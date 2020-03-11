-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: yabo_bank
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.16.04.1

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
-- Table structure for table `cash_flows`
--

DROP TABLE IF EXISTS `cash_flows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_flows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `nominal` double NOT NULL,
  `resource_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_flows`
--

LOCK TABLES `cash_flows` WRITE;
/*!40000 ALTER TABLE `cash_flows` DISABLE KEYS */;
INSERT INTO `cash_flows` VALUES (59,'2020-02-04','withdrawal to customer Customer_1580777465',1,5000,'MUTATION_02202000005','App\\Model\\Mutation',5,NULL,NULL),(60,'2020-02-04','withdrawal to customer Customer_1580777465',1,200000,'MUTATION_02202000010','App\\Model\\Mutation',10,NULL,NULL),(61,'2020-02-08','Penarikan ',1,1000000,'MUTATION_02202000017','App\\Model\\Mutation',17,NULL,NULL),(62,'2020-02-09','Penarikan ',1,1000,'MUTATION_02202000022','App\\Model\\Mutation',22,NULL,NULL),(63,'2020-02-10','Penarikan ',1,1500000,'MUTATION_02202000027','App\\Model\\Mutation',27,NULL,NULL),(64,'2020-02-04','payment from KARYA AGUNG REALITI',2,35000000,'PAYMENT_02202000001','App\\Model\\Payment',1,NULL,NULL),(65,'2020-02-06','payment from KARYA AGUNG REALITI',2,7742035,'PAYMENT_02202000002','App\\Model\\Payment',2,NULL,NULL),(66,'2020-02-12','payment from KARYA AGUNG REALITI',2,35000000,'PAYMENT_02202000003','App\\Model\\Payment',3,NULL,NULL),(67,'2020-02-07','payment from KARYA AGUNG REALITI',2,3000000,'PAYMENT_02202000004','App\\Model\\Payment',4,NULL,NULL),(68,'2020-02-09','payment from KARYA AGUNG REALITI',2,935035,'PAYMENT_02202000005','App\\Model\\Payment',5,NULL,NULL),(69,'2020-02-06','Biaya Ekspedisi 682378(9)4561 / 8762 MJ',1,10500000,'','App\\Model\\CashOut',1,NULL,NULL),(70,'2020-02-06','Biaya Ekspedisi 682378(9)4561 / 8762 MJ',1,10500000,'CASH_OUT_02202000002','App\\Model\\CashOut',2,NULL,NULL);
/*!40000 ALTER TABLE `cash_flows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_outs`
--

DROP TABLE IF EXISTS `cash_outs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_outs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` double NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_outs`
--

LOCK TABLES `cash_outs` WRITE;
/*!40000 ALTER TABLE `cash_outs` DISABLE KEYS */;
INSERT INTO `cash_outs` VALUES (1,'','Biaya Ekspedisi 682378(9)4561 / 8762 MJ',10500000,'2020-02-06','2020-02-06 06:16:30','2020-02-06 06:16:30'),(2,'CASH_OUT_02202000002','Biaya Ekspedisi 682378(9)4561 / 8762 MJ',10500000,'2020-02-06','2020-02-06 15:55:47','2020-02-06 15:55:47');
/*!40000 ALTER TABLE `cash_outs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_photo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (17,'Customer_1580777465','IDENTITY_1580778104.JPG','2020-02-04 00:51:19','2020-02-04 01:01:44'),(18,'Customer_1581146345','default.jpg','2020-02-08 07:19:05','2020-02-08 07:19:05'),(19,'Customer_1581146506','IDENTITY_1581342167.png','2020-02-08 07:21:46','2020-02-10 13:42:47'),(20,'Customer_1581146746','default.jpg','2020-02-08 07:25:46','2020-02-08 07:25:46'),(21,'Customer_1581146791','default.jpg','2020-02-08 07:26:31','2020-02-08 07:26:31'),(22,'Customer_1581225253','IDENTITY_1581226022.png','2020-02-09 05:14:13','2020-02-09 05:27:02'),(23,'Customer_1581335128','IDENTITY_1581335773.png','2020-02-10 11:45:28','2020-02-10 11:56:13'),(24,'Customer_1581344286','IDENTITY_1581344358.png','2020-02-10 14:18:06','2020-02-10 14:19:18'),(25,'Customer_1581512016','IDENTITY_1581522839.png','2020-02-12 12:53:36','2020-02-12 15:53:59');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drivers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (1,'Driver_1580778321','2020-02-04 01:05:32','2020-02-04 01:05:32');
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `selling_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,2,'INVOICE_02202000001','2020-02-04','2020-02-05','2020-02-04 05:53:06','2020-02-04 05:53:06'),(2,3,'INVOICE_02202000002','2020-02-04','2020-02-05','2020-02-04 08:49:34','2020-02-04 08:49:34');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
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
  `link` varchar(100) NOT NULL,
  `list_id` varchar(200) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `position` int(4) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (16,1,'Beranda','s-admin','s-admin','home',1,1,'-'),(21,1,'Menus','menus','menus','bars',1,1,'-'),(22,1,'Role','roles','roles','user',1,1,'-'),(23,1,'Users','users','users','users',1,1,'-'),(24,2,'Beranda','home','home','home',1,0,'Beranda'),(25,2,'Users','users','users','users',0,100,'users'),(26,2,'Price List','pricelists','pricelists','credit-card',1,0,'pricelist'),(27,2,'Customer','customers','customers','users',1,1,'customers'),(28,2,'Driver','drivers','drivers','users',1,1,'drivers'),(29,2,'LAPORAN','header','home','home',1,1,'LAPORAN'),(30,2,'Kas Keluar','cash_outs','cash_outs','share-square',1,3,'outcome'),(31,2,'Penjualan','sellings','sellings','shopping-cart',1,1,'selling'),(32,2,'Daftar Pembayaran','payments','payments','file',1,1,'invoice'),(33,14,'Beranda','home','home','home',1,1,'home'),(34,14,'Penjemputan','requests','requests','truck',0,1,'requests'),(35,14,'Penjemputan Sampah','pickups','pickups','truck',1,1,'pickups'),(36,13,'Beranda','home','home','home',1,1,'home'),(37,13,'Request Penjemputan','requests','requests','truck',1,1,'requests'),(38,13,'Penjemputan di Terima','pickups','pickups','truck',1,1,'pickups'),(39,13,'Mutasi','mutations','mutations','credit-card',1,1,'mutations'),(40,14,'Transaksi','transactions','transactions','credit-card',1,1,'transactions'),(41,2,'Penjemputan','requests','reque','truck',1,0,'truck'),(42,41,'Request Masuk','requests','requests','truck',1,1,'requests'),(43,41,'Request Diproses','pickups','pickups','truck',1,1,'-'),(44,2,'Proses Data','reports','reports','file-excel',1,4,'reports');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (61,'2014_10_12_000000_create_users_table',1),(62,'2014_10_12_100000_create_password_resets_table',1),(63,'2020_01_07_171747_create_roles_table',1),(64,'2020_01_07_171850_create_user_roles_table',1),(65,'2020_01_09_025853_create_menus_table',2),(66,'2020_01_11_160655_create_price_lists_table',2),(67,'2020_01_14_055213_create_pick_ups_table',3),(68,'2020_01_14_122148_create_customers_table',3),(69,'2020_01_14_122335_create_drivers_table',3),(70,'2020_01_14_130918_create_requests_table',3),(71,'2020_01_17_054513_create_transactions_table',4),(72,'2020_01_17_055152_create_mutations_table',4),(73,'2016_06_01_000001_create_oauth_auth_codes_table',5),(74,'2016_06_01_000002_create_oauth_access_tokens_table',5),(75,'2016_06_01_000003_create_oauth_refresh_tokens_table',5),(76,'2016_06_01_000004_create_oauth_clients_table',5),(77,'2016_06_01_000005_create_oauth_personal_access_clients_table',5),(78,'2020_02_02_185310_create_sellings_table',6),(79,'2020_02_03_110012_create_cash_outs_table',7),(80,'2020_02_04_124806_create_invoices_table',8),(81,'2020_02_04_144516_create_payments_table',9),(82,'2020_02_06_230009_create_cash_flows_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mutations`
--

DROP TABLE IF EXISTS `mutations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mutations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `transaction_id` int(10) unsigned DEFAULT NULL,
  `nominal` double NOT NULL,
  `position` tinyint(4) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mutations`
--

LOCK TABLES `mutations` WRITE;
/*!40000 ALTER TABLE `mutations` DISABLE KEYS */;
INSERT INTO `mutations` VALUES (1,'',17,0,0,2,'initial','2020-02-04 00:51:19','2020-02-04 00:51:19'),(4,'MUTATION_02202000002',17,2,10000,2,'transaction to customer Customer_1580777465: plastik,1000,kg,qty:10driver:c','2020-02-04 02:45:27','2020-02-04 02:45:27'),(5,'MUTATION_02202000005',17,0,5000,1,'withdrawal to customer Customer_1580777465','2020-02-04 02:47:48','2020-02-04 02:47:48'),(6,'MUTATION_02202000006',17,3,2000,2,'transaction to customer Customer_1580777465: plastik,1000,kg,qty:2driver:c','2020-02-04 09:37:34','2020-02-04 09:37:34'),(7,'MUTATION_02202000007',17,4,170000,2,'transaction to customer Customer_1580777465: Besi,5000,kg,qty:34driver:c','2020-02-04 09:37:34','2020-02-04 09:37:34'),(8,'MUTATION_02202000007',17,5,28000,2,'transaction to customer Customer_1580777465: Kardus,4000,kg,qty:7driver:c','2020-02-04 09:37:34','2020-02-04 09:37:34'),(9,'MUTATION_02202000007',17,6,20000,2,'transaction to customer Customer_1580777465: plastik,1000,kg,qty:20driver:c','2020-02-04 13:18:49','2020-02-04 13:18:49'),(10,'MUTATION_02202000010',17,0,200000,1,'withdrawal to customer Customer_1580777465','2020-02-04 13:19:34','2020-02-04 13:19:34'),(11,'MUTATION_02202000011',17,7,500000,2,'direct transaction to customer Customer_1580777465: plastik,1000,kg,qty:500','2020-02-08 06:41:24','2020-02-08 06:41:24'),(12,'MUTATION_02202000012',20,0,0,2,'initial','2020-02-08 07:25:46','2020-02-08 07:25:46'),(13,'MUTATION_02202000013',21,0,0,2,'initial','2020-02-08 07:26:31','2020-02-08 07:26:31'),(14,'MUTATION_02202000014',21,8,1000000,2,'direct transaction to customer Customer_1581146791: plastik,1000,kg,qty:1000','2020-02-08 07:29:00','2020-02-08 07:29:00'),(15,'MUTATION_02202000015',21,9,5000000,2,'transaction to customer Customer_1581146791: plastik,1000,kg,qty:5000driver:Caca Handika','2020-02-08 08:35:24','2020-02-08 08:35:24'),(16,'MUTATION_02202000016',21,10,100000,2,'direct transaction to customer Customer_1581146791: plastik,1000,kg,qty:100','2020-02-08 08:37:21','2020-02-08 08:37:21'),(17,'MUTATION_02202000017',21,0,1000000,1,'Penarikan ','2020-02-08 08:41:43','2020-02-08 08:41:43'),(18,'MUTATION_02202000018',21,11,1000,2,'Transaksi Langsung plastik (1000 / kg) , qty:1','2020-02-08 08:44:16','2020-02-08 08:44:16'),(19,'MUTATION_02202000019',21,12,5000,2,'Transaksi : plastik (1000 / kg) , qty:5, Driver : Caca Handika','2020-02-08 08:45:15','2020-02-08 08:45:15'),(20,'MUTATION_02202000020',19,13,10000,2,'Transaksi : Besi (5000 / kg) , qty:2, Driver : Caca Handika','2020-02-09 03:58:34','2020-02-09 03:58:34'),(21,'MUTATION_02202000021',20,14,150000,2,'Transaksi : Besi (5000 / kg) , qty:30, Driver : Caca Handika','2020-02-09 04:29:00','2020-02-09 04:29:00'),(22,'MUTATION_02202000022',19,0,1000,1,'Penarikan ','2020-02-09 04:44:12','2020-02-09 04:44:12'),(23,'MUTATION_02202000023',19,15,399000,2,'Transaksi : plastik (1000 / kg) , qty:399, Driver : Caca Handika','2020-02-09 05:06:55','2020-02-09 05:06:55'),(24,'MUTATION_02202000024',22,0,0,2,'initial','2020-02-09 05:14:13','2020-02-09 05:14:13'),(25,'MUTATION_02202000025',22,16,2500000,2,'Transaksi : Besi (5000 / kg) , qty:500, Driver : Caca Handika','2020-02-09 05:17:36','2020-02-09 05:17:36'),(26,'MUTATION_02202000026',22,17,500000,2,'Transaksi : Besi (5000 / kg) , qty:100, Driver : Caca Handika','2020-02-10 09:13:20','2020-02-10 09:13:20'),(27,'MUTATION_02202000027',22,0,1500000,1,'Penarikan ','2020-02-10 09:14:12','2020-02-10 09:14:12'),(28,'MUTATION_02202000028',23,0,0,2,'initial','2020-02-10 11:45:28','2020-02-10 11:45:28'),(29,'MUTATION_02202000029',24,0,0,2,'initial','2020-02-10 14:18:06','2020-02-10 14:18:06'),(30,'MUTATION_02202000030',25,0,0,2,'initial','2020-02-12 12:53:36','2020-02-12 12:53:36'),(31,'MUTATION_02202000031',19,18,6000,2,'Transaksi : plastik (1000 / kg) , qty:6, Driver : Caca Handika','2020-02-12 14:20:04','2020-02-12 14:20:04');
/*!40000 ALTER TABLE `mutations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('06c428488a658c89140b098663fe1c4082acf78b6ae24ecf14f8b7f71f9912f075847a1a37b0f76c',34,1,'YABO_BANK','[]',0,'2020-01-30 09:18:25','2020-01-30 09:18:25','2021-01-30 17:18:25'),('081f86630aa326ecd3c899e9d9d9f6f3ff8dfdfa2c7adf64e94662bcf0c9ff151ac9a3ecdf1139d5',43,1,'YABO_BANK','[]',1,'2020-01-29 21:53:45','2020-01-29 21:53:45','2021-01-30 05:53:45'),('086e9be785c2120f7906c4a24e2dcd20126819d0f6166e71e31306d9f9da04d31dd020534dbc46ee',31,1,'YABO_BANK','[]',1,'2020-01-26 00:20:35','2020-01-26 00:20:35','2021-01-26 08:20:35'),('09bde23622cdc04f8515686d58d472f55a0b8c1ce43c0c2d686aa34abdf1873ed97bb23b931d0531',31,1,'YABO_BANK','[]',0,'2020-01-25 05:13:27','2020-01-25 05:13:27','2021-01-25 13:13:27'),('14362357742075bcf0b434d5054040ff8c7f2ca6aa4a21ca6960f1b9c24a2d4d4d388e8c5c24f62e',31,1,'YABO_BANK','[]',0,'2020-01-25 10:07:27','2020-01-25 10:07:27','2021-01-25 18:07:27'),('1492299dbe9a47503c99ba3fa89c00ca81c337fc2d7136f7e8c18b646064fa82ea0a824012fcfcf3',31,1,'YABO_BANK','[]',1,'2020-01-27 06:33:44','2020-01-27 06:33:44','2021-01-27 14:33:44'),('16662620af8d0038aaee2730a791ce653c18df84e05ad289d6defeb1654c99668caf90c09ff87284',31,1,'YABO_BANK','[]',0,'2020-01-28 03:14:45','2020-01-28 03:14:45','2021-01-28 11:14:45'),('1b217045c590367a4f56154cbfc00545ec7e48c5d85c1f16c62d693bcb62aa3dcee8ecdde72142d5',34,1,'YABO_BANK','[]',0,'2020-01-23 07:25:29','2020-01-23 07:25:29','2021-01-23 15:25:29'),('1c39494c8dcf1c716e8ec751c024d00582721b5992fd2b4aed01c8450546f978f71011d520d5f675',49,3,'YABO_BANK','[]',1,'2020-02-09 03:08:30','2020-02-09 03:08:30','2021-02-09 11:08:30'),('1fe8f3ea79f50fc5147049077a05d676488411808338a9fa67acb277a47a6030a573735fb9a38284',34,1,'YABO_BANK','[]',0,'2020-01-25 04:19:21','2020-01-25 04:19:21','2021-01-25 12:19:21'),('20696d709c020a6dc31e4bf5dc07e6e7d6cbd565d69323e3af2f3b2fb540d9657a087ea39ba2fcf4',31,1,'YABO_BANK','[]',0,'2020-01-25 23:50:42','2020-01-25 23:50:42','2021-01-26 07:50:42'),('23f15d6c158c13d02b96941dec8b3024cc6ca42d372c99aa260a8bec2811a667d33a4fcda3a5076f',34,1,'YABO_BANK','[]',0,'2020-01-31 04:49:13','2020-01-31 04:49:13','2021-01-31 12:49:13'),('27882074645779f1e5ead6f29b0efb15dfc3c77318b3e01465f81d82ddad60319472f9f34af4183f',31,1,'YABO_BANK','[]',1,'2020-01-23 00:37:41','2020-01-23 00:37:41','2021-01-23 08:37:41'),('27ec4083676b85fe2f21030be6f560e4acc60aef543d126788d151b74aac268971077895b0679c91',51,3,'YABO_BANK','[]',1,'2020-02-08 07:29:17','2020-02-08 07:29:17','2021-02-08 15:29:17'),('27fabc5dc4e7be1701e1562b325995b161e690052f42fc29dfdb7453f337837140902be9cde2fe24',31,1,'YABO_BANK','[]',1,'2020-01-29 21:04:43','2020-01-29 21:04:43','2021-01-30 05:04:43'),('2b025be5ae8f30268208ff5e792f18fc75d96bcb25786965980ab3a63df62ecfed02df2e2fae4f09',31,1,'YABO_BANK','[]',1,'2020-01-27 06:14:39','2020-01-27 06:14:39','2021-01-27 14:14:39'),('2c2209ff32914085284d7282772120c5308cf20aaee9d475f39c1dd161dd4403c4096fb64b31a948',31,1,'YABO_BANK','[]',0,'2020-01-31 07:16:00','2020-01-31 07:16:00','2021-01-31 15:16:00'),('2ce48e7938af84895e28e7bf240f4f4af5868198cc483c864cd35d07a14013ff72654341a2fb25a5',31,1,'YABO_BANK','[]',0,'2020-01-29 22:50:58','2020-01-29 22:50:58','2021-01-30 06:50:58'),('309b7f649f8cfe5a6b0f7651b8c4adf45a2f98ea1ad18ac39bbdc33ad2b73f1a9fc00a83d226d66e',31,1,'YABO_BANK','[]',1,'2020-01-30 00:04:29','2020-01-30 00:04:29','2021-01-30 08:04:29'),('3248a97ad04da9f27daa5e4128cb8219496fb389b2fc853beb560fa048bec6e13bde4b1015a26b39',31,1,'YABO_BANK','[]',1,'2020-01-29 04:02:57','2020-01-29 04:02:57','2021-01-29 12:02:57'),('32b2127a96c077989abfe3f2b089a99814c102a8e10851c7ed79d95095c798d6b3080fd4cefa1084',42,1,'YABO_BANK','[]',0,'2020-01-25 23:45:18','2020-01-25 23:45:18','2021-01-26 07:45:18'),('3891d17bbc8350a36536ca9549b7b24c945ad2f87902fcc154c7344e9a5c2f12777ca68de70ccc9f',45,1,'YABO_BANK','[]',0,'2020-01-30 00:05:16','2020-01-30 00:05:16','2021-01-30 08:05:16'),('3a5892679f85fffa17c425317856982b4933b41d2810b09e21b9fdeb7de64f3e9bb4892d68dd3c20',43,1,'YABO_BANK','[]',1,'2020-01-25 23:59:40','2020-01-25 23:59:40','2021-01-26 07:59:40'),('3c3ab8f9cf049019f1352a74e371a908e0c72c8001318bf0d69c810e2f0cf1ceafe671bd2eef1abd',49,3,'YABO_BANK','[]',1,'2020-02-08 13:49:37','2020-02-08 13:49:37','2021-02-08 21:49:37'),('47b82f89c2cb3c052bb144482ff7dc7d7307d48be486f46cee2397180a73105401531a4429ff23a0',47,3,'YABO_BANK','[]',0,'2020-02-10 14:31:45','2020-02-10 14:31:45','2021-02-10 22:31:45'),('48eff2c1f5fff8edcf2632ff3efabe1fcc5cf089f0efb7a16908f0c06e7f490ea46bae5e680d5bc6',52,3,'YABO_BANK','[]',0,'2020-02-09 05:14:13','2020-02-09 05:14:13','2021-02-09 13:14:13'),('49914c1967fdc8ef26de9b3d181d739dba73c561b688087db73d1da6d8b1a727eb89d79d1735a151',31,1,'YABO_BANK','[]',1,'2020-01-23 00:22:50','2020-01-23 00:22:50','2021-01-23 08:22:50'),('5045649b2f1194061d956b951fc0e6f72b5e17d73318238d5cdcd4d69b2462eb79e12902740dcdf3',51,3,'YABO_BANK','[]',1,'2020-02-08 07:26:31','2020-02-08 07:26:31','2021-02-08 15:26:31'),('5067781a622d7b3c0f7f58195ef09694fab7735cee327247bee0c38a6aa53f04c791c0aa32fd7d20',34,1,'YABO_BANK','[]',0,'2020-01-31 04:06:21','2020-01-31 04:06:21','2021-01-31 12:06:21'),('5128ca8e9f8687378ceb4158b4ce56a28af38651360b18bc8ec20665bdbb5f9477847cd3920d9a5c',49,3,'YABO_BANK','[]',1,'2020-02-09 05:09:40','2020-02-09 05:09:40','2021-02-09 13:09:40'),('55c07a487fa634f40c84820976a09f85314f3cad57d71d90c61d6a1f994b0ae38b3320bbe18e888a',31,1,'YABO_BANK','[]',0,'2020-01-29 20:04:10','2020-01-29 20:04:10','2021-01-30 04:04:10'),('586ca2ca8f3b702803cca3f2d5c357f289ca1d10e3034b8c54447c232261d474db42659a13dcf4f5',44,1,'YABO_BANK','[]',0,'2020-01-26 00:00:03','2020-01-26 00:00:03','2021-01-26 08:00:03'),('58c00bf743cbb457e63056a15e43abeaa0bdd5778fc9119fde5bb57fb3812be2ed9e572244934d1b',31,1,'YABO_BANK','[]',0,'2020-01-23 06:55:23','2020-01-23 06:55:23','2021-01-23 14:55:23'),('59c1b047ac43fc3d13f3e8393f5d522d7c567472d296745aac27dd03940ab8eefc4cc8d68a01e59d',49,3,'YABO_BANK','[]',0,'2020-02-10 09:55:22','2020-02-10 09:55:22','2021-02-10 17:55:22'),('5ced80668e7f93bd7e6818b27c4f2169debb8e70c397ab004937078cc21a442fd3c2d891eb5f55cf',31,1,'YABO_BANK','[]',1,'2020-01-29 05:30:50','2020-01-29 05:30:50','2021-01-29 13:30:50'),('5d7c5aa05b6c676f4bbb0d2512f1ccbce631dce5fe36ff714ac7f0a78cadd78bde4e3198b571d32a',43,1,'YABO_BANK','[]',1,'2020-01-29 21:04:24','2020-01-29 21:04:24','2021-01-30 05:04:24'),('5e81f433223758e08e072613e115fd8449ce4a1c5034c7e064a55a2d126344849c8f99700745015d',34,1,'YABO_BANK','[]',0,'2020-01-30 08:38:54','2020-01-30 08:38:54','2021-01-30 16:38:54'),('6004f4412e119c516165a992e59662fd0c50ba8effa2539f7bf354bd96ac1d8e5cb59be7c26ee9a7',53,3,'YABO_BANK','[]',1,'2020-02-10 11:45:28','2020-02-10 11:45:28','2021-02-10 19:45:28'),('6588478869941d23d4374cbc6782af91a3118f059520f88b932f8971c45147ce48884d976ca27464',31,1,'YABO_BANK','[]',1,'2020-01-29 23:59:53','2020-01-29 23:59:53','2021-01-30 07:59:53'),('6a9a11a7792154947b379df7457a7f58cf0c850fb0ffd2660c4b0c992f5d12492cec5b00452914da',54,3,'YABO_BANK','[]',1,'2020-02-10 14:18:06','2020-02-10 14:18:06','2021-02-10 22:18:06'),('6b751e768274ffd212bf3875884eee2c21fdcbf31fdfe34e4f1738078294ee0fdc8d6035e3525de4',43,1,'YABO_BANK','[]',0,'2020-01-29 23:40:15','2020-01-29 23:40:15','2021-01-30 07:40:15'),('6d08587e11c296a2e001e2b90a97756b3ea101cb253fb2dede6da05e09058c5f0907d37f8ada86db',43,1,'YABO_BANK','[]',1,'2020-01-29 21:41:53','2020-01-29 21:41:53','2021-01-30 05:41:53'),('72bd6bf14e7cb9bfcb55b7b89cdf7bf23e2ecc0e02bbd5c38475463bc7f2e6861491b05ce27e0bee',31,1,'YABO_BANK','[]',1,'2020-01-25 10:17:02','2020-01-25 10:17:02','2021-01-25 18:17:02'),('75583c235ea48f9497f178a82574bf0ec2892f4d53f6e93c45c9f76f731da63943e02da46d1b1854',49,3,'YABO_BANK','[]',1,'2020-02-12 06:02:41','2020-02-12 06:02:41','2021-02-12 14:02:41'),('771ad907e916b63b3e910c9044cfba78d390fae26f7071e6126231050aec51358fba01a6f92e01e0',47,3,'YABO_BANK','[]',0,'2020-02-09 05:17:14','2020-02-09 05:17:14','2021-02-09 13:17:14'),('789e4c774cf343bf4c0899d183bc993652f4a8c534eaf85f09592fedf365c3a1568e4fb5833fcfcf',53,3,'YABO_BANK','[]',0,'2020-02-12 14:17:19','2020-02-12 14:17:19','2021-02-12 22:17:19'),('78a02a47ff6c33067d61623643c1ee4e1a6eeddfd866a7ca43e6f08cf072a0e06c93c4c16bfd4c95',49,3,'YABO_BANK','[]',0,'2020-02-10 14:24:30','2020-02-10 14:24:30','2021-02-10 22:24:30'),('78cc901daa511e8927f476eeb3aad72347280df5d9b6e15462e74f61ca4b5e40fd5ff60832d74515',31,1,'YABO_BANK','[]',1,'2020-01-27 06:15:52','2020-01-27 06:15:52','2021-01-27 14:15:52'),('7c7f94e271069dd7869dbd88ad55394724af173eb0f39cdc0a62101440048f6a959665991618de99',46,3,'YABO_BANK','[]',1,'2020-02-08 07:17:50','2020-02-08 07:17:50','2021-02-08 15:17:50'),('7f1550baabee3228ab0c418485993be0759b57bb205b613c135b8d274a338a50cf0147dbdfaa0690',34,1,'YABO_BANK','[]',0,'2020-01-25 04:14:06','2020-01-25 04:14:06','2021-01-25 12:14:06'),('84647e62f01f9cf35311a284aecfb671e8612c3cdd4bddd0a7e30260d13cc93123cc3f0390d31545',34,1,'YABO_BANK','[]',0,'2020-01-25 03:28:59','2020-01-25 03:28:59','2021-01-25 11:28:59'),('84df74a4f5acaffbcc8237f7d7e063be5353d051fe7722b55b265613ed2ae2fea000f5b1e1cf6789',31,1,'YABO_BANK','[]',0,'2020-01-29 03:23:48','2020-01-29 03:23:48','2021-01-29 11:23:48'),('876e4b5dc318e2d1281abfdbd83ee4180c7423b173da424948ba78abcffc73be665cd7c955f27fa3',34,1,'YABO_BANK','[]',0,'2020-01-23 05:09:54','2020-01-23 05:09:54','2021-01-23 13:09:54'),('8bff8c0d86fd984aed6bf462b8745fa3e9b361e2671a0380d72f89cb7b8f66efc291b648d4868d28',34,1,'YABO_BANK','[]',0,'2020-01-25 04:11:22','2020-01-25 04:11:22','2021-01-25 12:11:22'),('8fd3641a9d2089ffa97e81b29cb65d2dc39b36c656dba08a9f21d1899b3a4dcde31fd9a617b3b4f7',31,1,'YABO_BANK','[]',0,'2020-01-25 05:40:07','2020-01-25 05:40:07','2021-01-25 13:40:07'),('90e32d80f40fdbe0b615aa10bad9cfeecc9a544654904a3124e2f77572ffee41fe3f247897369254',34,1,'YABO_BANK','[]',0,'2020-01-25 04:22:34','2020-01-25 04:22:34','2021-01-25 12:22:34'),('944192e8054ed09b3e07cc7be9b34c18e7f1105406f0fe101f6e74caaa6b0adbc36218f443d45ed1',53,3,'YABO_BANK','[]',0,'2020-02-13 11:51:43','2020-02-13 11:51:43','2021-02-13 19:51:43'),('95431d7dfa8cb82f3903947857a0d9781b62b210e00a2f78dd3d606c233468cc2828fee078106387',31,1,'YABO_BANK','[]',1,'2020-01-25 10:18:03','2020-01-25 10:18:03','2021-01-25 18:18:03'),('969a872d1f24dc0fc590b323c2022225ab4b48a474e88019b66ab5ed57493da46b9a12eee8b8c63d',43,1,'YABO_BANK','[]',1,'2020-01-26 06:09:20','2020-01-26 06:09:20','2021-01-26 14:09:20'),('9a5ea65540aff00f90150a295e2de86c0ee11529d20fd41e1dd1893670ebaaa5fc9b2a68e5ed5bd7',34,1,'YABO_BANK','[]',0,'2020-01-25 04:31:15','2020-01-25 04:31:15','2021-01-25 12:31:15'),('9b38b6fed0f657d9a820011b3e38e3c6b38e09c148ff26142f486ed34acfae96283edc005ccff2c0',43,1,'YABO_BANK','[]',0,'2020-01-26 00:26:38','2020-01-26 00:26:38','2021-01-26 08:26:38'),('9debab4f97497cbcec163624dc760a00ed85263714fd9d11df58b502cfc9603011ef3fb43fd548cb',46,1,'YABO_BANK','[]',0,'2020-02-04 09:29:35','2020-02-04 09:29:35','2021-02-04 17:29:35'),('a0f03a5eb22c70517094c6eb3e3f7d15fd1d5f228eeecf31cbe93cdc29e6afe41a26d72c42db9526',51,3,'YABO_BANK','[]',1,'2020-02-08 07:31:26','2020-02-08 07:31:26','2021-02-08 15:31:26'),('a1f847c8c8b8b3a06ffdac16e5b686706fe4c81aae94957b520ec81f840d412a77ba4ed4770efd17',53,3,'YABO_BANK','[]',0,'2020-02-10 16:14:44','2020-02-10 16:14:44','2021-02-11 00:14:44'),('a5d7672431920921a25fdfd9313da42eacdc6a872228f9fc3a58cdc870e5b805f97c7dfefd9f0656',43,1,'YABO_BANK','[]',1,'2020-01-29 23:54:57','2020-01-29 23:54:57','2021-01-30 07:54:57'),('a5d7d9d897c9fa8a5863b41e825deceb09200b7f0342e12a83e831cbbe2eb0682fdd88dc8e547990',41,1,'YABO_BANK','[]',0,'2020-01-25 23:31:43','2020-01-25 23:31:43','2021-01-26 07:31:43'),('a7eecabec60163b455e1b9adb095293403671c9eaa07119dedb9edb5287d1f814e983c308c41533e',43,1,'YABO_BANK','[]',1,'2020-01-26 00:23:11','2020-01-26 00:23:11','2021-01-26 08:23:11'),('a89a13bfb12c9b13840aea60aacc7fe33915dc2e234898e1c3f97dcdf6c81b8633435caa6f1bc4bd',31,1,'YABO_BANK','[]',1,'2020-01-27 06:04:00','2020-01-27 06:04:00','2021-01-27 14:04:00'),('ae91288d36cac67f39ef399d5a477301a90478b0d3bb02475d8518e6aac62bb2ea52c807ac1fe511',47,3,'YABO_BANK','[]',1,'2020-02-09 03:32:31','2020-02-09 03:32:31','2021-02-09 11:32:31'),('af03d59afdaa81ad2a0c59def720ff199c60b8cf155526048ccec097bec35f7363c8ff9abe4aaaab',49,3,'YABO_BANK','[]',1,'2020-02-08 13:54:41','2020-02-08 13:54:41','2021-02-08 21:54:41'),('af6b629fa23d5c188811b8fd7ee65f1744ac2853aae2a301f5387c431a3285d0de479d774766eb79',31,1,'YABO_BANK','[]',0,'2020-01-26 05:31:43','2020-01-26 05:31:43','2021-01-26 13:31:43'),('af8253624d5dd138aa3e5114943fc7d7033f5512a107c24d1a59e5c28dc45d29bae8c2433871b3a8',31,1,'YABO_BANK','[]',0,'2020-01-23 01:10:53','2020-01-23 01:10:53','2021-01-23 09:10:53'),('b068b96046ed1978a6aa45f84a497268bfeeb42d0fda14aecdaed8f5747486042859de05e598ff78',45,1,'YABO_BANK','[]',1,'2020-01-29 23:56:20','2020-01-29 23:56:20','2021-01-30 07:56:20'),('b2a17d112c88d047d4e0013b167ddf12e81b2a703ce692de5e345c824b10a31b9abdab84f9cdec55',34,1,'YABO_BANK','[]',0,'2020-01-25 04:24:04','2020-01-25 04:24:04','2021-01-25 12:24:04'),('b4c29a4bafb14f4a3b96a78ab239250a00fb3f2b067fd8b57234b13edc167e1ca426d18000e90696',31,1,'YABO_BANK','[]',1,'2020-01-25 23:45:02','2020-01-25 23:45:02','2021-01-26 07:45:02'),('b51011d763c489e167e5599b1d0d229dd48d3e16de9c7d808b9959a931c03ff0a9ed54f82a540fd4',31,1,'YABO_BANK','[]',1,'2020-01-29 05:24:41','2020-01-29 05:24:41','2021-01-29 13:24:41'),('b663588c5e275845880bdd9e854d180cb7fb4eb3cdea4f275d44fe92d41de78461291424c4276c1d',34,1,'YABO_BANK','[]',0,'2020-01-25 04:34:04','2020-01-25 04:34:04','2021-01-25 12:34:04'),('bb4977d75b5180969ffd7cc903860c6382343d9cbfcc94168dbd47777af8ad3bc652fb08b30714dd',34,1,'YABO_BANK','[]',0,'2020-01-25 04:12:31','2020-01-25 04:12:31','2021-01-25 12:12:31'),('bd8d51d08093c9682fa811943ded74e396df59220cf00feea7a16be88d731fd73f5f87d2c568afb7',8,3,'YABO_BANK','[]',0,'2020-02-10 16:10:18','2020-02-10 16:10:18','2021-02-11 00:10:18'),('bde8f69a53875ed145a0ead26c817222326b935973558d2d2fadcd932eed4bf15037291c2b625408',34,1,'YABO_BANK','[]',0,'2020-01-30 21:12:40','2020-01-30 21:12:40','2021-01-31 05:12:40'),('bfa26f5a32b9ebc13c6adcfc0e908c0368f846b56696de7b40abbe21d175e0362f19fb0c872b814c',55,3,'YABO_BANK','[]',0,'2020-02-12 12:53:36','2020-02-12 12:53:36','2021-02-12 20:53:36'),('c25fac14b78f77fed2350d0a458b7276b49bad24fb7437ff0f9ccd72445fffc2a18ff3c4c06c157d',31,1,'YABO_BANK','[]',1,'2020-01-29 05:18:14','2020-01-29 05:18:14','2021-01-29 13:18:14'),('c2c7890395b6e67314fdb27f83cbebba0c4f80b9a8f65c8194ca5b37ac0056279552f6e9cc6d6752',31,1,'YABO_BANK','[]',1,'2020-01-25 10:21:09','2020-01-25 10:21:09','2021-01-25 18:21:09'),('c337628dd95eee39a305b460e98bb9670f866bdc0de16d2c52136ce2e82e5e9f6f0f24e227022fa0',31,1,'YABO_BANK','[]',0,'2020-01-23 01:05:53','2020-01-23 01:05:53','2021-01-23 09:05:53'),('c958700d1e30a0b737fbec14978447411d0702067c64547fb6121bdba54d46841764dd932a332049',31,1,'YABO_BANK','[]',0,'2020-01-23 01:10:12','2020-01-23 01:10:12','2021-01-23 09:10:12'),('cc5077fd7893cf57591f08394d2750be50b755fe80d90bd2a78ff690b1d15eb0f45f366c3669ede9',53,3,'YABO_BANK','[]',1,'2020-02-12 12:52:49','2020-02-12 12:52:49','2021-02-12 20:52:49'),('ce85027d63744887879ccf5238ef0b7419b7cc1d2c71287b2521973933d4bc2aa24f28c25cf92324',31,1,'YABO_BANK','[]',0,'2020-01-27 06:24:20','2020-01-27 06:24:20','2021-01-27 14:24:20'),('d5e63b38b851860a8f702e21df341fed2bc3f267f91b47a45e10fe9ecf7298976628bd6da976a2f0',47,1,'YABO_BANK','[]',0,'2020-02-04 09:37:07','2020-02-04 09:37:07','2021-02-04 17:37:07'),('d6dc0b81ced0157796607e17edd2bf1e7375997f9fd2df34aa827a8939d22e743bd6ee7362eb3ee5',31,1,'YABO_BANK','[]',0,'2020-01-23 01:00:36','2020-01-23 01:00:36','2021-01-23 09:00:36'),('d7199a5e2598d7939a442c31a4c4598b2b0b4e6587dbb570cfac34420a578d0c167098d92e9c0136',34,1,'YABO_BANK','[]',0,'2020-01-25 04:09:05','2020-01-25 04:09:05','2021-01-25 12:09:05'),('d9618285ab7b0b50c9f7d5bded9526d6bf40b5e641c6d50131eff61e07ad3958c81bd55a4dbb5cd4',49,3,'YABO_BANK','[]',1,'2020-02-10 13:41:46','2020-02-10 13:41:46','2021-02-10 21:41:46'),('d9be99deb4f0a33c1e3be27f095b7babf38c60acb38eda23c090f4af8e98fe3f3ea4f69be02782a1',41,1,'YABO_BANK','[]',1,'2020-01-25 23:36:43','2020-01-25 23:36:43','2021-01-26 07:36:43'),('e0a60196d9696571d64943f72126b17a71b4131b299b5976728487d6779623b33a2241cd0188e870',34,1,'YABO_BANK','[]',0,'2020-01-25 03:00:01','2020-01-25 03:00:01','2021-01-25 11:00:01'),('e4b408431666a0b519758b39e7fd6cb529a28142e00df7802bb997dfe3c4befc2e8e25c144b5cf17',53,3,'YABO_BANK','[]',0,'2020-02-10 11:55:14','2020-02-10 11:55:14','2021-02-10 19:55:14'),('e51d0305c54637e3a94f3fb131fe07be5aee2551585b6dfb39bd8af5537ca814c60f1ef7f8408363',34,1,'YABO_BANK','[]',0,'2020-01-25 04:28:44','2020-01-25 04:28:44','2021-01-25 12:28:44'),('ea3ddc441b87fe309b91ea80591e5553aa6b317774ad461ac11c19dd4fb6ed0304052f7099a2bbe3',34,1,'YABO_BANK','[]',0,'2020-01-25 05:26:12','2020-01-25 05:26:12','2021-01-25 13:26:12'),('eaaa460156c0ca33a6c1ff9773f63dca5feaf38af7638ed5060e831e10dbe3dbc4089f3f57b2b949',50,3,'YABO_BANK','[]',0,'2020-02-08 07:25:46','2020-02-08 07:25:46','2021-02-08 15:25:46'),('eafa2684d34dacdb567066d3b0d753f5f8c5e65a00b08e9efbbbed485a3454fce0fbcb152af1cac6',34,1,'YABO_BANK','[]',0,'2020-01-25 04:33:07','2020-01-25 04:33:07','2021-01-25 12:33:07'),('f134caa5979d8c984cf4c96b39d2a55cd7941ee8d2c5e2f3bc3b46d84444ef4dc0bcea5f6e61c01f',31,1,'YABO_BANK','[]',0,'2020-01-30 08:35:59','2020-01-30 08:35:59','2021-01-30 16:35:59'),('f41ad480b00c188369851b3b039bc0ef45a409404f4e0fc16973610a3b22f647cf4ba3a04983c710',53,3,'YABO_BANK','[]',1,'2020-02-12 12:42:11','2020-02-12 12:42:11','2021-02-12 20:42:11'),('f56ea78df833dbd2fc8ed2754b8a1c4bc45e455b0499f6b46dee510d537887127ecaae3f01b69b80',43,1,'YABO_BANK','[]',1,'2020-01-30 08:17:19','2020-01-30 08:17:19','2021-01-30 16:17:19'),('f5ea34314e7395996db926ce2f6634f774b0778c80eef7ec7be696445a7df70400987cb1a6c978df',31,1,'YABO_BANK','[]',0,'2020-01-25 10:15:24','2020-01-25 10:15:24','2021-01-25 18:15:24'),('f7787bb7e4d429d7488a50bf78a11b4b9360f4e91efe95dc7386cd84783c87572a390918f4518b9f',43,1,'YABO_BANK','[]',1,'2020-01-29 21:42:17','2020-01-29 21:42:17','2021-01-30 05:42:17'),('f7d96ea9fce5d5b2e7d9ab46351d27a5a9ffe17d1dc85427f0f022af5db618ab0ad33ed86d6e814d',34,1,'YABO_BANK','[]',0,'2020-01-25 04:15:04','2020-01-25 04:15:04','2021-01-25 12:15:04'),('f927961d080954980138d0ec52820bed35cbb5987444f995a611816fede5c1cdc4293f05d4d43fca',31,1,'YABO_BANK','[]',0,'2020-01-30 06:58:52','2020-01-30 06:58:52','2021-01-30 14:58:52'),('f95f0379fac6e1692a9bdc41f9e0fc2f85f226f916a0506da515ab2303e2435912ef1dfaa393b702',31,1,'YABO_BANK','[]',0,'2020-01-25 05:26:20','2020-01-25 05:26:20','2021-01-25 13:26:20'),('fb19231db279f020a1f3d7cfcc9372adfd6c945ba319813a7d561e8706ddcbc289c71be75b131adb',31,1,'YABO_BANK','[]',1,'2020-01-29 20:56:14','2020-01-29 20:56:14','2021-01-30 04:56:14'),('fb19aa2a1697fb446dfe187835050c479aa5ad7aa1742b00d72ef164864861e98efca068d9fc879c',43,1,'YABO_BANK','[]',1,'2020-01-26 05:56:59','2020-01-26 05:56:59','2021-01-26 13:56:59'),('fcda86ad96beca4f9192d161fc291a8ee64257117d9821882164e5b8719094490510ccf2624c7843',31,1,'YABO_BANK','[]',0,'2020-01-29 23:02:49','2020-01-29 23:02:49','2021-01-30 07:02:49');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'YABO_BANK Personal Access Client','4oBU2PEUIL3xHBN7mzNzejlWGMytVmP6yY3doTPu','http://localhost',1,0,0,'2020-01-21 22:51:30','2020-01-21 22:51:30'),(2,NULL,'YABO_BANK Password Grant Client','dK1Y5kbInrzK6S3TRgu9qNS23b49oKmUoLNkGz0F','http://localhost',0,1,0,'2020-01-21 22:51:30','2020-01-21 22:51:30'),(3,NULL,'SISA Personal Access Client','L5wvt82SPeat3aU08MWEguIi7SV9dpmLxVN3JYv1','http://localhost',1,0,0,'2020-02-08 07:13:33','2020-02-08 07:13:33'),(4,NULL,'SISA Password Grant Client','cInRcbEfWJyWin7bFnWB87NxStd6KyFrKSZ6yy2z','http://localhost',0,1,0,'2020-02-08 07:13:33','2020-02-08 07:13:33');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2020-01-21 22:51:30','2020-01-21 22:51:30'),(2,3,'2020-02-08 07:13:33','2020-02-08 07:13:33');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,'PAYMENT_02202000001',1,'2020-02-04',35000000,'2020-02-04 08:16:24','2020-02-04 08:16:24'),(2,'PAYMENT_02202000002',1,'2020-02-06',7742035,'2020-02-04 08:47:24','2020-02-04 08:47:24'),(3,'PAYMENT_02202000003',2,'2020-02-12',35000000,'2020-02-04 08:50:39','2020-02-04 08:50:39'),(4,'PAYMENT_02202000004',2,'2020-02-07',3000000,'2020-02-07 14:38:28','2020-02-07 14:38:28'),(5,'PAYMENT_02202000005',2,'2020-02-09',935035,'2020-02-09 05:23:08','2020-02-09 05:23:08');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pick_ups`
--

DROP TABLE IF EXISTS `pick_ups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pick_ups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(10) unsigned NOT NULL,
  `driver_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pick_ups`
--

LOCK TABLES `pick_ups` WRITE;
/*!40000 ALTER TABLE `pick_ups` DISABLE KEYS */;
INSERT INTO `pick_ups` VALUES (1,1,1,1,'2020-02-04 02:35:01','2020-02-04 02:45:27'),(2,2,1,1,'2020-02-04 09:30:24','2020-02-04 09:37:34'),(3,3,1,1,'2020-02-04 13:16:31','2020-02-04 13:18:49'),(4,5,1,1,'2020-02-08 08:30:51','2020-02-08 08:35:24'),(5,6,1,1,'2020-02-08 08:45:01','2020-02-08 08:45:15'),(6,4,1,1,'2020-02-08 13:51:46','2020-02-09 04:29:00'),(7,7,1,1,'2020-02-08 13:56:22','2020-02-09 03:58:34'),(8,9,1,1,'2020-02-09 04:52:29','2020-02-09 05:06:55'),(9,11,1,1,'2020-02-09 05:16:40','2020-02-09 05:17:36'),(10,12,1,1,'2020-02-10 09:12:04','2020-02-10 09:13:20'),(11,13,1,0,'2020-02-12 12:59:20','2020-02-12 12:59:20'),(12,14,1,0,'2020-02-12 12:59:43','2020-02-12 12:59:43'),(13,15,1,1,'2020-02-12 13:42:57','2020-02-12 14:20:04');
/*!40000 ALTER TABLE `pick_ups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_lists`
--

DROP TABLE IF EXISTS `price_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `unit` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_lists`
--

LOCK TABLES `price_lists` WRITE;
/*!40000 ALTER TABLE `price_lists` DISABLE KEYS */;
INSERT INTO `price_lists` VALUES (2,'plastik',1000,'kg','2020-01-11 08:41:22','2020-01-11 08:41:22'),(3,'Besi',5000,'kg','2020-01-11 08:42:09','2020-01-11 08:42:09'),(4,'Kardus',4000,'kg','2020-01-19 22:35:00','2020-01-19 22:35:00');
/*!40000 ALTER TABLE `price_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (1,17,'Request_1580783541',2,'tes plastic 10 kg','REQUEST_1580783559.JPG','2020-02-04 02:32:39','2020-02-04 02:45:27'),(2,17,'Request_1580808608',2,'tes 10 plastik','REQUEST_1580808608.png','2020-02-04 09:30:08','2020-02-04 09:37:34'),(3,17,'Request_1580822153',2,'tes plastik 20 kg','REQUEST_1580822153.png','2020-02-04 13:15:53','2020-02-04 13:18:49'),(4,20,'Request_1581150475',2,'plastik 2','REQUEST_1581150475.png','2020-02-08 08:27:55','2020-02-09 04:29:00'),(5,21,'Request_1581150484',2,'aa','REQUEST_1581150484.png','2020-02-08 08:28:04','2020-02-08 08:35:24'),(6,21,'Request_1581151495',2,'aa','REQUEST_1581151495.png','2020-02-08 08:44:55','2020-02-08 08:45:15'),(7,19,'Request_1581170140',2,'tes 20 kg','REQUEST_1581170140.png','2020-02-08 13:55:40','2020-02-09 03:58:34'),(9,19,'Request_1581223854',2,'vgh','REQUEST_1581223854.png','2020-02-09 04:50:54','2020-02-09 05:06:55'),(11,22,'Request_1581225357',2,'hahah','REQUEST_1581225357.png','2020-02-09 05:15:57','2020-02-09 05:17:36'),(12,22,'Request_1581325897',2,'tes 100 kg besi','REQUEST_1581325897.png','2020-02-10 09:11:37','2020-02-10 09:13:20'),(13,25,'Request_1581512262',1,'hhhu','REQUEST_1581512262.png','2020-02-12 12:57:42','2020-02-12 12:59:20'),(14,23,'Request_1581512278',1,'Sampah Plastik 5 Kg\nSampah Kardus 10 Kg','REQUEST_1581512278.png','2020-02-12 12:57:58','2020-02-12 12:59:43'),(15,19,'Request_1581514953',2,'ff','REQUEST_1581514953.png','2020-02-12 13:42:33','2020-02-12 14:20:04'),(16,25,'Request_1581588989',0,'ini bavab','REQUEST_1581588989.png','2020-02-13 10:16:29','2020-02-13 10:16:29');
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (6,1),(8,2),(14,13),(15,13),(16,13),(17,13),(18,13),(19,13),(20,13),(25,13),(26,13),(29,14),(31,13),(32,13),(33,13),(34,14),(35,14),(40,13),(43,13),(44,13),(45,13),(46,13),(47,14),(48,13),(49,13),(50,13),(51,13),(52,13),(53,13),(54,13),(55,13);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin',NULL,NULL),(2,'uadmin',NULL,NULL),(13,'customer',NULL,NULL),(14,'driver',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sellings`
--

DROP TABLE IF EXISTS `sellings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sellings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `container_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` date NOT NULL,
  `unloading_date` date NOT NULL,
  `gross` double NOT NULL,
  `cut_off` double NOT NULL,
  `selling_price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sellings`
--

LOCK TABLES `sellings` WRITE;
/*!40000 ALTER TABLE `sellings` DISABLE KEYS */;
INSERT INTO `sellings` VALUES (2,'SO_02202000001','KARYA AGUNG REALITI','TEGU 682378(9)4561','8762 MJ','2020-02-04','2020-02-06',20409,200,2115,'2020-02-04 02:59:47','2020-02-04 03:29:01'),(3,'SO_02202000003','KARYA AGUNG REALITI','TEGU 682378(9)4561','8762 MJ','2020-02-04','2020-02-13',20409,2000,2115,'2020-02-04 05:54:25','2020-02-04 09:18:51');
/*!40000 ALTER TABLE `sellings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `driver_id` int(10) unsigned NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (2,'TRANSACTION_02202000002',17,1,'plastik','kg','10',1000,'2020-02-04 02:45:27','2020-02-04 02:45:27'),(3,'TRANSACTION_02202000003',17,1,'plastik','kg','2',1000,'2020-02-04 09:37:34','2020-02-04 09:37:34'),(4,'TRANSACTION_02202000004',17,1,'Besi','kg','34',5000,'2020-02-04 09:37:34','2020-02-04 09:37:34'),(5,'TRANSACTION_02202000004',17,1,'Kardus','kg','7',4000,'2020-02-04 09:37:34','2020-02-04 09:37:34'),(6,'TRANSACTION_02202000004',17,1,'plastik','kg','20',1000,'2020-02-04 13:18:49','2020-02-04 13:18:49'),(7,'TRANSACTION_02202000007',17,0,'plastik','kg','500',1000,'2020-02-08 06:41:24','2020-02-08 06:41:24'),(8,'TRANSACTION_02202000008',21,0,'plastik','kg','1000',1000,'2020-02-08 07:29:00','2020-02-08 07:29:00'),(9,'TRANSACTION_02202000009',21,1,'plastik','kg','5000',1000,'2020-02-08 08:35:23','2020-02-08 08:35:23'),(10,'TRANSACTION_02202000010',21,0,'plastik','kg','100',1000,'2020-02-08 08:37:21','2020-02-08 08:37:21'),(11,'TRANSACTION_02202000011',21,0,'plastik','kg','1',1000,'2020-02-08 08:44:16','2020-02-08 08:44:16'),(12,'TRANSACTION_02202000012',21,1,'plastik','kg','5',1000,'2020-02-08 08:45:15','2020-02-08 08:45:15'),(13,'TRANSACTION_02202000013',19,1,'Besi','kg','2',5000,'2020-02-09 03:58:34','2020-02-09 03:58:34'),(14,'TRANSACTION_02202000014',20,1,'Besi','kg','30',5000,'2020-02-09 04:29:00','2020-02-09 04:29:00'),(15,'TRANSACTION_02202000015',19,1,'plastik','kg','399',1000,'2020-02-09 05:06:54','2020-02-09 05:06:54'),(16,'TRANSACTION_02202000016',22,1,'Besi','kg','500',5000,'2020-02-09 05:17:36','2020-02-09 05:17:36'),(17,'TRANSACTION_02202000017',22,1,'Besi','kg','100',5000,'2020-02-10 09:13:20','2020-02-10 09:13:20'),(18,'TRANSACTION_02202000018',19,1,'plastik','kg','6',1000,'2020-02-12 14:20:04','2020-02-12 14:20:04');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `map_point` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userable_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'muhammad Alfalah','alan@alan.com','alan@alan.com',NULL,'$2y$10$uyaV09dX4tnt/4SY36twW.FACqQdaOcXjCxiGJUt337gZT9FWTAei','','','','','',NULL,'2020-01-07 11:46:43','2020-01-11 07:24:11','a',1),(8,'admin','alin@alin.com','admin@admin.com',NULL,'$2y$10$dP9tWHGSgJYDys3OppzHBeL5mLgH/Ppf5KBV3XH6lgoxIS9nSVcVe','PROFILE_1580182493.png','default.jpg','0','jalan jalan','',NULL,'2020-01-11 05:25:50','2020-02-04 09:42:49','',NULL),(46,'Aslia Rande','a@a.com','aslia@gmail.com',NULL,'$2y$10$OFwFJ6zbSd8d34i3Tiq6iO5oEaCYLEXF8889Yx8rnkDX5d4eIHHre','PROFILE_1580808740.png','default.jpg','084011223344','Jl. MT Haryono','0,0',NULL,'2020-02-04 00:51:19','2020-02-08 07:17:28','App\\Model\\Customer',17),(47,'Caca Handika','c@c.com','caca@sisa.com',NULL,'$2y$10$Hj.bjkFUkR0pZY0cCvPv6.1tu.FjnnP5c/1I/0j2ny/SkrHnUuTRu','PROFILE_1581219196.png','default.jpg','08234444000','Jl. Kendari','0,0',NULL,'2020-02-04 01:05:32','2020-02-09 03:33:16','App\\Model\\Driver',1),(48,'aku','aku','a@a.com',NULL,'$2y$10$jgiTzar8ERH4T8vi4llsveTcCtxzG5KLlRY1aSqRtcIOe8rM0LKXS','default.jpg','default.jpg','081342989180','jalan mutiara','0,0',NULL,'2020-02-08 07:19:05','2020-02-08 07:19:05','App\\Model\\Customer',18),(49,'x','x','x@x.com',NULL,'$2y$10$eQB3i.eYAYUS2sHEBZ3cC.7vIMzb3iswWdrmRDrPy2gL.X/IPtEF2','PROFILE_1581225013.png','default.jpg','00','x','0,0',NULL,'2020-02-08 07:21:46','2020-02-09 05:10:13','App\\Model\\Customer',19),(50,'tes','x','x1@x1.com',NULL,'$2y$10$GfBMdqmhgCp.L./JqB3LSuNmt7Tj4bB2kWlOK0Zz0GWHkxEz9QXEW','default.jpg','default.jpg','000','tes','0,0',NULL,'2020-02-08 07:25:46','2020-02-09 04:29:50','App\\Model\\Customer',20),(51,'alan','alan','tes@tes.com',NULL,'$2y$10$MZ3t9jupwHthczsZw5qEL.2qVijXWc7T7RD/yZtQJSQhQqSFD1ora','default.jpg','default.jpg','084698137643','jln mutiara','0,0',NULL,'2020-02-08 07:26:31','2020-02-08 07:26:31','App\\Model\\Customer',21),(52,'abdul','abdul','abdul@gmail.com',NULL,'$2y$10$wxA81wS1HrRKvTn6AFAmMet38UIWWGH7fAqXUVfn5AhdgqLGrBE9W','PROFILE_1581225732.png','default.jpg','085','kambu','0,0',NULL,'2020-02-09 05:14:13','2020-02-09 05:22:12','App\\Model\\Customer',22),(53,'Fachmi Ma\'asy','Fachmi Ma\'asy','fachmi.maasy@gmail.com',NULL,'$2y$10$KdE4CtlZU26sVr9HmhIceuQ8BukWrC/6sU7Jp1AtE3uN6uSpF8Vxa','PROFILE_1581335159.png','default.jpg','082349452345','Jl. Ahmad Yani Komp. BTN II BLOK E NO. 1','0,0',NULL,'2020-02-10 11:45:28','2020-02-10 11:45:59','App\\Model\\Customer',23),(54,'z','z','z@z.com',NULL,'$2y$10$36uK3DM0.gh9WnN6AUgt3emjJhsB1hUFDTiKhTBTJ6aQk4w.gE0Pu','PROFILE_1581344314.png','default.jpg','084631259874','alamat','0,0',NULL,'2020-02-10 14:18:06','2020-02-10 14:18:34','App\\Model\\Customer',24),(55,'SC','SC','synergy_creative@yahoo.com',NULL,'$2y$10$5JJytD/r2vFigh4tW3mHFu4KhZQgZ4Qn9Zv6siS6dS/B/kGWgKm5G','PROFILE_1581522814.png','default.jpg','0811406164','made sabara','0,0',NULL,'2020-02-12 12:53:36','2020-02-12 15:53:34','App\\Model\\Customer',25);
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

-- Dump completed on 2020-02-13 20:37:30
