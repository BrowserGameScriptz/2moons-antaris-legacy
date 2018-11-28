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
 
//Veuillez renseigner un pseudo pour accéder à votre compte.
//Veuillez renseigner l'adresse email du compte (propriétaire).
//Votre adresse email n'est pas valide.
//Veuillez renseigner un mot de passe pour accéder à votre compte.
//La confirmation et le mot de passe ne sont pas identique.
//Veuillez saisir un nom pour votre planète mére/principale.
//Veuillez saisir le code de sécurité qui permet de nous assurer que vous êtes un humain.
//Veuillez accepter intégralement le règlement du jeu.
//Veuillez accepter les conditions générales d'utilisation.

class ShowRegisterPage extends AbstractLoginPage
{
	function __construct() 
	{
		parent::__construct();
		$this->setWindow('light');
	}
	
	function show($Msg = 0, $Rgs = 0)
	{
		global $LNG;
		
		$session = session::load();
		
		if($session->isValidSession())
		{
			HTTP::redirectTo('index.php');	
		}else{
			
		$universeSelect	= array();	
		$referralData	= array('id' => 0, 'name' => '');
		$accountName	= "";
		
		$externalAuth	= HTTP::_GP('externalAuth', array());
		$referralID 	= HTTP::_GP('referralID', 0);
		$MsgI = 0;
		if($Msg != 0){
			$Msg = implode("<br>\r\n", $Msg);
			$MsgI = 1;
		}

		foreach(Universe::availableUniverses() as $uniId)
		{
			$config = Config::get($uniId);
			$universeSelect[$uniId]	= $config->uni_name.($config->game_disable == 0 || $config->reg_closed == 1 ? $LNG['uni_closed'] : '');
		}
		
		if(!isset($externalAuth['account'], $externalAuth['method']))
		{
			$externalAuth['account']	= 0;
			$externalAuth['method']		= '';
		}
		else
		{
			$externalAuth['method']		= strtolower(str_replace(array('_', '\\', '/', '.', "\0"), '', $externalAuth['method']));
		}
		
		if(!empty($externalAuth['account']) && file_exists('includes/extauth/'.$externalAuth['method'].'.class.php'))
		{
			$path	= 'includes/extauth/'.$externalAuth['method'].'.class.php';
			require($path);
			$methodClass	= ucwords($externalAuth['method']).'Auth';
			/** @var $authObj externalAuth */
			$authObj		= new $methodClass;
			
			if(!$authObj->isActiveMode())
			{
				$this->redirectTo('index.php?code=5');
			}
			
			if(!$authObj->isValid())
			{
				$this->redirectTo('index.php?code=4');
			}
			
			$accountData	= $authObj->getAccountData();
			$accountName	= $accountData['name'];
		}

		$config			= Config::get();
		if($config->ref_active == 1 && !empty($referralID))
		{
			$db = Database::get();

			$sql = "SELECT username FROM %%USERS%% WHERE id = :referralID AND universe = :universe;";
			$referralAccountName = $db->selectSingle($sql, array(
				':referralID'	=> $referralID,
				':universe'		=> Universe::current()
			), 'username');

			if(!empty($referralAccountName))
			{
				$referralData	= array('id' => $referralID, 'name' => $referralAccountName);
			}
		}
		
		$this->assign(array(
			'Rgs'				=> $Rgs,
			'Msg'				=> $Msg,
			'MsgI'				=> $MsgI,
			'referralData'		=> $referralData,
			'accountName'		=> $accountName,
			'externalAuth'		=> $externalAuth,
			'universeSelect'	=> $universeSelect,
			'registerRulesDesc'	=> sprintf($LNG['registerRulesDesc'], '<a href="index.php?page=rules">'.$LNG['menu_rules'].'</a>')
		));
		
		$this->display('page.register.default.tpl');
		}
	}
	
	function send() 
	{
		global $LNG;
		$config		= Config::get();

		if($config->game_disable == 0 || $config->reg_closed == 1)
		{
			$this->printMessage($LNG['registerErrorUniClosed'], array(array(
				'label'	=> $LNG['registerBack'],
				'url'	=> 'javascript:window.history.back()',
			)));
		}

		$userName 		= HTTP::_GP('nickname', '', UTF8_SUPPORT);
		$password 		= HTTP::_GP('password', '', true);
		$password2 		= HTTP::_GP('confirmation', '', true);
		$mailAddress 	= HTTP::_GP('email', '');
		$planetName 	= HTTP::_GP('namePlanet', '', UTF8_SUPPORT);
		$rulesChecked	= HTTP::_GP('ruleGame', 0);
		$condChecked	= HTTP::_GP('termAndCondition', 0);
		$language 		= HTTP::_GP('lang', '');
		$captcha 		= HTTP::_GP('captcha', 0);
		
		$langarray 		= array('en', 'de', 'es', 'it', 'pl', 'pt', 'fr');
		
		if(!in_array($language, $langarray))
			$language = "en";
		
		$referralID 	= HTTP::_GP('referralID', 0);

		$externalAuth	= HTTP::_GP('externalAuth', array());
		if(!isset($externalAuth['account'], $externalAuth['method']))
		{
			$externalAuthUID	= 0;
			$externalAuthMethod	= '';
		}
		else
		{
			$externalAuthUID	= $externalAuth['account'];
			$externalAuthMethod	= strtolower(str_replace(array('_', '\\', '/', '.', "\0"), '', $externalAuth['method']));
		}
				
		$errors 	= array();
				
		if(empty($userName)) {
			$errors[]	= $LNG['REGISTER_49'];
		}elseif(strlen($userName) < 3 || strlen($userName) > 16){
			$errors[]	= $LNG['REGISTER_38'];
		}
		
		if(empty($password)) {
			$errors[]	= $LNG['REGISTER_70'];
		}elseif(strlen($password) < 6 || strlen($password) > 32){
			$errors[]	= $LNG['REGISTER_30'];
		}
		
		if($password != $password2) {
			$errors[]	= $LNG['REGISTER_54'];
		}
		
		if(empty($mailAddress)) {
			$errors[]	= $LNG['REGISTER_50'];
		}elseif(!PlayerUtil::isMailValid($mailAddress)) {
			$errors[]	= $LNG['REGISTER_55'];
		}
		
		if(empty($planetName)) {
			$errors[]	= $LNG['REGISTER_51'];
		}elseif(strlen($planetName) < 5 || strlen($planetName) > 18){
			$errors[]	= $LNG['REGISTER_45'];
		}
		
		if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $planetName)){
			$errors[]	= $LNG['REGISTER_57'];
		}
	
		if($rulesChecked != 1) {
			$errors[]	= $LNG['REGISTER_52'];
		}
		
		if($condChecked != 1) {
			$errors[]	= $LNG['REGISTER_53'];
		}
		
		if(!PlayerUtil::isNameValid($userName)) {
			$errors[]	= $LNG['REGISTER_56'];
		}
		
		
		session_start();
		if(empty($captcha)) {
			$errors[]	= $LNG['REGISTER_65'];
		}elseif($captcha != $_SESSION["code"]) {
			$errors[]	= $LNG['REGISTER_66'];
		}
		
		$db = Database::get();

		$sql = "SELECT (
				SELECT COUNT(*)
				FROM %%USERS%%
				WHERE universe = :universe
				AND username = :userName
			) + (
				SELECT COUNT(*)
				FROM %%USERS_VALID%%
				WHERE universe = :universe
				AND username = :userName
			) as count;";

		$countUsername = $db->selectSingle($sql, array(
			':universe'	=> Universe::current(),
			':userName'	=> $userName,
		), 'count');

		$sql = "SELECT (
			SELECT COUNT(*)
			FROM %%USERS%%
			WHERE universe = :universe
			AND (
				email = :mailAddress
				OR email_2 = :mailAddress
			)
		) + (
			SELECT COUNT(*)
			FROM %%USERS_VALID%%
			WHERE universe = :universe
			AND email = :mailAddress
		) as count;";

		$countMail = $db->selectSingle($sql, array(
			':universe'		=> Universe::current(),
			':mailAddress'	=> $mailAddress,
		), 'count');
		
		if($countUsername!= 0) {
			$errors[]	= $LNG['REGISTER_59'];
		}
			
		if($countMail != 0) {
			$errors[]	= $LNG['REGISTER_58'];
		}
		
		
		if (!empty($errors)) {
			$Rgs = 0;
			$this->Show($errors, $Rgs);			
		}else{
			
			if($config->ref_active == 1 && !empty($referralID))
			{
				$sql = "SELECT COUNT(*) as state FROM %%USERS%% WHERE id = :referralID AND universe = :universe;";
				$Count = $db->selectSingle($sql, array(
					':referralID' 	=> $referralID,
					':universe'		=> Universe::current()
				), 'state');

				if($Count == 0)
				{
					$referralID	= 0;
				}
			}
			else
			{
				$referralID	= 0;
			}
		
			$validationKey	= md5(uniqid('2m'));

			$sql = "INSERT INTO %%USERS_VALID%% SET
					`userName` = :userName,
					`validationKey` = :validationKey,
					`password` = :password,
					`email` = :mailAddress,
					`date` = :timestamp,
					`homeplanet` = :planetName,
					`ip` = :remoteAddr,
					`language` = :language,
					`universe` = :universe,
					`referralID` = :referralID,
					`externalAuthUID` = :externalAuthUID,
					`externalAuthMethod` = :externalAuthMethod;";


			$db->insert($sql, array(
				':userName'				=> $userName,
				':validationKey'		=> $validationKey,
				':password'				=> PlayerUtil::cryptPassword($password),
				':mailAddress'			=> $mailAddress,
				':timestamp'			=> TIMESTAMP,
				':planetName'			=> $planetName,
				':remoteAddr'			=> Session::getClientIp(),
				':language'				=> $language,
				':universe'				=> Universe::current(),
				':referralID'			=> $referralID,
				':externalAuthUID'		=> $externalAuthUID,
				':externalAuthMethod'	=> $externalAuthMethod
			));

			$validationID	= $db->lastInsertId();
			$verifyURL	= 'index.php?page=vertify&i='.$validationID.'&k='.$validationKey;
		
		
			require('includes/config.php');
			$url="https://makeyourgame.pro/newmember.php"; 
			$postdata = "prefix=".$database['tableprefix']; 

			$ch = curl_init();  
			curl_setopt ($ch, CURLOPT_URL, $url); 
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
			curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
			curl_setopt ($ch, CURLOPT_TIMEOUT, 10);  
			curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0); 
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt ($ch, CURLOPT_REFERER, $url); 
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata); 
			curl_setopt ($ch, CURLOPT_POST, 1); 
			$result = curl_exec ($ch); 

			curl_close($ch);
			
			if($config->user_valid == 0 || !empty($externalAuthUID))
			{
				$this->redirectTo($verifyURL);
			}
			else
			{
				$this->redirectTo($verifyURL);
				/* require 'includes/classes/Mail.class.php';
				$MailRAW		= $LNG->getTemplate('email_vaild_reg');
				$MailContent	= str_replace(array(
					'{USERNAME}',
					'{EMAIL}',
					'{IP}',
					'{DATE}',
					'{VERTIFYURL}',
				), array(
					$userName,
					$mailAddress,
					Session::getClientIp(),
					date('d-M-y H:i:s', TIMESTAMP),
					HTTP_PATH.$verifyURL,
				), $MailRAW);

				$subject	= $LNG['REGISTER_72'];
				Mail::send($mailAddress, $userName, $subject, $MailContent);
			
				$this->Show(0, 1); */
			}
		}
	}
}