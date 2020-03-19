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
  `no_contract` varchar(200) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `duration` varchar(200) NOT NULL,
  `no_news` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nomenclature_id` (`nomenclature_id`),
  KEY `pptk_id` (`pptk_id`),
  CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`nomenclature_id`) REFERENCES `nomenclature` (`id`),
  CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`pptk_id`) REFERENCES `pptk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (7,6,'F','AU','Pembangunan Broncaptering Kap. 1 L/det SPAM Pulau Hoga mendukung Kawasan Khusus Wisata Pulau Hoga, Kab. Wakatobi','Wakatobi',50,'L/d',5000000,5000000,0,2020,5,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(8,3,'F','AU','Peningkatan kualitas Perumahan Kumuh dan permukiman kumuh','KOTA KENDARI',38,'Hektar',40000000,40000000,0,2020,5,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(9,3,'F','AU','atan Kualitas Permukiman Kumuh Kawasan Pongo Kec. Wangi-wangi Selatan Kab. Wakatobi',' WAKATOBI',19.32,'Hektar',10000000,10000000,0,2020,6,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','','Selesai'),(10,3,'F','AU','Peningkatan Kualitas Permukiman Kumuh Kawasan Laiworu Kec. Batalaiworu Kabupaten Muna','MUNA ',27.88,'Hektar',31000000,31000000,0,2020,5,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(11,6,'F','AU','Pembangunan Broncaptering Kap. 1 L/det SPAM Pulau Hoga mendukung Kawasan Khusus Wisata Pulau Hoga, Kab. Wakatobi','WAKATOBI ',1,'Liter/detik',7000000,7000000,0,2020,7,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(12,6,'F','AU','Pembangunan IKK Kecamatan Lambai','KOLAKA UTARA',20,'Liter/detik',15635000,15635000,0,2020,6,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(13,6,'F','AU','Pembangunan SPAM Ibu Kota Kabupaten Buton Tengah 55 l/s','BUTON TENGAH',55,'Liter/detik',30000000,30000000,0,2020,5,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(14,6,'F','AU','Pembangunan SPAM IKK Matausu',' BOMBANA ',5,'Liter/detik',10051422,10051422,0,2020,5,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(15,5,'AU','AU','Ranperda Penyehatan Lingkungan Permukiman Kab. Buton Selatan','BUTON SELATAN',1,'KAB/KOTA',500000,500000,0,2020,6,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(16,5,'F','AU','Pembangunan PS Air Limbah Skala Kawasan Permukiman Tradisional','KOTA BAUBAU ',1000,'KK',5000000,5000000,0,2020,7,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(17,4,'F','AU','Penataan Kawasan Permukiman Budaya Kampung Liya, Tomia Timur, Lamanggu, Kawasan Wali,Popalia, Taipabu','WAKATOBI',42,'M2',72500000,72500000,0,2020,6,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(18,6,'F','AU','pembangunan jaringan perpipaan PAM Kota Kendari','Kota Kendari',4000,'SR',22500000,22500000,0,2020,5,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','','','','',''),(19,3,'F','AU','Administrasi Umum Satker PLP','KOTA KENDARI',4,'KAB/KOTA',200000,200000,0,2020,5,'0','0','default.jpg;default.jpg;default.jpg;default.jpg;default.jpg','a102 199','technoindo','11 bulan','technoindo','Lelang');
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
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget`
--

LOCK TABLES `budget` WRITE;
/*!40000 ALTER TABLE `budget` DISABLE KEYS */;
INSERT INTO `budget` VALUES (28,7,1000000,2,2020,0,0),(29,7,3000000,4,2020,0,0),(30,7,1000000,6,2020,0,0),(31,7,1500000,2,2020,0,1),(32,8,10000000,2,2020,0,0),(33,8,10000000,3,2020,0,0),(34,8,10000000,5,2020,0,0),(35,8,10000000,6,2020,0,0),(41,10,3000000,3,2020,0,0),(42,10,3000000,4,2020,0,0),(43,10,3000000,5,2020,0,0),(44,10,20000000,6,2020,0,0),(45,10,2000000,7,2020,0,0),(46,11,3000000,2,2020,0,0),(47,11,3000000,3,2020,0,0),(48,11,1000000,4,2020,0,0),(49,12,635000,3,2020,0,0),(50,12,5000000,4,2020,0,0),(51,12,5000000,5,2020,0,0),(52,12,5000000,6,2020,0,0),(53,13,10000000,3,2020,0,0),(54,13,10000000,4,2020,0,0),(55,13,10000000,5,2020,0,0),(56,14,51422,3,2020,0,0),(57,14,4000000,4,2020,0,0),(58,14,4000000,5,2020,0,0),(59,14,2000000,6,2020,0,0),(60,15,200000,3,2020,0,0),(61,15,300000,4,2020,0,0),(62,16,1000000,3,2020,0,0),(63,16,2000000,4,2020,0,0),(64,16,2000000,5,2020,0,0),(65,17,2500000,3,2020,0,0),(66,17,30000000,4,2020,0,0),(67,17,30000000,5,2020,0,0),(68,17,10000000,6,2020,0,0),(69,18,500000,3,2020,0,0),(70,18,2000000,4,2020,0,0),(71,18,20000000,5,2020,0,0),(72,8,10000000,2,2020,0,1),(84,9,2000000,3,2020,0,0),(85,9,2000000,4,2020,0,0),(86,9,2000000,5,2020,0,0),(87,9,2000000,6,2020,0,0),(88,9,2000000,7,2020,0,0),(89,19,200000,2,2020,0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `physical`
--

LOCK TABLES `physical` WRITE;
/*!40000 ALTER TABLE `physical` DISABLE KEYS */;
INSERT INTO `physical` VALUES (23,7,30,2,2020,0),(24,7,40,4,2020,0),(25,7,30,6,2020,0),(26,7,30,2,2020,1),(27,8,20,2,2020,0),(28,8,30,3,2020,0),(29,8,30,5,2020,0),(30,8,20,6,2020,0),(36,10,30,3,2020,0),(37,10,20,4,2020,0),(38,10,20,5,2020,0),(39,10,20,6,2020,0),(40,10,10,7,2020,0),(41,11,40,2,2020,0),(42,11,40,3,2020,0),(43,11,20,4,2020,0),(44,12,20,3,2020,0),(45,12,40,4,2020,0),(46,12,30,5,2020,0),(47,12,10,6,2020,0),(48,13,40,3,2020,0),(49,13,30,4,2020,0),(50,13,30,5,2020,0),(51,14,30,3,2020,0),(52,14,40,4,2020,0),(53,14,20,5,2020,0),(54,14,10,6,2020,0),(55,15,40,3,2020,0),(56,15,60,4,2020,0),(57,16,30,3,2020,0),(58,16,20,4,2020,0),(59,16,50,5,2020,0),(60,17,20,3,2020,0),(61,17,30,4,2020,0),(62,17,30,5,2020,0),(63,17,20,6,2020,0),(64,18,30,3,2020,0),(65,18,40,4,2020,0),(66,18,30,5,2020,0),(67,8,30,2,2020,1),(79,9,20,3,2020,0),(80,9,20,4,2020,0),(81,9,20,5,2020,0),(82,9,20,6,2020,0),(83,9,20,7,2020,0),(84,19,100,2,2020,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pptk`
--

LOCK TABLES `pptk` WRITE;
/*!40000 ALTER TABLE `pptk` DISABLE KEYS */;
INSERT INTO `pptk` VALUES (5,'Oksy Lepong Bulan, S.Ars','Randal Cipta Karya'),(6,'Eka Firmansyah T., ST, M. Eng','-'),(7,'Eulisa, ST','-');
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
INSERT INTO `users` VALUES (1,'127.0.0.1','admin@fixl.com','$2y$12$XpBgMvQ5JzfvN3PTgf/tA.XwxbCOs3mO0a10oP9/11qi1NUpv46.u','admin@fixl.com',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1579600224,1,'Admin','istrator','081342989185','USER_1_1578564541.png','admin'),(13,'::1','admin@admin.com','$2y$10$L5hzKcil32fXqus1bnBuNuxLrWq/6cOU8q1o0E2ahM6iddz4Wio06','admin@admin.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1568678256,1584614949,1,'ADMIN','ECIKAR','081144556677','USER_13_1581350650.png','jln mutiara no 8'),(16,'182.1.161.232','dinaspu@gmail.com','$2y$10$2JSpBKh5W1m6a7R1qx3E3Oq5uX3N2kSLXjOU1PR/CmR1JRcMzlE4G','dinaspu@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1579600546,1584622455,1,'user','.','12','default.jpg','alamat');
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

-- Dump completed on 2020-03-19 21:00:21
