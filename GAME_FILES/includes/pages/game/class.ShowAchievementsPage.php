<?php

class ShowAchievementsPage extends AbstractPage
{
    public static $requireModule = MODULE_ACHIEVEMENTS;
	
	function __construct() 
	{
	parent::__construct();
	}
	
	function show(){
	global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
	
	/*$allowedArray = array(1,2);
	if(!in_array($USER['id'], $allowedArray)){
		$this->printMessage('This page is being repaired by the team. / Cette page et en reparation chez les administrateurs.', true, array('game.php?page=overview', 2));
		die();
	}*/
		
	if($USER['date_of_birth'] != 0 && $USER['sexe'] != null && $USER['achievement_todo'] == 1){
	$PLANET['metal'] += 100000;
	$PLANET['crystal'] += 100000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '2' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['solar_plant'] >= 3 && $USER['achievement_todo'] == 2){
	$PLANET['metal'] += 100000;
	$PLANET['crystal'] += 50000;
	$PLANET['deuterium'] += 20000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '3' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['metal_mine'] >= 3 && $USER['achievement_todo'] == 3){
	$PLANET['metal'] += 300000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '4' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['crystal_mine'] >= 5 && $PLANET['deuterium_sintetizer'] >= 5 && $PLANET['elyrium_mine'] >= 5 && $USER['achievement_todo'] == 4){
	$PLANET['metal'] += 300000;
	$PLANET['crystal'] += 200000;
	$PLANET['deuterium'] += 150000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '5' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['metal_mine'] >= 10 && $PLANET['crystal_mine'] >= 10 && $PLANET['deuterium_sintetizer'] >= 10 && $PLANET['elyrium_mine'] >= 10 && $USER['achievement_todo'] == 5){
	$PLANET['metal'] += 500000;
	$PLANET['crystal'] += 300000;
	$PLANET['deuterium'] += 150000;
	$PLANET['elyrium'] += 100000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '6' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['robot_factory'] >= 7 && $USER['achievement_todo'] == 6){
	$PLANET['metal'] += 500000;
	$PLANET['crystal'] += 400000;
	$PLANET['deuterium'] += 300000;
	$PLANET['elyrium'] += 150000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '7' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['laboratory'] >= 7 && $USER['achievement_todo'] == 7){
	$PLANET['metal'] += 500000;
	$PLANET['crystal'] += 400000;
	$PLANET['deuterium'] += 300000;
	$PLANET['elyrium'] += 150000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '8' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['metal_store'] >= 3 && $PLANET['crystal_store'] >= 3 && $USER['defence_tech'] >= 3 && $USER['achievement_todo'] == 8){
	$PLANET['metal'] += 1000000;
	$PLANET['crystal'] += 300000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '9' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['barracks'] >= 6 && $USER['control_room_tech'] >= 6 && $USER['achievement_todo'] == 9){
	$PLANET['metal'] += 1000000;
	$PLANET['crystal'] += 300000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '10' WHERE id = ".$USER['id']." ;");
	}
	if($USER['energy_tech'] >= 6 && $USER['control_room_tech'] >= 6 && $USER['particle_tech'] >= 4 && $USER['achievement_todo'] == 10){
	$PLANET['metal'] += 800000;
	$PLANET['crystal'] += 600000;
	$PLANET['deuterium'] += 400000;
	$PLANET['elyrium'] += 200000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '11' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['barracks'] >= 7 && $PLANET['scientist'] >= 200 && $PLANET['soldier'] >= 300 && $USER['achievement_todo'] == 11){
	$PLANET['metal'] += 1500000;
	$PLANET['crystal'] += 1000000;
	
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '12' WHERE id = ".$USER['id']." ;");
	}
	$iPlanetCount 	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".PLANETS." WHERE `id_owner` = '". $USER['id'] ."' AND `planet_type` = '1' AND `destruyed` = '0';");
	if($iPlanetCount >= 2 && $USER['achievement_todo'] == 12){
	if($USER['mode_chaine'] < TIMESTAMP){
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET mode_chaine = '".(TIMESTAMP + 5 * 24 * 3600)."', achievement_todo = '13' WHERE id = ".$USER['id']." ;");
	}else{
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET mode_chaine = mode_chaine + '".(5 * 24 * 3600)."', achievement_todo = '13' WHERE id = ".$USER['id']." ;");
	}
	}
	if($PLANET['hangar'] >= 7 && $USER['infrastructure_tech'] >= 5 && $USER['combustion_tech'] >= 4 && $USER['energy_tech'] >= 7 && $USER['achievement_todo'] == 13){
	$PLANET['metal'] += 1000000;
	$PLANET['crystal'] += 700000;
	$PLANET['deuterium'] += 500000;
	$PLANET['elyrium'] += 450000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '14' WHERE id = ".$USER['id']." ;");
	}
	if($PLANET['hangar'] >= 9 && $PLANET[$resource[45]] >= 10 && $USER['achievement_todo'] == 14){
	$PLANET['metal'] += 2000000;
	$PLANET['crystal'] += 2000000;
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET achievement_todo = '15' WHERE id = ".$USER['id']." ;");
	}
	
	
	$OwnShips			= explode(';', $PLANET['specialships']);	
	$totlaShips			= 0;
	if(!empty($PLANET['specialships'])){
		foreach($OwnShips as $Items)
		{
			$temp 			= explode(',', $Items);
			if($temp[1] == 0)
				continue;
			$totlaShips		+= $temp[1];
		}	
	}	
	
	if($totlaShips >= 1 && $USER['achievement_todo'] == 15){
		if($USER['mode_rapide'] < TIMESTAMP){
		$USER['darkmatter'] +=5;
		$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET mode_rapide = '".(TIMESTAMP + 5 * 24 * 3600)."', achievement_todo = '16' WHERE id = ".$USER['id']." ;");
		}else{
		$USER['darkmatter'] +=5;
		$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET mode_rapide = mode_rapide + '".(5 * 24 * 3600)."', achievement_todo = '16' WHERE id = ".$USER['id']." ;");
		}
		$GLOBALS['DATABASE']->query("INSERT INTO `uni1_paysafecard_log` VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."', '".$USER['id']."',  '".TIMESTAMP."', '".$LNG['achat_succes_11']."', '0','5', '".$LNG['achat_succes_10']."', '1', '0');");
	} 
	
	$Details = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE `id` = '".$USER['id']."';");
	
	$this->tplObj->loadscript('achievements.js');
	$this->tplObj->assign_vars(
	array(
    'achievement_todo' => $Details['achievement_todo'],                         
   //'achievement_todo' => 16,                         
	));
	$this->display("page.achievements.default.tpl");
	}
}