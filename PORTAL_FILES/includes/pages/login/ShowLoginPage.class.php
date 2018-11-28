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


class ShowLoginPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show() 
	{
		if (empty($_POST)) {
			HTTP::redirectTo('index.php');	
		}

		$db = Database::get();

		$username = HTTP::_GP('pseudo', '', UTF8_SUPPORT);
		$password = HTTP::_GP('mdp', '', true);
		$univers 	= HTTP::_GP('univers', '', UTF8_SUPPORT);

		$sql = "SELECT id, password, username, universe, email, authlevel, encodage FROM %%USERS%% WHERE universe = :universe AND username = :username;";
		$loginData = $db->selectSingle($sql, array(
			':universe'	=> Universe::current(),
			':username'	=> $username
		));

		if (isset($loginData))
		{
			$hashedPassword = PlayerUtil::cryptPassword($password);
			if($loginData['password'] != $hashedPassword)
			{
				// Fallback pre 1.7
				if($loginData['password'] == md5($password)) {
					$sql = "UPDATE %%USERS%% SET password = :hashedPassword WHERE id = :loginID;";
					$db->update($sql, array(
						':hashedPassword'	=> $hashedPassword,
						':loginID'			=> $loginData['id']
					));
				} else {
					HTTP::redirectTo('index.php?code=1');	
				}
			}
			 
			$config = Config::get($loginData['universe']);
			if($config->game_disable == 0 && $loginData['authlevel'] == AUTH_USR) {
				HTTP::redirectTo('index.php?code=6');	
			}
			
			if(empty($loginData['encodage'])){
				$validationKey	= md5(uniqid('2m'));
				$sql = "UPDATE %%USERS%% SET encodage = :encodage WHERE id = :userid;";
				database::get()->update($sql, array(
					':encodage'	=> $validationKey,
					':userid'	=> (int) $loginData['id']
				));
			}

			if (isset($_COOKIE['Portal'])) 
				unset($_COOKIE['Portal']);
			$session	= Session::create();
			$session->userId		= (int) $loginData['id'];
			$session->adminAccess	= 0;
			$session->save();
			
			//HTTP::redirectTo('index.php?page=ingame&univers='.$univers);	
			HTTP::redirectTo('index.php#loginSuccessfull');	
		}
		else
		{
			HTTP::redirectTo('index.php?code=1');
		}
	}
}
