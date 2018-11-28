<?php
define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

if ($_POST["key"] == "5xoRdPx57"){ 
	$already_voted = $_POST["already_voted"];
	$ip = $_POST["ip"];
	$custom = $_POST["custom"];
	if($already_voted == 0 && $custom != ""){
		$validationKey	= md5(uniqid('2m'));
		$txn = "VOTE_".$validationKey;
		$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET vote_count = vote_count + 1, darkmatter = darkmatter + 0.15, v1 = ".(TIMESTAMP + 12*3600)." WHERE id = ".$custom.";");
		$GLOBALS['DATABASE']->query("INSERT INTO uni1_paysafecard_log VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$custom."','".TIMESTAMP."','".$txn."', '0', '0.15', 'Don', '1','".$validationKey."');");
		
	}
}
?> 