<?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:54:31
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/page.createship.default.tpl" */ ?>
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
  ),
  'nocache_hash' => '14145338265a81f0f73ceda0-83953956',
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
  'unifunc' => 'content_5a81f0f765ed93_28905426',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a81f0f765ed93_28905426')) {function content_5a81f0f765ed93_28905426($_smarty_tpl) {?><?php /*  Call merged included template "main.header.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('bodyclass'=>"full"), 0, '14145338265a81f0f73ceda0-83953956');
content_5a81f0f73dc156_87109062($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.header.tpl" */?>
<?php /*  Call merged included template "main.navigation.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0, '14145338265a81f0f73ceda0-83953956');
content_5a81f0f74189a5_35156889($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.navigation.tpl" */?>
<?php /*  Call merged included template "main.topnav.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.topnav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0, '14145338265a81f0f73ceda0-83953956');
content_5a81f0f74ae142_34605489($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.topnav.tpl" */?>

<div id="page_contenu">      <h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_387'];?>
</h1><div class="onglet">
              <ul>
                  <li><a href="?page=CreateShip&mode=ships" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_379'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_380'];?>
</a></li> 
                  <li><a href="?page=CreateShip" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_381'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_382'];?>
</a></li> 
                  <li><a href="?page=CreateShip&mode=pieces" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_383'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_384'];?>
</a></li> 
                  <li><a href="?page=CreateShip&mode=flotte" title="<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_385'];?>
"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_386'];?>
</a></li>
              </ul>
          </div>
          <div id="div_vaisseau">
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if (empty($_smarty_tpl->tpl_vars[\'Message\']->value)){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

		  <script type="text/javascript">
    $(document).ready(function(){ 
        VaisseauCreation.initialiser(); 
    });
</script>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

<!-- Le message de chargement pour attendre que l'on charge les composants et les infrastructures en JSON -->


<!-- Le formulaire de création de modèle -->
<form style="display: block;" id="form_creation_vaisseau" method="post" action="game.php?page=CreateShip">
    <!-- Sous-titre : Créer un nouveau modèle -->
	
    <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_806'];?>
</h2>
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
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
 :</td>
                <td name="fer">500</td>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_389'];?>
 :</td>
                <td name="attaque">0</td>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_391'];?>
 :</td>
                <td name="vitesse">0%</td>
            </tr>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
 :</td>
                <td name="or">250</td>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_420'];?>
 :</td>
                <td name="bouclier">0</td>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_421'];?>
 :</td>
                <td name="maniabilite">100%</td>
                
            </tr>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
 :</td>
                <td name="cristal">100</td>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_390'];?>
 :</td>
                <td name="coque">0</td>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_323'];?>
 :</td>
                <td name="temps">2m 0s</td>
            </tr>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
 : </td>
                <td name="elyrium">50</td>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_393'];?>
 :</td>
                <td name="fret">200</td>
                <td><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_422'];?>
 :</td>
                <td name="drone">0 drones</td>
            </tr>
        </tbody></table>
        <div class="espace"></div>
    </div>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if (empty($_smarty_tpl->tpl_vars[\'Message\']->value)){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

    <!-- On affiche tous les sous-onglet pour les composants de divers type -->
    <div class="onglet">
        <ul>
            <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('description');" title=""><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_285\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('attaque');" title=""><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_423\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('bouclier');" title=""><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_424\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('coque');" title=""><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_425\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('drone');" title=""><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_426\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('hangar');" title=""><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_427\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('vitesse');" title=""><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_428\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('autre');" title=""><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_429\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</a></li>
                    </ul>
    </div>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

    <!-- Sous partie : indiquer le nom du modèle / choisir l'infrastructure et image -->
    <div name="sous_onglet_description" class="sous_onglet">
        <!-- Le titre de cet sous-onglet -->
		<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if (empty($_smarty_tpl->tpl_vars[\'Message\']->value)){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

        <h2 class="titre_corps"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_430\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table name="description">
                <!-- Le nom du modèle -->
                <tbody><tr>
                    <td>
                        <label for="nom"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_431\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 :</label>
                        — <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_432\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

                    </td>
                    <td><input onchange="javascript:VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.previsualiser();" name="nom" id="nom" type="text"></td>
                </tr>

                <!-- Le lien vers l'image -->
                <tr>
                    <td>
                        <label for="image"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_433\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 :</label>
                        — <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_434\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

                    </td>
                    <td>
                        <input name="image" id="image" onchange="javascript:VaisseauCreation.changerImage(); VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.changerImage(); VaisseauCreation.previsualiser();" type="text">
                        <a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('liste_image');" title=""><img src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/couleur/image.png"></a>
                    </td>
                </tr>

                <!-- L'infrastructure du modèle -->
                <tr>
                    <td>
                        <label for="id_infrastructure"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_435\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 :</label>
                        — <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_436\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

                    </td>
                    <td>
                      <select name="id_infrastructure" id="id_infrastructure" onchange="VaisseauCreation.selectionnerInfrastructure();">
                                                            <option value="1"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'INFRASTRUCTURE\'][1];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
                                                            <option value="2"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'INFRASTRUCTURE\'][2];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
                                                            <option value="3"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'INFRASTRUCTURE\'][3];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
                                                            <option value="4"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'INFRASTRUCTURE\'][4];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
                                                            <option value="5"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'INFRASTRUCTURE\'][5];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
                                                            <option value="6"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'INFRASTRUCTURE\'][6];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
                                                            <option value="7"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'INFRASTRUCTURE\'][7];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
                                                            <option value="8"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'INFRASTRUCTURE\'][8];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
                                                            <option value="9"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'INFRASTRUCTURE\'][9];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
                                                    </select>
                    </td>
                </tr>
            </tbody></table>
        </div><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 
    </div>
                       
    <!-- Sous partie : liste de toutes les images de modèle que l'on propose aux joueurs -->
    <div name="sous_onglet_liste_image" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_437'];?>
</h2>
        
        <i><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_438'];?>
</i>
        <div class="conteneur">
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/1.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/1.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/2.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/2.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/3.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/3.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/4.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/4.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/5.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/5.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/6.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/6.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/7.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/7.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/8.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/8.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/9.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/9.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/10.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/10.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/11.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/11.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/12.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/12.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/13.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/13.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/14.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/14.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/15.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/15.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/16.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/16.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/17.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/17.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/18.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/18.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/19.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/19.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/20.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/20.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/21.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/21.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/22.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/22.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/23.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/23.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/24.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/24.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/25.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/25.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/26.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/26.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/27.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/27.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/28.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/28.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/29.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/29.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/30.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/30.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/31.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/31.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/32.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/32.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/33.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/33.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/34.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/34.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/35.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/35.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/36.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/36.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/37.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/37.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/38.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/38.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/39.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/39.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/40.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/40.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/41.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/41.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/42.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/42.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/43.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/43.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/44.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/44.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/45.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/45.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/46.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/46.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/47.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/47.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/48.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/48.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/49.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/49.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/50.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/50.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/51.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/51.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/52.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/52.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/53.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/53.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/54.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/54.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/55.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/55.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/56.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/56.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/57.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/57.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/58.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/58.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/59.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/59.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/60.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/60.jpg');" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_439'];?>
');" onmouseout="cache();">
                </div>
                        <div class="espace"></div>
        </div>
    </div>

            
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_attaque" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_440'];?>
</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                      <tbody><tr>
                        <td>
                            <label for="composant_1">
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][1];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">100</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">50</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">20</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">0</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][2];?>
 
                                  :
                            </label>
                            <div class="unite"><span class="orange">500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">200</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">100</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">0</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][3];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">1 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">250</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">50</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][4];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">1 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">1 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">400</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">150</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][5];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">4 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">2 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">1 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">250</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][6];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">10 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">6 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">2 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">400</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][7];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">25 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">15 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">8 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">1 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][8];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">35 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">22 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">12 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">1 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
        <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_441'];?>
</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <tbody><tr>
                        <td>
                            <label for="composant_13">
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][13];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">250</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">100</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">175</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">25</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][14];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">400</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">200</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">425</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">100</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][15];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">1 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">650</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">950</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">250</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
        <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_442'];?>
</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                      <tbody><tr>
                        <td>
                            <label for="composant_9">
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][9];?>
 
                                :
                            </label>
                            <div class="unite"><span class="orange">250</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">100</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">10</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">20</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][10];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">750</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">300</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">150</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">175</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][11];?>
 
                                :
                            </label>
                            <div class="unite"><span class="orange">1 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">400</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">250</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">350</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][12];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">2 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">800</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
        <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_443'];?>
</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <tbody><tr>
                        <td>
                            <label for="composant_29">
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][29];?>

                                  :
                            </label>
                            <div class="unite"><span class="orange">240 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">180 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">150 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">75 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][30];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">600 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">450 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">300 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">120 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][31];?>
 
                                                                    <span class="help rouge" onmouseover="montre('<b>Ce composant est bloqué :</b><br /><span class=\'vert\'>Avant-poste Antaris, au niveau 3 <i>(4)</i></span><br /><span class=\'vert\'>Siège des Antaris, au niveau 8 <i>(11)</i></span><br /><span class=\'vert\'>Maîtrise de l\'énergie, au niveau 20 <i>(20)</i></span><br /><span class=\'rouge\'>Connaissance des particules, au niveau 20 <i>(18)</i></span><br /><span class=\'vert\'>Connaissance des Antaris, au niveau 16 <i>(18)</i></span><br /><span class=\'rouge\'>Systèmes d\'armement, au niveau 20 <i>(19)</i></span><br />');" onmouseout="cache();">(B)</span>
                                :
                            </label>
                            <div class="unite"><span class="orange">1 050 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">600 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">412 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">210 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
        <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_444'];?>
</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <tbody><tr>
                        <td>
                            <label for="composant_32">
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][32];?>
 
                                :
                            </label>
                            <div class="unite"><span class="orange">20 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">15 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">4 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">6 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][33];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">60 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">35 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">8 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">12 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][34];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">135 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">75 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">20 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">30 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][35];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">145 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">80 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">25 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">32 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][36];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">220 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">120 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">42 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">40 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
        <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_445'];?>
</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <tbody><tr>
                        <td>
                            <label for="composant_16">
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][16];?>
 
                                :
                            </label>
                            <div class="unite"><span class="orange">750</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">300</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">0</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][17];?>
 
                                :
                            </label>
                            <div class="unite"><span class="orange">1 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">1 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">600</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">0</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][18];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">2 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">1 750</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">1 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">250</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][19];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">6 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">4 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">2 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">300</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][20];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">8 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">6 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">4 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][21];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">12 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">10 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">7 500</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">1 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][22];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">20 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">15 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">10 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">5 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][23];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">45 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">30 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">20 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">30 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                <span class="help cyan" onmouseover="montre('Moteur ayant la technologie « Hyperespace ».');" onmouseout="cache();">[H+]</span>                                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][24];?>

                                :
                            </label>
                            <div class="unite"><span class="orange">130 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">100 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">75 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">75 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                <span class="help cyan" onmouseover="montre('Moteur ayant la technologie « Hyperespace ».');" onmouseout="cache();">[H+]</span>                                 <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][25];?>
 
                                :
                            </label>
                            <div class="unite"><span class="orange">160 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">125 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">120 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">90 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                <span class="help cyan" onmouseover="montre('Moteur ayant la technologie « Hyperespace ».');" onmouseout="cache();">[H+]</span>                                 <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][26];?>
 
                                                                    <span class="help rouge" onmouseover="montre('<b>Ce composant est bloqué :</b><br /><span class=\'vert\'>Maîtrise de l\'énergie, au niveau 20 <i>(20)</i></span><br /><span class=\'vert\'>Maîtrise du sub-espace, au niveau 18 <i>(18)</i></span><br /><span class=\'vert\'>Connaissance des Antaris, au niveau 16 <i>(18)</i></span><br /><span class=\'rouge\'>Hypernavigation, au niveau 18 <i>(16)</i></span><br /><span class=\'vert\'>Connaissance des particules, au niveau 18 <i>(18)</i></span><br />');" onmouseout="cache();">(B)</span>
                                :
                            </label>
                            <div class="unite"><span class="orange">250 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">215 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">155 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">125 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
        <h2 class="titre_corps"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_446'];?>
</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <tbody><tr>
                        <td>
                            <label for="composant_27">
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][27];?>
 
                                :
                            </label>
                            <div class="unite"><span class="orange">2 000 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">3 000 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">2 500 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">800 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
                                                               <?php echo $_smarty_tpl->tpl_vars['LNG']->value['COMPOSANT'][28];?>
 
                                :
                            </label>
                            <div class="unite"><span class="orange">25 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][901];?>
</div>
                            <div class="unite"><span class="orange">50 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][902];?>
</div>
                            <div class="unite"><span class="orange">30 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][903];?>
</div>
                            <div class="unite"><span class="orange">20 000</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['tech'][904];?>
</div>
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
	
    <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if (empty($_smarty_tpl->tpl_vars[\'Message\']->value)){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<div id="msg_verifier_modele" class="gris">  <span class="rouge"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_447\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span></div>
    
    <!-- Pour valider la création de ce nouveau modèle -->
    <div id="bouton_formulaire">
        <input name="valid_creation" id="valid_creation" value="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_805\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
" type="submit">
    </div>
	<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

	<div id="" class="gris"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'Message\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<br><a onclick="location.href='game.php?page=CreateShip';"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_21\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</a></div>
	<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>


    <div class="espace"></div>
</form></div></div>  

<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php  $_smarty_tpl->tpl_vars[\'cronjob\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'cronjob\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'cronjobs\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'cronjob\']->key => $_smarty_tpl->tpl_vars[\'cronjob\']->value){
$_smarty_tpl->tpl_vars[\'cronjob\']->_loop = true;
?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<img src="cronjob.php?cronjobID=<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'cronjob\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
" alt=""><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php } ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->getSubTemplate ("main.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:54:31
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.header.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a81f0f73dc156_87109062')) {function content_5a81f0f73dc156_87109062($_smarty_tpl) {?>      <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <!-- Auteur(s) : Baukens Jeremy -->
    <!-- Site : Antaris Legacy -->
    <!-- Année : 2016 -->

    <!-- Debut du head -->
    <head>
        <!-- Title de la page -->
        <title><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'uni_name\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 - <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'game_name\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</title>

        <!-- Déclarations des balises meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'languageuser\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
" />
        <meta name="author" content="Jeremy Baukens" />
        <meta name="copyright" content="Jeremy Baukens" />
        <meta name="gameowner" content="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'admin_name\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
" />
        <meta name="gamecontact" content="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'admin_email\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
" />
        <meta name="description" content="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'meta_descrip\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
" />
        <meta name="keywords" content="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'meta_title\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
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
		 <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/lang/<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'languageuser\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
.js"></script>
         <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/main_compresser.min.js"></script>
		 
				<script type="text/javascript">
	var ServerTimezoneOffset = <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'Offset\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
;
	var serverTime 	= new Date(<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[0];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
, <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[1]-1;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
, <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[2];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
, <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[3];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
, <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[4];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
, <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[5];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
);
	var startTime	= serverTime.getTime();
	var localTime 	= serverTime;
	var localTS 	= startTime;
	var Gamename	= document.title;
	var Ready		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ready'];?>
";
	var Skin		= "<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'dpath\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
";
	var Lang		= "<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
";
	var head_info	= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['fcm_info'];?>
";
	var auth		= <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo (($tmp = @$_smarty_tpl->tpl_vars[\'authlevel\']->value)===null||$tmp===\'\' ? \'0\' : $tmp);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
;
	var days 		= <?php echo (($tmp = @json_encode($_smarty_tpl->tpl_vars['LNG']->value['week_day']))===null||$tmp==='' ? '[]' : $tmp);?>
 
	var months 		= <?php echo (($tmp = @json_encode($_smarty_tpl->tpl_vars['LNG']->value['months']))===null||$tmp==='' ? '[]' : $tmp);?>
 ;
	var tdformat	= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['js_tdformat'];?>
";
	var queryString	= "<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo strtr($_smarty_tpl->tpl_vars[\'queryString\']->value, array("\\\\" => "\\\\\\\\", "\'" => "\\\\\'", "\\"" => "\\\\\\"", "\\r" => "\\\\r", "\\n" => "\\\\n", "</" => "<\\/" ));?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
";
	var voterid     = <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'userID\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
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
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/l18n/validationEngine/jquery.validationEngine-<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
.js"></script>
	

	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/tooltip.js"></script>
	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/base.js"></script>
	<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php  $_smarty_tpl->tpl_vars[\'scriptname\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'scriptname\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'scripts\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'scriptname\']->key => $_smarty_tpl->tpl_vars[\'scriptname\']->value){
$_smarty_tpl->tpl_vars[\'scriptname\']->_loop = true;
?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'scriptname\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
.js"></script>
	<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php } ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

	
	<script type="text/javascript">
	$(function() {
		<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'execscript\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

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
                    <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_387'];?>
</li>
                </ul>
				
				  <div class="icones">
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/bug.png" onclick="#" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_8'];?>
.');" onmouseout="cache();" data-nom="bug">
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/facebook.png" onclick="javascript:window.open('https://www.facebook.com/Control-Panel-890372641089987/'); return false;" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_9'];?>
');" onmouseout="cache();" data-nom="facebook">
                 
				 
                </div>
				
		
            </div>
<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:54:31
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.navigation.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a81f0f74189a5_35156889')) {function content_5a81f0f74189a5_35156889($_smarty_tpl) {?><!-- Le menu à gauche -->
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
                    <li>Time : <span name="horloge" data-timestamp="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'timestamp\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
"></span></li>
                    <li><span name="nb_connecte" style="font-weight : bold;"></span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_connected'];?>
</li>
                </ul>
            </div><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:54:31
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.topnav.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a81f0f74ae142_34605489')) {function content_5a81f0f74ae142_34605489($_smarty_tpl) {?>          <!-- Le corps de la page -->
            <div id="corps">
              
        <div id="ressource_contenu"><!-- On affiche le titre pour les ressources -->
<h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_7'];?>
</h1>


<div class="selection_planete">
     <select id="select_custom">
	 
	 <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php  $_smarty_tpl->tpl_vars[\'x\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'x\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'AllPlanetsBis\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'x\']->key => $_smarty_tpl->tpl_vars[\'x\']->value){
$_smarty_tpl->tpl_vars[\'x\']->_loop = true;
?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

                <option value="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'id\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
" data-imagesrc="https://cdngames.antaris-legacy.eu/media/ingame/planet/<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'image\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
.jpg" <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if ($_smarty_tpl->tpl_vars[\'current_pid\']->value==$_smarty_tpl->tpl_vars[\'x\']->value[\'id\']){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
selected="selected"<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
                data-description="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_448\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 : <span class='<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'teleport_portal\']==0){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
rouge<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
vert<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
'><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'teleport_portal\']==0){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
OFF<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
ON<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span> - <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_449\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 : <span class='<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'force_field_timer\']>$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
vert<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
rouge<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
'><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'force_field_timer\']>$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
ON<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
OFF<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span> - <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_450\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 : <span class='<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'siege_on\']<$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
rouge<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
vert<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
'><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'siege_on\']<$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
OFF<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
ON<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span>">
                [<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'system\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
:<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'planet\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
] <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'name\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</option>
				
			<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php } ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
	

            </select>
</div>


 <!-- Pour afficher l'énergie sur la planète toute à droite -->

<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'resourceTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if (!isset($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'])){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php $_smarty_tpl->createLocalArrayVariable(\'resouceData\', true, 0);
$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'] = $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']+$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'used\'];?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

<div class="darkmatter" onmouseover="montre(' <div style=\'padding : 2px 8px; min-width : 170px;\'>                                              <b>  <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'resourceID\']->value];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_6\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 :</b><br />                                              — <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_5\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span><br />                                                                                      </div>');" onmouseout="cache();">
   <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if ($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']>999999999999){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo shortly_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

</div>

<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

	<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

									<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php } ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>


<!-- Permet d'afficher les ressources -->
<div class="conteneur_ressource">


<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'resourceTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if (!isset($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'])){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php $_smarty_tpl->createLocalArrayVariable(\'resouceData\', true, 0);
$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'] = $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']+$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'used\'];?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

    <!-- Le fer -->
    <div class="item_ressource <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
" id="current_<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
"  name="<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
" onmouseover="montre(' <div style=\'padding : 2px 8px; min-width : 170px;\'>                                                      <b><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_4\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'resourceID\']->value];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 :</b><br />                                                    — <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_846\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span> u.<br />  — <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_1\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'bunker\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span> u.<br />                                                      — <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_2\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span> u.<br />                                                      — <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_3\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'percent\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span>%                                                  </div>');" onmouseout="cache();">
        <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if ($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']>=$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<span class="rouge"><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</span><?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }else{ ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

    </div>
	<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

									<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php } ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>


	
	
	
    <div class="espace"></div>
</div>
<div class="espace"></div>
<!-- On appel le javascript nécessaire pour customizer le select pour les planètes -->
<script type="text/javascript">$('select#select_custom').ddslick({ width : 220 });</script>
<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if (!$_smarty_tpl->tpl_vars[\'vmode\']->value){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

		<script type="text/javascript">
		var viewShortlyNumber	= <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'shortlyNumber\']->value);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
;
		var vacation			= <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'vmode\']->value;?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
;
		<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'resourceTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

		<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php if (isset($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'production\'])){?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

		resourceTicker({
			available: <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
,
			limit: [0, <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
],
			production: <?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'production\']);?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
,
			valueElem: "current_<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
"
		}, true);
		<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

		<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php } ?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>

		</script>
		<?php echo '/*%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/<?php }?>/*/%%SmartyNocache:14145338265a81f0f73ceda0-83953956%%*/';?>
</div><?php }} ?>