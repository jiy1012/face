CREATE DATABASE  IF NOT EXISTS `face` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `face`;
-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: face
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `app_passport`
--

DROP TABLE IF EXISTS `app_passport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_passport` (
  `uid` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户uid',
  `email` varchar(128) NOT NULL DEFAULT '' COMMENT '邮箱',
  `username` varchar(128) NOT NULL DEFAULT '' COMMENT '用户名',
  `phone` varchar(24) NOT NULL DEFAULT '' COMMENT '手机号',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='注册账号密码表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_passport`
--

LOCK TABLES `app_passport` WRITE;
/*!40000 ALTER TABLE `app_passport` DISABLE KEYS */;
INSERT INTO `app_passport` VALUES (0,'','','','',1471760310,0),(6,'','','18210048936','d01a1a85b56400e33321fd7a6f1b09b5',1471760675,0),(7,'','','18210048936','d01a1a85b56400e33321fd7a6f1b09b5',1471766633,0),(8,'','','18210048937','d01a1a85b56400e33321fd7a6f1b09b5',1471766674,0),(9,'','','18210048937','d01a1a85b56400e33321fd7a6f1b09b5',1471766731,0),(10,'','','18210048938','d01a1a85b56400e33321fd7a6f1b09b5',1471766753,0),(11,'','','18210048939','d01a1a85b56400e33321fd7a6f1b09b5',1471766805,1471768133),(12,'','','18210048939','d01a1a85b56400e33321fd7a6f1b09b5',1471766845,1471766845),(13,'','','18210048931','d01a1a85b56400e33321fd7a6f1b09b5',1471766900,1471766900),(14,'','','18210048932','d01a1a85b56400e33321fd7a6f1b09b5',1471767058,1471767058);
/*!40000 ALTER TABLE `app_passport` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-28 20:30:43
