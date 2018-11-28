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
 * @info $Id: MissionCaseSpy.php 2640 2013-03-23 19:23:26Z slaver7 $
 * @link http://2moons.cc/
 */

class MissionCaseSpy extends MissionFunctions
{
		
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{
		global $pricelist, $reslist, $resource;		
		$senderUser				= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
		$senderPlanet			= $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_start_id'].";");
		$senderUser['factor']	= getFactors($senderUser, 'basic', $this->_fleet['fleet_start_time']);
		$ownSpyLvl				= max($senderUser['spy_tech'], 1);
		
		$LNG					= $this->getLanguage($senderUser['lang']);
		$targetUser				= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = ".$this->_fleet['fleet_target_owner'].";");
		$targetPlanet			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		$StartOwner				= $this->_fleet['fleet_owner'];
		$targetSpyLvl			= max($targetUser['spy_tech'], 1);
		
		$targetUser['factor']				= getFactors($targetUser, 'basic', $this->_fleet['fleet_start_time']);
		$PlanetRess 						= new ResourceUpdate();
		list($targetUser, $targetPlanet)	= $PlanetRess->CalcResource($targetUser, $targetPlanet, true, $this->_fleet['fleet_start_time']);
		
		$userAlliance				 		= $senderUser['ally_id'] == 0 ? "" : " <span class=\"orange\">[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
		$ennemieAlliance 					= $targetUser['ally_id'] == 0 ? "" : " <span class=\"orange\">[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";

		$ownSpyLvl		= $senderUser['spy_tech'];
		$targetSpyLvl	= $targetUser['spy_tech'];
				
		$Diffence		= $ownSpyLvl - $targetSpyLvl;
		$SpyRes			= $Diffence >= 0;
		$SpyOwn			= $Diffence >= 1;
		$SpyDef			= $Diffence >= 2;
		$SpyPop			= $Diffence >= 3;
		$SpyFleet		= $Diffence >= 4;
		$SpyBuild		= $Diffence >= 5;
		$SpyTechno		= $Diffence >= 6;
		$classIDs		= array();
		$OwnArray		= array();
		$HTML			= "";
		$linkCreate 	= "";
		if($SpyRes) {
			$classIDs[900]	= $reslist['resstype'][1];
		}
		if($SpyOwn) {
			$HTML     .= "<h3>".$LNG['tech'][1400]." :</h3>";
			if(empty($targetPlanet['specialships'])){
				$HTML .= "<div style=\"text-align : left;\">— ".$LNG['NOUVEAUTE_703']."<br>— ".$LNG['NOUVEAUTE_704']."<br></div>";
			}else{
				$OwnShips			= explode(';', $targetPlanet['specialships']);		
				foreach($OwnShips as $Items)
				{
					$temp 			= explode(',', $Items);
					if($temp[1] == 0)
						continue;
					$OwnArray[]		= array($temp[0], $temp[1]);
				}
				foreach($OwnArray as $Items)
				{
					$ElementY   	= $Items[0];
					$Availables 	= $Items[1];
					$getShipInfo	= $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, shipFret, nom, image, shipAttack, shipBouclier, shipCoque FROM ".VARS_USER." WHERE owerId = ".$targetUser['id']." AND varId = ".$ElementY.";");
					$HTML .= "<div style=\"display : inline-block; min-width : 140px; padding-right : 10px;\">".$getShipInfo['nom']." : <span class=\"orange\">".pretty_number($Availables)."</span> u.</div><div style=\"display : inline-block; font-size : 11px;\">(".$LNG['NOUVEAUTE_705']." : <span class=\"rouge\">".pretty_number($getShipInfo['shipAttack'])."</span> / ".$LNG['NOUVEAUTE_706']." : <span class=\"violet\">".pretty_number($getShipInfo['shipBouclier'])."</span> / ".$LNG['NOUVEAUTE_707']." : <span class=\"cyan\">".pretty_number($getShipInfo['shipCoque'])."</span>)</div> <br>";
					$linkCreate .= "&amp;im[".$ElementY."]=".$Availables;
				}
			}
		} 
		if($SpyDef) {
			$classIDs[400]	= $reslist['defense'];
		}
		if($SpyPop) {
			$classIDs[300]	= $reslist['population'];
		}
		if($SpyFleet) {
			$classIDs[200]	= $reslist['fleet'];
		}
		if($SpyBuild) {
			$classIDs[0]	= $reslist['build'];
		}
		if($SpyTechno) {
			$classIDs[100]	= $reslist['tech'];
		}
				
		foreach($classIDs as $classID => $elementIDs){
			foreach($elementIDs as $elementID)
			{
				if($classID == 100)
				{
					$spyData[$classID][$elementID]	= $targetUser[$resource[$elementID]];
				}
				else 
				{
					$spyData[$classID][$elementID]	= $targetPlanet[$resource[$elementID]];
				}
			}
			$spyData[$classID]	= array_filter($spyData[$classID]);
		}
				
		if($Diffence < 0){
			$spyRaport = sprintf($LNG['NOUVEAUTE_701'], $targetPlanet['name'], $targetPlanet['system'],$targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemieAlliance, $targetPlanet['name'], $targetPlanet['system'],$targetPlanet['planet']);
		}else{
			$AddToMessage = "";
			$AddToMessage1 = "";
			foreach($spyData as $Class => $elementIDs){
				if($Class == 900){
					$AddToMessage .= "<h3>".$LNG['tech'][$Class]." :</h3>";
					$AddToMessage .= "<div class=\"rapport_colonne\">";
					foreach($elementIDs as $elementID => $amount){
						$AddToMessage .= "&mdash; ".$LNG['tech'][$elementID]." : <span class=\"orange\">".pretty_number($amount)."</span><br />";
					}
					$AddToMessage .= "</div>";
				}
			}
					
			foreach($spyData as $Class => $elementIDs){
				if($Class != 900){
					$AddToMessage1 .= "<h3>".$LNG['tech'][$Class]." :</h3>";
					$AddToMessage1 .= "<div class=\"rapport_colonne\">";
					foreach($elementIDs as $elementID => $amount){
						$AddToMessage1 .= "&mdash; ".$LNG['tech'][$elementID]." : <span class=\"orange\">".pretty_number($amount)."</span><br />";
					}
					$AddToMessage1 .= "</div>";
				}
			}
			
			foreach($spyData as $Class => $elementIDs){
				foreach($elementIDs as $elementID => $amount){
					$linkCreate .= "&amp;im[".$elementID."]=".$amount;
				}
			}
			$linkCreate .= "&amp;planetId=".$this->_fleet['fleet_end_id']."&amp;timeofRa=".TIMESTAMP;
			
			$spyRaport = sprintf($LNG['NOUVEAUTE_845'], $targetPlanet['name'], $targetPlanet['system'],$targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemieAlliance, $targetPlanet['name'], $targetPlanet['system'],$targetPlanet['planet'], $AddToMessage, $HTML, $AddToMessage1, $linkCreate, $linkCreate);
		}
		SendSimpleMessage($senderUser['id'], $targetUser['id'], TIMESTAMP, 0, sprintf($LNG['sys_mess_tower_spy_ownerbis'], $targetPlanet['name'], $targetPlanet['system'],$targetPlanet['planet']), sprintf($LNG['NOUVEAUTE_697'], $this->getUsername($targetUser['id'])), $spyRaport); 
				
		
		if($senderUser['occultation_tech'] <= $targetUser['sensors_tech']){
			$LNGK	= new Language($targetUser['lang']);
			$LNGK->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
			$spyRaport1 = sprintf($LNGK['NOUVEAUTE_700'], $senderUser['username'], $userAlliance, $targetPlanet['name'], $targetPlanet['system'],$targetPlanet['planet'], $senderPlanet['name'], $senderPlanet['system'],$senderPlanet['planet']);
			SendSimpleMessage($targetUser['id'], $senderUser['id'], TIMESTAMP, 0, sprintf($LNGK['sys_mess_tower_spy_targetbis'], $targetPlanet['name'], $targetPlanet['system'],$targetPlanet['planet']), sprintf($LNGK['NOUVEAUTE_699'], $senderUser['username']), $spyRaport1);		
			
			$CONF		= Config::getAll(NULL, $this->_fleet['fleet_universe']);
			$WhereCol	= $this->_fleet['fleet_end_type'] == 3 ? "id_luna" : "id";		
			$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET der_metal = der_metal + ".(1 * $pricelist[210]['cost'][901] * (Config::get('Fleet_Cdr') / 100)).", der_crystal = der_crystal + ".(1 * $pricelist[210]['cost'][902] * (Config::get('Fleet_Cdr') / 100)).", der_deuterium = der_deuterium + ".(1 * $pricelist[210]['cost'][903] * (Config::get('Fleet_Cdr') / 100))." WHERE ".$WhereCol." = ".$this->_fleet['fleet_end_id'].";");
			$this->KillFleet();
		}else{
			$this->setState(FLEET_RETURN);
			$this->SaveFleet();
		}
		
		

	}
	
	function EndStayEvent()
	{
		return;
	}
	
	function ReturnEvent()
	{	
	
		$senderUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT lang, ally_id FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
		$targetUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id FROM ".USERS." WHERE id = ".$this->_fleet['fleet_target_owner'].";");
		$senderPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_start_id'].";");
		$targetPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name, id_owner FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		$userAlliance  = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
		$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
		
		$LNG		   = new Language($senderUser['lang']);
		$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
		$Var 		   = "<span class=\"vert\">".$LNG['ls_answer_1']."</span>";
		if($this->_fleet['hasCanceled'] != 0)
			$Var = "<span class=\"rouge\">".$LNG['ls_answer_2']."</span>";
		
		$Date		   = date("d F Y à H:i", TIMESTAMP);
		$ReturnMessage = sprintf($LNG['NOUVEAUTE_712'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetPlanet['id_owner']), $ennemAlliance, $LNG['type_missionbis'][6], $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']);
		SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_target_owner'], TIMESTAMP, 5, $LNG['NOUVEAUTE_713'], sprintf($LNG['NOUVEAUTE_714'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']), $ReturnMessage); 
		$this->RestoreFleet();
	}
}
