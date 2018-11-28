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
 * @info $Id: MissionCaseRecycling.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */

class MissionCaseRecycling extends MissionFunctions
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{	
		global $pricelist, $reslist, $resource;
		
		$resourceIDs	= array(901, 902, 903, 904, 921);
		$debrisIDs		= array(901, 902, 903, 904);
		$resQuery		= array();
		$collectQuery	= array();
		
		$collectedGoods = array();
		foreach($debrisIDs as $debrisID)
		{
			$collectedGoods[$debrisID] = 0;
			$resQuery[]	= 'der_'.$resource[$debrisID];
		}
		
		$TotalRes = 0;
		$targetData	= $GLOBALS['DATABASE']->getFirstRow("SELECT ".implode(',', $resQuery).", (".implode(' + ', $resQuery).") as total FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		if(!empty($targetData['total']))
		{
			$targetUser			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
			$targetUserFactors	= getFactors($targetUser);
			$shipStorageFactor	= 1 + $targetUserFactors['ShipStorage'];
			$TotalRes = $targetData['total'];
			// Get fleet capacity
			$fleetData	= explode(";", $this->_fleet['fleet_array']);

			$recyclerStorage	= 0;
			
			foreach ($fleetData as $fleetRow)
			{
				if (empty($fleetRow)) continue;
					
				$temp        = explode (",", $fleetRow);

				if ($temp[0] == 209 || $temp[0] == 219 || $temp[0] == 223)
					$recyclerStorage   += $pricelist[$temp[0]]['capacity'] * $temp[1];
			}
						
			unset($temp);
			
			$totalStorage = $recyclerStorage;

			// fast way
			$collectFactor	= min(1, $totalStorage / $targetData['total']);
			foreach($debrisIDs as $debrisID)
			{
				$collectedGoods[$debrisID]	= ceil($targetData['der_'.$resource[$debrisID]] * $collectFactor);
				$collectQuery[]				= 'der_'.$resource[$debrisID].' = GREATEST(0, der_'.$resource[$debrisID].' - '.$collectedGoods[$debrisID].')';
				$this->UpdateFleet('fleet_resource_'.$resource[$debrisID], $this->_fleet['fleet_resource_'.$resource[$debrisID]] + $collectedGoods[$debrisID]);
			}
			
			$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".implode(',', $collectQuery)." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		}
		
		$senderPlanet	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_start_id'].";");
		$targetPlanet	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		$senderUser		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
		$targetUser		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = ".$this->_fleet['fleet_target_owner'].";");
		$LNG			= $this->getLanguage($senderUser['lang']);
		$StartOwner		= $this->_fleet['fleet_owner'];
		$planetNameInfo = empty($targetPlanet) ? $LNG['NOUVEAUTE_717'] : $targetPlanet['name'];
		$userAlliance   = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
		$ennemAlliance  = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
		$MessageSend	= "";
		if(empty($targetPlanet) && ($collectedGoods[901] + $collectedGoods[902] + $collectedGoods[903] + $collectedGoods[904]) == 0){
			$MessageSend	= sprintf($LNG['NOUVEAUTE_718'], $LNG['NOUVEAUTE_717'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']);
		}elseif(empty($targetPlanet) && ($collectedGoods[901] + $collectedGoods[902] + $collectedGoods[903] + $collectedGoods[904]) > 0){
			$MessageSend	= sprintf($LNG['NOUVEAUTE_718'], $LNG['NOUVEAUTE_717'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']);
		}elseif(!empty($targetPlanet) && ($collectedGoods[901] + $collectedGoods[902] + $collectedGoods[903] + $collectedGoods[904]) == 0){
			$MessageSend	= sprintf($LNG['NOUVEAUTE_719'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']);
		}elseif(!empty($targetPlanet) && ($collectedGoods[901] + $collectedGoods[902] + $collectedGoods[903] + $collectedGoods[904]) > 0){
			
			$HTML = "";
			foreach($debrisIDs as $debrisID)
			{
				if($collectedGoods[$debrisID] > 0){
					$HTML .= sprintf($LNG['NOUVEAUTE_724'], $resource[$debrisID], $LNG['tech'][$debrisID], pretty_number($collectedGoods[$debrisID]));
				}
			}
			
			$TotalRec = ($collectedGoods[901] + $collectedGoods[902] + $collectedGoods[903] + $collectedGoods[904]);
			$TotalPer = round((100/$TotalRes*$TotalRec), 2);
			$stateMessage = ($targetPlanet['der_metal'] + $targetPlanet['der_crystal'] + $targetPlanet['der_deuterium'] + $targetPlanet['der_elyrium']) == 0 ? $LNG['NOUVEAUTE_726'] : sprintf($LNG['NOUVEAUTE_725'], $TotalPer, '%');
			$MessageSend	= sprintf($LNG['NOUVEAUTE_723'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemAlliance, pretty_number($targetData['der_metal']), pretty_number($targetData['der_crystal']), pretty_number($targetData['der_deuterium']), pretty_number($targetData['der_elyrium']), $stateMessage, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML);
		}
		SendSimpleMessage($this->_fleet['fleet_owner'], 0, TIMESTAMP, 7, $LNG['NOUVEAUTE_715'], sprintf($LNG['NOUVEAUTE_716'], $planetNameInfo, $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet']), $MessageSend);
		

	
	
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
		
		$LNG		   = new Language($senderUser['lang']);
		$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
		$Var 		   = "<span class=\"vert\">".$LNG['ls_answer_1']."</span>";
		if($this->_fleet['hasCanceled'] != 0)
			$Var = "<span class=\"rouge\">".$LNG['ls_answer_2']."</span>";
		
		$Date		   = date("d F Y à H:i", TIMESTAMP);
		
		$AddToMessage 	= "";
		
		if(empty($targetPlanet)){
			$ReturnMessage = sprintf($LNG['NOUVEAUTE_721'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $LNG['NOUVEAUTE_717'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'], $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']);
		}else{
			$HTML  = "";
			$HTML1 = "";
			$ResourceArray = array(901,902,903,904);
			foreach($ResourceArray as $resId){
				$HTML .= " <div class=\"element_item\">
                        <img src=\"/media/ingame/image/".$resource[$resId].".jpg\">
                        ".$LNG['tech'][$resId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_resource_'.$resource[$resId]])."</span> unités
                    </div>";
				
			}
			
			$fleetData	= explode(";", $this->_fleet['fleet_array']);
			
			foreach ($fleetData as $fleetRow)
			{
				if (empty($fleetRow)) continue;
					
				$temp        = explode (",", $fleetRow);
				$HTML1 .= "<div class=\"element_item\">
                        <img src=\"/styles/theme/gow/gebaeude/".$temp[0].".gif\">
                        ".$LNG['tech'][$temp[0]]." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités
                    </div>";

			}
					
			$ReturnMessage = sprintf($LNG['NOUVEAUTE_722'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemAlliance, $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML, $HTML1);
		}
		SendSimpleMessage($this->_fleet['fleet_owner'], 0, TIMESTAMP, 5, $LNG['NOUVEAUTE_720'], sprintf($LNG['NOUVEAUTE_714'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']), $ReturnMessage); 
		$this->RestoreFleet();
	}
}