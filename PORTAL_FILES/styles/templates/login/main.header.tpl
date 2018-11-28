<!DOCTYPE html>
<html lang="{$lang}">
	<!-- Auteur(s) : Jeremy Baukens -->
	<!-- Application : Antaris Legacy -->
	<!-- Début du projet : octobre 2011 -->
	<!-- Dernière mise à jour du portail : décembre 2015 -->

	<!-- //// HEAD //// -->
	<head>
		<!-- Title -->
		<title>{block name="title"} - {$gameName}{/block}</title>

		<!-- //// META //// -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<!-- Meta auteur / description -->
		<meta name="author" content="Jeremy Baukens" />
		<meta name="description" content="Antaris Legacy est un jeu de gestion/stratégie massivement multijoueur par navigateur internet, inspiré de l'univers de Stargate.Par le créateur de Pegase Universe et de Stargate Adventure." />
		<meta name="keywords" content="Antaris Legacy, Stargate Adventure, Pegase Universe, Science-fiction, Stargate Atlantis, Stargate Universe, Stargate SG1, Jeu, Gratuit" />

		<!-- Meta référencement -->
		<meta name="google" content="nositelinkssearchbox" />

		<!-- All Mobile -->
		<meta name="viewport" content="width=device-width, maximum-scale=1" />

		<!-- Apple Mobile -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<!-- //// FIN DES META //// -->

		<!-- //// IMPORTATION DU CSS //// -->
		<link type="text/css" rel="stylesheet" media="screen" href="https://cdn.antaris-legacy.eu/css/login/prodDefault.css" />
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel|Josefin+Sans:400,600,300">
		
		<!-- //// VERIFICATION GOOGLE ET HTML5 //// -->
		<!-- <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> -->

		<!-- //// IMPORTATION DU JS //// -->
		<script type="text/javascript" src="https://cdn.antaris-legacy.eu/scripts/login/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="https://cdn.antaris-legacy.eu/scripts/login/jquery-fancybox.min.js"></script>
		<script type="text/javascript" src="https://cdn.antaris-legacy.eu/scripts/login/jquery-cookie.min.js"></script>
		<script type="text/javascript" src="https://cdn.antaris-legacy.eu/scripts/login/main.js"></script>
		
		<!-- //// TAG PARTENAIRE //// -->
		<script type="text/javascript">{literal}
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create','UA-44438409-6','auto');ga('send','pageview');
		{/literal}</script>
		<!-- //// GESTION DES ICONS //// -->
		<link rel="shortcut icon" type="image/png" href="https://cdn.antaris-legacy.eu/images/login/16.png" />
		<link rel="apple-touch-icon" href="https://cdn.antaris-legacy.eu/images/login/60.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="https://cdn.antaris-legacy.eu/images/login/76.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="https://cdn.antaris-legacy.eu/images/login/120.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="https://cdn.antaris-legacy.eu/images/login/152.png" />
	</head>
	<!-- //// FIN DU HEAD //// -->

	<!-- //// BODY //// -->
	<body id="{$smarty.get.page|htmlspecialchars|default:'overview'}" class="{$bodyclass}">