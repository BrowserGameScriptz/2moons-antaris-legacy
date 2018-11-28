<?php /*%%SmartyHeaderCode:6859878885a81f0c1a84551-10348437%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f2040252ce603e17eb19f23ad302d0c0dc4da93' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/page.overview.default.tpl',
      1 => 1508112536,
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
  'nocache_hash' => '6859878885a81f0c1a84551-10348437',
  'variables' => 
  array (
    'cronjobs' => 1,
    'cronjob' => 1,
  ),
  'has_nocache_code' => true,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a81f0c1f3cc02_71023934',
  'cache_lifetime' => 3600,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a81f0c1f3cc02_71023934')) {function content_5a81f0c1f3cc02_71023934($_smarty_tpl) {?>      <!DOCTYPE html>
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
                    <li>Control room</li>
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

<script type="text/javascript">
$(document).ready(function(){ window.setInterval(function(){ $(".fleets").each(function(){ var e=$(this).data("fleet-time")-(serverTime.getTime()-startTime)/1e3;0>=e?$(this).text("-"):$(this).text(GetRestTimeFormat(e)) }) },1e3),window.setInterval(function(){ $(".decompte_actualise").each(function(){ var e=$(this).data("time")-(serverTime.getTime()-startTime)/1e3;0==e?window.location.href="game.php?page=overview":$(this).text(GetRestTimeFormat(e)) }) },1e3) });
var fleetreturnxd		= "Do you really want to make a return of the fleet ?"
var fleetreturnxd1		= "The commander of the fleet"
var fleetreturnxd2		= "just given the order to return to the starting planet"
</script>	 

<div id="page_contenu">
                                            
<h1>Control room</h1>
<div id="salle_de_controle">
    
    <div name="couverture" data-nom_univers="horizon">
        <!-- En haut à droite : affiche deux liens vers des pages qui permettent d'aider les débutants : guide et mission -->
       <div name="aide_debutant">
            <a href="?page=achievements" onmouseover="montre('Go to student assignments');" onmouseout="cache();">Assignments for beginners</a><br />
			
            
        </div> 
 <!-- En haut à gauche : DEFCON de l'alliance du joueur -->
 
 <?php if ($_smarty_tpl->tpl_vars['GeTransportCount']->value!=0){?>
 <div name="situation_irreguliere" class="rouge">
            <span onmouseover="montre('&nbsp;<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_push_1'];?>
');" onmouseout="cache();" style="cursor : help;"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_push_2'];?>
</span>
        </div>
 <?php }elseif($_smarty_tpl->tpl_vars['userally']->value!=0){?>
        <div name="defcon_alliance" class="cyan">
            <span onmouseover='montre("&nbsp;DEFCON : <?php echo $_smarty_tpl->tpl_vars['defcontext']->value;?>
");' 
                  onmouseout="cache();" style="cursor : help;"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_36'];?>
 <b>level <?php echo $_smarty_tpl->tpl_vars['defcon']->value;?>
</b></span>
        </div>
             <?php }?> 
			 
			 
        <!-- Bandeau noir avec les informations sur le compte -->
        <div name="bandeau_noir">
            <!-- Détail du compte : pseudo, tag alliance, points, classement et progression -->
            <div name="information_joueur">
                <img name="avatar_joueur" src="styles/avatars/<?php echo $_smarty_tpl->tpl_vars['avatar']->value;?>
" />

                <div name="pseudo">
                    <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['userally']->value!=0){?><span class="couleur_alliance">

    [<?php echo $_smarty_tpl->tpl_vars['ally_tag']->value;?>
]

</span><?php }?><!--
                    -->                </div>

                <div name="statistique">
                                                            
                    General Points : <a href="javascript:SalleDeControle.toggleStatistique();" onmouseout="cache();"
                                        onmouseover="montre('Show / hide detailed statistics.');"><?php echo $_smarty_tpl->tpl_vars['totalP']->value;?>
</a> pts 
                    <div data-js="stat_progression" ><?php if ($_smarty_tpl->tpl_vars['cokies']->value=='false'){?>&mdash; 
                         <?php echo $_smarty_tpl->tpl_vars['postalP']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_18'];?>
<?php }?></span>
                                            </div><br />
                    
                    Ranking :  <?php echo $_smarty_tpl->tpl_vars['userRank']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['userTotal']->value;?>
 
                    <div data-js="stat_progression" ><?php if ($_smarty_tpl->tpl_vars['cokies']->value=='false'){?>&mdash; 
                          <?php echo $_smarty_tpl->tpl_vars['postal']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_39'];?>
<?php }?></span>
                                            </div><br />
                </div>
            </div>

            <!-- Détail de l'alliance si le joueur en possède une : nom, points et classement -->
          

<?php if ($_smarty_tpl->tpl_vars['allyID']->value==0){?>
		  <div <?php if ($_smarty_tpl->tpl_vars['cokies']->value=='false'){?> style="display: block;"<?php }else{ ?>style="display: none;"<?php }?> name="information_alliance" >
                                    <div name="sans_alliance">
                        <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_32'];?>
<br />
                        <a href="?page=alliance"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_31'];?>
</a>
                    </div>
                            </div>
							<?php }else{ ?>
							<div <?php if ($_smarty_tpl->tpl_vars['cokies']->value=='false'){?> style="display: block;"<?php }else{ ?>style="display: none;"<?php }?> name="information_alliance">
                                    
                    <div name="nom">
                        <a href="?page=alliance" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_29'];?>
');" onmouseout="cache();"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_30'];?>
 <?php echo $_smarty_tpl->tpl_vars['ally_name']->value;?>
</a>
                    </div>
                    <div name="statistique">
                        <?php echo $_smarty_tpl->tpl_vars['ally_memberss']->value;?>
<br>
                        <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_28'];?>
 : <?php echo $_smarty_tpl->tpl_vars['ally_rank']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['Total_alliance']->value;?>
 
                    </div>
                            </div>
							<?php }?>
					
							
           
            <!-- Le détails des points pour les statistiques du compte -->
            <div <?php if ($_smarty_tpl->tpl_vars['cokies']->value=='true'){?> style="display: block;"<?php }else{ ?>style="display: none;"<?php }?> name="detail_statistique" ><!--
                --><div class="element">Building :    <span class="orange"><?php echo $_smarty_tpl->tpl_vars['totalBuild']->value;?>
</span> pts</div><!--
                --><div class="element">Ships :    <span class="orange"><?php echo $_smarty_tpl->tpl_vars['totalOwnShips']->value;?>
</span> pts</div><!--
                --><div class="element">Technology : <span class="orange"><?php echo $_smarty_tpl->tpl_vars['totalResearch']->value;?>
</span> pts</div><!--
                --><div class="element">Defense :     <span class="orange"><?php echo $_smarty_tpl->tpl_vars['totalDefense']->value;?>
</span> pts</div><!--
				--><div class="element">Device :    <span class="orange"><?php echo $_smarty_tpl->tpl_vars['totalFleet']->value;?>
</span> pts</div><!--
                --><div class="element">Population :  <span class="orange"><?php echo $_smarty_tpl->tpl_vars['totalPopu']->value;?>
</span> pts</div><!--
            --></div>
			
        </div>
            
        <!-- Bandeau de « news » qui défile sous le bandeau noir ci-dessus : toute l'actualité du serveur -->
        <div name="bandeau_news" onmouseover="SalleDeControle.pauseBandeauNews();" onmouseout="SalleDeControle.reprendreBandeauNews();">
            <ul data-js="defilement">
                               
							   <li name="numero_auto_1"><a href="?page=Hln">
                                          Access this page</a> to suggest a news item in the drafting of "Horizon Live News" or click on the logo to the right</li>
								<li name="numero_auto_2">Rate of demand for trade confederation « <i>Wa'leK</i> » : 
                                          <span class="taux <?php if ($_smarty_tpl->tpl_vars['taxe_metal']->value<0){?>rouge<?php }else{ ?>vert<?php }?>"><?php if ($_smarty_tpl->tpl_vars['taxe_metal']->value>0){?>+<?php }?><?php echo $_smarty_tpl->tpl_vars['taxe_metal']->value;?>
 %</span> for iron, 
                                          <span class="taux <?php if ($_smarty_tpl->tpl_vars['taxe_crystal']->value<0){?>rouge<?php }else{ ?>vert<?php }?>"><?php if ($_smarty_tpl->tpl_vars['taxe_crystal']->value>0){?>+<?php }?><?php echo $_smarty_tpl->tpl_vars['taxe_crystal']->value;?>
 %</span> for gold,
                                          <span class="taux <?php if ($_smarty_tpl->tpl_vars['taxe_deuterium']->value<0){?>rouge<?php }else{ ?>vert<?php }?>"><?php if ($_smarty_tpl->tpl_vars['taxe_deuterium']->value>0){?>+<?php }?><?php echo $_smarty_tpl->tpl_vars['taxe_deuterium']->value;?>
 %</span> for crystal and 
                                          <span class="taux <?php if ($_smarty_tpl->tpl_vars['taxe_elyrium']->value<0){?>rouge<?php }else{ ?>vert<?php }?>"><?php if ($_smarty_tpl->tpl_vars['taxe_elyrium']->value>0){?>+<?php }?><?php echo $_smarty_tpl->tpl_vars['taxe_elyrium']->value;?>
 %</span> for elyrium</li>	
								<li name="numero_auto_3"><?php echo $_smarty_tpl->tpl_vars['journalLog']->value;?>
</li>
                             <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['AllFeeds']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
                                <li name="numero_<?php echo $_smarty_tpl->tpl_vars['i']->value['feedID'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['message'];?>
 </li><?php } ?>
                            </ul>
        </div>
            
        <!-- Nous mettons sur le logo « Live news », un lien cliquable permettant d'écrire une news -->
        <div name="logo_news" onclick="window.location.replace('?page=Hln')"
             onmouseover="montre('Write an ad on this scroll bar');" onmouseout="cache();"></div>
    </div>
     
            
    
    <?php if ($_smarty_tpl->tpl_vars['fleetCount']->value==0){?>
    
   <h2 class="titre_corps">
        <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/strategie.png" />
        <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_18'];?>

    </h2>
    <div name="liste_flotte" class="categorie_speciale">
                    <!-- Il n'y a pas de flotte de détecté dans les capteurs -->
            <div style="padding : 10px 0px;" class="vert"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_19'];?>
.</div>
            </div>
			
			<?php }else{ ?>
			
			<h2 class="titre_corps">
        <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/strategie.png" />
       <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_18'];?>

    </h2>
    <div name="liste_flotte" class="categorie_speciale">
                    <!-- Il y a au moins une flottes de détecté -->
            <div style="padding : 10px 0px;" class="rouge" id="fleetcallresponse">
                                    <?php echo $_smarty_tpl->tpl_vars['fleetCount1']->value;?>

                            </div>
            
 <?php  $_smarty_tpl->tpl_vars['fleet'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fleet']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fleets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fleet']->key => $_smarty_tpl->tpl_vars['fleet']->value){
$_smarty_tpl->tpl_vars['fleet']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['fleet']->key;
?>                           
<!-- Affichage de la flotte n°<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetID'];?>
 -->
<div name="flotte" data-id_flotte="<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetID'];?>
" data-mission="<?php echo $_smarty_tpl->tpl_vars['fleet']->value['mission'];?>
" data-statut="<?php if ($_smarty_tpl->tpl_vars['fleet']->value['fleetmes']==0){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_15'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_16'];?>
<?php }?>">
    <!-- Affiche les informations principales sur la flotte -->
    <div name="information_principale">
        <div name="mission">
            <!-- Nom de la mission ainsi que le temps restant avant l'accomplissement de celle-ci -->
            <!--<img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission.png" /> -->
            <span class="<?php if ($_smarty_tpl->tpl_vars['fleet']->value['missioncolor']==1&&$_smarty_tpl->tpl_vars['fleet']->value['fleetOwner']==$_smarty_tpl->tpl_vars['userID']->value){?>vert<?php }elseif($_smarty_tpl->tpl_vars['fleet']->value['missioncolor']==1&&$_smarty_tpl->tpl_vars['fleet']->value['fleetOwner']!=$_smarty_tpl->tpl_vars['userID']->value){?>rouge<?php }elseif($_smarty_tpl->tpl_vars['fleet']->value['missioncolor']==3){?>chartreuse<?php }elseif($_smarty_tpl->tpl_vars['fleet']->value['missioncolor']==4){?>orange<?php }elseif($_smarty_tpl->tpl_vars['fleet']->value['missioncolor']==6){?>violet<?php }elseif($_smarty_tpl->tpl_vars['fleet']->value['missioncolor']==7){?>jaune<?php }elseif($_smarty_tpl->tpl_vars['fleet']->value['missioncolor']==8){?>marron<?php }elseif($_smarty_tpl->tpl_vars['fleet']->value['missioncolor']==12){?>cyan<?php }elseif($_smarty_tpl->tpl_vars['fleet']->value['missioncolor']==17){?>orange<?php }?>"><?php echo $_smarty_tpl->tpl_vars['fleet']->value['mission'];?>
</span>
             — 
            <span id="fleettime_<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetID'];?>
" class="fleets" data-fleet-end-time="<?php echo $_smarty_tpl->tpl_vars['fleet']->value['returntime'];?>
" data-fleet-time="<?php echo $_smarty_tpl->tpl_vars['fleet']->value['resttime'];?>
"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['fleet']->value['resttime'];?>
<?php $_tmp1=ob_get_clean();?><?php echo pretty_fly_time($_tmp1);?>
</span>
					
		
                    </div><!--
        --><div name="trajet">
            <!-- Parcours que la flotte doit effectuer : nom des planètes ainsi que les pseudos des joueurs concernés -->
            <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/planete.png">
      <!-- Planète et joueur de départ -->
                <?php echo $_smarty_tpl->tpl_vars['fleet']->value['text'];?>

                    </div><!--
        --><div name="detail">
            <!-- Affiche les informations suivantes : le nombre de vaisseau et le sens du trajet : « aller » ou « retour » -->
            <span onclick="javascript:SalleDeControle.afficherInformationFlotte(<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetID'];?>
);" style="cursor : pointer;" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_695'];?>
');" onmouseout="cache();">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/info.png">
                                     
                            </span> 
                                          &nbsp;—&nbsp;<span class="<?php if ($_smarty_tpl->tpl_vars['fleet']->value['fleetmes']==0){?>cyan<?php }else{ ?>rouge<?php }?>"><?php if ($_smarty_tpl->tpl_vars['fleet']->value['fleetmes']==0){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_15'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_16'];?>
<?php }?></span>            
                           <?php if ($_smarty_tpl->tpl_vars['fleet']->value['fleetmes']==0&&$_smarty_tpl->tpl_vars['fleet']->value['fleetOwner']==$_smarty_tpl->tpl_vars['userID']->value){?>
						   <!-- Lien qui permet au joueur de demander le retour de sa flotte -->
                <a onclick="javascript:SalleDeControle.faireRetourFlotte('<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetID'];?>
')" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_4'];?>
');" onmouseout="cache();"><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/fleche_ronde.png"></a><?php }?>
                    </div>
    </div> 



	
    <!-- Affiche les informations secondaires sur la flotte -->
	<?php if ($_smarty_tpl->tpl_vars['fleet']->value['fleetOwner']==$_smarty_tpl->tpl_vars['userID']->value){?>
    <div style="display: none;" name="information_secondaire">
        
                <div class="partie">
            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_1'];?>
 :</h3>                       
            <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetMission'];?>
<br>
            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_2'];?>
 :                              <?php if ($_smarty_tpl->tpl_vars['fleet']->value['fleetmes']==0){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_15'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_16'];?>
<?php }?><br>                       
                            <!-- Lien qui permet au joueur de demander le retour de sa flotte -->
                <?php if ($_smarty_tpl->tpl_vars['fleet']->value['fleetmes']==0){?><a onclick="javascript:SalleDeControle.faireRetourFlotte('<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetID'];?>
')" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_4'];?>
');" onmouseout="cache();">&gt;&gt; <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_3'];?>
</a><?php }?><br>
                    </div>                               
                <div class="partie">
            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_5'];?>
 :</h3>       
                            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_6'];?>
 : <span class="orange"><?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetAmount'];?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>
<br>
                            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_7'];?>
 : <span class="orange">0</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>

                    </div>
                <div class="partie">
            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_8'];?>
 :</h3>
                            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_9'];?>
 <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetStart'];?>
<br>
                            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_10'];?>
 <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetStay'];?>

                            <br><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_11'];?>
 <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetEnd'];?>

                    </div>
                <div class="partie">
            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_12'];?>
 :</h3>
            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_13'];?>
 : <span class="orange">24</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>

                            <br><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_14'];?>
 : <span class="orange">24</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>

                    </div>
                <div class="partie">
            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_15'];?>
 :</h3>
            
            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_16'];?>
 : <span class="orange">600</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>
<br>
                            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_17'];?>
 <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetNameStart'];?>
 [<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetStartSys'];?>
:<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetStartPla'];?>
]<br>
                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_18'];?>
 <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetNameEnd'];?>
 [<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetEndSys'];?>
:<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetEndPla'];?>
]
                    </div>
            </div>                                                                                       
			<?php }else{ ?>
			<div style="display: none;" name="information_secondaire">
        
                <div class="partie">
            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_1'];?>
 :</h3>

            <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetMission'];?>
<br>
            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_2'];?>
 :                              <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_696'];?>
<br>
           
                    </div>
                <div class="partie">
            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_8'];?>
 :</h3>
            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_10'];?>
 <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetStay'];?>

 </div>
<div class="partie">
            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_15'];?>
 :</h3>
            
            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_16'];?>
 : <span class="orange">600</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>
<br>
                            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_17'];?>
 <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetNameStart'];?>
 [<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetStartSys'];?>
:<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetStartPla'];?>
]<br>
                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_detailflo_18'];?>
 <?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetNameEnd'];?>
 [<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetEndSys'];?>
:<?php echo $_smarty_tpl->tpl_vars['fleet']->value['fleetEndPla'];?>
]
                    </div>
            </div>

			<?php }?>
			
</div>
<?php } ?>
          </div>           
    
    <?php }?>
     <h2 class="titre_corps">
        <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/maison.png" />
        You are on the planet <?php echo $_smarty_tpl->tpl_vars['planetname']->value;?>
 [<?php echo $_smarty_tpl->tpl_vars['system']->value;?>
:<?php echo $_smarty_tpl->tpl_vars['planet']->value;?>
]
    </h2>
    <div name="planete_information" class="categorie_speciale"><!--
        <?php if ($_smarty_tpl->tpl_vars['overmessage']->value==0){?>
       --><div name="liste_construction"> 
 
                            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_14'];?>
 :</h3>
                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_13'];?>
.<br />
                
                <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_12'];?>
 :</h3>
                
<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_11'];?>

                    </div><!-- 
					<?php }else{ ?>
					--><div name="liste_construction"> 


 <!-- On indique le titre selon le type d'entité -->
 <?php if ($_smarty_tpl->tpl_vars['buildInfo']->value['buildings']){?>
                            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_453'];?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['id'];?>
.jpg" /><!--
                        --><div name="nom">
                                                            
                             <span  onmouseout="cache();" onmouseover="montre('<div style=\'min-width : 250px;\'>                <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['page_gestion_12'];?>
 - <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['id']];?>
</b> (<span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['level'];?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'> <?php  $_smarty_tpl->tpl_vars['RessAmount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RessAmount']->_loop = false;
 $_smarty_tpl->tpl_vars['RessID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['price']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RessAmount']->key => $_smarty_tpl->tpl_vars['RessAmount']->value){
$_smarty_tpl->tpl_vars['RessAmount']->_loop = true;
 $_smarty_tpl->tpl_vars['RessID']->value = $_smarty_tpl->tpl_vars['RessAmount']->key;
?><li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['RessID']->value];?>
 : <span class=\'orange\'><?php echo pretty_number($_smarty_tpl->tpl_vars['RessAmount']->value);?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>
</li> <?php } ?>         </ul>                <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_3'];?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_5'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['starttimeego'];?>
</li>        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_6'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['endtime'];?>
</li>        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_4'];?>
 : <span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['elementime'];?>
</span></li>        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_7'];?>
 : <span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['percenting'];?>
%</span></li>                            </ul></div>');" style="cursor : help;"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['id']];?>
</span>
                             (<span class="orange"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['level'];?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['timeleft'];?>
"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['buildings']['starttime'];?>
</div><!--
                    --></div>  
                         <?php }?>   


 <?php if ($_smarty_tpl->tpl_vars['buildInfo']->value['tech']){?>
                            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_454'];?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['id'];?>
.jpg" /><!--
                        --><div name="nom">
                                                            
                             <span onmouseout="cache();" onmouseover="montre('<div style=\'min-width : 250px;\'>                <b>Development - <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['buildInfo']->value['tech']['id']];?>
</b> (<span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['level'];?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'> <?php  $_smarty_tpl->tpl_vars['RessAmount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RessAmount']->_loop = false;
 $_smarty_tpl->tpl_vars['RessID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['price']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RessAmount']->key => $_smarty_tpl->tpl_vars['RessAmount']->value){
$_smarty_tpl->tpl_vars['RessAmount']->_loop = true;
 $_smarty_tpl->tpl_vars['RessID']->value = $_smarty_tpl->tpl_vars['RessAmount']->key;
?><li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['RessID']->value];?>
 : <span class=\'orange\'><?php echo pretty_number($_smarty_tpl->tpl_vars['RessAmount']->value);?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>
</li> <?php } ?>         </ul>                <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_3'];?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_5'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['starttimeego'];?>
</li>        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_6'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['endtime'];?>
</li>        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_4'];?>
 : <span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['elementime'];?>
</span></li>        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_7'];?>
 : <span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['percenting'];?>
%</span></li>                            </ul></div>');" style="cursor : help;"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['buildInfo']->value['tech']['id']];?>
</span>
                             (<span class="orange"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['level'];?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['timeleft'];?>
"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['tech']['starttime'];?>
</div><!--
                    --></div>
                         <?php }?>  						 
 <?php if ($_smarty_tpl->tpl_vars['buildInfo']->value['fleet']){?>
                            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_455'];?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['id'];?>
.gif" /><!--
                        --><div name="nom">
                                                            
                             <span onmouseover="montre('<div style=\'min-width : 250px;\'>                <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['page_gestion_12'];?>
 - <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['id']];?>
</b> (<span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['level'];?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                                <?php  $_smarty_tpl->tpl_vars['RessAmount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RessAmount']->_loop = false;
 $_smarty_tpl->tpl_vars['RessID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['price']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RessAmount']->key => $_smarty_tpl->tpl_vars['RessAmount']->value){
$_smarty_tpl->tpl_vars['RessAmount']->_loop = true;
 $_smarty_tpl->tpl_vars['RessID']->value = $_smarty_tpl->tpl_vars['RessAmount']->key;
?><li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['RessID']->value];?>
 : <span class=\'orange\'><?php echo pretty_number($_smarty_tpl->tpl_vars['RessAmount']->value*$_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['level']);?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>
</li> <?php } ?>                                            </ul>                <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_3'];?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_1'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['timelefts'];?>
</li>        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_2'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['endtime'];?>
</li>            </ul></div>');" onmouseout="cache();" style="cursor : help;"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['id']];?>
</span>
                             (<span class="orange"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['level'];?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['timeleft'];?>
"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['fleet']['starttime'];?>
</div><!--
                    --></div>
                         <?php }?>  

                  <?php if ($_smarty_tpl->tpl_vars['buildInfo']->value['defense']){?>
                            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_461'];?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['defense']['id'];?>
.gif" /><!--
                        --><div name="nom">
                                                            
                             <span onmouseover="montre('<div style=\'min-width : 250px;\'>                <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['page_gestion_12'];?>
 - <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['buildInfo']->value['defense']['id']];?>
</b> (<span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['defense']['level'];?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                                <?php  $_smarty_tpl->tpl_vars['RessAmount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RessAmount']->_loop = false;
 $_smarty_tpl->tpl_vars['RessID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['buildInfo']->value['defense']['price']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RessAmount']->key => $_smarty_tpl->tpl_vars['RessAmount']->value){
$_smarty_tpl->tpl_vars['RessAmount']->_loop = true;
 $_smarty_tpl->tpl_vars['RessID']->value = $_smarty_tpl->tpl_vars['RessAmount']->key;
?><li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['RessID']->value];?>
 : <span class=\'orange\'><?php echo pretty_number($_smarty_tpl->tpl_vars['RessAmount']->value*$_smarty_tpl->tpl_vars['buildInfo']->value['defense']['level']);?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>
</li> <?php } ?>                                            </ul>                <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_3'];?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_1'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['defense']['timelefts'];?>
</li>        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_2'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['defense']['endtime'];?>
</li>            </ul></div>');" onmouseout="cache();" style="cursor : help;"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['buildInfo']->value['defense']['id']];?>
</span>
                             (<span class="orange"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['defense']['level'];?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['defense']['timeleft'];?>
"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['defense']['starttime'];?>
</div><!--
                    --></div>
                         <?php }?>                                       
            <?php if ($_smarty_tpl->tpl_vars['buildInfo']->value['ownship']){?>
                            <h3><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_456'];?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['image'];?>
" /><!--
                        --><div name="nom">
                                                            
                             <span onmouseover="montre('<div style=\'min-width : 250px;\'>                <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['page_gestion_12'];?>
 - <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['nom'];?>
</b> (<span class=\'orange\'><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['level'];?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                                <?php  $_smarty_tpl->tpl_vars['RessAmount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RessAmount']->_loop = false;
 $_smarty_tpl->tpl_vars['RessID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['price']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RessAmount']->key => $_smarty_tpl->tpl_vars['RessAmount']->value){
$_smarty_tpl->tpl_vars['RessAmount']->_loop = true;
 $_smarty_tpl->tpl_vars['RessID']->value = $_smarty_tpl->tpl_vars['RessAmount']->key;
?><li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][$_smarty_tpl->tpl_vars['RessID']->value];?>
  : <span class=\'orange\'><?php echo pretty_number($_smarty_tpl->tpl_vars['RessAmount']->value*$_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['level']);?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_achat_units'];?>
</li> <?php } ?>                                            </ul>                <b><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_3'];?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_1'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['timelefts'];?>
</li>        <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_2'];?>
 : <?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['endtime'];?>
</li>            </ul></div>');" onmouseout="cache();" style="cursor : help;"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['nom'];?>
</span>
                             (<span class="orange"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['level'];?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['timeleft'];?>
"><?php echo $_smarty_tpl->tpl_vars['buildInfo']->value['ownship']['starttime'];?>
</div><!--
                    --></div>
                         <?php }?>
                    </div><!--
					
					<?php }?>
					

        --><div name="planete">
            <!-- Nom de la planète actuelle -->
            <span name="nom" onmouseover="montre('ls_overview_46 : <?php echo $_smarty_tpl->tpl_vars['planetname']->value;?>
');" onmouseout="cache();">
               <?php echo $_smarty_tpl->tpl_vars['planetname']->value;?>
 [<?php echo $_smarty_tpl->tpl_vars['system']->value;?>
:<?php echo $_smarty_tpl->tpl_vars['planet']->value;?>
]
            </span><br />
            
            <!-- Indique à l'utilisateur le nombre de slots restants sur cette planète -->
            <span onmouseover="montre('Your planet has a limited number of space to accommodate buildings.');" onmouseout="cache();" style="cursor : help;">
                Slots : <?php echo $_smarty_tpl->tpl_vars['planet_field_current']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['planet_field_max']->value;?>

            </span>
            
                                                            
            <p>
                <!-- Information sur le portail : activer ou désactiver -->
                Teleportation portal : 
                 
                    <span class="<?php if ($_smarty_tpl->tpl_vars['teleport_portal']->value==0){?>rouge<?php }else{ ?>vert<?php }?>"><?php if ($_smarty_tpl->tpl_vars['teleport_portal']->value==0){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_5'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_6'];?>
<?php }?></span><br />  
                                
                <!-- Information sur le champ de force du portail : activer ou désactiver -->
                Force field : 
                 
                    <span class="<?php if ($_smarty_tpl->tpl_vars['force_field']->value<$_smarty_tpl->tpl_vars['trem']->value){?>rouge<?php }else{ ?>vert<?php }?>"><?php if ($_smarty_tpl->tpl_vars['force_field']->value<$_smarty_tpl->tpl_vars['trem']->value){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_5'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_6'];?>
<?php }?></span><br />  
                            </p>
            
            <p>
                <!-- Information sur le siège des Antaris : activer ou désactiver -->
                Antaris headquarters : 
                                    <span class="<?php if ($_smarty_tpl->tpl_vars['siege_active']->value<$_smarty_tpl->tpl_vars['TIMESTM']->value){?>rouge<?php }else{ ?>vert<?php }?>"><?php if ($_smarty_tpl->tpl_vars['siege_active']->value<$_smarty_tpl->tpl_vars['TIMESTM']->value){?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_5'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_6'];?>
<?php }?></span><br />
                                
                <!-- Information sur l'avant poste des Antaris : nombre de drones -->
                Outpost : 
                <a class="orange" onmouseover="montre('Change the number of drone assigned to the defense of the planet.');" onmouseout="cache();"
                   >0</a> drones
            </p>
            
            <p>
                <!-- Lien vers la page qui permet de modifier la planète ou de l'abandonner -->
                <a href="?page=Tower" onmouseout="cache();"
                   onmouseover="montre('Change the image or the name of the planet / Abort the colony.');">Change or abandon</a>
            </p>
        </div><!--
        
    --></div>
    
    
    
    
    <?php if ($_smarty_tpl->tpl_vars['GetAll99']->value<1){?>
            <h2 class="titre_corps">
            <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/aide.png" />
            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_20'];?>

        </h2>
        
        <!-- Si le joueur ne possède que sa planète mére, on lui affiche quelques conseils et explications -->
        <div name="aide_empire" class="categorie_speciale">
          <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_1'];?>

        </div>
		
		<?php }else{ ?>
		     <h2 class="titre_corps">
            <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/globe.png" />
            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_45'];?>
 (<?php echo $_smarty_tpl->tpl_vars['GetAll99']->value;?>
)
        </h2>
       <!-- Affiche l'ensemble des planète de l'empire avec une scrollbar horizontal -->
        <div name="liste_planete" class="categorie_speciale"><!--
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['AllPlanetsBis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
                    --><div name="planete">
                <div name="illustration">
                    <!-- Image de la planète -->
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/planet/<?php echo $_smarty_tpl->tpl_vars['i']->value['planet'];?>
.jpg" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_44'];?>
');" onmouseout="cache();" 
                         onclick="location.href='game.php?page=overview&cp=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
';" />
                
                    <!-- Slots restant sur le slot total de la planète -->
                    <div name="slot" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_43'];?>
');" onmouseout="cache();" >
                        <?php echo $_smarty_tpl->tpl_vars['i']->value['field_current'];?>
 / <?php echo $_smarty_tpl->tpl_vars['i']->value['field_max'];?>

                    </div>
                </div>
                
                <!-- Nom de la planète et ressources -->
                <div name="information">
                    <a onclick="location.href='game.php?page=overview&cp=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
';" class="nom_planete"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
 [<?php echo $_smarty_tpl->tpl_vars['i']->value['system'];?>
:<?php echo $_smarty_tpl->tpl_vars['i']->value['planet'];?>
]</a><br />

                                        <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
 : <span <?php if ($_smarty_tpl->tpl_vars['i']->value['metal']>=$_smarty_tpl->tpl_vars['i']->value['metal_max']){?>class="rouge"<?php }?>><?php echo pretty_number($_smarty_tpl->tpl_vars['i']->value['metal']);?>
</span><br />
                                        <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
 : <span <?php if ($_smarty_tpl->tpl_vars['i']->value['crystal']>=$_smarty_tpl->tpl_vars['i']->value['crystal_max']){?>class="rouge"<?php }?>><?php echo pretty_number($_smarty_tpl->tpl_vars['i']->value['crystal']);?>
</span><br />
                                        <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
 : <span <?php if ($_smarty_tpl->tpl_vars['i']->value['deuterium']>=$_smarty_tpl->tpl_vars['i']->value['deuterium_max']){?>class="rouge"<?php }?>><?php echo pretty_number($_smarty_tpl->tpl_vars['i']->value['deuterium']);?>
</span><br />
										<?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
 : <span <?php if ($_smarty_tpl->tpl_vars['i']->value['elyrium']>=$_smarty_tpl->tpl_vars['i']->value['elyrium_max']){?>class="rouge"<?php }?>><?php echo pretty_number($_smarty_tpl->tpl_vars['i']->value['elyrium']);?>
</span><br />
                                       
                                    </div>
            </div><!--<?php } ?>
                        --></div>
        

		
		<?php }?> 
		 
        
</div>
        
<script type="text/javascript">
    $(document).ready(function(){
        SalleDeControle.initialiser(); 
    });
</script></div>                    <!-- Fin du corps -->
           
            
          

<?php  $_smarty_tpl->tpl_vars['cronjob'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cronjob']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cronjobs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cronjob']->key => $_smarty_tpl->tpl_vars['cronjob']->value){
$_smarty_tpl->tpl_vars['cronjob']->_loop = true;
?><img src="cronjob.php?cronjobID=<?php echo $_smarty_tpl->tpl_vars['cronjob']->value;?>
" alt=""><?php } ?>
<?php echo $_smarty_tpl->getSubTemplate ("main.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>