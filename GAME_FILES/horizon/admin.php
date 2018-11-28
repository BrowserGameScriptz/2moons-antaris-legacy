<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kröpke
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2012 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.3 (2013-05-19)
 * @info $Id: admin.php 2640 2013-03-23 19:23:26Z slaver7 $
 * @link http://2moons.cc/
 */

define('MODE', 'ADMIN');

define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');

require('includes/common.php');
require_once('includes/classes/class.Log.php');

if ($USER['authlevel'] == AUTH_USR) HTTP::redirectTo('game.php');

if(!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] != $USER['password'])
{
	include_once('includes/pages/adm/ShowLoginPage.php');
	ShowLoginPage();
	exit;
}

$page = HTTP::_GP('page', '');
$uni = HTTP::_GP('uni', 0);

if($USER['authlevel'] == AUTH_ADM && !empty($uni))
	$_SESSION['adminuni'] = $uni;
if(empty($_SESSION['adminuni']))
	$_SESSION['adminuni'] = $UNI;

switch($page)
{
	//NEW LINES
	case 'translate':
		include_once('includes/pages/adm/ShowTranslatePage.php');
		ShowTranslatePage();
	break;
	
	case 'newlanguage':
		include_once('includes/pages/adm/ShowTranslatePage.php');
		ShowNewlanguagePage();
	break;
	
	case 'langedit':
		include_once('includes/pages/adm/ShowTranslatePage.php');
		ShowLangeditPage();
	break;
	
	case 'generalset':
		include_once('includes/pages/adm/ShowGeneralsetPage.php');
		ShowGeneralsetPage();
	break;
	case 'metaset':
		include_once('includes/pages/adm/ShowGeneralsetPage.php');
		ShowMetaPage();
	break;
	
	//BLOCK2
	case 'universeset':
		include_once('includes/pages/adm/ShowIngamesetPage.php');
		ShowIngamesetPage();
	break;
	case 'queuset':
		include_once('includes/pages/adm/ShowIngamesetPage.php');
		ShowQueusetPage();
	break;
	case 'referalset':
		include_once('includes/pages/adm/ShowIngamesetPage.php');
		ShowRefsetPage();
	break;
	case 'colonyset':
		include_once('includes/pages/adm/ShowIngamesetPage.php');
		ShowColonysetPage();
	break;
	case 'planetset':
		include_once('includes/pages/adm/ShowIngamesetPage.php');
		ShowPlanetsetPage();
	break;
	case 'debrisset':
		include_once('includes/pages/adm/ShowIngamesetPage.php');
		ShowDebrissetPage();
	break;
	case 'noobset':
		include_once('includes/pages/adm/ShowIngamesetPage.php');
		ShowNoobsetPage();
	break;
	case 'variousset':
		include_once('includes/pages/adm/ShowIngamesetPage.php');
		ShowVarioussetPage();
	break;
	case 'proxyset':
		include_once('includes/pages/adm/ShowIngamesetPage.php');
		ShowProxysetPage();
	break;
	case 'module':
		include_once('includes/pages/adm/ShowModulePage.php');
		ShowModulePage();
	break;
	case 'statsconf':
		include_once('includes/pages/adm/ShowStatsPage.php');
		ShowStatsPage();
	break;
	case 'cronjob':
		include_once('includes/pages/adm/ShowCronjobPage.php');
		ShowCronjob();
	break;
	//BLOCK4
	case 'playerlist':
		include_once('includes/pages/adm/ShowVariousoptPage.php');
		ShowPlayerlistPage();
	break;
	case 'planetlist':
		include_once('includes/pages/adm/ShowVariousoptPage.php');
		ShowPlanetlistPage();
	break;
	case 'planetalist':
		include_once('includes/pages/adm/ShowVariousoptPage.php');
		ShowPlanetalistPage();
	break;
	case 'messagelist':
		include_once('includes/pages/adm/ShowMessageListPage.php');
		ShowMessageListPage();
	break;
	case 'tracking':
		include_once('includes/pages/adm/ShowTrackingPage.php');
		ShowTrackingPage();
	break;
	
	
	
	//END NEW LINES
	case 'logout':
		include_once('includes/pages/adm/ShowLogoutPage.php');
		ShowLogoutPage();
	break;
	case 'topnav':
		include_once('includes/pages/adm/ShowTopnavPage.php');
		ShowTopnavPage();
	break;
	case 'overview':
		include_once('includes/pages/adm/ShowOverviewPage.php');
		ShowOverviewPage();
	break;
	case 'menu':
		include_once('includes/pages/adm/ShowMenuPage.php');
		ShowMenuPage();
	break;
	default:
		include_once('includes/pages/adm/ShowIndexPage.php');
		ShowIndexPage();
	break;
	case 'clearcache':
		include_once('includes/pages/adm/ShowClearCachePage.php');
		ShowClearCachePage();
	break;
	case 'fleets':
		include_once('includes/pages/adm/ShowFlyingFleetPage.php');
		ShowFlyingFleetPage();
	break;
	case 'globalmessage':
		include_once('includes/pages/adm/ShowSendMessagesPage.php');
		ShowSendMessagesPage();
	break;
	case 'search':
		include_once(ROOT_PATH . 'includes/pages/adm/ShowSearchPage.php');
		ShowSearchPage();
	break;
}
