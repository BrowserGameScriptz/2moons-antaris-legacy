      <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <!-- Auteur(s) : Baukens Jeremy -->
    <!-- Site : Antaris Legacy -->
    <!-- Année : 2011 -->

    <!-- Debut du head -->
    <head>
        <!-- Title de la page -->
       <title>{block name="title"} - {$uni_name} - {$game_name}{/block}</title>

        <!-- Déclarations des balises meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="fr" />
        <meta name="author" content="Jeremy Baukens" />
        <meta name="copyright" content="Jeremy Baukens" />
		<meta name="gameowner" content="{$admin_name}" />
        <meta name="gamecontact" content="{$admin_email}" />
        <meta name="description" content="{$meta_descrip}" />
        <meta name="keywords" content="{$meta_title}" />
        <meta name="Expires" content="never" />
        <meta name="rating" content="Tous public" />
        <meta name="subject" content="Antaris Legacy is a management/strategy browser game." />

        <!-- Fichier CSS et logo du site -->
        <!-- CSS utile : style_mozilla -->
        <link rel="stylesheet" media="screen" type="text/css" href="https://cdngames.antaris-legacy.eu/media/ingame/css/style_mozilla.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="https://cdngames.antaris-legacy.eu/media/ingame/css/scrollbar.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="https://cdngames.antaris-legacy.eu/media/ingame/css/alertify.core.css" />
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
        <link rel="shortcut icon" type="image/x-icon" href="design/image/favicon.png" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=ABeeZee|Electrolize">
		 <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/lang/fr.js"></script>
        <script type="text/javascript" src="https://cdngames.antaris-legacy.eu/media/js/main_compresser.min.js"></script>
        <script type="text/javascript">
	var ServerTimezoneOffset = {$Offset};
	var serverTime 	= new Date({$date.0}, {$date.1 - 1}, {$date.2}, {$date.3}, {$date.4}, {$date.5});
	var startTime	= serverTime.getTime();
	var localTime 	= serverTime;
	var localTS 	= startTime;
	var Gamename	= document.title;
	var Ready		= "{$LNG.ready}";
	var Skin		= "{$dpath}";
	var Lang		= "{$lang}";
	var head_info	= "{$LNG.fcm_info}";
	var auth		= {$authlevel|default:'0'};
	var days 		= {$LNG.week_day|json|default:'[]'} 
	var months 		= {$LNG.months|json|default:'[]'} ;
	var tdformat	= "{$LNG.js_tdformat}";
	var queryString	= "{$queryString|escape:'javascript'}";

	setInterval(function() {
		serverTime.setSeconds(serverTime.getSeconds()+1);
	}, 1000);
	</script>
				
				<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/jquery.js"></script>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/jquery.ui.js"></script>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/jquery.cookie.js"></script>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/jquery.fancybox.js"></script>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/l18n/validationEngine/jquery.validationEngine-{$lang}.js"></script>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/base/tooltip.js"></script>
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/base.js"></script>
	{foreach item=scriptname from=$scripts}
	<script type="text/javascript" src="https://cdngames.antaris-legacy.eu/scripts/game/{$scriptname}.js"></script>
	{/foreach}
	{block name="script"}{/block}
	<script type="text/javascript">
	$(function() {
		{$execscript}
	});
	</script>
        
                
    <!-- Fin du head -->
    </head>

   