/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - laravel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `laravel`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

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

/*Data for the table `failed_jobs` */

LOCK TABLES `failed_jobs` WRITE;

UNLOCK TABLES;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

LOCK TABLES `migrations` WRITE;

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2024_12_26_055505_create_tokos_table',1);

UNLOCK TABLES;

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

LOCK TABLES `password_reset_tokens` WRITE;

UNLOCK TABLES;

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

LOCK TABLES `personal_access_tokens` WRITE;

insert  into `personal_access_tokens`(`id`,`tokenable_type`,`tokenable_id`,`name`,`token`,`abilities`,`last_used_at`,`expires_at`,`created_at`,`updated_at`) values 
(1,'App\\Models\\User',1,'api','f5f9e47d308e07ce0928c7e044e048fec3be7075c700b630e13da0cba62bd766','[\"*\"]','2024-12-28 02:14:03',NULL,'2024-12-26 07:55:47','2024-12-28 02:14:03'),
(2,'App\\Models\\User',1,'api','bc8ac180523e259d37a5fe39f95912db9231caf4bcd4211c2e2b299fcc7f5b40','[\"*\"]',NULL,NULL,'2024-12-26 15:29:09','2024-12-26 15:29:09'),
(3,'App\\Models\\User',1,'api','d0b661e041083e489de113583222742c38b5c0f1ba703bd0faf0717e5cfab6b4','[\"*\"]',NULL,NULL,'2024-12-28 02:04:48','2024-12-28 02:04:48'),
(4,'App\\Models\\User',1,'api','31b72dce89f24360cff4898567c788199f863a5651d4cf20a6dabfdddbf140c3','[\"*\"]','2024-12-29 16:51:19',NULL,'2024-12-28 02:10:35','2024-12-29 16:51:19'),
(5,'App\\Models\\User',1,'api','41a362f98a3b1ca27c845c4948075621fef3c26d1b772a195d12300c846038a2','[\"*\"]','2024-12-29 16:50:34',NULL,'2024-12-28 03:39:01','2024-12-29 16:50:34'),
(6,'App\\Models\\User',4,'api','2e11953774b5d597803b794cfa6c2b49869b44a51e342ea40d321741cfbc55c9','[\"*\"]',NULL,NULL,'2025-01-10 07:35:18','2025-01-10 07:35:18'),
(7,'App\\Models\\User',1,'api','a28e3b89f62f1d9ec31cb02fda2ed7838e87ad868f5dc110b893ccf07e69e603','[\"*\"]',NULL,NULL,'2025-01-19 02:53:47','2025-01-19 02:53:47'),
(8,'App\\Models\\User',1,'api','049fbaed59523ecfd1c61e5d5d6b558cf7e29f8ee43222b843fbccd0ab84bacd','[\"*\"]','2025-04-02 03:19:15',NULL,'2025-01-19 02:53:50','2025-04-02 03:19:15'),
(9,'App\\Models\\User',1,'api','aab8314c1a4b2fe50972f72d3490824251f6ac6bcc86b560bb75c3baadd42a8b','[\"*\"]',NULL,NULL,'2025-01-20 13:51:48','2025-01-20 13:51:48'),
(10,'App\\Models\\User',1,'api','8c38ef4daf3d2a20491d5260763b0405e32167485afbd0527dad6679c5fa9f9e','[\"*\"]',NULL,NULL,'2025-01-20 13:52:20','2025-01-20 13:52:20'),
(11,'App\\Models\\User',1,'api','9f846e095b8b62b671a3d31a97d8058bd1702a4399ac032d6c18287c6d789aba','[\"*\"]',NULL,NULL,'2025-01-20 13:53:53','2025-01-20 13:53:53'),
(12,'App\\Models\\User',1,'api','fb07803940339cbce5269de1c9b1555e944f7da46e20b7579680fa822f2126c5','[\"*\"]',NULL,NULL,'2025-01-20 13:54:09','2025-01-20 13:54:09'),
(13,'App\\Models\\User',1,'api','c4dea45c474520889ef747bc64188b1c4c046fad703fd81f3fec1c1b561a6587','[\"*\"]',NULL,NULL,'2025-01-20 13:55:58','2025-01-20 13:55:58'),
(14,'App\\Models\\User',1,'api','9faae7617fa4c3fc0472ac3d9e8a8ea331b12100d7321efda1aea5eedb9cb903','[\"*\"]',NULL,NULL,'2025-01-20 13:57:13','2025-01-20 13:57:13'),
(15,'App\\Models\\User',1,'api','175f8520018c8654d8debe36ee6300433328605d5e8ad9d67eb92aa69282848f','[\"*\"]',NULL,NULL,'2025-03-29 03:58:32','2025-03-29 03:58:32'),
(16,'App\\Models\\User',1,'api','f75c414bb754d10e7c33cf18fed0f0db73655aa34e09aa936f3a536a2fc59c17','[\"*\"]','2025-04-02 03:19:07',NULL,'2025-04-02 03:18:42','2025-04-02 03:19:07');

UNLOCK TABLES;

/*Table structure for table `tokos` */

DROP TABLE IF EXISTS `tokos`;

CREATE TABLE `tokos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tokos` */

LOCK TABLES `tokos` WRITE;

insert  into `tokos`(`id`,`nama`,`jumlah`,`created_at`,`updated_at`) values 
(1,'laci',10,'2024-12-26 15:25:55','2024-12-26 16:05:29'),
(2,'Beras',6,'2024-12-26 15:41:51','2024-12-26 15:42:00'),
(3,'Biji',90,'2024-12-26 15:42:35','2024-12-26 15:42:39'),
(6,'Mobil',12,'2025-01-19 02:54:55','2025-01-19 02:54:55'),
(7,'Mobil',12,'2025-04-02 03:17:52','2025-04-02 03:17:52');

UNLOCK TABLES;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

LOCK TABLES `users` WRITE;

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'John Doe','johndoe@example.com',NULL,'$2y$10$E0bnTLsu6VGvn96ux56Xe.83zptni4HQuT//LGS1hdJpsX7GqYMxG',NULL,'2024-12-26 07:27:43','2024-12-26 07:27:43'),
(2,'sona','sona@example.com',NULL,'$2y$10$Rx.zqYtwAKesOZURh8vx9ee7zJsq26RCb2g2Eljc.Q8BHn1XEmTb6',NULL,'2024-12-28 01:53:49','2024-12-28 01:53:49'),
(3,'sonarianda','sonar@example.com',NULL,'$2y$10$0I1RpLsl7upfy10mSzodF.fwRe7hL8CIH2mcoPRq5.TEuVKgZWK06',NULL,'2024-12-28 01:58:56','2024-12-28 01:58:56'),
(4,'sonarianda','sonar@example1.com',NULL,'$2y$10$MkRIXbScFaIYy4HIOkLxmOQNChi5Lb2F2zoKJRi9wi3ps9v2zebBm',NULL,'2024-12-28 02:02:16','2024-12-28 02:02:16');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
