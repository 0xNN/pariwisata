/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.14-MariaDB : Database - pariwisata
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `banks` */

DROP TABLE IF EXISTS `banks`;

CREATE TABLE `banks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `banks` */

insert  into `banks`(`id`,`nama_bank`,`created_at`,`updated_at`) values 
(1,'BCA','2021-07-01 21:43:41','2021-07-01 21:43:41'),
(2,'BNI','2021-07-01 21:46:42','2021-07-01 21:46:53');

/*Table structure for table `bus_details` */

DROP TABLE IF EXISTS `bus_details`;

CREATE TABLE `bus_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bus_id` smallint(6) NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `bus_details` */

insert  into `bus_details`(`id`,`bus_id`,`foto`,`created_at`,`updated_at`) values 
(6,6,'\"1625753269916-Alur Seleksi CPNS.png\"','2021-07-08 21:07:49','2021-07-08 21:07:49'),
(7,6,'\"1625753269923-D76d6ee5c83b45ce4197579a5b8909b87.png\"','2021-07-08 21:07:49','2021-07-08 21:07:49'),
(8,7,'\"1625753280521-materai10000.jpg\"','2021-07-08 21:08:00','2021-07-08 21:08:00'),
(9,7,'\"1625753280527-WhatsApp Image 2021-06-16 at 12.28.55.jpeg\"','2021-07-08 21:08:00','2021-07-08 21:08:00');

/*Table structure for table `buses` */

DROP TABLE IF EXISTS `buses`;

CREATE TABLE `buses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_bus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_bus_id` smallint(6) NOT NULL,
  `minimum_pack` int(11) NOT NULL,
  `maksimum_pack` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `buses` */

insert  into `buses`(`id`,`nama_bus`,`jenis_bus_id`,`minimum_pack`,`maksimum_pack`,`created_at`,`updated_at`) values 
(6,'Bus A',1,30,45,'2021-07-07 14:46:50','2021-07-07 14:46:50'),
(7,'Bus B',2,25,30,'2021-07-07 14:47:03','2021-07-07 14:47:03');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `hotel_details` */

DROP TABLE IF EXISTS `hotel_details`;

CREATE TABLE `hotel_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` smallint(6) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `hotel_details` */

insert  into `hotel_details`(`id`,`hotel_id`,`foto`,`created_at`,`updated_at`) values 
(5,3,'1625666947627-icons8-list-64.png','2021-07-07 21:09:07','2021-07-07 21:09:07');

/*Table structure for table `hotels` */

DROP TABLE IF EXISTS `hotels`;

CREATE TABLE `hotels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_hotel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `hotels` */

insert  into `hotels`(`id`,`nama_hotel`,`created_at`,`updated_at`) values 
(3,'Hotel A','2021-07-07 13:56:57','2021-07-07 13:56:57'),
(4,'Hotel B','2021-07-07 13:57:02','2021-07-07 13:57:02');

/*Table structure for table `jenis_buses` */

DROP TABLE IF EXISTS `jenis_buses`;

CREATE TABLE `jenis_buses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jenis_buses` */

insert  into `jenis_buses`(`id`,`nama_jenis`,`created_at`,`updated_at`) values 
(1,'Big Bus','2021-07-01 22:11:38','2021-07-01 22:11:38'),
(2,'Medium Bus','2021-07-01 22:11:38','2021-07-01 22:11:38');

/*Table structure for table `lokasis` */

DROP TABLE IF EXISTS `lokasis`;

CREATE TABLE `lokasis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `lokasis` */

insert  into `lokasis`(`id`,`nama_lokasi`,`foto`,`hotel_id`,`created_at`,`updated_at`) values 
(2,'Monas','1625639268604-WhatsApp Image 2021-02-23 at 21.32.05 (1).jpeg',3,'2021-07-07 12:27:54','2021-07-07 13:27:48'),
(3,'Istiqlal','1625639310186-20180723_092402.jpg',4,'2021-07-07 13:28:10','2021-07-07 13:28:30'),
(4,'Ancol','1625754549894-D76d6ee5c83b45ce4197579a5b8909b87.png',3,'2021-07-08 21:29:09','2021-07-08 21:29:09'),
(5,'Kota Tua','1625754562362-unnamed.jpg',3,'2021-07-08 21:29:22','2021-07-08 21:29:22'),
(6,'Tangkuban Perahu','1625754649335-1200px-Android_logo_2019.svg.png',4,'2021-07-08 21:30:49','2021-07-08 21:30:49'),
(7,'Farm House','1625754672457-icons8-list-64.png',4,'2021-07-08 21:31:12','2021-07-08 21:31:12');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(44,'2014_10_12_000000_create_users_table',1),
(45,'2014_10_12_100000_create_password_resets_table',1),
(46,'2019_08_19_000000_create_failed_jobs_table',1),
(47,'2021_06_26_213143_create_buses_table',1),
(48,'2021_06_26_213512_create_hotels_table',1),
(49,'2021_06_26_213617_create_hotel_details_table',1),
(50,'2021_06_26_213818_create_bus_details_table',1),
(52,'2021_06_26_214625_create_pesawats_table',1),
(53,'2021_06_26_214649_create_pesawat_details_table',1),
(55,'2021_06_26_214911_create_pemesanans_table',1),
(56,'2021_06_26_215008_create_pembayarans_table',1),
(58,'2021_06_26_220207_create_jenis_buses_table',1),
(59,'2021_06_26_220327_create_paket_lokasis_table',1),
(60,'2021_06_26_221806_create_banks_table',1),
(61,'2021_06_26_214248_create_lokasis_table',2),
(64,'2021_07_07_134148_create_notes_table',4),
(65,'2021_07_07_133519_create_perusahaans_table',5),
(66,'2021_06_26_214825_create_pakets_table',6),
(67,'2021_06_26_215029_create_pembayaran_details_table',7);

/*Table structure for table `notes` */

DROP TABLE IF EXISTS `notes`;

CREATE TABLE `notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penjelasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_termasuk` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `notes` */

insert  into `notes`(`id`,`penjelasan`,`status_termasuk`,`created_at`,`updated_at`) values 
(1,'1. Makan Selama Perjalanan Tour',1,'2021-07-07 20:56:47','2021-07-07 20:56:47'),
(2,'2. Tour Leader',1,'2021-07-07 21:04:10','2021-07-07 21:04:10'),
(3,'3. Spanduk',1,'2021-07-07 21:04:24','2021-07-07 21:04:24'),
(5,'1. Pengeluaran Pribadi',2,'2021-07-07 21:06:06','2021-07-07 21:06:06');

/*Table structure for table `paket_lokasis` */

DROP TABLE IF EXISTS `paket_lokasis`;

CREATE TABLE `paket_lokasis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paket_id` smallint(6) NOT NULL,
  `lokasi_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `paket_lokasis` */

insert  into `paket_lokasis`(`id`,`paket_id`,`lokasi_id`,`created_at`,`updated_at`) values 
(1,1,2,'2021-07-07 17:10:01','2021-07-07 17:10:01'),
(3,1,3,'2021-07-08 21:10:57','2021-07-08 21:10:57'),
(4,3,2,'2021-07-08 21:25:14','2021-07-08 21:25:14'),
(5,4,4,'2021-07-08 21:29:36','2021-07-08 21:29:36'),
(6,4,5,'2021-07-08 21:29:44','2021-07-08 21:29:44'),
(7,1,4,'2021-07-08 21:29:57','2021-07-08 21:29:57'),
(8,1,5,'2021-07-08 21:30:04','2021-07-08 21:30:04'),
(9,1,6,'2021-07-08 21:31:30','2021-07-08 21:31:30'),
(10,1,7,'2021-07-08 21:31:35','2021-07-08 21:31:35');

/*Table structure for table `pakets` */

DROP TABLE IF EXISTS `pakets`;

CREATE TABLE `pakets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bus_id` smallint(6) DEFAULT NULL,
  `pesawat_id` smallint(6) DEFAULT NULL,
  `harga_paket` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pakets` */

insert  into `pakets`(`id`,`nama_paket`,`keterangan`,`bus_id`,`pesawat_id`,`harga_paket`,`created_at`,`updated_at`) values 
(1,'Paket A','paket a',6,NULL,1950000,'2021-07-07 14:54:31','2021-07-07 14:54:31'),
(3,'Paket 15','paket 15',NULL,3,2500000,'2021-07-07 16:54:12','2021-07-07 16:54:12'),
(4,'Jakarta - Jogja - Bandung','07 Hari 02 Malam Inap',7,NULL,2700000,'2021-07-08 21:27:02','2021-07-08 21:27:02');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pembayaran_details` */

DROP TABLE IF EXISTS `pembayaran_details`;

CREATE TABLE `pembayaran_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pembayaran_id` smallint(6) NOT NULL,
  `pembayaran_ke` int(11) NOT NULL,
  `dibayar` bigint(20) DEFAULT NULL,
  `bank_id` smallint(6) DEFAULT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_bayar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_dibayar` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembayaran_details` */

insert  into `pembayaran_details`(`id`,`pembayaran_id`,`pembayaran_ke`,`dibayar`,`bank_id`,`no_rekening`,`bukti_bayar`,`status_dibayar`,`created_at`,`updated_at`) values 
(1,1,1,26325000,1,'43434343','1625816472964-WhatsApp Image 2021-06-16 at 12.28.55.jpeg',1,'2021-07-09 14:38:43','2021-07-09 15:55:16'),
(2,1,2,43875000,1,'455654','1625828812032-unnamed.jpg',1,'2021-07-09 14:38:43','2021-07-09 18:12:27'),
(3,1,3,17550000,1,'454243244','1625833370161-icons8-stationery-32.png',1,'2021-07-09 14:38:43','2021-07-09 19:23:05');

/*Table structure for table `pembayarans` */

DROP TABLE IF EXISTS `pembayarans`;

CREATE TABLE `pembayarans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemesanan_id` smallint(6) NOT NULL,
  `status_pembayaran` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembayarans` */

insert  into `pembayarans`(`id`,`kode_pembayaran`,`pemesanan_id`,`status_pembayaran`,`created_at`,`updated_at`) values 
(1,'PB1625816323074NN',1,1,'2021-07-09 14:38:43','2021-07-09 19:23:51');

/*Table structure for table `pemesanans` */

DROP TABLE IF EXISTS `pemesanans`;

CREATE TABLE `pemesanans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_pemesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `paket_id` smallint(6) NOT NULL,
  `pax` int(11) DEFAULT NULL,
  `tgl_pemesanan` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pemesanans` */

insert  into `pemesanans`(`id`,`kode_pemesanan`,`user_id`,`paket_id`,`pax`,`tgl_pemesanan`,`status`,`created_at`,`updated_at`) values 
(1,'PM1625815922116NN',2,1,45,'2021-07-09',1,'2021-07-09 14:38:43','2021-07-09 19:24:54');

/*Table structure for table `perusahaans` */

DROP TABLE IF EXISTS `perusahaans`;

CREATE TABLE `perusahaans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_perusahaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telpon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `perusahaans` */

insert  into `perusahaans`(`id`,`nama_perusahaan`,`alamat_perusahaan`,`no_telpon`,`email`,`created_at`,`updated_at`) values 
(1,'CV. Pesona Indah Wisata','Jalan Ratna Lorong Atom No. 79 Palembang','0821-7941-2166','pesonaindahwisata2018@gmail.com','2021-07-07 18:07:02','2021-07-07 18:07:02');

/*Table structure for table `pesawat_details` */

DROP TABLE IF EXISTS `pesawat_details`;

CREATE TABLE `pesawat_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pesawat_id` smallint(6) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pesawat_details` */

insert  into `pesawat_details`(`id`,`pesawat_id`,`foto`,`created_at`,`updated_at`) values 
(3,2,'1625666973836-Microsoft Technology Associate.png','2021-07-07 21:09:33','2021-07-07 21:09:33');

/*Table structure for table `pesawats` */

DROP TABLE IF EXISTS `pesawats`;

CREATE TABLE `pesawats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pesawat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pesawats` */

insert  into `pesawats`(`id`,`nama_pesawat`,`created_at`,`updated_at`) values 
(2,'Pesawat A','2021-07-07 14:47:20','2021-07-07 14:47:20'),
(3,'Pesawat B','2021-07-07 14:47:28','2021-07-07 14:47:28');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `institusi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penanggung_jawab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kartu_identitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`email_verified_at`,`password`,`is_admin`,`institusi`,`nama_penanggung_jawab`,`kartu_identitas`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Administrator','admin123','admin@gmail.com','2021-06-26 22:34:32','$2y$10$1INCxKPSd4juiu7x3prxmuUGBhh7JFYZMVreKp4ptu9SuiTBC1e2.',1,'Admin',NULL,'22223333',NULL,'2021-06-26 22:34:32','2021-06-26 22:34:32'),
(2,'Tes','tes','tes@gmail.com','2021-07-01 21:33:27','$2y$10$lbiJta2lqFjzmq1rum42se5lGHi.feARrDPu/VkIiO8TZfkx5P8jO',NULL,'SD Negeri 1 Palembang','Tes','123123123',NULL,'2021-07-01 20:50:44','2021-07-01 21:33:27'),
(3,'Tes2','tes2','tes2@gmail.com','2021-07-09 19:51:57','$2y$10$C9jHY0dvC7iOXtvEdhQPuOifoLPUbA30SwAw8rbf0PWR8ZMlCyE7y',NULL,'SD Negeri 45 Palembang','Parman','244232244',NULL,'2021-07-09 19:49:00','2021-07-09 19:51:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
