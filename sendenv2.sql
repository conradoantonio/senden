/*
SQLyog Ultimate v9.63 
MySQL - 5.5.5-10.1.21-MariaDB : Database - sendenv2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sendenv2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sendenv2`;

/*Table structure for table `business_details` */

DROP TABLE IF EXISTS `business_details`;

CREATE TABLE `business_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(10) unsigned DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext_number` int(10) unsigned DEFAULT NULL,
  `int_number` int(10) unsigned DEFAULT NULL,
  `postal_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colony` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interbank_clabe` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_details_business_id_foreign` (`business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `business_details` */

/*Table structure for table `business_holidays` */

DROP TABLE IF EXISTS `business_holidays`;

CREATE TABLE `business_holidays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(10) unsigned DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_holidays_business_id_foreign` (`business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `business_holidays` */

/*Table structure for table `business_service_dates` */

DROP TABLE IF EXISTS `business_service_dates`;

CREATE TABLE `business_service_dates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(10) unsigned DEFAULT NULL,
  `service_date_id` int(10) unsigned DEFAULT NULL,
  `start_service` time NOT NULL,
  `end_service` time NOT NULL,
  `start_break` time NOT NULL,
  `end_break` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_service_dates_business_id_foreign` (`business_id`),
  KEY `business_service_dates_service_date_id_foreign` (`service_date_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `business_service_dates` */

/*Table structure for table `businesses` */

DROP TABLE IF EXISTS `businesses`;

CREATE TABLE `businesses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned DEFAULT NULL,
  `tradename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfc` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext_number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `int_number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colony` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clabe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varbinary(50) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `semana_inicio` time DEFAULT NULL,
  `semana_fin` time DEFAULT NULL,
  `semana_com_inicio` time DEFAULT NULL,
  `semana_com_fin` time DEFAULT NULL,
  `sabado_inicio` time DEFAULT NULL,
  `sabado_fin` time DEFAULT NULL,
  `sabado_com_inicio` time DEFAULT NULL,
  `sabado_com_fin` time DEFAULT NULL,
  `domingo_inicio` time DEFAULT NULL,
  `domingo_fin` time DEFAULT NULL,
  `domingo_com_inicio` time DEFAULT NULL,
  `domingo_com_fin` time DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `isOpen` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `businesses_category_id_foreign` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `businesses` */

insert  into `businesses`(`id`,`category_id`,`tradename`,`name`,`rfc`,`street`,`ext_number`,`int_number`,`postal_code`,`latitude`,`longitude`,`colony`,`city`,`state`,`phone`,`logo`,`photo1`,`photo2`,`clabe`,`contract`,`contract_number`,`bank_name`,`description`,`semana_inicio`,`semana_fin`,`semana_com_inicio`,`semana_com_fin`,`sabado_inicio`,`sabado_fin`,`sabado_com_inicio`,`sabado_com_fin`,`domingo_inicio`,`domingo_fin`,`domingo_com_inicio`,`domingo_com_fin`,`status`,`isOpen`,`created_at`,`updated_at`) values (1,1,'Oxxo','Oxxo sa de cv','VECJ880326321','Av vallarta','5321',NULL,'89125','20.667337','-103.398919','Acá chido','Guadalajara','Jalisco','9801010','businesses/logo_1.jpg','businesses/photo1_1.jpg',NULL,'2342567809904456',NULL,'32','Banamex','Esta es una descripción','09:30:00','06:30:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2017-06-13 10:02:52','2017-09-08 23:19:43'),(2,1,'test sa de cv','test','38172831283','chapalita','231','2','83219','18.8414822','-96.99263489999998','av universidad2','zapopan','Jalisco','9801010','businesses/logo_.jpg','businesses/photo1_.jpg','businesses/photo2_.jpg','4321765409875645','businesses/contract_.jpg','98','banamex',NULL,'09:30:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'00:00:00',NULL,NULL,NULL,1,1,'2017-07-07 00:11:59','2017-09-08 23:19:44'),(3,2,'Negocio de prueba SA de CV','Negocio de prueba','3281738273122','chapalita','231','2','83219','20.66516780287572','-103.3957363788208','av universidad2','zapopan','Jalisco','9801010','businesses/3/logo.png','businesses/photo1_.jpg',NULL,'0987654321','businesses/contract_.jpg','45','BBVA',NULL,'09:30:00','18:30:00','14:00:00','15:00:00','10:00:00','13:00:00',NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2017-07-17 02:09:43','2017-09-20 22:46:49'),(4,10,'bridge studio sa','bridge studio','shy23jhg21h','dsadasda','23123','2132','22323','20.66500235083216','-103.40192184025875','fghgdjhsgdjh','jaghdasg','jhghjgsdhd','124342134','businesses/4/logo.jpg','businesses/4/photo1.png','businesses/4/photo2.png','1293819237123','businesses/4/contract.jpg','23','bnjkdsa',NULL,'09:30:00','06:30:00','01:00:00','01:30:00','09:00:00','17:00:00','14:00:00','14:30:00','09:00:00','14:00:00',NULL,NULL,1,0,'2017-08-03 17:18:31','2017-09-08 23:19:35');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`created_at`,`updated_at`) values (1,'Tiendas de conveniencia',NULL,NULL),(2,'Farmacias',NULL,NULL),(3,'Restaurantes',NULL,NULL),(4,'Repostería y Café',NULL,NULL),(5,'Vinos y licores',NULL,NULL),(6,'Carnicería y cremería',NULL,NULL),(7,'Ropa y calzado',NULL,NULL),(8,'Papelería, tecnologia y regalos',NULL,NULL),(9,'Ferretería y refacciones',NULL,NULL),(10,'Servicios',NULL,NULL);

/*Table structure for table `dues` */

DROP TABLE IF EXISTS `dues`;

CREATE TABLE `dues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `value` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `dues` */

insert  into `dues`(`id`,`name`,`value`) values (1,'kmFee',7.50),(2,'initialFee',9.95),(3,'insuranceFee',2.90);

/*Table structure for table `faqs` */

DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `faqs` */

insert  into `faqs`(`id`,`question`,`answer`,`image`,`created_at`,`updated_at`) values (2,'que bonito','es lo bonito','faqs/1494393164.jpg','2017-05-10 05:12:44','2017-07-25 20:59:29'),(3,'sdadasd','sdadadsad','faqs/1501016326.png','2017-07-25 20:58:46','2017-07-25 20:58:46'),(4,'sdadsa','sadasda','faqs/1501016349.jpg','2017-07-25 20:59:09','2017-07-25 20:59:09');

/*Table structure for table `incidence_types` */

DROP TABLE IF EXISTS `incidence_types`;

CREATE TABLE `incidence_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `incidence_types` */

insert  into `incidence_types`(`id`,`name`,`created_at`,`updated_at`) values (1,'Local cerrado',NULL,NULL),(2,'No hay producto',NULL,NULL),(3,'Falla mecánica',NULL,NULL),(4,'Domicilio del usuario no encotrado',NULL,NULL),(5,'Otros',NULL,NULL);

/*Table structure for table `incidences` */

DROP TABLE IF EXISTS `incidences`;

CREATE TABLE `incidences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(10) unsigned DEFAULT NULL,
  `incidence_type_id` int(10) unsigned DEFAULT NULL,
  `solution_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_order_id` int(10) unsigned DEFAULT NULL,
  `observations` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incidences_business_id_foreign` (`business_id`),
  KEY `incidences_incidence_type_id_foreign` (`incidence_type_id`),
  KEY `incidences_solution_id_foreign` (`solution_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `incidences` */

insert  into `incidences`(`id`,`business_id`,`incidence_type_id`,`solution_id`,`order_id`,`description`,`order_number`,`new_order_id`,`observations`,`created_at`,`updated_at`) values (1,1,2,3,1,'No había producto, por lo que el local no pudo rebastecerse en ese momento.','1',NULL,'Se reembolsó el dinero al cliente','2017-07-16 16:58:18','2017-07-16 22:08:50'),(2,1,2,2,1,'sdads','1',NULL,'Se cancerló el pedido por falta.','2017-07-16 16:59:21','2017-07-24 22:03:04');

/*Table structure for table `informationenterprise` */

DROP TABLE IF EXISTS `informationenterprise`;

CREATE TABLE `informationenterprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(245) DEFAULT NULL,
  `description` text,
  `latitude` varchar(150) DEFAULT NULL,
  `longitude` varchar(150) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `logotype` varchar(145) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena los datos de la empresa SENDEN.';

/*Data for the table `informationenterprise` */

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(10) unsigned DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `to_id` int(11) DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `check` int(1) DEFAULT '1' COMMENT '0 Leido, 1 pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_business_id_foreign` (`business_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `messages` */

insert  into `messages`(`id`,`business_id`,`subject`,`from`,`body`,`to_id`,`archived`,`check`,`created_at`,`updated_at`) values (1,3,'Hola','Negocio de prueba','Adios',0,0,0,'2017-07-24 22:06:16','2017-07-24 22:06:33'),(2,0,'Re: Hola','Admin','Como estás',3,0,0,'2017-07-24 22:06:45','2017-07-24 22:06:55'),(3,3,'Re: Hola','Negocio de prueba','Bien gracias',0,0,1,'2017-07-24 22:07:12','2017-07-24 22:07:12');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_05_03_043242_create_businesses_table',1),(4,'2017_05_03_044535_create_business_details_table',1),(5,'2017_05_03_045919_create_business_service_dates_table',1),(6,'2017_05_03_050238_create_services_dates_table',1),(7,'2017_05_03_050500_create_business_holidays_table',1),(8,'2017_05_03_050657_create_order_table',1),(9,'2017_05_03_052010_create_order_details_table',1),(10,'2017_05_03_052431_create_statuses_table',1),(11,'2017_05_03_052551_create_orders_history_table',1),(12,'2017_05_03_052853_create_products_table',1),(13,'2017_05_03_053808_create_incidences_table',1),(14,'2017_05_03_054112_create_solutions_table',1),(15,'2017_05_03_054144_create_messages_table',1),(16,'2017_05_03_054439_create_senden_data_table',1),(17,'2017_05_03_055106_create_faqs_table',1),(18,'2017_05_08_023341_create_sendenboy_table',1),(19,'2017_05_08_024505_create_vehicles_table',1),(20,'2017_05_08_060012_create_categories_table',1),(21,'2017_05_08_061641_create_user_types_table',1),(22,'2017_05_08_065026_create_incidence_types_table',1),(23,'2017_05_08_065624_add_relationship_to_tables',1);

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `platform` int(11) DEFAULT NULL COMMENT '1 => Anddroid, 2 => IOS',
  `message` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=521 DEFAULT CHARSET=latin1;

/*Data for the table `notifications` */

insert  into `notifications`(`id`,`user_id`,`platform`,`message`,`created_at`,`updated_at`) values (1,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(2,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(3,4,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(4,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(5,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(6,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(7,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(8,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(9,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(10,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(11,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(12,262,1,'Hay un nuevo pedido cerca.','2017-06-13 20:17:16','2017-06-13 20:17:16'),(13,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-13 20:18:15','2017-06-13 20:18:15'),(14,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-13 20:18:15','2017-06-13 20:18:15'),(15,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(16,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(17,4,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(18,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(19,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(20,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(21,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(22,205,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(23,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(24,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(25,93,2,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(26,262,1,'Hay un nuevo pedido cerca.','2017-06-13 20:21:28','2017-06-13 20:21:28'),(27,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-13 20:25:04','2017-06-13 20:25:04'),(28,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-13 20:25:04','2017-06-13 20:25:04'),(29,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-13 20:36:31','2017-06-13 20:36:31'),(30,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-13 20:36:31','2017-06-13 20:36:31'),(31,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-13 23:09:16','2017-06-13 23:09:16'),(32,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-13 23:09:17','2017-06-13 23:09:17'),(33,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-13 23:27:44','2017-06-13 23:27:44'),(34,4,2,'¡Tu pedido ya está cerca de ti!','2017-06-13 23:28:10','2017-06-13 23:28:10'),(35,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-14 00:29:56','2017-06-14 00:29:56'),(36,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-14 00:29:56','2017-06-14 00:29:56'),(37,4,2,'¡Tu pedido ya está cerca de ti!','2017-06-14 00:30:05','2017-06-14 00:30:05'),(38,4,2,'¡Tu pedido ya está cerca de ti!','2017-06-14 00:30:05','2017-06-14 00:30:05'),(39,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-14 12:20:44','2017-06-14 12:20:44'),(40,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-14 12:20:44','2017-06-14 12:20:44'),(41,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-14 12:20:44','2017-06-14 12:20:44'),(42,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-14 12:20:44','2017-06-14 12:20:44'),(43,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-14 12:20:44','2017-06-14 12:20:44'),(44,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(45,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(46,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(47,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(48,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(49,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(50,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(51,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(52,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(53,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(54,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:01:49','2017-06-20 14:01:49'),(55,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:14','2017-06-20 14:07:14'),(56,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:14','2017-06-20 14:07:14'),(57,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:14','2017-06-20 14:07:14'),(58,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:14','2017-06-20 14:07:14'),(59,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:14','2017-06-20 14:07:14'),(60,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:14','2017-06-20 14:07:14'),(61,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:14','2017-06-20 14:07:14'),(62,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:15','2017-06-20 14:07:15'),(63,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:15','2017-06-20 14:07:15'),(64,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:15','2017-06-20 14:07:15'),(65,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:07:15','2017-06-20 14:07:15'),(66,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(67,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(68,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(69,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(70,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(71,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(72,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(73,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(74,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(75,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(76,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:13:15','2017-06-20 14:13:15'),(77,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:46','2017-06-20 14:35:46'),(78,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:46','2017-06-20 14:35:46'),(79,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:46','2017-06-20 14:35:46'),(80,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:47','2017-06-20 14:35:47'),(81,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:47','2017-06-20 14:35:47'),(82,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:47','2017-06-20 14:35:47'),(83,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:47','2017-06-20 14:35:47'),(84,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:47','2017-06-20 14:35:47'),(85,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:47','2017-06-20 14:35:47'),(86,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:47','2017-06-20 14:35:47'),(87,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:47','2017-06-20 14:35:47'),(88,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:35:47','2017-06-20 14:35:47'),(89,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 14:59:41','2017-06-20 14:59:41'),(90,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:05:59','2017-06-20 15:05:59'),(91,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(92,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(93,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(94,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(95,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(96,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(97,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(98,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(99,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(100,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(101,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(102,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:42','2017-06-20 15:08:42'),(103,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(104,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(105,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(106,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(107,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(108,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(109,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(110,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(111,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(112,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(113,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(114,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 15:08:46','2017-06-20 15:08:46'),(115,275,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 22:44:59','2017-06-20 22:44:59'),(116,275,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-20 23:15:22','2017-06-20 23:15:22'),(117,275,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 12:38:49','2017-06-22 12:38:49'),(118,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(119,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(120,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(121,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(122,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(123,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(124,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(125,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(126,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(127,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(128,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(129,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-22 13:18:36','2017-06-22 13:18:36'),(130,282,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-23 18:10:27','2017-06-23 18:10:27'),(131,282,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-23 18:10:27','2017-06-23 18:10:27'),(132,282,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-23 18:10:27','2017-06-23 18:10:27'),(133,275,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-23 19:12:43','2017-06-23 19:12:43'),(134,275,2,'¡Tu pedido ya está cerca de ti!','2017-06-23 19:12:51','2017-06-23 19:12:51'),(135,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-26 12:10:13','2017-06-26 12:10:13'),(136,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-26 12:10:13','2017-06-26 12:10:13'),(137,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-26 12:10:13','2017-06-26 12:10:13'),(138,275,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-27 20:46:16','2017-06-27 20:46:16'),(139,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-29 20:51:26','2017-06-29 20:51:26'),(140,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-29 20:51:26','2017-06-29 20:51:26'),(141,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-29 20:51:26','2017-06-29 20:51:26'),(142,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-06-29 20:51:26','2017-06-29 20:51:26'),(143,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(144,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(145,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(146,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(147,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(148,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(149,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(150,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(151,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(152,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(153,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(154,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(155,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(156,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-01 14:03:24','2017-07-01 14:03:24'),(157,275,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:34:15','2017-07-03 15:34:15'),(158,275,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:43:44','2017-07-03 15:43:44'),(159,275,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:48:58','2017-07-03 15:48:58'),(160,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(161,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(162,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(163,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(164,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(165,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(166,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(167,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(168,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(169,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(170,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(171,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:23','2017-07-03 15:51:23'),(172,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:24','2017-07-03 15:51:24'),(173,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:24','2017-07-03 15:51:24'),(174,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:51:24','2017-07-03 15:51:24'),(175,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(176,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(177,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(178,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(179,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(180,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(181,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(182,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(183,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(184,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(185,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(186,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(187,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(188,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(189,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 15:55:12','2017-07-03 15:55:12'),(190,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:32','2017-07-03 16:02:32'),(191,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:32','2017-07-03 16:02:32'),(192,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:32','2017-07-03 16:02:32'),(193,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:32','2017-07-03 16:02:32'),(194,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:32','2017-07-03 16:02:32'),(195,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:32','2017-07-03 16:02:32'),(196,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:32','2017-07-03 16:02:32'),(197,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:33','2017-07-03 16:02:33'),(198,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:33','2017-07-03 16:02:33'),(199,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:33','2017-07-03 16:02:33'),(200,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:33','2017-07-03 16:02:33'),(201,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:33','2017-07-03 16:02:33'),(202,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:33','2017-07-03 16:02:33'),(203,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:33','2017-07-03 16:02:33'),(204,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:33','2017-07-03 16:02:33'),(205,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:02:33','2017-07-03 16:02:33'),(206,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(207,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(208,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(209,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(210,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(211,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(212,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(213,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(214,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(215,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(216,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(217,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(218,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(219,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:07','2017-07-03 16:24:07'),(220,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:08','2017-07-03 16:24:08'),(221,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 16:24:08','2017-07-03 16:24:08'),(222,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 17:36:50','2017-07-03 17:36:50'),(223,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 17:36:50','2017-07-03 17:36:50'),(224,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 17:36:50','2017-07-03 17:36:50'),(225,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-03 17:36:50','2017-07-03 17:36:50'),(226,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:49','2017-07-04 13:44:49'),(227,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:49','2017-07-04 13:44:49'),(228,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:49','2017-07-04 13:44:49'),(229,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:49','2017-07-04 13:44:49'),(230,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:49','2017-07-04 13:44:49'),(231,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:49','2017-07-04 13:44:49'),(232,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:49','2017-07-04 13:44:49'),(233,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:49','2017-07-04 13:44:49'),(234,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:49','2017-07-04 13:44:49'),(235,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:50','2017-07-04 13:44:50'),(236,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:50','2017-07-04 13:44:50'),(237,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:50','2017-07-04 13:44:50'),(238,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:50','2017-07-04 13:44:50'),(239,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:50','2017-07-04 13:44:50'),(240,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:50','2017-07-04 13:44:50'),(241,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:50','2017-07-04 13:44:50'),(242,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 13:44:50','2017-07-04 13:44:50'),(243,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(244,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(245,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(246,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(247,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(248,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(249,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(250,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(251,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(252,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(253,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(254,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(255,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(256,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(257,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(258,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(259,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 14:17:37','2017-07-04 14:17:37'),(260,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(261,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(262,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(263,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(264,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(265,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(266,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(267,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(268,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(269,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(270,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(271,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(272,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(273,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(274,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(275,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(276,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 16:09:58','2017-07-04 16:09:58'),(277,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(278,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(279,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(280,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(281,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(282,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(283,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(284,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(285,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(286,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(287,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(288,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(289,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(290,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(291,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(292,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(293,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-04 21:00:13','2017-07-04 21:00:13'),(294,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:17','2017-07-04 21:00:17'),(295,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:17','2017-07-04 21:00:17'),(296,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:17','2017-07-04 21:00:17'),(297,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(298,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(299,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(300,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(301,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(302,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(303,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(304,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(305,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(306,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(307,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(308,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(309,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(310,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:00:18','2017-07-04 21:00:18'),(311,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(312,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(313,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(314,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(315,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(316,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(317,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(318,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(319,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(320,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(321,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(322,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(323,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(324,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(325,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(326,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(327,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-04 21:01:18','2017-07-04 21:01:18'),(328,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:46','2017-07-05 12:20:46'),(329,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:46','2017-07-05 12:20:46'),(330,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(331,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(332,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(333,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(334,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(335,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(336,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(337,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(338,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(339,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(340,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(341,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(342,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(343,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(344,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-05 12:20:47','2017-07-05 12:20:47'),(345,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(346,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(347,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(348,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(349,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(350,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(351,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(352,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(353,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(354,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(355,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(356,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(357,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(358,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(359,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(360,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(361,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:30','2017-07-05 12:21:30'),(362,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(363,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(364,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(365,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(366,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(367,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(368,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(369,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(370,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(371,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(372,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(373,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(374,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(375,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(376,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(377,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(378,4,2,'¡Tu pedido ya está cerca de ti!','2017-07-05 12:21:49','2017-07-05 12:21:49'),(379,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(380,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(381,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(382,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(383,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(384,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(385,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(386,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(387,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(388,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(389,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(390,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(391,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(392,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(393,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(394,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(395,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(396,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 19:04:27','2017-07-06 19:04:27'),(397,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(398,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(399,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(400,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(401,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(402,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(403,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(404,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(405,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(406,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(407,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(408,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(409,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(410,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(411,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(412,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:27','2017-07-06 20:04:27'),(413,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:28','2017-07-06 20:04:28'),(414,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-06 20:04:28','2017-07-06 20:04:28'),(415,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:46:18','2017-07-07 11:46:18'),(416,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:46:18','2017-07-07 11:46:18'),(417,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:46:18','2017-07-07 11:46:18'),(418,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:46:18','2017-07-07 11:46:18'),(419,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:46:18','2017-07-07 11:46:18'),(420,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:46:18','2017-07-07 11:46:18'),(421,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:46:18','2017-07-07 11:46:18'),(422,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:46:18','2017-07-07 11:46:18'),(423,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:04','2017-07-07 11:50:04'),(424,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:04','2017-07-07 11:50:04'),(425,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:04','2017-07-07 11:50:04'),(426,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:04','2017-07-07 11:50:04'),(427,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:04','2017-07-07 11:50:04'),(428,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:04','2017-07-07 11:50:04'),(429,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:04','2017-07-07 11:50:04'),(430,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:04','2017-07-07 11:50:04'),(431,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:11','2017-07-07 11:50:11'),(432,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:11','2017-07-07 11:50:11'),(433,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:11','2017-07-07 11:50:11'),(434,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:11','2017-07-07 11:50:11'),(435,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:11','2017-07-07 11:50:11'),(436,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:11','2017-07-07 11:50:11'),(437,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:11','2017-07-07 11:50:11'),(438,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:11','2017-07-07 11:50:11'),(439,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:14','2017-07-07 11:50:14'),(440,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:14','2017-07-07 11:50:14'),(441,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:14','2017-07-07 11:50:14'),(442,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:14','2017-07-07 11:50:14'),(443,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:14','2017-07-07 11:50:14'),(444,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:14','2017-07-07 11:50:14'),(445,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:14','2017-07-07 11:50:14'),(446,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 11:50:14','2017-07-07 11:50:14'),(447,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:26','2017-07-07 11:50:26'),(448,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:26','2017-07-07 11:50:26'),(449,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:26','2017-07-07 11:50:26'),(450,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:26','2017-07-07 11:50:26'),(451,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:26','2017-07-07 11:50:26'),(452,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:26','2017-07-07 11:50:26'),(453,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:26','2017-07-07 11:50:26'),(454,274,2,'¡Tu pedido ya está cerca de ti!','2017-07-07 11:50:26','2017-07-07 11:50:26'),(455,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(456,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(457,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(458,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(459,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(460,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(461,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(462,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(463,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(464,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(465,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(466,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(467,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(468,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(469,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(470,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(471,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(472,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-07 15:37:55','2017-07-07 15:37:55'),(473,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(474,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(475,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(476,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(477,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(478,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(479,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(480,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(481,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(482,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(483,274,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:47:38','2017-07-11 12:47:38'),(484,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(485,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(486,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(487,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(488,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(489,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(490,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(491,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(492,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(493,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(494,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(495,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(496,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(497,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(498,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(499,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(500,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(501,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:03','2017-07-11 12:56:03'),(502,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(503,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(504,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(505,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(506,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(507,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(508,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(509,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(510,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(511,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(512,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(513,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(514,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(515,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(516,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(517,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(518,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(519,4,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 12:56:04','2017-07-11 12:56:04'),(520,305,2,'¡Tu pedido ha sido recogido y ya está en camino!','2017-07-11 14:22:15','2017-07-11 14:22:15');

/*Table structure for table `order_details` */

DROP TABLE IF EXISTS `order_details`;

CREATE TABLE `order_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `subtotal` decimal(6,2) DEFAULT NULL,
  `total` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_order_id_foreign` (`order_id`),
  KEY `order_details_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_details` */

insert  into `order_details`(`id`,`order_id`,`product_id`,`quantity`,`price`,`subtotal`,`total`,`created_at`,`updated_at`) values (1,1,1,2,'15.00','30.00','100.00','2017-07-06 19:08:23',NULL),(2,1,2,4,'10.00','40.00','100.00','2017-07-06 19:08:23',NULL),(3,2,3,2,'14.00','28.00','100.00','2017-07-06 19:08:23',NULL);

/*Table structure for table `order_has_user` */

DROP TABLE IF EXISTS `order_has_user`;

CREATE TABLE `order_has_user` (
  `qualification` int(1) DEFAULT NULL,
  `comment` text,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `sendenboy_id` int(11) DEFAULT NULL,
  `qualification_user` int(11) DEFAULT NULL,
  `latitude_user` varchar(100) DEFAULT NULL,
  `longitude_user` varchar(100) DEFAULT NULL,
  `latitude_sendenboy` varchar(100) DEFAULT NULL,
  `longitude_sendenboy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `order_has_user` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conekta_order_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `sendenboy_id` int(10) unsigned DEFAULT NULL,
  `business_id` int(10) unsigned DEFAULT NULL,
  `status_id` int(10) unsigned DEFAULT NULL,
  `order_number` int(10) unsigned NOT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext_number` int(10) unsigned DEFAULT NULL,
  `int_number` int(10) unsigned DEFAULT NULL,
  `postal_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colony` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliveryAddress` text COLLATE utf8mb4_unicode_ci,
  `flag` decimal(5,2) DEFAULT NULL,
  `comission` decimal(4,2) DEFAULT NULL,
  `shipping_price` decimal(4,2) DEFAULT NULL,
  `total` float(10,2) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `initialFee` float(10,2) DEFAULT NULL,
  `insuranceFee` float(10,2) DEFAULT NULL,
  `kmFee` float(10,2) DEFAULT NULL,
  `distance` float(10,2) DEFAULT NULL,
  `deciding` tinyint(4) DEFAULT NULL,
  `isPaidSendenboy` tinyint(4) DEFAULT '0',
  `isPaidBusiness` tinyint(4) DEFAULT '0',
  `real_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_sendenboy_id_foreign` (`sendenboy_id`),
  KEY `orders_business_id_foreign` (`business_id`),
  KEY `orders_status_id_foreign` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`conekta_order_id`,`user_id`,`sendenboy_id`,`business_id`,`status_id`,`order_number`,`street`,`ext_number`,`int_number`,`postal_code`,`colony`,`city`,`state`,`deliveryAddress`,`flag`,`comission`,`shipping_price`,`total`,`comment`,`initialFee`,`insuranceFee`,`kmFee`,`distance`,`deciding`,`isPaidSendenboy`,`isPaidBusiness`,`real_time`,`created_at`,`updated_at`) values (1,'ord_2hEq7uq6wZVJeYKHE',5,1,3,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Cuautitlan 211, Colonia Chapalita','2.00','15.00','10.00',95.00,'Envuélvanlo porfavor.',9.95,2.90,7.50,745.00,NULL,1,0,'2017-09-02 17:19:42','2017-07-04 17:07:14','2017-09-20 18:30:12'),(2,'ord_2hEpi4KhBxbckSh5F',5,1,3,5,41,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Cuautitlan 211, Colonia Chapalita','2.00','15.00','10.00',35.00,'Sin comentarios',9.95,2.90,7.50,745.00,NULL,0,1,'2017-09-08 17:19:45','2017-07-15 17:07:14','2017-09-20 18:29:17');

/*Table structure for table `orders_history` */

DROP TABLE IF EXISTS `orders_history`;

CREATE TABLE `orders_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `start_order` datetime NOT NULL,
  `complete_order` datetime NOT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext_number` int(10) unsigned DEFAULT NULL,
  `int_number` int(10) unsigned DEFAULT NULL,
  `postal_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colony` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_history_business_id_foreign` (`business_id`),
  KEY `orders_history_order_id_foreign` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders_history` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(10) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT NULL COMMENT '0 => Rechazado, 1 => Aprobado, 2 => Pendiente, 3 => Baja lógica',
  `vehicle_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `stock` int(10) unsigned NOT NULL,
  `weight` enum('00 a 05 kilos','05 a 15 kilos','15 a 40 kilos') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lenght` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_best_seller` tinyint(1) DEFAULT NULL,
  `in_promotion` tinyint(1) DEFAULT NULL,
  `all_day` tinyint(1) DEFAULT NULL,
  `istop20` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_business_id_foreign` (`business_id`),
  KEY `products_status_id_foreign` (`status`),
  KEY `products_vehicle_id_foreign` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`business_id`,`status`,`vehicle_id`,`name`,`description`,`photo`,`price`,`stock`,`weight`,`lenght`,`height`,`width`,`is_best_seller`,`in_promotion`,`all_day`,`istop20`,`created_at`,`updated_at`) values (1,3,2,1,'Mejoralito','Sirve para aliviar la congestion y así','products/3/mejoralito.png',10,50,'00 a 05 kilos','4','10','9',1,1,1,1,'2017-08-15 15:45:04','2017-08-15 16:19:10'),(2,3,2,1,'Cocacola','Refresquito de 600mil bien papu','products/3/cocacola.jpg',10,400,'00 a 05 kilos','10','20','30',1,1,1,1,'2017-08-15 15:45:04','2017-09-29 16:38:08'),(3,3,2,1,'Sabritas','Unas papitas bien ricas llenas de aire papu.','products/3/sabritas.jpg',14,50,'00 a 05 kilos','10','2','15',1,1,1,1,'2017-08-15 15:45:04','2017-08-15 15:45:04');

/*Table structure for table `senden_data` */

DROP TABLE IF EXISTS `senden_data`;

CREATE TABLE `senden_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacity_terms_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_and_conditions_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `senden_data` */

/*Table structure for table `sendenboys` */

DROP TABLE IF EXISTS `sendenboys`;

CREATE TABLE `sendenboys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `vehicle_id` int(10) unsigned DEFAULT NULL,
  `insurance_policy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `circulation_card` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clabe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inLine` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sendenboys_user_id_foreign` (`user_id`),
  KEY `sendenboys_vehicle_id_foreign` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sendenboys` */

insert  into `sendenboys`(`id`,`user_id`,`vehicle_id`,`insurance_policy`,`circulation_card`,`license`,`plate_number`,`bank`,`clabe`,`driver_photo`,`vehicle_photo`,`inLine`,`created_at`,`updated_at`) values (1,2,1,'sendenboys/insurance_policy/2/1500572640.pdf','sendenboys/circulation_card/2/1500572640.jpg','sendenboys/license/2/1500572640.png','JKL-98-21','Banorte','2313872309987223','sendenboys/driver_photo/7/1501191997.png','sendenboys/vehicle_photo/7/1501191997.png',0,'2017-07-16 17:14:18','2017-07-20 17:44:00'),(2,6,1,'sendenboys/insurance_policy/6/1500499152.jpg','sendenboys/circulation_card/6/1500499152.jpg','sendenboys/license/6/1500499152.jpg','jkh-96-65','Banorte','4587632185457896','sendenboys/driver_photo/7/1501191997.png','sendenboys/vehicle_photo/7/1501191997.png',0,'2017-07-19 21:19:12','2017-07-20 15:13:08'),(3,7,2,'sendenboys/insurance_policy/7/1501656546.pdf','sendenboys/circulation_card/7/1500575739.png','sendenboys/license/7/1500575739.png','JKL9918','Banorte','348923789378343434','sendenboys/driver_photo/7/1501191997.png','sendenboys/vehicle_photo/7/1501191997.png',0,'2017-07-20 18:35:39','2017-08-02 06:49:06'),(4,16,2,'sendenboys/insurance_policy/16/1502261323.jpg','sendenboys/circulation_card/16/1502261323.png','sendenboys/license/16/1502261323.jpg','98-kj-jk','Banorte','328172381729381729','sendenboys/driver_photo/16/1502261323.png','sendenboys/vehicle_photo/16/1502261323.jpg',0,'2017-08-09 06:48:43','2017-08-09 06:48:43');

/*Table structure for table `service_dates` */

DROP TABLE IF EXISTS `service_dates`;

CREATE TABLE `service_dates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `service_dates` */

/*Table structure for table `solutions` */

DROP TABLE IF EXISTS `solutions`;

CREATE TABLE `solutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `solutions` */

insert  into `solutions`(`id`,`name`,`created_at`,`updated_at`) values (1,'Reasignar sendenboy','2017-07-06 11:28:39',NULL),(2,'Cancelar pedido','2017-07-06 11:28:47',NULL),(3,'Reembolsar','2017-07-06 11:29:16',NULL);

/*Table structure for table `statuses` */

DROP TABLE IF EXISTS `statuses`;

CREATE TABLE `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `statuses` */

insert  into `statuses`(`id`,`name`,`created_at`,`updated_at`) values (1,'Localizando','2017-05-09 23:02:09',NULL),(2,'Localizado',NULL,NULL),(3,'Pagado',NULL,NULL),(4,'Recogido',NULL,NULL),(5,'Finalizado',NULL,NULL),(6,'Cancelado',NULL,NULL),(7,'Entregado',NULL,NULL);

/*Table structure for table `tkey` */

DROP TABLE IF EXISTS `tkey`;

CREATE TABLE `tkey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akey` varchar(45) DEFAULT NULL,
  `description` text,
  `isUtilized` tinyint(4) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `akey_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tkey` */

insert  into `tkey`(`id`,`akey`,`description`,`isUtilized`,`order_id`,`akey_user`) values (1,'221','Test',NULL,1,'1'),(2,'895','Another one',NULL,2,'4');

/*Table structure for table `token_user` */

DROP TABLE IF EXISTS `token_user`;

CREATE TABLE `token_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text,
  `user_id` int(11) DEFAULT NULL,
  `platform` int(11) DEFAULT NULL COMMENT '1 => Anddroid, 2 => IOS',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

/*Data for the table `token_user` */

insert  into `token_user`(`id`,`token`,`user_id`,`platform`,`created_at`,`updated_at`) values (2,'19d48c17ffbd2b6d35175930b91458102a2e50ceb0862ea9d3f6394cbe7739b4',205,2,'2017-06-12 13:26:25','2017-06-12 13:26:25'),(3,'cRLSi_SxGbE:APA91bGO4y3bhFbcRUMTK6af334mBDRRldhc9edDDnzpBIYuEGE98VkAPjiaXrmnn13IlB0vrM4RlYgbpp0J9ntxaWjYgtLemcg0boiqPd4HMJg0ZYjJf0FzoWAQeaG5J7TQ0dNlkMtB',205,2,'2017-06-12 14:02:55','2017-06-12 14:02:55'),(4,'3dbaa4da6e0d1a8eb261f37e4dd5dde211463a35db2f7d3a3c9b8563129a26d3',4,2,'2017-06-12 14:42:47','2017-06-12 14:42:47'),(5,'cVXL86mvIdI:APA91bE0KyvRf_tnjSKfpRCc6LG9D5ZaAxEMXdPJ299bta-6KA-rttyCZlngEBtqLroFesyMWWN60rIb_tp8rTExKEpIpjegEyL0OAU8DCe5hyUrYLcQ8SkfU7aLWJj387NW8M-CtTaO',205,2,'2017-06-12 18:07:34','2017-06-12 18:07:34'),(6,'e_7LLyu5WYo:APA91bH7ubiC7Z2GFDdivc5Yx1aldVX3Sb-Ja2_ea3jbWysYtU7DdGTJK4bDeI9UNyEXB4-sDmOjXsCh6L-rY0qA7nTgW3ykF3Y2ZfYZmlDu2IRSffTLlCg89jrO9ofj1yPljC6z6OFK',205,2,'2017-06-12 19:27:16','2017-06-12 19:27:16'),(7,'ciBP-kdKuEk:APA91bElNoZyNwtP2bfjMIitfZM37cL9sCNrhCfDveHZTFfKENWexJJ0vr3z0R752hITsT5M7CHTJx1VB8oIFyq-G9MOrb971UoGq24y5r0c_o7ZGrCIi-0Rz5aCpbDrvpNApMmWhbQR',93,2,'2017-06-12 19:38:35','2017-06-12 19:38:35'),(8,'cQ7iVu7QG6A:APA91bErctpRLrBnb5gToM0qlRooBgY-xM-72Ix8iDFQBfE0mw_JXzMI9Z85f1WsMXzAgQvAqW3j8sBcSC-tOv4d06QNrWnREDd-ERF7dNZX_d903QIZbeNNRXqDQUbfJSWBvM-4S7z8',93,2,'2017-06-12 19:54:48','2017-06-12 19:54:48'),(9,'fuw-d60GNXo:APA91bEAoo-edoGn3lknkDNOFtq_V7fX4HdFtIzK4ssqJmCmGx8ijY01YPI9FZuDlWpZOgr13FhJvzDJCtSi3En0sC-LeYf66ZqlBJXZc_o15owzrNc8txbgnRhs0SCgcByg7YSU9JBF',205,2,'2017-06-12 20:08:48','2017-06-12 20:08:48'),(10,'d3FenDolWcQ:APA91bGe9J84B43gwTXJbOT7IOSAsfMkGfLuG8-_rkwU20XE0XQ-ViHeRfzg2-VO6RI_OcCFU5JwA8c_F8VFkdgojSpVjxWOQd-Gxc28gDKqiJGcKh-HxCVxDe7YOAC33VqzHguGZNLN',93,2,'2017-06-12 21:07:19','2017-06-12 21:07:19'),(11,'dN1GVSPryCw:APA91bHA5aGyrzDVuPqhvFogiiFzyi3droU48Hi_3YqzRozMuUIWhtSgEqpvXymVo3QksNvS7K-6WF2bAOwrNHg0qnb1AwXC80RakpHLAEj4kCZpaHKvFm5B0iJjVeNl9_UR3darvN-u',93,2,'2017-06-12 21:32:00','2017-06-12 21:32:00'),(12,'fnRmhXBkm5k:APA91bH7sdRDk6aSPJnbvs8FGESkN_IWGm4lHE8b2XjS8RqKLcNSHhYO_1oWWBt3U8ILtsdd_fz1iMfTPuzzN5bMBNywFeL9JTbsnZW3TKlmPL52CxjmxADmAg0FAUHWXuF5AIquKvTj',93,2,'2017-06-12 21:39:17','2017-06-12 21:39:17'),(13,'jdsshshdgajdhsdgsfdghfmsdjnfhui234y723843824kj234n',262,1,'2017-06-12 03:00:00','2017-06-13 00:54:11'),(14,'cYcN-3wNaco:APA91bHfKDFxZdbUMxP3kzTH1oakRgG0zJiWt9oPiQDcwCu6KpGMtmzVdlz6gKTpdfoUVWupobMYnEFEemmsTIxUFmM-NBlUMmOsKF00PU7XaCrF21Rih8clnU8PUOarU5XB3EKlb4oW',4,2,'2017-06-14 00:27:51','2017-06-14 00:27:51'),(15,'cRpvNUPxMvU:APA91bFS-qTtXD9cVmJ2uFN8jJaav88ffhFMLj2DmELwhIey9X5AyRjy8ZQN05rtVJtRAbZYnt2Z6YJXC0Pc3oRKnhp3q8N55yCmMDcc231H3YPQZrzX_0M476LK4vnD4Mazs-tziwUE',205,2,'2017-06-14 00:28:15','2017-06-14 00:28:15'),(16,'c6a37ce003012db98572d75b2627ae180468a1a47d60840e808cf4a16d55b270',4,2,'2017-06-14 01:57:38','2017-06-14 01:57:38'),(17,'10cae57627766ec6381969686181755bf2ac22d05c14730d4abd9976e72e6694',4,2,'2017-06-14 02:04:28','2017-06-14 02:04:28'),(18,'afb38c58e35d5fed204d497c770125f6694c98ce5039b3d4c820ccd29146cf89',205,2,'2017-06-14 02:06:59','2017-06-14 02:06:59'),(19,'f4Ob3FuqaJo:APA91bGYNsT5xcvO89wh0EE_NnYCc3oIJ1SWOWZeJ03-KwsQ1QUskZbi94m4EBb5HKD-c_Qv1ONrJo-mu1jGRulpsvvubhXqjskci2APA3jhxH3PyxZvfALhCvF_g7v_Vx8wVdzzR9bP',4,2,'2017-06-14 12:11:42','2017-06-14 12:11:42'),(20,'f5WlfIgH1xU:APA91bHOs4QlLZnN-MOjD8-s-TUi35enqQdgHqUTCVREF16MVL_jcEFkRN6XlZxPi_XgfxBIUbuDTLoHkmpnO0jmnWzpVRwOcrLKifKP3OMgJGNenCNAJkbdQ3eGInXDjmRR5Wh4sowr',93,2,'2017-06-14 12:12:29','2017-06-14 12:12:29'),(21,'c8p4329eT7I:APA91bE556C4lxYmyGB1fHFGk-qn8WE__CRGfHkZGFJtKesigAxMrLtrj2BEfzHGRUQdB2RS7CPrX2w6VviA9O4yrgqvOMipSmisttailw9TU4NJo-DdlQZOCvEOrVB1V2gaB_gE0FIv',64,2,'2017-06-14 12:43:23','2017-06-14 12:43:23'),(22,'cd34a23cf6727bfa277e5370194be3e6f898ae70b8f5aafa85b2304e71dddb59',4,2,'2017-06-14 12:47:11','2017-06-14 12:47:11'),(23,'3b7f8e4d6fd30bf4ddcaf78d8081469846f8f01595430d8f322863a3c50bcb03',4,2,'2017-06-14 16:22:34','2017-06-14 16:22:34'),(24,'caCFOOcaRwU:APA91bHGZtDveP7uSHWYj6UUEpJ_W2liCvEWLavL8GDTAeRPjPeab1-SWEyJEqs6d4ATJH6AMyIbDq3BVJS9FQmP3Dh7MX_E5nuP8O9EpkO36l1lxr9ZDMa3-43BrZzwiFO6qV5mxcX5',265,2,'2017-06-14 16:41:08','2017-06-14 16:41:08'),(25,'6605958278a96683d82bb0a02cda5b4c5bacbe96f9f7d71782e9e18119f47da6',205,2,'2017-06-14 17:14:51','2017-06-14 17:14:51'),(26,'cbqC3thllKo:APA91bFZN64IKYj-pZDizy2oUB_EzInZsnlmK3ZDqrvAIeM5ODGXOMjhAG6FwCe7aukD1wD1GpXHMbhqQX4_7OVZY_pMbvPlT4ySIR9kcUtuwLiSASiHrQImZ9chg7QM28EjvLoOwe4e',205,2,'2017-06-14 19:12:42','2017-06-14 19:12:42'),(27,'f_Q0rnbXS-M:APA91bHLi9_tJST0TnCnPuKo8jquWwnWv02G3EyY_FA0smKXV6KQv27Ee_wxC5sYigUl8rgnS8qSRquZ6Rytgt_EjVyMlLu68Cxq1eXvnXbPhgcC5S51WxTXOSavnFW82s2ISdUsAOnG',4,2,'2017-06-14 19:13:14','2017-06-14 19:13:14'),(28,'drpRrSJly9Q:APA91bFSKZBM1JDd5On0uzcLY6PpSfu11nEdbBwUIEvs3-sXh9rjeCb5J3XPCEJs_m5oaIMzaneyuzWTR_u-ZWhBxdpns_neJbqfB4Djh2GIbYwDYgC8tQ9gCcPEIP2ckW0li_zotDpk',4,2,'2017-06-14 19:36:38','2017-06-14 19:36:38'),(29,'fP-cHg6jToo:APA91bH3hCJKXKK4_8Gvpa2ekBEaDQP6Jnz9nKRga45K8Y4wyHRx6Ynu-HYjsbiMb913Xr8rijj9LoT8b6H_M0M5kqtrSxGaF8NL-m7LGvWzAYTgjEti9ShC8K76SeX9SM7oORxmbB-T',4,2,'2017-06-14 19:42:09','2017-06-14 19:42:09'),(30,'ftDMb56gLko:APA91bFkYj9m85HqHYEkuQTw9PGetskQmPjyrk6MVG9ZTECFzE_nqS2f-EtcO_kRNigdVGGLs0sQnyX4zS64SlfQVQpPB8_QRrih9otF9tHgtaMNQZVh-rUpW58LTOI_LmhSyv7BLpAe',264,2,'2017-06-14 22:57:58','2017-06-14 22:57:58'),(31,'d_mjIAVyea0:APA91bGCt2BOKQi1E7CA-pGQKjRCX2gkxdHQ7kDQXedSXMy4l0flzR0iybQgcrTCZ7x-9IxFz7rdfaxYIJYFPJ96e7okqiTANx2v7rckMlRMbAONOryLWVop0a6SITDN1NkJTvI3qtNS',232,2,'2017-06-14 23:01:58','2017-06-14 23:01:58'),(32,'fd2feb954f11b3f6ac9a376fce9b4f94c68ee7f2fa67b5dabbf2f09f9b23343f',266,2,'2017-06-15 02:37:45','2017-06-15 02:37:45'),(33,'ab96b286214a6f6d311ee081bcdd2b222bdf5fcb1524a0e955e602943422748f',232,2,'2017-06-15 12:02:13','2017-06-15 12:02:13'),(34,'af6b71a33b407333eb0dc0b8cd771262cd79e0aaf2da6b6c412d797ed5a6179f',232,2,'2017-06-15 13:30:08','2017-06-15 13:30:08'),(35,'74f48c67de33cf26450a8faeaa8cfe667b14318c2d807e511d4adfa83cd09600',267,2,'2017-06-15 14:26:17','2017-06-15 14:26:17'),(36,'fbb78cdf75ec0e40650f113e0bd8df4b266c3682d70cf9fd28c2990d148eca92',268,2,'2017-06-16 00:24:55','2017-06-16 00:24:55'),(37,'4fe8ce1281b6c59345e16250110a487bda746155c8d6838dff6fdc3b91afd9ab',269,2,'2017-06-16 13:32:39','2017-06-16 13:32:39'),(38,'eb50a03319f5d8b5b6b24d0dfd34a5d5c67dcb6db668d3408fd154c648df58b9',271,2,'2017-06-17 16:47:58','2017-06-17 16:47:58'),(39,'cQfmIUzceo8:APA91bGR0Q6VpQX_Majq4rW3fwiuWnzkigAHDN6idd_IBgsavffTfIa6BRwhtVqEUcNgzdjUZS-ytic_0qUOvM-YJgpN-3PX-NRzJjU_kiqePrX56ZhSKYZgJjJjcWqAfiQgG8DLcfpK',270,2,'2017-06-17 16:48:06','2017-06-17 16:48:06'),(40,'cqqxslmUbOE:APA91bG9m4y5nLjNAbPpcaSo7CgXuEkwm4YoiWVhltR328Eo1NyVzugjgZ3juim6G99y3nLVGcGdBWgd2TP_o7EdWZSsFKuw4RxdgQRS8L4f5hWeFtgBxzoXhNiSJzQyarfj70r4Wxwd',259,2,'2017-06-17 19:43:33','2017-06-17 19:43:33'),(41,'fETSOc0ckLE:APA91bFN6hOV28oOn81oZVFu1zroHCwpzkRoNJTbdmWSlTPBMOJYFyEWbn2hSc18kzzIX-MwyrrWK0gCx5gzgg7GS7XvQiinItW3DBYJHkGjwW3t4wr2cSYKcXLY5r_BCzrE0CLrMvus',216,2,'2017-06-18 07:12:49','2017-06-18 07:12:49'),(42,'cgtLBVrtCpA:APA91bHM0tuKqirsu95UUVhHfbsdtwt48nTlZ3HMEd5AzpTV_zvG7cWacGwEfUXSaTkRkK5TuTz5ZNrvvzOBF959MpXp2GOwFaaaPKJ5wj8E4402OCUDkgZXNaW70ibfR26RAQ4TbApf',111,2,'2017-06-18 18:31:42','2017-06-18 18:31:42'),(43,'cqQP3UGR3o4:APA91bGp15iYmjrb1DDKctH3eDUPEvIXxv4nBCJFK7V-W7_8zzHeMsvKlMoSpaCNHAnCySDqZLeFaHMylVEdENdrX0Ga4FOFQgihNxqQeqXnTIZ1Bvis-9tQ5ZKRfqSrJ8gQ21rS6viW',272,2,'2017-06-19 11:44:06','2017-06-19 11:44:06'),(44,'ff67d9421870a977b977f1808b843244253a83e80148320ce975eec0a259dcd1',273,2,'2017-06-19 20:31:44','2017-06-19 20:31:44'),(45,'cAdTOVsImGc:APA91bHTSsPQ3HkXLvAWy-P5OzUpsyzdqxRlN9MRo7qkiUGWgwNJgksZLBws01ejkLWxnAkol8DCQUBQACwGpmCWjIGM0_FUq9Z1mfpbxyCSiZznmVX2DAXPPPIlj2tlwNRg46ehjT07',96,2,'2017-06-19 23:01:54','2017-06-19 23:01:54'),(46,'dcjhB1atIZ0:APA91bEOg5RuSRABGB4rqmk_cR8nHBWJ4yGswhJL7N5u02_VYRxO9r6ogSU8QHw9R0lzRcv5v0ctjQsslvFU0zsF0Ei5ZY7nV8SLP2rsGIouNzvHIrdb16-gJkwYFrR5MODdxgh5ZGZx',165,2,'2017-06-20 12:43:35','2017-06-20 12:43:35'),(47,'f4Ob3FuqaJo:APA91bGo-muMWDw2xw0oRmdq_n39lNl0VueDHWN30mhkGm__-IBmHy47_fNe7FkCCmVhPkrEgZjN9QhJw8bkGPeeonxyzdzs9hdan8lhSD7DgMuARfHv2MKkiWFtGBrorK92ZNlm2zCZ',4,2,'2017-06-20 13:53:50','2017-06-20 13:53:50'),(48,'fpEZDIiRedY:APA91bHPp6A2oevHVNEDr7CyB9xoYvl6MLLGdG-zVAUpqFco6yY9xybCebu9lps0Yzq84oxt4Hl9ze4UXRKrLbxp79d_jOTlD5sK9Drx0jFD7dK9ryccwphX7cCrXJuqPGQmJKveJYiu',232,2,'2017-06-20 13:57:06','2017-06-20 13:57:06'),(49,'cAdTOVsImGc:APA91bFslpLLKWcetdM76nPLTXKyB3jpdg-xkCgMaTzkQh1i_7BCslVuZRgW99IKk6hdS8FXSze54fo3FRE7KY-4Ml4cYGa8T9yMxw6V8AwJIvo4TuNwmVi9jQcaxH8lgfrMDiI4MNEl',96,2,'2017-06-20 14:00:09','2017-06-20 14:00:09'),(50,'fETSOc0ckLE:APA91bHw9VVHXE51hdc8NFZ5jVzoYunZWh3jNvveljP8762xnHHOfEP9hIy1sC-kRHlhCwKSSTzBNDK4uCOZFKpopyi41YoeARDTXW0TriEak7G_qeHOYDOXF_k1pzJGfXBRG5kYoHI4',216,2,'2017-06-20 14:01:26','2017-06-20 14:01:26'),(51,'7f2c290e7e311e7fa6149e01bd951e5984b3840d08158c697e201ab46f48ce65',93,2,'2017-06-20 14:03:03','2017-06-20 14:03:03'),(52,'ctdZV2wM-74:APA91bFh5zo3sxA1IRGae-Z6obC6PVhdF3ippkyenQWX4zWNd39LK3kb0Vfq70JMYW3R9GkLCBfrDr0XxYsrc1K4iwEZLgwUKGCuxX-yF5jahsCNDlI_njx202DXBG6wqKWYoqY8Tn0u',232,2,'2017-06-20 14:11:35','2017-06-20 14:11:35'),(53,'857dfdee1c336bd2bd89a4bd434bdd76d82132f8b3d474a5930cd8e8ca100412',232,2,'2017-06-20 14:23:18','2017-06-20 14:23:18'),(54,'87be28d7aee068e4d85b9a2682a95dd72d7bd568aa1e9611447ae61327028278',93,2,'2017-06-20 14:33:21','2017-06-20 14:33:21'),(55,'devZCmHboq0:APA91bFq-DWAmgrKWzNAlUt-7YF4jKWdxiTDTg-lcz6U3Y1HKV1DBufTmwGtZhSDS74o2RI3QVMTqRUhe0XHY3BWFcnFF9_azFzByRQqWMrGJgXEBLu6V5Z_AYZautvPK98QxJ2oVQad',4,2,'2017-06-20 14:33:44','2017-06-20 14:33:44'),(56,'fIRxCjhHjAk:APA91bE55iYIacb58i7NNGP8hkVNFzbxi9ucr4HM8kmMPtmpIW9HYf41tSvxCSjI6k-H226hX-5EYPpO7vOPHHV_18PSVHUP3mCufj92aqAjkKUv1ZNu8NPqLZph4Ayuyx10JphE0a3h',274,2,'2017-06-20 14:53:36','2017-06-20 14:53:36'),(57,'0717ae1f837d1c9864c2e289d74a8b20ac387d886fb3e2c733c6a2ed2999f4c7',275,2,'2017-06-20 14:53:57','2017-06-20 14:53:57'),(58,'cqQP3UGR3o4:APA91bFeD5Xz1YpQ3w1bcsL_UwaI_yWk5gJwcMErwYZfLaGoC4_Nk3OjEDraTlnG3mEOd1wfUzOYSUGyi5H4F9ZLA1zH5wt8aqIoxvANhW8yTwYrHs_GsinDVwb6zS6o8EJRQZrTNB2g',272,2,'2017-06-20 16:05:56','2017-06-20 16:05:56'),(59,'eIsOByfRQck:APA91bGGbKoE-qoKOW-e0pih7dt5wiQOIhIiOJWnpOLByVp0frYtqqlQaGzQddpgbdWoXy9D-Ld5pZwcp6YmEf1fmtOg25Zw4kptJJ5vnb29xNYnIH2DapUgtbx1wWPkd-VtvPZtgLxu',256,2,'2017-06-20 16:46:13','2017-06-20 16:46:13'),(60,'1235cfb59f30e5b4d27c5296d78800d5db047da8006db0bc15ebaf54dfa8b325',276,2,'2017-06-20 21:47:39','2017-06-20 21:47:39'),(61,'cgtLBVrtCpA:APA91bF411v9a9xjzXQI8pyhsSFIArNZwOLcQqiOGI69bncZuz5sjbhws8STo087QmnsK9Y_-wfoSaYKHTvI3XZkuiJpo20_QWRSLVLrXhsBCt3xjcmbFeZYHIWR_kIawsYj-9hcZV2F',111,2,'2017-06-21 03:13:36','2017-06-21 03:13:36'),(62,'dvz5m_XtEX0:APA91bEkDW08IJ4_xySUcdwlLSME02BPtLv7bgzP-VS0othrxeOgdudApmkinjc1najfGa5IsFmnzzY-348mStgUgcU6hnADNMhxw4CKRZl9Vr2pj-sEUlET79AXGZAyPMZc-ocdPlV1',280,2,'2017-06-21 17:05:48','2017-06-21 17:05:48'),(63,'frR89L1OB8U:APA91bGhECd2E4Ji5jb9zl2CqcJ2Fc224wMI-3WryW1pN9ySbJJF4gvtykI6uZe6tsXKMpZHqqOepwCy3S7CP273ffF-bv5JZq6J2oqp4S7a0fRF2SQ2Vjm4ePzdIfGvbaicEn2EAxFh',281,2,'2017-06-21 20:26:04','2017-06-21 20:26:04'),(64,'deO2twuZeWg:APA91bGsnlKrp2wATUrc_5ERPLv828sW5q78pba_svbeHECAFur0txAmw5Z4obSSCY6r6u-5fRB9byv-ImMbvi4l_hHSSjCjnoeeNNFKshwjy9tlSrWu1b3TX-B6LTedT3Ae6fLfs5DS',229,2,'2017-06-22 12:52:43','2017-06-22 12:52:43'),(65,'eVMqk3Og6DU:APA91bFtONWSn7BwoCmiduY151UMFKWSUR_ozzyHlc_bVTp0J96pDgf_DguYBlv3iXi_YYrsp1aCTSUyI-AqBr5aEsq1aS1bL8BpAQZu3BSp6Jes4rf4GrouWeyphufVv7KeTj9E8KNz',283,2,'2017-06-22 14:47:30','2017-06-22 14:47:30'),(66,'fDcrwkJ-0HA:APA91bFIt9msp_hQwpXyaokmrTWCTxgpWTtgJYFu7TrBSFbcW_OYs7UNqnPxXZM_FY97Jhkhz_dG1yrFPMMcgI68Vgiogv8qSSsVY2xl7XvJ1LtOCZVwUtDMhQL8_jEyFcn4FrzC_Yy0',282,2,'2017-06-22 14:57:16','2017-06-22 14:57:16'),(67,'eE640TYdtOE:APA91bF5NkeWfquFP4qyexV1_v-zkL2e-Chq3Kni-bdcbt0YPDW_d1woQPDo-D8ZNRtfpU1ADTo1jDojIcrYMc4UT0XgEnKfE4wI5Sf0Y5fpMz3e9qgFtZcjuLLX6vYcmCaO0ebbC-cv',282,2,'2017-06-22 15:01:46','2017-06-22 15:01:46'),(68,'eXR-NCw6xoQ:APA91bHzZ1vqRAOirZqJyevF7OHMIt-ZDvZaosJ64jE6u4b7LhfdhrYtqOmKp3fEy5vl329Hu_U2VcoOfu1YPGTOr_9EjwJ8MxSz1Udwt8n9knJMXI5LaakmjPp4-aAG8mwcrNC5mUX8',284,2,'2017-06-22 20:36:40','2017-06-22 20:36:40'),(69,'f8GVahJ1zvQ:APA91bF2qv3mq9XPVH4d3xiCubdGqG7Wv2uBGpAaUkR3yymgFwd_Zha0_9yrJqa7Ru-awzZ6kCBPrcV_1f6D0umSnAaDbyBQdhtRIyQwLd_LZ_TjYDeQVTBVP90Y04Dqz6aCzU2aJkIY',285,2,'2017-06-22 23:29:40','2017-06-22 23:29:40'),(70,'cKlPJtRcnFQ:APA91bEHzrkZk42icthOfkpFyJW1InGiNIQ_SnQ6XN3qvGbgKGu64P9HMdKi5M2ifFuRGKlG01DXpFYGjd4UrsX87VDExgOpocnmKEwGBUeBIt21b4bYiVc-cxXlovfMPtHK0iEzlsfs',282,2,'2017-06-23 00:13:18','2017-06-23 00:13:18'),(71,'fnetBqNptZ8:APA91bH7PiaHtW3_dqVVb22mky5tYGxIW0mfn32YY2RKHTM8Q9k0RY9pNr_aNixHp553hCVMqsIj4Y3wC85U74Bqo8A-7MA7oWUkeax7n2hqcxbv76BGao-iyPlDiqFaSMV1oINMiZlT',140,2,'2017-06-23 12:07:42','2017-06-23 12:07:42'),(72,'cSTsoScYlhM:APA91bH8bK-Gpd3sqMiIjekbLX0YdaU0ddhKP4jJKIfGZWre_KJWEl_3NK4uUoZ_0EXHCDeaxPmEkLzGeO21DUovVwCmDQCRO9R18cSk0KTY9RaSG600oPbvPvr6NeRi57wkPq5gQrri',232,2,'2017-06-23 15:32:46','2017-06-23 15:32:46'),(73,'c-kEmJHYR7s:APA91bGt2h_N7wXyc2nBhMNjvxSoSHAFo83LKE3i8EzSeBC-yNozSE6R5P-yGWwaufxH9wAT9ANfyVVvtX3o09Q6K09IylXKJHxVWGMW5DKXPOk9_iVgr156oP-OsP5v_P-Ka9p4x-6O',274,2,'2017-06-23 15:50:17','2017-06-23 15:50:17'),(74,'c8H7AWE78fs:APA91bF4Etdnyt6oP5qa5SnGARefWiEGhzBIDHnKJt9crSJpFVib4P7vPaXw3D2t5nUsSvhckNJf4sSbzJpEDn306g_3oMByyRRZF_eedRS4-RKF4PrzpD7cXNncSrChYPzhFfns3Ew2',274,2,'2017-06-23 18:57:52','2017-06-23 18:57:52'),(75,'eeutwbXznnA:APA91bFJ3AqbEU-K2QmLmTig9S_AH193Xhb5eK8zhKORrmA26AO5xzW2vn919FNwiPPbOu1Q7XHKGmLZH7qt5OSiRJaWdHVRSqb9wD3YvyoMaeIr4KCzQApyqv7V96JTyn4zTzubUagd',129,2,'2017-06-23 19:34:59','2017-06-23 19:34:59'),(76,'fLCDc-c8Szw:APA91bHo8Q9vvbrPcQfClxcufyJcgySHgPe9D1da6rxopY_8hQw0B149si6VWIAzDwUEgTTdPTXL5N0pyrXwWcAiduBFXBTvupL7v3J8sWxAYlobEWqX5aJtL1NCGzG1hEIC1NmsPXfc',286,2,'2017-06-24 18:22:01','2017-06-24 18:22:01'),(77,'f12Bm8QbLYE:APA91bHzwoV2csa7g5Mq9wo2cUDbBm6_zuPYo-Gih_gprvEW92L3GEhjFEot5zlLwyrqwYepZPUOXeGU1fAcAmVTSts_BjT735Sep5H2GVKS8RvzJQM4bztyEOMnylU_rlJO3eujTQqg',287,2,'2017-06-26 00:34:47','2017-06-26 00:34:47'),(78,'fM_JTu-UhA8:APA91bFwlAVDUJN-vSIF-VybrcCn1WvymiEBhLvW7LpKlE69HY-Wh1wXPxUlscJxD8Af3tkl3xBZtugkDYFtjGSfI4CHCf4ZQbfnzQphlMpZmAV4nI7hh4WXqUxZ0k47u5uQ4hheEKBy',288,2,'2017-06-26 20:12:39','2017-06-26 20:12:39'),(79,'cJZ7xjjbpzs:APA91bFUd7Q6_FT97LuZb5UQtIUITM4G4ASR0CkMzCNUGHr5JMRQCIgI0Kx8h7EqbmOQDF4os1p3wC4X3lU8gcHuE6K7xBn6n4JI-aDInLkzeOnhucJ2_LzlknqxCajs4-m66lnUfNcu',220,2,'2017-06-27 13:16:27','2017-06-27 13:16:27'),(80,'a806b1e5af7d27cbd2509a1ee4568da138c6b139ec92bc1803acb250a9b46ff7',289,2,'2017-06-27 16:31:09','2017-06-27 16:31:09'),(81,'f40EWdju8qE:APA91bEaZELMAdIT5mI2nhZEUPD76UMtXlYEr4_vlznSUBlcCji_6MKkJVx5QITdcVt4-zTIsRKRjBqkUfzkmXm1zdjqhMjnHCD5dZxFcCcIIylTG8LEEKOv1okU4dsIeh28_btBcKSf',4,2,'2017-06-27 19:11:29','2017-06-27 19:11:29'),(82,'002f8958aa2fdc360b641d267428f4ecbd6bbba3f5012e54150393549d6ff733',263,2,'2017-06-27 23:06:35','2017-06-27 23:06:35'),(83,'fUivxDilbE0:APA91bGzEWKFeK81Io2FallgoK0hQH_9mUN-kbgruV9V7dXCnKFjOmxVveB2_oTWBinKoiNC_w7FuZBi3e6zZ-Ss5RrXz0zEe_I0_eTwwiY3W22uAWIN_uT59pwGDkoAX0hdbnfC1OQs',292,2,'2017-06-28 02:10:19','2017-06-28 02:10:19'),(84,'b0ed33e25a8dbfcd13c98bfbcc443ca27a8250bb94ffaa7743f9b764799669e5',293,2,'2017-06-28 17:20:56','2017-06-28 17:20:56'),(85,'fFqF_Igr9E4:APA91bECUOIIBlI2nbYK_DgClPsyc1b5fAFCK83cstQkltfjaeApao2f8tWLmaiDpZtNkGyp7qkAEbFfwrxe2eKD02rRxYXSzTrg_AakVHy5NlOeSdqepyEl3CH7lMaaDQlzMq2eRi61',59,2,'2017-06-29 02:01:01','2017-06-29 02:01:01'),(86,'e6pPcuSS82o:APA91bEApJs0aBItjDCBLDYzS0erN3mEobpUMOQsB0OTw0DSn-xT27XuBlpaitsB1XnZp3SW2W-j-mIVXv9JkD5exU6CRmEIFbAMv4mbTzk1Ijo38gImvP3Vu8hvxAUZfgQ6caF1r-r3',4,2,'2017-06-29 14:17:11','2017-06-29 14:17:11'),(87,'doovb3w6FnI:APA91bE8G82i9b6Xc3IIK21bNdsPeczFKYTnAtmCNN3s1zeiOJLSRpEBSOPdC9-z-SRQPiK0Y7aIKbIfvo_ky-_y47t3FAXXKXGB640PlwbEphuOpljxxy5-ysZxhVGjdC5G6qvwksZM',274,2,'2017-06-29 14:38:17','2017-06-29 14:38:17'),(88,'cqqxslmUbOE:APA91bERytKTuhv9tIrsIFiVQC45VrKA7A5MP5leT0y5NTRyB_OofvkKANxQ6OQMoNWUdh-cpvRNJQ0JO3BP2XqZKVx1cP1GNuf_cNri8FRnBuR4udxcg0MsYYQRL1xQHE-fx1GrCGJW',259,2,'2017-06-30 00:32:13','2017-06-30 00:32:13'),(89,'fCmNN5GigVc:APA91bF2bo0qNMd26vWkfNIgXYBiXbR1QHSsswXLtro-vr9q2F4lr373NHUv6RyRDXAe4H1Dh1CEh6w53CwPgb9oyhwJJ7BR7ruyzQQATq4DpUd9xKVhN29tZOyYR7y3UT1ioRAQOonJ',183,2,'2017-06-30 07:19:31','2017-06-30 07:19:31'),(90,'c8p4329eT7I:APA91bGBGi39HXnyXyxdGm-6AuL73V6LZmKZWMXqYkTh0mcE4GK8lt6JtewAFyGvsYqWBvmZi1wHBXFolcBonuIoC2qDVaYltXoc15hVV44i-wH0El55XKe9kg_7cvrT7eD-9oo4KPie',64,2,'2017-06-30 09:58:16','2017-06-30 09:58:16'),(91,'frnYCnE87XI:APA91bH4Op_w_xBPdNvUvCXPJpTot0BuWPrTRLVNvai7XuI_Ll-bt2ug3Fklq1QH5laxXbcrPjnXMwuzy7tpw9g3kxEeUjaWgxeBd-Jb6-1U9xy2LrXxRmlVZ739gZ19c_jKXxUKZH6e',44,2,'2017-07-02 15:57:06','2017-07-02 15:57:06'),(92,'d5adf6c878a6214205c571ae398df91b41a2a6056d79933977cd2812d845b2a5',4,2,'2017-07-03 15:27:05','2017-07-03 15:27:05'),(93,'0a371ead027b6119bfb5fbdbd8a2a88584b1be03132523cb9b05326e06281600',4,2,'2017-07-03 15:57:59','2017-07-03 15:57:59'),(94,'dSImp1eioUo:APA91bHiezVY3zTCUZ4n-lms4w0h0uPzNvqiTaWXUpiKD2XGEN2-A6e4U-tEtJF1og7ScrKwMZ62bU95s6kgRcCwytBnqxTQh03Xz9wTWH3PCwANI5xoPKfN5ZJjYn7YIKy30kS1sgcq',300,2,'2017-07-04 01:24:41','2017-07-04 01:24:41'),(95,'dpK1yHiFKrY:APA91bHzkhxuWX5rjiNa0TChTj1e3uiy-XwGUs1nTekIu5ZzFU8Y-GchLkMk-2qeOWo2jSG5xFW7IL8HZAGFgBX2kWJ6x_q7YF2blLWSbMbLm_Uf449NZ_xGrTpkNV5PnQR3hohtTZt2',301,2,'2017-07-04 01:56:12','2017-07-04 01:56:12'),(96,'b73af5b3fd0226263745d5871b387a8e45368942046431c06ec2ed381af4348e',205,2,'2017-07-04 12:54:25','2017-07-04 12:54:25'),(97,'f_ZtHQAfP70:APA91bHo0kDDwO3KTbZ0jx6JvFsThBHTz-eJB54-Dgt84z2C2diaqBM6cLpBp-_yiE-h_zicc0zVI5rw4YVrm0CEVwYIgg1yD8s0rypjEAUSsrCaul_zPf-zCmmbuLmJzj0nqKS9pN8x',274,2,'2017-07-04 13:40:42','2017-07-04 13:40:42'),(98,'d6681KcNal0:APA91bGzC9VXKpTjW_GJWrFfpKVuompv6YHPdOCNfzfPOf0WvgfyBrGVc_DF6wKDzElNnNnktiQ4bGyZbFJd_SVTGFwA96Oy5mSXxdQEidU0vGF4mCGWfaRU1BOxEGhxJChJFDutsYMN',274,2,'2017-07-04 13:41:48','2017-07-04 13:41:48'),(99,'9feb715f9a45d3eeed7979fa111a214f79ce821c1c9edcda5d719403d0707997',4,2,'2017-07-04 13:43:07','2017-07-04 13:43:07'),(100,'dTAzcYVyWf0:APA91bGG0Bc0N9zt0PDRnvZpmOmyv1I6h0RoFiGWU3-fVZ9clKCigZOvou_9YRMj69Ps2h0QAhc_aywjoJrxaM9rdRncaRTau9I4UpMcvy9zFHws2qp9Z_2xDhc3SGL3CgKBfpZqVD9I',205,2,'2017-07-04 15:05:06','2017-07-04 15:05:06'),(101,'daHaBbU4el8:APA91bEadv4564BSOKjUDzXd0aI68LBo_T3qQRefAksoIfytH8oarUrndn9wzRbqebvmTckDqvQijsjJ2NRIR0EF1Ab_5sCUgwMv6l0rd4hJ0tgXEFE52LlMZ2Icjr1wyJ-RKYB5qBIq',302,2,'2017-07-05 01:35:34','2017-07-05 01:35:34'),(102,'c3BjUmyc1MM:APA91bE85Eho5wK0PpFn0mM74luYkrswEvZ92PkntvWdG79AmTcmlNG0GA7tVoUcmbnC_jiguEIZyqu2Qvev1X1WoSZYM66Zi7aT8lCuX5CuQwExQuzjoJafDLlWseF_4CbKkgvZPMl2',4,2,'2017-07-05 19:24:39','2017-07-05 19:24:39'),(103,'cxivr9cFV9I:APA91bH42Uobn_4cxwKquGadBb3N7jetwJbmfauT702ERp4ZVO5SP9gFiq2qjaapq6L_FU3B-RyWtstxGWp7envV85UplLKyAE2KpON1Q11apt_gW_0dPD6HTJVpiqMigsCHAMM4iju0',93,2,'2017-07-05 19:34:42','2017-07-05 19:34:42'),(104,'fquXTaeRAzc:APA91bH0kvJgqZNcRap0MKr4q34gSyIdO6-LX0ntrHn0_NnUfhiE5lxc2ta4fNWbaNIt-B9kaVgsvzSwAKe0nu82lj4mmOBzekoadQiNrllmphWXEs0ykjKxxaxWdAt7yzZGJ7hWv-tu',64,2,'2017-07-06 09:50:15','2017-07-06 09:50:15'),(105,'d4xrMvt2MsM:APA91bH2MgA6FDc8mhbJMzTCEWxwEioAFnUVo4ePUkbvqQfRm1QvmTqyhvlahpMPrRtos_ip8xYTaXcftPoiKzVjm7zI3lqnF61iSezUgyOHY3OnKH7cXHJDjKZy5OIH0C6bg5uXVHEd',274,2,'2017-07-07 11:38:36','2017-07-07 11:38:36'),(106,'eSY5tPfmexI:APA91bGYEOsKlkx_v9_pHNHfZELK9PjRgawpCYmE9m0KOk4b3J-meHcFCMjHGuHV0tzzIN5GIubluukKOEa2BythFrUqt2n1iDbm7TALw6S_ecYVfH_dp6wRLW2D_k52XUqCZlB_2jGU',274,2,'2017-07-07 11:41:36','2017-07-07 11:41:36'),(107,'fGU0Wr_OdXM:APA91bFyVESweMKlyxgYTcsNwBGDJf-BYSmU7u3JcfZcy3i8s6ySauTQxi-BaE91E7IXIpVDa4K9j6m1VabAmNLjNIfbSkkXka6JTZbLClvG-cBfXyfvd-U09QZtt6X7TuA540-GwJIu',303,2,'2017-07-07 22:57:17','2017-07-07 22:57:17'),(108,'eXOijN2jgL8:APA91bECG0oZZq3yY0N1bulQoSl-arYBlQ4aLic4NwQZw8OWHO722b6nDg7wqkZ8a7byd_Bu0pjH41sfHfW_OQhd9ZAZXmtg9pFkHHkhgVxHWYUX-9I95aeqnwQ6IyI8IQYYrw2eFgYE',274,2,'2017-07-08 12:00:20','2017-07-08 12:00:20'),(109,'fUsc77WM-9U:APA91bF06-Agf3014Linw9x1b54UZ0VjaZKLOmwDW6IWS8_jTblb2ut0WOF5KaA5WeMAqNIjmderlPOI3gP1f_wkEj-v0_LOf_9rM8oyfFLr2gUEPEJTgcITawW8iwVHaTCXMtxk2ZrR',304,2,'2017-07-09 18:16:13','2017-07-09 18:16:13'),(110,'d07s7_LBG08:APA91bG88qzumiJgVCp3PbRoFJWphkMwJbxDi0V15tzfQG2oJX8c_twdyKcKS7IdfyXQw2Mbx0jaq8qvXnwu_hcGYU3USVoIRarRSTe091sLGoln1VnQYxbW-9h8ROZ1267s1CGpiBUC',274,2,'2017-07-11 12:03:31','2017-07-11 12:03:31'),(111,'fUdww7OV3PU:APA91bHTqkQN_oIeQuFp9aQsPz-OClWcCth_KhMo1oznt_Hp12pWWtOX2cNTPzhYa56dgY4lZYG25PWzGpI2JFC7I2A69f4ElF61WbqTpqqg2x5TxcnmQkJNYssoRgkF2oXEl-vq2pHi',274,2,'2017-07-11 12:45:23','2017-07-11 12:45:23'),(112,'b712f9060443b333732cf6c2e1e12b819d7c5b87fb3d2591cb98b203ffcb217a',305,2,'2017-07-11 13:47:52','2017-07-11 13:47:52'),(113,'d1833dbe55cff888bdd660ffea21f105b7b2558b236ad1cfaf71da4f4dada329',306,2,'2017-07-11 15:32:52','2017-07-11 15:32:52'),(114,'ffLfKIO6CwY:APA91bGbxzcxUxNEKhCT7PZpNaXOfHmy1KO5hhzKMeVgLK47n12vWPOYSxkzfjq6SrqfnMudWz1lH6LEos3D5vMLd-t1cmg63KxMftx55hSfj7PXytQ-tbtGlk1MeXNFkKhWQ1rF9brO',307,2,'2017-07-11 16:22:37','2017-07-11 16:22:37'),(115,'cqacIoZOTL4:APA91bG4fTcmY7ATjWY6Xiky7cc04sF18LlAjGal0LoiR98mso9nZWVmYz4YZKvPEBhWuXwBENcWGsmY97gHAtz5bWfqgVtclygqVYQx_c3PkVJd-hi9i59lvLtzvvQYIasXhJDNEcFB',308,2,'2017-07-11 17:07:44','2017-07-11 17:07:44'),(116,'cuznxaGMSAc:APA91bHV3TGaGLnSvyeoSI0KZgpjhhZrLFJpptQGCPZuZm-vLsj6DGUPOOEt6C9ZkXmRlvV658TpRx67xCayfcPGS4h9UcvxenbefqWbdcUq-jdx3-m82DRVxwaJDaJvcpTotdR0nXlb',309,2,'2017-07-12 01:55:12','2017-07-12 01:55:12');

/*Table structure for table `user_business_fav` */

DROP TABLE IF EXISTS `user_business_fav`;

CREATE TABLE `user_business_fav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_business_fav` */

/*Table structure for table `user_card` */

DROP TABLE IF EXISTS `user_card`;

CREATE TABLE `user_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text,
  `last_digits` text,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_card` */

/*Table structure for table `user_types` */

DROP TABLE IF EXISTS `user_types`;

CREATE TABLE `user_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_types` */

insert  into `user_types`(`id`,`name`,`created_at`,`updated_at`) values (1,'SendenAdmin','2017-06-13 10:04:01','2017-06-13 10:04:10'),(2,'Sendenboy','2017-06-13 10:04:01','2017-06-13 10:04:10'),(3,'Administrador','2017-06-13 10:04:01','2017-06-13 10:04:10'),(4,'Vendedor','2017-06-13 10:04:01','2017-06-13 10:04:10'),(5,'Sendenshop','2017-07-16 17:44:51','2017-07-16 17:44:57');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type_id` int(10) unsigned DEFAULT NULL,
  `business_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_password` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Texto plano',
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img/default.jpg',
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext_number` int(10) unsigned DEFAULT NULL,
  `int_number` int(10) unsigned DEFAULT NULL,
  `colony` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `municipality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneNumber` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isPanelUser` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `id_conekta` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_user_type_id_foreign` (`user_type_id`),
  KEY `users_business_id_foreign` (`business_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`user_type_id`,`business_id`,`name`,`surname`,`email`,`password`,`username`,`user_password`,`photo`,`street`,`ext_number`,`int_number`,`colony`,`municipality`,`state`,`postal_code`,`phoneNumber`,`isPanelUser`,`remember_token`,`status`,`id_conekta`,`created_at`,`updated_at`) values (1,3,3,'Negocio conrado',NULL,'anton_con@hotmail.com','$2y$10$Ht4iiDeDtZ0KYHVSYrqR6O52o2YkuJKHS7sgaQdrOLPhwSe.gLvRu',NULL,NULL,'users/1/1501872299.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'33548909',0,'HKIVMAv4MhkYvLT5OHa0xypSkEAxeF8qYw1qu48TdW9KIDaySGSiYoS209Uw',1,NULL,NULL,'2017-08-31 23:11:54'),(2,2,NULL,'Sendenboy Luis','fsdfasdfasd','luis_sendenboy@gmail.com','$2y$10$K6NeHtCdJo9aQDPb3b0wkOAW7c5PC03d4a2m.4kPaYnJEnY6fkXIy','luis_sendenboy','contra','img/default.jpg','Esta es una callesita',1416,2,'Del fresno','Guadalajara','Jalisco','89231','33092354',0,NULL,1,NULL,'2017-07-06 11:32:30','2017-08-09 07:00:12'),(3,1,NULL,'Administrador',NULL,'admin@senden.com','$2y$10$Ht4iiDeDtZ0KYHVSYrqR6O52o2YkuJKHS7sgaQdrOLPhwSe.gLvRu',NULL,NULL,'img/default.jpg','dkjahskdjhj',12,12,'hjkh','jk','hkjh','32133','45634563456345',1,'20m8NUmtfbMHxR9zNavoPezNKQrXyWzgmc7yqUeYMf3CmJw2EN0MXhHWyJx1',1,NULL,'2017-07-07 00:14:35','2017-07-07 00:14:35'),(4,3,3,'Admin Negocio',NULL,'juan@senden.com','$2y$10$ySKehQ0s5U5j.3ds6enoFeVojDjJXalb.KueHkPSTPdpHf3UI76ui',NULL,NULL,'img/default.jpg','federalismo 2004',1020,21,'Guadalupana','Guadalajara','Jalisco','82195','9801010',1,'z06AfvR3c5zLC836RJSIUH13ndR1cmW1UUpsJ21wS4Fn1Xq2MkLD4Cx60qoK',1,NULL,'2017-07-07 20:25:27','2017-07-24 17:50:56'),(5,5,NULL,'Sendenshop Antonio','C. R.','sendenshopcito@hotmail.com','$2y$10$/dXu9GIYzcP210W.xYLpGuyM3ESbpi9RKna27KfNLLQpOs8Y6hibO','anthony','contra','img/default.jpg','La pedrada',3008,NULL,'Circunvalación','Guadalajara','Jalisco','82176','321321323',0,NULL,1,NULL,NULL,'2017-08-15 17:27:08'),(6,2,NULL,'Manuel','Rosales Rodríguez','many_rosales@hotmail.com','$2y$10$otlnGMPsubeR20LmNkdHY.bnNLkyeHz/D4zQWil4QCDG1ezU9kwUi','many_rosales','contra','img/default.jpg','Petroleros Mexicanos',89,NULL,'Av. Los obreros','Culiacán','Sinaloa','82912','1232453434',0,NULL,1,NULL,'2017-07-19 21:19:12','2017-08-09 06:58:54'),(7,2,NULL,'Benjamin Alilleri','Ascencio Guzmán','benjamin@bridge.com.mx','$2y$10$Ra4fVtIoRnts9EnURLKQZepCF9q/whATqKJRdA1UNPi/fTnOoK0Vu','benjamomos','contra','img/default.jpg','Calle del Rodeo',240,NULL,'El vigía','Zapopan','Jalisco','45140','2312323123',0,NULL,1,NULL,'2017-07-20 18:35:38','2017-08-09 06:52:48'),(8,4,1,'Vendedor',NULL,'sales@senden.com','$2y$10$/dXu9GIYzcP210W.xYLpGuyM3ESbpi9RKna27KfNLLQpOs8Y6hibO',NULL,NULL,'img/default.jpg','Federalismo 2004',1020,NULL,'Guadalupana','Guadalajara','Jalisco','82195','5434535435',1,'kpYcIV3g9VOqtETzJYVP0AlNITgtvwh86hm7B2nqfaPudAHnPyUIqeYDx6GZ',1,NULL,'2017-07-21 16:26:38',NULL),(9,3,2,'Usuario tester negocio',NULL,'tester@senden.com','$2y$10$N0fqJzVs0ZpEnbzqTZ3epuPZ3re87tBBtk20tCx/M2.2hik0Wc/M2',NULL,NULL,'users/default.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4354345345',1,NULL,1,NULL,'2017-07-24 20:11:44','2017-07-24 20:11:44'),(10,4,3,'Vendedor Edgar vargas',NULL,'edgargas@gmail.com','$2y$10$AcPFO99ufQekso5tU3rHwO9lc7hsa3JHc0gFeVnjVXjC5kWjj3/Ba',NULL,NULL,'users/default.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3423423423',1,NULL,0,NULL,'2017-07-24 21:58:11','2017-07-25 21:30:30'),(14,1,NULL,'otro admin',NULL,'anothaoan@senden.com','$2y$10$oydqmTDc38436l7ph72q.ugqLy1ItGAoFlYou1j5sO8OkqLeW4CG2',NULL,NULL,'users/default.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'rrOq6k4f1K1GALdRaLzC5ZLnURSJSZ4qD1u2olrfaZzwuqfbBsVVPuWYSJAJ',0,NULL,'2017-08-03 21:34:40','2017-08-03 21:35:28'),(15,2,NULL,'Juan','Perez','juanperez@senden.com','$2y$10$dIm74OmgPHs54vY1h.sHjO7LKw/zYKEPwy8jmvXbLnJR.5U07dRRi','Juanperez','contra','img/default.jpg','Calle cuautitlan',23,NULL,'Chapala','Guadalajara','Jalisco','445000','123213234',0,NULL,1,NULL,'2017-08-09 06:42:29','2017-08-09 06:42:29'),(16,2,NULL,'Juan','Perez','anotherjuanperez@senden.com','$2y$10$1uR1YN/WV527HPs20XLEe.vLshktVt5QE7DikhCUKDeSf5RwHMJgG','juanperez321','contra','img/default.jpg','Federalísmo',23,23,'Guadalupe','Guadalajara','Jalisco','23123','2313281372',0,NULL,1,NULL,'2017-08-09 06:48:43','2017-08-09 06:58:02');

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vehicles` */

insert  into `vehicles`(`id`,`name`,`created_at`,`updated_at`) values (1,'Motocicleta',NULL,NULL),(2,'Automóvil',NULL,NULL);

/* Procedure structure for procedure `sp_ordersget` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_ordersget` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ordersget`(
	_order_id INT, #0 -> all orders, > 0 -> specific order
	_business_id INT #0 -> all business, > 0 -> specific business
)
BEGIN
	IF _order_id = 0 THEN
		SELECT o.`id` order_id, o.status_id as 'status', tk.akey AS order_number, o.`comment`, b.`name` business_name, c.`name` categorie_name, 
		o.`sendenboy_id`, DATE_FORMAT(o.`real_time`, '%d-%m-%y %r') order_date, u.`name` as sendenboy
		FROM orders o
		left JOIN businesses b ON b.`id` = o.`business_id`
		LEFT JOIN categories c ON c.`id` = b.`category_id`
		LEFT join sendenboys s on s.`id` = o.`sendenboy_id`
		LEFT JOIN users u ON u.`id` = s.`user_id`
		left JOIN tkey tk ON tk.`order_id` = o.`id`
		WHERE o.`status_id` NOT IN (5,6) AND (_business_id = 0 OR o.`business_id` = _business_id);
	ELSE
		SELECT o.`id` order_id, o.`comment`, o.`flag`, o.`comission`, o.`shipping_price`, o.`total`, o.`city`, o.`state`, DATE_FORMAT(o.`real_time`, '%d-%m-%y %r') order_date, o.deliveryAddress as order_address,
		s.`id` sendenboy_id, us.`name` sendenboy_name, s.`driver_photo` sendenboy_photo, s.`circulation_card` sendenboy_circulation_card, s.`license` sendenboy_license, us.`municipality` sendenboy_municipality, 
		tk.akey AS order_number, uc.`email` client_email, uc.`phoneNumber` client_phone, us.email sendenboy_email, us.phoneNumber sendenboy_phone,
		CONCAT(
			IFNULL(us.`street`, ''),
			IF(us.`ext_number`, ' #', ''),
			IFNULL(us.`ext_number`, ''),
			IF(us.`int_number`, ' INT. #', ''),
			IFNULL(us.`int_number`, ''),', ',
			IFNULL(us.`colony`, ''),
			IF(us.`postal_code`, ' C.P. ', ''),
			IFNULL(us.`postal_code`, '')
		) sendenboy_address,
		uc.`id` client_id, uc.`name` client_name, uc.`photo` client_photo, uc.`municipality` client_municipality, 
		CONCAT(
			IFNULL(uc.`street`, ''),
			IF(uc.`ext_number`, ' #', ''),
			IFNULL(uc.`ext_number`, ''),
			IF(uc.`int_number`, ' INT. #', ''),
			IFNULL(uc.`int_number`, ''),', ',
			IFNULL(uc.`colony`, ''),
			IF(uc.`postal_code`, ' C.P. ', ''),
			IFNULL(uc.`postal_code`, '')
		) client_address,
		b.`name` business_name, b.`rfc` business_rfc, b.`city` business_city, b.`state` business_state, b.`phone` business_phone, 
		CONCAT(
      IFNULL(b.`street`, ''),
      IF(b.`ext_number`, ' #', ''),
      IFNULL(b.`ext_number`, ''),
      IF(b.`int_number`, ' INT. #', ''),
      IFNULL(b.`int_number`, ''),', ',
      IFNULL(b.`colony`, ''),
      IF(b.`postal_code`, ' C.P. ', ''),
      IFNULL(b.`postal_code`, '')
    ) business_address,
    CONCAT (
      IFNULL(b.`city`, ''),
      IF(b.`city`, '', ', '),
      IFNULL(b.`state`, '')
    ) business_place,
		c.`name` categorie_name, st.`name` status_name
		FROM orders o
		LEFT JOIN businesses b ON b.`id` = o.`business_id`
		LEFT JOIN categories c ON c.`id` = b.`category_id`
		LEFT JOIN users uc ON uc.`id` = o.`user_id`
		left JOIN sendenboys s ON s.`id` = o.`sendenboy_id`
		LEFT JOIN users us ON us.`id` = s.`user_id`
		LEFT JOIN statuses st ON st.`id` = o.`status_id`
		LEFT JOIN tkey tk ON tk.`order_id` = o.`id`
		WHERE o.`status_id` NOT IN (5,6) AND o.`id` = _order_id;
	END IF;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
