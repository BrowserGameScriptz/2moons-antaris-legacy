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

class ShowIndexPage extends AbstractLoginPage
{
	function __construct() 
	{
		parent::__construct();
		$this->setWindow('light');
	}
	function checkProxy($ip){
		$contactEmail="support@antaris-univers.com"; //you must change this to your own email address
		$timeout=5; //by default, wait no longer than 5 secs for a response
		$banOnProability=0.99; //if getIPIntel returns a value higher than this, function returns true, set to 0.99 by default
		
		//init and set cURL options
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		//if you're using custom flags (like flags=m), change the URL below
		curl_setopt($ch, CURLOPT_URL, "http://check.getipintel.net/check.php?ip=".$ip."&contact=".$contactEmail);
		$response=curl_exec($ch);
		
		curl_close($ch);
		
		return $response;
	}

	function show() 
	{
		global $LNG;
		
		$referralID		= HTTP::_GP('ref', 0);
		$newpass		= HTTP::_GP('newpass', "", UTF8_SUPPORT);
		$ShowMessagePass = 0;
		$ShowMessageTxt = "";
		if(!empty($referralID))
		{
			$this->redirectTo('index.php?page=register&referralID='.$referralID);
		}
		
		if(!empty($newpass))
		{
			$db = Database::get();

			$sql = "SELECT * FROM %%LOSTPASSWORD%% WHERE `key` = :validationKey AND `hasChangedTime` > :time AND hasChanged = 1;";
			$isValid = $db->selectSingle($sql, array(
				':validationKey'	=> $newpass,
				':time'				=> TIMESTAMP
			));
			
			if(!empty($isValid))
			{
				$ShowMessagePass = 1;
				$userDataLost		   	= GetFromDatabase('USERS', 'id', $isValid['userID'], array('onlinetime', 'universe', 'username'));
				$ShowMessageTxt = sprintf($LNG['LOSTPWD_16'], $userDataLost['username']);
			}
		}
	
		$universeSelect	= array();
		
		foreach(Universe::availableUniverses() as $uniId)
		{
			$config = Config::get($uniId);
			$universeSelect[$uniId]	= $config->uni_name.($config->game_disable == 0 ? $LNG['uni_closed'] : '');
		}
		
		$Code	= HTTP::_GP('code', 0);
		$loginCode	= false;
		if(isset($LNG['login_error_'.$Code]))
		{
			$loginCode	= $LNG['login_error_'.$Code];
		}

		$config				= Config::get();
		
		$sql = "SELECT date, id, title, text, user FROM %%NEWS%% ORDER BY id DESC;";
		$newsResult = Database::get()->select($sql);

		$newsList	= array();
		
		foreach ($newsResult as $newsRow)
		{
			$newsList[]	= array(
				'title' => $newsRow['title'],
				'from' 	=> $newsRow['user'],
				'date' 	=> date('d-M-y H:i:s', $newsRow['date']),
				'id' 	=> $newsRow['id'],
				'text' 	=> makebr($newsRow['text']),
			);
		}
		
		$free = shell_exec('free');
		$free = (string)trim($free);
		$free_arr = explode("\n", $free);
		$mem = explode(" ", $free_arr[1]);
		$mem = array_filter($mem);
		$mem = array_merge($mem);
		
		$memory_usage = "<span class='color-green'>Ouvert &amp; fluide</span>";
		if($mem[1] != 0){
		$memory_usage = $mem[2]/$mem[1];
		
		if($memory_usage >= 0.9)
			$memory_usage = "<span class='color-green'>Ouvert &amp; fluide</span>";
		elseif($memory_usage >= 0.8)
			$memory_usage = "<span class='color-green'>Ouvert &amp; fluide</span>";
		else
			$memory_usage = "<span class='color-green'>Ouvert &amp; fluide</span>";
		}
		$this->assign(array(
			'myuserip'				=> Session::getClientIp(),
			//'checkProxy'			=> $this->checkProxy(Session::getClientIp()),
			'checkProxy'			=> 0,
			'memory_usage'			=> $memory_usage,
			'newsList'				=> $newsList,
			'ShowMessagePass'		=> $ShowMessagePass,
			'ShowMessageTxt'		=> $ShowMessageTxt,
			'universeSelect'		=> $universeSelect,
			'users_amount'			=> Config::get()->users_amount,
			'code'					=> $loginCode,
			'descHeader'			=> sprintf($LNG['loginWelcome'], $config->game_name),
			'descText'				=> sprintf($LNG['loginServerDesc'], $config->game_name),
			'loginInfo'				=> sprintf($LNG['loginInfo'], '<a href="index.php?page=rules">'.$LNG['menu_rules'].'</a>')
		));
		
		$this->display('page.index.default.tpl');
	}
}