-- MySQL dump 10.13  Distrib 5.1.61, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: scrum_db
-- ------------------------------------------------------
-- Server version	5.1.61-3

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
-- Table structure for table `columns`
--

DROP TABLE IF EXISTS `columns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `columns` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `column_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `columns`
--

LOCK TABLES `columns` WRITE;
/*!40000 ALTER TABLE `columns` DISABLE KEYS */;
INSERT INTO `columns` VALUES (1,'Column #1'),(2,'Column #2'),(3,'Column #3');
/*!40000 ALTER TABLE `columns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,1,'1333302165','RosaSync','');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_columns`
--

DROP TABLE IF EXISTS `projects_columns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_columns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_columns`
--

LOCK TABLES `projects_columns` WRITE;
/*!40000 ALTER TABLE `projects_columns` DISABLE KEYS */;
INSERT INTO `projects_columns` VALUES (1,1,1),(2,1,2),(3,1,3);
/*!40000 ALTER TABLE `projects_columns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `changed` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,1,1333300001,1333802064,'Task #1','Task description #1',0),(2,2,1,1333300225,1333300225,'Task #2','Task description #2',0),(3,3,1,1333300240,1333300240,'Task #3','Task description #3',0),(4,1,1,1333300225,1333300225,'Task #4','Description Task #4',0),(5,1,1,1333640960,1333640960,'Task #5','Task description #5',0),(6,1,1,1333645013,1333657779,'Всех убьем!!! ','Обязательна!',0),(7,1,1,1333645025,1334509480,'Абырвалг','фывафыва',0),(8,2,1,1333645064,1333657245,'Task #8','лфоывралофывра',0),(9,1,1,1333645258,1334509351,'sdfsdfsdsadfasdfasdfафыва','f<br />asdf<br />фыва<br />sdf<br />fsdfdfasdfsdf<br />sdfsdf<br />df<br />dfs<br />sdfsdfsdfsdfs',0),(10,2,1,1333645270,1334509409,'фывафывафывафыва','описание таска\nasd\nf\nasdf\nasdf\n\n',0),(11,2,1,1333645279,1334509404,'Task #10','<br />аааа<br />&lt;br&gt;<br /><br />&lt;br&gt;<br />asdf<br />asdf<br />asdf<br /><br />',0),(12,2,1,1333645284,1334436327,'Работат! вфыа','фывадфывафывафыва ыва <br />',1),(13,2,1,1333645300,1334434518,'Все работат!','&lt;?php phpinfo(); ?&gt;f<br /><br />',0),(14,3,1,1333645309,1333657699,'тема subj','Вот<br />',0),(15,3,1,1333645313,1333657748,'Task #15','о )',0),(16,1,1,1334142051,1334142066,'asdfasdf','asdfsdf',0),(17,1,1,1334142075,1334438054,'ыфва','sdfфыва',1),(18,1,1,1334142138,1334142138,'','ать запись в конфиг при каждом изменении таймера коллизий',0),(19,2,1,1334142287,1334436189,'ffff','asdf',1),(20,2,1,1334142322,1334142322,'Убрать запись в конфиг при каждом изменении таймера коллизий','',0),(21,1,1,1334142872,1334436668,'','',1),(22,1,1,1334437719,1334437719,'sadfasdf','asdfasdf',1),(23,3,1,1334437807,1334437807,'asdfasdf','asdfasdfasdf',1),(24,3,1,1334437902,1334437902,'sdfa','',1),(25,1,1,1334438071,1334438071,'фыва','',0);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` int(11) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `login` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `salt` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`name`),
  KEY `mail` (`mail`,`created`,`access`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'','',NULL,0,0,0,0,''),(1,'admin','cfafe6d0c990756730306d128df214d4','shi3a@yandex.ru',1334687069,1334687069,1334687069,1,'microsoft');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-09 23:25:01
