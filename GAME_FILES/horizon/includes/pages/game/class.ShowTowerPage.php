<?php

class ShowTowerPage extends AbstractPage
{
    public static $requireModule = MODULE_TOWER;
	
	function __construct() 
	{
		parent::__construct();
	}
	
	function show(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		if(!empty($USER['urlaubs_modus'])){
			$this->printMessage($LNG['vmodeblock'], true, array('game.php?page=Overview', 2));
			die();
		}
		$allowDelete = 0;
		if($PLANET['id'] == $USER['id_planet']){
			$allowDelete = 1;
		}
		$this->tplObj->assign_vars(array(
			'antaris_headpost' => $PLANET['antaris_headpost'],  
			'headquarters_antaris' => $PLANET['headquarters_antaris'], 
			'namer' => $PLANET['name'],                                
			'galaxy' => $PLANET['galaxy'],                                
			'system' => $PLANET['system'],                                
			'planet' => $PLANET['planet'],   			
			'planetidd' => $PLANET['id'],  
			'planetimage' => $PLANET['image'], 		
			'allowDelete' => $allowDelete,   			
		));
		$this->display("page.tower.default.tpl");
	}
	
	function rename() 
	{
		global $LNG, $PLANET;
		$newname        = HTTP::_GP('name', '', UTF8_SUPPORT);
		if (!empty($newname))
		{
			if($PLANET['name'] == $newname){
				$Message = "<span class='orange'>".$LNG['NOUVEAUTE_346']."</span>";
				echo ($Message);
			}elseif(!CheckName($newname)) {
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_348']."</span>";
				echo ($Message);
			}elseif(strlen($newname) < 5 || strlen($newname) > 18) {
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_347']."</span>";
				echo ($Message);
			}else {
				$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET name = '".$GLOBALS['DATABASE']->sql_escape($newname)."' WHERE id = ".$PLANET['id'].";");
				$Message = "<span class='vert'>".$LNG['NOUVEAUTE_349']."</span>";
				echo ($Message);
			}
		}
	}
	
	function newimage(){
		global $PLANET;
		$this->tplObj->assign_vars(array(
			'antaris_headpost' => $PLANET['antaris_headpost'],  
			'headquarters_antaris' => $PLANET['headquarters_antaris'], 			   	   
		));
		$this->display("page.tower.newimage.tpl");
	}
	
	function newimagecheck(){
		global $PLANET, $LNG;
		$newImage		= abs(HTTP::_GP('imageid', 1));	
		if(!is_numeric($newImage)){
			$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_352']."</span>";
			$this->sendJSON($Message);	
		}elseif($newImage < 1 || $newImage > 44){
			$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_351']."</span>";
			$this->sendJSON($Message);	
		}else{
			$Message = "<span class='vert'>".$LNG['NOUVEAUTE_353']."</span>";
			$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET  image  = '".$GLOBALS['DATABASE']->sql_escape($newImage)."' WHERE id = '".$PLANET['id']."'");
			$this->sendJSON($Message);	
		}
	}
	
	function delete(){
		global $USER, $PLANET, $LNG;
		
		$Message = "";
		$Lose 			= 1;
		if($_SERVER['REQUEST_METHOD'] === 'POST'){	
			$password		= HTTP::_GP('password', '', true);
			
			if (!empty($password))
			{
				$IfFleets	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".FLEETS." WHERE 
				(
					fleet_owner = '".$USER['id']."'
					AND (
							fleet_start_id = ".$PLANET['id']." OR fleet_start_id = ".$PLANET['id_luna']."
					)
				) OR (
					fleet_target_owner = '".$USER['id']."' 
					AND (
							fleet_end_id = '".$PLANET['id']."' OR fleet_end_id = ".$PLANET['id_luna']."
					)
				);");

				if ($IfFleets > 0) {
					$Lose 			= 1;
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_355']."</span>";
				} elseif ($USER['id_planet'] == $PLANET['id']) {
					$Lose 			= 1;
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_356']."</span>";
				} elseif (cryptPassword($password) != $USER['password']) {
					$Lose 			= 1;
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_354']."</span>";
				} else {
					if($PLANET['planet_type'] == 1) {
						$GLOBALS['DATABASE']->multi_query("DELETE FROM ".PLANETS." WHERE id = ".$PLANET['id_luna'].";DELETE FROM ".PLANETS." WHERE id = ".$PLANET['id'].";");
					} else {
						$GLOBALS['DATABASE']->multi_query("UPDATE ".PLANETS." SET id_luna = '0' WHERE id_luna = ".$PLANET['id'].";DELETE FROM ".PLANETS." WHERE id = ".$PLANET['id'].";");
					}
					$_SESSION['planet']     = $USER['id_planet'];
					$Lose 					= 0;
					$Message = "<span class='vert'>".$LNG['NOUVEAUTE_354']."</span>";
				}
			}else{
				$Lose 			= 1;
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_354']."</span>";
			}
		}
		
		$this->tplObj->assign_vars(array(
			'antaris_headpost' => $PLANET['antaris_headpost'],  
			'headquarters_antaris' => $PLANET['headquarters_antaris'], 
			'Message' 		=> $Message,
			'Lose' 		=> $Lose,
		));
		$this->display("page.tower.delete.tpl");
	}

	function portal(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		$Message = "";
		$allowPortal = 0;
		if($USER['energy_tech'] >= 6 && $USER['control_room_tech'] >= 5 && $USER['particle_tech'] >= 4){
			$allowPortal = 1;
		}
		
		$isAllowed = $GLOBALS['DATABASE']->query("SELECT * FROM ".PLANETS." WHERE id_owner = ".$USER['id']." AND teleport_portal = '0';");
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){	
			$cmdd		= HTTP::_GP('cmdd', '', UTF8_SUPPORT);
			if($cmdd == "portal"){
				if($PLANET['teleport_portal_timer'] > TIMESTAMP){
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=Tower&mode=portal');
				}else{
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET teleport_portal = '1', teleport_portal_timer = ".(TIMESTAMP + 24 * 60 * 60)." WHERE id = '".$PLANET['id']."'");
				}
			}elseif($cmdd == "force"){
				if($PLANET['teleport_portal'] == 0){
					$Message = "<div class='erreur_form rouge'>".$LNG['NOUVEAUTE_361']."</div>";
				}elseif($PLANET['force_field_timer'] > TIMESTAMP){
					$this->printMessage("<span class='rouge'>You did not respect the timers!</span>", true, array('game.php?page=Tower&mode=portal', 2));
				}else{
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET force_field_timer = ".(TIMESTAMP + 24 * 60 * 60).", force_field_timer_bis = ".(TIMESTAMP + 48 * 60 * 60)." WHERE id = '".$PLANET['id']."'");
				}
			}elseif($cmdd == "desportal"){
				if($GLOBALS['DATABASE']->numRows($isAllowed) < 3){
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET  teleport_portal  = '0', teleport_portal_timer = ".(TIMESTAMP + 24 * 60 * 60)." WHERE id = '".$PLANET['id']."'");
				}else{
					$this->printMessage("<span class='rouge'>You have already 3 portals closed</span>", true, array('game.php?page=Tower&mode=portal', 2));
				}
			}
		}
		
		$Details = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE `id` = '".$PLANET['id']."';");
		
		$showMessagePortal = 0;
		if($Details['teleport_portal'] == 1 && $Details['teleport_portal_timer'] > TIMESTAMP){
			$showMessagePortal = 1;
		}elseif($Details['teleport_portal'] == 1 && $Details['teleport_portal_timer'] < TIMESTAMP){
			$showMessagePortal = 2;
		}elseif($Details['teleport_portal'] == 0 && $Details['teleport_portal_timer'] > TIMESTAMP){
			$showMessagePortal = 3;
		}else{
			$showMessagePortal = 0;
		}
		$showMessageForce = 0;
		if($Details['force_field_timer_bis'] > TIMESTAMP && $Details['force_field_timer'] > TIMESTAMP){
			$showMessageForce = 1;
		}elseif($Details['force_field_timer_bis'] > TIMESTAMP && $Details['force_field_timer'] < TIMESTAMP){
			$showMessageForce = 2;
		}elseif($Details['force_field_timer_bis'] < TIMESTAMP){
			$showMessageForce = 0;
		}
		$this->tplObj->assign_vars(array(
			'showMessagePortal' => $showMessagePortal,  
			'showMessageForce' => $showMessageForce,  
			'antaris_headpost' => $Details['antaris_headpost'],  
			'headquarters_antaris' => $Details['headquarters_antaris'],                                  
			'Message' => $Message,                                  
			'allowPortal' => $allowPortal,                                  
			'energy_tech' => $USER['energy_tech'],                                  
			'control_room_tech' => $USER['control_room_tech'],                                  
			'particle_tech' => $USER['particle_tech'],                                  
			'TIMESTAMP' => TIMESTAMP,                                  
			'isAllowedClose' => $GLOBALS['DATABASE']->numRows($isAllowed),                                  
			'teleport_portal' => $Details['teleport_portal'],                                  
			'force_field_timer_show' => $Details['force_field_timer'],     
			'force_field_timer_end' =>  sprintf($LNG['NOUVEAUTE_365'], str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $Details['force_field_timer']), $USER['timezone'])),     
			'force_field_timer' =>  sprintf($LNG['NOUVEAUTE_364'], str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $Details['force_field_timer_bis']), $USER['timezone'])),                                  
			'teleport_portal_timer' =>  sprintf($LNG['NOUVEAUTE_362'], str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $Details['teleport_portal_timer']), $USER['timezone'])),               
		));
		$this->display("page.tower.portal.tpl");
	}
	
	function construct(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		$Message = "";
		if($_SERVER['REQUEST_METHOD'] === 'POST'){	
			$cmdd		= HTTP::_GP('cmdd', '', UTF8_SUPPORT);
			$nb_technicien		= abs(HTTP::_GP('nb_technicien', 0));
			$nb_scientifique		= abs(HTTP::_GP('nb_scientifique', 0));
			$former_amount		= abs(HTTP::_GP('former_amount', 0));
			
			$nb_technicien = str_replace('.', '', $nb_technicien);
			$nb_technicien = str_replace(' ', '', $nb_technicien);
			$nb_scientifique = str_replace('.', '', $nb_scientifique);
			$nb_scientifique = str_replace(' ', '', $nb_scientifique);
			
			$MaxUsine = min(1999980,pow(1.5,$PLANET['robot_factory'])*4870);
			$MaxUsine2 = min(1999980,pow(1.5,$PLANET['laboratory'])*4870);
			
			if($cmdd == "technic" && $_SERVER['REQUEST_METHOD'] === 'POST'){
				if($former_amount < $nb_technicien){
					$newAmount = $nb_technicien - $former_amount;
					if($newAmount > $MaxUsine){
					$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_373'], pretty_number($MaxUsine))."</span>";
					}elseif($newAmount > $PLANET['technician']){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_367']."</span>";
					}else{
						$PLANET['technician'] -= $newAmount;
						$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET  technician_used  = technician_used + ".$newAmount.", technician = technician - ".$newAmount." WHERE id = '".$PLANET['id']."'");
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_368']."</span>";
					}
				}elseif($former_amount > $nb_technicien){
					$newAmount = $former_amount - $nb_technicien;
					if($newAmount > $MaxUsine){
					$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_373'], pretty_number($MaxUsine))."</span>";
					}elseif($newAmount > $PLANET['technician_used']){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_367']."</span>";
					}else{
						$PLANET['technician'] += $newAmount;
						$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET  technician_used  = technician_used - ".$newAmount.", technician = technician + ".$newAmount." WHERE id = '".$PLANET['id']."'");
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_368']."</span>";
					}
				}elseif($former_amount == $nb_technicien){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_369']."</span>";
				}
			}elseif($_SERVER['REQUEST_METHOD'] === 'POST' && $cmdd == "sience"){
				if($former_amount < $nb_scientifique){
					$newAmount = $nb_scientifique - $former_amount;
					if($newAmount > $MaxUsine2){
					$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_374'], pretty_number($MaxUsine))."</span>";
					}elseif($newAmount > $PLANET['scientist']){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_367']."</span>";
					}else{
						$PLANET['scientist'] -= $newAmount;
						$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET  scientis_used  = scientis_used + ".$newAmount.", scientist = scientist - ".$newAmount." WHERE id = '".$PLANET['id']."'");
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_371']."</span>";
					}
				}elseif($former_amount > $nb_scientifique){
					$newAmount = $former_amount - $nb_scientifique;
					if($newAmount > $MaxUsine2){
					$Message = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_374'], pretty_number($MaxUsine))."</span>";
					}elseif($newAmount > $PLANET['scientis_used']){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_372']."</span>";
					}else{
						$PLANET['scientist'] += $newAmount;
						$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET  scientis_used  = scientis_used - ".$newAmount.", scientist = scientist + ".$newAmount." WHERE id = '".$PLANET['id']."'");
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_371']."</span>";
					}
				}elseif($former_amount == $nb_scientifique){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_370']."</span>";
				}
			}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_375']."</span>";
			}
		}
		$Details = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE `id` = '".$PLANET['id']."';");
		
		$MaxUsine = pow(1.5,$Details['robot_factory'])*4870;
		$MaxUsine2 = pow(1.5,$Details['laboratory'])*4870;
		$this->tplObj->assign_vars(array(
			'MaxUsine' => pretty_number(min(1999980,$MaxUsine)),  
			'MaxUsine2' => pretty_number(min(1999980,$MaxUsine2)),  
			'antaris_headpost' => $Details['antaris_headpost'],  
			'headquarters_antaris' => $Details['headquarters_antaris'],  
			'robot_factory' => $Details['robot_factory'],  
			'laboratory' => $Details['laboratory'],  
			'technicien' => pretty_number($Details['technician']),  
			'scientist' => pretty_number($Details['scientist']),  
			'technician_used' => pretty_number($Details['technician_used']),  
			'technician_used2' => ($Details['technician_used']),  
			'technician_used_bis' => $Details['technician_used'],  
			'scientis_used' => pretty_number($Details['scientis_used']),  
			'scientis_used2' => ($Details['scientis_used']),  
			'scientis_used_bis' => $Details['scientis_used'],  
			'reduce_build' => $Details['technician_used']*0.00005,  
			'reduce_tech' => $Details['scientis_used']*0.00005,  
			'Message' 	=> $Message,  
		));
		$this->display("page.tower.construct.tpl");
	}
	
	function siege(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		$Message = "";
		if($PLANET['headquarters_antaris'] == 0){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=Tower');
		}else{
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				$DetailsLOL = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE `id` = '".$PLANET['id']."';");
				$methode		= HTTP::_GP('methode', '', UTF8_SUPPORT);
				if($methode == "reactor"){
					if($DetailsLOL['elyrium_reactor'] < 1){
						$Message = "<span class=\"rouge\">Vous n'avez pas assez de \"".$LNG['tech'][221]."\". Vous en possédez que <b>0</b> unité(s).</span>";
					}else{
						$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET  siege_on  = ".(TIMESTAMP + 24*60*60).", elyrium_reactor = elyrium_reactor - '1' WHERE id = '".$DetailsLOL['id']."'");
					}
				}else{
					if($DetailsLOL['energy_modulator'] < 1){
						$Message = "<span class=\"rouge\">Vous n'avez pas assez de \"".$LNG['tech'][222]."\". Vous en possédez que <b>0</b> unité(s).</span>";
					}else{
						$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET  siege_on  = ".(TIMESTAMP + 31*24*60*60).", energy_modulator = energy_modulator - '1' WHERE id = '".$DetailsLOL['id']."'");
					}
				}
			}
			
			$Details = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE `id` = '".$PLANET['id']."';");
			$showMessage=0;
			if($Details['siege_on'] > TIMESTAMP){
				$showMessage=1;
			}
			
			$SiegeSim = ($Details['siege_on'] - $Details['siege_activated']);
			if($SiegeSim == 0)
				$SiegeSim = 1;
			$this->tplObj->assign_vars(array(
				'antaris_headpost' => $Details['antaris_headpost'],  
				'headquarters_antaris' => $Details['headquarters_antaris'],                                      
				'siege_timer_time' => $Details['siege_on'],                                      
				'showMessage' => $showMessage,                        
				'timing' => TIMESTAMP,                        
				'Message' => $Message,                        
				'siege_pircent' => (round(((TIMESTAMP - $Details['siege_activated']) * 100) / $SiegeSim, 2).''),                  
				'siege_timer' =>  sprintf($LNG['NOUVEAUTE_378'],str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $Details['siege_on']), $USER['timezone'])),  
				));
			$this->display("page.tower.siege.tpl");
		}
	}
	  
	function outpost(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		
		if($USER['id'] != 1){
		$this->printMessage('<span class="rouge">This function will be avaible in version 1.2 of Antaris Legacy</span>',  true, array('game.php?page=overview', 3)); 	
		}
		
		if($PLANET['antaris_headpost'] == 0){
		$this->printMessage("<span class='rouge'>you dont met the requirements!</span>", true, array('game.php?page=Tower', 2));
		}
		$this->tplObj->assign_vars(
				array(
               'antaris_headpost' => $PLANET['antaris_headpost'],  
			   'headquarters_antaris' => $PLANET['headquarters_antaris'], 			   
                                        )
		);
		$this->display("page.tower.outpost.tpl");
	}
}