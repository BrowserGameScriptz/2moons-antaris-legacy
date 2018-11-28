<?php

class ShowImmunityPage extends AbstractPage
{
    public static $requireModule = MODULE_IMMUNITY;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show(){
	
		global $USER, $PLANET, $LNG, $UNI, $CONF;
		
		$Message = "";
		
		if($USER['urlaubs_modus'] == 1){
			$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_20']."</span>";
			
			$this->tplObj->assign_vars(array(
				'Message' 		=> $Message,
			));
			$this->display("page.immunity.default.tpl");
		}else{
			
			if($_SERVER['REQUEST_METHOD'] === 'POST'){	
				$mode		= HTTP::_GP('immunity', '');
				if(empty($mode)){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_26']."</span>";
				}elseif($mode != "three"){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_22']."</span>";
				}elseif($USER['urlaubs_modus'] == 1){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_20']."</span>";
				}elseif($mode == 'three'){
					if($USER['darkmatter'] < 1){
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_23']."</span>";
					}elseif($USER['next_immunity'] > TIMESTAMP){
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_24']."</span>";
					}else{
						$USER['darkmatter'] -= 1;
						$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET `immunity_until` = ".(TIMESTAMP + 60*60*24*3).", `next_immunity` = ".(TIMESTAMP + 10*60*60*24)." WHERE `id` = ".$USER['id']." ;");
						$Messages = "- 1 credit(s) for 3 days of immunity mode";
						$GLOBALS['DATABASE']->query("INSERT INTO ".ACHATLOG." VALUES (null, '".TIMESTAMP."',  '".$USER['id']."', '".$GLOBALS['DATABASE']->sql_escape($Messages)."', 1, 'Conversion in immunity modus');");
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_25']."</span>";
					}
				}
			}
			
			$showCountdown = 0;
			if($USER['immunity_until'] < TIMESTAMP && $USER['next_immunity'] > TIMESTAMP){
				$showCountdown = 1;
			}
	
			$this->tplObj->loadscript('countdown.js');
			$this->tplObj->assign_vars(array(
				'immunity_active' => ((!empty($USER['immunity_until']) && $USER['immunity_until'] > TIMESTAMP) ? ($USER['immunity_until'] - TIMESTAMP) : 0),
				'immunity_active_cooldown' => ((!empty($USER['next_immunity']) && $USER['next_immunity'] > TIMESTAMP) ? ($USER['next_immunity'] - TIMESTAMP) : 0),
				'showCountdown' => $showCountdown,
				'Message' 		=> $Message,
			));
			$this->display("page.immunity.default.tpl");
		}
	}
}
