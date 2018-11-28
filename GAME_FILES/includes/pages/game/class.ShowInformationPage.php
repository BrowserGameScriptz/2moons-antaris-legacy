<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kröpke
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2012 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.3 (2013-05-19)
 * @info $Id: class.ShowInformationPage.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */


class ShowInformationPage extends AbstractPage
{
	public static $requireModule = MODULE_INFORMATION;
	
	//protected $disableEcoSystem = true;

	function __construct() 
	{
		parent::__construct();
	}
		
	static function getNextJumpWaitTime($lastTime)
	{
		global $CONF;
		
		return $lastTime + Config::get('gate_wait_time');
	}

	private function AddBuildingToQueue2($Element, $AddMode = true)
	{
		global $PLANET, $USER, $resource, $CONF, $reslist, $pricelist;
		
		if(!in_array($Element, $reslist['allow'][$PLANET['planet_type']])
			|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element) 
			|| ($Element == 31 && $USER["b_tech_planet"] != 0) 
			|| (($Element == 15 || $Element == 21) && !empty($PLANET['b_hangar_id']))
			|| (!$AddMode && $PLANET[$resource[$Element]] == 0)
		)
			return;
		
		$CurrentQueue  		= unserialize($PLANET['b_building_id']);

				
		if (!empty($CurrentQueue)) {
			$ActualCount	= count($CurrentQueue);
		} else {
			$CurrentQueue	= array();
			$ActualCount	= 0;
		}
		
		$CurrentMaxFields  	= CalculateMaxPlanetFields($PLANET);
		
		$max_build = Config::get('max_elements_build');
		if($USER['mode_chaine'] > TIMESTAMP){
		$max_build += 2;
		}
		
		if (($max_build != 0 && $ActualCount == $max_build) || ($AddMode && $PLANET["field_current"] >= ($CurrentMaxFields - $ActualCount)))
			return;
	
		$BuildMode 			= 'destroy';
		$BuildLevel			= $PLANET[$resource[$Element]] + (int) $AddMode;
		
		if($ActualCount == 0)
		{

			$costRessources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element, true, $PLANET[$resource[$Element]]);
			
			if(isset($costRessources[901])) { $PLANET[$resource[901]]	+= $costRessources[901]; }
			if(isset($costRessources[902])) { $PLANET[$resource[902]]	+= $costRessources[902]; }
			if(isset($costRessources[903])) { $PLANET[$resource[903]]	+= $costRessources[903]; }
			if(isset($costRessources[921])) { $USER[$resource[921]]		+= $costRessources[921]; }
			
			$elementTime    			= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costRessources);
			$BuildEndTime				= TIMESTAMP + $elementTime;
			
			$PLANET['b_building_id']	= serialize(array(array($Element, $BuildLevel, $elementTime, $BuildEndTime, $BuildMode)));
			$PLANET['b_building']		= $BuildEndTime;
			
		} else {
			$addLevel = 0;
			foreach($CurrentQueue as $QueueSubArray)
			{
				if($QueueSubArray[0] != $Element)
					continue;
					
				if($QueueSubArray[4] == 'build')
					$addLevel++;
				else
					$addLevel--;
			}
			
			$BuildLevel					+= $addLevel;
			
			if(!$AddMode && $BuildLevel == 0)
				return;
				
			if($pricelist[$Element]['max'] < $BuildLevel)
				return;
				
			$elementTime    			= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, NULL, !$AddMode, $BuildLevel);
			$BuildEndTime				= $CurrentQueue[$ActualCount - 1][3] + $elementTime;
			$CurrentQueue[]				= array($Element, $BuildLevel, $elementTime, $BuildEndTime, $BuildMode);
			$PLANET['b_building_id']	= serialize($CurrentQueue);		
		}

	}
	
	public function sendFleet()
	{
		global $PLANET, $USER, $resource, $LNG, $reslist;

		$NextJumpTime = self::getNextJumpWaitTime($PLANET['last_jump_time']);
		
		if (TIMESTAMP < $NextJumpTime) {
			$this->sendJSON(array('message' => $LNG['in_jump_gate_already_used'].' '.pretty_time($NextJumpTime - TIMESTAMP), 'error' => true));
		}
		
		$TargetPlanet = HTTP::_GP('jmpto', (int) $PLANET['id']);
		$TargetGate   = $GLOBALS['DATABASE']->getFirstRow("SELECT id, last_jump_time FROM ".PLANETS." WHERE id = ".$TargetPlanet." AND id_owner = ".$USER['id']." AND sprungtor > 0;");

		if (!isset($TargetGate) || $TargetPlanet == $PLANET['id']) {
			$this->sendJSON(array('message' => $LNG['in_jump_gate_doesnt_have_one'], 'error' => true));
		}
		
		$NextJumpTime   = self::getNextJumpWaitTime($TargetGate['last_jump_time']);
				
		if (TIMESTAMP < $NextJumpTime) {
			$this->sendJSON(array('message' => $LNG['in_jump_gate_not_ready_target'].' '.pretty_time($NextJumpTime - TIMESTAMP), 'error' => true));
		}
		
		$ShipArray		= array();
		$SubQueryOri	= "";
		$SubQueryDes	= "";
		$Ships			= HTTP::_GP('ship', array());
		
		foreach($reslist['fleet'] as $Ship)
		{
			if(!isset($Ships[$Ship]) || $Ship == 212)
				continue;
				
			$ShipArray[$Ship]	= max(0, min($Ships[$Ship], $PLANET[$resource[$Ship]]));
					
			if(empty($ShipArray[$Ship]))
				continue;
								
			$SubQueryOri 		.= $resource[$Ship]." = ".$resource[$Ship]." - ".$ShipArray[$Ship].", ";
			$SubQueryDes 		.= $resource[$Ship]." = ".$resource[$Ship]." + ".$ShipArray[$Ship].", ";
			$PLANET[$resource[$Ship]] -= $ShipArray[$Ship];
		}

		if (empty($SubQueryOri)) {
			$this->sendJSON(array('message' => $LNG['in_jump_gate_error_data'], 'error' => true));
		}
		
		$JumpTime	= TIMESTAMP;

		$SQL  = "UPDATE ".PLANETS." SET ";
		$SQL .= $SubQueryOri;
		$SQL .= "last_jump_time = ".$JumpTime." ";
		$SQL .= "WHERE ";
		$SQL .= "id = ". $PLANET['id'].";";
		$SQL .= "UPDATE ".PLANETS." SET ";
		$SQL .= $SubQueryDes;
		$SQL .= "last_jump_time = ".$JumpTime." ";
		$SQL .= "WHERE ";
		$SQL .= "id = ".$TargetPlanet.";";
		$GLOBALS['DATABASE']->multi_query($SQL);

		$PLANET['last_jump_time'] 	= $JumpTime;
		$NextJumpTime	= self::getNextJumpWaitTime($PLANET['last_jump_time']);
		$this->sendJSON(array('message' => sprintf($LNG['in_jump_gate_done'], pretty_time($NextJumpTime - TIMESTAMP)), 'error' => false));
	}

	private function getAvalibleFleets()
	{
		global $reslist, $resource, $PLANET;

        $fleetList  = array();

		foreach($reslist['fleet'] as $Ship)
		{
			if ($Ship == 212 || $PLANET[$resource[$Ship]] <= 0)
				continue;
						
			$fleetList[$Ship]	= $PLANET[$resource[$Ship]];
		}
				
		return $fleetList;
	}

	public function destroyMissiles()
	{
		global $resource, $PLANET;
		
		$Missle	= HTTP::_GP('missile', array());
		$PLANET[$resource[502]]	-= max(0, min($Missle[502], $PLANET[$resource[502]]));
		$PLANET[$resource[503]]	-= max(0, min($Missle[503], $PLANET[$resource[503]]));
		
		$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[502]." = ".$PLANET[$resource[502]].", ".$resource[503]." = ".$PLANET[$resource[503]]." WHERE id = ".$PLANET['id'].";");
		
		$this->sendJSON(array($PLANET[$resource[502]], $PLANET[$resource[503]]));
	}

	private function getTargetGates()
	{
		global $resource, $USER, $PLANET;
								
		$Order = $USER['planet_sort_order'] == 1 ? "DESC" : "ASC" ;
		$Sort  = $USER['planet_sort'];

        switch($Sort) {
            case 1:
                $OrderBy	= "galaxy, system, planet, planet_type ". $Order;
                break;
            case 2:
                $OrderBy	= "name ". $Order;
                break;
            default:
                $OrderBy	= "id ". $Order;
                break;
        }
				
				
        $moonResult	= $GLOBALS['DATABASE']->query("SELECT id, name, galaxy, system, planet, last_jump_time, ".$resource[43]." FROM ".PLANETS." WHERE id != ".$PLANET['id']." AND id_owner = ". $USER['id'] ." AND planet_type = '3' AND ".$resource[43]." > 0 ORDER BY ".$OrderBy.";");
        $moonList	= array();

        while($moonRow = $GLOBALS['DATABASE']->fetch_array($moonResult)) {
			$NextJumpTime				= self::getNextJumpWaitTime($moonRow['last_jump_time']);
			$moonList[$moonRow['id']]	= '['.$moonRow['galaxy'].':'.$moonRow['system'].':'.$moonRow['planet'].'] '.$moonRow['name'].(TIMESTAMP < $NextJumpTime ? ' ('.pretty_time($NextJumpTime - TIMESTAMP).')':'');
		}
		
		$GLOBALS['DATABASE']->free_result($moonResult);

		return $moonList;
	}

	public function show()
	{
		global $USER, $PLANET, $dpath, $LNG, $resource, $pricelist, $reslist, $CombatCaps, $ProdGrid, $CONF;

		$elementID 	= HTTP::_GP('id', 0);
		$Command 	= HTTP::_GP('cmd', '');
		
		$AllTech = array();
   
		$GetAll = $GLOBALS['DATABASE']->query("SELECT * FROM ".VARS_REQUIRE." WHERE elementID = ".$elementID." ;");
		if($GLOBALS['DATABASE']->numRows($GetAll)>0){
		while($x = $GLOBALS['DATABASE']->fetch_array($GetAll)){
		$AllTech[] = $x;
		}
		}
		
		
		$productionTable	= array();
		$FleetInfo			= array();
		$MissileList		= array();
		$gateData			= array();
		$fleetIdBugs		= array(202,203,210,224,225,226,221,222,209,223,219);
		$defIdBugs			= array(412,413,414,415,416,417,418);
		$buildingIdBugs		= array(4,10,1,2,3,48,7,8,9,11,22,23,24,25,45,21,46,14,31,5,33,47);
		$technoloIdBugs		= array(113,140,141,142,143,144,109,110,111,115,117,118,124,145,106,146,147,148,149);
		$populatiIdBugs		= array(301,302,303,304,305,306,307,308,309);
		
		if(!in_array($elementID, array_merge($fleetIdBugs, $defIdBugs, $buildingIdBugs, $technoloIdBugs, $populatiIdBugs)))
			$this->redirectTo('game.php?page=overview');
		
		if($Command == "destroy"){
			$this->AddBuildingToQueue2($elementID, false);
			$this->redirectTo('game.php?page=buildings');
		}
		
		$CurrentLevel		= 0;
		
		$ressIDs			= array_merge(array(), $reslist['resstype'][1], $reslist['resstype'][2], $reslist['resstype'][4]);
		
		if(in_array($elementID, $reslist['prod']) && in_array($elementID, $buildingIdBugs))
		{
			$BuildLevelFactor	= 10;
			$BuildTemp       	= $PLANET['temp_max'];
			$CurrentLevel		= $PLANET[$resource[$elementID]];
			$BuildEnergy		= $USER[$resource[113]];
			$BuildLevel     	= max($CurrentLevel, 0);
			$BuildStartLvl   	= max($CurrentLevel - 0, 0);
						
			for($BuildLevel = $BuildStartLvl; $BuildLevel < $BuildStartLvl + 8; $BuildLevel++)
			{
				foreach($ressIDs as $ID) 
				{
					if(!isset($ProdGrid[$elementID]['production'][$ID]))
						continue;
						
					$Production	= eval(ResourceUpdate::getProd($ProdGrid[$elementID]['production'][$ID]));
					
					if($ID <905) {
						$Production	*= Config::get('resource_multiplier');
					}
					
					$productionTable['production'][$BuildLevel][$ID]	= $Production;
				}
			}
			
			$productionTable['usedResource']	= array_keys($productionTable['production'][$BuildStartLvl]);
		}
		elseif(in_array($elementID, $reslist['storage']))
		{
			$BuildLevelFactor	= 10;
			$BuildTemp       	= $PLANET['temp_max'];
			$CurrentLevel		= $PLANET[$resource[$elementID]];
			$BuildEnergy		= $USER[$resource[113]];
			$BuildLevel     	= max($CurrentLevel, 0);
			$BuildStartLvl   	= max($CurrentLevel - 0, 0);
						
			for($BuildLevel = $BuildStartLvl; $BuildLevel < $BuildStartLvl + 8; $BuildLevel++)
			{
				foreach($ressIDs as $ID) 
				{
					if(!isset($ProdGrid[$elementID]['storage'][$ID]))
						continue;
						
					$productionTable['storage'][$BuildLevel][$ID]	= round(eval(ResourceUpdate::getProd($ProdGrid[$elementID]['storage'][$ID]))) * Config::get('resource_multiplier') * STORAGE_FACTOR;
				}
			}
			
			$productionTable['usedResource']	= array_keys($productionTable['storage'][$BuildStartLvl]);
		}
		elseif(in_array($elementID, $fleetIdBugs))
		{
			$MaxSpeed = 15000;
			$FleetInfo	= array(
				'structure'		=> ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902]) / 10,
				'structureTech'		=> ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902]) / 10 * (1 + (0.1 * $USER['shield_tech']) + $USER['factor']['Shield']),
				'tech'			=> $pricelist[$elementID]['tech'],
				'attack'		=> $CombatCaps[$elementID]['attack'],
				'attackTech'		=> $CombatCaps[$elementID]['attack'] * (1 + (0.1 * $USER['military_tech']) + $USER['factor']['Attack']) * (rand(80, 120) / 100),
				'shield'		=> $CombatCaps[$elementID]['shield'],
				'shieldTech'		=> $CombatCaps[$elementID]['shield'] * (1 + (0.1 * $USER['defence_tech']) + $USER['factor']['Defensive']),
				'capacity'		=> $pricelist[$elementID]['capacity'],
				'speed1'		=> 100/15000*$pricelist[$elementID]['speed'],
				'speed2'		=> $pricelist[$elementID]['speed2'],
				'consumption1'	=> $pricelist[$elementID]['consumption'],
				'consumption2'	=> $pricelist[$elementID]['consumption2'],
				'rapidfire'		=> array(
					'from'	=> array(),
					'to'	=> array(),
				),
			);
				
			$fleetIDs	= array_merge($reslist['fleet'], $reslist['defense']);
			
			foreach($fleetIDs as $fleetID)
			{
				if (isset($CombatCaps[$elementID]['sd']) && !empty($CombatCaps[$elementID]['sd'][$fleetID])) {
					$FleetInfo['rapidfire']['to'][$fleetID] = $CombatCaps[$elementID]['sd'][$fleetID];
				}
				
				if (isset($CombatCaps[$fleetID]['sd']) && !empty($CombatCaps[$fleetID]['sd'][$elementID])) {
					$FleetInfo['rapidfire']['from'][$fleetID] = $CombatCaps[$fleetID]['sd'][$elementID];
				}
			}
		}
		elseif (in_array($elementID, $defIdBugs))
		{
			$FleetInfo	= array(
				'structure'		=> ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902]) / 10,
				'structureTech'		=> ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902]) / 10 * (1 + (0.1 * $USER['shield_tech']) + $USER['factor']['Shield']),
				'attack'		=> $CombatCaps[$elementID]['attack'],
				'attackTech'		=> $CombatCaps[$elementID]['attack'] * (1 + (0.1 * $USER['military_tech']) + $USER['factor']['Attack']) * (rand(80, 120) / 100),
				'shield'		=> $CombatCaps[$elementID]['shield'],
				'shieldTech'		=> $CombatCaps[$elementID]['shield'] * (1 + (0.1 * $USER['defence_tech']) + $USER['factor']['Defensive']),
				'capacity'		=> 0,
				'speed1'		=> 0,
				'rapidfire'		=> array(
					'from'	=> array(),
					'to'	=> array(),
				),
			);
				
			$fleetIDs	= array_merge($reslist['fleet'], $reslist['defense']);
			
			foreach($fleetIDs as $fleetID)
			{
				if (isset($CombatCaps[$elementID]['sd']) && !empty($CombatCaps[$elementID]['sd'][$fleetID])) {
					$FleetInfo['rapidfire']['to'][$fleetID] = $CombatCaps[$elementID]['sd'][$fleetID];
				}
				
				if (isset($CombatCaps[$fleetID]['sd']) && !empty($CombatCaps[$fleetID]['sd'][$elementID])) {
					$FleetInfo['rapidfire']['from'][$fleetID] = $CombatCaps[$fleetID]['sd'][$elementID];
				}
			}
		}
		
		$number = 1;
		$elementBonus ='';
		if(isset($LNG['gameeffect'][$elementID])){
			$elementBonus		= BuildFunctions::getAvalibleEffect($elementID);
		}
		if(!$elementBonus)
			$number = 0;
		
		$destroyRessources  = 0;
		$destroyTime  		= 0;
		if($elementID < 100){
			$destroyRessources	= BuildFunctions::getElementPrice($USER, $PLANET, $elementID, true, $PLANET[$resource[$elementID]]);
			$destroyTime		= BuildFunctions::getBuildingTime($USER, $PLANET, $elementID, $destroyRessources);
		}	
		
		$this->tplObj->assign_vars(array(		
			'destroyRessources'		=> $destroyRessources,
			'destroyTime'			=> $destroyTime,	
			'planetinfo1'			=> $PLANET['metal_mine'],
			'planetinfo2'			=> $PLANET['crystal_mine'],
			'planetinfo3'			=> $PLANET['deuterium_sintetizer'],
			'planetinfo4'			=> $PLANET['solar_plant'],
			'planetinfo5'			=> $PLANET['headquarters_antaris'],
			'planetinfo14'			=> $PLANET['robot_factory'],
			'planetinfo21'			=> $PLANET['hangar'],
			'planetinfo31'			=> $PLANET['laboratory'],
			'planetinfo45'			=> $PLANET['barracks'],
			'planetinfo46'			=> $PLANET['defense_base'],
			'planetinfo47'			=> $PLANET['antaris_headpost'],
			'planetinfo48'			=> $PLANET['elyrium_mine'],
			'planetinfo106'			=> $USER['spy_tech'],
			'planetinfo109'			=> $USER['military_tech'],
			'planetinfo110'			=> $USER['defence_tech'],
			'planetinfo111'			=> $USER['shield_tech'],
			'planetinfo113'			=> $USER['energy_tech'],
			'planetinfo115'			=> $USER['combustion_tech'],
			'planetinfo117'			=> $USER['impulse_motor_tech'],
			'planetinfo118'			=> $USER['hyperspace_motor_tech'],
			'planetinfo140'			=> $USER['extraction_tech'],
			'planetinfo141'			=> $USER['control_room_tech'],
			'planetinfo142'			=> $USER['subspace_tech'],
			'planetinfo143'			=> $USER['particle_tech'],
			'planetinfo144'			=> $USER['antaris_tech'],
			'planetinfo145'			=> $USER['infrastructure_tech'],
			'planetinfo146'			=> $USER['virus_tech'],
			
			
			'number'			=> $number,
			'elementBonus'			=> $elementBonus,
			'elementID'			=> $elementID,
			'productionTable'	=> $productionTable,
			'CurrentLevel'		=> $CurrentLevel,
			'MissileList'		=> $MissileList,
			'Bonus'				=> BuildFunctions::getAvalibleBonus($elementID),
			'FleetInfo'			=> $FleetInfo,
			'gateData'			=> $gateData,
			'AllTech'		=> $AllTech,
			'techacc' => BuildFunctions::isTechnologieAccessible($USER, $PLANET, $elementID),
		));
		
		$this->display('page.infomation.default.tpl');
	}
}