<?php

define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$langCho = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'en';
if(!isset($_COOKIE['lang'])) $langCho = 'en';
$LNG = new Language($langCho);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME', 'PUBLIC'));


$nickname 		= HTTP::_GP('nickname', '', UTF8_SUPPORT);
$password 		= HTTP::_GP('password', '');
$confirmation 	= HTTP::_GP('confirmation', '');
$email		 	= HTTP::_GP('email', '', UTF8_SUPPORT);
$namePlanet	 	= HTTP::_GP('namePlanet', '', UTF8_SUPPORT);
$captcha	 	= HTTP::_GP('captcha', '', UTF8_SUPPORT);
$sendEcho		= array();


if(!empty($captcha)){
	session_start();
	if($captcha != $_SESSION["code"]) {
		$codeColor = "red";
		$codeMsg	 = $LNG['REGISTER_67'];
	}elseif($captcha == $_SESSION["code"]){
		$codeColor = "green";
		$codeMsg	 = $LNG['REGISTER_69'];
	}	
}
else{
		$codeColor = "grey";
		$codeMsg	 = $LNG['REGISTER_68'];
}

if(!empty($password)){
	if(strlen($password) < 6 || strlen($password) > 32){
		$passColor = "red";
		$passMsg	 = $LNG['REGISTER_30'];
	}elseif(!empty($password)){
		$passColor = "green";
		$passMsg	 = $LNG['REGISTER_31'];
	}
}
else{
		$passColor = "grey";
		$passMsg	 = $LNG['REGISTER_32'];
}

if(!empty($confirmation)){
	if(strlen($confirmation) < 6 || strlen($confirmation) > 32){
		$confColor = "red";
		$confMsg	 = $LNG['REGISTER_33'];
	}elseif($confirmation != $password){
		$confColor = "red";
		$confMsg	 = $LNG['REGISTER_34'];
	}elseif($confirmation == $password){
		$confColor = "green";
		$confMsg	 = $LNG['REGISTER_35'];
	}
}else{
		$confColor = "grey";
		$confMsg	 = $LNG['REGISTER_36'];
}

if(!empty($nickname)){
	$sql	= 'SELECT * FROM %%USERS%% WHERE username = :username AND universe = :universe;';
	$checkUser = Database::get()->select($sql, array(
		':username'	=> $nickname,
		':universe'	=> 1
	));	
	$sql	= 'SELECT * FROM %%USERS_VALID%% WHERE username = :username AND universe = :universe;';
	$cherckUser1 = Database::get()->select($sql, array(
		':username'	=> $nickname,
		':universe'	=> 1
	));
	
	if(!PlayerUtil::isNameValid($nickname)) {
		$userColor = "red";
		$userMsg   = $LNG['REGISTER_56'];
	}elseif(count($checkUser) !=0 || count($cherckUser1) != 0){
		$userColor = "red";
		$userMsg   = $LNG['REGISTER_37'];
	}elseif(strlen($nickname) < 3 || strlen($nickname) > 16){
		$userColor = "red";
		$userMsg	 = $LNG['REGISTER_38'];
	}elseif(!empty($nickname)){
		$userColor = "green";
		$userMsg	 = $LNG['REGISTER_39'];
	}
}else{
		$userColor = "grey";
		$userMsg	 = $LNG['REGISTER_40'];
}

if(!empty($email)){
	$sql	= 'SELECT * FROM %%USERS%% WHERE email = :email AND universe = :universe;';
	$checkEmail = Database::get()->select($sql, array(
		':email'	=> $email,
		':universe'	=> 1
	));	
	$sql	= 'SELECT * FROM %%USERS_VALID%% WHERE email = :email AND universe = :universe;';
	$checkEmail1 = Database::get()->select($sql, array(
		':email'	=> $email,
		':universe'	=> 1
	));		
	
	if(count($checkEmail) !=0 || count($checkEmail1) != 0){
		$mailColor = "red";
		$mailMsg   = $LNG['REGISTER_41'];
	}elseif(!PlayerUtil::isMailValid($email)){
		$mailColor = "red";
		$mailMsg	 = $LNG['REGISTER_42'];
	}elseif(PlayerUtil::isMailValid($email)){
		$mailColor = "green";
		$mailMsg	 = $LNG['REGISTER_43'];
	}
}else{
		$mailColor = "grey";
		$mailMsg	 = $LNG['REGISTER_44'];
}

if(!empty($namePlanet)){
	if(strlen($namePlanet) < 5 || strlen($namePlanet) > 18){
		$planetColor = "red";
		$planetMsg	 = $LNG['REGISTER_45'];
	}elseif(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $namePlanet)){
		$planetColor = "red";
		$planetMsg	 = $LNG['REGISTER_46'];
	}elseif(!empty($namePlanet)){
		$planetColor = "green";
		$planetMsg	 = $LNG['REGISTER_47'];
	}
}else{
		$planetColor = "grey";
		$planetMsg	 = $LNG['REGISTER_48'];
}	

$sendEcho = array("nickname"=>array("color"=>"".$userColor."","message"=>"".$userMsg.""),"email"=>array("color"=>"".$mailColor."","message"=>"".$mailMsg.""),"password"=>array("color"=>"".$passColor."","message"=>"".$passMsg.""),"confirmation"=>array("color"=>"".$confColor."","message"=>"".$confMsg.""),"namePlanet"=>array("color"=>"".$planetColor."","message"=>"".$planetMsg.""),"captcha"=>array("color"=>"".$codeColor."","message"=>"".$codeMsg.""));

echo json_encode($sendEcho);

?>


