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
 * @info $Id: class.ShowFleetAjaxPage.php 2640 2013-03-23 19:23:26Z slaver7 $
 * @link http://2moons.cc/
 */

require_once('includes/classes/class.FleetFunctions.php');


class ShowFleetAjaxPage extends AbstractPage
{
	public $returnData	= array();

    public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		$this->setWindow('ajax');
	}
	
	private function sendData($Code, $Message) {
		$this->returnData['code']	= $Code;
		$this->returnData['mess']	= $Message;
		$this->sendJSON($this->returnData);
	}
	
	public function show()
	{
		global $USER, $PLANET, $resource, $LNG, $CONF, $pricelist;
		
		$UserDeuterium  = $PLANET['elyrium'];
		
		$planetID 		= HTTP::_GP('planetID', 0);
		$targetMission	= HTTP::_GP('mission', 0);
		$select	= HTTP::_GP('select', 0);
		
		$activeSlots	= FleetFunctions::GetCurrentFleets($USER['id']);
		$maxSlots		= FleetFunctions::GetMaxFleetSlots($USER);
		
		$this->returnData['slots']		= $activeSlots;
		
		if (IsVacationMode($USER)) {
			$this->sendData('rouge', $LNG['fa_vacation_mode_current']);
		}
		
		if (empty($planetID)) {
			$this->sendData('rouge', $LNG['fa_planet_not_exist']);
		}
		
		if ($maxSlots <= $activeSlots) {
			$this->sendData('rouge', $LNG['fa_no_more_slots']);
		}

		$fleetArray = array();

		switch($targetMission)
		{
			
			case 1:
				if(!isModulAvalible(MODULE_MISSION_ATTACK)) {
					$this->sendData('rouge', $LNG['sys_module_inactive']);
				}
				
				$GetuserComp = $GLOBALS['DATABASE']->query("SELECT * FROM `uni1_fleets_manage` WHERE userID = ".$USER['id']." AND manageID = ".$select.";");
				$num_rows = $GLOBALS['DATABASE']->numRows($GetuserComp);
				if($num_rows == 0){
				$this->sendData('rouge', 'You need to create a fleet shortcut first');
				}else{
				while($xb = $GLOBALS['DATABASE']->fetch_array($GetuserComp)){
				$ship202 = min($xb['ship202'], $PLANET[$resource[202]]);
				$ship203 = min($xb['ship203'], $PLANET[$resource[203]]);
				$ship204 = min($xb['ship204'], $PLANET[$resource[204]]);
				$ship205 = min($xb['ship205'], $PLANET[$resource[205]]);
				$ship206 = min($xb['ship206'], $PLANET[$resource[206]]);
				$ship207 = min($xb['ship207'], $PLANET[$resource[207]]);
				$ship211 = min($xb['ship211'], $PLANET[$resource[211]]);
				$ship214 = min($xb['ship214'], $PLANET[$resource[214]]);
				$ship215 = min($xb['ship215'], $PLANET[$resource[215]]);
				$ship216 = min($xb['ship216'], $PLANET[$resource[216]]);
				
			
				if(empty($ship202) && $xb['ship202'] > 0 ) {
				$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}elseif(empty($ship203) && $xb['ship203'] > 0) {
					$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}elseif(empty($ship204) && $xb['ship204'] > 0) {
					$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}elseif(empty($ship205) && $xb['ship205'] > 0) {
					$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}elseif(empty($ship206) && $xb['ship206'] > 0) {
					$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}elseif(empty($ship207) && $xb['ship207'] > 0) {
					$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}elseif(empty($ship211) && $xb['ship211'] > 0 ) {
					$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}elseif(empty($ship214) && $xb['ship214'] > 0 ) {
					$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}elseif(empty($ship215) && $xb['ship215'] > 0 ) {
					$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}elseif(empty($ship216) && $xb['ship216'] > 0 ) {
					$this->sendData(611, sprintf($LNG['fleet_ajax_15'], $LNG['tech'][202]));
				}
				$fleetArray = array(202 => $ship202, 203 => $ship203, 204 => $ship204, 205 => $ship205, 206 => $ship206, 207 => $ship207, 211 => $ship211, 214 => $ship214, 215 => $ship215, 216 => $ship216);
				
				$this->returnData['ships'][202]	= $PLANET[$resource[202]] - $ship202;
				$this->returnData['ships'][203]	= $PLANET[$resource[203]] - $ship203;
				$this->returnData['ships'][204]	= $PLANET[$resource[204]] - $ship204;
				$this->returnData['ships'][205]	= $PLANET[$resource[205]] - $ship205;
				$this->returnData['ships'][206]	= $PLANET[$resource[206]] - $ship206;
				$this->returnData['ships'][207]	= $PLANET[$resource[207]] - $ship207;
				$this->returnData['ships'][211]	= $PLANET[$resource[211]] - $ship211;
				$this->returnData['ships'][214]	= $PLANET[$resource[214]] - $ship214;
				$this->returnData['ships'][215]	= $PLANET[$resource[215]] - $ship215;
				$this->returnData['ships'][216]	= $PLANET[$resource[216]] - $ship216;
				
				}
				}				
				
				
				
				
			break;
			
			case 6:
				if(!isModulAvalible(MODULE_MISSION_SPY)) {
					$this->sendData('rouge', $LNG['sys_module_inactive']);
				}
				
				$ships	= min($USER['spio_anz'], $PLANET[$resource[224]]);
				
				if(empty($ships)) {
					$this->sendData('rouge', $LNG['fleet_ajax_2']);
				}
				
				$fleetArray = array(224 => $ships);
				$this->returnData['ships'][224]	= $PLANET[$resource[224]] - $ships;
			break;
			
			
			case 8:
				if(!isModulAvalible(MODULE_MISSION_RECYCLE)) {
					$this->sendData('rouge', $LNG['sys_module_inactive']);
				}
				
				$totalDebris	= $GLOBALS['DATABASE']->getFirstCell("SELECT der_metal + der_crystal + der_deuterium FROM ".PLANETS." WHERE id = ".$planetID.";");
				$usedDebris		= 0;
				
				$recElementIDs	= array(219, 209, 223);
				
				$fleetArray		= array();
				
				foreach($recElementIDs as $elementID)
				{
					$shipsNeed 		= min(ceil($totalDebris / $pricelist[$elementID]['capacity']), $PLANET[$resource[$elementID]]);
					$totalDebris	-= ($shipsNeed * $pricelist[$elementID]['capacity']);
					
					$fleetArray[$elementID]	= $shipsNeed;
					$this->returnData['ships'][$elementID]	= $PLANET[$resource[$elementID]] - $shipsNeed;
					
					if($totalDebris <= 0)
					{
						break;
					}
				}
				
				if(empty($fleetArray))
				{
					$this->sendData('rouge', $LNG['fleet_ajax_1']);
				}
				if($PLANET[$resource[219]] == 0 && $PLANET[$resource[209]] == 0 && $PLANET[$resource[223]] == 0)
				{
					$this->sendData('rouge', $LNG['fleet_ajax_1']);
				}
				break;
			default:
				$this->sendData('rouge', $LNG['fleet_ajax_2']);
			break;
		}
		
		$fleetArray						= array_filter($fleetArray);
		
		if(empty($fleetArray)) {
			$this->sendData('rouge', $LNG['fleet_ajax_2']);
		}
		
		$targetData	= $GLOBALS['DATABASE']->getFirstRow("SELECT planet.id_owner as id_owner, 
										planet.name as name, 
										planet.galaxy as galaxy, 
										planet.system as system, 
										planet.planet as planet,
										planet.planet_type as planet_type, 
										total_points, onlinetime, urlaubs_modus, banaday, authattack, user_deleted, username
										FROM ".PLANETS." planet
										INNER JOIN ".USERS." user ON planet.id_owner = user.id
										LEFT JOIN ".STATPOINTS." as stat ON stat.id_owner = user.id AND stat.stat_type = '1' 
										WHERE planet.id = ".$planetID.";");
		$BuddyCheck = $GLOBALS['DATABASE']->query("SELECT * FROM uni1_buddy WHERE (sender = '".$USER['id']."' AND owner = '".$targetData['id_owner']."' AND state = '1') OR (owner = '".$USER['id']."' AND sender = '".$targetData['id_owner']."' AND state = '1');");								
		if (empty($targetData)) {
			$this->sendData('rouge', $LNG['fa_planet_not_exist']);
		}
		if ($targetMission == 1 || $targetMission == 6 || $targetMission == 3 || $targetMission == 14 || $targetMission == 13)
		{
		$ipCheck = $GLOBALS['DATABASE']->query("SELECT userID, secondID FROM uni1_ipblock WHERE userID = ".$USER['id']." OR secondID = '".$USER['id']."';");
		if($GLOBALS['DATABASE']->numRows($ipCheck) > 0){
		while($xb = $GLOBALS['DATABASE']->fetch_array($ipCheck)){
		if ($targetData['id_owner'] == $xb['userID'] || $targetData['id_owner'] == $xb['secondID']) {
				$this->sendData('rouge', '<span class=rouge>'.sprintf($LNG['fleet_multi_block'], $this->getUsername($targetData['id_owner'])).'</span>');	
			}
		}
		}
		if($GLOBALS['DATABASE']->numRows($BuddyCheck) >= 1){
			$this->sendData('rouge', sprintf($LNG['fleet_pact'], $this->getUsername($targetData['id_owner'])));
			} 
		}
		if($targetMission == 6 || $targetMission == 1)
		{ 
	if($targetMission == 1){
			if(FleetFunctions::CheckBash($targetData['id_owner'])) {
				$this->sendData('rouge', $LNG['fl_bash_protection']);	
			}
	}
			
			
			if($targetData['user_deleted'] == 1){
			$this->sendData('rouge', sprintf($LNG['fleet_ajax_3'], $targetData['username']));	
			}
			
			 
			
			if($targetData['banaday'] > TIMESTAMP){
			$this->sendData('rouge', sprintf($LNG['fleet_ajax_4'], $targetData['username']));	
			}
			
			if(Config::get('adm_attack') == 1 && $targetData['authattack'] > $USER['authlevel']) {
				$this->sendData('rouge', $LNG['fa_action_not_allowed']);
			}
			
			if (IsVacationMode($targetData)) {
				$this->sendData('rouge', sprintf($LNG['fleet_ajax_5'], $targetData['username']));
			}
			
			$IsNoobProtec	= CheckNoobProtec($USER, $targetData, $targetData);
			
			if ($IsNoobProtec['NoobPlayer']) {
				$this->sendData('rouge', sprintf($LNG['fleet_ajax_6'], $targetData['username']));
			}
			
			if ($IsNoobProtec['StrongPlayer']) {
				$this->sendData('rouge', sprintf($LNG['fleet_ajax_7'], $targetData['username']));
			}

			if ($USER['id'] == $targetData['id_owner']) {
				$this->sendData('rouge', $LNG['fleet_ajax_8']);
			}
		}
		
	
		
		$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
		
		$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array($targetData['galaxy'], $targetData['system'], $targetData['planet']));
		
		$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
		$Duration			= FleetFunctions::GetMissionDuration(10, $SpeedAllMin, $Distance, $SpeedFactor, $USER);
		$consumption		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration, $Distance, $SpeedAllMin, $USER, $SpeedFactor);

		$UserDeuterium   	-= $consumption;

		if($UserDeuterium < 0) {
			$this->sendData('rouge', $LNG['fa_not_enough_fuel']);
		}
		
		if($consumption > FleetFunctions::GetFleetRoom($fleetArray)) {
			$this->sendData('rouge', $LNG['fa_no_fleetroom']);
		}
		
		if(connection_aborted())
			exit;
			
		$this->returnData['slots']++;
		
		$fleetRessource	= array(
			901	=> 0,
			902	=> 0,
			903	=> 0,
			904	=> 0,
		);
		$fleetPopulation	= array(
			301	=> 0,
			302	=> 0,
			303	=> 0,
			304	=> 0,
			305	=> 0,
			306	=> 0,
			307	=> 0,
			309	=> 0,
		);
		$fleetStartTime		= $Duration + TIMESTAMP;
		$fleetStayTime		= $fleetStartTime;
		$fleetEndTime		= $fleetStayTime + $Duration;
		
		$shipID				= array_keys($fleetArray);
		
		
		FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'],
		$targetData['id_owner'], $planetID, $targetData['galaxy'], $targetData['system'], $targetData['planet'], $targetData['planet_type'], $fleetRessource, $fleetPopulation, $fleetStartTime, $fleetStayTime, $fleetEndTime);
				
		if($targetMission == 6){
		$finalMsg = sprintf($LNG['fleet_ajax_9'], $targetData['name'],$targetData['galaxy'],$targetData['system'],$targetData['planet']);
		}else{
		$finalMsg = sprintf($LNG['fleet_ajax_16'], array_sum($fleetArray),$targetData['name'],$targetData['system'],$targetData['planet'], $LNG['type_missionbis'][$targetMission]);
		}
		$this->sendData('vert', $finalMsg);
		
		}
	}