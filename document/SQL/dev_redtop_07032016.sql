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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cicilan` */

insert  into `cicilan`(`cicilan_id`,`angsuran_ke`,`order_id`,`no_anggota`,`jumlah`,`total_pinjaman`,`bunga`,`cicilan_perbulan`,`status`,`keterangan`,`insert_timestamp`,`jatuh_tempo`,`update_timestamp`) values (1,1,1,1,500000.00,510000.00,10000.00,510000.00,'lunas','transaksi_pinjaman','2016-03-02 16:33:56','2016-04-25','2016-03-02 10:34:20');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8;

/*Data for the table `master_anggota` */

insert  into `master_anggota`(`no_anggota`,`nik`,`nama`,`departemen`,`jabatan`,`alamat`,`no_telpon`,`no_rekening`,`created_time`,`hapus`) values (1,'95070331','Sri Kurniawati ',1,1,NULL,NULL,'58901','2016-02-13 07:12:24',0),(2,'09076931','Ady Fitriadi',2,2,NULL,NULL,'58901','2016-02-13 07:12:24',0),(3,'04023715','Andriansyah',2,3,NULL,NULL,'58901','2016-02-13 07:12:24',0),(4,'11068311','Fifi Kusuma Dewi',2,4,NULL,NULL,'58901','2016-02-13 07:12:24',0),(5,'12109441','Nita Apriani',2,5,NULL,NULL,'58901','2016-02-13 07:12:24',0),(6,'13099991','Safikurrohman',2,6,NULL,NULL,'58901','2016-02-13 07:12:24',0),(7,'14030721','Trisno',2,7,NULL,NULL,'58901','2016-02-13 07:12:24',0),(8,'06014806','Aan Kayan',3,8,NULL,NULL,'58901','2016-02-13 07:12:24',0),(9,'96101166','Agus',3,9,NULL,NULL,'58901','2016-02-13 07:12:24',0),(10,'05014236','Asep Saprudin',3,10,NULL,NULL,'58901','2016-02-13 07:12:24',0),(11,'99112046','Bambang ',3,11,NULL,NULL,'58901','2016-02-13 07:12:24',0),(12,'09087076','Dwi Prihatno',3,12,NULL,NULL,'58901','2016-02-13 07:12:24',0),(13,'04104096','Ervin Rasilani',3,13,NULL,NULL,'58901','2016-02-13 07:12:24',0),(14,'06014796','Guntur Prabowo',3,8,NULL,NULL,'58901','2016-02-13 07:12:24',0),(15,'09076896','Irwan',3,9,NULL,NULL,'58901','2016-02-13 07:12:24',0),(16,'13029646','Junjungan Tambunan',3,14,NULL,NULL,'58901','2016-02-13 07:12:24',0),(17,'09087046','Sahrudin bin Maftuh',3,14,NULL,NULL,'58901','2016-02-13 07:12:24',0),(18,'95120936','Sirmawan',3,11,NULL,NULL,'58901','2016-02-13 07:12:24',0),(19,'07035366','Siswanto',3,15,NULL,NULL,'58901','2016-02-13 07:12:24',0),(20,'97111476','Sugyono',3,16,NULL,NULL,'58901','2016-02-13 07:12:24',0),(21,'05014216','Sukiyanto',3,14,NULL,NULL,'58901','2016-02-13 07:12:24',0),(22,'10077776','Sunari',3,9,NULL,NULL,'58901','2016-02-13 07:12:24',0),(23,'99112036','Supoyo',3,11,NULL,NULL,'58901','2016-02-13 07:12:24',0),(24,'97111466','Suyono',3,9,NULL,NULL,'58901','2016-02-13 07:12:24',0),(25,'97031339','J. Jacob Sitanggang',4,17,NULL,NULL,'58901','2016-02-13 07:12:24',0),(26,'97031319','Rahardjo',4,17,NULL,NULL,'58901','2016-02-13 07:12:24',0),(27,'13099979','Randy Fadilah',4,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(28,'01052599','Sobirin HR',4,19,NULL,NULL,'58901','2016-02-13 07:12:24',0),(29,'97081389','Thalib MP Manihiya',4,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(30,'95070489','Badol Saragi',5,19,NULL,NULL,'58901','2016-02-13 07:12:24',0),(31,'97031329','Gatot Agung Imansyah',5,17,NULL,NULL,'58901','2016-02-13 07:12:24',0),(32,'13110149','Irsan Daulay',5,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(33,'95070424','Leonardo Davinci',5,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(34,'97021289','M. Herman Hakim',5,21,NULL,NULL,'58901','2016-02-13 07:12:24',0),(35,'10017329','Muhamad Zackyansyah',5,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(36,'05064499','Nurdin',5,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(37,'03023111','Satria',5,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(38,'95070629','Subarini',5,19,NULL,NULL,'58901','2016-02-13 07:12:24',0),(39,'00022349','Supriyono',5,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(40,'01062679','Syarifudin (Gallery)',5,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(41,'97031349','Agustin Rina Astuti',6,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(42,'13089859','Amelia Octa Della',6,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(43,'12028769','Citra Wulandari',6,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(44,'15061649','Yudistira',6,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(45,'13110179','Ardiansyah Iskandar',7,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(46,'00022339','Mulyadi',7,17,NULL,NULL,'58901','2016-02-13 07:12:24',0),(47,'12109419','Riswanto',7,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(48,'96091119','Agus Hermawan',8,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(49,'97031309','Bahrudin',8,17,NULL,NULL,'58901','2016-02-13 07:12:24',0),(50,'03093439','Hari Sugeng Kurnianto',8,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(51,'95070119','Izmi',8,19,NULL,NULL,'58901','2016-02-13 07:12:24',0),(52,'13120389','Muhammad Fahrizal',8,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(53,'04073999','Supriadi (O CafŽ)',8,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(54,'11128589','Yola Nivi Astriyani',8,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(55,'95070319','Yudi Herawadi',8,19,NULL,NULL,'58901','2016-02-13 07:12:24',0),(56,'97081399','Kusrini',9,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(57,'96091129','Ahyani',10,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(58,'04104069','S. Harriyono',10,19,NULL,NULL,'58901','2016-02-13 07:12:24',0),(59,'12018674','M. Subkhan',11,22,NULL,NULL,'58901','2016-02-13 07:12:24',0),(60,'12028744','Theresia Veronica Linogi',11,22,NULL,NULL,'58901','2016-02-13 07:12:24',0),(61,'10027364','A. Rifqi',12,23,NULL,NULL,'58901','2016-02-13 07:12:24',0),(62,'15061634','Bagus Gudiawan',12,24,NULL,NULL,'58901','2016-02-13 07:12:24',0),(63,'15091734','Bambang Wisono',12,23,NULL,NULL,'58901','2016-02-13 07:12:24',0),(64,'06065024','Dini Marianta Putri',12,23,NULL,NULL,'58901','2016-02-13 07:12:24',0),(65,'03093474','Dwini Setyowati',12,24,NULL,NULL,'58901','2016-02-13 07:12:24',0),(66,'13120364','Een Nuragina Meilasari',12,24,NULL,NULL,'58901','2016-02-13 07:12:24',0),(67,'14111304','Fara Nurfadila',12,25,NULL,NULL,'58901','2016-02-13 07:12:24',0),(68,'14020549','Fifi Kuryani',12,24,NULL,NULL,'58901','2016-02-13 07:12:24',0),(69,'15081724','Gusti Ngurah BWS',12,24,NULL,NULL,'58901','2016-02-13 07:12:24',0),(70,'08026204','Hosein Rahmat Ibrahim',12,26,NULL,NULL,'58901','2016-02-13 07:12:24',0),(71,'03063194','Ifik Rorowilis',12,23,NULL,NULL,'58901','2016-02-13 07:12:24',0),(72,'95060024','Rina Rakhmi',12,27,NULL,NULL,'58901','2016-02-13 07:12:24',0),(73,'13100084','Roksi Ricardo',12,24,NULL,NULL,'58901','2016-02-13 07:12:24',0),(74,'13120374','Yesicha Nur Sriati',12,25,NULL,NULL,'58901','2016-02-13 07:12:24',0),(75,'96020994','Erwinadi',13,17,NULL,NULL,'58901','2016-02-13 07:12:24',0),(76,'10057644','Ferry Setiawan ',13,28,NULL,NULL,'58901','2016-02-13 07:12:24',0),(77,'09016625','H. Abdul Hamid',13,28,NULL,NULL,'58901','2016-02-13 07:12:24',0),(78,'99101849','I Made Gde Suryadi',13,29,NULL,NULL,'58901','2016-02-13 07:12:24',0),(79,'05034315','Jakaria Gunawan',13,29,NULL,NULL,'58901','2016-02-13 07:12:24',0),(80,'97011244','Jamil',13,17,NULL,NULL,'58901','2016-02-13 07:12:24',0),(81,'01062689','Joko Susilo',13,30,NULL,NULL,'58901','2016-02-13 07:12:24',0),(82,'11038134','Matsani',13,28,NULL,NULL,'58901','2016-02-13 07:12:24',0),(83,'09127304','Redi Ramdhani',13,29,NULL,NULL,'58901','2016-02-13 07:12:24',0),(84,'10107894','Rudy Kurniawan',13,28,NULL,NULL,'58901','2016-02-13 07:12:24',0),(85,'00082499','Sammy Raflimy',13,29,NULL,NULL,'58901','2016-02-13 07:12:24',0),(86,'12119494','Supriyadi (28)',13,28,NULL,NULL,'58901','2016-02-13 07:12:24',0),(87,'95070454','Agus Sukmawijaya',14,31,NULL,NULL,'58901','2016-02-13 07:12:24',0),(88,'11038174','Amik Hari Priyanto',14,31,NULL,NULL,'58901','2016-02-13 07:12:24',0),(89,'02092994','Bonny Firmansyah',14,31,NULL,NULL,'58901','2016-02-13 07:12:24',0),(90,'14060964','Lusiani',14,31,NULL,NULL,'58901','2016-02-13 07:12:24',0),(91,'12109384','Fisty Helny Risnawati',15,32,NULL,NULL,'58901','2016-02-13 07:12:24',0),(92,'95070414','Agus Ridwan',16,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(93,'03073285','Agus Supriyanto',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(94,'04023735','Ahmad Sofyan',16,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(95,'12038915','Alhamdika R. Matari',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(96,'06075035','Budhi Waluyojati',16,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(97,'97021295','Dede Mulyadi',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(98,'03053175','Dodi Casmadi',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(99,'03083335','Dwi Riyantoko',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(100,'05014195','Eko Muliono',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(101,'05054445','Hafiz Sulaiman',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(102,'10128015','Hari Supriadi',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(103,'11048215','Hartono',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(104,'03053165','Hendra',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(105,'12129565','Hendy Pratama',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(106,'00052445','Heru Cahyono',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(107,'12099315','Irfan Maulana',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(108,'00122525','Irwan Krisnawan',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(109,'15081685','Jeffry',16,33,NULL,NULL,'58901','2016-02-13 07:12:24',0),(110,'06044925','Komarulloh',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(111,'10107885','M Firdaus Fahlevi',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(112,'01082735','M. Djufriadi',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(113,'96020975','Melita Padmanegara',16,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(114,'96121225','Nawawi',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(115,'07045435','Ni Made Sariani',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(116,'96020985','Norlia BR Manurung',16,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(117,'13079825','Nurhadi',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(118,'96031025','Prawoto',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(119,'95110885','Ratna Suminar',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(120,'02032885','Rian Purna Indrianto',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(121,'02072925','Sobari',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(122,'03053155','Srianto',16,34,NULL,NULL,'58901','2016-02-13 07:12:24',0),(123,'95080705','Sunarno',16,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(124,'04023725','Susamto',16,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(125,'95100795','Suwarno',16,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(126,'95070465','Taryuni',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(127,'14020585','Yatmin',16,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(128,'06024855','Zuwandi',16,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(129,'01062635','Andri Surawidjaya',17,35,NULL,NULL,'58901','2016-02-13 07:12:24',0),(130,'99071521','Inayah',17,36,NULL,NULL,'58901','2016-02-13 07:12:24',0),(131,'15091773','K. Alice Irangani',17,37,NULL,NULL,'58901','2016-02-13 07:12:24',0),(132,'95070374','Mustopha',17,38,NULL,NULL,'58901','2016-02-13 07:12:24',0),(133,'04073983','Tedy Rinaldy',17,39,NULL,NULL,'58901','2016-02-13 07:12:24',0),(134,'05094583','Yulindah Nawangtyas',17,36,NULL,NULL,'58901','2016-02-13 07:12:24',0),(135,'99101758','Maryati',18,40,NULL,NULL,'58901','2016-02-13 07:12:24',0),(136,'95120918','Wahyudi Winarso',18,41,NULL,NULL,'58901','2016-02-13 07:12:24',0),(137,'95070278','Azwar Hamzah',19,42,NULL,NULL,'58901','2016-02-13 07:12:24',0),(138,'14030708','Nakam',19,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(139,'96031058','Sugiyanto',19,44,NULL,NULL,'58901','2016-02-13 07:12:24',0),(140,'10107908','Tono',19,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(141,'04043818','Zaenal Mutaqin',19,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(142,'95110858','Agus Bahtiar',20,44,NULL,NULL,'58901','2016-02-13 07:12:24',0),(143,'95120928','Dasep Supriatna',20,42,NULL,NULL,'58901','2016-02-13 07:12:24',0),(144,'05124718','Muslihat',20,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(145,'99091568','Yusuf Bara Laluhangga',20,47,NULL,NULL,'58901','2016-02-13 07:12:24',0),(146,'95080678','Agus Mulyadi',21,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(147,'95070268','Ceky Kuncoro',21,42,NULL,NULL,'58901','2016-02-13 07:12:24',0),(148,'00052458','Dede Wahyudi',21,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(149,'99091628','Edelhard Soedira',21,44,NULL,NULL,'58901','2016-02-13 07:12:24',0),(150,'02022868','Isnanto',21,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(151,'15102048','Jainal Arifin',21,42,NULL,NULL,'58901','2016-02-13 07:12:24',0),(152,'95070188','Setiyayadi',21,48,NULL,NULL,'58901','2016-02-13 07:12:24',0),(153,'01092768','Syarifudin (Kitchen)',21,44,NULL,NULL,'58901','2016-02-13 07:12:24',0),(154,'05124708','Yanuar Setiawan',21,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(155,'14050868','Adi Priyanto',22,49,NULL,NULL,'58901','2016-02-13 07:12:24',0),(156,'99112108','Agus Siswanto',22,49,NULL,NULL,'58901','2016-02-13 07:12:24',0),(157,'14091218','FX Bayu Adhi Nu25ho',22,50,NULL,NULL,'58901','2016-02-13 07:12:24',0),(158,'95100828','Hari Sutopo',22,51,NULL,NULL,'58901','2016-02-13 07:12:24',0),(159,'99112118','Moch Arifin Anwar',22,52,NULL,NULL,'58901','2016-02-13 07:12:24',0),(160,'09026678','Rusli Widayat',22,52,NULL,NULL,'58901','2016-02-13 07:12:24',0),(161,'95100788','Sudono Suharyanto',22,53,NULL,NULL,'58901','2016-02-13 07:12:24',0),(162,'09107148','Sudrajat',22,54,NULL,NULL,'58901','2016-02-13 07:12:24',0),(163,'95070578','Sutrisno',22,52,NULL,NULL,'58901','2016-02-13 07:12:24',0),(164,'95070558','Suwandi',22,55,NULL,NULL,'58901','2016-02-13 07:12:24',0),(165,'09127248','Yopi Bayu Heryanto',22,53,NULL,NULL,'58901','2016-02-13 07:12:24',0),(166,'04013648','Guntur Gunawan',23,42,NULL,NULL,'58901','2016-02-13 07:12:24',0),(167,'12109438','Rohman Sujana',23,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(168,'99122228','Sade Rusyana',23,43,NULL,NULL,'58901','2016-02-13 07:12:24',0),(169,'08016148','Faisal',24,56,NULL,NULL,'58901','2016-02-13 07:12:24',0),(170,'02022858','Farizal Andriawan',24,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(171,'99101839','Herry Heryanto Supantoro',24,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(172,'99122238','Ishak Kurniawan',24,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(173,'96071108','M. Muslih',24,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(174,'95070258','M. Syah',24,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(175,'99101675','R. Budi Wibisono',24,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(176,'13100018','Rinto Tampubolon',24,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(177,'95070497','Saidi',24,56,NULL,NULL,'58901','2016-02-13 07:12:24',0),(178,'99112148','Subanar',24,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(179,'01042578','Suparman',24,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(180,'99112128','Warsono',24,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(181,'99101685','Benny Mustika Alam',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(182,'00042415','Deniawan',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(183,'04053865','Dery Octavian',25,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(184,'06014829','Dewi Priatni',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(185,'11048235','Herman Susilo',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(186,'10037465','Iwan Agus Setiawan',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(187,'99101944','M Rizki P Ariwibowo',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(188,'99101859','Rista Meliana',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(189,'03083365','Riwanto',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(190,'00042405','Rodean Dermawan',25,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(191,'99101705','Ronny',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(192,'00032385','Yayat Sufriyatna',25,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(193,'00012315','Yuli Wahyudin',25,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(194,'11108469','Herti Mulyasari',26,18,NULL,NULL,'58901','2016-02-13 07:12:24',0),(195,'15091742','Muhamad Imron',26,57,NULL,NULL,'58901','2016-02-13 07:12:24',0),(196,'97111502','Siti Solikhah',26,58,NULL,NULL,'58901','2016-02-13 07:12:24',0),(197,'15081662','Virginia Sabrina Ayurianty',26,58,NULL,NULL,'58901','2016-02-13 07:12:24',0),(198,'99112081','Wahyu Shandi Setiawan',26,59,NULL,NULL,'58901','2016-02-13 07:12:24',0),(199,'13069814','Citra Lusita',27,60,NULL,NULL,'58901','2016-02-13 07:12:24',0),(200,'09087017','Agus Lasadi',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(201,'99091617','Agustus MAM Djoka',28,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(202,'05104627','Dedi Junaedi',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(203,'99101737','Eddy Kurnianto',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(204,'05094577','Gusfinardi',28,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(205,'14040817','Harryman',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(206,'03073267','Joko Budiono',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(207,'10027357','Perdiansyah',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(208,'03083417','Ramsis E Pangaribuan',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(209,'99081537','Ranto Parluhutan',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(210,'96010967','Robby Sutikno',28,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(211,'11108457','Rudi Suhartono',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(212,'99101747','Sarina Damanik ',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(213,'03083427','Sunarto (28)',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(214,'05014257','Surasa',28,20,NULL,NULL,'58901','2016-02-13 07:12:24',0),(215,'01042587','Sutrisno',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(216,'02012847','Teguh Utomo',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0),(217,'06105147','Tri Mardianto',28,61,NULL,NULL,'58901','2016-02-13 07:12:24',0);

/*Table structure for table `master_barang` */

DROP TABLE IF EXISTS `master_barang`;

CREATE TABLE `master_barang` (
  `kode_barang` varchar(255) NOT NULL,
  `type` enum('product','jasa') DEFAULT 'product',
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

insert  into `master_barang`(`kode_barang`,`type`,`nama_barang`,`deskripsi`,`harga_beli`,`presentase`,`harga_jual`,`created_timestamp`,`status`,`hapus`) values ('0089686010015','jasa','Indomie Ayam Bawang','1850',450.00,2300,2750.00,'2016-02-13 16:57:49',1,0),('0089686010343','product','Indokie Soto Mie','',1850.00,450,2300.00,'2016-02-22 12:53:56',1,0),('0089686010527','product','Indomie Kari Ayam','',2100.00,400,2500.00,'2016-02-20 14:49:36',1,0),('0089686010947','product','Indomie Goreng','',1987.00,513,2500.00,'2016-02-13 16:04:33',1,0),('0089686060126','product','Pop Mie Rasa Baso','',3350.00,650,4000.00,'2016-02-13 16:07:52',1,0),('0089686060461','product','Pop Mie Kari Ayam','',3350.00,650,4000.00,'2016-02-13 16:08:21',1,0),('0711844120013','product','Sambal ABC','335ml',11000.00,2000,13000.00,'2016-02-15 13:14:35',1,0),('0711844120310','product','Saos sambel ABC sachet','',5500.00,1500,7000.00,'2016-02-19 14:48:32',1,0),('0711844330115','product','ABC Sarden ','',13900.00,4100,18000.00,'2016-02-13 16:46:39',1,0),('0749921006158','product','Nutri Sari Jambu','',910.00,590,1500.00,'2016-02-13 16:15:27',1,0),('4800361347655','product','Lactogrow 3','Usia 1-3',84000.00,4000,88000.00,'2016-02-15 13:18:08',1,0),('4902430400947','product','Shampo Pantene','Anti Dandruff 170ml',21000.00,1000,22000.00,'2016-02-13 16:21:45',1,0),('4902430610599','product','Pampers Premium Care','XL isi 21',85000.00,3000,88000.00,'2016-02-18 17:37:39',1,0),('76164217','product','Marlboro Merah','',17500.00,2500,20000.00,'2016-02-13 15:17:50',1,0),('7622210476043','product','Chips Ahoy','cookies',7000.00,1500,8500.00,'2016-02-21 19:25:56',1,0),('76239878','product','Marlboro Putih','',17500.00,2500,20000.00,'2016-02-13 15:46:05',1,0),('8886001038011','product','Beng beng 22gr','',1300.00,700,2000.00,'2016-02-13 15:33:48',1,0),('8886007811076','product','Teh Celup Sosro','',4000.00,500,4500.00,'2016-02-20 15:19:53',1,0),('8886008101053','product','Aqua 600ml','',1700.00,1300,3000.00,'2016-02-19 14:58:43',1,0),('8888166330306','product','biskuit lemonia','lemon',5500.00,1500,7000.00,'2016-02-21 19:22:09',1,0),('8888166336568','product','crispy crackers','nissin',7000.00,2000,9000.00,'2016-02-21 19:16:44',1,0),('8888166336605','product','wafer nissin','chocolate',7000.00,1500,8500.00,'2016-02-21 19:09:05',1,0),('8888166337305','product','wafer nissin','strawberry',7000.00,1500,8500.00,'2016-02-21 19:08:11',1,0),('8888166603240','product','cream biskuit coklat','serena',8000.00,2000,10000.00,'2016-02-21 19:02:25',1,0),('8888166607132','product','Khong Guan wafer','Classic',14000.00,1500,15500.00,'2016-02-21 18:43:51',1,0),('8888166609365','product','biskuit lemonia','chocolate',5500.00,1500,7000.00,'2016-02-21 19:21:09',1,0),('8888166842557','product','genji pie','monde',7000.00,1500,8500.00,'2016-02-21 19:05:40',1,0),('8888166989474','product','wafer nissin','susu',7000.00,1500,8500.00,'2016-02-21 19:07:08',1,0),('8888166991125','product','butter cookies','monde',13000.00,2000,15000.00,'2016-02-21 18:52:38',1,0),('8888166991484','product','biskuit mentega klapa','mentega klapa nissin',8500.00,1500,10000.00,'2016-02-21 19:13:04',1,0),('8888166991491','product','biskuit kopi susu','coffee milk nissin',8500.00,1500,10000.00,'2016-02-21 19:11:36',1,0),('8888166996083','product','biskuit klapa ijo','nissin',5500.00,1500,7000.00,'2016-02-21 18:57:19',1,0),('8990057882730','product','Bebelac 3','Rasa Madu 800gr',106500.00,3500,110000.00,'2016-02-18 17:34:49',1,0),('8990057882761','product','Bebelac 4','Rasa Vanila 800gr',98000.00,4000,102000.00,'2016-02-18 17:35:32',1,0),('8991001111289','product','silver queen','',5500.00,1000,6500.00,'2016-02-21 19:27:21',1,0),('8991001301017','product','meses ceres','',8750.00,1250,10000.00,'2016-02-21 19:19:51',1,0),('8991001770011','product','sandwich biskuit selamat','chocolate',9000.00,2000,11000.00,'2016-02-21 19:00:09',1,0),('8991002101630','product','ABC Kopi Susu','',900.00,600,1500.00,'2016-02-13 16:27:09',1,0),('8991002101746','product','ABC Mocca','',900.00,600,1500.00,'2016-02-15 13:16:25',1,0),('8991002103238','product','Good Day Mchn','Mochachino',930.00,570,1500.00,'2016-02-13 15:48:25',1,0),('8991002103764','product','Good Day Cpchn','Caphuchino',1300.00,700,2000.00,'2016-02-13 15:48:55',1,0),('8991002105423','product','Kopi kapal Api','Bubuk 165gr',10250.00,1750,12000.00,'2016-02-20 15:11:50',1,0),('8991002105430','product','Kopi Kapal Api','Bubuk 65gr',4500.00,1500,6000.00,'2016-02-20 15:13:09',1,0),('8991002105485','product','Kopi Kapal Api','Mix',833.00,417,1250.00,'2016-02-13 15:38:16',1,0),('8991002106321','product','Kopi Kapal Api','Less Sugar',850.00,400,1250.00,'2016-02-15 13:10:11',1,0),('8991002121010','product','Good Day Mchn','Botol 250 ml',4500.00,1500,6000.00,'2016-02-13 16:11:51',1,0),('8991102300322','product','Tango Wafer Coklat','',850.00,650,1500.00,'2016-02-13 16:14:16',1,0),('8991102300421','product','wafer tango','chocolate',9000.00,2000,11000.00,'2016-02-21 18:48:05',1,0),('8991102300520','product','Tango Wafer Vanilla','',850.00,650,1500.00,'2016-02-13 16:13:34',1,0),('8991102300544','product','wafer Tango','susu vanila',9000.00,2000,11000.00,'2016-02-21 18:46:49',1,0),('8991111152097','product','Listerine Green Tea','500ml',34000.00,3000,37000.00,'2016-02-15 12:58:08',1,0),('8991906101019','product','Djarum Super','',12650.00,2350,15000.00,'2016-02-13 15:41:57',1,0),('8991906101057','product','LA Light','',14000.00,3000,17000.00,'2016-02-20 16:05:43',1,0),('8991906101071','product','LA Menthol','',14000.00,3000,17000.00,'2016-02-20 16:06:05',1,0),('8991906101101','product','LA Ice','',14000.00,3000,17000.00,'2016-02-13 16:03:03',1,0),('8991906101316','product','Djarum Black Mild','',12000.00,3000,15000.00,'2016-02-13 15:43:25',1,0),('8991906101361','product','Djarum Super Mild','',14500.00,1500,16000.00,'2016-02-20 16:16:40',1,0),('8991906105758','product','LA Bold','',13700.00,1300,15000.00,'2016-02-18 11:59:59',1,0),('8991911101011','product','Envio mild','',11800.00,1200,13000.00,'2016-02-19 14:40:55',1,0),('8992222050203','product','Gatsby Super Hard','',6000.00,1000,7000.00,'2016-02-13 15:54:52',1,0),('8992222052993','product','Gatsby Hyper Solid','',6000.00,1000,7000.00,'2016-02-13 15:53:23',1,0),('8992304009181','product','Garnier Men','Turbo Light 50ml',13000.00,1000,14000.00,'2016-02-20 15:47:04',1,0),('8992628020152','product','Minyak Goreng ','Bimoli 2 lt',22000.00,1000,23000.00,'2016-02-13 15:59:13',1,0),('8992695110206','product','Panadol Merah','',650.00,350,1000.00,'2016-02-13 16:41:55',1,0),('8992696404441','product','Susu Beruang','',7000.00,1000,8000.00,'2016-02-13 15:37:09',1,0),('8992696407701','product','Dancow 3+','Rasa Vanila',78000.00,4000,82000.00,'2016-02-18 17:33:54',1,0),('8992696427006','product','Lactogen 4 Gold','',81000.00,4000,85000.00,'2016-02-19 10:58:45',1,0),('8992696427266','product','Datita 3-5','',75000.00,5000,80000.00,'2016-02-18 17:32:58',1,0),('8992696430204','product','Milo Sachet','',1250.00,250,1500.00,'2016-02-13 16:29:47',1,0),('8992725910332','product','Listerine Cool Mint','250ml',19900.00,2100,22000.00,'2016-02-13 16:53:36',1,0),('8992725910400','product','Listerine Cool Mint','Isi 80ml',7750.00,1250,9000.00,'2016-02-18 17:31:17',1,0),('8992727005111','product','Biore Mens ','Cool Oil 100gr',21000.00,1000,22000.00,'2016-02-20 15:45:44',1,0),('8992727005135','product','Biore Mens ','White Energy',21000.00,1000,22000.00,'2016-02-13 16:48:15',1,0),('8992727005302','product','Attack Jazz','',12900.00,3100,16000.00,'2016-02-13 16:45:54',1,0),('8992752116233','product','mizone ','apple guava',2750.00,1250,4000.00,'2016-02-19 17:04:25',1,0),('8992753031894','product','SKM Sachet Putih','',1100.00,400,1500.00,'2016-02-13 16:31:03',1,0),('8992753100101','product','SKM Gold','',12400.00,1100,13500.00,'2016-02-13 16:35:23',1,0),('8992753102204','product','SKM Coklat','',8500.00,500,9000.00,'2016-02-13 16:10:17',1,0),('8992753883707','product','Frisian Flag Karya','4-6 Rasa Madu 800gr',76000.00,4000,80000.00,'2016-02-18 17:36:40',1,0),('8992760221028','product','oreo','roll',6000.00,1500,7500.00,'2016-02-21 19:15:15',1,0),('8992761002015','product','Coca Cola','',3630.00,1370,5000.00,'2016-02-13 16:28:13',1,0),('8992761147020','product','Sprite 425ml','',3750.00,1250,5000.00,'2016-02-15 13:20:03',1,0),('8992761147037','product','Fanta','',3750.00,1250,5000.00,'2016-02-13 16:19:10',1,0),('8992761166038','product','Pulpy Orange','',4790.00,1210,6000.00,'2016-02-13 15:51:44',1,0),('8992765301008','product','Gillete Goal II','Kuning',4000.00,1000,5000.00,'2016-02-15 13:11:40',1,0),('8992858527308','product','Hydro Coco','',4000.00,1000,5000.00,'2016-02-13 15:34:14',1,0),('8992866110608','product','Cat Rambut','Bigen Black',15000.00,1000,16000.00,'2016-02-15 13:07:40',1,0),('8992866110639','product','Cat Rambut','Bigen Brown Black',15000.00,1000,16000.00,'2016-02-15 13:08:07',1,0),('8992933453119','product','Susu Jahe','',800.00,700,1500.00,'2016-02-13 16:09:17',1,0),('8993058000684','product','Extra Joss','',791.00,209,1000.00,'2016-02-13 15:31:18',1,0),('8993072123567','product','Kapas Kecantikan','',7900.00,1100,9000.00,'2016-02-13 16:47:24',1,0),('8993175537360','product','wafer nabati','chocolate',7500.00,1500,9000.00,'2016-02-21 18:55:48',1,0),('8993176110081','product','Minyak Kayu Putih Lang','Isi 30ml',7500.00,1000,8500.00,'2016-02-18 17:40:51',1,0),('8993189270284','product','Charm Body Fit','Isi 8',2750.00,1250,4000.00,'2016-02-13 15:50:44',1,0),('8993189272134','product','Mamy Poko Pants','Standard Ukuran M isi 34',54000.00,4000,58000.00,'2016-02-18 17:38:27',1,0),('8993189272165','product','Mamy Poko Pants XXL 24','celana',57000.00,4000,61000.00,'2016-02-19 11:01:05',1,0),('8993560025113','product','Sabun Dettol','70gr',3200.00,800,4000.00,'2016-02-15 12:59:50',1,0),('8993989311699','product','Class Mild','',14650.00,1350,16000.00,'2016-02-13 16:38:52',1,0),('8994171101289','product','Luwak White Cofee','',900.00,600,1500.00,'2016-02-13 16:06:33',1,0),('8994755030431','product','good time cookies','chocolate',6500.00,1500,8000.00,'2016-02-21 19:24:24',1,0),('8995078803078','product','U Mild','',11400.00,1600,13000.00,'2016-02-13 15:41:20',1,0),('8995177102058','product','Gulaku 1kg','',14500.00,1500,16000.00,'2016-02-15 13:05:53',1,0),('8995227500247','product','Larutan cap kaki tiga','Rasa Jambu Biji',4000.00,1000,5000.00,'2016-02-19 14:36:07',1,0),('8995227500278','product','Larutan cap kaki tiga','Rasa Leci',4000.00,1000,5000.00,'2016-02-19 14:35:02',1,0),('8996001302026','product','malkist roma','',4500.00,1500,6000.00,'2016-02-21 19:17:44',1,0),('8996001440049','product','Energen Coklat','',1060.00,440,1500.00,'2016-02-13 16:09:42',1,0),('8996001440124','product','Energen Vanila','',1060.00,440,1500.00,'2016-02-13 16:30:21',1,0),('8996001600146','product','Teh Pucuk','',2083.00,1917,4000.00,'2016-02-13 15:52:35',1,0),('8996001600221','product','Kopiko 78','',5000.00,1000,6000.00,'2016-02-13 16:11:20',1,0),('8996006142511','product','Teh Kotak','',2125.00,1875,4000.00,'2016-02-13 16:34:25',1,0),('8996006855145','product','Teh Botol','450ml',4500.00,1500,6000.00,'2016-02-13 15:36:39',1,0),('8997009510017','product','You C 1000 Lemon','',4333.00,1667,6000.00,'2016-02-13 17:05:52',1,0),('8997009510055','product','You C 1000 Org','',4333.00,1667,6000.00,'2016-02-13 16:33:02',1,0),('8997016910312','product','Minyak Goreng','Green Land 2 ltr',22000.00,1000,23000.00,'2016-02-13 15:15:05',1,0),('8997018460150','product','Marlboro Ice Blast','',17500.00,2500,20000.00,'2016-02-20 16:02:27',1,0),('8997021870014','product','Fresh Care Citrus','',9583.00,3417,13000.00,'2016-02-13 15:56:50',1,0),('8997021870151','product','Fresh Care Strong','',9583.00,3417,13000.00,'2016-02-13 15:57:20',1,0),('8997021870236','product','Fresh Care Sports','',9583.00,3417,13000.00,'2016-02-13 15:55:47',1,0),('8997035111110','product','Pocari Kaleng','',5000.00,500,5500.00,'2016-02-13 16:33:53',1,0),('8998009010231','product','Ultra Coklat','250ml',3500.00,1500,5000.00,'2016-02-13 16:23:22',1,0),('8998009010248','product','Ultra Strawberry','250 ml',3500.00,1500,5000.00,'2016-02-15 13:37:57',1,0),('8998009020179','product','Buahvita orange','',5400.00,1100,6500.00,'2016-02-19 14:30:35',1,0),('8998009020186','product','Buahvita guava','',5400.00,1100,6500.00,'2016-02-19 14:33:00',1,0),('8998009050053','product','Sari Kacang Ijo','250ml',3500.00,1500,5000.00,'2016-02-13 15:33:05',1,0),('8998009050060','product','Sari Kacang Ijo','200ml',2700.00,1300,4000.00,'2016-02-15 13:06:53',1,0),('8998127311173','product','Star Mild','',14750.00,1250,16000.00,'2016-02-13 15:45:39',1,0),('8998127514123','product','Dunhill Mild','',15750.00,2250,18000.00,'2016-02-13 16:01:15',1,0),('8998866200813','product','Mie Sedap Cup','Mie Goreng',3750.00,750,4500.00,'2016-02-15 13:03:12',1,0),('8998866600095','product','Sabun Clk Ekonomi','',1750.00,750,2500.00,'2016-02-15 13:01:11',1,0),('8998866603393','product','Rapika','',4500.00,1500,6000.00,'2016-02-15 12:56:09',1,0),('8998866607315','product','So Klin Softergent','',14000.00,1000,15000.00,'2016-02-13 16:36:19',1,0),('8998866679664','product','So Klin Lantai','Citrus Lemon',8000.00,1000,9000.00,'2016-02-20 15:26:26',1,0),('8998898101409','product','Tolak Angin Cair','',1958.00,1042,3000.00,'2016-02-13 15:35:24',1,0),('8998989100120','product','Gudang Garam Filter','Isi 12 batang',12300.00,2700,15000.00,'2016-02-13 15:42:47',1,0),('8998989110167','product','GG Surya 16','',15950.00,3050,19000.00,'2016-02-13 15:22:55',1,0),('8998989121163','product','Surya Pro Merah','',13700.00,1300,15000.00,'2016-02-13 15:21:21',1,0),('8998989300391','product','Surya Pro Mild','',10200.00,2800,13000.00,'2016-02-13 15:20:41',1,0),('8999908000200','product','Bodrex','',600.00,400,1000.00,'2016-02-13 16:42:31',1,0),('8999908057709','product','Bodrex Flu Batuk','',1750.00,250,2000.00,'2016-02-13 16:43:21',1,0),('8999909000162','product','Magnum Blue','',11950.00,2050,14000.00,'2016-02-13 15:39:58',1,0),('8999909000377','product','Sampoerna Evolution','',17100.00,1900,19000.00,'2016-02-18 17:29:36',1,0),('8999909001909','product','Magnum Black','',12200.00,1800,14000.00,'2016-02-15 13:05:23',1,0),('8999909010567','product','Dji Sam Soe 16','16 batang',15850.00,1150,17000.00,'2016-02-13 16:17:22',1,0),('8999909028234','product','Dji Sam Soe 12','12 batang',12975.00,1525,14500.00,'2016-02-13 15:18:47',1,0),('8999909028999','product','Dji Sam Soe ','Super Premium Reffil',15350.00,1650,17000.00,'2016-02-20 16:08:27',1,0),('8999909076006','product','Sampoerna Menthol','',15450.00,2550,18000.00,'2016-02-13 15:19:57',1,0),('8999909096004','product','Sampoerna Mild','Sampoerna Merah',16500.00,1500,18000.00,'2016-02-13 15:17:06',1,0),('8999988888811','product','Larutan cap kaki tiga','Rasa Orange',4000.00,1000,5000.00,'2016-02-20 15:29:25',1,0),('8999999001117','product','Lifebouy Total 10','250ml',11250.00,750,12000.00,'2016-02-13 16:40:55',1,0),('8999999001124','product','Lifebouy Mild Care','250ml',11250.00,750,12000.00,'2016-02-13 16:40:13',1,0),('8999999003098','product','Vaseline ','Intensive Care',23900.00,5100,29000.00,'2016-02-13 16:50:28',1,0),('8999999006006','product','Rinso Cair','',16000.00,2000,18000.00,'2016-02-20 15:25:19',1,0),('8999999029326','product','Shampo Sunsilk','Nourishing Soft & Smoot',16500.00,2000,18500.00,'2016-02-20 15:58:42',1,0),('8999999029357','product','Shampo Sunsilk ','Black Shine',16500.00,2000,18500.00,'2016-02-20 15:59:16',1,0),('8999999029616','product','Clear Ice Cool','',18500.00,2500,21000.00,'2016-02-13 15:50:10',1,0),('8999999029685','product','Clear Cmpl. Care','',18500.00,2500,21000.00,'2016-02-13 15:49:43',1,0),('8999999033170','product','Shampo Lifebouy','Hijau 170ml',12750.00,2250,15000.00,'2016-02-13 15:24:42',1,0),('8999999033217','product','Shampo Lifebouy','Biru 170ml',12750.00,2250,15000.00,'2016-02-13 15:24:03',1,0),('8999999034153','product','Blue Band 200gr','',5500.00,1500,7000.00,'2016-02-15 13:04:21',1,0),('8999999034696','product','Pond\'s Men','Energy Charge 100gr',21000.00,3000,24000.00,'2016-02-19 14:55:16',1,0),('8999999036607','product','Sabun Lux','Soft Touch 85gr',2500.00,500,3000.00,'2016-02-13 15:27:52',1,0),('8999999036638','product','Sabun Lux','Velvet Toiuch 85gr',2500.00,500,3000.00,'2016-02-13 15:27:20',1,0),('8999999038137','product','Buahvita sirsak','',5400.00,1100,6500.00,'2016-02-19 14:32:01',1,0),('8999999039110','product','Shampo Dove','Total Hair Fall Treatment',17750.00,2250,20000.00,'2016-02-18 17:42:07',1,0),('8999999039165','product','Shampo Dove','Total Damage Treatment',17750.00,2250,20000.00,'2016-02-18 17:42:46',1,0),('8999999044213','product','Zwitsal Baby Shampo','Aloe Vera, Kemiri, seledri',32400.00,1600,34000.00,'2016-02-15 13:02:24',1,0),('8999999045852','product','Sabun Lifebouy','Merah 75gr',2250.00,750,3000.00,'2016-02-13 15:29:04',1,0),('8999999045869','product','Sabun Lifebouy','Biru 75gr',2250.00,750,3000.00,'2016-02-13 15:28:35',1,0),('8999999049409','product','Rexona Men','',12000.00,2000,14000.00,'2016-02-13 15:36:01',1,0),('8999999049430','product','Rexona Men','V8 Kuning',12500.00,1500,14000.00,'2016-02-15 13:12:22',1,0),('8999999049454','product','Rexona Women','Free Spirit',12000.00,2000,14000.00,'2016-02-13 16:23:59',1,0),('8999999049508','product','Rexona Women','Shower Clean',12500.00,1500,14000.00,'2016-02-13 16:24:39',1,0),('8999999100506','product','Kecap Bango 600ml','',17750.00,1250,19000.00,'2016-02-13 16:25:56',1,0),('8999999195649','product','Teh Sari Wangi','',4250.00,750,5000.00,'2016-02-13 15:58:03',1,0),('8999999390198','product','Sunlight 800ml','',11500.00,1500,13000.00,'2016-02-13 16:12:40',1,0),('8999999401238','product','Rinso Anti Noda','900gr',14500.00,2500,17000.00,'2016-02-13 16:22:36',1,0),('8999999403188','product','Molto Pewangi','Blossom Pink',11500.00,2500,14000.00,'2016-02-13 17:01:07',1,0),('8999999406929','product','CIF Super Pell','',8750.00,1250,10000.00,'2016-02-13 17:07:21',1,0),('8999999407919','product','Wipol Karbol Wangi','',11500.00,1000,12500.00,'2016-02-20 15:27:40',1,0),('8999999706180','product','Pepsodent Family','190gr',7500.00,1500,9000.00,'2016-02-20 15:37:42',1,0),('8999999707835','product','Close Up Deep Action','',5100.00,1400,6500.00,'2016-02-20 15:39:13',1,0),('8999999710866','product','Pepsodent Herbal','190gr',13000.00,1000,14000.00,'2016-02-15 12:57:37',1,0),('8999999716998','product','Pond\"s oil control','',20250.00,1750,22000.00,'2016-02-19 14:53:57',1,0),('8999999717025','product','Pond\"s clear solutions','',20250.00,1750,22000.00,'2016-02-19 14:53:01',1,0),('8999999717094','product','pond\"s white beauty','100gr',20250.00,1750,22000.00,'2016-02-19 14:51:59',1,0),('8999999719418','product','Vaseline ','Healthy White ',24500.00,5500,30000.00,'2016-02-13 16:51:11',1,0),('9300830006472','product','AXE ','',27900.00,7100,35000.00,'2016-02-13 17:04:05',1,0),('9311931201208','product','Teh Tarik','',1350.00,150,1500.00,'2016-02-13 16:32:02',1,0),('95508788','product','Marlboro Bck Menthol','',17500.00,2500,20000.00,'2016-02-13 15:46:42',1,0),('Beras 001','product','Beras BMD','Isi 25Kg',260000.00,10000,270000.00,'2016-02-15 13:45:39',1,0),('Cotton 001','product','Cotton Buds','',600.00,400,1000.00,'2016-02-20 15:32:02',1,0),('gillette goal II001','product','Gillette goal','kuning',4500.00,500,5000.00,'2016-02-19 15:57:37',1,0),('GULA0001','product','Gula Lokal','1 KG ',13000.00,1000,14000.00,'2016-02-15 13:26:36',1,0),('Kaus 001','product','Kaus Kaki Dewasa','',5000.00,2000,7000.00,'2016-02-15 13:44:37',1,0),('Kaus 002','product','Stocking','',8000.00,1000,9000.00,'2016-02-15 13:44:57',1,0),('Kopi 001','product','Kopi Kapal Api Seduh','',1000.00,1000,2000.00,'2016-02-15 13:32:23',1,0),('Kopi 002','product','Kopi Indocafe Seduh','',2000.00,1000,3000.00,'2016-02-15 13:33:48',1,0),('Kopi 003','product','Kopi ABC Susu Seduh','',2000.00,1000,3000.00,'2016-02-15 13:34:07',1,0),('Kopi 004','product','Kopi ABC Moca Seduh','',2000.00,1000,3000.00,'2016-02-15 13:34:26',1,0),('Kopi 005','product','Kopi Luwak Seduh','',2000.00,1000,3000.00,'2016-02-15 13:35:26',1,0),('Kopi 006','product','Kopi Good Day Seduh','',2000.00,1000,3000.00,'2016-02-15 13:36:11',1,0),('Kopi 007','product','Kopi Cappuchino Seduh','',3000.00,1000,4000.00,'2016-02-15 13:37:00',1,0),('Kopi 008','product','Kopi Less Sugar Seduh','Kapal Api',2000.00,1000,3000.00,'2016-02-15 13:39:09',1,0),('Kopi 009','product','Susu Jahe Seduh','',2000.00,1000,3000.00,'2016-02-15 13:40:01',1,0),('Kopi 010','product','Energen seduh','',2000.00,1000,3000.00,'2016-02-15 13:40:52',1,0),('Kopi 011','product','Nutrisari Seduh','',2000.00,1000,3000.00,'2016-02-15 13:41:22',1,0),('Kopi 012','product','Milo Seduh','',2000.00,1000,3000.00,'2016-02-15 13:41:37',1,0),('Kopi 013','product','Teh Tarik Seduh','',2000.00,1000,3000.00,'2016-02-15 13:42:21',1,0),('Korek api001','product','korek api ','Tokai',1000.00,1000,2000.00,'2016-02-19 15:55:59',1,0),('mini wafer001','product','nitchi mini wafer','roll',1833.00,1167,3000.00,'2016-02-21 19:29:33',1,0),('Pelayanan1000','jasa','Pelayanan1000','Masak AIR',0.00,1000,1000.00,'2016-02-21 18:26:27',1,0),('permen0001','product','Mentos ','permen mentos per pcs ',200.00,50,250.00,'2016-02-22 17:08:45',1,0),('Snack 001','product','Kacang Kulit','',2500.00,500,3000.00,'2016-02-15 13:47:00',1,0),('Snack 002','product','Aneka Snack 1','',2500.00,500,3000.00,'2016-02-15 13:47:49',1,0),('Snack 003','product','Aneka Snack 2','',800.00,200,1000.00,'2016-02-15 13:48:29',1,0),('Snack 004','product','Kerupuk ','',800.00,200,1000.00,'2016-02-15 13:48:58',1,0),('Snack 005','product','Permen Relaxa','',165.00,85,250.00,'2016-02-15 13:50:16',1,0),('Tisue 001','product','Paseo 50sht','',1500.00,500,2000.00,'2016-02-15 13:43:09',1,0),('Tisue 002','product','Paseo 250sht','',7000.00,3000,10000.00,'2016-02-15 13:43:39',1,0),('yalkul001','product','yakul','',1500.00,500,2000.00,'2016-02-19 14:28:00',1,0);

/*Table structure for table `master_barang_log` */

DROP TABLE IF EXISTS `master_barang_log`;

CREATE TABLE `master_barang_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) DEFAULT NULL,
  `type` enum('product','jasa') DEFAULT 'product',
  `nama_barang` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `harga_beli` decimal(20,2) DEFAULT '0.00',
  `presentase` int(20) DEFAULT '0',
  `harga_jual` decimal(20,2) DEFAULT '0.00',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '0',
  `hapus` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Jika 1 = DELETE',
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`hapus`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `master_barang_log` */

insert  into `master_barang_log`(`id`,`kode_barang`,`type`,`nama_barang`,`deskripsi`,`harga_beli`,`presentase`,`harga_jual`,`created_timestamp`,`status`,`hapus`,`account_id`) values (12,'Pelayanan1000','jasa','Pelayanan1000','Masak AIR',0.00,1000,1000.00,'2016-02-21 18:26:27',1,0,7),(13,'0089686010015','product','Indomie Ayam Bawang','',1850.00,450,2300.00,'2016-02-13 16:57:49',1,0,7),(14,'0089686010015','','sasd','1850',450.00,2300,1.00,'2016-02-13 16:57:49',0,0,7),(15,'0089686010015','','sasd','1850',450.00,2300,1.00,'2016-02-13 16:57:49',0,0,7),(16,'0089686010015','product','Indomie Ayam Bawang','1850',450.00,2300,2750.00,'2016-02-13 16:57:49',1,0,7);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `master_jenis_simpanan` */

insert  into `master_jenis_simpanan`(`kode_jenis_simpanan`,`nama_simpanan`,`keterangan`,`nominal`,`create_timestamp`,`hapus`,`prioritas`) values (1,'Simpanan Pokok','Simpanan Pokok',100000.00,'2015-12-14 18:18:12',0,1),(2,'Simpanan Wajib','Simpanan Wajib',100000.00,'2015-12-14 18:18:23',0,2),(3,'Simpanan Sukarela','Simpanan Sukarela',0.00,'2015-12-14 18:18:35',0,0),(4,'Simpanan Exclusive','Simpanan Exclusive',200000.00,'2016-01-31 20:44:03',0,0),(5,'Simpanan Awal','Simpanan Awal',0.00,'2016-02-13 08:18:13',0,9);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `master_supplier` */

insert  into `master_supplier`(`kode_supplier`,`nama_supplier`,`email`,`alamat`,`no_telfon`,`hapus`) values (1,'Toko Johan','johan@yahoo.com','Jl. Kingkit','0213806945',0),(2,'Toko Susu Thoriq','thoriq@yahoo.com','Jl. Angsana Pejaten','081586637223',0),(3,'Toko Susu Kadung Sayang','kadung@yahoo.com','Jl. Jati Padang Raya No. 55A','085888486729',0),(4,'Toko Syifa Gas','syifa@yahoo.com','Jl. Ceylon','083786728217',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian` */

insert  into `pembelian`(`order_id`,`kode_supplier`,`account_id`,`order_timestamp`,`status_timestamp`,`arrive_timestamp`,`ppn`,`transaksi_noppn`,`total_transaksi`,`currency`,`payment_status`,`status`) values (1,1,7,'2016-02-28 06:22:43','2016-03-06',NULL,1.00,0.00,0.00,'IDR','lunas','approve'),(2,1,7,'2016-03-28 06:23:07',NULL,NULL,1.00,40200.00,40602.00,'IDR','lunas','pending'),(3,3,7,'2016-01-28 06:23:26','2016-03-06',NULL,0.00,0.00,0.00,'IDR','lunas','approve'),(4,2,7,'2016-03-07 00:07:57','2016-03-06','0000-00-00',1.00,0.00,0.00,'IDR','lunas','delivered'),(5,1,7,'2016-03-07 00:17:03','2016-03-06','0000-00-00',1.00,850000.00,858500.00,'IDR','lunas','delivered'),(6,1,7,'2016-03-07 00:19:31','2016-03-06','0000-00-00',1.00,125400.00,126654.00,'IDR','lunas','delivered');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian_detail` */

insert  into `pembelian_detail`(`order_id`,`order_detail_id`,`order_master_id`,`qty`,`buying_price`,`sub_total`,`order_detail_status`,`created_timestamp`) values (4,8,NULL,NULL,NULL,NULL,'active','2016-03-07 00:15:44'),(5,10,'8888166991491',100,8500.00,850000.00,'active','2016-03-07 00:17:28'),(6,12,'8995078803078',11,11400.00,125400.00,'active','2016-03-07 00:21:06');

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
  `status` enum('barangmasuk','barangkeluar','opname') NOT NULL DEFAULT 'opname',
  `keterangan` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_stok`),
  KEY `kode_barang` (`kode_barang`),
  KEY `order_detail_id` (`order_id_penjualan`),
  KEY `stok_barang_ibfk_3` (`order_id_pembelian`),
  CONSTRAINT `stok_barang_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

/*Data for the table `stok_barang` */

insert  into `stok_barang`(`id_stok`,`kode_barang`,`order_id_penjualan`,`order_id_pembelian`,`qty`,`status`,`keterangan`,`timestamp`) values (1,'8991906101057',NULL,NULL,2,'opname','saldo_awal','2016-02-21 13:25:09'),(2,'8991906101071',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:25:30'),(3,'8991906101101',NULL,NULL,16,'opname','saldo_awal','2016-02-21 13:25:54'),(4,'8991906105758',NULL,NULL,7,'opname','saldo_awal','2016-02-21 13:26:33'),(5,'8999909010567',NULL,NULL,9,'opname','saldo_awal','2016-02-21 13:26:49'),(6,'8999909028234',NULL,NULL,43,'opname','saldo_awal','2016-02-21 13:27:02'),(7,'8999909028999',NULL,NULL,13,'opname','saldo_awal','2016-02-21 13:27:18'),(8,'76164217',NULL,NULL,26,'opname','saldo_awal','2016-02-21 13:27:34'),(9,'76239878',NULL,NULL,30,'opname','saldo_awal','2016-02-21 13:27:53'),(10,'95508788',NULL,NULL,21,'opname','saldo_awal','2016-02-21 13:28:06'),(11,'8991906101019',NULL,NULL,25,'opname','saldo_awal','2016-02-21 13:28:36'),(12,'8991906101316',NULL,NULL,4,'opname','saldo_awal','2016-02-21 13:28:54'),(13,'8999909096004',NULL,NULL,45,'opname','saldo_awal','2016-02-21 13:28:57'),(14,'8993989311699',NULL,NULL,30,'opname','saldo_awal','2016-02-21 13:29:39'),(15,'8998127311173',NULL,NULL,6,'opname','saldo_awal','2016-02-21 13:29:55'),(16,'8995078803078',NULL,NULL,34,'opname','saldo_awal','2016-02-21 13:30:11'),(17,'8998989300391',NULL,NULL,31,'opname','saldo_awal','2016-02-21 13:30:31'),(18,'8998989121163',NULL,NULL,19,'opname','saldo_awal','2016-02-21 13:31:22'),(19,'8999909076006',NULL,NULL,41,'opname','saldo_awal','2016-02-21 13:32:43'),(20,'8999909000377',NULL,NULL,10,'opname','saldo_awal','2016-02-21 13:33:05'),(21,'8998989110167',NULL,NULL,12,'opname','saldo_awal','2016-02-21 13:34:22'),(22,'8998989100120',NULL,NULL,46,'opname','saldo_awal','2016-02-21 13:37:22'),(23,'8991911101011',NULL,NULL,9,'opname','saldo_awal','2016-02-21 13:37:37'),(24,'8999909000162',NULL,NULL,27,'opname','saldo_awal','2016-02-21 13:37:50'),(25,'8999909001909',NULL,NULL,32,'opname','saldo_awal','2016-02-21 13:38:09'),(26,'8998127514123',NULL,NULL,12,'opname','saldo_awal','2016-02-21 13:38:22'),(27,'8997018460150',NULL,NULL,6,'opname','saldo_awal','2016-02-21 13:38:44'),(28,'8998898101409',NULL,NULL,41,'opname','saldo_awal','2016-02-21 13:39:07'),(29,'8993058000684',NULL,NULL,12,'opname','saldo_awal','2016-02-21 13:40:03'),(30,'8992765301008',NULL,NULL,3,'opname','saldo_awal','2016-02-21 13:43:21'),(31,'gillette goal II001',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:43:43'),(32,'Korek api001',NULL,NULL,29,'opname','saldo_awal','2016-02-21 13:45:47'),(33,'8992222052993',NULL,NULL,4,'opname','saldo_awal','2016-02-21 13:47:22'),(34,'8992222050203',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:47:38'),(35,'8992866110608',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:48:50'),(36,'8992866110639',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:49:01'),(37,'9300830006472',NULL,NULL,2,'opname','saldo_awal','2016-02-21 13:49:19'),(38,'8997021870014',NULL,NULL,2,'opname','saldo_awal','2016-02-21 13:49:33'),(39,'8997021870236',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:49:47'),(40,'8999999045869',NULL,NULL,24,'opname','saldo_awal','2016-02-21 13:51:37'),(41,'8999999045852',NULL,NULL,10,'opname','saldo_awal','2016-02-21 13:51:49'),(42,'8999999036607',NULL,NULL,13,'opname','saldo_awal','2016-02-21 13:52:12'),(43,'8999999036638',NULL,NULL,6,'opname','saldo_awal','2016-02-21 13:52:24'),(44,'8993560025113',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:52:45'),(45,'8993176110081',NULL,NULL,3,'opname','saldo_awal','2016-02-21 13:53:06'),(46,'8999999707835',NULL,NULL,5,'opname','saldo_awal','2016-02-21 13:53:35'),(47,'8999999710866',NULL,NULL,4,'opname','saldo_awal','2016-02-21 13:53:50'),(48,'8999999706180',NULL,NULL,8,'opname','saldo_awal','2016-02-21 13:54:06'),(49,'8992725910332',NULL,NULL,2,'opname','saldo_awal','2016-02-21 13:54:23'),(50,'8992725910400',NULL,NULL,3,'opname','saldo_awal','2016-02-21 13:54:34'),(51,'8991111152097',NULL,NULL,2,'opname','saldo_awal','2016-02-21 13:54:52'),(52,'4902430400947',NULL,NULL,4,'opname','saldo_awal','2016-02-21 13:55:07'),(53,'8999999034696',NULL,NULL,5,'opname','saldo_awal','2016-02-21 13:55:33'),(54,'8992727005135',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:55:51'),(55,'8992727005111',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:56:36'),(56,'8992304009181',NULL,NULL,2,'opname','saldo_awal','2016-02-21 13:56:48'),(57,'8999999717094',NULL,NULL,3,'opname','saldo_awal','2016-02-21 13:57:22'),(58,'8999999716998',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:57:33'),(59,'8999999717025',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:57:55'),(60,'8999999033170',NULL,NULL,2,'opname','saldo_awal','2016-02-21 13:58:40'),(61,'8999999033217',NULL,NULL,1,'opname','saldo_awal','2016-02-21 13:58:53'),(62,'8999999049409',NULL,NULL,5,'opname','saldo_awal','2016-02-21 14:00:13'),(63,'8999999049454',NULL,NULL,1,'opname','saldo_awal','2016-02-21 14:00:30'),(64,'8999999049508',NULL,NULL,6,'opname','saldo_awal','2016-02-21 14:02:38'),(65,'8999999029357',NULL,NULL,3,'opname','saldo_awal','2016-02-21 14:03:03'),(66,'8999999029326',NULL,NULL,1,'opname','saldo_awal','2016-02-21 14:03:22'),(67,'8999999029616',NULL,NULL,2,'opname','saldo_awal','2016-02-21 14:03:45'),(68,'8999999003098',NULL,NULL,1,'opname','saldo_awal','2016-02-21 14:04:00'),(69,'8999999039165',NULL,NULL,3,'opname','saldo_awal','2016-02-21 14:14:21'),(70,'8996001600146',NULL,NULL,1,'opname','saldo_awal','2016-02-21 14:15:01'),(71,'8992761166038',NULL,NULL,6,'opname','saldo_awal','2016-02-21 14:15:16'),(72,'8998009050060',NULL,NULL,24,'opname','saldo_awal','2016-02-21 14:53:28'),(73,'8998009010231',NULL,NULL,17,'opname','saldo_awal','2016-02-21 14:53:42'),(74,'8998009010248',NULL,NULL,37,'opname','saldo_awal','2016-02-21 14:53:57'),(75,'8995227500278',NULL,NULL,9,'opname','saldo_awal','2016-02-21 14:54:22'),(76,'8999988888811',NULL,NULL,7,'opname','saldo_awal','2016-02-21 14:54:39'),(77,'8998009020179',NULL,NULL,6,'opname','saldo_awal','2016-02-21 14:55:01'),(78,'8998009020186',NULL,NULL,6,'opname','saldo_awal','2016-02-21 14:55:19'),(79,'8999999038137',NULL,NULL,5,'opname','saldo_awal','2016-02-21 14:55:35'),(80,'yalkul001',NULL,NULL,24,'opname','saldo_awal','2016-02-21 14:55:53'),(81,'8992752116233',NULL,NULL,9,'opname','saldo_awal','2016-02-21 14:56:55'),(82,'8997009510055',NULL,NULL,12,'opname','saldo_awal','2016-02-21 15:00:03'),(83,'8997009510017',NULL,NULL,28,'opname','saldo_awal','2016-02-21 15:00:15'),(84,'8992858527308',NULL,NULL,35,'opname','saldo_awal','2016-02-21 15:00:39'),(85,'8996006855145',NULL,NULL,22,'opname','saldo_awal','2016-02-21 15:01:00'),(86,'8996001600221',NULL,NULL,9,'opname','saldo_awal','2016-02-21 15:01:19'),(87,'8991002121010',NULL,NULL,15,'opname','saldo_awal','2016-02-21 15:01:38'),(88,'8992696404441',NULL,NULL,27,'opname','saldo_awal','2016-02-21 15:01:56'),(89,'8997035111110',NULL,NULL,7,'opname','saldo_awal','2016-02-21 15:02:40'),(90,'8992761147037',NULL,NULL,16,'opname','saldo_awal','2016-02-21 15:03:11'),(91,'8992761002015',NULL,NULL,20,'opname','saldo_awal','2016-02-21 15:03:23'),(92,'8992761147020',NULL,NULL,18,'opname','saldo_awal','2016-02-21 15:03:35'),(93,'8886008101053',NULL,NULL,36,'opname','saldo_awal','2016-02-21 15:04:06'),(94,'GULA0001',NULL,NULL,11,'opname','saldo_awal','2016-02-21 15:05:18'),(95,'8995177102058',NULL,NULL,2,'opname','saldo_awal','2016-02-21 15:05:35'),(96,'8999999100506',NULL,NULL,3,'opname','saldo_awal','2016-02-21 15:05:41'),(97,'8991002105423',NULL,NULL,6,'opname','saldo_awal','2016-02-21 15:06:19'),(98,'8991002105430',NULL,NULL,2,'opname','saldo_awal','2016-02-21 15:06:30'),(99,'8992753100101',NULL,NULL,6,'opname','saldo_awal','2016-02-21 15:06:56'),(100,'8992753102204',NULL,NULL,19,'opname','saldo_awal','2016-02-21 15:07:05'),(101,'8999999034153',NULL,NULL,8,'opname','saldo_awal','2016-02-21 15:07:30'),(102,'0711844120013',NULL,NULL,2,'opname','saldo_awal','2016-02-21 15:07:43'),(103,'8999999195649',NULL,NULL,4,'opname','saldo_awal','2016-02-21 15:07:58'),(104,'8886007811076',NULL,NULL,3,'opname','saldo_awal','2016-02-21 15:08:13'),(105,'8998866200813',NULL,NULL,4,'opname','saldo_awal','2016-02-21 15:08:43'),(106,'0089686060461',NULL,NULL,3,'opname','saldo_awal','2016-02-21 15:08:54'),(107,'8999999390198',NULL,NULL,3,'opname','saldo_awal','2016-02-21 15:09:04'),(108,'8998866600095',NULL,NULL,1,'opname','saldo_awal','2016-02-21 15:09:16'),(109,'8998866603393',NULL,NULL,3,'opname','saldo_awal','2016-02-21 15:09:42'),(110,'8999999006006',NULL,NULL,1,'opname','saldo_awal','2016-02-21 15:09:54'),(111,'8998866679664',NULL,NULL,1,'opname','saldo_awal','2016-02-21 15:10:24'),(112,'8999999407919',NULL,NULL,4,'opname','saldo_awal','2016-02-21 15:10:36'),(113,'8999999001124',NULL,NULL,2,'opname','saldo_awal','2016-02-21 15:10:53'),(114,'8999999001117',NULL,NULL,2,'opname','saldo_awal','2016-02-21 15:11:10'),(115,'8993189270284',NULL,NULL,5,'opname','saldo_awal','2016-02-21 15:11:27'),(116,'Cotton 001',NULL,NULL,56,'opname','saldo_awal','2016-02-21 15:12:06'),(117,'8993072123567',NULL,NULL,1,'opname','saldo_awal','2016-02-21 15:12:17'),(118,'Kaus 001',NULL,NULL,20,'opname','saldo_awal','2016-02-21 15:12:31'),(119,'Kaus 002',NULL,NULL,9,'opname','saldo_awal','2016-02-21 15:12:43'),(120,'8992628020152',NULL,NULL,11,'opname','saldo_awal','2016-02-21 15:12:59'),(121,'8997016910312',NULL,NULL,1,'opname','saldo_awal','2016-02-21 15:13:12'),(122,'8998866607315',NULL,NULL,8,'opname','saldo_awal','2016-02-21 15:13:29'),(123,'8999999401238',NULL,NULL,7,'opname','saldo_awal','2016-02-21 15:13:53'),(124,'8886001038011',NULL,NULL,70,'opname','saldo_awal','2016-02-21 15:18:10'),(125,'0089686010947',NULL,NULL,83,'opname','saldo_awal','2016-02-21 15:18:36'),(126,'0089686010015',NULL,NULL,81,'opname','saldo_awal','2016-02-21 15:19:08'),(127,'0089686010527',NULL,NULL,74,'opname','saldo_awal','2016-02-21 15:19:24'),(128,'8991002105485',NULL,NULL,429,'opname','saldo_awal','2016-02-21 15:19:43'),(129,'8994171101289',NULL,NULL,203,'opname','saldo_awal','2016-02-21 15:19:56'),(130,'8992696430204',NULL,NULL,50,'opname','saldo_awal','2016-02-21 15:20:22'),(131,'8992753031894',NULL,NULL,13,'opname','saldo_awal','2016-02-21 15:20:45'),(132,'8992933453119',NULL,NULL,28,'opname','saldo_awal','2016-02-21 15:20:58'),(133,'8991002103238',NULL,NULL,17,'opname','saldo_awal','2016-02-21 15:22:11'),(134,'8991002101630',NULL,NULL,44,'opname','saldo_awal','2016-02-21 15:22:30'),(135,'8991002101746',NULL,NULL,48,'opname','saldo_awal','2016-02-21 15:22:43'),(136,'8991002106321',NULL,NULL,12,'opname','saldo_awal','2016-02-21 15:22:59'),(137,'8991002103764',NULL,NULL,5,'opname','saldo_awal','2016-02-21 15:23:14'),(138,'8996001440124',NULL,NULL,51,'opname','saldo_awal','2016-02-21 15:23:27'),(139,'8996001440049',NULL,NULL,45,'opname','saldo_awal','2016-02-21 15:23:40'),(140,'Beras 001',NULL,NULL,2,'opname','saldo_awal','2016-02-21 15:24:25'),(141,'Snack 004',NULL,NULL,28,'opname','saldo_awal','2016-02-21 15:24:39'),(142,'Snack 002',NULL,NULL,11,'opname','saldo_awal','2016-02-21 15:25:12'),(143,'Snack 003',NULL,NULL,15,'opname','saldo_awal','2016-02-21 15:25:29'),(144,'8991102300322',NULL,NULL,5,'opname','saldo_awal','2016-02-21 15:25:55'),(145,'8991102300520',NULL,NULL,9,'opname','saldo_awal','2016-02-21 15:26:50'),(146,'8993189272134',NULL,NULL,1,'opname','saldo_awal','2016-02-21 15:27:08'),(147,'4902430610599',NULL,NULL,1,'opname','saldo_awal','2016-02-21 15:27:23'),(148,'Snack 005',NULL,NULL,65,'opname','saldo_awal','2016-02-21 15:28:09'),(150,'permen0001',NULL,NULL,43,'opname','saldo_awal','2016-02-22 17:12:16'),(151,'8995227500247',NULL,NULL,6,'opname','saldo_awal','2016-02-22 18:23:48'),(152,'0089686010015',1,NULL,-10,'barangkeluar',NULL,'2016-02-28 06:19:01'),(153,'8995078803078',1,NULL,-10,'barangkeluar',NULL,'2016-02-28 06:19:01'),(154,'0711844120013',2,NULL,-1,'barangkeluar',NULL,'2016-02-28 06:20:03'),(155,'8993989311699',3,NULL,-10,'barangkeluar',NULL,'2016-02-28 06:20:37'),(156,'4902430400947',4,NULL,-1,'barangkeluar',NULL,'2016-02-28 06:21:01'),(157,'8886008101053',5,NULL,-10,'barangkeluar',NULL,'2016-02-28 06:21:39'),(159,'0089686010015',7,NULL,-1,'barangkeluar',NULL,'2016-03-01 20:42:58'),(160,'0089686010015',16,NULL,-11,'barangkeluar',NULL,'2016-03-01 22:01:43'),(161,'0089686010015',17,NULL,-10,'barangkeluar',NULL,'2016-03-01 22:06:05'),(162,'0711844120013',1,NULL,-1,'barangkeluar',NULL,'2016-03-06 23:35:13'),(163,'8995078803078',2,NULL,-1,'barangkeluar',NULL,'2016-03-06 23:35:43'),(164,'8995078803078',NULL,6,11,'barangmasuk',NULL,'2016-03-07 00:21:33');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `temp_stok_barang` */

insert  into `temp_stok_barang`(`id_stok`,`kode_barang`,`order_id_pembelian`,`qty`,`status`,`timestamp`) values (1,NULL,1,NULL,'barangmasuk','2016-03-07 00:06:49'),(2,NULL,3,NULL,'barangmasuk','2016-03-07 00:06:59');

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
  `payment_method` enum('cash','kredit') DEFAULT 'cash',
  `lama_cicilan` int(11) DEFAULT '0' COMMENT 'lama cicilan akan di looping ke table cicilan',
  PRIMARY KEY (`order_id`),
  KEY `account_id` (`account_id`),
  KEY `kode_customer` (`kode_customer`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `transaksi_pinjaman` */

insert  into `transaksi_pinjaman`(`id`,`pinjaman_id`,`no_anggota`,`jumlah_pinjaman`,`total_pinjaman`,`lama_cicilan`,`bunga`,`keterangan`,`status`,`time_created`) values (1,'PJ160001',1,500000.00,510000.00,1,10000.00,'asd','lunas','2016-03-02 16:33:56');

/*Table structure for table `transaksi_simpanan` */

DROP TABLE IF EXISTS `transaksi_simpanan`;

CREATE TABLE `transaksi_simpanan` (
  `kode_simpanan` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` int(11) DEFAULT NULL,
  `total_simpanan` decimal(20,2) DEFAULT '0.00',
  `created_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_simpanan`),
  KEY `no_anggota` (`no_anggota`),
  CONSTRAINT `transaksi_simpanan_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `master_anggota` (`no_anggota`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=utf8;

/*Data for the table `transaksi_simpanan` */

insert  into `transaksi_simpanan`(`kode_simpanan`,`no_anggota`,`total_simpanan`,`created_timestamp`) values (1,1,2875000.00,'2016-02-13 08:34:41'),(2,2,2875000.00,'2016-02-13 08:34:41'),(3,3,2550000.00,'2016-02-13 08:34:41'),(4,4,2425000.00,'2016-02-13 08:34:41'),(5,5,2000000.00,'2016-02-13 08:34:41'),(6,6,1600000.00,'2016-02-13 08:34:41'),(7,7,2000000.00,'2016-02-13 08:34:41'),(8,8,2875000.00,'2016-02-13 08:34:41'),(9,9,2875000.00,'2016-02-13 08:34:41'),(10,10,2875000.00,'2016-02-13 08:34:41'),(11,11,2875000.00,'2016-02-13 08:34:41'),(12,12,2875000.00,'2016-02-13 08:34:41'),(13,13,2875000.00,'2016-02-13 08:34:41'),(14,14,2875000.00,'2016-02-13 08:34:41'),(15,15,2875000.00,'2016-02-13 08:34:41'),(16,16,2625000.00,'2016-02-13 08:34:41'),(17,17,2875000.00,'2016-02-13 08:34:41'),(18,18,2875000.00,'2016-02-13 08:34:41'),(19,19,2875000.00,'2016-02-13 08:34:41'),(20,20,2875000.00,'2016-02-13 08:34:41'),(21,21,2000000.00,'2016-02-13 08:34:41'),(22,22,2875000.00,'2016-02-13 08:34:41'),(23,23,2875000.00,'2016-02-13 08:34:41'),(24,24,2875000.00,'2016-02-13 08:34:41'),(25,25,2875000.00,'2016-02-13 08:34:41'),(26,26,2875000.00,'2016-02-13 08:34:41'),(27,27,1700000.00,'2016-02-13 08:34:41'),(28,28,2000000.00,'2016-02-13 08:34:41'),(29,29,2875000.00,'2016-02-13 08:34:41'),(30,30,2000000.00,'2016-02-13 08:34:41'),(31,31,2875000.00,'2016-02-13 08:34:41'),(32,32,200000.00,'2016-02-13 08:34:41'),(33,33,2875000.00,'2016-02-13 08:34:41'),(34,34,2875000.00,'2016-02-13 08:34:41'),(35,35,2875000.00,'2016-02-13 08:34:41'),(36,36,2875000.00,'2016-02-13 08:34:41'),(37,37,2875000.00,'2016-02-13 08:34:41'),(38,38,2875000.00,'2016-02-13 08:34:41'),(39,39,2875000.00,'2016-02-13 08:34:41'),(40,40,2875000.00,'2016-02-13 08:34:41'),(41,41,2875000.00,'2016-02-13 08:34:41'),(42,42,1500000.00,'2016-02-13 08:34:41'),(43,43,2875000.00,'2016-02-13 08:34:41'),(44,44,500000.00,'2016-02-13 08:34:41'),(45,45,200000.00,'2016-02-13 08:34:41'),(46,46,2875000.00,'2016-02-13 08:34:41'),(47,47,1700000.00,'2016-02-13 08:34:41'),(48,48,2875000.00,'2016-02-13 08:34:41'),(49,49,2875000.00,'2016-02-13 08:34:41'),(50,50,2875000.00,'2016-02-13 08:34:41'),(51,51,2875000.00,'2016-02-13 08:34:41'),(52,52,2425000.00,'2016-02-13 08:34:41'),(53,53,2875000.00,'2016-02-13 08:34:41'),(54,54,2425000.00,'2016-02-13 08:34:41'),(55,55,2875000.00,'2016-02-13 08:34:41'),(56,56,2000000.00,'2016-02-13 08:34:41'),(57,57,2725000.00,'2016-02-13 08:34:41'),(58,58,2875000.00,'2016-02-13 08:34:41'),(59,59,2750000.00,'2016-02-13 08:34:41'),(60,60,2750000.00,'2016-02-13 08:34:41'),(61,61,2875000.00,'2016-02-13 08:34:41'),(62,62,800000.00,'2016-02-13 08:34:41'),(63,63,600000.00,'2016-02-13 08:34:41'),(64,64,2875000.00,'2016-02-13 08:34:41'),(65,65,2875000.00,'2016-02-13 08:34:41'),(66,66,2425000.00,'2016-02-13 08:34:41'),(67,67,1600000.00,'2016-02-13 08:34:41'),(68,68,2425000.00,'2016-02-13 08:34:41'),(69,69,200000.00,'2016-02-13 08:34:41'),(70,70,2875000.00,'2016-02-13 08:34:41'),(71,71,2875000.00,'2016-02-13 08:34:41'),(72,72,2875000.00,'2016-02-13 08:34:41'),(73,73,2100000.00,'2016-02-13 08:34:41'),(74,74,2100000.00,'2016-02-13 08:34:41'),(75,75,2875000.00,'2016-02-13 08:34:41'),(76,76,2575000.00,'2016-02-13 08:34:41'),(77,77,2875000.00,'2016-02-13 08:34:41'),(78,78,2875000.00,'2016-02-13 08:34:41'),(79,79,2875000.00,'2016-02-13 08:34:41'),(80,80,2875000.00,'2016-02-13 08:34:41'),(81,81,2875000.00,'2016-02-13 08:34:41'),(82,82,2875000.00,'2016-02-13 08:34:41'),(83,83,2875000.00,'2016-02-13 08:34:41'),(84,84,2875000.00,'2016-02-13 08:34:41'),(85,85,2875000.00,'2016-02-13 08:34:41'),(86,86,2000000.00,'2016-02-13 08:34:41'),(87,87,2875000.00,'2016-02-13 08:34:41'),(88,88,2875000.00,'2016-02-13 08:34:41'),(89,89,2875000.00,'2016-02-13 08:34:41'),(90,90,800000.00,'2016-02-13 08:34:41'),(91,91,1800000.00,'2016-02-13 08:34:41'),(92,92,2875000.00,'2016-02-13 08:34:41'),(93,93,2875000.00,'2016-02-13 08:34:41'),(94,94,2100000.00,'2016-02-13 08:34:41'),(95,95,500000.00,'2016-02-13 08:34:41'),(96,96,2875000.00,'2016-02-13 08:34:41'),(97,97,2875000.00,'2016-02-13 08:34:41'),(98,98,2875000.00,'2016-02-13 08:34:41'),(99,99,2100000.00,'2016-02-13 08:34:41'),(100,100,2875000.00,'2016-02-13 08:34:41'),(101,101,2875000.00,'2016-02-13 08:34:41'),(102,102,2425000.00,'2016-02-13 08:34:41'),(103,103,1900000.00,'2016-02-13 08:34:41'),(104,104,2875000.00,'2016-02-13 08:34:41'),(105,105,200000.00,'2016-02-13 08:34:41'),(106,106,2100000.00,'2016-02-13 08:34:41'),(107,107,500000.00,'2016-02-13 08:34:41'),(108,108,2875000.00,'2016-02-13 08:34:41'),(109,109,400000.00,'2016-02-13 08:34:41'),(110,110,2325000.00,'2016-02-13 08:34:41'),(111,111,2875000.00,'2016-02-13 08:34:41'),(112,112,2100000.00,'2016-02-13 08:34:41'),(113,113,2875000.00,'2016-02-13 08:34:41'),(114,114,2875000.00,'2016-02-13 08:34:41'),(115,115,2000000.00,'2016-02-13 08:34:41'),(116,116,2875000.00,'2016-02-13 08:34:41'),(117,117,500000.00,'2016-02-13 08:34:41'),(118,118,2875000.00,'2016-02-13 08:34:41'),(119,119,2875000.00,'2016-02-13 08:34:41'),(120,120,2875000.00,'2016-02-13 08:34:41'),(121,121,2875000.00,'2016-02-13 08:34:41'),(122,122,2875000.00,'2016-02-13 08:34:41'),(123,123,2875000.00,'2016-02-13 08:34:41'),(124,124,2875000.00,'2016-02-13 08:34:41'),(125,125,2425000.00,'2016-02-13 08:34:41'),(126,126,2875000.00,'2016-02-13 08:34:41'),(127,127,1600000.00,'2016-02-13 08:34:41'),(128,128,2875000.00,'2016-02-13 08:34:41'),(129,129,2875000.00,'2016-02-13 08:34:41'),(130,130,1600000.00,'2016-02-13 08:34:41'),(131,131,400000.00,'2016-02-13 08:34:41'),(132,132,2875000.00,'2016-02-13 08:34:41'),(133,133,2875000.00,'2016-02-13 08:34:41'),(134,134,2875000.00,'2016-02-13 08:34:41'),(135,135,2875000.00,'2016-02-13 08:34:41'),(136,136,2325000.00,'2016-02-13 08:34:41'),(137,137,2875000.00,'2016-02-13 08:34:41'),(138,138,800000.00,'2016-02-13 08:34:41'),(139,139,2875000.00,'2016-02-13 08:34:41'),(140,140,1100000.00,'2016-02-13 08:34:41'),(141,141,2875000.00,'2016-02-13 08:34:41'),(142,142,2425000.00,'2016-02-13 08:34:41'),(143,143,2000000.00,'2016-02-13 08:34:41'),(144,144,2875000.00,'2016-02-13 08:34:41'),(145,145,2875000.00,'2016-02-13 08:34:41'),(146,146,2875000.00,'2016-02-13 08:34:41'),(147,147,2875000.00,'2016-02-13 08:34:41'),(148,148,2725000.00,'2016-02-13 08:34:41'),(149,149,2875000.00,'2016-02-13 08:34:41'),(150,150,2875000.00,'2016-02-13 08:34:41'),(151,151,200000.00,'2016-02-13 08:34:41'),(152,152,2875000.00,'2016-02-13 08:34:41'),(153,153,2875000.00,'2016-02-13 08:34:41'),(154,154,2775000.00,'2016-02-13 08:34:41'),(155,155,2000000.00,'2016-02-13 08:34:41'),(156,156,2875000.00,'2016-02-13 08:34:41'),(157,157,1100000.00,'2016-02-13 08:34:41'),(158,158,2875000.00,'2016-02-13 08:34:41'),(159,159,2875000.00,'2016-02-13 08:34:41'),(160,160,2875000.00,'2016-02-13 08:34:41'),(161,161,2875000.00,'2016-02-13 08:34:41'),(162,162,2775000.00,'2016-02-13 08:34:41'),(163,163,2875000.00,'2016-02-13 08:34:41'),(164,164,2875000.00,'2016-02-13 08:34:41'),(165,165,1300000.00,'2016-02-13 08:34:41'),(166,166,2875000.00,'2016-02-13 08:34:41'),(167,167,2550000.00,'2016-02-13 08:34:41'),(168,168,2875000.00,'2016-02-13 08:34:41'),(169,169,2725000.00,'2016-02-13 08:34:41'),(170,170,2875000.00,'2016-02-13 08:34:41'),(171,171,2875000.00,'2016-02-13 08:34:41'),(172,172,2875000.00,'2016-02-13 08:34:41'),(173,173,2875000.00,'2016-02-13 08:34:41'),(174,174,2875000.00,'2016-02-13 08:34:41'),(175,175,2875000.00,'2016-02-13 08:34:41'),(176,176,1900000.00,'2016-02-13 08:34:41'),(177,177,2875000.00,'2016-02-13 08:34:41'),(178,178,2875000.00,'2016-02-13 08:34:41'),(179,179,2875000.00,'2016-02-13 08:34:41'),(180,180,2875000.00,'2016-02-13 08:34:41'),(181,181,1200000.00,'2016-02-13 08:34:41'),(182,182,2875000.00,'2016-02-13 08:34:41'),(183,183,2875000.00,'2016-02-13 08:34:41'),(184,184,2875000.00,'2016-02-13 08:34:41'),(185,185,1400000.00,'2016-02-13 08:34:41'),(186,186,2875000.00,'2016-02-13 08:34:41'),(187,187,2875000.00,'2016-02-13 08:34:41'),(188,188,2875000.00,'2016-02-13 08:34:41'),(189,189,2875000.00,'2016-02-13 08:34:41'),(190,190,2875000.00,'2016-02-13 08:34:41'),(191,191,2875000.00,'2016-02-13 08:34:41'),(192,192,2875000.00,'2016-02-13 08:34:41'),(193,193,2875000.00,'2016-02-13 08:34:41'),(194,194,2000000.00,'2016-02-13 08:34:41'),(195,195,200000.00,'2016-02-13 08:34:41'),(196,196,2875000.00,'2016-02-13 08:34:41'),(197,197,200000.00,'2016-02-13 08:34:41'),(198,198,2875000.00,'2016-02-13 08:34:41'),(199,199,2525000.00,'2016-02-13 08:34:41'),(200,200,2875000.00,'2016-02-13 08:34:41'),(201,201,2875000.00,'2016-02-13 08:34:41'),(202,202,2875000.00,'2016-02-13 08:34:41'),(203,203,2875000.00,'2016-02-13 08:34:41'),(204,204,2875000.00,'2016-02-13 08:34:41'),(205,205,2000000.00,'2016-02-13 08:34:41'),(206,206,2875000.00,'2016-02-13 08:34:41'),(207,207,2875000.00,'2016-02-13 08:34:41'),(208,208,2875000.00,'2016-02-13 08:34:41'),(209,209,2775000.00,'2016-02-13 08:34:41'),(210,210,2875000.00,'2016-02-13 08:34:41'),(211,211,2775000.00,'2016-02-13 08:34:41'),(212,212,2875000.00,'2016-02-13 08:34:41'),(213,213,2875000.00,'2016-02-13 08:34:41'),(214,214,2875000.00,'2016-02-13 08:34:41'),(215,215,2875000.00,'2016-02-13 08:34:41'),(216,216,2875000.00,'2016-02-13 08:34:41'),(217,217,2600000.00,'2016-02-13 08:34:41'),(221,1,100000.00,'2016-03-02 16:33:17');

/*Table structure for table `transaksi_simpanan_detail` */

DROP TABLE IF EXISTS `transaksi_simpanan_detail`;

CREATE TABLE `transaksi_simpanan_detail` (
  `kode_simpanan_detail` int(11) NOT NULL AUTO_INCREMENT,
  `kode_simpanan` int(11) DEFAULT NULL,
  `kode_jenis_simpanan` int(11) DEFAULT NULL,
  `jumlah_simpanan` decimal(20,2) DEFAULT '0.00',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_simpanan_detail`),
  KEY `kode_simpanan` (`kode_simpanan`),
  KEY `kode_jenis_simpanan` (`kode_jenis_simpanan`),
  CONSTRAINT `transaksi_simpanan_detail_ibfk_1` FOREIGN KEY (`kode_simpanan`) REFERENCES `transaksi_simpanan` (`kode_simpanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_simpanan_detail_ibfk_2` FOREIGN KEY (`kode_jenis_simpanan`) REFERENCES `master_jenis_simpanan` (`kode_jenis_simpanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8;

/*Data for the table `transaksi_simpanan_detail` */

insert  into `transaksi_simpanan_detail`(`kode_simpanan_detail`,`kode_simpanan`,`kode_jenis_simpanan`,`jumlah_simpanan`,`created_timestamp`) values (1,1,5,2875000.00,'2016-02-13 08:41:04'),(2,2,5,2875000.00,'2016-02-13 08:41:04'),(3,3,5,2550000.00,'2016-02-13 08:41:04'),(4,4,5,2425000.00,'2016-02-13 08:41:04'),(5,5,5,2000000.00,'2016-02-13 08:41:04'),(6,6,5,1600000.00,'2016-02-13 08:41:04'),(7,7,5,2000000.00,'2016-02-13 08:41:04'),(8,8,5,2875000.00,'2016-02-13 08:41:04'),(9,9,5,2875000.00,'2016-02-13 08:41:04'),(10,10,5,2875000.00,'2016-02-13 08:41:04'),(11,11,5,2875000.00,'2016-02-13 08:41:04'),(12,12,5,2875000.00,'2016-02-13 08:41:04'),(13,13,5,2875000.00,'2016-02-13 08:41:04'),(14,14,5,2875000.00,'2016-02-13 08:41:04'),(15,15,5,2875000.00,'2016-02-13 08:41:04'),(16,16,5,2625000.00,'2016-02-13 08:41:04'),(17,17,5,2875000.00,'2016-02-13 08:41:04'),(18,18,5,2875000.00,'2016-02-13 08:41:04'),(19,19,5,2875000.00,'2016-02-13 08:41:04'),(20,20,5,2875000.00,'2016-02-13 08:41:04'),(21,21,5,2000000.00,'2016-02-13 08:41:04'),(22,22,5,2875000.00,'2016-02-13 08:41:04'),(23,23,5,2875000.00,'2016-02-13 08:41:04'),(24,24,5,2875000.00,'2016-02-13 08:41:04'),(25,25,5,2875000.00,'2016-02-13 08:41:04'),(26,26,5,2875000.00,'2016-02-13 08:41:04'),(27,27,5,1700000.00,'2016-02-13 08:41:04'),(28,28,5,2000000.00,'2016-02-13 08:41:04'),(29,29,5,2875000.00,'2016-02-13 08:41:04'),(30,30,5,2000000.00,'2016-02-13 08:41:04'),(31,31,5,2875000.00,'2016-02-13 08:41:04'),(32,32,5,200000.00,'2016-02-13 08:41:04'),(33,33,5,2875000.00,'2016-02-13 08:41:04'),(34,34,5,2875000.00,'2016-02-13 08:41:04'),(35,35,5,2875000.00,'2016-02-13 08:41:04'),(36,36,5,2875000.00,'2016-02-13 08:41:04'),(37,37,5,2875000.00,'2016-02-13 08:41:04'),(38,38,5,2875000.00,'2016-02-13 08:41:04'),(39,39,5,2875000.00,'2016-02-13 08:41:04'),(40,40,5,2875000.00,'2016-02-13 08:41:04'),(41,41,5,2875000.00,'2016-02-13 08:41:04'),(42,42,5,1500000.00,'2016-02-13 08:41:04'),(43,43,5,2875000.00,'2016-02-13 08:41:04'),(44,44,5,500000.00,'2016-02-13 08:41:04'),(45,45,5,200000.00,'2016-02-13 08:41:04'),(46,46,5,2875000.00,'2016-02-13 08:41:04'),(47,47,5,1700000.00,'2016-02-13 08:41:04'),(48,48,5,2875000.00,'2016-02-13 08:41:04'),(49,49,5,2875000.00,'2016-02-13 08:41:04'),(50,50,5,2875000.00,'2016-02-13 08:41:04'),(51,51,5,2875000.00,'2016-02-13 08:41:04'),(52,52,5,2425000.00,'2016-02-13 08:41:04'),(53,53,5,2875000.00,'2016-02-13 08:41:04'),(54,54,5,2425000.00,'2016-02-13 08:41:04'),(55,55,5,2875000.00,'2016-02-13 08:41:04'),(56,56,5,2000000.00,'2016-02-13 08:41:04'),(57,57,5,2725000.00,'2016-02-13 08:41:04'),(58,58,5,2875000.00,'2016-02-13 08:41:04'),(59,59,5,2750000.00,'2016-02-13 08:41:04'),(60,60,5,2750000.00,'2016-02-13 08:41:04'),(61,61,5,2875000.00,'2016-02-13 08:41:04'),(62,62,5,800000.00,'2016-02-13 08:41:04'),(63,63,5,600000.00,'2016-02-13 08:41:04'),(64,64,5,2875000.00,'2016-02-13 08:41:04'),(65,65,5,2875000.00,'2016-02-13 08:41:04'),(66,66,5,2425000.00,'2016-02-13 08:41:04'),(67,67,5,1600000.00,'2016-02-13 08:41:04'),(68,68,5,2425000.00,'2016-02-13 08:41:04'),(69,69,5,200000.00,'2016-02-13 08:41:04'),(70,70,5,2875000.00,'2016-02-13 08:41:04'),(71,71,5,2875000.00,'2016-02-13 08:41:04'),(72,72,5,2875000.00,'2016-02-13 08:41:04'),(73,73,5,2100000.00,'2016-02-13 08:41:04'),(74,74,5,2100000.00,'2016-02-13 08:41:04'),(75,75,5,2875000.00,'2016-02-13 08:41:04'),(76,76,5,2575000.00,'2016-02-13 08:41:04'),(77,77,5,2875000.00,'2016-02-13 08:41:04'),(78,78,5,2875000.00,'2016-02-13 08:41:04'),(79,79,5,2875000.00,'2016-02-13 08:41:04'),(80,80,5,2875000.00,'2016-02-13 08:41:04'),(81,81,5,2875000.00,'2016-02-13 08:41:04'),(82,82,5,2875000.00,'2016-02-13 08:41:04'),(83,83,5,2875000.00,'2016-02-13 08:41:04'),(84,84,5,2875000.00,'2016-02-13 08:41:04'),(85,85,5,2875000.00,'2016-02-13 08:41:04'),(86,86,5,2000000.00,'2016-02-13 08:41:04'),(87,87,5,2875000.00,'2016-02-13 08:41:04'),(88,88,5,2875000.00,'2016-02-13 08:41:04'),(89,89,5,2875000.00,'2016-02-13 08:41:04'),(90,90,5,800000.00,'2016-02-13 08:41:04'),(91,91,5,1800000.00,'2016-02-13 08:41:04'),(92,92,5,2875000.00,'2016-02-13 08:41:04'),(93,93,5,2875000.00,'2016-02-13 08:41:04'),(94,94,5,2100000.00,'2016-02-13 08:41:04'),(95,95,5,500000.00,'2016-02-13 08:41:04'),(96,96,5,2875000.00,'2016-02-13 08:41:04'),(97,97,5,2875000.00,'2016-02-13 08:41:04'),(98,98,5,2875000.00,'2016-02-13 08:41:04'),(99,99,5,2100000.00,'2016-02-13 08:41:04'),(100,100,5,2875000.00,'2016-02-13 08:41:04'),(101,101,5,2875000.00,'2016-02-13 08:41:04'),(102,102,5,2425000.00,'2016-02-13 08:41:04'),(103,103,5,1900000.00,'2016-02-13 08:41:04'),(104,104,5,2875000.00,'2016-02-13 08:41:04'),(105,105,5,200000.00,'2016-02-13 08:41:04'),(106,106,5,2100000.00,'2016-02-13 08:41:04'),(107,107,5,500000.00,'2016-02-13 08:41:04'),(108,108,5,2875000.00,'2016-02-13 08:41:04'),(109,109,5,400000.00,'2016-02-13 08:41:04'),(110,110,5,2325000.00,'2016-02-13 08:41:04'),(111,111,5,2875000.00,'2016-02-13 08:41:04'),(112,112,5,2100000.00,'2016-02-13 08:41:04'),(113,113,5,2875000.00,'2016-02-13 08:41:04'),(114,114,5,2875000.00,'2016-02-13 08:41:04'),(115,115,5,2000000.00,'2016-02-13 08:41:04'),(116,116,5,2875000.00,'2016-02-13 08:41:04'),(117,117,5,500000.00,'2016-02-13 08:41:04'),(118,118,5,2875000.00,'2016-02-13 08:41:04'),(119,119,5,2875000.00,'2016-02-13 08:41:04'),(120,120,5,2875000.00,'2016-02-13 08:41:04'),(121,121,5,2875000.00,'2016-02-13 08:41:04'),(122,122,5,2875000.00,'2016-02-13 08:41:04'),(123,123,5,2875000.00,'2016-02-13 08:41:04'),(124,124,5,2875000.00,'2016-02-13 08:41:04'),(125,125,5,2425000.00,'2016-02-13 08:41:04'),(126,126,5,2875000.00,'2016-02-13 08:41:04'),(127,127,5,1600000.00,'2016-02-13 08:41:04'),(128,128,5,2875000.00,'2016-02-13 08:41:04'),(129,129,5,2875000.00,'2016-02-13 08:41:04'),(130,130,5,1600000.00,'2016-02-13 08:41:04'),(131,131,5,400000.00,'2016-02-13 08:41:04'),(132,132,5,2875000.00,'2016-02-13 08:41:04'),(133,133,5,2875000.00,'2016-02-13 08:41:04'),(134,134,5,2875000.00,'2016-02-13 08:41:04'),(135,135,5,2875000.00,'2016-02-13 08:41:04'),(136,136,5,2325000.00,'2016-02-13 08:41:04'),(137,137,5,2875000.00,'2016-02-13 08:41:04'),(138,138,5,800000.00,'2016-02-13 08:41:04'),(139,139,5,2875000.00,'2016-02-13 08:41:04'),(140,140,5,1100000.00,'2016-02-13 08:41:04'),(141,141,5,2875000.00,'2016-02-13 08:41:04'),(142,142,5,2425000.00,'2016-02-13 08:41:04'),(143,143,5,2000000.00,'2016-02-13 08:41:04'),(144,144,5,2875000.00,'2016-02-13 08:41:04'),(145,145,5,2875000.00,'2016-02-13 08:41:04'),(146,146,5,2875000.00,'2016-02-13 08:41:04'),(147,147,5,2875000.00,'2016-02-13 08:41:04'),(148,148,5,2725000.00,'2016-02-13 08:41:04'),(149,149,5,2875000.00,'2016-02-13 08:41:04'),(150,150,5,2875000.00,'2016-02-13 08:41:04'),(151,151,5,200000.00,'2016-02-13 08:41:04'),(152,152,5,2875000.00,'2016-02-13 08:41:04'),(153,153,5,2875000.00,'2016-02-13 08:41:04'),(154,154,5,2775000.00,'2016-02-13 08:41:04'),(155,155,5,2000000.00,'2016-02-13 08:41:04'),(156,156,5,2875000.00,'2016-02-13 08:41:04'),(157,157,5,1100000.00,'2016-02-13 08:41:04'),(158,158,5,2875000.00,'2016-02-13 08:41:04'),(159,159,5,2875000.00,'2016-02-13 08:41:04'),(160,160,5,2875000.00,'2016-02-13 08:41:04'),(161,161,5,2875000.00,'2016-02-13 08:41:04'),(162,162,5,2775000.00,'2016-02-13 08:41:04'),(163,163,5,2875000.00,'2016-02-13 08:41:04'),(164,164,5,2875000.00,'2016-02-13 08:41:04'),(165,165,5,1300000.00,'2016-02-13 08:41:04'),(166,166,5,2875000.00,'2016-02-13 08:41:04'),(167,167,5,2550000.00,'2016-02-13 08:41:04'),(168,168,5,2875000.00,'2016-02-13 08:41:04'),(169,169,5,2725000.00,'2016-02-13 08:41:04'),(170,170,5,2875000.00,'2016-02-13 08:41:04'),(171,171,5,2875000.00,'2016-02-13 08:41:04'),(172,172,5,2875000.00,'2016-02-13 08:41:04'),(173,173,5,2875000.00,'2016-02-13 08:41:04'),(174,174,5,2875000.00,'2016-02-13 08:41:04'),(175,175,5,2875000.00,'2016-02-13 08:41:04'),(176,176,5,1900000.00,'2016-02-13 08:41:04'),(177,177,5,2875000.00,'2016-02-13 08:41:04'),(178,178,5,2875000.00,'2016-02-13 08:41:04'),(179,179,5,2875000.00,'2016-02-13 08:41:04'),(180,180,5,2875000.00,'2016-02-13 08:41:04'),(181,181,5,1200000.00,'2016-02-13 08:41:04'),(182,182,5,2875000.00,'2016-02-13 08:41:04'),(183,183,5,2875000.00,'2016-02-13 08:41:04'),(184,184,5,2875000.00,'2016-02-13 08:41:04'),(185,185,5,1400000.00,'2016-02-13 08:41:04'),(186,186,5,2875000.00,'2016-02-13 08:41:04'),(187,187,5,2875000.00,'2016-02-13 08:41:04'),(188,188,5,2875000.00,'2016-02-13 08:41:04'),(189,189,5,2875000.00,'2016-02-13 08:41:04'),(190,190,5,2875000.00,'2016-02-13 08:41:04'),(191,191,5,2875000.00,'2016-02-13 08:41:04'),(192,192,5,2875000.00,'2016-02-13 08:41:04'),(193,193,5,2875000.00,'2016-02-13 08:41:04'),(194,194,5,2000000.00,'2016-02-13 08:41:04'),(195,195,5,200000.00,'2016-02-13 08:41:04'),(196,196,5,2875000.00,'2016-02-13 08:41:04'),(197,197,5,200000.00,'2016-02-13 08:41:04'),(198,198,5,2875000.00,'2016-02-13 08:41:04'),(199,199,5,2525000.00,'2016-02-13 08:41:04'),(200,200,5,2875000.00,'2016-02-13 08:41:04'),(201,201,5,2875000.00,'2016-02-13 08:41:04'),(202,202,5,2875000.00,'2016-02-13 08:41:04'),(203,203,5,2875000.00,'2016-02-13 08:41:04'),(204,204,5,2875000.00,'2016-02-13 08:41:04'),(205,205,5,2000000.00,'2016-02-13 08:41:04'),(206,206,5,2875000.00,'2016-02-13 08:41:04'),(207,207,5,2875000.00,'2016-02-13 08:41:04'),(208,208,5,2875000.00,'2016-02-13 08:41:04'),(209,209,5,2775000.00,'2016-02-13 08:41:04'),(210,210,5,2875000.00,'2016-02-13 08:41:04'),(211,211,5,2775000.00,'2016-02-13 08:41:04'),(212,212,5,2875000.00,'2016-02-13 08:41:04'),(213,213,5,2875000.00,'2016-02-13 08:41:04'),(214,214,5,2875000.00,'2016-02-13 08:41:04'),(215,215,5,2875000.00,'2016-02-13 08:41:04'),(216,216,5,2875000.00,'2016-02-13 08:41:04'),(217,217,5,2600000.00,'2016-02-13 08:41:04'),(218,221,2,100000.00,'2016-03-02 16:33:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`account_id`,`nama`,`email`,`password`,`keterangan`,`id_menu`,`lastlogin`,`regdate`,`status`,`hapus`) values (7,'admin','admin@gmail.com','21232f297a57a5a743894a0e4a801fc3','root','1,2,4,5,6,7,8,9,10,11,12,13,14','2016-03-06 04:55:24','2015-10-15 04:42:41',1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
