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


class ShowDisclamerPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		$this->setWindow('light');
	}
	
	function show() 
	{
		global $LNG;
		
		$errorMsg = "";
		$errorNum  = -1;
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$nickname 		= HTTP::_GP('name', '', UTF8_SUPPORT);
			$email	 		= HTTP::_GP('email', '', UTF8_SUPPORT);
			$subject	 	= HTTP::_GP('subject', '', UTF8_SUPPORT);
			$captcha	 	= HTTP::_GP('captcha', '', UTF8_SUPPORT);
			$message	 	= HTTP::_GP('message', '', UTF8_SUPPORT);
			
			$subjectAllow = array(1,2,3,4,5,6);
			if(empty($nickname)){
				$errorMsg .= $LNG['CONTACT_37'];
				$errorNum  = 0;
			}
			if(empty($email)){
				$addition = !empty($errorMsg) ? "<br>" : "";
				$errorMsg .= $addition.$LNG['CONTACT_38'];
				$errorNum  = 0;
			}elseif(!PlayerUtil::isMailValid($email)){
				$addition = !empty($errorMsg) ? "<br>" : "";
				$errorMsg	 .= $addition.$LNG['CONTACT_39'];
				$errorNum  = 0;
			}
			if(empty($message)){
				$addition = !empty($errorMsg) ? "<br>" : "";
				$errorMsg .= $addition.$LNG['CONTACT_40'];
				$errorNum  = 0;
			}elseif(strlen($message) < 25){
				$addition = !empty($errorMsg) ? "<br>" : "";
				$errorMsg .= $addition.$LNG['CONTACT_41'];
				$errorNum  = 0;
			}
			if(!in_array($subject, $subjectAllow)){
				$addition = !empty($errorMsg) ? "<br>" : "";
				$errorMsg .= $addition.$LNG['CONTACT_42'];
				$errorNum  = 0;
			}
			
			session_start();
			if(empty($captcha)) {
				$addition = !empty($errorMsg) ? "<br>" : "";
				$errorMsg .= $addition.$LNG['CONTACT_44'];
				$errorNum  = 0;
			}elseif($captcha != $_SESSION["code"]) {
				$addition = !empty($errorMsg) ? "<br>" : "";
				$errorMsg .= $addition.$LNG['REGISTER_66'];
				$errorNum  = 0;
			}
		
			if(empty($errorMsg)){
				$errorMsg = $LNG['CONTACT_43'];
				$errorNum  = 1;
				
				$MailRAW		= $LNG->getTemplate('email_contact_us');
		
				$MailContent	= str_replace(array(
					'{SUBJECT}',
					'{DATE}',
					'{PSUEDO}',
					'{EMAIL}',
					'{USERIP}',
					'{MSG}',
				), array(
					$LNG['CONTACT_14'][$subject],
					date('d-M-y H:i:s', TIMESTAMP),
					$nickname,
					$email,
					Session::getClientIp(),
					$message,
				), $MailRAW);
		
				require 'includes/classes/Mail.class.php';

				$subject	= 'Antaris Legacy - '.$LNG['CONTACT_14'][$subject];
				$admin = "support@antaris-univers.com";
				Mail::send($email, $nickname, $subject, $MailContent);
				Mail::send($admin, $nickname, $subject, $MailContent);
			}
		}
		
		$this->assign(array(
			'errorMsg'	=> $errorMsg,
			'errorNum'	=> $errorNum,
			'nickname'	=> isset($nickname) && $errorNum == 0 ? $nickname : "",
			'email'		=> isset($email) && $errorNum == 0 ? $email : "",
			'message'	=> isset($message) && $errorNum == 0 ? $message : "",
			'subject'	=> isset($subject) && $errorNum == 0 ? $subject : "",
		));
		
		$this->display('page.disclamer.default.tpl');
	}
}

