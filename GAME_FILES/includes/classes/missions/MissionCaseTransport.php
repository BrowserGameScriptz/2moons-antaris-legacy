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
class MissionCaseTransport extends MissionFunctions
{		
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{
		global $resource;
		$senderUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT lang, ally_id, username, id FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
		$targetUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id, lang, id, username FROM ".USERS." WHERE id = ".$this->_fleet['fleet_target_owner'].";");
		$senderPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_start_id'].";");
		$targetPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name, id_owner FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		$userAlliance  = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
		$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
		$userRank	   = $GLOBALS['DATABASE']->getFirstRow("SELECT total_points FROM ".STATPOINTS." WHERE `id_owner` = '".$this->_fleet['fleet_owner']."';");
		$targetRank	   = $GLOBALS['DATABASE']->getFirstRow("SELECT total_points FROM ".STATPOINTS." WHERE `id_owner` = '".$this->_fleet['fleet_target_owner']."';");
		$fleetData2	   = explode(";", $this->_fleet['specialized_array']);
		$ResourceArray = array(901,902,903,904);
		$PopulatiArray = array(301,302,303,304,305,306,307,308,309);
		
		$Date		   = date("d F Y à H:i", TIMESTAMP);
		
		$HTML		   = "";
		$HTML1		   = "";
		$HTML2		   = "";
		
		$TotalTransported = 0;
		
		$TransportResLog	=	array();
		$TransportPopLog	=	array();
		$TransportDevLog	=	array();
		
		$LNG		   = new Language($senderUser['lang']);
		$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
		
		$technicienT						= 0;
		$scientifiqueT						= 0;
		$soldatT							= 0;
		$piloteT							= 0;
		$antarisT							= 0;
		$FleetRecord        				= explode(';', $this->_fleet['fleet_array']);
			
		foreach ($FleetRecord as $Item => $Group)
		{
			if (empty($Group)) continue;
				
			$Class			= explode(',', $Group);
			$getUserShip   = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure FROM ".VARS_USER." WHERE varId = ".$Class[0].";");
			$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
				
			$technicienT				+= $getUserPeople['technician']*$Class[1];
			$scientifiqueT				+= $getUserPeople['scientist']*$Class[1];
			$soldatT					+= $getUserPeople['soldier']*$Class[1];
			$piloteT					+= $getUserPeople['pilots']*$Class[1];
		}
			
		if($this->_fleet['fleet_owner'] == $this->_fleet['fleet_target_owner']){
			
			foreach($ResourceArray as $resId){
				if($this->_fleet['fleet_resource_'.$resource[$resId]] > 0){
					$HTML .= " <div class=\"element_item\"><img src=\"/media/ingame/image/".$resource[$resId].".jpg\">".$LNG['tech'][$resId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_resource_'.$resource[$resId]])."</span> unités</div>";
					$TransportResLog[] = $resId.",".$this->_fleet['fleet_resource_'.$resource[$resId]];
					$TotalTransported += $this->_fleet['fleet_resource_'.$resource[$resId]];
				}
			}
			
			foreach($PopulatiArray as $popId){
				$Var = 0;
				if($popId == 302)
					$Var = $technicienT;
				elseif($popId == 303)
					$Var = $scientifiqueT;
				elseif($popId == 306)
					$Var = $soldatT;
				elseif($popId == 308)
					$Var = $piloteT;
					
				if(($this->_fleet['fleet_population_'.$popId] - $Var) > 0){
					$HTML1 .= " <div class=\"element_item\"><img src=\"/media/ingame/population/".$popId.".jpg\">".$LNG['tech'][$popId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_population_'.$popId])."</span> unités</div>";
					$TransportPopLog[] = $popId.",".$this->_fleet['fleet_population_'.$popId];
					$TotalTransported += $this->_fleet['fleet_population_'.$popId];
				}
			}
			
			foreach ($fleetData2 as $fleetRow)
			{
				if (empty($fleetRow)) continue;
				$temp        = explode (",", $fleetRow);			
				$HTML2 .= "<div class=\"element_item\"><img src=\"/styles/theme/gow/gebaeude/".$temp[0].".gif\">".$LNG['tech'][$temp[0]]." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
				$TransportDevLog[] = $temp[0].",".$temp[1];
				$TotalTransported += $temp[1];
			}
		
			$ToGoMessage = sprintf($LNG['NOUVEAUTE_737'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $HTML, $HTML2, $HTML1);			
			SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 7, sprintf($LNG['sys_mess_tower_transport_bis'], $this->getUsername($targetUser['id'])), sprintf($LNG['NOUVEAUTE_736'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']), $ToGoMessage); 
		}elseif($this->_fleet['fleet_owner'] != $this->_fleet['fleet_target_owner']){
			
			$StrongestPlayer = $senderUser['username'];
			if($targetRank['total_points'] > $userRank['total_points'])
				$StrongestPlayer = $targetUser['username'];
			
			foreach($ResourceArray as $resId){
				if($this->_fleet['fleet_resource_'.$resource[$resId]] > 0){
					$HTML .= " <div class=\"element_item\"><img src=\"/media/ingame/image/".$resource[$resId].".jpg\">".$LNG['tech'][$resId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_resource_'.$resource[$resId]])."</span> unités</div>";
					$TotalTransported += $this->_fleet['fleet_resource_'.$resource[$resId]];
				}
			}
			
			foreach($PopulatiArray as $popId){
				$Var = 0;
				if($popId == 302)
					$Var = $technicienT;
				elseif($popId == 303)
					$Var = $scientifiqueT;
				elseif($popId == 306)
					$Var = $soldatT;
				elseif($popId == 308)
					$Var = $piloteT;
					
				if(($this->_fleet['fleet_population_'.$popId] - $Var) > 0){
					$HTML1 .= " <div class=\"element_item\"><img src=\"/media/ingame/population/".$popId.".jpg\">".$LNG['tech'][$popId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_population_'.$popId])."</span> unités</div>";
					$TotalTransported += $this->_fleet['fleet_population_'.$popId];
				}
			}
			
			foreach ($fleetData2 as $fleetRow)
			{
				if (empty($fleetRow)) continue;
				$temp        = explode (",", $fleetRow);			
				$HTML2 .= "<div class=\"element_item\"><img src=\"/styles/theme/gow/gebaeude/".$temp[0].".gif\">".$LNG['tech'][$temp[0]]." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
				$TotalTransported += $temp[1];
			}
			
			$ToGoMessage = sprintf($LNG['NOUVEAUTE_740'], $senderUser['username'], $userAlliance, $targetUser['username'], $ennemAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $HTML, $HTML2, $HTML1, $StrongestPlayer);					
			SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_target_owner'], TIMESTAMP, 7, sprintf($LNG['sys_mess_tower_transport_bis'], $this->getUsername($targetUser['id'])), sprintf($LNG['NOUVEAUTE_736'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']), $ToGoMessage); 
			
			$LNG		   = new Language($targetUser['lang']);
			$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
			
			foreach($ResourceArray as $resId){
				if($this->_fleet['fleet_resource_'.$resource[$resId]] > 0){
					$HTML .= " <div class=\"element_item\"><img src=\"/media/ingame/image/".$resource[$resId].".jpg\">".$LNG['tech'][$resId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_resource_'.$resource[$resId]])."</span> unités</div>";
					$TransportResLog[] = $resId.",".$this->_fleet['fleet_resource_'.$resource[$resId]];
				}
			}
			
			
			foreach($PopulatiArray as $popId){
				$Var = 0;
				if($popId == 302)
					$Var = $technicienT;
				elseif($popId == 303)
					$Var = $scientifiqueT;
				elseif($popId == 306)
					$Var = $soldatT;
				elseif($popId == 308)
					$Var = $piloteT;
				
				
				if(($this->_fleet['fleet_population_'.$popId] - $Var) > 0){
					$HTML1 .= " <div class=\"element_item\"><img src=\"/media/ingame/population/".$popId.".jpg\">".$LNG['tech'][$popId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_population_'.$popId])."</span> unités</div>";
					$TransportPopLog[] = $popId.",".$this->_fleet['fleet_population_'.$popId];
				}
			}
			
			foreach ($fleetData2 as $fleetRow)
			{
				if (empty($fleetRow)) continue;
				$temp        = explode (",", $fleetRow);			
				$HTML2 .= "<div class=\"element_item\"><img src=\"/styles/theme/gow/gebaeude/".$temp[0].".gif\">".$LNG['tech'][$temp[0]]." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
				$TransportDevLog[] = $temp[0].",".$temp[1];
			}
		
			$ToGoMessage = sprintf($LNG['NOUVEAUTE_740'], $senderUser['username'], $userAlliance, $targetUser['username'], $ennemAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $HTML, $HTML2, $HTML1, $StrongestPlayer);		
			SendSimpleMessage($this->_fleet['fleet_target_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 7, sprintf($LNG['sys_mess_tower_transport_bis'], $senderUser['username']), sprintf($LNG['NOUVEAUTE_736'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']), $ToGoMessage); 
			
			$StrongestPlayerId = $userRank['total_points'] > $targetRank['total_points'] ? $this->_fleet['fleet_owner'] : $this->_fleet['fleet_target_owner'];
			$legal = 0;
			if($StrongestPlayerId != $this->_fleet['fleet_owner'])
				$legal = 1;
			if($TotalTransported == 0)
				$legal = 0;
					
			$transportRes 		= !empty($TransportResLog) ? ", transportRes = '".implode(';', $TransportResLog)."'" : '';
			$transportPop 		= !empty($TransportPopLog) ? ", transportPop = '".implode(';', $TransportPopLog)."'" : '';
			$transportDevice	= !empty($TransportDevLog) ? ", transportDevice = '".implode(';', $TransportDevLog)."'" : '';
			
			$GLOBALS['DATABASE']->query("INSERT INTO ".TRANSORTLOG." SET senderID = ".$this->_fleet['fleet_owner'].", receiverID = ".$this->_fleet['fleet_target_owner'].", time = ".TIMESTAMP.", strongest = ".$StrongestPlayerId."".$transportRes."".$transportPop."".$transportDevice.", push = 0, legal = ".$legal.";");	
		}

		$this->TransportGoodsToPlanet();
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
		
		
		$ReturnMessage = sprintf($LNG['NOUVEAUTE_735'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemAlliance, $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML1, $HTML, $HTML2, $HTML3);
		
		SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_target_owner'], TIMESTAMP, 5, $LNG['sys_mess_tower_transport'], sprintf($LNG['NOUVEAUTE_714'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']), $ReturnMessage); 
		
		$this->RestoreFleet();
	}
}