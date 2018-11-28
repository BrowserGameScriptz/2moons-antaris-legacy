<?php
class MissionCaseStayVR extends MissionFunctions
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	function TargetEvent()
	{	
		global $resource;
		$senderUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT lang, ally_id, id, username, impulse_motor_tech, hyperspace_motor_tech FROM ".USERS." WHERE id = ".$this->_fleet['fleet_owner'].";");
		$targetUser	   = $GLOBALS['DATABASE']->getFirstRow("SELECT ally_id, id, username, lang FROM ".USERS." WHERE id = ".$this->_fleet['fleet_target_owner'].";");
		$senderPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_start_id'].";");
		$targetPlanet  = $GLOBALS['DATABASE']->getFirstRow("SELECT galaxy, system, planet, name, id_owner FROM ".PLANETS." WHERE id = ".$this->_fleet['fleet_end_id'].";");
		$userAlliance  = $senderUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($senderUser['ally_id'])."]</span>";
		$ennemAlliance = $targetUser['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetUser['ally_id'])."]</span>";
		$userRank	   = $GLOBALS['DATABASE']->getFirstRow("SELECT total_points FROM ".STATPOINTS." WHERE `id_owner` = '".$this->_fleet['fleet_owner']."';");
		$targetRank	   = $GLOBALS['DATABASE']->getFirstRow("SELECT total_points FROM ".STATPOINTS." WHERE `id_owner` = '".$this->_fleet['fleet_target_owner']."';");
		$fleetData	   = explode(";", $this->_fleet['fleet_array']);
		$fleetData2	   = explode(";", $this->_fleet['specialized_array']);
		$ResourceArray = array(901,902,903,904);
		$PopulatiArray = array(301,302,303,304,305,306,307,308,309);
		$TransportResLog	=	array();
		$TransportDevLog	=	array();
		$LNG		   = new Language($senderUser['lang']);
		$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
		$Var 		   = "<span class=\"vert\">".$LNG['ls_answer_1']."</span>";
		if($this->_fleet['hasCanceled'] != 0)
			$Var = "<span class=\"rouge\">".$LNG['ls_answer_2']."</span>";
		$Date		   = date("d F Y à H:i", TIMESTAMP);
		$HTML			= "";
		$HTML1			= "";
		$fleetArray			= fleetAmountToArray($this->_fleet['fleet_array']);
		$duration			= $this->_fleet['fleet_start_time'] - $this->_fleet['start_time'];		
		require_once('includes/classes/class.FleetFunctions.php');
		$fleetMaxSpeed 		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $senderUser);
		$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
		$distance			= FleetFunctions::GetTargetDistance(array($this->_fleet['fleet_start_galaxy'], $this->_fleet['fleet_start_system'], $this->_fleet['fleet_start_planet']), array($this->_fleet['fleet_end_galaxy'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet']));		$consumption   		= FleetFunctions::GetFleetConsumption($fleetArray, $duration, $distance, $fleetMaxSpeed, $senderUser, $SpeedFactor);		//$this->UpdateFleet('fleet_resource_elyrium', $this->_fleet['fleet_resource_elyrium'] + $consumption / 2);
		foreach($ResourceArray as $resId){
			if($this->_fleet['fleet_resource_'.$resource[$resId]] > 0){
				$HTML .= " <div class=\"element_item\"><img src=\"/media/ingame/image/".$resource[$resId].".jpg\">".$LNG['tech'][$resId]." : <span class=\"orange\">".pretty_number($this->_fleet['fleet_resource_'.$resource[$resId]])."</span> unités</div>";
				$TransportResLog[] = $resId.",".$this->_fleet['fleet_resource_'.$resource[$resId]];
			}
		}
		foreach ($fleetData as $fleetRow)
		{
			if (empty($fleetRow)) continue;
			$temp        = explode (",", $fleetRow);			
			$HTML1 .= "<div class=\"element_item\"><img src=\"/styles/theme/gow/gebaeude/".$temp[0].".gif\">".$LNG['tech'][$temp[0]]." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
			$TransportDevLog[] = $temp[0].",".$temp[1];
		}
		if($this->_fleet['fleet_owner'] == $this->_fleet['fleet_target_owner']){
			$ToGoMessage = sprintf($LNG['NOUVEAUTE_749'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML1);		
			SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_target_owner'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_747'], $targetUser['username']), sprintf($LNG['NOUVEAUTE_748'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']), $ToGoMessage); 
		}elseif($this->_fleet['fleet_owner'] != $this->_fleet['fleet_target_owner']){
			$StrongestPlayer = $senderUser['username'];
			if($targetRank['total_points'] > $userRank['total_points'])
				$StrongestPlayer = $targetUser['username'];
			$ToGoMessage = sprintf($LNG['NOUVEAUTE_751'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $senderUser['username'], $userAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML1, $StrongestPlayer);		
			SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_target_owner'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_747'], $targetUser['username']), sprintf($LNG['NOUVEAUTE_748'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']), $ToGoMessage);
			$LNG		   = new Language($targetUser['lang']);
			$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));		
			$ToGoMessage = sprintf($LNG['NOUVEAUTE_751'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $targetUser['username'], $ennemAlliance, $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $senderUser['username'], $userAlliance, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML1, $StrongestPlayer);		
			SendSimpleMessage($this->_fleet['fleet_target_owner'], $this->_fleet['fleet_owner'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_752'], $senderUser['username']), sprintf($LNG['NOUVEAUTE_748'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet']), $ToGoMessage);
			$StrongestPlayerId = $userRank['total_points'] > $targetRank['total_points'] ? $this->_fleet['fleet_owner'] : $this->_fleet['fleet_target_owner'];
			$legal = 0;
			if($StrongestPlayerId != $this->_fleet['fleet_owner'])
				$legal = 1;
			$transportRes 		= !empty($TransportResLog) ? ", transportRes = '".implode(';', $TransportResLog)."'" : '';
			$transportDevice	= !empty($TransportDevLog) ? ", transportDevice = '".implode(';', $TransportDevLog)."'" : '';
			$GLOBALS['DATABASE']->query("INSERT INTO ".TRANSORTLOG." SET senderID = ".$this->_fleet['fleet_owner'].", receiverID = ".$this->_fleet['fleet_target_owner'].", time = ".TIMESTAMP.", strongest = ".$StrongestPlayerId."".$transportRes."".$transportDevice.", push = 0, legal = ".$legal.";");	
		}
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
			$HTML1 .= "<div class=\"element_item\"><img src=\"/styles/theme/gow/gebaeude/".$temp[0].".gif\">".$LNG['tech'][$temp[0]]." : <span class=\"orange\">".pretty_number($temp[1])."</span> unités</div>";
		}
		$ReturnMessage = sprintf($LNG['NOUVEAUTE_746'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $targetPlanet['name'], $targetPlanet['system'], $targetPlanet['planet'], $this->getUsername($targetUser['id']), $ennemAlliance, $Var, $Date, $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet'], $HTML, $HTML1);
		SendSimpleMessage($this->_fleet['fleet_owner'], $this->_fleet['fleet_target_owner'], TIMESTAMP, 5, $LNG['NOUVEAUTE_745'], sprintf($LNG['NOUVEAUTE_714'], $senderPlanet['name'], $senderPlanet['system'], $senderPlanet['planet']), $ReturnMessage); 
		$this->RestoreFleet();
	}
}