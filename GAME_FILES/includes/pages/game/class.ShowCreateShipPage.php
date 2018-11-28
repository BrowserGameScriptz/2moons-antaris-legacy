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

class ShowCreateShipPage extends AbstractPage
{
	public static $requireModule = MODULE_CREATESHIP;

	function __construct() 
	{
		parent::__construct();
	}
	function is_image($path)
	{
		$img_url = $path;
		$img_formats = array("png", "jpg", "jpeg");//Etc. . . 
		$path_info = pathinfo($img_url);
		if (in_array(strtolower($path_info['extension']), $img_formats)) {
			return true;
		}

		return false;
	}
	
	function pieces()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		$getInfrastructure = $GLOBALS['DATABASE']->query("SELECT DISTINCT * FROM ".VARS_INFRA.";");
		while($xb = $GLOBALS['DATABASE']->fetch_array($getInfrastructure)){
			$infrastructureData[$xb['id']]	= array(
				'nom'					=> $LNG['INFRASTRUCTURE'][$xb['id']],
				'fret'					=> pretty_number($xb['fret']),
				'cost901'				=> pretty_number($xb['cost901']),
				'cost902'				=> pretty_number($xb['cost902']),
				'cost903'				=> pretty_number($xb['cost903']),
				'cost904'				=> pretty_number($xb['cost904']),
				'soldier'				=> pretty_number($xb['soldier']),
				'technician'			=> pretty_number($xb['technician']),
				'scientist'				=> pretty_number($xb['scientist']),
				'pilots'				=> pretty_number($xb['pilots']),
				'mouvement'				=> $xb['mouvement'],
				'poids'					=> pretty_number($xb['poids']),
			);
		}
		
		$getComposant = $GLOBALS['DATABASE']->query("SELECT DISTINCT * FROM ".VARS_COMPO.";");
		while($xb = $GLOBALS['DATABASE']->fetch_array($getComposant)){
			if($xb['type'] == 1)
				$type = $LNG['NOUVEAUTE_413'];
			elseif($xb['type'] == 2)
				$type = $LNG['NOUVEAUTE_414'];
			elseif($xb['type'] == 3)
				$type = $LNG['NOUVEAUTE_415'];
			elseif($xb['type'] == 4)
				$type = $LNG['NOUVEAUTE_416'];
			elseif($xb['type'] == 5)
				$type = $LNG['NOUVEAUTE_417'];
			elseif($xb['type'] == 6)
				$type = $LNG['NOUVEAUTE_418'];
			elseif($xb['type'] == 7)
				$type = $LNG['NOUVEAUTE_419'];
			
			$composantData[$xb['id']]	= array(
				'nom'					=> $LNG['COMPOSANT'][$xb['id']],
				'fret'					=> pretty_number($xb['fret']),
				'cost901'				=> pretty_number($xb['cost901']),
				'cost902'				=> pretty_number($xb['cost902']),
				'cost903'				=> pretty_number($xb['cost903']),
				'cost904'				=> pretty_number($xb['cost904']),
				'cost221'				=> pretty_number($xb['cost221']),
				'cost221'				=> pretty_number($xb['cost221']),
				'valeur'				=> pretty_number($xb['valeur']),
				'type'					=> $type,
			);
		}
				
		$this->tplObj->assign_vars(array(	
			'infrastructureData'		=> $infrastructureData,
			'composantData'				=> $composantData,
		));
		$this->display('page.createship.pieces.tpl');
	}
	
	private function BuildAuftr($fmenge)
	{
		global $USER, $PLANET, $reslist, $CONF, $resource;	
		$NewQueue	= array();
		foreach($fmenge as $Element => $Count)
		{
			
			$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$Element.";");
			
			$CheckRequire = array();
			$allowedArray	= array(1201,1202,1203,1204,1205,1206,1207,1208,1209,1210,1211,1212,1213,1214,1215,1216,1217,1218,1219,1220,1221,1222,1223,1224,1225,1226,1227,1228,1229,1230,1231,1232,1233,1234,1235,1236);
			for ($i = 1; $i <= 36; $i++) {
				if($getUserShip['composant_'.$i] >= 1){
					$NewValue	=	$i - 1;
					$CheckRequire[] = $allowedArray[$NewValue];
				}
			}
			
			$CheckRequire[] = ($getUserShip['id_infrastructure']+1100);
			$CheckRequires 	= implode(';', $CheckRequire);
			$CheckRequireT	= explode(';', $CheckRequires);
			
			$techTreeList		 = array();
			$requirementsList	= array();
			$AllTechB		=	0;
			foreach($CheckRequireT as $webId){
				
				if(isset($requeriments[$webId]))
				{
					foreach($requeriments[$webId] as $requireID => $RedCount){
						$Red	=	$RedCount;
						$Req	=	isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]];
						
						if($Red > $Req){
							$AllTechB	+=	1;
							$requirementsList[$requireID]	= array(
								'count' => $RedCount,
								'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
							);
						}
					}
				}
			}
			
			$techTreeList[$webId]	= $requirementsList;
			 
			if(empty($Count) || empty($getUserShip) || $AllTechB != 0) {
				continue;
			}
			
			$MaxElements 	= BuildFunctions::getMaxConstructibleOwn($USER, $PLANET, $getUserShip['varId'], $getUserShip['cost901'], $getUserShip['cost902'], $getUserShip['cost903'], $getUserShip['cost904']);
			$Count			= is_numeric($Count) ? round($Count) : 0;
			$Count 			= max(min($Count, Config::get('max_fleet_per_build')), 0);
			$Count 			= min($Count, $MaxElements);
						
			if(empty($Count))
				continue;
					
			if(($getUserShip['cost901']*$Count) != 0) { $PLANET[$resource[901]]	-= ($getUserShip['cost901']*$Count); }
			if(($getUserShip['cost902']*$Count) != 0) { $PLANET[$resource[902]]	-= ($getUserShip['cost902']*$Count); }
			if(($getUserShip['cost903']*$Count) != 0) { $PLANET[$resource[903]]	-= ($getUserShip['cost903']*$Count); }
			if(($getUserShip['cost904']*$Count) != 0) { $PLANET[$resource[904]]	-= ($getUserShip['cost904']*$Count); }
			
			$BuildQueue		= explode(';', $PLANET['ownCount']);
			$BuildArray					= array();
			$insideId	= 0;
			if(!empty($PLANET['ownCount'])){
				foreach($BuildQueue as $Item)
				{
					$temp = explode(',', $Item);
					$BuildArray[] 		= array($temp[0], $temp[1]);
				}
				
				$Done		= false;
				foreach($BuildArray as $Item)
				{
					$ElementY   = $Item[0];
					$inBuild    = $Item[1];
					$NewQueue[]	= $ElementY.','.$inBuild;
				}
			}
			
			$NewQueue[]	= $Element.','.$Count;
		}
		
		$PLANET['ownCount'] = implode(';', $NewQueue);
		$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ownCount = '".implode(';', $NewQueue)."' WHERE id = ".$PLANET['id'].";");
	}  
		
	function ships()
	{
		global $LNG, $resource, $USER, $PLANET, $requeriments;
		
		$fmenge	= isset($_POST['fmenge']) ? $_POST['fmenge'] : array();
		
		if (!empty($fmenge) && $USER['urlaubs_modus'] == 0) {
			$this->BuildAuftr($fmenge);
		}
		
		$getUserShips = $GLOBALS['DATABASE']->query("SELECT * FROM ".VARS_USER." WHERE owerId = ".$USER['id'].";");
		
		$Fastmode = 0;
		if($USER['mode_rapide'] > TIMESTAMP){
			$Fastmode = 0.20;	
		}
		$shipData = array();
		foreach($getUserShips as $xb){
			$AllComposant = array();
			$CheckRequire = array();
			$allowedArray	= array(1201,1202,1203,1204,1205,1206,1207,1208,1209,1210,1211,1212,1213,1214,1215,1216,1217,1218,1219,1220,1221,1222,1223,1224,1225,1226,1227,1228,1229,1230,1231,1232,1233,1234,1235,1236);
			for ($i = 1; $i <= 36; $i++) {
				if($xb['composant_'.$i] >= 1){
					$NewValue	=	$i - 1;
					$AllComposant[] = "<span class=\'couleur_theme\'>".$xb['composant_'.$i]."</span> <b>x</b> ".$LNG['tech'][$allowedArray[$NewValue]];
					$CheckRequire[] = $allowedArray[$NewValue];
				}
			}
			
			$CheckRequire[] = ($xb['id_infrastructure']+1100);
			$CheckRequires 	= implode(';', $CheckRequire);
			$CheckRequireT	= explode(';', $CheckRequires);
			
			$techTreeList		 = array();
			$requirementsList	= array();
			$AllTechB		=	0;
			foreach($CheckRequireT as $webId){
				
				if(isset($requeriments[$webId]))
				{
					foreach($requeriments[$webId] as $requireID => $RedCount){
						$Red	=	$RedCount;
						$Req	=	isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]];
						
						if($Red > $Req){
							$AllTechB	+=	1;
							$requirementsList[$requireID]	= array(
								'count' => $RedCount,
								'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
							);
						}
					}
				}
			}

			$ElementOwn 		= explode(';', $PLANET['specialships']);
			$getShipCount	 	= 0;
			if(!empty($ElementOwn))
			{
				foreach($ElementOwn as $OwnShip)
				{
					$temp = explode(',', $OwnShip);
					if($xb['varId'] == $temp[0])
						$getShipCount = $temp[1];
					
				}
			}
			
			$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
			
			
			$techTreeList[$webId]	= $requirementsList;
			$MaxElements 	= BuildFunctions::getMaxConstructibleOwn($USER, $PLANET, $xb['varId'], $xb['cost901'], $xb['cost902'], $xb['cost903'], $xb['cost904']);
			$buyable		= BuildFunctions::isElementBuyableOwn($USER, $PLANET, $xb['cost901'], $xb['cost902'], $xb['cost903'], $xb['cost904']);
			$poundA			= (int) $liste_infrastructure[$xb['id_infrastructure']]['poids'];
			
			$Siege = 0;
			if($PLANET['siege_on'] > TIMESTAMP){
				$Siege = 1;	
			}
			 
			$AcuTimeOwn = $xb['constructionTime'];
			if($Siege == 1){
				for ($i = 0; $i < $PLANET[$resource[5]]; $i++) {
					$AcuTimeOwn	/=  1.50;
				}
			}
			
			for ($i = 0; $i < $PLANET[$resource[14]]; $i++) {
				$AcuTimeOwn	/=  1.05;
			}
			
			for ($i = 0; $i < $PLANET[$resource[21]]; $i++) {
				$AcuTimeOwn	/=  1.08;
			}
		
			$shipData[$xb['varId']]	= array(
				'nom'					=> $xb['nom'],
				'image'					=> $xb['image'],
				'id_infrastructure'		=> $xb['id_infrastructure'],
				'cost901'				=> pretty_number($xb['cost901']),
				'cost902'				=> pretty_number($xb['cost902']),
				'cost903'				=> pretty_number($xb['cost903']),
				'cost904'				=> pretty_number($xb['cost904']),
				'shipAttack'			=> $xb['shipAttack'],
				'shipBouclier'			=> $xb['shipBouclier'],
				'shipCoque'				=> $xb['shipCoque'],
				'shipSpeed'				=> $xb['shipSpeed'],
				'shipHyperspace'		=> $xb['shipHyperspace'],
				'shipFret'				=> pretty_number($xb['shipFret']),
				'constructionTime'		=> gmdate("H:i:s", $AcuTimeOwn),
				'shipType'				=> $LNG['INFRASTRUCTURE'][$xb['id_infrastructure']],
				'AllComposant'			=> $AllComposant,
				'AllTech'				=> $techTreeList,
				'AllTechB'				=> $AllTechB,
				'buyable'				=> $buyable,
				'maxBuildableB'			=> $MaxElements,
				'getShipCount'			=> $getShipCount,
				'speedpercent'			=> round(($xb['shipSpeed']/$poundA*1e4/100),2),
				'maxBuildable'			=> sprintf($LNG['NOUVEAUTE_325'], pretty_number($MaxElements)),
			);
		}
		
		$Google = $GLOBALS['DATABASE']->getFirstRow("SELECT ownCount FROM ".PLANETS." WHERE id = ".$PLANET['id'].";");
		
		$elementInQueue	= array();
		$ElementQueue 	= explode(';', $Google['ownCount']);
		$Buildlist		= array();
		if(!empty($ElementQueue))
		{
			$Shipyard		= array();
			$QueueTime		= 0;
			$BuildArray		= array();
			
			if(!empty($Google['ownCount'])){
				foreach($ElementQueue as $Item)
				{
					$temp = explode(',', $Item);
					$BuildArray[] 		= array($temp[0], $temp[1]);
				}

				foreach($BuildArray as $Element)
				{
					if (empty($Element))
						continue;
					
					$ElementY   = $Element[0];
					$inBuild    = $Element[1];
					
					$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT constructionTime, nom FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$ElementY.";");
						
					$elementInQueue[$Element[0]]	= true;
					$ElementTime  	= $getUserShip['constructionTime'];
					$QueueTime   	+= $ElementTime * $Element[1];
					$Shipyard[]		= array($getUserShip['nom'], $Element[1], $ElementTime, $Element[0]);		
				}
			

				$this->tplObj->loadscript('bcmath.js');
				$this->tplObj->loadscript('shipyard.js');
				$this->tplObj->execscript('ShipyardInit();');
				
				$Buildlist	= array(
					'Queue' 				=> $Shipyard,
					'b_hangar_id_plus' 		=> $PLANET['b_vaisseau'],
					'pretty_time_b_hangar' 	=> pretty_time(max($QueueTime - $PLANET['b_vaisseau'],0)),
				);
			}
		}
				
		$this->tplObj->assign_vars(array(	
			'shipData'		=> $shipData,
			'maxlength'		=> strlen(Config::get('max_fleet_per_build')),
			'BuildList'		=> $Buildlist,
		));
		$this->display('page.createship.ships.tpl');
	}
	function show()
	{
		global $LNG, $ProdGrid, $resource, $reslist, $CONF, $pricelist, $USER, $PLANET;
		
		
		$composant		= array();
		$Message		 = "";

		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$nom	 		= HTTP::_GP('nom', '', UTF8_SUPPORT);
			$image	 		= HTTP::_GP('image', "antaris-univers.com");
			$id_infrastructure	 		= HTTP::_GP('id_infrastructure', 1);
			$id_infrastructurea	 		= array(1,2,3,4,5,6,7,8,9);
			//Attaque
			$composant[1]	= HTTP::_GP('composant_1', 0);
			$composant[2]	= HTTP::_GP('composant_2', 0);
			$composant[3]	= HTTP::_GP('composant_3', 0);
			$composant[4]	= HTTP::_GP('composant_4', 0);
			$composant[5]	= HTTP::_GP('composant_5', 0);
			$composant[6]	= HTTP::_GP('composant_6', 0);
			$composant[7]	= HTTP::_GP('composant_7', 0);
			$composant[8]	= HTTP::_GP('composant_8', 0);
			//Fin attaque
			//Coques
			$composant[9]	= HTTP::_GP('composant_9', 0);
			$composant[10]	= HTTP::_GP('composant_10', 0);
			$composant[11]	= HTTP::_GP('composant_11', 0);
			$composant[12]	= HTTP::_GP('composant_12', 0);
			//Fin Coques
			//Bouclier
			$composant[13]	= HTTP::_GP('composant_13', 0);
			$composant[14]	= HTTP::_GP('composant_14', 0);
			$composant[15]	= HTTP::_GP('composant_15', 0);
			//Fin bouclier
			//Reacteur
			$composant[16]	= HTTP::_GP('composant_16', 0);
			$composant[17]	= HTTP::_GP('composant_17', 0);
			$composant[18]	= HTTP::_GP('composant_18', 0);
			$composant[19]	= HTTP::_GP('composant_19', 0);
			$composant[20]	= HTTP::_GP('composant_20', 0);
			$composant[21]	= HTTP::_GP('composant_21', 0);
			$composant[22]	= HTTP::_GP('composant_22', 0);
			$composant[23]	= HTTP::_GP('composant_23', 0);
			$composant[24]	= HTTP::_GP('composant_24', 0);
			$composant[25]	= HTTP::_GP('composant_25', 0);
			$composant[26]	= HTTP::_GP('composant_26', 0);
			//Fin reacteur
			//Autres
			$composant[27]	= HTTP::_GP('composant_27', 0);
			$composant[28]	= HTTP::_GP('composant_28', 0);
			//Fin autres
			//Lance drone
			$composant[29]	= HTTP::_GP('composant_29', 0);
			$composant[30]	= HTTP::_GP('composant_30', 0);
			$composant[31]	= HTTP::_GP('composant_31', 0);
			//Fin lance drone
			//Hangars
			$composant[32]	= HTTP::_GP('composant_32', 0);
			$composant[33]	= HTTP::_GP('composant_33', 0);
			$composant[34]	= HTTP::_GP('composant_34', 0);
			$composant[35]	= HTTP::_GP('composant_35', 0);
			$composant[36]	= HTTP::_GP('composant_36', 0);
			//Fin hangars
			$valid_creation	= HTTP::_GP('valid_creation', 'Créer ce modèle', UTF8_SUPPORT);
			$reactorArray = array(1,2);
			$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
			
			$liste_composant = array("1"=>array("id_composant"=>"1","nom"=>"Station de tir","type"=>"attaque","fer"=>"100","oro"=>"50","cristal"=>"20","elyrium"=>"0","valeur"=>"10","fret"=>"2","temps"=>"20","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"2"=>array("id_composant"=>"2","nom"=>"Canon à ions","type"=>"attaque","fer"=>"500","oro"=>"200","cristal"=>"100","elyrium"=>"0","valeur"=>"80","fret"=>"5","temps"=>"40","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"3"=>array("id_composant"=>"3","nom"=>"Missile IEM","type"=>"attaque","fer"=>"1000","oro"=>"500","cristal"=>"250","elyrium"=>"50","valeur"=>"250","fret"=>"10","temps"=>"100","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"4"=>array("id_composant"=>"4","nom"=>"Canon à plasma","type"=>"attaque","fer"=>"1500","oro"=>"1000","cristal"=>"400","elyrium"=>"150","valeur"=>"600","fret"=>"20","temps"=>"200","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"5"=>array("id_composant"=>"5","nom"=>"Rayon plasma","type"=>"attaque","fer"=>"4000","oro"=>"2500","cristal"=>"1000","elyrium"=>"250","valeur"=>"2000","fret"=>"50","temps"=>"300","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"6"=>array("id_composant"=>"6","nom"=>"Disrupteur","type"=>"attaque","fer"=>"10000","oro"=>"6000","cristal"=>"2500","elyrium"=>"400","valeur"=>"7500","fret"=>"100","temps"=>"400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"7"=>array("id_composant"=>"7","nom"=>"Canon des Antaris","type"=>"attaque","fer"=>"25000","oro"=>"15000","cristal"=>"8000","elyrium"=>"1000","valeur"=>"25000","fret"=>"200","temps"=>"550","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"8"=>array("id_composant"=>"8","nom"=>"Rayon Antaris","type"=>"attaque","fer"=>"35000","oro"=>"22500","cristal"=>"12500","elyrium"=>"1500","valeur"=>"47500","fret"=>"400","temps"=>"600","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"9"=>array("id_composant"=>"9","nom"=>"Coque à petit densité","type"=>"coque","fer"=>"250","oro"=>"100","cristal"=>"10","elyrium"=>"20","valeur"=>"60","fret"=>"4","temps"=>"15","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"10"=>array("id_composant"=>"10","nom"=>"Coque à densité moyenne","type"=>"coque","fer"=>"750","oro"=>"300","cristal"=>"150","elyrium"=>"175","valeur"=>"450","fret"=>"10","temps"=>"30","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"11"=>array("id_composant"=>"11","nom"=>"Coque à grande densité","type"=>"coque","fer"=>"1000","oro"=>"400","cristal"=>"250","elyrium"=>"350","valeur"=>"1000","fret"=>"15","temps"=>"40","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"12"=>array("id_composant"=>"12","nom"=>"Coque des Antaris","type"=>"coque","fer"=>"2000","oro"=>"800","cristal"=>"500","elyrium"=>"500","valeur"=>"3000","fret"=>"30","temps"=>"50","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"13"=>array("id_composant"=>"13","nom"=>"Petit bouclier","type"=>"bouclier","fer"=>"250","oro"=>"100","cristal"=>"175","elyrium"=>"25","valeur"=>"65","fret"=>"4","temps"=>"40","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"14"=>array("id_composant"=>"14","nom"=>"Grand bouclier","type"=>"bouclier","fer"=>"400","oro"=>"200","cristal"=>"425","elyrium"=>"100","valeur"=>"350","fret"=>"8","temps"=>"60","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"15"=>array("id_composant"=>"15","nom"=>"Bouclier des Antaris","type"=>"bouclier","fer"=>"1000","oro"=>"650","cristal"=>"950","elyrium"=>"250","valeur"=>"1200","fret"=>"14","temps"=>"75","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"16"=>array("id_composant"=>"16","nom"=>"Turboréacteur","type"=>"vitesse","fer"=>"750","oro"=>"500","cristal"=>"300","elyrium"=>"0","valeur"=>"5","fret"=>"20","temps"=>"100","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"17"=>array("id_composant"=>"17","nom"=>"Statoréacteur","type"=>"vitesse","fer"=>"1500","oro"=>"1000","cristal"=>"600","elyrium"=>"0","valeur"=>"150","fret"=>"50","temps"=>"125","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"18"=>array("id_composant"=>"18","nom"=>"Propulseur à propergol","type"=>"vitesse","fer"=>"2500","oro"=>"1750","cristal"=>"1000","elyrium"=>"250","valeur"=>"300","fret"=>"100","temps"=>"0","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"19"=>array("id_composant"=>"19","nom"=>"Propulseur hybride","type"=>"vitesse","fer"=>"6000","oro"=>"4000","cristal"=>"2500","elyrium"=>"300","valeur"=>"750","fret"=>"300","temps"=>"225","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"0"),"20"=>array("id_composant"=>"20","nom"=>"Propulseur ionique","type"=>"vitesse","fer"=>"8500","oro"=>"6000","cristal"=>"4000","elyrium"=>"500","valeur"=>"1650","fret"=>"750","temps"=>"250","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"0"),"21"=>array("id_composant"=>"21","nom"=>"Propulseur photonique","type"=>"vitesse","fer"=>"12500","oro"=>"10000","cristal"=>"7500","elyrium"=>"1000","valeur"=>"2000","fret"=>"2800","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"0"),"22"=>array("id_composant"=>"22","nom"=>"Propulseur nucléaire thermique","type"=>"vitesse","fer"=>"20000","oro"=>"15000","cristal"=>"10000","elyrium"=>"5000","valeur"=>"4000","fret"=>"8000","temps"=>"350","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"23"=>array("id_composant"=>"23","nom"=>"Réacteur à antimatière","type"=>"vitesse","fer"=>"45000","oro"=>"30000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"13000","fret"=>"16000","temps"=>"500","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"24"=>array("id_composant"=>"24","nom"=>"Moteur à hyperespace","type"=>"vitesse","fer"=>"130000","oro"=>"100000","cristal"=>"75000","elyrium"=>"75000","valeur"=>"32000","fret"=>"60000","temps"=>"750","infra_min"=>"6","hyperespace"=>"1","hangar_infra"=>"0"),"25"=>array("id_composant"=>"25","nom"=>"Moteur VSL","type"=>"vitesse","fer"=>"160000","oro"=>"125000","cristal"=>"120000","elyrium"=>"90000","valeur"=>"45000","fret"=>"95000","temps"=>"900","infra_min"=>"6","hyperespace"=>"1","hangar_infra"=>"0"),"26"=>array("id_composant"=>"26","nom"=>"Moteur VSL amélioré","type"=>"vitesse","fer"=>"250000","oro"=>"215000","cristal"=>"155000","elyrium"=>"125000","valeur"=>"60000","fret"=>"125000","temps"=>"1400","infra_min"=>"9","hyperespace"=>"1","hangar_infra"=>"0"),"27"=>array("id_composant"=>"27","nom"=>"Installation du siège des Antaris","type"=>"autre","fer"=>"2000000","oro"=>"3000000","cristal"=>"2500000","elyrium"=>"800000","valeur"=>"0","fret"=>"40000","temps"=>"20000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"28"=>array("id_composant"=>"28","nom"=>"Système de téléportation","type"=>"autre","fer"=>"25000","oro"=>"50000","cristal"=>"30000","elyrium"=>"20000","valeur"=>"0","fret"=>"1000","temps"=>"1000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"29"=>array("id_composant"=>"29","nom"=>"Lance-drone à cadence faible","type"=>"drone","fer"=>"240000","oro"=>"180000","cristal"=>"150000","elyrium"=>"75000","valeur"=>"1","fret"=>"1200","temps"=>"3500","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"30"=>array("id_composant"=>"30","nom"=>"Lance-drone à cadence moyenne","type"=>"drone","fer"=>"600000","oro"=>"450000","cristal"=>"300000","elyrium"=>"120000","valeur"=>"4","fret"=>"4800","temps"=>"13000","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"31"=>array("id_composant"=>"31","nom"=>"Lance-drone à cadence rapide","type"=>"drone","fer"=>"1050000","oro"=>"600000","cristal"=>"412500","elyrium"=>"210000","valeur"=>"10","fret"=>"12000","temps"=>"30000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
			
			
			$replacedValue 	= array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36);
			$tota_fret 		= 0;
			$tota_fer 		= $liste_infrastructure[$id_infrastructure]['fer'];
			$tota_or 		= $liste_infrastructure[$id_infrastructure]['oro'];
			$tota_crystal	= $liste_infrastructure[$id_infrastructure]['cristal'];
			$tota_elyrium 	= $liste_infrastructure[$id_infrastructure]['elyrium'];
			$tota_valeur 	= 0;
			$tota_temps 	= $liste_infrastructure[$id_infrastructure]['temps'];
			$tota_atq 		= 0;
			$tota_coq 		= 0;
			$tota_bouc 		= 0;
			$tota_spee 		= 0;
			$tota_hyper 	= 0;
			$tota_fret 		= 0;
			$tota_fret2 		= $liste_infrastructure[$id_infrastructure]['fret'];
			foreach($replacedValue as $Value){
				$result 		= $composant[$Value];
				$tota_fret 		+= $liste_composant[$Value]['fret'] * $result;
				$tota_fer 		+= $liste_composant[$Value]['fer'] * $result;
				$tota_or 		+= $liste_composant[$Value]['oro'] * $result;
				$tota_crystal	+= $liste_composant[$Value]['cristal'] * $result;
				$tota_elyrium 	+= $liste_composant[$Value]['elyrium'] * $result;
				$tota_valeur 	+= $liste_composant[$Value]['valeur'] * $result;
				$tota_temps 	+= $liste_composant[$Value]['temps'] * $result;
				
				if($liste_composant[$Value]['type'] == "attaque")
					$tota_atq 		+= $liste_composant[$Value]['valeur'] * $result;
				elseif($liste_composant[$Value]['type'] == "coque")
					$tota_coq 		+= $liste_composant[$Value]['valeur'] * $result;
				elseif($liste_composant[$Value]['type'] == "bouclier")
					$tota_bouc 		+= $liste_composant[$Value]['valeur'] * $result;
				elseif($liste_composant[$Value]['type'] == "vitesse")
					$tota_spee 		+= $liste_composant[$Value]['valeur'] * $result;
					
				$tota_hyper 	+= $liste_composant[$Value]['hyperespace'] * $result;
				$tota_fret2 	-= $liste_composant[$Value]['fret'] * $result;
			}
			
			$Answer = $composant[16] + $composant[17] + $composant[18] + $composant[19] + $composant[20] + $composant[21] + $composant[22] + $composant[23] + $composant[24] + $composant[25] + $composant[26];
			if(strlen($nom) < 5 || strlen($nom) > 25){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_797']."</span>";
			}elseif(preg_match('#[^a-zA-Z0-9]#',$nom)) {
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_798']."</span>";
			}elseif(!file_exists($image) && !$this->is_image($image)) {
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_799']."</span>";
			}elseif($composant[1] + $composant[2] + $composant[3] + $composant[4] + $composant[5] + $composant[6] + $composant[7] + $composant[8] == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_800']."</span>";
			}elseif($composant[9] + $composant[10] + $composant[11] + $composant[12] == 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_801']."</span>";
			}elseif(!in_array($Answer, $reactorArray)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_802']."</span>";
			}elseif($liste_infrastructure[$id_infrastructure]['fret'] < $tota_fret){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_803']."</span>";
			}elseif(!in_array($id_infrastructure, $id_infrastructurea)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_22']."</span>";
			}else{
				$Message = "<span class='vert'>Le vaisseau « ".$nom." » a été creer</span>";
				$GLOBALS['DATABASE']->query("INSERT INTO ".VARS_USER." VALUES (null, '".$tota_atq."', '".$tota_coq."', '".$tota_bouc."', '".$tota_spee."', '".$tota_hyper."', '".$tota_fret2."', '".$USER['id']."',  '".$GLOBALS['DATABASE']->sql_escape($nom)."', '".$GLOBALS['DATABASE']->sql_escape($image)."', '".$GLOBALS['DATABASE']->sql_escape($id_infrastructure)."', '".$tota_fer."', '".$tota_or."', '".$tota_crystal."', '".$tota_elyrium."', '".$composant[1]."', '".$composant[2]."', '".$composant[3]."', '".$composant[4]."', '".$composant[5]."', '".$composant[6]."', '".$composant[7]."', '".$composant[8]."', '".$composant[9]."', '".$composant[10]."', '".$composant[11]."', '".$composant[12]."', '".$composant[13]."', '".$composant[14]."', '".$composant[15]."', '".$composant[16]."', '".$composant[17]."', '".$composant[18]."', '".$composant[19]."', '".$composant[20]."', '".$composant[21]."', '".$composant[22]."', '".$composant[23]."', '".$composant[24]."', '".$composant[25]."', '".$composant[26]."', '".$composant[27]."', '".$composant[28]."', '".$composant[29]."', '".$composant[30]."', '".$composant[31]."', '".$composant[32]."', '".$composant[33]."', '".$composant[34]."', '".$composant[35]."', '".$composant[36]."', '".$tota_temps."', '0,0,0');");
			}
		}
		$this->tplObj->assign_vars(array(	
			'Message'	=> $Message,
		));
		$this->display('page.createship.default.tpl');
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
				$GLOBALS['DATABASE']->multi_query("DELETE FROM ".FLEETS_MANAGE." WHERE manageID = ".$id_equipe.";UPDATE ".USERS." SET fleet_manage_bis = fleet_manage_bis - 1 WHERE id = ".$USER['id'].";");
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
					if($Element != $id_entite)
						$NewQueue[]	= $Element.','.$Amount;
					
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
			$appareil_226		= abs(HTTP::_GP('appareil_226', 0));
			$fullArray			= array($appareil_226);
			$realIdarray		= array(226);
			$checkArray			= 0;
			$NewQueue = array();
			$NewQueue1 = array();
			foreach($fullArray as $ShipID){
				$NewQueue1[]	= $realIdarray[$checkArray].','.$ShipID;
				$checkArray++;
			}
			
			if(!empty($_POST['vaisseau'] )){
			foreach($_POST['vaisseau'] as $ID => $Value) {
				$GetuserFleets = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".VARS_USER." WHERE varId = ".$GLOBALS['DATABASE']->sql_escape($ID)." AND owerId = ".$USER['id'].";");
				if(empty($GetuserFleets)){
					
				}else{
					$NewQueue[]	= $ID.','.$Value;
				}
			}
			
			$NewQueue	= implode(';', array_merge($NewQueue, $NewQueue1));

			
			
			if(!empty($setupName)){
				$SQL	= "LOCK TABLE ".FLEETS_MANAGE." WRITE, ".USERS." WRITE;
					   UPDATE ".USERS." SET `fleet_manage_bis` = `fleet_manage_bis` + 1 WHERE id = ".$USER['id'].";
					   INSERT INTO uni1_fleets_manage SET
					   `userID`              = ".$USER['id'].",
					   `manage_name`         = '".$GLOBALS['DATABASE']->sql_escape($setupName)."',
					   `manageArray`         = '".$GLOBALS['DATABASE']->sql_escape($NewQueue)."',
					   `manageType`          = 2;
					   SET @manageID = LAST_INSERT_ID();
					   UNLOCK TABLES;";
				$GLOBALS['DATABASE']->multi_query($SQL);
			}
		}else{ 
				header('location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=CreateShip&mode=flotte');
			}
		}
		
		$userComp = array();
		$GetuserComp = $GLOBALS['DATABASE']->query("SELECT * FROM ".FLEETS_MANAGE." WHERE userID = ".$USER['id']." AND manageType = 2 ORDER by manageID ASC;");
		
		
		foreach($GetuserComp as $xb){
			$FLEETLIST			= array();	
			$APPAREILLIST		= array();	
			$fleetTyps		= explode(';', $xb['manageArray']);
			//202,203,225
			$fleetID	= array();
			$fleetAmount	= array();
			$apparails = array(226);
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
				
				$GetuserFleets = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".VARS_USER." WHERE varId = ".$GLOBALS['DATABASE']->sql_escape($fleetID[$temp[0]])." AND owerId = ".$USER['id'].";");
				
				if(!in_array($fleetID[$temp[0]],$apparails)){
					if($fleetAmount[$temp[0]] == 0)
						continue;
					
					$FLEETLIST[$temp[0]]	= array(
						'fleetAmount'		=> $fleetAmount[$temp[0]],
						'fleetID'			=> $fleetID[$temp[0]],
						'image'				=> $GetuserFleets['image'],
						'name'				=> $GetuserFleets['nom'],
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
		$GetuserFleets = $GLOBALS['DATABASE']->query("SELECT * FROM ".VARS_USER." WHERE owerId = ".$USER['id']." ORDER by varId DESC;");
		foreach($GetuserFleets as $popID)
		{
			$population[]	= array(
				'id'	=> $popID['varId'],
				'image'	=> $popID['image'],
				'count'	=> 0,
				'name'	=> strlen($popID['nom']) >= 13 ? substr($popID['nom'],0,13).'...' : $popID['nom'],
			);
		}
		
		$appareil		= array();
		$appareilArray	= array(226);
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
		
		if($USER['fleet_manage_bis'] == 0){
		$this->display('page.fleetgestion.default.tpl');
		}elseif($USER['fleet_manage_bis'] == 1){
		$this->display('page.fleetgestion1.default.tpl');
		}elseif($USER['fleet_manage_bis'] == 2){
		$this->display('page.fleetgestion2.default.tpl');
		}elseif($USER['fleet_manage_bis'] == 3){
		$this->display('page.fleetgestion3.default.tpl');
		}
		
	}
}
