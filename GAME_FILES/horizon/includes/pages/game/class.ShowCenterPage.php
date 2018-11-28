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
 * @info $Id: class.ShowResourcesPage.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */
require 'includes/classes/class.FleetFunctions.php';
class ShowCenterPage extends AbstractPage
{
	public static $requireModule = MODULE_SPACECENTER;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show()
	{
		global $LNG, $USER, $PLANET;
		
		$Message = "";
		
		/*$allowedArray = array(1,2);
		if(!in_array($USER['id'], $allowedArray)){
			$this->printMessage('This page is being repaired by the team. / Cette page et en reparation chez les administrateurs.', true, array('game.php?page=overview', 2));
			die();
		}*/
		
		if($USER['urlaubs_modus'] == 1){
			$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_20']."</span>";
		}
		
		$this->tplObj->assign_vars(array(	
			'Message' 		=> $Message,
		));
		
		$this->display('page.center.default.tpl');
	}
	
	
	function mission()
	{
		global $LNG, $USER, $PLANET, $resource, $pricelist;
		
		if (IsVacationMode($USER)) {
			$this->redirectTo('game.php?page=center');
			return false;
		}
		
		$mission				= HTTP::_GP('missionID', 0);
		$colonyList 			= $this->GetColonyList();
		$GetAll99 				= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE id != ".$PLANET['id']." AND id_owner = ".$USER['id']." AND destruyed = '0' ;");
		$RecyclersOnPlanet		= array();
		$recyclerFleet			= array(209,223,219);
		$OwnArray				= array();
		$OwnShipsOnPlanet		= array();
		$ResourceOnPlanet		= array();
		$ResourceArray			= array(901,902,903,904);
		$SpecializedOnPlanet	= array();
		$SpecializedArray		= array(202,203,210,224,225,226,221,222);
		$PopulationOnPlanet		= array();
		$PopulationArray		= array(302,303,304,305,306,307,308,309);
		$RecyclersCount			= 0;
		$ownFleetCount			= 0;
		
		foreach($PopulationArray as $popId)
		{	
			$PopulationOnPlanet[]	= array(
				'id'		=> $popId,
				'amount'	=> floor($PLANET[$resource[$popId]]),
			);
		}
		
		foreach($SpecializedArray as $specializedId)
		{	
			$SpecializedOnPlanet[]	= array(
				'id'		=> $specializedId,
				'amount'	=> floor($PLANET[$resource[$specializedId]]),
			);
		}
		
		foreach($ResourceArray as $resId)
		{	
			$resourceTag	= "fer";
			if($resId == 902)
				$resourceTag	= "oro";
			elseif($resId == 903)
				$resourceTag	= "cristal";
			elseif($resId == 904)
				$resourceTag	= "elyrium";
				
			$ResourceOnPlanet[]	= array(
				'id'		=> $resId,
				'amount'	=> floor($PLANET[$resource[$resId]]),
				'image'		=> $resource[$resId],
				'resTag'	=> $resourceTag,
			);
		}
		
		foreach($recyclerFleet as $recycler)
		{	
			if($PLANET[$resource[$recycler]] == 0)
				continue;
			
			$RecyclersCount		+= 1;
			$RecyclersOnPlanet[]	= array(
				'id'	=> $recycler,
				'count'	=> floor($PLANET[$resource[$recycler]]),
				'fret'	=> pretty_number($pricelist[$recycler]['capacity']),
				'speed'	=> 100/100000000*$pricelist[$recycler]['speed'],
				'Hyper'	=> $pricelist[$recycler]['isHyperspace'],
				'text'	=> sprintf($LNG['NOUVEAUTE_612'], floor($PLANET[$resource[$recycler]])),
			);
		}
		if(!empty($PLANET['specialships'])){
			$OwnShips			= explode(';', $PLANET['specialships']);		
			foreach($OwnShips as $Items)
			{
				$temp 			= explode(',', $Items);
				if($temp[1] == 0)
					continue;
				$OwnArray[]		= array($temp[0], $temp[1]);
			}
			
			$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
			
			foreach($OwnArray as $Items)
			{
				$ElementY   	= $Items[0];
				$Availables 	= $Items[1];
				$getShipInfo	= $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, shipFret, nom, image, shipAttack, shipBouclier, shipCoque FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$ElementY.";");
				$poundA			= (int) $liste_infrastructure[$getShipInfo['id_infrastructure']]['poids'];
				$ownFleetCount	+= $Availables;
				$OwnShipsOnPlanet[]	= array(
					'id'			=> $ElementY,
					'count'			=> floor($Availables),
					'fret'			=> pretty_number($getShipInfo['shipFret']),
					'fret2'			=> $getShipInfo['shipFret'],
					'speed'			=> round(($getShipInfo['shipSpeed']/$poundA*1e4/100),2),
					'Hyper'			=> 0,
					'nom'			=> $getShipInfo['nom'],
					'image'			=> $getShipInfo['image'],
					'infra'			=> $getShipInfo['id_infrastructure'],
					'shipAttack'	=> $getShipInfo['shipAttack'],
					'shipBouclier'	=> $getShipInfo['shipBouclier'],
					'shipCoque'		=> $getShipInfo['shipCoque'],
					'text'			=> sprintf($LNG['NOUVEAUTE_612'], floor($Availables)),
				);
			}
		}
		$this->tplObj->assign_vars(array(	
			'planetSpies'			=> $PLANET[$resource[224]],
			'colonyList' 			=> $colonyList,
			'GetAll99'	 			=> $GetAll99,
			'RecyclersOnPlanet'	 	=> $RecyclersOnPlanet,
			'ResourceOnPlanet'	 	=> $ResourceOnPlanet,
			'PopulationOnPlanet'	=> $PopulationOnPlanet,
			'SpecializedOnPlanet'	=> $SpecializedOnPlanet,
			'OwnShipsOnPlanet'	 	=> $OwnShipsOnPlanet,
			'RecyclersCount'	 	=> $RecyclersCount,
			'ownFleetCount'		 	=> $ownFleetCount,
			'droneOnPlanet'		 	=> $PLANET[$resource[226]],
		));
		
		$allowedArray = array(4,3,7,12,8,9,6,1);
		if(in_array($mission, $allowedArray)){
			$this->display('page.center.mission_'.$mission.'.tpl');
		}else{
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=center');
		}		
	}
	
	function verifier()
	{
		global $LNG, $UNI, $USER, $PLANET, $resource, $pricelist;
		$onglet_page 					= HTTP::_GP('onglet_page', "", UTF8_SUPPORT);
		
		if($onglet_page == "null")
			return false;
		
		if($onglet_page == "espionner"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$IsNoobProtec		= CheckNoobProtec($USER, $Opponent, $Opponent);
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state >= 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state >= 1);");
			$Message = "";
			$SpeedFactor    	= 0;
			$Distance    		= 0;
			$SpeedAllMin		= 0;
			$Duration1			= 0;
			$Duration2			= 0;
			$consumption1		= 0;
			$consumption2		= 0;
				
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				$Message = "<span class='rouge'>".$LNG['fleet_ajax_8']."</span>";
			}elseif($PLANET[$resource[224]] == 0){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][224])."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(Config::get('adm_attack') == 1 && $Opponent['authattack'] > $USER['authlevel']) {
				echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_578'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['NoobPlayer']){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_539'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['StrongPlayer']){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_540'], $Opponent['username'])."</span>";
			}else{
				$fleetArray			= array(224 => 1);
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
			}
			
			$Messages = empty($Message) ? true : false;
			$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
			$array = array("distance"=>$Distance,"vitesse"=>100,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>0,"tab_equipage"=>array("soldat"=>0,"technicien"=>0,"scientifique"=>0,"pilote"=>0,"antaris"=>0),"tab_hangar"=>array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0,"9"=>0),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
		}elseif($onglet_page == "recycler"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$appareil_209			= HTTP::_GP('appareil_209', 0);
			$appareil_223			= HTTP::_GP('appareil_223', 0);
			$appareil_219			= HTTP::_GP('appareil_219', 0);
			$Message 				= "";
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$totalCapa				= ($pricelist[209]['capacity'] * $appareil_209) + ($pricelist[223]['capacity'] * $appareil_223) + ($pricelist[219]['capacity'] * $appareil_219);
			$fleetArray				= array();
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(($appareil_209 + $appareil_223 + $appareil_219) == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif($appareil_209 > $PLANET[$resource[209]]){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][209])."</span>";
			}elseif($appareil_223 > $PLANET[$resource[223]]){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][223])."</span>";
			}elseif($appareil_219 > $PLANET[$resource[219]]){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][219])."</span>";
			}else{
				$fleetArray			= array(209 => $appareil_209, 223 => $appareil_223, 219 => $appareil_219);
				$fleetArray			= array_filter($fleetArray);
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$totalCapa			-= ($consumption1 + $consumption2);
			}
			
			$Messages = empty($Message) ? true : false;
			$showGood = empty($Opponent) ? sprintf($LNG['NOUVEAUTE_613'], $TargetSystem, $TargetPlanet) : sprintf($LNG['NOUVEAUTE_614'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']);
			$Messages1 = empty($Message) ? $showGood : $Message;
			$array = array("distance"=>$Distance,"vitesse"=>100,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>$totalCapa,"tab_equipage"=>array("soldat"=>0,"technicien"=>0,"scientifique"=>0,"pilote"=>0,"antaris"=>0),"tab_hangar"=>array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0,"9"=>0),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
			
		}elseif($onglet_page == "pactiser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$OpponentID.");");
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							$Messages = empty($Message) ? true : false;
							$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
							$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity-5-10),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
							
							echo json_encode($array);
							return false;
						}
						
					}
				}
			}
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				$Message = "<span class='rouge'>".$LNG['fleet_ajax_13']."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_586'], $Opponent['username'])."</span>";
			}elseif(5 > $PLANET[$resource[305]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][305])."</span>";
			}elseif((10 + $soldat) > $PLANET[$resource[306]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
			}elseif($technicien > $PLANET[$resource[302]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
			}elseif($scientifique > $PLANET[$resource[303]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
			}elseif($pilote > $PLANET[$resource[308]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
			}elseif($antaris > $PLANET[$resource[309]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][309])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
					
					$group[$vaisseauID] = $count;
				}
				$fleetArray			= $group;
				//$fleetArray			= array_filter($fleetArray);
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				
				
			}
			
			if($getShipCount == 0)
				$freecapa = max(0,($freecapacity-5-10));
			else
				$freecapa = ($freecapacity-5-10) - $consumption1 - $consumption2;
			
			$Messages = empty($Message) ? true : false;
			$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_552'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
			$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>$freecapa,"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
		}elseif($onglet_page == "coloniser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$OpponentID.");");
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							$Messages = empty($Message) ? true : false;
							$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
							$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity-10-100),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
							
							echo json_encode($array);
							return false;
						}
						
					}
				}
			}
			$iPlanetCount 	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `id_owner` = '".$USER['id']."' AND `planet_type` = '1' AND `destruyed` = '0';");
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(!empty($Opponent)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_562'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif($iPlanetCount >= 10){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_567']."</span>";
			}elseif((100 + $soldat) > $PLANET[$resource[306]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
			}elseif($technicien > $PLANET[$resource[302]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
			}elseif(10 + $scientifique > $PLANET[$resource[303]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
			}elseif($pilote > $PLANET[$resource[308]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
			}elseif($antaris > $PLANET[$resource[309]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][309])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
					
					$group[$vaisseauID] = $count;
				}
				$fleetArray			= $group;
				//$fleetArray			= array_filter($fleetArray);
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				
				
			}
			 
			if($getShipCount == 0)
				$freecapa = max(0,($freecapacity-10-100));
			else
				$freecapa = ($freecapacity-10-100) - $consumption1 - $consumption2;
			
			$Messages = empty($Message) ? true : false;
			$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_623'], $TargetSystem, $TargetPlanet) : $Message;
			$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>$freecapa,"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
		}elseif($onglet_page == "baser_vr"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= 100;
			$appareil_209			= HTTP::_GP('appareil_209', 0);
			$appareil_223			= HTTP::_GP('appareil_223', 0);
			$appareil_219			= HTTP::_GP('appareil_219', 0);
			$Message 				= "";
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$totalCapa				= ($pricelist[209]['capacity'] * $appareil_209) + ($pricelist[223]['capacity'] * $appareil_223) + ($pricelist[219]['capacity'] * $appareil_219);
			$fleetArray				= array();
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.id as pids, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state = 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state = 1);");
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['pids'] == $PLANET['id']){
				$Message = "<span class='rouge'>".$LNG['fleet_ajax_19']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(empty($SelectCount) && $Opponent['id'] != $USER['id']){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_577'], $Opponent['username'])."</span>";
			}elseif(($appareil_209 + $appareil_223 + $appareil_219) == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif($appareil_209 > $PLANET[$resource[209]]){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][209])."</span>";
			}elseif($appareil_223 > $PLANET[$resource[223]]){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][223])."</span>";
			}elseif($appareil_219 > $PLANET[$resource[219]]){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][219])."</span>";
			}else{
				$fleetArray			= array(209 => $appareil_209, 223 => $appareil_223, 219 => $appareil_219);
				$fleetArray			= array_filter($fleetArray);
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$totalCapa			-= ($consumption1 + $consumption2);
			}
			
			$Messages = empty($Message) ? true : false;
			$showGood = sprintf($LNG['NOUVEAUTE_627'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']);
			$Messages1 = empty($Message) ? $showGood : $Message;
			$array = array("distance"=>$Distance,"vitesse"=>100,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>0,"carburant_aller"=>$consumption1,"carburant_retour"=>0,"fret_restant"=>$totalCapa,"tab_equipage"=>array("soldat"=>0,"technicien"=>0,"scientifique"=>0,"pilote"=>0,"antaris"=>0),"tab_hangar"=>array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0,"9"=>0),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
			
		}elseif($onglet_page == "baser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$avaible_fleets 		= array(202,203,210,224,225,226,221,222);;
			$avaible_pop 			= array(301,302,303,304,305,306,307,308,309);
			$avaible_res 			= array('fer', 'oro', 'cristal', 'elyrium');
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			
			foreach($avaible_fleets as $fleetId){
				$appareil[$fleetId]	= HTTP::_GP('appareil_'.$fleetId, 0);
			}
			foreach($avaible_pop as $popId){
				$population[$popId]	= HTTP::_GP('population_'.$popId, 0);
			}
			foreach($avaible_res as $resId){
				$ressourcen[$resId]	= HTTP::_GP('ressource_'.$resId, 0);
			}
			
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal, p.id as pids FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$OpponentID.");");
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
							
							if(($technicien + $population[302]) > $PLANET[$resource[302]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif(($scientifique + $population[303]) > $PLANET[$resource[303]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif($population[304] > $PLANET[$resource[304]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][304])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif($population[305] > $PLANET[$resource[305]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][305])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif(($soldat + $population[306]) > $PLANET[$resource[306]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif($population[307] > $PLANET[$resource[307]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][307])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif(($pilote + $population[308]) > $PLANET[$resource[308]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}
				
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							$Messages = empty($Message) ? true : false;
							$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
							$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
							
							echo json_encode($array);
							return false;
						}
						
					}
				}
			}
			
			$resourcensArray = array(901,902,903,904);
			$startResId		 = 0;
			foreach($ressourcen as $resId => $count){
				if($count == 0)
					continue;
				
				if($resId == "fer")
					$resId = 901;
				elseif($resId == "oro")
					$resId = 902;
				elseif($resId == "cristal")
					$resId = 903;
				elseif($resId == "elyrium")
					$resId = 904;
					
				$freecapacity 			-= $count;
				if($count > $PLANET[$resource[$resId]]){
					$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$resId])."</span>";
					$Messages = empty($Message) ? true : false;
					$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
					$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
					echo json_encode($array);
					return false;
				}
			$startResId += 1;
			}
			
			foreach($appareil as $fleetId => $count){
				if($count == 0)
					continue;
				
				$freecapacity 			-= $count;
				if($count > $PLANET[$resource[$fleetId]]){
					$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$fleetId])."</span>";
					$Messages = empty($Message) ? true : false;
					$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
					$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
					echo json_encode($array);
					return false;
				}
			}
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id_owner'] != $USER['id']){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_634']."</span>";
			}elseif($Opponent['pids'] == $PLANET['id']){
				$Message = "<span class='rouge'>".$LNG['fleet_ajax_13']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
						
					$group[$vaisseauID] = $count;
				}
				$fleetArray			= $group;
				//$fleetArray			= array_filter($fleetArray);
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
					
				if($getShipCount == 0)
					$freecapacity = max(0,$freecapacity);
				else
					$freecapacity = $freecapacity - $consumption1 - $consumption2;
				
				if($freecapacity < 0) {
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_636']."</span>";
				}else{
				}
			}
			
			
			$Messages = empty($Message) ? true : false;
			$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_635'], $Opponent['name'], $TargetSystem, $TargetPlanet) : $Message;
			$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>$freecapacity,"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
		}elseif($onglet_page == "transporter"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$avaible_fleets 		= array(202,203,210,224,225,226,221,222);;
			$avaible_pop 			= array(301,302,303,304,305,306,307,308,309);
			$avaible_res 			= array('fer', 'oro', 'cristal', 'elyrium');
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			
			foreach($avaible_fleets as $fleetId){
				$appareil[$fleetId]	= HTTP::_GP('appareil_'.$fleetId, 0);
			}
			foreach($avaible_pop as $popId){
				$population[$popId]	= HTTP::_GP('population_'.$popId, 0);
			}
			foreach($avaible_res as $resId){
				$ressourcen[$resId]	= HTTP::_GP('ressource_'.$resId, 0);
			}
			
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal, p.id as pids FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state = 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state = 1);");
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
							
							if(($technicien + $population[302]) > $PLANET[$resource[302]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif(($scientifique + $population[303]) > $PLANET[$resource[303]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif($population[304] > $PLANET[$resource[304]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][304])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif($population[305] > $PLANET[$resource[305]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][305])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif(($soldat + $population[306]) > $PLANET[$resource[306]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif($population[307] > $PLANET[$resource[307]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][307])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}elseif(($pilote + $population[308]) > $PLANET[$resource[308]]){
								$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
								echo json_encode($array);
								return false;
							}
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							$Messages = empty($Message) ? true : false;
							$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
							$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
							
							echo json_encode($array);
							return false;
						}
						
					}
				}
			}
			
			$resourcensArray = array(901,902,903,904);
			$startResId		 = 0;
			foreach($ressourcen as $resId => $count){
				if($count == 0)
					continue;
				
				if($resId == "fer")
					$resId = 901;
				elseif($resId == "oro")
					$resId = 902;
				elseif($resId == "cristal")
					$resId = 903;
				elseif($resId == "elyrium")
					$resId = 904;
					
				$freecapacity 			-= $count;
				if($count > $PLANET[$resource[$resId]]){
					$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$resId])."</span>";
					$Messages = empty($Message) ? true : false;
					$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
					$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
					echo json_encode($array);
					return false;
				}
			$startResId += 1;
			}
			
			foreach($appareil as $fleetId => $count){
				if($count == 0)
					continue;
				
				$freecapacity 			-= $count;
				if($count > $PLANET[$resource[$fleetId]]){
					$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$fleetId])."</span>";
					$Messages = empty($Message) ? true : false;
					$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
					$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
					echo json_encode($array);
					return false;
				}
			}
			
			foreach($population as $popId => $count){
				if($count == 0)
					continue;
				
				$countBis	= 0;
				if($popId == 302)
					$countBis = $technicien;
				elseif($popId == 303)
					$countBis = $scientifique;
				elseif($popId == 306)
					$countBis = $soldat;
				elseif($popId == 308)
					$countBis = $pilote;
				elseif($popId == 309)
					$countBis = $antaris;
				$freecapacity 			-= $count;
				if(($count+$countBis) > $PLANET[$resource[$popId]]){
					$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$popId])."</span>";
					$Messages = empty($Message) ? true : false;
					$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
					$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));			
					echo json_encode($array);
					return false;
				}
			}
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(empty($SelectCount) && $USER['id'] != $Opponent['id']){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_577'], $Opponent['username'])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
						
					$group[$vaisseauID] = $count;
				}
				$fleetArray			= $group;
				//$fleetArray			= array_filter($fleetArray);
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
					
				if($getShipCount == 0)
					$freecapacity = max(0,$freecapacity);
				else
					$freecapacity = $freecapacity - $consumption1 - $consumption2;
				
				if($freecapacity < 0) {
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_636']."</span>";
				}else{
				}
			}
			
			
			$Messages = empty($Message) ? true : false;
			$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_635'], $Opponent['name'], $TargetSystem, $TargetPlanet) : $Message;
			$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>$freecapacity,"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
		}elseif($onglet_page == "attaquer"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$appareil_226			= HTTP::_GP('appareil_226', 0);
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal, p.id as pids, p.system, p.planet FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$IsNoobProtec			= CheckNoobProtec($USER, $Opponent, $Opponent);
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state >= 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state >= 1);");
			$CountBash	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".LOG_FLEETS."
			WHERE fleet_owner = ".$USER['id']." 
			AND fleet_end_galaxy = 1 
			AND fleet_end_system = ".$TargetSystem." 
			AND fleet_end_planet = ".$TargetPlanet." 
			AND fleet_state != 2 
			AND fleet_start_time > ".(TIMESTAMP - BASH_TIME)." 
			AND fleet_mission = 1;");
			
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							$Messages = empty($Message) ? true : false;
							$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
							$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>($freecapacity-$appareil_226),"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
							
							echo json_encode($array);
							return false;
						}
						
					}
				}
			}
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				$Message = "<span class='rouge'>".$LNG['fleet_ajax_13']."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(FleetFunctions::CheckBash($Opponent['pids'])){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_588'], $Opponent['username'])."</span>";
			}elseif(Config::get('adm_attack') == 1 && $Opponent['authattack'] > $USER['authlevel']) {
				echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP || FleetFunctions::CheckBash($Opponent['pids']) || !isModulAvalible(MODULE_MISSION_ATTACK)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_578'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['NoobPlayer']){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_539'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['StrongPlayer']){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_540'], $Opponent['username'])."</span>";
			}elseif($appareil_226 > $PLANET[$resource[226]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][226])."</span>";
			}elseif($soldat > $PLANET[$resource[306]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
			}elseif($technicien > $PLANET[$resource[302]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
			}elseif($scientifique > $PLANET[$resource[303]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
			}elseif($pilote > $PLANET[$resource[308]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
			}elseif($antaris > $PLANET[$resource[309]]){
				$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][309])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
						
					$group[$vaisseauID] = $count;
				}
				$fleetArray			= $group;
				//$fleetArray			= array_filter($fleetArray);
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
					
				if($getShipCount == 0)
					$freecapacity = max(0,($freecapacity-$appareil_226));
				else
					$freecapacity = $freecapacity - $consumption1 - $consumption2 - $appareil_226;
				
				if($freecapacity < 0) {
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_636']."</span>";
				}else{
				}
			}
			
			
			$Messages = empty($Message) ? true : false;
			$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_648'], $Opponent['name'], $Opponent['system'], $Opponent['planet'], $Opponent['username']) : $Message;
			$array = array("distance"=>$Distance,"vitesse"=>$TotalMaxSpeed,"hyperespace"=>true,"temps_trajet_aller"=>$Duration1,"temps_trajet_retour"=>$Duration2,"carburant_aller"=>$consumption1,"carburant_retour"=>$consumption2,"fret_restant"=>$freecapacity,"tab_equipage"=>array("soldat"=>$soldat,"technicien"=>$technicien,"scientifique"=>$scientifique,"pilote"=>$pilote,"antaris"=>$antaris),"tab_hangar"=>array("1"=>$hangar_1,"2"=>$hangar_2,"3"=>$hangar_3,"4"=>$hangar_4,"5"=>$hangar_5,"6"=>$hangar_6,"7"=>$hangar_7,"8"=>$hangar_8,"9"=>$hangar_9),"formulaire"=>array("correct"=>$Messages,"message"=>"".$Messages1.""));
		}
			
		echo json_encode($array);
	}
	
	function envoyerMission()
	{
		global $PLANET, $LNG, $UNI, $CONF, $USER, $resource, $pricelist;
		
		$onglet_page 					= HTTP::_GP('onglet_page', "", UTF8_SUPPORT);
		$specialized					= array();
		if($onglet_page == "espionner"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$SpeedFactor    	= 0;
			$Distance    		= 0;
			$SpeedAllMin		= 0;
			$Duration1			= 0;
			$Duration2			= 0;
			$consumption1		= 0;
			$consumption2		= 0;
			$targetMission			= 6;
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, p.name, p.system, p.planet, u.urlaubs_modus, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.destruyed, p.teleport_portal, p.id as pids FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$IsNoobProtec		= CheckNoobProtec($USER, $Opponent, $Opponent);
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state >= 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state >= 1);");
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fleet_ajax_8']."</span>";
			}elseif($PLANET[$resource[224]] == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][224])."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(Config::get('adm_attack') == 1 && $Opponent['authattack'] > $USER['authlevel']) {
				echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_578'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['NoobPlayer']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_539'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['StrongPlayer']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_540'], $Opponent['username'])."</span>";
			}else{
				$fleetArray			= array(224 => 1);
				$UserDeuterium  	= $PLANET['elyrium'];
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				
				if($UserDeuterium - ($consumption1 + $consumption2) < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fa_not_enough_fuel']."</span>";
				}elseif(($consumption1 + $consumption2) > FleetFunctions::GetFleetRoom($fleetArray)) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_636']."</span>";
				}else{	
					
					$PLANET['elyrium']   	-= ($consumption1 + $consumption2);
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".($consumption1 + $consumption2)."' WHERE id = ".$PLANET['id']." ;");
			
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
					
					$fleetStartTime		= $Duration1 + TIMESTAMP;
					$fleetStayTime		= $fleetStartTime;
					$fleetEndTime		= $fleetStayTime + $Duration2;
					
					$shipID				= array_keys($fleetArray);
					FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $Opponent['id'], $Opponent['pids'], 1, $TargetSystem, $TargetPlanet, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
				
					$Message = "<span class='vert'>".sprintf($LNG['fleet_ajax_9'], $Opponent['name'], $Opponent['system'],$Opponent['planet'])."</span>";
				}
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=6">'.$LNG['NOUVEAUTE_545'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "recycler"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$appareil_209			= HTTP::_GP('appareil_209', 0);
			$appareil_223			= HTTP::_GP('appareil_223', 0);
			$appareil_219			= HTTP::_GP('appareil_219', 0);
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$targetMission			= 8;
			$totalCapa				= ($pricelist[209]['capacity'] * $appareil_209) + ($pricelist[223]['capacity'] * $appareil_223) + ($pricelist[219]['capacity'] * $appareil_219);
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, p.name, p.system, p.planet, u.urlaubs_modus, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.destruyed, p.teleport_portal, p.id as pids FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(($appareil_209 + $appareil_223 + $appareil_219) == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif($appareil_209 > $PLANET[$resource[209]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][209])."</span>";
			}elseif($appareil_223 > $PLANET[$resource[223]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][223])."</span>";
			}elseif($appareil_219 > $PLANET[$resource[219]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][219])."</span>";
			}else{
				$fleetArray			= array(209 => $appareil_209, 223 => $appareil_223, 219 => $appareil_219);
				$fleetArray			= array_filter($fleetArray);
				$UserDeuterium  	= $PLANET['elyrium'];
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$totalCapa			-= ($consumption1 + $consumption2);
				if($UserDeuterium - ($consumption1 + $consumption2) < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fa_not_enough_fuel']."</span>";
				}elseif(($consumption1 + $consumption2) > FleetFunctions::GetFleetRoom($fleetArray)) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_636']."</span>";
				}else{	
					
					$PLANET['elyrium']   	-= ($consumption1 + $consumption2);
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".($consumption1 + $consumption2)."' WHERE id = ".$PLANET['id']." ;");
			
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
					
					$fleetStartTime		= $Duration1 + TIMESTAMP;
					$fleetStayTime		= $fleetStartTime;
					$fleetEndTime		= $fleetStayTime + $Duration2;
					
					$shipID				= array_keys($fleetArray);		

					$targetPlayerData	= array(
						'id'				=> 0,
						'id_owner'			=> 0,
					);
					
					if(empty($Opponent))
						FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $targetPlayerData['id_owner'], $targetPlayerData['id'], 1, $TargetSystem, $TargetPlanet, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
					else
						FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $Opponent['id'], $Opponent['pids'], 1, $TargetSystem, $TargetPlanet, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
					
					$shipAmount	= ($appareil_209 + $appareil_223 + $appareil_219);
					if(empty($Opponent))
						$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_617'], pretty_number($shipAmount), $TargetSystem, $TargetPlanet, $LNG['type_missionbis'][8])."</span>";
					else
						$Message = "<span class='vert'>".sprintf($LNG['fleet_ajax_16'], pretty_number($shipAmount), $Opponent['name'], $Opponent['system'], $Opponent['planet'], $LNG['type_missionbis'][8])."</span>";
				}
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=8">'.$LNG['NOUVEAUTE_616'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "pactiser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal, p.system, p.planet, p.id as pids FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$OpponentID.");");
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=12">'.$LNG['NOUVEAUTE_553'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
							return false;
						}
						
					}
				}
			}
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fleet_ajax_13']."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_586'], $Opponent['username'])."</span>";
			}elseif(5 > $PLANET[$resource[305]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][305])."</span>";
			}elseif((10 + $soldat) > $PLANET[$resource[306]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
			}elseif($technicien > $PLANET[$resource[302]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
			}elseif($scientifique > $PLANET[$resource[303]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
			}elseif($pilote > $PLANET[$resource[308]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
			}elseif($antaris > $PLANET[$resource[309]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][309])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
					
					$group[$vaisseauID] = $count;
				}
				
				$fleetArray			= $group;
				$fleetArray			= array_filter($fleetArray);
				$UserDeuterium  	= $PLANET['elyrium'];
				$targetMission		= 12;
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				
				$freecapa = ($freecapacity-5-10) - $consumption1 - $consumption2;
				
				if($UserDeuterium - ($consumption1 + $consumption2) < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fa_not_enough_fuel']."</span>";
				}elseif($freecapa < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_636']."</span>";
				}else{	
					
					$PLANET['elyrium']   	-= ($consumption1 + $consumption2);
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".($consumption1 + $consumption2)."' WHERE id = ".$PLANET['id']." ;");
			
					$fleetRessource	= array(
						901	=> 0,
						902	=> 0,
						903	=> 0,
						904	=> 0,
					);
					$fleetPopulation	= array(
						301	=> 0,
						302	=> $technicien,
						303	=> $scientifique,
						304	=> 0,
						305	=> 5,
						306	=> ($soldat+10),
						307	=> 0,
						308	=> $pilote,
						309	=> $antaris,
					);

					$PLANET[$resource[301]]	-= $fleetPopulation[301];
					$PLANET[$resource[302]]	-= $fleetPopulation[302];
					$PLANET[$resource[303]]	-= $fleetPopulation[303];
					$PLANET[$resource[304]]	-= $fleetPopulation[304];
					$PLANET[$resource[305]]	-= $fleetPopulation[305];
					$PLANET[$resource[306]]	-= $fleetPopulation[306];
					$PLANET[$resource[307]]	-= $fleetPopulation[307];
					$PLANET[$resource[308]]	-= $fleetPopulation[308];
					$PLANET[$resource[309]]	-= $fleetPopulation[309];
					
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[301]." = ".$resource[301]." - ".$fleetPopulation[301].", ".$resource[302]." = ".$resource[302]." - ".$fleetPopulation[302].", ".$resource[303]." = ".$resource[303]." - ".$fleetPopulation[303].", ".$resource[304]." = ".$resource[304]." - ".$fleetPopulation[304].", ".$resource[305]." = ".$resource[305]." - ".$fleetPopulation[305].", ".$resource[306]." = ".$resource[306]." - ".$fleetPopulation[306].", ".$resource[307]." = ".$resource[307]." - ".$fleetPopulation[307].", ".$resource[308]." = ".$resource[308]." - ".$fleetPopulation[308].", ".$resource[309]." = ".$resource[309]." - ".$fleetPopulation[309]."	WHERE id = ".$PLANET['id'].";"); 
					
					$fleetStartTime		= $Duration1 + TIMESTAMP;
					$fleetStayTime		= $fleetStartTime;
					$fleetEndTime		= $fleetStayTime + $Duration2;
					
					$shipID				= array_keys($fleetArray);
					
					FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $Opponent['id'], $Opponent['pids'], 1, $TargetSystem, $TargetPlanet, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
					
					$Message = "<span class='vert'>".sprintf($LNG['fleet_ajax_16'], pretty_number($getShipCount), $Opponent['name'], $Opponent['system'], $Opponent['planet'], $LNG['type_missionbis'][12])."</span>";
				}
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=12">'.$LNG['NOUVEAUTE_553'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "coloniser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$OpponentID.");");
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=7">'.$LNG['NOUVEAUTE_553'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
							return false;
						}
						
					}
				}
			}
			$iPlanetCount 	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `id_owner` = '".$USER['id']."' AND `planet_type` = '1' AND `destruyed` = '0';");
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(!empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_562'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif($iPlanetCount >= 10){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_567']."</span>";
			}elseif((100 + $soldat) > $PLANET[$resource[306]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
			}elseif($technicien > $PLANET[$resource[302]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
			}elseif(10 + $scientifique > $PLANET[$resource[303]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
			}elseif($pilote > $PLANET[$resource[308]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
			}elseif($antaris > $PLANET[$resource[309]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][309])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
					
					$group[$vaisseauID] = $count;
				}
				
				$fleetArray			= $group;
				$fleetArray			= array_filter($fleetArray);
				$UserDeuterium  	= $PLANET['elyrium'];
				$targetMission		= 7;
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				
				$freecapa = ($freecapacity-10-100) - $consumption1 - $consumption2;
				
				if($UserDeuterium - ($consumption1 + $consumption2) < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fa_not_enough_fuel']."</span>";
				}elseif($freecapa < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_636']."</span>";
				}else{	
					
					$PLANET['elyrium']   	-= ($consumption1 + $consumption2);
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".($consumption1 + $consumption2)."' WHERE id = ".$PLANET['id']." ;");
			
					$fleetRessource	= array(
						901	=> 0,
						902	=> 0,
						903	=> 0,
						904	=> 0,
					);
					$fleetPopulation	= array(
						301	=> 0,
						302	=> $technicien,
						303	=> ($scientifique+10),
						304	=> 0,
						305	=> 0,
						306	=> ($soldat+100),
						307	=> 0,
						308	=> $pilote,
						309	=> $antaris,
					);

					$PLANET[$resource[301]]	-= $fleetPopulation[301];
					$PLANET[$resource[302]]	-= $fleetPopulation[302];
					$PLANET[$resource[303]]	-= $fleetPopulation[303];
					$PLANET[$resource[304]]	-= $fleetPopulation[304];
					$PLANET[$resource[305]]	-= $fleetPopulation[305];
					$PLANET[$resource[306]]	-= $fleetPopulation[306];
					$PLANET[$resource[307]]	-= $fleetPopulation[307];
					$PLANET[$resource[308]]	-= $fleetPopulation[308];
					$PLANET[$resource[309]]	-= $fleetPopulation[309];
					
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[301]." = ".$resource[301]." - ".$fleetPopulation[301].", ".$resource[302]." = ".$resource[302]." - ".$fleetPopulation[302].", ".$resource[303]." = ".$resource[303]." - ".$fleetPopulation[303].", ".$resource[304]." = ".$resource[304]." - ".$fleetPopulation[304].", ".$resource[305]." = ".$resource[305]." - ".$fleetPopulation[305].", ".$resource[306]." = ".$resource[306]." - ".$fleetPopulation[306].", ".$resource[307]." = ".$resource[307]." - ".$fleetPopulation[307].", ".$resource[308]." = ".$resource[308]." - ".$fleetPopulation[308].", ".$resource[309]." = ".$resource[309]." - ".$fleetPopulation[309]."	WHERE id = ".$PLANET['id'].";"); 
					
					$fleetStartTime		= $Duration1 + TIMESTAMP;
					$fleetStayTime		= $fleetStartTime;
					$fleetEndTime		= $fleetStayTime + $Duration2;
					
					$shipID				= array_keys($fleetArray);
					
					$targetPlayerData	= array(
						'id'				=> 0,
						'id_owner'			=> 0,
					);
										
					FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $targetPlayerData['id_owner'], $targetPlayerData['id'], 1, $TargetSystem, $TargetPlanet, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
					
					$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_617'], pretty_number($getShipCount), $TargetSystem, $TargetPlanet, $LNG['type_missionbis'][7])."</span>";
				}
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=7">'.$LNG['NOUVEAUTE_553'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "baser_vr"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= 100;
			$appareil_209			= HTTP::_GP('appareil_209', 0);
			$appareil_223			= HTTP::_GP('appareil_223', 0);
			$appareil_219			= HTTP::_GP('appareil_219', 0);
			$Message 				= "";
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$totalCapa				= ($pricelist[209]['capacity'] * $appareil_209) + ($pricelist[223]['capacity'] * $appareil_223) + ($pricelist[219]['capacity'] * $appareil_219);
			$fleetArray				= array();
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.id as pids, p.force_field_timer, p.system, p.planet, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state = 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state = 1);");
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['pids'] == $PLANET['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fleet_ajax_19']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(empty($SelectCount) && $Opponent['id'] != $USER['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_577'], $Opponent['username'])."</span>";
			}elseif(($appareil_209 + $appareil_223 + $appareil_219) == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif($appareil_209 > $PLANET[$resource[209]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][209])."</span>";
			}elseif($appareil_223 > $PLANET[$resource[223]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][223])."</span>";
			}elseif($appareil_219 > $PLANET[$resource[219]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $LNG['tech'][219])."</span>";
			}else{
				$fleetArray			= array(209 => $appareil_209, 223 => $appareil_223, 219 => $appareil_219);
				$fleetArray			= array_filter($fleetArray);
				$targetMission		= 17;
				$UserDeuterium  	= $PLANET['elyrium'];
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$totalCapa			-= ($consumption1 + $consumption2);
				
				if($UserDeuterium - ($consumption1 + $consumption2) < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fa_not_enough_fuel']."</span>";
				}elseif(($consumption1 + $consumption2) > FleetFunctions::GetFleetRoom($fleetArray)) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_636']."</span>";
				}else{	
					
					$PLANET['elyrium']   	-= ($consumption1 + $consumption2);
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".($consumption1 + $consumption2)."' WHERE id = ".$PLANET['id']." ;");
			
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
					
					$fleetStartTime		= $Duration1 + TIMESTAMP;
					$fleetStayTime		= $fleetStartTime;
					$fleetEndTime		= $fleetStayTime + $Duration2;
					
					$totalShips			= ($appareil_209 + $appareil_223 + $appareil_219);
					$shipID				= array_keys($fleetArray);
					FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $Opponent['id'], $Opponent['pids'], 1, $TargetSystem, $TargetPlanet, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
				
					$Message = "<span class='vert'>".sprintf($LNG['fleet_ajax_16'], $totalShips, $Opponent['name'], $Opponent['system'],$Opponent['planet'], $LNG['type_missionbis'][17])."</span>";
				}
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=9">'.$LNG['NOUVEAUTE_628'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "baser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$avaible_fleets 		= array(202,203,210,224,225,226,221,222);;
			$avaible_pop 			= array(301,302,303,304,305,306,307,308,309);
			$avaible_res 			= array('fer', 'oro', 'cristal', 'elyrium');
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			
			foreach($avaible_fleets as $fleetId){
				$appareil[$fleetId]	= HTTP::_GP('appareil_'.$fleetId, 0);
			}
			foreach($avaible_pop as $popId){
				$population[$popId]	= HTTP::_GP('population_'.$popId, 0);
			}
			foreach($avaible_res as $resId){
				$ressourcen[$resId]	= HTTP::_GP('ressource_'.$resId, 0);
			}
			
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal, p.id as pids, p.system, p.planet FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$OpponentID.");");
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
							
							if(($technicien + $population[302]) > $PLANET[$resource[302]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif(($scientifique + $population[303]) > $PLANET[$resource[303]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif($population[304] > $PLANET[$resource[304]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][304])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;;
							}elseif($population[305] > $PLANET[$resource[305]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][305])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif(($soldat + $population[306]) > $PLANET[$resource[306]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif($population[307] > $PLANET[$resource[307]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][307])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif(($pilote + $population[308]) > $PLANET[$resource[308]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
							return false;
						}
						
					}
				}
			}

			$resourcensArray = array(901,902,903,904);
			$startResId		 = 0;
			foreach($ressourcen as $resId => $count){
				if($count == 0)
					continue;
				
				if($resId == "fer")
					$resId = 901;
				elseif($resId == "oro")
					$resId = 902;
				elseif($resId == "cristal")
					$resId = 903;
				elseif($resId == "elyrium")
					$resId = 904;
					
				$freecapacity 			-= $count;
				if($count > $PLANET[$resource[$resId]]){
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$resId])."</span>";
					echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					return false;
				}
			$startResId += 1;
			}
			
			foreach($appareil as $fleetId => $count){
				if($count == 0)
					continue;
				$freecapacity 			-= $count;
				if($count > $PLANET[$resource[$fleetId]]){
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$fleetId])."</span>";
					echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					return false;
				}
			}
			
			foreach($population as $popId => $count){
				
				if($count == 0)
					continue;
				
				$countBis	= 0;
				if($popId == 302)
					$countBis = $technicien;
				elseif($popId == 303)
					$countBis = $scientifique;
				elseif($popId == 306)
					$countBis = $soldat;
				elseif($popId == 308)
					$countBis = $pilote;
				elseif($popId == 309)
					$countBis = $antaris;
				$freecapacity 			-= $count;
				if(($count+$countBis) > $PLANET[$resource[$popId]]){
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$popId])."</span>";
					echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					return false;
				}
			}
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id_owner'] != $USER['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_634']."</span>";
			}elseif($Opponent['pids'] == $PLANET['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fleet_ajax_13']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
						
					$group[$vaisseauID] = $count;
				}
				$group2 = array();
				foreach($appareil as $fleetId => $count){
					if($count == 0)
						continue;
						
					$group2[$fleetId] = $count;
				}
				$fleetArray			= $group;
				$specialized		= $group2;
				//$fleetArray		= array_filter($fleetArray);
				$UserDeuterium  	= $PLANET['elyrium'];
				$targetMission		= 4;
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
					
				if($getShipCount == 0)
					$freecapacity = max(0,$freecapacity);
				else
					$freecapacity = $freecapacity - $consumption1 - $consumption2;
				
				if($freecapacity < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_636']."</span>";
				}elseif($UserDeuterium - ($consumption1 + $consumption2) < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fa_not_enough_fuel']."</span>";
				}else{	
					
					$PLANET['elyrium']   	-= ($consumption1 + $consumption2);
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".($consumption1 + $consumption2)."' WHERE id = ".$PLANET['id']." ;");
			
					$fleetRessource	= array(
						901	=> $ressourcen["fer"],
						902	=> $ressourcen["oro"],
						903	=> $ressourcen["cristal"],
						904	=> $ressourcen["elyrium"],
					);
					$fleetPopulation	= array(
						301	=> $population[301],
						302	=> ($population[302] + $technicien),
						303	=> ($population[303] + $scientifique),
						304	=> $population[304],
						305	=> $population[305],
						306	=> ($population[306] + $soldat),
						307	=> $population[307],
						308	=> ($population[308] + $pilote),
						309	=> ($population[309] + $antaris),
					);

					$PLANET[$resource[301]]	-= $fleetPopulation[301];
					$PLANET[$resource[302]]	-= $fleetPopulation[302];
					$PLANET[$resource[303]]	-= $fleetPopulation[303];
					$PLANET[$resource[304]]	-= $fleetPopulation[304];
					$PLANET[$resource[305]]	-= $fleetPopulation[305];
					$PLANET[$resource[306]]	-= $fleetPopulation[306];
					$PLANET[$resource[307]]	-= $fleetPopulation[307];
					$PLANET[$resource[308]]	-= $fleetPopulation[308];
					$PLANET[$resource[309]]	-= $fleetPopulation[309];
					
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[301]." = ".$resource[301]." - ".$fleetPopulation[301].", ".$resource[302]." = ".$resource[302]." - ".$fleetPopulation[302].", ".$resource[303]." = ".$resource[303]." - ".$fleetPopulation[303].", ".$resource[304]." = ".$resource[304]." - ".$fleetPopulation[304].", ".$resource[305]." = ".$resource[305]." - ".$fleetPopulation[305].", ".$resource[306]." = ".$resource[306]." - ".$fleetPopulation[306].", ".$resource[307]." = ".$resource[307]." - ".$fleetPopulation[307].", ".$resource[308]." = ".$resource[308]." - ".$fleetPopulation[308].", ".$resource[309]." = ".$resource[309]." - ".$fleetPopulation[309]."	WHERE id = ".$PLANET['id'].";"); 
					
					$fleetStartTime		= $Duration1 + TIMESTAMP;
					$fleetStayTime		= $fleetStartTime;
					$fleetEndTime		= $fleetStayTime + $Duration2;
					
					$shipID				= array_keys($fleetArray);
					 
					FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $Opponent['id'], $Opponent['pids'], 1, $TargetSystem, $TargetPlanet, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
					
					$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_587'], pretty_number($getShipCount), $Opponent['name'], $Opponent['system'], $Opponent['planet'], $LNG['type_missionbis'][4])."</span>";
				}
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "transporter"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$avaible_fleets 		= array(202,203,210,224,225,226,221,222);;
			$avaible_pop 			= array(301,302,303,304,305,306,307,308,309);
			$avaible_res 			= array('fer', 'oro', 'cristal', 'elyrium');
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			
			foreach($avaible_fleets as $fleetId){
				$appareil[$fleetId]	= HTTP::_GP('appareil_'.$fleetId, 0);
			}
			foreach($avaible_pop as $popId){
				$population[$popId]	= HTTP::_GP('population_'.$popId, 0);
			}
			foreach($avaible_res as $resId){
				$ressourcen[$resId]	= HTTP::_GP('ressource_'.$resId, 0);
			}
			
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal, p.id as pids, p.system, p.planet FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$OpponentID.");");
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
							
							if(($technicien + $population[302]) > $PLANET[$resource[302]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif(($scientifique + $population[303]) > $PLANET[$resource[303]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif($population[304] > $PLANET[$resource[304]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][304])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;;
							}elseif($population[305] > $PLANET[$resource[305]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][305])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif(($soldat + $population[306]) > $PLANET[$resource[306]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif($population[307] > $PLANET[$resource[307]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][307])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}elseif(($pilote + $population[308]) > $PLANET[$resource[308]]){
								$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
								$Messages = empty($Message) ? true : false;
								$Messages1 = empty($Message) ? sprintf($LNG['NOUVEAUTE_597'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username']) : $Message;
								echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=4">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
								return false;
							}
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=3">'.$LNG['NOUVEAUTE_637'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
							return false;
						}
						
					}
				}
			}

			$resourcensArray = array(901,902,903,904);
			$startResId		 = 0;
			foreach($ressourcen as $resId => $count){
				if($count == 0)
					continue;
				
				if($resId == "fer")
					$resId = 901;
				elseif($resId == "oro")
					$resId = 902;
				elseif($resId == "cristal")
					$resId = 903;
				elseif($resId == "elyrium")
					$resId = 904;
					
				$freecapacity 			-= $count;
				if($count > $PLANET[$resource[$resId]]){
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$resId])."</span>";
					echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=3">'.$LNG['NOUVEAUTE_637'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					return false;
				}
			$startResId += 1;
			}
			
			foreach($appareil as $fleetId => $count){
				if($count == 0)
					continue;
				
				$freecapacity 			-= $count;
				if($count > $PLANET[$resource[$fleetId]]){
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$fleetId])."</span>";
					echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=3">'.$LNG['NOUVEAUTE_637'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					return false;
				}
			}
			
			foreach($population as $popId => $count){
				if($count == 0)
					continue;
				
				$countBis	= 0;
				if($popId == 302)
					$countBis = $technicien;
				elseif($popId == 303)
					$countBis = $scientifique;
				elseif($popId == 306)
					$countBis = $soldat;
				elseif($popId == 308)
					$countBis = $pilote;
				elseif($popId == 309)
					$countBis = $antaris;
				$freecapacity 			-= $count;
				if(($count+$countBis) > $PLANET[$resource[$popId]]){
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$popId])."</span>";
					echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=3">'.$LNG['NOUVEAUTE_637'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					return false;
				}
			}
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(empty($SelectCount) && $USER['id'] != $Opponent['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_577'], $Opponent['username'])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
						
					$group[$vaisseauID] = $count;
				}
				
				$group2 = array();
				foreach($appareil as $fleetId => $count){
					if($count == 0)
						continue;
						
					$group2[$fleetId] = $count;
				}
				
				$fleetArray			= $group;
				$specialized		= $group2;
				//$fleetArray		= array_filter($fleetArray);
				$UserDeuterium  	= $PLANET['elyrium'];
				$targetMission		= 3;
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
					
				if($getShipCount == 0)
					$freecapacity = max(0,$freecapacity);
				else
					$freecapacity = $freecapacity - $consumption1 - $consumption2;
				
				if($freecapacity < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_636']."</span>";
				}elseif($UserDeuterium - ($consumption1 + $consumption2) < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fa_not_enough_fuel']."</span>";
				}else{	
					
					$PLANET['elyrium']   	-= ($consumption1 + $consumption2);
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".($consumption1 + $consumption2)."' WHERE id = ".$PLANET['id']." ;");
			
					$fleetRessource	= array(
						901	=> $ressourcen["fer"],
						902	=> $ressourcen["oro"],
						903	=> $ressourcen["cristal"],
						904	=> $ressourcen["elyrium"],
					);
					$fleetPopulation	= array(
						301	=> $population[301],
						302	=> ($population[302] + $technicien),
						303	=> ($population[303] + $scientifique),
						304	=> $population[304],
						305	=> $population[305],
						306	=> ($population[306] + $soldat),
						307	=> $population[307],
						308	=> ($population[308] + $pilote),
						309	=> ($population[309] + $antaris),
					);

					$PLANET[$resource[301]]	-= $fleetPopulation[301];
					$PLANET[$resource[302]]	-= $fleetPopulation[302];
					$PLANET[$resource[303]]	-= $fleetPopulation[303];
					$PLANET[$resource[304]]	-= $fleetPopulation[304];
					$PLANET[$resource[305]]	-= $fleetPopulation[305];
					$PLANET[$resource[306]]	-= $fleetPopulation[306];
					$PLANET[$resource[307]]	-= $fleetPopulation[307];
					$PLANET[$resource[308]]	-= $fleetPopulation[308];
					$PLANET[$resource[309]]	-= $fleetPopulation[309];
					
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[301]." = ".$resource[301]." - ".$fleetPopulation[301].", ".$resource[302]." = ".$resource[302]." - ".$fleetPopulation[302].", ".$resource[303]." = ".$resource[303]." - ".$fleetPopulation[303].", ".$resource[304]." = ".$resource[304]." - ".$fleetPopulation[304].", ".$resource[305]." = ".$resource[305]." - ".$fleetPopulation[305].", ".$resource[306]." = ".$resource[306]." - ".$fleetPopulation[306].", ".$resource[307]." = ".$resource[307]." - ".$fleetPopulation[307].", ".$resource[308]." = ".$resource[308]." - ".$fleetPopulation[308].", ".$resource[309]." = ".$resource[309]." - ".$fleetPopulation[309]."	WHERE id = ".$PLANET['id'].";"); 
					
					$fleetStartTime		= $Duration1 + TIMESTAMP;
					$fleetStayTime		= $fleetStartTime;
					$fleetEndTime		= $fleetStayTime + $Duration2;
					
					$shipID				= array_keys($fleetArray);
					 
					FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $Opponent['id'], $Opponent['pids'], 1, $TargetSystem, $TargetPlanet, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
					
					$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_587'], pretty_number($getShipCount), $Opponent['name'], $Opponent['system'], $Opponent['planet'], $LNG['type_missionbis'][3])."</span>";
				}
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=3">'.$LNG['NOUVEAUTE_637'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "attaquer"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$reacteur_aller			= HTTP::_GP('reacteur_aller', 100);
			$reacteur_retour		= HTTP::_GP('reacteur_retour', 100);
			$appareil_226			= HTTP::_GP('appareil_226', 0);
			$OwnShips				= explode(';', $PLANET['specialships']);	
			foreach($OwnShips as $Items)
			{
				$temp 				= explode(',', $Items);
				$vaisseau[$temp[0]]	= HTTP::_GP('vaisseau_'.$temp[0], 0);
				$hangar[$temp[0]]	= HTTP::_GP('hangar_'.$temp[0], 0);
			}
			
			$Message 				= "";
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal, p.id as pids, p.system, p.planet FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$IsNoobProtec			= CheckNoobProtec($USER, $Opponent, $Opponent);
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state >= 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state >= 1);");
			$CountBash	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".LOG_FLEETS."
			WHERE fleet_owner = ".$USER['id']." 
			AND fleet_end_galaxy = 1 
			AND fleet_end_system = ".$TargetSystem." 
			AND fleet_end_planet = ".$TargetPlanet." 
			AND fleet_state != 2 
			AND fleet_start_time > ".(TIMESTAMP - BASH_TIME)." 
			AND fleet_mission IN (1,2);");
			
			$SpeedFactor    		= 0;
			$Distance    			= 0;
			$SpeedAllMin			= 0;
			$Duration1				= 0;
			$Duration2				= 0;
			$consumption1			= 0;
			$consumption2			= 0;
			$hangar_1				= 0;
			$hangar_2				= 0;
			$hangar_3				= 0;
			$hangar_4				= 0;
			$hangar_5				= 0;
			$hangar_6				= 0;
			$hangar_7				= 0;
			$hangar_8				= 0;
			$hangar_9				= 0;
			$technicien				= 0;
			$scientifique			= 0;
			$soldat					= 0;
			$pilote					= 0;
			$antaris				= 0;
			$freecapacity			= 0;
			$fleetArray				= array();
			$ElementOwn 			= explode(';', $PLANET['specialships']);
			$getShipCount	 		= 0;
			$TotalMaxSpeed			= 0;
			$StartFleetId			= 0;
			foreach($vaisseau as $vaisseauID => $count){
				$AmountHangar	= 0;
				foreach($hangar as $hangarID => $hangarC){
					if($hangarID == $vaisseauID)
						$AmountHangar	= 	$hangarC;	
				}
						
				if($count == 0 && $AmountHangar == 0)
					continue;
				
				if(!empty($ElementOwn))
				{
					foreach($ElementOwn as $OwnShip)
					{
						$temp = explode(',', $OwnShip);
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, constructionTime, nom, composant_32, composant_33, composant_34, composant_35, composant_36, shipFret FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$temp[0].";");
						$getShipCount =+ $count;
						
						$getUserPeople = $GLOBALS['DATABASE']->getFirstRow("SELECT soldier, technician, scientist, pilots FROM ".VARS_INFRA." WHERE id = ".$getUserShip['id_infrastructure'].";");
						
						$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
						
						$liste_composant = array("32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
						
						if($vaisseauID == $temp[0]){
							$hangar_1				+= $getUserShip['composant_32']*$liste_composant[32]['valeur'];
							$hangar_2				+= $getUserShip['composant_33']*$liste_composant[33]['valeur'];
							$hangar_3				+= $getUserShip['composant_34']*$liste_composant[34]['valeur'];
							$hangar_4				+= $getUserShip['composant_35']*$liste_composant[35]['valeur'];
							$hangar_5				+= $getUserShip['composant_36']*$liste_composant[36]['valeur'];
							$hangar_6				+= 0;
							$hangar_7				+= 0;
							$hangar_8				+= 0;
							$hangar_9				+= 0;
							$technicien				+= $getUserPeople['technician']*$count;
							$scientifique			+= $getUserPeople['scientist']*$count;
							$soldat					+= $getUserPeople['soldier']*$count;
							$pilote					+= $getUserPeople['pilots']*$count;
							$antaris				+= 0;
							$freecapacity			+= ($getUserShip['shipFret']*$count);
							$freecapacity 			-= ($getUserPeople['technician']*$count) + ($getUserPeople['scientist']*$count) + ($getUserPeople['soldier']*$count) + ($getUserPeople['pilots']*$count);
							$poundA					= (int) $liste_infrastructure[$getUserShip['id_infrastructure']]['poids'];
							if($StartFleetId == 0 && ($count + $AmountHangar) > 0){
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
								$StartFleetId			+= 1;
							}else{
								$TotalMaxSpeed			= round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2) > $TotalMaxSpeed ? $TotalMaxSpeed : round(($getUserShip['shipSpeed']/$poundA*1e4/100), 2);
							}
						}
						
						if($vaisseauID == $temp[0] && ($count + $AmountHangar) > $temp[1]){
							$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_15'], $getUserShip['nom'])."</span>";
							echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=3">'.$LNG['NOUVEAUTE_637'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
							return false;
						}
						
					}
				}
			}
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif($getShipCount == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_615']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fleet_ajax_13']."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(FleetFunctions::CheckBash($Opponent['pids'])){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_588'], $Opponent['username'])."</span>";
			}elseif(Config::get('adm_attack') == 1 && $Opponent['authattack'] > $USER['authlevel']) {
				echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP || FleetFunctions::CheckBash($Opponent['pids']) || !isModulAvalible(MODULE_MISSION_ATTACK)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_578'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['NoobPlayer']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_539'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['StrongPlayer']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_540'], $Opponent['username'])."</span>";
			}elseif($appareil_226 > $PLANET[$resource[226]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][226])."</span>";
			}elseif($soldat > $PLANET[$resource[306]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
			}elseif($technicien > $PLANET[$resource[302]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][302])."</span>";
			}elseif($scientifique > $PLANET[$resource[303]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][303])."</span>";
			}elseif($pilote > $PLANET[$resource[308]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][308])."</span>";
			}elseif($antaris > $PLANET[$resource[309]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][309])."</span>";
			}else{
				$group = array();
				foreach($vaisseau as $vaisseauID => $count){
					if($count == 0)
						continue;
						
					$group[$vaisseauID] = $count;
				}
				$fleetArray			= $group;
				$specialized		= $appareil_226 > 0 ? array(226 => $appareil_226) : array();
				//$fleetArray		= array_filter($fleetArray);
				$UserDeuterium  	= $PLANET['elyrium'];
				$targetMission		= 1;
				$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
				$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array(1, $TargetSystem, $TargetPlanet));
				$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeedOwn($fleetArray, $USER);
				$Duration1			= FleetFunctions::GetMissionDuration(($reacteur_aller/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption1		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration1, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
				$Duration2			= FleetFunctions::GetMissionDuration(($reacteur_retour/10), $SpeedAllMin, $Distance, $SpeedFactor, $USER);
				$consumption2		= FleetFunctions::GetFleetConsumptionOwn($fleetArray, $Duration2, $Distance, $SpeedAllMin, $USER, $SpeedFactor);
					
				if($getShipCount == 0)
					$freecapacity = max(0,($freecapacity-$appareil_226));
				else
					$freecapacity = $freecapacity - $consumption1 - $consumption2 - $appareil_226;
				
				if($freecapacity < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_636']."</span>";
				}elseif($UserDeuterium - ($consumption1 + $consumption2) < 0) {
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fa_not_enough_fuel']."</span>";
				}else{	
					
					$PLANET['elyrium']   	-= ($consumption1 + $consumption2);
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium = elyrium - '".($consumption1 + $consumption2)."' WHERE id = ".$PLANET['id']." ;");
			
					$fleetRessource	= array(
						901	=> 0,
						902	=> 0,
						903	=> 0,
						904	=> 0,
					);
					$fleetPopulation	= array(
						301	=> 0,
						302	=> $technicien,
						303	=> $scientifique,
						304	=> 0,
						305	=> 0,
						306	=> $soldat,
						307	=> 0,
						308	=> $pilote,
						309	=> $antaris,
					);

					$PLANET[$resource[301]]	-= $fleetPopulation[301];
					$PLANET[$resource[302]]	-= $fleetPopulation[302];
					$PLANET[$resource[303]]	-= $fleetPopulation[303];
					$PLANET[$resource[304]]	-= $fleetPopulation[304];
					$PLANET[$resource[305]]	-= $fleetPopulation[305];
					$PLANET[$resource[306]]	-= $fleetPopulation[306];
					$PLANET[$resource[307]]	-= $fleetPopulation[307];
					$PLANET[$resource[308]]	-= $fleetPopulation[308];
					$PLANET[$resource[309]]	-= $fleetPopulation[309];
					
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[301]." = ".$resource[301]." - ".$fleetPopulation[301].", ".$resource[302]." = ".$resource[302]." - ".$fleetPopulation[302].", ".$resource[303]." = ".$resource[303]." - ".$fleetPopulation[303].", ".$resource[304]." = ".$resource[304]." - ".$fleetPopulation[304].", ".$resource[305]." = ".$resource[305]." - ".$fleetPopulation[305].", ".$resource[306]." = ".$resource[306]." - ".$fleetPopulation[306].", ".$resource[307]." = ".$resource[307]." - ".$fleetPopulation[307].", ".$resource[308]." = ".$resource[308]." - ".$fleetPopulation[308].", ".$resource[309]." = ".$resource[309]." - ".$fleetPopulation[309]."	WHERE id = ".$PLANET['id'].";"); 
					
					$fleetStartTime		= $Duration1 + TIMESTAMP;
					$fleetStayTime		= $fleetStartTime;
					$fleetEndTime		= $fleetStayTime + $Duration2;
					
					$shipID				= array_keys($fleetArray);
					 
					FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $Opponent['id'], $Opponent['pids'], 1, $TargetSystem, $TargetPlanet, 1, $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
					
					$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_587'], pretty_number($getShipCount), $Opponent['name'], $Opponent['system'], $Opponent['planet'], $LNG['type_missionbis'][1])."</span>";
				}
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=center">'.$LNG['NOUVEAUTE_599'].'</a><br /><< <a href="game.php?page=center&mode=mission&missionID=1">'.$LNG['NOUVEAUTE_584'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}
	}
	
	private function GetColonyList()
	{
		global $PLANET, $USER;
		
		$ColonyList	= array();
		
		foreach($USER['PLANETS'] as $CurPlanetID => $CurPlanet)
		{
			if ($PLANET['id'] == $CurPlanet['id'])
				continue;
			
			$ColonyList[] = array(
				'name'		=> $CurPlanet['name'],
				'galaxy'	=> $CurPlanet['galaxy'],
				'system'	=> $CurPlanet['system'],
				'planet'	=> $CurPlanet['planet'],
				'type'		=> $CurPlanet['planet_type'],
				'image'		=> $CurPlanet['image'],
			);	
		}
			
		return $ColonyList;
	}
}
