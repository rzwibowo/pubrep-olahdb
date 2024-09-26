-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: olahdb_v2
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.34-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_akses`
--

DROP TABLE IF EXISTS `tbl_akses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_akses` (
  `id_akses` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `modul` varchar(250) DEFAULT NULL,
  `parent_modul` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_akses`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_akses`
--

LOCK TABLES `tbl_akses` WRITE;
/*!40000 ALTER TABLE `tbl_akses` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_akses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_alasan`
--

DROP TABLE IF EXISTS `tbl_alasan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_alasan` (
  `id_alasan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alasan` varchar(500) DEFAULT NULL,
  `status_alasan` char(1) DEFAULT 'Y',
  `id_operator` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_alasan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_auth`
--

DROP TABLE IF EXISTS `tbl_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_auth` (
  `id_auth` int(11) NOT NULL AUTO_INCREMENT,
  `password_auth` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_auth`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_barang`
--

DROP TABLE IF EXISTS `tbl_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT '0',
  `id_onlineshop` int(11) DEFAULT NULL,
  `status_barang` char(1) DEFAULT 'Y',
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `nama_customer` varchar(50) DEFAULT NULL,
  `telp_customer` varchar(30) DEFAULT NULL,
  `alamat_customer` varchar(300) DEFAULT NULL,
  `id_propinsi` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_wilayah` int(11) DEFAULT '1',
  `kodepos` varchar(100) DEFAULT NULL,
  `status_customer` char(1) DEFAULT 'Y',
  `id_operator` int(11) DEFAULT NULL,
  `id_onlineshop` int(11) DEFAULT '1',
  `waktu_input` datetime DEFAULT NULL,
  `kota_csv_customer` varchar(100) DEFAULT NULL,
  `error_kota_customer` char(1) DEFAULT NULL,
  `status_follow_up` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_customer`),
  KEY `tbl_customer_id_kabupaten_IDX` (`id_kabupaten`,`nama_customer`,`telp_customer`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26882 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_customer_error`
--

DROP TABLE IF EXISTS `tbl_customer_error`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_customer_error` (
  `tgl_impor` datetime DEFAULT NULL,
  `detail_error` text,
  `pesan_error` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tbl_karyawan`
--

DROP TABLE IF EXISTS `tbl_karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_karyawan` (
  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,
  `id_onlineshop` int(11) DEFAULT '1',
  `nama_karyawan` varchar(100) DEFAULT NULL,
  `telp_karyawan` varchar(30) DEFAULT NULL,
  `alamat_karyawan` varchar(250) DEFAULT NULL,
  `foto_karyawan` varchar(250) DEFAULT NULL,
  `jenis_karyawan` varchar(25) DEFAULT NULL,
  `status_karyawan` char(1) DEFAULT 'Y',
  `id_operator` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tbl_kodepos`
--

DROP TABLE IF EXISTS `tbl_kodepos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kodepos` (
  `id_kodepos` int(11) NOT NULL AUTO_INCREMENT,
  `kodepos` varchar(100) DEFAULT NULL,
  `desa_kodepos` varchar(100) DEFAULT NULL,
  `kecamatan_kodepos` varchar(100) DEFAULT NULL,
  `kota_kodepos` varchar(100) DEFAULT NULL,
  `propinsi_kodepos` varchar(100) DEFAULT NULL,
  `status_kodepos` char(1) DEFAULT 'Y',
  PRIMARY KEY (`id_kodepos`)
) ENGINE=InnoDB AUTO_INCREMENT=77207 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_kota`
--

DROP TABLE IF EXISTS `tbl_kota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kota` (
  `id_kota` int(11) NOT NULL AUTO_INCREMENT,
  `id_propinsi` int(11) DEFAULT NULL,
  `nama_kota` varchar(100) DEFAULT NULL,
  `status_kota` char(1) DEFAULT 'Y',
  `id_users` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kota`)
) ENGINE=InnoDB AUTO_INCREMENT=2041 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tbl_level`
--

DROP TABLE IF EXISTS `tbl_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(100) DEFAULT NULL,
  `status_level` char(1) DEFAULT 'Y',
  `id_operator` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tbl_lokasi`
--

DROP TABLE IF EXISTS `tbl_lokasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lokasi` (
  `id_lokasi` int(10) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(11) DEFAULT NULL,
  `nama_lokasi` varchar(255) DEFAULT NULL,
  `lokasi_penjualan` char(1) DEFAULT NULL,
  `status_lokasi` char(1) DEFAULT 'Y',
  `id_user` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_onlineshop`
--

DROP TABLE IF EXISTS `tbl_onlineshop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_onlineshop`
--

LOCK TABLES `tbl_onlineshop` WRITE;
/*!40000 ALTER TABLE `tbl_onlineshop` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_onlineshop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_operator`
--

DROP TABLE IF EXISTS `tbl_operator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_operator` (
  `id_operator` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `username_operator` varchar(50) DEFAULT NULL,
  `password_operator` varchar(300) DEFAULT NULL,
  `nama_operator` varchar(100) DEFAULT NULL,
  `telp_operator` varchar(30) DEFAULT NULL,
  `alamat_operator` varchar(250) DEFAULT NULL,
  `foto_operator` varchar(250) DEFAULT NULL,
  `status_operator` char(1) DEFAULT 'Y',
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_operator`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tbl_penawaran`
--

DROP TABLE IF EXISTS `tbl_penawaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_penawaran` (
  `id_penawaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_onlineshop` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `media_penawaran` enum('telp','wa','door') DEFAULT NULL,
  `keterangan_penawaran` varchar(500) DEFAULT NULL,
  `id_alasan` int(11) DEFAULT NULL,
  `id_operator` int(11) DEFAULT NULL,
  `id_segmentasi` int(11) DEFAULT NULL,
  `kesimpulan_penawaran` enum('potensial','tidak potensial','tidak diketahui','tidak respon') DEFAULT NULL,
  `kode_penawaran` varchar(100) DEFAULT NULL,
  `prospek_penawaran` enum('follow up','maintenance','scale up') DEFAULT NULL,
  `aktivitas_follow_up` enum('prospek','negosiasi','closing','dihentikan','terbuka') DEFAULT 'terbuka',
  `tgl_penawaran` datetime DEFAULT NULL,
  `tgl_konfirmasi_penawaran` datetime DEFAULT NULL,
  `status_penawaran` char(1) DEFAULT 'Y',
  PRIMARY KEY (`id_penawaran`),
  KEY `tbl_penawaran_id_customer_IDX` (`id_customer`,`id_operator`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tbl_penawaran_gambar`
--

DROP TABLE IF EXISTS `tbl_penawaran_gambar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_penawaran_gambar` (
  `id_penawaran_gambar` int(11) NOT NULL AUTO_INCREMENT,
  `id_penawaran` int(11) DEFAULT NULL,
  `filename_penawaran_gambar` varchar(100) DEFAULT NULL,
  `status_penawaran_gambar` char(1) DEFAULT 'Y',
  PRIMARY KEY (`id_penawaran_gambar`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_penjualan`
--

DROP TABLE IF EXISTS `tbl_penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_penjualan`
--

LOCK TABLES `tbl_penjualan` WRITE;
/*!40000 ALTER TABLE `tbl_penjualan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_penjualan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_penjualan_detail`
--

DROP TABLE IF EXISTS `tbl_penjualan_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_penjualan_detail` (
  `id_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_penjualan_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_penjualan_detail`
--

LOCK TABLES `tbl_penjualan_detail` WRITE;
/*!40000 ALTER TABLE `tbl_penjualan_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_penjualan_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perusahaan`
--

DROP TABLE IF EXISTS `tbl_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perusahaan` (
  `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `npwp_perusahaan` varchar(100) DEFAULT NULL,
  `alamat_perusahaan` varchar(250) DEFAULT NULL,
  `telp_perusahaan` varchar(15) DEFAULT NULL,
  `logo_perusahaan` varchar(255) DEFAULT NULL,
  `status_perusahaan` char(1) DEFAULT 'Y',
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_propinsi`
--

DROP TABLE IF EXISTS `tbl_propinsi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_propinsi` (
  `id_propinsi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_propinsi` varchar(100) DEFAULT NULL,
  `status_propinsi` char(1) DEFAULT 'Y',
  `id_users` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_propinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_riwayat_beli`
--

DROP TABLE IF EXISTS `tbl_riwayat_beli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_riwayat_beli` (
  `id_riwayat_beli` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `tgl_riwayat_beli` datetime DEFAULT NULL,
  `ekspedisi` varchar(100) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `status_riwayat_beli` char(1) DEFAULT 'Y',
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_riwayat_beli`),
  KEY `tbl_riwayat_beli_id_customer_IDX` (`id_customer`,`tgl_riwayat_beli`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32243 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_riwayat_beli_detail`
--

DROP TABLE IF EXISTS `tbl_riwayat_beli_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_riwayat_beli_detail` (
  `id_detail_riwayat_beli` int(11) NOT NULL AUTO_INCREMENT,
  `id_riwayat_beli` int(11) DEFAULT NULL,
  `id_barang` varchar(100) DEFAULT NULL,
  `jml_detail` varchar(100) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_detail_riwayat_beli`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_segmentasi`
--

DROP TABLE IF EXISTS `tbl_segmentasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_segmentasi` (
  `id_segmentasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_segmentasi` varchar(100) DEFAULT NULL,
  `status_segmentasi` char(1) DEFAULT 'Y',
  `id_operator` int(11) DEFAULT NULL,
  `waktu_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_segmentasi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tbl_wilayah`
--

DROP TABLE IF EXISTS `tbl_wilayah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_wilayah` (
  `id_wilayah` int(10) NOT NULL AUTO_INCREMENT,
  `propinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kode_pos` int(20) DEFAULT NULL,
  PRIMARY KEY (`id_wilayah`)
) ENGINE=InnoDB AUTO_INCREMENT=81268 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'olahdb_v2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-01 18:35:57
