<?php
define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);
require 'includes/common.php';
require 'includes/libs/xsolla/xsolla-autoloader.php';

use Xsolla\SDK\Webhook\WebhookServer;
use Symfony\Component\HttpFoundation\Request;
use Xsolla\SDK\Webhook\Message\Message;
use Xsolla\SDK\Exception\Webhook\XsollaWebhookException;
use Xsolla\SDK\Exception\Webhook\InvalidUserException;

$request = Request::createFromGlobals();
$request->setTrustedProxies(array('103.21.244.0/22', '103.22.200.0/22', '103.31.4.0/22', '104.16.0.0/12', '108.162.192.0/18', '131.0.72.0/22', '141.101.64.0/18', '162.158.0.0/15', '172.64.0.0/13', '173.245.48.0/20', '188.114.96.0/20', '190.93.240.0/20', '197.234.240.0/22', '198.41.128.0/17', '199.27.128.0/21', '67.222.136.63', '67.222.136.64'));

$callback = function (Message $message) {
    switch ($message->getNotificationType()) {
        case Message::USER_VALIDATION:
            /** @var Xsolla\SDK\Webhook\Message\UserValidationMessage $message */
            // TODO if user not found, you should throw Xsolla\SDK\Exception\Webhook\InvalidUserException
			$userArray = $message->getUser();
			$userId = $message->getUserId();
			$messageArray = $message->toArray();
			
			$USER = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE `id` = '".$userId."';");
			
			if(empty($USER))
			{
				throw new InvalidUserException('USER NOT FOUND');
			}
            break;
        case Message::PAYMENT:
            /** @var Xsolla\SDK\Webhook\Message\PaymentMessage $message */
            // TODO if the payment delivery fails for some reason, you should throw Xsolla\SDK\Exception\Webhook\XsollaWebhookException
			$userArray = $message->getUser();
			$userId = $message->getUserId();
            $paymentDetailsArray = $message->getPurchase();
            $transaction = $message->getTransaction();
            $isDryRun = $message->isDryRun();
			$customParametersArray = $message->getCustomParameters();
            $messageArray = $message->toArray();
			//$validationID = $customParametersArray['key1'];
			$validationID = 'kdmzdmzdkkoZD';
			$shortKey = $paymentDetailsArray['items']['sku'];
			
			$userId = $GLOBALS['DATABASE']->sql_escape($userId);
			$shortKeyInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".XSOLLA." WHERE `xsollaKey` = '".$shortKey."';");
			$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET darkmatter = darkmatter + ".$shortKeyInfo['xsollaCredit']." WHERE id = ".$userId.";");
			$GLOBALS['DATABASE']->query("INSERT INTO uni1_paysafecard_log VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$userId."','".TIMESTAMP."','".$transaction['id']."', '".$shortKeyInfo['xsollaPrice']."', '".$shortKeyInfo['xsollaCredit']."', 'Xsolla', '1','".$validationID."');");
			
            break;
        case Message::USER_BALANCE:
            /** @var Xsolla\SDK\Webhook\Message\RefundMessage $message */
            // TODO if you cannot handle the refund, you should throw Xsolla\SDK\Exception\Webhook\XsollaWebhookException
            break;
        default:
            throw new XsollaWebhookException('Notification type not implemented');
    }
};

$webhookServer = WebhookServer::create($callback, 'w6EwaVQdzW26wDAi');
$webhookServer->start();