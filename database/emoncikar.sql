-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: emoncikar
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomenclature_id` int(10) unsigned NOT NULL,
  `AuFnF` varchar(5) NOT NULL DEFAULT 'AU',
  `AUpLkS` varchar(5) NOT NULL DEFAULT 'AU',
  `title` text NOT NULL,
  `location` text NOT NULL,
  `quantity` double NOT NULL,
  `unit` varchar(100) NOT NULL,
  `ceiling_budget` double NOT NULL,
  `ceiling_rpm` double NOT NULL,
  `ceiling_pln` double NOT NULL,
  `year` int(11) NOT NULL,
  `pptk_id` int(10) unsigned NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `images` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nomenclature_id` (`nomenclature_id`),
  KEY `pptk_id` (`pptk_id`),
  CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`nomenclature_id`) REFERENCES `nomenclature` (`id`),
  CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`pptk_id`) REFERENCES `pptk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (4,6,'F','AU','Perluasan SPAM IKK ANGGOEYA','KOTA KENDARI',40,'SR',6000000,6000000,0,2020,5,'','','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg'),(5,3,'F','AU','Pengembangan Kawasan Perdesaan Kec. Towea','Muna',1,'Ha',1000000,1000000,0,2021,5,'','','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg'),(6,3,'F','AU','Pembangunan PSD Kawasan Kumuh Pesisir','Bau-bau',1,'Ha',1000000,1000000,0,2021,5,'','','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budget`
--

DROP TABLE IF EXISTS `budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL,
  `nominal` double NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `rpm_pln` int(2) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget`
--

LOCK TABLES `budget` WRITE;
/*!40000 ALTER TABLE `budget` DISABLE KEYS */;
INSERT INTO `budget` VALUES (12,4,2000000,2,2020,0,0),(13,4,2000000,3,2020,0,0),(14,4,2000000,4,2020,0,0),(15,4,1900000,2,2020,0,1),(16,5,300000,2,2021,0,0),(17,5,200000,3,2021,0,0),(18,5,450000,4,2021,0,0),(19,5,50000,5,2021,0,0),(24,6,300000,2,2021,0,0),(25,6,500000,4,2021,0,0),(26,6,150000,11,2021,0,0),(27,6,50000,12,2021,0,0);
/*!40000 ALTER TABLE `budget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'uadmin','user admin'),(3,'user','user');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(50) NOT NULL,
  `list_id` varchar(200) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `position` int(4) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (101,1,'Beranda','admin/','home_index','home',1,1,'-'),(102,1,'Group','admin/group','group_index','home',1,2,'-'),(103,1,'Setting','admin/menus','-','cogs',1,3,'-'),(104,1,'User','admin/user_management','user_management_index','users',1,4,'-'),(106,103,'Menu','admin/menus','menus_index','circle',1,1,'-'),(107,2,'Beranda','uadmin/home','home_index','home',1,1,'-'),(108,2,'Pengguna','uadmin/users','users_index','users',1,100,'-'),(109,2,'Data Kegiatan','uadmin/activity','activity_index','file',1,2,'-'),(110,2,'Tambah Kegiatan','uadmin/activity/add','activity_add','plus-square',1,3,'-'),(111,2,'PPTK','uadmin/pptk','pptk_index','users',1,4,'-'),(112,2,'SETTING','header','-','home',1,6,'-'),(115,2,'Laporan','uadmin/report','uadmin_report','file',1,5,'-'),(116,2,'Nomenklatur','uadmin/nomenclature','nomenclature_index','file',1,7,'-'),(117,3,'Beranda','user/home','home_index','home',1,1,'-'),(118,3,'Data Kegiatan','user/activity','activity_index','file',1,1,'-');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nomenclature`
--

DROP TABLE IF EXISTS `nomenclature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nomenclature` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nomenclature`
--

LOCK TABLES `nomenclature` WRITE;
/*!40000 ALTER TABLE `nomenclature` DISABLE KEYS */;
INSERT INTO `nomenclature` VALUES (3,2412,'cipta karya | Pembinaan dan Pengembangan Kawasan Permukiman'),(4,2413,'cipta karya | Pembinaan dan Pengembangan Penataan Bangunan dan Lingkungan'),(5,2414,'cipta karya | Pembinaan dan Pengembangan Penyehatan Lingkungan Permukiman'),(6,2415,'cipta karya | Pembinaan dan Pengembangan Sistem Penyediaan Air Minum');
/*!40000 ALTER TABLE `nomenclature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `physical`
--

DROP TABLE IF EXISTS `physical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `physical` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL,
  `progress` int(3) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `physical_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `physical`
--

LOCK TABLES `physical` WRITE;
/*!40000 ALTER TABLE `physical` DISABLE KEYS */;
INSERT INTO `physical` VALUES (10,4,30,2,2020,0),(11,4,50,3,2020,0),(12,4,20,4,2020,0),(13,4,15,2,2020,1),(14,5,30,2,2021,0),(15,5,50,3,2021,0),(16,5,20,4,2021,0),(20,6,30,2,2021,0),(21,6,50,4,2021,0),(22,6,20,11,2021,0);
/*!40000 ALTER TABLE `physical` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pptk`
--

DROP TABLE IF EXISTS `pptk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pptk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pptk`
--

LOCK TABLES `pptk` WRITE;
/*!40000 ALTER TABLE `pptk` DISABLE KEYS */;
INSERT INTO `pptk` VALUES (5,'Oksy Lepong Bulan, S.Ars','Randal Cipta Karya');
/*!40000 ALTER TABLE `pptk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problem`
--

DROP TABLE IF EXISTS `problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL,
  `report_date` date NOT NULL,
  `problem_description` text NOT NULL,
  `problem_date` date NOT NULL,
  `solution` text NOT NULL,
  `authorities` text NOT NULL,
  `settlement_date` date NOT NULL,
  `required_support` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `problem_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem`
--

LOCK TABLES `problem` WRITE;
/*!40000 ALTER TABLE `problem` DISABLE KEYS */;
/*!40000 ALTER TABLE `problem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` text NOT NULL,
  `address` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','admin@fixl.com','$2y$12$XpBgMvQ5JzfvN3PTgf/tA.XwxbCOs3mO0a10oP9/11qi1NUpv46.u','admin@fixl.com',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1579600224,1,'Admin','istrator','081342989185','USER_1_1578564541.png','admin'),(13,'::1','admin@admin.com','$2y$10$L5hzKcil32fXqus1bnBuNuxLrWq/6cOU8q1o0E2ahM6iddz4Wio06','admin@admin.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1568678256,1580649061,1,'admin','emoncikar','00','USER_13_1578989096.png','jln mutiara no 8'),(16,'182.1.161.232','dinaspu@gmail.com','$2y$10$/c33Qt8mOh96DVZF0vuZvOkawyKMz7ZjvX2KS1GFh8cZd4h6jT3vG','dinaspu@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1579600546,1580393051,1,'alan','.','12','default.jpg','alamat');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1,1,1),(29,13,2),(32,16,3);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-10 15:18:45
