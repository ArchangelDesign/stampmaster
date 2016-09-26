-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sm
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `sm_config`
--

DROP TABLE IF EXISTS `sm_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(150) DEFAULT NULL,
  `c_value` varchar(255) DEFAULT NULL,
  `extended` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_config`
--

LOCK TABLES `sm_config` WRITE;
/*!40000 ALTER TABLE `sm_config` DISABLE KEYS */;
INSERT INTO `sm_config` VALUES (1,'cacheConfig','1',0),(2,'company-name','The Stamp Company',0),(3,'page-title','The STamp Company Store Online',0);
/*!40000 ALTER TABLE `sm_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sm_config_extension`
--

DROP TABLE IF EXISTS `sm_config_extension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_config_extension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_value` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_config_extension`
--

LOCK TABLES `sm_config_extension` WRITE;
/*!40000 ALTER TABLE `sm_config_extension` DISABLE KEYS */;
/*!40000 ALTER TABLE `sm_config_extension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sm_price_list`
--

DROP TABLE IF EXISTS `sm_price_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_price_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stamp_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_price_list`
--

LOCK TABLES `sm_price_list` WRITE;
/*!40000 ALTER TABLE `sm_price_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `sm_price_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sm_stamp_types`
--

DROP TABLE IF EXISTS `sm_stamp_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_stamp_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stamp_name` varchar(70) COLLATE utf8_bin NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `thumbnail` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `large_image` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `width` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `mass` float DEFAULT NULL,
  `manufacturer` varchar(70) COLLATE utf8_bin DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL COMMENT 'Collection of stamp types',
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_stamp_types`
--

LOCK TABLES `sm_stamp_types` WRITE;
/*!40000 ALTER TABLE `sm_stamp_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `sm_stamp_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sm_storage`
--

DROP TABLE IF EXISTS `sm_storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stamp_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `state` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_storage`
--

LOCK TABLES `sm_storage` WRITE;
/*!40000 ALTER TABLE `sm_storage` DISABLE KEYS */;
/*!40000 ALTER TABLE `sm_storage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sm_users`
--

DROP TABLE IF EXISTS `sm_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(70) COLLATE utf8_bin NOT NULL,
  `email` varchar(250) COLLATE utf8_bin NOT NULL,
  `password` varchar(150) COLLATE utf8_bin NOT NULL,
  `date_registered` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1' COMMENT 'Collection of users',
  `session_id` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `token` varchar(25) COLLATE utf8_bin NOT NULL,
  `avatar` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `province` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `street` varchar(70) COLLATE utf8_bin DEFAULT NULL,
  `apartment` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `company` varchar(90) COLLATE utf8_bin DEFAULT NULL,
  `tax_id` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin AVG_ROW_LENGTH=16384;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_users`
--

LOCK TABLES `sm_users` WRITE;
/*!40000 ALTER TABLE `sm_users` DISABLE KEYS */;
INSERT INTO `sm_users` VALUES (1,'admin','admin@admin.pl','$2y$10$g4KTo/EM1lZu1L1QZEzeveYVN5L.3IXoMVlB3mtTTZ4/lfxMo.9Gq',NULL,NULL,'2016-09-19 14:10:11',1,'','3eff93d20a5522ffff67268dc',NULL,NULL,'','','','','',1,'','',NULL,NULL);
/*!40000 ALTER TABLE `sm_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sm_users_groups`
--

DROP TABLE IF EXISTS `sm_users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `expires` tinyint(4) DEFAULT NULL,
  `default` tinyint(4) DEFAULT NULL,
  `expiration` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_users_groups`
--

LOCK TABLES `sm_users_groups` WRITE;
/*!40000 ALTER TABLE `sm_users_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `sm_users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-26 10:16:32
