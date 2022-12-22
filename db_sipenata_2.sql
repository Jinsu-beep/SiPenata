/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.27-MariaDB : Database - db_sipenata
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_sipenata` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`id`,`id_user`,`nama`,`no_telp`,`created_at`,`updated_at`,`deleted_at`) values 
(1,34,'admin','01','2022-12-01 16:33:36','2022-12-01 16:33:36',NULL),
(4,39,'admin2','0000','2022-12-12 17:48:07','2022-12-12 17:48:07',NULL);

/*Table structure for table `tb_detail_perusahaan` */

DROP TABLE IF EXISTS `tb_detail_perusahaan`;

CREATE TABLE `tb_detail_perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(11) DEFAULT NULL,
  `file` enum('TandaDaftarPerusahaan','AktaPendirianPerusahaan') DEFAULT NULL,
  `patch` varchar(255) DEFAULT NULL,
  `status` enum('tunggu persetujuan','perbaiki','disetujui') DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_perusahaan` (`id_perusahaan`),
  CONSTRAINT `tb_detail_perusahaan_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `tb_perusahaan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_detail_perusahaan` */

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_dasarhukum` */

insert  into `tb_m_dasarhukum`(`id`,`nama`,`no_DasarHukum`,`file_DasarHukum`,`tanggal`,`created_at`,`updated_at`,`deleted_at`) values 
(6,'test3','test3','/storage/DasarHukum/test3.pdf','2022-11-19','2022-11-19 17:54:22','2022-11-19 17:54:22',NULL),
(10,'test4','test4','/storage/DasarHukum/test4.pdf','2022-12-04','2022-12-04 20:04:27','2022-12-04 20:04:27',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_desa` */

/*Table structure for table `tb_m_kabupaten` */

DROP TABLE IF EXISTS `tb_m_kabupaten`;

CREATE TABLE `tb_m_kabupaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nama_panjang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_provinsi` (`id_provinsi`),
  CONSTRAINT `tb_m_kabupaten_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `tb_m_provinsi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_kabupaten` */

insert  into `tb_m_kabupaten`(`id`,`id_provinsi`,`nama`,`nama_panjang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,51,'Jembrana','Kabupaten Jembrana','2022-12-16 17:22:33',NULL,NULL),
(2,51,'Tabanan','Kabupaten Tabanan','2022-12-16 17:22:33',NULL,NULL),
(3,51,'Badung','Kabupaten Badung','2022-12-16 17:22:33',NULL,NULL),
(4,51,'Gianyar','Kabupaten Gianyar','2022-12-16 17:22:33',NULL,NULL),
(5,51,'Klungkung','Kabupaten Klungkung','2022-12-16 17:22:33',NULL,NULL),
(6,51,'Bangli','Kabupaten Bangli','2022-12-16 17:22:33',NULL,NULL),
(7,51,'Karangasem','Kabupaten Karangasem','2022-12-16 17:22:33',NULL,NULL),
(8,51,'Buleleng','Kabupaten Buleleng','2022-12-16 17:22:33',NULL,NULL),
(9,51,'Denpasar','Kota Denpasar','2022-12-16 17:22:33',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_kecamatan` */

/*Table structure for table `tb_m_provinsi` */

DROP TABLE IF EXISTS `tb_m_provinsi`;

CREATE TABLE `tb_m_provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `nama_panjang` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_provinsi` */

/*Table structure for table `tb_m_status` */

DROP TABLE IF EXISTS `tb_m_status`;

CREATE TABLE `tb_m_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  CONSTRAINT `tb_menara_ibfk_1` FOREIGN KEY (`id_pemilik_menara`) REFERENCES `tb_pemilik_menara` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_opd` */

insert  into `tb_opd`(`id`,`opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Kominfo','2022-11-21 01:01:25',NULL,NULL),
(2,'Lingkungan','2022-11-21 01:01:31',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_pemilik_menara` */

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
  `alamat` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `jenis_menara` enum('Tower 4 Kaki','Tower 3 Kaki','Tower 1 Kaki') DEFAULT NULL,
  `tinggi_menara` varchar(255) DEFAULT NULL,
  `tinggi_antena` varchar(255) DEFAULT NULL,
  `luas_area` varchar(255) DEFAULT NULL,
  `akses_jalan` varchar(255) DEFAULT NULL,
  `status_lahan` enum('sewa','milik perusahaan') DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_persetujuan_pendamping` */

insert  into `tb_persetujuan_pendamping`(`id`,`id_pengajuan_menara`,`nama`,`no_ktp`,`file_suratPersetujuan`,`jarak`,`created_at`,`updated_at`,`deleted_at`) values 
(2,NULL,'s','s','s','s','2022-12-09 16:39:20','2022-12-09 16:39:20',NULL),
(3,NULL,'a','a','a','a','2022-12-09 16:39:20','2022-12-09 16:39:20',NULL);

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
  `status` enum('tunggu persetujuan','perbaiki','diterima') DEFAULT NULL,
  `disposisi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_provider` */

insert  into `tb_provider`(`id`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(12,'Telkomsel','2022-12-14 08:39:09','2022-12-14 08:39:09',NULL),
(13,'Indosat','2022-12-14 08:39:16','2022-12-14 08:39:16',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_super_admin` */

insert  into `tb_super_admin`(`id`,`id_user`,`nama`,`no_telp`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'SUPER ADMIN','123456789123',NULL,'2022-12-01 16:53:49',NULL),
(12,24,'a','081246775621','2022-11-20 16:32:50','2022-11-20 16:32:50',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_tim_administratif` */

insert  into `tb_tim_administratif`(`id`,`id_user`,`id_opd`,`nama`,`no_telp`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,2,'Tim Administratif','123456789123','2022-12-02 01:24:54',NULL,NULL),
(4,26,NULL,'sd','081231231231','2022-11-21 09:18:10','2022-11-21 09:18:10',NULL),
(5,27,NULL,'ghj','ghj','2022-11-21 09:29:40','2022-11-21 09:29:40',NULL),
(6,28,2,'123','rty','2022-11-21 17:53:09','2022-11-21 09:53:09',NULL),
(7,40,1,'tim administratif','111','2022-12-12 17:48:57','2022-12-12 17:48:57',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_tim_lapangan` */

insert  into `tb_tim_lapangan`(`id`,`id_user`,`id_opd`,`nama`,`no_telp`,`created_at`,`updated_at`,`deleted_at`) values 
(1,3,NULL,'Tim Lapangan',NULL,'2022-09-10 18:21:13',NULL,NULL),
(3,41,2,'tim lapangan','2222','2022-12-12 17:49:58','2022-12-12 17:49:58',NULL);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `kategori` enum('Super Admin','Admin','Tim Administratif','Tim Lapangan','Pemilik Menara') DEFAULT NULL,
  `token` varchar(16) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`kategori`,`token`,`created_at`,`verified_at`,`updated_at`,`deleted_at`) values 
(1,'superadmin','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Super Admin',NULL,NULL,'2022-12-13 01:47:19',NULL,NULL),
(2,'tim_administratif','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Tim Administratif',NULL,NULL,'2022-12-13 01:47:25',NULL,NULL),
(3,'tim_lapangan','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Tim Lapangan',NULL,NULL,'2022-12-13 01:47:27',NULL,NULL),
(19,'w','$2y$10$ufW/keFqUNxnlk7OcG3Pi.Ty1TKrAE5QaVpVa1WPNvyuiilFhAZta','Admin',NULL,NULL,NULL,NULL,NULL),
(24,'a','$2y$10$8K3k8ufpTHsIlLn1Jn0xZuDzD76Ixti6LgDqjiuteRCP2fYm56GQy','Super Admin',NULL,NULL,NULL,NULL,NULL),
(26,'sda','$2y$10$J3EDx3opi9qP/TLbCzJ35uGhmeoY7i2GB.d3pH4P6qmXXRIBBbI3a','Tim Administratif',NULL,NULL,NULL,NULL,NULL),
(27,'ghj','$2y$10$WNmjr/N5h82GLh8/tGX4Uuy5/9U92yX0mBqLvKj2zgST1ze2zPuAm','Tim Administratif',NULL,NULL,NULL,NULL,NULL),
(28,'sd','$2y$10$clY9FWvUnShQ0wCsRupQiuxkB/YsPIB4ZT2W1a5GjSHLHR0vU0nXK','Tim Administratif',NULL,NULL,NULL,NULL,NULL),
(34,'admin','$2y$10$BLdwxKtgvLz1Y7zuKkksO..GyBTK3vzL.RxoBKlJmrb3Z0S0dJ.N6','Admin',NULL,NULL,'2022-12-12 21:46:04',NULL,NULL),
(39,'admin2','$2y$10$m2InHNWCpLhWz6XRF0l8leCGtZ2PL.psVTQgRA8yfi.2unU3bU48e','Admin',NULL,NULL,'2022-12-12 17:48:07',NULL,NULL),
(40,'timAdmin','$2y$10$lC4MtMECV5I9tmH/vbyeNeAM4JVANmDKNp40GP6MrT5/IQbSdM1/q','Tim Administratif',NULL,NULL,'2022-12-12 17:48:57',NULL,NULL),
(41,'timlapangan','$2y$10$RVVQCsjMI6XLwVYOdrA/eOphmRyYVxN.Nug9Pz2lkruWWZM0wsIoW','Tim Lapangan',NULL,NULL,'2022-12-12 17:49:58',NULL,NULL),
(42,'tyagijisnu','$2y$10$LAdo24Na1SBkyTB3bjBdy.43V7Nuu/QQ2DxB.iAAAkD4fvRD4R0AS','Pemilik Menara','CTnMy1pr8UffA1ab',NULL,'2022-12-13 23:09:27',NULL,NULL);

/*Table structure for table `tb_zone_plan` */

DROP TABLE IF EXISTS `tb_zone_plan`;

CREATE TABLE `tb_zone_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `radius` int(11) DEFAULT NULL,
  `status` enum('available','used') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_zone_plan` */

insert  into `tb_zone_plan`(`id`,`nama`,`lat`,`long`,`radius`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(6,'ewqqwe','-8.271646791709626','115.16208151096887',236,'used','2022-12-08 21:29:26','2022-12-08 13:29:26',NULL),
(7,'dsadasd','-8.412910048650659','115.58908936920683',54,'available','2022-12-08 15:03:09','2022-12-08 15:03:09',NULL),
(8,'zone plan jln sultan agung','-8.442850582380535','115.62276231966094',350,'available','2022-12-14 08:38:47','2022-12-14 08:38:47',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
