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
require_once('includes/classes/class.FleetFunctions.php');

class ShowTportalPage extends AbstractPage
{	
	public static $requireModule = MODULE_TPORTAL;
	function __construct() 
	{
		parent::__construct();
		
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
	
	function envoyerMission()
	{
		global $PLANET, $LNG, $UNI, $CONF, $USER, $resource, $pricelist, $reslist;
		
		$onglet_page 					= HTTP::_GP('onglet_page', "", UTF8_SUPPORT);
		$specialized					= array();
		if($onglet_page == "espionner"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$targetMission			= 14;
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, p.name, p.system, p.planet, u.urlaubs_modus, u.lang, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.destruyed, p.teleport_portal, p.id as pids, u.ally_id, p.specialships FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
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
			}elseif($PLANET[$resource[210]] == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_541']."</span>";
			}elseif($Opponent['teleport_portal'] == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_536'], $Opponent['username'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fleet_ajax_19']."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(Config::get('adm_attack') == 1 && $Opponent['authattack'] > $USER['authlevel']) {
				echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif($Opponent['force_field_timer'] > TIMESTAMP && $USER['virus_tech'] < $Opponent['forcefield_tech']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_21'], $this->getUsername($Opponent['id_owner']))."</span>";
			}elseif(!empty($SelectCount)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_578'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['NoobPlayer']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_539'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['StrongPlayer']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_540'], $Opponent['username'])."</span>";
			}else{
				$fleetAmount	= 1;
				$PLANET[$resource[210]] -= 1;
				$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ".$resource[210]." = ".$resource[210]." - 1 WHERE id = ".$PLANET['id'].";");
				$UserTarget		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE id = ".$Opponent['id'].";");
				$PlanetTarget	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE id = ".$Opponent['pids'].";");
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
				$linkCreate	 	= "";
				if($SpyRes) {
					$classIDs[900]	= $reslist['resstype'][1];
				}
				if($SpyOwn) {
					$HTML     .= "<h3>".$LNG['tech'][1400]." :</h3>";
					if(empty($Opponent['specialships'])){
						$HTML .= "<div style=\"text-align : left;\">— ".$LNG['NOUVEAUTE_703']."<br>— ".$LNG['NOUVEAUTE_704']."<br></div>";
					}else{
						$OwnShips			= explode(';', $Opponent['specialships']);		
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
							$getShipInfo	= $GLOBALS['DATABASE']->getFirstRow("SELECT id_infrastructure, shipSpeed, shipFret, nom, image, shipAttack, shipBouclier, shipCoque FROM ".VARS_USER." WHERE owerId = ".$Opponent['id']." AND varId = ".$ElementY.";");
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
				
				$userAlliance	 = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($USER['ally_id'])."]</span>";
				$ennemieAlliance = $Opponent['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($Opponent['ally_id'])."]</span>";
				
				if($Diffence < 0){
					$spyRaport = sprintf($LNG['NOUVEAUTE_701'], $Opponent['name'], $Opponent['system'],$Opponent['planet'], $this->getUsername($Opponent['id_owner']), $ennemieAlliance, $Opponent['name'], $Opponent['system'],$Opponent['planet']);
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
					$linkCreate .= "&amp;planetId=".$Opponent['pids']."&amp;timeofRa=".TIMESTAMP;
					
					$spyRaport = sprintf($LNG['NOUVEAUTE_702'], $Opponent['name'], $Opponent['system'],$Opponent['planet'], $this->getUsername($Opponent['id_owner']), $ennemieAlliance, $Opponent['name'], $Opponent['system'],$Opponent['planet'], $AddToMessage, $HTML, $AddToMessage1, $linkCreate, $linkCreate);
				}
				SendSimpleMessage($USER['id'], $Opponent['id'], TIMESTAMP, 0, sprintf($LNG['sys_mess_tower_spy_owner'], $Opponent['name'], $Opponent['system'],$Opponent['planet']), sprintf($LNG['NOUVEAUTE_697'], $this->getUsername($Opponent['id_owner'])), $spyRaport); 
				
				$LNGK	= new Language($Opponent['lang']);
				$LNGK->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
				$spyRaport1 = sprintf($LNGK['NOUVEAUTE_700'], $USER['username'], $userAlliance, $Opponent['name'], $Opponent['system'],$Opponent['planet'], $PLANET['name'], $PLANET['system'],$PLANET['planet']);
				SendSimpleMessage($Opponent['id'], $USER['id'], TIMESTAMP, 0, sprintf($LNGK['NOUVEAUTE_698'], $Opponent['name'], $Opponent['system'],$Opponent['planet']), sprintf($LNGK['NOUVEAUTE_699'], $USER['username']), $spyRaport1);		
			
				$Message = "<span class='vert'>".sprintf($LNG['fleet_ajax_17'], $Opponent['name'], $Opponent['system'],$Opponent['planet'],$this->getUsername($Opponent['id_owner']))."</span>";
				
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=Tportal">'.$LNG['NOUVEAUTE_544'].'</a><br /><< <a href="game.php?page=Tportal&mode=mission&missionID=14">'.$LNG['NOUVEAUTE_545'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "pactiser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$targetMission			= 12;
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.lang, u.ally_id, p.name, p.system, p.planet, u.urlaubs_modus, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$IsNoobProtec		= CheckNoobProtec($USER, $Opponent, $Opponent);
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$OpponentID.");");
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fleet_ajax_19']."</span>";
			}elseif($Opponent['teleport_portal'] == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_536'], $Opponent['username'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_586'], $Opponent['username'])."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif($PLANET[$resource[305]] < 5 || $PLANET[$resource[306]] < 10){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_551'], pretty_number($PLANET[$resource[305]]), pretty_number($PLANET[$resource[306]]))."</span>";
			}else{
				$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$Opponent['id_owner']." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$Opponent['id_owner'].");");
				if(!empty($SelectCount)){
					$LNG	= new Language($USER['lang']);
					$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
					$TheMessage = '<div style="text-align : justify;">'.sprintf($LNG['ls_fts_colo_1'], $Opponent['system'], $Opponent['planet'], $LNG['type_missionbis'][12]).'</div><div class="citation"><div class="guillemet ouvrir">«</div><div class="guillemet fermer">»</div>'.$LNG['ls_fts_colo_2'].' :<ul style="text-align : left;"><li>'.$LNG['ls_fts_colo_3'].'</li><li>'.$LNG['ls_fts_colo_4'].'</li><li>'.$LNG['ls_fts_colo_5'].'</li><li>'.$LNG['ls_fts_colo_6'].'</li><li>'.$LNG['ls_fts_colo_7'].'</li><li>'.$LNG['ls_fts_colo_8'].'</li></ul></div><div class="explication_utilisateur">'.$LNG['ls_fts_colo_9'].'</div>';
					SendSimpleMessage($USER['id'], $USER['id'], TIMESTAMP, 7, $LNG['sys_colo_mess_from_text1'], sprintf($LNG['sys_colo_mess_report1'], $Opponent['system'], $Opponent['planet']), $TheMessage);
				}else{
					$GLOBALS['DATABASE']->multi_query("INSERT INTO ".BUDDY." SET sender = ".$USER['id'].", owner = ".$Opponent['id_owner'].", universe = 1, time = ".TIMESTAMP.";SET @buddyID = LAST_INSERT_ID();");
					$PLANET[$resource[305]]	-= 5;
					$PLANET[$resource[306]]	-= 10;
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET diplomat = diplomat - 5, soldier = soldier - 10 WHERE id = ".$PLANET['id']." ;");
				
					$LNG	= new Language($USER['lang']);
					$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
					
					$userAlliance  = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($USER['ally_id'])."]</span>";
					$ennemAlliance = $Opponent['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($Opponent['ally_id'])."]</span>";
		
					$Message = sprintf($LNG['NOUVEAUTE_555'], $USER['username'], $userAlliance, $Opponent['name'], $Opponent['system'], $Opponent['planet'], $this->getUsername($Opponent['id_owner']), $ennemAlliance);
					SendSimpleMessage($USER['id'], $Opponent['id'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_557'], $Opponent['username']), sprintf($LNG['NOUVEAUTE_556'], $Opponent['name'], $Opponent['system'], $Opponent['planet']), $Message);
					
					$LNGK	= new Language($Opponent['lang']);
					$LNGK->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));					
					$Message1 = sprintf($LNG['NOUVEAUTE_558'], $USER['username'], $userAlliance, $Opponent['name'], $Opponent['system'], $Opponent['planet'], $this->getUsername($Opponent['id_owner']), $ennemAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet']);
					SendSimpleMessage($Opponent['id_owner'], $USER['id'], TIMESTAMP, 7, sprintf($LNGK['NOUVEAUTE_574'], $USER['username']), sprintf($LNGK['NOUVEAUTE_573'], $USER['username']), $Message1);
				}
				$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_554'], $Opponent['name'], $Opponent['system'], $Opponent['planet'], $this->getUsername($Opponent['id_owner']))."</span>";
			}
			
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=Tportal">'.$LNG['NOUVEAUTE_544'].'</a><br /><< <a href="game.php?page=Tportal&mode=mission&missionID=12">'.$LNG['NOUVEAUTE_553'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "coloniser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$iPlanetCount 			= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `id_owner` = '".$USER['id']."' AND `planet_type` = '1' AND `destruyed` = '0';");
			$iGalaxyPlace 			= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `system` = ".$TargetSystem." AND `planet` = ".$TargetPlanet.";");
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.lang, u.ally_id, p.name, p.system, p.planet, u.urlaubs_modus, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$MaxPlanets		= PlayerUtil::maxPlanetCount($USER);
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(!empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_562'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($PLANET['teleport_portal'] == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_561']."</span>";
			}elseif($iPlanetCount >= $MaxPlanets){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_567']."</span>";
			}elseif($PLANET[$resource[303]] < 10 || $PLANET[$resource[306]] < 100){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_565'], pretty_number($PLANET[$resource[303]]), pretty_number($PLANET[$resource[306]]))."</span>";
			}else{
				
				if ($iGalaxyPlace != 0 || $iPlanetCount >= $MaxPlanets){
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
					$generatename = $this->GenerateName();
					require_once('includes/functions/CreateOnePlanetRecord.php');
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
				$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_566'], $TargetSystem, $TargetPlanet)."</span>";
			}
			echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=Tportal">'.$LNG['NOUVEAUTE_544'].'</a><br /><< <a href="game.php?page=Tportal&mode=mission&missionID=7">'.$LNG['NOUVEAUTE_568'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "baser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$targetMission			= 14;
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, p.name, p.system, p.planet, u.urlaubs_modus, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, u.lang, u.ally_id, p.id as pids, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$IsNoobProtec		= CheckNoobProtec($USER, $Opponent, $Opponent);
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state = 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state = 1);");
			$TotalUnits = 0;
			$TotalUnits2 = 0;
			$avaible_fleets = array(202,203,210,224,225,226,221,222);
			$avaible_pop = array(301,302,303,304,305,306,307,308,309);
			$avaible_res = array('fer', 'oro', 'cristal', 'elyrium');
			$avaible_resID = array(901,902,903,904);
			$WhichId = 0;
			$capacity = 0;
			$sqlUpdate	=	'';
			$sqlUpdateB	=	'';
			$TransportResLog	=	array();
			$TransportPopLog	=	array();
			$TransportDevLog	=	array();
				
			foreach($avaible_fleets as $FleetID){
				$TotalUnits		+= HTTP::_GP('appareil_'.$FleetID, 0);
				$capacity		+= $pricelist[$FleetID]['capacity']*$PLANET[$resource[$FleetID]];
				$Count			= HTTP::_GP('appareil_'.$FleetID, 0);
				$appareil[$FleetID]	= HTTP::_GP('appareil_'.$FleetID, 0);
				$sqlUpdate	.= "".$resource[$FleetID]." = (".$resource[$FleetID]." - ".$Count."),";
				$sqlUpdateB	.= "".$resource[$FleetID]." = (".$resource[$FleetID]." + ".$Count."),";
			}
			foreach($avaible_pop as $FleetID){
				$TotalUnits		+= HTTP::_GP('population_'.$FleetID, 0);
				$Count			= HTTP::_GP('population_'.$FleetID, 0);
				$population[$FleetID]	= HTTP::_GP('population_'.$FleetID, 0);
				$sqlUpdate	.= "".$resource[$FleetID]." = (".$resource[$FleetID]." - ".$Count."),";
				$sqlUpdateB	.= "".$resource[$FleetID]." = (".$resource[$FleetID]." + ".$Count."),";
			}
			foreach($avaible_res as $FleetID){
				$TotalUnits		+= HTTP::_GP('ressource_'.$FleetID, 0);
				$TotalUnits2	+= HTTP::_GP('ressource_'.$FleetID, 0);
				$Count			= HTTP::_GP('ressource_'.$FleetID, 0);
				$ressourcen[$FleetID]	= HTTP::_GP('ressource_'.$FleetID, 0);
				$sqlUpdate	.= "".$resource[$avaible_resID[$WhichId]]." = (".$resource[$avaible_resID[$WhichId]]." - ".$Count."),";
				$sqlUpdateB	.= "".$resource[$avaible_resID[$WhichId]]." = (".$resource[$avaible_resID[$WhichId]]." + ".$Count."),";
				$WhichId++;
			}

			$resourcensArray = array(901,902,903,904);
			$startResId		 = 0;
			$ShippedEquip	= "";
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
					
				$ShippedEquip .= '<div class="element_item">
                <img src="media/ingame/image/'.$resource[$resId].'.jpg">
                '.$LNG['tech'][$resId].' : <span class="orange">'.$count.'</span> unités
            </div>';
			
				if($count > $PLANET[$resource[$resId]]){
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$resId])."</span>";
					echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=Tportal">'.$LNG['NOUVEAUTE_544'].'</a><br /><< <a href="game.php?page=Tportal&mode=mission&missionID=17">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					return false;
				}else{
					$TransportResLog[] = $resId.",".$count;
				}
			$startResId += 1;
			}
			
			foreach($appareil as $fleetId => $count){
				if($count == 0)
					continue;
				
				$ShippedEquip .= '<div class="element_item">
                <img src="styles/theme/gow/gebaeude/'.$fleetId.'.gif">
                '.$LNG['tech'][$fleetId].' : <span class="orange">'.$count.'</span> unités
            </div>';
				
				if($count > $PLANET[$resource[$fleetId]]){
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$fleetId])."</span>";
					echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=Tportal">'.$LNG['NOUVEAUTE_544'].'</a><br /><< <a href="game.php?page=Tportal&mode=mission&missionID=17">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					return false;
				}else{
					$TransportDevLog[] = $fleetId.",".$count;
				}
			}
			
			foreach($population as $popId => $count){
				if($count == 0)
					continue;
				
				$ShippedEquip .= '<div class="element_item">
                <img src="styles/theme/gow/gebaeude/'.$popId.'.jpg">
                '.$LNG['tech'][$popId].' : <span class="orange">'.$count.'</span> unités
            </div>';
			
				if($count > $PLANET[$resource[$popId]]){
					$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$popId])."</span>";
					echo '<div id="espionner_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=Tportal">'.$LNG['NOUVEAUTE_544'].'</a><br /><< <a href="game.php?page=Tportal&mode=mission&missionID=17">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
					return false;
				}else{
					$TransportPopLog[] = $popId.",".$count;
				}
			}
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['pids'] == $PLANET['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fleet_ajax_19']."</span>";
			}elseif($Opponent['teleport_portal'] == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_536'], $Opponent['username'], $TargetSystem, $TargetPlanet)."</span>";
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
			}elseif($TotalUnits == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_575']."</span>";
			}elseif($TotalUnits2 > $capacity){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_669']."</span>";
			}else{
				$GLOBALS['DATABASE']->query('UPDATE '.PLANETS.' SET '.$sqlUpdate.' id = '.$PLANET['id'].' WHERE id = '.$PLANET['id'].';');
				$GLOBALS['DATABASE']->query('UPDATE '.PLANETS.' SET '.$sqlUpdateB.' id = '.$Opponent['pids'].' WHERE id = '.$Opponent['pids'].';');
				$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_579'], $Opponent['name'], $Opponent['system'],$Opponent['planet'],$this->getUsername($Opponent['id_owner']))."</span>";
				
				
				$LNG	= new Language($USER['lang']);
				$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
				$LNGK	= new Language($Opponent['lang']);
				$LNGK->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));		
					
				if($USER['id'] == $Opponent['id']){
					$MessageSend = sprintf($LNG['NOUVEAUTE_673'], _date("d F Y à H:i", TIMESTAMP, 'Europe/Brussels'), $PLANET['name'], $PLANET['system'], $PLANET['planet'], $Opponent['name'], $Opponent['system'],$Opponent['planet'], $ShippedEquip);
					SendSimpleMessage($USER['id'], $USER['id'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_671'], $this->getUsername($Opponent['id'])), sprintf($LNG['NOUVEAUTE_672'], $Opponent['name'], $Opponent['system'], $Opponent['planet']), $MessageSend);
				}elseif($USER['id'] != $Opponent['id']){
					$userAlliance	 = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($USER['ally_id'])."]</span>";
					$ennemieAlliance = $Opponent['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($Opponent['ally_id'])."]</span>";
					$StrongestPlayer = $USER['total_points'] > $Opponent['total_points'] ? $USER['username'] : $this->getUsername($Opponent['id']);
					$StrongestPlayerId = $USER['total_points'] > $Opponent['total_points'] ? $USER['id'] : $Opponent['id'];
					$MessageSend = sprintf($LNG['NOUVEAUTE_674'], $USER['username'], $userAlliance, $this->getUsername($Opponent['id']), $ennemieAlliance, _date("d F Y à H:i", TIMESTAMP, 'Europe/Brussels'), $PLANET['name'], $PLANET['system'], $PLANET['planet'], $Opponent['name'], $Opponent['system'],$Opponent['planet'], $ShippedEquip, $StrongestPlayer);
					$MessageSend1 = sprintf($LNGK['NOUVEAUTE_674'], $USER['username'], $userAlliance, $this->getUsername($Opponent['id']), $ennemieAlliance, _date("d F Y à H:i", TIMESTAMP, 'Europe/Brussels'), $PLANET['name'], $PLANET['system'], $PLANET['planet'], $Opponent['name'], $Opponent['system'],$Opponent['planet'], $ShippedEquip, $StrongestPlayer);
					SendSimpleMessage($USER['id'], $Opponent['id'], TIMESTAMP, 7, sprintf($LNG['NOUVEAUTE_671'], $this->getUsername($Opponent['id'])), sprintf($LNG['NOUVEAUTE_672'], $Opponent['name'], $Opponent['system'], $Opponent['planet']), $MessageSend);
					SendSimpleMessage($Opponent['id'], $USER['id'], TIMESTAMP, 7, sprintf($LNGK['NOUVEAUTE_671'], $USER['username']), sprintf($LNGK['NOUVEAUTE_672'], $Opponent['name'], $Opponent['system'], $Opponent['planet']), $MessageSend1);
					
					$legal = 0;
					if($StrongestPlayerId != $USER['id'])
						$legal = 1;
					
					$transportRes 		= !empty($TransportResLog) ? ", transportRes = '".implode(';', $TransportResLog)."'" : '';
					$transportPop 		= !empty($TransportPopLog) ? ", transportPop = '".implode(';', $TransportPopLog)."'" : '';
					$transportDevice	= !empty($TransportDevLog) ? ", transportDevice = '".implode(';', $TransportDevLog)."'" : '';
					$GLOBALS['DATABASE']->query("INSERT INTO ".TRANSORTLOG." SET senderID = ".$USER['id'].", receiverID = ".$Opponent['id'].", time = ".TIMESTAMP.", strongest = ".$StrongestPlayerId."".$transportRes."".$transportPop."".$transportDevice.", push = 0, legal = ".$legal.";");	
				}
			}
			
			echo '<div id="baser_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=Tportal">'.$LNG['NOUVEAUTE_544'].'</a><br /><< <a href="game.php?page=Tportal&mode=mission&missionID=17">'.$LNG['NOUVEAUTE_580'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}elseif($onglet_page == "attaquer"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$appareil_202			= HTTP::_GP('appareil_202', 0);
			$appareil_203			= HTTP::_GP('appareil_203', 0);
			$appareil_225			= HTTP::_GP('appareil_225', 0);
			$population_306			= HTTP::_GP('population_306', 0);
			$population_307			= HTTP::_GP('population_307', 0);
			
			$BattleCount 			= 0;
			$battleArray 			= array(202,203,225,306,307);
			$Sendarray[202]			= 0;
			$Sendarray[203]			= 0;
			$sqlRemoveAttacker		= "";
		
			$BuildArray[202]		= HTTP::_GP('appareil_202', 0);
			$BuildArray[203]		= HTTP::_GP('appareil_203', 0);
			$BuildArray[225]		= HTTP::_GP('appareil_225', 0);
			$BuildArray[306]		= HTTP::_GP('population_306', 0);
			$BuildArray[307]		= HTTP::_GP('population_307', 0);
			
			foreach($BuildArray as $ID => $Count)
			{	
				if(!in_array($ID, $battleArray) || $Count == 0) continue;
			
				if($Count > 0 && $PLANET[$resource[$ID]] >= $Count){
					$ships[$ID]   = $Count;
					if($ID > 220)
						$BattleCount	   += $Count;
					if($ID == 202)
						$Sendarray[202]	+= $Count;
					elseif($ID == 203)
						$Sendarray[203]	+= $Count;
					//$PLANET[$resource[$ID]] -= $Count;
					//$sqlRemoveAttacker .= "UPDATE ".PLANETS." SET ".$resource[$ID]." = ".$resource[$ID]." - ".$Count." WHERE id = '".$PLANET['id']."';";
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
										total_points, onlinetime, forcefield_tech, urlaubs_modus, banaday, immunity_until, authattack, user_deleted, username, ally_id, lang
										FROM ".PLANETS." planet
										INNER JOIN ".USERS." user ON planet.id_owner = user.id
										LEFT JOIN ".STATPOINTS." as stat ON stat.id_owner = user.id AND stat.stat_type = '1' 
										WHERE planet.system = ".$TargetSystem." AND planet.planet = ".$TargetPlanet.";");
			
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.system, p.planet, u.ally_id, p.id as pids, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal, u.lang FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
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
			}elseif($Opponent['teleport_portal'] == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_536'], $Opponent['username'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['fleet_ajax_19']."</span>";
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
			}elseif($Opponent['force_field_timer'] > TIMESTAMP && $USER['virus_tech'] < $Opponent['forcefield_tech']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['fleet_ajax_21'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(FleetFunctions::CheckBashPortalAttack($Opponent['pids'])){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_488'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_578'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['NoobPlayer']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_539'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['StrongPlayer']){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_540'], $Opponent['username'])."</span>";
			}elseif(($appareil_202 + $appareil_203 + $appareil_225 + $population_306 + $population_307) == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_708']."</span>";
			}elseif(($appareil_225 + $population_306 + $population_307) == 0){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".$LNG['NOUVEAUTE_708']."</span>";
			}elseif($appareil_202 > $PLANET[$resource[202]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][202])."</span>";
			}elseif($appareil_203 > $PLANET[$resource[203]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][203])."</span>";
			}elseif($appareil_225 > $PLANET[$resource[225]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][225])."</span>";
			}elseif($population_306 > $PLANET[$resource[306]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
			}elseif($population_307 > $PLANET[$resource[307]]){
				$Message = "<span class='rouge'><b>".$LNG['NOUVEAUTE_546']." : </b>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][307])."</span>";
			}else{
				
				foreach($BuildArray as $ID => $Count)
				{	
					if(!in_array($ID, $battleArray) || $Count == 0) continue;
				
					if($Count > 0 && $PLANET[$resource[$ID]] >= $Count){
						$PLANET[$resource[$ID]] -= $Count;
						$sqlRemoveAttacker .= "UPDATE ".PLANETS." SET ".$resource[$ID]." = ".$resource[$ID]." - ".$Count." WHERE id = '".$PLANET['id']."';";
					}
				}
			
				if(!empty($sqlRemoveAttacker))
					$GLOBALS['DATABASE']->multi_query($sqlRemoveAttacker);
				$GLOBALS['DATABASE']->query("INSERT INTO ".PORTALBASH." SET attackerId = ".$USER['id'].", planetId = ".$targetData['id'].", timeAttack = ".TIMESTAMP.";");	
			
				$userAlliance	 = $USER['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($USER['ally_id'])."]</span>";
				$ennemieAlliance = $targetData['ally_id'] == 0 ? "" : " <span class='orange'>[".$this->getAllianceTag($targetData['ally_id'])."]</span>";
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
				
				if(!isset($Raport)) {
					$this->printMessage($LNG['sys_raport_not_found']);
				}
				
				$CombatRaport			= unserialize($Raport['raport']);
				$CombatRaport['time']	= _date($LNG['php_tdformat'], $CombatRaport['time'], $USER['timezone']);
				$CombatRaport			= $this->BCWrapperPreRev2321($CombatRaport);
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
					
					$MessageSend = sprintf($LNG['NOUVEAUTE_772'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], $this->getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, $this->getUsername($WinnerId), $this->getUsername($LoserId), $attackColor, $USER['username'], $attackClass, $defendColor, $targetData['username'], $defendClass, sprintf($LNG['NOUVEAUTE_775'], $USER['username']), $TextToEcho3, "", "", $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
					$MessageSend2 = $MessageSend;
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
					$MessageSend = sprintf($LNGK['NOUVEAUTE_772'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], $this->getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, $this->getUsername($WinnerId), $this->getUsername($LoserId), $attackColor, $USER['username'], $attackClass, $defendColor, $targetData['username'], $defendClass, sprintf($LNG['NOUVEAUTE_775'], $USER['username']), $TextToEcho3, "", "", $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
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
					
					$MessageSend = sprintf($LNG['NOUVEAUTE_779'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], $this->getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, $USER['username'], $USER['username'], $targetData['username'], $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
					$MessageSend2 = $MessageSend;
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
					$MessageSend = sprintf($LNGK['NOUVEAUTE_779'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], $this->getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, $USER['username'], $USER['username'], $targetData['username'], $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
					SendSimpleMessage($targetData['id_owner'], $USER['id'], TIMESTAMP, 6, sprintf($LNGK['NOUVEAUTE_778'], $USER['username']), sprintf($LNGK['NOUVEAUTE_769'], $USER['username'], $targetData['name'], $targetData['system'], $targetData['planet']), $MessageSend);
				}elseif ($combatResult['won'] == "r"){
					//LOSE 0 ROUND MESSAGE
					$MessageSend = sprintf($LNG['NOUVEAUTE_710'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], $this->getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet']);
					$MessageSend2 = $MessageSend;
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
				
					$MessageSend = sprintf($LNGK['NOUVEAUTE_772'], $USER['username'], $userAlliance, $targetData['name'], $targetData['system'], $targetData['planet'], $this->getUsername($targetData['id_owner']), $ennemieAlliance, $PLANET['name'], $PLANET['system'], $PLANET['planet'], $USER['username'], $TextToEcho, $targetData['username'], $TextToEcho2, $this->getUsername($WinnerId), $this->getUsername($LoserId), $attackColor, $USER['username'], $attackClass, $defendColor, $targetData['username'], $defendClass, "", $TextToEcho3, sprintf($LNG['NOUVEAUTE_776'], $targetData['username']), $TextToEcho4, $USER['username'], $TextToEcho5, $targetData['username'], $TextToEcho6);
					SendSimpleMessage($targetData['id_owner'], $USER['id'], TIMESTAMP, 6, sprintf($LNGK['NOUVEAUTE_770'], $USER['username']), sprintf($LNGK['NOUVEAUTE_769'], $USER['username'], $targetData['name'], $targetData['system'], $targetData['planet']), $MessageSend);
				}
				
				$Message = "".sprintf($LNG['NOUVEAUTE_780'], $targetData['name'], $targetData['system'], $targetData['planet'], $targetData['username'])."<b>Rapport de combat :</b><div name=\"rapport_attaque\" style=\"width : 90%; margin : 20px auto;\"><div name=\"attaque_portail\" class=\"conteneur_message\">".$MessageSend2."</div></div>";
			}
			
			echo '<div id="attaquer_portail" class="formulaire_mission categorie"><h2>'.$LNG['NOUVEAUTE_547'].'</h2><div name="formulaire_envoyer"><!-- Les liens pour revenir sur le menu ou sur la mission --><div class="retour_menu"><< <a href="game.php?page=Tportal">'.$LNG['NOUVEAUTE_544'].'</a><br /><< <a href="game.php?page=Tportal&mode=mission&missionID=13">'.$LNG['NOUVEAUTE_584'].'</a></div><!-- On affiche le message renvoyé par le formulaire -->'.$Message.'</div></div>';
		}
	}
	function GenerateName() 
	{
		global $LNG, $PLANET;

		$Names		= file('botnames.txt');
		$NamesCount	= count($Names);
		$Rand		= mt_rand(0, $NamesCount);
		$UserName 	= trim($Names[$Rand]);
		return $UserName;
	}
	
	function verifier()
	{
		global $PLANET, $LNG, $UNI, $CONF, $USER, $resource, $pricelist;
		
		$onglet_page 					= HTTP::_GP('onglet_page', "", UTF8_SUPPORT);
		if($onglet_page == "espionner"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$IsNoobProtec		= CheckNoobProtec($USER, $Opponent, $Opponent);
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state >= 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state >= 1);");
			if(empty($TargetSystem) || empty($TargetPlanet)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($PLANET[$resource[210]] == 0){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_541']."</span>";
			}elseif($Opponent['teleport_portal'] == 0){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_536'], $Opponent['username'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				echo "<span class='rouge'>".$LNG['fleet_ajax_19']."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(Config::get('adm_attack') == 1 && $Opponent['authattack'] > $USER['authlevel']) {
				echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif($Opponent['force_field_timer'] > TIMESTAMP && $USER['virus_tech'] < $Opponent['forcefield_tech']){
				echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_21'], $this->getUsername($Opponent['id_owner']))."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_578'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['NoobPlayer']){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_539'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['StrongPlayer']){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_540'], $Opponent['username'])."</span>";
			}else{
				echo "<span class='vert'>".sprintf($LNG['NOUVEAUTE_548'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username'])."</span>";
			}
		}elseif($onglet_page == "pactiser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$IsNoobProtec		= CheckNoobProtec($USER, $Opponent, $Opponent);
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id'].") OR (sender = ".$USER['id']." AND owner = ".$OpponentID.");");
			if(empty($TargetSystem) || empty($TargetPlanet)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				echo "<span class='rouge'>".$LNG['fleet_ajax_19']."</span>";
			}elseif($Opponent['teleport_portal'] == 0){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_536'], $Opponent['username'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_586'], $Opponent['username'])."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif($PLANET[$resource[305]] < 5 || $PLANET[$resource[306]] < 10){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_551'], pretty_number($PLANET[$resource[305]]), pretty_number($PLANET[$resource[306]]))."</span>";
			}else{
				echo "<span class='vert'>".sprintf($LNG['NOUVEAUTE_552'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username'])."</span>";
			}
		}elseif($onglet_page == "coloniser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$iPlanetCount 	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `id_owner` = '".$USER['id']."' AND `planet_type` = '1' AND `destruyed` = '0';");
			$MaxPlanets		= PlayerUtil::maxPlanetCount($USER);
			if(empty($TargetSystem) || empty($TargetPlanet)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(!empty($Opponent)){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_562'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($PLANET['teleport_portal'] == 0){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_561']."</span>";
			}elseif($iPlanetCount >= $MaxPlanets){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_567']."</span>";
			}elseif($PLANET[$resource[303]] < 10 || $PLANET[$resource[306]] < 100){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_565'], pretty_number($PLANET[$resource[303]]), pretty_number($PLANET[$resource[306]]))."</span>";
			}else{
				echo "<span class='vert'>".sprintf($LNG['NOUVEAUTE_563'], $TargetSystem, $TargetPlanet)."</span>";
			}
		}elseif($onglet_page == "baser"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$TotalUnits  = 0;
			$TotalUnits2 = 0;
			$capacity = 0;
			$avaible_fleets = array(202,203,210,224,225,226,221,222);
			$avaible_pop = array(301,302,303,304,305,306,307,308,309);
			$avaible_res = array('fer', 'oro', 'cristal', 'elyrium');
			foreach($avaible_fleets as $FleetID){
				$TotalUnits		+= HTTP::_GP('appareil_'.$FleetID, 0);
				$capacity		+= $pricelist[$FleetID]['capacity']*$PLANET[$resource[$FleetID]];
				$appareil[$FleetID]	= HTTP::_GP('appareil_'.$FleetID, 0);
			}
			foreach($avaible_pop as $FleetID){
				$TotalUnits		+= HTTP::_GP('population_'.$FleetID, 0);
				$population[$FleetID]	= HTTP::_GP('population_'.$FleetID, 0);
			}
			foreach($avaible_res as $FleetID){
				$TotalUnits		+= HTTP::_GP('ressource_'.$FleetID, 0);
				$TotalUnits2	+= HTTP::_GP('ressource_'.$FleetID, 0);
				$ressourcen[$FleetID]	= HTTP::_GP('ressource_'.$FleetID, 0);
			}
			
			
			
			
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.id as pids, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$iPlanetCount 	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `id_owner` = '".$USER['id']."' AND `planet_type` = '1' AND `destruyed` = '0';");
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state = 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state = 1);");
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			
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
				
				if($count > $PLANET[$resource[$resId]]){
					echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$resId])."</span>";
					return false;
				}
			$startResId += 1;
			}
			
			foreach($appareil as $fleetId => $count){
				if($count == 0)
					continue;
				
				if($count > $PLANET[$resource[$fleetId]]){
					echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$fleetId])."</span>";
					return false;
				}
			}
			
			foreach($population as $popId => $count){
				if($count == 0)
					continue;

				if($count > $PLANET[$resource[$popId]]){
					echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][$popId])."</span>";
					return false;
				}
			}
			
			if(empty($TargetSystem) || empty($TargetPlanet)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['pids'] == $PLANET['id']){
				echo "<span class='rouge'>".$LNG['fleet_ajax_19']."</span>";
			}elseif($Opponent['teleport_portal'] == 0){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_536'], $Opponent['username'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(empty($SelectCount) && $Opponent['id'] != $USER['id']){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_577'], $Opponent['username'])."</span>";
			}elseif($TotalUnits == 0){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_575']."</span>";
			}elseif($TotalUnits2 > $capacity){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_669']."</span>";
			}else{
				echo "<span class='vert'>".sprintf($LNG['NOUVEAUTE_576'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username'])."</span>";
			}
		}elseif($onglet_page == "attaquer"){
			$TargetSystem 			= HTTP::_GP('systeme', 0);
			$TargetPlanet			= HTTP::_GP('position', 0);
			$appareil_202			= HTTP::_GP('appareil_202', 0);
			$appareil_203			= HTTP::_GP('appareil_203', 0);
			$appareil_225			= HTTP::_GP('appareil_225', 0);
			$population_306			= HTTP::_GP('population_306', 0);
			$population_307			= HTTP::_GP('population_307', 0);
			$Opponent				= $GLOBALS['DATABASE']->getFirstRow("SELECT u.id, u.forcefield_tech, p.id as pids, p.force_field_timer, u.user_deleted, u.urlaubs_modus, u.immunity_until, u.bana, u.username, u.banaday, u.onlinetime, u.user_lastip, u.authattack, p.id_owner, p.destruyed, p.der_metal, p.der_crystal, p.name, p.destruyed, p.teleport_portal FROM ".USERS." as u, ".PLANETS." as p WHERE p.universe = ".$UNI." AND p.galaxy = 1 AND p.system = ".$TargetSystem." AND p.planet = ".$TargetPlanet."  AND p.planet_type = 1 AND u.id = p.id_owner;");
			$OpponentID				= empty($Opponent) ? 0 : $Opponent['id'];
			$OpponentStats			= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = ".$OpponentID.";");
			$Opponent				+= $OpponentStats;
			$ipCheck 				= $GLOBALS['DATABASE']->getFirstRow("SELECT userID, secondID FROM uni1_ipblock WHERE (userID = ".$USER['id']." AND secondID = ".$OpponentID.") OR (secondID = ".$USER['id']." AND userID = ".$OpponentID.");");
			$IsNoobProtec		= CheckNoobProtec($USER, $Opponent, $Opponent);
			$SelectCount		= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM uni1_buddy WHERE (sender = ".$OpponentID." AND owner = ".$USER['id']." AND state >= 1) OR (sender = ".$USER['id']." AND owner = ".$OpponentID." AND state >= 1);");
			if(empty($TargetSystem) || empty($TargetPlanet)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_534']."</span>";
			}elseif($TargetSystem > 1000 || $TargetPlanet > 10 || $TargetPlanet < 1 || $TargetSystem < 1 || !is_numeric($TargetPlanet) || !is_numeric($TargetSystem)){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_564']."</span>";
			}elseif(empty($Opponent)){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_535'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['teleport_portal'] == 0){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_536'], $Opponent['username'], $TargetSystem, $TargetPlanet)."</span>";
			}elseif($Opponent['id'] == $USER['id']){
				echo "<span class='rouge'>".$LNG['fleet_ajax_19']."</span>";
			}elseif(!empty($ipCheck) || ENABLE_MULTIALERT && $USER['id'] != $Opponent['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $Opponent['user_lastip'] && $GLOBALS['DATABASE']->getFirstCell("SELECT (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$USER['id'].") + (SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$Opponent['id'].")") != 2){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_537'], $Opponent['username'])."</span>";
			}elseif(Config::get('adm_attack') == 1 && $Opponent['authattack'] > $USER['authlevel']) {
				echo "<span class='rouge'>".$LNG['fa_action_not_allowed']."</span>";
			}elseif ($Opponent['urlaubs_modus'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_538'], $Opponent['username'])."</span>";
			}elseif($Opponent['user_deleted'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_3'], $Opponent['username'])."</span>";
			}elseif ($Opponent['bana'] == 1){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_542'], $Opponent['username'])."</span>";
			}elseif($Opponent['force_field_timer'] > TIMESTAMP && $USER['virus_tech'] < $Opponent['forcefield_tech']){
				echo "<span class='rouge'>".sprintf($LNG['fleet_ajax_21'], $Opponent['username'])."</span>";
			}elseif ($Opponent['immunity_until'] > TIMESTAMP){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_543'], $Opponent['username'])."</span>";
			}elseif(FleetFunctions::CheckBashPortalAttack($Opponent['pids'])){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_488'], $Opponent['username'])."</span>";
			}elseif(!empty($SelectCount)){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_578'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['NoobPlayer']){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_539'], $Opponent['username'])."</span>";
			}elseif ($IsNoobProtec['StrongPlayer']){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_540'], $Opponent['username'])."</span>";
			}elseif(($appareil_202 + $appareil_203 + $appareil_225 + $population_306 + $population_307) == 0){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_708']."</span>";
			}elseif(($appareil_225 + $population_306 + $population_307) == 0){
				echo "<span class='rouge'>".$LNG['NOUVEAUTE_708']."</span>";
			}elseif($appareil_202 > $PLANET[$resource[202]]){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][202])."</span>";
			}elseif($appareil_203 > $PLANET[$resource[203]]){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][203])."</span>";
			}elseif($appareil_225 > $PLANET[$resource[225]]){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][225])."</span>";
			}elseif($population_306 > $PLANET[$resource[306]]){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][306])."</span>";
			}elseif($population_307 > $PLANET[$resource[307]]){
				echo "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_489'], $LNG['tech'][307])."</span>";
			}else{
				echo "<span class='vert'>".sprintf($LNG['NOUVEAUTE_583'], $Opponent['name'], $TargetSystem, $TargetPlanet, $Opponent['username'])."</span>";
			}
		}else{
			echo "<span class='rouge'>".$LNG['NOUVEAUTE_22']."</span>";
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
	
	function show(){
		global $LNG, $ProdGrid, $resource, $reslist, $CONF, $pricelist, $USER, $PLANET;
			
		$havePortal = 0;
		if($USER['energy_tech'] >=6 && $USER['control_room_tech'] >=5 && $USER['particle_tech'] >=4){
			$havePortal = 1;
		}
		
		$showMessage =0;
		if($PLANET['teleport_portal'] == 0 && $USER['energy_tech'] >=6 && $USER['control_room_tech'] >=5 && $USER['particle_tech'] >=4){
			$showMessage = 1;
		}elseif($PLANET['teleport_portal'] == 1 && $PLANET['force_field_timer'] < TIMESTAMP){
			$showMessage = 2;
		}elseif($PLANET['teleport_portal'] == 1 && $PLANET['force_field_timer'] > TIMESTAMP){
			$showMessage = 3;
		}
		
		$Message = "";
		
		if($USER['urlaubs_modus'] == 1){
			$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_20']."</span>";
		}
			
		$this->tplObj->assign_vars(array(	
			'energy_tech' => $USER['energy_tech'],                                  
			'control_room_tech' => $USER['control_room_tech'],                                  
			'tpanels' => $PLANET['teleport_portal'],                                  
			'particul_tech' => $USER['particle_tech'],
			'havePortal' => $havePortal,
			'showMessage' => $showMessage,
			'Message' 		=> $Message,
		));
		$this->display('page.tportal.default.tpl');
	}
	
	function mission(){
		global $LNG, $ProdGrid, $resource, $reslist, $CONF, $pricelist, $USER, $PLANET;
		
		if (IsVacationMode($USER) || $PLANET['teleport_portal'] == 0) {
			$this->redirectTo('game.php?page=Tportal');
			return false;
		}
		
		$PlanetCount					= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE id != ".$PLANET['id']." AND id_owner = ".$USER['id']." AND destruyed = 0;");		
		$mission				= HTTP::_GP('missionID', 0);
		/* if($mission == 0){
			$this->printMessage('<span class="rouge">notok</span>');
		} */
		
		$colonyList 	= $this->GetColonyList();
		
		$PopulationOnPlanet	= array();
		$PopulationOnPlanetb	= array();
		$FleetsOnPlanet	= array();
		$FleetsOnPlanetb	= array();
		$avaible_pop = array(302,303,304,305,306,307,308,309);
		$avaible_popb = array(306,307);
		foreach($avaible_pop as $populationID)
		{	
			$PopulationOnPlanet[]	= array(
				'id'	=> $populationID,
				'count'	=> floor($PLANET[$resource[$populationID]]),
			);
		}

		foreach($avaible_popb as $populationID)
		{	
			$PopulationOnPlanetb[]	= array(
				'id'	=> $populationID,
				'count'	=> floor($PLANET[$resource[$populationID]]),
			);
		}
		
		$FleetsOnPlanet	= array();
		$avaible_fleets = array(202,203,210,224,225,226,221,222);
		$avaible_fleetsb = array(202,203,225);
		$capacity		= 0;
		$capacity1		= 0;
		foreach($avaible_fleets as $FleetID)
		{
			$FleetsOnPlanet[]	= array(
				'id'	=> $FleetID,
				'speed'	=> FleetFunctions::GetFleetMaxSpeed($FleetID, $USER),
				'count'	=> floor($PLANET[$resource[$FleetID]]),
			);
			$capacity		+= $pricelist[$FleetID]['capacity']*$PLANET[$resource[$FleetID]];
			
		}

		foreach($avaible_fleetsb as $FleetID)
		{
			$FleetsOnPlanetb[]	= array(
				'id'	=> $FleetID,
				'speed'	=> FleetFunctions::GetFleetMaxSpeed($FleetID, $USER),
				'count'	=> floor($PLANET[$resource[$FleetID]]),
			);
			$capacity1		+= $pricelist[$FleetID]['capacity']*$PLANET[$resource[$FleetID]];
		}

		$GetAll99 = $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE id != ".$PLANET['id']." AND id_owner = ".$USER['id']." AND destruyed = '0' ;");

		//$this->tplObj->loadscript('portal.js');
		$this->tplObj->assign_vars(array(
			'metal'			=> floor($PLANET['metal']),
			'crystal'		=> floor($PLANET['crystal']),
			'deuterium'		=> floor($PLANET['deuterium']),
			'elyrium'		=> floor($PLANET['elyrium']),
			'mission'		=> $mission,
			'capacity'		=> $capacity,
			'capacity1'		=> $capacity1,
			'colonyList' 	=> $colonyList,
			'GetAll99' 		=> $GetAll99,
			'PopulationOnPlanet' => $PopulationOnPlanet,
			'FleetsOnPlanet'=> $FleetsOnPlanet,
			'PopulationOnPlanetb' => $PopulationOnPlanetb,
			'FleetsOnPlanetb'=> $FleetsOnPlanetb,
			'tpanels'		=> $PLANET['teleport_portal'],       
			'PlanetCount' 	=> $PlanetCount,
			'typeSelect'   	=> array(1 => $LNG['type_planet'][1], 2 => $LNG['type_planet'][2]),
		));
		
		$allowedArray = array(17,7,12,14,13);
		if(in_array($mission, $allowedArray)){
			$this->display('page.tportal.mission_'.$mission.'.tpl');
		}else{
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=Tportal');
		}
	}
	
	function missionSend(){
	global $LNG, $ProdGrid, $resource, $reslist, $CONF, $pricelist, $USER, $PLANET;
		
	$mission					= HTTP::_GP('target_mission', 0);	
	$population202				= HTTP::_GP('population203', 0);	
	$population203				= HTTP::_GP('population203', 0);	
	$population204				= HTTP::_GP('population204', 0);	
	$population205				= HTTP::_GP('population205', 0);	
	$population206				= HTTP::_GP('population206', 0);	
	$population207				= HTTP::_GP('population207', 0);	
	$population211				= HTTP::_GP('population211', 0);	
	$population214				= HTTP::_GP('population214', 0);	
	$population215				= HTTP::_GP('population215', 0);	
	$population216				= HTTP::_GP('population216', 0);	
	$population209				= HTTP::_GP('population209', 0);	
	$population223				= HTTP::_GP('population223', 0);	
	$population219				= HTTP::_GP('population219', 0);	
	$population210				= HTTP::_GP('population210', 0);	
	$population224				= HTTP::_GP('population224', 0);	
	$population301				= HTTP::_GP('population301', 0);	
	$population302				= HTTP::_GP('population302', 0);	
	$population303				= HTTP::_GP('population303', 0);	
	$population304				= HTTP::_GP('population304', 0);	
	$population305				= HTTP::_GP('population305', 0);	
	$population306				= HTTP::_GP('population306', 0);	
	$population307				= HTTP::_GP('population307', 0);	
	$population308				= HTTP::_GP('population308', 0);	
	$population309				= HTTP::_GP('population308', 9);	
	$system						= HTTP::_GP('system', 0);	
	$planet						= HTTP::_GP('planet', 0);	
	$fleetArray 				= array();
	$specialized				= array();
	switch($mission)
		{
			case 17:
				$ship202 = min($population202, $PLANET[$resource[202]]);
				$ship203 = min($population203, $PLANET[$resource[203]]);
				$ship204 = min($population204, $PLANET[$resource[204]]);
				$ship205 = min($population205, $PLANET[$resource[205]]);
				$ship206 = min($population206, $PLANET[$resource[206]]);
				$ship207 = min($population207, $PLANET[$resource[207]]);
				$ship211 = min($population211, $PLANET[$resource[211]]);
				$ship214 = min($population214, $PLANET[$resource[214]]);
				$ship215 = min($population215, $PLANET[$resource[215]]);
				$ship216 = min($population216, $PLANET[$resource[216]]);
				$ship209 = min($population209, $PLANET[$resource[209]]);
				$ship223 = min($population223, $PLANET[$resource[223]]);
				$ship219 = min($population219, $PLANET[$resource[219]]);
				$ship210 = min($population210, $PLANET[$resource[210]]);
				$ship224 = min($population224, $PLANET[$resource[224]]);
				
				$fleetArray = array(202 => $ship202, 203 => $ship203, 204 => $ship204, 205 => $ship205, 206 => $ship206, 207 => $ship207, 211 => $ship211, 214 => $ship214, 215 => $ship215, 216 => $ship216, 209 => $ship209, 223 => $ship223, 219 => $ship219, 210 => $ship210, 224 => $ship224);
				

				break;
				case 14:
				$fleetArray = array(210 => 1);
				

				break;
		}
		$fleetArray						= array_filter($fleetArray);
		if(empty($fleetArray)) {
			$this->printMessage('<span class="rouge">NO ARRAY</span>');
		}
		$targetData	= $GLOBALS['DATABASE']->getFirstRow("SELECT planet.id_owner as id_owner, 
										planet.id as id, 
										planet.name as name, 
										planet.galaxy as galaxy, 
										planet.system as system, 
										planet.planet as planet,
										planet.planet_type as planet_type, 
										planet.teleport_portal as teleport_portal, 
										planet.force_field_timer as force_field_timer, 
										total_points, onlinetime, urlaubs_modus, banaday, forcefield_tech, authattack, user_deleted, username
										FROM ".PLANETS." planet
										INNER JOIN ".USERS." user ON planet.id_owner = user.id
										LEFT JOIN ".STATPOINTS." as stat ON stat.id_owner = user.id AND stat.stat_type = '1' 
										WHERE planet.galaxy = '1' AND planet.system = ".$system." AND planet.planet = ".$planet.";");
									
		$galaxy = 1;
		$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
		$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array($galaxy, $system, $planet));
		$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
		$Duration			= 1;
		$consumption		= 0;	
		
		$fleetRessource	= array(
			901	=> 0,
			902	=> 0,
			903	=> 0,
			904	=> 0,
		);
		$fleetPopulation	= array(
			301	=> $population301,
			302	=> $population302,
			303	=> $population303,
			304	=> $population304,
			305	=> $population305,
			306	=> $population306,
			307	=> $population307,
			308	=> $population308,
			309	=> $population309,
		);
		
		$PLANET[$resource[901]]	-= $fleetRessource[901];
		$PLANET[$resource[902]]	-= $fleetRessource[902];
		$PLANET[$resource[903]]	-= $fleetRessource[903];
		$PLANET[$resource[904]]	-= $fleetRessource[904];
		
		$PLANET[$resource[301]]	-= $fleetPopulation[301];
		$PLANET[$resource[302]]	-= $fleetPopulation[302];
		$PLANET[$resource[303]]	-= $fleetPopulation[303];
		$PLANET[$resource[304]]	-= $fleetPopulation[304];
		$PLANET[$resource[305]]	-= $fleetPopulation[305];
		$PLANET[$resource[306]]	-= $fleetPopulation[306];
		$PLANET[$resource[307]]	-= $fleetPopulation[307];
		$PLANET[$resource[308]]	-= $fleetPopulation[308];
		$PLANET[$resource[309]]	-= $fleetPopulation[309];
		
		$fleetStartTime		= $Duration + TIMESTAMP;
		$fleetStayTime		= $fleetStartTime;
		$fleetEndTime		= $fleetStayTime + 1;
		
		$shipID				= array_keys($fleetArray);
		
		FleetFunctions::sendFleet($fleetArray, $mission, $USER['id'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'],$targetData['id_owner'], $targetData['id'], $targetData['galaxy'], $targetData['system'], $targetData['planet'], $targetData['planet_type'], $fleetRessource, $fleetPopulation, $specialized, $fleetStartTime, $fleetStayTime, $fleetEndTime);
		
		$this->printMessage('<span class="vert">OK</span>');
	
		$this->tplObj->assign_vars(array(
				
		));
	}
}

	