-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: antaris_horizon
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `antaris_horizon`
--


--
-- Table structure for table `uni1_achats_log`
--

DROP TABLE IF EXISTS `uni1_achats_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_achats_log` (
  `achatID` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `userID` int(11) unsigned NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8,
  `total_cred` int(11) unsigned NOT NULL DEFAULT '0',
  `usedType` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`achatID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_achats_log`
--

LOCK TABLES `uni1_achats_log` WRITE;
/*!40000 ALTER TABLE `uni1_achats_log` DISABLE KEYS */;
INSERT INTO `uni1_achats_log` VALUES (1,1507661788,11,'- 1 credit(s) for 1 day of planet cloak mode',1,'Conversion in planet cloak modus');
/*!40000 ALTER TABLE `uni1_achats_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_aks`
--

DROP TABLE IF EXISTS `uni1_aks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_aks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `target` int(11) unsigned NOT NULL,
  `ankunft` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_aks`
--

LOCK TABLES `uni1_aks` WRITE;
/*!40000 ALTER TABLE `uni1_aks` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_aks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_alliance`
--

DROP TABLE IF EXISTS `uni1_alliance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_alliance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ally_name` varchar(50) DEFAULT '',
  `ally_tag` varchar(20) DEFAULT '',
  `ally_owner` int(11) unsigned NOT NULL DEFAULT '0',
  `ally_register_time` int(11) NOT NULL DEFAULT '0',
  `ally_description` text,
  `ally_web` varchar(255) DEFAULT '',
  `ally_text` text,
  `ally_image` varchar(255) DEFAULT '',
  `ally_request` varchar(1000) DEFAULT NULL,
  `ally_request_notallow` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ally_request_min_points` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ally_owner_range` varchar(32) DEFAULT '',
  `ally_members` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ally_stats` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ally_diplo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ally_universe` tinyint(3) unsigned NOT NULL,
  `ally_max_members` int(5) unsigned NOT NULL DEFAULT '20',
  `ally_events` varchar(55) NOT NULL DEFAULT '',
  `defcon` tinyint(3) unsigned NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`),
  KEY `ally_tag` (`ally_tag`),
  KEY `ally_name` (`ally_name`),
  KEY `ally_universe` (`ally_universe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_alliance`
--

LOCK TABLES `uni1_alliance` WRITE;
/*!40000 ALTER TABLE `uni1_alliance` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_alliance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_alliance_ranks`
--

DROP TABLE IF EXISTS `uni1_alliance_ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_alliance_ranks` (
  `rankID` int(11) NOT NULL AUTO_INCREMENT,
  `rankName` varchar(32) NOT NULL,
  `allianceID` int(10) unsigned NOT NULL,
  `MEMBERLIST` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `MANAGEAPPLY` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ROUNDMAIL` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ADMIN` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `DIPLOMATIC` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `RANKS` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `MANAGEUSERS` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rankID`),
  KEY `allianceID` (`allianceID`,`rankID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_alliance_ranks`
--

LOCK TABLES `uni1_alliance_ranks` WRITE;
/*!40000 ALTER TABLE `uni1_alliance_ranks` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_alliance_ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_alliance_request`
--

DROP TABLE IF EXISTS `uni1_alliance_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_alliance_request` (
  `applyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `allianceID` int(10) unsigned NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`applyID`),
  KEY `allianceID` (`allianceID`,`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_alliance_request`
--

LOCK TABLES `uni1_alliance_request` WRITE;
/*!40000 ALTER TABLE `uni1_alliance_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_alliance_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_banned`
--

DROP TABLE IF EXISTS `uni1_banned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_banned` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `whoId` int(11) unsigned NOT NULL DEFAULT '0',
  `who` varchar(64) NOT NULL DEFAULT '',
  `theme` varchar(500) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `longer` int(11) NOT NULL DEFAULT '0',
  `author` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `universe` tinyint(3) unsigned NOT NULL,
  KEY `ID` (`id`),
  KEY `universe` (`universe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_banned`
--

LOCK TABLES `uni1_banned` WRITE;
/*!40000 ALTER TABLE `uni1_banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_banned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_bash_portail`
--

DROP TABLE IF EXISTS `uni1_bash_portail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_bash_portail` (
  `bashId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attackerId` int(11) unsigned NOT NULL DEFAULT '0',
  `planetId` int(11) unsigned NOT NULL DEFAULT '0',
  `timeAttack` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`bashId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_bash_portail`
--

LOCK TABLES `uni1_bash_portail` WRITE;
/*!40000 ALTER TABLE `uni1_bash_portail` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_bash_portail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_buddy`
--

DROP TABLE IF EXISTS `uni1_buddy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_buddy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender` int(11) unsigned NOT NULL DEFAULT '0',
  `owner` int(11) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `universe` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `universe` (`universe`),
  KEY `sender` (`sender`,`owner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_buddy`
--

LOCK TABLES `uni1_buddy` WRITE;
/*!40000 ALTER TABLE `uni1_buddy` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_buddy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_buddy_request`
--

DROP TABLE IF EXISTS `uni1_buddy_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_buddy_request` (
  `id` int(11) unsigned NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_buddy_request`
--

LOCK TABLES `uni1_buddy_request` WRITE;
/*!40000 ALTER TABLE `uni1_buddy_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_buddy_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_bunker_log`
--

DROP TABLE IF EXISTS `uni1_bunker_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_bunker_log` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL DEFAULT '0',
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`logID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_bunker_log`
--

LOCK TABLES `uni1_bunker_log` WRITE;
/*!40000 ALTER TABLE `uni1_bunker_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_bunker_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_config`
--

DROP TABLE IF EXISTS `uni1_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_config` (
  `uni` int(11) NOT NULL AUTO_INCREMENT,
  `VERSION` varchar(8) NOT NULL,
  `sql_revision` int(11) NOT NULL DEFAULT '0',
  `users_amount` int(11) unsigned NOT NULL DEFAULT '1',
  `game_speed` bigint(20) unsigned NOT NULL DEFAULT '2500',
  `fleet_speed` bigint(20) unsigned NOT NULL DEFAULT '2500',
  `resource_multiplier` smallint(5) unsigned NOT NULL DEFAULT '1',
  `halt_speed` smallint(5) unsigned NOT NULL DEFAULT '1',
  `Fleet_Cdr` tinyint(3) unsigned NOT NULL DEFAULT '30',
  `Defs_Cdr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `initial_fields` smallint(5) unsigned NOT NULL DEFAULT '163',
  `uni_name` varchar(30) NOT NULL,
  `game_name` varchar(30) NOT NULL,
  `game_disable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `close_reason` text NOT NULL,
  `metal_basic_income` int(11) NOT NULL DEFAULT '20',
  `crystal_basic_income` int(11) NOT NULL DEFAULT '10',
  `deuterium_basic_income` int(11) NOT NULL DEFAULT '0',
  `elyrium_basic_income` int(11) unsigned NOT NULL DEFAULT '0',
  `formation_basic_income` int(11) unsigned NOT NULL DEFAULT '0',
  `energy_basic_income` int(11) NOT NULL DEFAULT '0',
  `LastSettedGalaxyPos` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `LastSettedSystemPos` smallint(5) unsigned NOT NULL DEFAULT '1',
  `LastSettedPlanetPos` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `noobprotection` int(11) NOT NULL DEFAULT '0',
  `noobprotectiontime` int(11) NOT NULL DEFAULT '5000',
  `noobprotectionmulti` int(11) NOT NULL DEFAULT '5',
  `forum_url` varchar(128) NOT NULL DEFAULT 'http://2moons.cc',
  `adm_attack` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `debug` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(2) NOT NULL DEFAULT '',
  `stat` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `stat_level` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `stat_last_update` int(11) NOT NULL DEFAULT '0',
  `stat_settings` int(11) unsigned NOT NULL DEFAULT '1000',
  `stat_update_time` tinyint(3) unsigned NOT NULL DEFAULT '25',
  `stat_last_db_update` int(11) NOT NULL DEFAULT '0',
  `stats_fly_lock` int(11) NOT NULL DEFAULT '0',
  `cron_lock` int(11) NOT NULL DEFAULT '0',
  `ts_modon` tinyint(1) NOT NULL DEFAULT '0',
  `ts_server` varchar(64) NOT NULL DEFAULT '',
  `ts_tcpport` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ts_udpport` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ts_timeout` tinyint(1) NOT NULL DEFAULT '1',
  `ts_version` tinyint(1) NOT NULL DEFAULT '2',
  `ts_cron_last` int(11) NOT NULL DEFAULT '0',
  `ts_cron_interval` smallint(5) NOT NULL DEFAULT '5',
  `ts_login` varchar(32) NOT NULL DEFAULT '',
  `ts_password` varchar(32) NOT NULL DEFAULT '',
  `reg_closed` tinyint(1) NOT NULL DEFAULT '0',
  `OverviewNewsFrame` tinyint(1) NOT NULL DEFAULT '1',
  `OverviewNewsText` text NOT NULL,
  `capaktiv` tinyint(1) NOT NULL DEFAULT '0',
  `cappublic` varchar(42) NOT NULL DEFAULT '',
  `capprivate` varchar(42) NOT NULL DEFAULT '',
  `min_build_time` tinyint(2) NOT NULL DEFAULT '1',
  `mail_active` tinyint(1) NOT NULL DEFAULT '0',
  `mail_use` tinyint(1) NOT NULL DEFAULT '0',
  `smtp_host` varchar(64) NOT NULL DEFAULT '',
  `smtp_port` smallint(5) NOT NULL DEFAULT '0',
  `smtp_user` varchar(64) NOT NULL DEFAULT '',
  `smtp_pass` varchar(32) NOT NULL DEFAULT '',
  `smtp_ssl` enum('','ssl','tls') NOT NULL DEFAULT '',
  `smtp_sendmail` varchar(64) NOT NULL DEFAULT '',
  `smail_path` varchar(30) NOT NULL DEFAULT '/usr/sbin/sendmail',
  `user_valid` tinyint(1) NOT NULL DEFAULT '0',
  `fb_on` tinyint(1) NOT NULL DEFAULT '0',
  `fb_apikey` varchar(42) NOT NULL DEFAULT '',
  `fb_skey` varchar(42) NOT NULL DEFAULT '',
  `ga_active` varchar(42) NOT NULL DEFAULT '0',
  `ga_key` varchar(42) NOT NULL DEFAULT '',
  `moduls` varchar(100) NOT NULL DEFAULT '',
  `trade_allowed_ships` varchar(255) NOT NULL DEFAULT '202,401',
  `trade_charge` varchar(5) NOT NULL DEFAULT '30',
  `chat_closed` tinyint(1) NOT NULL DEFAULT '0',
  `chat_allowchan` tinyint(1) NOT NULL DEFAULT '1',
  `chat_allowmes` tinyint(1) NOT NULL DEFAULT '1',
  `chat_allowdelmes` tinyint(1) NOT NULL DEFAULT '1',
  `chat_logmessage` tinyint(1) NOT NULL DEFAULT '1',
  `chat_nickchange` tinyint(1) NOT NULL DEFAULT '1',
  `chat_botname` varchar(15) NOT NULL DEFAULT '2Moons',
  `chat_channelname` varchar(15) NOT NULL DEFAULT '2Moons',
  `chat_socket_active` tinyint(1) NOT NULL DEFAULT '0',
  `chat_socket_host` varchar(64) NOT NULL DEFAULT '',
  `chat_socket_ip` varchar(40) NOT NULL DEFAULT '',
  `chat_socket_port` smallint(5) NOT NULL DEFAULT '0',
  `chat_socket_chatid` tinyint(1) NOT NULL DEFAULT '1',
  `max_galaxy` tinyint(3) unsigned NOT NULL DEFAULT '9',
  `max_system` smallint(5) unsigned NOT NULL DEFAULT '400',
  `max_planets` tinyint(3) unsigned NOT NULL DEFAULT '15',
  `planet_factor` float(2,1) NOT NULL DEFAULT '1.0',
  `max_elements_build` tinyint(3) unsigned NOT NULL DEFAULT '5',
  `max_elements_tech` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `max_elements_ships` tinyint(3) unsigned NOT NULL DEFAULT '10',
  `min_player_planets` tinyint(3) unsigned NOT NULL DEFAULT '9',
  `planets_tech` tinyint(4) NOT NULL DEFAULT '11',
  `planets_officier` tinyint(4) NOT NULL DEFAULT '5',
  `planets_per_tech` float(2,1) NOT NULL DEFAULT '0.5',
  `max_fleet_per_build` bigint(20) unsigned NOT NULL DEFAULT '1000000',
  `deuterium_cost_galaxy` int(11) unsigned NOT NULL DEFAULT '10',
  `max_dm_missions` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `max_overflow` float(2,1) NOT NULL DEFAULT '1.0',
  `moon_factor` float(2,1) NOT NULL DEFAULT '1.0',
  `moon_chance` tinyint(3) unsigned NOT NULL DEFAULT '20',
  `darkmatter_cost_trader` int(11) unsigned NOT NULL DEFAULT '750',
  `factor_university` tinyint(3) unsigned NOT NULL DEFAULT '8',
  `max_fleets_per_acs` tinyint(3) unsigned NOT NULL DEFAULT '16',
  `debris_moon` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `vmode_min_time` int(11) NOT NULL DEFAULT '259200',
  `gate_wait_time` int(11) NOT NULL DEFAULT '3600',
  `metal_start` int(11) unsigned NOT NULL DEFAULT '500',
  `crystal_start` int(11) unsigned NOT NULL DEFAULT '500',
  `deuterium_start` int(11) unsigned NOT NULL DEFAULT '0',
  `elyrium_start` int(11) unsigned NOT NULL DEFAULT '0',
  `darkmatter_start` int(11) unsigned NOT NULL DEFAULT '0',
  `ttf_file` varchar(128) NOT NULL DEFAULT 'styles/resource/fonts/DroidSansMono.ttf',
  `ref_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ref_bonus` int(11) unsigned NOT NULL DEFAULT '1000',
  `ref_minpoints` bigint(20) unsigned NOT NULL DEFAULT '2000',
  `ref_max_referals` tinyint(1) unsigned NOT NULL DEFAULT '5',
  `del_oldstuff` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `del_user_manually` tinyint(3) unsigned NOT NULL DEFAULT '7',
  `del_user_automatic` tinyint(3) unsigned NOT NULL DEFAULT '30',
  `del_user_sendmail` tinyint(3) unsigned NOT NULL DEFAULT '21',
  `sendmail_inactive` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `silo_factor` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `timezone` varchar(32) NOT NULL DEFAULT 'Europe/London',
  `dst` enum('0','1','2') NOT NULL DEFAULT '2',
  `energySpeed` smallint(6) NOT NULL DEFAULT '1',
  `disclamerAddress` text NOT NULL,
  `disclamerPhone` text NOT NULL,
  `disclamerMail` text NOT NULL,
  `disclamerNotice` text NOT NULL,
  `alliance_create_min_points` bigint(20) unsigned NOT NULL DEFAULT '0',
  `lottery_time` int(11) unsigned NOT NULL DEFAULT '0',
  `lottery_min` int(11) unsigned NOT NULL DEFAULT '15',
  `taxe_metal` float NOT NULL DEFAULT '0',
  `taxe_crystal` float NOT NULL DEFAULT '0',
  `taxe_deuterium` float NOT NULL DEFAULT '0',
  `taxe_elyrium` float NOT NULL DEFAULT '0',
  `bank_metal` double(50,0) unsigned NOT NULL DEFAULT '400000000000',
  `bank_crystal` double(50,0) unsigned NOT NULL DEFAULT '300000000000',
  `bank_deuterium` double(50,0) unsigned NOT NULL DEFAULT '200000000000',
  `bank_elyrium` double(50,0) unsigned NOT NULL DEFAULT '100000000000',
  `new_taxe_metal` float NOT NULL DEFAULT '0',
  `new_taxe_crystal` float NOT NULL DEFAULT '0',
  `new_taxe_deuterium` float NOT NULL DEFAULT '0',
  `new_taxe_elyrium` float NOT NULL DEFAULT '0',
  `newbank` int(11) unsigned NOT NULL DEFAULT '0',
  `asteroid_event` int(11) unsigned NOT NULL DEFAULT '0',
  `asteroid_metal` bigint(20) unsigned NOT NULL DEFAULT '0',
  `asteroid_crystal` bigint(20) unsigned NOT NULL DEFAULT '0',
  `asteroid_deuterium` bigint(20) unsigned NOT NULL DEFAULT '0',
  `globalevent` int(11) unsigned NOT NULL DEFAULT '0',
  `globaleventsocial` int(11) unsigned NOT NULL DEFAULT '0',
  `birthday_event` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_name` text NOT NULL,
  `site_title` varchar(255) NOT NULL DEFAULT 'Control Panel© - Create your own space war game',
  `admin_email` text NOT NULL,
  `site_logo` text NOT NULL,
  `site_favicon` text NOT NULL,
  `meta_title` varchar(500) NOT NULL DEFAULT 'antaris, legacy, antaris legacy, science, fiction, science-fiction, jeu, game, jeu navigateur',
  `meta_descrip` varchar(500) NOT NULL DEFAULT 'Antaris Legacy is a game management / strategy massively multiplayer browser based on a science fiction universe entirely invented.',
  `dateFormat` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `timeFormat` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `isShortly` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uni`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_config`
--

LOCK TABLES `uni1_config` WRITE;
/*!40000 ALTER TABLE `uni1_config` DISABLE KEYS */;
INSERT INTO `uni1_config` VALUES (1,'1.0',2,9,2500,2500,1,1,30,0,163,'MakeYourGame','MakeYourGame',1,'The game is currently closed',5000,4000,2000,1000,0,0,1,25,3,1,10000000,5,'https://makeyourgame.pro',1,1,'en',2,3,1518088581,1000,0,0,0,0,0,'',0,0,1,2,0,5,'','',0,1,'Welcome to #MakeYourGame',0,'','',1,1,0,'mail.makeyourgame.pro',465,'clients@makeyourgame.pro','&amp;#pwtr4U}0G3','','clients@makeyourgame.pro','/usr/sbin/sendmail',0,0,'','','0','','1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1','9999999999999','25',0,1,1,0,1,1,'#BotNet','#BotNet',0,'','',0,1,1,500,10,1.0,1,1,10,1,8,0,0.5,99999,1000,1,1.0,1.0,0,0,8,8,0,259200,3600,40000,30000,20000,50000,5,'styles/resource/fonts/antaris.ttf',1,1,1000000,10,3,10,40,21,1,5,'Europe/Brussels','0',1,'','','','',0,1518175144,15,-14.35,15.74,13.49,-14.88,6534212972,4158267912421,660588896800302,419748343196899,0.32,1.13,-0.65,-0.79,2857863733,1430519391,150000,100000,50000,1429192655,1429732643,0,'','Control Panel© - Create your own space war game','','','','antaris, legacy, antaris legacy, science, fiction, science-fiction, jeu, game, jeu navigateur','Antaris Legacy is a game management / strategy massively multiplayer browser based on a science fiction universe entirely invented.',1,1,0);
/*!40000 ALTER TABLE `uni1_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_cronjobs`
--

DROP TABLE IF EXISTS `uni1_cronjobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_cronjobs` (
  `cronjobID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `min` varchar(32) NOT NULL,
  `hours` varchar(32) NOT NULL,
  `dom` varchar(32) NOT NULL,
  `month` varchar(32) NOT NULL,
  `dow` varchar(32) NOT NULL,
  `class` varchar(32) NOT NULL,
  `nextTime` int(11) NOT NULL DEFAULT '0',
  `lock` varchar(32) DEFAULT NULL,
  UNIQUE KEY `cronjobID` (`cronjobID`),
  KEY `isActive` (`isActive`,`nextTime`,`lock`,`cronjobID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_cronjobs`
--

LOCK TABLES `uni1_cronjobs` WRITE;
/*!40000 ALTER TABLE `uni1_cronjobs` DISABLE KEYS */;
INSERT INTO `uni1_cronjobs` VALUES (1,'referral',1,'3,33','*','*','*','*','ReferralCronjob',1518465780,NULL),(2,'statistic',1,'*/15','*','*','*','*','StatisticCronjob',1518465600,NULL),(3,'daily',1,'25','2','*','*','*','DailyCronjob',1518485100,NULL),(4,'cleaner',1,'45','2','*','*','6','CleanerCronjob',1518831900,NULL),(5,'inactive',0,'30','1','*','*','0,3,6','InactiveMailCronjob',1518568200,'10747d3d8f19eead4466ae966e59abc5'),(9,'Stats History',1,'58','2','*','*','*','StatHistoryCronjob',1518487080,NULL),(10,'Bunker Reset',1,'57','23','*','*','*','BunkerCronjob',1518476220,'372f3ce61254c58cb9bb705493760395'),(11,'Clean PUSH',1,'5,35,55','*','*','*','*','DoJobCronjob',1518465300,NULL),(14,'Social Event',0,'15','18','5,10,15,20,25,30','*','*','EventSocialCronJob',1518714900,'9d64fe5138d25c792349897e9d3f5243'),(15,'Birtday',0,'27','3','*','*','*','BirthdayCronJob',1518488820,'e068ef641d29478e514bfd21195b79c4'),(16,'Journal Cronjob',1,'*/10','*','*','*','*','JournalCronjob',1518465600,NULL),(17,'Email Cronjob',1,'25,45','*','*','*','*','EmailCronjob',1518467100,'fd11849a8b038626de5ff83f89e665ab');
/*!40000 ALTER TABLE `uni1_cronjobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_diplo`
--

DROP TABLE IF EXISTS `uni1_diplo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_diplo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `owner_1` int(11) unsigned NOT NULL,
  `owner_2` int(11) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `accept` tinyint(1) NOT NULL,
  `accept_text` varchar(255) NOT NULL,
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `universe` tinyint(3) unsigned NOT NULL,
  `validUntil` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `universe` (`universe`),
  KEY `owner_1` (`owner_1`,`owner_2`,`accept`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_diplo`
--

LOCK TABLES `uni1_diplo` WRITE;
/*!40000 ALTER TABLE `uni1_diplo` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_diplo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_emails`
--

DROP TABLE IF EXISTS `uni1_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_emails` (
  `email` text,
  `isSend` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sendTime` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_emails`
--

LOCK TABLES `uni1_emails` WRITE;
/*!40000 ALTER TABLE `uni1_emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_explorations`
--

DROP TABLE IF EXISTS `uni1_explorations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_explorations` (
  `explorationID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `type_of_search` tinyint(3) NOT NULL DEFAULT '0',
  `start_planet_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `start_system` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `start_planet` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `end_planet_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `start_time` int(11) unsigned NOT NULL DEFAULT '0',
  `emd_time` int(11) unsigned NOT NULL DEFAULT '0',
  `population_array` text CHARACTER SET utf8,
  `ships_array` text CHARACTER SET utf8,
  `text` text CHARACTER SET utf16,
  `categorie` int(11) unsigned NOT NULL DEFAULT '0',
  `subcategorie` int(11) unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT 'defaut.jpg',
  PRIMARY KEY (`explorationID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_explorations`
--

LOCK TABLES `uni1_explorations` WRITE;
/*!40000 ALTER TABLE `uni1_explorations` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_explorations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_fleet_event`
--

DROP TABLE IF EXISTS `uni1_fleet_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_fleet_event` (
  `fleetID` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `lock` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`fleetID`),
  KEY `lock` (`lock`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_fleet_event`
--

LOCK TABLES `uni1_fleet_event` WRITE;
/*!40000 ALTER TABLE `uni1_fleet_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_fleet_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_fleets`
--

DROP TABLE IF EXISTS `uni1_fleets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_fleets` (
  `fleet_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `fleet_owner` int(11) unsigned NOT NULL DEFAULT '0',
  `fleet_mission` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `fleet_amount` bigint(20) unsigned NOT NULL DEFAULT '0',
  `fleet_array` text,
  `fleet_universe` tinyint(3) unsigned NOT NULL,
  `fleet_start_time` int(11) NOT NULL DEFAULT '0',
  `fleet_start_id` int(11) unsigned NOT NULL,
  `fleet_start_galaxy` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_start_system` smallint(5) unsigned NOT NULL DEFAULT '0',
  `fleet_start_planet` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_start_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `fleet_end_time` int(11) NOT NULL DEFAULT '0',
  `fleet_end_stay` int(11) NOT NULL DEFAULT '0',
  `fleet_end_id` int(11) unsigned NOT NULL,
  `fleet_end_galaxy` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_end_system` smallint(5) unsigned NOT NULL DEFAULT '0',
  `fleet_end_planet` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_end_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `fleet_target_obj` smallint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_metal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_crystal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_deuterium` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_elyrium` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_darkmatter` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_301` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_302` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_303` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_304` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_305` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_306` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_307` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_308` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_309` double(50,0) unsigned NOT NULL DEFAULT '0',
  `specialized_array` text,
  `fleet_target_owner` int(11) unsigned NOT NULL DEFAULT '0',
  `fleet_group` int(10) unsigned NOT NULL DEFAULT '0',
  `fleet_mess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `start_time` int(11) DEFAULT NULL,
  `fleet_busy` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hasCanceled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fleet_id`),
  KEY `fleet_target_owner` (`fleet_target_owner`,`fleet_mission`),
  KEY `fleet_owner` (`fleet_owner`,`fleet_mission`),
  KEY `fleet_group` (`fleet_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_fleets`
--

LOCK TABLES `uni1_fleets` WRITE;
/*!40000 ALTER TABLE `uni1_fleets` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_fleets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_fleets_manage`
--

DROP TABLE IF EXISTS `uni1_fleets_manage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_fleets_manage` (
  `manageID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL DEFAULT '0',
  `manage_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `manageArray` varchar(255) DEFAULT NULL,
  `manageType` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `couleur` varchar(32) NOT NULL DEFAULT 'blanc',
  PRIMARY KEY (`manageID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_fleets_manage`
--

LOCK TABLES `uni1_fleets_manage` WRITE;
/*!40000 ALTER TABLE `uni1_fleets_manage` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_fleets_manage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_ipblock`
--

DROP TABLE IF EXISTS `uni1_ipblock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_ipblock` (
  `ipblockID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL DEFAULT '0',
  `secondID` int(11) unsigned NOT NULL DEFAULT '0',
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ipblockID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_ipblock`
--

LOCK TABLES `uni1_ipblock` WRITE;
/*!40000 ALTER TABLE `uni1_ipblock` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_ipblock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_iplog`
--

DROP TABLE IF EXISTS `uni1_iplog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_iplog` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `ipaddress` text CHARACTER SET utf8,
  `browser` text CHARACTER SET utf8,
  `os` text CHARACTER SET utf8,
  `userID` int(11) NOT NULL DEFAULT '0',
  `version` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`logID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_iplog`
--

LOCK TABLES `uni1_iplog` WRITE;
/*!40000 ALTER TABLE `uni1_iplog` DISABLE KEYS */;
INSERT INTO `uni1_iplog` VALUES (1,1507503996,'91.182.210.241','firefox','Windows',1,'56.0'),(2,1507504493,'91.182.210.241','firefox','Windows',1,'56.0'),(3,1507504554,'91.182.210.241','firefox','Windows',1,'56.0'),(4,1507504563,'91.182.210.241','firefox','Windows',1,'56.0'),(5,1507505540,'91.182.210.241','firefox','Windows',1,'56.0'),(6,1507506278,'91.182.210.241','firefox','Windows',1,'56.0'),(7,1507523535,'95.10.25.187','firefox','Windows',4,'56.0'),(8,1507524490,'46.235.153.107','chrome','Windows',1,'61.0.3163.100'),(9,1507541274,'146.159.139.23','chrome','Windows',6,'59.0.3071.109'),(10,1507558329,'81.213.185.185','firefox','Windows',4,'56.0'),(11,1507558483,'91.182.210.241','firefox','Windows',1,'56.0'),(12,1507660318,'85.179.167.66','chrome','Windows',10,'61.0.3163.100'),(13,1507795048,'78.52.130.237','chrome','Windows',10,'61.0.3163.100'),(14,1507888692,'80.117.32.154','chrome','Windows',8,'61.0.3163.100'),(15,1507948570,'85.175.5.31','chrome','Windows',2,'61.0.3163.100'),(16,1507988590,'89.228.114.148','chrome','Linux',12,'61.0.3163.98'),(17,1509729908,'79.30.154.65','chrome','Windows',8,'61.0.3163.100'),(18,1512659157,'80.182.165.216','chrome','Windows',8,'62.0.3202.94'),(19,1516125177,'146.52.248.62','chrome','Windows',20,'63.0.3239.132'),(20,1517338692,'84.246.203.101','firefox','Windows',23,'52.0'),(21,1517355405,'84.246.203.101','firefox','Windows',23,'52.0'),(22,1517355506,'84.246.203.101','firefox','Windows',23,'52.0');
/*!40000 ALTER TABLE `uni1_iplog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_journal_log`
--

DROP TABLE IF EXISTS `uni1_journal_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_journal_log` (
  `text` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_journal_log`
--

LOCK TABLES `uni1_journal_log` WRITE;
/*!40000 ALTER TABLE `uni1_journal_log` DISABLE KEYS */;
INSERT INTO `uni1_journal_log` VALUES ('ironbull, xapim, laxre');
/*!40000 ALTER TABLE `uni1_journal_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_log`
--

DROP TABLE IF EXISTS `uni1_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mode` tinyint(3) unsigned NOT NULL,
  `admin` int(11) unsigned NOT NULL,
  `target` int(11) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `data` text NOT NULL,
  `universe` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mode` (`mode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_log`
--

LOCK TABLES `uni1_log` WRITE;
/*!40000 ALTER TABLE `uni1_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_log_fleets`
--

DROP TABLE IF EXISTS `uni1_log_fleets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_log_fleets` (
  `fleet_id` bigint(11) unsigned NOT NULL,
  `fleet_owner` int(11) unsigned NOT NULL DEFAULT '0',
  `fleet_mission` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `fleet_amount` bigint(20) unsigned NOT NULL DEFAULT '0',
  `fleet_array` text,
  `fleet_universe` tinyint(3) unsigned NOT NULL,
  `fleet_start_time` int(11) NOT NULL DEFAULT '0',
  `fleet_start_id` int(11) unsigned NOT NULL,
  `fleet_start_galaxy` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_start_system` smallint(5) unsigned NOT NULL DEFAULT '0',
  `fleet_start_planet` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_start_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `fleet_end_time` int(11) NOT NULL DEFAULT '0',
  `fleet_end_stay` int(11) NOT NULL DEFAULT '0',
  `fleet_end_id` int(11) unsigned NOT NULL,
  `fleet_end_galaxy` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_end_system` smallint(5) unsigned NOT NULL DEFAULT '0',
  `fleet_end_planet` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_end_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `fleet_target_obj` smallint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_metal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_crystal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_deuterium` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_elyrium` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_resource_darkmatter` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_301` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_302` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_303` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_304` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_305` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_306` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_307` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_308` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_population_309` double(50,0) unsigned NOT NULL DEFAULT '0',
  `specialized_array` text,
  `fleet_target_owner` int(11) unsigned NOT NULL DEFAULT '0',
  `fleet_group` varchar(15) NOT NULL DEFAULT '0',
  `fleet_mess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `start_time` int(11) DEFAULT NULL,
  `fleet_busy` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_state` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fleet_id`),
  KEY `BashRule` (`fleet_owner`,`fleet_end_id`,`fleet_start_time`,`fleet_mission`,`fleet_state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_log_fleets`
--

LOCK TABLES `uni1_log_fleets` WRITE;
/*!40000 ALTER TABLE `uni1_log_fleets` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_log_fleets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_lostpassword`
--

DROP TABLE IF EXISTS `uni1_lostpassword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_lostpassword` (
  `userID` int(10) unsigned NOT NULL,
  `key` varchar(32) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `hasChanged` tinyint(1) NOT NULL DEFAULT '0',
  `fromIP` varchar(40) NOT NULL,
  PRIMARY KEY (`key`),
  UNIQUE KEY `userID` (`userID`,`key`,`time`,`hasChanged`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_lostpassword`
--

LOCK TABLES `uni1_lostpassword` WRITE;
/*!40000 ALTER TABLE `uni1_lostpassword` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_lostpassword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_loteria`
--

DROP TABLE IF EXISTS `uni1_loteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_loteria` (
  `ID` int(11) NOT NULL,
  `user` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `tickets` int(5) NOT NULL,
  `universe` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_loteria`
--

LOCK TABLES `uni1_loteria` WRITE;
/*!40000 ALTER TABLE `uni1_loteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_loteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_loteria_log`
--

DROP TABLE IF EXISTS `uni1_loteria_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_loteria_log` (
  `username` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `prize` int(11) NOT NULL,
  `universe` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_loteria_log`
--

LOCK TABLES `uni1_loteria_log` WRITE;
/*!40000 ALTER TABLE `uni1_loteria_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_loteria_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_message_banned`
--

DROP TABLE IF EXISTS `uni1_message_banned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_message_banned` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `who` varchar(64) NOT NULL DEFAULT '',
  `theme` varchar(500) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `longer` int(11) NOT NULL DEFAULT '0',
  `author` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `universe` tinyint(3) unsigned NOT NULL,
  KEY `ID` (`id`),
  KEY `universe` (`universe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_message_banned`
--

LOCK TABLES `uni1_message_banned` WRITE;
/*!40000 ALTER TABLE `uni1_message_banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_message_banned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_messages`
--

DROP TABLE IF EXISTS `uni1_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_messages` (
  `message_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message_owner` int(11) unsigned NOT NULL DEFAULT '0',
  `message_sender` int(11) unsigned NOT NULL DEFAULT '0',
  `message_time` int(11) NOT NULL DEFAULT '0',
  `message_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `message_from` varchar(128) DEFAULT NULL,
  `message_subject` varchar(255) DEFAULT NULL,
  `message_text` text,
  `message_unread` tinyint(4) NOT NULL DEFAULT '1',
  `message_universe` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `message_sender` (`message_sender`),
  KEY `message_owner` (`message_owner`,`message_type`,`message_unread`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_messages`
--

LOCK TABLES `uni1_messages` WRITE;
/*!40000 ALTER TABLE `uni1_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_minichat`
--

DROP TABLE IF EXISTS `uni1_minichat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_minichat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL DEFAULT '0',
  `pseudo` varchar(32) CHARACTER SET utf8 NOT NULL,
  `alliance` varchar(255) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `color` varchar(55) NOT NULL,
  `destinataire` int(11) unsigned NOT NULL DEFAULT '0',
  `isAnnonce` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_minichat`
--

LOCK TABLES `uni1_minichat` WRITE;
/*!40000 ALTER TABLE `uni1_minichat` DISABLE KEYS */;
INSERT INTO `uni1_minichat` VALUES (1,1,'demo','','hello',1507502926,'',0,0),(2,1,'demo','','This is a unsupported demo website',1507504013,'',0,0),(3,1,'demo','','Hello, we are the 09/10/2017',1507524649,'',0,0),(4,12,'Drood','','hello :)',1507974740,'',0,0);
/*!40000 ALTER TABLE `uni1_minichat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_multi`
--

DROP TABLE IF EXISTS `uni1_multi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_multi` (
  `multiID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`multiID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_multi`
--

LOCK TABLES `uni1_multi` WRITE;
/*!40000 ALTER TABLE `uni1_multi` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_multi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_news`
--

DROP TABLE IF EXISTS `uni1_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL,
  `date` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_news`
--

LOCK TABLES `uni1_news` WRITE;
/*!40000 ALTER TABLE `uni1_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_newsfeed`
--

DROP TABLE IF EXISTS `uni1_newsfeed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_newsfeed` (
  `feedID` int(11) NOT NULL AUTO_INCREMENT,
  `username` int(11) NOT NULL DEFAULT '0',
  `date` int(11) unsigned NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8 NOT NULL,
  `accepted` int(11) unsigned NOT NULL DEFAULT '0',
  `valid_until` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`feedID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_newsfeed`
--

LOCK TABLES `uni1_newsfeed` WRITE;
/*!40000 ALTER TABLE `uni1_newsfeed` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_newsfeed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_notes`
--

DROP TABLE IF EXISTS `uni1_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) unsigned DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `priority` tinyint(1) unsigned DEFAULT '1',
  `title` varchar(32) DEFAULT NULL,
  `text` text,
  `universe` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `universe` (`universe`),
  KEY `owner` (`owner`,`time`,`priority`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_notes`
--

LOCK TABLES `uni1_notes` WRITE;
/*!40000 ALTER TABLE `uni1_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_paypal`
--

DROP TABLE IF EXISTS `uni1_paypal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_paypal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_paypal`
--

LOCK TABLES `uni1_paypal` WRITE;
/*!40000 ALTER TABLE `uni1_paypal` DISABLE KEYS */;
INSERT INTO `uni1_paypal` VALUES (1,1,1,1507502943,2);
/*!40000 ALTER TABLE `uni1_paypal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_paypal_log`
--

DROP TABLE IF EXISTS `uni1_paypal_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_paypal_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `darkmatter` double(50,0) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_paypal_log`
--

LOCK TABLES `uni1_paypal_log` WRITE;
/*!40000 ALTER TABLE `uni1_paypal_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_paypal_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_paysafecard_log`
--

DROP TABLE IF EXISTS `uni1_paysafecard_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_paysafecard_log` (
  `payID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL DEFAULT '0',
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `pinCode` text,
  `pinPrice` float(5,2) unsigned NOT NULL DEFAULT '0.00',
  `pinCredits` float(5,2) unsigned NOT NULL DEFAULT '0.00',
  `pinType` varchar(255) DEFAULT NULL,
  `pinAprouved` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`payID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_paysafecard_log`
--

LOCK TABLES `uni1_paysafecard_log` WRITE;
/*!40000 ALTER TABLE `uni1_paysafecard_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_paysafecard_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_planets`
--

DROP TABLE IF EXISTS `uni1_planets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_planets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT 'Hauptplanet',
  `id_owner` int(11) unsigned DEFAULT NULL,
  `universe` tinyint(3) unsigned NOT NULL,
  `galaxy` tinyint(3) NOT NULL DEFAULT '0',
  `system` smallint(5) NOT NULL DEFAULT '0',
  `planet` tinyint(3) NOT NULL DEFAULT '0',
  `last_update` int(11) DEFAULT NULL,
  `planet_type` enum('1','3') NOT NULL DEFAULT '1',
  `destruyed` int(11) NOT NULL DEFAULT '0',
  `b_building` int(11) NOT NULL DEFAULT '0',
  `b_building_id` text,
  `b_hangar` int(11) NOT NULL DEFAULT '0',
  `b_hangar_id` text,
  `b_hangar_plus` int(11) NOT NULL DEFAULT '0',
  `b_defense` int(11) NOT NULL DEFAULT '0',
  `b_defense_id` text,
  `b_defense_plus` int(11) NOT NULL DEFAULT '0',
  `image` varchar(32) NOT NULL DEFAULT 'normaltempplanet01',
  `diameter` int(11) unsigned NOT NULL DEFAULT '12800',
  `field_current` smallint(5) unsigned NOT NULL DEFAULT '0',
  `field_max` smallint(5) unsigned NOT NULL DEFAULT '163',
  `temp_min` int(3) NOT NULL DEFAULT '-17',
  `temp_max` int(3) NOT NULL DEFAULT '23',
  `eco_hash` varchar(32) NOT NULL DEFAULT '',
  `formation` double(50,0) unsigned NOT NULL DEFAULT '0',
  `formation_used` bigint(11) unsigned NOT NULL DEFAULT '0',
  `metal` double(50,6) unsigned NOT NULL DEFAULT '0.000000',
  `metal_perhour` double(50,6) NOT NULL DEFAULT '0.000000',
  `metal_max` double(50,0) unsigned DEFAULT '100000',
  `crystal` double(50,6) unsigned NOT NULL DEFAULT '0.000000',
  `crystal_perhour` double(50,6) NOT NULL DEFAULT '0.000000',
  `crystal_max` double(50,0) unsigned DEFAULT '100000',
  `deuterium` double(50,6) unsigned NOT NULL DEFAULT '0.000000',
  `deuterium_perhour` double(50,6) NOT NULL DEFAULT '0.000000',
  `deuterium_max` double(50,0) unsigned DEFAULT '100000',
  `elyrium` double(50,6) unsigned NOT NULL DEFAULT '0.000000',
  `elyrium_perhour` double(50,6) unsigned NOT NULL DEFAULT '0.000000',
  `elyrium_max` double(50,0) unsigned NOT NULL DEFAULT '100000',
  `energy_used` double(50,0) NOT NULL DEFAULT '0',
  `energy` double(50,0) unsigned NOT NULL DEFAULT '0',
  `metal_mine` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `metal_mine_extract` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `crystal_mine` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `crystal_mine_extract` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deuterium_sintetizer` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deuterium_sintetizer_extract` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `elyrium_mine` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `elyrium_mine_extract` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `solar_plant` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `solar_plant_extract` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fusion_plant` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `robot_factory` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `nano_factory` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hangar` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `metal_store` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `crystal_store` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deuterium_store` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `elyrium_store` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `laboratory` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `terraformer` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `university` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ally_deposit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `silo` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mondbasis` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `phalanx` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sprungtor` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `antaris_headpost` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `headquarters_antaris` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `barracks` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `defense_base` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `small_ship_cargo` bigint(20) unsigned NOT NULL DEFAULT '0',
  `big_ship_cargo` bigint(20) unsigned NOT NULL DEFAULT '0',
  `light_hunter` bigint(20) unsigned NOT NULL DEFAULT '0',
  `heavy_hunter` bigint(20) unsigned NOT NULL DEFAULT '0',
  `crusher` bigint(20) unsigned NOT NULL DEFAULT '0',
  `battle_ship` bigint(20) unsigned NOT NULL DEFAULT '0',
  `colonizer` bigint(20) unsigned NOT NULL DEFAULT '0',
  `recycler` bigint(20) unsigned NOT NULL DEFAULT '0',
  `spy_sonde` bigint(20) unsigned NOT NULL DEFAULT '0',
  `bomber_ship` bigint(20) unsigned NOT NULL DEFAULT '0',
  `solar_satelit` bigint(20) unsigned NOT NULL DEFAULT '0',
  `destructor` bigint(20) unsigned NOT NULL DEFAULT '0',
  `dearth_star` bigint(20) unsigned NOT NULL DEFAULT '0',
  `battleship` bigint(20) unsigned NOT NULL DEFAULT '0',
  `lune_noir` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ev_transporter` bigint(20) unsigned NOT NULL DEFAULT '0',
  `star_crasher` bigint(20) unsigned NOT NULL DEFAULT '0',
  `giga_recykler` bigint(20) unsigned NOT NULL DEFAULT '0',
  `dm_ship` bigint(20) NOT NULL DEFAULT '0',
  `elyrium_reactor` bigint(20) unsigned NOT NULL DEFAULT '0',
  `energy_modulator` bigint(20) unsigned NOT NULL DEFAULT '0',
  `mid_recycler` double(50,0) unsigned NOT NULL DEFAULT '0',
  `spy_sonde_portal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `speeder` bigint(20) unsigned NOT NULL DEFAULT '0',
  `drones` bigint(20) unsigned NOT NULL DEFAULT '0',
  `orbital_station` bigint(20) unsigned NOT NULL DEFAULT '0',
  `misil_launcher` bigint(20) unsigned NOT NULL DEFAULT '0',
  `small_laser` bigint(20) unsigned NOT NULL DEFAULT '0',
  `big_laser` bigint(20) unsigned NOT NULL DEFAULT '0',
  `gauss_canyon` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ionic_canyon` bigint(20) unsigned NOT NULL DEFAULT '0',
  `buster_canyon` bigint(20) unsigned NOT NULL DEFAULT '0',
  `small_protection_shield` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `planet_protector` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `big_protection_shield` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `graviton_canyon` bigint(20) unsigned NOT NULL DEFAULT '0',
  `light_platform` bigint(20) unsigned NOT NULL DEFAULT '0',
  `heavy_platform` bigint(20) unsigned NOT NULL DEFAULT '0',
  `chasseur_canon` bigint(20) unsigned NOT NULL DEFAULT '0',
  `canon_ion` bigint(20) unsigned NOT NULL DEFAULT '0',
  `exper_defense` bigint(20) unsigned NOT NULL DEFAULT '0',
  `mine_space` bigint(20) unsigned NOT NULL DEFAULT '0',
  `satelite_antaris` bigint(20) unsigned NOT NULL DEFAULT '0',
  `interceptor_misil` bigint(20) unsigned NOT NULL DEFAULT '0',
  `interplanetary_misil` bigint(20) unsigned NOT NULL DEFAULT '0',
  `metal_mine_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `metal_mine_extract_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `crystal_mine_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `crystal_mine_extract_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `deuterium_sintetizer_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `deuterium_sintetizer_extract_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `solar_plant_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `solar_plant_extract_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `elyrium_mine_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `elyrium_mine_extract_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `fusion_plant_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `solar_satelit_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `barracks_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `last_jump_time` int(11) NOT NULL DEFAULT '0',
  `der_metal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `der_crystal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `der_deuterium` double(50,0) unsigned NOT NULL DEFAULT '0',
  `der_elyrium` double(50,0) unsigned NOT NULL DEFAULT '0',
  `id_luna` int(11) NOT NULL DEFAULT '0',
  `teleport_portal` int(11) unsigned NOT NULL DEFAULT '1',
  `teleport_portal_timer` int(11) unsigned NOT NULL DEFAULT '0',
  `force_field_timer` int(11) unsigned NOT NULL DEFAULT '0',
  `force_field_timer_bis` int(11) unsigned NOT NULL DEFAULT '0',
  `siege_on` int(11) unsigned NOT NULL DEFAULT '0',
  `siege_activated` int(11) unsigned NOT NULL DEFAULT '0',
  `ordernumber` int(11) unsigned NOT NULL DEFAULT '0',
  `metal_bunker` bigint(20) unsigned NOT NULL DEFAULT '0',
  `crystal_bunker` bigint(20) unsigned NOT NULL DEFAULT '0',
  `deuterium_bunker` bigint(20) unsigned NOT NULL DEFAULT '0',
  `elyrium_bunker` bigint(20) unsigned NOT NULL DEFAULT '0',
  `metal_bunker_in` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `crystal_bunker_in` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deuterium_bunker_in` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `elyrium_bunker_in` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `civil` bigint(20) unsigned NOT NULL DEFAULT '0',
  `technician` bigint(20) unsigned NOT NULL DEFAULT '0',
  `scientist` bigint(20) unsigned NOT NULL DEFAULT '0',
  `archaeologist` bigint(20) unsigned NOT NULL DEFAULT '0',
  `diplomat` bigint(20) unsigned NOT NULL DEFAULT '0',
  `soldier` bigint(20) unsigned NOT NULL DEFAULT '0',
  `adv_soldier` bigint(20) unsigned NOT NULL DEFAULT '0',
  `pilot` bigint(20) unsigned NOT NULL DEFAULT '0',
  `antaris` bigint(20) unsigned NOT NULL DEFAULT '0',
  `technician_used` bigint(20) unsigned NOT NULL DEFAULT '0',
  `scientis_used` bigint(20) unsigned NOT NULL DEFAULT '0',
  `civil_prod` bigint(20) unsigned NOT NULL DEFAULT '0',
  `technician_prod` bigint(20) unsigned NOT NULL DEFAULT '0',
  `scientist_prod` bigint(20) unsigned NOT NULL DEFAULT '0',
  `archaeologist_prod` bigint(20) unsigned NOT NULL DEFAULT '0',
  `diplomat_prod` bigint(20) unsigned NOT NULL DEFAULT '0',
  `soldier_prod` bigint(20) unsigned NOT NULL DEFAULT '0',
  `adv_soldier_prod` bigint(20) unsigned NOT NULL DEFAULT '0',
  `pilot_prod` bigint(20) unsigned NOT NULL DEFAULT '0',
  `colo_metal` int(11) NOT NULL DEFAULT '0',
  `colo_crystal` int(11) NOT NULL DEFAULT '0',
  `colo_deut` int(11) NOT NULL DEFAULT '0',
  `colo_elyrium` int(11) NOT NULL DEFAULT '0',
  `specialships` text,
  `b_vaisseau` int(11) NOT NULL DEFAULT '0',
  `b_vaisseau_id` text,
  `b_vaisseau_plus` int(11) NOT NULL DEFAULT '0',
  `ownCount` text,
  `civilProd901` double(50,6) NOT NULL DEFAULT '0.000000',
  `civilProd902` double(50,6) NOT NULL DEFAULT '0.000000',
  `civilProd903` double(50,6) NOT NULL DEFAULT '0.000000',
  `civilProd904` double(50,6) NOT NULL DEFAULT '0.000000',
  PRIMARY KEY (`id`),
  KEY `id_luna` (`id_luna`),
  KEY `id_owner` (`id_owner`),
  KEY `destruyed` (`destruyed`),
  KEY `universe` (`universe`,`galaxy`,`system`,`planet`,`planet_type`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_planets`
--

LOCK TABLES `uni1_planets` WRITE;
/*!40000 ALTER TABLE `uni1_planets` DISABLE KEYS */;
INSERT INTO `uni1_planets` VALUES (1,'homeplanet',1,1,1,1,3,1507561475,'1',0,0,'',0,'',0,0,'',0,'21',12767,0,163,20,60,'',0,0,80000.000000,0.000000,80000,60000.000000,0.000000,60000,40000.000000,0.000000,40000,50000.000000,0.000000,20000,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'10','10','10','10','10','10','10','10','10','10','10','10','10',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,NULL,0,'',0.000000,0.000000,0.000000,0.000000),(19,'irgendwas',19,1,1,19,3,1516049188,'1',0,0,'',0,'',0,0,'',0,'1',12767,0,163,56,96,'',0,0,40797.222223,0.000000,80000,30637.777777,0.000000,60000,20318.888891,0.000000,40000,50000.000000,0.000000,20000,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'10','10','10','10','10','10','10','10','10','10','10','10','10',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,NULL,0,'',0.000000,0.000000,0.000000,0.000000),(20,'mein haus',20,1,1,20,5,1516125177,'1',0,0,'',0,'',0,0,'',0,'25',12767,0,163,-3,37,'',0,0,80000.000000,0.000000,80000,60000.000000,0.000000,60000,40000.000000,0.000000,40000,50000.000000,0.000000,20000,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'10','10','10','10','10','10','10','10','10','10','10','10','10',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,NULL,0,'',0.000000,0.000000,0.000000,0.000000),(21,'DreamHome',21,1,1,21,6,1516426314,'1',0,0,'',0,'',0,0,'',0,'11',12767,0,163,15,55,'',0,0,40204.166666,0.000000,80000,30163.333334,0.000000,60000,20081.666667,0.000000,40000,50000.000000,0.000000,20000,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'10','10','10','10','10','10','10','10','10','10','10','10','10',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,NULL,0,'',0.000000,0.000000,0.000000,0.000000),(22,'turbo',22,1,1,22,4,1516435761,'1',0,1516436095,'a:1:{i:0;a:5:{i:0;i:1;i:1;i:1;i:2;d:348;i:3;d:1516436095;i:4;s:5:\"build\";}}',0,'',0,0,'',0,'23',12767,0,163,37,77,'',0,0,39947.222222,0.000000,80000,30070.277778,0.000000,60000,20083.888888,0.000000,40000,50000.000000,0.000000,20000,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'10','10','10','10','10','10','10','10','10','10','10','10','10',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,NULL,0,'',0.000000,0.000000,0.000000,0.000000),(23,'xapim',23,1,1,23,3,1517357363,'1',0,0,'',0,'',0,0,'',0,'9',12767,6,163,30,70,'',0,0,69332.140120,33.600000,80000,53864.388701,25.200000,60000,32387.599504,16.800000,40000,50000.000000,9.576000,20000,-66,50,1,0,1,0,1,0,1,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'10','10','10','10','10','10','10','10','10','10','10','10','10',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,NULL,0,'',0.000000,0.000000,0.000000,0.000000),(24,'retaq',24,1,1,24,7,1518088831,'1',0,1518089034,'a:1:{i:0;a:5:{i:0;i:4;i:1;i:1;i:2;d:423;i:3;d:1518089034;i:4;s:5:\"build\";}}',0,'',0,0,'',0,'25',12767,0,163,-38,2,'',0,0,40122.222223,0.000000,80000,30165.277777,0.000000,60000,20093.888889,0.000000,40000,50000.000000,0.000000,20000,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'10','10','10','10','10','10','10','10','10','10','10','10','10',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,NULL,0,'',0.000000,0.000000,0.000000,0.000000),(25,'hr9uu',25,1,1,25,4,1518465291,'1',0,0,'',0,'',0,0,'',0,'34',12767,0,163,30,70,'46e666acabd76b575c142d47e89f3b2a',0,0,40130.555555,0.000000,80000,30104.444445,0.000000,60000,20052.222223,0.000000,40000,50000.000000,0.000000,20000,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'10','10','10','10','10','10','10','10','10','10','10','10','10',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,NULL,0,'',0.000000,0.000000,0.000000,0.000000);
/*!40000 ALTER TABLE `uni1_planets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_raports`
--

DROP TABLE IF EXISTS `uni1_raports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_raports` (
  `rid` varchar(32) NOT NULL,
  `raport` text NOT NULL,
  `time` int(11) NOT NULL,
  `attacker` varchar(255) NOT NULL DEFAULT '',
  `defender` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`rid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_raports`
--

LOCK TABLES `uni1_raports` WRITE;
/*!40000 ALTER TABLE `uni1_raports` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_raports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_records`
--

DROP TABLE IF EXISTS `uni1_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_records` (
  `userID` int(10) unsigned NOT NULL,
  `elementID` smallint(5) unsigned NOT NULL,
  `level` bigint(20) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_records`
--

LOCK TABLES `uni1_records` WRITE;
/*!40000 ALTER TABLE `uni1_records` DISABLE KEYS */;
INSERT INTO `uni1_records` VALUES (23,1,1),(23,2,1),(23,3,1),(23,4,2),(23,48,1);
/*!40000 ALTER TABLE `uni1_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_reward`
--

DROP TABLE IF EXISTS `uni1_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_reward` (
  `rewardId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rewardCode` varchar(255) NOT NULL,
  `rewardMetal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `rewardCrystal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `rewardDeuterium` double(50,0) unsigned NOT NULL DEFAULT '0',
  `rewardElyrium` double(50,0) unsigned NOT NULL DEFAULT '0',
  `rewardDarkmatter` double(50,0) unsigned NOT NULL DEFAULT '0',
  `rewardCount` int(11) NOT NULL DEFAULT '-1',
  `rewardUserLimit` int(11) NOT NULL DEFAULT '1',
  `universe` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`rewardId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_reward`
--

LOCK TABLES `uni1_reward` WRITE;
/*!40000 ALTER TABLE `uni1_reward` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_reward_log`
--

DROP TABLE IF EXISTS `uni1_reward_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_reward_log` (
  `rewardIdLog` int(11) unsigned NOT NULL DEFAULT '0',
  `rewardUserId` int(11) unsigned NOT NULL DEFAULT '0',
  `rewardTime` int(11) unsigned NOT NULL DEFAULT '0',
  `universe` int(11) unsigned NOT NULL DEFAULT '0',
  `rewardPrice` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_reward_log`
--

LOCK TABLES `uni1_reward_log` WRITE;
/*!40000 ALTER TABLE `uni1_reward_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_reward_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_session`
--

DROP TABLE IF EXISTS `uni1_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_session` (
  `sessionID` varchar(32) NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `userIP` varchar(40) NOT NULL,
  `lastonline` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `sessionID` (`sessionID`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_session`
--

LOCK TABLES `uni1_session` WRITE;
/*!40000 ALTER TABLE `uni1_session` DISABLE KEYS */;
INSERT INTO `uni1_session` VALUES ('resbsl8slcp9lg2svcpf2nvj35',24,'95.71.8.254',1518088864),('h19bf5smqukp3mclf3k00dnt75',25,'92.238.244.69',1518465311);
/*!40000 ALTER TABLE `uni1_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_shortcuts`
--

DROP TABLE IF EXISTS `uni1_shortcuts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_shortcuts` (
  `shortcutID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ownerID` int(10) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `galaxy` tinyint(3) unsigned NOT NULL,
  `system` smallint(5) unsigned NOT NULL,
  `planet` tinyint(3) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`shortcutID`),
  KEY `ownerID` (`ownerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_shortcuts`
--

LOCK TABLES `uni1_shortcuts` WRITE;
/*!40000 ALTER TABLE `uni1_shortcuts` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_shortcuts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_stathistory`
--

DROP TABLE IF EXISTS `uni1_stathistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_stathistory` (
  `id_owner` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `universe` tinyint(4) NOT NULL,
  `history_build_points` double(50,0) NOT NULL,
  `history_tech_points` double(50,0) NOT NULL,
  `history_fleet_points` double(50,0) NOT NULL,
  `history_defs_points` double(50,0) NOT NULL,
  `history_popu_points` double(50,0) NOT NULL,
  `history_ownship_points` double(50,0) unsigned NOT NULL DEFAULT '0',
  `history_total_points` double(50,0) NOT NULL,
  `history_total_rank` double(50,0) NOT NULL DEFAULT '0',
  UNIQUE KEY `id_owner` (`id_owner`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_stathistory`
--

LOCK TABLES `uni1_stathistory` WRITE;
/*!40000 ALTER TABLE `uni1_stathistory` DISABLE KEYS */;
INSERT INTO `uni1_stathistory` VALUES (1,1518088581,1,0,0,0,0,0,0,0,0),(19,1518088581,1,0,0,0,0,0,0,0,1),(20,1518088581,1,0,0,0,0,0,0,0,2),(21,1518088581,1,0,0,0,0,0,0,0,3),(22,1518088581,1,0,0,0,0,0,0,0,4),(23,1518088581,1,0,0,0,0,0,0,0,5),(24,1518088581,1,0,0,0,0,0,0,0,6),(25,1518465197,1,0,0,0,0,0,0,0,8);
/*!40000 ALTER TABLE `uni1_stathistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_statpoints`
--

DROP TABLE IF EXISTS `uni1_statpoints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_statpoints` (
  `id_owner` int(11) unsigned NOT NULL DEFAULT '0',
  `id_ally` int(11) unsigned NOT NULL DEFAULT '0',
  `stat_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `universe` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `tech_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `tech_old_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `tech_points` double(50,0) unsigned NOT NULL DEFAULT '0',
  `tech_count` bigint(20) unsigned NOT NULL DEFAULT '0',
  `build_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `build_old_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `build_points` double(50,0) unsigned NOT NULL DEFAULT '0',
  `build_count` double(50,0) unsigned NOT NULL DEFAULT '0',
  `defs_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `defs_old_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `defs_points` double(50,0) unsigned NOT NULL DEFAULT '0',
  `defs_count` double(50,0) unsigned NOT NULL DEFAULT '0',
  `popu_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `popu_old_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `popu_points` double(50,0) unsigned NOT NULL DEFAULT '0',
  `popu_count` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_old_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_points` double(50,0) unsigned NOT NULL DEFAULT '0',
  `fleet_count` double(50,0) unsigned NOT NULL DEFAULT '0',
  `ownship_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `ownship_old_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `ownship_points` double(50,0) unsigned NOT NULL DEFAULT '0',
  `ownship_count` double(50,0) unsigned NOT NULL DEFAULT '0',
  `total_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `total_old_rank` double(50,0) unsigned NOT NULL DEFAULT '0',
  `total_points` double(50,0) unsigned NOT NULL DEFAULT '0',
  `total_count` double(50,0) unsigned NOT NULL DEFAULT '0',
  KEY `id_owner` (`id_owner`),
  KEY `universe` (`universe`),
  KEY `stat_type` (`stat_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_statpoints`
--

LOCK TABLES `uni1_statpoints` WRITE;
/*!40000 ALTER TABLE `uni1_statpoints` DISABLE KEYS */;
INSERT INTO `uni1_statpoints` VALUES (1,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(19,0,1,1,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0),(20,0,1,1,2,2,0,0,2,2,0,0,2,2,0,0,2,2,0,0,2,2,0,0,2,2,0,0,2,2,0,0),(21,0,1,1,3,3,0,0,3,3,0,0,3,3,0,0,3,3,0,0,3,3,0,0,3,3,0,0,3,3,0,0),(22,0,1,1,4,4,0,0,4,4,0,0,4,4,0,0,4,4,0,0,4,4,0,0,4,4,0,0,4,4,0,0),(23,0,1,1,5,5,0,0,5,5,0,6,5,5,0,0,5,5,0,0,5,5,0,0,5,5,0,0,5,5,0,6),(24,0,1,1,6,6,0,0,6,6,0,0,6,6,0,0,6,6,0,0,6,6,0,0,6,6,0,0,6,6,0,0),(25,0,1,1,8,0,0,0,8,0,0,0,8,0,0,0,8,0,0,0,8,0,0,0,8,0,0,0,8,0,0,0);
/*!40000 ALTER TABLE `uni1_statpoints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_ticket`
--

DROP TABLE IF EXISTS `uni1_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_ticket` (
  `ticketID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universe` tinyint(3) unsigned NOT NULL,
  `ownerID` int(10) unsigned NOT NULL,
  `categoryID` tinyint(1) unsigned NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ticketID`),
  KEY `ownerID` (`ownerID`),
  KEY `universe` (`universe`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_ticket`
--

LOCK TABLES `uni1_ticket` WRITE;
/*!40000 ALTER TABLE `uni1_ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_ticket_answer`
--

DROP TABLE IF EXISTS `uni1_ticket_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_ticket_answer` (
  `answerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ownerID` int(10) unsigned NOT NULL,
  `ownerName` varchar(32) NOT NULL,
  `ticketID` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  PRIMARY KEY (`answerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_ticket_answer`
--

LOCK TABLES `uni1_ticket_answer` WRITE;
/*!40000 ALTER TABLE `uni1_ticket_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_ticket_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_ticket_category`
--

DROP TABLE IF EXISTS `uni1_ticket_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_ticket_category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_ticket_category`
--

LOCK TABLES `uni1_ticket_category` WRITE;
/*!40000 ALTER TABLE `uni1_ticket_category` DISABLE KEYS */;
INSERT INTO `uni1_ticket_category` VALUES (1,'Support');
/*!40000 ALTER TABLE `uni1_ticket_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_topkb`
--

DROP TABLE IF EXISTS `uni1_topkb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_topkb` (
  `rid` varchar(32) NOT NULL,
  `units` double(50,0) unsigned NOT NULL,
  `result` varchar(1) NOT NULL,
  `time` int(11) NOT NULL,
  `universe` tinyint(3) unsigned NOT NULL,
  KEY `time` (`universe`,`rid`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_topkb`
--

LOCK TABLES `uni1_topkb` WRITE;
/*!40000 ALTER TABLE `uni1_topkb` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_topkb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_tracking_mod`
--

DROP TABLE IF EXISTS `uni1_tracking_mod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_tracking_mod` (
  `trackId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL,
  `userName` text CHARACTER SET utf8,
  `pageVisited` text CHARACTER SET utf8,
  `data` text CHARACTER SET utf8,
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `trackMode` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`trackId`)
) ENGINE=MyISAM AUTO_INCREMENT=710 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_tracking_mod`
--

LOCK TABLES `uni1_tracking_mod` WRITE;
/*!40000 ALTER TABLE `uni1_tracking_mod` DISABLE KEYS */;
INSERT INTO `uni1_tracking_mod` VALUES (1,1,'demo','page=intro',NULL,1507501421,1),(2,1,'demo','page=intro',NULL,1507501686,1),(3,1,'demo','page=intro',NULL,1507501750,1),(4,1,'demo','page=overview',NULL,1507501757,1),(5,1,'demo','page=overview',NULL,1507501764,1),(6,1,'demo','page=overview',NULL,1507501776,1),(7,1,'demo','page=overview',NULL,1507501785,1),(8,1,'demo','page=overview',NULL,1507501793,1),(9,1,'demo','page=overview',NULL,1507501833,1),(10,1,'demo','page=overview',NULL,1507501841,1),(11,1,'demo','page=overview',NULL,1507501855,1),(12,1,'demo','page=overview',NULL,1507501858,1),(13,1,'demo','page=overview',NULL,1507501943,1),(14,1,'demo','page=overview',NULL,1507501947,1),(15,1,'demo','page=overview',NULL,1507501949,1),(16,1,'demo','page=overview',NULL,1507501963,1),(17,1,'demo','page=settings',NULL,1507501975,1),(18,1,'demo','page=settings',NULL,1507501977,1),(19,1,'demo','page=settings&mode=avatar',NULL,1507501979,1),(20,1,'demo','page=settings&mode=design',NULL,1507501981,1),(21,1,'demo','page=changelang',NULL,1507501984,1),(22,1,'demo','page=overview',NULL,1507501986,1),(23,1,'demo','page=overview',NULL,1507501999,1),(24,1,'demo','page=overview',NULL,1507502223,1),(25,1,'demo','page=overview',NULL,1507502226,1),(26,1,'demo','page=overview',NULL,1507502232,1),(27,1,'demo','page=overview',NULL,1507502248,1),(28,1,'demo','page=overview',NULL,1507502251,1),(29,1,'demo','page=shipyard&mode=fleet',NULL,1507502285,1),(30,1,'demo','page=CreateShip',NULL,1507502287,1),(31,1,'demo','page=CreateShip',NULL,1507502311,1),(32,1,'demo','page=CreateShip',NULL,1507502314,1),(33,1,'demo','page=CreateShip&mode=ships',NULL,1507502316,1),(34,1,'demo','page=overview',NULL,1507502319,1),(35,1,'demo','page=overview',NULL,1507502464,1),(36,1,'demo','page=overview',NULL,1507502473,1),(37,1,'demo','page=techtree',NULL,1507502474,1),(38,1,'demo','page=overview',NULL,1507502476,1),(39,1,'demo','page=overview',NULL,1507502483,1),(40,1,'demo','page=overview',NULL,1507502484,1),(41,1,'demo','page=techtree',NULL,1507502485,1),(42,1,'demo','page=galaxy',NULL,1507502486,1),(43,1,'demo','page=galaxy',NULL,1507502496,1),(44,1,'demo','page=galaxy',NULL,1507502539,1),(45,1,'demo','page=galaxy',NULL,1507502724,1),(46,1,'demo','page=galaxy',NULL,1507502876,1),(47,1,'demo','page=overview',NULL,1507502885,1),(48,1,'demo','page=techtree',NULL,1507502886,1),(49,1,'demo','page=galaxy',NULL,1507502888,1),(50,1,'demo','page=Tportal',NULL,1507502889,1),(51,1,'demo','page=center',NULL,1507502890,1),(52,1,'demo','page=Tower',NULL,1507502891,1),(53,1,'demo','page=research',NULL,1507502893,1),(54,1,'demo','page=Tower',NULL,1507502895,1),(55,1,'demo','page=buildings',NULL,1507502899,1),(56,1,'demo','page=research',NULL,1507502901,1),(57,1,'demo','page=shipyard&mode=fleet',NULL,1507502902,1),(58,1,'demo','page=CreateShip',NULL,1507502903,1),(59,1,'demo','page=defense',NULL,1507502903,1),(60,1,'demo','page=population',NULL,1507502905,1),(61,1,'demo','page=search',NULL,1507502906,1),(62,1,'demo','page=alliance',NULL,1507502907,1),(63,1,'demo','page=market',NULL,1507502908,1),(64,1,'demo','page=Bunker',NULL,1507502909,1),(65,1,'demo','page=Bank',NULL,1507502910,1),(66,1,'demo','page=battleSimulator',NULL,1507502911,1),(67,1,'demo','page=spaceSimulator',NULL,1507502912,1),(68,1,'demo','page=Immunity',NULL,1507502915,1),(69,1,'demo','page=messages',NULL,1507502917,1),(70,1,'demo','page=statistics',NULL,1507502919,1),(71,1,'demo','page=settings',NULL,1507502921,1),(72,1,'demo','page=gestion',NULL,1507502922,1),(73,1,'demo','page=Tchat',NULL,1507502923,1),(74,1,'demo','page=Achat',NULL,1507502930,1),(75,1,'demo','page=faq',NULL,1507502933,1),(76,1,'demo','page=ticket',NULL,1507502935,1),(77,1,'demo','page=banList',NULL,1507502937,1),(78,1,'demo','page=Achat',NULL,1507502938,1),(79,1,'demo','page=Achat&mode=paypal',NULL,1507502941,1),(80,1,'demo','page=Achat&mode=paypal',NULL,1507502943,1),(81,1,'demo','page=Achat',NULL,1507502950,1),(82,1,'demo','page=overview',NULL,1507502952,1),(83,1,'demo','page=Achat',NULL,1507502957,1),(84,1,'demo','page=Achat&mode=paypal',NULL,1507502959,1),(85,1,'demo','page=Achat&mode=allopass',NULL,1507502961,1),(86,1,'demo','page=Achat',NULL,1507502964,1),(87,1,'demo','page=overview',NULL,1507502965,1),(88,1,'demo','page=overview',NULL,1507502991,1),(89,1,'demo','game.php',NULL,1507503509,1),(90,1,'demo','page=overview',NULL,1507503511,1),(91,1,'demo','page=techtree',NULL,1507503514,1),(92,1,'demo','page=galaxy',NULL,1507503515,1),(93,1,'demo','page=Tportal',NULL,1507503516,1),(94,1,'demo','page=center',NULL,1507503517,1),(95,1,'demo','page=Tower',NULL,1507503518,1),(96,1,'demo','page=overview',NULL,1507503519,1),(97,1,'demo','page=overview',NULL,1507503654,1),(98,1,'demo','page=overview',NULL,1507503659,1),(99,1,'demo','page=overview',NULL,1507503665,1),(100,1,'demo','page=overview',NULL,1507503731,1),(101,1,'demo','page=overview',NULL,1507503780,1),(102,1,'demo','page=overview',NULL,1507503807,1),(103,1,'demo','page=intro',NULL,1507503996,1),(104,1,'demo','page=Tchat',NULL,1507504001,1),(105,1,'demo','page=overview',NULL,1507504020,1),(106,1,'demo','page=achievements',NULL,1507504026,1),(107,1,'demo','page=overview',NULL,1507504031,1),(108,1,'demo','page=alliance',NULL,1507504033,1),(109,1,'demo','page=overview',NULL,1507504034,1),(110,1,'demo','page=shipyard&mode=fleet',NULL,1507504036,1),(111,1,'demo','page=CreateShip',NULL,1507504037,1),(112,1,'demo','page=defense',NULL,1507504038,1),(113,1,'demo','page=overview',NULL,1507504039,1),(114,1,'demo','page=overview',NULL,1507504126,1),(115,1,'demo','page=CreateShip',NULL,1507504146,1),(116,1,'demo','page=CreateShip&mode=ships',NULL,1507504155,1),(117,1,'demo','page=overview',NULL,1507504176,1),(118,1,'demo','page=overview',NULL,1507504181,1),(119,1,'demo','page=overview',NULL,1507504187,1),(120,1,'demo','page=overview',NULL,1507504370,1),(121,1,'demo','page=Tchat',NULL,1507504373,1),(122,1,'demo','page=overview',NULL,1507504377,1),(123,1,'demo','page=alliance',NULL,1507504381,1),(124,1,'demo','page=overview',NULL,1507504382,1),(125,1,'demo','page=overview',NULL,1507504386,1),(126,1,'demo','page=faq',NULL,1507504389,1),(127,1,'demo','page=overview',NULL,1507504391,1),(128,1,'demo','page=overview',NULL,1507504394,1),(129,1,'demo','page=overview',NULL,1507504413,1),(130,1,'demo','page=overview',NULL,1507504415,1),(131,1,'demo','page=techtree',NULL,1507504417,1),(132,1,'demo','page=logout','The player disconnected.',1507504419,2),(133,1,'demo','page=logout',NULL,1507504419,1),(134,1,'demo','page=intro',NULL,1507504493,1),(135,1,'demo','page=logout','The player disconnected.',1507504495,2),(136,1,'demo','page=logout',NULL,1507504495,1),(137,1,'demo','page=intro',NULL,1507504554,1),(138,1,'demo','page=logout','The player disconnected.',1507504556,2),(139,1,'demo','page=logout',NULL,1507504556,1),(140,1,'demo','page=intro',NULL,1507504563,1),(141,1,'demo','page=overview',NULL,1507504565,1),(142,1,'demo','page=overview',NULL,1507504568,1),(143,1,'demo','page=battleHall',NULL,1507504571,1),(144,1,'demo','page=overview',NULL,1507504573,1),(145,1,'demo','page=Tower',NULL,1507504580,1),(146,1,'demo','page=center',NULL,1507504581,1),(147,1,'demo','page=Tportal',NULL,1507504582,1),(148,1,'demo','page=galaxy',NULL,1507504583,1),(149,1,'demo','page=techtree',NULL,1507504584,1),(150,1,'demo','page=overview',NULL,1507504591,1),(151,1,'demo','page=overview',NULL,1507504592,1),(152,1,'demo','page=techtree',NULL,1507504595,1),(153,1,'demo','page=galaxy',NULL,1507504596,1),(154,1,'demo','page=Tportal',NULL,1507504597,1),(155,1,'demo','page=Tower',NULL,1507504598,1),(156,1,'demo','page=buildings',NULL,1507504598,1),(157,1,'demo','page=research',NULL,1507504600,1),(158,1,'demo','page=shipyard&mode=fleet',NULL,1507504601,1),(159,1,'demo','page=CreateShip',NULL,1507504602,1),(160,1,'demo','page=defense',NULL,1507504603,1),(161,1,'demo','page=population',NULL,1507504603,1),(162,1,'demo','page=overview',NULL,1507504605,1),(163,1,'demo','page=Planetcloak',NULL,1507504607,1),(164,1,'demo','page=Tchat',NULL,1507504610,1),(165,1,'demo','page=Lottery',NULL,1507504612,1),(166,1,'demo','page=overview',NULL,1507504613,1),(167,1,'demo','page=overview',NULL,1507504621,1),(168,1,'demo','page=techtree',NULL,1507504622,1),(169,1,'demo','page=overview',NULL,1507504710,1),(170,1,'demo','page=overview',NULL,1507505384,1),(171,1,'demo','page=logout','The player disconnected.',1507505386,2),(172,1,'demo','page=logout',NULL,1507505386,1),(173,1,'demo','page=intro',NULL,1507505540,1),(174,1,'demo','page=overview',NULL,1507505553,1),(175,1,'demo','page=market',NULL,1507505556,1),(176,1,'demo','page=overview',NULL,1507505558,1),(177,1,'demo','page=Tchat',NULL,1507505564,1),(178,1,'demo','page=overview',NULL,1507505565,1),(179,1,'demo','page=overview',NULL,1507505606,1),(180,1,'demo','page=techtree',NULL,1507505622,1),(181,1,'demo','page=overview',NULL,1507505624,1),(182,1,'demo','page=overview',NULL,1507505633,1),(183,1,'demo','page=overview',NULL,1507505817,1),(184,1,'demo','page=Tchat',NULL,1507505820,1),(185,1,'demo','page=overview',NULL,1507505899,1),(186,1,'demo','page=logout','The player disconnected.',1507505904,2),(187,1,'demo','page=logout',NULL,1507505904,1),(188,2,'klon','page=intro',NULL,1507506203,1),(189,2,'klon','page=overview',NULL,1507506222,1),(190,2,'klon','page=techtree',NULL,1507506230,1),(191,2,'klon','page=galaxy',NULL,1507506232,1),(192,2,'klon','page=buildings',NULL,1507506263,1),(193,1,'demo','page=intro',NULL,1507506278,1),(194,1,'demo','page=Tchat',NULL,1507506281,1),(195,1,'demo','game.php',NULL,1507506304,1),(196,1,'demo','page=Tchat',NULL,1507506307,1),(197,2,'klon','page=search',NULL,1507506307,1),(198,1,'demo','page=overview',NULL,1507506309,1),(199,1,'demo','page=CreateShip',NULL,1507506311,1),(200,2,'klon','page=population',NULL,1507506312,1),(201,1,'demo','page=overview',NULL,1507506315,1),(202,2,'klon','page=center',NULL,1507506323,1),(203,2,'klon','page=Tower',NULL,1507506326,1),(204,2,'klon','page=Tportal',NULL,1507506328,1),(205,2,'klon','page=galaxy',NULL,1507506332,1),(206,2,'klon','page=techtree',NULL,1507506334,1),(207,2,'klon','page=overview',NULL,1507506337,1),(208,1,'demo','page=explorations',NULL,1507506349,1),(209,1,'demo','page=Explorations',NULL,1507506353,1),(210,1,'demo','page=Explorations&mode=expoBusy',NULL,1507506354,1),(211,1,'demo','page=Explorations&mode=expoFound',NULL,1507506356,1),(212,1,'demo','page=Explorations&mode=expoFound',NULL,1507506359,1),(213,1,'demo','page=Explorations',NULL,1507506362,1),(214,1,'demo','page=overview',NULL,1507506364,1),(215,1,'demo','page=Tchat',NULL,1507506368,1),(216,1,'demo','page=overview',NULL,1507506390,1),(217,1,'demo','page=gestion',NULL,1507506392,1),(218,1,'demo','page=Tchat',NULL,1507506394,1),(219,1,'demo','page=overview',NULL,1507506397,1),(220,1,'demo','page=Hln',NULL,1507506400,1),(221,1,'demo','page=overview',NULL,1507506406,1),(222,1,'demo','page=faq',NULL,1507506417,1),(223,1,'demo','page=ticket',NULL,1507506419,1),(224,1,'demo','page=overview',NULL,1507506421,1),(225,1,'demo','page=overview',NULL,1507506425,1),(226,1,'demo','page=techtree',NULL,1507506429,1),(227,1,'demo','page=overview',NULL,1507506431,1),(228,1,'demo','page=resources',NULL,1507506433,1),(229,1,'demo','page=battleSimulator',NULL,1507506434,1),(230,1,'demo','page=spaceSimulator',NULL,1507506441,1),(231,1,'demo','page=battleSimulator',NULL,1507506443,1),(232,1,'demo','page=battleSimulator',NULL,1507506454,1),(233,1,'demo','page=spaceSimulator',NULL,1507506465,1),(234,1,'demo','page=battleSimulator',NULL,1507506468,1),(235,1,'demo','page=spaceSimulator',NULL,1507506479,1),(236,1,'demo','page=overview',NULL,1507506497,1),(237,1,'demo','page=defense',NULL,1507506505,1),(238,1,'demo','page=CreateShip',NULL,1507506508,1),(239,1,'demo','page=CreateShip&mode=ships',NULL,1507506509,1),(240,1,'demo','page=CreateShip',NULL,1507506510,1),(241,1,'demo','page=overview',NULL,1507506532,1),(242,1,'demo','page=Tower',NULL,1507506537,1),(243,1,'demo','page=Tower&mode=newimage',NULL,1507506540,1),(244,1,'demo','page=overview',NULL,1507506551,1),(245,1,'demo','page=settings',NULL,1507506555,1),(246,1,'demo','page=statistics',NULL,1507506557,1),(247,1,'demo','page=overview',NULL,1507506568,1),(248,1,'demo','page=overview',NULL,1507506579,1),(249,1,'demo','page=overview',NULL,1507506680,1),(250,1,'demo','page=overview',NULL,1507506694,1),(251,1,'demo','page=shipyard&mode=fleet',NULL,1507506697,1),(252,1,'demo','page=CreateShip',NULL,1507506702,1),(253,1,'demo','page=defense',NULL,1507506704,1),(254,1,'demo','page=population',NULL,1507506705,1),(255,1,'demo','page=population',NULL,1507506712,1),(256,1,'demo','page=population&mode=flotte',NULL,1507506713,1),(257,1,'demo','page=buildings',NULL,1507506716,1),(258,1,'demo','page=Tower',NULL,1507506717,1),(259,1,'demo','page=Tower&mode=construct',NULL,1507506719,1),(260,1,'demo','page=overview',NULL,1507506722,1),(261,1,'demo','page=overview',NULL,1507506746,1),(262,1,'demo','page=overview',NULL,1507506749,1),(263,1,'demo','page=techtree',NULL,1507506750,1),(264,1,'demo','page=galaxy',NULL,1507506751,1),(265,1,'demo','page=Tportal',NULL,1507506752,1),(266,1,'demo','page=buildings',NULL,1507506753,1),(267,1,'demo','page=research',NULL,1507506755,1),(268,1,'demo','page=CreateShip',NULL,1507506755,1),(269,1,'demo','page=defense',NULL,1507506756,1),(270,1,'demo','page=population',NULL,1507506757,1),(271,1,'demo','page=Bunker',NULL,1507506759,1),(272,1,'demo','page=resources',NULL,1507506760,1),(273,1,'demo','page=battleSimulator',NULL,1507506761,1),(274,1,'demo','page=spaceSimulator',NULL,1507506762,1),(275,1,'demo','page=Planetcloak',NULL,1507506763,1),(276,1,'demo','page=overview',NULL,1507506766,1),(277,1,'demo','page=overview',NULL,1507506773,1),(278,1,'demo','game.php',NULL,1507506895,1),(279,1,'demo','page=CreateShip',NULL,1507506897,1),(280,1,'demo','page=overview',NULL,1507506977,1),(281,1,'demo','page=CreateShip',NULL,1507507055,1),(282,1,'demo','page=overview',NULL,1507507057,1),(283,1,'demo','page=CreateShip',NULL,1507507071,1),(284,1,'demo','page=overview',NULL,1507507127,1),(285,1,'demo','page=CreateShip',NULL,1507507131,1),(286,1,'demo','page=CreateShip',NULL,1507507143,1),(287,1,'demo','page=CreateShip&mode=ships',NULL,1507507279,1),(288,1,'demo','page=overview',NULL,1507507280,1),(289,1,'demo','page=CreateShip',NULL,1507507288,1),(290,1,'demo','game.php',NULL,1507507313,1),(291,3,'Wrath','page=intro',NULL,1507512074,1),(292,3,'Wrath','page=overview',NULL,1507512086,1),(293,3,'Wrath','page=CreateShip',NULL,1507512099,1),(294,3,'Wrath','page=Tportal',NULL,1507512135,1),(295,3,'Wrath','page=techtree',NULL,1507512144,1),(296,3,'Wrath','page=shipyard&mode=fleet',NULL,1507512151,1),(297,3,'Wrath','page=center',NULL,1507512159,1),(298,3,'Wrath','page=galaxy',NULL,1507512169,1),(299,3,'Wrath','page=spaceSimulator',NULL,1507512217,1),(300,4,'xena','page=intro',NULL,1507517398,1),(301,4,'xena','page=Achat',NULL,1507517417,1),(302,4,'xena','page=Tchat',NULL,1507517445,1),(303,4,'xena','page=CreateShip',NULL,1507517888,1),(304,4,'xena','page=CreateShip',NULL,1507517922,1),(305,4,'xena','page=CreateShip&mode=ships',NULL,1507517932,1),(306,4,'xena','page=CreateShip',NULL,1507517938,1),(307,4,'xena','page=research',NULL,1507517957,1),(308,4,'xena','page=center',NULL,1507518000,1),(309,4,'xena','page=center&mode=mission',NULL,1507518004,1),(310,4,'xena','page=Tportal',NULL,1507518012,1),(311,4,'xena','page=techtree',NULL,1507518023,1),(312,4,'xena','page=techtree&mode=ships',NULL,1507518033,1),(313,4,'xena','page=techtree&mode=defense',NULL,1507518053,1),(314,4,'xena','page=techtree&mode=population',NULL,1507518058,1),(315,4,'xena','page=techtree&mode=infra',NULL,1507518064,1),(316,4,'xena','page=techtree&mode=compo',NULL,1507518072,1),(317,4,'xena','page=CreateShip',NULL,1507518101,1),(318,4,'xena','page=CreateShip',NULL,1507518108,1),(319,4,'xena','page=CreateShip',NULL,1507518137,1),(320,4,'xena','page=CreateShip',NULL,1507518414,1),(321,4,'xena','page=techtree',NULL,1507518424,1),(322,4,'xena','page=techtree&mode=ships',NULL,1507518431,1),(323,4,'xena','page=techtree&mode=defense',NULL,1507518439,1),(324,4,'xena','page=techtree&mode=population',NULL,1507518443,1),(325,4,'xena','page=techtree&mode=infra',NULL,1507518448,1),(326,4,'xena','page=techtree&mode=compo',NULL,1507518454,1),(327,4,'xena','page=intro',NULL,1507523535,1),(328,4,'xena','page=CreateShip',NULL,1507523546,1),(329,4,'xena','page=Tchat',NULL,1507523556,1),(330,4,'xena','page=Tchat',NULL,1507524088,1),(331,1,'demo','page=intro',NULL,1507524490,1),(332,1,'demo','page=Tchat',NULL,1507524527,1),(333,1,'demo','game.php',NULL,1507524635,1),(334,1,'demo','page=Tchat',NULL,1507524638,1),(335,1,'demo','page=overview',NULL,1507524653,1),(336,1,'demo','page=overview',NULL,1507524691,1),(337,1,'demo','page=overview',NULL,1507524715,1),(338,1,'demo','page=overview',NULL,1507524723,1),(339,1,'demo','page=overview',NULL,1507524745,1),(340,5,'viperX','page=intro',NULL,1507534052,1),(341,5,'viperX','page=shipyard&mode=fleet',NULL,1507534067,1),(342,5,'viperX','page=Tchat',NULL,1507534072,1),(343,5,'viperX','page=CreateShip',NULL,1507534109,1),(344,6,'Zedr','page=intro',NULL,1507534198,1),(345,6,'Zedr','page=Immunity',NULL,1507534203,1),(346,6,'Zedr','page=Reward2',NULL,1507534210,1),(347,6,'Zedr','page=Bunker',NULL,1507534214,1),(348,6,'Zedr','page=Bank',NULL,1507534217,1),(349,5,'viperX','page=CreateShip&mode=pieces',NULL,1507534227,1),(350,6,'Zedr','page=Bunker',NULL,1507534252,1),(351,5,'viperX','page=CreateShip&mode=flotte',NULL,1507534259,1),(352,6,'Zedr','page=Bunker',NULL,1507534271,1),(353,6,'Zedr','page=Bunker',NULL,1507534282,1),(354,6,'Zedr','page=Bunker&mode=historique',NULL,1507534291,1),(355,6,'Zedr','page=Bunker',NULL,1507534293,1),(356,5,'viperX','page=Bank',NULL,1507534298,1),(357,6,'Zedr','page=Bank',NULL,1507534298,1),(358,5,'viperX','page=alliance',NULL,1507534299,1),(359,5,'viperX','page=market',NULL,1507534301,1),(360,5,'viperX','page=market&mode=echange',NULL,1507534304,1),(361,6,'Zedr','page=changelang',NULL,1507534305,1),(362,5,'viperX','page=market&mode=push',NULL,1507534306,1),(363,6,'Zedr','page=overview',NULL,1507534307,1),(364,5,'viperX','page=market&mode=multi',NULL,1507534310,1),(365,6,'Zedr','page=resources',NULL,1507534310,1),(366,5,'viperX','page=galaxy',NULL,1507534313,1),(367,5,'viperX','page=Tportal',NULL,1507534315,1),(368,6,'Zedr','page=shipyard&mode=fleet',NULL,1507534317,1),(369,5,'viperX','page=Tportal',NULL,1507534320,1),(370,5,'viperX','page=overview',NULL,1507534323,1),(371,5,'viperX','page=Immunity',NULL,1507534384,1),(372,5,'viperX','page=techtree',NULL,1507534416,1),(373,5,'viperX','page=overview',NULL,1507534417,1),(374,5,'viperX','page=Achat',NULL,1507534426,1),(375,5,'viperX','page=Achat&mode=paypal',NULL,1507534453,1),(376,5,'viperX','page=achat&mode=probleme',NULL,1507534468,1),(377,5,'viperX','page=Achat&mode=problemep',NULL,1507534472,1),(378,6,'Zedr','page=Achat',NULL,1507534478,1),(379,5,'viperX','page=Achat&mode=historique',NULL,1507534481,1),(380,6,'Zedr','page=Achat',NULL,1507534560,1),(381,6,'Zedr','page=shipyard&mode=fleet',NULL,1507534563,1),(382,6,'Zedr','page=Bunker',NULL,1507534641,1),(383,6,'Zedr','page=alliance',NULL,1507534642,1),(384,6,'Zedr','page=intro',NULL,1507541274,1),(385,4,'xena','page=intro',NULL,1507558329,1),(386,1,'demo','page=intro',NULL,1507558483,1),(387,1,'demo','page=overview',NULL,1507558490,1),(388,1,'demo','page=overview',NULL,1507558496,1),(389,1,'demo','page=overview',NULL,1507558499,1),(390,1,'demo','game.php',NULL,1507558518,1),(391,1,'demo','page=overview',NULL,1507558529,1),(392,1,'demo','page=overview',NULL,1507558537,1),(393,1,'demo','page=overview',NULL,1507558828,1),(394,1,'demo','page=Tchat',NULL,1507558832,1),(395,1,'demo','page=overview',NULL,1507558837,1),(396,1,'demo','page=overview',NULL,1507561475,1),(397,7,'DrakeSong','page=intro',NULL,1507574412,1),(398,7,'DrakeSong','page=CreateShip',NULL,1507574417,1),(399,8,'odiabile','page=intro',NULL,1507626591,1),(400,8,'odiabile','page=techtree',NULL,1507626597,1),(401,8,'odiabile','page=galaxy',NULL,1507626600,1),(402,8,'odiabile','page=Tportal',NULL,1507626601,1),(403,8,'odiabile','page=galaxy',NULL,1507626603,1),(404,8,'odiabile','page=center',NULL,1507626606,1),(405,8,'odiabile','page=Tower',NULL,1507626607,1),(406,8,'odiabile','page=research',NULL,1507626608,1),(407,8,'odiabile','page=buildings',NULL,1507626610,1),(408,8,'odiabile','page=shipyard&mode=fleet',NULL,1507626611,1),(409,8,'odiabile','page=CreateShip',NULL,1507626612,1),(410,8,'odiabile','page=defense',NULL,1507626613,1),(411,8,'odiabile','page=population',NULL,1507626614,1),(412,8,'odiabile','page=Bunker',NULL,1507626615,1),(413,8,'odiabile','page=resources',NULL,1507626617,1),(414,8,'odiabile','page=battleSimulator',NULL,1507626618,1),(415,8,'odiabile','page=spaceSimulator',NULL,1507626620,1),(416,8,'odiabile','page=messages',NULL,1507626622,1),(417,8,'odiabile','page=Immunity',NULL,1507626625,1),(418,8,'odiabile','page=Planetcloak',NULL,1507626626,1),(419,8,'odiabile','page=Lottery',NULL,1507626627,1),(420,8,'odiabile','page=Reward2',NULL,1507626628,1),(421,9,'Ragnar','page=intro',NULL,1507632244,1),(422,9,'Ragnar','page=overview',NULL,1507632259,1),(423,9,'Ragnar','page=CreateShip',NULL,1507632268,1),(424,9,'Ragnar','page=banList',NULL,1507632289,1),(425,9,'Ragnar','page=Lottery',NULL,1507632293,1),(426,9,'Ragnar','page=Lottery',NULL,1507632587,1),(427,10,'anytime','page=intro',NULL,1507660076,1),(428,10,'anytime','page=changelang',NULL,1507660092,1),(429,10,'anytime','page=statistics',NULL,1507660102,1),(430,10,'anytime','page=CreateShip',NULL,1507660133,1),(431,10,'anytime','page=shipyard&mode=fleet',NULL,1507660136,1),(432,10,'anytime','page=overview',NULL,1507660149,1),(433,10,'anytime','page=techtree',NULL,1507660150,1),(434,10,'anytime','page=galaxy',NULL,1507660151,1),(435,10,'anytime','page=intro',NULL,1507660318,1),(436,10,'anytime','page=buildings',NULL,1507660745,1),(437,10,'anytime','page=buildings',NULL,1507660745,1),(438,11,'Spolfee','page=intro',NULL,1507661731,1),(439,11,'Spolfee','page=buildings',NULL,1507661743,1),(440,11,'Spolfee','page=buildings',NULL,1507661748,1),(441,11,'Spolfee','page=buildings',NULL,1507661773,1),(442,11,'Spolfee','page=CreateShip',NULL,1507661775,1),(443,11,'Spolfee','page=Planetcloak',NULL,1507661782,1),(444,11,'Spolfee','page=Planetcloak',NULL,1507661788,1),(445,11,'Spolfee','page=center',NULL,1507661791,1),(446,11,'Spolfee','page=resources',NULL,1507661811,1),(447,11,'Spolfee','page=research',NULL,1507661821,1),(448,11,'Spolfee','page=buildings',NULL,1507661826,1),(449,11,'Spolfee','page=CreateShip',NULL,1507661840,1),(450,11,'Spolfee','page=CreateShip',NULL,1507661859,1),(451,11,'Spolfee','page=CreateShip',NULL,1507661897,1),(452,11,'Spolfee','page=CreateShip&mode=ships',NULL,1507661900,1),(453,11,'Spolfee','page=CreateShip&mode=pieces',NULL,1507661904,1),(454,11,'Spolfee','page=CreateShip',NULL,1507662025,1),(455,10,'anytime','page=intro',NULL,1507795049,1),(456,10,'anytime','page=Tchat',NULL,1507795057,1),(457,10,'anytime','page=overview',NULL,1507795070,1),(458,10,'anytime','page=overview',NULL,1507795244,1),(459,10,'anytime','page=overview',NULL,1507796642,1),(460,8,'odiabile','page=intro',NULL,1507888692,1),(461,8,'odiabile','page=overview',NULL,1507888700,1),(462,8,'odiabile','page=Hln',NULL,1507888709,1),(463,8,'odiabile','page=overview',NULL,1507888712,1),(464,2,'klon','page=intro',NULL,1507948570,1),(465,2,'klon','page=buildings',NULL,1507948598,1),(466,2,'klon','page=buildings',NULL,1507948602,1),(467,12,'Drood','page=intro',NULL,1507974701,1),(468,12,'Drood','page=buildings',NULL,1507974710,1),(469,12,'Drood','page=buildings',NULL,1507974723,1),(470,12,'Drood','page=Tchat',NULL,1507974730,1),(471,12,'Drood','page=buildings',NULL,1507974765,1),(472,12,'Drood','page=Tchat',NULL,1507974872,1),(473,12,'Drood','page=buildings',NULL,1507974877,1),(474,12,'Drood','page=buildings',NULL,1507974929,1),(475,12,'Drood','page=research',NULL,1507974938,1),(476,12,'Drood','page=buildings',NULL,1507974945,1),(477,12,'Drood','page=research',NULL,1507974962,1),(478,12,'Drood','page=statistics',NULL,1507974986,1),(479,12,'Drood','page=buildings',NULL,1507974999,1),(480,12,'Drood','page=buildings',NULL,1507975004,1),(481,12,'Drood','page=Tchat',NULL,1507975056,1),(482,12,'Drood','page=buildings',NULL,1507975066,1),(483,12,'Drood','page=intro',NULL,1507988590,1),(484,12,'Drood','page=Tchat',NULL,1507988599,1),(485,13,'diyworld','page=intro',NULL,1509418535,1),(486,13,'diyworld','page=buildings',NULL,1509418698,1),(487,13,'diyworld','page=buildings',NULL,1509418726,1),(488,13,'diyworld','page=research',NULL,1509418731,1),(489,13,'diyworld','page=CreateShip',NULL,1509418734,1),(490,13,'diyworld','page=search',NULL,1509418752,1),(491,13,'diyworld','page=market',NULL,1509418756,1),(492,8,'odiabile','page=intro',NULL,1509729908,1),(493,8,'odiabile','page=overview',NULL,1509729912,1),(494,14,'space','page=intro',NULL,1509905633,1),(495,14,'space','page=Achat',NULL,1509905645,1),(496,14,'space','page=buildings',NULL,1509905659,1),(497,14,'space','page=overview',NULL,1509905663,1),(498,14,'space','page=research',NULL,1509905669,1),(499,14,'space','page=Lottery',NULL,1509905674,1),(500,14,'space','page=statistics',NULL,1509905682,1),(501,14,'space','page=center',NULL,1509905701,1),(502,14,'space','page=CreateShip',NULL,1509905707,1),(503,14,'space','page=shipyard&mode=fleet',NULL,1509905710,1),(504,14,'space','page=overview',NULL,1509905716,1),(505,14,'space','page=techtree',NULL,1509905719,1),(506,14,'space','page=galaxy',NULL,1509905722,1),(507,14,'space','page=Tportal',NULL,1509905723,1),(508,14,'space','page=galaxy',NULL,1509905724,1),(509,14,'space','page=overview',NULL,1509905759,1),(510,15,'sean007','page=intro',NULL,1510440520,1),(511,15,'sean007','page=overview',NULL,1510440545,1),(512,15,'sean007','page=techtree',NULL,1510440547,1),(513,15,'sean007','page=overview',NULL,1510440556,1),(514,16,'zordex','page=intro',NULL,1511804144,1),(515,16,'zordex','page=resources',NULL,1511804164,1),(516,16,'zordex','page=center',NULL,1511804187,1),(517,16,'zordex','page=Tower',NULL,1511804190,1),(518,16,'zordex','page=overview',NULL,1511804196,1),(519,16,'zordex','page=techtree',NULL,1511804199,1),(520,16,'zordex','page=buildings',NULL,1511804207,1),(521,16,'zordex','page=buildings',NULL,1511804212,1),(522,16,'zordex','page=statistics',NULL,1511804232,1),(523,17,'Skyld','page=intro',NULL,1512209879,1),(524,17,'Skyld','page=overview',NULL,1512209900,1),(525,17,'Skyld','page=Hln',NULL,1512209915,1),(526,17,'Skyld','page=techtree',NULL,1512209920,1),(527,17,'Skyld','page=buildings',NULL,1512209924,1),(528,17,'Skyld','page=buildings',NULL,1512209943,1),(529,17,'Skyld','page=statistics',NULL,1512209961,1),(530,17,'Skyld','page=CreateShip',NULL,1512210002,1),(531,17,'Skyld','page=population',NULL,1512210064,1),(532,17,'Skyld','page=shipyard&mode=fleet',NULL,1512210082,1),(533,17,'Skyld','page=shipyard&mode=fleet',NULL,1512210100,1),(534,17,'Skyld','page=research',NULL,1512210106,1),(535,17,'Skyld','page=research',NULL,1512210123,1),(536,17,'Skyld','page=buildings',NULL,1512210142,1),(537,17,'Skyld','page=buildings',NULL,1512210150,1),(538,17,'Skyld','page=buildings',NULL,1512210157,1),(539,17,'Skyld','page=Lottery',NULL,1512210191,1),(540,17,'Skyld','page=defense',NULL,1512210208,1),(541,17,'Skyld','page=buildings',NULL,1512210214,1),(542,17,'Skyld','page=buildings',NULL,1512210233,1),(543,17,'Skyld','page=buildings',NULL,1512210242,1),(544,17,'Skyld','page=buildings',NULL,1512210294,1),(545,17,'Skyld','page=buildings',NULL,1512210302,1),(546,17,'Skyld','page=buildings',NULL,1512210313,1),(547,17,'Skyld','page=buildings',NULL,1512210332,1),(548,8,'odiabile','page=intro',NULL,1512659157,1),(549,8,'odiabile','page=techtree',NULL,1512659174,1),(550,8,'odiabile','page=defense',NULL,1512659178,1),(551,8,'odiabile','page=CreateShip',NULL,1512659179,1),(552,8,'odiabile','page=shipyard&mode=fleet',NULL,1512659180,1),(553,8,'odiabile','page=buildings',NULL,1512659228,1),(554,8,'odiabile','page=buildings',NULL,1512659230,1),(555,8,'odiabile','page=buildings',NULL,1512659231,1),(556,8,'odiabile','page=center',NULL,1512659232,1),(557,8,'odiabile','page=Tower',NULL,1512659233,1),(558,8,'odiabile','page=Tower&mode=newimage',NULL,1512659235,1),(559,8,'odiabile','page=statistics',NULL,1512659242,1),(560,18,'sn0wak','page=intro',NULL,1513768416,1),(561,18,'sn0wak','page=overview',NULL,1513768437,1),(562,18,'sn0wak','page=techtree',NULL,1513768448,1),(563,18,'sn0wak','page=buildings',NULL,1513768456,1),(564,18,'sn0wak','page=buildings',NULL,1513768492,1),(565,18,'sn0wak','page=galaxy',NULL,1513768498,1),(566,18,'sn0wak','page=buildings',NULL,1513768516,1),(567,18,'sn0wak','page=battleHall',NULL,1513768523,1),(568,18,'sn0wak','page=CreateShip',NULL,1513768536,1),(569,18,'sn0wak','page=defense',NULL,1513768546,1),(570,18,'sn0wak','page=Immunity',NULL,1513768572,1),(571,18,'sn0wak','page=gestion',NULL,1513768579,1),(572,19,'wabbelbomber','page=intro',NULL,1516048614,1),(573,19,'wabbelbomber','page=research',NULL,1516048631,1),(574,19,'wabbelbomber','page=research',NULL,1516048642,1),(575,19,'wabbelbomber','page=research',NULL,1516048650,1),(576,19,'wabbelbomber','page=research',NULL,1516048671,1),(577,19,'wabbelbomber','page=shipyard&mode=fleet',NULL,1516048672,1),(578,19,'wabbelbomber','page=changelang',NULL,1516048684,1),(579,19,'wabbelbomber','page=research',NULL,1516048712,1),(580,19,'wabbelbomber','page=research',NULL,1516048720,1),(581,19,'wabbelbomber','page=defense',NULL,1516048768,1),(582,19,'wabbelbomber','page=CreateShip',NULL,1516048769,1),(583,19,'wabbelbomber','page=shipyard&mode=fleet',NULL,1516048771,1),(584,19,'wabbelbomber','page=research',NULL,1516048773,1),(585,19,'wabbelbomber','page=buildings',NULL,1516048774,1),(586,19,'wabbelbomber','page=research',NULL,1516048806,1),(587,19,'wabbelbomber','page=shipyard&mode=fleet',NULL,1516048807,1),(588,19,'wabbelbomber','page=CreateShip',NULL,1516048843,1),(589,19,'wabbelbomber','page=buildings',NULL,1516048848,1),(590,19,'wabbelbomber','page=research',NULL,1516048849,1),(591,20,'Rocky','page=intro',NULL,1516048888,1),(592,20,'Rocky','page=changelang',NULL,1516048907,1),(593,19,'wabbelbomber','page=research',NULL,1516048910,1),(594,20,'Rocky','page=research',NULL,1516048911,1),(595,20,'Rocky','page=techtree',NULL,1516048935,1),(596,20,'Rocky','page=overview',NULL,1516048937,1),(597,20,'Rocky','page=buildings',NULL,1516048956,1),(598,20,'Rocky','page=alliance',NULL,1516048992,1),(599,20,'Rocky','page=market',NULL,1516048995,1),(600,20,'Rocky','page=Bunker',NULL,1516048996,1),(601,20,'Rocky','page=Bank',NULL,1516048997,1),(602,20,'Rocky','page=resources',NULL,1516048998,1),(603,20,'Rocky','page=battleSimulator',NULL,1516048999,1),(604,20,'Rocky','page=spaceSimulator',NULL,1516049000,1),(605,20,'Rocky','page=Immunity',NULL,1516049002,1),(606,20,'Rocky','page=Planetcloak',NULL,1516049003,1),(607,20,'Rocky','page=Lottery',NULL,1516049004,1),(608,20,'Rocky','page=Reward2',NULL,1516049008,1),(609,20,'Rocky','page=messages',NULL,1516049009,1),(610,20,'Rocky','page=messages',NULL,1516049011,1),(611,20,'Rocky','page=statistics',NULL,1516049012,1),(612,20,'Rocky','page=gestion',NULL,1516049013,1),(613,20,'Rocky','page=banList',NULL,1516049013,1),(614,20,'Rocky','page=overview',NULL,1516049022,1),(615,20,'Rocky','page=techtree',NULL,1516049028,1),(616,20,'Rocky','page=techtree',NULL,1516049030,1),(617,20,'Rocky','page=Tportal',NULL,1516049031,1),(618,20,'Rocky','page=center',NULL,1516049032,1),(619,20,'Rocky','page=center',NULL,1516049034,1),(620,20,'Rocky','page=Tower',NULL,1516049035,1),(621,20,'Rocky','page=research',NULL,1516049036,1),(622,20,'Rocky','page=defense',NULL,1516049037,1),(623,19,'wabbelbomber','page=research',NULL,1516049188,1),(624,20,'Rocky','page=intro',NULL,1516125177,1),(625,21,'drystream','page=intro',NULL,1516426167,1),(626,21,'drystream','page=center',NULL,1516426193,1),(627,21,'drystream','page=Tower',NULL,1516426200,1),(628,21,'drystream','page=galaxy',NULL,1516426203,1),(629,21,'drystream','page=buildings',NULL,1516426235,1),(630,21,'drystream','page=CreateShip',NULL,1516426314,1),(631,22,'ironbull','page=intro',NULL,1516435583,1),(632,22,'ironbull','page=settings',NULL,1516435621,1),(633,22,'ironbull','page=settings&mode=design',NULL,1516435630,1),(634,22,'ironbull','page=settings',NULL,1516435639,1),(635,22,'ironbull','page=settings&mode=avatar',NULL,1516435651,1),(636,22,'ironbull','page=settings&mode=design',NULL,1516435658,1),(637,22,'ironbull','page=settings&mode=notification',NULL,1516435667,1),(638,22,'ironbull','page=buildings',NULL,1516435673,1),(639,22,'ironbull','page=buildings',NULL,1516435677,1),(640,22,'ironbull','page=buildings',NULL,1516435685,1),(641,22,'ironbull','page=shipyard&mode=fleet',NULL,1516435729,1),(642,22,'ironbull','page=buildings',NULL,1516435735,1),(643,22,'ironbull','page=buildings',NULL,1516435742,1),(644,22,'ironbull','page=buildings',NULL,1516435747,1),(645,22,'ironbull','page=battleHall',NULL,1516435757,1),(646,22,'ironbull','page=logout','The player disconnected.',1516435761,2),(647,22,'ironbull','page=logout',NULL,1516435761,1),(648,23,'xapim','page=intro',NULL,1517334787,1),(649,23,'xapim','page=Tchat',NULL,1517334811,1),(650,23,'xapim','page=overview',NULL,1517334853,1),(651,23,'xapim','page=buildings',NULL,1517334858,1),(652,23,'xapim','page=overview',NULL,1517334867,1),(653,23,'xapim','page=techtree',NULL,1517334877,1),(654,23,'xapim','page=galaxy',NULL,1517334880,1),(655,23,'xapim','page=Tportal',NULL,1517334884,1),(656,23,'xapim','page=center',NULL,1517334888,1),(657,23,'xapim','page=Tower',NULL,1517334892,1),(658,23,'xapim','page=intro',NULL,1517338692,1),(659,23,'xapim','page=statistics',NULL,1517338703,1),(660,23,'xapim','page=buildings',NULL,1517338726,1),(661,23,'xapim','page=buildings',NULL,1517338731,1),(662,23,'xapim','page=buildings',NULL,1517339165,1),(663,23,'xapim','page=buildings',NULL,1517339262,1),(664,23,'xapim','page=buildings',NULL,1517339638,1),(665,23,'xapim','page=buildings',NULL,1517341375,1),(666,23,'xapim','page=buildings',NULL,1517341976,1),(667,23,'xapim','page=buildings',NULL,1517341989,1),(668,23,'xapim','page=buildings',NULL,1517342774,1),(669,23,'xapim','page=intro',NULL,1517355405,1),(670,23,'xapim','page=buildings',NULL,1517355414,1),(671,23,'xapim','page=buildings',NULL,1517355422,1),(672,23,'xapim','page=overview',NULL,1517355433,1),(673,23,'xapim','page=Tower',NULL,1517355442,1),(674,23,'xapim','game.php',NULL,1517355470,1),(675,23,'xapim','page=logout','The player disconnected.',1517355494,2),(676,23,'xapim','page=logout',NULL,1517355494,1),(677,23,'xapim','page=intro',NULL,1517355507,1),(678,23,'xapim','page=overview',NULL,1517356676,1),(679,23,'xapim','page=buildings',NULL,1517356681,1),(680,23,'xapim','page=buildings',NULL,1517356686,1),(681,23,'xapim','page=buildings',NULL,1517357363,1),(682,24,'laxre','page=intro',NULL,1518088581,1),(683,24,'laxre','page=buildings',NULL,1518088602,1),(684,24,'laxre','page=buildings',NULL,1518088611,1),(685,24,'laxre','page=research',NULL,1518088634,1),(686,24,'laxre','page=buildings',NULL,1518088640,1),(687,24,'laxre','page=galaxy',NULL,1518088658,1),(688,24,'laxre','page=overview',NULL,1518088679,1),(689,24,'laxre','page=Immunity',NULL,1518088692,1),(690,24,'laxre','page=Planetcloak',NULL,1518088697,1),(691,24,'laxre','page=Lottery',NULL,1518088744,1),(692,24,'laxre','page=Reward2',NULL,1518088752,1),(693,24,'laxre','page=Achat',NULL,1518088765,1),(694,24,'laxre','page=gestion',NULL,1518088776,1),(695,24,'laxre','page=battleSimulator',NULL,1518088792,1),(696,24,'laxre','page=spaceSimulator',NULL,1518088801,1),(697,24,'laxre','page=market',NULL,1518088813,1),(698,24,'laxre','page=CreateShip',NULL,1518088831,1),(699,25,'hr9uu','page=intro',NULL,1518465197,1),(700,25,'hr9uu','page=techtree',NULL,1518465216,1),(701,25,'hr9uu','page=overview',NULL,1518465217,1),(702,25,'hr9uu','page=galaxy',NULL,1518465241,1),(703,25,'hr9uu','page=buildings',NULL,1518465257,1),(704,25,'hr9uu','page=CreateShip',NULL,1518465271,1),(705,25,'hr9uu','page=population',NULL,1518465276,1),(706,25,'hr9uu','page=defense',NULL,1518465280,1),(707,25,'hr9uu','page=shipyard&mode=fleet',NULL,1518465281,1),(708,25,'hr9uu','page=Bank',NULL,1518465287,1),(709,25,'hr9uu','page=Bunker',NULL,1518465291,1);
/*!40000 ALTER TABLE `uni1_tracking_mod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_transport_player`
--

DROP TABLE IF EXISTS `uni1_transport_player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_transport_player` (
  `transportID` int(11) NOT NULL AUTO_INCREMENT,
  `senderID` int(11) unsigned NOT NULL DEFAULT '0',
  `receiverID` int(11) unsigned NOT NULL DEFAULT '0',
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `strongest` int(11) unsigned NOT NULL DEFAULT '0',
  `transportRes` text,
  `transportPop` text,
  `transportDevice` text,
  `push` double(50,0) unsigned NOT NULL DEFAULT '0',
  `legal` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delete` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`transportID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_transport_player`
--

LOCK TABLES `uni1_transport_player` WRITE;
/*!40000 ALTER TABLE `uni1_transport_player` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_transport_player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_users`
--

DROP TABLE IF EXISTS `uni1_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_users` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `email_2` varchar(64) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar_defaut.jpg',
  `lang` varchar(2) NOT NULL DEFAULT 'de',
  `authattack` tinyint(1) NOT NULL DEFAULT '0',
  `authlevel` tinyint(1) NOT NULL DEFAULT '0',
  `isModo` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `isStaff` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rights` text,
  `id_planet` int(11) unsigned NOT NULL DEFAULT '0',
  `universe` tinyint(3) unsigned NOT NULL,
  `galaxy` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `system` smallint(5) unsigned NOT NULL DEFAULT '0',
  `planet` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `darkmatter` float(5,2) NOT NULL DEFAULT '0.00',
  `user_lastip` varchar(40) NOT NULL DEFAULT '',
  `ip_at_reg` varchar(40) NOT NULL DEFAULT '',
  `register_time` int(11) NOT NULL DEFAULT '0',
  `onlinetime` int(11) NOT NULL DEFAULT '0',
  `dpath` varchar(20) NOT NULL DEFAULT 'gow',
  `timezone` varchar(32) NOT NULL DEFAULT 'Europe/London',
  `planet_sort` tinyint(1) NOT NULL DEFAULT '0',
  `planet_sort_order` tinyint(1) NOT NULL DEFAULT '0',
  `spio_anz` int(10) unsigned NOT NULL DEFAULT '1',
  `settings_fleetactions` tinyint(2) unsigned NOT NULL DEFAULT '3',
  `settings_esp` tinyint(1) NOT NULL DEFAULT '1',
  `settings_wri` tinyint(1) NOT NULL DEFAULT '1',
  `settings_bud` tinyint(1) NOT NULL DEFAULT '1',
  `settings_mis` tinyint(1) NOT NULL DEFAULT '1',
  `settings_blockPM` tinyint(1) NOT NULL DEFAULT '0',
  `urlaubs_modus` tinyint(1) NOT NULL DEFAULT '0',
  `urlaubs_until` int(11) NOT NULL DEFAULT '0',
  `db_deaktjava` int(11) NOT NULL DEFAULT '0',
  `b_tech_planet` int(11) unsigned NOT NULL DEFAULT '0',
  `b_tech` int(11) unsigned NOT NULL DEFAULT '0',
  `b_tech_id` smallint(2) unsigned NOT NULL DEFAULT '0',
  `b_tech_queue` text,
  `spy_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `computer_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `military_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `defence_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `shield_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `energy_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hyperspace_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `combustion_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `impulse_motor_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hyperspace_motor_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `laser_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ionic_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `buster_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `intergalactic_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `expedition_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `metal_proc_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `crystal_proc_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deuterium_proc_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `graviton_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `extraction_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `subspace_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `particle_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `antaris_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `infrastructure_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `virus_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `forcefield_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `occultation_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sensors_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `control_room_tech` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ally_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ally_register_time` int(11) NOT NULL DEFAULT '0',
  `ally_rank_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `next_ally_register` int(11) unsigned NOT NULL DEFAULT '0',
  `rpg_geologue` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `rpg_amiral` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_ingenieur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_technocrate` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_espion` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_constructeur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_scientifique` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_commandant` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_stockeur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_defenseur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_destructeur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_general` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_bunker` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_raideur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_empereur` tinyint(22) NOT NULL DEFAULT '0',
  `bana` tinyint(1) NOT NULL DEFAULT '0',
  `banaday` int(11) NOT NULL DEFAULT '0',
  `hof` tinyint(4) NOT NULL DEFAULT '0',
  `spyMessagesMode` tinyint(1) NOT NULL DEFAULT '0',
  `wons` int(11) unsigned NOT NULL DEFAULT '0',
  `loos` int(11) unsigned NOT NULL DEFAULT '0',
  `draws` int(11) unsigned NOT NULL DEFAULT '0',
  `kbmetal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `kbcrystal` double(50,0) unsigned NOT NULL DEFAULT '0',
  `kbdeuterium` double(50,0) unsigned NOT NULL DEFAULT '0',
  `lostunits` double(50,0) unsigned NOT NULL DEFAULT '0',
  `desunits` double(50,0) unsigned NOT NULL DEFAULT '0',
  `uctime` int(11) NOT NULL DEFAULT '0',
  `setmail` int(11) NOT NULL DEFAULT '0',
  `dm_attack` int(11) NOT NULL DEFAULT '0',
  `dm_defensive` int(11) NOT NULL DEFAULT '0',
  `dm_buildtime` int(11) NOT NULL DEFAULT '0',
  `dm_researchtime` int(11) NOT NULL DEFAULT '0',
  `dm_resource` int(11) NOT NULL DEFAULT '0',
  `dm_energie` int(11) NOT NULL DEFAULT '0',
  `dm_fleettime` int(11) NOT NULL DEFAULT '0',
  `ref_id` int(11) NOT NULL DEFAULT '0',
  `ref_bonus` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `inactive_mail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `intro` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_deleted` int(11) unsigned NOT NULL DEFAULT '0',
  `multi_spotted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mode_chaine` int(11) unsigned NOT NULL DEFAULT '0',
  `mode_rapide` int(11) unsigned NOT NULL DEFAULT '0',
  `date_of_birth` int(11) DEFAULT NULL,
  `year` int(11) NOT NULL DEFAULT '2015',
  `sexe` varchar(5) DEFAULT NULL,
  `planet_cloak` int(11) unsigned NOT NULL DEFAULT '0',
  `planet_cloak_countdown` int(11) unsigned NOT NULL DEFAULT '0',
  `immunity_until` int(11) unsigned NOT NULL DEFAULT '0',
  `next_immunity` int(11) unsigned NOT NULL DEFAULT '0',
  `hln_post` int(11) unsigned NOT NULL DEFAULT '0',
  `achievement_todo` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `ragnar_item` int(11) unsigned NOT NULL DEFAULT '0',
  `khufu_item` int(11) unsigned NOT NULL DEFAULT '0',
  `amplificateur_item` int(11) unsigned NOT NULL DEFAULT '0',
  `malvar_item` int(11) unsigned NOT NULL DEFAULT '0',
  `fleet_manage` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fleet_manage_bis` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `max_explore` int(11) unsigned NOT NULL DEFAULT '0',
  `chat_visit` int(11) unsigned NOT NULL DEFAULT '0',
  `chat_ban` int(11) unsigned NOT NULL DEFAULT '0',
  `message_ban` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `message_ban_time` int(11) unsigned NOT NULL DEFAULT '0',
  `vote_count` int(11) unsigned NOT NULL DEFAULT '0',
  `v1` int(11) unsigned NOT NULL DEFAULT '0',
  `v2` int(11) unsigned NOT NULL DEFAULT '0',
  `custom_color` varchar(55) DEFAULT 'FFFFFF',
  `galaxy_space` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `encodage` varchar(32) DEFAULT NULL,
  `notification_messagerie` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `notification_attaque_subie` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `notification_tchat` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `notification_connexion` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `notification_annonce` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `notification_champ_force` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `inJournal` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `authlevel` (`authlevel`),
  KEY `ref_bonus` (`ref_bonus`),
  KEY `universe` (`universe`,`username`,`password`,`onlinetime`,`authlevel`),
  KEY `ally_id` (`ally_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_users`
--

LOCK TABLES `uni1_users` WRITE;
/*!40000 ALTER TABLE `uni1_users` DISABLE KEYS */;
INSERT INTO `uni1_users` VALUES (1,'demo','95d9bed956f1f97afed6f6543fc78815','jeremy.baukens@gmail.com','jeremy.baukens@gmail.com','avatar_defaut.jpg','en',0,3,0,1,NULL,1,1,1,1,3,5.00,'91.182.210.241','91.182.210.241',1507501421,1507561476,'gow','Europe/Brussels',0,0,1,3,1,1,1,1,0,0,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,2015,NULL,0,0,0,0,0,1,0,0,0,0,0,0,0,3,0,0,0,0,0,0,'FFFFFF',0,'4ca86912b5674f2c0e7c18725c910843',1,1,1,1,1,1,1),(19,'wabbelbomber','ac67675aae438dfe9cf6f61fc9df81d2','J_E_M@outlook.de','J_E_M@outlook.de','avatar_defaut.jpg','en',0,0,0,0,NULL,19,1,1,19,3,5.00,'149.205.110.28','149.205.110.28',1516048614,1516053088,'gow','Europe/Brussels',0,0,1,3,1,1,1,1,0,0,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,2015,NULL,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'FFFFFF',0,'4dda790b421e56fb5ba05a6bbb984f85',1,1,1,1,1,1,1),(20,'Rocky','e10adc3949ba59abbe56e057f20f883e','Rockythedog88@gmail.com','Rockythedog88@gmail.com','avatar_defaut.jpg','en',0,0,0,0,NULL,20,1,1,20,5,5.00,'146.52.248.62','146.52.248.62',1516048888,1516125194,'gow','Europe/Brussels',0,0,1,3,1,1,1,1,0,0,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,2015,NULL,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'FFFFFF',0,'928099cd39aae72c06b4629ee28f14b6',1,1,1,1,1,1,1),(21,'drystream','96ae77302e79da54b57b0223416c3e4b','drystream@gmail.com','drystream@gmail.com','avatar_defaut.jpg','en',0,0,0,0,NULL,21,1,1,21,6,5.00,'93.85.113.157','93.85.113.157',1516426167,1516426368,'gow','Europe/Brussels',0,0,1,3,1,1,1,1,0,0,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,2015,NULL,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'FFFFFF',0,'b80071af8e6523e9a1ee639d63ef320d',1,1,1,1,1,1,1),(22,'ironbull','447ee6d4af957d677bb47203327c4390','ironbull@libero.it','ironbull@libero.it','avatar_defaut.jpg','it',0,0,0,0,NULL,22,1,1,22,4,5.00,'95.244.12.193','95.244.12.193',1516435583,1516435761,'gow','Europe/Brussels',0,0,1,3,1,1,1,1,0,0,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,2015,NULL,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'FFFFFF',0,'f9c82af6b44da91ba777a81ec31ee3d0',1,1,1,1,1,1,1),(23,'xapim','ab699531299764accdbe03c6c5c06897','tiagofazendeiro@hotmail.com','tiagofazendeiro@hotmail.com','avatar_defaut.jpg','en',0,0,0,0,NULL,23,1,1,23,3,5.00,'84.246.203.101','84.246.203.101',1517334787,1517358774,'gow','Europe/Brussels',0,0,1,3,1,1,1,1,0,0,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,2015,NULL,0,0,0,0,0,1,0,0,0,0,0,0,0,4,0,0,0,0,0,0,'FFFFFF',0,'86e545491bd7262a408708ba1bb645ea',1,1,1,1,1,1,1),(24,'laxre','d429221a19b271eaed2cf38e11b0d7af','laxre@bk.ru','laxre@bk.ru','avatar_defaut.jpg','en',0,0,0,0,NULL,24,1,1,24,7,5.00,'95.71.8.254','95.71.8.254',1518088581,1518088864,'gow','Europe/Brussels',0,0,1,3,1,1,1,1,0,0,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,2015,NULL,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'FFFFFF',0,'b3671a3dfa6d9cd67646fcaaf5f12c92',1,1,1,1,1,1,1),(25,'hr9uu','19439ace9942db139cd9c9e92b4d7352','hr9uu@slipry.net','hr9uu@slipry.net','avatar_defaut.jpg','en',0,0,0,0,NULL,25,1,1,25,4,5.00,'92.238.244.69','92.238.244.69',1518465197,1518465311,'gow','Europe/Brussels',0,0,1,3,1,1,1,1,0,0,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,2015,NULL,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'FFFFFF',0,'c718e1cf4fa7b6b2f7b4b7d06923927c',1,1,1,1,1,1,0);
/*!40000 ALTER TABLE `uni1_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_users_to_acs`
--

DROP TABLE IF EXISTS `uni1_users_to_acs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_users_to_acs` (
  `userID` int(10) unsigned NOT NULL,
  `acsID` int(10) unsigned NOT NULL,
  KEY `userID` (`userID`),
  KEY `acsID` (`acsID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_users_to_acs`
--

LOCK TABLES `uni1_users_to_acs` WRITE;
/*!40000 ALTER TABLE `uni1_users_to_acs` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_users_to_acs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_users_to_extauth`
--

DROP TABLE IF EXISTS `uni1_users_to_extauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_users_to_extauth` (
  `id` int(11) NOT NULL,
  `account` varchar(64) NOT NULL,
  `mode` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `account` (`account`,`mode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_users_to_extauth`
--

LOCK TABLES `uni1_users_to_extauth` WRITE;
/*!40000 ALTER TABLE `uni1_users_to_extauth` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_users_to_extauth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_users_to_topkb`
--

DROP TABLE IF EXISTS `uni1_users_to_topkb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_users_to_topkb` (
  `rid` varchar(32) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `role` tinyint(1) NOT NULL,
  KEY `rid` (`rid`,`role`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_users_to_topkb`
--

LOCK TABLES `uni1_users_to_topkb` WRITE;
/*!40000 ALTER TABLE `uni1_users_to_topkb` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_users_to_topkb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_users_valid`
--

DROP TABLE IF EXISTS `uni1_users_valid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_users_valid` (
  `validationID` int(11) unsigned NOT NULL,
  `userName` varchar(64) NOT NULL,
  `validationKey` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(64) NOT NULL,
  `planetName` varchar(500) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `language` varchar(3) NOT NULL,
  `universe` tinyint(3) unsigned NOT NULL,
  `referralID` int(11) DEFAULT NULL,
  `externalAuthUID` varchar(128) DEFAULT NULL,
  `externalAuthMethod` varchar(32) DEFAULT NULL,
  `encodage` varchar(32) NOT NULL,
  PRIMARY KEY (`validationID`,`validationKey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_users_valid`
--

LOCK TABLES `uni1_users_valid` WRITE;
/*!40000 ALTER TABLE `uni1_users_valid` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_users_valid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_vars`
--

DROP TABLE IF EXISTS `uni1_vars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_vars` (
  `elementID` smallint(5) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `class` int(11) NOT NULL,
  `onPlanetType` set('1','3') NOT NULL,
  `onePerPlanet` tinyint(4) NOT NULL,
  `factor` float(4,2) NOT NULL,
  `maxLevel` int(11) DEFAULT NULL,
  `cost901` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cost902` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cost903` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cost904` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cost905` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cost911` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cost921` bigint(20) unsigned NOT NULL DEFAULT '0',
  `consumption1` int(11) unsigned DEFAULT NULL,
  `consumption2` int(11) unsigned DEFAULT NULL,
  `speedTech` int(11) unsigned DEFAULT NULL,
  `speed1` int(11) unsigned DEFAULT NULL,
  `speed2` int(11) unsigned DEFAULT NULL,
  `speed2Tech` int(10) unsigned DEFAULT NULL,
  `speed2onLevel` int(10) unsigned DEFAULT NULL,
  `speed3Tech` int(10) unsigned DEFAULT NULL,
  `speed3onLevel` int(10) unsigned DEFAULT NULL,
  `capacity` int(11) unsigned DEFAULT NULL,
  `attack` int(10) unsigned DEFAULT NULL,
  `defend` int(10) unsigned DEFAULT NULL,
  `coque` int(10) unsigned NOT NULL DEFAULT '0',
  `timeBonus` int(11) unsigned DEFAULT NULL,
  `bonusAttack` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusDefensive` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusShield` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusBuildTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusResearchTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusShipTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusDefensiveTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusResource` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusEnergy` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusResourceStorage` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusShipStorage` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusFlyTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusFleetSlots` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusPlanets` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusSpyPower` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusExpedition` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusGateCoolTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusMoreFound` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusAttackUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusDefensiveUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusShieldUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusBuildTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusResearchTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusShipTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusDefensiveTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusResourceUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusEnergyUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusResourceStorageUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusShipStorageUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusFlyTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusFleetSlotsUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusPlanetsUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusSpyPowerUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusExpeditionUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusGateCoolTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusMoreFoundUnit` smallint(1) NOT NULL DEFAULT '0',
  `speedFleetFactor` float(4,2) DEFAULT NULL,
  `production901` varchar(255) DEFAULT NULL,
  `production902` varchar(255) DEFAULT NULL,
  `production903` varchar(255) DEFAULT NULL,
  `production904` varchar(255) DEFAULT NULL,
  `production905` varchar(255) DEFAULT NULL,
  `production911` varchar(255) DEFAULT NULL,
  `production921` varchar(255) DEFAULT NULL,
  `storage901` varchar(255) DEFAULT NULL,
  `storage902` varchar(255) DEFAULT NULL,
  `storage903` varchar(255) DEFAULT NULL,
  `storage904` varchar(255) DEFAULT NULL,
  `shiptype` int(11) unsigned NOT NULL DEFAULT '0',
  `isHyperspace` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`elementID`),
  KEY `class` (`class`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_vars`
--

LOCK TABLES `uni1_vars` WRITE;
/*!40000 ALTER TABLE `uni1_vars` DISABLE KEYS */;
INSERT INTO `uni1_vars` VALUES (1,'metal_mine',0,'1',0,1.50,255,150,60,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'(40 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,'-(10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,NULL,0,0),(2,'crystal_mine',0,'1',0,1.50,255,200,150,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,'(30 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,'-(10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);',NULL,NULL,NULL,NULL,NULL,0,0),(3,'deuterium_sintetizer',0,'1',0,1.50,255,300,160,5,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,'(20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,'- (30 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,NULL,0,0),(4,'solar_plant',0,'1',0,1.50,255,150,75,30,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'(20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,NULL,0,0),(6,'university',0,'1',0,2.00,255,100000000,50000000,25000000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.08,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(12,'fusion_plant',0,'1',0,2.00,255,900,360,180,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,'- (10 * $BuildLevel * pow(1.1,$BuildLevel) * (0.1 * $BuildLevelFactor))',NULL,NULL,'(30 * $BuildLevel * pow((1.05 + $BuildEnergy * 0.01), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,NULL,0,0),(14,'robot_factory',0,'1,3',0,2.00,255,1000,600,200,100,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(15,'nano_factory',0,'1',0,2.00,255,1000000,500000,100000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(21,'hangar',0,'1,3',0,2.00,255,500,400,250,50,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(22,'metal_store',0,'1,3',0,2.00,255,12500,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'pow(2, $BuildLevel) * 80000',NULL,NULL,NULL,0,0),(23,'crystal_store',0,'1,3',0,2.00,255,12500,6250,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'pow(2, $BuildLevel) * 60000',NULL,NULL,0,0),(24,'deuterium_store',0,'1,3',0,2.00,255,12500,6250,3125,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'pow(2, $BuildLevel) * 40000',NULL,0,0),(31,'laboratory',0,'1',0,2.00,255,2000,4000,500,100,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(33,'terraformer',0,'1',0,2.00,255,1000000,800000,400000,200000,0,800,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(34,'ally_deposit',0,'1',0,2.00,255,20000,40000,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(41,'mondbasis',0,'3',0,2.00,255,20000,40000,20000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(42,'phalanx',0,'3',0,2.00,255,20000,40000,20000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(43,'sprungtor',0,'3',0,2.00,255,2000000,4000000,2000000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(44,'silo',0,'1',0,2.00,255,20000,20000,1000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(106,'spy_tech',100,'1,3',0,2.00,255,1200,2400,400,200,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(108,'computer_tech',100,'1,3',0,2.00,255,0,400,600,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(109,'military_tech',100,'1,3',0,2.00,255,1000,250,125,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(110,'defence_tech',100,'1,3',0,2.00,255,1500,100,250,500,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(111,'shield_tech',100,'1,3',0,2.00,255,400,1200,600,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(113,'energy_tech',100,'1,3',0,2.00,255,500,600,50,10,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.05,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(114,'hyperspace_tech',100,'1,3',0,2.00,255,0,4000,2000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(115,'combustion_tech',100,'1,3',0,2.00,255,500,400,800,200,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,-0.01,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(117,'impulse_motor_tech',100,'1,3',0,2.00,255,1000,1500,2000,750,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,-0.02,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(118,'hyperspace_motor_tech',100,'1,3',0,2.00,255,3000,4000,5000,1250,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,-0.03,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(120,'laser_tech',100,'1,3',0,2.00,255,200,100,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(121,'ionic_tech',100,'1,3',0,2.00,255,1000,300,100,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(122,'buster_tech',100,'1,3',0,2.00,255,2000,4000,1000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(123,'intergalactic_tech',100,'1,3',0,2.00,255,240000,400000,160000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(124,'expedition_tech',100,'1,3',0,1.75,255,4000,8000,4000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(131,'metal_proc_tech',100,'1,3',0,2.00,255,750,500,250,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(132,'crystal_proc_tech',100,'1,3',0,2.00,255,1000,750,500,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(133,'deuterium_proc_tech',100,'1,3',0,2.00,255,1250,1000,750,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(199,'graviton_tech',100,'1,3',0,3.00,255,0,0,0,0,0,300000,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(202,'small_ship_cargo',200,'1,3',0,1.00,NULL,5000,4000,3000,0,0,0,0,10,20,4,5000,10000,NULL,NULL,NULL,NULL,15000,0,0,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(203,'big_ship_cargo',200,'1,3',0,1.00,NULL,10000,6000,6000,2000,0,0,0,50,50,1,7500,7500,NULL,NULL,NULL,NULL,50000,0,0,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(204,'light_hunter',200,'1,3',0,1.00,NULL,4000,1200,300,0,0,0,0,20,20,1,12500,12500,NULL,NULL,NULL,NULL,50,50,10,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(205,'heavy_hunter',200,'1,3',0,1.00,NULL,7000,2100,700,0,0,0,0,75,75,2,10000,15000,NULL,NULL,NULL,NULL,100,150,25,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(206,'crusher',200,'1,3',0,1.00,NULL,15000,9000,4000,1200,0,0,0,300,300,2,15000,15000,NULL,NULL,NULL,NULL,800,400,50,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(207,'battle_ship',200,'1,3',0,1.00,NULL,40000,18000,7000,3000,0,0,0,250,250,3,10000,10000,NULL,NULL,NULL,NULL,1500,1000,200,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(208,'colonizer',200,'1,3',0,1.00,NULL,10000,20000,10000,0,0,0,0,1000,1000,2,2500,2500,NULL,NULL,NULL,NULL,7500,50,100,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(209,'recycler',200,'1,3',0,1.00,NULL,12000,5000,2000,200,0,0,0,300,300,1,2000,2000,NULL,NULL,NULL,NULL,40000,0,0,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(210,'spy_sonde',200,'1,3',0,1.00,NULL,2000,1200,400,0,0,0,0,1,1,1,100000000,100000000,NULL,NULL,NULL,NULL,50,0,0,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(211,'bomber_ship',200,'1,3',0,1.00,NULL,60000,30000,20000,10000,0,0,0,1000,1000,5,4000,5000,NULL,NULL,NULL,NULL,500,1000,500,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(212,'solar_satelit',200,'1,3',0,1.00,NULL,0,2000,500,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'((($BuildTemp + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel)',NULL,NULL,NULL,NULL,NULL,0,0),(213,'destructor',200,'1,3',0,1.00,NULL,60000,50000,15000,0,0,0,0,1000,1000,3,5000,5000,NULL,NULL,NULL,NULL,2000,2000,500,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(214,'dearth_star',200,'1,3',0,1.00,NULL,5000000,4000000,1000000,500000,0,0,0,1,1,3,200,200,NULL,NULL,NULL,NULL,1000000,200000,50000,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(215,'battleship',200,'1,3',0,1.00,NULL,40000,65000,10000,20000,0,0,0,250,250,3,10000,10000,NULL,NULL,NULL,NULL,750,700,400,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(216,'lune_noir',200,'1,3',0,1.00,NULL,8000000,2000000,1500000,900000,0,0,0,250,250,3,900,900,NULL,NULL,NULL,NULL,15000000,150000,70000,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(217,'ev_transporter',200,'1,3',0,1.00,NULL,35000,20000,1500,0,0,0,0,90,90,3,6000,6000,NULL,NULL,NULL,NULL,400000000,50,120,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(218,'star_crasher',200,'1,3',0,1.00,NULL,275000000,130000000,60000000,0,0,0,0,10000,10000,3,10,10,NULL,NULL,NULL,NULL,50000000,35000000,2000000,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(219,'giga_recykler',200,'1,3',0,1.00,NULL,20000,10000,20000,30000,0,0,0,300,300,3,50000,50000,NULL,NULL,NULL,NULL,2500000,0,0,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1),(220,'dm_ship',200,'1,3',0,1.00,NULL,6000000,7000000,3000000,0,0,0,0,100000,100000,3,100,100,NULL,NULL,NULL,NULL,6000000,5,50000,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(401,'misil_launcher',400,'1,3',0,1.00,NULL,2000,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,80,20,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(402,'small_laser',400,'1,3',0,1.00,NULL,1500,500,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,100,25,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(403,'big_laser',400,'1,3',0,1.00,NULL,6000,2000,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,250,100,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(404,'gauss_canyon',400,'1,3',0,1.00,NULL,20000,15000,2000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1100,200,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(405,'ionic_canyon',400,'1,3',0,1.00,NULL,2000,6000,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,150,500,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(406,'buster_canyon',400,'1,3',0,1.00,NULL,50000,50000,30000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,3000,300,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(407,'small_protection_shield',400,'1,3',1,1.00,NULL,10000,10000,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,2000,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(408,'big_protection_shield',400,'1,3',1,1.00,NULL,50000,50000,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,10000,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(409,'planet_protector',400,'1,3',1,1.00,NULL,10000000,5000000,2500000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,1000000,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(410,'graviton_canyon',400,'1,3',0,1.00,NULL,15000000,15000000,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,500000,80000,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(411,'orbital_station',400,'1,3',1,1.00,NULL,5000000000,2000000000,500000000,0,0,1000000,10000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,400000000,2000000000,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(502,'interceptor_misil',500,'1,3',0,1.00,NULL,8000,0,2000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,1,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(503,'interplanetary_misil',500,'1,3',0,1.00,NULL,12500,2500,10000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,12000,1,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(601,'rpg_geologue',600,'1,3',0,1.00,20,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.05,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(602,'rpg_amiral',600,'1,3',0,1.00,20,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.05,0.05,0.05,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(603,'rpg_ingenieur',600,'1,3',0,1.00,10,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.05,0.05,0.00,0.00,0.00,0.00,0.00,0.00,0.05,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(604,'rpg_technocrate',600,'1,3',0,1.00,10,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,-0.05,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(605,'rpg_constructeur',600,'1,3',0,1.00,3,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,-0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(606,'rpg_scientifique',600,'1,3',0,1.00,3,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,-0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(607,'rpg_stockeur',600,'1,3',0,1.00,2,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.50,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(608,'rpg_defenseur',600,'1,3',0,1.00,2,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,-0.25,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(609,'rpg_bunker',600,'1,3',0,1.00,1,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(610,'rpg_espion',600,'1,3',0,1.00,2,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.35,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(611,'rpg_commandant',600,'1,3',0,1.00,3,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,3.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(612,'rpg_destructeur',600,'1,3',0,1.00,1,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(613,'rpg_general',600,'1,3',0,1.00,3,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,-0.10,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(614,'rpg_raideur',600,'1,3',0,1.00,1,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(615,'rpg_empereur',600,'1,3',0,1.00,1,0,0,0,0,0,0,1000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,2.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(701,'dm_attack',700,'1,3',0,1.00,NULL,0,0,0,0,0,0,1500,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,86400,0.10,0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(702,'dm_defensive',700,'1,3',0,1.00,NULL,0,0,0,0,0,0,1500,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,86400,0.00,0.00,0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(703,'dm_buildtime',700,'1,3',0,1.00,NULL,0,0,0,0,0,0,750,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,86400,0.00,0.00,0.00,-0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(704,'dm_resource',700,'1,3',0,1.00,NULL,0,0,0,0,0,0,2500,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,86400,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(705,'dm_energie',700,'1,3',0,1.00,NULL,0,0,0,0,0,0,2000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,86400,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(706,'dm_researchtime',700,'1,3',0,1.00,NULL,0,0,0,0,0,0,1250,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,86400,0.00,0.00,0.00,0.00,-0.10,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(707,'dm_fleettime',700,'1,3',0,1.00,NULL,0,0,0,0,0,0,3000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,86400,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,-0.10,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(25,'elyrium_store',0,'1,3',0,2.00,255,12500,6250,3125,1560,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'pow(2, $BuildLevel) * 20000',0,0),(10,'solar_plant_extract',0,'1',0,1.50,255,16000,10000,7500,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'(400 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,NULL,0,0),(48,'elyrium_mine',0,'1',0,1.50,255,400,300,50,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,'(10 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor))',NULL,'-(10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,NULL,0,0),(7,'metal_mine_extract',0,'1',0,1.50,255,40000,18000,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'(800* $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,'-(10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,NULL,0,0),(8,'crystal_mine_extract',0,'1',0,1.50,255,28000,15000,2000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,'(600* $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,'-(10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);',NULL,NULL,NULL,NULL,NULL,0,0),(9,'deuterium_sintetizer_extract',0,'1',0,1.50,255,40000,25000,4000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,'(400* $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,'- (30 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,NULL,0,0),(11,'elyrium_mine_extract',0,'1',0,1.50,255,80000,45000,15000,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,'(200* $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor))',NULL,'-(10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)',NULL,NULL,NULL,NULL,NULL,0,0),(45,'barracks',0,'1',0,2.00,255,1000,1000,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,'$BuildLevel * (pow((1.3), $BuildLevel) * 50)',NULL,NULL,NULL,NULL,NULL,NULL,0,0),(46,'defense_base',0,'1',0,2.00,255,2000,1800,1000,500,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(5,'headquarters_antaris',0,'1',0,2.00,255,500000,600000,200000,100000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(47,'antaris_headpost',0,'1',0,2.00,255,275000,200000,150000,125000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(140,'extraction_tech',100,'1,3',0,2.00,255,500,250,20,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(141,'control_room_tech',100,'1,3',0,2.00,255,1200,200,800,20,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(142,'subspace_tech',100,'1,3',0,2.00,255,1250,2500,750,500,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,-0.03,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(143,'particle_tech',100,'1,3',0,2.00,255,200,1200,1000,1200,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(144,'antaris_tech',100,'1,3',0,2.00,255,200,250,250,200,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(145,'infrastructure_tech',100,'1,3',0,2.00,255,500,400,50,200,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(146,'virus_tech',100,'1,3',0,2.00,255,50000,80000,40000,10000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(147,'forcefield_tech',100,'1,3',0,2.00,255,75000,140000,65000,18000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(148,'occultation_tech',100,'1,3',0,2.00,255,10000,20000,12000,4000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(149,'sensors_tech',100,'1,3',0,2.00,255,8000,16000,10000,3000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(221,'elyrium_reactor',200,'1,3',0,1.00,NULL,100000,140000,120000,220000,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(222,'energy_modulator',200,'1,3',0,1.00,NULL,8000000,12750000,6500000,1400000,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(301,'civil',300,'1,3',0,1.00,NULL,0,0,0,0,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(302,'technician',300,'1,3',0,1.00,NULL,0,0,0,0,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(303,'scientist',300,'1,3',0,1.00,NULL,0,0,0,0,4,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(304,'archaeologist',300,'1,3',0,1.00,NULL,0,0,0,0,50,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(305,'diplomat',300,'1,3',0,1.00,NULL,0,0,0,0,20,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(306,'soldier',300,'1,3',0,1.00,NULL,0,0,0,0,12,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,500,100,450,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(307,'adv_soldier',300,'1,3',0,1.00,NULL,0,0,0,0,44,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2500,500,2300,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(309,'antaris',300,'1,3',0,1.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(801,'ragnar_item',800,'1,3',0,2.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(802,'khufu_item',800,'1,3',0,2.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(803,'amplificateur_item',800,'1,3',0,2.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(804,'malvar_item',800,'1,3',0,2.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(223,'mid_recycler',200,'1,3',0,1.00,NULL,16000,8000,3200,4000,0,0,0,300,300,1,4000,4000,NULL,NULL,NULL,NULL,100000,0,0,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(224,'spy_sonde_portal',200,'1,3',0,1.00,NULL,3000,1000,400,1200,0,0,0,1,1,1,1000000000,1000000000,NULL,NULL,NULL,NULL,50,0,0,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(225,'speeder',200,'1,3',0,1.00,NULL,150000,125000,30000,2000,0,0,0,1,1,1,1,1,NULL,NULL,NULL,NULL,5000,75000,30000,50000,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(226,'drones',200,'1,3',0,1.00,NULL,85000,75000,40000,18000,0,0,0,1,1,1,1,1,NULL,NULL,NULL,NULL,0,100000,0,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(412,'light_platform',400,'1,3',0,1.00,NULL,10000,7500,2500,500,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,6000,2000,2500,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(413,'heavy_platform',400,'1,3',0,1.00,NULL,75000,50000,15000,3000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,40000,16000,24000,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(414,'chasseur_canon',400,'1,3',0,1.00,NULL,500000,300000,100000,30000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,600000,0,300000,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(415,'canon_ion',400,'1,3',0,1.00,NULL,4000000,2000000,700000,150000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,3500000,700000,1700000,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(416,'exper_defense',400,'1,3',0,1.00,NULL,25000000,12500000,3000000,750000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,25000000,3250000,11250000,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(417,'mine_space',400,'1,3',0,1.00,NULL,100000,75000,25000,10000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,190000,0,500,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(418,'satelite_antaris',400,'1,3',0,1.00,NULL,5000000,2500000,1200000,150000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,6800000,2500000,4500000,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1101,'chasseur',1100,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1102,'intercepteur',1100,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1104,'escorteur',1100,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1105,'navette',1100,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1106,'corvette',1100,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1107,'croiseur',1100,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1108,'croiseur_lourd',1100,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1109,'destroyeer',1100,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1103,'transporteur',1100,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(1201,'station_de_tir',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1101,0),(1202,'canon_a_ion',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1101,0),(1203,'missile_iem',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1101,0),(1204,'canon_a_plasma',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1102,0),(1205,'rayon_plasma',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1102,0),(1206,'disrupteur',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1105,0),(1207,'canon_des_antaris',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1105,0),(1208,'rayon_antaris',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1105,0),(1209,'coque_low_density',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1101,0),(1210,'coque_medium_density',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1102,0),(1211,'coque_heavy_density',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1104,0),(1212,'coque_des_antaris',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1106,0),(1213,'low_shield',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1101,0),(1214,'big_shield',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1104,0),(1215,'antaris_shield',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1106,0),(1216,'turbo_reactor',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1101,0),(1217,'statoreacteur',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1102,0),(1218,'propulseur_propegol',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1102,0),(1219,'propulseur_hybride',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1103,0),(1220,'propulseur_ionique',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1103,0),(1221,'propulseur_photonique',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1103,0),(1222,'propulseur_nuclear_therm',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1104,0),(1223,'reacteur_antimatiere',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1105,0),(1224,'moteur_hyperspace',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1106,0),(1225,'moteur_vsl',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1106,0),(1226,'moteur_vsl_improve',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1109,0),(1227,'install_siege',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1106,0),(1228,'install_teleport',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1106,0),(1229,'lance_drone_faible',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1102,0),(1230,'lance_drone_moyenne',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1104,0),(1231,'lance_drone_rapide',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1106,0),(1232,'hangeur_chasseur',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1103,0),(1233,'hangeur_intercep',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1104,0),(1234,'hangeur_transport',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1105,0),(1235,'hangeur_escorteur',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1105,0),(1236,'hangeur_navette',1200,'1,3',0,0.00,NULL,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1106,0),(308,'pilot',300,'1,3',0,1.00,NULL,0,0,0,0,4,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0);
/*!40000 ALTER TABLE `uni1_vars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_vars_composant`
--

DROP TABLE IF EXISTS `uni1_vars_composant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_vars_composant` (
  `id` int(11) unsigned NOT NULL DEFAULT '0',
  `cost901` int(11) unsigned NOT NULL DEFAULT '0',
  `cost902` int(11) unsigned NOT NULL DEFAULT '0',
  `cost903` int(11) unsigned NOT NULL DEFAULT '0',
  `cost904` int(11) unsigned NOT NULL DEFAULT '0',
  `cost221` int(11) unsigned NOT NULL DEFAULT '0',
  `valeur` int(11) unsigned NOT NULL DEFAULT '0',
  `fret` int(11) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_vars_composant`
--

LOCK TABLES `uni1_vars_composant` WRITE;
/*!40000 ALTER TABLE `uni1_vars_composant` DISABLE KEYS */;
INSERT INTO `uni1_vars_composant` VALUES (1,100,50,20,0,0,10,20,1),(2,500,200,100,0,0,80,5,1),(3,1000,500,250,50,0,250,10,1),(4,1500,1000,400,150,0,600,20,1),(5,4000,25000,1000,250,0,2000,50,1),(6,10000,6000,2500,400,0,7500,100,1),(7,25000,15000,8000,1000,0,25000,200,1),(8,35000,22500,12500,1500,0,47500,400,1),(9,250,100,10,20,0,60,4,2),(10,750,300,150,175,0,450,10,2),(11,1000,450,250,350,0,1000,15,2),(12,2000,800,500,500,0,3000,30,2),(13,250,100,172,25,0,65,4,3),(14,400,200,425,100,0,350,8,3),(15,1000,650,950,250,0,1200,14,3),(16,750,500,300,0,0,5,20,4),(17,1500,1000,600,0,0,150,50,4),(18,25000,1750,1000,250,0,300,100,4),(19,6000,4000,2500,300,0,750,300,4),(20,8500,6000,4000,500,0,1650,750,4),(21,12500,10000,7500,1000,0,2000,2800,4),(22,20000,15000,10000,5000,0,4000,8000,4),(23,45000,30000,20000,30000,0,13000,16000,4),(24,130000,100000,75000,75000,0,32000,60000,4),(25,160000,125000,12000,90000,0,45000,95000,4),(26,250000,215000,155000,125000,0,60000,125000,4),(27,2000000,3000000,2500000,800000,1,50000,400000,3),(28,25000,50000,30000,20000,0,75,1000,5),(29,240000,180000,150000,75000,0,1,1200,6),(30,600000,450000,300000,120000,0,4,4800,6),(31,1050000,600000,412000,210000,0,10,12000,6),(32,20000,15000,4000,6000,0,10,1500,7),(33,60000,35000,8000,12500,0,5,9000,7),(34,135000,75000,20000,30000,0,2,15000,7),(35,145000,80000,25000,32000,0,2,60000,7),(36,220000,120000,42000,40000,0,1,115000,7);
/*!40000 ALTER TABLE `uni1_vars_composant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_vars_infrastructure`
--

DROP TABLE IF EXISTS `uni1_vars_infrastructure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_vars_infrastructure` (
  `id` int(11) unsigned NOT NULL DEFAULT '0',
  `fret` int(11) unsigned NOT NULL DEFAULT '0',
  `cost901` int(11) unsigned NOT NULL DEFAULT '0',
  `cost902` int(11) unsigned NOT NULL DEFAULT '0',
  `cost903` int(11) unsigned NOT NULL DEFAULT '0',
  `cost904` int(11) unsigned NOT NULL DEFAULT '0',
  `soldier` int(11) unsigned NOT NULL DEFAULT '0',
  `technician` int(11) unsigned NOT NULL DEFAULT '0',
  `scientist` int(11) unsigned NOT NULL DEFAULT '0',
  `pilots` int(11) unsigned NOT NULL DEFAULT '0',
  `mouvement` int(11) unsigned NOT NULL DEFAULT '0',
  `poids` int(11) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_vars_infrastructure`
--

LOCK TABLES `uni1_vars_infrastructure` WRITE;
/*!40000 ALTER TABLE `uni1_vars_infrastructure` DISABLE KEYS */;
INSERT INTO `uni1_vars_infrastructure` VALUES (1,200,500,250,100,10,0,0,0,1,100,50),(2,2500,3500,1750,300,150,1,0,0,2,85,2000),(3,10000,17500,8000,3500,1000,10,5,2,4,82,8000),(4,40000,30000,18000,10000,3000,20,10,4,10,70,16000),(5,150000,80000,40000,18000,8000,20,20,10,40,68,40000),(6,400000,175000,100000,42000,22000,30,50,20,80,34,90000),(7,600000,225000,150000,45000,28000,40,80,30,120,30,95000),(8,800000,275000,180000,48000,34000,50,100,40,150,28,100000),(9,1650000,550000,400000,120000,82000,100,150,60,400,25,140000);
/*!40000 ALTER TABLE `uni1_vars_infrastructure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_vars_rapidfire`
--

DROP TABLE IF EXISTS `uni1_vars_rapidfire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_vars_rapidfire` (
  `elementID` int(11) NOT NULL,
  `rapidfireID` int(11) NOT NULL,
  `shoots` int(11) NOT NULL,
  KEY `elementID` (`elementID`),
  KEY `rapidfireID` (`rapidfireID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_vars_rapidfire`
--

LOCK TABLES `uni1_vars_rapidfire` WRITE;
/*!40000 ALTER TABLE `uni1_vars_rapidfire` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_vars_rapidfire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_vars_requriements`
--

DROP TABLE IF EXISTS `uni1_vars_requriements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_vars_requriements` (
  `elementID` int(11) NOT NULL,
  `requireID` int(11) NOT NULL,
  `requireLevel` int(11) NOT NULL,
  KEY `elementID` (`elementID`),
  KEY `requireID` (`requireID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_vars_requriements`
--

LOCK TABLES `uni1_vars_requriements` WRITE;
/*!40000 ALTER TABLE `uni1_vars_requriements` DISABLE KEYS */;
INSERT INTO `uni1_vars_requriements` VALUES (10,4,15),(10,113,10),(7,1,20),(7,140,10),(8,2,20),(8,140,12),(9,3,20),(9,140,14),(11,48,20),(11,140,16),(24,110,2),(24,3,2),(23,110,2),(23,2,2),(22,110,2),(22,1,2),(25,48,2),(25,110,2),(45,14,3),(45,141,3),(21,14,5),(21,141,5),(46,14,5),(46,141,3),(5,31,8),(5,113,12),(5,144,10),(5,141,10),(33,31,3),(47,31,10),(47,5,6),(47,144,12),(47,141,12),(113,31,2),(140,31,5),(140,113,5),(140,110,2),(141,31,3),(142,21,5),(142,31,8),(142,113,8),(142,143,5),(143,31,3),(143,113,5),(144,31,12),(144,113,10),(144,142,7),(144,143,6),(109,31,5),(109,143,2),(110,31,3),(111,21,3),(111,31,6),(111,113,6),(111,143,4),(115,21,1),(115,31,3),(115,113,3),(117,21,5),(117,31,7),(117,113,6),(117,143,4),(118,21,8),(118,31,10),(118,113,12),(118,142,10),(145,21,1),(145,31,3),(106,31,6),(146,31,14),(146,113,12),(146,144,8),(147,31,14),(147,110,12),(147,144,8),(148,31,10),(148,113,12),(148,144,6),(148,145,8),(149,31,10),(149,113,12),(149,144,6),(149,143,8),(301,45,1),(302,45,2),(303,45,5),(306,45,6),(307,45,12),(307,109,5),(307,111,5),(308,45,10),(308,21,2),(304,45,12),(304,144,14),(305,45,6),(202,21,2),(202,115,2),(203,21,4),(203,115,6),(204,21,1),(204,115,1),(205,21,3),(205,111,2),(205,117,2),(206,21,5),(206,117,4),(207,21,7),(207,118,4),(208,21,4),(208,117,3),(219,118,12),(219,110,16),(219,14,16),(210,21,3),(210,115,3),(210,106,2),(211,117,6),(211,21,8),(212,21,1),(213,21,9),(213,118,6),(214,21,12),(214,118,7),(221,143,8),(222,143,10),(215,118,5),(215,21,8),(216,106,12),(216,21,15),(216,109,14),(216,110,14),(216,111,15),(222,144,10),(221,140,8),(217,111,10),(217,21,14),(222,113,12),(217,110,14),(217,117,15),(218,21,18),(218,109,20),(218,110,20),(218,111,20),(222,14,10),(218,118,20),(221,113,8),(219,45,12),(209,142,6),(209,110,6),(209,14,8),(209,45,5),(220,21,9),(222,31,12),(220,118,6),(401,46,1),(402,113,1),(402,46,2),(403,113,3),(403,46,4),(404,46,6),(404,113,6),(404,109,3),(404,110,1),(405,46,4),(405,146,4),(406,46,8),(407,110,2),(407,46,1),(408,110,6),(408,46,6),(409,609,1),(221,31,8),(410,46,18),(410,109,20),(221,14,6),(411,110,22),(411,108,15),(411,111,25),(411,113,20),(411,608,2),(411,46,20),(223,45,10),(223,14,12),(223,110,12),(223,117,8),(219,144,12),(224,45,6),(224,21,8),(224,110,5),(224,106,8),(224,118,5),(226,47,1),(225,45,3),(225,21,5),(225,110,3),(225,109,5),(225,115,5),(225,144,2),(412,46,2),(412,110,2),(412,109,3),(413,46,5),(413,110,5),(413,109,7),(413,141,5),(414,46,10),(414,109,12),(414,110,10),(414,141,10),(414,143,8),(415,46,10),(415,109,13),(415,111,11),(415,110,10),(415,141,10),(415,113,12),(416,46,15),(416,109,16),(416,111,12),(416,110,12),(416,141,14),(416,144,16),(416,143,14),(417,46,7),(417,109,10),(417,110,5),(418,46,12),(418,109,14),(418,111,12),(418,110,10),(418,141,10),(418,144,10),(1101,21,2),(1101,145,2),(1102,21,4),(1102,145,4),(1103,21,6),(1103,145,6),(1104,21,7),(1104,145,7),(1105,21,8),(1105,145,8),(1106,21,10),(1106,145,10),(1106,144,4),(1107,21,12),(1107,145,12),(1107,144,6),(1108,21,14),(1108,145,14),(1108,144,8),(1109,21,16),(1109,145,16),(1109,144,10),(1202,109,2),(1202,143,2),(1203,109,5),(1203,143,5),(1204,109,8),(1204,143,8),(1205,109,10),(1205,143,10),(1206,109,14),(1206,143,14),(1207,109,16),(1207,143,16),(1207,113,16),(1207,144,10),(1208,109,18),(1208,143,18),(1208,113,18),(1208,144,14),(1209,110,2),(1210,110,5),(1211,110,8),(1212,110,14),(1212,144,5),(1213,113,2),(1213,111,4),(1213,143,2),(1214,113,5),(1214,111,7),(1214,143,5),(1215,113,10),(1215,111,14),(1215,143,10),(1215,144,10),(1216,113,2),(1216,115,2),(1217,113,3),(1217,115,4),(1218,113,4),(1218,115,6),(1219,113,6),(1219,115,7),(1219,117,5),(1220,113,8),(1220,117,8),(1221,113,10),(1221,117,10),(1221,142,3),(1222,113,12),(1222,142,6),(1222,144,2),(1222,118,4),(1223,113,15),(1223,142,8),(1223,144,8),(1223,118,8),(1224,113,17),(1224,142,14),(1224,144,12),(1224,118,12),(1225,113,18),(1225,142,16),(1225,144,16),(1225,118,16),(1226,113,20),(1226,142,18),(1226,144,16),(1226,118,18),(1226,143,18),(1227,113,12),(1227,144,12),(1227,141,15),(1228,113,10),(1228,143,12),(1229,47,1),(1229,4,16),(1229,143,16),(1229,144,16),(1229,109,16),(1230,109,18),(1230,144,16),(1230,143,18),(1230,113,18),(1230,5,8),(1230,47,2),(1231,47,3),(1231,5,8),(1231,113,20),(1231,143,20),(1231,144,16),(1231,109,20),(1232,141,4),(1232,110,2),(1232,145,4),(1233,141,6),(1233,110,4),(1233,145,6),(1234,141,8),(1234,110,6),(1234,145,8),(1235,141,10),(1235,110,8),(1235,145,10),(1236,141,12),(1236,110,10),(1236,145,12),(308,45,10),(308,21,2),(124,31,4);
/*!40000 ALTER TABLE `uni1_vars_requriements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_vars_user`
--

DROP TABLE IF EXISTS `uni1_vars_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_vars_user` (
  `varId` int(11) NOT NULL AUTO_INCREMENT,
  `shipAttack` bigint(20) unsigned NOT NULL DEFAULT '0',
  `shipCoque` bigint(20) unsigned NOT NULL DEFAULT '0',
  `shipBouclier` bigint(20) unsigned NOT NULL DEFAULT '0',
  `shipSpeed` bigint(20) unsigned NOT NULL DEFAULT '0',
  `shipHyperspace` float(5,2) unsigned NOT NULL DEFAULT '0.00',
  `shipFret` bigint(20) unsigned NOT NULL DEFAULT '0',
  `owerId` int(11) unsigned NOT NULL DEFAULT '0',
  `nom` varchar(32) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_infrastructure` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `cost901` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cost902` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cost903` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cost904` bigint(20) unsigned NOT NULL DEFAULT '0',
  `composant_1` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_2` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_3` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_4` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_5` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_6` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_7` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_8` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_9` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_10` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_11` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_12` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_13` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_14` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_15` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_16` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_17` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_18` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_19` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_20` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_21` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_22` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_23` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_24` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_25` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_26` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_27` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_28` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_29` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_30` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_31` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_32` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_33` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_34` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_35` int(11) unsigned NOT NULL DEFAULT '0',
  `composant_36` int(11) unsigned NOT NULL DEFAULT '0',
  `constructionTime` int(11) unsigned NOT NULL DEFAULT '0',
  `count` varchar(255) NOT NULL DEFAULT '0,0,0',
  PRIMARY KEY (`varId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `uni1_xsolla_options`
--

DROP TABLE IF EXISTS `uni1_xsolla_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_xsolla_options` (
  `xsollaID` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `xsollaKey` varchar(32) NOT NULL,
  `xsollaCredit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `xsollaPrice` float(5,2) unsigned NOT NULL DEFAULT '0.00',
  UNIQUE KEY `xsollaKey` (`xsollaKey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_xsolla_options`
--

LOCK TABLES `uni1_xsolla_options` WRITE;
/*!40000 ALTER TABLE `uni1_xsolla_options` DISABLE KEYS */;
INSERT INTO `uni1_xsolla_options` VALUES (1,' 2cqlBf15Ge',1,1.80),(2,' STgjfv4fn4',5,8.75),(3,' 7sCs69r2GC',10,17.00),(4,' tKdOYXUvgJ',20,33.00),(5,' 6Uu8MicxsM',40,64.00),(6,' Ptyxtdqq5t',80,124.00);
/*!40000 ALTER TABLE `uni1_xsolla_options` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-15 21:10:40

