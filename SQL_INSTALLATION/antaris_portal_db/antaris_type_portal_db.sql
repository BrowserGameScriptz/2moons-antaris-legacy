-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: antaris_portal
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
-- Current Database: `antaris_portal`
--


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
  `uni_name` varchar(30) NOT NULL,
  `game_name` varchar(30) NOT NULL,
  `game_disable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `close_reason` text NOT NULL,
  `forum_url` varchar(128) NOT NULL DEFAULT 'http://2moons.cc',
  `adm_attack` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `debug` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(2) NOT NULL DEFAULT '',
  `stat_update_time` tinyint(3) unsigned NOT NULL DEFAULT '25',
  `stat_last_db_update` int(11) NOT NULL DEFAULT '0',
  `cron_lock` int(11) NOT NULL DEFAULT '0',
  `ts_cron_interval` smallint(5) NOT NULL DEFAULT '5',
  `ts_login` varchar(32) NOT NULL DEFAULT '',
  `ts_password` varchar(32) NOT NULL DEFAULT '',
  `reg_closed` tinyint(1) NOT NULL DEFAULT '0',
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
  `ga_active` varchar(42) NOT NULL DEFAULT '0',
  `ga_key` varchar(42) NOT NULL DEFAULT '',
  `ttf_file` varchar(128) NOT NULL DEFAULT 'styles/resource/fonts/DroidSansMono.ttf',
  `ref_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ref_bonus` int(11) unsigned NOT NULL DEFAULT '1000',
  `ref_minpoints` bigint(20) unsigned NOT NULL DEFAULT '2000',
  `ref_max_referals` tinyint(1) unsigned NOT NULL DEFAULT '5',
  `timezone` varchar(32) NOT NULL DEFAULT 'Europe/London',
  `dst` enum('0','1','2') NOT NULL DEFAULT '2',
  PRIMARY KEY (`uni`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_config`
--

LOCK TABLES `uni1_config` WRITE;
/*!40000 ALTER TABLE `uni1_config` DISABLE KEYS */;
INSERT INTO `uni1_config` VALUES (1,'1.8.git',0,25,'MakeYourGame','MakeYourGame',1,'The game is closed','http://makeyourgame.pro',0,0,'en',25,0,0,5,'','',0,0,1,'',465,'','','','','/usr/sbin/sendmail',1,'0','','styles/resource/fonts/DroidSansMono.ttf',0,1000,2000,5,'UTC','2');
/*!40000 ALTER TABLE `uni1_config` ENABLE KEYS */;
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
  `hasChangedTime` int(11) unsigned NOT NULL DEFAULT '0',
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
INSERT INTO `uni1_session` VALUES ('meamhlkhsgjpqoabp25lunpo22',24,'95.71.8.254',1518088580),('ijkcm9k8kt270dh458402u7no1',25,'92.238.244.69',1518465197);
/*!40000 ALTER TABLE `uni1_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_users`
--

DROP TABLE IF EXISTS `uni1_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `email_2` varchar(64) NOT NULL DEFAULT '',
  `lang` varchar(2) NOT NULL DEFAULT 'de',
  `authattack` tinyint(1) NOT NULL DEFAULT '0',
  `authlevel` tinyint(1) NOT NULL DEFAULT '0',
  `rights` text,
  `id_planet` int(11) unsigned NOT NULL DEFAULT '0',
  `universe` tinyint(3) unsigned NOT NULL,
  `user_lastip` varchar(40) NOT NULL DEFAULT '',
  `ip_at_reg` varchar(40) NOT NULL DEFAULT '',
  `register_time` int(11) NOT NULL DEFAULT '0',
  `onlinetime` int(11) NOT NULL DEFAULT '0',
  `dpath` varchar(20) NOT NULL DEFAULT 'gow',
  `timezone` varchar(32) NOT NULL DEFAULT 'Europe/London',
  `uctime` int(11) NOT NULL DEFAULT '0',
  `setmail` int(11) NOT NULL DEFAULT '0',
  `ref_id` int(11) NOT NULL DEFAULT '0',
  `ref_bonus` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `inactive_mail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `homeplanet` varchar(32) NOT NULL,
  `encodage` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `authlevel` (`authlevel`),
  KEY `ref_bonus` (`ref_bonus`),
  KEY `universe` (`universe`,`username`,`password`,`onlinetime`,`authlevel`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_users`
--

LOCK TABLES `uni1_users` WRITE;
/*!40000 ALTER TABLE `uni1_users` DISABLE KEYS */;
INSERT INTO `uni1_users` VALUES (1,'demo','95d9bed956f1f97afed6f6543fc78815','jeremy.baukens@gmail.com','jeremy.baukens@gmail.com','fr',0,0,NULL,0,1,'91.182.210.241','91.182.210.241',1507501297,1507576239,'gow','UTC',0,0,0,0,0,'homeplanet','4ca86912b5674f2c0e7c18725c910843'),(2,'klon','e10adc3949ba59abbe56e057f20f883e','2ref@ztu.com','2ref@ztu.com','en',0,0,NULL,0,1,'85.175.5.31','85.175.5.31',1507506181,1507948570,'gow','UTC',0,0,0,0,0,'Asrotiks','3581c3a489fc4cf44fb0890d18403481'),(3,'Wrath','b8ea4c263ecc4891171382b776b467dc','yyzblogg@gmail.com','yyzblogg@gmail.com','en',0,0,NULL,0,1,'184.151.178.214','184.151.178.214',1507512059,1507512073,'gow','UTC',0,0,0,0,0,'Tbagballs','01c7277cd3ce9479a05e2c713061cb56'),(4,'xena','9c3c5f4b4958f37f9ca3727ebf9fd226','wstctr@gmail.com','wstctr@gmail.com','en',0,0,NULL,0,1,'81.213.185.185','95.10.25.187',1507517391,1507558387,'gow','UTC',0,0,0,0,0,'TekBayrak','092d14e506e707688499cdd62067d7ef'),(5,'viperX','e10adc3949ba59abbe56e057f20f883e','alex@yopmail.com','alex@yopmail.com','en',0,0,NULL,0,1,'192.241.183.136','192.241.183.136',1507534036,1507534050,'gow','UTC',0,0,0,0,0,'112233','e295b1171728793cbda3628f3eaaf445'),(6,'Zedr','7a12a47984333222320df4510947fbdd','zaccardo.francesco@hotmail.com','zaccardo.francesco@hotmail.com','it',0,0,NULL,0,1,'146.159.139.23','146.159.139.23',1507534194,1507541274,'gow','UTC',0,0,0,0,0,'Main Planet','2c662bdbfc23f7fc6b2d440625fa4859'),(7,'DrakeSong','b5ea8985533defbf1d08d5ed2ac8fe9b','we@web.de','we@web.de','de',0,0,NULL,0,1,'79.206.252.48','79.206.252.48',1507574410,1507574412,'gow','UTC',0,0,0,0,0,'MehrVonDem','2133d1e8e52b9beabd424a789c7e6cab'),(8,'odiabile','40c40eaa1fe2d30abc6980e477dfb419','tode1@hotmail.it','tode1@hotmail.it','it',0,0,NULL,0,1,'80.182.165.216','79.50.142.226',1507626547,1512659154,'gow','UTC',0,0,0,0,0,'odiabile','ae6802b444b4e8b975ff92c3b0e6cedd'),(9,'Ragnar','2b0c30a5d1afc723ae3eed2ac7b99efe','seanbowers14@gmail.com','seanbowers14@gmail.com','en',0,0,NULL,0,1,'101.99.150.43','101.99.150.43',1507632238,1507632241,'gow','UTC',0,0,0,0,0,'Vahala','3d8a6cb011d58bfddff0e5d515889e3b'),(10,'anytime','fc5b0db24a6549378530ec779f95a3ec','terminus34@gmx.de','terminus34@gmx.de','de',0,0,NULL,0,1,'78.52.130.237','85.179.167.66',1507660068,1507795048,'gow','UTC',0,0,0,0,0,'hello','768bc4e0afd68e79040a7e48b1b8755e'),(11,'Spolfee','08ef84145b81dcd98554b70c662c41ed','spolfoilt@mail.ru','spolfoilt@mail.ru','en',0,0,NULL,0,1,'109.226.99.192','109.226.99.192',1507661725,1507661731,'gow','UTC',0,0,0,0,0,'Headpl','fad578d60ad8db5344cf6aeb617685cd'),(12,'Drood','af48cb643601aee3259b3c66360363ad','tomekkatomekk@gmail.com','tomekkatomekk@gmail.com','en',0,0,NULL,0,1,'89.228.114.148','89.228.114.148',1507974689,1507988590,'gow','UTC',0,0,0,0,0,'Osterode','d141ab2025f62982cea18b58de808400'),(13,'diyworld','d5cbfe9ff07fef1ecc93861ce5dd4f3b','dsf@dsfsf.com','dsf@dsfsf.com','en',0,0,NULL,0,1,'112.222.40.236','112.222.40.236',1509418502,1509421421,'gow','UTC',0,0,0,0,0,'mainplanet','80757158d13f784e317ebfc3d9a0acc1'),(14,'space','44d1178cc4945b2ffb06e61e90e00f64','spacemoon@euromail.hu','spacemoon@euromail.hu','en',0,0,NULL,0,1,'188.112.107.117','188.112.107.117',1509905626,1509905632,'gow','UTC',0,0,0,0,0,'space','d069cfdb0de1061ee7b9cb9f0c1dbff9'),(15,'sean007','f44e8b4fc259a04b803227614d362c9a','louki193300@gmail.com','louki193300@gmail.com','fr',0,0,NULL,0,1,'88.186.47.57','88.186.47.57',1510440517,1510440519,'gow','UTC',0,0,0,0,0,'lulunax','9a7fe20720120898c784f491777d53e5'),(16,'zordex','ea9a4f95d043229bf5c303a324078013','forest.men@bk.ru','forest.men@bk.ru','en',0,0,NULL,0,1,'195.182.22.227','195.182.22.227',1511804120,1511804143,'gow','UTC',0,0,0,0,0,'zordaz','7c99b44667de37ba8758322153c91025'),(17,'Skyld','cc72c0caef68237d8aba29a8dd26143a','rainer.greb@outlook.de','rainer.greb@outlook.de','de',0,0,NULL,0,1,'89.15.237.65','89.15.237.65',1512209869,1512209878,'gow','UTC',0,0,0,0,0,'Earth','5d5608d2f8e225df3872e75c9a29d60a'),(18,'sn0wak','ee24db0f79a2b95271de918e339cf0f4','brunocosta505@hotmail.com','brunocosta505@hotmail.com','pt',0,0,NULL,0,1,'79.168.132.244','79.168.132.244',1513768410,1513768639,'gow','UTC',0,0,0,0,0,'Reticuli','ecbf6ee7400fb26a9542afc19f15eac1'),(19,'wabbelbomber','ac67675aae438dfe9cf6f61fc9df81d2','J_E_M@outlook.de','J_E_M@outlook.de','de',0,0,NULL,0,1,'149.205.110.28','149.205.110.28',1516048611,1516048614,'gow','UTC',0,0,0,0,0,'irgendwas','4dda790b421e56fb5ba05a6bbb984f85'),(20,'Rocky','e10adc3949ba59abbe56e057f20f883e','Rockythedog88@gmail.com','Rockythedog88@gmail.com','de',0,0,NULL,0,1,'146.52.248.62','146.52.248.62',1516048878,1516125177,'gow','UTC',0,0,0,0,0,'mein haus','928099cd39aae72c06b4629ee28f14b6'),(21,'drystream','96ae77302e79da54b57b0223416c3e4b','drystream@gmail.com','drystream@gmail.com','en',0,0,NULL,0,1,'93.85.113.157','93.85.113.157',1516426144,1516426166,'gow','UTC',0,0,0,0,0,'DreamHome','b80071af8e6523e9a1ee639d63ef320d'),(22,'ironbull','447ee6d4af957d677bb47203327c4390','ironbull@libero.it','ironbull@libero.it','it',0,0,NULL,0,1,'95.244.12.193','95.244.12.193',1516435574,1516435583,'gow','UTC',0,0,0,0,0,'turbo','f9c82af6b44da91ba777a81ec31ee3d0'),(23,'xapim','ab699531299764accdbe03c6c5c06897','tiagofazendeiro@hotmail.com','tiagofazendeiro@hotmail.com','en',0,0,NULL,0,1,'84.246.203.101','84.246.203.101',1517334778,1517355506,'gow','UTC',0,0,0,0,0,'xapim','86e545491bd7262a408708ba1bb645ea'),(24,'laxre','d429221a19b271eaed2cf38e11b0d7af','laxre@bk.ru','laxre@bk.ru','en',0,0,NULL,0,1,'95.71.8.254','95.71.8.254',1518088570,1518088580,'gow','UTC',0,0,0,0,0,'retaq','b3671a3dfa6d9cd67646fcaaf5f12c92'),(25,'hr9uu','19439ace9942db139cd9c9e92b4d7352','hr9uu@slipry.net','hr9uu@slipry.net','en',0,0,NULL,0,1,'92.238.244.69','92.238.244.69',1518465195,1518465197,'gow','UTC',0,0,0,0,0,'hr9uu','c718e1cf4fa7b6b2f7b4b7d06923927c');
/*!40000 ALTER TABLE `uni1_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uni1_users_valid`
--

DROP TABLE IF EXISTS `uni1_users_valid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uni1_users_valid` (
  `validationID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(64) NOT NULL,
  `validationKey` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(64) NOT NULL,
  `date` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `language` varchar(3) NOT NULL,
  `universe` tinyint(3) unsigned NOT NULL,
  `referralID` int(11) DEFAULT NULL,
  `externalAuthUID` varchar(128) DEFAULT NULL,
  `externalAuthMethod` varchar(32) DEFAULT NULL,
  `homeplanet` varchar(32) NOT NULL,
  PRIMARY KEY (`validationID`,`validationKey`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uni1_users_valid`
--

LOCK TABLES `uni1_users_valid` WRITE;
/*!40000 ALTER TABLE `uni1_users_valid` DISABLE KEYS */;
/*!40000 ALTER TABLE `uni1_users_valid` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-15 21:10:45

