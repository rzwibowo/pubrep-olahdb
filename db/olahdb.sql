/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - olahdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tbl_akses` */

DROP TABLE IF EXISTS `tbl_akses`;

CREATE TABLE `tbl_akses` (
  `id_akses` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `modul` varchar(250) DEFAULT NULL,
  `parent_modul` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_akses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_akses` */

/*Table structure for table `tbl_alasan` */

DROP TABLE IF EXISTS `tbl_alasan`;

CREATE TABLE `tbl_alasan` (
  `nama_alasan` varchar(500) DEFAULT NULL,
  `status_alasan` char(1) DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_alasan` */

/*Table structure for table `tbl_auth` */

DROP TABLE IF EXISTS `tbl_auth`;

CREATE TABLE `tbl_auth` (
  `id_auth` int(11) NOT NULL AUTO_INCREMENT,
  `password_auth` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_auth`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_auth` */

insert  into `tbl_auth`(`id_auth`,`password_auth`) values 
(1,'555');

/*Table structure for table `tbl_customer` */

DROP TABLE IF EXISTS `tbl_customer`;

CREATE TABLE `tbl_customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `nama_customer` varchar(50) DEFAULT NULL,
  `telp_customer` varchar(30) DEFAULT NULL,
  `alamat_customer` varchar(300) DEFAULT NULL,
  `id_propinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `status_customer` char(1) DEFAULT 'Y',
  `id_operator` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_customer` */

/*Table structure for table `tbl_karyawan` */

DROP TABLE IF EXISTS `tbl_karyawan`;

CREATE TABLE `tbl_karyawan` (
  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,
  `id_onlineshop` int(11) DEFAULT NULL,
  `nama_karyawan` varchar(100) DEFAULT NULL,
  `telp_karyawan` varchar(30) DEFAULT NULL,
  `alamat_karyawan` varchar(250) DEFAULT NULL,
  `foto_karyawan` varchar(250) DEFAULT NULL,
  `jenis_karyawan` varchar(25) DEFAULT 'CS',
  `status_karyawan` char(1) DEFAULT 'Y',
  `id_operator` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_karyawan` */

/*Table structure for table `tbl_level` */

DROP TABLE IF EXISTS `tbl_level`;

CREATE TABLE `tbl_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(100) DEFAULT NULL,
  `status_level` char(1) DEFAULT 'Y',
  `id_operator` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_level` */

insert  into `tbl_level`(`id_level`,`nama_level`,`status_level`,`id_operator`,`waktu_input`) values 
(1,'Superadmin','Y',1,'2021-09-07 12:13:07'),
(2,'Admin X','N',1,'2021-09-07 16:16:38'),
(3,'Kasir','Y',1,'2021-09-08 12:01:13'),
(4,'SPV','Y',1,'2021-09-08 12:00:45'),
(5,'Kasir','N',1,'2021-09-08 14:29:37');

/*Table structure for table `tbl_lokasi` */

DROP TABLE IF EXISTS `tbl_lokasi`;

CREATE TABLE `tbl_lokasi` (
  `id_lokasi` int(10) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(11) DEFAULT 1,
  `nama_lokasi` varchar(255) DEFAULT NULL,
  `lokasi_penjualan` char(1) DEFAULT 'Y',
  `status_lokasi` char(1) DEFAULT 'Y',
  `id_user` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_lokasi` */

insert  into `tbl_lokasi`(`id_lokasi`,`id_perusahaan`,`nama_lokasi`,`lokasi_penjualan`,`status_lokasi`,`id_user`,`waktu_input`) values 
(1,1,'Axsol','N','Y',1,'2021-06-02 08:39:44'),
(2,1,'Gudang Bos Ampuh','Y','Y',1,'2021-07-17 20:15:08'),
(3,NULL,'asdasdasdasd','Y','N',NULL,NULL),
(4,1,'Ranting','Y','Y',NULL,NULL);

/*Table structure for table `tbl_onlineshop` */

DROP TABLE IF EXISTS `tbl_onlineshop`;

CREATE TABLE `tbl_onlineshop` (
  `id_onlineshop` int(11) NOT NULL AUTO_INCREMENT,
  `nama_onlineshop` varchar(250) DEFAULT NULL,
  `telp_onlineshop` varchar(30) DEFAULT NULL,
  `alamat_onlineshop` varchar(500) DEFAULT NULL,
  `pemilik_onlineshop` varchar(150) DEFAULT NULL,
  `status_onlineshop` char(1) DEFAULT 'Y',
  `id_operator` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_onlineshop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_onlineshop` */

/*Table structure for table `tbl_operator` */

DROP TABLE IF EXISTS `tbl_operator`;

CREATE TABLE `tbl_operator` (
  `id_operator` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `username_operator` varchar(50) DEFAULT NULL,
  `password_operator` varchar(300) DEFAULT NULL,
  `nama_operator` varchar(100) DEFAULT NULL,
  `telp_operator` varchar(30) DEFAULT NULL,
  `alamat_operator` varchar(250) DEFAULT NULL,
  `foto_operator` varchar(250) DEFAULT 'no_gambar.jpg',
  `status_operator` char(1) DEFAULT 'Y',
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_operator`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_operator` */

insert  into `tbl_operator`(`id_operator`,`id_level`,`username_operator`,`password_operator`,`nama_operator`,`telp_operator`,`alamat_operator`,`foto_operator`,`status_operator`,`waktu_input`) values 
(1,1,'admin','21232f297a57a5a743894a0e4a801fc3','Admin','0','-','no_gambar.jpg','Y','2021-09-07 12:13:32');

/*Table structure for table `tbl_penawaran` */

DROP TABLE IF EXISTS `tbl_penawaran`;

CREATE TABLE `tbl_penawaran` (
  `id_penawaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_onlineshop` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `keterangan_transaksi` varchar(500) DEFAULT NULL,
  `id_alasan` int(11) DEFAULT NULL,
  `id_operator` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penawaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_penawaran` */

/*Table structure for table `tbl_penawaran_detail` */

DROP TABLE IF EXISTS `tbl_penawaran_detail`;

CREATE TABLE `tbl_penawaran_detail` (
  `id_penawaran_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_penawaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penawaran_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_penawaran_detail` */

/*Table structure for table `tbl_penjualan` */

DROP TABLE IF EXISTS `tbl_penjualan`;

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_penjualan` */

/*Table structure for table `tbl_penjualan_detail` */

DROP TABLE IF EXISTS `tbl_penjualan_detail`;

CREATE TABLE `tbl_penjualan_detail` (
  `id_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_penjualan_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_penjualan_detail` */

/*Table structure for table `tbl_perusahaan` */

DROP TABLE IF EXISTS `tbl_perusahaan`;

CREATE TABLE `tbl_perusahaan` (
  `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(255) DEFAULT '-',
  `npwp_perusahaan` varchar(100) DEFAULT '-',
  `alamat_perusahaan` varchar(250) DEFAULT '-',
  `telp_perusahaan` varchar(15) DEFAULT '-',
  `logo_perusahaan` varchar(255) DEFAULT 'no_gambar.jpg',
  `status_perusahaan` char(1) DEFAULT 'Y',
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_perusahaan` */

insert  into `tbl_perusahaan`(`id_perusahaan`,`nama_perusahaan`,`npwp_perusahaan`,`alamat_perusahaan`,`telp_perusahaan`,`logo_perusahaan`,`status_perusahaan`) values 
(1,'Axsol','-','-','0000','WhatsApp_Image_2021-07-21_at_15_27_30.jpeg','Y');

/*Table structure for table `tbl_sebab` */

DROP TABLE IF EXISTS `tbl_sebab`;

CREATE TABLE `tbl_sebab` (
  `id_sebab` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_sebab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_sebab` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
