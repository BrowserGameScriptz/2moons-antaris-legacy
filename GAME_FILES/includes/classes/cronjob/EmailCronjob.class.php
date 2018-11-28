<?php

class EmailCronjob
{
	function run()
	{
		global $LNG;
		$CONF	= Config::getAll(NULL, ROOT_UNI);
		$selectUsers = $GLOBALS['DATABASE']->query("SELECT email FROM `uni1_emails` WHERE isSend = 0 LIMIT 5;");
		
		foreach($selectUsers as $Users){
			$GLOBALS['DATABASE']->query("UPDATE `uni1_emails` SET isSend = 1, sendTime = ".TIMESTAMP." WHERE email = '".$Users['email']."';");
			$MailContent	= "<div style=\"text-align: center\"><br><i><span style=\"text-decoration: underline\"><a href=\"http://antaris-univers.com\"<img src=\"http://img15.hostingpics.net/pics/404168header1.png\" alt=\"http://antaris-univers.com\"></a></span></i><br>HTTP://ANTARIS-UNIVERS.COM<br></div><i>Join us now the best and most realisitc space ogame like server. <br> First univers where you can create and design your own ships !!</i>";

			$subject	= 'Antaris Legacy - Create your own ships';
			$admin = "support@antaris-univers.com";
			$to      = 'personne@example.com';
			$headers = 'From: support@antaris-univers.com' . "\r\n" .
			'Reply-To: support@antaris-univers.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			 mail($Users['email'], $subject, $MailContent, $headers);
		}
	}
}