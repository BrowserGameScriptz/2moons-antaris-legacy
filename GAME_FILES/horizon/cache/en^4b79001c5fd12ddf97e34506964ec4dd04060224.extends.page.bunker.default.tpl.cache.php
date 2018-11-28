<?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:54:51
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/page.bunker.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9295713875a81f10b43a808-85215881%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b79001c5fd12ddf97e34506964ec4dd04060224' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/page.bunker.default.tpl',
      1 => 1508112534,
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
  ),
  'nocache_hash' => '9295713875a81f10b43a808-85215881',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cronjobs' => 1,
    'cronjob' => 1,
  ),
  'has_nocache_code' => true,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a81f10b591939_83068808',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a81f10b591939_83068808')) {function content_5a81f10b591939_83068808($_smarty_tpl) {?><?php /*  Call merged included template "main.header.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('bodyclass'=>"full"), 0, '9295713875a81f10b43a808-85215881');
content_5a81f10b444b79_66226376($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.header.tpl" */?>
<?php /*  Call merged included template "main.navigation.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0, '9295713875a81f10b43a808-85215881');
content_5a81f10b4860b1_62894947($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.navigation.tpl" */?>
<?php /*  Call merged included template "main.topnav.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.topnav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0, '9295713875a81f10b43a808-85215881');
content_5a81f10b51f836_27925561($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.topnav.tpl" */?>

<div id="page_contenu"><h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_68'];?>
</h1><div class="onglet">
              <ul>
                 <li><a href="?page=Bunker" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_1'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_1'];?>
</a></li>
                  <li><a href="?page=Bunker&mode=historique" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_2'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_2'];?>
</a></li>
              </ul>
          </div>
          <div id="div_bunker"><!-- Sous titre de l'onglet -->
<h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_1'];?>
</h2>

<div name="bunker_transaction">
    <!-- Image d'illustration du bunker à ressources -->
    <img name="illustration" src="https://cdngames.antaris-legacy.eu/media/image/bunker.jpg" />
    
    <!-- Paragraphe explicatif -->
    <p>
       <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_3'];?>

    </p>
    
    <!-- Si le formulaire a été envoyé par le joueur -->
      <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if (!empty($_smarty_tpl->tpl_vars[\'Message\']->value)){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'Message\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

	   
	   
    <!-- Formulaire à remplir pour effectuer des actions auprès du bunker -->
    <form id="form_bunker" method="post" action="?page=Bunker">
        <table>
            <tr>
                <th class="nom_ressource"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_4'];?>
</th>
                <th class="quantite"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_5'];?>
</th>
                <th class="capacite_restante"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_6'];?>
</th>
                <th class="actions"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_7'];?>
</th>
            </tr>

            <!-- On parcours les quatres ressources du jeu -->
                       <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'bunkerTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

					  
					   <tr>
                <td class="nom_ressource">
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
.jpg" />
                    <span class="intutile" style="cursor:help;">
                        <span class="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'in\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
">•</span>
                        <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'resname\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

                    </span>
                </td>
                <td class="quantite">
                    <span class="orange"><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'bunker\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span> <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_bunker_8\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

                </td>
                <td class="capacite_restante">
                    <span class="gris"><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'remaining\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span> <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_bunker_9\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

                </td>
                <td class="actions">
                    <select id="action_<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" name="action_<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
">
                        <option value="ajouter" ><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_bunker_10\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</option>
                        <option value="retirer" ><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_bunker_11\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</option>
                    </select>
                  
                    <input  type="text" class="entier"  name="quantite_<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" 
                            data-max="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'remaining\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
"
                            data-quantite_bunker="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'bunker\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
"
                            data-insertion_possible="1"
                            value="0" /> <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_bunker_9\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

                </td>
            </tr>
                <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php } ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
       
        </table>
        
        
     
        <!-- Explication sur le captcha -->
        <div name="explication_captcha">
            <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_12'];?>

        </div><!--
        
        --><div name="captcha">
            <label for="captcha"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_69'];?>
 :</label> 
            
            <!-- Affichage de l'image captcha -->
            <div class="champ">
                <input type="text" id="captcha" name="captcha"  value="" />
                <img name="captcha" src="?page=Bunker&mode=getCode" />
            </div>

        </div>
                
        <input type="submit" name="valid_form_bunker" value="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bunker_13'];?>
" />
    </form>
  
</div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>

<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php  $_smarty_tpl->tpl_vars[\'cronjob\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'cronjob\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'cronjobs\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'cronjob\']->key => $_smarty_tpl->tpl_vars[\'cronjob\']->value){
$_smarty_tpl->tpl_vars[\'cronjob\']->_loop = true;
?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<img src="cronjob.php?cronjobID=<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'cronjob\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" alt=""><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php } ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->getSubTemplate ("main.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:54:51
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.header.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a81f10b444b79_66226376')) {function content_5a81f10b444b79_66226376($_smarty_tpl) {?>      <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <!-- Auteur(s) : Baukens Jeremy -->
    <!-- Site : Antaris Legacy -->
    <!-- Année : 2016 -->

    <!-- Debut du head -->
    <head>
        <!-- Title de la page -->
        <title><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'uni_name\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 - <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'game_name\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</title>

        <!-- Déclarations des balises meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'languageuser\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" />
        <meta name="author" content="Jeremy Baukens" />
        <meta name="copyright" content="Jeremy Baukens" />
        <meta name="gameowner" content="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'admin_name\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" />
        <meta name="gamecontact" content="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'admin_email\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" />
        <meta name="description" content="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'meta_descrip\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" />
        <meta name="keywords" content="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'meta_title\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
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
		 <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/lang/<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'languageuser\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
.js"></script>
         <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/main_compresser.min.js"></script>
		 
				<script type="text/javascript">
	var ServerTimezoneOffset = <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'Offset\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
;
	var serverTime 	= new Date(<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[0];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
, <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[1]-1;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
, <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[2];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
, <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[3];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
, <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[4];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
, <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[5];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
);
	var startTime	= serverTime.getTime();
	var localTime 	= serverTime;
	var localTS 	= startTime;
	var Gamename	= document.title;
	var Ready		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ready'];?>
";
	var Skin		= "<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'dpath\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
";
	var Lang		= "<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
";
	var head_info	= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['fcm_info'];?>
";
	var auth		= <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo (($tmp = @$_smarty_tpl->tpl_vars[\'authlevel\']->value)===null||$tmp===\'\' ? \'0\' : $tmp);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
;
	var days 		= <?php echo (($tmp = @json_encode($_smarty_tpl->tpl_vars['LNG']->value['week_day']))===null||$tmp==='' ? '[]' : $tmp);?>
 
	var months 		= <?php echo (($tmp = @json_encode($_smarty_tpl->tpl_vars['LNG']->value['months']))===null||$tmp==='' ? '[]' : $tmp);?>
 ;
	var tdformat	= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['js_tdformat'];?>
";
	var queryString	= "<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo strtr($_smarty_tpl->tpl_vars[\'queryString\']->value, array("\\\\" => "\\\\\\\\", "\'" => "\\\\\'", "\\"" => "\\\\\\"", "\\r" => "\\\\r", "\\n" => "\\\\n", "</" => "<\\/" ));?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
";
	var voterid     = <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'userID\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
;
	var aprise1		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_answer_1'];?>
"
	var aprise2		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_answer_2'];?>
"
	var aprise3		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_click_4'];?>
"
	var aprise4		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_galaxy_31'];?>
"

	setInterval(function() {
		serverTime.setSeconds(serverTime.getSeconds()+1);
	}, 1000);
	
	</script>
				
	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/l18n/validationEngine/jquery.validationEngine-<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
.js"></script>
	

	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/tooltip.js"></script>
	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/base.js"></script>
	<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php  $_smarty_tpl->tpl_vars[\'scriptname\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'scriptname\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'scripts\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'scriptname\']->key => $_smarty_tpl->tpl_vars[\'scriptname\']->value){
$_smarty_tpl->tpl_vars[\'scriptname\']->_loop = true;
?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'scriptname\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
.js"></script>
	<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php } ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

	
	<script type="text/javascript">
	$(function() {
		<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'execscript\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

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
                    <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_675'];?>
</li>
                    <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_676'];?>
 <span class="orange">Horizon</span></li>
                    <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_68'];?>
</li>
                </ul>
				
				  <div class="icones">
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/bug.png" onclick="#" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_8'];?>
.');" onmouseout="cache();" data-nom="bug">
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/facebook.png" onclick="javascript:window.open('https://www.facebook.com/Control-Panel-890372641089987/'); return false;" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_9'];?>
');" onmouseout="cache();" data-nom="facebook">
                 
				 
                </div>
				
		
            </div>
<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:54:51
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.navigation.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a81f10b4860b1_62894947')) {function content_5a81f10b4860b1_62894947($_smarty_tpl) {?><!-- Le menu à gauche -->
            <div id="menu">
                <h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_title_1'];?>
</h1>
                <ul>
                    <?php if (isModulAvalible(@constant('MODULE_OVERVIEW'))){?><li><a href="?page=overview" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_1'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_overview'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_TECHTREE'))){?><li><a href="?page=techtree" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_2'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_457'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_GALAXY'))){?><li><a href="?page=galaxy" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_3'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_524'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_TPORTAL'))){?><li><a href="?page=Tportal" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_5'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_tportal'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_SPACECENTER'))){?><li><a href="?page=center" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_4'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_fleettable_5'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_TOWER'))){?><li><a href="?page=Tower" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_6'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_tmanagement'];?>
</a></li><?php }?>
                </ul>
                <h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_title_2'];?>
</h1>
                <ul>
                    <?php if (isModulAvalible(@constant('MODULE_BUILDING'))){?><li><a href="?page=buildings&cmdd=build" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_8'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_buildings'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_RESEARCH'))){?><li><a href="?page=research" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_9'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_268'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_SPECIALIZED'))){?><li><a href="?page=shipyard&mode=fleet" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_10'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_320'];?>
</a></li><?php }?>
					<?php if (isModulAvalible(@constant('MODULE_CREATESHIP'))){?><li><a href="?page=CreateShip" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_451'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_387'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_DEFENSE'))){?><li><a href="?page=defense" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_11'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_336'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_POPULATION'))){?><li><a href="?page=population" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_12'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_population'];?>
</a></li><?php }?>

                </ul>
                <h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_title_3'];?>
</h1>
                <ul>
                    <?php if (isModulAvalible(@constant('MODULE_SEARCH'))){?><li><a href="?page=search" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_13'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_search'];?>
</a> </li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_ALLIANCE'))||isModulAvalible(@constant('MODULE_MARKET'))){?><li><?php if (isModulAvalible(@constant('MODULE_ALLIANCE'))){?><a href="?page=alliance" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_14'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_alliance'];?>
</a><?php }?> / <?php if (isModulAvalible(@constant('MODULE_MARKET'))){?><a href="?page=market" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_15'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_market'];?>
</a><?php }?></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_BUNKER'))||isModulAvalible(@constant('MODULE_BANK'))){?><li><?php if (isModulAvalible(@constant('MODULE_BUNKER'))){?><a href="?page=Bunker" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_16'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_bunker'];?>
</a><?php }?> / <?php if (isModulAvalible(@constant('MODULE_BANK'))){?><a href="?page=Bank" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_32'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_33'];?>
</a><?php }?></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_RESSOURCE_LIST'))){?><li><a href="?page=resources" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_17'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_resources'];?>
</a></li><?php }?>
					<?php if (isModulAvalible(@constant('MODULE_SIMULATOR_PORTAL'))||isModulAvalible(@constant('MODULE_SIMULATOR_SPACE'))){?><li><?php if (isModulAvalible(@constant('MODULE_SIMULATOR_PORTAL'))){?><a href="?page=battleSimulator" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_809'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_807'];?>
</a><?php }?> / <?php if (isModulAvalible(@constant('MODULE_SIMULATOR_SPACE'))){?><a href="?page=spaceSimulator" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_810'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_808'];?>
</a><?php }?></li><?php }?>
                </ul>
				<h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_title_4'];?>
</h1>
                <ul>
                    <?php if (isModulAvalible(@constant('MODULE_IMMUNITY'))){?><li><a href="?page=Immunity" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_18'];?>
."><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_immunity'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_PLANET_CLOAK'))){?><li><a href="?page=Planetcloak" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_19'];?>
."><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_pcloak'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_LOTTERY'))){?><li><a href="?page=Lottery" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_20'];?>
."><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_lotto'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_REDEEM'))){?><li> <a href="?page=Reward2" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_21'];?>
."><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_redeem'];?>
</a></li><?php }?>
                </ul>
                <h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_title_5'];?>
</h1>
                <ul>
                    <?php if (isModulAvalible(@constant('MODULE_MESSAGES'))){?><li><a id="gotit" href="?page=messages" name="messagerie" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_22'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_messages'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_STATISTICS'))){?><li><a href="?page=statistics" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_23'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_statistics'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_SETTINGS'))){?><li><a href="?page=settings" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_24'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_proset'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_GESTION'))){?><li><a href="?page=gestion" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_25'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_gestion'];?>
</a></li><?php }?>
					<?php if (isModulAvalible(@constant('MODULE_CHAT'))){?><li><a id="gotit2" href="?page=Tchat" name="tchat" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_90'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_91'];?>
</a></li><?php }?>
					
					<?php if (isModulAvalible(@constant('MODULE_ACHAT'))){?><li><a href="?page=Achat" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_26'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_shop'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_FAQ'))||isModulAvalible(@constant('MODULE_SUPPORT'))){?><li><?php if (isModulAvalible(@constant('MODULE_FAQ'))){?><a href="?page=faq" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_faq_13'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_faq_13'];?>
</a><?php }?> / <?php if (isModulAvalible(@constant('MODULE_SUPPORT'))){?><a href="?page=ticket" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_818'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_817'];?>
</a><?php }?></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_BANNED'))){?><li><a href="?page=banList" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_28'];?>
."><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_banned'];?>
</a></li><?php }?>
                    <?php if (isModulAvalible(@constant('MODULE_BATTLEHALL'))){?><li><a href="?page=battleHall" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_29'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_topkb'];?>
</a></li><?php }?>
                    <li><a data-ajax="0" href="?page=logout" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_expl_30'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_logout'];?>
</a></li>
                </ul>
                <h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_title_6'];?>
</h1>
                <ul>
                    <li>Horizon : <span name="charge_serveur"></span></li>
                    <li>Time : <span name="horloge" data-timestamp="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'timestamp\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
"></span></li>
                    <li><span name="nb_connecte" style="font-weight : bold;"></span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_connected'];?>
</li>
                </ul>
            </div><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:54:51
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.topnav.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a81f10b51f836_27925561')) {function content_5a81f10b51f836_27925561($_smarty_tpl) {?>          <!-- Le corps de la page -->
            <div id="corps">
              
        <div id="ressource_contenu"><!-- On affiche le titre pour les ressources -->
<h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_7'];?>
</h1>


<div class="selection_planete">
     <select id="select_custom">
	 
	 <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php  $_smarty_tpl->tpl_vars[\'x\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'x\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'AllPlanetsBis\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'x\']->key => $_smarty_tpl->tpl_vars[\'x\']->value){
$_smarty_tpl->tpl_vars[\'x\']->_loop = true;
?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

                <option value="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'id\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" data-imagesrc="https://cdngames.antaris-legacy.eu/media/ingame/planet/<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'image\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
.jpg" <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if ($_smarty_tpl->tpl_vars[\'current_pid\']->value==$_smarty_tpl->tpl_vars[\'x\']->value[\'id\']){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
selected="selected"<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
                data-description="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_448\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 : <span class='<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'teleport_portal\']==0){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
rouge<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
vert<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
'><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'teleport_portal\']==0){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
OFF<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
ON<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span> - <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_449\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 : <span class='<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'force_field_timer\']>$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
vert<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
rouge<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
'><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'force_field_timer\']>$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
ON<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
OFF<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span> - <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_450\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 : <span class='<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'siege_on\']<$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
rouge<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
vert<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
'><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'siege_on\']<$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
OFF<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
ON<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span>">
                [<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'system\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
:<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'planet\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
] <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'name\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</option>
				
			<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php } ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
	

            </select>
</div>


 <!-- Pour afficher l'énergie sur la planète toute à droite -->

<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'resourceTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if (!isset($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'])){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php $_smarty_tpl->createLocalArrayVariable(\'resouceData\', true, 0);
$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'] = $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']+$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'used\'];?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

<div class="darkmatter" onmouseover="montre(' <div style=\'padding : 2px 8px; min-width : 170px;\'>                                              <b>  <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'resourceID\']->value];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_6\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 :</b><br />                                              — <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_5\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span><br />                                                                                      </div>');" onmouseout="cache();">
   <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if ($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']>999999999999){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo shortly_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

</div>

<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

	<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

									<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php } ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>


<!-- Permet d'afficher les ressources -->
<div class="conteneur_ressource">


<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'resourceTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if (!isset($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'])){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php $_smarty_tpl->createLocalArrayVariable(\'resouceData\', true, 0);
$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'] = $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']+$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'used\'];?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

    <!-- Le fer -->
    <div class="item_ressource <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" id="current_<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
"  name="<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
" onmouseover="montre(' <div style=\'padding : 2px 8px; min-width : 170px;\'>                                                      <b><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_4\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'resourceID\']->value];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 :</b><br />                                                    — <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_846\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span> u.<br />  — <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_1\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'bunker\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span> u.<br />                                                      — <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_2\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span> u.<br />                                                      — <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_3\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'percent\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span>%                                                  </div>');" onmouseout="cache();">
        <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if ($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']>=$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<span class="rouge"><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</span><?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }else{ ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

    </div>
	<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

									<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php } ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>


	
	
	
    <div class="espace"></div>
</div>
<div class="espace"></div>
<!-- On appel le javascript nécessaire pour customizer le select pour les planètes -->
<script type="text/javascript">$('select#select_custom').ddslick({ width : 220 });</script>
<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if (!$_smarty_tpl->tpl_vars[\'vmode\']->value){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

		<script type="text/javascript">
		var viewShortlyNumber	= <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'shortlyNumber\']->value);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
;
		var vacation			= <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'vmode\']->value;?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
;
		<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'resourceTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

		<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php if (isset($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'production\'])){?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

		resourceTicker({
			available: <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
,
			limit: [0, <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
],
			production: <?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'production\']);?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
,
			valueElem: "current_<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
"
		}, true);
		<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

		<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php } ?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>

		</script>
		<?php echo '/*%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/<?php }?>/*/%%SmartyNocache:9295713875a81f10b43a808-85215881%%*/';?>
</div><?php }} ?>