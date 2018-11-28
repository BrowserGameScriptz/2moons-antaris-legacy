<?php /*%%SmartyHeaderCode:7982796865a81f1003df8a1-39606332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad26210204b3546caf1f061c16a130b0b3b1530e' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/page.shipyard.default.tpl',
      1 => 1508112537,
      2 => 'file',
    ),
    '6de2a4d8cca6da78b7fc0172d50c372c8aa5fd67' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/layout.full.tpl',
      1 => 1508112532,
      2 => 'file',
    ),
    'c46468abd9cbd99f762a18f2dcfcca41798dfca5' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.header.tpl',
      1 => 1508112532,
      2 => 'file',
    ),
    'aa5b8558fe178f0114f7796b51d32a721c35d154' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.navigation.tpl',
      1 => 1508112532,
      2 => 'file',
    ),
    '03dab3926bcdb3beb74bc3f7d208b6354ab5ddcd' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.topnav.tpl',
      1 => 1508112532,
      2 => 'file',
    ),
    '36672310439c2af051a0c3a5e966401d241727df' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.footer.tpl',
      1 => 1508112532,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7982796865a81f1003df8a1-39606332',
  'variables' => 
  array (
    'cronjobs' => 1,
    'cronjob' => 1,
  ),
  'has_nocache_code' => true,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a81f100581009_08793602',
  'cache_lifetime' => 3600,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a81f100581009_08793602')) {function content_5a81f100581009_08793602($_smarty_tpl) {?>      <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <!-- Auteur(s) : Baukens Jeremy -->
    <!-- Site : Antaris Legacy -->
    <!-- Année : 2016 -->

    <!-- Debut du head -->
    <head>
        <!-- Title de la page -->
        <title><?php echo $_smarty_tpl->tpl_vars['uni_name']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['game_name']->value;?>
</title>

        <!-- Déclarations des balises meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="<?php echo $_smarty_tpl->tpl_vars['languageuser']->value;?>
" />
        <meta name="author" content="Jeremy Baukens" />
        <meta name="copyright" content="Jeremy Baukens" />
        <meta name="gameowner" content="<?php echo $_smarty_tpl->tpl_vars['admin_name']->value;?>
" />
        <meta name="gamecontact" content="<?php echo $_smarty_tpl->tpl_vars['admin_email']->value;?>
" />
        <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['meta_descrip']->value;?>
" />
        <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['meta_title']->value;?>
" />
        <meta name="Expires" content="never" />
        <meta name="rating" content="Tous public" />
        <meta name="subject" content="Antaris Legacy is a management/strategy browser game." />

        <!-- Fichier CSS et logo du site -->
        <!-- CSS utile : style_mozilla -->
       <link rel="stylesheet" media="screen" type="text/css" href="https://cdngames.antaris-legacy.eu/media/ingame/css/style_mozilla.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="https://cdngames.antaris-legacy.eu/media/ingame/css/scrollbar.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="https://cdngames.antaris-legacy.eu/media/ingame/css/alertify.core.css" />
        <link rel="shortcut icon" type="image/x-icon" href="design/image/favicon.png" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=ABeeZee|Electrolize">
		<style>
html { 
    background : #212433 url(https://cdngames.antaris-legacy.eu/theme/fond.jpg) no-repeat top fixed; 
	-webkit-background-size : cover;
	-o-background-size : cover;
	-moz-background-size : cover;
	background-size : cover;
    behavior : url(/design/pie.htc);  
}

body div#version_univers {  background-image : url(https://cdngames.antaris-legacy.eu/theme/version_univers.png); }
body div#version_beta {     background-image : url(https://cdngames.antaris-legacy.eu/theme/version_beta.png); }
body div#header { background-image : url(https://cdngames.antaris-legacy.eu/theme/header.png); }

@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
    body div#version_univers { display : none; }
    body div#version_beta { display : none; }
}
area {
display: none; }

</style>
		 <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/lang/<?php echo $_smarty_tpl->tpl_vars['languageuser']->value;?>
.js"></script>
         <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/main_compresser.min.js"></script>
		 
				<script type="text/javascript">
	var ServerTimezoneOffset = <?php echo $_smarty_tpl->tpl_vars['Offset']->value;?>
;
	var serverTime 	= new Date(<?php echo $_smarty_tpl->tpl_vars['date']->value[0];?>
, <?php echo $_smarty_tpl->tpl_vars['date']->value[1]-1;?>
, <?php echo $_smarty_tpl->tpl_vars['date']->value[2];?>
, <?php echo $_smarty_tpl->tpl_vars['date']->value[3];?>
, <?php echo $_smarty_tpl->tpl_vars['date']->value[4];?>
, <?php echo $_smarty_tpl->tpl_vars['date']->value[5];?>
);
	var startTime	= serverTime.getTime();
	var localTime 	= serverTime;
	var localTS 	= startTime;
	var Gamename	= document.title;
	var Ready		= "Ready";
	var Skin		= "<?php echo $_smarty_tpl->tpl_vars['dpath']->value;?>
";
	var Lang		= "<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
";
	var head_info	= "Info";
	var auth		= <?php echo (($tmp = @$_smarty_tpl->tpl_vars['authlevel']->value)===null||$tmp==='' ? '0' : $tmp);?>
;
	var days 		= ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"] 
	var months 		= ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"] ;
	var tdformat	= "[M] [D] [d] [H]:[i]:[s]";
	var queryString	= "<?php echo strtr($_smarty_tpl->tpl_vars['queryString']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
";
	var voterid     = <?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
;
	var aprise1		= "Yes"
	var aprise2		= "No"
	var aprise3		= "Confirm"
	var aprise4		= "Cancel"

	setInterval(function() {
		serverTime.setSeconds(serverTime.getSeconds()+1);
	}, 1000);
	
	</script>
				
	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/l18n/validationEngine/jquery.validationEngine-<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
.js"></script>
	

	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/tooltip.js"></script>
	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/base.js"></script>
	<?php  $_smarty_tpl->tpl_vars['scriptname'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['scriptname']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['scripts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['scriptname']->key => $_smarty_tpl->tpl_vars['scriptname']->value){
$_smarty_tpl->tpl_vars['scriptname']->_loop = true;
?>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/<?php echo $_smarty_tpl->tpl_vars['scriptname']->value;?>
.js"></script>
	<?php } ?>
	
	<script type="text/javascript">
	$(function() {
		<?php echo $_smarty_tpl->tpl_vars['execscript']->value;?>

	});
	</script>
   
    <!-- Fin du head -->
    </head>
 <!-- Debut du body -->
    <body>

        <div id="curseur" class="infobulle"></div>
        
        <!-- Le haut de la page : image d'Antaris Legacy -->
        <div id="header"></div>
        
        <!-- Pour afficher la version de l'univers -->
        <div id="version_univers"></div>
       
		
        
                <!-- Ensemble de la page -->
        <div id="ensemble">
            <div id="bar_navigation">
                <ul>  
                    <li>Antaris Legacy : The Game</li>
                    <li>Univers <span class="orange">Horizon</span></li>
                    <li><?php if ($_smarty_tpl->tpl_vars['mode']->value=="defense"){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_defenses'];?>
<?php }elseif($_smarty_tpl->tpl_vars['mode']->value=="orbit"){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_defenses'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_320'];?>
<?php }?></li>
                </ul>
				
				  <div class="icones">
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/bug.png" onclick="#" onmouseover="montre('Report a bug on our forum.');" onmouseout="cache();" data-nom="bug">
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/facebook.png" onclick="javascript:window.open('https://www.facebook.com/Control-Panel-890372641089987/'); return false;" onmouseover="montre('Access our facebook page');" onmouseout="cache();" data-nom="facebook">
                 
				 
                </div>
				
		
            </div>
<!-- Le menu à gauche -->
            <div id="menu">
                <h1>Command</h1>
                <ul>
                    <li><a href="?page=overview" title="To view information and manage your empire">Control room</a></li>                    <li><a href="?page=techtree" title="To view the list of unlockables">Prerequisites</a></li>                    <li><a href="?page=galaxy" title="To view a map of the galaxy">Interstellar sensors</a></li>                    <li><a href="?page=Tportal" title="For missions through the teleportation portal">Teleportation portal</a></li>                    <li><a href="?page=center" title="To train civilians and create teams">Space Center</a></li>                    <li><a href="?page=Tower" title="To manage the teleportation portal, the seat of Antaris, buildings">Tower management</a></li>                </ul>
                <h1>Development</h1>
                <ul>
                    <li><a href="?page=buildings&cmdd=build" title="To construct buildings on this planet">Buildings</a></li>                    <li><a href="?page=research" title="To develop new technologies">Technologies</a></li>                    <li><a href="?page=shipyard&mode=fleet" title="To design and build ships">Specialized devices</a></li>					<li><a href="?page=CreateShip" title="To design and build ships.">Space base</a></li>                    <li><a href="?page=defense" title="To build defenses to protect the planet">Défenses</a></li>                    <li><a href="?page=population" title="To train civilians and create teams">Populations</a></li>
                </ul>
                <h1>Player</h1>
                <ul>
                    <li><a href="?page=search" title="To search for a player a planet or alliance">Search</a> </li>                    <li><a href="?page=alliance" title="To join or create an alliance">Alliance</a> / <a href="?page=market" title="To manage your account trade">Market</a></li>                    <li><a href="?page=Bunker" title="Secure resources in a bunker">Bunker</a> / <a href="?page=Bank" title="To trade with the confederation of trade.">Bank</a></li>                    <li><a href="?page=resources" title="To view the output of the planet">Resources</a></li>					<li><a href="?page=battleSimulator" title="This module allows you to simulate your combat performed by portal.">Portal sim.</a> / <a href="?page=spaceSimulator" title="This module allows you to simulate your combat performed by space.">Space sim.</a></li>                </ul>
				<h1>Special Features</h1>
                <ul>
                    <li><a href="?page=Immunity" title="Protect your planets against hostile attacks.">Immunity</a></li>                    <li><a href="?page=Planetcloak" title="Hide your planets from the galaxy view.">Planet Cloak</a></li>                    <li><a href="?page=Lottery" title="Play lottery and win prices.">Lottery</a></li>                    <li> <a href="?page=Reward2" title="Use your redeem codes here.">Redeem code</a></li>                </ul>
                <h1>Community</h1>
                <ul>
                    <li><a id="gotit" href="?page=messages" name="messagerie" title="To read the various messages you received">Messages</a></li>                    <li><a href="?page=statistics" title="To view the statistics of the universe">Statistics</a></li>                    <li><a href="?page=settings" title="To change all your account data">Profil & settings</a></li>                    <li><a href="?page=gestion" title="To get an overview of your empire (Simplified)">Gestion</a></li>					<li><a id="gotit2" href="?page=Tchat" name="tchat" title="To chat with other players in the universe.">Common tchat</a></li>					
					<li><a href="?page=Achat" title="To buy resources and the various modes">Shop</a></li>                    <li><a href="?page=faq" title="FAQ: Help">FAQ: Help</a> / <a href="?page=ticket" title="You can ask your questions directly to the administrator using this module">Support</a></li>                    <li><a href="?page=banList" title="See the list of banned players.">Banned</a></li>                    <li><a href="?page=battleHall" title="Top hits are listed on this page.">Hall of Fame</a></li>                    <li><a data-ajax="0" href="?page=logout" title="To exit and log out of your account">Logout</a></li>
                </ul>
                <h1>Informations</h1>
                <ul>
                    <li>Horizon : <span name="charge_serveur"></span></li>
                    <li>Time : <span name="horloge" data-timestamp="<?php echo $_smarty_tpl->tpl_vars['timestamp']->value;?>
"></span></li>
                    <li><span name="nb_connecte" style="font-weight : bold;"></span> connected(s)</li>
                </ul>
            </div>          <!-- Le corps de la page -->
            <div id="corps">
              
        <div id="ressource_contenu"><!-- On affiche le titre pour les ressources -->
<h1>Your resources</h1>


<div class="selection_planete">
     <select id="select_custom">
	 
	 <?php  $_smarty_tpl->tpl_vars['x'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['x']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AllPlanetsBis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['x']->key => $_smarty_tpl->tpl_vars['x']->value){
$_smarty_tpl->tpl_vars['x']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['x']->value['id'];?>
" data-imagesrc="https://cdngames.antaris-legacy.eu/media/ingame/planet/<?php echo $_smarty_tpl->tpl_vars['x']->value['image'];?>
.jpg" <?php if ($_smarty_tpl->tpl_vars['current_pid']->value==$_smarty_tpl->tpl_vars['x']->value['id']){?>selected="selected"<?php }?>                data-description="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_448'];?>
 : <span class='<?php if ($_smarty_tpl->tpl_vars['x']->value['teleport_portal']==0){?>rouge<?php }else{ ?>vert<?php }?>'><?php if ($_smarty_tpl->tpl_vars['x']->value['teleport_portal']==0){?>OFF<?php }else{ ?>ON<?php }?></span> - <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_449'];?>
 : <span class='<?php if ($_smarty_tpl->tpl_vars['x']->value['force_field_timer']>$_smarty_tpl->tpl_vars['timestamp']->value){?>vert<?php }else{ ?>rouge<?php }?>'><?php if ($_smarty_tpl->tpl_vars['x']->value['force_field_timer']>$_smarty_tpl->tpl_vars['timestamp']->value){?>ON<?php }else{ ?>OFF<?php }?></span> - <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_450'];?>
 : <span class='<?php if ($_smarty_tpl->tpl_vars['x']->value['siege_on']<$_smarty_tpl->tpl_vars['timestamp']->value){?>rouge<?php }else{ ?>vert<?php }?>'><?php if ($_smarty_tpl->tpl_vars['x']->value['siege_on']<$_smarty_tpl->tpl_vars['timestamp']->value){?>OFF<?php }else{ ?>ON<?php }?></span>">
                [<?php echo $_smarty_tpl->tpl_vars['x']->value['system'];?>
:<?php echo $_smarty_tpl->tpl_vars['x']->value['planet'];?>
] <?php echo $_smarty_tpl->tpl_vars['x']->value['name'];?>
</option>
				
			<?php } ?>	

            </select>
</div>


 <!-- Pour afficher l'énergie sur la planète toute à droite -->

<?php  $_smarty_tpl->tpl_vars['resouceData'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resouceData']->_loop = false;
 $_smarty_tpl->tpl_vars['resourceID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['resourceTable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resouceData']->key => $_smarty_tpl->tpl_vars['resouceData']->value){
$_smarty_tpl->tpl_vars['resouceData']->_loop = true;
 $_smarty_tpl->tpl_vars['resourceID']->value = $_smarty_tpl->tpl_vars['resouceData']->key;
?>
<?php if (!isset($_smarty_tpl->tpl_vars['resouceData']->value['current'])){?>
<?php $_smarty_tpl->createLocalArrayVariable('resouceData', true, 0);
$_smarty_tpl->tpl_vars['resouceData']->value['current'] = $_smarty_tpl->tpl_vars['resouceData']->value['max']+$_smarty_tpl->tpl_vars['resouceData']->value['used'];?>
<div class="darkmatter" onmouseover="montre(' <div style=\'padding : 2px 8px; min-width : 170px;\'>                                              <b>  <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['resourceID']->value];?>
 <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_6'];?>
 :</b><br />                                              — <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_5'];?>
 : <span class=\'orange\'><?php echo pretty_number($_smarty_tpl->tpl_vars['resouceData']->value['max']);?>
</span><br />                                                                                      </div>');" onmouseout="cache();">
   <?php if ($_smarty_tpl->tpl_vars['resouceData']->value['current']>999999999999){?><?php echo shortly_number($_smarty_tpl->tpl_vars['resouceData']->value['current']);?>
<?php }else{ ?><?php echo pretty_number($_smarty_tpl->tpl_vars['resouceData']->value['current']);?>
<?php }?>
</div>

<?php }else{ ?>
	<?php }?>
									<?php } ?>

<!-- Permet d'afficher les ressources -->
<div class="conteneur_ressource">


<?php  $_smarty_tpl->tpl_vars['resouceData'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resouceData']->_loop = false;
 $_smarty_tpl->tpl_vars['resourceID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['resourceTable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resouceData']->key => $_smarty_tpl->tpl_vars['resouceData']->value){
$_smarty_tpl->tpl_vars['resouceData']->_loop = true;
 $_smarty_tpl->tpl_vars['resourceID']->value = $_smarty_tpl->tpl_vars['resouceData']->key;
?>
<?php if (!isset($_smarty_tpl->tpl_vars['resouceData']->value['current'])){?>
<?php $_smarty_tpl->createLocalArrayVariable('resouceData', true, 0);
$_smarty_tpl->tpl_vars['resouceData']->value['current'] = $_smarty_tpl->tpl_vars['resouceData']->value['max']+$_smarty_tpl->tpl_vars['resouceData']->value['used'];?>
<?php }else{ ?>
    <!-- Le fer -->
    <div class="item_ressource <?php echo $_smarty_tpl->tpl_vars['resouceData']->value['name'];?>
" id="current_<?php echo $_smarty_tpl->tpl_vars['resouceData']->value['name'];?>
"  name="<?php echo $_smarty_tpl->tpl_vars['resouceData']->value['current'];?>
" onmouseover="montre(' <div style=\'padding : 2px 8px; min-width : 170px;\'>                                                      <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_4'];?>
 <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['resourceID']->value];?>
 :</b><br />                                                    — <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_846'];?>
 : <span class=\'orange\'><?php echo pretty_number($_smarty_tpl->tpl_vars['resouceData']->value['current']);?>
</span> u.<br />  — <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_1'];?>
 : <span class=\'orange\'><?php echo pretty_number($_smarty_tpl->tpl_vars['resouceData']->value['bunker']);?>
</span> u.<br />                                                      — <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_2'];?>
 : <span class=\'orange\'><?php echo pretty_number($_smarty_tpl->tpl_vars['resouceData']->value['max']);?>
</span> u.<br />                                                      — <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_3'];?>
 : <span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['resouceData']->value['percent'];?>
</span>%                                                  </div>');" onmouseout="cache();">
        <?php if ($_smarty_tpl->tpl_vars['resouceData']->value['current']>=$_smarty_tpl->tpl_vars['resouceData']->value['max']){?><span class="rouge"><?php echo pretty_number($_smarty_tpl->tpl_vars['resouceData']->value['current']);?>
</span><?php }else{ ?><?php echo pretty_number($_smarty_tpl->tpl_vars['resouceData']->value['current']);?>
<?php }?>
    </div>
	<?php }?>
									<?php } ?>

	
	
	
    <div class="espace"></div>
</div>
<div class="espace"></div>
<!-- On appel le javascript nécessaire pour customizer le select pour les planètes -->
<script type="text/javascript">$('select#select_custom').ddslick({ width : 220 });</script>
<?php if (!$_smarty_tpl->tpl_vars['vmode']->value){?>
		<script type="text/javascript">
		var viewShortlyNumber	= <?php echo json_encode($_smarty_tpl->tpl_vars['shortlyNumber']->value);?>
;
		var vacation			= <?php echo $_smarty_tpl->tpl_vars['vmode']->value;?>
;
		<?php  $_smarty_tpl->tpl_vars['resouceData'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resouceData']->_loop = false;
 $_smarty_tpl->tpl_vars['resourceID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['resourceTable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resouceData']->key => $_smarty_tpl->tpl_vars['resouceData']->value){
$_smarty_tpl->tpl_vars['resouceData']->_loop = true;
 $_smarty_tpl->tpl_vars['resourceID']->value = $_smarty_tpl->tpl_vars['resouceData']->key;
?>
		<?php if (isset($_smarty_tpl->tpl_vars['resouceData']->value['production'])){?>
		resourceTicker({
			available: <?php echo json_encode($_smarty_tpl->tpl_vars['resouceData']->value['current']);?>
,
			limit: [0, <?php echo json_encode($_smarty_tpl->tpl_vars['resouceData']->value['max']);?>
],
			production: <?php echo json_encode($_smarty_tpl->tpl_vars['resouceData']->value['production']);?>
,
			valueElem: "current_<?php echo $_smarty_tpl->tpl_vars['resouceData']->value['name'];?>
"
		}, true);
		<?php }?>
		<?php } ?>
		</script>
		<?php }?></div>
<div id="page_contenu">	

<?php if ($_smarty_tpl->tpl_vars['inmode']->value==1){?>
<h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_320'];?>
</h1><div class="onglet">	<ul>		
<li><a onclick="location.href='game.php?page=shipyard&mode=fleet';" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_312'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_316'];?>
</a></li>		
<li><a onclick="location.href='game.php?page=shipyard&mode=recy';" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_313'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_317'];?>
</a></li>	
	
<li><a onclick="location.href='game.php?page=shipyard&mode=energy';" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_315'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_319'];?>
</a></li>	
</ul>
</div>
<?php }else{ ?>
<h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_328'];?>
</h1><div class="onglet">	<ul>		
<li><a onclick="location.href='game.php?page=defense&mode=defense';" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_329'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_331'];?>
</a></li>				
<li><a onclick="location.href='game.php?page=defense&mode=orbit';" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_330'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_332'];?>
</a></li>	
</ul>
</div>
<?php }?>


<h2 class="titre_corps"><?php if ($_smarty_tpl->tpl_vars['mode']->value=="defense"){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_333'];?>
<?php }elseif($_smarty_tpl->tpl_vars['mode']->value=="orbit"){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_333'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_321'];?>
<?php }?></h2>


<?php if (!empty($_smarty_tpl->tpl_vars['BuildList']->value)){?>
<table style="width:760px">
	<tr>
		<td class="transparent">
			
			<form action="#" method="post">
			<input type="hidden" name="action" value="delete">
			<table>
			
			<tr>
				<td><select width="300" style="width: 695px" name="auftr[]" id="auftr" size="3" multiple><option>&nbsp;</option></select></td>
			</tr>
			
			</table>
			</form>
			
		</td>
	</tr>
</table>
<br>
<?php }else{ ?>
<div id="div_liste_construction" class="centre"><i><?php if ($_smarty_tpl->tpl_vars['mode']->value=="defense"){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_334'];?>
<?php }elseif($_smarty_tpl->tpl_vars['mode']->value=="orbit"){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_334'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_322'];?>
<?php }?></i></div>
<?php }?>








<div id="div_liste_appareil" class="centre"><h2 class="titre_corps"></h2><!-- On débute l'item appareil -->

<?php  $_smarty_tpl->tpl_vars['Element'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Element']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['elementList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Element']->key => $_smarty_tpl->tpl_vars['Element']->value){
$_smarty_tpl->tpl_vars['Element']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['Element']->key;
?>
<?php if ($_smarty_tpl->tpl_vars['mode']->value=="fleet"){?><form action="game.php?page=shipyard&amp;mode=<?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
" method="post"><?php }elseif($_smarty_tpl->tpl_vars['mode']->value=="recy"){?><form action="game.php?page=shipyard&amp;mode=<?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
" method="post"><?php }elseif($_smarty_tpl->tpl_vars['mode']->value=="energy"){?><form action="game.php?page=shipyard&amp;mode=<?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
" method="post"><?php }else{ ?><form action="game.php?page=defense" method="post"><?php }?>
<div class="item grand">
    <!-- On affiche le nom de l'appareil dans un lien qui redirige vers la description de celui-ci -->
    <div class="titre">
        <a onclick="location.href='game.php?page=information&id=<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
';" 
           class="titre_contour"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['ID']->value];?>
</a>
    </div>
    
    <!-- Pour afficher l'image avec une information bulle quand on survole qui permet de connaître le prix et la description de l'appareil -->
    <div class="image">
        <img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
.gif" alt="Picture of : <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['ID']->value];?>
" 
             onmouseover="montre('<!-- Les informations sur l\'appareil : prix et description --><div class=\'description_bulle\'>    <!-- On affiche le nom de l\'appareil -->    <h2><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['ID']->value];?>
 (<span class=\'blanc\'><?php echo pretty_number($_smarty_tpl->tpl_vars['Element']->value['available']);?>
</span>)</h2>    <table>        <tr>            <td colspan=\'2\'><h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_324'];?>
 :</h3></td>            <td><h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_285'];?>
 :</h3></td>        </tr>        <tr>            <!-- On affiche le prix en ressource, les caractèristiques ainsi que le temps de construction -->            <td> <?php  $_smarty_tpl->tpl_vars['RessAmount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RessAmount']->_loop = false;
 $_smarty_tpl->tpl_vars['RessID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Element']->value['costRessources']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RessAmount']->key => $_smarty_tpl->tpl_vars['RessAmount']->value){
$_smarty_tpl->tpl_vars['RessAmount']->_loop = true;
 $_smarty_tpl->tpl_vars['RessID']->value = $_smarty_tpl->tpl_vars['RessAmount']->key;
?>               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['RessID']->value];?>
 :<br />    <?php } ?>                                       <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_323'];?>
 :<br /><br />                                                                                                         </td>            <td>              <?php  $_smarty_tpl->tpl_vars['RessAmount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RessAmount']->_loop = false;
 $_smarty_tpl->tpl_vars['RessID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Element']->value['costRessources']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RessAmount']->key => $_smarty_tpl->tpl_vars['RessAmount']->value){
$_smarty_tpl->tpl_vars['RessAmount']->_loop = true;
 $_smarty_tpl->tpl_vars['RessID']->value = $_smarty_tpl->tpl_vars['RessAmount']->key;
?>   <span class=\'<?php if ($_smarty_tpl->tpl_vars['Element']->value['costOverflow'][$_smarty_tpl->tpl_vars['RessID']->value]==0){?>vert<?php }else{ ?>rouge<?php }?>\'><?php echo pretty_number($_smarty_tpl->tpl_vars['RessAmount']->value);?>
</span><br />  <?php } ?>                                           <?php if ($_smarty_tpl->tpl_vars['Element']->value['UnitsSecond']==0){?><?php echo pretty_time($_smarty_tpl->tpl_vars['Element']->value['elementTime']);?>
<?php }else{ ?><?php echo pretty_number($_smarty_tpl->tpl_vars['Element']->value['UnitsSecond']);?>
 u/s<?php }?><br /><br />                                                                                                       </td>                        <!-- On affiche la description de l\'appareil -->            <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['shortDescription'][$_smarty_tpl->tpl_vars['ID']->value];?>
</td>        </tr>        <tr>            <td colspan=\'3\' class=\'gris\' style=\'padding-top : 10px; text-align : center;\'>                <?php echo $_smarty_tpl->tpl_vars['Element']->value['maxBuildableS'];?>
            </td>        </tr>    </table><div>');" onmouseout="cache();" />
    </div>
    
    <!-- Permet de savoir si l'appareil est constructible -->
   


   <div class="action">
     <?php if (!$_smarty_tpl->tpl_vars['Element']->value['techacc']){?>
	
			   
		
			   <span class="rouge" onmouseover="montre('<b><?php if ($_smarty_tpl->tpl_vars['mode']->value=="defense"){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_335'];?>
<?php }elseif($_smarty_tpl->tpl_vars['mode']->value=="orbit"){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_335'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_326'];?>
<?php }?> :</b><div style=\'padding : 3px 0px 0px 15px;\'><?php  $_smarty_tpl->tpl_vars['requireList'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['requireList']->_loop = false;
 $_smarty_tpl->tpl_vars['elementID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['Element']->value['AllTech']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['requireList']->key => $_smarty_tpl->tpl_vars['requireList']->value){
$_smarty_tpl->tpl_vars['requireList']->_loop = true;
 $_smarty_tpl->tpl_vars['elementID']->value = $_smarty_tpl->tpl_vars['requireList']->key;
?><?php  $_smarty_tpl->tpl_vars['NeedLevel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['NeedLevel']->_loop = false;
 $_smarty_tpl->tpl_vars['requireID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['requireList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['NeedLevel']->key => $_smarty_tpl->tpl_vars['NeedLevel']->value){
$_smarty_tpl->tpl_vars['NeedLevel']->_loop = true;
 $_smarty_tpl->tpl_vars['requireID']->value = $_smarty_tpl->tpl_vars['NeedLevel']->key;
?><?php if ($_smarty_tpl->tpl_vars['NeedLevel']->value['count']>$_smarty_tpl->tpl_vars['NeedLevel']->value['own']){?><span class=\'rouge\'><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['requireID']->value];?>
, <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_311'];?>
 <?php echo $_smarty_tpl->tpl_vars['NeedLevel']->value['count'];?>
 <i>(<?php echo $_smarty_tpl->tpl_vars['NeedLevel']->value['own'];?>
)</i></span><br /><?php }?><?php } ?><?php } ?></div>');" onmouseout="cache();" style="cursor : help;"><b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_287'];?>
</b></span>
		
		 
		
		
		
   <?php }elseif($_smarty_tpl->tpl_vars['Element']->value['AlreadyBuild']){?>
                    <span class="rouge" style="cursor : help;"><b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_287'];?>
</b></span>
					
			 <?php }elseif(!$_smarty_tpl->tpl_vars['Element']->value['buyable']){?>
                    <span class="orange" style="cursor : help;"><b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_309'];?>
</b></span>		
					
					
        	<?php }elseif($_smarty_tpl->tpl_vars['NotBuilding']->value&&$_smarty_tpl->tpl_vars['Element']->value['buyable']){?>
					
					 
                <input class="entier" size="<?php echo $_smarty_tpl->tpl_vars['maxlength']->value;?>
" maxlength="<?php echo $_smarty_tpl->tpl_vars['maxlength']->value;?>
" id="input_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" name="fmenge[<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
]" value="0" type="text" tabindex="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['FleetList']['iteration'];?>
">
                <input value="Max." type="button" onclick="$('#input_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
').val('<?php echo $_smarty_tpl->tpl_vars['Element']->value['maxBuildable'];?>
')">
				
				
				
				
					
					
					<?php }?>
    </div>
	
	
	
	
    
    <!-- On affiche le nomdre d'unité pour cet appareil dans un degradé noir -->
    <div class="nombre"><?php echo pretty_number($_smarty_tpl->tpl_vars['Element']->value['available']);?>
 <span style="font-size:0.84em;font-weight:normal;"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>
</span></div>
</div>
</form>
<?php } ?>
<div class="espace"></div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
			

<script type="text/javascript">
data			= <?php echo json_encode($_smarty_tpl->tpl_vars['BuildList']->value);?>
;
bd_operating	= '(In construction)';
bd_available	= 'Available: ';
</script>

<?php  $_smarty_tpl->tpl_vars['cronjob'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cronjob']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cronjobs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cronjob']->key => $_smarty_tpl->tpl_vars['cronjob']->value){
$_smarty_tpl->tpl_vars['cronjob']->_loop = true;
?><img src="cronjob.php?cronjobID=<?php echo $_smarty_tpl->tpl_vars['cronjob']->value;?>
" alt=""><?php } ?>
<?php echo $_smarty_tpl->getSubTemplate ("main.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>