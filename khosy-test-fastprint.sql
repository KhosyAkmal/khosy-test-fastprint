-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: khosy_test_fastprint
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2023_06_28_005537_create_products_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id_produk` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (6,'ALCOHOL GEL POLISH CLEANSER GP-CLN01',12500,'L QUEENLY','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(9,'ALUMUNIUM FOIL ALL IN ONE BULAT 23mm IM',1000,'L MTH AKSESORIS (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(11,'ALUMUNIUM FOIL ALL IN ONE BULAT 30mm IM',1000,'L MTH AKSESORIS (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(12,'ALUMUNIUM FOIL ALL IN ONE SHEET 250mm IM',12500,'L MTH AKSESORIS (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(15,'ALUMUNIUM FOIL HDPE/PE BULAT 23mm IM',12500,'L MTH AKSESORIS (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(17,'ALUMUNIUM FOIL HDPE/PE BULAT 30mm IM',1000,'L MTH AKSESORIS (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(18,'ALUMUNIUM FOIL HDPE/PE SHEET 250mm IM',13000,'L MTH AKSESORIS (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(19,'ALUMUNIUM FOIL PET SHEET 250mm IM',1000,'L MTH AKSESORIS (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(22,'ARM PENDEK MODEL U',13000,'L MTH AKSESORIS (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(23,'ARM SUPPORT KECIL',13000,'L MTH TABUNG (LK)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(24,'ARM SUPPORT KOTAK PUTIH',13000,'L MTH AKSESORIS (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(26,'ARM SUPPORT PENDEK POLOS',13000,'L MTH TABUNG (LK)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(27,'ARM SUPPORT S IM',1000,'L MTH AKSESORIS (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(28,'ARM SUPPORT T (IMPORT)',13000,'L MTH AKSESORIS (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(29,'ARM SUPPORT T - MODEL 1 ( LOKAL )',10000,'L MTH TABUNG (LK)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(50,'BLACK LASER TONER FP-T3 (100gr)',13000,'L MTH AKSESORIS (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(56,'BODY PRINTER CANON IP2770',500,'SP MTH SPAREPART (LK)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(58,'BODY PRINTER T13X',15000,'SP MTH SPAREPART (LK)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(59,'BOTOL 1000ML BLUE KHUSUS UNTUK EPSON R1800/R800 - 4180 IM (T054920)',10000,'CI MTH TINTA LAIN (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(60,'BOTOL 1000ML CYAN KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 4120 IM (T054220)',10000,'CI MTH TINTA LAIN (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(61,'BOTOL 1000ML GLOSS OPTIMIZER KHUSUS UNTUK EPSON R1800/R800/R1900/R2000/IX7000/MG6170 - 4100 IM (T054020)',1500,'CI MTH TINTA LAIN (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(62,'BOTOL 1000ML L.LIGHT BLACK KHUSUS UNTUK EPSON 2400 - 0599 IM',1500,'CI MTH TINTA LAIN (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(63,'BOTOL 1000ML LIGHT BLACK KHUSUS UNTUK EPSON 2400 - 0597 IM',1500,'CI MTH TINTA LAIN (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(64,'BOTOL 1000ML MAGENTA KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 4140 IM (T054320)',1000,'CI MTH TINTA LAIN (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(65,'BOTOL 1000ML MATTE BLACK KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 3503 IM (T054820)',1500,'CI MTH TINTA LAIN (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(66,'BOTOL 1000ML ORANGE KHUSUS UNTUK EPSON R1900/R2000 IM - 4190 (T087920)',1500,'CI MTH TINTA LAIN (IM)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(67,'BOTOL 1000ML RED KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 4170 IM (T054720)',1000,'CI MTH TINTA LAIN (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(68,'BOTOL 1000ML YELLOW KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 4160 IM (T054420)',1500,'CI MTH TINTA LAIN (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(70,'BOTOL KOTAK 100ML LK',1000,'L MTH AKSESORIS (LK)','bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17'),(72,'BOTOL 10ML IM',1000,'S MTH STEMPEL (IM)','tidak bisa dijual','2023-06-27 20:58:17','2023-06-27 20:58:17');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-28 10:59:02
