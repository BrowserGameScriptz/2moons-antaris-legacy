<?php
define('MODE', 'LOGIN');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

function GetOS(){
  $tab = array('Windows', 'Macintosh', 'Linux', 'FreeBSD', 'SunOS', 'IRIX', 'BeOS', 'OS/2', 'AIX');
  foreach($tab as $os){
    if(stripos($_SERVER['HTTP_USER_AGENT'], $os))
      return $os;
  }
  return 'Autre';
}

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
	$ub = "Unknown";
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'ie';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
						if(!isset($matches['version'][1]))
							$version="?";
					  else
              $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

function getClientIp()
{
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        }
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif(!empty($_SERVER['HTTP_X_FORWARDED']))
        {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        }
        elseif(!empty($_SERVER['HTTP_FORWARDED_FOR']))
        {
			$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        elseif(!empty($_SERVER['HTTP_FORWARDED']))
        {
			$ipAddress = $_SERVER['HTTP_FORWARDED'];
        }
        elseif(!empty($_SERVER['REMOTE_ADDR']))
        {
			$ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        else
        {
			$ipAddress = 'UNKNOWN';
        }
        return $ipAddress;
}

		$userId 			= HTTP::_GP('userId', '');
		$userName 			= HTTP::_GP('username', '', UTF8_SUPPORT);
		$password 			= HTTP::_GP('password', 'notneeded', true);
		$mailAddress 		= HTTP::_GP('email', '');
		$homeplanet 		= HTTP::_GP('homeplanet', '', UTF8_SUPPORT);
		$language 			= HTTP::_GP('lang', '');
		$referralID 		= HTTP::_GP('referralID', 0); 
		$encodage 			= HTTP::_GP('encodingplayer', '');
		$externalAuthUID	= 0;
		$externalAuthMethod	= '';

		if(empty($encodage)){
			HTTP::redirectTo('index.php?code=6');	
		}
		
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache"); // HTTP/1.0
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		$loginData = $GLOBALS['DATABASE']->getFirstRow("SELECT id, password, username, bana, banaday, universe, email, authlevel, encodage, intro FROM ".USERS." WHERE universe = 1 AND id = '".$userId."';");
		$loginData2 = $GLOBALS['DATABASE']->getFirstRow("SELECT id, password, username, bana, banaday, universe, email, authlevel, encodage, intro FROM ".USERS." WHERE id = '".$userId."';");
		$loginData3 = $GLOBALS['DATABASE']->getFirstRow("SELECT id, password, username, bana, banaday, universe, email, authlevel, encodage, intro FROM ".USERS." WHERE encodage = '".$encodage."';");

		if (!empty($loginData))
		{
			
			$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET password = '".$password."' WHERE id = ".$loginData['id'].";");
			
			if($loginData['encodage'] != $encodage) {
			HTTP::redirectTo('index.php?code=6');	
			}
			setcookie("nom_authentification",$loginData['username'].'.'.$loginData['id']);
			if (isset($_COOKIE['Horizon'])) 
				unset($_COOKIE['Horizon']);
			Session::create($loginData['id']);
			
			$ua= getBrowser();
			$os = GetOS();
			
			$GLOBALS['DATABASE']->query("INSERT INTO ".IPLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".TIMESTAMP."','".getClientIp()."','".$ua['name']."', '".$os."', ".$loginData['id'].",'".$ua['version']."');");
			
			if($loginData['intro'] == 0){
				HTTP::redirectTo('game.php?page=intro');
				return false;
			}else{
				HTTP::redirectTo('game.php');
				return false;
			}
		}elseif (!empty($loginData2))
		{
			
			$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET password = '".$password."' WHERE id = ".$loginData['id'].";");
			
			if($loginData['encodage'] != $encodage) {
			HTTP::redirectTo('index.php?code=6');	
			}
			setcookie("nom_authentification",$loginData['username'].'.'.$loginData['id']);
			if (isset($_COOKIE['Horizon'])) 
				unset($_COOKIE['Horizon']);
			Session::create($loginData['id']);
			
			$ua= getBrowser();
			$os = GetOS();
			
			$GLOBALS['DATABASE']->query("INSERT INTO ".IPLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".TIMESTAMP."','".getClientIp()."','".$ua['name']."', '".$os."', ".$loginData['id'].",'".$ua['version']."');");
			
			if($loginData['intro'] == 0){
				HTTP::redirectTo('game.php?page=intro');
				return false;
			}else{
				HTTP::redirectTo('game.php');
				return false;
			}
		}elseif (!empty($loginData3))
		{
			
			$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET password = '".$password."' WHERE id = ".$loginData['id'].";");
			
			if($loginData['encodage'] != $encodage) {
			HTTP::redirectTo('index.php?code=6');	
			}
			setcookie("nom_authentification",$loginData['username'].'.'.$loginData['id']);
			if (isset($_COOKIE['Horizon'])) 
				unset($_COOKIE['Horizon']);
			Session::create($loginData['id']);
			
			$ua= getBrowser();
			$os = GetOS();
			
			$GLOBALS['DATABASE']->query("INSERT INTO ".IPLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".TIMESTAMP."','".getClientIp()."','".$ua['name']."', '".$os."', ".$loginData['id'].",'".$ua['version']."');");
			
			if($loginData['intro'] == 0){
				HTTP::redirectTo('game.php?page=intro');
				return false;
			}else{
				HTTP::redirectTo('game.php');
				return false;
			}
		}else{
			$validationKey	= md5(uniqid('2m'));
			$validationID	= $userId;
			
			$SQL = "INSERT INTO ".USERS_VALID." SET
				`validationID`= '".$GLOBALS['DATABASE']->escape($validationID)."',
				`planetName`= '".$GLOBALS['DATABASE']->escape($homeplanet)."',
				`encodage`= '".$GLOBALS['DATABASE']->escape($encodage)."',
				`userName` = '".$GLOBALS['DATABASE']->escape($userName)."',
				`validationKey` = '".$validationKey."',
				`password` = '".$password."',
				`email` = '".$GLOBALS['DATABASE']->escape($mailAddress)."',
				`date` = '".TIMESTAMP."',
				`ip` = '".getClientIp()."',
				`language` = '".$GLOBALS['DATABASE']->escape($language)."',
				`universe` = 1,
				`referralID` = ".$referralID.",
				`externalAuthUID` = '".$GLOBALS['DATABASE']->escape($externalAuthUID)."',
				`externalAuthMethod` = '".$externalAuthMethod."';";
				
			$GLOBALS['DATABASE']->query($SQL);
			setcookie("nom_authentification",$userName.'.'.$validationID);
			$verifyURL	= 'index.php?page=vertify&i='.$validationID.'&k='.$validationKey;
			HTTP::redirectTo($verifyURL);
			return false;
		}


