<?php

class ShowBunkerPage extends AbstractPage
{
    public static $requireModule = MODULE_BUNKER;       
	function __construct() 
	{
		parent::__construct();
	}

	function getCode(){
		$code=rand(1000,9999);
		$_SESSION['code']=$code;
		$im = imagecreatetruecolor(50, 24);
		$bg = imagecolorallocate($im, 22, 86, 165); //background color blue
		$fg = imagecolorallocate($im, 255, 255, 255);//text color white
		imagefill($im, 0, 0, $bg);
		imagestring($im, 5, 5, 5,  $code, $fg);
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-type: image/png');
		imagepng($im);
		imagedestroy($im);
	}

	function show(){
		
		$Message = array();
		
		global $PLANET, $LNG, $USER, $THEME, $resource, $reslist;
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){	
			
			$action_metal   	= HTTP::_GP('action_metal', '');
			$action_crystal  	= HTTP::_GP('action_crystal', '');
			$action_deuterium   = HTTP::_GP('action_deuterium', '');
			$action_elyrium   	= HTTP::_GP('action_elyrium', '');
			$quantite_metal   	= HTTP::_GP('quantite_metal', 0);
			$quantite_crystal   = HTTP::_GP('quantite_crystal', 0);
			$quantite_deuterium = HTTP::_GP('quantite_deuterium', 0);
			$quantite_elyrium   = HTTP::_GP('quantite_elyrium', 0);
			$captcha   			= HTTP::_GP('captcha', '');
			$possibleArray		= array('ajouter', 'retirer');
			
			$quantite_metal   	= abs($quantite_metal);
			$quantite_crystal   = abs($quantite_crystal);
			$quantite_deuterium = abs($quantite_deuterium);
			$quantite_elyrium   = abs($quantite_elyrium);
			
			$basicIncome[901]	= Config::get($resource[901].'_basic_income');
			$basicIncome[902]	= Config::get($resource[902].'_basic_income');
			$basicIncome[903]	= Config::get($resource[903].'_basic_income');
			$basicIncome[904]	= Config::get($resource[904].'_basic_income');
			$basicProduction	= array(
				901 => $basicIncome[901] * Config::get('resource_multiplier'),
				902 => $basicIncome[902] * Config::get('resource_multiplier'),
				903	=> $basicIncome[903] * Config::get('resource_multiplier'),
				904	=> $basicIncome[904] * Config::get('resource_multiplier'),
			);
		
			$totalProduction	= array(
				901 => $PLANET[$resource[901].'_perhour'],
				902 => $PLANET[$resource[902].'_perhour'],
				903	=> $PLANET[$resource[903].'_perhour'],
				904	=> $PLANET[$resource[904].'_perhour'],
			);
			$dailyProduction	= array(
				901 => $totalProduction[901] * 48,
				902 => $totalProduction[902] * 48,
				903	=> $totalProduction[903] * 48,
				904	=> $totalProduction[904] * 48,
			);
			
			$inBunker = $GLOBALS['DATABASE']->query("SELECT SUM(metal_bunker) as sum_metal_bunker, SUM(crystal_bunker) as sum_crystal_bunker, SUM(deuterium_bunker) as sum_deuterium_bunker, SUM(elyrium_bunker) as sum_elyrium_bunker FROM ".PLANETS." WHERE id_owner = ".$USER['id']." AND destruyed = '0';");
			$inBunker = $GLOBALS['DATABASE']->fetch_array($inBunker);
			
			$inBunkerPost = $GLOBALS['DATABASE']->query("SELECT metal_bunker_in  as metal_bunker_in , crystal_bunker_in  as crystal_bunker_in , deuterium_bunker_in  as deuterium_bunker_in, elyrium_bunker_in as elyrium_bunker_in  FROM ".PLANETS." WHERE id = ".$PLANET['id'].";");
			$inBunkerPost = $GLOBALS['DATABASE']->fetch_array($inBunkerPost);
			
			$isPossible = $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".FLEETS." WHERE fleet_end_id = ".$PLANET['id']." AND fleet_end_stay < ".(TIMESTAMP + 600)." AND fleet_mess = 0 AND fleet_mission = '1';");
		
		
			if($USER['urlaubs_modus'] == 1){
				$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_20']."</span>";
			}elseif($_SESSION['code'] != $captcha) {
				$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_58']."</span>";
			}elseif($isPossible != 0){
				$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_59']."</span>";
			}elseif(!in_array($action_metal, $possibleArray) || !in_array($action_crystal, $possibleArray) || !in_array($action_deuterium, $possibleArray) || !in_array($action_elyrium, $possibleArray)){
				$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_60']."</span>";
			}else{
		
				if($action_metal == "ajouter" && ($dailyProduction[901] - $inBunker['sum_metal_bunker'] - $quantite_metal >= 0) && $quantite_metal > 0 && $inBunkerPost['metal_bunker_in'] < 2 && $PLANET['metal'] >= $quantite_metal){
					$PLANET['metal'] -= $quantite_metal;
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET metal_bunker = metal_bunker + ".$quantite_metal.", metal_bunker_in = metal_bunker_in + 1 WHERE id = ".$PLANET['id']." ;");
					$Insert = sprintf($LNG['NOUVEAUTE_66'], pretty_number($quantite_metal), $LNG['tech'][901], $PLANET['name'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet']);
					$GLOBALS['DATABASE']->query("INSERT INTO ".BUNKERLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."',".TIMESTAMP.", '".$GLOBALS['DATABASE']->escape($Insert)."', '1');");
				}elseif($action_metal == "retirer" && $PLANET['metal_bunker'] - $quantite_metal >= 0 && $quantite_metal > 0){
					$PLANET['metal'] += $quantite_metal;
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET metal_bunker = metal_bunker - ".$quantite_metal." WHERE id = ".$PLANET['id']." ;");
					$Widraw = sprintf($LNG['NOUVEAUTE_67'], pretty_number($quantite_metal), $LNG['tech'][901], $PLANET['name'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet']);
					$GLOBALS['DATABASE']->query("INSERT INTO ".BUNKERLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."',".TIMESTAMP.", '".$GLOBALS['DATABASE']->escape($Widraw)."', '2');");
				}elseif($action_metal == "ajouter" && ($dailyProduction[901] - $inBunker['sum_metal_bunker'] - $quantite_metal < 0)){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_61'], pretty_number($quantite_metal), $LNG['tech'][901])."</span>";
				}elseif($action_metal == "retirer" && $PLANET['metal_bunker'] - $quantite_metal < 0){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_62'], pretty_number($quantite_metal), $LNG['tech'][901])."</span>";
				}elseif($inBunkerPost['metal_bunker_in'] == 2 && $quantite_metal != 0){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_63'], $LNG['tech'][901])."</span>";
				}elseif($action_metal == "ajouter" && $PLANET['metal'] < $quantite_metal){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_64'], $LNG['tech'][901])."</span>";
				}
			
				if($action_crystal == "ajouter" && ($dailyProduction[902] - $inBunker['sum_crystal_bunker'] - $quantite_crystal >= 0) && $quantite_crystal > 0 && $inBunkerPost['crystal_bunker_in'] < 2 && $PLANET['crystal'] >= $quantite_crystal){
					$PLANET['crystal'] -= $quantite_crystal;
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET crystal_bunker = crystal_bunker + ".$quantite_crystal.", crystal_bunker_in = crystal_bunker_in + 1 WHERE id = ".$PLANET['id']." ;");
					$Insert = sprintf($LNG['NOUVEAUTE_66'], pretty_number($quantite_crystal), $LNG['tech'][902], $PLANET['name'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet']);
					$GLOBALS['DATABASE']->query("INSERT INTO ".BUNKERLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."',".TIMESTAMP.", '".$GLOBALS['DATABASE']->escape($Insert)."', '1');");
				}elseif($action_crystal == "retirer" && $PLANET['crystal_bunker'] - $quantite_crystal >= 0 && $quantite_crystal > 0){
					$PLANET['crystal'] += $quantite_crystal;
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET crystal_bunker = crystal_bunker - ".$quantite_crystal." WHERE id = ".$PLANET['id']." ;");
					$Widraw = sprintf($LNG['NOUVEAUTE_67'], pretty_number($quantite_crystal), $LNG['tech'][902], $PLANET['name'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet']);
					$GLOBALS['DATABASE']->query("INSERT INTO ".BUNKERLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."',".TIMESTAMP.", '".$GLOBALS['DATABASE']->escape($Widraw)."', '2');");
				}elseif($action_crystal == "ajouter" && ($dailyProduction[902] - $inBunker['sum_crystal_bunker'] - $quantite_crystal < 0)){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_61'], pretty_number($quantite_crystal), $LNG['tech'][902])."</span>";
				}elseif($action_crystal == "retirer" && $PLANET['crystal_bunker'] - $quantite_crystal < 0){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_62'], pretty_number($quantite_crystal), $LNG['tech'][902])."</span>";
				}elseif($inBunkerPost['crystal_bunker_in'] == 2 && $quantite_crystal != 0){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_63'], $LNG['tech'][902])."</span>";
				}elseif($action_crystal == "ajouter" && $PLANET['crystal'] < $quantite_crystal){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_64'], $LNG['tech'][902])."</span>";
				}
			
				if($action_deuterium == "ajouter" && ($dailyProduction[903] - $inBunker['sum_deuterium_bunker'] - $quantite_deuterium >= 0) && $quantite_deuterium > 0 && $inBunkerPost['deuterium_bunker_in'] < 2 && $PLANET['deuterium'] >= $quantite_deuterium){
					$PLANET['deuterium'] -= $quantite_deuterium;
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET deuterium_bunker = deuterium_bunker + ".$quantite_deuterium.", deuterium_bunker_in = deuterium_bunker_in + 1 WHERE id = ".$PLANET['id']." ;");
					$Insert = sprintf($LNG['NOUVEAUTE_66'], pretty_number($quantite_deuterium), $LNG['tech'][903], $PLANET['name'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet']);
					$GLOBALS['DATABASE']->query("INSERT INTO ".BUNKERLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."',".TIMESTAMP.", '".$GLOBALS['DATABASE']->escape($Insert)."', '1');");
				}elseif($action_deuterium == "retirer" && $PLANET['deuterium_bunker'] - $quantite_deuterium >= 0 && $quantite_deuterium > 0){
					$PLANET['deuterium'] += $quantite_deuterium;
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET deuterium_bunker = deuterium_bunker - ".$quantite_deuterium." WHERE id = ".$PLANET['id']." ;");
					$Widraw = sprintf($LNG['NOUVEAUTE_67'], pretty_number($quantite_deuterium), $LNG['tech'][903], $PLANET['name'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet']);
					$GLOBALS['DATABASE']->query("INSERT INTO ".BUNKERLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."',".TIMESTAMP.", '".$GLOBALS['DATABASE']->escape($Widraw)."', '2');");
				}elseif($action_deuterium == "ajouter" && ($dailyProduction[903] - $inBunker['sum_deuterium_bunker'] - $quantite_deuterium < 0)){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_61'], pretty_number($quantite_deuterium), $LNG['tech'][903])."</span>";
				}elseif($action_deuterium == "retirer" && $PLANET['deuterium_bunker'] - $quantite_deuterium < 0){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_62'], pretty_number($quantite_deuterium), $LNG['tech'][903])."</span>";
				}elseif($inBunkerPost['deuterium_bunker_in'] == 2 && $quantite_deuterium != 0){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_63'], $LNG['tech'][903])."</span>";
				}elseif($action_deuterium == "ajouter" && $PLANET['deuterium'] < $quantite_deuterium){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_64'], $LNG['tech'][903])."</span>";
				}
			
				if($action_elyrium == "ajouter" && ($dailyProduction[904] - $inBunker['sum_elyrium_bunker'] - $quantite_elyrium >= 0) && $quantite_elyrium > 0 && $inBunkerPost['elyrium_bunker_in'] < 2 && $PLANET['elyrium'] >= $quantite_elyrium){
					$PLANET['elyrium'] -= $quantite_elyrium;
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium_bunker = elyrium_bunker + ".$quantite_elyrium.", elyrium_bunker_in = elyrium_bunker_in + 1 WHERE id = ".$PLANET['id']." ;");
					$Insert = sprintf($LNG['NOUVEAUTE_66'], pretty_number($quantite_elyrium), $LNG['tech'][904], $PLANET['name'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet']);
					$GLOBALS['DATABASE']->query("INSERT INTO ".BUNKERLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."',".TIMESTAMP.", '".$GLOBALS['DATABASE']->escape($Insert)."', '1');");
				}elseif($action_elyrium == "retirer" && $PLANET['elyrium_bunker'] - $quantite_elyrium >= 0 && $quantite_elyrium > 0){
					$PLANET['elyrium'] += $quantite_elyrium;
					$GLOBALS['DATABASE']->query("UPDATE ".PLANETS." SET elyrium_bunker = elyrium_bunker - ".$quantite_elyrium." WHERE id = ".$PLANET['id']." ;");
					$Widraw = sprintf($LNG['NOUVEAUTE_67'], pretty_number($quantite_elyrium), $LNG['tech'][904], $PLANET['name'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet']);
					$GLOBALS['DATABASE']->query("INSERT INTO ".BUNKERLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."',".TIMESTAMP.", '".$GLOBALS['DATABASE']->escape($Widraw)."', '2');");
				}elseif($action_elyrium == "ajouter" && ($dailyProduction[904] - $inBunker['sum_elyrium_bunker'] - $quantite_elyrium < 0)){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_61'], pretty_number($quantite_elyrium), $LNG['tech'][904])."</span>";
				}elseif($action_elyrium == "retirer" && $PLANET['elyrium_bunker'] - $quantite_elyrium < 0){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_62'], pretty_number($quantite_elyrium), $LNG['tech'][904])."</span>";
				}elseif($inBunkerPost['elyrium_bunker_in'] == 2 && $quantite_elyrium != 0){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_63'], $LNG['tech'][904])."</span>";
				}elseif($action_elyrium == "ajouter" && $PLANET['elyrium'] < $quantite_elyrium){
					$Message[] = "<span class='rouge'>".sprintf($LNG['NOUVEAUTE_64'], $LNG['tech'][904])."</span>";
				}
				
				if(empty($Message))
					$Message[] = "<span class='vert'>".$LNG['NOUVEAUTE_65']."</span>";
			}
		}
		$bunkerTable = array();
		$inBunker = $GLOBALS['DATABASE']->query("SELECT SUM(metal_bunker) as metal_bunker, SUM(crystal_bunker) as crystal_bunker, SUM(deuterium_bunker) as deuterium_bunker, SUM(elyrium_bunker) as elyrium_bunker FROM ".PLANETS." WHERE id_owner = ".$USER['id']." AND destruyed = '0';");
		$inBunker = $GLOBALS['DATABASE']->fetch_array($inBunker);
		
		$Details = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE `id` = '".$PLANET['id']."';");
		
		foreach($reslist['resstype'][1] as $resourceID)
		{
			$bunkerTable[$resourceID]['name']			= $resource[$resourceID];
			$bunkerTable[$resourceID]['resname']		= $LNG['tech'][$resourceID];
			$bunkerTable[$resourceID]['current']		= $Details[$resource[$resourceID]];
			$bunkerTable[$resourceID]['bunker']			= $Details[$resource[$resourceID].'_bunker'];
			$bunkerTable[$resourceID]['max']			= $Details[$resource[$resourceID].'_max'];
			
			
			$basicIncome[901]	= Config::get($resource[901].'_basic_income');
			$basicIncome[902]	= Config::get($resource[902].'_basic_income');
			$basicIncome[903]	= Config::get($resource[903].'_basic_income');
			$basicIncome[904]	= Config::get($resource[904].'_basic_income');
			$basicProduction	= array(
			901 => $basicIncome[901] * Config::get('resource_multiplier'),
			902 => $basicIncome[902] * Config::get('resource_multiplier'),
			903	=> $basicIncome[903] * Config::get('resource_multiplier'),
			904	=> $basicIncome[904] * Config::get('resource_multiplier'),
		);
		
		$totalProduction	= array(
			901 => $PLANET[$resource[901].'_perhour'],
			902 => $PLANET[$resource[902].'_perhour'],
			903	=> $PLANET[$resource[903].'_perhour'],
			904	=> $PLANET[$resource[904].'_perhour'],
		);
		$dailyProduction	= array(
			901 => $totalProduction[901] * 48,
			902 => $totalProduction[902] * 48,
			903	=> $totalProduction[903] * 48,
			904	=> $totalProduction[904] * 48,
		);
		
		
		$isPossible = $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".FLEETS." WHERE fleet_end_id = ".$Details['id']." AND fleet_end_stay < ".(TIMESTAMP + 600)." AND fleet_mess = 0 AND fleet_mission = '1';");
		
		$dotting = 'vert';
		if($isPossible > 0){
			$dotting = 'rouge';
		}
		if($Details[$resource[$resourceID].'_bunker_in'] == 2){
			$dotting = 'rouge';
		}
		
		$bunkerTable[$resourceID]['in']			= $dotting;
		$bunkerTable[$resourceID]['remaining']	= ($dailyProduction[$resourceID] - $inBunker[''.$resource[$resourceID].'_bunker']);
		}
	
		$this->tplObj->assign_vars(array(
			'bunkerTable'		=> $bunkerTable,
			'Message'			=> implode("<br>\r\n", $Message),
		));
		$this->display("page.bunker.default.tpl");
	}
	
	function historique(){
		global $USER, $PLANET, $LNG, $UNI, $CONF;
	
	
		$messageList = '';
		$messageRaw	= $GLOBALS['DATABASE']->query("SELECT * FROM ".BUNKERLOG." WHERE userID = ".$USER['id']." AND time > ".(TIMESTAMP - 15 * 24 * 60 * 60)." ORDER BY time DESC;");
	
		while($messageRow = $GLOBALS['DATABASE']->fetch_array($messageRaw)){
	
			$messageList[$messageRow['logID']]	= array(
				'date'		=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $messageRow['time']), $USER['timezone']),
				'message'		=> $messageRow['message'],
				'accepted'		=> $messageRow['type'],
			);
		}
	
	
		$this->tplObj->assign_vars(array(
			'messageList' => $messageList,                        
		));
		$this->display("page.bunker.historique.tpl");
	}
}