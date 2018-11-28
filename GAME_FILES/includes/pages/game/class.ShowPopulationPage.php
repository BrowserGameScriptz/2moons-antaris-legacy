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

class ShowPopulationPage extends AbstractPage
{
	public static $requireModule = MODULE_POPULATION;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show()
	{
		global $USER, $PLANET, $LNG, $resource, $dpath, $reslist, $CONF;
		$Message = "";
		if($_SERVER['REQUEST_METHOD'] === 'POST'){	
			$population_301		= abs(HTTP::_GP('population_301', 0));
			$population_302		= abs(HTTP::_GP('population_302', 0));
			$population_303		= abs(HTTP::_GP('population_303', 0));
			$population_304		= abs(HTTP::_GP('population_304', 0));
			$population_305		= abs(HTTP::_GP('population_305', 0));
			$population_306		= abs(HTTP::_GP('population_306', 0));
			$population_307		= abs(HTTP::_GP('population_307', 0));
			$population_308		= abs(HTTP::_GP('population_308', 0));
			
			$cost_population_301		= $population_301 * 1;
			$cost_population_302		= $population_302 * 3;
			$cost_population_303		= $population_303 * 4;
			$cost_population_304		= $population_304 * 50;
			$cost_population_305		= $population_305 * 20;
			$cost_population_306		= $population_306 * 12;
			$cost_population_307		= $population_307 * 44;
			$cost_population_308		= $population_308 * 4;
			$MaxPoints = $PLANET['formation'];
			$TotalCost = $cost_population_301 + $cost_population_302 + $cost_population_303 + $cost_population_304 + $cost_population_305 + $cost_population_306 + $cost_population_307 + $cost_population_308;
			if($TotalCost > $MaxPoints){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_341']."</span>";	
			}else{
				$GLOBALS['DATABASE']->query("Update ".PLANETS." SET `civil_prod` = ".$GLOBALS['DATABASE']->sql_escape($population_301).", `technician_prod` = ".$GLOBALS['DATABASE']->sql_escape($population_302).", `scientist_prod` = ".$GLOBALS['DATABASE']->sql_escape($population_303).", `archaeologist_prod` = ".$GLOBALS['DATABASE']->sql_escape($population_304).", `diplomat_prod` = ".$GLOBALS['DATABASE']->sql_escape($population_305).", `soldier_prod` = ".$GLOBALS['DATABASE']->sql_escape($population_306).", `adv_soldier_prod` = ".$GLOBALS['DATABASE']->sql_escape($population_307).", `pilot_prod` = ".$GLOBALS['DATABASE']->sql_escape($population_308).", `formation_used` = ".$TotalCost." WHERE `id` = ".$PLANET['id']." ;");
				$Message = "<span class='vert'>".$LNG['NOUVEAUTE_342']."</span>";
			}
		}
		
		$elementIDs	= array(301,302,303,304,305,306,307,308,309);
		foreach($elementIDs as $Element)
		{	
			$AllTech = array();
			$GetAll = $GLOBALS['DATABASE']->query("SELECT * FROM ".VARS_REQUIRE." WHERE elementID = ".$Element." ;");
			if($GLOBALS['DATABASE']->numRows($GetAll)>0){
				while($x = $GLOBALS['DATABASE']->fetch_array($GetAll)){
					$AllTech[] = $x;
				}
			}
			
			
			$costRessources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element, false, false);
			$Produced = 0;
			$Cost = 0;
			if($Element == 301){
				$Cost = 1;	
			}elseif($Element == 302){
				$Cost = 3;	
			}elseif($Element == 303){
				$Cost = 4;
			}elseif($Element == 304){
				$Cost = 50;	
			}elseif($Element == 305){
				$Cost = 20;	
			}elseif($Element == 306){
				$Cost = 12;	
			}elseif($Element == 307){
				$Cost = 44;	
			}elseif($Element == 308){
				$Cost = 4;	
			}
			$Details = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE `id` = '".$PLANET['id']."';");
			
			if($Element != 309){
				$Produced = $Details[$resource[$Element].'_prod'];
				$TotalCost = $Produced * $Cost;
			}

			$elementList[$Element]	= array(
				'amount'				=> pretty_number(round($Details[$resource[$Element]])),
				'costRessources'		=> $costRessources,
				'Produced'				=> $Produced,
				'TotalCost'				=> $TotalCost,
				'id'					=> $Element,
				'AllTech'				=> $AllTech,
				'techacc' 				=> BuildFunctions::isTechnologieAccessible($USER, $Details, $Element),
			);
		}
		
		$this->tplObj->assign_vars(array(	
			'textbot' => sprintf($LNG['NOUVEAUTE_338'], $Details['formation'] - $Details['formation_used']),
			'notused' => pretty_number($Details['formation'] - $Details['formation_used']),
			'elementList' => $elementList,
			'formation' => pretty_number($Details['formation']),
			'formationBis' => $Details['formation'],
			'Message' => $Message,
		));
		
		$this->display('page.population.default.tpl');
	}
	
	function ajax()
	{
		global $USER;
		
		$action			= HTTP::_GP('action', "", UTF8_SUPPORT);
		$id_equipe		= HTTP::_GP('id_equipe', 0);
		
		if($action == "modifierNomEquipe"){
			$nom			= HTTP::_GP('nom', "", UTF8_SUPPORT);
			//echo "<script type=\"text/javascript\">apprise(\"<b>Vous devez mettre au moins une population ou un appareil dans votre équipe pour la créer.</b>\", {'maxWidthWindow' : 400, 'alert' : true});</script>";
			$fleetInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".FLEETS_MANAGE." WHERE manageID = ".$id_equipe.";");
			
			if(empty($fleetInfo)){
				
			}elseif($USER['id'] != $fleetInfo['userID']){
				
			}elseif($fleetInfo['manage_name'] == $nom){
			
			}elseif(!CheckName($nom)) {
				
			}elseif(strlen($nom) < 3 || strlen($nom) > 18) {
				
			}else{
				$GLOBALS['DATABASE']->query("UPDATE ".FLEETS_MANAGE." SET
					manage_name = '".$GLOBALS['DATABASE']->sql_escape($nom)."'
					WHERE manageID = ".$GLOBALS['DATABASE']->sql_escape($id_equipe).";");
				
			}
		}elseif($action == "supprimerEquipe"){
			$fleetInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".FLEETS_MANAGE." WHERE manageID = ".$id_equipe.";");
			
			if(empty($fleetInfo)){
				
			}elseif($USER['id'] != $fleetInfo['userID']){
				
			}else{
				$GLOBALS['DATABASE']->multi_query("DELETE FROM ".FLEETS_MANAGE." WHERE manageID = ".$id_equipe.";UPDATE ".USERS." SET fleet_manage = fleet_manage - 1 WHERE id = ".$USER['id'].";");
			}
		}elseif($action == "modifierCouleurEquipe"){
			$couleur			= HTTP::_GP('couleur', "", UTF8_SUPPORT);
			$couleurAllowed 	= array('vert', 'chartreuse', 'jaune', 'orange', 'cyan', 'rose', 'violet', 'blanc');
			$fleetInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".FLEETS_MANAGE." WHERE manageID = ".$id_equipe.";");
			
			if(empty($fleetInfo)){
				echo "location.reload";
			}elseif($USER['id'] != $fleetInfo['userID']){
				echo "location.reload";
			}else{
				$GLOBALS['DATABASE']->query("UPDATE ".FLEETS_MANAGE." SET
					couleur = '".$GLOBALS['DATABASE']->sql_escape($couleur)."'
					WHERE manageID = ".$GLOBALS['DATABASE']->sql_escape($id_equipe).";");
			}
		}elseif($action == "supprimerElementEquipe"){
			$id_entite			= HTTP::_GP('id_entite', 0);
			$fleetInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".FLEETS_MANAGE." WHERE manageID = ".$id_equipe.";");
			
			if(empty($fleetInfo)){
				echo "location.reload";
			}elseif($USER['id'] != $fleetInfo['userID']){
				echo "location.reload";
			}else{
				$BuildQueue		= explode(';', $fleetInfo['manageArray']);
				$BuildArray					= array();
				$fleetDit		= array();
				foreach($BuildQueue as $Item)
				{
					$temp = explode(',', $Item);
					$BuildArray[] 		= array($temp[0], $temp[1]);
				}
				$NewQueue	= array();
				foreach($BuildArray as $Item)
				{
					$Element   = $Item[0];
					$Amount     = $Item[1];
					if($Element != $id_entite){
						$NewQueue[]	= $Element.','.$Amount;
					}else{
						$NewQueue[]	= $Element.',0';
					}
				}
				$News = !empty($NewQueue) ? implode(';', $NewQueue) : '';
				$GLOBALS['DATABASE']->query("UPDATE ".FLEETS_MANAGE." SET
					manageArray = '".$News."'
					WHERE manageID = ".$GLOBALS['DATABASE']->sql_escape($id_equipe).";");
			}
		}
	}
	function flotte()
	{
		global $USER, $PLANET, $LNG, $resource, $dpath, $reslist, $CONF;
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){	
			$setupName			= HTTP::_GP('setupName', "", UTF8_SUPPORT);
			$population_301		= abs(HTTP::_GP('population_301', 0));
			$population_302		= abs(HTTP::_GP('population_302', 0));
			$population_303		= abs(HTTP::_GP('population_303', 0));
			$population_304		= abs(HTTP::_GP('population_304', 0));
			$population_305		= abs(HTTP::_GP('population_305', 0));
			$population_306		= abs(HTTP::_GP('population_306', 0));
			$population_307		= abs(HTTP::_GP('population_307', 0));
			$population_308		= abs(HTTP::_GP('population_308', 0));
			$population_309		= abs(HTTP::_GP('population_309', 0));
			$appareil_202		= abs(HTTP::_GP('appareil_202', 0));
			$appareil_203		= abs(HTTP::_GP('appareil_203', 0));
			$appareil_225		= abs(HTTP::_GP('appareil_225', 0));
			
			$fullArray			= array($population_301, $population_302, $population_303, $population_304, $population_305, $population_306, $population_307, $population_308, $population_309, $appareil_202, $appareil_203, $appareil_225);
			$realIdarray		= array(301,302,303,304,305,306,307,308,309,202,203,225);
			$checkArray			= 0;
			foreach($fullArray as $ShipID){
				$NewQueue[]	= $realIdarray[$checkArray].','.$ShipID;
				$checkArray++;
			}
			$NewQueue	= implode(';', $NewQueue);
			
			if(!empty($setupName)){
				$SQL	= "LOCK TABLE ".FLEETS_MANAGE." WRITE, ".USERS." WRITE;
					   UPDATE ".USERS." SET `fleet_manage` = `fleet_manage` + 1 WHERE id = ".$USER['id'].";
					   INSERT INTO uni1_fleets_manage SET
					   `userID`              = ".$USER['id'].",
					   `manage_name`         = '".$GLOBALS['DATABASE']->sql_escape($setupName)."',
					   `manageArray`         = '".$GLOBALS['DATABASE']->sql_escape($NewQueue)."',
					   `manageType`          = 1;
					   SET @manageID = LAST_INSERT_ID();
					   UNLOCK TABLES;";
				$GLOBALS['DATABASE']->multi_query($SQL);
			}
		}
		
		$userComp = array();
		$GetuserComp = $GLOBALS['DATABASE']->query("SELECT * FROM ".FLEETS_MANAGE." WHERE userID = ".$USER['id']." AND manageType = 1 ORDER by manageID ASC;");
		
		
		foreach($GetuserComp as $xb){
			$FLEETLIST			= array();	
			$APPAREILLIST		= array();	
			$fleetTyps		= explode(';', $xb['manageArray']);
			//202,203,225
			$fleetID	= array();
			$fleetAmount	= array();
			$apparails = array(202,203,225);
			foreach ($fleetTyps as $fleetTyp)
			{
				$temp = explode(',', $fleetTyp);
				
				if (!isset($fleetAmount[$temp[0]]))
				{
					$fleetID[$temp[0]] = 0;
					$fleetAmount[$temp[0]] = 0;
				}
				
				$fleetID[$temp[0]] = $temp[0];
				$fleetAmount[$temp[0]] = $temp[1];
				
				
				
				if(!in_array($fleetID[$temp[0]],$apparails)){
					if($fleetAmount[$temp[0]] == 0)
						continue;
					
					$FLEETLIST[$temp[0]]	= array(
						'fleetAmount'		=> $fleetAmount[$temp[0]],
						'fleetID'		=> $fleetID[$temp[0]],
					);
				}else{
					if($fleetAmount[$temp[0]] == 0)
						continue;
					
					$APPAREILLIST[$temp[0]]	= array(
						'fleetAmount'		=> $fleetAmount[$temp[0]],
						'fleetID'		=> $fleetID[$temp[0]],
					);
				}
			}
			
			$userComp[$xb['manageID']]	= array(
				'manage_name'		=> $xb['manage_name'],
				'couleur'			=> $xb['couleur'],
				'FLEETLIST'			=> $FLEETLIST,
				'APPAREILLIST'		=> $APPAREILLIST,
			);
		}
			
		$population		= array();
		$popArray	 	= array(301,302,303,304,305,306,307,308,309);
		foreach($popArray as $popID)
		{
			$population[]	= array(
				'id'	=> $popID,
				'count'	=> $PLANET[$resource[$popID]],
				'name'	=> strlen($LNG['tech'][$popID]) >= 13 ? substr($LNG['tech'][$popID],0,13).'...' : $LNG['tech'][$popID],
			);
		}
		
		$appareil		= array();
		$appareilArray	= array(202,203,225);
		foreach($appareilArray as $appID)
		{
			$appareil[]	= array(
				'id'	=> $appID,
				'count'	=> $PLANET[$resource[$appID]],
				'name'	=> strlen($LNG['tech'][$appID]) >= 13 ? substr($LNG['tech'][$appID],0,13).'...' : $LNG['tech'][$appID],
			);
		}
		
		
		$this->tplObj->assign_vars(array(	
			'population'		=> $population,
			'appareil'			=> $appareil,
			'userComp' 			=> $userComp,
		));
		
		if($USER['fleet_manage'] == 0){
		$this->display('page.population.flotte.tpl');
		}elseif($USER['fleet_manage'] == 1){
		$this->display('page.population.flotte1.tpl');
		}elseif($USER['fleet_manage'] == 2){
		$this->display('page.population.flotte2.tpl');
		}elseif($USER['fleet_manage'] == 3){
		$this->display('page.population.flotte3.tpl');
		}
		
	}
}
