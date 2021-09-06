/*
SQLyog Ultimate v9.50 
MySQL - 5.5.16 : Database - simpak
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`simpak` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `simpak`;

/*Table structure for table `tbl_ju_detail` */

DROP TABLE IF EXISTS `tbl_ju_detail`;

CREATE TABLE `tbl_ju_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coa` int(5) DEFAULT NULL,
  `header` int(10) DEFAULT NULL COMMENT 'FK tbl_ju_header',
  `debet` varchar(20) DEFAULT NULL,
  `kredit` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `SUPERKEY` (`coa`,`header`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_ju_header` */

DROP TABLE IF EXISTS `tbl_ju_header`;

CREATE TABLE `tbl_ju_header` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_bukti` varchar(20) DEFAULT NULL,
  `periode` int(10) DEFAULT NULL COMMENT 'FK tbl_periode',
  `tanggal_transaksi` date DEFAULT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `stt` enum('1','2') DEFAULT '1' COMMENT '1=Baru;2=Posting',
  `tanggal_input` datetime DEFAULT NULL,
  `user_input` int(10) DEFAULT NULL,
  `pc_input` varchar(50) DEFAULT NULL,
  `ip_input` varchar(20) DEFAULT NULL,
  `tanggal_edit` datetime DEFAULT NULL,
  `user_edit` int(10) DEFAULT NULL,
  `pc_edit` varchar(50) DEFAULT NULL,
  `ip_edit` varchar(20) DEFAULT NULL,
  `ste` enum('1','2') DEFAULT '1' COMMENT '1=Clear;2=Error',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_periode` */

DROP TABLE IF EXISTS `tbl_periode`;

CREATE TABLE `tbl_periode` (
  `id_periode` int(10) NOT NULL AUTO_INCREMENT,
  `kode_periode` char(4) DEFAULT NULL,
  `awal_periode` date DEFAULT NULL,
  `akhir_periode` date DEFAULT NULL,
  `jte` tinyint(5) DEFAULT NULL COMMENT 'Jumlah Transaksi Error',
  `stt` enum('1','2') DEFAULT '1' COMMENT '1=Unposted;2=Posted',
  PRIMARY KEY (`id_periode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_perkiraan` */

DROP TABLE IF EXISTS `tbl_perkiraan`;

CREATE TABLE `tbl_perkiraan` (
  `id_perkiraan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coa_perkiraan` char(5) NOT NULL,
  `nama_perkiraan` varchar(50) DEFAULT NULL,
  `kelompok` int(10) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `saldo_awal` varchar(20) DEFAULT '0',
  PRIMARY KEY (`id_perkiraan`),
  UNIQUE KEY `UNIQUE` (`coa_perkiraan`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_perkiraan_group` */

DROP TABLE IF EXISTS `tbl_perkiraan_group`;

CREATE TABLE `tbl_perkiraan_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_pg` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
