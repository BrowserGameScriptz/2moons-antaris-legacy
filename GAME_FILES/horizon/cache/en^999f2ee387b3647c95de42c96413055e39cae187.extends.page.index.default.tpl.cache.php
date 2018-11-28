<?php /* Smarty version Smarty-3.1.13, created on 2018-02-13 03:19:39
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/login/page.index.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3787914935a824b3b5be285-76521172%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '999f2ee387b3647c95de42c96413055e39cae187' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/login/page.index.default.tpl',
      1 => 1508112539,
      2 => 'file',
    ),
    '55ce944d76d0e57fc11be7d6008851ee3f435ab7' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/login/layout.light.tpl',
      1 => 1508112539,
      2 => 'file',
    ),
    'd61e976807c1618cfaafe7646b8a827b18ba73ab' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/login/main.header.tpl',
      1 => 1508112539,
      2 => 'file',
    ),
    '8d5ddff0ab14d892b2bb707a9c252a6b166f9090' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/login/main.navigation.tpl',
      1 => 1508112539,
      2 => 'file',
    ),
    '634370fa651563f3f751deb8863c56d0ede20bfc' => 
    array (
      0 => '/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/login/main.footer.tpl',
      1 => 1508112539,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3787914935a824b3b5be285-76521172',
  'function' => 
  array (
  ),
  'has_nocache_code' => true,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a824b3b5f8c42_23453140',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a824b3b5f8c42_23453140')) {function content_5a824b3b5f8c42_23453140($_smarty_tpl) {?><?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php $_smarty = $_smarty_tpl->smarty; if (!is_callable(\'smarty_function_html_options\')) include \'/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/includes/libs/Smarty/plugins/function.html_options.php\';
?>/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
<?php /*  Call merged included template "main.header.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0, '3787914935a824b3b5be285-76521172');
content_5a824b3b5c69a9_85107427($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.header.tpl" */?>
<?php /*  Call merged included template "main.navigation.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0, '3787914935a824b3b5be285-76521172');
content_5a824b3b5d7446_29767029($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.navigation.tpl" */?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <!-- Auteur(s) : DUBUFFET Thomas -->
    <!-- Site : Antaris Legacy -->
    <!-- Début du projet : octobre 2011 -->
    <!-- Dernière mise à jour du portail : juin 2013 -->


      
                
            <!-- Le corps de la page -->
            <div id="corps"><div id="page_contenu"><noscript><meta http-equiv="refresh" content="0; url=index.php?page=nojs"></noscript><div id="page_accueil">
    <!-- Le titre de la page et JavaScript -->

	<script type="text/javascript">
	var PageAccueil = {
    /**
     * Cette fonction permet de lancer le formulaire de connexion pour accÃ©der Ã  un compte d'un univers
     * @author Thomas Dubuffet <thomas.dubuffet@free.fr>
     * @param string $nom_domaine le nom de domaine du site
     * @return void
     */
    formulaireConnexion : function() {
        var $form   = $('div#page_accueil form#form_se_connecter');
        var $option = $form.find('select#univers').find('option:selected');

        $form.attr('action', 'http://' + $option.val() + '.' + ApplicationMethode.nom_domaine);
    },
    
    /**
     * Cette fonction sert Ã  afficher un article en particulier dans le flux d'actualitÃ© 
     * @author Thomas Dubuffet <thomas.dubuffet@free.fr>
     * @param int $num_page le numÃ©ro de page Ã  afficher
     * @return void
     */
     afficherArticle : function(num_page) {
        $('div#actualite div.article').css('display', 'none');
        $('div#actualite div#article_num_' + num_page).css('display', 'block');
        
        $('div#actualite div.gestion_pagination > a').removeClass('activer');
        $('div#actualite div.gestion_pagination > a[name="' + num_page + '"]').addClass('activer');
     }
};
</script>
    <!-- Sous-titre : pour se connecter à un compte -->
    <h1>Connect to a universe</h1>
    <div class="fond_login">
      
	 <form id="login" name="login" action="index.php?page=login" data-action="index.php?page=login" method="post">
            <label for="univers">Univers :</label>
            <select name="uni" id="universe" class="changeAction"><?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo smarty_function_html_options(array(\'options\'=>$_smarty_tpl->tpl_vars[\'universeSelect\']->value,\'selected\'=>$_smarty_tpl->tpl_vars[\'UNI\']->value),$_smarty_tpl);?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
</select>

            <input type="text" id="pseudo" name="username" maxlength="20" placeholder="Username" />
            <input type="password" id="mdp" name="password" maxlength="32" placeholder="Password" />

            <input type="submit" id="valid_form" name="valid_form" value="Play !" />
        </form>
		
		
        <div class="mdp_perdu">
            <a href="index.php?page=LostPassword" title="To recover a lost password.">Forgot Password?</a>
        </div>
    </div>

    <!-- Sous-titre : image d'illustration d'actualité -->
    <h1 class="titre_illustration">Welcome to a new world of Science Fiction !</h1>
            <img class="illustration" src="/media/image_annonce/sortie_horizon_num2.jpg" alt="" />
        


    <!-- Sous-titre : pour afficher la dernière nouvelle -->
    <h1 class="titre_actualite">Latest Antaris Legacy news</h1>
    
    <!-- Pour gérer l'affichage des actualités -->
    <div id="actualite">
              
<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php  $_smarty_tpl->tpl_vars[\'newsRow\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'newsRow\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'newsList\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'newsRow\']->key => $_smarty_tpl->tpl_vars[\'newsRow\']->value){
$_smarty_tpl->tpl_vars[\'newsRow\']->_loop = true;
?>/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>

			  <!-- Un article -->
        <div id="article_num_<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'newsRow\']->value[\'id\'];?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
" class="article <?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php if ($_smarty_tpl->tpl_vars[\'newsRow\']->value[\'Rank\']==1){?>/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
display<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php }else{ ?>/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
no_display<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php }?>/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
">
            <div class="titre"><?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'newsRow\']->value[\'title\'];?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
!</div>
            <div class="dateheure"><?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'newsRow\']->value[\'date\'];?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
</div>
            
            <div class="texte">
                <div class="guillemet ouvrir">&laquo;</div>
                <div class="guillemet fermer">&raquo;</div>

                
        <?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'newsRow\']->value[\'text\'];?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>

            
    
                
                 <div class="auteur">Written by <?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'newsRow\']->value[\'from\'];?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
</div>
            </div>
        </div>
                <!-- Un article -->
				<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php } ?>/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>

				
       
              
               
        <div class="gestion_pagination">
		
		<span class="titre">Articles :</span>
		<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php  $_smarty_tpl->tpl_vars[\'newsRow\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'newsRow\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'newsList\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'newsRow\']->key => $_smarty_tpl->tpl_vars[\'newsRow\']->value){
$_smarty_tpl->tpl_vars[\'newsRow\']->_loop = true;
?>/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>

		<a name="<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'newsRow\']->value[\'id\'];?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
" class="activer" onclick="javascript:PageAccueil.afficherArticle(<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'newsRow\']->value[\'id\'];?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
);"><?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'newsRow\']->value[\'id\'];?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
</a>
		<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php } ?>/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>

		</div>
    </div>
    
</div>
</div>            <!-- Fin du corps -->
            </div>
            <div class="espace"></div>
            
          

<?php /*  Call merged included template "main.footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("main.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0, '3787914935a824b3b5be285-76521172');
content_5a824b3b5f1f50_87968023($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "main.footer.tpl" */?><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-13 03:19:39
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/login/main.header.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a824b3b5c69a9_85107427')) {function content_5a824b3b5c69a9_85107427($_smarty_tpl) {?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'lang\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
" class="no-js"> <!--<![endif]-->
 <head>
        <!-- Title de la page -->
        <title><?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'LNG\']->value[\'siteTitleIndex\'];?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
 - <?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'gameName\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
</title>

        <!-- Déclarations des balises meta -->
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="fr" />
        <meta name="author" content="Jeremy Baukens" />
        <meta name="copyright" content="Jeremy Baukens" />
        <meta name="description" content="Antaris Legacy is a game management / strategy massively multiplayer browser based on a science fiction universe entirely invented." />
        <meta name="keywords" content="antaris, legacy, antaris legacy, science, fiction, science-fiction, jeu, game, jeu navigateur" />
        <meta name="Expires" content="never" />
        <meta name="rating" content="Tous public" />
        <meta name="subject" content="Antaris Legacy is a management/strategy browser game." />
        
        <meta name="viewport" content="width=device-width, maximum-scale=1"/>

        <!-- Fichier CSS et logo du site -->
        <!-- CSS utile : style_mozilla -->
        <link rel="stylesheet" media="screen" type="text/css" href="/media/style_mozilla.css" />
        <link rel="shortcut icon" type="image/x-icon" href="/design/image/favicon.png" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=ABeeZee|Electrolize">
          
        <!-- Les élements particuliers pour certains navigateurs : Mozilla/5.0 (Windows NT 6.3; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0 -->
                <!-- Fin des éléments particuliers -->

        <!-- Pour vérification du site via Google et pour l'HTML5 -->
		<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
		<meta name="google-site-verification" content="fz71vSLYhblGA96Iw-4JxgvuxUvR3ev1IwX2xLC0OkE" />
        
        <!-- Fichiers JavaScript : Plugins -->
        <script type="text/javascript" src="/media/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/media/apprise.js"></script>
        <script type="text/javascript" src="/media/jquery.columnizer.js"></script>
        <script type="text/javascript" src="/media/js/AjaxMethode.js"></script>
        <script type="text/javascript" src="/media/js/GestionMethode.js"></script>
        <script type="text/javascript" src="/media/js/ActionMethode.js"></script>
        <script type="text/javascript" src="/media/js/ApplicationMethode.js"></script>
        <script type="text/javascript" src="/media/js/fonction_infobulle.js"></script>
       
        <!-- Fichiers JavaScript : Application -->
     

    <!-- Fin du head -->
    </head>
<body id="<?php echo (($tmp = @htmlspecialchars($_GET['page']))===null||$tmp==='' ? 'overview' : $tmp);?>
" class="<?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'bodyclass\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
">

<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-13 03:19:39
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/login/main.navigation.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a824b3b5d7446_29767029')) {function content_5a824b3b5d7446_29767029($_smarty_tpl) {?>  <div id="curseur" class="infobulle"></div>
        
        <!-- Le haut de la page : image d'Antaris Legacy -->
        <div id="header"></div>
        
        <!-- Pour afficher la version du jeu -->
        <div id="version_jeu"></div>

        <!-- Ensemble de la page -->
        <div id="ensemble">
            <div id="bar_navigation">
                <ul>  
                    <li>Antaris legacy : Portal</li>
                    <li>Home</li>
                </ul>
                <div class="icones">
                    <img src="/media/image/icone/couleur/bug.png" onclick="javascript:window.open('forum'); return false;" 
                         onmouseover="montre('Report a bug on forum.');" onmouseout="cache();" />
                    <img src="/media/image/icone/couleur/repondre.png" onclick="location.href='index.php?page=newsletter';" 
                         onmouseover="montre('Subscribe to our newsletter');" onmouseout="cache();" />
                    <img src="/media/image/icone/couleur/facebook.png" onclick="javascript:window.open('https://www.facebook.com'); return false;" 
                         onmouseover="montre('Go to our Facebook page');" onmouseout="cache();" />
                   
                </div>
            </div>
            
            <!-- Le menu à gauche -->
            <div id="menu">
                <h1>The Game [Sci-fi]</h1>
                <ul>
                    <li><a onclick="location.href='index.php';" title="Go to Antaris Legacy homepage.">Home</a></li>
                    <li><a onclick="location.href='index.php?page=about';" title="View a quick presentation of the game.">Presentation</a></li>
                    <li><a onclick="location.href='index.php?page=register';" title="Create your account immediately on Antaris Legacy.">Register</a></li>
                </ul>
                <h1>Community</h1>
                <ul>
                    <li><a onclick="location.href='index.php?page=rulez';" title="Read the rules before you start playing.">Rules of the game</a></li>
                    <li><a onclick="location.href='index.php?page=terms';" title="Read the terms of use of our services.">Terms and Conditions</a></li> 
                    <li><a href="forum" title="Access the community forum.">Forum</a></li>
                    <li><a onclick="location.href='index.php?page=disclamer';" title="Send an email to the site administrator.">Contact us</a></li>
                    <li><a onclick="location.href='index.php?page=legal';" title="View website disclaimer.">Imprint</a></li>
                </ul>

                <!-- Statistiques des univers -->
                <h1>Statistics</h1>
                           
                                                                            <ul>
                        <li>&mdash; 
                            <span style="cursor : help;" onmouseover="montre('&mdash; Open since 19 april 2015<br />&mdash; Version of the univers : <span class=\'jaune\'>1.1</span>');" onmouseout="cache();">Univers 
                                <span style="font-weight:bold;cursor:pointer;">Horizon :</span>
                            </span>
                        </li>
                        <li><img class="serveur" src="/media/image/icone/couleur/serveur_fluide.gif" />Status : <span class="vert">Fluid</span></li>
                        <li>Nb. registered : <span class="orange"><?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'users_amount\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
</span></li>
                        <li>Nb. connected : <span class="vert"><?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'onLine\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
</span></li>
                    </ul>
                                                                                    </div>
            
            <!-- Une petite fiche de proposition d'inscription -->
            <div id="inscription_rapide">
                <a class="bouton" href="index.php?page=register" title="Create your account immediately on Antaris Legacy.">Conquer</a>
                <div class="texte">
                    We are in 2196, your people just discovered an alien artifact allows both to travel through the different worlds of the universe...
                </div>
            </div>

            <!-- Lien pour revenir en haut de la page facilement -->
            <div id="retour_haut">
                <a href="#" title="To return to the top of the page.">Back to top</a>
            </div><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2018-02-13 03:19:39
         compiled from "/var/www/vhosts/antaris-legacy.eu/httpdocs/universe/horizon/styles/templates/login/main.footer.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5a824b3b5f1f50_87968023')) {function content_5a824b3b5f1f50_87968023($_smarty_tpl) {?>  <!-- On affiche le copyright -->
            <div id="bar_copyright">
                <span id="temps_exec_page"><?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo $_smarty_tpl->tpl_vars[\'total_time\']->value;?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
</span> sec
				
				
		
            </div>
        
        <!-- Fin de l'ensemble -->
        </div>
    </body>
</html>
<div id="dialog" style="display:none;"></div>
		<script>
  (function(i,s,o,g,r,a,m){ i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ 
  (i[r].q=i[r].q||[]).push(arguments) },i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
   })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '[YOUR GA]', 'auto');
  ga('send', 'pageview');

</script>
<script>
var LoginConfig = {
	'isMultiUniverse': <?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'isMultiUniverse\']->value);?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
,
	'referralEnable' : <?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'referralEnable\']->value);?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>
,
	'basePath' : <?php echo '/*%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/<?php echo json_encode($_smarty_tpl->tpl_vars[\'basepath\']->value);?>
/*/%%SmartyNocache:3787914935a824b3b5be285-76521172%%*/';?>

};
</script>

</body>
</html><?php }} ?>