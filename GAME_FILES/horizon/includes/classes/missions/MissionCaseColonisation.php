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
 * @info $Id: MissionCaseColonisation.php 2640 2013-03-23 19:23:26Z slaver7 $
 * @link http://2moons.cc/
 */

class MissionCaseColonisation extends MissionFunctions
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{	
		global $resource;
		$iPlanetCount 	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `id_owner` = '". $this->_fleet['fleet_owner'] ."' AND `planet_type` = '1' AND `destruyed` = '0';");
		$iGalaxyPlace 	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `id` = '".$this->_fleet['fleet_end_id']."';");
		$senderUser		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE `id` = '".$this->_fleet['fleet_owner']."';");
		$senderPlanet	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE `id` = '".$this->_fleet['fleet_start_id']."';");
		$LNG			= $this->getLanguage($senderUser['lang']);
		
		$MaxPlanets		= PlayerUtil::maxPlanetCount($senderUser);
		
		if ($iGalaxyPlace != 0 || $iPlanetCount >= $MaxPlanets){
			$TheMessage = sprintf($LNG['NOUVEAUTE_727'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'], "jaune", $LNG['type_missionbis'][$this->_fleet['fleet_mission']]);
			SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 7, $LNG['sys_colo_mess_from_text1'], sprintf($LNG['sys_colo_mess_report1'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet']), $TheMessage);
					
		}else{
			$bonus_iron = mt_rand(1,40);
			$bonus_gold = mt_rand(1,40);
			$bonus_crys = mt_rand(1,40);
			$bonus_elyr = mt_rand(1,40);
			$Color = 'vert';
			$Color1 = 'vert';
			$Color2 = 'vert';
			$Color3 = 'vert';
			$bonus_iron_perc = rand(1,55);
			$bonus_gold_perc = rand(1,55);
			$bonus_crys_perc = rand(1,55);
			$bonus_elyr_perc = rand(1,55);
			if($bonus_iron_perc >= $bonus_iron){
				$bonus_iron *= -1;
				$Color = 'rouge';
			}
			if($bonus_gold_perc >= $bonus_gold){
				$bonus_gold *= -1;
				$Color1 = 'rouge';
			}
			if($bonus_crys_perc >= $bonus_crys){
				$bonus_crys *= -1;
				$Color2 = 'rouge';
			}
			if($bonus_elyr_perc >= $bonus_elyr){
				$bonus_elyr *= -1;
				$Color3 = 'rouge';
			}
			require_once('includes/functions/CreateOnePlanetRecord.php');
			$PlanetNameChoosed = $this->GenerateName();
			$NewOwnerPlanet = CreateOnePlanetRecord($this->_fleet['fleet_end_galaxy'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'], $this->_fleet['fleet_universe'], $this->_fleet['fleet_owner'], $PlanetNameChoosed, false, $senderUser['authlevel'], $bonus_iron , $bonus_gold, $bonus_crys, $bonus_elyr, $iPlanetCount);
			if($NewOwnerPlanet === false){
				$TheMessage = sprintf($LNG['NOUVEAUTE_727'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'], "jaune", $LNG['type_missionbis'][$this->_fleet['fleet_mission']]);
				SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 7, $LNG['sys_colo_mess_from_text1'], sprintf($LNG['sys_colo_mess_report1'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet']), $TheMessage);
			}else{
				$this->_fleet['fleet_end_id']	= $NewOwnerPlanet;
				$this->StoreResourceToPlanet();
				$this->UpdateFleet('fleet_resource_metal', 0);
				$this->UpdateFleet('fleet_resource_crystal', 0);
				$this->UpdateFleet('fleet_resource_deuterium', 0);
				$this->UpdateFleet('fleet_resource_elyrium', 0);
				$this->UpdateFleet('fleet_population_303', ($this->_fleet['fleet_population_303'] - 10));
				$this->UpdateFleet('fleet_population_306', ($this->_fleet['fleet_population_306'] - 100));
				$this->StorePopulationToPlanet();
				$TheMessage = sprintf($LNG['NOUVEAUTE_728'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'], $PlanetNameChoosed, $Color, $bonus_iron, "%", $Color1, $bonus_gold, "%", $Color2, $bonus_crys, "%", $Color3, $bonus_elyr, "%");
				SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 7, $LNG['sys_colo_mess_from_text'], sprintf($LNG['sys_colo_mess_report2'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet']), $TheMessage);
			}
		}
		$this->setState(FLEET_RETURN);
		$this->SaveFleet();
	}
	
	function EndStayEvent()
	{
		return;
	}
	
	function ReturnEvent()
	{
		global $resource;
		
		$senderUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT lang, ally_id FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
		$targetUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id, id FROM ".USERS." WHERE id = ".$this->_fleet['fleet_target_owner'].";");
		$senderPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_start_id'].";");
		$targetPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name, id_owner FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		$userAlliance  = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
		$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
		$PopulatiArray = array(301,302,303,304,305,306,307,308,309);
		$ResourceArray = array(901,902,903,904);
		
		$LNG		   = new Language($senderUser['lang']);
		$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
		$Var 		   = "<span class=\"vert\">".$LNG['ls_answer_1']."</span>";
		if($this->_fleet['hasCanceled'] != 0)
			$Var = "<span class=\"rouge\">".$LNG['ls_answer_2']."</span>";
		
		$Date		   = date("d F Y à H:i", TIMESTAMP);
		
		$AddToMessage 	= "";
		$HTML			= "";
		$HTML1			= "";
		$HTML2			= "";
		$fleetData	= explode(";", $this->_fleet['fleet_array']);
		
		foreach($ResourceArray as $resId){
			if($this->_fleet['fleet_resource_'.$resource[$resId]] > 0)
				$HTML .= " <div class=\"element_item\"><img src=\"/media/ingame/image/".$resource[$resId].".jpg\">".$LNG['tech'][$resId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_resource_'.$resource[$resId]])."</span> unités</div>";
		}
		
		foreach ($fleetData as $fleetRow)
		{
			if (empty($fleetRow)) continue;
			$temp        = explode (",", $fleetRow);
			$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom, image FROM ".VARS_USER." WHERE owerId = ".$this->_fleet['fleet_owner']." AND varId = ".$temp[0].";");
			
			$HTML1 .= "<div class=\"element_item\"><img src=\"".$getUserShip['image']."\">".$getUserShip['nom']." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
		}
		
		foreach($PopulatiArray as $popId){
			if($this->_fleet['fleet_population_'.$popId] > 0)
				$HTML2 .= " <div class=\"element_item\"><img src=\"/media/ingame/population/".$popId.".jpg\">".$LNG['tech'][$popId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_population_'.$popId])."</span> unités</div>";
		}
		
		if($this->_fleet['hasCanceled'] != 0)
			$ReturnMessage = sprintf($LNG['NOUVEAUTE_731'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $LNG['NOUVEAUTE_717'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'], $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML1, $HTML2);
		else
			$ReturnMessage = sprintf($LNG['NOUVEAUTE_730'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemAlliance, $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML1, $HTML, $HTML2);
		
		SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 5, $LNG['NOUVEAUTE_729'], sprintf($LNG['NOUVEAUTE_714'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']), $ReturnMessage); 
		
		$this->RestoreFleet();
	}
}