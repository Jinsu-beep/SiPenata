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

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_admin` */

/*Table structure for table `tb_laporan_kondisi` */

DROP TABLE IF EXISTS `tb_laporan_kondisi`;

CREATE TABLE `tb_laporan_kondisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menara` int(11) DEFAULT NULL,
  `id_tim_lapangan` int(11) DEFAULT NULL,
  `tanggalLaporan` date DEFAULT NULL,
  `foto` varbinary(255) DEFAULT NULL,
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
  `no_DasarHukum` varchar(255) DEFAULT NULL,
  `file_DasarHukum` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_dasarhukum` */

insert  into `tb_m_dasarhukum`(`id`,`nama`,`no_DasarHukum`,`file_DasarHukum`,`tanggal`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'asd',NULL,'sdads','2022-11-17','2022-11-17 14:42:15',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_kabupaten` */

insert  into `tb_m_kabupaten`(`id`,`id_provinsi`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'b','2022-10-07 12:50:57',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_kecamatan` */

insert  into `tb_m_kecamatan`(`id`,`id_kabupaten`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'c','2022-10-07 12:51:06',NULL,NULL);

/*Table structure for table `tb_m_provinsi` */

DROP TABLE IF EXISTS `tb_m_provinsi`;

CREATE TABLE `tb_m_provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_provinsi` */

insert  into `tb_m_provinsi`(`id`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'a','2022-10-07 12:50:41',NULL,NULL);

/*Table structure for table `tb_m_status` */

DROP TABLE IF EXISTS `tb_m_status`;

CREATE TABLE `tb_m_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_m_status` */

/*Table structure for table `tb_menara` */

DROP TABLE IF EXISTS `tb_menara`;

CREATE TABLE `tb_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_pemilik_menara` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tanggal_pembuatan` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `jenisMenara` enum('Menara 4 Kaki','Menara 3 Kaki','Menara 1 Kaki') DEFAULT NULL,
  `tinggiMenara` varchar(255) DEFAULT NULL,
  `tinggiAntena` varchar(255) DEFAULT NULL,
  `luasArea` varchar(255) DEFAULT NULL,
  `aksesJalan` varchar(255) DEFAULT NULL,
  `suratIzinPembanguna` varchar(255) DEFAULT NULL,
  `suratIzinOperasional` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pemilik_menara` (`id_pemilik_menara`),
  KEY `id_m_kecamatan` (`id_kecamatan`),
  CONSTRAINT `tb_menara_ibfk_1` FOREIGN KEY (`id_pemilik_menara`) REFERENCES `tb_pemilik_menara` (`id`),
  CONSTRAINT `tb_menara_ibfk_2` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_m_kecamatan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_menara` */

insert  into `tb_menara`(`id`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_desa`,`id_pemilik_menara`,`foto`,`nama`,`tanggal_pembuatan`,`alamat`,`lat`,`long`,`jenisMenara`,`tinggiMenara`,`tinggiAntena`,`luasArea`,`aksesJalan`,`suratIzinPembanguna`,`suratIzinOperasional`,`created_at`,`updated_at`,`deleted_at`) values 
(1,NULL,NULL,1,NULL,1,NULL,'menara 1','2022-10-01','jl. test','121','212',NULL,'12',NULL,NULL,NULL,NULL,NULL,'2022-10-07 12:53:37',NULL,NULL);

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
  `id_perusahaan` int(11) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(255) DEFAULT NULL,
  `NPWP` varchar(255) DEFAULT NULL,
  `Kewarganegaraan` enum('WNI','WNA') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_perusahaan` (`id_perusahaan`),
  CONSTRAINT `tb_pemilik_menara_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`),
  CONSTRAINT `tb_pemilik_menara_ibfk_2` FOREIGN KEY (`id_perusahaan`) REFERENCES `tb_perusahaan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pemilik_menara` */

insert  into `tb_pemilik_menara`(`id`,`id_user`,`id_perusahaan`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_desa`,`nama`,`no_ktp`,`NPWP`,`Kewarganegaraan`,`alamat`,`no_telp`,`email`,`created_at`,`updated_at`,`deleted_at`) values 
(1,5,NULL,NULL,NULL,NULL,NULL,'Pemilik Menara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(2,11,NULL,NULL,NULL,NULL,NULL,'asd',NULL,NULL,NULL,NULL,NULL,NULL,'2022-09-15 17:22:28','2022-09-15 17:22:28',NULL),
(3,17,NULL,1,1,1,1,'asd','asd','asd','WNI','aas','123','asd','2022-10-16 11:37:38','2022-10-16 11:37:38',NULL),
(4,18,NULL,1,1,1,1,'qwe','qwe','qweqwe','WNI','qweqw','123','qwe','2022-10-16 11:39:13','2022-10-16 11:39:13',NULL);

/*Table structure for table `tb_pengajuan_menara` */

DROP TABLE IF EXISTS `tb_pengajuan_menara`;

CREATE TABLE `tb_pengajuan_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik_menara` int(11) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_persetujuan_pendamping` int(11) DEFAULT NULL,
  `ketinggian_menara` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `jenis_menara` enum('Tower 4 Kaki','Tower 3 Kaki','Tower 1 Kaki') DEFAULT NULL,
  `tinggi_menara` varchar(255) DEFAULT NULL,
  `tinggi_antena` varchar(255) DEFAULT NULL,
  `luas_area` varchar(255) DEFAULT NULL,
  `akses_jalan` varchar(255) DEFAULT NULL,
  `status_lahan` enum('sewa','milik_perusahaan') DEFAULT NULL,
  `kepemilikan_tanah` varchar(255) DEFAULT NULL,
  `file_SuratKuasa` varchar(255) DEFAULT NULL,
  `file_GambarRancanganPondasi` varchar(255) DEFAULT NULL,
  `file_DenahBangunan` varchar(255) DEFAULT NULL,
  `file_GambarLokasiDanSituasi` varchar(255) DEFAULT NULL,
  `file_KTPPemohon` varchar(255) DEFAULT NULL,
  `file_NPWPPemohon` varchar(255) DEFAULT NULL,
  `file_FotoPemohon` varchar(255) DEFAULT NULL,
  `file_SuratTanah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pemilik_menara` (`id_pemilik_menara`),
  CONSTRAINT `tb_pengajuan_menara_ibfk_1` FOREIGN KEY (`id_pemilik_menara`) REFERENCES `tb_pemilik_menara` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengajuan_menara` */

/*Table structure for table `tb_pengajuan_status` */

DROP TABLE IF EXISTS `tb_pengajuan_status`;

CREATE TABLE `tb_pengajuan_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` int(11) DEFAULT NULL,
  `id_pengajuan_menara` int(11) DEFAULT NULL,
  `tanggal_status` date DEFAULT NULL,
  `disposisi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_status` (`id_status`),
  KEY `id_pengajuan_menara` (`id_pengajuan_menara`),
  CONSTRAINT `tb_pengajuan_status_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `tb_m_status` (`id`),
  CONSTRAINT `tb_pengajuan_status_ibfk_2` FOREIGN KEY (`id_pengajuan_menara`) REFERENCES `tb_pengajuan_menara` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengajuan_status` */

/*Table structure for table `tb_penggunaan_menara` */

DROP TABLE IF EXISTS `tb_penggunaan_menara`;

CREATE TABLE `tb_penggunaan_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provider` int(11) DEFAULT NULL,
  `id_menara` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedt_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_menara` (`id_menara`),
  KEY `id_provider` (`id_provider`),
  CONSTRAINT `tb_penggunaan_menara_ibfk_3` FOREIGN KEY (`id_menara`) REFERENCES `tb_menara` (`id`),
  CONSTRAINT `tb_penggunaan_menara_ibfk_4` FOREIGN KEY (`id_provider`) REFERENCES `tb_provider` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_penggunaan_menara` */

/*Table structure for table `tb_persetujuan_pendamping` */

DROP TABLE IF EXISTS `tb_persetujuan_pendamping`;

CREATE TABLE `tb_persetujuan_pendamping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengajuan_menara` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(16) DEFAULT NULL,
  `file_suratPersetujuan` varchar(255) DEFAULT NULL,
  `jarak` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pengajuan_menara` (`id_pengajuan_menara`),
  CONSTRAINT `tb_persetujuan_pendamping_ibfk_1` FOREIGN KEY (`id_pengajuan_menara`) REFERENCES `tb_pengajuan_menara` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_persetujuan_pendamping` */

/*Table structure for table `tb_perusahaan` */

DROP TABLE IF EXISTS `tb_perusahaan`;

CREATE TABLE `tb_perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `file_TandaDaftarPerusahaan` varchar(255) DEFAULT NULL,
  `file_AktaPendirianPerusahaan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_perusahaan` */

/*Table structure for table `tb_provider` */

DROP TABLE IF EXISTS `tb_provider`;

CREATE TABLE `tb_provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_provider` */

/*Table structure for table `tb_super_admin` */

DROP TABLE IF EXISTS `tb_super_admin`;

CREATE TABLE `tb_super_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_super_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_super_admin` */

insert  into `tb_super_admin`(`id`,`id_user`,`nama`,`no_telp`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'SUPER ADMIN',NULL,NULL,'2022-09-19 11:17:18',NULL),
(7,15,'Tyagi',NULL,'2022-09-20 14:12:21','2022-09-20 14:12:21',NULL);

/*Table structure for table `tb_tim_administratif` */

DROP TABLE IF EXISTS `tb_tim_administratif`;

CREATE TABLE `tb_tim_administratif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
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

insert  into `tb_tim_administratif`(`id`,`id_user`,`id_opd`,`nama`,`no_telp`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,NULL,'Tim Administratif',NULL,'2022-09-10 18:21:00',NULL,NULL);

/*Table structure for table `tb_tim_lapangan` */

DROP TABLE IF EXISTS `tb_tim_lapangan`;

CREATE TABLE `tb_tim_lapangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
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

insert  into `tb_tim_lapangan`(`id`,`id_user`,`id_opd`,`nama`,`no_telp`,`created_at`,`updated_at`,`deleted_at`) values 
(1,3,NULL,'Tim Lapangan',NULL,'2022-09-10 18:21:13',NULL,NULL);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `kategori` enum('Super Admin','Admin','Tim Administratif','Tim Lapangan','Pemilik Menara') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`kategori`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'admin','$2y$10$ufW/keFqUNxnlk7OcG3Pi.Ty1TKrAE5QaVpVa1WPNvyuiilFhAZta','Super Admin',NULL,NULL,NULL),
(2,'tim_administratif','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Tim Administratif',NULL,NULL,NULL),
(3,'tim_lapangan','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Tim Lapangan',NULL,NULL,NULL),
(5,'pemilik_menara','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Pemilik Menara',NULL,NULL,NULL),
(6,'provider','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','',NULL,NULL,NULL),
(11,'asd','$2y$10$jpNwswBnAfS3hIfhGaTmBuWCGXyLsrYuzlOmcaHFj5x3nk6bbJnU.','Pemilik Menara',NULL,NULL,NULL),
(12,'qwe','$2y$10$u6gakYhnhWCjF47nfLEn6OKvdeD/wGwJXsierCVOfd4kFYcMXl1zq','',NULL,NULL,NULL),
(15,'tyagi','$2y$10$sFgGMLBnZ2YAAgOqh6U6kucpp04wUC0hnyfITMgbsKkQtLzcHE7WG','Super Admin',NULL,NULL,NULL),
(16,NULL,'$2y$10$XvGWwUnv70njFgk7KdR2K.fQYmARqKJJIdH0/w6/TUvcfBz65gNjC','Pemilik Menara',NULL,NULL,NULL),
(17,'asd','$2y$10$esjab/fcG0y7IIJMKOAgOurstnIx2/YVkBynURIb/UFc6CR9nvrtO','Pemilik Menara',NULL,NULL,NULL),
(18,'qwe','$2y$10$qogdYEZewATPWEEvM.S09uN9udi50ZQzu4ZBM0DbywFc9GdP9kNZa','Pemilik Menara',NULL,NULL,NULL);

/*Table structure for table `tb_zone_plan` */

DROP TABLE IF EXISTS `tb_zone_plan`;

CREATE TABLE `tb_zone_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `status` enum('available','used') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_zone_plan` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
