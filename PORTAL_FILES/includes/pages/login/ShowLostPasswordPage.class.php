<?php

/**
 *  2Moons 
 *   by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package 2Moons
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @licence MIT
 * @version 1.8.0
 * @link https://github.com/jkroepke/2Moons
 */


class ShowLostPasswordPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		$this->setWindow('light');
	}
	
	function show($Msg = 0, $Rgs = 0, $mailing = 0) 
	{
		global $LNG;
		
		$session = session::load();
		
		if($session->isValidSession())
		{
			HTTP::redirectTo('index.php');	
		}else{
			
		$universeSelect	= $this->getUniverseSelector();
		$MsgI = 0;
		if($Msg != 0){
			$Msg = implode("<br>\r\n", $Msg);
			$MsgI = 1;
		}
		
		$this->assign(array(
			'mail'				=> $mailing,
			'Rgs'				=> $Rgs,
			'Msg'				=> $Msg,
			'MsgI'				=> $MsgI,
			'MsgII'				=> sprintf($LNG['LOSTPWD_15'],$mailing),
			'universeSelect'	=> $universeSelect
		));
		
		$this->display('page.lostPassword.default.tpl');
		}
	}
	
	function newPassword() 
	{
		global $LNG;
		$userID			= HTTP::_GP('u', 0);
		$validationKey	= HTTP::_GP('k', '');

		$db = Database::get();

		$sql = "SELECT * FROM %%LOSTPASSWORD%% WHERE userID = :userID AND `key` = :validationKey AND `time` > :time AND hasChanged = 0;";
		$isValid = $db->selectSingle($sql, array(
			':userID'			=> $userID,
			':validationKey'	=> $validationKey,
			':time'				=> TIMESTAMP
		));

		if(empty($isValid))
		{
			HTTP::redirectTo('index.php?page=error403');
		} 
		$errors 	= array();
		$iserror	= 0;
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$password 		= HTTP::_GP('password', '');
			$confirmation	= HTTP::_GP('confirmation', '');
					
			if(empty($password)) {
				$errors[]	= $LNG['REGISTER_71'];
				$iserror	= 1;
			}elseif(strlen($password) < 6 || strlen($password) > 32){
				$errors[]	= $LNG['REGISTER_30'];
				$iserror	= 1;
			}
			if($password != $confirmation) {
				$errors[]	= $LNG['REGISTER_54'];
				$iserror	= 1;
			}
			
			if($iserror == 0){
				$sql = "UPDATE %%USERS%% SET password = :newPassword WHERE id = :userID;";
				$db->update($sql, array(
					':userID'		=> $userID,
					':newPassword'	=> PlayerUtil::cryptPassword($confirmation)
				));
				$sql = "UPDATE %%LOSTPASSWORD%% SET hasChanged = 1, hasChangedTime = :hasChangedTime WHERE userID = :userID AND `key` = :validationKey;";
				$db->update($sql, array(
					':userID'			=> $userID,
					':validationKey'	=> $validationKey,
					':hasChangedTime'	=> TIMESTAMP + 15
				));
		
				HTTP::redirectTo('index.php?newpass='.$validationKey);
			}
			
		}
		
		$userDataLost		   	= GetFromDatabase('USERS', 'id', $userID, array('onlinetime', 'universe', 'username'));
		$config					= Config::get($userDataLost['universe']);
		$lostCoun				= $this->getLocationInfoByIp();
		$this->assign(array(
			'errors'  	=> implode("<br>\r\n", $errors),
			'iserror'  	=> $iserror,
			'lostusername'  => $userDataLost['username'],
			'lostuniverse'  => $config->uni_name,
			'lostonlineti'  => date('d-M-y H:i:s', $userDataLost['onlinetime']),
			'lostexpires'   => date('d-M-y H:i:s', $isValid['time']),
			'lostIp'		=> Session::getClientIp(),
			'lostCoun'		=> $lostCoun['country'],
		));
		
		$this->display('page.lostPassword.change.tpl');
		
	}
	
	function getLocationInfoByIp(){
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = @$_SERVER['REMOTE_ADDR'];
		$result  = array('country'=>'', 'city'=>'');
		if(filter_var($client, FILTER_VALIDATE_IP)){
			$ip = $client;
		}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
			$ip = $forward;
		}else{
			$ip = $remote;
		}
		$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
		if($ip_data && $ip_data->geoplugin_countryName != null){
			$result['country'] = $ip_data->geoplugin_countryName;
			$result['city'] = $ip_data->geoplugin_city;
		}
		return $result;
	}
	
	function send()
	{
		global $LNG;
		$captcha	= HTTP::_GP('captcha', '');
		$mail		= HTTP::_GP('email', '', true);
		
		$errorMessages	= array();

		if(empty($mail))
		{
			$errorMessages[]	= $LNG['CONTACT_38'];
		}
		
		if(!PlayerUtil::isMailValid($mail)) {
			$errorMessages[]	= $LNG['CONTACT_39'];
		}
		
		session_start();
		if(empty($captcha)){
			$errorMessages[]	= $LNG['CONTACT_44'];
		}elseif($captcha != $_SESSION["code"]) {
			$errorMessages[]	= $LNG['REGISTER_66'];
		}
		
		
		
		$db = Database::get();
		
		$sql = "SELECT id FROM %%USERS%% WHERE universe = :universe AND email_2 = :mail;";
		$userID = $db->selectSingle($sql, array(
			':universe'	=> Universe::current(),
			':mail'		=> $mail
		), 'id');

		if(empty($userID) && $captcha == $_SESSION["code"] && !empty($mail))
		{
			$errorMessages[]	= $LNG['LOSTPWD_9'];
		}
			
		$config	= Config::get();

		if (!empty($errorMessages)) {
			$Rgs = 0;
			$this->Show($errorMessages, $Rgs, $mail);			
		}else{

			/* $sql = "SELECT COUNT(*) as state FROM %%LOSTPASSWORD%% WHERE userID = :userID AND time > :time AND hasChanged = 0;";
			$hasChanged = $db->selectSingle($sql, array(
				':userID'	=> $userID,
				':time'		=> (TIMESTAMP - 86400)
			), 'state');

			if(!empty($hasChanged))
			{
				$this->printMessage($LNG['passwordErrorOnePerDay'], array(array(
					'label'	=> $LNG['passwordBack'],
					'url'	=> 'index.php?page=lostPassword',
				)));
			} */

			$validationKey	= md5(uniqid());
						
			$MailRAW		= $LNG->getTemplate('email_lost_password_validation');
		
			$MailContent	= str_replace(array(
				'{GAMENAME}',
				'{VALIDURL}',
			), array(
				$config->game_name.' - '.$config->uni_name,
				HTTP_PATH.'index.php?page=lostPassword&mode=newPassword&u='.$userID.'&k='.$validationKey,
			), $MailRAW);
		
			require 'includes/classes/Mail.class.php';

			$subject	= sprintf($LNG['passwordValidMailTitle'], $config->game_name);

			Mail::send($mail, "", $subject, $MailContent);

			$sql = "INSERT INTO %%LOSTPASSWORD%% SET userID = :userID, `key` = :validationKey, `time` = :timestamp, fromIP = :remoteAddr;";
			$db->insert($sql, array(
				':userID'		=> $userID,
				':timestamp'	=> TIMESTAMP + 1800,
				':validationKey'=> $validationKey,
				':remoteAddr'	=> Session::getClientIp()
			));	
			
			$this->Show(0, 1, $mail);

			//$this->printMessage($LNG['passwordValidMailSend'], array(array(
			//	'label'	=> $LNG['passwordNext'],
			//	'url'	=> 'index.php',
			//)));
		}	
	}
}