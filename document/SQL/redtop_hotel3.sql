/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.25 : Database - redtop_hotel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`redtop_hotel` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `redtop_hotel`;

/*Table structure for table `cicilan` */

DROP TABLE IF EXISTS `cicilan`;

CREATE TABLE `cicilan` (
  `cicilan_id` int(11) NOT NULL AUTO_INCREMENT,
  `angsuran_ke` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `no_anggota` int(11) DEFAULT NULL,
  `jumlah` decimal(20,2) DEFAULT NULL,
  `total_pinjaman` decimal(20,2) DEFAULT '0.00',
  `bunga` decimal(20,2) DEFAULT NULL,
  `cicilan_perbulan` decimal(20,2) DEFAULT NULL,
  `status` enum('lunas','belum') DEFAULT 'belum',
  `keterangan` varchar(255) DEFAULT '',
  `insert_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jatuh_tempo` date DEFAULT NULL,
  `update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cicilan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `cicilan` */

insert  into `cicilan`(`cicilan_id`,`angsuran_ke`,`order_id`,`no_anggota`,`jumlah`,`total_pinjaman`,`bunga`,`cicilan_perbulan`,`status`,`keterangan`,`insert_timestamp`,`jatuh_tempo`,`update_timestamp`) values (1,1,32,5,3000000.00,3180000.00,30000.00,530000.00,'lunas','transaksi_pinjaman','2016-02-02 05:59:05','2016-03-25','2016-02-02 10:43:24'),(2,2,32,5,3000000.00,3180000.00,30000.00,530000.00,'belum','transaksi_pinjaman','2016-02-02 05:59:05','2016-04-25',NULL),(3,3,32,5,3000000.00,3180000.00,30000.00,530000.00,'belum','transaksi_pinjaman','2016-02-02 05:59:05','2016-05-25',NULL),(4,4,32,5,3000000.00,3180000.00,30000.00,530000.00,'belum','transaksi_pinjaman','2016-02-02 05:59:05','2016-06-25',NULL),(5,5,32,5,3000000.00,3180000.00,30000.00,530000.00,'belum','transaksi_pinjaman','2016-02-02 05:59:05','2016-07-25',NULL),(6,6,32,5,3000000.00,3180000.00,30000.00,530000.00,'belum','transaksi_pinjaman','2016-02-02 05:59:05','2016-08-25',NULL),(7,1,33,5,500000.00,510000.00,10000.00,510000.00,'lunas','transaksi_pinjaman','2016-02-02 06:04:42','2016-03-25','2016-02-02 21:12:56'),(8,1,30,5,100000.00,100000.00,0.00,100000.00,'lunas','tranaski_penjualan','2016-02-02 06:09:38','2016-03-25','2016-02-02 10:42:11'),(9,1,34,5,1000000.00,1060000.00,30000.00,530000.00,'lunas','transaksi_pinjaman','2016-02-02 20:20:34','2016-03-25','2016-02-02 21:17:51'),(10,2,34,5,1000000.00,1060000.00,30000.00,530000.00,'lunas','transaksi_pinjaman','2016-02-02 20:20:34','2016-04-25','2016-02-02 21:18:02');

/*Table structure for table `config_nominal_pinjaman` */

DROP TABLE IF EXISTS `config_nominal_pinjaman`;

CREATE TABLE `config_nominal_pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nominal_max` decimal(20,2) DEFAULT '0.00',
  `account_id` bigint(20) DEFAULT NULL,
  `insert_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `config_nominal_pinjaman_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `config_nominal_pinjaman` */

insert  into `config_nominal_pinjaman`(`id`,`nominal_max`,`account_id`,`insert_timestamp`) values (1,4000000.00,7,'2015-12-26 14:14:22');

/*Table structure for table `config_pinjaman` */

DROP TABLE IF EXISTS `config_pinjaman`;

CREATE TABLE `config_pinjaman` (
  `id_conf` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah_pinjaman` decimal(20,2) DEFAULT '0.00',
  `bunga` decimal(20,2) DEFAULT '0.00',
  `lama_cicilan` int(11) DEFAULT '0',
  `angsuran` decimal(20,2) DEFAULT '0.00',
  PRIMARY KEY (`id_conf`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `config_pinjaman` */

insert  into `config_pinjaman`(`id_conf`,`jumlah_pinjaman`,`bunga`,`lama_cicilan`,`angsuran`) values (1,500000.00,10000.00,1,510000.00),(2,1000000.00,30000.00,2,530000.00),(3,1500000.00,20000.00,6,270000.00),(4,2000000.00,25000.00,5,425000.00),(5,3000000.00,30000.00,6,530000.00);

/*Table structure for table `log_harga` */

DROP TABLE IF EXISTS `log_harga`;

CREATE TABLE `log_harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` int(11) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_beli_lama` decimal(20,2) DEFAULT '0.00',
  `harga_beli_baru` decimal(20,2) DEFAULT '0.00',
  `persentase` decimal(20,2) DEFAULT '0.00',
  `harga_jual_lama` decimal(20,2) DEFAULT '0.00',
  `harga_jual_baru` decimal(20,2) DEFAULT '0.00',
  `user_update` int(11) DEFAULT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `log_harga` */

/*Table structure for table `log_saldo_anggota` */

DROP TABLE IF EXISTS `log_saldo_anggota`;

CREATE TABLE `log_saldo_anggota` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` int(255) DEFAULT NULL,
  `type` enum('transaksi_pinjaman','transaksi_simpanan','transaksi_penarikan') DEFAULT NULL COMMENT 'dari transaksi nama_table. Jika simpanan Ambil dari Header nya saja',
  `transaksi_id` int(11) DEFAULT NULL COMMENT 'order_id',
  `nominal` decimal(10,2) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT NULL,
  `insert_timestamp` date DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `no_anggota` (`no_anggota`),
  CONSTRAINT `log_saldo_anggota_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `master_anggota` (`no_anggota`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `log_saldo_anggota` */

/*Table structure for table `master_anggota` */

DROP TABLE IF EXISTS `master_anggota`;

CREATE TABLE `master_anggota` (
  `no_anggota` int(255) NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `departemen` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telpon` varchar(255) DEFAULT NULL,
  `no_rekening` varchar(255) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`no_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `master_anggota` */

insert  into `master_anggota`(`no_anggota`,`nik`,`nama`,`departemen`,`jabatan`,`alamat`,`no_telpon`,`no_rekening`,`created_time`,`hapus`) values (5,'1211510748','Nita Apriani','2','4','Jakarta','08979999999','39916584777','2015-12-11 19:36:49',0),(6,'1211510746','samuel','1','2','jkarta','0899999','999999','2015-12-14 20:58:36',2),(7,'131100000009','Martinus Lumban','1','2','tangerang','08979999999','30990000000','2016-01-30 22:41:15',0),(8,'1212111109','Rizki Chiris','1','2','Jakarta','099887766666','39912736666','2016-02-03 03:35:37',2);

/*Table structure for table `master_barang` */

DROP TABLE IF EXISTS `master_barang`;

CREATE TABLE `master_barang` (
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `harga_beli` decimal(20,2) DEFAULT '0.00',
  `presentase` int(20) DEFAULT '0',
  `harga_jual` decimal(20,2) DEFAULT '0.00',
  `created_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '0',
  `hapus` tinyint(1) DEFAULT '0' COMMENT 'Jika 1 = DELETE',
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_barang` */

insert  into `master_barang`(`kode_barang`,`nama_barang`,`deskripsi`,`harga_beli`,`presentase`,`harga_jual`,`created_timestamp`,`status`,`hapus`) values ('2147483647','sampoerna mild','tai',18000.00,2000,20000.00,'2016-02-02 20:27:07',1,1),('8999909096004','Rokok Mild','Rokok 17+\r\n',15000.00,3000,18000.00,'2016-02-02 20:39:00',1,0);

/*Table structure for table `master_departemen` */

DROP TABLE IF EXISTS `master_departemen`;

CREATE TABLE `master_departemen` (
  `kode_departemen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_departemen` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`kode_departemen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `master_departemen` */

insert  into `master_departemen`(`kode_departemen`,`nama_departemen`,`keterangan`,`created_time`,`hapus`) values (1,'IT','IT Application','2015-11-22 22:29:20',0),(2,'Bus','Business2','2015-11-22 22:29:20',0);

/*Table structure for table `master_jabatan` */

DROP TABLE IF EXISTS `master_jabatan`;

CREATE TABLE `master_jabatan` (
  `kode_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) DEFAULT '',
  `keterangan` varchar(255) DEFAULT '',
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`kode_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `master_jabatan` */

insert  into `master_jabatan`(`kode_jabatan`,`nama_jabatan`,`keterangan`,`created_time`,`hapus`) values (1,'IT','IT test','2015-11-22 22:45:54',1),(2,'Staff','Staff Lapangan','2015-11-22 22:45:54',0),(3,'','','2015-11-22 22:46:13',1),(4,'Manager','Manager Umum','2015-12-11 19:36:01',0),(5,'samuel','simpanan','2016-01-23 02:57:35',0);

/*Table structure for table `master_jenis_simpanan` */

DROP TABLE IF EXISTS `master_jenis_simpanan`;

CREATE TABLE `master_jenis_simpanan` (
  `kode_jenis_simpanan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_simpanan` varchar(255) DEFAULT '',
  `keterangan` varchar(255) DEFAULT '',
  `nominal` decimal(10,2) DEFAULT '0.00',
  `create_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hapus` tinyint(1) DEFAULT '0',
  `prioritas` int(1) DEFAULT '0' COMMENT 'UNTUK PEMBAYARAN DI AWAL',
  PRIMARY KEY (`kode_jenis_simpanan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `master_jenis_simpanan` */

insert  into `master_jenis_simpanan`(`kode_jenis_simpanan`,`nama_simpanan`,`keterangan`,`nominal`,`create_timestamp`,`hapus`,`prioritas`) values (1,'Simpanan Pokok','Simpanan Pokok',100000.00,'2015-12-14 18:18:12',0,1),(2,'Simpanan Wajib','Simpanan Wajib',200000.00,'2015-12-14 18:18:23',0,0),(3,'Simpanan Sukarela','Simpanan Sukarela',0.00,'2015-12-14 18:18:35',0,0),(4,'Simpanan Exclusive','Simpanan Exclusive',200000.00,'2016-01-31 20:44:03',0,0);

/*Table structure for table `master_supplier` */

DROP TABLE IF EXISTS `master_supplier`;

CREATE TABLE `master_supplier` (
  `kode_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telfon` varchar(12) DEFAULT NULL,
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`kode_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `master_supplier` */

insert  into `master_supplier`(`kode_supplier`,`nama_supplier`,`email`,`alamat`,`no_telfon`,`hapus`) values (2,'PT. Maju Mundur','maju@gmail.com','Tangerang','123454321',0);

/*Table structure for table `menu_web` */

DROP TABLE IF EXISTS `menu_web`;

CREATE TABLE `menu_web` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `link_menu` varchar(255) DEFAULT NULL,
  `icon_menu` varchar(255) DEFAULT NULL,
  `label_menu` varchar(255) DEFAULT NULL,
  `class_menu` varchar(255) DEFAULT NULL,
  `count_data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

/*Data for the table `menu_web` */

insert  into `menu_web`(`id_menu`,`link_menu`,`icon_menu`,`label_menu`,`class_menu`,`count_data`) values (1,'transaksi_pembelian','icon icon-pembelian','Transaksi Pembelian','badge badge-success pull-right','echo (isset($count_transaksi_pembelian)?$count_transaksi_pembelian:\"\");'),(2,'transaksi_penjualan','icon icon-jual','Invoice','badge badge-success pull-right','echo (isset($count_transaksi_penjualan)?$count_transaksi_penjualan:\"\");'),(3,'transaksi_service','icon-user','Transaksi Service','badge badge-success pull-right',''),(4,'surat_jalan','icon icon-suratjalan','Surat Jalan','badge badge-warning pull-right','echo (isset($count_surat_jalan)?$count_surat_jalan:\"\");'),(5,'generate_invoice','icon icon-invoice','Generate Invoice','badge badge-important pull-right','echo (isset($count_invoice)?$count_invoice:\"\");'),(6,'generate_penawaran','icon icon-penawaran','Generate Penawaran','badge badge-warning pull-right',''),(77,'spk','icon-user','SPK','badge badge-important pull-right',''),(78,'koreksi_invoice','icon-user','Koreksi Invoice','badge badge-warning pull-right','echo (isset($count_transaksi_penjualan)?$count_transaksi_penjualan:\"\");');

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_supplier` int(11) DEFAULT NULL COMMENT 'Supplier',
  `account_id` bigint(20) DEFAULT NULL COMMENT 'Pelayan',
  `order_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'tanggal PO di BUAT',
  `status_timestamp` date DEFAULT NULL COMMENT 'tanggal Approve PO',
  `arrive_timestamp` date DEFAULT NULL COMMENT 'tanggal Datang PO',
  `ppn` decimal(20,2) DEFAULT NULL,
  `transaksi_noppn` decimal(20,2) DEFAULT NULL,
  `total_transaksi` decimal(20,2) DEFAULT NULL,
  `currency` char(3) DEFAULT 'IDR',
  `payment_status` enum('lunas','hutang') DEFAULT NULL,
  `status` enum('approve','reject','pending','delivered') DEFAULT 'pending',
  PRIMARY KEY (`order_id`),
  KEY `account_id` (`account_id`),
  KEY `kode_customer` (`kode_supplier`),
  CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`kode_supplier`) REFERENCES `master_supplier` (`kode_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `user` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian` */

insert  into `pembelian`(`order_id`,`kode_supplier`,`account_id`,`order_timestamp`,`status_timestamp`,`arrive_timestamp`,`ppn`,`transaksi_noppn`,`total_transaksi`,`currency`,`payment_status`,`status`) values (50,2,8,'2016-02-03 02:54:39','2016-02-02','2016-02-27',10.00,800000.00,880000.00,'IDR','lunas','delivered');

/*Table structure for table `pembelian_detail` */

DROP TABLE IF EXISTS `pembelian_detail`;

CREATE TABLE `pembelian_detail` (
  `order_id` int(11) NOT NULL,
  `order_detail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_master_id` varchar(255) DEFAULT NULL COMMENT 'kode barang',
  `qty` int(11) DEFAULT NULL,
  `buying_price` decimal(20,2) DEFAULT '0.00',
  `sub_total` decimal(12,2) DEFAULT NULL,
  `order_detail_status` enum('active','delete') DEFAULT 'active',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`order_detail_id`),
  KEY `order_detail_id` (`order_detail_id`),
  KEY `order_master_id` (`order_master_id`),
  CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `pembelian` (`order_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian_detail` */

insert  into `pembelian_detail`(`order_id`,`order_detail_id`,`order_master_id`,`qty`,`buying_price`,`sub_total`,`order_detail_status`,`created_timestamp`) values (50,2,'8999909096004',100,8000.00,800000.00,'active','2016-02-03 02:56:45');

/*Table structure for table `resign` */

DROP TABLE IF EXISTS `resign`;

CREATE TABLE `resign` (
  `NoPengunduranDiri` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(255) DEFAULT '',
  `TglResign` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Keterangan` varchar(255) DEFAULT '',
  PRIMARY KEY (`NoPengunduranDiri`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `resign` */

insert  into `resign`(`NoPengunduranDiri`,`no_anggota`,`TglResign`,`Keterangan`) values (7,'6','2016-02-03 03:31:19','Keluar kota'),(8,'8','2016-02-03 03:35:52','Tidak Jadi');

/*Table structure for table `stok_barang` */

DROP TABLE IF EXISTS `stok_barang`;

CREATE TABLE `stok_barang` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) DEFAULT NULL,
  `order_id_penjualan` int(11) DEFAULT NULL,
  `order_id_pembelian` int(11) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `status` enum('barangmasuk','barangkeluar','opname') NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_stok`),
  KEY `kode_barang` (`kode_barang`),
  KEY `order_detail_id` (`order_id_penjualan`),
  KEY `stok_barang_ibfk_3` (`order_id_pembelian`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `stok_barang` */

insert  into `stok_barang`(`id_stok`,`kode_barang`,`order_id_penjualan`,`order_id_pembelian`,`qty`,`status`,`keterangan`,`timestamp`) values (1,'8999909096004',NULL,50,100,'barangmasuk',NULL,'2016-02-03 02:57:24'),(2,'8999909096004',31,NULL,-10,'barangkeluar',NULL,'2016-02-03 02:58:32');

/*Table structure for table `temp_stok_barang` */

DROP TABLE IF EXISTS `temp_stok_barang`;

CREATE TABLE `temp_stok_barang` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) DEFAULT NULL,
  `order_id_pembelian` int(11) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `status` enum('barangmasuk','barangkeluar') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `temp_stok_barang` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_customer` varchar(255) DEFAULT NULL COMMENT 'Customer',
  `account_id` bigint(20) DEFAULT NULL COMMENT 'Pelayan',
  `order_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_before_ppn` decimal(20,2) DEFAULT NULL,
  `ppn` int(11) DEFAULT '0',
  `total_after_ppn` decimal(20,2) DEFAULT NULL,
  `cash` decimal(20,2) DEFAULT NULL,
  `kredit` decimal(20,2) DEFAULT NULL,
  `currency` char(3) DEFAULT 'IDR',
  `payment_status` enum('lunas','cicilan') DEFAULT 'lunas' COMMENT 'default asumsi LUNAS',
  `lama_cicilan` int(11) DEFAULT '0' COMMENT 'lama cicilan akan di looping ke table cicilan',
  PRIMARY KEY (`order_id`),
  KEY `account_id` (`account_id`),
  KEY `kode_customer` (`kode_customer`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`order_id`,`kode_customer`,`account_id`,`order_timestamp`,`total_before_ppn`,`ppn`,`total_after_ppn`,`cash`,`kredit`,`currency`,`payment_status`,`lama_cicilan`) values (1,'5',8,'2015-12-24 17:08:05',16500.00,1,16665.00,10000.00,6665.00,'IDR','cicilan',0),(2,'5',8,'2015-12-24 17:09:32',16500.00,1,16665.00,10000.00,6665.00,'IDR','cicilan',0),(3,'5',8,'2015-12-24 17:10:10',16500.00,1,16665.00,10000.00,6665.00,'IDR','cicilan',0),(4,'5',8,'2015-12-24 17:11:22',16500.00,1,16665.00,10000.00,6665.00,'IDR','cicilan',0),(5,'5',8,'2015-12-24 17:11:52',16500.00,1,16665.00,10000.00,6665.00,'IDR','cicilan',0),(6,'5',8,'2015-12-24 17:12:34',16500.00,1,16665.00,10000.00,6665.00,'IDR','cicilan',0),(7,'5',8,'2015-12-24 17:29:23',375000.00,10,412500.00,12500.00,400000.00,'IDR','cicilan',0),(8,'newCustomer',8,'2015-12-24 17:32:11',98000.00,10,107800.00,0.00,0.00,'IDR','lunas',0),(9,'5',8,'2015-12-24 17:38:14',28700.00,10,31570.00,31570.00,0.00,'IDR','cicilan',0),(10,'newCustomer',8,'2015-12-24 17:40:40',33000.00,10,36300.00,36300.00,0.00,'IDR','lunas',0),(11,'5',8,'2015-12-24 17:42:14',16500.00,1,16665.00,16665.00,0.00,'IDR','cicilan',0),(12,'5',8,'2015-12-24 17:43:53',16500.00,1,16665.00,16665.00,0.00,'IDR','cicilan',0),(13,'5',8,'2015-12-24 17:45:26',16500.00,1,16665.00,16665.00,0.00,'IDR','lunas',0),(14,'5',8,'2015-12-24 17:46:06',16500.00,1,16665.00,6665.00,10000.00,'IDR','cicilan',0),(15,'5',8,'2015-12-24 17:47:13',11000.00,1,11110.00,11110.00,0.00,'IDR','lunas',0),(16,'newCustomer',8,'2015-12-24 17:49:35',11000.00,1,11110.00,11110.00,0.00,'IDR','lunas',0),(17,'newCustomer',8,'2015-12-24 17:52:23',11000.00,1,11110.00,11110.00,0.00,'IDR','lunas',0),(18,'newCustomer',8,'2015-12-24 17:53:31',11000.00,1,11110.00,11110.00,0.00,'IDR','lunas',0),(19,'5',8,'2016-01-02 19:55:08',770000.00,10,847000.00,347000.00,500000.00,'IDR','cicilan',0),(20,'5',8,'2016-01-28 19:33:38',16500.00,1,16665.00,16665.00,0.00,'IDR','lunas',0),(21,'5',8,'2016-01-28 19:36:57',16500.00,1,16665.00,16665.00,0.00,'IDR','lunas',0),(22,'newCustomer',8,'2016-01-28 19:41:06',33000.00,1,16665.00,16665.00,0.00,'IDR','lunas',0),(23,'5',8,'2016-01-28 21:36:20',60000.00,10,66000.00,66000.00,0.00,'IDR','lunas',0),(24,'5',8,'2016-01-28 21:39:04',60000.00,10,66000.00,16000.00,50000.00,'IDR','cicilan',0),(25,'5',8,'2016-01-28 21:51:12',16500.00,10,18150.00,18150.00,0.00,'IDR','lunas',0),(26,'5',8,'2016-01-28 21:53:08',16500.00,1,16665.00,6665.00,10000.00,'IDR','cicilan',0),(27,'6',8,'2016-01-28 21:59:30',16500.00,10,18150.00,8150.00,10000.00,'IDR','cicilan',0),(28,'6',8,'2016-01-31 00:57:51',375000.00,1,378750.00,378750.00,0.00,'IDR','lunas',0),(29,'6',8,'2016-01-31 00:59:50',210000.00,1,212100.00,212100.00,0.00,'IDR','lunas',0),(30,'5',8,'2016-02-02 06:09:38',165000.00,10,181500.00,81500.00,100000.00,'IDR','cicilan',0),(31,'5',8,'2016-02-03 02:58:32',89000.00,10,97900.00,97900.00,0.00,'IDR','lunas',0);

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `order_id` int(11) NOT NULL,
  `order_detail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_master_id` varchar(255) NOT NULL COMMENT 'kode barang,0 = >pph',
  `qty` int(11) DEFAULT NULL,
  `selling_price` decimal(20,2) DEFAULT NULL COMMENT 'harga satuan,bila order_master_id 0 .selling_price berarti %',
  `sub_total` decimal(20,2) DEFAULT NULL COMMENT '@ x Qty',
  `order_detail_status` enum('active','delete') DEFAULT 'active',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`order_detail_id`,`order_master_id`),
  KEY `order_detail_id` (`order_detail_id`),
  KEY `order_master_id` (`order_master_id`),
  CONSTRAINT `transaksi_detail_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `transaksi` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

insert  into `transaksi_detail`(`order_id`,`order_detail_id`,`order_master_id`,`qty`,`selling_price`,`sub_total`,`order_detail_status`,`created_timestamp`) values (19,1,'11',100,7700.00,770000.00,'active','2016-01-02 19:55:08'),(20,2,'10',1,16500.00,16500.00,'active','2016-01-28 19:33:38'),(21,3,'10',1,16500.00,16500.00,'active','2016-01-28 19:36:57'),(22,4,'10',NULL,NULL,33000.00,'active','2016-01-28 19:41:06'),(23,5,'13',5,12000.00,60000.00,'active','2016-01-28 21:36:20'),(24,6,'13',5,12000.00,60000.00,'active','2016-01-28 21:39:04'),(25,7,'10',1,16500.00,16500.00,'active','2016-01-28 21:51:12'),(26,8,'10',1,16500.00,16500.00,'active','2016-01-28 21:53:08'),(27,9,'10',1,16500.00,16500.00,'active','2016-01-28 21:59:30'),(28,10,'10',10,16500.00,165000.00,'active','2016-01-31 00:57:51'),(28,11,'9',10,21000.00,210000.00,'active','2016-01-31 00:57:51'),(29,12,'9',10,21000.00,210000.00,'active','2016-01-31 00:59:50'),(30,13,'10',10,16500.00,165000.00,'active','2016-02-02 06:09:38'),(31,14,'8999909096004',10,8900.00,89000.00,'active','2016-02-03 02:58:32');

/*Table structure for table `transaksi_penarikan` */

DROP TABLE IF EXISTS `transaksi_penarikan`;

CREATE TABLE `transaksi_penarikan` (
  `NoPengunduranDiri` int(11) NOT NULL,
  `kode_jenis_simpanan` int(11) NOT NULL,
  `jumlahTarik` decimal(20,2) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`NoPengunduranDiri`,`kode_jenis_simpanan`),
  CONSTRAINT `transaksi_penarikan_ibfk_1` FOREIGN KEY (`NoPengunduranDiri`) REFERENCES `resign` (`NoPengunduranDiri`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_penarikan` */

/*Table structure for table `transaksi_pinjaman` */

DROP TABLE IF EXISTS `transaksi_pinjaman`;

CREATE TABLE `transaksi_pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjaman_id` varchar(255) NOT NULL DEFAULT '',
  `no_anggota` int(11) NOT NULL,
  `jumlah_pinjaman` decimal(20,2) DEFAULT '0.00',
  `total_pinjaman` decimal(20,2) DEFAULT '0.00',
  `lama_cicilan` int(11) DEFAULT '0',
  `bunga` decimal(20,2) DEFAULT '0.00',
  `keterangan` varchar(255) DEFAULT '',
  `status` enum('lunas','belum') DEFAULT 'belum',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`no_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Data for the table `transaksi_pinjaman` */

insert  into `transaksi_pinjaman`(`id`,`pinjaman_id`,`no_anggota`,`jumlah_pinjaman`,`total_pinjaman`,`lama_cicilan`,`bunga`,`keterangan`,`status`,`time_created`) values (25,'PJ160001',5,2000000.00,2125000.00,5,25000.00,'bayar hutang','belum','2016-01-18 21:48:00'),(26,'PJ160002',5,3000000.00,3180000.00,6,30000.00,'beli rumah','belum','2016-01-23 05:17:44'),(27,'PJ160003',6,500000.00,510000.00,1,10000.00,'sewa motor','belum','2016-01-23 05:31:42'),(28,'PJ160004',5,3000000.00,3180000.00,6,30000.00,'asd','belum','2016-01-27 03:45:11'),(29,'PJ160005',6,3000000.00,3180000.00,6,30000.00,'asd','belum','2016-01-28 21:57:22'),(30,'PJ160006',5,3000000.00,3180000.00,6,30000.00,'mau merried','belum','2016-01-28 22:33:42'),(31,'PJ160007',7,3000000.00,3180000.00,6,30000.00,'ss','belum','2016-01-31 01:14:10'),(32,'PJ160008',5,3000000.00,3180000.00,6,30000.00,'Biaya Kuliah','belum','2016-02-02 05:59:05'),(33,'PJ160009',5,500000.00,510000.00,1,10000.00,'nikah','belum','2016-02-02 06:04:42'),(34,'PJ160010',7,1000000.00,1060000.00,2,30000.00,'gfdfg','belum','2016-02-02 20:20:34');

/*Table structure for table `transaksi_simpanan` */

DROP TABLE IF EXISTS `transaksi_simpanan`;

CREATE TABLE `transaksi_simpanan` (
  `kode_simpanan` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` int(11) DEFAULT NULL,
  `total_simpanan` decimal(20,2) DEFAULT '0.00',
  `created_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_simpanan`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `transaksi_simpanan` */

insert  into `transaksi_simpanan`(`kode_simpanan`,`no_anggota`,`total_simpanan`,`created_timestamp`) values (26,5,30000.00,'2016-01-27 04:03:43'),(28,7,300000.00,'2016-01-31 21:46:50'),(29,7,200000.00,'2016-01-31 21:47:03'),(30,8,100000.00,'2016-02-03 03:35:37');

/*Table structure for table `transaksi_simpanan_detail` */

DROP TABLE IF EXISTS `transaksi_simpanan_detail`;

CREATE TABLE `transaksi_simpanan_detail` (
  `kode_simpanan_detail` int(11) NOT NULL AUTO_INCREMENT,
  `kode_simpanan` int(11) DEFAULT NULL,
  `kode_jenis_simpanan` int(11) DEFAULT NULL,
  `jumlah_simpanan` decimal(20,2) DEFAULT '0.00',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_simpanan_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `transaksi_simpanan_detail` */

insert  into `transaksi_simpanan_detail`(`kode_simpanan_detail`,`kode_simpanan`,`kode_jenis_simpanan`,`jumlah_simpanan`,`created_timestamp`) values (18,22,1,100000.00,'2015-12-14 19:07:27'),(19,22,2,50000.00,'2015-12-14 19:07:27'),(20,22,3,50000.00,'2015-12-14 19:07:27'),(21,23,1,100.00,'2016-01-27 04:00:57'),(22,23,2,1.00,'2016-01-27 04:00:57'),(23,24,1,300.00,'2016-01-27 04:02:45'),(24,25,1,10.00,'2016-01-27 04:03:07'),(25,26,2,30000.00,'2016-01-27 04:03:43'),(26,27,1,100000.00,'2016-01-30 22:41:15'),(27,28,1,100000.00,'2016-01-31 21:46:51'),(28,28,2,200000.00,'2016-01-31 21:46:51'),(29,29,2,200000.00,'2016-01-31 21:47:03'),(30,30,1,100000.00,'2016-02-03 03:35:37');

/*Table structure for table `upload_file_opname` */

DROP TABLE IF EXISTS `upload_file_opname`;

CREATE TABLE `upload_file_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(255) DEFAULT NULL,
  `insert_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

/*Data for the table `upload_file_opname` */

insert  into `upload_file_opname`(`id`,`nama_file`,`insert_timestamp`) values (1,'upload_Stok6.xls','2015-12-26 04:46:12'),(2,'upload_Stok.xls','2015-12-26 04:51:48'),(3,'upload_Stok1.xls','2015-12-26 04:53:12'),(4,'upload_Stok2.xls','2015-12-26 04:54:20'),(5,'upload_Stok3.xls','2015-12-26 04:55:13'),(6,'upload_Stok4.xls','2015-12-26 04:56:10'),(7,'upload_Stok5.xls','2015-12-26 04:57:16'),(8,'upload_Stok7.xls','2015-12-26 04:57:48'),(9,'upload_Stok8.xls','2015-12-26 04:58:30'),(10,'upload_Stok9.xls','2015-12-26 04:58:57'),(11,'upload_Stok10.xls','2015-12-26 04:59:37'),(12,'upload_Stok11.xls','2015-12-26 05:00:11'),(13,'upload_Stok12.xls','2015-12-26 05:01:22'),(14,'upload_Stok13.xls','2015-12-26 05:01:37'),(15,'upload_Stok14.xls','2015-12-26 05:02:28'),(16,'upload_Stok15.xls','2015-12-26 05:02:58'),(17,'upload_Stok16.xls','2015-12-26 05:03:11'),(18,'upload_Stok17.xls','2015-12-26 05:04:52'),(19,'upload_Stok18.xls','2015-12-26 05:06:12'),(20,'upload_Stok19.xls','2015-12-26 05:06:49'),(21,'upload_Stok20.xls','2015-12-26 05:07:01'),(22,'upload_Stok21.xls','2015-12-26 05:07:26'),(23,'upload_Stok22.xls','2015-12-26 05:08:17'),(24,'upload_Stok23.xls','2015-12-26 05:09:04'),(25,'upload_Stok24.xls','2015-12-26 05:09:38'),(26,'upload_Stok25.xls','2015-12-26 05:09:59'),(27,'upload_Stok26.xls','2015-12-26 05:10:19'),(28,'upload_Stok27.xls','2015-12-26 05:10:46'),(29,'upload_Stok28.xls','2015-12-26 05:11:23'),(30,'upload_Stok29.xls','2015-12-26 05:11:30'),(31,'upload_Stok30.xls','2015-12-26 05:11:53'),(32,'upload_Stok31.xls','2015-12-26 05:12:31'),(33,'upload_Stok32.xls','2015-12-26 05:12:34'),(34,'upload_Stok33.xls','2015-12-26 05:12:56'),(35,'upload_Stok34.xls','2015-12-26 05:13:04'),(36,'upload_Stok35.xls','2015-12-26 05:13:21'),(37,'upload_Stok36.xls','2015-12-26 05:17:55'),(38,'upload_Stok37.xls','2015-12-26 05:20:13'),(39,'upload_Stok38.xls','2015-12-26 05:23:44'),(40,'upload_Stok39.xls','2015-12-26 05:24:17'),(41,'upload_Stok40.xls','2015-12-26 05:25:38'),(42,'upload_Stok41.xls','2015-12-26 05:26:08'),(43,'upload_Stok42.xls','2015-12-26 05:27:38'),(44,'upload_Stok43.xls','2015-12-26 05:29:33'),(45,'upload_Stok44.xls','2015-12-26 05:30:17'),(46,'upload_Stok45.xls','2015-12-26 05:30:44'),(47,'stok_baru.xls','2016-01-02 19:45:39'),(48,'opname_Redtop.xls','2016-01-28 22:57:02'),(49,'opname_Redtop1.xls','2016-01-28 22:57:23'),(50,'opname_Redtop2.xls','2016-01-28 23:02:03'),(51,'opname_Redtop3.xls','2016-01-28 23:03:55'),(52,'opname_Redtop4.xls','2016-01-28 23:04:04'),(53,'opname_Redtop5.xls','2016-01-29 22:39:03'),(54,'opname_Redtop6.xls','2016-01-29 22:49:14'),(55,'opname_Redtop7.xls','2016-01-29 22:50:17'),(56,'opname_Redtop8.xls','2016-01-29 22:52:53'),(57,'opname_Redtop9.xls','2016-01-29 22:53:21'),(58,'opname_Redtop10.xls','2016-01-29 23:04:29'),(59,'asd.xls','2016-01-31 00:59:06');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `account_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `keterangan` enum('admin','approval','user','root') DEFAULT NULL,
  `id_menu` varchar(255) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`account_id`,`nama`,`email`,`password`,`keterangan`,`id_menu`,`lastlogin`,`regdate`,`status`,`hapus`) values (7,'Samuels','sam@gmail.comsss','6894e45cd6c8b887f52ae3b59d8f15dc','root','1,2,4,5,6,7,8,9,10,11,12,13,14','2015-12-27 02:27:26','2015-10-15 04:42:41',1,0),(8,'Admin','admin@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','admin','1,2,3,4,5,6,7,8,9,10,11,12,13,14','2016-02-02 08:23:00','2015-10-15 04:42:41',1,0),(9,'sam','sam@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','admin',NULL,NULL,'2015-12-26 12:23:51',0,1),(10,'samuel erwardi','0','6894e45cd6c8b887f52ae3b59d8f15dc','',NULL,NULL,'2015-12-27 01:33:24',1,1),(11,'asdasdadsas','admin@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','root','1,2,4,5,6,7,8,9,10,11,12,13,14','2016-02-02 08:23:00','2015-12-27 02:06:44',1,0),(12,'xcv','admin@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','root','1,2,4,5,6,7,8,9,10,11,12,13,14','2016-02-02 08:23:00','2015-12-27 02:09:44',1,0),(13,'sami','sami@gmail.com','202cb962ac59075b964b07152d234b70','admin','1,2,4,5,6,7,8,9,10,11,12,13,14',NULL,'2015-12-27 02:15:48',1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
