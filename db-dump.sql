CREATE DATABASE  IF NOT EXISTS `sm` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `sm`;
-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: sm
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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
-- Table structure for table `sm_stamp_types`
--

DROP TABLE IF EXISTS `sm_stamp_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_stamp_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stamp_name` varchar(70) COLLATE utf8_bin NOT NULL,
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
  `token` varchar(25) COLLATE utf8_bin NOT NULL,
  `avatar` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `province` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `street` varchar(70) COLLATE utf8_bin DEFAULT NULL,
  `apartment` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1' COMMENT 'Collection of users',
  `first_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `company` varchar(90) COLLATE utf8_bin DEFAULT NULL,
  `tax_id` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin AVG_ROW_LENGTH=16384;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_users`
--

LOCK TABLES `sm_users` WRITE;
/*!40000 ALTER TABLE `sm_users` DISABLE KEYS */;
INSERT INTO `sm_users` VALUES (2,'admin','aimeefoodlover@gmail.com','sdfsdf',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'Rafal','Martinez',NULL,NULL);
/*!40000 ALTER TABLE `sm_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-30 18:12:16
