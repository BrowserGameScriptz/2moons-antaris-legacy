<?php

/**
 *  2Moons
 *  Copyright (C) 2011 Jan Kröpke
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
 * @copyright 2009 Lucky
 * @copyright 2011 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.5 (2011-07-31)
 * @info $Id: dbtables.php 2490 2012-12-27 16:21:07Z slaver7 $
 * @link http://2moons.cc/
 */

// Global configkeys
$BASICCONFIG	= array('VERSION', 'game_name', 'stat', 'stat_level', 'stat_last_update', 'stat_settings', 'stat_update_time', 'stat_last_db_update', 'stats_fly_lock', 'cron_lock', 'ts_modon', 'ts_server', 'ts_tcpport', 'ts_udpport', 'ts_timeout', 'ts_version', 'ts_cron_last', 'ts_cron_interval', 'ts_login', 'ts_password', 'capaktiv', 'cappublic', 'capprivate', 'mail_active', 'mail_use', 'smtp_host', 'smtp_port', 'smtp_user', 'smtp_pass', 'smtp_ssl', 'smtp_sendmail', 'smail_path', 'fb_on', 'fb_apikey', 'fb_skey', 'ga_active', 'ga_key', 'chat_closed', 'chat_allowchan', 'chat_allowmes', 'chat_allowdelmes', 'chat_logmessage', 'chat_nickchange', 'chat_botname', 'chat_channelname', 'chat_socket_active', 'chat_socket_host', 'chat_socket_ip', 'chat_socket_port', 'chat_socket_chatid', 'ttf_file', 'sendmail_inactive', 'del_user_sendmail', 'del_user_automatic', 'del_oldstuff', 'del_user_manually', 'ref_max_referals', 'disclamerAddress','disclamerPhone','disclamerMail','disclamerNotice');
 
// Data Tabells
define('DB_NAME'			, $database['databasename']);
define('DB_PREFIX'			, $database['tableprefix']);

define('ACHATLOG'			, DB_PREFIX.'achats_log');
define('AKS'				, DB_PREFIX.'aks');
define('ALLIANCE'			, DB_PREFIX.'alliance');
define('ALLIANCE_RANK'		, DB_PREFIX.'alliance_ranks');
define('STATHISTORY'		, DB_PREFIX.'stathistory');
define('ALLIANCE_REQUEST'	, DB_PREFIX.'alliance_request');
define('BANNED'				, DB_PREFIX.'banned');
define('PORTALBASH'			, DB_PREFIX.'bash_portail');
define('BUDDY'				, DB_PREFIX.'buddy');
define('BUDDY_REQUEST'		, DB_PREFIX.'buddy_request');
define('BUNKERLOG'			, DB_PREFIX.'bunker_log');
define('CHAT_BAN'			, DB_PREFIX.'chat_bans');
define('CHAT_INV'			, DB_PREFIX.'chat_invitations');
define('CHAT_MES'			, DB_PREFIX.'chat_messages');
define('CHAT_ON'			, DB_PREFIX.'chat_online');
define('CONFIG'				, DB_PREFIX.'config');
define('CRONJOBS'			, DB_PREFIX.'cronjobs');
define('DIPLO'				, DB_PREFIX.'diplo'); 
define('FLEETS'				, DB_PREFIX.'fleets');
define('FLEETS_EVENT'		, DB_PREFIX.'fleet_event');
define('FLEETS_MANAGE'		, DB_PREFIX.'fleets_manage');
define('IPLOG'				, DB_PREFIX.'iplog');
define('REGISTERLOG'		, DB_PREFIX.'journal_log');
define('LOG'				, DB_PREFIX.'log');
define('LOG_FLEETS'			, DB_PREFIX.'log_fleets');
define('LOSTPASSWORD'		, DB_PREFIX.'lostpassword');
define('LOTTERIE'			, DB_PREFIX.'loteria');
define('LOTTERIELOG'		, DB_PREFIX.'loteria_log');
define('NEWS'				, DB_PREFIX.'news');
define('NOTES'				, DB_PREFIX.'notes');
define('MESSAGES'			, DB_PREFIX.'messages');
define('MINICHAT'			, DB_PREFIX.'minichat');
define('MULTI'				, DB_PREFIX.'multi');
define('NEWSFEED'			, DB_PREFIX.'newsfeed');
define('PAYLOG'      	    , DB_PREFIX.'paysafecard_log');
define('PLANETS'            , DB_PREFIX.'planets');
define('RW'		            , DB_PREFIX.'raports');
define('RECORDS'		    , DB_PREFIX.'records');
define('REWARDS'		    , DB_PREFIX.'reward');
define('REWARDSLOG'		    , DB_PREFIX.'reward_log');
define('SESSION'			, DB_PREFIX.'session');
define('SHORTCUTS'			, DB_PREFIX.'shortcuts');
define('STATPOINTS'			, DB_PREFIX.'statpoints');
define('TICKETS'			, DB_PREFIX.'ticket');
define('TICKETS_ANSWER'		, DB_PREFIX.'ticket_answer');
define('TICKETS_CATEGORY'	, DB_PREFIX.'ticket_category');
define('TRACKING'			, DB_PREFIX.'tracking_mod');
define('TRANSORTLOG'		, DB_PREFIX.'transport_player');
define('TOPKB'				, DB_PREFIX.'topkb');
define('TOPKB_USERS'		, DB_PREFIX.'users_to_topkb');
define('USERS'				, DB_PREFIX.'users');
define('USERS_ACS'			, DB_PREFIX.'users_to_acs');
define('USERS_AUTH'			, DB_PREFIX.'users_to_extauth');
define('USERS_VALID'	 	, DB_PREFIX.'users_valid');
define('VARS'	 			, DB_PREFIX.'vars');
define('VARS_COMPO'			, DB_PREFIX.'vars_composant');
define('VARS_INFRA'			, DB_PREFIX.'vars_infrastructure');
define('VARS_RAPIDFIRE'		, DB_PREFIX.'vars_rapidfire');
define('VARS_REQUIRE'	 	, DB_PREFIX.'vars_requriements');
define('VARS_USER'		 	, DB_PREFIX.'vars_user');
define('XSOLLA'			 	, DB_PREFIX.'xsolla_options');

// MOD-TABLES