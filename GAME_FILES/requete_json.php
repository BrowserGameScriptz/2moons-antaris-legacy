<?php

define('MODE', 'INGAME');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

function getUsername($ID) {
$username = '';
$stats_sql	=	'SELECT username FROM '.USERS.' WHERE `id` = '.$ID.';';
$query = $GLOBALS['DATABASE']->query($stats_sql);
while ($StatRow = $GLOBALS['DATABASE']->fetch_array($query))
{
	$username = $StatRow['username'];
}
return $username;
}

function getAllianceTag($allianceID)
{
$diploAlly	= $GLOBALS['DATABASE']->query("SELECT ally_tag FROM ".ALLIANCE." WHERE id = ".$allianceID.";");
$diploRow = $GLOBALS['DATABASE']->fetch_array($diploAlly);
$diploRow = $diploRow['ally_tag'];
return $diploRow;
}

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'mFzSfd8q';
    $secret_iv = '2QhdrkjV';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

$obtenir	 		= HTTP::_GP('obtenir', '', UTF8_SUPPORT);
$securite_cle 		= HTTP::_GP('securite_cle', '');
$type_tchat 		= HTTP::_GP('type_tchat', 'general', UTF8_SUPPORT);
$page_active 		= HTTP::_GP('page_active', '', false);
$id_dernier 		= HTTP::_GP('id_dernier', 0);
$action 			= HTTP::_GP('action', "");

/* $free = shell_exec('free');
$free = (string)trim($free);
$free_arr = explode("\n", $free);
$mem = explode(" ", $free_arr[1]);
$mem = array_filter($mem);
$mem = array_merge($mem);
$memory_usage = $mem[2]/$mem[1]; */
$memory_usage = 0.2;

$haveAlly = false;
$isAdmin = false;
$isModo = false;
$isStadd = false;
if($USER['ally_id'] != 0)
	$haveAlly = true;
if($USER['authlevel'] == 3)
	$isAdmin = true;
if($USER['isModo'] == 1)
	$isModo = true;
if($USER['isStaff'] == 1)
	$isStadd = true;
$balken = $GLOBALS['DATABASE']->countquery("SELECT COUNT(*) FROM ".USERS." WHERE universe = 1 AND onlinetime > '".(TIMESTAMP - 15 * 60 )."';");	
$newChat = $GLOBALS['DATABASE']->countquery("SELECT COUNT(*) FROM ".MINICHAT." WHERE id > '".$USER['chat_visit']."';");	
$CountChat = $GLOBALS['DATABASE']->countquery("SELECT COUNT(*) FROM ".MINICHAT.";");	


if($action == "voter"){
	if($USER['v1'] > TIMESTAMP){
		$sendEcho = array("reponse"=>false,"message"=>$LNG['NOUVEAUTE_344']);
	}else{
		$sendEcho = array("reponse"=>true,"message"=>$LNG['NOUVEAUTE_345']);
	}
	echo json_encode($sendEcho);
}elseif($action == "voterRoot"){
	if($USER['v2'] > TIMESTAMP){
		$sendEcho = array("reponse"=>false,"message"=>$LNG['NOUVEAUTE_344']);
	}else{
		$sendEcho = array("reponse"=>true,"message"=>$LNG['NOUVEAUTE_345']);
		$validationKey	= md5(uniqid('2m'));
		$txn 			= "VOTE_".$validationKey;
		$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET darkmatter = darkmatter + '0.05', v2 = ".(TIMESTAMP+2*60*60)." WHERE id = '".$USER['id']."';");	
		$GLOBALS['DATABASE']->query("INSERT INTO uni1_paysafecard_log VALUES ('".$GLOBALS['DATABASE']->GetInsertID()."','".$USER['id']."','".TIMESTAMP."','".$txn."', '0', '0.05', 'Don', '1','".$validationKey."');");
	}
	echo json_encode($sendEcho);
}elseif($action == "supprimer_bienvenue"){
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET intro = 1 WHERE id = ".$USER['id']." ;");
	$sendEcho = array("reponse"=>true);
	echo json_encode($sendEcho);
}elseif($obtenir == "information_actualisation"){
	if($USER['authlevel'] == 3)
		$chatPosi = $LNG['NOUVEAUTE_813'];
	elseif($USER['isModo'] == 1)
		$chatPosi = $LNG['NOUVEAUTE_814'];
	elseif($USER['isStaff'] == 1)
		$chatPosi = $LNG['NOUVEAUTE_815'];
	else 
		$chatPosi = $LNG['NOUVEAUTE_816'];
				
	$sendEcho = array("serveur"=>array("nom_univers"=>"".Config::get('uni_name')."","version"=>"".Config::get('VERSION')."","timestamp"=>TIMESTAMP,"nb_connecte"=>$balken,"charge_serveur"=>$memory_usage),"notification"=>null,"joueur"=>array("id_joueur"=>$USER['id'],"pseudo"=>"".$USER['username']."","administrateur"=>$isAdmin,"moderateur"=>$isModo,"staff"=>$isStadd,"statut_staff"=>"".$chatPosi."","avatar_anti_cache"=>"https://cdn.makeyourgame.pro/game/media/avatar/mini_1375.png?1468969250","possede_alliance"=>$haveAlly,"nb_nouveau_message"=>$USER['messages'],"nb_nouveau_tchat"=>$newChat,"nb_nouveau_tchat_alliance"=>0),"global_joueur"=>array("id_joueur"=>$USER['id'],"pseudo"=>"".$USER['username']."","administrateur"=>$isAdmin,"moderateur"=>$isModo,"staff"=>$isStadd,"statut_staff"=>"".$chatPosi."","avatar_anti_cache"=>"https://cdn.makeyourgame.pro/game/media/avatar/mini_1375.png?1468969250","possede_alliance"=>$haveAlly,"nb_nouveau_message"=>$USER['messages'],"nb_nouveau_tchat"=>$newChat,"nb_nouveau_tchat_alliance"=>0));
	
	echo json_encode($sendEcho);
}elseif($obtenir == "liste_message_tchat"){
	$sendEcho = "";
	$lastID		 = $GLOBALS['DATABASE']->getFirstRow("SELECT id FROM ".MINICHAT." ORDER BY id DESC LIMIT 1;");
	if(empty($lastID))
		$lastID['id'] = 0;
	
	$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET chat_visit = '".$lastID['id']."' WHERE id = ".$USER['id']." ;");
	if(!empty($lastID)){
		$chatMessage = $GLOBALS['DATABASE']->query("SELECT * FROM ".MINICHAT." WHERE id > ".$id_dernier." ORDER BY id DESC LIMIT 10;");
		foreach($chatMessage as $omt){
				
			if($omt['destinataire'] != 0 && $omt['destinataire'] != $USER['id']	&& $omt['userID'] != $USER['id'] && $USER['authlevel'] == 0 && $USER['isModo'] == 0 && $USER['isStaff'] == 0)
				continue; 
			//$sendEcho = array();	
			$Details = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE `id` = '".$omt['userID']."';");
			$chatStaff = false;
			$chatPosi  = "";
			if($Details['authlevel'] == 3 || $Details['isModo'] || $Details['isStaff'])
				$chatStaff = true;
			if($Details['authlevel'] == 3)
				$chatPosi = $LNG['NOUVEAUTE_813'];
			elseif($Details['isModo'] == 1)
				$chatPosi = $LNG['NOUVEAUTE_814'];
			elseif($Details['isStaff'] == 1)
				$chatPosi = $LNG['NOUVEAUTE_815'];
			else 
				$chatPosi = $LNG['NOUVEAUTE_816'];
			
			$destinataire = null;
			$tag_alliancedest = "";
			$chucotement = "";
			$destUsername = "";
			$destAvatar = "";
			$chatStaff2 = false;
			$destAlly = 0;
			$destcolor = "";
			if($omt['destinataire'] != 0){
				$destinataire = $omt['destinataire'];
				$DetailsDest = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE `id` = '".$destinataire."';");
				
				if($DetailsDest['authlevel'] == 3 || $DetailsDest['isModo'] || $DetailsDest['isStaff'])
					$chatStaff2 = true;
				$chucotement = sprintf($LNG['NOUVEAUTE_252'], $Details['username'], $DetailsDest['username']);
				if($DetailsDest['ally_id'] != 0){
					$allyDetailsDest = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".ALLIANCE." WHERE `id` = '".$DetailsDest['ally_id']."';");
					$tag_alliancedest = $allyDetailsDest['ally_tag'];
				}
				$destUsername = $DetailsDest['username'];
				$destAvatar = $DetailsDest['avatar'];
				$destAlly = $DetailsDest['ally_id'];
				$destcolor = $DetailsDest['custom_color'];
			}
			$tag_alliance = "";
			if($Details['ally_id'] != 0){
				$allyDetails = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".ALLIANCE." WHERE `id` = '".$Details['ally_id']."';");
				$tag_alliance = $allyDetails['ally_tag'];
			}
			
			$allowedClor = array('rouge', 'orange', 'jaune', 'chartreuse', 'vert', 'cyan', 'bleu', 'violet', 'rose', 'gris', 'blanc');
			foreach($allowedClor as $color){
				$omt['message'] = str_replace('['.$color.']', '<span class="'.$color.'">', $omt['message']);
				$omt['message'] = str_replace('[/'.$color.']', '</span>', $omt['message']);
			}
			
			$omt['message'] = str_replace('[b]', '<strong>', $omt['message']);	// ie. "\r\n" becomes "<br />\n"
			$omt['message'] = str_replace('[/b]', '</strong>', $omt['message']);
			$omt['message'] = str_replace('[i]', '<em>', $omt['message']);
			$omt['message'] = str_replace('[/i]', '</em>', $omt['message']);
			$omt['message'] = str_replace('[u]', '<span style="text-decoration: underline;">', $omt['message']);
			$omt['message'] = str_replace('[/u]', '</span>', $omt['message']);
			
			$typeMessageSend = "normal";
			if($omt['isAnnonce'] == 1)
				$typeMessageSend = "annonce";
			$theDate = _date('d/m à H:i:s', $omt['timestamp'], $Details['timezone']);
			$theavatartext = sprintf($LNG['NOUVEAUTE_253'], $omt['pseudo'], $omt['pseudo']);
			$sendEcho[] = array("id_message"=>$omt['id'],"id_expediteur"=>$omt['userID'],"id_destinataire"=>$destinataire,"id_alliance"=>0,"timestamp"=>$omt['timestamp'],"date_heure"=>"".$theDate."","type"=>"".$typeMessageSend."","texte"=>"".$omt['message']."","expediteur"=>array("pseudo"=>"".$omt['pseudo']."","avatar"=>"styles/avatars/".$Details['avatar'],"staff"=>$chatStaff,"tag_alliance"=>"".$tag_alliance."","couleur"=>"".$Details['custom_color']."", "allianceid"=>"".$Details['ally_id'].""),"destinataire"=>array("pseudo"=>"".$destUsername."","avatar"=>"styles/avatars/".$destAvatar,"staff"=>$chatStaff2,"tag_alliance"=>"".$tag_alliancedest."","couleur"=>"".$destcolor."","allianceid"=>"".$destAlly.""),"bulles"=>array("avatar"=>"".$theavatartext."","chuchotement"=>"".$chucotement."","membre_staff"=>$chatPosi));
			
		}
		if($CountChat >= 50){
			$GLOBALS['DATABASE']->query("DELETE FROM ".MINICHAT." WHERE id < ".($lastID['id']-10)." ;");
		}
	
		echo json_encode($sendEcho);
	}
	
}elseif($obtenir == "liste_infrastructure"){
	
	$sendEcho = array("1"=>array("id_infrastructure"=>"1","nom"=>"".$LNG['INFRASTRUCTURE'][1]."","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"".$LNG['INFRASTRUCTURE'][2]."","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"".$LNG['INFRASTRUCTURE'][3]."","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"".$LNG['INFRASTRUCTURE'][4]."","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"".$LNG['INFRASTRUCTURE'][5]."","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"".$LNG['INFRASTRUCTURE'][6]."","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"".$LNG['INFRASTRUCTURE'][7]."","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"".$LNG['INFRASTRUCTURE'][8]."","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"".$LNG['INFRASTRUCTURE'][9]."","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
	echo json_encode($sendEcho);
	
}elseif($obtenir == "liste_composant"){
	$sendEcho = array("1"=>array("id_composant"=>"1","nom"=>"".$LNG['COMPOSANT'][1]."","type"=>"attaque","fer"=>"100","oro"=>"50","cristal"=>"20","elyrium"=>"0","valeur"=>"10","fret"=>"2","temps"=>"20","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"2"=>array("id_composant"=>"2","nom"=>"".$LNG['COMPOSANT'][2]."","type"=>"attaque","fer"=>"500","oro"=>"200","cristal"=>"100","elyrium"=>"0","valeur"=>"80","fret"=>"5","temps"=>"40","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"3"=>array("id_composant"=>"3","nom"=>"".$LNG['COMPOSANT'][3]."","type"=>"attaque","fer"=>"1000","oro"=>"500","cristal"=>"250","elyrium"=>"50","valeur"=>"250","fret"=>"10","temps"=>"100","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"4"=>array("id_composant"=>"4","nom"=>"".$LNG['COMPOSANT'][4]."","type"=>"attaque","fer"=>"1500","oro"=>"1000","cristal"=>"400","elyrium"=>"150","valeur"=>"600","fret"=>"20","temps"=>"200","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"5"=>array("id_composant"=>"5","nom"=>"".$LNG['COMPOSANT'][5]."","type"=>"attaque","fer"=>"4000","oro"=>"2500","cristal"=>"1000","elyrium"=>"250","valeur"=>"2000","fret"=>"50","temps"=>"300","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"6"=>array("id_composant"=>"6","nom"=>"".$LNG['COMPOSANT'][6]."","type"=>"attaque","fer"=>"10000","oro"=>"6000","cristal"=>"2500","elyrium"=>"400","valeur"=>"7500","fret"=>"100","temps"=>"400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"7"=>array("id_composant"=>"7","nom"=>"".$LNG['COMPOSANT'][7]."","type"=>"attaque","fer"=>"25000","oro"=>"15000","cristal"=>"8000","elyrium"=>"1000","valeur"=>"25000","fret"=>"200","temps"=>"550","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"8"=>array("id_composant"=>"8","nom"=>"".$LNG['COMPOSANT'][8]."","type"=>"attaque","fer"=>"35000","oro"=>"22500","cristal"=>"12500","elyrium"=>"1500","valeur"=>"47500","fret"=>"400","temps"=>"600","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"9"=>array("id_composant"=>"9","nom"=>"".$LNG['COMPOSANT'][9]."","type"=>"coque","fer"=>"250","oro"=>"100","cristal"=>"10","elyrium"=>"20","valeur"=>"60","fret"=>"4","temps"=>"15","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"10"=>array("id_composant"=>"10","nom"=>"".$LNG['COMPOSANT'][10]."","type"=>"coque","fer"=>"750","oro"=>"300","cristal"=>"150","elyrium"=>"175","valeur"=>"450","fret"=>"10","temps"=>"30","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"11"=>array("id_composant"=>"11","nom"=>"".$LNG['COMPOSANT'][11]."","type"=>"coque","fer"=>"1000","oro"=>"400","cristal"=>"250","elyrium"=>"350","valeur"=>"1000","fret"=>"15","temps"=>"40","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"12"=>array("id_composant"=>"12","nom"=>"".$LNG['COMPOSANT'][12]."","type"=>"coque","fer"=>"2000","oro"=>"800","cristal"=>"500","elyrium"=>"500","valeur"=>"3000","fret"=>"30","temps"=>"50","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"13"=>array("id_composant"=>"13","nom"=>"".$LNG['COMPOSANT'][13]."","type"=>"bouclier","fer"=>"250","oro"=>"100","cristal"=>"175","elyrium"=>"25","valeur"=>"65","fret"=>"4","temps"=>"40","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"14"=>array("id_composant"=>"14","nom"=>"".$LNG['COMPOSANT'][14]."","type"=>"bouclier","fer"=>"400","oro"=>"200","cristal"=>"425","elyrium"=>"100","valeur"=>"350","fret"=>"8","temps"=>"60","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"15"=>array("id_composant"=>"15","nom"=>"".$LNG['COMPOSANT'][15]."","type"=>"bouclier","fer"=>"1000","oro"=>"650","cristal"=>"950","elyrium"=>"250","valeur"=>"1200","fret"=>"14","temps"=>"75","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"16"=>array("id_composant"=>"16","nom"=>"".$LNG['COMPOSANT'][16]."","type"=>"vitesse","fer"=>"750","oro"=>"500","cristal"=>"300","elyrium"=>"0","valeur"=>"5","fret"=>"20","temps"=>"100","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"17"=>array("id_composant"=>"17","nom"=>"".$LNG['COMPOSANT'][17]."","type"=>"vitesse","fer"=>"1500","oro"=>"1000","cristal"=>"600","elyrium"=>"0","valeur"=>"150","fret"=>"50","temps"=>"125","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"18"=>array("id_composant"=>"18","nom"=>"".$LNG['COMPOSANT'][18]."","type"=>"vitesse","fer"=>"2500","oro"=>"1750","cristal"=>"1000","elyrium"=>"250","valeur"=>"300","fret"=>"100","temps"=>"0","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"19"=>array("id_composant"=>"19","nom"=>"".$LNG['COMPOSANT'][19]."","type"=>"vitesse","fer"=>"6000","oro"=>"4000","cristal"=>"2500","elyrium"=>"300","valeur"=>"750","fret"=>"300","temps"=>"225","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"0"),"20"=>array("id_composant"=>"20","nom"=>"".$LNG['COMPOSANT'][20]."","type"=>"vitesse","fer"=>"8500","oro"=>"6000","cristal"=>"4000","elyrium"=>"500","valeur"=>"1650","fret"=>"750","temps"=>"250","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"0"),"21"=>array("id_composant"=>"21","nom"=>"".$LNG['COMPOSANT'][21]."","type"=>"vitesse","fer"=>"12500","oro"=>"10000","cristal"=>"7500","elyrium"=>"1000","valeur"=>"2000","fret"=>"2800","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"0"),"22"=>array("id_composant"=>"22","nom"=>"".$LNG['COMPOSANT'][22]."","type"=>"vitesse","fer"=>"20000","oro"=>"15000","cristal"=>"10000","elyrium"=>"5000","valeur"=>"4000","fret"=>"8000","temps"=>"350","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"23"=>array("id_composant"=>"23","nom"=>"".$LNG['COMPOSANT'][23]."","type"=>"vitesse","fer"=>"45000","oro"=>"30000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"13000","fret"=>"16000","temps"=>"500","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"24"=>array("id_composant"=>"24","nom"=>"".$LNG['COMPOSANT'][24]."","type"=>"vitesse","fer"=>"130000","oro"=>"100000","cristal"=>"75000","elyrium"=>"75000","valeur"=>"32000","fret"=>"60000","temps"=>"750","infra_min"=>"6","hyperespace"=>"1","hangar_infra"=>"0"),"25"=>array("id_composant"=>"25","nom"=>"".$LNG['COMPOSANT'][25]."","type"=>"vitesse","fer"=>"160000","oro"=>"125000","cristal"=>"120000","elyrium"=>"90000","valeur"=>"45000","fret"=>"95000","temps"=>"900","infra_min"=>"6","hyperespace"=>"1","hangar_infra"=>"0"),"26"=>array("id_composant"=>"26","nom"=>"".$LNG['COMPOSANT'][26]."","type"=>"vitesse","fer"=>"250000","oro"=>"215000","cristal"=>"155000","elyrium"=>"125000","valeur"=>"60000","fret"=>"125000","temps"=>"1400","infra_min"=>"9","hyperespace"=>"1","hangar_infra"=>"0"),"27"=>array("id_composant"=>"27","nom"=>"".$LNG['COMPOSANT'][27]."","type"=>"autre","fer"=>"2000000","oro"=>"3000000","cristal"=>"2500000","elyrium"=>"800000","valeur"=>"0","fret"=>"40000","temps"=>"20000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"28"=>array("id_composant"=>"28","nom"=>"".$LNG['COMPOSANT'][28]."","type"=>"autre","fer"=>"25000","oro"=>"50000","cristal"=>"30000","elyrium"=>"20000","valeur"=>"0","fret"=>"1000","temps"=>"1000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"29"=>array("id_composant"=>"29","nom"=>"".$LNG['COMPOSANT'][29]."","type"=>"drone","fer"=>"240000","oro"=>"180000","cristal"=>"150000","elyrium"=>"75000","valeur"=>"1","fret"=>"1200","temps"=>"3500","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"30"=>array("id_composant"=>"30","nom"=>"".$LNG['COMPOSANT'][30]."","type"=>"drone","fer"=>"600000","oro"=>"450000","cristal"=>"300000","elyrium"=>"120000","valeur"=>"4","fret"=>"4800","temps"=>"13000","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"31"=>array("id_composant"=>"31","nom"=>"".$LNG['COMPOSANT'][31]."","type"=>"drone","fer"=>"1050000","oro"=>"600000","cristal"=>"412500","elyrium"=>"210000","valeur"=>"10","fret"=>"12000","temps"=>"30000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"32"=>array("id_composant"=>"32","nom"=>"".$LNG['COMPOSANT'][32]."","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"".$LNG['COMPOSANT'][33]."","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"".$LNG['COMPOSANT'][34]."","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"".$LNG['COMPOSANT'][35]."","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"".$LNG['COMPOSANT'][36]."","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
	
	echo json_encode($sendEcho);
}elseif($obtenir == "capteur_systeme"){
	$systeme 			= HTTP::_GP('systeme', 1);
	
	if($systeme > 1000 || $systeme < 0)
		$systeme = 1000;
	
	$planetArray		= array(1,2,3,4,5,6,7,8,9,10);
	$SelectCombo		= mt_rand(1,5);
	if($SelectCombo == 1){
		$positionArray 	= array('null', 'droite', 'gauche', 'gauche', 'gauche', 'droite', 'droite', 'gauche', 'gauche', 'droite', 'gauche');
		$positionX		= array(0, 496, 594, 222, 268, 180, 533, 682, 623, 85, 283,);
		$positionY		= array(0, 214, 172, 209, 97, 326, 330, 123, 371, 376, 263);
	}elseif($SelectCombo == 2){
		$positionArray 	= array('null', 'gauche', 'gauche', 'gauche', 'gauche', 'droite', 'droite', 'gauche', 'droite', 'droite', 'gauche');
		$positionX		= array(0, 377, 637, 279, 652, 191, 204, 602, 509, 127, 698,);
		$positionY		= array(0, 355, 323, 216, 98, 316, 102, 226, 145, 163, 371);
	}elseif($SelectCombo == 3){	
		$positionArray 	= array('null', 'gauche', 'droite', 'droite', 'gauche', 'droite', 'gauche', 'droite', 'gauche', 'droite', 'gauche');
		$positionX		= array(0, 676, 103, 446, 306, 437, 649, 216, 585, 147, 254,);
		$positionY		= array(0, 152, 265, 357, 140, 109, 254, 359, 296, 97, 201);
	}elseif($SelectCombo == 4){	
		$positionArray 	= array('null', 'droite', 'droite', 'droite', 'gauche', 'droite', 'droite', 'droite', 'gauche', 'gauche', 'gauche');
		$positionX		= array(0, 101, 252, 469, 597, 499, 140, 153, 562, 688, 221,);
		$positionY		= array(0, 182, 361, 342, 219, 134, 312, 117, 298, 174, 261);
	}elseif($SelectCombo == 5){	
		$positionArray 	= array('null', 'gauche', 'droite', 'droite', 'gauche', 'droite', 'gauche', 'gauche', 'droite', 'gauche', 'droite');
		$positionX		= array(0, 643, 160, 269, 699, 518, 679, 352, 161, 292, 532,);
		$positionY		= array(0, 154, 374, 318, 377, 108, 244, 113, 231, 184, 316);
	}
	
	
	$finalArray			= array();
	foreach($planetArray as $planet){
		$galInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".PLANETS." WHERE `system` = '".$systeme."' AND `planet` = '".$planet."';");
	
		if(empty($galInfo)){
			$mission_1	= encrypt_decrypt("encrypt","coloniser_portail-".$systeme."-".$planet);
			$mission_2	= encrypt_decrypt("encrypt","recycler-".$systeme."-".$planet);
			
			$finalArray[$planet] = array("systeme"=>$galInfo['system'],"position"=>$planet,"direction"=>"".$positionArray[$planet]."","coordonnees"=>array("x"=>$positionX[$planet],"y"=>$positionY[$planet]),"champ_ruine"=>array("fer"=>0,"or"=>0,"cristal"=>0,"elyrium"=>0),"libre"=>true,"nom_planete"=>"Free","actions_encrypter"=>array("coloniser_portail"=>"".$mission_1."","recycler"=>"".$mission_2.""));
		}else{
			$galStatInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE `id_owner` = '".$galInfo['id_owner']."';");
			$playerInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE `id` = '".$galInfo['id_owner']."';");
			
			$galStatInfo1 	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".STATPOINTS." WHERE `id_owner` = '".$galInfo['id_owner']."';");
			$galStatInfo1 	+= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".USERS." WHERE `id` = '".$galInfo['id_owner']."';");
			$AllyName = "";
			if($playerInfo['ally_id'] != 0)
				$AllyName = " <span class=orange>[".getAllianceTag($playerInfo['ally_id'])."]</span>";
			
			
			$IsNoobProtec		= CheckNoobProtec($USER, $galStatInfo1, $galStatInfo1);
			$Class		 		= "";
			
			$Count	= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".LOG_FLEETS."
			WHERE fleet_owner = ".$USER['id']." 
			AND fleet_end_galaxy = 1 
			AND fleet_end_system = ".$systeme." 
			AND fleet_end_planet = ".$planet." 
			AND fleet_state != 0 
			AND fleet_start_time > ".(TIMESTAMP - BASH_TIME)." 
			AND fleet_mission = 1;");
			

			
			if ($playerInfo['user_deleted'] == 1)
			{
				$Class		 	= 'supprimer_serveur';

			}
			elseif ($playerInfo['banaday'] > TIMESTAMP && $playerInfo['urlaubs_modus'] == 1)
			{
				$Class		 	= 'banni_serveur';
			}
			elseif ($playerInfo['banaday'] > TIMESTAMP)
			{
				$Class		 	= 'banni_serveur';
			}
			elseif ($playerInfo['multi_spotted'] == 1)
			{
				$Class		 	= 'bleu';
			}
			elseif ($playerInfo['urlaubs_modus'] == 1)
			{
				$Class		 	= 'violet';
			}
			elseif ($playerInfo['immunity_until'] > TIMESTAMP || $Count >= 6 || !isModulAvalible(MODULE_MISSION_ATTACK))
			{
				$Class		 	= 'jaune';
			}
			elseif ($IsNoobProtec['NoobPlayer'])
			{
				$Class		 	= 'vert';
			}
			elseif ($IsNoobProtec['StrongPlayer'])
			{
				$Class		 	= 'rouge';
			}elseif (1 < 0)
			{
				$Class		 	= 'en_guerre';
			}
			
			$mission_1	= encrypt_decrypt("encrypt","attaquer_portail-".$galInfo['system']."-".$galInfo['planet']);
			$mission_2	= encrypt_decrypt("encrypt","attaquer_flotte-".$galInfo['system']."-".$galInfo['planet']);
			$mission_3	= encrypt_decrypt("encrypt","espionner_portail-".$galInfo['system']."-".$galInfo['planet']);
			$mission_4	= encrypt_decrypt("encrypt","espionner_flotte-".$galInfo['system']."-".$galInfo['planet']);
			$mission_5	= encrypt_decrypt("encrypt","recycler-".$galInfo['system']."-".$galInfo['planet']);
			$finalArray[$planet] = array("systeme"=>$galInfo['system'],"position"=>$galInfo['planet'],"direction"=>"".$positionArray[$planet]."","coordonnees"=>array("x"=>$positionX[$planet],"y"=>$positionY[$planet]),"champ_ruine"=>array("fer"=>$galInfo['der_metal'],"or"=>$galInfo['der_crystal'],"cristal"=>$galInfo['der_deuterium'],"elyrium"=>$galInfo['der_elyrium']),"libre"=>false,"nom_planete"=>"".$galInfo['name']."","pseudo_joueur"=>"".getUsername($galInfo['id_owner'])."","pseudo_couleur"=>"".$Class."","point_joueur"=>pretty_number($galStatInfo['total_points']),"classement_joueur"=>$galStatInfo['total_rank'],"affichage_alliance"=>$AllyName,"actions_encrypter"=>array("attaquer_portail"=>"".$mission_1."","attaquer_flotte"=>"".$mission_2."","espionner_portail"=>"".$mission_3."","espionner_flotte"=>"".$mission_4."","recycler"=>"".$mission_5.""));
		}
	}
	
	$sendEcho = array("configuration"=>array("rayon_planete"=>13,"rayon_fromage"=>50,"rayon_champ_ruine"=>35,"hauteur_bulle"=>26,"largeur_bulle"=>190,"hauteur_capteur"=>470,"largeur_capteur"=>770),"liste_planete"=>$finalArray);
	
	echo json_encode($sendEcho);
	
	
}elseif($obtenir == "liste_appareil"){
	$elementsid = array(202,203,210,224,225,226,209,223,219,221,222);
	$finalArray			= array();
	$elementValue 	= 1;
	$array2 = array(209,223,219);
	$array3 = array(221,222);
	foreach($elementsid as $element){
		$onglet = 1;
		if(in_array($element, $array2))
			$onglet = 2;
		if(in_array($element, $array3))
			$onglet = 3;
		
		$nombre = $PLANET[$resource[$element]];
		$finalArray[$element] = array("id_appareil"=>$element,"id_planete"=>$PLANET['id'],"nombre"=>$nombre,"prix_fer"=>$pricelist[$element]['cost'][901],"prix_or"=>$pricelist[$element]['cost'][902],"prix_cristal"=>$pricelist[$element]['cost'][903],"prix_elyrium"=>$pricelist[$element]['cost'][904],"attaque"=>$pricelist[$element]['atk'],"bouclier"=>$pricelist[$element]['defed'],"coque"=>$pricelist[$element]['defed'],"vitesse"=>$pricelist[$element]['defed'],"fret"=>$pricelist[$element]['capacity'],"hyperespace"=>0,"onglet"=>$onglet,"nom"=>"".$LNG['tech'][$element]."");
		$elementValue++;
	}
	$sendEcho = $finalArray;
	echo json_encode($sendEcho); 
}elseif($obtenir == "liste_equipe"){
	$userPop = array();
	$GetuserPop= $GLOBALS['DATABASE']->query("SELECT * FROM ".FLEETS_MANAGE." WHERE userID = ".$USER['id']." AND manageType = 1 ORDER by manageID ASC;");
	foreach($GetuserPop as $Pop){
		$userPop[$Pop['manageID']]	= array(
			'id_equipe'				=> $Pop['manageID'],
			'id_equipe_encrypter'	=> encrypt_decrypt("encrypt","population-".$USER['id']."-".$Pop['manageID']),
			'couleur'				=> $Pop['couleur'],
			'nom'					=> $Pop['manage_name'],
		);
	}
	
	$userShip = array();
	$GetuserShip= $GLOBALS['DATABASE']->query("SELECT * FROM ".FLEETS_MANAGE." WHERE userID = ".$USER['id']." AND manageType = 2 ORDER by manageID ASC;");
	foreach($GetuserShip as $Pop){
		$userShip[$Pop['manageID']]	= array(
			'id_equipe'				=> $Pop['manageID'],
			'id_equipe_encrypter'	=> encrypt_decrypt("encrypt","appareil-".$USER['id']."-".$Pop['manageID']),
			'couleur'				=> $Pop['couleur'],
			'nom'					=> $Pop['manage_name'],
		);
	}
	$sendEcho = array("population"=>$userPop,"vaisseau"=>$userShip);
	echo json_encode($sendEcho); 
}
//"notification"=>[array("time"=>1469050532,"texte"=>"« Antaris » a envoyé un chuchotement :<br> « tu va bien »","temps"=>12,"type"=>"chuchotement","image"=>"styles/avatars/avatar_defaut.jpg")]
?>
