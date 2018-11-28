<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

function  _rewardPurchase($userId, $currency, $mc_gross, $txn_id, $validation, $quantity, $mc_fee) {
	// Make userid safe to use in query
	$userId = $GLOBALS['DATABASE']->sql_escape($userId);
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET darkmatter = darkmatter + ".$quantity." WHERE id = ".$userId.";");
	$GLOBALS['DATABASE']->query("INSERT INTO ".PAYLOG." VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$userId."','".TIMESTAMP."','".$txn_id."', '".$mc_gross."', '".$quantity."', 'Paypal', '1','".$validation."');");

	$userInfo = $GLOBALS['DATABASE']->uniquequery("SELECT * FROM ".USERS." WHERE id = ".$userId.";");
	
	require('includes/config.php');
	$url="https://makeyourgame.pro/curl_paiement.php"; 
	$postdata = "userId=".$userId."&gameId=".$database['tableprefix']."&txn_id=".$txn_id."&mc_gross=".$mc_gross."&quantity=".$quantity."&pinAprouved=1&paystatus=Completed&pinType=paypal&username=".$userInfo['username']."&mc_fee=".$mc_fee."&invoice=".$validation;  

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
	//echo $result;
}

//-------------------------- Don't change anything below this! ----------------------------- //
define("DEBUG", 1);
// Set to 0 once you're ready to go live
define("USE_SANDBOX", 0);
define("LOG_FILE", "ipn.log");
// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
$keyval = explode ('=', $keyval);
if (count($keyval) == 2) 
$myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
$value = urlencode(stripslashes($value));
} else {
$value = urlencode($value);
}
$req .= "&$key=$value";
}
// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data
if(USE_SANDBOX == true) {
$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
$ch = curl_init($paypal_url);
if ($ch == FALSE) {
return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
if(DEBUG == true) {
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}
// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.
//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);
$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
{
if(DEBUG == true) {	
error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
}
curl_close($ch);
exit;
} else {
// Log the entire HTTP response if debug is switched on.
if(DEBUG == true) {
error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
// Split response headers and payload
list($headers, $res) = explode("\r\n\r\n", $res, 2);
}
curl_close($ch);
}
$result = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$CustomVar 	= explode(",", $_POST['custom']);
$userId 	= isset($CustomVar[0]) ? $CustomVar[0] : null;
$validation = isset($CustomVar[1]) ? $CustomVar[1] : null;
$currency = isset($_POST['item_number']) ? $_POST['item_number'] : null;
$mc_gross = isset($_POST['mc_gross']) ? $_POST['mc_gross'] : null;
$payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : null;
$txn_id        = isset($_POST['txn_id']) ? $_POST['txn_id'] : null;
$quantity        = isset($_POST['quantity']) ? $_POST['quantity'] : null;
$mc_fee        = isset($_POST['mc_fee']) ? $_POST['mc_fee'] : null;


$result = false;
if ($payment_status == 'Completed' && !empty($userId) && !empty($validation) && !empty($currency) && !empty($mc_gross) && !empty($txn_id) && !empty($quantity)) {
	$result = true;
	_rewardPurchase($userId, $currency, $mc_gross, $txn_id, $validation, $quantity, $mc_fee);    
}
}else{
	echo 'Banned !';
}
if ($result) {
    echo 'OK';
}

?>