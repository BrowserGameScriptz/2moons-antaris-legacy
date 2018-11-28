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
 * @info $Id: class.ShowSettingsPage.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */

class ShowSettingsPage extends AbstractPage
{
	public static $requireModule = MODULE_SETTINGS;

	function __construct() 
	{
		parent::__construct();
	}
	
	public function show()
	{
		global $USER, $LNG, $CONF;
		
		$Message = array();
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$dateOfBirth		= HTTP::_GP('date_de_naissance', 0);
			$dateOfBirth1		= HTTP::_GP('date_de_naissance1', 0);
			$dateOfBirth2		= HTTP::_GP('date_de_naissance2', 0);
			$dateOfBirthCheck = strtotime(''.$dateOfBirth.'-'.$dateOfBirth1.'-'.$dateOfBirth2.'');
			$sexe		= HTTP::_GP('sexe', 1);
			$allowedSex = array(1, 2);
			
			if((empty($dateOfBirthCheck) || $dateOfBirth == 0 || $dateOfBirth1 == 0 || $dateOfBirth2 == 0) && $USER['date_of_birth'] > 0){
				$Message[] = '<span class="orange">'.$LNG['NOUVEAUTE_172'].'</span>';
			}
			elseif(empty($dateOfBirthCheck) || $dateOfBirth == 0 || $dateOfBirth1 == 0 || $dateOfBirth2 == 0){
				$Message[] = '<span class="rouge">'.$LNG['NOUVEAUTE_168'].'</span>';
			}
			elseif($dateOfBirth < 0 || $dateOfBirth1 < 0 || $dateOfBirth2 < 0 || strlen($dateOfBirth) > 2 || strlen($dateOfBirth1) > 2 || strlen($dateOfBirth2) > 4){
				$Message[] = '<span class="rouge">'.$LNG['NOUVEAUTE_167'].'</span>';
			}
			else{
				$Message[] = '<span class="vert">'.$LNG['NOUVEAUTE_169'].'</span>';
				$SQL		= "UPDATE ".USERS." SET date_of_birth = '".$GLOBALS['DATABASE']->sql_escape($dateOfBirthCheck)."' WHERE id = ".$USER['id'].";";
				$GLOBALS['DATABASE']->query($SQL);
				
				$LOG = new Logcheck(9);
				$LOG->username = $USER['username'];
				$LOG->pageLog  = "page=settings";
				$LOG->info     = "The player changed hes date of birth: "._date($LNG['php_tdformat'], $GLOBALS['DATABASE']->sql_escape($dateOfBirthCheck), $USER['timezone']).".";
				$LOG->save();
			}
			
			if($USER['sexe'] > 0){
				$Message[] = '<span class="orange">'.$LNG['NOUVEAUTE_173'].'</span>';
			}elseif(!in_array($sexe, $allowedSex)){
				$Message[] = '<span class="rouge">'.$LNG['NOUVEAUTE_170'].'</span>';
			}else{
				$Message[] = '<span class="vert">'.$LNG['NOUVEAUTE_171'].'</span>';
				$SQL		= "UPDATE ".USERS." SET sexe = '".$GLOBALS['DATABASE']->sql_escape($sexe)."' WHERE id = ".$USER['id'].";";
				$GLOBALS['DATABASE']->query($SQL);
				
				$sexName = "Man";
				if($sexe == 2)
					$sexName = "Woman";
				$LOG = new Logcheck(9);
				$LOG->username = $USER['username'];
				$LOG->pageLog  = "page=settings";
				$LOG->info     = "The player changed hes sex: ".$GLOBALS['DATABASE']->sql_escape($sexName).".";
				$LOG->save();
			}
		}
		
		$this->tplObj->assign_vars(array(				
			'Message' => implode("<br>\r\n", $Message),
			'email' => $USER['email'],
			'drate' => date('d/m/Y', $USER['date_of_birth']),
			'drates' => $USER['date_of_birth'],
			'sexe' => $USER['sexe'],
		));
		$this->display('page.settings.personal.tpl');
	}
	
	public function avatar()
	{
		global $USER, $LNG, $CONF;
		define('TARGET', 'styles/avatars/'); // Repertoire cible
		define('MAX_SIZE', 200000); // Taille max en octets du fichier
		define('WIDTH_MAX', 800); // Largeur max de l'image en pixels
		define('HEIGHT_MAX', 800); // Hauteur max de l'image en pixels
		// Tableaux de donnees
		$tabExt = array('jpg','png','jpeg', 'gif'); // Extensions autorisees

		$infosImg = array();
		// Variables
		$extension = '';
		$message = '';
		$nomImage = '';
		$Message = '';


		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$fichier = basename($_FILES['fichier']['name']);
			if( !empty($_FILES['fichier']['name']) )
			{
				$extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
				if(in_array(strtolower($extension),$tabExt))
				{
					$infosImg = getimagesize($_FILES['fichier']['tmp_name']);
					if($infosImg[2] >= 1 && $infosImg[2] <= 14)
					{
						if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE))
						{
							if(isset($_FILES['fichier']['error'])&& UPLOAD_ERR_OK === $_FILES['fichier']['error'])
							{
								$nomImage = md5(uniqid()) .'.'. $extension;
								if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage))
								{
									$SQL		= "UPDATE ".USERS." SET avatar = '".$nomImage."' WHERE id = ".$USER['id'].";";
									$GLOBALS['DATABASE']->multi_query($SQL);
									$Message = "<span class='vert'>".$LNG['NOUVEAUTE_176']."</span>";
									$LOG = new Logcheck(9);
									$LOG->username = $USER['username'];
									$LOG->pageLog  = "page=settings&mode=avatar";
									$LOG->info     = "The player changed hes avatar: ".$GLOBALS['DATABASE']->sql_escape($nomImage).".";
									$LOG->save();
								}
								else
								{
									$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_177']."</span>";
								}
							}
							else
							{
								$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_178']."</span>";
							}
						}
						else
						{
							$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_179']."</span>";
						}
					}
					else
					{
						$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_180']."</span>";
					}
				}
				else
				{
					$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_181']."</span>";
				}
			}
			else
			{
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_182']."</span>";
			}
		}
		$Details = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE `id` = '".$USER['id']."';");
		
		$this->tplObj->assign_vars(array(				
			'Message' => $Message,
			'avatar' => $Details['avatar'],
			'usernamea' => $USER['username'],
			'NOUVEAUTE_175' => sprintf($LNG['NOUVEAUTE_175'], $USER['username']),
		));
		$this->display('page.settings.avatar.tpl');
	}
	
	
	
	public function signature()
	{
		global $USER, $LNG, $CONF;
		$this->tplObj->assign_vars(array(	
			'userid' => $USER['id'],
			'ref_active'		=> Config::get('ref_active'),
		));
		$this->display('page.settings.signature.tpl');
	}
	
	public function design()
	{
		global $USER, $LNG, $CONF;
		
			$this->tplObj->assign_vars(array(				
			'custom_color' => $USER['custom_color'],
			'galaxy_space' => $USER['galaxy_space'],
			));
			
			$this->display('page.settings.design.tpl');
	}
	
	public function designSend() {
		global $USER, $LNG, $PLANET;
		$Color			= HTTP::_GP('Color', '');
		//$Galaxy			= HTTP::_GP('Galaxy', 0);
		//$allowedGal		= array(0,1);
		$allowedColors	= array('FF9900', 'FFBB00', 'FFFF00', 'CCFF00', '075502', '118822', '00FF00', '44FF00', '77FF00', '99FF00', 'AAFF00', '002255', '004088', '3360AA', '5580BB', '55BBAA', '77CCDD', '86F0FC', '5F1789', '781CAC', 'D32EE2', '853FAD', 'A363C7', 'E26AED', 'F5A2E3', '444444', '555555', '777777', '999999', 'AAAAAA', 'CCCCCC', 'FFFFFF');
		$Message = array();
		
		if(!in_array($Color, $allowedColors)) //hex color is valid
		{
			$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_186']."</span>";
		}
		elseif($Color == $USER['custom_color'])
		{
			$Message[] = "<span class='orange'>".$LNG['NOUVEAUTE_187']."</span>";
		}
		else
		{
			$Message[] = "<span class='vert'>".$LNG['NOUVEAUTE_188']."</span>";
			$SQL	= "UPDATE ".USERS." SET `custom_color` = '".$GLOBALS['DATABASE']->sql_escape($Color)."' WHERE id = '".$USER["id"]."';";
			$GLOBALS['DATABASE']->query($SQL);
			$LOG = new Logcheck(9);
			$LOG->username = $USER['username'];
			$LOG->pageLog  = "page=settings&mode=design";
			$LOG->info     = "The player changed hes custom color: #".$GLOBALS['DATABASE']->sql_escape($Color).".";
			$LOG->save();
		}
		
		/*if(!in_array($Galaxy, $allowedGal)){
			$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_183']."</span>";
		}elseif($Galaxy == $USER['galaxy_space']){
			$Message[] = "<span class='orange'>".$LNG['NOUVEAUTE_184']."</span>";
		}else{
			$Message[] = "<span class='vert'>".$LNG['NOUVEAUTE_185']."</span>";
			$SQL	= "UPDATE ".USERS." SET `galaxy_space` = '".$GLOBALS['DATABASE']->sql_escape($Galaxy)."' WHERE id = '".$USER["id"]."';";
			$GLOBALS['DATABASE']->query($SQL);
		}*/

		$resp = implode("<br>\r\n", $Message).'<br><br><a onclick="location.href=\'game.php?page=settings&mode=design\';">'.$LNG['NOUVEAUTE_21'].'.</a>';
		
		$this->sendJSON($resp);
	}
	
	
	public function notification()
	{
		global $USER, $LNG, $CONF;
		
		$Message = ""; 
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$notification_messagerie			= abs(HTTP::_GP('notification_messagerie', 0));
			$notification_attaque_subie			= abs(HTTP::_GP('notification_attaque_subie', 0));
			$notification_tchat					= abs(HTTP::_GP('notification_tchat', 0));
			$notification_connexion				= abs(HTTP::_GP('notification_connexion', 0));
			$notification_annonce				= abs(HTTP::_GP('notification_annonce', 0));
			$notification_champ_force			= abs(HTTP::_GP('notification_champ_force', 0));
			$MessageLog1						= array();
			
			if($notification_messagerie == $USER['notification_messagerie'] && $notification_attaque_subie == $USER['notification_attaque_subie'] && $notification_tchat == $USER['notification_tchat'] && $notification_connexion == $USER['notification_connexion'] && $notification_annonce == $USER['notification_annonce'] && $notification_champ_force == $USER['notification_champ_force']){
				$Message = "<span class='orange'>".$LNG['NOUVEAUTE_203']."</span>";
			}
			else{
				$Message = "<span class='vert'>".$LNG['NOUVEAUTE_202']."</span>";
				$SQL	= "UPDATE ".USERS." SET `notification_messagerie` = '".$GLOBALS['DATABASE']->sql_escape($notification_messagerie)."', `notification_attaque_subie` = '".$GLOBALS['DATABASE']->sql_escape($notification_attaque_subie)."', `notification_tchat` = '".$GLOBALS['DATABASE']->sql_escape($notification_tchat)."', `notification_connexion` = '".$GLOBALS['DATABASE']->sql_escape($notification_connexion)."', `notification_annonce` = '".$GLOBALS['DATABASE']->sql_escape($notification_annonce)."', `notification_champ_force` = '".$GLOBALS['DATABASE']->sql_escape($notification_champ_force)."' WHERE id = '".$USER["id"]."';";
				$GLOBALS['DATABASE']->query($SQL);
				
				if($notification_messagerie == 0 && $USER['notification_messagerie'] == 1){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player deactivated: notification_messagerie.";
					$LOG->save();
				}elseif($notification_messagerie == 1 && $USER['notification_messagerie'] == 0){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player activated: notification_messagerie.";
					$LOG->save();
				}
				
				if($notification_attaque_subie == 0 && $USER['notification_attaque_subie'] == 1){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player deactivated: notification_attaque_subie.";
					$LOG->save();
				}elseif($notification_attaque_subie == 1 && $USER['notification_attaque_subie'] == 0){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player activated: notification_attaque_subie.";
					$LOG->save();
				}
				
				if($notification_tchat == 0 && $USER['notification_tchat'] == 1){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player deactivated: notification_tchat.";
					$LOG->save();
				}elseif($notification_tchat == 1 && $USER['notification_tchat'] == 0){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player activated: notification_tchat.";
					$LOG->save();
				}
				
				if($notification_connexion == 0 && $USER['notification_connexion'] == 1){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player deactivated: notification_connexion.";
					$LOG->save();
				}elseif($notification_connexion == 1 && $USER['notification_connexion'] == 0){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player activated: notification_connexion.";
					$LOG->save();
				}
				
				if($notification_annonce == 0 && $USER['notification_annonce'] == 1){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player deactivated: notification_annonce.";
					$LOG->save();
				}elseif($notification_annonce == 1 && $USER['notification_annonce'] == 0){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player activated: notification_annonce.";
					$LOG->save();
				}
				
				if($notification_champ_force == 0 && $USER['notification_champ_force'] == 1){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player deactivated: notification_champ_force.";
					$LOG->save();
				}elseif($notification_champ_force == 1 && $USER['notification_champ_force'] == 0){
					$LOG = new Logcheck(9);
					$LOG->username = $USER['username'];
					$LOG->pageLog  = "page=settings&mode=notification";
					$LOG->info     = "The player activated: notification_champ_force.";
					$LOG->save();
				}

			}			
		}
		
		$Details = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE `id` = '".$USER['id']."';");
		$this->tplObj->assign_vars(array(				
			'Message'					=> $Message,
			'notification_messagerie'	=> $Details['notification_messagerie'],
			'notification_attaque_subie'=> $Details['notification_attaque_subie'],
			'notification_tchat'		=> $Details['notification_tchat'],
			'notification_connexion'	=> $Details['notification_connexion'],
			'notification_annonce'		=> $Details['notification_annonce'],
			'notification_champ_force'	=> $Details['notification_champ_force'],
		));
			
		$this->display('page.settings.notification.tpl');
	}
	
	private function CheckVMode(){
		global $USER, $PLANET;
		if(!empty($USER['b_tech']) || !empty($PLANET['b_building']) || !empty($PLANET['b_hangar']))
			return false;
			

		$fleets = $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".FLEETS." WHERE `fleet_owner` = ".$USER['id'].";");
		if($fleets != 0)
			return false;
							
		$query = $GLOBALS['DATABASE']->query("SELECT * FROM ".PLANETS." WHERE id_owner = ".$USER['id']." AND id != ".$PLANET['id']." AND destruyed = 0;");
			
		while($CPLANET = $GLOBALS['DATABASE']->fetch_array($query))
		{
			list($USER, $CPLANET)	= $this->ecoObj->CalcResource($USER, $CPLANET, true);
			
			if(!empty($CPLANET['b_building']) || !empty($CPLANET['b_hangar']))
				return false;
				
			unset($CPLANET);
		}

		$GLOBALS['DATABASE']->free_result($query);
		return true;
	}

	public function vmode()
	{
		global $USER, $LNG, $CONF;
		$this->tplObj->assign_vars(array(				
			'ddate'			=> date('F j, Y, g:i a', TIMESTAMP + Config::get('vmode_min_time')) ,
			'vmoded' => $USER['urlaubs_modus'],
			'vuntil' => $USER['urlaubs_until'],
			'timuing' => TIMESTAMP,
			'ddates'			=> date('F j, Y, g:i a', $USER['urlaubs_until']) ,
		));
		$this->display('page.settings.vmode.tpl');
	}
	
	public function vmodeSend()
	{
		
		function __construct() 
		{
			parent::__construct();
			$this->setWindow('popup');
		}
	
		global $USER, $LNG, $CONF, $SESSION;
		
		$SQL	= "UPDATE ".USERS." SET 
					urlaubs_modus = '1',
					urlaubs_until = ".(TIMESTAMP + Config::get('vmode_min_time'))."
					WHERE id = ".$USER["id"].";							
					UPDATE ".PLANETS." SET
					metal_mine_porcent = '0',
					crystal_mine_porcent = '0',
					elyrium_mine_porcent = '0',
					deuterium_sintetizer_porcent = '0',
					metal_mine_extract_porcent = '0',
					crystal_mine_extract_porcent = '0',
					elyrium_mine_extract_porcent = '0',
					deuterium_sintetizer_extract_porcent = '0',
					metal_perhour = '0',
					crystal_perhour = '0',
					deuterium_perhour = '0',
					elyrium_perhour = '0'
					WHERE id_owner = ".$USER["id"].";";
		
		$GLOBALS['DATABASE']->multi_query($SQL);
		
		$LOG = new Logcheck(9);
		$LOG->username = $USER['username'];
		$LOG->pageLog  = "page=settings&mode=vmode";
		$LOG->info     = "The player entered in vacation mode";
		$LOG->save();
		
		$SESSION->DestroySession();
		header('Location: index.php');
				
	}
	
	public function delete()
	{
		global $USER, $LNG, $CONF, $SESSION;
		$Message = "";
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$password			= HTTP::_GP('mdp', '');
			if (!empty($password) && cryptPassword($password) == $USER["password"])
			{
				$this->setWindow('popup');
				$SQL		= "UPDATE ".USERS." SET user_deleted = '1', urlaubs_modus = '1' WHERE id = ".$USER['id'].";";
				$GLOBALS['DATABASE']->query($SQL);
				$LOG = new Logcheck(9);
				$LOG->username = $USER['username'];
				$LOG->pageLog  = "page=settings&mode=delete";
				$LOG->info     = "The player deleted hes account";
				$LOG->save();
		$this->printMessage('<span class="vert">'.$LNG['op_options_changed'].'</span>');
				$SESSION->DestroySession();
				$this->display('page.logout.default.tpl');
			}else{
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_209']."</span>";
			}
		}
		
		$this->tplObj->assign_vars(array(
		'Message'	=> $Message,
		));
		$this->display('page.settings.delete.tpl');
	}

	
	public function vmodeEnd()
	{
		global $USER, $LNG, $CONF, $SESSION;
		$SQL		= "UPDATE ".USERS." SET urlaubs_modus = '0', urlaubs_until = ".(TIMESTAMP + 48*3600)." WHERE id = ".$USER['id'].";";
		$GLOBALS['DATABASE']->multi_query($SQL);
		$LOG = new Logcheck(9);
		$LOG->username = $USER['username'];
		$LOG->pageLog  = "page=settings&mode=vmode";
		$LOG->info     = "The player left vacation mode";
		$LOG->save();
		$this->printMessage('<span class="vert">'.$LNG['op_options_changed'].'</span>');	
	}
	
}
	

