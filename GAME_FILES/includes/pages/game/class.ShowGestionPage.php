<?php

class ShowGestionPage extends AbstractPage
{
    public static $requireModule = MODULE_GESTION;        
	function __construct() 
	{
		parent::__construct();
	}
	
	function order(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		
		$GetAll990 = $GLOBALS['DATABASE']->query("SELECT id FROM ".PLANETS." WHERE id_owner = ".$USER['id']." AND destruyed = '0' ;");
		$GetAll990 = $GLOBALS['DATABASE']->numRows($GetAll990);
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$message = '';
			foreach ($_POST as $var => $val)
			{
				if (strpos($var, 'classement_') !== false)
				{
					// Là tu sais que c'est un de tes nombreux select et $val égal l'ordre que ton user a défini pour cet élement
					$id = str_replace('classement_', '', $var);
					$ordre = abs($val);
					$message .= $ordre;
					
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET ordernumber = ".$GLOBALS['DATABASE']->sql_escape($ordre)." WHERE id = ".$GLOBALS['DATABASE']->sql_escape($id).";");
				}
			}
		}
		$GetAll = $GLOBALS['DATABASE']->query("SELECT * FROM ".PLANETS." WHERE id_owner = ".$USER['id']." AND destruyed = '0' ORDER BY ordernumber ASC;");

		if($GLOBALS['DATABASE']->numRows($GetAll)>0){
			while($messageRow = $GLOBALS['DATABASE']->fetch_array($GetAll)){
				$messageList[$messageRow['id']]	= array(
					'orderID'		=> $messageRow['id'],
					'name'		=> $messageRow['name'],
					'galaxy'		=> $messageRow['galaxy'],
					'system'		=> $messageRow['system'],
					'planet'		=> $messageRow['planet'],
					'ordernumber'		=> $messageRow['ordernumber'],
				);
			}
		}
		$this->tplObj->assign_vars(array(
			'messageList' => $messageList,
			'GetAll990' => $GetAll990,
		));
		$this->display("page.gestion.order.tpl");
	}

	
	function show(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		$GetAll = $GLOBALS['DATABASE']->query("SELECT * FROM ".PLANETS." WHERE id_owner = ".$USER['id']." AND destruyed = '0' ORDER by ordernumber ASC;");
		$number = 1;
		if($GLOBALS['DATABASE']->numRows($GetAll)>0){
			while($messageRow = $GLOBALS['DATABASE']->fetch_array($GetAll)){
				if ($messageRow['b_building'] - TIMESTAMP > 0) {
					$Queue			= unserialize($messageRow['b_building_id']);
					$buildInfo['buildings']	= array(
						'id'		=> $Queue[0][0],
						'level'		=> $Queue[0][1],
						'timeleft'	=> $messageRow['b_building'] - TIMESTAMP,
						'time'		=> $messageRow['b_building'],
						'starttime'	=> pretty_time($messageRow['b_building'] - TIMESTAMP),
					);
				}
				else{
					$buildInfo['buildings']	= false;
				}
				
				if (!empty($messageRow['b_hangar_id'])) {
					$Queue	= unserialize($messageRow['b_hangar_id']);
					//$time	= BuildFunctions::getBuildingTime($USER, $messageRow['id'], $Queue[0][0]) * $Queue[0][1];
					$time	= BuildFunctions::getBuildingTime($USER, 1, $Queue[0][0]) * $Queue[0][1];
					$buildInfo['fleet']	= array(
						'id'		=> $Queue[0][0],
						'level'		=> $Queue[0][1],
						'timeleft'	=> $time - $messageRow['b_hangar'],
						'time'		=> $time,
						'starttime'	=> pretty_time($time - $messageRow['b_hangar']),
					);
				}
				else{
					$buildInfo['fleet']	= false;
				}
					
				if (!empty($messageRow['b_defense_id'])) {
						
					$Queue	= unserialize($messageRow['b_defense_id']);
					//$time	= BuildFunctions::getBuildingTime($USER, $messageRow['id'], $Queue[0][0]) * $Queue[0][1];
					$time	= BuildFunctions::getBuildingTime($USER, 1, $Queue[0][0]) * $Queue[0][1];
					$buildInfo['defense']	= array(
						'id'		=> $Queue[0][0],
						'level'		=> $Queue[0][1],
						'timeleft'	=> $time - $messageRow['b_defense'],
						'time'		=> $time,
						'starttime'	=> pretty_time($time - $messageRow['b_defense']),
					);
				}
				else{
					$buildInfo['defense']	= false;
				}
					
				if ($USER['b_tech'] - TIMESTAMP > 0) {
					$Queue			= unserialize($USER['b_tech_queue']);
					$buildInfo['tech']	= array(
						'id'		=> $Queue[0][0],
						'level'		=> $Queue[0][1],
						'timeleft'	=> $USER['b_tech'] - TIMESTAMP,
						'time'		=> $USER['b_tech'],
						'starttime'	=> pretty_time($USER['b_tech'] - TIMESTAMP),
					);
				}
				else{
					$buildInfo['tech']	= false;
				}
				
				if (!empty($PLANET['ownCount'])) {
					$ElementQueue 	= explode(';', $PLANET['ownCount']);
					$startIdQueue	= 0;
					
					foreach($ElementQueue as $Item)
					{
						$temp 				= explode(',', $Item);
						
						if($startIdQueue == 0)
							$BuildArray[] 		= array($temp[0], $temp[1]);
						
						$startIdQueue 		+= 1;
					}

					foreach($BuildArray as $Element)
					{
						if (empty($Element))
							continue;
							
						$ElementY   = $Element[0];
						$inBuild    = $Element[1];
							
						$getUserShip = $GLOBALS['DATABASE']->getFirstRow("SELECT constructionTime, nom, image, cost901, cost902, cost903, cost904 FROM ".VARS_USER." WHERE owerId = ".$USER['id']." AND varId = ".$ElementY.";");
								
						$elementInQueue[$Element[0]]	= true;
						$ElementTime  		= $getUserShip['constructionTime'];
						
						$Siege = 0;
						if($PLANET['siege_on'] > TIMESTAMP){
							$Siege = 1;	
						}
						
						if($Siege == 1){
							for ($i = 0; $i < $PLANET[$resource[5]]; $i++) {
								$ElementTime	/=  2;
							}
						}
						
						for ($i = 0; $i < $PLANET[$resource[14]]; $i++) {
							$ElementTime	/=  1.05;
						}
						
						for ($i = 0; $i < $PLANET[$resource[21]]; $i++) {
							$ElementTime	/=  1.08;
						}
						
						$QueueTime   		= $ElementTime * $inBuild;
						$buildInfo['ownship']	= array(
							'price'		=> array(901 => $getUserShip['cost901'], 902 => $getUserShip['cost902'], 903 => $getUserShip['cost903'], 904 => $getUserShip['cost904']),
							'nom'		=> $getUserShip['nom'],
							'image'		=> $getUserShip['image'],
							'id'		=> $ElementY,
							'level'		=> $inBuild,
							'timeleft'	=> $QueueTime - $PLANET['b_vaisseau'],
							'timelefts'	=> date('d/m/Y H:i:s', (TIMESTAMP + ($ElementTime - $PLANET['b_vaisseau']))),
							'time'		=> $QueueTime,
							'starttime'	=> pretty_time($QueueTime - $PLANET['b_vaisseau']),
							'endtime'	=> date('d/m/Y H:i:s',(TIMESTAMP + $QueueTime - $PLANET['b_vaisseau'])),
						);	
					}
					$overmessage = 1;
				}else {
					$buildInfo['ownship']	= false;
				}
				
					
				$messageList[$messageRow['id']]	= array(
					'buildInfo'		=> $buildInfo,
					'name'		=> $messageRow['name'],
					'galaxy'		=> $messageRow['galaxy'],
					'system'		=> $messageRow['system'],
					'planet'		=> $messageRow['planet'],
					'plid'		=> $messageRow['id'],
					'gmetal'		=> pretty_number($messageRow['metal']),
					'gcrystal'		=> pretty_number($messageRow['crystal']),
					'gdeuterium'		=> pretty_number($messageRow['deuterium']),
					'gelyrium'		=> pretty_number($messageRow['elyrium']),
					'gmetalpircent'		=> round($messageRow['metal'] * 100 / $messageRow['metal_max']),
					'gcrystalpircent'		=> round($messageRow['crystal'] * 100 / $messageRow['crystal_max']),
					'gdeuteriumpircent'		=> round($messageRow['deuterium'] * 100 / $messageRow['deuterium_max']),
					'gelyriumpircent'		=> round($messageRow['elyrium'] * 100 / $messageRow['elyrium_max']),
					//'energypircent'		=> round(100 / $messageRow['energy'] * ($messageRow['energy']-abs($messageRow['energy_used']))),
					'energypircent'		=> 0,
					'field_current'		=> $messageRow['field_current'],
					'field_max'		=> $messageRow['field_max'],
					'teleport_portal'		=> $messageRow['teleport_portal'],
					'image'		=> $messageRow['image'],
					'force_field_timer'		=> $messageRow['force_field_timer'],
					'energy'		=> $messageRow['energy'],
					'energy_used'		=> ($messageRow['energy']-abs($messageRow['energy_used'])),
					'metal_mine_porcent'		=> $messageRow['metal_mine_porcent']*10,
					'crystal_mine_porcent'		=> $messageRow['crystal_mine_porcent']*10,
					'deuterium_sintetizer_porcent'		=> $messageRow['deuterium_sintetizer_porcent']*10,
					'elyrium_mine_porcent'		=> $messageRow['elyrium_mine_porcent']*10,
					'number'		=> $number++,
				);
			}
		}	    
		$this->tplObj->assign_vars(
		array(
			'messageList' => $messageList,							
			'timinger' => TIMESTAMP,							
		));
		$this->display("page.gestion.default.tpl");
	}
}