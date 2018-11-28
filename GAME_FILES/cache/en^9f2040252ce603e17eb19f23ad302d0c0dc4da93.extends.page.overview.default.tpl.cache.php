<?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:53:37
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/page.overview.default.tpl" */ ?>
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
  ),
  'nocache_hash' => '6859878885a81f0c1a84551-10348437',
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
  'unifunc' => 'content_5a81f0c1f0f416_00405296',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a81f0c1f0f416_00405296')) {function content_5a81f0c1f0f416_00405296($_smarty_tpl) {?><?php /*  Call merged included template "main.header.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('bodyclass'=>"full"), 0, '6859878885a81f0c1a84551-10348437');
content_5a81f0c1a91257_15519759($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.header.tpl" */?>
<?php /*  Call merged included template "main.navigation.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0, '6859878885a81f0c1a84551-10348437');
content_5a81f0c1add733_00856933($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.navigation.tpl" */?>
<?php /*  Call merged included template "main.topnav.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.topnav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0, '6859878885a81f0c1a84551-10348437');
content_5a81f0c1be6ab2_05037848($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.topnav.tpl" */?>


<script type="text/javascript">
$(document).ready(function(){ window.setInterval(function(){ $(".fleets").each(function(){ var e=$(this).data("fleet-time")-(serverTime.getTime()-startTime)/1e3;0>=e?$(this).text("-"):$(this).text(GetRestTimeFormat(e)) }) },1e3),window.setInterval(function(){ $(".decompte_actualise").each(function(){ var e=$(this).data("time")-(serverTime.getTime()-startTime)/1e3;0==e?window.location.href="game.php?page=overview":$(this).text(GetRestTimeFormat(e)) }) },1e3) });
var fleetreturnxd		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_10'];?>
"
var fleetreturnxd1		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_11'];?>
"
var fleetreturnxd2		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_ovbuild_12'];?>
"
</script>	 

<div id="page_contenu">
                                            
<h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_40'];?>
</h1>
<div id="salle_de_controle">
    
    <div name="couverture" data-nom_univers="horizon">
        <!-- En haut à droite : affiche deux liens vers des pages qui permettent d'aider les débutants : guide et mission -->
       <div name="aide_debutant">
            <a href="?page=achievements" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_37'];?>
');" onmouseout="cache();"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_38'];?>
</a><br />
			
            
        </div> 
 <!-- En haut à gauche : DEFCON de l'alliance du joueur -->
 
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'GeTransportCount\']->value!=0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

 <div name="situation_irreguliere" class="rouge">
            <span onmouseover="montre('&nbsp;<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_push_1\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
');" onmouseout="cache();" style="cursor : help;"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_push_2\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
        </div>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'userally\']->value!=0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

        <div name="defcon_alliance" class="cyan">
            <span onmouseover='montre("&nbsp;DEFCON : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'defcontext\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
");' 
                  onmouseout="cache();" style="cursor : help;"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_36\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <b>level <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'defcon\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</b></span>
        </div>
             <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 
			 
			 
        <!-- Bandeau noir avec les informations sur le compte -->
        <div name="bandeau_noir">
            <!-- Détail du compte : pseudo, tag alliance, points, classement et progression -->
            <div name="information_joueur">
                <img name="avatar_joueur" src="styles/avatars/<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'avatar\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" />

                <div name="pseudo">
                    <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'username\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'userally\']->value!=0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<span class="couleur_alliance">

    [<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'ally_tag\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
]

</span><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<!--
                    -->                </div>

                <div name="statistique">
                                                            
                    <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_34'];?>
 : <a href="javascript:SalleDeControle.toggleStatistique();" onmouseout="cache();"
                                        onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_35'];?>
.');"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'totalP\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</a> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_18'];?>
 
                    <div data-js="stat_progression" ><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'cokies\']->value==\'false\'){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
&mdash; 
                         <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'postalP\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_18\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
                                            </div><br />
                    
                    <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_33'];?>
 :  <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'userRank\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 / <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'userTotal\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 
                    <div data-js="stat_progression" ><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'cokies\']->value==\'false\'){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
&mdash; 
                          <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'postal\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_39\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
                                            </div><br />
                </div>
            </div>

            <!-- Détail de l'alliance si le joueur en possède une : nom, points et classement -->
          

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'allyID\']->value==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

		  <div <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'cokies\']->value==\'false\'){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 style="display: block;"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
style="display: none;"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 name="information_alliance" >
                                    <div name="sans_alliance">
                        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_32\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br />
                        <a href="?page=alliance"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_31\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</a>
                    </div>
                            </div>
							<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

							<div <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'cokies\']->value==\'false\'){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 style="display: block;"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
style="display: none;"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 name="information_alliance">
                                    
                    <div name="nom">
                        <a href="?page=alliance" onmouseover="montre('<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_29\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
');" onmouseout="cache();"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_30\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'ally_name\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</a>
                    </div>
                    <div name="statistique">
                        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'ally_memberss\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>
                        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_28\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'ally_rank\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 / <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'Total_alliance\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 
                    </div>
                            </div>
							<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

					
							
           
            <!-- Le détails des points pour les statistiques du compte -->
            <div <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'cokies\']->value==\'true\'){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 style="display: block;"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
style="display: none;"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 name="detail_statistique" ><!--
                --><div class="element"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_27'];?>
 :    <span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'totalBuild\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_18'];?>
</div><!--
                --><div class="element"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_26'];?>
 :    <span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'totalOwnShips\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_18'];?>
</div><!--
                --><div class="element"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_25'];?>
 : <span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'totalResearch\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_18'];?>
</div><!--
                --><div class="element"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_24'];?>
 :     <span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'totalDefense\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_18'];?>
</div><!--
				--><div class="element"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_655'];?>
 :    <span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'totalFleet\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_18'];?>
</div><!--
                --><div class="element"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_23'];?>
 :  <span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'totalPopu\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_18'];?>
</div><!--
            --></div>
			
        </div>
            
        <!-- Bandeau de « news » qui défile sous le bandeau noir ci-dessus : toute l'actualité du serveur -->
        <div name="bandeau_news" onmouseover="SalleDeControle.pauseBandeauNews();" onmouseout="SalleDeControle.reprendreBandeauNews();">
            <ul data-js="defilement">
                               
							   <li name="numero_auto_1"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_22'];?>
</li>
								<li name="numero_auto_2"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bank_43'];?>
 : 
                                          <span class="taux <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'taxe_metal\']->value<0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'taxe_metal\']->value>0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
+<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'taxe_metal\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 %</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bank_44'];?>
, 
                                          <span class="taux <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'taxe_crystal\']->value<0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'taxe_crystal\']->value>0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
+<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'taxe_crystal\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 %</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bank_45'];?>
,
                                          <span class="taux <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'taxe_deuterium\']->value<0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'taxe_deuterium\']->value>0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
+<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'taxe_deuterium\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 %</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bank_46'];?>
 
                                          <span class="taux <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'taxe_elyrium\']->value<0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'taxe_elyrium\']->value>0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
+<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'taxe_elyrium\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 %</span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_bank_47'];?>
</li>	
								<li name="numero_auto_3"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'journalLog\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>
                             <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'i\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'i\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'k\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'AllFeeds\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'i\']->key => $_smarty_tpl->tpl_vars[\'i\']->value){
$_smarty_tpl->tpl_vars[\'i\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'k\']->value = $_smarty_tpl->tpl_vars[\'i\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                                <li name="numero_<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'feedID\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'message\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 </li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                            </ul>
        </div>
            
        <!-- Nous mettons sur le logo « Live news », un lien cliquable permettant d'écrire une news -->
        <div name="logo_news" onclick="window.location.replace('?page=Hln')"
             onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_21'];?>
');" onmouseout="cache();"></div>
    </div>
     
            
    
    <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'fleetCount\']->value==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

    
   <h2 class="titre_corps">
        <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/strategie.png" />
        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_18\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

    </h2>
    <div name="liste_flotte" class="categorie_speciale">
                    <!-- Il n'y a pas de flotte de détecté dans les capteurs -->
            <div style="padding : 10px 0px;" class="vert"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_19\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.</div>
            </div>
			
			<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

			
			<h2 class="titre_corps">
        <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/strategie.png" />
       <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_18\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

    </h2>
    <div name="liste_flotte" class="categorie_speciale">
                    <!-- Il y a au moins une flottes de détecté -->
            <div style="padding : 10px 0px;" class="rouge" id="fleetcallresponse">
                                    <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleetCount1\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                            </div>
            
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'fleet\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'fleet\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'index\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'fleets\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'fleet\']->key => $_smarty_tpl->tpl_vars[\'fleet\']->value){
$_smarty_tpl->tpl_vars[\'fleet\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'index\']->value = $_smarty_tpl->tpl_vars[\'fleet\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
                           
<!-- Affichage de la flotte n°<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetID\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 -->
<div name="flotte" data-id_flotte="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetID\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" data-mission="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'mission\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" data-statut="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetmes\']==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_15\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_16\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
">
    <!-- Affiche les informations principales sur la flotte -->
    <div name="information_principale">
        <div name="mission">
            <!-- Nom de la mission ainsi que le temps restant avant l'accomplissement de celle-ci -->
            <!--<img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission.png" /> -->
            <span class="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'fleet\']->value[\'missioncolor\']==1&&$_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetOwner\']==$_smarty_tpl->tpl_vars[\'userID\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'fleet\']->value[\'missioncolor\']==1&&$_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetOwner\']!=$_smarty_tpl->tpl_vars[\'userID\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'fleet\']->value[\'missioncolor\']==3){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
chartreuse<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'fleet\']->value[\'missioncolor\']==4){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
orange<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'fleet\']->value[\'missioncolor\']==6){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
violet<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'fleet\']->value[\'missioncolor\']==7){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
jaune<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'fleet\']->value[\'missioncolor\']==8){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
marron<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'fleet\']->value[\'missioncolor\']==12){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
cyan<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'fleet\']->value[\'missioncolor\']==17){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
orange<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'mission\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
             — 
            <span id="fleettime_<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetID\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" class="fleets" data-fleet-end-time="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'returntime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" data-fleet-time="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'resttime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'resttime\'];?>
<?php $_tmp1=ob_get_clean();?><?php echo pretty_fly_time($_tmp1);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
					
		
                    </div><!--
        --><div name="trajet">
            <!-- Parcours que la flotte doit effectuer : nom des planètes ainsi que les pseudos des joueurs concernés -->
            <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/planete.png">
      <!-- Planète et joueur de départ -->
                <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'text\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                    </div><!--
        --><div name="detail">
            <!-- Affiche les informations suivantes : le nombre de vaisseau et le sens du trajet : « aller » ou « retour » -->
            <span onclick="javascript:SalleDeControle.afficherInformationFlotte(<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetID\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
);" style="cursor : pointer;" onmouseover="montre('<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_695\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
');" onmouseout="cache();">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/info.png">
                                     
                            </span> 
                                          &nbsp;—&nbsp;<span class="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetmes\']==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
cyan<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetmes\']==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_15\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_16\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>            
                           <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetmes\']==0&&$_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetOwner\']==$_smarty_tpl->tpl_vars[\'userID\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

						   <!-- Lien qui permet au joueur de demander le retour de sa flotte -->
                <a onclick="javascript:SalleDeControle.faireRetourFlotte('<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetID\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
')" onmouseover="montre('<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_4\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
');" onmouseout="cache();"><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/fleche_ronde.png"></a><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                    </div>
    </div> 



	
    <!-- Affiche les informations secondaires sur la flotte -->
	<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetOwner\']==$_smarty_tpl->tpl_vars[\'userID\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

    <div style="display: none;" name="information_secondaire">
        
                <div class="partie">
            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_1\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>                       
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetMission\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_2\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :                              <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetmes\']==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_15\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_16\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>                       
                            <!-- Lien qui permet au joueur de demander le retour de sa flotte -->
                <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetmes\']==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<a onclick="javascript:SalleDeControle.faireRetourFlotte('<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetID\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
')" onmouseover="montre('<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_4\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
');" onmouseout="cache();">&gt;&gt; <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_3\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</a><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>
                    </div>                               
                <div class="partie">
            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_5\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>       
                            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_6\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetAmount\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>
                            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_7\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class="orange">0</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                    </div>
                <div class="partie">
            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_8\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
                            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_9\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetStart\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>
                            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_10\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetStay\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                            <br><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_11\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetEnd\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                    </div>
                <div class="partie">
            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_12\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_13\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class="orange">24</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                            <br><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_14\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class="orange">24</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                    </div>
                <div class="partie">
            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_15\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
            
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_16\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class="orange">600</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>
                            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_17\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetNameStart\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 [<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetStartSys\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
:<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetStartPla\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
]<br>
                <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_18\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetNameEnd\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 [<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetEndSys\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
:<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetEndPla\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
]
                    </div>
            </div>                                                                                       
			<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

			<div style="display: none;" name="information_secondaire">
        
                <div class="partie">
            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_1\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>

            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetMission\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_2\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :                              <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_696\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>
           
                    </div>
                <div class="partie">
            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_8\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_10\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetStay\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

 </div>
<div class="partie">
            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_15\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
            
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_16\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class="orange">600</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<br>
                            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_17\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetNameStart\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 [<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetStartSys\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
:<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetStartPla\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
]<br>
                <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_detailflo_18\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetNameEnd\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 [<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetEndSys\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
:<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'fleet\']->value[\'fleetEndPla\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
]
                    </div>
            </div>

			<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

			
</div>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

          </div>           
    
    <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

     <h2 class="titre_corps">
        <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/maison.png" />
        <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_15'];?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'planetname\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 [<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'system\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
:<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'planet\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
]
    </h2>
    <div name="planete_information" class="categorie_speciale"><!--
        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'overmessage\']->value==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

       --><div name="liste_construction"> 
 
                            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_14\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
                <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_13\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.<br />
                
                <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_12\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
                
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_11\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                    </div><!-- 
					<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

					--><div name="liste_construction"> 


 <!-- On indique le titre selon le type d'entité -->
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_453\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'id\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.jpg" /><!--
                        --><div name="nom">
                                                            
                             <span  onmouseout="cache();" onmouseover="montre('<div style=\'min-width : 250px;\'>                <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'page_gestion_12\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 - <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'id\']];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</b> (<span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'RessAmount\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'RessID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'price\']; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'RessAmount\']->key => $_smarty_tpl->tpl_vars[\'RessAmount\']->value){
$_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'RessID\']->value = $_smarty_tpl->tpl_vars[\'RessAmount\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'RessID\']->value];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'RessAmount\']->value);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
         </ul>                <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_3\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_5\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'starttimeego\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_6\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'endtime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_4\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'elementime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span></li>        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_7\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'percenting\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
%</span></li>                            </ul></div>');" style="cursor : help;"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'id\']];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
                             (<span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'timeleft\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'buildings\'][\'starttime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</div><!--
                    --></div>  
                         <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
   


 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_454\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'id\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.jpg" /><!--
                        --><div name="nom">
                                                            
                             <span onmouseout="cache();" onmouseover="montre('<div style=\'min-width : 250px;\'>                <b>Development - <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'id\']];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</b> (<span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'RessAmount\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'RessID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'price\']; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'RessAmount\']->key => $_smarty_tpl->tpl_vars[\'RessAmount\']->value){
$_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'RessID\']->value = $_smarty_tpl->tpl_vars[\'RessAmount\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'RessID\']->value];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'RessAmount\']->value);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
         </ul>                <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_3\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_5\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'starttimeego\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_6\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'endtime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_4\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'elementime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span></li>        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_7\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'percenting\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
%</span></li>                            </ul></div>');" style="cursor : help;"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'id\']];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
                             (<span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'timeleft\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'tech\'][\'starttime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</div><!--
                    --></div>
                         <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
  						 
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_455\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'id\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.gif" /><!--
                        --><div name="nom">
                                                            
                             <span onmouseover="montre('<div style=\'min-width : 250px;\'>                <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'page_gestion_12\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 - <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'id\']];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</b> (<span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                                <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'RessAmount\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'RessID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'price\']; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'RessAmount\']->key => $_smarty_tpl->tpl_vars[\'RessAmount\']->value){
$_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'RessID\']->value = $_smarty_tpl->tpl_vars[\'RessAmount\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'RessID\']->value];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'RessAmount\']->value*$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'level\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
                                            </ul>                <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_3\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_1\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'timelefts\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_2\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'endtime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>            </ul></div>');" onmouseout="cache();" style="cursor : help;"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'id\']];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
                             (<span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'timeleft\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'fleet\'][\'starttime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</div><!--
                    --></div>
                         <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
  

                  <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_461\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'id\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.gif" /><!--
                        --><div name="nom">
                                                            
                             <span onmouseover="montre('<div style=\'min-width : 250px;\'>                <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'page_gestion_12\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 - <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'id\']];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</b> (<span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                                <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'RessAmount\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'RessID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'price\']; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'RessAmount\']->key => $_smarty_tpl->tpl_vars[\'RessAmount\']->value){
$_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'RessID\']->value = $_smarty_tpl->tpl_vars[\'RessAmount\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'RessID\']->value];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'RessAmount\']->value*$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'level\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
                                            </ul>                <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_3\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_1\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'timelefts\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_2\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'endtime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>            </ul></div>');" onmouseout="cache();" style="cursor : help;"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'id\']];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
                             (<span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'timeleft\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'defense\'][\'starttime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</div><!--
                    --></div>
                         <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
                                       
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                            <h3><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_456\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</h3>
                                        
                    <!-- Affiche la liste des construction pour ce type d'entité -->
                                                            <div name="construction"><!--
                        --><img src="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'image\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" /><!--
                        --><div name="nom">
                                                            
                             <span onmouseover="montre('<div style=\'min-width : 250px;\'>                <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'page_gestion_12\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 - <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'nom\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</b> (<span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                                <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'RessAmount\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'RessID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'price\']; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'RessAmount\']->key => $_smarty_tpl->tpl_vars[\'RessAmount\']->value){
$_smarty_tpl->tpl_vars[\'RessAmount\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'RessID\']->value = $_smarty_tpl->tpl_vars[\'RessAmount\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'RessID\']->value];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
  : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'RessAmount\']->value*$_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'level\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'lm_achat_units\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li> <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
                                            </ul>                <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_3\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_1\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'timelefts\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>        <li><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_ovbuild_2\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'endtime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</li>            </ul></div>');" onmouseout="cache();" style="cursor : help;"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'nom\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>
                             (<span class="orange"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'level\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>) :
                        </div><!--
                        --><div name="compteur" class="decompte_actualise"
                                data-time="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'timeleft\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'buildInfo\']->value[\'ownship\'][\'starttime\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</div><!--
                    --></div>
                         <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                    </div><!--
					
					<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

					

        --><div name="planete">
            <!-- Nom de la planète actuelle -->
            <span name="nom" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_46'];?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'planetname\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
');" onmouseout="cache();">
               <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'planetname\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 [<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'system\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
:<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'planet\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
]
            </span><br />
            
            <!-- Indique à l'utilisateur le nombre de slots restants sur cette planète -->
            <span onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_10'];?>
.');" onmouseout="cache();" style="cursor : help;">
                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_9'];?>
 : <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'planet_field_current\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 / <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'planet_field_max\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

            </span>
            
                                                            
            <p>
                <!-- Information sur le portail : activer ou désactiver -->
                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_8'];?>
 : 
                 
                    <span class="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'teleport_portal\']->value==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'teleport_portal\']->value==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_5\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_6\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span><br />  
                                
                <!-- Information sur le champ de force du portail : activer ou désactiver -->
                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_7'];?>
 : 
                 
                    <span class="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'force_field\']->value<$_smarty_tpl->tpl_vars[\'trem\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'force_field\']->value<$_smarty_tpl->tpl_vars[\'trem\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_5\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_6\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span><br />  
                            </p>
            
            <p>
                <!-- Information sur le siège des Antaris : activer ou désactiver -->
                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_4'];?>
 : 
                                    <span class="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'siege_active\']->value<$_smarty_tpl->tpl_vars[\'TIMESTM\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'siege_active\']->value<$_smarty_tpl->tpl_vars[\'TIMESTM\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_5\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_6\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span><br />
                                
                <!-- Information sur l'avant poste des Antaris : nombre de drones -->
                <?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_42'];?>
 : 
                <a class="orange" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_41'];?>
');" onmouseout="cache();"
                   >0</a> drones
            </p>
            
            <p>
                <!-- Lien vers la page qui permet de modifier la planète ou de l'abandonner -->
                <a href="?page=Tower" onmouseout="cache();"
                   onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_2'];?>
.');"><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_overview_3'];?>
</a>
            </p>
        </div><!--
        
    --></div>
    
    
    
    
    <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'GetAll99\']->value<1){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

            <h2 class="titre_corps">
            <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/aide.png" />
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_20\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

        </h2>
        
        <!-- Si le joueur ne possède que sa planète mére, on lui affiche quelques conseils et explications -->
        <div name="aide_empire" class="categorie_speciale">
          <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_1\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

        </div>
		
		<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

		     <h2 class="titre_corps">
            <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/globe.png" />
            <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_45\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 (<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'GetAll99\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
)
        </h2>
       <!-- Affiche l'ensemble des planète de l'empire avec une scrollbar horizontal -->
        <div name="liste_planete" class="categorie_speciale"><!--
		<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'i\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'i\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'k\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'AllPlanetsBis\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'i\']->key => $_smarty_tpl->tpl_vars[\'i\']->value){
$_smarty_tpl->tpl_vars[\'i\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'k\']->value = $_smarty_tpl->tpl_vars[\'i\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                    --><div name="planete">
                <div name="illustration">
                    <!-- Image de la planète -->
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/planet/<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'planet\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.jpg" onmouseover="montre('<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_44\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
');" onmouseout="cache();" 
                         onclick="location.href='game.php?page=overview&cp=<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'id\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
';" />
                
                    <!-- Slots restant sur le slot total de la planète -->
                    <div name="slot" onmouseover="montre('<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_overview_43\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
');" onmouseout="cache();" >
                        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'field_current\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 / <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'field_max\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                    </div>
                </div>
                
                <!-- Nom de la planète et ressources -->
                <div name="information">
                    <a onclick="location.href='game.php?page=overview&cp=<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'id\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
';" class="nom_planete"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'name\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 [<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'system\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
:<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'i\']->value[\'planet\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
]</a><br />

                                        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][901];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'i\']->value[\'metal\']>=$_smarty_tpl->tpl_vars[\'i\']->value[\'metal_max\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
class="rouge"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'i\']->value[\'metal\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span><br />
                                        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][902];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'i\']->value[\'crystal\']>=$_smarty_tpl->tpl_vars[\'i\']->value[\'crystal_max\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
class="rouge"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'i\']->value[\'crystal\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span><br />
                                        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][903];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'i\']->value[\'deuterium\']>=$_smarty_tpl->tpl_vars[\'i\']->value[\'deuterium_max\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
class="rouge"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'i\']->value[\'deuterium\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span><br />
										<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][904];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'i\']->value[\'elyrium\']>=$_smarty_tpl->tpl_vars[\'i\']->value[\'elyrium_max\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
class="rouge"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'i\']->value[\'elyrium\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span><br />
                                       
                                    </div>
            </div><!--<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                        --></div>
        

		
		<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 
		 
        
</div>
        
<script type="text/javascript">
    $(document).ready(function(){
        SalleDeControle.initialiser(); 
    });
</script></div>                    <!-- Fin du corps -->
           
            
          

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'cronjob\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'cronjob\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'cronjobs\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'cronjob\']->key => $_smarty_tpl->tpl_vars[\'cronjob\']->value){
$_smarty_tpl->tpl_vars[\'cronjob\']->_loop = true;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<img src="cronjob.php?cronjobID=<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'cronjob\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" alt=""><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->getSubTemplate ("main.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:53:37
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.header.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a81f0c1a91257_15519759')) {function content_5a81f0c1a91257_15519759($_smarty_tpl) {?>      <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <!-- Auteur(s) : Baukens Jeremy -->
    <!-- Site : Antaris Legacy -->
    <!-- Année : 2016 -->

    <!-- Debut du head -->
    <head>
        <!-- Title de la page -->
        <title><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'uni_name\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 - <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'game_name\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</title>

        <!-- Déclarations des balises meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'languageuser\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" />
        <meta name="author" content="Jeremy Baukens" />
        <meta name="copyright" content="Jeremy Baukens" />
        <meta name="gameowner" content="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'admin_name\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" />
        <meta name="gamecontact" content="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'admin_email\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" />
        <meta name="description" content="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'meta_descrip\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" />
        <meta name="keywords" content="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'meta_title\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
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
		 <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/lang/<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'languageuser\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.js"></script>
         <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/main_compresser.min.js"></script>
		 
				<script type="text/javascript">
	var ServerTimezoneOffset = <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'Offset\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
;
	var serverTime 	= new Date(<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[0];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
, <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[1]-1;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
, <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[2];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
, <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[3];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
, <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[4];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
, <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'date\']->value[5];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
);
	var startTime	= serverTime.getTime();
	var localTime 	= serverTime;
	var localTS 	= startTime;
	var Gamename	= document.title;
	var Ready		= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ready'];?>
";
	var Skin		= "<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'dpath\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
";
	var Lang		= "<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
";
	var head_info	= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['fcm_info'];?>
";
	var auth		= <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo (($tmp = @$_smarty_tpl->tpl_vars[\'authlevel\']->value)===null||$tmp===\'\' ? \'0\' : $tmp);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
;
	var days 		= <?php echo (($tmp = @json_encode($_smarty_tpl->tpl_vars['LNG']->value['week_day']))===null||$tmp==='' ? '[]' : $tmp);?>
 
	var months 		= <?php echo (($tmp = @json_encode($_smarty_tpl->tpl_vars['LNG']->value['months']))===null||$tmp==='' ? '[]' : $tmp);?>
 ;
	var tdformat	= "<?php echo $_smarty_tpl->tpl_vars['LNG']->value['js_tdformat'];?>
";
	var queryString	= "<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo strtr($_smarty_tpl->tpl_vars[\'queryString\']->value, array("\\\\" => "\\\\\\\\", "\'" => "\\\\\'", "\\"" => "\\\\\\"", "\\r" => "\\\\r", "\\n" => "\\\\n", "</" => "<\\/" ));?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
";
	var voterid     = <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'userID\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
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
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/l18n/validationEngine/jquery.validationEngine-<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.js"></script>
	

	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/tooltip.js"></script>
	
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/base.js"></script>
	<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'scriptname\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'scriptname\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'scripts\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'scriptname\']->key => $_smarty_tpl->tpl_vars[\'scriptname\']->value){
$_smarty_tpl->tpl_vars[\'scriptname\']->_loop = true;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'scriptname\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.js"></script>
	<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

	
	<script type="text/javascript">
	$(function() {
		<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'execscript\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

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
                    <li><?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_overview'];?>
</li>
                </ul>
				
				  <div class="icones">
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/bug.png" onclick="#" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_8'];?>
.');" onmouseout="cache();" data-nom="bug">
                    <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/facebook.png" onclick="javascript:window.open('https://www.facebook.com/Control-Panel-890372641089987/'); return false;" onmouseover="montre('<?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_9'];?>
');" onmouseout="cache();" data-nom="facebook">
                 
				 
                </div>
				
		
            </div>
<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:53:37
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.navigation.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a81f0c1add733_00856933')) {function content_5a81f0c1add733_00856933($_smarty_tpl) {?><!-- Le menu à gauche -->
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
                    <li>Time : <span name="horloge" data-timestamp="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'timestamp\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"></span></li>
                    <li><span name="nb_connecte" style="font-weight : bold;"></span> <?php echo $_smarty_tpl->tpl_vars['LNG']->value['lm_connected'];?>
</li>
                </ul>
            </div><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:53:37
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.topnav.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a81f0c1be6ab2_05037848')) {function content_5a81f0c1be6ab2_05037848($_smarty_tpl) {?>          <!-- Le corps de la page -->
            <div id="corps">
              
        <div id="ressource_contenu"><!-- On affiche le titre pour les ressources -->
<h1><?php echo $_smarty_tpl->tpl_vars['LNG']->value['ls_topnav_7'];?>
</h1>


<div class="selection_planete">
     <select id="select_custom">
	 
	 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'x\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'x\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'AllPlanetsBis\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'x\']->key => $_smarty_tpl->tpl_vars[\'x\']->value){
$_smarty_tpl->tpl_vars[\'x\']->_loop = true;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

                <option value="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'id\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" data-imagesrc="https://cdngames.antaris-legacy.eu/media/ingame/planet/<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'image\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
.jpg" <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'current_pid\']->value==$_smarty_tpl->tpl_vars[\'x\']->value[\'id\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
selected="selected"<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
                data-description="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_448\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class='<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'teleport_portal\']==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'teleport_portal\']==0){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
OFF<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
ON<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> - <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_449\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class='<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'force_field_timer\']>$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'force_field_timer\']>$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
ON<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
OFF<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> - <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_450\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class='<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'siege_on\']<$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
rouge<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
vert<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'x\']->value[\'siege_on\']<$_smarty_tpl->tpl_vars[\'timestamp\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
OFF<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
ON<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>">
                [<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'system\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
:<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'planet\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
] <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'x\']->value[\'name\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</option>
				
			<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
	

            </select>
</div>


 <!-- Pour afficher l'énergie sur la planète toute à droite -->

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'resourceTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if (!isset($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'])){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php $_smarty_tpl->createLocalArrayVariable(\'resouceData\', true, 0);
$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'] = $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']+$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'used\'];?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

<div class="darkmatter" onmouseover="montre(' <div style=\'padding : 2px 8px; min-width : 170px;\'>                                              <b>  <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'resourceID\']->value];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_6\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</b><br />                                              — <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_5\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span><br />                                                                                      </div>');" onmouseout="cache();">
   <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']>999999999999){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo shortly_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

</div>

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

	<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

									<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>


<!-- Permet d'afficher les ressources -->
<div class="conteneur_ressource">


<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'resourceTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if (!isset($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'])){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php $_smarty_tpl->createLocalArrayVariable(\'resouceData\', true, 0);
$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'] = $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']+$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'used\'];?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

    <!-- Le fer -->
    <div class="item_ressource <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" id="current_<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"  name="<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
" onmouseover="montre(' <div style=\'padding : 2px 8px; min-width : 170px;\'>                                                      <b><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_4\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'tech\'][$_smarty_tpl->tpl_vars[\'resourceID\']->value];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 :</b><br />                                                    — <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'NOUVEAUTE_846\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> u.<br />  — <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_1\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'bunker\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> u.<br />                                                      — <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_2\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span> u.<br />                                                      — <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'ls_topnav_3\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
 : <span class=\'orange\'><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'percent\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span>%                                                  </div>');" onmouseout="cache();">
        <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if ($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']>=$_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<span class="rouge"><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</span><?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }else{ ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo pretty_number($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

    </div>
	<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

									<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>


	
	
	
    <div class="espace"></div>
</div>
<div class="espace"></div>
<!-- On appel le javascript nécessaire pour customizer le select pour les planètes -->
<script type="text/javascript">$('select#select_custom').ddslick({ width : 220 });</script>
<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if (!$_smarty_tpl->tpl_vars[\'vmode\']->value){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

		<script type="text/javascript">
		var viewShortlyNumber	= <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'shortlyNumber\']->value);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
;
		var vacation			= <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'vmode\']->value;?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
;
		<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php  $_smarty_tpl->tpl_vars[\'resouceData\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'resouceData\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'resourceID\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'resourceTable\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'resouceData\']->key => $_smarty_tpl->tpl_vars[\'resouceData\']->value){
$_smarty_tpl->tpl_vars[\'resouceData\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'resourceID\']->value = $_smarty_tpl->tpl_vars[\'resouceData\']->key;
?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

		<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php if (isset($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'production\'])){?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

		resourceTicker({
			available: <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'current\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
,
			limit: [0, <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'max\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
],
			production: <?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'resouceData\']->value[\'production\']);?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
,
			valueElem: "current_<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php echo $_smarty_tpl->tpl_vars[\'resouceData\']->value[\'name\'];?>
/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
"
		}, true);
		<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

		<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php } ?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>

		</script>
		<?php echo '/*%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/<?php }?>/*/%%SmartyNocache:6859878885a81f0c1a84551-10348437%%*/';?>
</div><?php }} ?>