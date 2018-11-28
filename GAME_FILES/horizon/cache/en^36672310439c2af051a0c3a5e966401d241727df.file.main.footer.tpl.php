<?php /* Smarty version Smarty-3.1.13, created on 2018-02-12 20:53:36
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19827648205a81f0c0c212d5-67356956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36672310439c2af051a0c3a5e966401d241727df' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/game/main.footer.tpl',
      1 => 1508112532,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19827648205a81f0c0c212d5-67356956',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LNG' => 0,
    'langen' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a81f0c0c25f08_07063417',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a81f0c0c25f08_07063417')) {function content_5a81f0c0c25f08_07063417($_smarty_tpl) {?> </div>
            <div class="espace"></div>
        
            
            <!-- On affiche le copyright -->
            <div id="bar_copyright">
                © <?php echo $_smarty_tpl->tpl_vars['LNG']->value['NOUVEAUTE_164'];?>
 - 
                <span name="temps_execution"></span> sec <span style="float:right;"><select onchange="window.open(this.options[this.selectedIndex].value,'_top')"><option <?php if ($_smarty_tpl->tpl_vars['langen']->value==2){?>selected<?php }?> value="game.php?page=changelang&langs=fr">French</option><option value="game.php?page=changelang&langs=en" <?php if ($_smarty_tpl->tpl_vars['langen']->value==1){?>selected<?php }?>>English</option></select></span>
            </div>
        
        <!-- Fin de l'ensemble -->
        </div>
                
        <!-- Cet élément « script » doit être obligatoirement en bas de la page -->
        <script type="text/javascript">
            CookieMethode.supprimer('application-cle_cryptage');
            CookieMethode.creer('application-cle_cryptage', 'zI85DfBGGf80NlhI96gd4fdNbYhQXumNmislA2f73BAlNYwnP1ZnAVotsHyLKCAcEjOlo7lJyfr0hdZy9G18Yg', 0);
        </script>
    </body>
</html><?php }} ?>