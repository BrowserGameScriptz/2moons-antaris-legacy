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
 * @info $Id: class.ShowSearchPage.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */

class ShowPlanetcloakPage extends AbstractPage
{
	
	public static $requireModule = MODULE_PLANET_CLOAK;
	
	function __construct() {
		parent::__construct();
	}
	
	function show()
	{
		global $USER, $LNG, $THEME;
		
		$Message = "";
		
		if($USER['urlaubs_modus'] == 1){
			$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_20']."</span>";
			
			$this->tplObj->assign_vars(array(
				'Message' 		=> $Message,
			));
			$this->display("page.planetcloak.default.tpl");
		}else{
			
			if($_SERVER['REQUEST_METHOD'] === 'POST'){	
				$days   = HTTP::_GP('planetcloak', '');
				$allowedArray = array('one', 'seven');
				
				if(empty($days)){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_26']."</span>";
				}elseif(!in_array($days, $allowedArray)){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_22']."</span>";
				}elseif($USER['urlaubs_modus'] == 1){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_20']."</span>";
				}elseif($days == 'one'){
					if($USER['darkmatter'] < 1){
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_23']."</span>";
					}elseif($USER['planet_cloak_countdown'] > TIMESTAMP){
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_24']."</span>";
					}else{
						$USER['darkmatter'] -= 1;
						$GLOBALS['DATABASE']->query("Update ".USERS." SET `planet_cloak` = ".(TIMESTAMP + 24 * 60 * 60).", `planet_cloak_countdown` = ".(TIMESTAMP + 8 * 24 * 60 * 60)." WHERE `id` = ".$USER['id'].";");
						//$GLOBALS['DATABASE']->query("INSERT INTO uni1_planetcloak_log VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."','".TIMESTAMP."','1');");
						$Messages = "- 1 credit(s) for 1 day of planet cloak mode";
						$GLOBALS['DATABASE']->query("INSERT INTO ".ACHATLOG." VALUES (null, '".TIMESTAMP."',  '".$USER['id']."', '".$GLOBALS['DATABASE']->sql_escape($Messages)."', 1, 'Conversion in planet cloak modus');");
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_27']."</span>";
					}
				}elseif($days == 'seven'){
					if($USER['darkmatter'] < 3){
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_23']."</span>";
					}elseif($USER['planet_cloak_countdown'] > TIMESTAMP){
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_24']."</span>";
					}else{
						$USER['darkmatter'] -= 3;
						$GLOBALS['DATABASE']->query("Update ".USERS." SET `planet_cloak` = ".(TIMESTAMP + 7 * 24 * 60 * 60).", `planet_cloak_countdown` = ".(TIMESTAMP + 37 * 24 * 60 * 60)." WHERE `id` = ".$USER['id'].";");
						//$GLOBALS['DATABASE']->query("INSERT INTO uni1_planetcloak_log VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."','".TIMESTAMP."','5');");
						$Messages = "- 3 credit(s) for 7 day of planet cloak mode";
						$GLOBALS['DATABASE']->query("INSERT INTO ".ACHATLOG." VALUES (null, '".TIMESTAMP."',  '".$USER['id']."', '".$GLOBALS['DATABASE']->sql_escape($Messages)."', 3, 'Conversion in planet cloak modus');");
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_27']."</span>";
					}
				}
			}
			
			$showCountdown = 0;
			if($USER['planet_cloak'] < TIMESTAMP && $USER['planet_cloak_countdown'] > TIMESTAMP){
				$showCountdown = 1;
			}
			
			$this->tplObj->loadscript("jquery.countdown.js");
			$this->tplObj->assign_vars(array(
				'cloak_active' => ((!empty($USER['planet_cloak']) && $USER['planet_cloak'] > TIMESTAMP) ? ($USER['planet_cloak'] - TIMESTAMP) : 0),
				'cloak_active_countdown' => ((!empty($USER['planet_cloak_countdown']) && $USER['planet_cloak_countdown'] > TIMESTAMP) ? ($USER['planet_cloak_countdown'] - TIMESTAMP) : 0),
				'showCountdown' => $showCountdown,
				'Message' 		=> $Message,
			));
			
			$this->display('page.planetcloak.default.tpl');
		}
	}
}