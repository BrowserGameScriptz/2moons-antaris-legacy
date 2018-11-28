<?php /*%%SmartyHeaderCode:14145338265a81f0f73ceda0-83953956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e93b74d1a314876eeba2cf3d14c655c92534dd8' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/page.createship.default.tpl',
      1 => 1508112535,
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
  'nocache_hash' => '14145338265a81f0f73ceda0-83953956',
  'variables' => 
  array (
    'cronjobs' => 1,
    'cronjob' => 1,
  ),
  'has_nocache_code' => true,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a81f0f7689172_34917920',
  'cache_lifetime' => 3600,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a81f0f7689172_34917920')) {function content_5a81f0f7689172_34917920($_smarty_tpl) {?>      <!DOCTYPE html>
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
                    <li>Space base</li>
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
<div id="page_contenu">      <h1>Space base</h1><div class="onglet">
              <ul>
                  <li><a href="?page=CreateShip&mode=ships" title="See a list of your personal vessels">List your ships</a></li> 
                  <li><a href="?page=CreateShip" title="Create new vessel model">Create a new template</a></li> 
                  <li><a href="?page=CreateShip&mode=pieces" title="View the details of each infrastructure/component available">List of pieces</a></li> 
                  <li><a href="?page=CreateShip&mode=flotte" title="Manage your predefined fleets">Fleet management</a></li>
              </ul>
          </div>
          <div id="div_vaisseau">
<?php if (empty($_smarty_tpl->tpl_vars['Message']->value)){?>
		  <script type="text/javascript">
    $(document).ready(function(){ 
        VaisseauCreation.initialiser(); 
    });
</script>
<?php }?>
<!-- Le message de chargement pour attendre que l'on charge les composants et les infrastructures en JSON -->


<!-- Le formulaire de création de modèle -->
<form style="display: block;" id="form_creation_vaisseau" method="post" action="game.php?page=CreateShip">
    <!-- Sous-titre : Créer un nouveau modèle -->
	
    <h2 class="titre_corps">Create new vessel model</h2>
    <div class="previsualiser">
        <!-- Pour afficher l'image du modèle que l'on créé -->
        <img name="image_modele" src="https://cdngames.antaris-legacy.eu/design/image/defaut_vaisseau.jpg">
        <img name="image_calque" src="https://cdngames.antaris-legacy.eu/design/image/item_description_img.png">
        
        <!-- Tableau contenant tous les caractéristiques du modèle -->
        <table>
            <tbody><tr>
                <td colspan="6" name="nom" class="gris">
                    <span name="nom_modele">...</span>
                    [<span name="nom_infrastructrure">Chasseur</span> 
                      — Siège : <span name="siege_antaris"><span class="rouge">non</span></span> 
                      — Téléportation : <span name="systeme_teleportation"><span class="rouge">non</span></span>
                      — Hyperespace : <span name="hyperespace"><span class="rouge">non</span></span>]
                </td>
            </tr> 
            <tr>
                <td>Iron :</td>
                <td name="fer">500</td>
                <td>Attack :</td>
                <td name="attaque">0</td>
                <td>Speed :</td>
                <td name="vitesse">0%</td>
            </tr>
            <tr>
                <td>Gold :</td>
                <td name="or">250</td>
                <td>Shield :</td>
                <td name="bouclier">0</td>
                <td>Maneuver :</td>
                <td name="maniabilite">100%</td>
                
            </tr>
            <tr>
                <td>Crystal :</td>
                <td name="cristal">100</td>
                <td>Shell :</td>
                <td name="coque">0</td>
                <td>Time :</td>
                <td name="temps">2m 0s</td>
            </tr>
            <tr>
                <td>Elyrium : </td>
                <td name="elyrium">50</td>
                <td>Capacity :</td>
                <td name="fret">200</td>
                <td>Launcher :</td>
                <td name="drone">0 drones</td>
            </tr>
        </tbody></table>
        <div class="espace"></div>
    </div>
<?php if (empty($_smarty_tpl->tpl_vars['Message']->value)){?>
    <!-- On affiche tous les sous-onglet pour les composants de divers type -->
    <div class="onglet">
        <ul>
            <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('description');" title=""><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_285'];?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('attaque');" title=""><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_423'];?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('bouclier');" title=""><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_424'];?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('coque');" title=""><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_425'];?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('drone');" title=""><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_426'];?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('hangar');" title=""><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_427'];?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('vitesse');" title=""><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_428'];?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('autre');" title=""><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_429'];?>
</a></li>
                    </ul>
    </div>
<?php }?>
    <!-- Sous partie : indiquer le nom du modèle / choisir l'infrastructure et image -->
    <div name="sous_onglet_description" class="sous_onglet">
        <!-- Le titre de cet sous-onglet -->
		<?php if (empty($_smarty_tpl->tpl_vars['Message']->value)){?>
        <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_430'];?>
</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table name="description">
                <!-- Le nom du modèle -->
                <tbody><tr>
                    <td>
                        <label for="nom"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_431'];?>
 :</label>
                        — <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_432'];?>

                    </td>
                    <td><input onchange="javascript:VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.previsualiser();" name="nom" id="nom" type="text"></td>
                </tr>

                <!-- Le lien vers l'image -->
                <tr>
                    <td>
                        <label for="image"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_433'];?>
 :</label>
                        — <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_434'];?>

                    </td>
                    <td>
                        <input name="image" id="image" onchange="javascript:VaisseauCreation.changerImage(); VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.changerImage(); VaisseauCreation.previsualiser();" type="text">
                        <a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('liste_image');" title=""><img src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/couleur/image.png"></a>
                    </td>
                </tr>

                <!-- L'infrastructure du modèle -->
                <tr>
                    <td>
                        <label for="id_infrastructure"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_435'];?>
 :</label>
                        — <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_436'];?>

                    </td>
                    <td>
                      <select name="id_infrastructure" id="id_infrastructure" onchange="VaisseauCreation.selectionnerInfrastructure();">
                                                            <option value="1"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['INFRASTRUCTURE'][1];?>
</option>
                                                            <option value="2"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['INFRASTRUCTURE'][2];?>
</option>
                                                            <option value="3"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['INFRASTRUCTURE'][3];?>
</option>
                                                            <option value="4"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['INFRASTRUCTURE'][4];?>
</option>
                                                            <option value="5"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['INFRASTRUCTURE'][5];?>
</option>
                                                            <option value="6"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['INFRASTRUCTURE'][6];?>
</option>
                                                            <option value="7"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['INFRASTRUCTURE'][7];?>
</option>
                                                            <option value="8"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['INFRASTRUCTURE'][8];?>
</option>
                                                            <option value="9"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['INFRASTRUCTURE'][9];?>
</option>
                                                    </select>
                    </td>
                </tr>
            </tbody></table>
        </div><?php }?> 
    </div>
                       
    <!-- Sous partie : liste de toutes les images de modèle que l'on propose aux joueurs -->
    <div name="sous_onglet_liste_image" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">List of images available for your model</h2>
        
        <i>Please click on the image you want for your model.</i>
        <div class="conteneur">
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/1.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/1.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/2.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/2.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/3.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/3.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/4.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/4.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/5.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/5.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/6.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/6.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/7.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/7.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/8.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/8.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/9.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/9.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/10.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/10.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/11.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/11.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/12.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/12.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/13.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/13.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/14.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/14.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/15.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/15.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/16.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/16.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/17.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/17.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/18.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/18.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/19.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/19.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/20.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/20.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/21.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/21.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/22.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/22.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/23.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/23.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/24.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/24.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/25.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/25.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/26.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/26.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/27.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/27.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/28.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/28.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/29.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/29.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/30.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/30.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/31.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/31.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/32.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/32.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/33.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/33.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/34.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/34.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/35.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/35.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/36.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/36.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/37.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/37.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/38.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/38.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/39.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/39.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/40.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/40.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/41.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/41.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/42.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/42.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/43.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/43.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/44.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/44.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/45.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/45.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/46.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/46.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/47.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/47.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/48.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/48.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/49.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/49.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/50.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/50.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/51.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/51.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/52.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/52.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/53.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/53.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/54.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/54.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/55.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/55.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/56.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/56.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/57.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/57.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/58.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/58.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/59.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/59.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/60.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/60.jpg');" onmouseover="montre('Select this image for your model.');" onmouseout="cache();">
                </div>
                        <div class="espace"></div>
        </div>
    </div>

            
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_attaque" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">Components list « Arms »</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                      <tbody><tr>
                        <td>
                            <label for="composant_1">
                                                               Fire station
                                :
                            </label>
                            <div class="unite"><span class="orange">100</span> Iron</div>
                            <div class="unite"><span class="orange">50</span> Gold</div>
                            <div class="unite"><span class="orange">20</span> Crystal</div>
                            <div class="unite"><span class="orange">0</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_1', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_1', 'onkeyup');" class="composant entier" id="composant_1" name="composant_1" data-id_composant="1" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">10</span>                             d'attaque<br>
                            <span class="rouge">2</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_2">
                                                               Ion cannon 
                                  :
                            </label>
                            <div class="unite"><span class="orange">500</span> Iron</div>
                            <div class="unite"><span class="orange">200</span> Gold</div>
                            <div class="unite"><span class="orange">100</span> Crystal</div>
                            <div class="unite"><span class="orange">0</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_2', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_2', 'onkeyup');" class="composant entier" id="composant_2" name="composant_2" data-id_composant="2" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">80</span>                             d'attaque<br>
                            <span class="rouge">5</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_3">
                                                               IEM Missile
                                :
                            </label>
                            <div class="unite"><span class="orange">1 000</span> Iron</div>
                            <div class="unite"><span class="orange">500</span> Gold</div>
                            <div class="unite"><span class="orange">250</span> Crystal</div>
                            <div class="unite"><span class="orange">50</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_3', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_3', 'onkeyup');" class="composant entier" id="composant_3" name="composant_3" data-id_composant="3" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">250</span>                             d'attaque<br>
                            <span class="rouge">10</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_4">
                                                               Plasma cannon
                                :
                            </label>
                            <div class="unite"><span class="orange">1 500</span> Iron</div>
                            <div class="unite"><span class="orange">1 000</span> Gold</div>
                            <div class="unite"><span class="orange">400</span> Crystal</div>
                            <div class="unite"><span class="orange">150</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_4', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_4', 'onkeyup');" class="composant entier" id="composant_4" name="composant_4" data-id_composant="4" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="4">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">600</span>                             d'attaque<br>
                            <span class="rouge">20</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_5">
                                                               Plasma beam
                                :
                            </label>
                            <div class="unite"><span class="orange">4 000</span> Iron</div>
                            <div class="unite"><span class="orange">2 500</span> Gold</div>
                            <div class="unite"><span class="orange">1 000</span> Crystal</div>
                            <div class="unite"><span class="orange">250</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_5', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_5', 'onkeyup');" class="composant entier" id="composant_5" name="composant_5" data-id_composant="5" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="5">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">2 000</span>                             d'attaque<br>
                            <span class="rouge">50</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_6">
                                                               Disruptor
                                :
                            </label>
                            <div class="unite"><span class="orange">10 000</span> Iron</div>
                            <div class="unite"><span class="orange">6 000</span> Gold</div>
                            <div class="unite"><span class="orange">2 500</span> Crystal</div>
                            <div class="unite"><span class="orange">400</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_6', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_6', 'onkeyup');" class="composant entier" id="composant_6" name="composant_6" data-id_composant="6" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="6">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">7 500</span>                             d'attaque<br>
                            <span class="rouge">100</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_7">
                                                               Canon of Antaris
                                :
                            </label>
                            <div class="unite"><span class="orange">25 000</span> Iron</div>
                            <div class="unite"><span class="orange">15 000</span> Gold</div>
                            <div class="unite"><span class="orange">8 000</span> Crystal</div>
                            <div class="unite"><span class="orange">1 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_7', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_7', 'onkeyup');" class="composant entier" id="composant_7" name="composant_7" data-id_composant="7" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="7">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">25 000</span>                             d'attaque<br>
                            <span class="rouge">200</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_8">
                                                                Antaris beam
                                :
                            </label>
                            <div class="unite"><span class="orange">35 000</span> Iron</div>
                            <div class="unite"><span class="orange">22 500</span> Gold</div>
                            <div class="unite"><span class="orange">12 500</span> Crystal</div>
                            <div class="unite"><span class="orange">1 500</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_8', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_8', 'onkeyup');" class="composant entier" id="composant_8" name="composant_8" data-id_composant="8" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="8">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">47 500</span>                             d'attaque<br>
                            <span class="rouge">400</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_bouclier" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">Components list « Shields »</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <tbody><tr>
                        <td>
                            <label for="composant_13">
                                                                Small shield
                                :
                            </label>
                            <div class="unite"><span class="orange">250</span> Iron</div>
                            <div class="unite"><span class="orange">100</span> Gold</div>
                            <div class="unite"><span class="orange">175</span> Crystal</div>
                            <div class="unite"><span class="orange">25</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_13', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_13', 'onkeyup');" class="composant entier" id="composant_13" name="composant_13" data-id_composant="13" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">65</span>                             de bouclier<br>
                            <span class="rouge">4</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_14">
                                                                Big shield
                                :
                            </label>
                            <div class="unite"><span class="orange">400</span> Iron</div>
                            <div class="unite"><span class="orange">200</span> Gold</div>
                            <div class="unite"><span class="orange">425</span> Crystal</div>
                            <div class="unite"><span class="orange">100</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_14', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_14', 'onkeyup');" class="composant entier" id="composant_14" name="composant_14" data-id_composant="14" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="14">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">350</span>                             de bouclier<br>
                            <span class="rouge">8</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_15">
                                                                Antaris shield
                                :
                            </label>
                            <div class="unite"><span class="orange">1 000</span> Iron</div>
                            <div class="unite"><span class="orange">650</span> Gold</div>
                            <div class="unite"><span class="orange">950</span> Crystal</div>
                            <div class="unite"><span class="orange">250</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_15', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_15', 'onkeyup');" class="composant entier" id="composant_15" name="composant_15" data-id_composant="15" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="15">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1 200</span>                             de bouclier<br>
                            <span class="rouge">14</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_coque" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">Components list « Shells »</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                      <tbody><tr>
                        <td>
                            <label for="composant_9">
                                                               Small density hull 
                                :
                            </label>
                            <div class="unite"><span class="orange">250</span> Iron</div>
                            <div class="unite"><span class="orange">100</span> Gold</div>
                            <div class="unite"><span class="orange">10</span> Crystal</div>
                            <div class="unite"><span class="orange">20</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_9', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_9', 'onkeyup');" class="composant entier" id="composant_9" name="composant_9" data-id_composant="9" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">60</span>                             de coque<br>
                            <span class="rouge">4</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_10">
                                                                Average density hull
                                :
                            </label>
                            <div class="unite"><span class="orange">750</span> Iron</div>
                            <div class="unite"><span class="orange">300</span> Gold</div>
                            <div class="unite"><span class="orange">150</span> Crystal</div>
                            <div class="unite"><span class="orange">175</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_10', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_10', 'onkeyup');" class="composant entier" id="composant_10" name="composant_10" data-id_composant="10" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="10">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">450</span>                             de coque<br>
                            <span class="rouge">10</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_11">
                                                                High density hull 
                                :
                            </label>
                            <div class="unite"><span class="orange">1 000</span> Iron</div>
                            <div class="unite"><span class="orange">400</span> Gold</div>
                            <div class="unite"><span class="orange">250</span> Crystal</div>
                            <div class="unite"><span class="orange">350</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_11', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_11', 'onkeyup');" class="composant entier" id="composant_11" name="composant_11" data-id_composant="11" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="11">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1 000</span>                             de coque<br>
                            <span class="rouge">15</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_12">
                                                                Antaris hull
                                :
                            </label>
                            <div class="unite"><span class="orange">2 000</span> Iron</div>
                            <div class="unite"><span class="orange">800</span> Gold</div>
                            <div class="unite"><span class="orange">500</span> Crystal</div>
                            <div class="unite"><span class="orange">500</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_12', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_12', 'onkeyup');" class="composant entier" id="composant_12" name="composant_12" data-id_composant="12" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="12">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">3 000</span>                             de coque<br>
                            <span class="rouge">30</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_drone" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">Components list « Start-drones »</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <tbody><tr>
                        <td>
                            <label for="composant_29">
                                                               Drone low Rate
                                  :
                            </label>
                            <div class="unite"><span class="orange">240 000</span> Iron</div>
                            <div class="unite"><span class="orange">180 000</span> Gold</div>
                            <div class="unite"><span class="orange">150 000</span> Crystal</div>
                            <div class="unite"><span class="orange">75 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_29', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_29', 'onkeyup');" class="composant entier" id="composant_29" name="composant_29" data-id_composant="29" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="29">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1</span>                             drone(s)<br>
                            <span class="rouge">1 200</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_30">
                                                                Drone medium rate
                                :
                            </label>
                            <div class="unite"><span class="orange">600 000</span> Iron</div>
                            <div class="unite"><span class="orange">450 000</span> Gold</div>
                            <div class="unite"><span class="orange">300 000</span> Crystal</div>
                            <div class="unite"><span class="orange">120 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_30', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_30', 'onkeyup');" class="composant entier" id="composant_30" name="composant_30" data-id_composant="30" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="30">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">4</span>                             drone(s)<br>
                            <span class="rouge">4 800</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_31">
                                                                Drone fast rate 
                                                                    <span class="help rouge" onmouseover="montre('<b>Ce composant est bloqué :</b><br /><span class=\'vert\'>Avant-poste Antaris, au niveau 3 <i>(4)</i></span><br /><span class=\'vert\'>Siège des Antaris, au niveau 8 <i>(11)</i></span><br /><span class=\'vert\'>Maîtrise de l\'énergie, au niveau 20 <i>(20)</i></span><br /><span class=\'rouge\'>Connaissance des particules, au niveau 20 <i>(18)</i></span><br /><span class=\'vert\'>Connaissance des Antaris, au niveau 16 <i>(18)</i></span><br /><span class=\'rouge\'>Systèmes d\'armement, au niveau 20 <i>(19)</i></span><br />');" onmouseout="cache();">(B)</span>
                                :
                            </label>
                            <div class="unite"><span class="orange">1 050 000</span> Iron</div>
                            <div class="unite"><span class="orange">600 000</span> Gold</div>
                            <div class="unite"><span class="orange">412 500</span> Crystal</div>
                            <div class="unite"><span class="orange">210 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_31', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_31', 'onkeyup');" class="composant entier" id="composant_31" name="composant_31" data-id_composant="31" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="31">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">10</span>                             drone(s)<br>
                            <span class="rouge">12 000</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                        </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_hangar" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">Components list « Hangars »</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <tbody><tr>
                        <td>
                            <label for="composant_32">
                                                                Hunter hangar 
                                :
                            </label>
                            <div class="unite"><span class="orange">20 000</span> Iron</div>
                            <div class="unite"><span class="orange">15 000</span> Gold</div>
                            <div class="unite"><span class="orange">4 000</span> Crystal</div>
                            <div class="unite"><span class="orange">6 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_32', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_32', 'onkeyup');" class="composant entier" id="composant_32" name="composant_32" data-id_composant="32" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="32">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">10</span>                             place(s)<br>
                            <span class="rouge">1 500</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_33">
                                                                Interceptor hangar
                                :
                            </label>
                            <div class="unite"><span class="orange">60 000</span> Iron</div>
                            <div class="unite"><span class="orange">35 000</span> Gold</div>
                            <div class="unite"><span class="orange">8 000</span> Crystal</div>
                            <div class="unite"><span class="orange">12 500</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_33', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_33', 'onkeyup');" class="composant entier" id="composant_33" name="composant_33" data-id_composant="33" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="33">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">5</span>                             place(s)<br>
                            <span class="rouge">9 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_34">
                                                                Carrier hangar
                                :
                            </label>
                            <div class="unite"><span class="orange">135 000</span> Iron</div>
                            <div class="unite"><span class="orange">75 000</span> Gold</div>
                            <div class="unite"><span class="orange">20 000</span> Crystal</div>
                            <div class="unite"><span class="orange">30 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_34', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_34', 'onkeyup');" class="composant entier" id="composant_34" name="composant_34" data-id_composant="34" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="34">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">2</span>                             place(s)<br>
                            <span class="rouge">15 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_35">
                                                                Escort hangar
                                :
                            </label>
                            <div class="unite"><span class="orange">145 000</span> Iron</div>
                            <div class="unite"><span class="orange">80 000</span> Gold</div>
                            <div class="unite"><span class="orange">25 000</span> Crystal</div>
                            <div class="unite"><span class="orange">32 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_35', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_35', 'onkeyup');" class="composant entier" id="composant_35" name="composant_35" data-id_composant="35" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="35">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">2</span>                             place(s)<br>
                            <span class="rouge">60 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_36">
                                                                Shuttle hangar
                                :
                            </label>
                            <div class="unite"><span class="orange">220 000</span> Iron</div>
                            <div class="unite"><span class="orange">120 000</span> Gold</div>
                            <div class="unite"><span class="orange">42 000</span> Crystal</div>
                            <div class="unite"><span class="orange">40 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_36', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_36', 'onkeyup');" class="composant entier" id="composant_36" name="composant_36" data-id_composant="36" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="36">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1</span>                             place(s)<br>
                            <span class="rouge">115 000</span> u. de fret
                        </td>
                    </tr>
                                              </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_vitesse" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">Components list « Reactors »</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <tbody><tr>
                        <td>
                            <label for="composant_16">
                                                                Turbojet 
                                :
                            </label>
                            <div class="unite"><span class="orange">750</span> Iron</div>
                            <div class="unite"><span class="orange">500</span> Gold</div>
                            <div class="unite"><span class="orange">300</span> Crystal</div>
                            <div class="unite"><span class="orange">0</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_16', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_16', 'onkeyup');" class="composant entier" id="composant_16" name="composant_16" data-id_composant="16" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">5</span>                             de poussée<br>
                            <span class="rouge">20</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_17">
                                                                Ramjet 
                                :
                            </label>
                            <div class="unite"><span class="orange">1 500</span> Iron</div>
                            <div class="unite"><span class="orange">1 000</span> Gold</div>
                            <div class="unite"><span class="orange">600</span> Crystal</div>
                            <div class="unite"><span class="orange">0</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_17', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_17', 'onkeyup');" class="composant entier" id="composant_17" name="composant_17" data-id_composant="17" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="17">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">150</span>                             de poussée<br>
                            <span class="rouge">50</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_18">
                                                                Propellant rocket
                                :
                            </label>
                            <div class="unite"><span class="orange">2 500</span> Iron</div>
                            <div class="unite"><span class="orange">1 750</span> Gold</div>
                            <div class="unite"><span class="orange">1 000</span> Crystal</div>
                            <div class="unite"><span class="orange">250</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_18', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_18', 'onkeyup');" class="composant entier" id="composant_18" name="composant_18" data-id_composant="18" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="18">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">300</span>                             de poussée<br>
                            <span class="rouge">100</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_19">
                                                                Hybrid drive
                                :
                            </label>
                            <div class="unite"><span class="orange">6 000</span> Iron</div>
                            <div class="unite"><span class="orange">4 000</span> Gold</div>
                            <div class="unite"><span class="orange">2 500</span> Crystal</div>
                            <div class="unite"><span class="orange">300</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_19', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_19', 'onkeyup');" class="composant entier" id="composant_19" name="composant_19" data-id_composant="19" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="19">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">750</span>                             de poussée<br>
                            <span class="rouge">300</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_20">
                                                                Ion thruster
                                :
                            </label>
                            <div class="unite"><span class="orange">8 500</span> Iron</div>
                            <div class="unite"><span class="orange">6 000</span> Gold</div>
                            <div class="unite"><span class="orange">4 000</span> Crystal</div>
                            <div class="unite"><span class="orange">500</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_20', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_20', 'onkeyup');" class="composant entier" id="composant_20" name="composant_20" data-id_composant="20" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="20">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1 650</span>                             de poussée<br>
                            <span class="rouge">750</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_21">
                                                                Photonic propulsion
                                :
                            </label>
                            <div class="unite"><span class="orange">12 500</span> Iron</div>
                            <div class="unite"><span class="orange">10 000</span> Gold</div>
                            <div class="unite"><span class="orange">7 500</span> Crystal</div>
                            <div class="unite"><span class="orange">1 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_21', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_21', 'onkeyup');" class="composant entier" id="composant_21" name="composant_21" data-id_composant="21" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="21">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">2 000</span>                             de poussée<br>
                            <span class="rouge">2 800</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_22">
                                                                Nuclear thermal rocket
                                :
                            </label>
                            <div class="unite"><span class="orange">20 000</span> Iron</div>
                            <div class="unite"><span class="orange">15 000</span> Gold</div>
                            <div class="unite"><span class="orange">10 000</span> Crystal</div>
                            <div class="unite"><span class="orange">5 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_22', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_22', 'onkeyup');" class="composant entier" id="composant_22" name="composant_22" data-id_composant="22" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="22">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">4 000</span>                             de poussée<br>
                            <span class="rouge">8 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_23">
                                                                Antimatter reactor
                                :
                            </label>
                            <div class="unite"><span class="orange">45 000</span> Iron</div>
                            <div class="unite"><span class="orange">30 000</span> Gold</div>
                            <div class="unite"><span class="orange">20 000</span> Crystal</div>
                            <div class="unite"><span class="orange">30 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_23', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_23', 'onkeyup');" class="composant entier" id="composant_23" name="composant_23" data-id_composant="23" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="23">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">13 000</span>                             de poussée<br>
                            <span class="rouge">16 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_24">
                                <span class="help cyan" onmouseover="montre('Moteur ayant la technologie « Hyperespace ».');" onmouseout="cache();">[H+]</span>                                Hyperspace motor
                                :
                            </label>
                            <div class="unite"><span class="orange">130 000</span> Iron</div>
                            <div class="unite"><span class="orange">100 000</span> Gold</div>
                            <div class="unite"><span class="orange">75 000</span> Crystal</div>
                            <div class="unite"><span class="orange">75 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_24', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_24', 'onkeyup');" class="composant entier" id="composant_24" name="composant_24" data-id_composant="24" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="24">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">32 000</span>                             de poussée<br>
                            <span class="rouge">60 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_25">
                                <span class="help cyan" onmouseover="montre('Moteur ayant la technologie « Hyperespace ».');" onmouseout="cache();">[H+]</span>                                 VSL motor 
                                :
                            </label>
                            <div class="unite"><span class="orange">160 000</span> Iron</div>
                            <div class="unite"><span class="orange">125 000</span> Gold</div>
                            <div class="unite"><span class="orange">120 000</span> Crystal</div>
                            <div class="unite"><span class="orange">90 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_25', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_25', 'onkeyup');" class="composant entier" id="composant_25" name="composant_25" data-id_composant="25" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="25">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">45 000</span>                             de poussée<br>
                            <span class="rouge">95 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_26">
                                <span class="help cyan" onmouseover="montre('Moteur ayant la technologie « Hyperespace ».');" onmouseout="cache();">[H+]</span>                                 Advanced VSL motor 
                                                                    <span class="help rouge" onmouseover="montre('<b>Ce composant est bloqué :</b><br /><span class=\'vert\'>Maîtrise de l\'énergie, au niveau 20 <i>(20)</i></span><br /><span class=\'vert\'>Maîtrise du sub-espace, au niveau 18 <i>(18)</i></span><br /><span class=\'vert\'>Connaissance des Antaris, au niveau 16 <i>(18)</i></span><br /><span class=\'rouge\'>Hypernavigation, au niveau 18 <i>(16)</i></span><br /><span class=\'vert\'>Connaissance des particules, au niveau 18 <i>(18)</i></span><br />');" onmouseout="cache();">(B)</span>
                                :
                            </label>
                            <div class="unite"><span class="orange">250 000</span> Iron</div>
                            <div class="unite"><span class="orange">215 000</span> Gold</div>
                            <div class="unite"><span class="orange">155 000</span> Crystal</div>
                            <div class="unite"><span class="orange">125 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_26', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_26', 'onkeyup');" class="composant entier" id="composant_26" name="composant_26" data-id_composant="26" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="26">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">60 000</span>                             de poussée<br>
                            <span class="rouge">125 000</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                  </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_autre" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">Components list « Other »</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <tbody><tr>
                        <td>
                            <label for="composant_27">
                                                               Seat of Antaris installation 
                                :
                            </label>
                            <div class="unite"><span class="orange">2 000 000</span> Iron</div>
                            <div class="unite"><span class="orange">3 000 000</span> Gold</div>
                            <div class="unite"><span class="orange">2 500 000</span> Crystal</div>
                            <div class="unite"><span class="orange">800 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" value="0" onchange="javascript:VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.previsualiser();" class="composant" id="composant_27" name="composant_27" data-id_composant="27" type="checkbox"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="27">Incompatible</div>
                                                    </td>
                        <td>
                                                        +50% de bouclier<br>
                            <span class="rouge">40 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_28">
                                                               Teleportation system 
                                :
                            </label>
                            <div class="unite"><span class="orange">25 000</span> Iron</div>
                            <div class="unite"><span class="orange">50 000</span> Gold</div>
                            <div class="unite"><span class="orange">30 000</span> Crystal</div>
                            <div class="unite"><span class="orange">20 000</span> Elyrium</div>
                        </td>
                        <td>
                                                            <input style="display: none;" value="0" onchange="javascript:VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.previsualiser();" class="composant" id="composant_28" name="composant_28" data-id_composant="28" type="checkbox"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="28">Incompatible</div>
                                                    </td>
                        <td>
                                                        75% téléportation<br>
                            <span class="rouge">1 000</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                              </tbody></table>
        </div>
    </div>
        
    
    <!-- Sous-titre : pour vérifier la validité du formulaire -->
    <h2 class="titre_corps">Valider la création de ce modèle</h2>
	
    <?php if (empty($_smarty_tpl->tpl_vars['Message']->value)){?><div id="msg_verifier_modele" class="gris">  <span class="rouge"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_447'];?>
</span></div>
    
    <!-- Pour valider la création de ce nouveau modèle -->
    <div id="bouton_formulaire">
        <input name="valid_creation" id="valid_creation" value="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_805'];?>
" type="submit">
    </div>
	<?php }else{ ?>
	<div id="" class="gris"><?php echo $_smarty_tpl->tpl_vars['Message']->value;?>
<br><a onclick="location.href='game.php?page=CreateShip';"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_21'];?>
</a></div>
	<?php }?>

    <div class="espace"></div>
</form></div></div>  

<?php  $_smarty_tpl->tpl_vars['cronjob'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cronjob']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cronjobs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cronjob']->key => $_smarty_tpl->tpl_vars['cronjob']->value){
$_smarty_tpl->tpl_vars['cronjob']->_loop = true;
?><img src="cronjob.php?cronjobID=<?php echo $_smarty_tpl->tpl_vars['cronjob']->value;?>
" alt=""><?php } ?>
<?php echo $_smarty_tpl->getSubTemplate ("main.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>