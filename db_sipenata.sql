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
  `id_user` bigint(20) DEFAULT NULL,
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
(1,44,'admin','01','2022-12-16 17:36:43','2022-12-01 16:33:36',NULL);

/*Table structure for table `tb_detail_pengajuan` */

DROP TABLE IF EXISTS `tb_detail_pengajuan`;

CREATE TABLE `tb_detail_pengajuan` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_pengajuan_menara` int(11) DEFAULT NULL,
  `file` enum('SuratKuasa','RancangBangun','DenahBangunan','GambarLokasiDanSituasi','KTPPemohon','NPWPPemohon','FotoPemohon','SuratTanah') DEFAULT NULL,
  `patch` varchar(255) DEFAULT NULL,
  `status` enum('disetujui','perbaiki','tunggu persetujuan') DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pengajuan_menara` (`id_pengajuan_menara`),
  CONSTRAINT `tb_detail_pengajuan_ibfk_1` FOREIGN KEY (`id_pengajuan_menara`) REFERENCES `tb_pengajuan_menara` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_detail_pengajuan` */

insert  into `tb_detail_pengajuan`(`id`,`id_pengajuan_menara`,`file`,`patch`,`status`,`tanggal`,`created_at`,`updated_at`,`deleted_at`) values 
(1,8,'KTPPemohon','/storage/Pengajuan/8/KTPPemohon.jpg','disetujui','2023-01-08','2023-01-08 17:44:41','2023-01-08 09:44:41',NULL),
(2,8,'NPWPPemohon','/storage/Pengajuan/8/NPWPPemohon.jpeg','disetujui','2023-01-08','2023-01-08 17:44:41','2023-01-08 09:44:41',NULL),
(3,8,'FotoPemohon','/storage/Pengajuan/8/FotoPemohon.jpg','disetujui','2023-01-08','2023-01-08 17:44:41','2023-01-08 09:44:41',NULL),
(4,8,'SuratKuasa','/storage/Pengajuan/8/SuratKuasa.pdf','disetujui','2023-01-08','2023-01-08 17:44:41','2023-01-08 09:44:41',NULL),
(5,8,'RancangBangun','/storage/Pengajuan/8/RancangBangun.pdf','disetujui','2023-01-08','2023-01-08 17:44:41','2023-01-08 09:44:41',NULL),
(6,8,'DenahBangunan','/storage/Pengajuan/8/DenahBangunan.pdf','disetujui','2023-01-08','2023-01-08 17:44:41','2023-01-08 09:44:41',NULL),
(7,8,'GambarLokasiDanSituasi','/storage/Pengajuan/8/LokasiDanSituasi.pdf','disetujui','2023-01-08','2023-01-08 17:44:41','2023-01-08 09:44:41',NULL),
(8,8,'SuratTanah','/storage/Pengajuan/8/SuratTanah.pdf','disetujui','2023-01-08','2023-01-08 17:44:41','2023-01-08 09:44:41',NULL),
(25,11,'KTPPemohon','/storage/Pengajuan/11/KTPPemohon.jpg','disetujui','2023-01-30','2023-01-31 02:15:31','2023-01-30 18:15:31',NULL),
(26,11,'NPWPPemohon','/storage/Pengajuan/11/NPWPPemohon.jpeg','disetujui','2023-01-30','2023-01-31 02:15:31','2023-01-30 18:15:31',NULL),
(27,11,'FotoPemohon','/storage/Pengajuan/11/FotoPemohon.jpg','disetujui','2023-01-30','2023-01-31 02:15:31','2023-01-30 18:15:31',NULL),
(28,11,'SuratKuasa','/storage/Pengajuan/11/SuratKuasa.pdf','disetujui','2023-01-30','2023-01-31 02:15:31','2023-01-30 18:15:31',NULL),
(29,11,'RancangBangun','/storage/Pengajuan/11/RancangBangun.pdf','disetujui','2023-01-30','2023-01-31 02:15:31','2023-01-30 18:15:31',NULL),
(30,11,'DenahBangunan','/storage/Pengajuan/11/DenahBangunan.pdf','disetujui','2023-01-30','2023-01-31 02:15:31','2023-01-30 18:15:31',NULL),
(31,11,'GambarLokasiDanSituasi','/storage/Pengajuan/11/LokasiDanSituasi.pdf','disetujui','2023-01-30','2023-01-31 02:15:31','2023-01-30 18:15:31',NULL),
(32,11,'SuratTanah','/storage/Pengajuan/11/SuratTanah.pdf','disetujui','2023-01-30','2023-01-31 02:15:31','2023-01-30 18:15:31',NULL),
(33,12,'KTPPemohon','/storage/Pengajuan/12/KTPPemohon.jpg','disetujui','2023-02-02','2023-02-02 17:56:42','2023-02-02 09:56:42',NULL),
(34,12,'NPWPPemohon','/storage/Pengajuan/12/NPWPPemohon.jpeg','disetujui','2023-02-02','2023-02-02 17:56:42','2023-02-02 09:56:42',NULL),
(35,12,'FotoPemohon','/storage/Pengajuan/12/FotoPemohon.jpg','disetujui','2023-02-02','2023-02-02 17:56:42','2023-02-02 09:56:42',NULL),
(36,12,'SuratKuasa','/storage/Pengajuan/12/SuratKuasa.pdf','disetujui','2023-02-02','2023-02-02 17:56:42','2023-02-02 09:56:42',NULL),
(37,12,'RancangBangun','/storage/Pengajuan/12/RancangBangun.pdf','disetujui','2023-02-02','2023-02-02 17:56:42','2023-02-02 09:56:42',NULL),
(38,12,'DenahBangunan','/storage/Pengajuan/12/DenahBangunan.pdf','disetujui','2023-02-02','2023-02-02 17:56:42','2023-02-02 09:56:42',NULL),
(39,12,'GambarLokasiDanSituasi','/storage/Pengajuan/12/LokasiDanSituasi.pdf','disetujui','2023-02-02','2023-02-02 17:56:42','2023-02-02 09:56:42',NULL),
(40,12,'SuratTanah','/storage/Pengajuan/12/SuratTanah.pdf','disetujui','2023-02-02','2023-02-02 17:56:42','2023-02-02 09:56:42',NULL),
(41,13,'KTPPemohon','/storage/Pengajuan/13/KTPPemohon.jpg','disetujui','2023-02-03','2023-02-04 03:46:14','2023-02-03 19:46:14',NULL),
(42,13,'NPWPPemohon','/storage/Pengajuan/13/NPWPPemohon.jpeg','disetujui','2023-02-03','2023-02-04 03:46:14','2023-02-03 19:46:14',NULL),
(43,13,'FotoPemohon','/storage/Pengajuan/13/FotoPemohon.jpg','disetujui','2023-02-03','2023-02-04 03:46:14','2023-02-03 19:46:14',NULL),
(44,13,'SuratKuasa','/storage/Pengajuan/13/SuratKuasa.pdf','disetujui','2023-02-03','2023-02-04 03:46:14','2023-02-03 19:46:14',NULL),
(45,13,'RancangBangun','/storage/Pengajuan/13/RancangBangun.pdf','disetujui','2023-02-03','2023-02-04 03:46:14','2023-02-03 19:46:14',NULL),
(46,13,'DenahBangunan','/storage/Pengajuan/13/DenahBangunan.pdf','disetujui','2023-02-03','2023-02-04 03:46:14','2023-02-03 19:46:14',NULL),
(47,13,'GambarLokasiDanSituasi','/storage/Pengajuan/13/LokasiDanSituasi.pdf','disetujui','2023-02-03','2023-02-04 03:46:14','2023-02-03 19:46:14',NULL),
(48,13,'SuratTanah','/storage/Pengajuan/13/SuratTanah.pdf','disetujui','2023-02-03','2023-02-04 03:46:14','2023-02-03 19:46:14',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_detail_perusahaan` */

insert  into `tb_detail_perusahaan`(`id`,`id_perusahaan`,`file`,`patch`,`status`,`tanggal`,`created_at`,`updated_at`,`deleted_at`) values 
(1,16,'TandaDaftarPerusahaan','/storage/Perusahaan/16/TandaDaftar.pdf','disetujui','2023-01-08','2023-01-08 17:23:19','2023-01-08 09:23:19',NULL),
(2,16,'AktaPendirianPerusahaan','/storage/Perusahaan/16/AktaPendirian.pdf','disetujui','2023-01-08','2023-01-08 17:23:19','2023-01-08 09:23:19',NULL),
(3,17,'TandaDaftarPerusahaan','/storage/Perusahaan/17/TandaDaftar.pdf','disetujui','2023-01-08','2023-01-10 12:28:35','2023-01-10 04:28:35',NULL),
(4,17,'AktaPendirianPerusahaan','/storage/Perusahaan/17/AktaPendirian.pdf','disetujui','2023-01-08','2023-01-10 12:28:35','2023-01-10 04:28:35',NULL);

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
  KEY `id_tim_lapangan` (`id_tim_lapangan`),
  KEY `id_menara` (`id_menara`),
  CONSTRAINT `tb_laporan_kondisi_ibfk_1` FOREIGN KEY (`id_tim_lapangan`) REFERENCES `tb_tim_lapangan` (`id`),
  CONSTRAINT `tb_laporan_kondisi_ibfk_2` FOREIGN KEY (`id_menara`) REFERENCES `tb_menara` (`id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_dasarhukum` */

insert  into `tb_m_dasarhukum`(`id`,`nama`,`no_DasarHukum`,`file_DasarHukum`,`tanggal`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'PENETAPAN ZONA LOKASI MENARA TELEKOMUNIKASI','101/ HK/ 2019','/storage/DasarHukum/PENETAPAN ZONA LOKASI MENARA TELEKOMUNIKASI.pdf','2023-01-08','2023-01-08 08:41:08','2023-01-08 08:41:08',NULL),
(2,'PERUBAHAN ATAS KEPUTUSAN BUPATI NOMOR 362/HK/2018 TENTANG PENETAPAN PERUNTUKAN DAN KETINGGIAN MENARA TELEKOMUNIKASI','109/ HK/ 2019','/storage/DasarHukum/PERUBAHAN ATAS KEPUTUSAN BUPATI NOMOR 362/HK/2018 TENTANG PENETAPAN PERUNTUKAN DAN KETINGGIAN MENARA TELEKOMUNIKASI.pdf','2023-01-08','2023-01-08 08:41:49','2023-01-08 08:41:49',NULL),
(3,'PEDOMAN PEMBANGUNAN DAN PENGGUNAAN BERSAMA MENARA TELEKOMUNIKASI','18 Tahun 2009, 07/PRTM/2009, 19/PER/M.KOMINFO/03/2','/storage/DasarHukum/PEDOMAN PEMBANGUNAN DAN PENGGUNAAN BERSAMA MENARA TELEKOMUNIKASI.pdf','2023-01-08','2023-01-08 08:42:42','2023-01-08 08:42:42',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=738 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_desa` */

insert  into `tb_m_desa`(`id`,`id_kecamatan`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,101,'Cupel','2022-12-16 17:33:31',NULL,NULL),
(2,101,'Baluk','2022-12-16 17:33:31',NULL,NULL),
(3,101,'Banyu Biru','2022-12-16 17:33:31',NULL,NULL),
(4,101,'Kaliakah','2022-12-16 17:33:31',NULL,NULL),
(5,101,'Berangbang','2022-12-16 17:33:31',NULL,NULL),
(6,101,'Baler Bale Agung','2022-12-16 17:33:31',NULL,NULL),
(7,101,'Pendem','2022-12-16 17:33:31',NULL,NULL),
(8,101,'Banjar Tengah','2022-12-16 17:33:31',NULL,NULL),
(9,101,'Tegal Badeng Timur','2022-12-16 17:33:31',NULL,NULL),
(10,101,'Tegal Badeng Barat','2022-12-16 17:33:31',NULL,NULL),
(11,101,'Pengambengan','2022-12-16 17:33:31',NULL,NULL),
(12,101,'Perancak','2022-12-16 17:33:31',NULL,NULL),
(13,101,'Lelateng','2022-12-16 17:33:31',NULL,NULL),
(14,101,'Loloan Barat','2022-12-16 17:33:31',NULL,NULL),
(15,101,'Loloan Timur','2022-12-16 17:33:31',NULL,NULL),
(16,101,'Batu Agung','2022-12-16 17:33:31',NULL,NULL),
(17,101,'Dauhwaru','2022-12-16 17:33:31',NULL,NULL),
(18,101,'Budeng','2022-12-16 17:33:31',NULL,NULL),
(19,101,'Air Kuning','2022-12-16 17:33:31',NULL,NULL),
(20,101,'Yehkuning','2022-12-16 17:33:31',NULL,NULL),
(21,101,'Sangkaragung','2022-12-16 17:33:31',NULL,NULL),
(22,101,'Dangin Tukadaya','2022-12-16 17:33:31',NULL,NULL),
(23,102,'Mendoyo Dauh Tukad','2022-12-16 17:33:31',NULL,NULL),
(24,102,'Pohsanten','2022-12-16 17:33:31',NULL,NULL),
(25,102,'Mendoyo Dangin Tukad','2022-12-16 17:33:31',NULL,NULL),
(26,102,'Pergung','2022-12-16 17:33:31',NULL,NULL),
(27,102,'Delodberawah','2022-12-16 17:33:31',NULL,NULL),
(28,102,'Tegalcangkring','2022-12-16 17:33:31',NULL,NULL),
(29,102,'Penyaringan','2022-12-16 17:33:31',NULL,NULL),
(30,102,'Yehembang','2022-12-16 17:33:31',NULL,NULL),
(31,102,'Yeh Sumbul','2022-12-16 17:33:31',NULL,NULL),
(32,102,'Yehembang  Kauh','2022-12-16 17:33:31',NULL,NULL),
(33,102,'Yehembang  Kangin','2022-12-16 17:33:31',NULL,NULL),
(34,103,'Medewi','2022-12-16 17:33:31',NULL,NULL),
(35,103,'Pulukan','2022-12-16 17:33:31',NULL,NULL),
(36,103,'Asahduren','2022-12-16 17:33:31',NULL,NULL),
(37,103,'Pekutatan','2022-12-16 17:33:31',NULL,NULL),
(38,103,'Pangyangan','2022-12-16 17:33:31',NULL,NULL),
(39,103,'Gumbrih','2022-12-16 17:33:31',NULL,NULL),
(40,103,'Manggissari','2022-12-16 17:33:31',NULL,NULL),
(41,103,'Pengragoan','2022-12-16 17:33:31',NULL,NULL),
(42,104,'Gilimanuk','2022-12-16 17:33:31',NULL,NULL),
(43,104,'Melaya','2022-12-16 17:33:31',NULL,NULL),
(44,104,'Belimbingsari','2022-12-16 17:33:31',NULL,NULL),
(45,104,'Ekasari','2022-12-16 17:33:31',NULL,NULL),
(46,104,'Nusasari','2022-12-16 17:33:31',NULL,NULL),
(47,104,'Warnasari','2022-12-16 17:33:31',NULL,NULL),
(48,104,'Candikusuma','2022-12-16 17:33:31',NULL,NULL),
(49,104,'Tuwed','2022-12-16 17:33:31',NULL,NULL),
(50,104,'Tukadaya','2022-12-16 17:33:31',NULL,NULL),
(51,104,'Manistutu','2022-12-16 17:33:31',NULL,NULL),
(52,105,'Pendem','2022-12-16 17:33:31',NULL,NULL),
(53,105,'Perancak','2022-12-16 17:33:31',NULL,NULL),
(54,105,'Loloan Timur','2022-12-16 17:33:31',NULL,NULL),
(55,105,'Batu Agung','2022-12-16 17:33:31',NULL,NULL),
(56,105,'Dauhwaru','2022-12-16 17:33:31',NULL,NULL),
(57,105,'Budeng','2022-12-16 17:33:31',NULL,NULL),
(58,105,'Air Kuning','2022-12-16 17:33:31',NULL,NULL),
(59,105,'Yehkuning','2022-12-16 17:33:31',NULL,NULL),
(60,105,'Sangkaragung','2022-12-16 17:33:31',NULL,NULL),
(61,105,'Dangin Tukad Aya','2022-12-16 17:33:31',NULL,NULL),
(62,201,'Bajera','2022-12-16 17:33:31',NULL,NULL),
(63,201,'Wanagiri','2022-12-16 17:33:31',NULL,NULL),
(64,201,'Pupuan Sawah','2022-12-16 17:33:31',NULL,NULL),
(65,201,'Berembeng','2022-12-16 17:33:31',NULL,NULL),
(66,201,'Selemadeg','2022-12-16 17:33:31',NULL,NULL),
(67,201,'Sarampingan','2022-12-16 17:33:31',NULL,NULL),
(68,201,'Antap','2022-12-16 17:33:31',NULL,NULL),
(69,201,'Wanagiri Kauh','2022-12-16 17:33:31',NULL,NULL),
(70,201,'Manikyang','2022-12-16 17:33:31',NULL,NULL),
(71,201,'Bajera Utara','2022-12-16 17:33:31',NULL,NULL),
(72,202,'Gunung Salak','2022-12-16 17:33:31',NULL,NULL),
(73,202,'Gadungan','2022-12-16 17:33:31',NULL,NULL),
(74,202,'Bantas','2022-12-16 17:33:31',NULL,NULL),
(75,202,'Mambang','2022-12-16 17:33:31',NULL,NULL),
(76,202,'Megati','2022-12-16 17:33:31',NULL,NULL),
(77,202,'Tangguntiti','2022-12-16 17:33:31',NULL,NULL),
(78,202,'Beraban','2022-12-16 17:33:31',NULL,NULL),
(79,202,'Tegal Mengkeb','2022-12-16 17:33:31',NULL,NULL),
(80,202,'Dalang','2022-12-16 17:33:31',NULL,NULL),
(81,202,'Gadungsari','2022-12-16 17:33:31',NULL,NULL),
(82,203,'Mundeh','2022-12-16 17:33:31',NULL,NULL),
(83,203,'Mundeh Kangin','2022-12-16 17:33:31',NULL,NULL),
(84,203,'Lalanglinggah','2022-12-16 17:33:31',NULL,NULL),
(85,203,'Antosari','2022-12-16 17:33:31',NULL,NULL),
(86,203,'Lumbung','2022-12-16 17:33:31',NULL,NULL),
(87,203,'Lumbung Kauh','2022-12-16 17:33:31',NULL,NULL),
(88,203,'Tiing Gading','2022-12-16 17:33:31',NULL,NULL),
(89,203,'Mundeh Kauh','2022-12-16 17:33:31',NULL,NULL),
(90,203,'Angkah','2022-12-16 17:33:31',NULL,NULL),
(91,203,'Selabih','2022-12-16 17:33:31',NULL,NULL),
(92,203,'Bengkel Sari','2022-12-16 17:33:31',NULL,NULL),
(93,204,'Tibubiu','2022-12-16 17:33:31',NULL,NULL),
(94,204,'Kelating','2022-12-16 17:33:31',NULL,NULL),
(95,204,'Penarukan','2022-12-16 17:33:31',NULL,NULL),
(96,204,'Belumbang','2022-12-16 17:33:31',NULL,NULL),
(97,204,'Tista','2022-12-16 17:33:31',NULL,NULL),
(98,204,'Kerambitan','2022-12-16 17:33:31',NULL,NULL),
(99,204,'Pangkung Karung','2022-12-16 17:33:31',NULL,NULL),
(100,204,'Samsam','2022-12-16 17:33:31',NULL,NULL),
(101,204,'Kukuh','2022-12-16 17:33:31',NULL,NULL),
(102,204,'Baturiti','2022-12-16 17:33:31',NULL,NULL),
(103,204,'Meliling','2022-12-16 17:33:31',NULL,NULL),
(104,204,'Sembung Gede','2022-12-16 17:33:31',NULL,NULL),
(105,204,'Batuaji','2022-12-16 17:33:31',NULL,NULL),
(106,204,'Kesiut','2022-12-16 17:33:31',NULL,NULL),
(107,204,'Timpag','2022-12-16 17:33:31',NULL,NULL),
(108,205,'Sudimara','2022-12-16 17:33:31',NULL,NULL),
(109,205,'Gubug','2022-12-16 17:33:31',NULL,NULL),
(110,205,'Bongan','2022-12-16 17:33:31',NULL,NULL),
(111,205,'Delod Peken','2022-12-16 17:33:31',NULL,NULL),
(112,205,'Dauh Peken','2022-12-16 17:33:31',NULL,NULL),
(113,205,'Dajan Peken','2022-12-16 17:33:31',NULL,NULL),
(114,205,'Denbantas','2022-12-16 17:33:31',NULL,NULL),
(115,205,'Subamia','2022-12-16 17:33:31',NULL,NULL),
(116,205,'Wanasari','2022-12-16 17:33:31',NULL,NULL),
(117,205,'Tunjuk','2022-12-16 17:33:31',NULL,NULL),
(118,205,'Buahan','2022-12-16 17:33:31',NULL,NULL),
(119,205,'Sesandan','2022-12-16 17:33:31',NULL,NULL),
(120,206,'Bengkel','2022-12-16 17:33:31',NULL,NULL),
(121,206,'Pangkung Tibah','2022-12-16 17:33:31',NULL,NULL),
(122,206,'Belalang','2022-12-16 17:33:31',NULL,NULL),
(123,206,'Beraban','2022-12-16 17:33:31',NULL,NULL),
(124,206,'Buwit','2022-12-16 17:33:31',NULL,NULL),
(125,206,'Cepaka','2022-12-16 17:33:31',NULL,NULL),
(126,206,'Kaba-kaba','2022-12-16 17:33:31',NULL,NULL),
(127,206,'Nyambu','2022-12-16 17:33:31',NULL,NULL),
(128,206,'Pandak Bandung','2022-12-16 17:33:31',NULL,NULL),
(129,206,'Pandak Gede','2022-12-16 17:33:31',NULL,NULL),
(130,206,'Nyitdah','2022-12-16 17:33:31',NULL,NULL),
(131,206,'Pejaten','2022-12-16 17:33:31',NULL,NULL),
(132,206,'Kediri','2022-12-16 17:33:31',NULL,NULL),
(133,206,'Abian Tuwung','2022-12-16 17:33:31',NULL,NULL),
(134,206,'Banjar Anyar','2022-12-16 17:33:31',NULL,NULL),
(135,207,'Kukuh','2022-12-16 17:33:31',NULL,NULL),
(136,207,'Beringkit','2022-12-16 17:33:31',NULL,NULL),
(137,207,'Peken','2022-12-16 17:33:31',NULL,NULL),
(138,207,'Batannyuh','2022-12-16 17:33:31',NULL,NULL),
(139,207,'Tegaljadi','2022-12-16 17:33:31',NULL,NULL),
(140,207,'Kuwum','2022-12-16 17:33:31',NULL,NULL),
(141,207,'Selanbawak','2022-12-16 17:33:31',NULL,NULL),
(142,207,'Marga','2022-12-16 17:33:31',NULL,NULL),
(143,207,'Petiga','2022-12-16 17:33:31',NULL,NULL),
(144,207,'Cau Belayu','2022-12-16 17:33:31',NULL,NULL),
(145,207,'Tua','2022-12-16 17:33:31',NULL,NULL),
(146,207,'Payangan','2022-12-16 17:33:31',NULL,NULL),
(147,207,'Marga Dajan Puri','2022-12-16 17:33:31',NULL,NULL),
(148,207,'Marga Dauh Puri','2022-12-16 17:33:31',NULL,NULL),
(149,207,'Geluntung','2022-12-16 17:33:31',NULL,NULL),
(150,207,'Baru','2022-12-16 17:33:31',NULL,NULL),
(151,208,'Rejasa','2022-12-16 17:33:31',NULL,NULL),
(152,208,'Jegu','2022-12-16 17:33:31',NULL,NULL),
(153,208,'Riang Gede','2022-12-16 17:33:31',NULL,NULL),
(154,208,'Buruan','2022-12-16 17:33:31',NULL,NULL),
(155,208,'Biaung','2022-12-16 17:33:31',NULL,NULL),
(156,208,'Pitra','2022-12-16 17:33:31',NULL,NULL),
(157,208,'Penatahan','2022-12-16 17:33:31',NULL,NULL),
(158,208,'Tengkudak','2022-12-16 17:33:31',NULL,NULL),
(159,208,'Mengesta','2022-12-16 17:33:31',NULL,NULL),
(160,208,'Penebel','2022-12-16 17:33:31',NULL,NULL),
(161,208,'Babakan','2022-12-16 17:33:31',NULL,NULL),
(162,208,'Senganan','2022-12-16 17:33:31',NULL,NULL),
(163,208,'Jatiluwih','2022-12-16 17:33:31',NULL,NULL),
(164,208,'Wongaya Gede','2022-12-16 17:33:31',NULL,NULL),
(165,208,'Tajen','2022-12-16 17:33:31',NULL,NULL),
(166,208,'Tegallinggah','2022-12-16 17:33:31',NULL,NULL),
(167,208,'Pesagi','2022-12-16 17:33:31',NULL,NULL),
(168,208,'Sangketan','2022-12-16 17:33:31',NULL,NULL),
(169,209,'Perean','2022-12-16 17:33:31',NULL,NULL),
(170,209,'Luwus','2022-12-16 17:33:31',NULL,NULL),
(171,209,'Apuan','2022-12-16 17:33:31',NULL,NULL),
(172,209,'Angseri','2022-12-16 17:33:31',NULL,NULL),
(173,209,'Bangli','2022-12-16 17:33:31',NULL,NULL),
(174,209,'Baturiti','2022-12-16 17:33:31',NULL,NULL),
(175,209,'Antapan','2022-12-16 17:33:31',NULL,NULL),
(176,209,'Candikuning','2022-12-16 17:33:31',NULL,NULL),
(177,209,'Mekarsari','2022-12-16 17:33:31',NULL,NULL),
(178,209,'Batunya','2022-12-16 17:33:31',NULL,NULL),
(179,209,'Perean Tengah','2022-12-16 17:33:31',NULL,NULL),
(180,209,'Perean Kangin','2022-12-16 17:33:31',NULL,NULL),
(181,210,'Belimbing','2022-12-16 17:33:31',NULL,NULL),
(182,210,'Sanda','2022-12-16 17:33:31',NULL,NULL),
(183,210,'Batungsel','2022-12-16 17:33:31',NULL,NULL),
(184,210,'Kebon Padangan','2022-12-16 17:33:31',NULL,NULL),
(185,210,'Munduk Temu','2022-12-16 17:33:31',NULL,NULL),
(186,210,'Pujungan','2022-12-16 17:33:31',NULL,NULL),
(187,210,'Pupuan','2022-12-16 17:33:31',NULL,NULL),
(188,210,'Bantiran','2022-12-16 17:33:31',NULL,NULL),
(189,210,'Padangan','2022-12-16 17:33:31',NULL,NULL),
(190,210,'Jelijih Punggung','2022-12-16 17:33:31',NULL,NULL),
(191,210,'Belatungan','2022-12-16 17:33:31',NULL,NULL),
(192,210,'Pajahan','2022-12-16 17:33:31',NULL,NULL),
(193,210,'Karyasari','2022-12-16 17:33:31',NULL,NULL),
(194,210,'Sai','2022-12-16 17:33:31',NULL,NULL),
(195,301,'Tuban','2022-12-16 17:33:31',NULL,NULL),
(196,301,'Kuta','2022-12-16 17:33:31',NULL,NULL),
(197,301,'Kedonganan','2022-12-16 17:33:31',NULL,NULL),
(198,301,'Legian','2022-12-16 17:33:31',NULL,NULL),
(199,301,'Seminyak','2022-12-16 17:33:31',NULL,NULL),
(200,302,'Munggu','2022-12-16 17:33:31',NULL,NULL),
(201,302,'Buduk','2022-12-16 17:33:31',NULL,NULL),
(202,302,'Mengwitani','2022-12-16 17:33:31',NULL,NULL),
(203,302,'Kapal','2022-12-16 17:33:31',NULL,NULL),
(204,302,'Sempidi','2022-12-16 17:33:31',NULL,NULL),
(205,302,'Penarungan','2022-12-16 17:33:31',NULL,NULL),
(206,302,'Sembung','2022-12-16 17:33:31',NULL,NULL),
(207,302,'Baha','2022-12-16 17:33:31',NULL,NULL),
(208,302,'Mengwi','2022-12-16 17:33:31',NULL,NULL),
(209,302,'Kekeran','2022-12-16 17:33:31',NULL,NULL),
(210,302,'Sobangan','2022-12-16 17:33:31',NULL,NULL),
(211,302,'Gulingan','2022-12-16 17:33:31',NULL,NULL),
(212,302,'Werdi Bhuwana','2022-12-16 17:33:31',NULL,NULL),
(213,302,'Abianbase','2022-12-16 17:33:31',NULL,NULL),
(214,302,'Sading','2022-12-16 17:33:31',NULL,NULL),
(215,302,'Lukluk','2022-12-16 17:33:31',NULL,NULL),
(216,302,'Cemagi','2022-12-16 17:33:31',NULL,NULL),
(217,302,'Pererenan','2022-12-16 17:33:31',NULL,NULL),
(218,302,'Tumbakbayuh','2022-12-16 17:33:31',NULL,NULL),
(219,302,'Kuwum','2022-12-16 17:33:31',NULL,NULL),
(220,303,'Darmasaba','2022-12-16 17:33:31',NULL,NULL),
(221,303,'Sibang Kaja','2022-12-16 17:33:31',NULL,NULL),
(222,303,'Sibang Gede','2022-12-16 17:33:31',NULL,NULL),
(223,303,'Jagapati','2022-12-16 17:33:31',NULL,NULL),
(224,303,'Angantaka','2022-12-16 17:33:31',NULL,NULL),
(225,303,'Sedang','2022-12-16 17:33:31',NULL,NULL),
(226,303,'Mambal','2022-12-16 17:33:31',NULL,NULL),
(227,303,'Abiansemal','2022-12-16 17:33:31',NULL,NULL),
(228,303,'Bongkasa','2022-12-16 17:33:31',NULL,NULL),
(229,303,'Taman','2022-12-16 17:33:31',NULL,NULL),
(230,303,'Blahkiuh','2022-12-16 17:33:31',NULL,NULL),
(231,303,'Ayunan','2022-12-16 17:33:31',NULL,NULL),
(232,303,'Sangeh','2022-12-16 17:33:31',NULL,NULL),
(233,303,'Punggul','2022-12-16 17:33:31',NULL,NULL),
(234,303,'Mekar Bhuwana','2022-12-16 17:33:31',NULL,NULL),
(235,303,'Dauh Yeh Cani','2022-12-16 17:33:31',NULL,NULL),
(236,303,'Selat','2022-12-16 17:33:31',NULL,NULL),
(237,303,'Bongkasa Pertiwi','2022-12-16 17:33:31',NULL,NULL),
(238,304,'Carangsari','2022-12-16 17:33:31',NULL,NULL),
(239,304,'Petang','2022-12-16 17:33:31',NULL,NULL),
(240,304,'Belok Sidan','2022-12-16 17:33:31',NULL,NULL),
(241,304,'Pelaga','2022-12-16 17:33:31',NULL,NULL),
(242,304,'Getasan','2022-12-16 17:33:31',NULL,NULL),
(243,304,'Pangsan','2022-12-16 17:33:31',NULL,NULL),
(244,304,'Sulangai','2022-12-16 17:33:31',NULL,NULL),
(245,305,'Pecatu','2022-12-16 17:33:31',NULL,NULL),
(246,305,'Ungasan','2022-12-16 17:33:31',NULL,NULL),
(247,305,'Kutuh','2022-12-16 17:33:31',NULL,NULL),
(248,305,'Benoa','2022-12-16 17:33:31',NULL,NULL),
(249,305,'Tanjung Benoa','2022-12-16 17:33:31',NULL,NULL),
(250,305,'Jimbaran','2022-12-16 17:33:31',NULL,NULL),
(251,306,'Kerobokan Kelod','2022-12-16 17:33:31',NULL,NULL),
(252,306,'Kerobokan','2022-12-16 17:33:31',NULL,NULL),
(253,306,'Kerobokan Kaja','2022-12-16 17:33:31',NULL,NULL),
(254,306,'Tibubeneng','2022-12-16 17:33:31',NULL,NULL),
(255,306,'Canggu','2022-12-16 17:33:31',NULL,NULL),
(256,306,'Dalung','2022-12-16 17:33:31',NULL,NULL),
(257,401,'Batubulan','2022-12-16 17:33:31',NULL,NULL),
(258,401,'Ketewel','2022-12-16 17:33:31',NULL,NULL),
(259,401,'Guwang','2022-12-16 17:33:31',NULL,NULL),
(260,401,'Sukawati','2022-12-16 17:33:31',NULL,NULL),
(261,401,'Celuk','2022-12-16 17:33:31',NULL,NULL),
(262,401,'Singapadu','2022-12-16 17:33:31',NULL,NULL),
(263,401,'Batuan','2022-12-16 17:33:31',NULL,NULL),
(264,401,'Kemenuh','2022-12-16 17:33:31',NULL,NULL),
(265,401,'Batubulan Kangin','2022-12-16 17:33:31',NULL,NULL),
(266,401,'Singapadu Tengah','2022-12-16 17:33:31',NULL,NULL),
(267,401,'Singapadu Kaler','2022-12-16 17:33:31',NULL,NULL),
(268,401,'Batuan Kaler','2022-12-16 17:33:31',NULL,NULL),
(269,402,'Saba','2022-12-16 17:33:31',NULL,NULL),
(270,402,'Pering','2022-12-16 17:33:31',NULL,NULL),
(271,402,'Keramas','2022-12-16 17:33:31',NULL,NULL),
(272,402,'Belega','2022-12-16 17:33:31',NULL,NULL),
(273,402,'Blahbatuh','2022-12-16 17:33:31',NULL,NULL),
(274,402,'Buruan','2022-12-16 17:33:31',NULL,NULL),
(275,402,'Bedulu','2022-12-16 17:33:31',NULL,NULL),
(276,402,'Medahan','2022-12-16 17:33:31',NULL,NULL),
(277,402,'Bona','2022-12-16 17:33:31',NULL,NULL),
(278,403,'Tulikup','2022-12-16 17:33:31',NULL,NULL),
(279,403,'Sidan','2022-12-16 17:33:31',NULL,NULL),
(280,403,'Samplangan','2022-12-16 17:33:31',NULL,NULL),
(281,403,'Lebih','2022-12-16 17:33:31',NULL,NULL),
(282,403,'Abianbase','2022-12-16 17:33:31',NULL,NULL),
(283,403,'Gianyar','2022-12-16 17:33:31',NULL,NULL),
(284,403,'Bitera','2022-12-16 17:33:31',NULL,NULL),
(285,403,'Beng','2022-12-16 17:33:31',NULL,NULL),
(286,403,'Bakbakan','2022-12-16 17:33:31',NULL,NULL),
(287,403,'Siangan','2022-12-16 17:33:31',NULL,NULL),
(288,403,'Suwat','2022-12-16 17:33:31',NULL,NULL),
(289,403,'Petak','2022-12-16 17:33:31',NULL,NULL),
(290,403,'Serongga','2022-12-16 17:33:31',NULL,NULL),
(291,403,'Petak Kaja','2022-12-16 17:33:31',NULL,NULL),
(292,403,'Temesi','2022-12-16 17:33:31',NULL,NULL),
(293,403,'Sumita','2022-12-16 17:33:31',NULL,NULL),
(294,403,'Tegal Tugu','2022-12-16 17:33:31',NULL,NULL),
(295,404,'Pejeng','2022-12-16 17:33:31',NULL,NULL),
(296,404,'Sanding','2022-12-16 17:33:31',NULL,NULL),
(297,404,'Tampaksiring','2022-12-16 17:33:31',NULL,NULL),
(298,404,'Manukaya','2022-12-16 17:33:31',NULL,NULL),
(299,404,'Pejeng Kawan','2022-12-16 17:33:31',NULL,NULL),
(300,404,'Pejeng Kaja','2022-12-16 17:33:31',NULL,NULL),
(301,404,'Pejeng Kangin','2022-12-16 17:33:31',NULL,NULL),
(302,404,'Pejeng Kelod','2022-12-16 17:33:31',NULL,NULL),
(303,405,'Lodtunduh','2022-12-16 17:33:31',NULL,NULL),
(304,405,'Mas','2022-12-16 17:33:31',NULL,NULL),
(305,405,'Singakerta','2022-12-16 17:33:31',NULL,NULL),
(306,405,'Kedewatan','2022-12-16 17:33:31',NULL,NULL),
(307,405,'Ubud','2022-12-16 17:33:31',NULL,NULL),
(308,405,'Peliatan','2022-12-16 17:33:31',NULL,NULL),
(309,405,'Petulu','2022-12-16 17:33:31',NULL,NULL),
(310,405,'Sayan','2022-12-16 17:33:31',NULL,NULL),
(311,406,'Keliki','2022-12-16 17:33:31',NULL,NULL),
(312,406,'Tegallalang','2022-12-16 17:33:31',NULL,NULL),
(313,406,'Kenderan','2022-12-16 17:33:31',NULL,NULL),
(314,406,'Kedisan','2022-12-16 17:33:31',NULL,NULL),
(315,406,'Pupuan','2022-12-16 17:33:31',NULL,NULL),
(316,406,'Sebatu','2022-12-16 17:33:31',NULL,NULL),
(317,406,'Taro','2022-12-16 17:33:31',NULL,NULL),
(318,407,'Melinggih','2022-12-16 17:33:31',NULL,NULL),
(319,407,'Kelusa','2022-12-16 17:33:31',NULL,NULL),
(320,407,'Bukian','2022-12-16 17:33:31',NULL,NULL),
(321,407,'Puhu','2022-12-16 17:33:31',NULL,NULL),
(322,407,'Buahan','2022-12-16 17:33:31',NULL,NULL),
(323,407,'Kerta','2022-12-16 17:33:31',NULL,NULL),
(324,407,'Melinggih Kelod','2022-12-16 17:33:31',NULL,NULL),
(325,407,'Buahan Kaja','2022-12-16 17:33:31',NULL,NULL),
(326,407,'Bresela','2022-12-16 17:33:31',NULL,NULL),
(327,501,'Sakti','2022-12-16 17:33:31',NULL,NULL),
(328,501,'Batumadeg','2022-12-16 17:33:31',NULL,NULL),
(329,501,'Klumpu','2022-12-16 17:33:31',NULL,NULL),
(330,501,'Batukandik','2022-12-16 17:33:31',NULL,NULL),
(331,501,'Sekartaji','2022-12-16 17:33:31',NULL,NULL),
(332,501,'Tanglad','2022-12-16 17:33:31',NULL,NULL),
(333,501,'Suana','2022-12-16 17:33:31',NULL,NULL),
(334,501,'Batununggul','2022-12-16 17:33:31',NULL,NULL),
(335,501,'Kutampi','2022-12-16 17:33:31',NULL,NULL),
(336,501,'Ped','2022-12-16 17:33:31',NULL,NULL),
(337,501,'Kampung Toyapakeh','2022-12-16 17:33:31',NULL,NULL),
(338,501,'Lembongan','2022-12-16 17:33:31',NULL,NULL),
(339,501,'Jungutbatu','2022-12-16 17:33:31',NULL,NULL),
(340,501,'Pejukutan','2022-12-16 17:33:31',NULL,NULL),
(341,501,'Kutampi Kaler','2022-12-16 17:33:31',NULL,NULL),
(342,501,'Bunga Mekar','2022-12-16 17:33:31',NULL,NULL),
(343,502,'Negari','2022-12-16 17:33:31',NULL,NULL),
(344,502,'Takmung','2022-12-16 17:33:31',NULL,NULL),
(345,502,'Banjarangkan','2022-12-16 17:33:31',NULL,NULL),
(346,502,'Tusan','2022-12-16 17:33:31',NULL,NULL),
(347,502,'Bakas','2022-12-16 17:33:31',NULL,NULL),
(348,502,'Getakan','2022-12-16 17:33:31',NULL,NULL),
(349,502,'Tihingan','2022-12-16 17:33:31',NULL,NULL),
(350,502,'Aan','2022-12-16 17:33:31',NULL,NULL),
(351,502,'Nyalian','2022-12-16 17:33:31',NULL,NULL),
(352,502,'Bungbungan','2022-12-16 17:33:31',NULL,NULL),
(353,502,'Timuhun','2022-12-16 17:33:31',NULL,NULL),
(354,502,'Nyanglan','2022-12-16 17:33:31',NULL,NULL),
(355,502,'Tohpati','2022-12-16 17:33:31',NULL,NULL),
(356,503,'Satra','2022-12-16 17:33:31',NULL,NULL),
(357,503,'Tojan','2022-12-16 17:33:31',NULL,NULL),
(358,503,'Gelgel','2022-12-16 17:33:31',NULL,NULL),
(359,503,'Kampung Gelgel','2022-12-16 17:33:31',NULL,NULL),
(360,503,'Jumpai','2022-12-16 17:33:31',NULL,NULL),
(361,503,'Tangkas','2022-12-16 17:33:31',NULL,NULL),
(362,503,'Kamasan','2022-12-16 17:33:31',NULL,NULL),
(363,503,'Semarapura Kaja','2022-12-16 17:33:31',NULL,NULL),
(364,503,'Semarapura Kauh','2022-12-16 17:33:31',NULL,NULL),
(365,503,'Semarapura Tengah','2022-12-16 17:33:31',NULL,NULL),
(366,503,'Semarapura Kangin','2022-12-16 17:33:31',NULL,NULL),
(367,503,'Semarapura Kelod Kangin','2022-12-16 17:33:31',NULL,NULL),
(368,503,'Semarapura  Kelod','2022-12-16 17:33:31',NULL,NULL),
(369,503,'Akah','2022-12-16 17:33:31',NULL,NULL),
(370,503,'Manduang','2022-12-16 17:33:31',NULL,NULL),
(371,503,'Selat','2022-12-16 17:33:31',NULL,NULL),
(372,503,'Tegak','2022-12-16 17:33:31',NULL,NULL),
(373,503,'Selisihan','2022-12-16 17:33:31',NULL,NULL),
(374,504,'Paksebali','2022-12-16 17:33:31',NULL,NULL),
(375,504,'Sampalan Tengah','2022-12-16 17:33:31',NULL,NULL),
(376,504,'Sampalan Kelod','2022-12-16 17:33:31',NULL,NULL),
(377,504,'Sulang','2022-12-16 17:33:31',NULL,NULL),
(378,504,'Gunaksa','2022-12-16 17:33:31',NULL,NULL),
(379,504,'Kusamba','2022-12-16 17:33:31',NULL,NULL),
(380,504,'Kampung Kusamba','2022-12-16 17:33:31',NULL,NULL),
(381,504,'Pesinggahan','2022-12-16 17:33:31',NULL,NULL),
(382,504,'Dawan Kelod','2022-12-16 17:33:31',NULL,NULL),
(383,504,'Pikat','2022-12-16 17:33:31',NULL,NULL),
(384,504,'Dawan Kaler','2022-12-16 17:33:31',NULL,NULL),
(385,504,'Besan','2022-12-16 17:33:31',NULL,NULL),
(386,601,'Apuan','2022-12-16 17:33:31',NULL,NULL),
(387,601,'Demulih','2022-12-16 17:33:31',NULL,NULL),
(388,601,'Abuan','2022-12-16 17:33:31',NULL,NULL),
(389,601,'Susut','2022-12-16 17:33:31',NULL,NULL),
(390,601,'Sulahan','2022-12-16 17:33:31',NULL,NULL),
(391,601,'Penglumbaran','2022-12-16 17:33:31',NULL,NULL),
(392,601,'Tiga','2022-12-16 17:33:31',NULL,NULL),
(393,601,'Selat','2022-12-16 17:33:31',NULL,NULL),
(394,601,'Pengiangan','2022-12-16 17:33:31',NULL,NULL),
(395,602,'Bunutin','2022-12-16 17:33:31',NULL,NULL),
(396,602,'Tamanbali','2022-12-16 17:33:31',NULL,NULL),
(397,602,'Bebalang','2022-12-16 17:33:31',NULL,NULL),
(398,602,'Kawan','2022-12-16 17:33:31',NULL,NULL),
(399,602,'Cempaga','2022-12-16 17:33:31',NULL,NULL),
(400,602,'Kubu','2022-12-16 17:33:31',NULL,NULL),
(401,602,'Kayubihi','2022-12-16 17:33:31',NULL,NULL),
(402,602,'Pengotan','2022-12-16 17:33:31',NULL,NULL),
(403,602,'Landih','2022-12-16 17:33:31',NULL,NULL),
(404,603,'Jehem','2022-12-16 17:33:31',NULL,NULL),
(405,603,'Tembuku','2022-12-16 17:33:31',NULL,NULL),
(406,603,'Yangapi','2022-12-16 17:33:31',NULL,NULL),
(407,603,'Undisan','2022-12-16 17:33:31',NULL,NULL),
(408,603,'Bangbang','2022-12-16 17:33:31',NULL,NULL),
(409,603,'Peninjoan','2022-12-16 17:33:31',NULL,NULL),
(410,604,'Mengani','2022-12-16 17:33:31',NULL,NULL),
(411,604,'Binyan','2022-12-16 17:33:31',NULL,NULL),
(412,604,'Ulian','2022-12-16 17:33:31',NULL,NULL),
(413,604,'Bunutin','2022-12-16 17:33:31',NULL,NULL),
(414,604,'Langgahan','2022-12-16 17:33:31',NULL,NULL),
(415,604,'Lembean','2022-12-16 17:33:31',NULL,NULL),
(416,604,'Manikliyu','2022-12-16 17:33:31',NULL,NULL),
(417,604,'Bayung Cerik','2022-12-16 17:33:31',NULL,NULL),
(418,604,'Mangguh','2022-12-16 17:33:31',NULL,NULL),
(419,604,'Belancan','2022-12-16 17:33:31',NULL,NULL),
(420,604,'Katung','2022-12-16 17:33:31',NULL,NULL),
(421,604,'Banua','2022-12-16 17:33:31',NULL,NULL),
(422,604,'Abuan','2022-12-16 17:33:31',NULL,NULL),
(423,604,'Bonyoh','2022-12-16 17:33:31',NULL,NULL),
(424,604,'Sekaan','2022-12-16 17:33:31',NULL,NULL),
(425,604,'Bayung Gede','2022-12-16 17:33:31',NULL,NULL),
(426,604,'Sekardadi','2022-12-16 17:33:31',NULL,NULL),
(427,604,'Kedisan','2022-12-16 17:33:31',NULL,NULL),
(428,604,'Buahan','2022-12-16 17:33:31',NULL,NULL),
(429,604,'Abangsongan','2022-12-16 17:33:31',NULL,NULL),
(430,604,'Suter','2022-12-16 17:33:31',NULL,NULL),
(431,604,'Batudinding','2022-12-16 17:33:31',NULL,NULL),
(432,604,'Terunyan','2022-12-16 17:33:31',NULL,NULL),
(433,604,'Songan A','2022-12-16 17:33:31',NULL,NULL),
(434,604,'Songan B','2022-12-16 17:33:31',NULL,NULL),
(435,604,'Batur Selatan','2022-12-16 17:33:31',NULL,NULL),
(436,604,'Batur Tengah','2022-12-16 17:33:31',NULL,NULL),
(437,604,'Batur Utara','2022-12-16 17:33:31',NULL,NULL),
(438,604,'Kintamani','2022-12-16 17:33:31',NULL,NULL),
(439,604,'Serai','2022-12-16 17:33:31',NULL,NULL),
(440,604,'Daup','2022-12-16 17:33:31',NULL,NULL),
(441,604,'Awan','2022-12-16 17:33:31',NULL,NULL),
(442,604,'Gunungbau','2022-12-16 17:33:31',NULL,NULL),
(443,604,'Belanga','2022-12-16 17:33:31',NULL,NULL),
(444,604,'Batukaang','2022-12-16 17:33:31',NULL,NULL),
(445,604,'Belantih','2022-12-16 17:33:31',NULL,NULL),
(446,604,'Catur','2022-12-16 17:33:31',NULL,NULL),
(447,604,'Pengejaran','2022-12-16 17:33:31',NULL,NULL),
(448,604,'Selulung','2022-12-16 17:33:31',NULL,NULL),
(449,604,'Satra','2022-12-16 17:33:31',NULL,NULL),
(450,604,'Dausa','2022-12-16 17:33:31',NULL,NULL),
(451,604,'Bantang','2022-12-16 17:33:31',NULL,NULL),
(452,604,'Sukawana','2022-12-16 17:33:31',NULL,NULL),
(453,604,'Kutuh','2022-12-16 17:33:31',NULL,NULL),
(454,604,'Subaya','2022-12-16 17:33:31',NULL,NULL),
(455,604,'Siakin','2022-12-16 17:33:31',NULL,NULL),
(456,604,'Pinggan','2022-12-16 17:33:31',NULL,NULL),
(457,604,'Belandingan','2022-12-16 17:33:31',NULL,NULL),
(458,701,'Nongan','2022-12-16 17:33:31',NULL,NULL),
(459,701,'Rendang','2022-12-16 17:33:31',NULL,NULL),
(460,701,'Menanga','2022-12-16 17:33:31',NULL,NULL),
(461,701,'Besakih','2022-12-16 17:33:31',NULL,NULL),
(462,701,'Pempatan','2022-12-16 17:33:31',NULL,NULL),
(463,701,'Pesaban','2022-12-16 17:33:31',NULL,NULL),
(464,702,'Tangkup','2022-12-16 17:33:31',NULL,NULL),
(465,702,'Talibeng','2022-12-16 17:33:31',NULL,NULL),
(466,702,'Sidemen','2022-12-16 17:33:31',NULL,NULL),
(467,702,'Sangkan Gunung','2022-12-16 17:33:31',NULL,NULL),
(468,702,'Telaga Tawang','2022-12-16 17:33:31',NULL,NULL),
(469,702,'Sinduwati','2022-12-16 17:33:31',NULL,NULL),
(470,702,'Tri Eka Buana','2022-12-16 17:33:31',NULL,NULL),
(471,702,'Kerta Buana','2022-12-16 17:33:31',NULL,NULL),
(472,702,'Lakasari','2022-12-16 17:33:31',NULL,NULL),
(473,702,'Wismakerta','2022-12-16 17:33:31',NULL,NULL),
(474,703,'Gegelang','2022-12-16 17:33:31',NULL,NULL),
(475,703,'Antiga','2022-12-16 17:33:31',NULL,NULL),
(476,703,'Ulakan','2022-12-16 17:33:31',NULL,NULL),
(477,703,'Manggis','2022-12-16 17:33:31',NULL,NULL),
(478,703,'Nyuh Tebel','2022-12-16 17:33:31',NULL,NULL),
(479,703,'Tenganan','2022-12-16 17:33:31',NULL,NULL),
(480,703,'Ngis','2022-12-16 17:33:31',NULL,NULL),
(481,703,'Selumbung','2022-12-16 17:33:31',NULL,NULL),
(482,703,'Padangbai','2022-12-16 17:33:31',NULL,NULL),
(483,703,'Antiga Kelod','2022-12-16 17:33:31',NULL,NULL),
(484,703,'Pasedahan','2022-12-16 17:33:31',NULL,NULL),
(485,703,'Sengkidu','2022-12-16 17:33:31',NULL,NULL),
(486,704,'Bugbug','2022-12-16 17:33:31',NULL,NULL),
(487,704,'Subagan','2022-12-16 17:33:31',NULL,NULL),
(488,704,'Padang Kerta','2022-12-16 17:33:31',NULL,NULL),
(489,704,'Karangasem','2022-12-16 17:33:31',NULL,NULL),
(490,704,'Tumbu','2022-12-16 17:33:31',NULL,NULL),
(491,704,'Seraya','2022-12-16 17:33:31',NULL,NULL),
(492,704,'Seraya Barat','2022-12-16 17:33:31',NULL,NULL),
(493,704,'Seraya Timur','2022-12-16 17:33:31',NULL,NULL),
(494,704,'Pertima','2022-12-16 17:33:31',NULL,NULL),
(495,704,'Tegalinggah','2022-12-16 17:33:31',NULL,NULL),
(496,704,'Bukit','2022-12-16 17:33:31',NULL,NULL),
(497,705,'Ababi','2022-12-16 17:33:31',NULL,NULL),
(498,705,'Tiying Tali','2022-12-16 17:33:31',NULL,NULL),
(499,705,'Bunutan','2022-12-16 17:33:31',NULL,NULL),
(500,705,'Tista','2022-12-16 17:33:31',NULL,NULL),
(501,705,'Abang','2022-12-16 17:33:31',NULL,NULL),
(502,705,'Pidpid','2022-12-16 17:33:31',NULL,NULL),
(503,705,'Datah','2022-12-16 17:33:31',NULL,NULL),
(504,705,'Culik','2022-12-16 17:33:31',NULL,NULL),
(505,705,'Purwakerti','2022-12-16 17:33:31',NULL,NULL),
(506,705,'Kerta Mandala','2022-12-16 17:33:31',NULL,NULL),
(507,705,'Labasari','2022-12-16 17:33:31',NULL,NULL),
(508,705,'Nawa Kerti','2022-12-16 17:33:31',NULL,NULL),
(509,705,'Kesimpar','2022-12-16 17:33:31',NULL,NULL),
(510,705,'Tribuana','2022-12-16 17:33:31',NULL,NULL),
(511,706,'Bungaya','2022-12-16 17:33:31',NULL,NULL),
(512,706,'Budekeling','2022-12-16 17:33:31',NULL,NULL),
(513,706,'Bebandem','2022-12-16 17:33:31',NULL,NULL),
(514,706,'Sibetan','2022-12-16 17:33:31',NULL,NULL),
(515,706,'Jungutan','2022-12-16 17:33:31',NULL,NULL),
(516,706,'Bungaya Kangin','2022-12-16 17:33:31',NULL,NULL),
(517,706,'Buana Giri','2022-12-16 17:33:31',NULL,NULL),
(518,706,'Macang','2022-12-16 17:33:31',NULL,NULL),
(519,707,'Muncan','2022-12-16 17:33:31',NULL,NULL),
(520,707,'Selat','2022-12-16 17:33:31',NULL,NULL),
(521,707,'Duda','2022-12-16 17:33:31',NULL,NULL),
(522,707,'Sebudi','2022-12-16 17:33:31',NULL,NULL),
(523,707,'Duda Utara','2022-12-16 17:33:31',NULL,NULL),
(524,707,'Duda Timur','2022-12-16 17:33:31',NULL,NULL),
(525,707,'Pering Sari','2022-12-16 17:33:31',NULL,NULL),
(526,707,'Amerta Bhuana','2022-12-16 17:33:31',NULL,NULL),
(527,708,'Ban','2022-12-16 17:33:31',NULL,NULL),
(528,708,'Dukuh','2022-12-16 17:33:31',NULL,NULL),
(529,708,'Kubu','2022-12-16 17:33:31',NULL,NULL),
(530,708,'Tianyar','2022-12-16 17:33:31',NULL,NULL),
(531,708,'Tianyar Barat','2022-12-16 17:33:31',NULL,NULL),
(532,708,'Tianyar Tengah','2022-12-16 17:33:31',NULL,NULL),
(533,708,'Tulamben','2022-12-16 17:33:31',NULL,NULL),
(534,708,'Baturinggit','2022-12-16 17:33:31',NULL,NULL),
(535,708,'Sukadana','2022-12-16 17:33:31',NULL,NULL),
(536,801,'Sumberklampok','2022-12-16 17:33:31',NULL,NULL),
(537,801,'Pejarakan','2022-12-16 17:33:31',NULL,NULL),
(538,801,'Sumberkima','2022-12-16 17:33:31',NULL,NULL),
(539,801,'Pemuteran','2022-12-16 17:33:31',NULL,NULL),
(540,801,'Banyupoh','2022-12-16 17:33:31',NULL,NULL),
(541,801,'Penyabangan','2022-12-16 17:33:31',NULL,NULL),
(542,801,'Musi','2022-12-16 17:33:31',NULL,NULL),
(543,801,'Sanggalangit','2022-12-16 17:33:31',NULL,NULL),
(544,801,'Gerokgak','2022-12-16 17:33:31',NULL,NULL),
(545,801,'Patas','2022-12-16 17:33:31',NULL,NULL),
(546,801,'Pengulon','2022-12-16 17:33:31',NULL,NULL),
(547,801,'Tinga-tinga','2022-12-16 17:33:31',NULL,NULL),
(548,801,'Celukanbawang','2022-12-16 17:33:31',NULL,NULL),
(549,801,'Tukadsumaga','2022-12-16 17:33:31',NULL,NULL),
(550,802,'Unggahan','2022-12-16 17:33:31',NULL,NULL),
(551,802,'Ularan','2022-12-16 17:33:31',NULL,NULL),
(552,802,'Ringdikit','2022-12-16 17:33:31',NULL,NULL),
(553,802,'Rangdu','2022-12-16 17:33:31',NULL,NULL),
(554,802,'Mayong','2022-12-16 17:33:31',NULL,NULL),
(555,802,'Gunungsari','2022-12-16 17:33:31',NULL,NULL),
(556,802,'Munduk Bestala','2022-12-16 17:33:31',NULL,NULL),
(557,802,'Bestala','2022-12-16 17:33:31',NULL,NULL),
(558,802,'Kalianget','2022-12-16 17:33:31',NULL,NULL),
(559,802,'Joanyar','2022-12-16 17:33:31',NULL,NULL),
(560,802,'Tangguwisia','2022-12-16 17:33:31',NULL,NULL),
(561,802,'Sulanyah','2022-12-16 17:33:31',NULL,NULL),
(562,802,'Bubunan','2022-12-16 17:33:31',NULL,NULL),
(563,802,'Petemon','2022-12-16 17:33:31',NULL,NULL),
(564,802,'Seririt','2022-12-16 17:33:31',NULL,NULL),
(565,802,'Pengastulan','2022-12-16 17:33:31',NULL,NULL),
(566,802,'Lokapaksa','2022-12-16 17:33:31',NULL,NULL),
(567,802,'Pangkungparuk','2022-12-16 17:33:31',NULL,NULL),
(568,802,'Banjarasem','2022-12-16 17:33:31',NULL,NULL),
(569,802,'Kalisada','2022-12-16 17:33:31',NULL,NULL),
(570,802,'Umeanyar','2022-12-16 17:33:31',NULL,NULL),
(571,803,'Sepang','2022-12-16 17:33:31',NULL,NULL),
(572,803,'Tista','2022-12-16 17:33:31',NULL,NULL),
(573,803,'Bongancina','2022-12-16 17:33:31',NULL,NULL),
(574,803,'Pucaksari','2022-12-16 17:33:31',NULL,NULL),
(575,803,'Telaga','2022-12-16 17:33:31',NULL,NULL),
(576,803,'Titab','2022-12-16 17:33:31',NULL,NULL),
(577,803,'Subuk','2022-12-16 17:33:31',NULL,NULL),
(578,803,'Tinggarsari','2022-12-16 17:33:31',NULL,NULL),
(579,803,'Kedis','2022-12-16 17:33:31',NULL,NULL),
(580,803,'Kekeran','2022-12-16 17:33:31',NULL,NULL),
(581,803,'Busungbiu','2022-12-16 17:33:31',NULL,NULL),
(582,803,'Pelapuan','2022-12-16 17:33:31',NULL,NULL),
(583,803,'Bengkel','2022-12-16 17:33:31',NULL,NULL),
(584,803,'Umejero','2022-12-16 17:33:31',NULL,NULL),
(585,803,'Sepang Kelod','2022-12-16 17:33:31',NULL,NULL),
(586,804,'Banyuseri','2022-12-16 17:33:31',NULL,NULL),
(587,804,'Tirtasari','2022-12-16 17:33:31',NULL,NULL),
(588,804,'Kayuputih','2022-12-16 17:33:31',NULL,NULL),
(589,804,'Banyuatis','2022-12-16 17:33:31',NULL,NULL),
(590,804,'Gesing','2022-12-16 17:33:31',NULL,NULL),
(591,804,'Munduk','2022-12-16 17:33:31',NULL,NULL),
(592,804,'Gobleg','2022-12-16 17:33:31',NULL,NULL),
(593,804,'Pedawa','2022-12-16 17:33:31',NULL,NULL),
(594,804,'Cempaga','2022-12-16 17:33:31',NULL,NULL),
(595,804,'Sidetapa','2022-12-16 17:33:31',NULL,NULL),
(596,804,'Tampekan','2022-12-16 17:33:31',NULL,NULL),
(597,804,'Banjar Tegeha','2022-12-16 17:33:31',NULL,NULL),
(598,804,'Banjar','2022-12-16 17:33:31',NULL,NULL),
(599,804,'Dencarik','2022-12-16 17:33:31',NULL,NULL),
(600,804,'Temukus','2022-12-16 17:33:31',NULL,NULL),
(601,804,'Tigawasa','2022-12-16 17:33:31',NULL,NULL),
(602,804,'Kaliasem','2022-12-16 17:33:31',NULL,NULL),
(603,805,'Pancasari','2022-12-16 17:33:31',NULL,NULL),
(604,805,'Wanagiri','2022-12-16 17:33:31',NULL,NULL),
(605,805,'Ambengan','2022-12-16 17:33:31',NULL,NULL),
(606,805,'Gitgit','2022-12-16 17:33:31',NULL,NULL),
(607,805,'Pegayaman','2022-12-16 17:33:31',NULL,NULL),
(608,805,'Silangjana','2022-12-16 17:33:31',NULL,NULL),
(609,805,'Pegadungan','2022-12-16 17:33:31',NULL,NULL),
(610,805,'Padangbulia','2022-12-16 17:33:31',NULL,NULL),
(611,805,'Sukasada','2022-12-16 17:33:31',NULL,NULL),
(612,805,'Sambangan','2022-12-16 17:33:31',NULL,NULL),
(613,805,'Panji','2022-12-16 17:33:31',NULL,NULL),
(614,805,'Panji Anom','2022-12-16 17:33:31',NULL,NULL),
(615,805,'Tegallinggah','2022-12-16 17:33:31',NULL,NULL),
(616,805,'Selat','2022-12-16 17:33:31',NULL,NULL),
(617,805,'Kayu Putih','2022-12-16 17:33:31',NULL,NULL),
(618,806,'Kalibukbuk','2022-12-16 17:33:31',NULL,NULL),
(619,806,'Anturan','2022-12-16 17:33:31',NULL,NULL),
(620,806,'Tukadmungga','2022-12-16 17:33:31',NULL,NULL),
(621,806,'Pemaron','2022-12-16 17:33:31',NULL,NULL),
(622,806,'Baktiseraga','2022-12-16 17:33:31',NULL,NULL),
(623,806,'Banyuasari','2022-12-16 17:33:31',NULL,NULL),
(624,806,'Banjar Tegal','2022-12-16 17:33:31',NULL,NULL),
(625,806,'Kendran','2022-12-16 17:33:31',NULL,NULL),
(626,806,'Paket Agung','2022-12-16 17:33:31',NULL,NULL),
(627,806,'Kampung Singaraja','2022-12-16 17:33:31',NULL,NULL),
(628,806,'Liligundi','2022-12-16 17:33:31',NULL,NULL),
(629,806,'Beratan','2022-12-16 17:33:31',NULL,NULL),
(630,806,'Sarimekar','2022-12-16 17:33:31',NULL,NULL),
(631,806,'Naga Sepaha','2022-12-16 17:33:31',NULL,NULL),
(632,806,'Petandakan','2022-12-16 17:33:31',NULL,NULL),
(633,806,'Alasangker','2022-12-16 17:33:31',NULL,NULL),
(634,806,'Poh Bergong','2022-12-16 17:33:31',NULL,NULL),
(635,806,'Jinengdalem','2022-12-16 17:33:31',NULL,NULL),
(636,806,'Banyuning','2022-12-16 17:33:31',NULL,NULL),
(637,806,'Penarukan','2022-12-16 17:33:31',NULL,NULL),
(638,806,'Kampung Kajanan','2022-12-16 17:33:31',NULL,NULL),
(639,806,'Astina','2022-12-16 17:33:31',NULL,NULL),
(640,806,'Banjar Jawa','2022-12-16 17:33:31',NULL,NULL),
(641,806,'Kaliuntu','2022-12-16 17:33:31',NULL,NULL),
(642,806,'Kampung Anyar','2022-12-16 17:33:31',NULL,NULL),
(643,806,'Kampung Bugis','2022-12-16 17:33:31',NULL,NULL),
(644,806,'Banjar Bali','2022-12-16 17:33:31',NULL,NULL),
(645,806,'Penglatan','2022-12-16 17:33:31',NULL,NULL),
(646,806,'Kampung Baru','2022-12-16 17:33:31',NULL,NULL),
(647,807,'Lemukih','2022-12-16 17:33:31',NULL,NULL),
(648,807,'Galungan','2022-12-16 17:33:31',NULL,NULL),
(649,807,'Sekumpul','2022-12-16 17:33:31',NULL,NULL),
(650,807,'Bebetin','2022-12-16 17:33:31',NULL,NULL),
(651,807,'Sudaji','2022-12-16 17:33:31',NULL,NULL),
(652,807,'Sawan','2022-12-16 17:33:31',NULL,NULL),
(653,807,'Menyali','2022-12-16 17:33:31',NULL,NULL),
(654,807,'Suwug','2022-12-16 17:33:31',NULL,NULL),
(655,807,'Jagaraga','2022-12-16 17:33:31',NULL,NULL),
(656,807,'Sinabun','2022-12-16 17:33:31',NULL,NULL),
(657,807,'Kerobokan','2022-12-16 17:33:31',NULL,NULL),
(658,807,'Sangsit','2022-12-16 17:33:31',NULL,NULL),
(659,807,'Bungkulan','2022-12-16 17:33:31',NULL,NULL),
(660,807,'Giri Emas','2022-12-16 17:33:31',NULL,NULL),
(661,808,'Tambakan','2022-12-16 17:33:31',NULL,NULL),
(662,808,'Pakisan','2022-12-16 17:33:31',NULL,NULL),
(663,808,'Bontihing','2022-12-16 17:33:31',NULL,NULL),
(664,808,'Tajun','2022-12-16 17:33:31',NULL,NULL),
(665,808,'Tunjung','2022-12-16 17:33:31',NULL,NULL),
(666,808,'Depeha','2022-12-16 17:33:31',NULL,NULL),
(667,808,'Tamblang','2022-12-16 17:33:31',NULL,NULL),
(668,808,'Bulian','2022-12-16 17:33:31',NULL,NULL),
(669,808,'Bila','2022-12-16 17:33:31',NULL,NULL),
(670,808,'Bengkala','2022-12-16 17:33:31',NULL,NULL),
(671,808,'Kubutambahan','2022-12-16 17:33:31',NULL,NULL),
(672,808,'Bukti','2022-12-16 17:33:31',NULL,NULL),
(673,808,'Mengening','2022-12-16 17:33:31',NULL,NULL),
(674,809,'Sembiran','2022-12-16 17:33:31',NULL,NULL),
(675,809,'Pacung','2022-12-16 17:33:31',NULL,NULL),
(676,809,'Julah','2022-12-16 17:33:31',NULL,NULL),
(677,809,'Madenan','2022-12-16 17:33:31',NULL,NULL),
(678,809,'Bondalem','2022-12-16 17:33:31',NULL,NULL),
(679,809,'Tejakula','2022-12-16 17:33:31',NULL,NULL),
(680,809,'Les','2022-12-16 17:33:31',NULL,NULL),
(681,809,'Penuktukan','2022-12-16 17:33:31',NULL,NULL),
(682,809,'Sambirenteng','2022-12-16 17:33:31',NULL,NULL),
(683,809,'Tembok','2022-12-16 17:33:31',NULL,NULL),
(684,901,'Serangan','2022-12-16 17:33:31',NULL,NULL),
(685,901,'Pedungan','2022-12-16 17:33:31',NULL,NULL),
(686,901,'Sesetan','2022-12-16 17:33:31',NULL,NULL),
(687,901,'Panjer','2022-12-16 17:33:31',NULL,NULL),
(688,901,'Renon','2022-12-16 17:33:31',NULL,NULL),
(689,901,'Sanur','2022-12-16 17:33:31',NULL,NULL),
(690,901,'Sidakarya','2022-12-16 17:33:31',NULL,NULL),
(691,901,'Pemogan','2022-12-16 17:33:31',NULL,NULL),
(692,901,'Sanur Kaja','2022-12-16 17:33:31',NULL,NULL),
(693,901,'Sanur Kauh','2022-12-16 17:33:31',NULL,NULL),
(694,902,'Dangin Puri Kelod','2022-12-16 17:33:31',NULL,NULL),
(695,902,'Sumerta Kelod','2022-12-16 17:33:31',NULL,NULL),
(696,902,'Kesiman','2022-12-16 17:33:31',NULL,NULL),
(697,902,'Kesiman Petilan\n','2022-12-16 17:33:31',NULL,NULL),
(698,902,'Kesiman Kertalangu','2022-12-16 17:33:31',NULL,NULL),
(699,902,'Sumerta','2022-12-16 17:33:31',NULL,NULL),
(700,902,'Sumerta Kaja','2022-12-16 17:33:31',NULL,NULL),
(701,902,'Sumerta Kauh','2022-12-16 17:33:31',NULL,NULL),
(702,902,'Dangin Puri Kangin','2022-12-16 17:33:31',NULL,NULL),
(703,902,'Dangin Puri','2022-12-16 17:33:31',NULL,NULL),
(704,902,'Dangin Puri Kauh','2022-12-16 17:33:31',NULL,NULL),
(705,902,'Dangin Puri Kaja','2022-12-16 17:33:31',NULL,NULL),
(706,902,'Tonja','2022-12-16 17:33:31',NULL,NULL),
(707,902,'Penatih','2022-12-16 17:33:31',NULL,NULL),
(708,903,'Padangsambian Kelod','2022-12-16 17:33:31',NULL,NULL),
(709,903,'Pemecutan Kelod','2022-12-16 17:33:31',NULL,NULL),
(710,903,'Dauh Puri Kauh','2022-12-16 17:33:31',NULL,NULL),
(711,903,'Dauh Puri Kelod','2022-12-16 17:33:31',NULL,NULL),
(712,903,'Dauh Puri','2022-12-16 17:33:31',NULL,NULL),
(713,903,'Dauh Puri Kangin','2022-12-16 17:33:31',NULL,NULL),
(714,903,'Pemecutan','2022-12-16 17:33:31',NULL,NULL),
(715,903,'Tegal Harum','2022-12-16 17:33:31',NULL,NULL),
(716,903,'Tegal Kertha','2022-12-16 17:33:31',NULL,NULL),
(717,903,'Padangsambian','2022-12-16 17:33:31',NULL,NULL),
(718,903,'Padangsambian Kaja','2022-12-16 17:33:31',NULL,NULL),
(719,903,'Pemecutan Kaja','2022-12-16 17:33:31',NULL,NULL),
(720,903,'Dauh Puri Kaja','2022-12-16 17:33:31',NULL,NULL),
(721,903,'Ubung','2022-12-16 17:33:31',NULL,NULL),
(722,903,'Ubung Kaja','2022-12-16 17:33:31',NULL,NULL),
(723,903,'Peguyangan','2022-12-16 17:33:31',NULL,NULL),
(724,903,'Peguyangan Kaja\n','2022-12-16 17:33:31',NULL,NULL),
(725,903,'Peguyangan Kangin','2022-12-16 17:33:31',NULL,NULL),
(726,904,'Dangin Puri Kangin','2022-12-16 17:33:31',NULL,NULL),
(727,904,'Dangin Puri Kauh','2022-12-16 17:33:31',NULL,NULL),
(728,904,'Dangin Puri Kaja','2022-12-16 17:33:31',NULL,NULL),
(729,904,'Tonja','2022-12-16 17:33:31',NULL,NULL),
(730,904,'Pemecutan Kaja','2022-12-16 17:33:31',NULL,NULL),
(731,904,'Dauh Puri Kaja','2022-12-16 17:33:31',NULL,NULL),
(732,904,'Ubung','2022-12-16 17:33:31',NULL,NULL),
(733,904,'Ubung Kaja','2022-12-16 17:33:31',NULL,NULL),
(734,904,'Peguyangan','2022-12-16 17:33:31',NULL,NULL),
(735,904,'Peguyangan Kaja','2022-12-16 17:33:31',NULL,NULL),
(736,904,'Peguyangan Kangin','2022-12-16 17:33:31',NULL,NULL),
(737,904,'Penatih Dangin Puri','2022-12-16 17:33:31',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_kabupaten` */

insert  into `tb_m_kabupaten`(`id`,`id_provinsi`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,51,'Jembrana','2022-12-16 17:33:31',NULL,NULL),
(2,51,'Tabanan','2022-12-16 17:33:31',NULL,NULL),
(3,51,'Badung','2022-12-16 17:33:31',NULL,NULL),
(4,51,'Gianyar','2022-12-16 17:33:31',NULL,NULL),
(5,51,'Klungkung','2022-12-16 17:33:31',NULL,NULL),
(6,51,'Bangli','2022-12-16 17:33:31',NULL,NULL),
(7,51,'Karangasem','2022-12-16 17:33:31',NULL,NULL),
(8,51,'Buleleng','2022-12-16 17:33:31',NULL,NULL),
(9,51,'Denpasar','2022-12-16 17:33:31',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=905 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_kecamatan` */

insert  into `tb_m_kecamatan`(`id`,`id_kabupaten`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(101,1,'NEGARA','2022-12-16 17:33:31',NULL,NULL),
(102,1,'MENDOYO','2022-12-16 17:33:31',NULL,NULL),
(103,1,'PEKUTATAN','2022-12-16 17:33:31',NULL,NULL),
(104,1,'MELAYA','2022-12-16 17:33:31',NULL,NULL),
(105,1,'JEMBRANA','2022-12-16 17:33:31',NULL,NULL),
(201,2,'SELEMADEG','2022-12-16 17:33:31',NULL,NULL),
(202,2,'SELEMADEG TIMUR','2022-12-16 17:33:31',NULL,NULL),
(203,2,'SELEMADEG BARAT','2022-12-16 17:33:31',NULL,NULL),
(204,2,'KERAMBITAN','2022-12-16 17:33:31',NULL,NULL),
(205,2,'TABANAN','2022-12-16 17:33:31',NULL,NULL),
(206,2,'KEDIRI','2022-12-16 17:33:31',NULL,NULL),
(207,2,'MARGA','2022-12-16 17:33:31',NULL,NULL),
(208,2,'PENEBEL','2022-12-16 17:33:31',NULL,NULL),
(209,2,'BATURITI','2022-12-16 17:33:31',NULL,NULL),
(210,2,'PUPUAN','2022-12-16 17:33:31',NULL,NULL),
(301,3,'KUTA','2022-12-16 17:33:31',NULL,NULL),
(302,3,'MENGWI','2022-12-16 17:33:31',NULL,NULL),
(303,3,'ABIANSEMAL','2022-12-16 17:33:31',NULL,NULL),
(304,3,'PETANG','2022-12-16 17:33:31',NULL,NULL),
(305,3,'KUTA SELATAN','2022-12-16 17:33:31',NULL,NULL),
(306,3,'KUTA UTARA','2022-12-16 17:33:31',NULL,NULL),
(401,4,'SUKAWATI','2022-12-16 17:33:31',NULL,NULL),
(402,4,'BLAHBATUH','2022-12-16 17:33:31',NULL,NULL),
(403,4,'GIANYAR','2022-12-16 17:33:31',NULL,NULL),
(404,4,'TAMPAKSIRING','2022-12-16 17:33:31',NULL,NULL),
(405,4,'UBUD','2022-12-16 17:33:31',NULL,NULL),
(406,4,'TEGALLALANG','2022-12-16 17:33:31',NULL,NULL),
(407,4,'PAYANGAN','2022-12-16 17:33:31',NULL,NULL),
(501,5,'NUSA PENIDA','2022-12-16 17:33:31',NULL,NULL),
(502,5,'BANJARANGKAN','2022-12-16 17:33:31',NULL,NULL),
(503,5,'KLUNGKUNG','2022-12-16 17:33:31',NULL,NULL),
(504,5,'DAWAN','2022-12-16 17:33:31',NULL,NULL),
(601,6,'SUSUT','2022-12-16 17:33:31',NULL,NULL),
(602,6,'BANGLI','2022-12-16 17:33:31',NULL,NULL),
(603,6,'TEMBUKU','2022-12-16 17:33:31',NULL,NULL),
(604,6,'KINTAMANI','2022-12-16 17:33:31',NULL,NULL),
(701,7,'RENDANG','2022-12-16 17:33:31',NULL,NULL),
(702,7,'SIDEMEN','2022-12-16 17:33:31',NULL,NULL),
(703,7,'MANGGIS','2022-12-16 17:33:31',NULL,NULL),
(704,7,'KARANGASEM','2022-12-16 17:33:31',NULL,NULL),
(705,7,'ABANG','2022-12-16 17:33:31',NULL,NULL),
(706,7,'BEBANDEM','2022-12-16 17:33:31',NULL,NULL),
(707,7,'SELAT','2022-12-16 17:33:31',NULL,NULL),
(708,7,'KUBU','2022-12-16 17:33:31',NULL,NULL),
(801,8,'GEROKGAK','2022-12-16 17:33:31',NULL,NULL),
(802,8,'SERIRIT','2022-12-16 17:33:31',NULL,NULL),
(803,8,'BUSUNGBIU','2022-12-16 17:33:31',NULL,NULL),
(804,8,'BANJAR','2022-12-16 17:33:31',NULL,NULL),
(805,8,'SUKASADA','2022-12-16 17:33:31',NULL,NULL),
(806,8,'BULELENG','2022-12-16 17:33:31',NULL,NULL),
(807,8,'SAWAN','2022-12-16 17:33:31',NULL,NULL),
(808,8,'KUBUTAMBAHAN','2022-12-16 17:33:31',NULL,NULL),
(809,9,'TEJAKULA','2022-12-16 17:33:31',NULL,NULL),
(901,9,'DENPASAR SELATAN','2022-12-16 17:33:31',NULL,NULL),
(902,9,'DENPASAR TIMUR','2022-12-16 17:33:31',NULL,NULL),
(903,9,'DENPASAR BARAT','2022-12-16 17:33:31',NULL,NULL),
(904,9,'DENPASAR UTARA','2022-12-16 17:33:31',NULL,NULL);

/*Table structure for table `tb_m_provider` */

DROP TABLE IF EXISTS `tb_m_provider`;

CREATE TABLE `tb_m_provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_provider` */

insert  into `tb_m_provider`(`id`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(12,'Telkomsel','2023-01-08 16:51:19','2023-01-08 08:51:19',NULL),
(13,'Indosat Ooredoo','2023-01-08 16:51:32','2023-01-08 08:51:32',NULL),
(14,'Tri Indonesia','2023-01-08 16:51:41','2023-01-08 08:51:41',NULL),
(15,'XL Axiata','2023-01-08 16:51:54','2023-01-08 08:51:54',NULL),
(16,'Smartfren','2023-01-08 16:52:04','2023-01-08 08:52:04',NULL);

/*Table structure for table `tb_m_provinsi` */

DROP TABLE IF EXISTS `tb_m_provinsi`;

CREATE TABLE `tb_m_provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_provinsi` */

insert  into `tb_m_provinsi`(`id`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(11,'Aceh','2022-12-16 17:33:32',NULL,NULL),
(12,'Sumatera Utara','2022-12-16 17:33:32',NULL,NULL),
(13,'Sumatera Barat','2022-12-16 17:33:32',NULL,NULL),
(15,'Jambi','2022-12-16 17:33:32',NULL,NULL),
(16,'Sumatera Selatan','2022-12-16 17:33:32',NULL,NULL),
(17,'Bengkulu','2022-12-16 17:33:32',NULL,NULL),
(18,'Lampung','2022-12-16 17:33:32',NULL,NULL),
(19,'Bangka Belitung','2022-12-16 17:33:32',NULL,NULL),
(21,'Kepulauan Riau','2022-12-16 17:33:32',NULL,NULL),
(31,'DKI Jakarta','2022-12-16 17:33:32',NULL,NULL),
(32,'Jawa Barat','2022-12-16 17:33:32',NULL,NULL),
(33,'Jawa Tengah','2022-12-16 17:33:32',NULL,NULL),
(34,'Daerah Istimewa Yogyakarta','2022-12-16 17:33:32',NULL,NULL),
(35,'Jawa Timur','2022-12-16 17:33:32',NULL,NULL),
(36,'Banten','2022-12-16 17:33:32',NULL,NULL),
(51,'Bali','2022-12-16 17:33:32',NULL,NULL),
(52,'Nusa Tenggara Barat','2022-12-16 17:33:32',NULL,NULL),
(53,'Nusa Tenggara Timur','2022-12-16 17:33:32',NULL,NULL),
(61,'Kalimantan Barat','2022-12-16 17:33:32',NULL,NULL),
(62,'Kalimantan Tengah','2022-12-16 17:33:32',NULL,NULL),
(63,'Kalimantan Selatan','2022-12-16 17:33:32',NULL,NULL),
(64,'Kalimantan Timur','2022-12-16 17:33:32',NULL,NULL),
(65,'Kalimantan Utara','2022-12-16 17:33:32',NULL,NULL),
(71,'Sulawesi Utara','2022-12-16 17:33:32',NULL,NULL),
(72,'Sulawesi Tengah','2022-12-16 17:33:32',NULL,NULL),
(73,'Sulawesi Selatan','2022-12-16 17:33:32',NULL,NULL),
(74,'Sulawesi Tenggara','2022-12-16 17:33:32',NULL,NULL),
(75,'Gorontalo','2022-12-16 17:33:32',NULL,NULL),
(76,'Sulawesi Barat','2022-12-16 17:33:32',NULL,NULL),
(81,'Maluku','2022-12-16 17:33:32',NULL,NULL),
(82,'Maluku Utara','2022-12-16 17:33:32',NULL,NULL),
(91,'Papua','2022-12-16 17:33:32',NULL,NULL),
(92,'Papua Barat','2022-12-16 17:33:32',NULL,NULL);

/*Table structure for table `tb_m_status` */

DROP TABLE IF EXISTS `tb_m_status`;

CREATE TABLE `tb_m_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_status` */

insert  into `tb_m_status`(`id`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(2,'Pemeriksaan Oleh Tim Administrasi','2022-12-19 01:26:53',NULL,NULL),
(3,'Disetujui Tim Administratif','2022-12-19 01:27:51',NULL,NULL),
(4,'Disetujui Tim Lapangan','2022-12-19 01:28:05',NULL,NULL),
(5,'Pengajuan Disetujui','2022-12-19 01:28:14',NULL,NULL),
(6,'Selesai','2022-12-19 01:28:17',NULL,NULL),
(7,'Perbaikan Administrasi','2022-12-19 01:28:23',NULL,NULL),
(8,'Ditolak','2022-12-19 01:28:26',NULL,NULL),
(9,'Pemeriksaan Oleh Tim Lapangan','2022-12-19 15:21:47',NULL,NULL);

/*Table structure for table `tb_m_zoneplan` */

DROP TABLE IF EXISTS `tb_m_zoneplan`;

CREATE TABLE `tb_m_zoneplan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `radius` int(11) DEFAULT NULL,
  `batas_menara` int(11) DEFAULT NULL,
  `jumlah_menara` int(11) DEFAULT NULL,
  `status` enum('available','used','terlarang') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_provinsi` (`id_provinsi`),
  KEY `id_kabupaten` (`id_kabupaten`),
  KEY `id_kecamatan` (`id_kecamatan`),
  KEY `id_desa` (`id_desa`),
  CONSTRAINT `tb_m_zoneplan_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `tb_m_provinsi` (`id`),
  CONSTRAINT `tb_m_zoneplan_ibfk_2` FOREIGN KEY (`id_kabupaten`) REFERENCES `tb_m_kabupaten` (`id`),
  CONSTRAINT `tb_m_zoneplan_ibfk_3` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_m_kecamatan` (`id`),
  CONSTRAINT `tb_m_zoneplan_ibfk_4` FOREIGN KEY (`id_desa`) REFERENCES `tb_m_desa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_m_zoneplan` */

insert  into `tb_m_zoneplan`(`id`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_desa`,`nama`,`lat`,`long`,`radius`,`batas_menara`,`jumlah_menara`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,51,7,704,492,'Seraya Timur','-8.396299741738005','115.6995957076312',642,1,0,'available','2023-02-04 03:39:27','2023-01-08 08:57:07',NULL),
(4,51,7,705,497,'Ababi','-8.400375435618203','115.58737271010638',290,2,2,'used','2023-02-04 03:45:34','2023-02-03 19:45:34',NULL),
(6,51,7,708,533,'Tulamben','-8.283776784611558','115.59719977460378',640,1,0,'available','2023-02-02 17:59:11','2023-02-02 09:59:11',NULL),
(7,51,7,704,492,'Seraya Barat 1','-8.439862138683022','115.63816825638409',340,1,1,'used','2023-02-01 16:46:49','2023-02-01 08:46:49',NULL);

/*Table structure for table `tb_menara` */

DROP TABLE IF EXISTS `tb_menara`;

CREATE TABLE `tb_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_pemilik_menara` int(11) DEFAULT NULL,
  `id_zonePlan` int(11) DEFAULT NULL,
  `no_menara` varchar(10) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal_pembuatan` date DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `jenis_menara` enum('Menara 4 Kaki','Menara 3 Kaki','Menara 1 Kaki') DEFAULT NULL,
  `tinggi_menara` varchar(255) DEFAULT NULL,
  `tinggi_antena` varchar(255) DEFAULT NULL,
  `luas_area` varchar(255) DEFAULT NULL,
  `akses_jalan` varchar(255) DEFAULT NULL,
  `file_suratIzinPembangunan` varchar(255) DEFAULT NULL,
  `file_suratIzinOperasional` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_provinsi` (`id_provinsi`),
  KEY `id_kabupaten` (`id_kabupaten`),
  KEY `id_kecamatan` (`id_kecamatan`),
  KEY `id_desa` (`id_desa`),
  KEY `id_pemilik_menara` (`id_pemilik_menara`),
  CONSTRAINT `tb_menara_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `tb_m_provinsi` (`id`),
  CONSTRAINT `tb_menara_ibfk_2` FOREIGN KEY (`id_kabupaten`) REFERENCES `tb_m_kabupaten` (`id`),
  CONSTRAINT `tb_menara_ibfk_3` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_m_kecamatan` (`id`),
  CONSTRAINT `tb_menara_ibfk_4` FOREIGN KEY (`id_desa`) REFERENCES `tb_m_desa` (`id`),
  CONSTRAINT `tb_menara_ibfk_5` FOREIGN KEY (`id_pemilik_menara`) REFERENCES `tb_pemilik_menara` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_menara` */

insert  into `tb_menara`(`id`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_desa`,`id_pemilik_menara`,`id_zonePlan`,`no_menara`,`foto`,`tanggal_pembuatan`,`lat`,`long`,`jenis_menara`,`tinggi_menara`,`tinggi_antena`,`luas_area`,`akses_jalan`,`file_suratIzinPembangunan`,`file_suratIzinOperasional`,`created_at`,`updated_at`,`deleted_at`) values 
(12,51,7,705,497,16,4,'161','/storage/Menara/12/FotoMenara.jpeg','2023-01-08','-8.401762515031399','115.58721184730531','Menara 4 Kaki','70','2','200','Jalan Setapak','/storage/Menara/12/Pembangunan.pdf','/storage/Menara/12/Operasional.pdf','2023-02-04 03:41:12','2023-01-08 09:50:22',NULL),
(15,51,7,704,492,17,7,'173',NULL,NULL,'-8.441052411616912','115.63937544822694','Menara 4 Kaki','75','2','200','Aspal',NULL,NULL,'2023-02-02 09:33:13','2023-02-02 09:33:13',NULL),
(16,51,7,705,497,17,4,'172',NULL,NULL,'-8.398691497299039','115.58898746967317','Menara 4 Kaki','73','2','300','Jalan Setapak',NULL,NULL,'2023-02-03 19:47:33','2023-02-03 19:47:33',NULL);

/*Table structure for table `tb_opd` */

DROP TABLE IF EXISTS `tb_opd`;

CREATE TABLE `tb_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_opd` */

insert  into `tb_opd`(`id`,`opd`,`created_at`,`updated_at`,`deleted_at`) values 
(3,'Dinas Lingkungan','2022-12-16 21:38:23',NULL,NULL),
(4,'Dinas Kominfo','2022-12-16 21:38:29',NULL,NULL);

/*Table structure for table `tb_pemilik_menara` */

DROP TABLE IF EXISTS `tb_pemilik_menara`;

CREATE TABLE `tb_pemilik_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
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
  KEY `id_perusahaan` (`id_perusahaan`),
  KEY `id_provinsi` (`id_provinsi`),
  KEY `id_kabupaten` (`id_kabupaten`),
  KEY `id_kecamatan` (`id_kecamatan`),
  KEY `id_desa` (`id_desa`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_pemilik_menara_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `tb_perusahaan` (`id`),
  CONSTRAINT `tb_pemilik_menara_ibfk_2` FOREIGN KEY (`id_provinsi`) REFERENCES `tb_m_provinsi` (`id`),
  CONSTRAINT `tb_pemilik_menara_ibfk_3` FOREIGN KEY (`id_kabupaten`) REFERENCES `tb_m_kabupaten` (`id`),
  CONSTRAINT `tb_pemilik_menara_ibfk_4` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_m_kecamatan` (`id`),
  CONSTRAINT `tb_pemilik_menara_ibfk_5` FOREIGN KEY (`id_desa`) REFERENCES `tb_m_desa` (`id`),
  CONSTRAINT `tb_pemilik_menara_ibfk_6` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_pemilik_menara` */

insert  into `tb_pemilik_menara`(`id`,`id_user`,`id_perusahaan`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_desa`,`nama`,`no_ktp`,`NPWP`,`Kewarganegaraan`,`alamat`,`no_telp`,`email`,`created_at`,`updated_at`,`deleted_at`) values 
(16,52,16,51,9,901,685,'Agus Aditya','0123456789','9876543210','WNI','Jln. Pulau Kawe','08123456789','jisnubagas@student.unud.ac.id','2023-01-08 09:10:09','2023-01-08 09:18:41',NULL),
(17,53,17,51,7,705,497,'Tyagi Jisnu','123456789','546481','WNI','Jl. Lettu Dugdugan','081321321321','tyagijisnubagas222@gmail.com','2023-01-08 09:52:16','2023-01-08 09:54:18',NULL);

/*Table structure for table `tb_pengajuan_menara` */

DROP TABLE IF EXISTS `tb_pengajuan_menara`;

CREATE TABLE `tb_pengajuan_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik_menara` int(11) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_zonePlan` int(11) DEFAULT NULL,
  `kode_registrasi` int(10) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `jenis_menara` enum('Menara 4 Kaki','Menara 3 Kaki','Menara 1 Kaki') DEFAULT NULL,
  `tinggi_menara` varchar(255) DEFAULT NULL,
  `tinggi_antena` varchar(255) DEFAULT NULL,
  `luas_area` varchar(255) DEFAULT NULL,
  `akses_jalan` varchar(255) DEFAULT NULL,
  `status_lahan` enum('sewa','milik perusahaan') DEFAULT NULL,
  `kepemilikan_tanah` varchar(255) DEFAULT NULL,
  `jumlah_pendamping` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `file_rekomendasiPembangunanMenara` varchar(255) DEFAULT NULL,
  `status` enum('draft','diajukan') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pemilik_menara` (`id_pemilik_menara`),
  KEY `id_provinsi` (`id_provinsi`),
  KEY `id_kabupaten` (`id_kabupaten`),
  KEY `id_kecamatan` (`id_kecamatan`),
  KEY `id_desa` (`id_desa`),
  CONSTRAINT `tb_pengajuan_menara_ibfk_1` FOREIGN KEY (`id_pemilik_menara`) REFERENCES `tb_pemilik_menara` (`id`),
  CONSTRAINT `tb_pengajuan_menara_ibfk_2` FOREIGN KEY (`id_provinsi`) REFERENCES `tb_m_provinsi` (`id`),
  CONSTRAINT `tb_pengajuan_menara_ibfk_3` FOREIGN KEY (`id_kabupaten`) REFERENCES `tb_m_kabupaten` (`id`),
  CONSTRAINT `tb_pengajuan_menara_ibfk_4` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_m_kecamatan` (`id`),
  CONSTRAINT `tb_pengajuan_menara_ibfk_5` FOREIGN KEY (`id_desa`) REFERENCES `tb_m_desa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_pengajuan_menara` */

insert  into `tb_pengajuan_menara`(`id`,`id_pemilik_menara`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_desa`,`id_zonePlan`,`kode_registrasi`,`lat`,`long`,`jenis_menara`,`tinggi_menara`,`tinggi_antena`,`luas_area`,`akses_jalan`,`status_lahan`,`kepemilikan_tanah`,`jumlah_pendamping`,`tanggal`,`file_rekomendasiPembangunanMenara`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(8,16,51,7,705,497,NULL,1,'-8.401762515031399','115.58721184730531','Menara 4 Kaki','70','2','200','Jalan Setapak','milik perusahaan','PT. A',2,'2023-01-08','/storage/Pengajuan/8/FileSurat/RekomendasiPembangunanMenara.pdf','diajukan','2023-01-08 17:45:47','2023-01-08 09:45:47',NULL),
(11,17,51,7,704,492,7,2,'-8.441052411616912','115.63937544822694','Menara 4 Kaki','75','2','200','Aspal','milik perusahaan','PT. Bintang',1,'2023-02-01','/storage/Pengajuan/11/FileSurat/RekomendasiPembangunanMenara.pdf','diajukan','2023-02-02 17:33:13','2023-02-02 09:33:13',NULL),
(12,17,51,7,708,533,6,3,'-8.286509299265775','115.59825181961061','Menara 4 Kaki','74','2','200','aspal','milik perusahaan','Pt. Bintang',NULL,'2023-02-02',NULL,'diajukan','2023-02-02 09:55:10','2023-02-02 09:55:10',NULL),
(13,17,51,7,705,497,4,4,'-8.398691497299039','115.58898746967317','Menara 4 Kaki','73','2','300','Jalan Setapak','milik perusahaan','PT. Bintang',1,'2023-02-03','/storage/Pengajuan/13/FileSurat/RekomendasiPembangunanMenara.pdf','diajukan','2023-02-04 03:47:33','2023-02-03 19:47:33',NULL);

/*Table structure for table `tb_pengajuan_status` */

DROP TABLE IF EXISTS `tb_pengajuan_status`;

CREATE TABLE `tb_pengajuan_status` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_status` int(11) DEFAULT NULL,
  `id_pengajuan_menara` int(11) DEFAULT NULL,
  `tanggal_status` datetime DEFAULT NULL,
  `disposisi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_status` (`id_status`),
  KEY `id_pengajuan_menara` (`id_pengajuan_menara`),
  CONSTRAINT `tb_pengajuan_status_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `tb_m_status` (`id`),
  CONSTRAINT `tb_pengajuan_status_ibfk_2` FOREIGN KEY (`id_pengajuan_menara`) REFERENCES `tb_pengajuan_menara` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_pengajuan_status` */

insert  into `tb_pengajuan_status`(`id`,`id_status`,`id_pengajuan_menara`,`tanggal_status`,`disposisi`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,8,'2023-01-08 09:41:46',NULL,'2023-01-08 09:41:46','2023-01-08 09:41:46',NULL),
(2,3,8,'2023-01-08 09:44:41','data sudah benar','2023-01-08 09:44:41','2023-01-08 09:44:41',NULL),
(3,9,8,'2023-01-08 09:44:41','data sudah benar','2023-01-08 09:44:41','2023-01-08 09:44:41',NULL),
(4,4,8,'2023-01-08 09:45:19','lokasi sesuai dibangun menara','2023-01-08 09:45:19','2023-01-08 09:45:19',NULL),
(5,5,8,'2023-01-08 09:45:19','lokasi sesuai dibangun menara','2023-01-08 09:45:19','2023-01-08 09:45:19',NULL),
(6,6,8,'2023-01-08 09:45:47','pengajuan menara selesai','2023-01-08 09:45:47','2023-01-08 09:45:47',NULL),
(19,2,11,'2023-01-30 15:05:35',NULL,'2023-01-30 15:05:35','2023-01-30 15:05:35',NULL),
(20,7,11,'2023-01-30 18:15:31','perbaiki','2023-01-30 18:15:31','2023-01-30 18:15:31',NULL),
(21,2,11,'2023-02-01 08:13:34','perbaiki','2023-02-01 08:13:34','2023-02-01 08:13:34',NULL),
(22,7,11,'2023-02-01 08:14:57','perbaiki','2023-02-01 08:14:57','2023-02-01 08:14:57',NULL),
(23,2,11,'2023-02-01 08:18:45','perbaiki','2023-02-01 08:18:45','2023-02-01 08:18:45',NULL),
(24,7,11,'2023-02-01 08:22:34','perbaiki','2023-02-01 08:22:34','2023-02-01 08:22:34',NULL),
(25,2,11,'2023-02-01 08:29:01','perbaiki','2023-02-01 08:29:01','2023-02-01 08:29:01',NULL),
(26,7,11,'2023-02-01 08:30:16','perbaiki','2023-02-01 08:30:16','2023-02-01 08:30:16',NULL),
(27,2,11,'2023-02-01 08:38:25','perbaiki','2023-02-01 08:38:25','2023-02-01 08:38:25',NULL),
(28,7,11,'2023-02-01 08:41:01','perbaiki','2023-02-01 08:41:01','2023-02-01 08:41:01',NULL),
(29,2,11,'2023-02-01 08:42:36','perbaiki','2023-02-01 08:42:36','2023-02-01 08:42:36',NULL),
(30,7,11,'2023-02-01 08:46:19','perbaiki','2023-02-01 08:46:19','2023-02-01 08:46:19',NULL),
(31,2,11,'2023-02-01 08:46:49','perbaiki','2023-02-01 08:46:49','2023-02-01 08:46:49',NULL),
(32,3,11,'2023-02-02 09:31:28','Diterima','2023-02-02 09:31:28','2023-02-02 09:31:28',NULL),
(33,9,11,'2023-02-02 09:31:28','Diterima','2023-02-02 09:31:28','2023-02-02 09:31:28',NULL),
(34,4,11,'2023-02-02 09:32:17','diterima','2023-02-02 09:32:17','2023-02-02 09:32:17',NULL),
(35,5,11,'2023-02-02 09:32:17','diterima','2023-02-02 09:32:17','2023-02-02 09:32:17',NULL),
(36,6,11,'2023-02-02 09:33:13','selesai','2023-02-02 09:33:13','2023-02-02 09:33:13',NULL),
(37,2,12,'2023-02-02 09:55:10',NULL,'2023-02-02 09:55:10','2023-02-02 09:55:10',NULL),
(38,3,12,'2023-02-02 09:56:42','setuju','2023-02-02 09:56:42','2023-02-02 09:56:42',NULL),
(39,9,12,'2023-02-02 09:56:42','setuju','2023-02-02 09:56:42','2023-02-02 09:56:42',NULL),
(41,8,12,'2023-02-02 09:59:11','tolak','2023-02-02 09:59:11','2023-02-02 09:59:11',NULL),
(42,2,13,'2023-02-03 19:45:34',NULL,'2023-02-03 19:45:34','2023-02-03 19:45:34',NULL),
(43,3,13,'2023-02-03 19:46:14','setuju','2023-02-03 19:46:14','2023-02-03 19:46:14',NULL),
(44,9,13,'2023-02-03 19:46:14','setuju','2023-02-03 19:46:14','2023-02-03 19:46:14',NULL),
(45,4,13,'2023-02-03 19:46:53','setuju','2023-02-03 19:46:53','2023-02-03 19:46:53',NULL),
(46,5,13,'2023-02-03 19:46:53','setuju','2023-02-03 19:46:53','2023-02-03 19:46:53',NULL),
(47,6,13,'2023-02-03 19:47:33','selesai','2023-02-03 19:47:33','2023-02-03 19:47:33',NULL);

/*Table structure for table `tb_penggunaan_menara` */

DROP TABLE IF EXISTS `tb_penggunaan_menara`;

CREATE TABLE `tb_penggunaan_menara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provider` int(11) DEFAULT NULL,
  `id_menara` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_menara` (`id_menara`),
  KEY `id_provider` (`id_provider`),
  CONSTRAINT `tb_penggunaan_menara_ibfk_1` FOREIGN KEY (`id_menara`) REFERENCES `tb_menara` (`id`),
  CONSTRAINT `tb_penggunaan_menara_ibfk_2` FOREIGN KEY (`id_provider`) REFERENCES `tb_m_provider` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_penggunaan_menara` */

insert  into `tb_penggunaan_menara`(`id`,`id_provider`,`id_menara`,`created_at`,`updated_at`,`deleted_at`) values 
(1,12,12,'2023-01-08 09:50:37','2023-01-08 09:50:37',NULL);

/*Table structure for table `tb_persetujuan_pendamping` */

DROP TABLE IF EXISTS `tb_persetujuan_pendamping`;

CREATE TABLE `tb_persetujuan_pendamping` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_persetujuan_pendamping` */

insert  into `tb_persetujuan_pendamping`(`id`,`id_pengajuan_menara`,`nama`,`no_ktp`,`file_suratPersetujuan`,`jarak`,`created_at`,`updated_at`,`deleted_at`) values 
(1,8,'budi','1155616','/storage/Pengajuan/8/Pendamping/Pendamping1.pdf','66','2023-01-08 09:41:46','2023-01-08 09:41:46',NULL),
(2,8,'dira','6168468','/storage/Pengajuan/8/Pendamping/Pendamping2.pdf','70','2023-01-08 09:41:46','2023-01-08 09:41:46',NULL),
(7,11,'Dito','123','/storage/Pengajuan/11/Pendamping/Pendamping1.pdf','63','2023-01-30 15:05:36','2023-01-30 15:05:36',NULL),
(8,13,'Budi','123123','/storage/Pengajuan/13/Pendamping/Pendamping1.pdf','30','2023-02-03 19:45:34','2023-02-03 19:45:34',NULL);

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
  `marker` varchar(255) DEFAULT NULL,
  `disposisi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_provinsi` (`id_provinsi`),
  KEY `id_kabupaten` (`id_kabupaten`),
  KEY `id_kecamatan` (`id_kecamatan`),
  KEY `id_desa` (`id_desa`),
  CONSTRAINT `tb_perusahaan_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `tb_m_provinsi` (`id`),
  CONSTRAINT `tb_perusahaan_ibfk_2` FOREIGN KEY (`id_kabupaten`) REFERENCES `tb_m_kabupaten` (`id`),
  CONSTRAINT `tb_perusahaan_ibfk_3` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_m_kecamatan` (`id`),
  CONSTRAINT `tb_perusahaan_ibfk_4` FOREIGN KEY (`id_desa`) REFERENCES `tb_m_desa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_perusahaan` */

insert  into `tb_perusahaan`(`id`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_desa`,`nama`,`no_telp`,`alamat`,`email`,`status`,`marker`,`disposisi`,`created_at`,`updated_at`,`deleted_at`) values 
(16,51,9,901,685,'PT. Asri','0321456987','Jl. Pulau Kawe','a@gmail.com','diterima','/storage/Perusahaan/16/Marker.png','pendaftaran diterima','2023-01-09 01:32:12','2023-01-08 09:23:19',NULL),
(17,51,9,901,685,'PT. Bintang','036155684','Jl. Pulau Moyo','b@gmail.com','diterima','/storage/Perusahaan/17/Marker.png','dis','2023-01-10 12:28:35','2023-01-10 04:28:35',NULL);

/*Table structure for table `tb_super_admin` */

DROP TABLE IF EXISTS `tb_super_admin`;

CREATE TABLE `tb_super_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
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
(1,43,'SUPER ADMIN','123456789123',NULL,'2022-12-01 16:53:49',NULL);

/*Table structure for table `tb_tim_administratif` */

DROP TABLE IF EXISTS `tb_tim_administratif`;

CREATE TABLE `tb_tim_administratif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_tim_administratif_ibfk_2` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`),
  CONSTRAINT `tb_tim_administratif_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_tim_administratif` */

insert  into `tb_tim_administratif`(`id`,`id_user`,`id_opd`,`nama`,`no_telp`,`created_at`,`updated_at`,`deleted_at`) values 
(8,48,3,'Jaya','081231231231','2022-12-16 13:39:07','2022-12-16 13:39:07',NULL);

/*Table structure for table `tb_tim_lapangan` */

DROP TABLE IF EXISTS `tb_tim_lapangan`;

CREATE TABLE `tb_tim_lapangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_tim_lapangan_ibfk_2` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`),
  CONSTRAINT `tb_tim_lapangan_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_tim_lapangan` */

insert  into `tb_tim_lapangan`(`id`,`id_user`,`id_opd`,`nama`,`no_telp`,`created_at`,`updated_at`,`deleted_at`) values 
(4,49,3,'Adi','082312312312','2022-12-16 13:39:43','2022-12-16 13:39:43',NULL);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `kategori` enum('Super Admin','Admin','Tim Administratif','Tim Lapangan','Pemilik Menara') DEFAULT NULL,
  `token` varchar(16) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`kategori`,`token`,`created_at`,`verified_at`,`updated_at`,`deleted_at`) values 
(43,'superadmin','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Super Admin',NULL,'2022-12-16 17:36:06','2022-12-16 17:39:22',NULL,NULL),
(44,'admin','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Admin',NULL,'2022-12-16 17:36:10','2022-12-16 17:39:25',NULL,NULL),
(48,'timadministratif','$2y$10$aOBg/5k8ZuAlhU5/a1WFE.mR7Z3WpLm35cscs/iuJIQlvFkHwqwhO','Tim Administratif',NULL,NULL,'2022-12-16 13:39:07',NULL,NULL),
(49,'timlapangan','$2y$10$jdN6rBQe/pmX18GIEuUUeucpfurdMrddm8mYCmAv.8E99ivMLkCuy','Tim Lapangan',NULL,NULL,'2022-12-16 13:39:43',NULL,NULL),
(52,'agus','$2y$10$.G/.ZR1I0FXDyckliHR6AOxvSVx1wCU5wFbGqUzgGHf5DjN1PC/YG','Pemilik Menara','LJrE5cnT809PRYEI',NULL,'2023-01-08 09:10:24',NULL,NULL),
(53,'tyagi','$2y$10$nGTnHKRapbmdMwy/RX0xaOM9yj/W8pesxf73zqPEvGRx/BclvTa9O','Pemilik Menara','j1oJ0drirQ5X2JWl',NULL,'2023-01-08 09:52:34',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
