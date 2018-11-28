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
 * @info $Id: class.ShowChatPage.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */

class ShowTchatPage extends AbstractPage
{
	public static $requireModule = MODULE_CHAT;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show() 
	{
		global $USER, $LNG;
	
		/* $allowedArray = array(1,2,56);
		if(!in_array($USER['id'], $allowedArray)){
			$this->printMessage('This page is being repaired by the team. / Cette page et en reparation chez les administrateurs.', true, array('game.php?page=overview', 2));
			die();
		} */
		
		
		$lastID		 = $GLOBALS['DATABASE']->getFirstRow("SELECT id FROM ".MINICHAT." ORDER BY id DESC LIMIT 1;");
		if(empty($lastID))
			$lastID['id'] = 0;
		$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET chat_visit = '".$lastID['id']."' WHERE id = ".$USER['id']." ;");
				
		$this->tplObj->assign_vars(array(	
			'isstaff' => $USER['isStaff'],
			'chat_ban' => $USER['chat_ban'],
			'chat_bans' => sprintf($LNG['NOUVEAUTE_498'], str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $USER['chat_ban']), $USER['timezone'])),
			'theTImer' => TIMESTAMP,
		));
		
		$this->display('page.chat.default.tpl');
	}
	
	function envoyer() 
	{		
		global $USER, $LNG;
		$this->setWindow('ajax');
		$this->initTemplate();
		
		$GetLastTime = $GLOBALS['DATABASE']->GetFirstRow("SELECT timestamp FROM ".MINICHAT." WHERE userID = ".$USER['id']." ORDER BY timestamp DESC LIMIT 1;");
		if($GetLastTime['timestamp']+5 > TIMESTAMP){
			$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_827']."</span>";
			echo $Message;
		}elseif($USER['chat_ban'] < TIMESTAMP){
			$type				= HTTP::_GP('type', '');
			$action				= HTTP::_GP('action', 'ajouter_message', UTF8_SUPPORT);
			$bbcode_gras		= HTTP::_GP('bbcode_gras', 'B');
			$bbcode_italique	= HTTP::_GP('bbcode_italique', 'I');
			$bbcode_souligne	= HTTP::_GP('bbcode_souligne', 'U');
			$bbcode_lien		= HTTP::_GP('bbcode_lien', 'Lien');
			$bbcode_image		= HTTP::_GP('bbcode_image', 'Image');
			$bbcode_rouge		= HTTP::_GP('bbcode_rouge', '');
			$bbcode_orange		= HTTP::_GP('bbcode_orange', '');
			$bbcode_jaune		= HTTP::_GP('bbcode_jaune', '');
			$bbcode_chartreuse	= HTTP::_GP('bbcode_chartreuse', '');
			$bbcode_vert		= HTTP::_GP('bbcode_vert', '');
			$bbcode_cyan		= HTTP::_GP('bbcode_cyan', '');
			$bbcode_bleu		= HTTP::_GP('bbcode_bleu', '');
			$bbcode_violet		= HTTP::_GP('bbcode_violet', '');
			$bbcode_rose		= HTTP::_GP('bbcode_rose', '');
			$bbcode_gris		= HTTP::_GP('bbcode_gris', '');
			$bbcode_blanc		= HTTP::_GP('bbcode_blanc', '');
			$tchat_message		= HTTP::_GP('tchat_message', '', UTF8_SUPPORT);
			$submit_tchat		= HTTP::_GP('submit_tchat', 'Envoyer', UTF8_SUPPORT);
			$Message 			= "";
			if(empty($tchat_message)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_685']."</span>";
			}elseif($this->contains($tchat_message, '/chuchoter')){
				// Fonctionne parfaitement
				$spaceID	= 0;
				$spaceArray = explode(":", $tchat_message);
				$spaceArray = isset($spaceArray[1]) ? $spaceArray[1] : 'L\'utilisateur';
				
				$destinataire		 = $GLOBALS['DATABASE']->getFirstRow("SELECT id FROM ".USERS." WHERE username = '".$GLOBALS['DATABASE']->sql_escape($spaceArray)."';");
				
				if(empty($destinataire)){
					$Message = "<span class='rouge'>".$GLOBALS['DATABASE']->sql_escape($spaceArray)." n'extiste pas</span>";
				}else{
					$tchat_message = str_replace("/chuchoter", "", $tchat_message);
					$tchat_message = str_replace(":".$spaceArray.":", "", $tchat_message);
					$Message = "<span class='vert'>".$LNG['NOUVEAUTE_684']."</span>";
					$spaceID = $destinataire['id'];
					$GLOBALS['DATABASE']->query("INSERT INTO ".MINICHAT." SET 
						id			= ".$GLOBALS['DATABASE']->GetInsertID().",
						userID		= '".$GLOBALS['DATABASE']->sql_escape($USER['id'])."', 
						pseudo		= '".$GLOBALS['DATABASE']->sql_escape($USER['username'])."', 
						alliance	= '',
						message		= '".$GLOBALS['DATABASE']->sql_escape($tchat_message)."', 
						timestamp	= ".TIMESTAMP.", 
						color	= '',
						isAnnonce	= 0,
						destinataire	= '".$spaceID."';");
				}
			}elseif($this->contains($tchat_message, '/bannir')){			
				$spaceID	= 0;
				$spaceArray = explode(":", $tchat_message);
				$spaceArrayB = explode(":", $tchat_message);
				$spaceArray = isset($spaceArray[1]) ? $spaceArray[1] : 'L\'utilisateur';
				
				$destinataire		 = $GLOBALS['DATABASE']->getFirstRow("SELECT id FROM ".USERS." WHERE username = '".$GLOBALS['DATABASE']->sql_escape($spaceArray)."';");
				
				if($USER['authlevel'] == 0 && $USER['isModo'] == 0 && $USER['isStaff'] == 0){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_679']."</span>";
				}elseif(empty($destinataire)){
					$Message = "<span class='rouge'>".$GLOBALS['DATABASE']->sql_escape($spaceArray)." n'extiste pas</span>";
				}else{
					$banData = explode(" ", $spaceArrayB[2]);
					
					if(!isset($banData[1]) || !isset($banData[2])){
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_679']."</span>";	
					}else{
						$banTime = explode("=", $banData[1]);
						$banReas = explode("=", $banData[2]);
						$banTime = TIMESTAMP + ($banTime[1] * 3600);
						$banReas = $banReas[1];
						$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET chat_ban = '".$banTime."' WHERE username = '".$spaceArray."' ;");
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_683']."</span>";
						$tchat_message = sprintf($LNG['NOUVEAUTE_497'], $spaceArray, str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $banTime), $USER['timezone']), $banReas);
						$GLOBALS['DATABASE']->query("INSERT INTO ".MINICHAT." SET 
							id			= ".$GLOBALS['DATABASE']->GetInsertID().",
							userID		= '".$GLOBALS['DATABASE']->sql_escape($USER['id'])."', 
							pseudo		= '".$GLOBALS['DATABASE']->sql_escape($USER['username'])."', 
							alliance	= '',
							message		= '".$GLOBALS['DATABASE']->sql_escape($tchat_message)."', 
							timestamp	= ".TIMESTAMP.", 
							color	= '',
							isAnnonce	= 0,
							destinataire	= 0;");
					}
				}
			}elseif($this->contains($tchat_message, '/debannir')){			
				$spaceID	= 0;
				$spaceArray = explode(":", $tchat_message);
				$spaceArrayB = explode(":", $tchat_message);
				$spaceArray = isset($spaceArray[1]) ? $spaceArray[1] : 'L\'utilisateur';
				
				$destinataire		 = $GLOBALS['DATABASE']->getFirstRow("SELECT id FROM ".USERS." WHERE username = '".$GLOBALS['DATABASE']->sql_escape($spaceArray)."';");
				
				if($USER['authlevel'] == 0 && $USER['isModo'] == 0 && $USER['isStaff'] == 0){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_679']."</span>";
				}elseif(empty($destinataire)){
					$Message = "<span class='rouge'>".$GLOBALS['DATABASE']->sql_escape($spaceArray)." n'extiste pas</span>";
				}else{
					$banData = explode(" ", $spaceArrayB[2]);
					if(!isset($banData[1])){
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_679']."</span>";	
					}else{
						$banTime = explode("=", $banData[1]);
						$banTime = TIMESTAMP + ($banTime[1] * 3600);
						$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET chat_ban = 0 WHERE username = '".$spaceArray."' ;");
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_682']."</span>";
						$tchat_message = sprintf($LNG['NOUVEAUTE_500'], $spaceArray, str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $banTime), $USER['timezone']));
						$GLOBALS['DATABASE']->query("INSERT INTO ".MINICHAT." SET 
							id			= ".$GLOBALS['DATABASE']->GetInsertID().",
							userID		= '".$GLOBALS['DATABASE']->sql_escape($USER['id'])."', 
							pseudo		= '".$GLOBALS['DATABASE']->sql_escape($USER['username'])."', 
							alliance	= '',
							message		= '".$GLOBALS['DATABASE']->sql_escape($tchat_message)."', 
							timestamp	= ".TIMESTAMP.", 
							color	= '',
							isAnnonce	= 0,
							destinataire	= 0;");
					}
				}
			}elseif($this->contains($tchat_message, '/annonce')){		
					if($USER['authlevel'] == 0 && $USER['isModo'] == 0 && $USER['isStaff'] == 0){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_679']."</span>";
					}else{
						$tchat_message = str_replace("/annonce", "", $tchat_message);
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_681']."</span>";
						$GLOBALS['DATABASE']->query("INSERT INTO ".MINICHAT." SET 
							id			= ".$GLOBALS['DATABASE']->GetInsertID().",
							userID		= '".$GLOBALS['DATABASE']->sql_escape($USER['id'])."', 
							pseudo		= '".$GLOBALS['DATABASE']->sql_escape($USER['username'])."', 
							alliance	= '',
							message		= '".$GLOBALS['DATABASE']->sql_escape($tchat_message)."', 
							timestamp	= ".TIMESTAMP.", 
							color	= '',
							isAnnonce	= 1,
							destinataire	= 0;");
					}
			}elseif($this->contains($tchat_message, '/supprimer')){			
				
				if($USER['authlevel'] == 0 && $USER['isModo'] == 0 && $USER['isStaff'] == 0){
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_679']."</span>";
				}else{
					$deleteType = explode(" ", $tchat_message);
					if(!isset($deleteType[1])){
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_679']."</span>";	
					}elseif($deleteType[1] == "chuchotement"){
						$tchat_message = $LNG['NOUVEAUTE_501'];
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_680']."</span>";
						$GLOBALS['DATABASE']->query("DELETE FROM ".MINICHAT." WHERE destinataire != 0;");	
						$GLOBALS['DATABASE']->query("INSERT INTO ".MINICHAT." SET 
							id			= ".$GLOBALS['DATABASE']->GetInsertID().",
							userID		= '".$GLOBALS['DATABASE']->sql_escape($USER['id'])."', 
							pseudo		= '".$GLOBALS['DATABASE']->sql_escape($USER['username'])."', 
							alliance	= '',
							message		= '".$GLOBALS['DATABASE']->sql_escape($tchat_message)."', 
							timestamp	= ".TIMESTAMP.", 
							color	= '',
							isAnnonce	= 0,
							destinataire	= 0;");
					}elseif($deleteType[1] == "normal"){
						$tchat_message = $LNG['NOUVEAUTE_502'];
						$Message = "<span class='vert'>".$LNG['NOUVEAUTE_678']."</span>";
						$GLOBALS['DATABASE']->query("DELETE FROM ".MINICHAT.";");	
						$GLOBALS['DATABASE']->query("INSERT INTO ".MINICHAT." SET 
							id			= ".$GLOBALS['DATABASE']->GetInsertID().",
							userID		= '".$GLOBALS['DATABASE']->sql_escape($USER['id'])."', 
							pseudo		= '".$GLOBALS['DATABASE']->sql_escape($USER['username'])."', 
							alliance	= '',
							message		= '".$GLOBALS['DATABASE']->sql_escape($tchat_message)."', 
							timestamp	= ".TIMESTAMP.", 
							color	= '',
							isAnnonce	= 0,
							destinataire	= 0;");
					}elseif($deleteType[1] == "joueur"){
						
						$spaceArray = explode(":", $tchat_message);
						$spaceArrayB = explode(":", $tchat_message);
						$spaceArray = isset($spaceArray[1]) ? $spaceArray[1] : 'L\'utilisateur';
						
						$destinataire		 = $GLOBALS['DATABASE']->getFirstRow("SELECT id FROM ".USERS." WHERE username = '".$GLOBALS['DATABASE']->sql_escape($spaceArray)."';");
				
						if($USER['authlevel'] == 0 && $USER['isModo'] == 0 && $USER['isStaff'] == 0){
							$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_679']."</span>";
						}elseif(empty($destinataire)){
							$Message = "<span class='rouge'>".$GLOBALS['DATABASE']->sql_escape($spaceArray)." n'extiste pas</span>";
						}else{
							$tchat_message = sprintf($LNG['NOUVEAUTE_503'], $spaceArray);
							$Message = "<span class='vert'>".$LNG['NOUVEAUTE_678']."</span>";
							$GLOBALS['DATABASE']->query("DELETE FROM ".MINICHAT." WHERE userID = '".$destinataire['id']."';");	
							$GLOBALS['DATABASE']->query("INSERT INTO ".MINICHAT." SET 
								id			= ".$GLOBALS['DATABASE']->GetInsertID().",
								userID		= '".$GLOBALS['DATABASE']->sql_escape($USER['id'])."', 
								pseudo		= '".$GLOBALS['DATABASE']->sql_escape($USER['username'])."', 
								alliance	= '',
								message		= '".$GLOBALS['DATABASE']->sql_escape($tchat_message)."', 
								timestamp	= ".TIMESTAMP.", 
								color	= '',
								isAnnonce	= 0,
								destinataire	= 0;");
						}
					}
				}
			}else{
				$Message = "<span class='vert'>".$LNG['NOUVEAUTE_677']."</span>";
				$GLOBALS['DATABASE']->query("INSERT INTO ".MINICHAT." SET 
					id			= ".$GLOBALS['DATABASE']->GetInsertID().",
					userID		= '".$GLOBALS['DATABASE']->sql_escape($USER['id'])."', 
					pseudo		= '".$GLOBALS['DATABASE']->sql_escape($USER['username'])."', 
					alliance	= '',
					message		= '".$GLOBALS['DATABASE']->sql_escape($tchat_message)."', 
					timestamp	= ".TIMESTAMP.", 
					color	= '',
					isAnnonce	= 0,
					destinataire	= 0;");
			}
			echo $Message;
		}else{
			$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_499']."</span>";
			echo $Message;
		}
	}
	
	function contains($haystack, $needle, $caseSensitive = false) {
    return $caseSensitive ? (strpos($haystack, $needle) === FALSE ? FALSE : TRUE):(stripos($haystack, $needle) === FALSE ? FALSE : TRUE);
	}
}
