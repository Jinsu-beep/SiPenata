/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.6-MariaDB : Database - db_sipenata
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_sipenata` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_sipenata`;

/*Table structure for table `tb_laporan_kondisi` */

DROP TABLE IF EXISTS `tb_laporan_kondisi`;

CREATE TABLE `tb_laporan_kondisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menara` int(11) DEFAULT NULL,
  `id_tim_lapangan` int(11) DEFAULT NULL,
  `laporan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_menara` (`id_menara`),
  KEY `id_tim_lapangan` (`id_tim_lapangan`),
  CONSTRAINT `tb_laporan_kondisi_ibfk_1` FOREIGN KEY (`id_menara`) REFERENCES `tb_menara` (`id`),
  CONSTRAINT `tb_laporan_kondisi_ibfk_2` FOREIGN KEY (`id_tim_lapangan`) REFERENCES `tb_tim_lapangan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_laporan_kondisi` */

/*Table structure for table `tb_m_dasarhukum` */

DROP TABLE IF EXISTS `tb_m_dasarhukum`;

CREATE TABLE `tb_m_dasarhukum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `dasar_hukum` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_dasarhukum` */

/*Table structure for table `tb_m_desa` */

DROP TABLE IF EXISTS `tb_m_desa`;

CREATE TABLE `tb_m_desa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kecamatan` (`id_kecamatan`),
  CONSTRAINT `tb_m_desa_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_m_kecamatan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_desa` */

/*Table structure for table `tb_m_kabupaten` */

DROP TABLE IF EXISTS `tb_m_kabupaten`;

CREATE TABLE `tb_m_kabupaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_provinsi` (`id_provinsi`),
  CONSTRAINT `tb_m_kabupaten_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `tb_m_provinsi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_kabupaten` */

/*Table structure for table `tb_m_kecamatan` */

DROP TABLE IF EXISTS `tb_m_kecamatan`;

CREATE TABLE `tb_m_kecamatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kabupaten` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kabupaten` (`id_kabupaten`),
  CONSTRAINT `tb_m_kecamatan_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `tb_m_kabupaten` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_kecamatan` */

/*Table structure for table `tb_m_negara` */

DROP TABLE IF EXISTS `tb_m_negara`;

CREATE TABLE `tb_m_negara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_negara` */

/*Table structure for table `tb_m_provinsi` */

DROP TABLE IF EXISTS `tb_m_provinsi`;

CREATE TABLE `tb_m_provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_provinsi` */

/*Table structure for table `tb_menara` */

DROP TABLE IF EXISTS `tb_menara`;

CREATE TABLE `tb_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_kecamatan` int(11) DEFAULT NULL,
  `id_pemilik_menara` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tanggal_pembuatan` date DEFAULT NULL,
  `beban_maks` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `tinggi` varchar(255) DEFAULT NULL,
  `NOP` varchar(255) DEFAULT NULL,
  `surat_izin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pemilik_menara` (`id_pemilik_menara`),
  KEY `id_m_kecamatan` (`id_m_kecamatan`),
  CONSTRAINT `tb_menara_ibfk_1` FOREIGN KEY (`id_pemilik_menara`) REFERENCES `tb_pemilik_menara` (`id`),
  CONSTRAINT `tb_menara_ibfk_2` FOREIGN KEY (`id_m_kecamatan`) REFERENCES `tb_m_kecamatan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_menara` */

/*Table structure for table `tb_opd` */

DROP TABLE IF EXISTS `tb_opd`;

CREATE TABLE `tb_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_opd` */

/*Table structure for table `tb_pemilik_menara` */

DROP TABLE IF EXISTS `tb_pemilik_menara`;

CREATE TABLE `tb_pemilik_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_pemilik_menara_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pemilik_menara` */

insert  into `tb_pemilik_menara`(`id`,`id_user`,`nama`,`no_telp`,`alamat`,`email`,`created_at`,`updated_at`,`deleted_at`) values 
(1,5,'Pemilik Menara',NULL,NULL,NULL,NULL,NULL,NULL),
(2,11,'asd',NULL,NULL,NULL,'2022-09-15 17:22:28','2022-09-15 17:22:28',NULL);

/*Table structure for table `tb_pengajuan_menara` */

DROP TABLE IF EXISTS `tb_pengajuan_menara`;

CREATE TABLE `tb_pengajuan_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik_menara` int(11) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `surat_tanah` varchar(255) DEFAULT NULL,
  `surat_keterangan_rencana_kota` varchar(255) DEFAULT NULL,
  `informasi_perencanaan_menara` varchar(255) DEFAULT NULL,
  `persetujuan_warga` varchar(255) DEFAULT NULL,
  `status` enum('Draft','Proses','Disetujui','Selesai') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pemilik_menara` (`id_pemilik_menara`),
  CONSTRAINT `tb_pengajuan_menara_ibfk_1` FOREIGN KEY (`id_pemilik_menara`) REFERENCES `tb_pemilik_menara` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengajuan_menara` */

/*Table structure for table `tb_penyewaan_menara` */

DROP TABLE IF EXISTS `tb_penyewaan_menara`;

CREATE TABLE `tb_penyewaan_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provider` int(11) DEFAULT NULL,
  `id_menara` int(11) DEFAULT NULL,
  `Status` enum('Draft','Proses','Disetujui','Ditolak') DEFAULT NULL,
  `waktu_awal` date DEFAULT NULL,
  `waktu_akhir` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedt_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_menara` (`id_menara`),
  KEY `id_provider` (`id_provider`),
  CONSTRAINT `tb_penyewaan_menara_ibfk_1` FOREIGN KEY (`id_provider`) REFERENCES `tb_provider` (`id`),
  CONSTRAINT `tb_penyewaan_menara_ibfk_3` FOREIGN KEY (`id_menara`) REFERENCES `tb_menara` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_penyewaan_menara` */

/*Table structure for table `tb_perbaikan_menara` */

DROP TABLE IF EXISTS `tb_perbaikan_menara`;

CREATE TABLE `tb_perbaikan_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menara` int(11) DEFAULT NULL,
  `status` enum('Draft','Proses','Disetujui','Ditolak','Selesai') DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `surat_izin` varchar(255) DEFAULT NULL,
  `surat_tanah` varchar(255) DEFAULT NULL,
  `surat_keterangan_rencana_kota` varchar(255) DEFAULT NULL,
  `informasi_perubahan_menara` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_menara` (`id_menara`),
  CONSTRAINT `tb_perbaikan_menara_ibfk_1` FOREIGN KEY (`id_menara`) REFERENCES `tb_menara` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_perbaikan_menara` */

/*Table structure for table `tb_provider` */

DROP TABLE IF EXISTS `tb_provider`;

CREATE TABLE `tb_provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_tlp` varchar(13) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_provider_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_provider` */

insert  into `tb_provider`(`id`,`id_user`,`nama`,`no_tlp`,`alamat`,`email`,`created_at`,`updated_at`,`deleted_at`) values 
(1,6,'provider',NULL,NULL,NULL,NULL,NULL,NULL),
(2,12,'qwe',NULL,NULL,NULL,'2022-09-15 17:25:45','2022-09-15 17:25:45',NULL);

/*Table structure for table `tb_super_admin` */

DROP TABLE IF EXISTS `tb_super_admin`;

CREATE TABLE `tb_super_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_super_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_super_admin` */

insert  into `tb_super_admin`(`id`,`id_user`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'SUPER ADMIN',NULL,'2022-09-19 11:17:18',NULL),
(7,15,'Tyagi','2022-09-20 14:12:21','2022-09-20 14:12:21',NULL);

/*Table structure for table `tb_tim_administratif` */

DROP TABLE IF EXISTS `tb_tim_administratif`;

CREATE TABLE `tb_tim_administratif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_tim_administratif_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`),
  CONSTRAINT `tb_tim_administratif_ibfk_2` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_tim_administratif` */

insert  into `tb_tim_administratif`(`id`,`id_user`,`id_opd`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,NULL,'Tim Administratif','2022-09-10 18:21:00',NULL,NULL);

/*Table structure for table `tb_tim_lapangan` */

DROP TABLE IF EXISTS `tb_tim_lapangan`;

CREATE TABLE `tb_tim_lapangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_tim_lapangan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`),
  CONSTRAINT `tb_tim_lapangan_ibfk_2` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_tim_lapangan` */

insert  into `tb_tim_lapangan`(`id`,`id_user`,`id_opd`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,3,NULL,'Tim Lapangan','2022-09-10 18:21:13',NULL,NULL);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `kategori` enum('Super Admin','Tim Administratif','Tim Lapangan','Pemilik Menara','Provider') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`kategori`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'admin','$2y$10$ufW/keFqUNxnlk7OcG3Pi.Ty1TKrAE5QaVpVa1WPNvyuiilFhAZta','Super Admin',NULL,NULL,NULL),
(2,'tim_administratif','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Tim Administratif',NULL,NULL,NULL),
(3,'tim_lapangan','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Tim Lapangan',NULL,NULL,NULL),
(5,'pemilik_menara','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Pemilik Menara',NULL,NULL,NULL),
(6,'provider','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Provider',NULL,NULL,NULL),
(11,'asd','$2y$10$jpNwswBnAfS3hIfhGaTmBuWCGXyLsrYuzlOmcaHFj5x3nk6bbJnU.','Pemilik Menara',NULL,NULL,NULL),
(12,'qwe','$2y$10$u6gakYhnhWCjF47nfLEn6OKvdeD/wGwJXsierCVOfd4kFYcMXl1zq','Provider',NULL,NULL,NULL),
(15,'tyagi','$2y$10$sFgGMLBnZ2YAAgOqh6U6kucpp04wUC0hnyfITMgbsKkQtLzcHE7WG','Super Admin',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
