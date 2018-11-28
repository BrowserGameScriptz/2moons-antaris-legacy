<?php

define('MODE', 'INGAME');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';
require 'includes/classes/class.FleetFunctions.php';

function getUsername($ID) {
	$username = '';
	$stats_sql	=	'SELECT username FROM '.USERS.' WHERE `id` = '.$ID.';';
	$query = $GLOBALS['DATABASE']->query($stats_sql);
	while ($StatRow = $GLOBALS['DATABASE']->fetch_array($query))
	{
		$username = $StatRow['username'];
	}
	return $username;
}

function BCWrapperPreRev2321($CombatRaport)
{
	
	if(isset($CombatRaport['simu']))
	{
		$CombatRaport['additionalInfo'] = $CombatRaport['simu'];
	}
		
	if (!empty($CombatRaport['steal']['metal']))
	{
		$CombatRaport['steal'] = array(
			901	=> $CombatRaport['steal']['metal'],
			902	=> $CombatRaport['steal']['crystal'],
			903	=> $CombatRaport['steal']['deuterium'],
			904	=> $CombatRaport['steal']['elyrium']
		);
	}
		
	return $CombatRaport;
}
	
function getAllianceTag($allianceID)
{
	$diploAlly	= $GLOBALS['DATABASE']->query("SELECT ally_tag FROM ".ALLIANCE." WHERE id = ".$allianceID.";");
	$diploRow = $GLOBALS['DATABASE']->fetch_array($diploAlly);
	$diploRow = $diploRow['ally_tag'];
	return $diploRow;
}

function GenerateName() 
{
	global $LNG, $PLANET;
	$Names		= file('botnames.txt');
	$NamesCount	= count($Names);
	$Rand		= mt_rand(0, 16500);
	$UserName 	= trim($Names[$Rand]);
	return $UserName;
}

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'mFzSfd8q';
    $secret_iv = '2QhdrkjV';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

// @coloniser_portail
// @recycler
// @attaquer_portail
// @attaquer_flotte
// @espionner_portail
// @espionner_flotte
$action_encrypter	 		= HTTP::_GP('action_encrypter', '', UTF8_SUPPORT);
$MissionArray				= encrypt_decrypt("decrypt",$action_encrypter);
$temp 						= explode('-', $MissionArray);
$specialized				= array();
$Mission					= $temp[0];
$Systeme					= $temp[1];
$Position					= $temp[2];

if (IsVacationMode($USER)) {
	echo "<span class='rouge'>Vous ne pouvez pas effectué cette action lorsque vous etes en mode vacances</span>";
	return false;
}
$fleetArray = array();

if($Mission == "coloniser_portail"){
	
	$TargetSystem 			= $Systeme;
	$TargetPlanet			= $Position;
	$iPlanetCount 			= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `id_owner` = '".$USER['id']."' AND `planet_type` = '1' AND `destruyed` = '0';");
	$iGalaxyPlace 			= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `system` = ".$TargetSystem." AND `planet` = ".$TargetPlanet.";");
	$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.lang, u.ally_id, p.name, p.system, p.planet, u.urlaubs_modus, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
	$MaxPlanets		= PlayerUtil::maxPlanetCount($USER);
	if(!empty($Opponent)){
		echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_562'], $TargetSystem, $TargetPlanet)."</span>";
	}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
	}elseif($PLANET['teleport_portal'] == 0){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_561']."</span>";
	}elseif($iPlanetCount >= $MaxPlanets){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_567']."</span>";
	}elseif($PLANET[$resource[303]] < 10 || $PLANET[$resource[306]] < 100){
		echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_565'], pretty_number($PLANET[$resource[303]]), pretty_number($PLANET[$resource[306]]))."</span>";
	}else{			
		if ($iGalaxyPlace != 0 || $iPlanetCount >= 10){
			$TheMessage = sprintf($LNG['NOUVEAUTE_727'], $TargetSystem, $TargetPlanet, "jaune", $LNG['type_missionbis'][7]);
			SendSimpleMessage($USER['id'], $USER['id'], TIMESTAMP, 7, $LNG['sys_colo_mess_from_text1'], sprintf($LNG['sys_colo_mess_report1'], $TargetSystem, $TargetPlanet), $TheMessage);
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
			$generatename = GenerateName();
			$NewOwnerPlanet = CreateOnePlanetRecord(1, $TargetSystem, $TargetPlanet, 1, $USER['id'], $generatename, false, $USER['authlevel'], $bonus_iron , $bonus_gold, $bonus_crys, $bonus_elyr, $iPlanetCount);
			if($NewOwnerPlanet === false){
				$TheMessage = sprintf($LNG['NOUVEAUTE_727'], $TargetSystem, $TargetPlanet, "jaune", $LNG['type_missionbis'][7]);
				SendSimpleMessage($USER['id'], $USER['id'], TIMESTAMP, 7, $LNG['sys_colo_mess_from_text1'], sprintf($LNG['sys_colo_mess_report1'], $TargetSystem, $TargetPlanet), $TheMessage);
			}else{
				$PLANET[$resource[303]] -= 10;
				$PLANET[$resource[306]] -= 100;
				$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[303]." = ".$resource[303]." - 10, ".$resource[306]." = ".$resource[306]." - 100 WHERE id = ".$PLANET['id'].";");
				$TheMessage = sprintf($LNG['NOUVEAUTE_728'], $TargetSystem, $TargetPlanet, $generatename, $Color, $bonus_iron, "%", $Color1, $bonus_gold, "%", $Color2, $bonus_crys, "%", $Color3, $bonus_elyr, "%");
				SendSimpleMessage($USER['id'], $USER['id'], TIMESTAMP, 7, $LNG['sys_colo_mess_from_text'], sprintf($LNG['sys_colo_mess_report2'], $TargetSystem, $TargetPlanet), $TheMessage);
			}
		}	
		echo "<span class='vert'>".sprintf($LNG['fleet_ajax_10'], $Systeme,$Position)."</span>";	
	}	
}elseif($Mission == "recycler"){
	
	$totalDebris	= $GLOBALS['DATABASE']->getFirstCell("SELECT der_metal + der_crystal + der_deuterium + der_elyrium FROM ".PLANETS." WHERE system = ".$Systeme." AND planet = ".$Position.";");
	$targetData	= $GLOBALS['DATABASE']->getFirstRow("SELECT name, id_owner, system, planet, id FROM ".PLANETS." WHERE system = ".$Systeme." AND planet = ".$Position." AND planet_type = 1;");	
	$usedDebris		= 0;
	
	$fleetArray		= array();
	$appareil_7	 	= HTTP::_GP('appareil_209', 0);	
	$appareil_8	 	= HTTP::_GP('appareil_223', 0);	
	$appareil_9	 	= HTTP::_GP('appareil_219', 0);

	$fleetArray		= array(209 => min($appareil_7, $PLANET[$resource[209]]), 223 => min($appareil_8, $PLANET[$resource[223]]), 219 => min($appareil_9, $PLANET[$resource[219]]));
	$fleetArray			= array_filter($fleetArray);
	
	if(empty($fleetArray)){
		echo "<span class='rouge'>".$LNG['fleet_ajax_1']."</span>"; //$LNG['fleet_ajax_2']
	}else{
	
	$UserDeuterium  	= $PLANET['elyrium'];
	$targetMission		= 8;
	$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
	$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $Systeme, $Position));
	$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
	$Duration			= FleetFunctions::GetMissionDuration(10, $SpeedAllMin, $Distance, $SpeedFactor, $USER);
	$consumption		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
			
	if(!isModulAvalible(MODULE_MISSION_RECYCLE)) {
		echo "<span class='rouge'>".$LNG['sys_module_inactive']."</span>";
	}elseif($PLANET[$resource[219]] == 0 && $PLANET[$resource[209]] == 0 && $PLANET[$resource[223]] == 0){
		echo "<span class='rouge'>".$LNG['fleet_ajax_1']."</span>"; //$LNG['fleet_ajax_2']
	}elseif($UserDeuterium - $consumption < 0) {
		echo "<span class='rouge'>".$LNG['fa_not_enough_fuel']."</span>";
	}elseif($consumption > FleetFunctions::GetFleetRoom($fleetArray)) {
		echo "<span class='rouge'>".$LNG['fa_no_fleetroom']."</span>";
	}else{
			$PLANET['elyrium']   	-= $consumption;
			$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".$consumption."' WHERE id = ".$PLANET['id']." ;");
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
				308	=> 0,
				309	=> 0,
			);
				
			$fleetStartTime		= $Duration + TIMESTAMP;
			$fleetStayTime		= $fleetStartTime;
			$fleetEndTime		= $fleetStayTime + $Duration;
							
			$shipID				= array_keys($fleetArray);
			
			$targetPlayerData	= array(
				'id'				=> 0,
				'id_owner'			=> 0,
			);
					
			if(empty($targetData))
				FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $targetPlayerData['id_owner'], $targetPlayerData['id'], 1, $Systeme, $Position, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
			else
				FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $targetData['id_owner'], $targetData['id'], 1, $Systeme, $Position, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
					
			echo "<span class='vert'>".sprintf($LNG['fleet_ajax_16'], array_sum($fleetArray),$targetData['name'],$targetData['system'],$targetData['planet'], $LNG['type_missionbis'][$targetMission])."</span>";
		}
	}
}elseif($Mission == "espionner_flotte"){
	$ships	= min($USER['spio_anz'], $PLANET[$resource[224]]);
	if(!isModulAvalible(MODULE_MISSION_SPY)) {
		echo "<span class='rouge'>".$LNG['sys_module_inactive']."</span>";
	}elseif(empty($ships)){
		echo "<span class='rouge'>".$LNG['fleet_ajax_2']."</span>";
	}else{
		$fleetArray = array(224 => $ships);
		//$this->returnData['ships'][224]	= $PLANET[$resource[224]] - $ships;
		$targetData	= $GLOBALS['DATABASE']->getFirstRow("SELECT planet.id_owner as id_owner, 
										planet.id as pid, 
										planet.name as name, 
										planet.galaxy as galaxy, 
										planet.system as system, 
										planet.planet as planet,
										planet.planet_type as planet_type, 
										total_points, onlinetime, urlaubs_modus, banaday, authattack, user_deleted, username, ally_id, lang, user_lastip
										FROM ".PLANETS." planet
										INNER JOIN ".USERS." user ON planet.id_owner = user.id
										LEFT JOIN ".STATPOINTS." as stat ON stat.id_owner = user.id AND stat.stat_type = '1' 
										WHERE planet.system = ".$Systeme." AND planet.planet = ".$Position.";");
		$IsNoobProtec	= CheckNoobProtec($USER, $targetData, $targetData);
		$targetMission		= 6;
		$fleetArray			= array_filter($fleetArray);
		$UserDeuterium  	= $PLANET['elyrium'];
		$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
		$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $Systeme, $Position));
		$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
		$Duration			= FleetFunctions::GetMissionDuration(10, $SpeedAllMin, $Distance, $SpeedFactor, $USER);
		$consumption		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
			
		$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$targetData['id_owner'].") OR (secondID = ".$USER['id']." AND userID = ".$targetData['id_owner'].");");
		$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$targetData['id_owner']." AND owner = ".$USER['id']." AND state >= 1) OR (sender = ".$USER['id']." AND owner = ".$targetData['id_owner']." AND state >= 1);");								
		
		if (empty($targetData)) {
			echo "<span class='rouge'>".$LNG['fa_planet_not_exist']."</span>";
		}elseif(!empty($SelectCount)){
			echo "<span class='rouge'>".sprintf($LNG['fleet_pact'], getUsername($targetData['id_owner']))."</span>";
		}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $targetData['id_owner'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $targetData['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$targetData['id_owner'].")") != 2){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $targetData['username'])."</span>";
		}elseif (IsVacationMode($targetData)) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_5'], $targetData['username'])."</span>";
		}elseif($targetData['user_deleted'] == 1){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $targetData['username'])."</span>";
		}elseif($targetData['banaday'] > TIMESTAMP){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_4'], $targetData['username'])."</span>";
		}elseif(Config::get('adm_attack') == 1 && $targetData['authattack'] > $USER['authlevel']) {
			echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
		}elseif ($IsNoobProtec['NoobPlayer']) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_6'], $targetData['username'])."</span>";
		}elseif ($IsNoobProtec['StrongPlayer']) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_7'], $targetData['username'])."</span>";
		}elseif ($USER['id'] == $targetData['id_owner']) {
			echo "<span class='rouge'>".$LNG['fleet_ajax_8']."</span>";
		}elseif($UserDeuterium - $consumption < 0) {
				echo "<span class='rouge'>".$LNG['fa_not_enough_fuel']."</span>";
		}elseif($consumption > FleetFunctions::GetFleetRoom($fleetArray)) {
			echo "<span class='rouge'>".$LNG['fa_no_fleetroom']."</span>";
		}else{
			
			$PLANET['elyrium']   	-= $consumption;
			$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".$consumption."' WHERE id = ".$PLANET['id']." ;");
			
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
				308	=> 0,
				309	=> 0,
			);
				
			$fleetStartTime		= $Duration + TIMESTAMP;
			$fleetStayTime		= $fleetStartTime;
			$fleetEndTime		= $fleetStayTime + $Duration;
							
			$shipID				= array_keys($fleetArray);
						
			FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $targetData['id_owner'], $targetData['pid'], 1, $Systeme, $Position, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
			echo "<span class='vert'>".sprintf($LNG['fleet_ajax_16'], array_sum($fleetArray),$targetData['name'],$targetData['system'],$targetData['planet'], $LNG['type_missionbis'][$targetMission])."</span>";
		}
		
	}
	
}elseif($Mission == "espionner_portail"){
	
	$ships	= min($USER['spio_anz'], $PLANET[$resource[210]]);
	
	if(!isModulAvalible(MODULE_MISSION_SPY)) {
		echo "<span class='rouge'>".$LNG['sys_module_inactive']."</span>";
	}elseif($PLANET['teleport_portal'] == 0) {
		echo "<span class='rouge'>".$LNG['fleet_ajax_11']."</span>";
	}elseif(empty($ships)) {
		echo "<span class='rouge'>".$LNG['fleet_ajax_22']."</span>";
	}else{
		$fleetArray = array(210 => $ships);
		$targetData	= $GLOBALS['DATABASE']->getFirstRow("SELECT planet.id_owner as id_owner, 
										planet.id as id, 
										planet.name as name, 
										planet.galaxy as galaxy, 
										planet.system as system, 
										planet.planet as planet,
										planet.planet_type as planet_type, 
										planet.specialships as specialships, 
										planet.force_field_timer as force_field_timer, 
										planet.teleport_portal as teleport_portal, 
										total_points, onlinetime, forcefield_tech, urlaubs_modus, user_lastip, banaday, authattack, user_deleted, username, ally_id, lang
										FROM ".PLANETS." planet
										INNER JOIN ".USERS." user ON planet.id_owner = user.id
										LEFT JOIN ".STATPOINTS." as stat ON stat.id_owner = user.id AND stat.stat_type = '1' 
										WHERE planet.system = ".$Systeme." AND planet.planet = ".$Position.";");
		$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$targetData['id_owner'].") OR (secondID = ".$USER['id']." AND userID = ".$targetData['id_owner'].");");
		$BuddyCheck = $GLOBALS['DATABASE']->query("SELECT * FROM uni1_buddy WHERE (sender = '".$USER['id']."' AND owner = '".$targetData['id_owner']."' AND state >= '1') OR (owner = '".$USER['id']."' AND sender = '".$targetData['id_owner']."' AND state >= '1');");		
		$IsNoobProtec	= CheckNoobProtec($USER, $targetData, $targetData);
		$targetMission		= 14;
		if (empty($targetData)) {
			echo "<span class='rouge'>".$LNG['fa_planet_not_exist']."</span>";
		}elseif($targetData['id_owner'] == $USER['id']){
			echo "<span class='rouge'>".$LNG['fleet_ajax_19']."</span>";
		}elseif($GLOBALS['DATABASE']->numRows($BuddyCheck) >= 1){
			echo "<span class='rouge'>".sprintf($LNG['fleet_pact'], getUsername($targetData['id_owner']))."</span>";
		}elseif ($USER['id'] == $targetData['id_owner']) {
			echo "<span class='rouge'>".$LNG['fleet_ajax_8']."</span>";
		}elseif($targetData['teleport_portal'] == 0){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_18'], $targetData['name'], $targetData['system'], $targetData['planet'])."</span>";
		}elseif($targetData['force_field_timer'] > TIMESTAMP && $USER['virus_tech'] < $targetData['forcefield_tech']){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_21'], getUsername($targetData['id_owner']))."</span>";
		}elseif ($targetData['urlaubs_modus'] == 1){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $targetData['username'])."</span>";
		}elseif($targetData['user_deleted'] == 1){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $targetData['username'])."</span>";
		}elseif($targetData['banaday'] > TIMESTAMP){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_4'], $targetData['username'])."</span>";
		}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $targetData['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $targetData['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$targetData['id'].")") != 2){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $targetData['username'])."</span>";
		}elseif(Config::get('adm_attack') == 1 && $targetData['authattack'] > $USER['authlevel']) {
			echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
		}elseif (IsVacationMode($targetData)) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_5'], $targetData['username'])."</span>";
		}elseif ($IsNoobProtec['NoobPlayer']) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_6'], $targetData['username'])."</span>";
		}elseif ($IsNoobProtec['StrongPlayer']) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_7'], $targetData['username'])."</span>";
		}else{
			$fleetAmount	= 1;
			$PLANET[$resource[210]] -= 1;
			$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[210]." = ".$resource[210]." - 1 WHERE id = ".$PLANET['id'].";");
			$UserTarget		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = ".$targetData['id_owner'].";");
			$PlanetTarget	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = ".$targetData['id'].";");
			$ownSpyLvl		= $USER['spy_tech'];
			$targetSpyLvl	= $UserTarget['spy_tech'];
		
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
				if(empty($targetData['specialships'])){
					$HTML .= "<div style=\"text-align : left;\">— ".$LNG['NOUVEAUTE_703']."<br>— ".$LNG['NOUVEAUTE_704']."<br></div>";
				}else{
					$OwnShips			= explode(';', $targetData['specialships']);		
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
						$getShipInfo	= $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, shipFret, nom, image, shipAttack, shipBouclier, shipCoque FROM ".VARS_USER." WHERE varId = ".$ElementY.";");
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
						$spyData[$classID][$elementID]	= $UserTarget[$resource[$elementID]];
					}
					else 
					{
						$spyData[$classID][$elementID]	= $PlanetTarget[$resource[$elementID]];
					}
				}
				$spyData[$classID]	= array_filter($spyData[$classID]);
			}
			
			$userAlliance	 = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".getAllianceTag($USER['ally_id'])."]</span>";
			$ennemieAlliance = $targetData['ally_id'] == 0 ? "" : " <span class='orange'>[".getAllianceTag($targetData['ally_id'])."]</span>";
				
			if($Diffence < 0){
				$spyRaport = sprintf($LNG['NOUVEAUTE_701'], $targetData['name'], $targetData['system'],$targetData['planet'], getUsername($targetData['id_owner']), $ennemieAlliance, $targetData['name'], $targetData['system'],$targetData['planet']);
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
				$linkCreate .= "&amp;planetId=".$targetData['id']."&amp;timeofRa=".TIMESTAMP;
				
				$spyRaport = sprintf($LNG['NOUVEAUTE_702'], $targetData['name'], $targetData['system'],$targetData['planet'], getUsername($targetData['id_owner']), $ennemieAlliance, $targetData['name'], $targetData['system'],$targetData['planet'], $AddToMessage, $HTML, $AddToMessage1, $linkCreate, $linkCreate);
			}
			SendSimpleMessage($USER['id'], $targetData['id_owner'], TIMESTAMP, 0, sprintf($LNG['sys_mess_tower_spy_owner'], $targetData['name'], $targetData['system'],$targetData['planet']), sprintf($LNG['NOUVEAUTE_697'], getUsername($targetData['id_owner'])), $spyRaport); 
				
			$LNGK	= new Language($targetData['lang']);
			$LNGK->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
			$spyRaport1 = sprintf($LNGK['NOUVEAUTE_700'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'],$targetData['planet'], $PLANET['name'], $PLANET['system'],$PLANET['planet']);
			SendSimpleMessage($targetData['id_owner'], $USER['id'], TIMESTAMP, 0, sprintf($LNGK['NOUVEAUTE_698'], $targetData['name'], $targetData['system'],$targetData['planet']), sprintf($LNGK['NOUVEAUTE_699'], $USER['username']), $spyRaport1);		

			echo "<span class='vert'>".sprintf($LNG['fleet_ajax_17'], $targetData['name'], $targetData['system'],$targetData['planet'],getUsername($targetData['id_owner']))."</span>";
		}
	}
}elseif($Mission == "attaquer_portail"){
	
	//id_equipe_encrypter
	//encrypt_decrypt("decrypt",$VarToDecrypt),
	//encrypt_decrypt("encrypt","population-".$USER['id']."-".$Pop['manageID']),
	
	$id_equipe_encrypter	 	= HTTP::_GP('id_equipe_encrypter', "", UTF8_SUPPORT);	
	$id_equipe_encrypter		= encrypt_decrypt("decrypt",$id_equipe_encrypter);
	$temp 						= explode('-', $id_equipe_encrypter);
	$type						= $temp[0];
	$userMid					= $temp[1];
	$fleetId					= $temp[2];
	$GetuserComp = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM `uni1_fleets_manage` WHERE userID = ".$USER['id']." AND manageID = ".$fleetId." AND manageType = 1;");
				
	if($PLANET['teleport_portal'] == 0) {
		echo "<span class='rouge'>".$LNG['fleet_ajax_11']."</span>";
	}elseif(empty($GetuserComp)){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_486']."</span>";
	}else{
		
		$BuildQueue		= explode(';', $GetuserComp['manageArray']);
		$BuildArray		= array();
		foreach($BuildQueue as $Item)
		{
			$temp = explode(',', $Item);
			$BuildArray[] 		= array($temp[0], $temp[1]);
		}
		$BattleCount = 0;
		$battleArray = array(202,203,225,306,307);
		$Sendarray[202]	= 0;
		$Sendarray[203]	= 0;
		$sqlRemoveAttacker			= "";
		foreach($BuildArray as $Item)
		{	
			if(!in_array($Item[0], $battleArray) || $Item[1] == 0) continue;
		
			if($Item[1] > 0 && $PLANET[$resource[$Item[0]]] >= $Item[1]){
				$ships[$Item[0]]   = $Item[1];
				if($Item[0] > 220)
					$BattleCount	   += $Item[1];
				if($Item[0] == 202)
					$Sendarray[202]	+= $Item[1];
				elseif($Item[0] == 203)
					$Sendarray[203]	+= $Item[1];
				$PLANET[$resource[$Item[0]]] -= $Item[1];
				$sqlRemoveAttacker .= "UPDATE ".PLANETS." SET ".$resource[$Item[0]]." = ".$resource[$Item[0]]." - ".$Item[1]." WHERE id = '".$PLANET['id']."';";
			}elseif($Item[1] > 0 && $PLANET[$resource[$Item[0]]] < $Item[1]){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$Item[0]])."</span>";
				die;
			}
		}
		
		$targetData	= $GLOBALS['DATABASE']->getFirstRow("SELECT planet.id_owner as id_owner, 
										planet.id as id, 
										planet.name as name, 
										planet.galaxy as galaxy, 
										planet.system as system, 
										planet.planet as planet,
										planet.planet_type as planet_type, 
										planet.force_field_timer as force_field_timer, 
										planet.teleport_portal as teleport_portal, 
										planet.small_ship_cargo as small_ship_cargo, 
										planet.big_ship_cargo as big_ship_cargo, 
										planet.speeder as speeder, 
										planet.soldier as soldier, 
										planet.adv_soldier as adv_soldier, 
										total_points, onlinetime, forcefield_tech, urlaubs_modus, banaday, immunity_until, authattack, user_lastip, user_deleted, username, ally_id, lang
										FROM ".PLANETS." planet
										INNER JOIN ".USERS." user ON planet.id_owner = user.id
										LEFT JOIN ".STATPOINTS." as stat ON stat.id_owner = user.id AND stat.stat_type = '1' 
										WHERE planet.system = ".$Systeme." AND planet.planet = ".$Position.";");
		$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$targetData['id_owner'].") OR (secondID = ".$USER['id']." AND userID = ".$targetData['id_owner'].");");
		$BuddyCheck = $GLOBALS['DATABASE']->query("SELECT * FROM uni1_buddy WHERE (sender = '".$USER['id']."' AND owner = '".$targetData['id_owner']."' AND state >= '1') OR (owner = '".$USER['id']."' AND sender = '".$targetData['id_owner']."' AND state >= '1');");		
		$IsNoobProtec	= CheckNoobProtec($USER, $targetData, $targetData);
		if (empty($targetData)) {
			echo "<span class='rouge'>".$LNG['fa_planet_not_exist']."</span>";
		}elseif($targetData['id_owner'] == $USER['id']){
			echo "<span class='rouge'>".$LNG['fleet_ajax_19']."</span>";
		}elseif (FleetFunctions::CheckBashPortalAttack($targetData['id'])){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_488'], $targetData['username'])."</span>";
		}elseif ($targetData['immunity_until'] > TIMESTAMP || !isModulAvalible(MODULE_MISSION_ATTACK)){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_543'], $targetData['username'])."</span>";
		}elseif($GLOBALS['DATABASE']->numRows($BuddyCheck) >= 1){
			echo "<span class='rouge'>".sprintf($LNG['fleet_pact'], getUsername($targetData['id_owner']))."</span>";
		}elseif($targetData['teleport_portal'] == 0){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_18'], $targetData['name'], $targetData['system'], $targetData['planet'])."</span>";
		}elseif($targetData['force_field_timer'] > TIMESTAMP && $USER['virus_tech'] < $targetData['forcefield_tech']){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_21'], getUsername($targetData['id_owner']))."</span>";
		}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $targetData['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $targetData['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$targetData['id'].")") != 2){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $targetData['username'])."</span>";
		}elseif ($targetData['urlaubs_modus'] == 1){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $targetData['username'])."</span>";
		}elseif($targetData['user_deleted'] == 1){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $targetData['username'])."</span>";
		}elseif($targetData['banaday'] > TIMESTAMP){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_4'], $targetData['username'])."</span>";
		}elseif(Config::get('adm_attack') == 1 && $targetData['authattack'] > $USER['authlevel']) {
			echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
		}elseif (IsVacationMode($targetData)) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_5'], $targetData['username'])."</span>";
		}elseif ($IsNoobProtec['NoobPlayer']) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_6'], $targetData['username'])."</span>";
		}elseif ($IsNoobProtec['StrongPlayer']) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_7'], $targetData['username'])."</span>";
		}elseif ($BattleCount == 0) {
			echo "<span class='rouge'>".$LNG['NOUVEAUTE_708']."</span>";
		}else{
			$GLOBALS['DATABASE']->multi_query($sqlRemoveAttacker);
			$GLOBALS['DATABASE']->query("INSERT INTO ".PORTALBASH." SET attackerId = ".$USER['id'].", planetId = ".$targetData['id'].", timeAttack = ".TIMESTAMP.";");	
			
			$userAlliance	 = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".getAllianceTag($USER['ally_id'])."]</span>";
			$ennemieAlliance = $targetData['ally_id'] == 0 ? "" : " <span class='orange'>[".getAllianceTag($targetData['ally_id'])."]</span>";
			$targetUser   	 = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = '".$targetData['id_owner']."';");
			$targetPlanet    = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = '".$targetData['id']."';");
			$fleetAttack	= array();
			$fleetDefend	= array();
			
			$userAttack		= array();
			$userDefend		= array();
			
			$stealResource	= array(
				901	=> 0,
				902	=> 0,
				903	=> 0,
				904	=> 0,
			);
			
			$fleetAttack[0]['fleetDetail']		= array(
				'fleet_start_galaxy'	=> $PLANET['galaxy'], 
				'fleet_start_system'	=> $PLANET['system'], 
				'fleet_start_planet'	=> $PLANET['planet'], 
				'fleet_start_type'		=> $PLANET['planet_type'], 
			);
			$fleetAttack[0]['player']			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = '".$USER['id']."';");
			$fleetAttack[0]['player']['factor']	= getFactors($fleetAttack[0]['player'], 'attack', TIMESTAMP);
			$fleetAttack[0]['unit']				= $ships;
			
			$userAttack[$fleetAttack[0]['player']['id']]	= $fleetAttack[0]['player']['username'];
			
			$fleetDefend[0]['player']			= $targetUser;
			$fleetDefend[0]['player']['factor']	= getFactors($fleetDefend[0]['player'], 'attack', TIMESTAMP);
			$fleetDefend[0]['fleetDetail']		= array(
				'fleet_start_galaxy'	=> $targetData['galaxy'], 
				'fleet_start_system'	=> $targetData['system'], 
				'fleet_start_planet'	=> $targetData['planet'], 
				'fleet_start_type'		=> $targetData['planet_type'], 
			);
	
			$fleetDefend[0]['unit']				= array();
			
			foreach($battleArray as $elementID)
			{
				if (empty($targetData[$resource[$elementID]])) continue;

				$fleetDefend[0]['unit'][$elementID] = $targetData[$resource[$elementID]];
			}
			
			$userDefend[$fleetDefend[0]['player']['id']]	= $fleetDefend[0]['player']['username'];
			
			require_once('includes/classes/missions/calculateAttack.php');
		
			$combatResult 		= calculateAttack($fleetAttack, $fleetDefend, 0, 0, $Sendarray[202], $Sendarray[203]);
			$sqlQuery			= "";
			
			foreach ($fleetAttack as $fleetID => $fleetDetail)
			{
				$fleetArray = '';
				$totalCount = 0;
				
				$fleetDetail['unit']	= array_filter($fleetDetail['unit']);
				foreach ($fleetDetail['unit'] as $elementID => $amount)
				{				
					$fleetArray[] = $resource[$elementID]." = (".$resource[$elementID]." + ".$amount.")";
					$PLANET[$resource[$elementID]] += $amount;
					$totalCount += $amount;
				}
				
				if($totalCount == 0)
				{
					//DELETE THE FLEETS FROM BATTLE HERE
				}
				elseif($totalCount > 0)
				{
					$sqlQuery .= "UPDATE ".PLANETS." SET ".implode(', ', $fleetArray).", ".$resource[202]." = ".$resource[202]." + ".$Sendarray[202].", ".$resource[203]." = ".$resource[203]." + ".$Sendarray[203]." WHERE id = '".$PLANET['id']."';";
					$PLANET[$resource[202]] += $Sendarray[202];
					$PLANET[$resource[203]] += $Sendarray[203];
				}
				else
				{
					throw new Exception("Negative Fleet amount ....");
				}
			}
			
			foreach ($fleetDefend as $fleetID => $fleetDetail)
			{
				$fleetArray = array();
				foreach ($fleetDetail['unit'] as $elementID => $amount)
				{				
					$fleetArray[] = $resource[$elementID]." = ".$amount;
				}
				
				if(!empty($fleetArray))
				{
					$sqlQuery .= "UPDATE ".PLANETS." SET ".implode(', ', $fleetArray)." WHERE id = '".$targetData['id']."';";
				}
			}
			
			if(!empty($sqlQuery)){
				$GLOBALS['DATABASE']->multi_query($sqlQuery);
			}
			
			if ($combatResult['won'] == "a")
			{
				require_once('includes/classes/missions/calculateStealPortal.php');
				$stealResource = calculateStealPortal($fleetAttack, $targetPlanet, false, $combatResult['Small'], $combatResult['Large']);
				$PLANET['metal']	+= $stealResource[901];
				$PLANET['crystal']	+= $stealResource[902];
				$PLANET['deuterium']+= $stealResource[903];
				$PLANET['elyrium']	+= $stealResource[904];
				$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET metal = metal + '".$stealResource[901]."', crystal = crystal + '".$stealResource[902]."', deuterium = deuterium + '".$stealResource[903]."', elyrium = elyrium + '".$stealResource[904]."' WHERE id = ".$PLANET['id']." ;");
			}
			
			$raportInfo	= array(
				'thisFleet'				=> false,
				'stealResource'			=> $stealResource,
				'moonDestroy'			=> false,
				'moonName'				=> null,
				'moonDestroyChance'		=> null,
				'moonDestroySuccess'	=> null,
				'fleetDestroyChance'	=> null,
				'fleetDestroySuccess'	=> null,
			);
		
			require_once('includes/classes/missions/GenerateReport.php');
			$raportData	= GenerateReport($combatResult, $raportInfo);	
			
			switch($combatResult['won'])
			{
				case "a":
					$attackStatus	= 'wons';
					$defendStatus	= 'loos';
					$attackClass	= $LNG['NOUVEAUTE_773'];
					$defendClass	= $LNG['NOUVEAUTE_774'];
					$attackColor	= "vert";
					$defendColor	= "rouge";
					$WinnerId		= $USER['id'];
					$LoserId		= $targetData['id_owner'];
				break;
				case "w":
					$attackStatus	= 'draws';
					$defendStatus	= 'draws';
					$attackClass	= 'raportDraw';
					$defendClass	= 'raportDraw';
				break;
				case "r":
					$attackStatus	= 'loos';
					$defendStatus	= 'wons';
					$attackClass	= $LNG['NOUVEAUTE_774'];
					$defendClass	= $LNG['NOUVEAUTE_773'];
					$WinnerId		= $targetData['id_owner'];
					$LoserId		= $USER['id'];
					$attackColor	= "rouge";
					$defendColor	= "vert";
				break;
			}
			
			$raportID	= md5(uniqid('', true).TIMESTAMP);
			
			$sqlQuery	= "INSERT INTO ".RW." SET 
			rid = '".$raportID."',
			raport = '".serialize($raportData)."',
			time = '".TIMESTAMP."',
			attacker = '".implode(',', array_keys($userAttack))."',
			defender = '".implode(',', array_keys($userDefend))."';";
			$GLOBALS['DATABASE']->query($sqlQuery);
			
			$sqlQuery		= "";
			
			$sqlQuery	.= "INSERT INTO ".TOPKB_USERS." SET ";
			$sqlQuery	.= "rid = '".$raportID."', ";
			$sqlQuery	.= "role = 1, ";
			$sqlQuery	.= "username = '".$GLOBALS['DATABASE']->escape($USER['username'])."', ";
			$sqlQuery	.= "uid = ".$USER['id'].";";
			
			$sqlQuery	.= "INSERT INTO ".TOPKB_USERS." SET ";
			$sqlQuery	.= "rid = '".$raportID."', ";
			$sqlQuery	.= "role = 2, ";
			$sqlQuery	.= "username = '".$GLOBALS['DATABASE']->escape($targetData['username'])."', ";
			$sqlQuery	.= "uid = ".$targetData['id_owner'].";";
			
			$sqlQuery	.= "UPDATE ".PLANETS." SET
						metal = metal - ".$stealResource[901].",
						crystal = crystal - ".$stealResource[902].",
						deuterium = deuterium - ".$stealResource[903].",
						elyrium = elyrium - ".$stealResource[904]."
						WHERE
						id = ".$targetData['id'].";
						UPDATE ".USERS." SET
						".$attackStatus." = ".$attackStatus." + 1,
						lostunits = lostunits + ".$combatResult['unitLost']['attacker'].",
						desunits = desunits + ".$combatResult['unitLost']['defender']."
						WHERE
						id IN (".implode(',', array_keys($userAttack)).");
						UPDATE ".USERS." SET
						".$defendStatus." = ".$defendStatus." + 1,
						lostunits = lostunits + ".$combatResult['unitLost']['defender'].",
						desunits = desunits + ".$combatResult['unitLost']['attacker']."
						WHERE
						id IN (".implode(',', array_keys($userDefend)).");";
						
			$GLOBALS['DATABASE']->multi_query($sqlQuery);

			$RID		= $raportID;
		
			$Raport		= $GLOBALS['DATABASE']->getFirstRow("SELECT 
			raport, time,
			(
				SELECT 
				GROUP_CONCAT(username SEPARATOR ' & ') as attacker
				FROM ".USERS." 
				WHERE id IN (SELECT uid FROM ".TOPKB_USERS." WHERE ".TOPKB_USERS.".rid = ".RW.".rid AND role = 1)
			) as attacker,
			(
				SELECT 
				GROUP_CONCAT(username SEPARATOR ' & ') as defender
				FROM ".USERS." 
				WHERE id IN (SELECT uid FROM ".TOPKB_USERS." WHERE ".TOPKB_USERS.".rid = ".RW.".rid AND role = 2)
			) as defender
			FROM ".RW."
			WHERE rid = '".$GLOBALS['DATABASE']->escape($RID)."';");
			
			$Info		= array($Raport["attacker"], $Raport["defender"]);
			
			$CombatRaport			= unserialize($Raport['raport']);
			$CombatRaport['time']	= _date($LNG['php_tdformat'], $CombatRaport['time'], $USER['timezone']);
			$CombatRaport			= BCWrapperPreRev2321($CombatRaport);
			$Raport					= $CombatRaport;
			$TextToEcho				= "";			
			$TextToEcho2			= "";			
			$TextToEcho3			= "";
			$TextToEcho4			= "";
			$TextToEcho5			= "";
			$TextToEcho6			= "";
			
			$UserOShips[225]		= 0;
			$UserOShips[306]		= 0;
			$UserOShips[307]		= 0;
			
			$TargetShips[225]		= 0;
			$TargetShips[306]		= 0;
			$TargetShips[307]		= 0;
			
			if ($combatResult['won'] == "a"){
				//WIN 0 ROUND MESSAGE		
				foreach($stealResource as $ResId => $Count){
					$TextToEcho3 .= "- <span style=\"display : inline-block; width : 80px; text-align : left;\">".$LNG['tech'][$ResId]." :</span> 
					<span style=\"display : inline-block; width : 120px; text-align : left;\" class=\"orange\">".pretty_number($Count)."</span><br>";
				}
				
				foreach($Raport['rounds'] as $Round => $RoundInfo){
					$i = key(end($RoundInfo));
					if($Round == 0){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$UserOShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho = "<tr><td colspan='5'>The attacker has no army on this planet</td></tr>";
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho2 .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$TargetShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho2 = "<tr><td colspan='5'><center>".$LNG['NOUVEAUTE_777']."</center></td></tr>";
							}
							
						}
					}
					
					if($Round == (count($combatResult['rw']) -1)){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($UserOShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $UserOShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho5 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($TargetShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $TargetShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho6 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
					}
					//$i++;
				}
				
				$MessageSend = sprintf($LNG['NOUVEAUTE_772'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, getUsername($WinnerId), getUsername($LoserId), $attackColor, $USER['username'], $attackClass, $defendColor, $targetData['username'], $defendClass, sprintf($LNG['NOUVEAUTE_775'], $USER['username']), $TextToEcho3, "", "", $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
				SendSimpleMessage($USER['id'], $targetData['id_owner'], TIMESTAMP, 6, sprintf($LNG['NOUVEAUTE_770'], $targetData['username']), sprintf($LNG['NOUVEAUTE_769'], $USER['username'], $targetData['name'], $targetData['system'], $targetData['planet']), $MessageSend);
				//WIN 0 ROUND MESSAGE
				$LNGK	= new Language($targetData['lang']);
				$LNGK->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
				
				$TextToEcho				= "";			
				$TextToEcho2			= "";			
				$TextToEcho3			= "";
				$TextToEcho4			= "";
				$TextToEcho5			= "";
				$TextToEcho6			= "";	
				
				$UserOShips[225]		= 0;
				$UserOShips[306]		= 0;
				$UserOShips[307]		= 0;
			
				$TargetShips[225]		= 0;
				$TargetShips[306]		= 0;
				$TargetShips[307]		= 0;
				
				foreach($stealResource as $ResId => $Count){
					$TextToEcho3 .= "- <span style=\"display : inline-block; width : 80px; text-align : left;\">".$LNGK['tech'][$ResId]." :</span> 
					<span style=\"display : inline-block; width : 120px; text-align : left;\" class=\"orange\">".pretty_number($Count)."</span><br>";
				}
				
				foreach($Raport['rounds'] as $Round => $RoundInfo){
					$i = key(end($RoundInfo));
					if($Round == 0){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho .= "<tr>
										<td>".$LNGK['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$UserOShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho = "<tr><td colspan='5'>The attacker has no army on this planet</td></tr>";
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho2 .= "<tr>
										<td>".$LNGK['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$TargetShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho2 = "<tr><td colspan='5'><center>".$LNGK['NOUVEAUTE_777']."</center></td></tr>";
							}
							
						}
					}
					
					if($Round == (count($combatResult['rw']) -1)){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($UserOShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho5 .= "<tr>
																<td>".$LNGK['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $UserOShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho5 .= "<tr>
														<td>".$LNGK['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($TargetShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho6 .= "<tr>
																<td>".$LNGK['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									
									$TextColor	= $TargetShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho6 .= "<tr>
														<td>".$LNGK['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
					}
					//$i++;
				}
				$MessageSend = sprintf($LNGK['NOUVEAUTE_772'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, getUsername($WinnerId), getUsername($LoserId), $attackColor, $USER['username'], $attackClass, $defendColor, $targetData['username'], $defendClass, sprintf($LNG['NOUVEAUTE_775'], $USER['username']), $TextToEcho3, "", "", $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
				SendSimpleMessage($targetData['id_owner'], $USER['id'], TIMESTAMP, 6, sprintf($LNGK['NOUVEAUTE_771'], $USER['username']), sprintf($LNGK['NOUVEAUTE_769'], $USER['username'], $targetData['name'], $targetData['system'], $targetData['planet']), $MessageSend);
			}elseif ($combatResult['won'] == "w"){
				//DRAW 0 ROUND MESSAGE		
				foreach($stealResource as $ResId => $Count){
					$TextToEcho3 .= "- <span style=\"display : inline-block; width : 80px; text-align : left;\">".$LNG['tech'][$ResId]." :</span> 
					<span style=\"display : inline-block; width : 120px; text-align : left;\" class=\"orange\">".pretty_number($Count)."</span><br>";
				}
				
				foreach($Raport['rounds'] as $Round => $RoundInfo){
					$i = key(end($RoundInfo));
					if($Round == 0){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$UserOShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho = "<tr><td colspan='5'>The attacker has no army on this planet</td></tr>";
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho2 .= "<tr>
										<td>".$LNG['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$TargetShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho2 = "<tr><td colspan='5'><center>".$LNG['NOUVEAUTE_777']."</center></td></tr>";
							}
							
						}
					}
					
					if($Round == (count($combatResult['rw']) -1)){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($UserOShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $UserOShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho5 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($TargetShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $TargetShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho6 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
					}
					//$i++;
				}
				
				$MessageSend = sprintf($LNG['NOUVEAUTE_779'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, $USER['username'], $USER['username'], $targetData['username'], $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
				SendSimpleMessage($USER['id'], $targetData['id_owner'], TIMESTAMP, 6, sprintf($LNG['NOUVEAUTE_778'], $targetData['username']), sprintf($LNG['NOUVEAUTE_769'], $USER['username'], $targetData['name'], $targetData['system'], $targetData['planet']), $MessageSend);
				//DRAW 0 ROUND MESSAGE
				$LNGK	= new Language($targetData['lang']);
				$LNGK->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
				
				$TextToEcho				= "";			
				$TextToEcho2			= "";			
				$TextToEcho3			= "";
				$TextToEcho4			= "";
				$TextToEcho5			= "";
				$TextToEcho6			= "";	
				
				$UserOShips[225]		= 0;
				$UserOShips[306]		= 0;
				$UserOShips[307]		= 0;
			
				$TargetShips[225]		= 0;
				$TargetShips[306]		= 0;
				$TargetShips[307]		= 0;
				
				foreach($stealResource as $ResId => $Count){
					$TextToEcho3 .= "- <span style=\"display : inline-block; width : 80px; text-align : left;\">".$LNGK['tech'][$ResId]." :</span> 
					<span style=\"display : inline-block; width : 120px; text-align : left;\" class=\"orange\">".pretty_number($Count)."</span><br>";
				}
				
				foreach($Raport['rounds'] as $Round => $RoundInfo){
					$i = key(end($RoundInfo));
					if($Round == 0){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho .= "<tr>
										<td>".$LNGK['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$UserOShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho = "<tr><td colspan='5'>The attacker has no army on this planet</td></tr>";
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho2 .= "<tr>
										<td>".$LNGK['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$TargetShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho2 = "<tr><td colspan='5'><center>".$LNGK['NOUVEAUTE_777']."</center></td></tr>";
							}
							
						}
					}
					
					if($Round == (count($combatResult['rw']) -1)){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($UserOShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho5 .= "<tr>
																<td>".$LNGK['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $UserOShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho5 .= "<tr>
														<td>".$LNGK['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($TargetShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho6 .= "<tr>
																<td>".$LNGK['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									
									$TextColor	= $TargetShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho6 .= "<tr>
														<td>".$LNGK['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
					}
					//$i++;
				}
				$MessageSend = sprintf($LNGK['NOUVEAUTE_779'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, $USER['username'], $USER['username'], $targetData['username'], $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
				SendSimpleMessage($targetData['id_owner'], $USER['id'], TIMESTAMP, 6, sprintf($LNGK['NOUVEAUTE_778'], $USER['username']), sprintf($LNGK['NOUVEAUTE_769'], $USER['username'], $targetData['name'], $targetData['system'], $targetData['planet']), $MessageSend);
			}elseif ($combatResult['won'] == "r"){
				//LOSE 0 ROUND MESSAGE
				$MessageSend = sprintf($LNG['NOUVEAUTE_710'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet']);
				SendSimpleMessage($USER['id'], $targetData['id_owner'], TIMESTAMP, 6, sprintf($LNG['NOUVEAUTE_771'], $targetData['username']), sprintf($LNG['NOUVEAUTE_769'], $USER['username'], $targetData['name'], $targetData['system'], $targetData['planet']), $MessageSend);
				//WIN 0 ROUND MESSAGE
				$LNGK	= new Language($targetData['lang']);
				$LNGK->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
				
				$TextToEcho				= "";			
				$TextToEcho2			= "";	
				$TextToEcho5			= "";
				$TextToEcho6			= "";					
				foreach($Raport['rounds'] as $Round => $RoundInfo){
					$i = key(end($RoundInfo));
					if($Round == 0){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho .= "<tr>
										<td>".$LNGK['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$UserOShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho = "<tr><td colspan='5'>The attacker has no army on this planet</td></tr>";
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								foreach($Player['ships'] as $ShipID => $ShipData){
									$TextToEcho2 .= "<tr>
										<td>".$LNGK['shortNames'][$ShipID]."</td>
										<td>".pretty_number($ShipData[1])."</td>
										<td>".pretty_number($ShipData[2])."</td>
										<td>".pretty_number($ShipData[3])."</td>
										<td>".pretty_number($ShipData[0])."</td>
									</tr>";
									$TargetShips[$ShipID] = $ShipData[0];
								}
							}else{
								$TextToEcho2 = "<tr><td colspan='5'><center>".$LNGK['NOUVEAUTE_777']."</center></td></tr>";
							}
							
						}
					}
					
					if($Round == (count($combatResult['rw']) -1)){
						foreach($RoundInfo['attacker'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($UserOShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho5 .= "<tr>
																<td>".$LNGK['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									if($insideId == 0){
										$TextToEcho5 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									$TextColor	= $UserOShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho5 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($UserOShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
						
						foreach($RoundInfo['defender'] as $Player){
							$PlayerInfo = $Raport['players'][$Player['userID']];
							if(!empty($Player['ships'])){
								
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $Ship){
									$insideId = 0;
									foreach($Player['ships'] as $ShipID => $ShipData){
										if($ShipID == $Ship){
											$insideId = 1;
											$TextColor	= ($TargetShips[$ShipID] - $ShipData[0]) > 0 ? "rouge" : "orange";
											$TextSign	= $TextColor == "rouge" ? "-" : "";
											$TextToEcho6 .= "<tr>
																<td>".$LNGK['shortNames'][$ShipID]."</td>
																<td>".pretty_number($ShipData[0])."</td>
																<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID] - $ShipData[0])."</td>
															</tr>";
										}
									}
									
									if($insideId == 0){
										$TextToEcho6 .= "<tr>
																<td>".$LNG['shortNames'][$Ship]."</td>
																<td>0</td>
																<td class=\"orange\">0</td>
															</tr>";
									}
								}
							}else{
								$ShipsArray = array(225,306,307);
								foreach($ShipsArray as $ShipID){
									
									$TextColor	= $TargetShips[$ShipID] > 0 ? "rouge" : "orange";
									$TextSign	= $TextColor == "rouge" ? "-" : "";
									$TextToEcho6 .= "<tr>
														<td>".$LNG['shortNames'][$ShipID]."</td>
														<td>0</td>
														<td class=\"".$TextColor."\">".$TextSign."".pretty_number($TargetShips[$ShipID])."</td>
													</tr>";
								}
							}
							
						}
					}
					//$i++;
				}
				
				$TransporterId = array(202,203);
				
				foreach($TransporterId as $id){
					$TextToEcho4 .= "- <span style=\"display : inline-block; width : 140px; text-align : left;\">".$LNG['tech'][$id]." :</span> 
					<span style=\"display : inline-block; width : 60px; text-align : left;\" class=\"orange\">".pretty_number($Sendarray[$id])."</span><br>";
				}
			
				$MessageSend = sprintf($LNGK['NOUVEAUTE_772'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, getUsername($WinnerId), getUsername($LoserId), $attackColor, $USER['username'], $attackClass, $defendColor, $targetData['username'], $defendClass, "", $TextToEcho3, sprintf($LNG['NOUVEAUTE_776'], $targetData['username']), $TextToEcho4, $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
				SendSimpleMessage($targetData['id_owner'], $USER['id'], TIMESTAMP, 6, sprintf($LNGK['NOUVEAUTE_770'], $USER['username']), sprintf($LNGK['NOUVEAUTE_769'], $USER['username'], $targetData['name'], $targetData['system'], $targetData['planet']), $MessageSend);
			}
			
			echo "<span class='vert'>".sprintf($LNG['fleet_ajax_20'], $targetData['name'], $targetData['system'],$targetData['planet'],getUsername($targetData['id_owner']))."</span>";
		}
	}
}else{
	$id_equipe_encrypter	 	= HTTP::_GP('id_equipe_encrypter', "", UTF8_SUPPORT);	
	$id_equipe_encrypter		= encrypt_decrypt("decrypt",$id_equipe_encrypter);
	$temp 						= explode('-', $id_equipe_encrypter);
	$type						= $temp[0];
	$userMid					= $temp[1];
	$fleetId					= $temp[2];
	
	$GetuserComp = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM `uni1_fleets_manage` WHERE userID = ".$USER['id']." AND manageID = ".$fleetId." AND manageType = 2;");
				
	if(empty($GetuserComp)){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_486']."</span>";
	}else{
		
		$BuildQueue		= explode(';', $GetuserComp['manageArray']);
		$OwnQueue		= explode(';', $PLANET['specialships']);
		$BuildArray					= array();
		foreach($BuildQueue as $Item)
		{
			$temp = explode(',', $Item);
			$BuildArray[] 		= array($temp[0], $temp[1]);
		}
		$shipAmount	= 0;
		foreach($BuildArray as $Item)
		{
			$getShipInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT constructionTime, nom FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$Item[0].";");
			$getShipCount	 	= 0;
			if(!empty($OwnQueue))
			{
				foreach($OwnQueue as $OwnShip)
				{
					$temp = explode(',', $OwnShip);
					if($Item[0] == $temp[0])
						$getShipCount = $temp[1];
					
				}
			}
			
			if($Item[1] > 0 && $getShipCount >= $Item[1]){
				$ships[$Item[0]]   	= $Item[1];
				$shipAmount			+= $Item[1];
			}elseif($Item[1] > 0 && $getShipCount < $Item[1]){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $getShipInfo['nom'])."</span>";
				die;
			}
		}
		
		$fleetArray = $ships;
		$targetData	= $GLOBALS['DATABASE']->getFirstRow("SELECT planet.id_owner as id_owner, 
										planet.id as id, 
										planet.name as name, 
										planet.galaxy as galaxy, 
										planet.system as system, 
										planet.planet as planet,
										planet.planet_type as planet_type, 
										planet.force_field_timer as force_field_timer, 
										planet.teleport_portal as teleport_portal, 
										total_points, onlinetime, forcefield_tech, urlaubs_modus, banaday, user_lastip, authattack, immunity_until, user_deleted, username, ally_id, lang
										FROM ".PLANETS." planet
										INNER JOIN ".USERS." user ON planet.id_owner = user.id
										LEFT JOIN ".STATPOINTS." as stat ON stat.id_owner = user.id AND stat.stat_type = '1' 
										WHERE planet.system = ".$Systeme." AND planet.planet = ".$Position.";");
		$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$targetData['id_owner'].") OR (secondID = ".$USER['id']." AND userID = ".$targetData['id_owner'].");");
		$BuddyCheck = $GLOBALS['DATABASE']->query("SELECT * FROM uni1_buddy WHERE (sender = '".$USER['id']."' AND owner = '".$targetData['id_owner']."' AND state >= '1') OR (owner = '".$USER['id']."' AND sender = '".$targetData['id_owner']."' AND state >= '1');");		
		$IsNoobProtec	= CheckNoobProtec($USER, $targetData, $targetData);
		$targetMission		= 1;
		
		$CountBash	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".LOG_FLEETS."
			WHERE fleet_owner = ".$USER['id']." 
			AND fleet_end_id = ".$targetData['id']." 
			AND fleet_state != 0 
			AND fleet_start_time > ".(TIMESTAMP - BASH_TIME)." 
			AND fleet_mission = 1;");
			
		if (empty($targetData)) {
			echo "<span class='rouge'>".$LNG['fa_planet_not_exist']."</span>";
		}elseif($targetData['id_owner'] == $USER['id']){
			echo "<span class='rouge'>".$LNG['fleet_ajax_13']."</span>";
		}elseif(FleetFunctions::CheckBash($targetData['id'])){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_588'], getUsername($targetData['id_owner']))."</span>";
		}elseif($GLOBALS['DATABASE']->numRows($BuddyCheck) >= 1){
			echo "<span class='rouge'>".sprintf($LNG['fleet_pact'], getUsername($targetData['id_owner']))."</span>";
		}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $targetData['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $targetData['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$targetData['id'].")") != 2){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $targetData['username'])."</span>";
		}elseif ($targetData['urlaubs_modus'] == 1){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $targetData['username'])."</span>";
		}elseif($targetData['user_deleted'] == 1){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $targetData['username'])."</span>";
		}elseif($targetData['banaday'] > TIMESTAMP){
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_4'], $targetData['username'])."</span>";
		}elseif(Config::get('adm_attack') == 1 && $targetData['authattack'] > $USER['authlevel']) {
			echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
		}elseif (IsVacationMode($targetData)) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_5'], $targetData['username'])."</span>";
		}elseif ($targetData['immunity_until'] > TIMESTAMP || $CountBash >= 6 || !isModulAvalible(MODULE_MISSION_ATTACK)){
			echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_543'], $targetData['username'])."</span>";
		}elseif ($IsNoobProtec['NoobPlayer']) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_6'], $targetData['username'])."</span>";
		}elseif ($IsNoobProtec['StrongPlayer']) {
			echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_7'], $targetData['username'])."</span>";
		}else{
			$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
			$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array($targetData['galaxy'], $targetData['system'], $targetData['planet']));
			$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
			$Duration			= FleetFunctions::GetMissionDuration(10, $SpeedAllMin, $Distance, $SpeedFactor, $USER);
			$consumption		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration, $Distance, $SpeedAllMin, $USER, $SpeedFactor);	
		
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
				308	=> 0,
				309	=> 0,
			);
			
			$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[301]." = ".$resource[301]." - ".$fleetPopulation[301].", ".$resource[302]." = ".$resource[302]." - ".$fleetPopulation[302].", ".$resource[303]." = ".$resource[303]." - ".$fleetPopulation[303].", ".$resource[304]." = ".$resource[304]." - ".$fleetPopulation[304].", ".$resource[305]." = ".$resource[305]." - ".$fleetPopulation[305].", ".$resource[306]." = ".$resource[306]." - ".$fleetPopulation[306].", ".$resource[307]." = ".$resource[307]." - ".$fleetPopulation[307].", ".$resource[308]." = ".$resource[308]." - ".$fleetPopulation[308].", ".$resource[309]." = ".$resource[309]." - ".$fleetPopulation[309]."	WHERE id = ".$PLANET['id'].";"); 
		
			$fleetStartTime		= $Duration + TIMESTAMP;
			$fleetStayTime		= $fleetStartTime;
			$fleetEndTime		= $fleetStayTime + $Duration;
			
			$shipID				= array_keys($fleetArray);
			
			FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'],
			$targetData['id_owner'], $targetData['id'], $targetData['galaxy'], $targetData['system'], $targetData['planet'], $targetData['planet_type'], $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
			
			echo "<span class='vert'>".sprintf($LNG['NOUVEAUTE_587'], $shipAmount, $targetData['name'], $targetData['system'],$targetData['planet'], $LNG['type_missionbis'][1])."</span>";
			
		} 
	}
}
?>