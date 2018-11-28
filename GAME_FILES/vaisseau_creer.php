<?php

define('MODE', 'INGAME');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$action	 		= HTTP::_GP('action', '', UTF8_SUPPORT);
$composant		= array();
if($action == "verifierModele"){
	$nom	 		= HTTP::_GP('nom', '', UTF8_SUPPORT);
	$image	 		= HTTP::_GP('image', "antaris-legacy.co");
	$id_infrastructure	 		= HTTP::_GP('id_infrastructure', 1);
	//Attaque
	$composant[1]	= HTTP::_GP('composant_1', 0);
	$composant[2]	= HTTP::_GP('composant_2', 0);
	$composant[3]	= HTTP::_GP('composant_3', 0);
	$composant[4]	= HTTP::_GP('composant_4', 0);
	$composant[5]	= HTTP::_GP('composant_5', 0);
	$composant[6]	= HTTP::_GP('composant_6', 0);
	$composant[7]	= HTTP::_GP('composant_7', 0);
	$composant[8]	= HTTP::_GP('composant_8', 0);
	//Fin attaque
	//Coques
	$composant[9]	= HTTP::_GP('composant_9', 0);
	$composant[10]	= HTTP::_GP('composant_10', 0);
	$composant[11]	= HTTP::_GP('composant_11', 0);
	$composant[12]	= HTTP::_GP('composant_12', 0);
	//Fin Coques
	//Bouclier
	$composant[13]	= HTTP::_GP('composant_13', 0);
	$composant[14]	= HTTP::_GP('composant_14', 0);
	$composant[15]	= HTTP::_GP('composant_15', 0);
	//Fin bouclier
	//Reacteur
	$composant[16]	= HTTP::_GP('composant_16', 0);
	$composant[17]	= HTTP::_GP('composant_17', 0);
	$composant[18]	= HTTP::_GP('composant_18', 0);
	$composant[19]	= HTTP::_GP('composant_19', 0);
	$composant[20]	= HTTP::_GP('composant_20', 0);
	$composant[21]	= HTTP::_GP('composant_21', 0);
	$composant[22]	= HTTP::_GP('composant_22', 0);
	$composant[23]	= HTTP::_GP('composant_23', 0);
	$composant[24]	= HTTP::_GP('composant_24', 0);
	$composant[25]	= HTTP::_GP('composant_25', 0);
	$composant[26]	= HTTP::_GP('composant_26', 0);
	//Fin reacteur
	//Autres
	$composant[27]	= HTTP::_GP('composant_27', 0);
	$composant[28]	= HTTP::_GP('composant_28', 0);
	//Fin autres
	//Lance drone
	$composant[29]	= HTTP::_GP('composant_29', 0);
	$composant[30]	= HTTP::_GP('composant_30', 0);
	$composant[31]	= HTTP::_GP('composant_31', 0);
	//Fin lance drone
	//Hangars
	$composant[32]	= HTTP::_GP('composant_32', 0);
	$composant[33]	= HTTP::_GP('composant_33', 0);
	$composant[34]	= HTTP::_GP('composant_34', 0);
	$composant[35]	= HTTP::_GP('composant_35', 0);
	$composant[36]	= HTTP::_GP('composant_36', 0);
	//Fin hangars
	$valid_creation	= HTTP::_GP('valid_creation', 'Créer ce modèle', UTF8_SUPPORT);
	$reactorArray = array(1,2);
	$liste_infrastructure = array("1"=>array("id_infrastructure"=>"1","nom"=>"Chasseur","fret"=>"200","equipage_soldat"=>"0","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"1","temps"=>"120","maniabilite"=>"100","poids"=>"50","fer"=>"500","oro"=>"250","cristal"=>"100","elyrium"=>"50"),"2"=>array("id_infrastructure"=>"2","nom"=>"Intercepteur","fret"=>"2500","equipage_soldat"=>"1","equipage_technicien"=>"0","equipage_scientifique"=>"0","equipage_pilote"=>"2","temps"=>"250","maniabilite"=>"85","poids"=>"2000","fer"=>"3500","oro"=>"1750","cristal"=>"300","elyrium"=>"150"),"3"=>array("id_infrastructure"=>"3","nom"=>"Transporteur","fret"=>"10000","equipage_soldat"=>"10","equipage_technicien"=>"5","equipage_scientifique"=>"2","equipage_pilote"=>"4","temps"=>"300","maniabilite"=>"82","poids"=>"8000","fer"=>"17500","oro"=>"8000","cristal"=>"3500","elyrium"=>"1000"),"4"=>array("id_infrastructure"=>"4","nom"=>"Escorteur","fret"=>"40000","equipage_soldat"=>"20","equipage_technicien"=>"10","equipage_scientifique"=>"4","equipage_pilote"=>"10","temps"=>"300","maniabilite"=>"70","poids"=>"16000","fer"=>"30000","oro"=>"18000","cristal"=>"10000","elyrium"=>"3000"),"5"=>array("id_infrastructure"=>"5","nom"=>"Navette","fret"=>"150000","equipage_soldat"=>"20","equipage_technicien"=>"20","equipage_scientifique"=>"10","equipage_pilote"=>"40","temps"=>"400","maniabilite"=>"68","poids"=>"40000","fer"=>"80000","oro"=>"40000","cristal"=>"18000","elyrium"=>"8000"),"6"=>array("id_infrastructure"=>"6","nom"=>"Corvette","fret"=>"400000","equipage_soldat"=>"30","equipage_technicien"=>"50","equipage_scientifique"=>"20","equipage_pilote"=>"80","temps"=>"1500","maniabilite"=>"34","poids"=>"90000","fer"=>"175000","oro"=>"100000","cristal"=>"42000","elyrium"=>"22000"),"7"=>array("id_infrastructure"=>"7","nom"=>"Croiseur","fret"=>"600000","equipage_soldat"=>"40","equipage_technicien"=>"80","equipage_scientifique"=>"30","equipage_pilote"=>"120","temps"=>"1600","maniabilite"=>"30","poids"=>"95000","fer"=>"225000","oro"=>"150000","cristal"=>"45000","elyrium"=>"28000"),"8"=>array("id_infrastructure"=>"8","nom"=>"Croiseur lourd","fret"=>"800000","equipage_soldat"=>"50","equipage_technicien"=>"100","equipage_scientifique"=>"40","equipage_pilote"=>"150","temps"=>"1600","maniabilite"=>"28","poids"=>"100000","fer"=>"275000","oro"=>"180000","cristal"=>"48000","elyrium"=>"34000"),"9"=>array("id_infrastructure"=>"9","nom"=>"Destroyer","fret"=>"1650000","equipage_soldat"=>"100","equipage_technicien"=>"150","equipage_scientifique"=>"60","equipage_pilote"=>"400","temps"=>"3500","maniabilite"=>"25","poids"=>"140000","fer"=>"550000","oro"=>"400000","cristal"=>"120000","elyrium"=>"82000"));
	
	$liste_composant = array("1"=>array("id_composant"=>"1","nom"=>"Station de tir","type"=>"attaque","fer"=>"100","oro"=>"50","cristal"=>"20","elyrium"=>"0","valeur"=>"10","fret"=>"2","temps"=>"20","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"2"=>array("id_composant"=>"2","nom"=>"Canon à ions","type"=>"attaque","fer"=>"500","oro"=>"200","cristal"=>"100","elyrium"=>"0","valeur"=>"80","fret"=>"5","temps"=>"40","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"3"=>array("id_composant"=>"3","nom"=>"Missile IEM","type"=>"attaque","fer"=>"1000","oro"=>"500","cristal"=>"250","elyrium"=>"50","valeur"=>"250","fret"=>"10","temps"=>"100","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"4"=>array("id_composant"=>"4","nom"=>"Canon à plasma","type"=>"attaque","fer"=>"1500","oro"=>"1000","cristal"=>"400","elyrium"=>"150","valeur"=>"600","fret"=>"20","temps"=>"200","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"5"=>array("id_composant"=>"5","nom"=>"Rayon plasma","type"=>"attaque","fer"=>"4000","oro"=>"2500","cristal"=>"1000","elyrium"=>"250","valeur"=>"2000","fret"=>"50","temps"=>"300","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"6"=>array("id_composant"=>"6","nom"=>"Disrupteur","type"=>"attaque","fer"=>"10000","oro"=>"6000","cristal"=>"2500","elyrium"=>"400","valeur"=>"7500","fret"=>"100","temps"=>"400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"7"=>array("id_composant"=>"7","nom"=>"Canon des Antaris","type"=>"attaque","fer"=>"25000","oro"=>"15000","cristal"=>"8000","elyrium"=>"1000","valeur"=>"25000","fret"=>"200","temps"=>"550","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"8"=>array("id_composant"=>"8","nom"=>"Rayon Antaris","type"=>"attaque","fer"=>"35000","oro"=>"22500","cristal"=>"12500","elyrium"=>"1500","valeur"=>"47500","fret"=>"400","temps"=>"600","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"9"=>array("id_composant"=>"9","nom"=>"Coque à petit densité","type"=>"coque","fer"=>"250","oro"=>"100","cristal"=>"10","elyrium"=>"20","valeur"=>"60","fret"=>"4","temps"=>"15","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"10"=>array("id_composant"=>"10","nom"=>"Coque à densité moyenne","type"=>"coque","fer"=>"750","oro"=>"300","cristal"=>"150","elyrium"=>"175","valeur"=>"450","fret"=>"10","temps"=>"30","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"11"=>array("id_composant"=>"11","nom"=>"Coque à grande densité","type"=>"coque","fer"=>"1000","oro"=>"400","cristal"=>"250","elyrium"=>"350","valeur"=>"1000","fret"=>"15","temps"=>"40","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"12"=>array("id_composant"=>"12","nom"=>"Coque des Antaris","type"=>"coque","fer"=>"2000","oro"=>"800","cristal"=>"500","elyrium"=>"500","valeur"=>"3000","fret"=>"30","temps"=>"50","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"13"=>array("id_composant"=>"13","nom"=>"Petit bouclier","type"=>"bouclier","fer"=>"250","oro"=>"100","cristal"=>"175","elyrium"=>"25","valeur"=>"65","fret"=>"4","temps"=>"40","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"14"=>array("id_composant"=>"14","nom"=>"Grand bouclier","type"=>"bouclier","fer"=>"400","oro"=>"200","cristal"=>"425","elyrium"=>"100","valeur"=>"350","fret"=>"8","temps"=>"60","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"15"=>array("id_composant"=>"15","nom"=>"Bouclier des Antaris","type"=>"bouclier","fer"=>"1000","oro"=>"650","cristal"=>"950","elyrium"=>"250","valeur"=>"1200","fret"=>"14","temps"=>"75","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"16"=>array("id_composant"=>"16","nom"=>"Turboréacteur","type"=>"vitesse","fer"=>"750","oro"=>"500","cristal"=>"300","elyrium"=>"0","valeur"=>"5","fret"=>"20","temps"=>"100","infra_min"=>"1","hyperespace"=>"0","hangar_infra"=>"0"),"17"=>array("id_composant"=>"17","nom"=>"Statoréacteur","type"=>"vitesse","fer"=>"1500","oro"=>"1000","cristal"=>"600","elyrium"=>"0","valeur"=>"150","fret"=>"50","temps"=>"125","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"18"=>array("id_composant"=>"18","nom"=>"Propulseur à propergol","type"=>"vitesse","fer"=>"2500","oro"=>"1750","cristal"=>"1000","elyrium"=>"250","valeur"=>"300","fret"=>"100","temps"=>"0","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"19"=>array("id_composant"=>"19","nom"=>"Propulseur hybride","type"=>"vitesse","fer"=>"6000","oro"=>"4000","cristal"=>"2500","elyrium"=>"300","valeur"=>"750","fret"=>"300","temps"=>"225","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"0"),"20"=>array("id_composant"=>"20","nom"=>"Propulseur ionique","type"=>"vitesse","fer"=>"8500","oro"=>"6000","cristal"=>"4000","elyrium"=>"500","valeur"=>"1650","fret"=>"750","temps"=>"250","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"0"),"21"=>array("id_composant"=>"21","nom"=>"Propulseur photonique","type"=>"vitesse","fer"=>"12500","oro"=>"10000","cristal"=>"7500","elyrium"=>"1000","valeur"=>"2000","fret"=>"2800","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"0"),"22"=>array("id_composant"=>"22","nom"=>"Propulseur nucléaire thermique","type"=>"vitesse","fer"=>"20000","oro"=>"15000","cristal"=>"10000","elyrium"=>"5000","valeur"=>"4000","fret"=>"8000","temps"=>"350","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"23"=>array("id_composant"=>"23","nom"=>"Réacteur à antimatière","type"=>"vitesse","fer"=>"45000","oro"=>"30000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"13000","fret"=>"16000","temps"=>"500","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"0"),"24"=>array("id_composant"=>"24","nom"=>"Moteur à hyperespace","type"=>"vitesse","fer"=>"130000","oro"=>"100000","cristal"=>"75000","elyrium"=>"75000","valeur"=>"32000","fret"=>"60000","temps"=>"750","infra_min"=>"6","hyperespace"=>"1","hangar_infra"=>"0"),"25"=>array("id_composant"=>"25","nom"=>"Moteur VSL","type"=>"vitesse","fer"=>"160000","oro"=>"125000","cristal"=>"120000","elyrium"=>"90000","valeur"=>"45000","fret"=>"95000","temps"=>"900","infra_min"=>"6","hyperespace"=>"1","hangar_infra"=>"0"),"26"=>array("id_composant"=>"26","nom"=>"Moteur VSL amélioré","type"=>"vitesse","fer"=>"250000","oro"=>"215000","cristal"=>"155000","elyrium"=>"125000","valeur"=>"60000","fret"=>"125000","temps"=>"1400","infra_min"=>"9","hyperespace"=>"1","hangar_infra"=>"0"),"27"=>array("id_composant"=>"27","nom"=>"Installation du siège des Antaris","type"=>"autre","fer"=>"2000000","oro"=>"3000000","cristal"=>"2500000","elyrium"=>"800000","valeur"=>"0","fret"=>"40000","temps"=>"20000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"28"=>array("id_composant"=>"28","nom"=>"Système de téléportation","type"=>"autre","fer"=>"25000","oro"=>"50000","cristal"=>"30000","elyrium"=>"20000","valeur"=>"0","fret"=>"1000","temps"=>"1000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"29"=>array("id_composant"=>"29","nom"=>"Lance-drone à cadence faible","type"=>"drone","fer"=>"240000","oro"=>"180000","cristal"=>"150000","elyrium"=>"75000","valeur"=>"1","fret"=>"1200","temps"=>"3500","infra_min"=>"2","hyperespace"=>"0","hangar_infra"=>"0"),"30"=>array("id_composant"=>"30","nom"=>"Lance-drone à cadence moyenne","type"=>"drone","fer"=>"600000","oro"=>"450000","cristal"=>"300000","elyrium"=>"120000","valeur"=>"4","fret"=>"4800","temps"=>"13000","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"0"),"31"=>array("id_composant"=>"31","nom"=>"Lance-drone à cadence rapide","type"=>"drone","fer"=>"1050000","oro"=>"600000","cristal"=>"412500","elyrium"=>"210000","valeur"=>"10","fret"=>"12000","temps"=>"30000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"0"),"32"=>array("id_composant"=>"32","nom"=>"Hangar à chasseur","type"=>"hangar","fer"=>"20000","oro"=>"15000","cristal"=>"4000","elyrium"=>"6000","valeur"=>"10","fret"=>"1500","temps"=>"300","infra_min"=>"3","hyperespace"=>"0","hangar_infra"=>"1"),"33"=>array("id_composant"=>"33","nom"=>"Hangar à intercepteur","type"=>"hangar","fer"=>"60000","oro"=>"35000","cristal"=>"8000","elyrium"=>"12500","valeur"=>"5","fret"=>"9000","temps"=>"600","infra_min"=>"4","hyperespace"=>"0","hangar_infra"=>"2"),"34"=>array("id_composant"=>"34","nom"=>"Hangar à transporteur","type"=>"hangar","fer"=>"135000","oro"=>"75000","cristal"=>"20000","elyrium"=>"30000","valeur"=>"2","fret"=>"15000","temps"=>"1200","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"3"),"35"=>array("id_composant"=>"35","nom"=>"Hangar à escorteur","type"=>"hangar","fer"=>"145000","oro"=>"80000","cristal"=>"25000","elyrium"=>"32000","valeur"=>"2","fret"=>"60000","temps"=>"1400","infra_min"=>"5","hyperespace"=>"0","hangar_infra"=>"4"),"36"=>array("id_composant"=>"36","nom"=>"Hangar à navette","type"=>"hangar","fer"=>"220000","oro"=>"120000","cristal"=>"42000","elyrium"=>"40000","valeur"=>"1","fret"=>"115000","temps"=>"3000","infra_min"=>"6","hyperespace"=>"0","hangar_infra"=>"5"));
	
	
	$replacedValue 	= array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36);
	$tota_fret 		= 0;
	$tota_fer 		= 0;
	$tota_or 		= 0;
	$tota_crystal	= 0;
	$tota_elyrium 	= 0;
	$tota_valeur 	= 0;
	foreach($replacedValue as $Value){
		$result 		= $composant[$Value];
		$tota_fret 		+= $liste_composant[$Value]['fret'] * $result;
		$tota_fer 		+= $liste_composant[$Value]['fer'] * $result;
		$tota_or 		+= $liste_composant[$Value]['oro'] * $result;
		$tota_crystal	+= $liste_composant[$Value]['cristal'] * $result;
		$tota_elyrium 	+= $liste_composant[$Value]['elyrium'] * $result;
		$tota_valeur 	+= $liste_composant[$Value]['valeur'] * $result;
	}
	
	$Answer = $composant[16] + $composant[17] + $composant[18] + $composant[19] + $composant[20] + $composant[21] + $composant[22] + $composant[23] + $composant[24] + $composant[25] + $composant[26];
	if(strlen($nom) < 5 || strlen($nom) > 25){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_797']."</span>";
	}elseif(preg_match('#[^a-zA-Z0-9]#',$nom)) {
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_798']."</span>";
	}elseif(!file_exists($image) && !is_image($image)) {
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_799']."</span>";
	}elseif($composant[1] + $composant[2] + $composant[3] + $composant[4] + $composant[5] + $composant[6] + $composant[7] + $composant[8] == 0){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_800']."</span>";
	}elseif($composant[9] + $composant[10] + $composant[11] + $composant[12] == 0){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_801']."</span>";
	}elseif(!in_array($Answer, $reactorArray)){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_802']."</span>";
	}elseif($liste_infrastructure[$id_infrastructure]['fret'] < $tota_fret){
		echo "<span class='rouge'>".$LNG['NOUVEAUTE_803']."</span>";
	}else{
		echo "<span class='vert'>".$LNG['NOUVEAUTE_804']."</span>";
	}
}


function is_image($path)
{
    $img_url = $path;
	$img_formats = array("png", "jpg", "jpeg");//Etc. . . 
	$path_info = pathinfo($img_url);
	
	if (isset($path_info['extension']) && in_array(strtolower($path_info['extension']), $img_formats)) {
		return true;
	}

    return false;
}

?>