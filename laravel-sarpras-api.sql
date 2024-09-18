-- MySQL dump 10.13  Distrib 8.0.37, for Linux (x86_64)
--
-- Host: localhost    Database: laravel_sarpras_sebelas
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES ('ATK','Alat Tulis Kantor','2024-09-02 21:29:18','2024-09-02 21:29:18');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_phone_unique` (`phone`),
  UNIQUE KEY `employees_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES ('1234567891011','Parwanton','Wakasek Kesiswaan','0812132','par@localhost.test',NULL,'2024-09-04 21:58:36','2024-09-04 21:58:36'),('197412311994031001','Sutarsa','Wakil Kepala Sekolah Bidang Sarana Prasarana','08123456789','sutarsa@smkn11bdg.sch.id',NULL,NULL,NULL),('197412311994031005','Zim zim','Ketua Progam keahlian DKV','08123456783','ani.nuraeni@smkn11bdg.sch.id',NULL,NULL,NULL),('197806311994031003','Toni Kusmara','Staff Sarana Prasarana','08123456781','toni.kusmara@smkn11bdg.sch.id',NULL,NULL,NULL),('198012311994031002','Yani','Kepala Sekolah Bidang Kurikulum','08123456792','yani@smkn11bdg.sch.id',NULL,NULL,NULL),('198212311994031004','Ani Nuraeni','Ketua Progam keahlian RPL','08123456782','zim.zim@smkn11bdg.sch.id',NULL,NULL,NULL);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incoming_items`
--

DROP TABLE IF EXISTS `incoming_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incoming_items` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `total_items` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incoming_items_employee_id_foreign` (`employee_id`),
  KEY `incoming_items_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `incoming_items_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `incoming_items_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incoming_items`
--

LOCK TABLES `incoming_items` WRITE;
/*!40000 ALTER TABLE `incoming_items` DISABLE KEYS */;
INSERT INTO `incoming_items` VALUES ('INV-001','198212311994031004','S0001','Barang masuk untuk keperluan testing',0,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('INV-002','198212311994031004','S0002','Barang masuk untuk keperluan testing',0,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('INV-003','198212311994031004','S0003','Barang masuk untuk keperluan testing',0,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('INV-004','198212311994031004','S0004','Barang masuk untuk keperluan testing',0,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('INV-005','198212311994031004','S0005','Barang masuk untuk keperluan testing',0,'2024-09-02 21:29:19','2024-09-02 21:29:19');
/*!40000 ALTER TABLE `incoming_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incoming_items_details`
--

DROP TABLE IF EXISTS `incoming_items_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incoming_items_details` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incoming_item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incoming_items_details_item_id_foreign` (`item_id`),
  KEY `incoming_items_details_incoming_item_id_foreign` (`incoming_item_id`),
  CONSTRAINT `incoming_items_details_id_foreign` FOREIGN KEY (`id`) REFERENCES `incoming_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `incoming_items_details_incoming_item_id_foreign` FOREIGN KEY (`incoming_item_id`) REFERENCES `incoming_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `incoming_items_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incoming_items_details`
--

LOCK TABLES `incoming_items_details` WRITE;
/*!40000 ALTER TABLE `incoming_items_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `incoming_items_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `min_stock` int NOT NULL DEFAULT '0',
  `price` int NOT NULL DEFAULT '0',
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_category_id_foreign` (`category_id`),
  CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES ('I-001','/images/pulpen-ae7.jpeg','Pulpen AE7','pcs',10,5,2000,'ATK','2024-09-02 21:29:18','2024-09-02 21:29:18'),('I-002','/images/buku-sidu-38.jpeg','Buku Sidu 38 Lembar','pcs',10,5,4000,'ATK','2024-09-02 21:29:19','2024-09-02 21:29:19'),('I-003','/images/kertas-sidu-a4.jpeg','Kertas Sidu A4','rim',10,5,15000,'ATK','2024-09-02 21:29:19','2024-09-02 21:29:19'),('I-004','/images/pulpen-joyko-gp-265.jpeg','Pulpen Joyko GP 265','pcs',10,5,2000,'ATK','2024-09-02 21:29:19','2024-09-02 21:29:19'),('I-005','/images/spidol-snowman-boardmarker.jpeg','Spidol Snowman Boardmarker','pcs',10,5,8000,'ATK','2024-09-02 21:29:19','2024-09-02 21:29:19');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_employees_table',1),(2,'0001_01_01_000000_create_users_table',1),(3,'0001_01_01_000001_create_cache_table',1),(4,'0001_01_01_000002_create_jobs_table',1),(5,'2024_05_20_081839_create_personal_access_tokens_table',1),(6,'2024_07_23_022428_create_categories_table',1),(7,'2024_07_23_022517_create_items_table',1),(8,'2024_07_23_022520_create_suppliers_table',1),(9,'2024_07_23_022530_create_incoming_itemss_table',1),(10,'2024_07_23_022538_create_outgoing_items_table',1),(11,'2024_07_23_022558_create_incoming_item_details_table',1),(12,'2024_07_23_022605_create_outgoing_item_details_table',1),(13,'2024_07_23_022804_create_submission_items_table',1),(14,'2024_07_23_022920_create_request_items_table',1),(15,'2024_07_23_023616_create_submission_item_details_table',1),(16,'2024_07_23_023624_create_request_item_details_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outgoing_item_details`
--

DROP TABLE IF EXISTS `outgoing_item_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `outgoing_item_details` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outgoing_item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `outgoing_item_details_item_id_foreign` (`item_id`),
  KEY `outgoing_item_details_outgoing_item_id_foreign` (`outgoing_item_id`),
  CONSTRAINT `outgoing_item_details_id_foreign` FOREIGN KEY (`id`) REFERENCES `outgoing_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `outgoing_item_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `outgoing_item_details_outgoing_item_id_foreign` FOREIGN KEY (`outgoing_item_id`) REFERENCES `outgoing_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outgoing_item_details`
--

LOCK TABLES `outgoing_item_details` WRITE;
/*!40000 ALTER TABLE `outgoing_item_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `outgoing_item_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outgoing_items`
--

DROP TABLE IF EXISTS `outgoing_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `outgoing_items` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_items` int NOT NULL DEFAULT '0',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `outgoing_items_operator_id_foreign` (`operator_id`),
  KEY `outgoing_items_division_id_foreign` (`division_id`),
  CONSTRAINT `outgoing_items_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `outgoing_items_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outgoing_items`
--

LOCK TABLES `outgoing_items` WRITE;
/*!40000 ALTER TABLE `outgoing_items` DISABLE KEYS */;
INSERT INTO `outgoing_items` VALUES ('OTK-001','197806311994031003','198212311994031004',5,'Barang keluar untuk keperluan testing','2024-09-02 21:29:19','2024-09-02 21:29:19'),('OTK-002','197806311994031003','198212311994031004',5,'Barang keluar untuk','2024-09-02 21:29:19','2024-09-02 21:29:19'),('OTK-003','197806311994031003','198212311994031004',5,'Barang keluar untuk','2024-09-02 21:29:19','2024-09-02 21:29:19'),('OTK-004','197806311994031003','198212311994031004',6,'Barang keluar untuk','2024-09-02 21:29:19','2024-09-02 21:29:19'),('OTK-005','197806311994031003','198212311994031004',6,'Barang keluar untuk','2024-09-02 21:29:19','2024-09-02 21:29:19');
/*!40000 ALTER TABLE `outgoing_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',197806311994031003,'accessToken','b80d6b8b2ef0cd1a387bd215bdfb1288870c51b3d4d63855bba3bbdd798c582e','[\"*\"]','2024-09-04 00:45:26',NULL,'2024-09-03 00:02:28','2024-09-04 00:45:26'),(2,'App\\Models\\User',197806311994031003,'accessToken','3b7bfcbc3b5071bc177745f9147dd383408307c67699f0eb3ec3db0e5f783316','[\"*\"]',NULL,NULL,'2024-09-03 01:03:16','2024-09-03 01:03:16'),(3,'App\\Models\\User',197806311994031003,'accessToken','eb223dc73ecf0d1b60a39a86fa277b3e1546e55ed709b63c92665ebcb143fea9','[\"*\"]','2024-09-04 01:09:23',NULL,'2024-09-04 00:45:55','2024-09-04 01:09:23'),(4,'App\\Models\\User',197806311994031003,'accessToken','ea18acdcb053537488e7414df57380c2e2ad55264498b1a39135e2cbce4f0c52','[\"*\"]','2024-09-04 22:01:21',NULL,'2024-09-04 01:09:27','2024-09-04 22:01:21'),(5,'App\\Models\\User',197806311994031003,'accessToken','9d554fc03e82497ad84ab435a5e4d4026cb0999ea7c3fb10a7c4f00ea8eb03ec','[\"*\"]',NULL,NULL,'2024-09-04 05:39:45','2024-09-04 05:39:45'),(6,'App\\Models\\User',197806311994031003,'accessToken','eafe758dfb5ae0f6ed8ff73d09b31ea62644c769cd3db912ba55e55bf1e22324','[\"*\"]',NULL,NULL,'2024-09-04 05:40:35','2024-09-04 05:40:35'),(7,'App\\Models\\User',197806311994031003,'accessToken','9def1203e1cee59e13f2286203f71d65416baf15fa2f940cf6ddf279d2dcf8e2','[\"*\"]',NULL,NULL,'2024-09-04 21:34:27','2024-09-04 21:34:27'),(8,'App\\Models\\User',197806311994031003,'accessToken','5859020934fff26fd56cac3ead2b4d5aff74b56c67c37f8640b3eec2052d16ff','[\"*\"]','2024-09-08 21:12:25',NULL,'2024-09-08 21:12:25','2024-09-08 21:12:25'),(9,'App\\Models\\User',197806311994031003,'accessToken','947537a68a8423fdfa039cdb7df04966bbeb961c17ba4ed661a476acb715c206','[\"*\"]','2024-09-08 21:25:45',NULL,'2024-09-08 21:25:16','2024-09-08 21:25:45'),(10,'App\\Models\\User',197806311994031003,'accessToken','75a3fd2ab665b29d188a8e009e3b09acf630601d35e0d3355613d5b1aa2e7dff','[\"*\"]','2024-09-08 21:32:02',NULL,'2024-09-08 21:32:02','2024-09-08 21:32:02'),(11,'App\\Models\\User',197806311994031003,'accessToken','7b999114a9a5104dfd5d55e5021fb31d89075868d40b6968e659c29e2ef25d2f','[\"*\"]','2024-09-08 21:36:17',NULL,'2024-09-08 21:36:17','2024-09-08 21:36:17'),(18,'App\\Models\\User',197806311994031003,'accessToken','ed12f832966b466b98714e43fa6fbca7b5be36499bf1087c6ad3f4e1de1a3dc7','[\"*\"]','2024-09-09 22:14:35',NULL,'2024-09-09 09:21:04','2024-09-09 22:14:35'),(20,'App\\Models\\User',197806311994031003,'accessToken','92952d0127a6d7239cb81b51b0d2014a2a4c4f3ccc79f9216dc2772e021564eb','[\"*\"]','2024-09-11 00:54:05',NULL,'2024-09-10 08:09:36','2024-09-11 00:54:05'),(21,'App\\Models\\User',197806311994031003,'accessToken','7298dee92d97b8516a19b9ef319a3b82fa9a88eb0f495af94bb3c018106c7626','[\"*\"]','2024-09-10 08:10:06',NULL,'2024-09-10 08:09:52','2024-09-10 08:10:06'),(26,'App\\Models\\User',197806311994031003,'accessToken','bdaa3d73ec55846068bcec3da3a82bee5e71b8e4d68c1ec28bd2df5199e2549c','[\"*\"]','2024-09-10 23:07:52',NULL,'2024-09-10 23:07:07','2024-09-10 23:07:52'),(29,'App\\Models\\User',197806311994031003,'accessToken','54747f4828858048ea15b0f236fb15be58c17a209848d253fe47879c43470718','[\"*\"]','2024-09-10 23:50:00',NULL,'2024-09-10 23:38:42','2024-09-10 23:50:00'),(30,'App\\Models\\User',197806311994031003,'accessToken','b1c52fdd4663517724c241b9c03e4707145d3b416413279dc3ffb49f030fddfb','[\"*\"]','2024-09-10 23:51:16',NULL,'2024-09-10 23:50:15','2024-09-10 23:51:16'),(35,'App\\Models\\User',197806311994031003,'accessToken','94c178ad2e8b393a020f9a27cc2e163d69a5f7a636ec683371e245290c2eb3e1','[\"*\"]','2024-09-11 00:52:48',NULL,'2024-09-11 00:52:06','2024-09-11 00:52:48'),(36,'App\\Models\\User',197806311994031003,'accessToken','50a23915f2a6c04f9faed2273ec938bd557ffb686bc252b9b6a5b7c7e076df02','[\"*\"]','2024-09-11 03:59:29',NULL,'2024-09-11 02:28:29','2024-09-11 03:59:29');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_item_details`
--

DROP TABLE IF EXISTS `request_item_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_item_details` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `qty_acc` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `request_item_details_id_foreign` (`id`),
  KEY `request_item_details_item_id_foreign` (`item_id`),
  CONSTRAINT `request_item_details_id_foreign` FOREIGN KEY (`id`) REFERENCES `request_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_item_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_item_details`
--

LOCK TABLES `request_item_details` WRITE;
/*!40000 ALTER TABLE `request_item_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_item_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_items`
--

DROP TABLE IF EXISTS `request_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_items` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('diajukan','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `total_items` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `request_items_employee_id_foreign` (`employee_id`),
  CONSTRAINT `request_items_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_items`
--

LOCK TABLES `request_items` WRITE;
/*!40000 ALTER TABLE `request_items` DISABLE KEYS */;
INSERT INTO `request_items` VALUES ('RQ-001','198212311994031004','diajukan',5,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('RQ-002','197412311994031005','diajukan',5,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('RQ-003','197412311994031005','diajukan',5,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('RQ-004','198212311994031004','diajukan',5,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('RQ-005','197412311994031005','diajukan',5,'2024-09-02 21:29:19','2024-09-02 21:29:19');
/*!40000 ALTER TABLE `request_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submission_item_details`
--

DROP TABLE IF EXISTS `submission_item_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submission_item_details` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submission_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `qty_acc` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `submission_item_details_id_unique` (`id`),
  KEY `submission_item_details_submission_id_foreign` (`submission_id`),
  KEY `submission_item_details_item_id_foreign` (`item_id`),
  CONSTRAINT `submission_item_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `submission_item_details_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `submission_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submission_item_details`
--

LOCK TABLES `submission_item_details` WRITE;
/*!40000 ALTER TABLE `submission_item_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `submission_item_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submission_items`
--

DROP TABLE IF EXISTS `submission_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submission_items` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('diajukan','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `total_items` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submission_items_division_id_foreign` (`division_id`),
  CONSTRAINT `submission_items_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submission_items`
--

LOCK TABLES `submission_items` WRITE;
/*!40000 ALTER TABLE `submission_items` DISABLE KEYS */;
INSERT INTO `submission_items` VALUES ('SM-001','198212311994031004','diajukan',5,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('SM-002','197412311994031005','diajukan',10,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('SM-003','198212311994031004','diajukan',15,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('SM-004','197412311994031005','diajukan',10,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('SM-005','197412311994031005','diajukan',10,'2024-09-02 21:29:19','2024-09-02 21:29:19'),('SM-006','197412311994031005','diajukan',10,'2024-09-02 21:29:19','2024-09-02 21:29:19');
/*!40000 ALTER TABLE `submission_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES ('S0001','Supplier 1','Address 1','08123456789','2024-09-02 21:29:18','2024-09-02 21:29:18'),('S0002','Supplier 2','Address 2','08123456790','2024-09-02 21:29:18','2024-09-02 21:29:18'),('S0003','Supplier 3','Address 3','08123456791','2024-09-02 21:29:18','2024-09-02 21:29:18'),('S0004','Supplier 4','Address 4','08123456792','2024-09-02 21:29:18','2024-09-02 21:29:18'),('S0005','Supplier 5','Address 5','08123456793','2024-09-02 21:29:18','2024-09-02 21:29:18');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','unit','pengawas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unit',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  CONSTRAINT `users_id_foreign` FOREIGN KEY (`id`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('197412311994031001','pengawas','$2y$12$awuiDQr8GWZ3nK7MmJ/IJ.FCtc2qzYz7VsVkUj9JcDkSKunDwKLB6','pengawas',NULL,'2024-09-02 21:29:18','2024-09-02 21:29:18'),('197412311994031005','zim_zim','$2y$12$2uZUpn4rf0diSw.BJVYK8eaIAR8zJ8SYvcKEChJPtmGjmFxJfgd8m','unit',NULL,'2024-09-02 21:29:18','2024-09-02 21:29:18'),('197806311994031003','admin','$2y$12$m8hFw4jScC70CSkvMhbdgelXVYbmP5QsYLF6RTTqy40y5sQrZD3ze','admin',NULL,'2024-09-02 21:29:18','2024-09-02 21:29:18'),('198212311994031004','ani_nuraeni','$2y$12$cmV1g8Sa6ITTyZv65snAsOcCLs0d182AhAwp37IYy4LExceUURXnO','unit',NULL,'2024-09-02 21:29:18','2024-09-02 21:29:18');
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

-- Dump completed on 2024-09-18  8:54:40
