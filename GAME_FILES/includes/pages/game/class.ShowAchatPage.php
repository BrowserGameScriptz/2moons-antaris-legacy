<?php
require 'includes/libs/xsolla/xsolla-autoloader.php';

use Xsolla\SDK\API\XsollaClient;
use Xsolla\SDK\API\PaymentUI\TokenRequest;


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
 * @info $Id: class.ShowResourcesPage.php 2632 2013-03-18 19:05:14Z slaver7 $
 * @link http://2moons.cc/
 */

class ShowAchatPage extends AbstractPage
{
	public static $requireModule = MODULE_ACHAT;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show(){
		global $LNG, $CONF, $USER, $PLANET;
		$totalProduction = $GLOBALS['DATABASE']->query("SELECT SUM(metal_perhour) as metal_perhour, SUM(crystal_perhour) as crystal_perhour, SUM(deuterium_perhour) as deuterium_perhour, SUM(elyrium_perhour) as elyrium_perhour FROM ".PLANETS." WHERE id_owner = ".$USER['id']." AND destruyed = '0';");
		$totalProduction = $GLOBALS['DATABASE']->fetch_array($totalProduction);
		$targetUser   	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = '".$USER['id']."';");
		$Factor = 0;
		if($targetUser['total_rank'] < round($CONF['users_amount'] / 3)){
			$Factor = 1;	
		}elseif($targetUser['total_rank'] < round($CONF['users_amount'] / 2)){
			$Factor = 2;	
		}else{
			$Factor = 3;	
		}
		
		$Message = array();
		if($_SERVER['REQUEST_METHOD'] === 'POST'){	
			$metal			= abs(HTTP::_GP('metal', 0));	
			$oro			= abs(HTTP::_GP('oro', 0));	
			$cristal		= abs(HTTP::_GP('cristal', 0));	
			$elyrium		= abs(HTTP::_GP('elyrium', 0));	
			$mode_chaine	= abs(HTTP::_GP('mode_chaine', 0));	
			$mode_rapide	= abs(HTTP::_GP('mode_rapide', 0));	
			$total_credit 	= $metal + $oro + $cristal + $elyrium + $mode_chaine + $mode_rapide;
			
			if($total_credit < 1){
				$Message[]	=  "<span class='rouge'>".$LNG['NOUVEAUTE_234']."</span>";
			}elseif($USER['darkmatter'] < $total_credit){
				$Message[]	=  "<span class='rouge'>".$LNG['NOUVEAUTE_235']."</span>";
			}else{
				
				$USER['darkmatter'] -= $total_credit;
				$Message[] = "<span class='vert'><b>".$LNG['NOUVEAUTE_238']." :</b></span>";
				if($metal > 0){
					$PLANET['metal'] 		+= $totalProduction['metal_perhour']*$metal*$Factor;
					$Message[] = sprintf($LNG['NOUVEAUTE_239'], $metal, pretty_number($totalProduction['metal_perhour']*$Factor*$metal), $LNG['tech'][901]);
					$Messages  = sprintf($LNG['NOUVEAUTE_239'], $metal, pretty_number($totalProduction['metal_perhour']*$Factor*$metal), $LNG['tech'][901]);
					$GLOBALS['DATABASE']->query("INSERT INTO ".ACHATLOG." VALUES (null, '".TIMESTAMP."',  '".$USER['id']."', '".$GLOBALS['DATABASE']->sql_escape($Messages)."', '".$metal."', 'Conversion in iron');");
				}
				if($oro > 0){
					$PLANET['crystal'] 		+= $totalProduction['crystal_perhour']*$oro*$Factor;
					$Message[] = sprintf($LNG['NOUVEAUTE_239'], $oro, pretty_number($totalProduction['crystal_perhour']*$Factor*$oro), $LNG['tech'][902]);
					$Messages  = sprintf($LNG['NOUVEAUTE_239'], $oro, pretty_number($totalProduction['crystal_perhour']*$Factor*$oro), $LNG['tech'][902]);
					$GLOBALS['DATABASE']->query("INSERT INTO ".ACHATLOG." VALUES (null, '".TIMESTAMP."',  '".$USER['id']."', '".$GLOBALS['DATABASE']->sql_escape($Messages)."', '".$oro."', 'Conversion in gold');");
				}
				if($cristal > 0){
					$PLANET['deuterium']	+= $totalProduction['deuterium_perhour']*$cristal*$Factor;
					$Message[] = sprintf($LNG['NOUVEAUTE_239'], $cristal, pretty_number($totalProduction['deuterium_perhour']*$Factor*$cristal), $LNG['tech'][903]);
					$Messages  = sprintf($LNG['NOUVEAUTE_239'], $cristal, pretty_number($totalProduction['deuterium_perhour']*$Factor*$cristal), $LNG['tech'][903]);
					$GLOBALS['DATABASE']->query("INSERT INTO ".ACHATLOG." VALUES (null, '".TIMESTAMP."',  '".$USER['id']."', '".$GLOBALS['DATABASE']->sql_escape($Messages)."', '".$cristal."', 'Conversion in cristal');");
				}
				if($elyrium > 0){
					$PLANET['elyrium'] 		+= $totalProduction['elyrium_perhour']*$elyrium*$Factor;
					$Message[] = sprintf($LNG['NOUVEAUTE_239'], $elyrium, pretty_number($totalProduction['elyrium_perhour']*$Factor*$elyrium), $LNG['tech'][904]);
					$Messages  = sprintf($LNG['NOUVEAUTE_239'], $elyrium, pretty_number($totalProduction['elyrium_perhour']*$Factor*$elyrium), $LNG['tech'][904]);
					$GLOBALS['DATABASE']->query("INSERT INTO ".ACHATLOG." VALUES (null, '".TIMESTAMP."',  '".$USER['id']."', '".$GLOBALS['DATABASE']->sql_escape($Messages)."', '".$elyrium."', 'Conversion in elyrium');");
				}
				if($mode_chaine > 0){
					if($USER['mode_chaine'] < TIMESTAMP){
					$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET mode_chaine = ".(TIMESTAMP +(15*$mode_chaine*24*60*60))." WHERE id = ".$USER['id'].";");
					}else{
						$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET mode_chaine = mode_chaine + ".(15*$mode_chaine*24*60*60)." WHERE id = ".$USER['id'].";");
					}
					$Message[] = sprintf($LNG['NOUVEAUTE_240'], $mode_chaine, pretty_number(15*$mode_chaine));
					$Messages  = sprintf($LNG['NOUVEAUTE_240'], $mode_chaine, pretty_number(15*$mode_chaine));
					$GLOBALS['DATABASE']->query("INSERT INTO ".ACHATLOG." VALUES (null, '".TIMESTAMP."',  '".$USER['id']."', '".$GLOBALS['DATABASE']->sql_escape($Messages)."', '".$mode_chaine."', 'Conversion in chain modus');");
				}
				if($mode_rapide > 0){
					if($USER['mode_rapide'] < TIMESTAMP){
					$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET mode_rapide = ".(TIMESTAMP +(15*$mode_rapide*24*60*60))." WHERE id = ".$USER['id'].";");
					}else{
						$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET mode_rapide = mode_rapide + ".(15*$mode_rapide*24*60*60)." WHERE id = ".$USER['id'].";");
					}
					$Message[] = sprintf($LNG['NOUVEAUTE_241'], $mode_rapide, pretty_number(15*$mode_rapide));
					$Messages  = sprintf($LNG['NOUVEAUTE_241'], $mode_rapide, pretty_number(15*$mode_rapide));
					$GLOBALS['DATABASE']->query("INSERT INTO ".ACHATLOG." VALUES (null, '".TIMESTAMP."',  '".$USER['id']."', '".$GLOBALS['DATABASE']->sql_escape($Messages)."', '".$mode_rapide."', 'Conversion in fast modus');");
				}
				
				$Messages = implode("<br>\r\n", $Message);
			}
		}
		$chain_active = 0;
		$fast_active = 0;
		if($USER['mode_chaine'] > TIMESTAMP){
			$chain_active = 1;
		}
		if($USER['mode_rapide'] > TIMESTAMP){
			$fast_active = 1;
		}
		
		$targetUser   	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE id_owner = '".$USER['id']."';");
		$Factor = 0;
		if($targetUser['total_rank'] < round($CONF['users_amount'] / 3)){
			$Factor = 1;	
		}elseif($targetUser['total_rank'] < round($CONF['users_amount'] / 2)){
			$Factor = 2;	
		}else{
			$Factor = 3;	
		}
		$this->tplObj->loadscript("donation.js");
		$this->tplObj->assign_vars(array(
			'Message'		=> implode("<br>\r\n", $Message),
			'chain_active'	=> $chain_active,
			'fast_active'	=> $fast_active,
			'metal'	=> $totalProduction['metal_perhour']*$Factor,
			'crystal'	=> $totalProduction['crystal_perhour']*$Factor,
			'deuterium'	=> $totalProduction['deuterium_perhour']*$Factor,
			'elyrium'	=> $totalProduction['elyrium_perhour']*$Factor,
			'prmetal'	=> pretty_number($totalProduction['metal_perhour']*$Factor),
			'prcrystal'	=> pretty_number($totalProduction['crystal_perhour']*$Factor),
			'prdeuterium'	=> pretty_number($totalProduction['deuterium_perhour']*$Factor),
			'prelyrium'	=> pretty_number($totalProduction['elyrium_perhour']*$Factor),	
			'mode_chaine'	=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $USER['mode_chaine']), $USER['timezone']),	
			'mode_rapide'	=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $USER['mode_rapide']), $USER['timezone']),	
		));
		$this->display('page.achat.default.tpl');
	}
	
	function historique(){
		global $LNG, $USER;
		$messageList = '';
		$messageRaw	= $GLOBALS['DATABASE']->query("SELECT * FROM ".PAYLOG." WHERE userID = ".$USER['id']." ORDER BY time DESC;");
		while($messageRow = $GLOBALS['DATABASE']->fetch_array($messageRaw))
		{
			$messageRaws	= $GLOBALS['DATABASE']->query("SELECT SUM(pinCredits) as sum_pinCredits, SUM(pinPrice) as sum_pinPrice FROM ".PAYLOG." WHERE userID = ".$USER['id']." AND  pinAprouved  = '1';");
			$messageRaws = $GLOBALS['DATABASE']->fetch_array($messageRaws);
				$messageList[$messageRow['payID']]	= array(
					'date'		=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $messageRow['time']), $USER['timezone']),
					'pinCode'		=> $messageRow['pinCode'],
					'pinType'		=> $messageRow['pinType'],
					'pinCredits'		=> $messageRow['pinCredits'],
					'pinPrice'		=> $messageRow['pinPrice'],
					'pinAprouved'		=> $messageRow['pinAprouved'],
					'sum_pinPrice' => (($messageRaws['sum_pinPrice'] > 0) ? $messageRaws['sum_pinPrice'] : 0),	
					'sum_pinCredits'		=> (($messageRaws['sum_pinCredits'] > 0) ? $messageRaws['sum_pinCredits'] : 0),
			);
		}
		$this->tplObj->assign_vars(array(	
			'messageList' => $messageList,		
		));	
		$this->display('page.achat.historique.tpl');
	}
	
	function paysafe(){
		global $LNG, $USER;
		$Message = "";
		if($_SERVER['REQUEST_METHOD'] === 'POST'){	
			$code0		= HTTP::_GP('code0', '');	
			$code1		= HTTP::_GP('code1', '');	
			$code2		= HTTP::_GP('code2', '');	
			$code3		= HTTP::_GP('code3', '');	
			$code4		= HTTP::_GP('code4', '');	
			$validationKey	= md5(uniqid('2m')); 
			$finalCode = "".$code0."-".$code1."-".$code2."-".$code3."";
			
			if(empty($code4)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_222']."</span>";
			}elseif(!is_numeric($code4) || $code4 < 0){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_220']."</span>";
			}elseif(strlen($code0) + strlen($code1) + strlen($code2) + strlen($code3) < 16 || strlen($code0) + strlen($code1) + strlen($code2) + strlen($code3) > 16){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_219']."</span>";
			}elseif(!is_numeric($code0) || !is_numeric($code1) || !is_numeric($code2) || !is_numeric($code3)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_220']."</span>";
			}else{
				$GLOBALS['DATABASE']->query("INSERT INTO uni1_paysafecard_log VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."','".TIMESTAMP."','".$GLOBALS['DATABASE']->sql_escape($finalCode)."', '".$GLOBALS['DATABASE']->sql_escape($code4)."', '0', 'PaysafeCard', '0','".$validationKey."');");
				
				//send mail here
				require('includes/classes/Mail.class.php');
				$MailSubject 	= "Paysafecard paiement from #".$USER['username']."";
				$MailContent	= "Dear Team,<br> You are required to process the following paiement<br><br>Game : http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."<br>User : #".$USER['id']."_".$USER['username']."<br>Amount : ".$GLOBALS['DATABASE']->sql_escape($code4)."<br>Code : ".$GLOBALS['DATABASE']->sql_escape($finalCode)."<br><br>Regards";
				
				Mail::send('billing@makeyourgame.pro', 'Billing Team', $MailSubject, $MailContent);
				
				$Message = "<span class='vert'>".$LNG['NOUVEAUTE_221']."</span>";
			}
		}
		$this->tplObj->loadscript("donation.js");
		$this->tplObj->assign_vars(array(
			'payusername' => $USER['username'],
			'payid' 	  => $USER['id'],
			'Message' 	  => $Message,
		));
		$this->display('page.achat.paysafe.tpl');
	}
	
	function paypal(){
		global $LNG, $USER;
		$commandctr = 0;
		$Message = "";
		$paidInfo		= HTTP::_GP('i', '');	
		if($_SERVER['REQUEST_METHOD'] === 'POST' && empty($paidInfo)){	
			require_once(ROOT_PATH . 'includes/classes/class.paypal.php');
			$MAIL        = 'billing@makeyourgame.pro';
			$pattern        = array(
                1        => '1.60',
                5        => '7.75',
                10       => '15.00',
                20       => '29.00',
                40       => '56.00',
                80       => '108.00',
			);
			
			$amount              = abs(HTTP::_GP('amount',0));
			$amount				 = $GLOBALS['DATABASE']->sql_escape($amount);
			$cost                = HTTP::_GP('cost',0);
			if(!array_key_exists($amount, $pattern)) {
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_22']."</span>";
			}else{
				$cost        = $pattern[$amount];
				$validationKey	= md5(uniqid('2m'));
				$GLOBALS['DATABASE']->query("INSERT INTO `uni1_paypal` (`id`, `player`, `amount`, `timestamp`, `price`) VALUES (NULL, '".$USER['id']."', '".$amount."', '".TIMESTAMP."', '".$cost."');");
				$this_p = new paypal_class;
				$ID        = $GLOBALS['DATABASE']->uniquequery("SELECT `id` FROM `uni1_paypal` WHERE `player` = '".$USER['id']."' AND `amount` = '".$amount."' AND `timestamp` = '".TIMESTAMP."'");
				$this_p->add_field('business', $MAIL);
				$this_p->add_field('return', 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/game.php?page=Achat&mode=paypal&i='.$validationKey.'');
				$this_p->add_field('cancel_return', 'https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/paypal.php');	 
				$this_p->add_field('notify_url', 'https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/paypal.php');	 
					
				$this_p->add_field('item_name', $amount.' Credit-User('.$USER['username'].').');
				$this_p->add_field('item_number', $amount.'_credits');
				$this_p->add_field('amount', $cost);
				$this_p->add_field('currency_code', 'EUR');
				$this_p->add_field('custom', $USER['id'].','.$validationKey);
				$this_p->add_field('rm', '2');
				foreach ($this_p->fields as $name => $value) {
					$field[] = array('text'=>'<input type="hidden" name="'.$name.'" value="'.$value.'">');
				}
				$this->tplObj->assign_vars(array(
					'fields' => $field,
				));
				$this->display('paypal_class.tpl');
			}
		}elseif(!empty($paidInfo)){
			$key		= $_GET['i'];	
			$Details = $GLOBALS['DATABASE']->query("SELECT * FROM ".PAYLOG." WHERE `key` = '".$GLOBALS['DATABASE']->sql_escape($key)."' and pinType = 'Paypal' and `userID` = '".$USER['id']."';");
			$Details = $GLOBALS['DATABASE']->fetch_array($Details);
			$commandctr = 1;
			$this->tplObj->assign_vars(array(	
				'pinCode' => $Details['pinCode'],
				'pinPrice' => $Details['pinPrice'],
				'pinCredits' => $Details['pinCredits'],
			));
		}
		
		$this->tplObj->assign_vars(array(	
			'commandctr' => $commandctr,
			'Message' 	 => $Message,
		));
		$this->display('page.achat.paypal.tpl');
	}
	
	function allopass(){
		global $LNG, $USER;	
		$commandctr = 0;
		if(!empty($_GET['i'])){
			$key		= $_GET['i'];	
			$Details = $GLOBALS['DATABASE']->query("SELECT * FROM ".PAYLOG." WHERE `userID` = '".$USER['id']."' ORDER BY time DESC LIMIT 1;");
			$Details = $GLOBALS['DATABASE']->fetch_array($Details);
			$commandctr = 1;
			$this->tplObj->assign_vars(array(	
				'pinCode' => $Details['pinCode'],
				'pinPrice' => $Details['pinPrice'],
				'pinCredits' => $Details['pinCredits'],
			));
		}
		$validationKey	= md5(uniqid('2m'));
		$tokenRequest = new TokenRequest(18507, $USER['id']);
		$tokenRequest->setUserEmail($USER['email'])
				->setSandboxMode(false)
				->setUserName($USER['username'])
				->setDesignMethod('dark')
				->setReturnUrl('https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/game.php?page=Achat&mode=allopass&i='.$validationKey)
				//->setPaiementUrl('https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/xsolla.php')
				->setCustomParameters(array('key1' => $validationKey));

		$xsollaClient = XsollaClient::factory(array(
				'merchant_id' => '27660',
				'api_key' => 'SEPvBkLhjz1lX9y1'
		));
		$token = $xsollaClient->createPaymentUITokenFromRequest($tokenRequest);
		$getLink = 'https://secure.xsolla.com/paystation2/?access_token='.$token;
		
		
		$this->tplObj->assign_vars(array(	
		'user_id' => $USER['id'],	
		'commandctr' => $commandctr,
		'getLink' => $getLink,
		));	
		$this->display('page.achat.allopass.tpl');
	}

	function probleme(){
		global $LNG;
		$this->display('page.achat.probleme.tpl');
	}
	
	function problemea(){
		global $LNG, $USER;
		$Message = "";
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$code_allopass			= HTTP::_GP('code_allopass', '', true);
			if(empty($code_allopass)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_244']."</span>";
			}elseif(strlen($code_allopass) != 9){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_245']."</span>";
			}else{
				//send mail here
				require('includes/classes/Mail.class.php');
				$MailSubject 	= "Xsolla error from #".$USER['username']."";
				$MailContent	= "Dear Team,<br> You are required to process the following error<br><br>Game : https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."<br>User : #".$USER['id']."_".$USER['username']."<br>Code : ".$code_allopass."<br><br>Regards";
				Mail::send('billing@makeyourgame.pro', 'Billing Team', $MailSubject, $MailContent);
				
				$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_246'], $code_allopass, str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], (TIMESTAMP + 24*3600)), $USER['timezone']))."</span>";
			}
		}
		$this->tplObj->assign_vars(array(	
			'pusername' => $USER['username'],
			'paid' => $USER['id'],
			'Message' => $Message,
		));
		$this->display('page.achat.problemea.tpl');
	}
	
	function problemep(){
		global $LNG, $USER;	
		$Message 		= array();
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$nom			= HTTP::_GP('nom', '', UTF8_SUPPORT);
			$prenom			= HTTP::_GP('prenom', '', UTF8_SUPPORT);
			$montant		= HTTP::_GP('montant', 0);
			$id_transaction	= HTTP::_GP('id_transaction', '');
			if(empty($nom)){
				$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_247']."</span>";
			}
			if(empty($prenom)){
				$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_248']."</span>";
			}
			if(empty($montant)){
				$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_249']."</span>";
			}
			if(empty($id_transaction)){
				$Message[] = "<span class='rouge'>".$LNG['NOUVEAUTE_250']."</span>";
			}
			if (empty($Message)) {
				$Message[] = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_246'], $id_transaction, str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], (TIMESTAMP + 24*3600)), $USER['timezone']))."</span>";
				//send mail here
				require('includes/classes/Mail.class.php');
				$MailSubject 	= "Paypal error from #".$USER['username']."";
				$MailContent	= "Dear Team,<br> You are required to process the following error<br><br>Game : https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."<br>User : #".$USER['id']."_".$USER['username']."<br>Name : ".$nom."<br>Firstname : ".$prenom."<br>Amount : ".$montant."<br>Transaction : ".$id_transaction."<br><br>Regards";
				Mail::send('billing@makeyourgame.pro', 'Billing Team', $MailSubject, $MailContent);
			}
		}	
		$this->tplObj->assign_vars(array(	
			'Message' => implode("<br>\r\n", $Message),
			'pusername' => $USER['username'],
			'paid' => $USER['id'],	
		));
		$this->display('page.achat.problemep.tpl');
	}
	
	
	function problemepp(){
		global $LNG, $USER;
		$Message = "";
		if (!empty($_POST)){
			$code0			= HTTP::_GP('code0', '');
			$code1			= HTTP::_GP('code1', '');
			$code2			= HTTP::_GP('code2', '');
			$code3			= HTTP::_GP('code3', '');
			$finalCode = "".$code0."-".$code1."-".$code2."-".$code3."";
			if(strlen($code0) + strlen($code1) + strlen($code2) + strlen($code3) < 16 || strlen($code0) + strlen($code1) + strlen($code2) + strlen($code3) > 16){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_219']."</span>";
			}elseif(!is_numeric($code0) || !is_numeric($code1) || !is_numeric($code2) || !is_numeric($code3)){
				$Message = "<span class='rouge'>".$LNG['NOUVEAUTE_220']."</span>";
			}else{
				$Message = "<span class='vert'>".sprintf($LNG['NOUVEAUTE_251'], $finalCode, str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], (TIMESTAMP + 24*3600)), $USER['timezone']))."</span>";
				
				//send mail here
				require('includes/classes/Mail.class.php');
				$MailSubject 	= "Paysafe error from #".$USER['username']."";
				$MailContent	= "Dear Team,<br> You are required to process the following error<br><br>Game : https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."<br>User : #".$USER['id']."_".$USER['username']."<br>Code : ".$finalCode."<br><br>Regards";
				Mail::send('billing@makeyourgame.pro', 'Billing Team', $MailSubject, $MailContent);
			}
		}		
		$this->tplObj->assign_vars(array(	
			'pusername' => $USER['username'],
			'paid' => $USER['id'],		
			'Message' => $Message,		
		));
		$this->display('page.achat.problemepp.tpl');
	}
}
