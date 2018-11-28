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
 * @info $Id: MissionCaseStay.php 2640 2013-03-23 19:23:26Z slaver7 $
 * @link http://2moons.cc/
 */

class MissionCaseStay extends MissionFunctions
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{	
		global $resource;
		$senderUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT lang, ally_id, id FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
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
		$HTML3			= "";
		
		$fleetArray			= fleetAmountToArray($this->_fleet['fleet_array']);
		$duration			= $this->_fleet['fleet_start_time'] - $this->_fleet['start_time'];
		
		require_once('includes/classes/class.FleetFunctions.php');
		
		$fleetMaxSpeed 		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $senderUser);
		$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
		$distance			= FleetFunctions::GetTargetDistance(
			array($this->_fleet['fleet_start_galaxy'], $this->_fleet['fleet_start_system'], $this->_fleet['fleet_start_planet']),
			array($this->_fleet['fleet_end_galaxy'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'])
		);
		
		$consumption   		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $duration, $distance, $fleetMaxSpeed, $senderUser, $SpeedFactor);
		
		//$this->UpdateFleet('fleet_resource_elyrium', $this->_fleet['fleet_resource_elyrium'] + $consumption / 2);
		
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
		
		foreach ($fleetData2 as $fleetRow)
		{
			if (empty($fleetRow)) continue;
			$temp        = explode (",", $fleetRow);			
			$HTML3 .= "<div class=\"element_item\"><img src=\"/styles/theme/gow/gebaeude/".$temp[0].".gif\">".$LNG['tech'][$temp[0]]." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
		}
		
		$ToGoMessage = sprintf($LNG['NOUVEAUTE_734'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $HTML1, $HTML, $HTML2, $HTML3);		
		
		SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 7, $LNG['sys_mess_tower_deploy_good'], sprintf($LNG['NOUVEAUTE_733'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']), $ToGoMessage); 
				
		$this->RestoreFleet(false);
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
		$HTML3			= "";
		
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
		
		foreach ($fleetData2 as $fleetRow)
		{
			if (empty($fleetRow)) continue;
			$temp        = explode (",", $fleetRow);			
			$HTML3 .= "<div class=\"element_item\"><img src=\"/styles/theme/gow/gebaeude/".$temp[0].".gif\">".$LNG['tech'][$temp[0]]." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
		}
		
		
		
		$ReturnMessage = sprintf($LNG['NOUVEAUTE_732'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemAlliance, $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML1, $HTML, $HTML2, $HTML3);
		SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 5, $LNG['sys_mess_tower_deploy_fail'], sprintf($LNG['NOUVEAUTE_714'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']), $ReturnMessage); 
		
		$this->RestoreFleet();
	}
}