/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.25 : Database - redtop_hotel_live
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`redtop_hotel_live` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `redtop_hotel_live`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cicilan` */

/*Table structure for table `config_nominal_pinjaman` */

DROP TABLE IF EXISTS `config_nominal_pinjaman`;

CREATE TABLE `config_nominal_pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('pinjaman_koperasi','pinjaman_inventory') DEFAULT NULL,
  `nominal_max` decimal(20,2) DEFAULT '0.00',
  `account_id` bigint(20) DEFAULT NULL,
  `insert_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `config_nominal_pinjaman_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `config_nominal_pinjaman` */

insert  into `config_nominal_pinjaman`(`id`,`type`,`nominal_max`,`account_id`,`insert_timestamp`) values (1,'pinjaman_koperasi',3000000.00,7,'2015-12-26 14:14:22'),(2,'pinjaman_inventory',1000000.00,7,'2016-02-06 00:50:51');

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

insert  into `config_pinjaman`(`id_conf`,`jumlah_pinjaman`,`bunga`,`lama_cicilan`,`angsuran`) values (1,500000.00,10000.00,1,510000.00),(2,1000000.00,60000.00,2,530000.00),(3,1500000.00,120000.00,6,270000.00),(4,2000000.00,125000.00,5,425000.00),(5,3000000.00,180000.00,6,530000.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `log_saldo_anggota` */

/*Table structure for table `master_anggota` */

DROP TABLE IF EXISTS `master_anggota`;

CREATE TABLE `master_anggota` (
  `no_anggota` int(255) NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `departemen` int(11) DEFAULT NULL,
  `jabatan` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telpon` varchar(255) DEFAULT NULL,
  `no_rekening` varchar(255) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`no_anggota`),
  KEY `departemen` (`departemen`),
  KEY `jabatan` (`jabatan`),
  CONSTRAINT `master_anggota_ibfk_1` FOREIGN KEY (`departemen`) REFERENCES `master_departemen` (`kode_departemen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `master_anggota_ibfk_2` FOREIGN KEY (`jabatan`) REFERENCES `master_jabatan` (`kode_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `master_anggota` */

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
  `hapus` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Jika 1 = DELETE',
  PRIMARY KEY (`kode_barang`,`hapus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_barang` */

/*Table structure for table `master_departemen` */

DROP TABLE IF EXISTS `master_departemen`;

CREATE TABLE `master_departemen` (
  `kode_departemen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_departemen` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`kode_departemen`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `master_departemen` */

insert  into `master_departemen`(`kode_departemen`,`nama_departemen`,`keterangan`,`created_time`,`hapus`) values (1,'A&G','A&G','2016-02-12 16:45:49',0),(2,'Accounting','Accounting','2016-02-12 16:45:49',0),(3,'Engineering','Engineering','2016-02-12 16:45:49',0),(4,'FB/Banquet Opr','FB/Banquet Opr','2016-02-12 16:45:49',0),(5,'FB/Gallery Rest','FB/Gallery Rest','2016-02-12 16:45:49',0),(6,'FB/Lobby Lounge & Bar','FB/Lobby Lounge & Bar','2016-02-12 16:45:49',0),(7,'FB/Mini Bar','FB/Mini Bar','2016-02-12 16:45:49',0),(8,'FB/O Cafe','FB/O Cafe','2016-02-12 16:45:49',0),(9,'FB/Room Service','FB/Room Service','2016-02-12 16:45:49',0),(10,'FB/Sapphire Lounge & Bar','FB/Sapphire Lounge & Bar','2016-02-12 16:45:49',0),(11,'Fitness & Spa','Fitness & Spa','2016-02-12 16:45:49',0),(12,'FO','FO','2016-02-12 16:45:49',0),(13,'FO/Concierge','FO/Concierge','2016-02-12 16:45:49',0),(14,'FO/Operator','FO/Operator','2016-02-12 16:45:49',0),(15,'FO/Reservation','FO/Reservation','2016-02-12 16:45:49',0),(16,'Housekeeping','Housekeeping','2016-02-12 16:45:49',0),(17,'HRD','HRD','2016-02-12 16:45:49',0),(18,'Kitchen/Admin','Kitchen/Admin','2016-02-12 16:45:49',0),(19,'Kitchen/Banquet','Kitchen/Banquet','2016-02-12 16:45:49',0),(20,'Kitchen/Commissary','Kitchen/Commissary','2016-02-12 16:45:49',0),(21,'Kitchen/Gallery','Kitchen/Gallery','2016-02-12 16:45:49',0),(22,'Kitchen/Oriental','Kitchen/Oriental','2016-02-12 16:45:49',0),(23,'Kitchen/Pastry','Kitchen/Pastry','2016-02-12 16:45:49',0),(24,'Kitchen/Steward','Kitchen/Steward','2016-02-12 16:45:49',0),(25,'Laundry','Laundry','2016-02-12 16:45:49',0),(26,'Sales & Marketing','Sales & Marketing','2016-02-12 16:45:49',0),(27,'Sales & Marketing/PR','Sales & Marketing/PR','2016-02-12 16:45:49',0),(28,'Security','Security','2016-02-12 16:45:49',0);

/*Table structure for table `master_jabatan` */

DROP TABLE IF EXISTS `master_jabatan`;

CREATE TABLE `master_jabatan` (
  `kode_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) DEFAULT '',
  `keterangan` varchar(255) DEFAULT '',
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`kode_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*Data for the table `master_jabatan` */

insert  into `master_jabatan`(`kode_jabatan`,`nama_jabatan`,`keterangan`,`created_time`,`hapus`) values (1,'BC Supervisor','BC Supervisor','2016-02-12 16:58:52',0),(2,'AP Supervisor','AP Supervisor','2016-02-12 16:58:52',0),(3,'Cost Control Supervisor','Cost Control Supervisor','2016-02-12 16:58:52',0),(4,'AR Supervisor','AR Supervisor','2016-02-12 16:58:52',0),(5,'AP Staff','AP Staff','2016-02-12 16:58:52',0),(6,'Storekeeper','Storekeeper','2016-02-12 16:58:52',0),(7,'Purchasing Clerk','Purchasing Clerk','2016-02-12 16:58:52',0),(8,'Staff Can Fix It','Staff Can Fix It','2016-02-12 16:58:52',0),(9,'Engineering Supervisor','Engineering Supervisor','2016-02-12 16:58:52',0),(10,'Tehnician','Tehnician','2016-02-12 16:58:52',0),(11,'Sr. Technician','Sr. Technician','2016-02-12 16:58:52',0),(12,'Elcom Leader','Elcom Leader','2016-02-12 16:58:52',0),(13,'Senior Admin','Senior Admin','2016-02-12 16:58:52',0),(14,'Technician','Technician','2016-02-12 16:58:52',0),(15,'Mechanic','Mechanic','2016-02-12 16:58:52',0),(16,'Asst Chief Engineer','Asst Chief Engineer','2016-02-12 16:58:52',0),(17,'Captain','Captain','2016-02-12 16:58:52',0),(18,'Attendant','Attendant','2016-02-12 16:58:52',0),(19,'Asst. Manager','Asst. Manager','2016-02-12 16:58:52',0),(20,'Supervisor','Supervisor','2016-02-12 16:58:52',0),(21,'Manager','Manager','2016-02-12 16:58:52',0),(22,'Instructur','Instructur','2016-02-12 16:58:52',0),(23,'Duty Manager','Duty Manager','2016-02-12 16:58:52',0),(24,'FDA','FDA','2016-02-12 16:58:52',0),(25,'GRO','GRO','2016-02-12 16:58:52',0),(26,'Asst. FOM','Asst. FOM','2016-02-12 16:58:52',0),(27,'FOM','FOM','2016-02-12 16:58:52',0),(28,'Driver','Driver','2016-02-12 16:58:52',0),(29,'Bellboy','Bellboy','2016-02-12 16:58:52',0),(30,'Doorman','Doorman','2016-02-12 16:58:52',0),(31,'Operator','Operator','2016-02-12 16:58:52',0),(32,'Reservation Clerk','Reservation Clerk','2016-02-12 16:58:52',0),(33,'Gardener Leader','Gardener Leader','2016-02-12 16:58:52',0),(34,'HK Manager','HK Manager','2016-02-12 16:58:52',0),(35,'Training Manager','Training Manager','2016-02-12 16:58:52',0),(36,'HR Supervisor','HR Supervisor','2016-02-12 16:58:52',0),(37,'English Teacher','English Teacher','2016-02-12 16:58:52',0),(38,'Personnel Manager','Personnel Manager','2016-02-12 16:58:52',0),(39,'ER & GA Coordinator','ER & GA Coordinator','2016-02-12 16:58:52',0),(40,'Secretary','Secretary','2016-02-12 16:58:52',0),(41,'Exec. Sous Chef','Exec. Sous Chef','2016-02-12 16:58:52',0),(42,'Chef de Parties','Chef de Parties','2016-02-12 16:58:52',0),(43,'Commis II','Commis II','2016-02-12 16:58:52',0),(44,'Demi Chef','Demi Chef','2016-02-12 16:58:52',0),(47,'Commis I','Commis I','2016-02-12 16:58:52',0),(48,'Sous Chef','Sous Chef','2016-02-12 16:58:52',0),(49,'Commis II Dimsum','Commis II Dimsum','2016-02-12 16:58:52',0),(50,'Chinese Chef','Chinese Chef','2016-02-12 16:58:52',0),(51,'Demi Chef Dimsum','Demi Chef Dimsum','2016-02-12 16:58:52',0),(52,'Demi Chef  Chinese','Demi Chef  Chinese','2016-02-12 16:58:52',0),(53,'Chef de Parties Chinese','Chef de Parties Chinese','2016-02-12 16:58:52',0),(54,'Commis II Chinese','Commis II Chinese','2016-02-12 16:58:52',0),(55,'Special Chef Dimsun','Special Chef Dimsun','2016-02-12 16:58:52',0),(56,'Asst. Chief Steward','Asst. Chief Steward','2016-02-12 16:58:52',0),(57,'Sales Executive','Sales Executive','2016-02-12 16:58:52',0),(58,'Sales Manager','Sales Manager','2016-02-12 16:58:52',0),(59,'Sales Admin','Sales Admin','2016-02-12 16:58:52',0),(60,'PR Officer','PR Officer','2016-02-12 16:58:52',0),(61,'Officer','Officer','2016-02-12 16:58:52',0);

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

insert  into `master_jenis_simpanan`(`kode_jenis_simpanan`,`nama_simpanan`,`keterangan`,`nominal`,`create_timestamp`,`hapus`,`prioritas`) values (1,'Simpanan Pokok','Simpanan Pokok',100000.00,'2015-12-14 18:18:12',0,1),(2,'Simpanan Wajib','Simpanan Wajib',100000.00,'2015-12-14 18:18:23',0,2),(3,'Simpanan Sukarela','Simpanan Sukarela',0.00,'2015-12-14 18:18:35',0,0),(4,'Simpanan Exclusive','Simpanan Exclusive',200000.00,'2016-01-31 20:44:03',0,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian` */

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian_detail` */

/*Table structure for table `resign` */

DROP TABLE IF EXISTS `resign`;

CREATE TABLE `resign` (
  `NoPengunduranDiri` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(255) DEFAULT '',
  `TglResign` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Keterangan` varchar(255) DEFAULT '',
  `status` tinyint(1) DEFAULT '0' COMMENT '0 = Belum penarikan ,1 = sudah',
  PRIMARY KEY (`NoPengunduranDiri`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `resign` */

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
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

/*Data for the table `stok_barang` */

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `order_id` int(11) NOT NULL,
  `order_detail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_master_id` varchar(255) NOT NULL COMMENT 'kode barang,0 = >pph',
  `qty` int(11) DEFAULT NULL,
  `buying_price` decimal(20,2) DEFAULT NULL,
  `selling_price` decimal(20,2) DEFAULT NULL COMMENT 'harga satuan,bila order_master_id 0 .selling_price berarti %',
  `sub_total` decimal(20,2) DEFAULT NULL COMMENT '@ x Qty',
  `order_detail_status` enum('active','delete') DEFAULT 'active',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`order_detail_id`,`order_master_id`),
  KEY `order_detail_id` (`order_detail_id`),
  KEY `order_master_id` (`order_master_id`),
  CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `transaksi` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaksi_pinjaman` */

/*Table structure for table `transaksi_simpanan` */

DROP TABLE IF EXISTS `transaksi_simpanan`;

CREATE TABLE `transaksi_simpanan` (
  `kode_simpanan` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` int(11) DEFAULT NULL,
  `total_simpanan` decimal(20,2) DEFAULT '0.00',
  `created_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_simpanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaksi_simpanan` */

/*Table structure for table `transaksi_simpanan_detail` */

DROP TABLE IF EXISTS `transaksi_simpanan_detail`;

CREATE TABLE `transaksi_simpanan_detail` (
  `kode_simpanan_detail` int(11) NOT NULL AUTO_INCREMENT,
  `kode_simpanan` int(11) DEFAULT NULL,
  `kode_jenis_simpanan` int(11) DEFAULT NULL,
  `jumlah_simpanan` decimal(20,2) DEFAULT '0.00',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_simpanan_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaksi_simpanan_detail` */

/*Table structure for table `upload_file_opname` */

DROP TABLE IF EXISTS `upload_file_opname`;

CREATE TABLE `upload_file_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(255) DEFAULT NULL,
  `insert_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `upload_file_opname` */

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

insert  into `user`(`account_id`,`nama`,`email`,`password`,`keterangan`,`id_menu`,`lastlogin`,`regdate`,`status`,`hapus`) values (7,'Samuels','sam@gmail.comsss','6894e45cd6c8b887f52ae3b59d8f15dc','root','1,2,4,5,6,7,8,9,10,11,12,13,14','2015-12-27 02:27:26','2015-10-15 04:42:41',1,0),(8,'Admin','admin@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','admin','1,2,3,4,5,6,7,8,9,10,11,12,13,14','2016-02-12 03:16:45','2015-10-15 04:42:41',1,0),(9,'sam','sam@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','admin',NULL,NULL,'2015-12-26 12:23:51',0,1),(10,'samuel erwardi','0','6894e45cd6c8b887f52ae3b59d8f15dc','',NULL,NULL,'2015-12-27 01:33:24',1,1),(11,'asdasdadsas','admin@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','root','1,2,4,5,6,7,8,9,10,11,12,13,14','2016-02-12 03:16:45','2015-12-27 02:06:44',1,0),(12,'xcv','admin@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','root','1,2,4,5,6,7,8,9,10,11,12,13,14','2016-02-12 03:16:45','2015-12-27 02:09:44',1,0),(13,'sami','sami@gmail.com','202cb962ac59075b964b07152d234b70','admin','1,2,4,5,6,7,8,9,10,11,12,13,14',NULL,'2015-12-27 02:15:48',1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
