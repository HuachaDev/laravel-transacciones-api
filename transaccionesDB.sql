/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.24-MariaDB : Database - transaccionesdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`transaccionesdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `transaccionesdb`;

/*Table structure for table `cuentas_financieras` */

DROP TABLE IF EXISTS `cuentas_financieras`;

CREATE TABLE `cuentas_financieras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `saldo` decimal(15,2) NOT NULL,
  `titularCuenta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_cuenta_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cuentas_financieras_tipo_cuenta_id_foreign` (`tipo_cuenta_id`),
  CONSTRAINT `cuentas_financieras_tipo_cuenta_id_foreign` FOREIGN KEY (`tipo_cuenta_id`) REFERENCES `tipos_cuenta` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cuentas_financieras` */

insert  into `cuentas_financieras`(`id`,`saldo`,`titularCuenta`,`direccion`,`created_at`,`updated_at`,`tipo_cuenta_id`) values 
(1,15383.00,'John Doe','','2024-09-10 10:00:00','2024-10-01 19:26:02',1),
(2,500.00,'Jane Smith','','2024-09-10 11:00:00','2024-10-01 19:26:02',1);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2019_12_14_000001_create_personal_access_tokens_table',1),
(2,'2024_10_01_133211_create_tipos_cuenta_table',1),
(3,'2024_10_01_133214_create_cuentas_financieras_table',1),
(4,'2024_10_01_133217_create_transacciones_table',1),
(5,'2024_10_01_133751_create_tipos_transaccion_table',1),
(6,'2024_10_01_140328_add_foreign_keys_to_cuentas_financieras_table',2),
(7,'2024_10_01_140341_add_foreign_keys_to_transacciones_table',2);

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `tipos_cuenta` */

DROP TABLE IF EXISTS `tipos_cuenta`;

CREATE TABLE `tipos_cuenta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipos_cuenta` */

insert  into `tipos_cuenta`(`id`,`nombre`,`created_at`,`updated_at`) values 
(1,'CuentaEstandar','2024-10-01 10:11:03','2024-10-01 10:11:03'),
(2,'CuentaPremium','2024-10-01 10:11:03','2024-10-01 10:11:03');

/*Table structure for table `tipos_transaccion` */

DROP TABLE IF EXISTS `tipos_transaccion`;

CREATE TABLE `tipos_transaccion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipos_transaccion` */

insert  into `tipos_transaccion`(`id`,`nombre`,`created_at`,`updated_at`) values 
(1,'Depósito','2024-10-01 10:42:12','2024-10-01 10:42:12'),
(2,'Retiro','2024-10-01 10:42:12','2024-10-01 10:42:12'),
(3,'Transferencia','2024-10-01 10:42:12','2024-10-01 10:42:12');

/*Table structure for table `transacciones` */

DROP TABLE IF EXISTS `transacciones`;

CREATE TABLE `transacciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `monto` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cuenta_id` bigint(20) unsigned NOT NULL,
  `tipo_transaccion_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transacciones_cuenta_id_foreign` (`cuenta_id`),
  KEY `transacciones_tipo_transaccion_id_foreign` (`tipo_transaccion_id`),
  CONSTRAINT `transacciones_cuenta_id_foreign` FOREIGN KEY (`cuenta_id`) REFERENCES `cuentas_financieras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transacciones_tipo_transaccion_id_foreign` FOREIGN KEY (`tipo_transaccion_id`) REFERENCES `tipos_transaccion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transacciones` */

insert  into `transacciones`(`id`,`monto`,`created_at`,`updated_at`,`cuenta_id`,`tipo_transaccion_id`) values 
(1,5000.00,'2024-09-10 10:00:00','2024-09-10 10:00:00',1,1),
(2,200.00,'2024-09-10 11:00:00','2024-09-10 11:00:00',2,1),
(4,600.00,'2024-10-01 12:37:20','2024-10-01 12:37:24',1,1),
(5,1000.00,'2024-10-01 18:02:06','2024-10-01 18:02:06',1,1),
(6,1020.00,'2024-10-01 18:11:11','2024-10-01 18:11:11',1,2),
(7,20.00,'2024-10-01 18:18:00','2024-10-01 18:18:00',1,1),
(8,1020.00,'2024-10-01 18:18:10','2024-10-01 18:18:10',1,2),
(9,4080.00,'2024-10-01 18:22:24','2024-10-01 18:22:24',1,2),
(10,714.00,'2024-10-01 18:22:37','2024-10-01 18:22:37',1,2),
(11,500.00,'2024-10-01 19:12:54','2024-10-01 19:12:54',1,1),
(12,5000.00,'2024-10-01 19:13:03','2024-10-01 19:13:03',1,1),
(13,10000.00,'2024-10-01 19:13:11','2024-10-01 19:13:11',1,1),
(14,303.00,'2024-10-01 19:26:02','2024-10-01 19:26:02',1,3),
(15,300.00,'2024-10-01 19:26:02','2024-10-01 19:26:02',2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
