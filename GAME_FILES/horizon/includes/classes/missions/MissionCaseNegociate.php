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
 * @info $Id: MissionCaseTransport.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */
class MissionCaseNegociate extends MissionFunctions
{		
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{

		global $resource;
		
		$senderUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT lang, ally_id, username, id FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
		$targetUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id, id, username, lang FROM ".USERS." WHERE id = ".$this->_fleet['fleet_target_owner'].";");
		$senderPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_start_id'].";");
		$targetPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name, id_owner FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		$userAlliance  = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
		$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
		$SelectCount   = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$targetUser['id']." AND owner = ".$senderUser['id'].") OR (sender = ".$senderUser['id']." AND owner = ".$targetUser['id']." );");
		
		if(!empty($SelectCount)){
			$LNG		   = new Language($senderUser['lang']);
			$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
			
			$TheMessage = sprintf($LNG['NOUVEAUTE_727'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'], "jaune", $LNG['type_missionbis'][$this->_fleet['fleet_mission']]);
			SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 7, $LNG['sys_colo_mess_from_text1'], sprintf($LNG['sys_colo_mess_report1'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet']), $TheMessage);
		}else{
			$GLOBALS['DATABASE']->query("INSERT INTO uni1_buddy (sender,owner,state,time,universe) VALUES('".$this->_fleet['fleet_owner']."', '".$this->_fleet['fleet_target_owner']."', '0', '".(TIMESTAMP)."', '1');");
			$this->UpdateFleet('fleet_population_305', ($this->_fleet['fleet_population_305'] - 5));
			$this->UpdateFleet('fleet_population_306', ($this->_fleet['fleet_population_306'] - 10));
			
			$LNG		   = new Language($senderUser['lang']);
			$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
			$Message = sprintf($LNG['NOUVEAUTE_555'], $senderUser['username'], $userAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance);
			SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_target_owner'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_743'], $targetUser['username']), sprintf($LNG['NOUVEAUTE_556'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']), $Message);
			$LNG		   = new Language($targetUser['lang']);
			$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
			$Message = sprintf($LNG['NOUVEAUTE_744'], $senderUser['username'], $userAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']);
			SendSimpleMessage($this->_fleet['fleet_target_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_574'], $senderUser['username']), sprintf($LNG['NOUVEAUTE_573'], $senderUser['username']), $Message);
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
		$fleetData	   = explode(";", $this->_fleet['fleet_array']);
		$fleetData2	   = explode(";", $this->_fleet['specialized_array']);
		$ResourceArray = array(901,902,903,904);
		$PopulatiArray = array(301,302,303,304,305,306,307,308,309);
		
		$LNG		   = new Language($senderUser['lang']);
		$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
		$Var 		   = "<span class=\"vert\">".$LNG['ls_answer_1']."</span>";
		if($this->_fleet['hasCanceled'] != 0)
			$Var = "<span class=\"rouge\">".$LNG['ls_answer_2']."</span>";
		
		$Date		   = date("d F Y à H:i", TIMESTAMP);
		
		$HTML			= "";
		$HTML1			= "";
		$HTML2			= "";
		
		foreach ($fleetData as $fleetRow)
		{
			if (empty($fleetRow)) continue;
			$temp        = explode (",", $fleetRow);
			$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT nom, image FROM ".VARS_USER." WHERE owerId = ".$this->_fleet['fleet_owner']." AND varId = ".$temp[0].";");
			
			$HTML1 .= "<div class=\"element_item\"><img src=\"".$getUserShip['image']."\">".$getUserShip['nom']." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
		}
		
		foreach($ResourceArray as $resId){
			if($this->_fleet['fleet_resource_'.$resource[$resId]] > 0)
				$HTML .= " <div class=\"element_item\"><img src=\"/media/ingame/image/".$resource[$resId].".jpg\">".$LNG['tech'][$resId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_resource_'.$resource[$resId]])."</span> unités</div>";
		}
		
		foreach($PopulatiArray as $popId){
			if($this->_fleet['fleet_population_'.$popId] > 0)
				$HTML2 .= " <div class=\"element_item\"><img src=\"/media/ingame/population/".$popId.".jpg\">".$LNG['tech'][$popId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_population_'.$popId])."</span> unités</div>";
		}
		
		$ReturnMessage = sprintf($LNG['NOUVEAUTE_742'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemAlliance, $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML1, $HTML, $HTML2);
				
		SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_target_owner'], TIMESTAMP, 5, $LNG['NOUVEAUTE_741'], sprintf($LNG['NOUVEAUTE_714'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']), $ReturnMessage); 
		
		$this->RestoreFleet();
	}
}