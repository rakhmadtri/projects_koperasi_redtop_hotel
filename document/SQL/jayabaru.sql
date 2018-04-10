/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.25 : Database - jayabaru
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jayabaru` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `jayabaru`;

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `kode_customer` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pt` int(11) DEFAULT NULL,
  `kode_kokab` int(10) NOT NULL,
  `nama_customer` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telfon` varchar(12) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`kode_customer`,`kode_kokab`),
  KEY `kode_kokab` (`kode_kokab`),
  KEY `kode_pt` (`kode_pt`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`kode_kokab`) REFERENCES `master_kokab` (`kota_id`),
  CONSTRAINT `customer_ibfk_3` FOREIGN KEY (`kode_pt`) REFERENCES `master_cabang` (`kode_cabang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`kode_customer`,`kode_pt`,`kode_kokab`,`nama_customer`,`email`,`no_telfon`,`alamat`,`hapus`) values (1,1,1,'TOKO 1','abc@gmail.com','11111111','Jakarta',0),(2,1,3,'TOKO 2','PT. Alfa Midi@tange.com','asdasd','asdasd',0),(3,1,1,'TOKO 3','PT. Alfa Midi@tange.com','PT. Alfa Mid','PT. Alfa Midi',0),(4,12,161,'sms toko2','sms@gmail.com','0899999999','jl.raya no1',0);

/*Table structure for table `invoice` */

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `no_invoice` varchar(255) NOT NULL COMMENT 'req by client xxxx/JB/YY',
  `order_id` int(11) DEFAULT NULL,
  `payment_amount` decimal(12,2) DEFAULT '0.00',
  `payment_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_flag` tinyint(1) DEFAULT '0' COMMENT '0 for not Paid',
  `last_id` int(11) DEFAULT '0',
  PRIMARY KEY (`no_invoice`),
  KEY `FK_invoice` (`order_id`),
  CONSTRAINT `FK_invoice` FOREIGN KEY (`order_id`) REFERENCES `transaksi` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `invoice` */

insert  into `invoice`(`no_invoice`,`order_id`,`payment_amount`,`payment_timestamp`,`payment_flag`,`last_id`) values ('00011/JB/15',11,448888.44,'2015-12-11 23:49:19',2,0),('00015/JB/15',15,151500.00,'2015-11-15 00:01:00',0,0),('00016/JB/15',16,151500.00,'2015-11-15 00:01:48',0,0),('00020/JB/15',20,151500.00,'2015-11-15 00:06:11',0,0),('00021/JB/15',21,11111.00,'2016-05-15 00:06:27',2,0),('00022/JB/15',22,151500.00,'2015-11-15 16:57:44',2,0),('00023/JB/15',23,204000.00,'2015-12-15 17:20:10',2,0);

/*Table structure for table `master_barang` */

DROP TABLE IF EXISTS `master_barang`;

CREATE TABLE `master_barang` (
  `kode_barang` int(11) NOT NULL AUTO_INCREMENT,
  `category` enum('A-PRODUCT','JASA','SPARE_PART','TRANSPORT') DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `created_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '0',
  `hapus` tinyint(1) DEFAULT '0' COMMENT 'Jika 1 = DELETE',
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `master_barang` */

insert  into `master_barang`(`kode_barang`,`category`,`nama_barang`,`deskripsi`,`license`,`created_timestamp`,`status`,`hapus`) values (1,'A-PRODUCT','Barang A','Barang A',NULL,'2015-10-17 12:58:43',1,0),(2,'JASA','Maintenance A','Test',NULL,'2015-10-17 13:30:55',1,0),(3,'A-PRODUCT','Barang B','The best of product',NULL,'2015-11-04 11:50:03',1,0),(4,'A-PRODUCT','Loncin 12000','Salah Satu produk Merk Terbaik',NULL,'2015-11-05 09:26:49',1,0),(5,'A-PRODUCT','','',NULL,'2015-11-05 12:03:39',0,1),(6,'A-PRODUCT','asdasdasd','',NULL,'2015-11-05 12:06:33',0,1),(7,'A-PRODUCT','Loncin 12000 XP','Barang Mahal','XP001-KB','2015-11-06 21:18:38',1,0);

/*Table structure for table `master_cabang` */

DROP TABLE IF EXISTS `master_cabang`;

CREATE TABLE `master_cabang` (
  `kode_cabang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cabang` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1',
  `hapus` tinyint(1) DEFAULT '0' COMMENT 'Jika 1 = Delete',
  PRIMARY KEY (`kode_cabang`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `master_cabang` */

insert  into `master_cabang`(`kode_cabang`,`nama_cabang`,`deskripsi`,`created_timestamp`,`status`,`hapus`) values (1,'PT.SUMBER ALFARIA TRIJAYA. Tbk','Induk Perusahaan','2015-10-21 10:02:21',1,0),(12,'PT.Sumber Makmur','Induk Perusahaan','2015-10-23 11:29:22',1,0);

/*Table structure for table `master_kokab` */

DROP TABLE IF EXISTS `master_kokab`;

CREATE TABLE `master_kokab` (
  `kota_id` int(10) NOT NULL AUTO_INCREMENT,
  `kokab_nama` varchar(30) DEFAULT NULL,
  `provinsi_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`kota_id`),
  KEY `pro_kota` (`provinsi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=503 DEFAULT CHARSET=latin1;

/*Data for the table `master_kokab` */

insert  into `master_kokab`(`kota_id`,`kokab_nama`,`provinsi_id`) values (1,'Kabupaten Aceh Barat',1),(2,'Kabupaten Aceh Barat Daya',1),(3,'Kabupaten Aceh Besar',1),(4,'Kabupaten Aceh Jaya',1),(5,'Kabupaten Aceh Selatan',1),(6,'Kabupaten Aceh Singkil',1),(7,'Kabupaten Aceh Tamiang',1),(8,'Kabupaten Aceh Tengah',1),(9,'Kabupaten Aceh Tenggara',1),(10,'Kabupaten Aceh Timur',1),(11,'Kabupaten Aceh Utara',1),(12,'Kabupaten Bener Meriah',1),(13,'Kabupaten Bireuen',1),(14,'Kabupaten Gayo Luwes',1),(15,'Kabupaten Nagan Raya',1),(16,'Kabupaten Pidie',1),(17,'Kabupaten Pidie Jaya',1),(18,'Kabupaten Simeulue',1),(19,'Kota Banda Aceh',1),(20,'Kota Langsa',1),(21,'Kota Lhokseumawe',1),(22,'Kota Sabang',1),(23,'Kota Subulussalam',1),(24,'Kabupaten Asahan',2),(25,'Kabupaten Batubara',2),(26,'Kabupaten Dairi',2),(27,'Kabupaten Deli Serdang',2),(28,'Kabupaten Humbang Hasundutan',2),(29,'Kabupaten Karo',2),(30,'Kabupaten Labuhan Batu',2),(31,'Kabupaten Labuhanbatu Selatan',2),(32,'Kabupaten Labuhanbatu Utara',2),(33,'Kabupaten Langkat',2),(34,'Kabupaten Mandailing Natal',2),(35,'Kabupaten Nias',2),(36,'Kabupaten Nias Barat',2),(37,'Kabupaten Nias Selatan',2),(38,'Kabupaten Nias Utara',2),(39,'Kabupaten Padang Lawas',2),(40,'Kabupaten Padang Lawas Utara',2),(41,'Kabupaten Pakpak Barat',2),(42,'Kabupaten Samosir',2),(43,'Kabupaten Serdang Bedagai',2),(44,'Kabupaten Simalungun',2),(45,'Kabupaten Tapanuli Selatan',2),(46,'Kabupaten Tapanuli Tengah',2),(47,'Kabupaten Tapanuli Utara',2),(48,'Kabupaten Toba Samosir',2),(49,'Kota Binjai',2),(50,'Kota Gunung Sitoli',2),(51,'Kota Medan',2),(52,'Kota Padangsidempuan',2),(53,'Kota Pematang Siantar',2),(54,'Kota Sibolga',2),(55,'Kota Tanjung Balai',2),(56,'Kota Tebing Tinggi',2),(57,'Kabupaten Agam',3),(58,'Kabupaten Dharmas Raya',3),(59,'Kabupaten Kepulauan Mentawai',3),(60,'Kabupaten Lima Puluh Kota',3),(61,'Kabupaten Padang Pariaman',3),(62,'Kabupaten Pasaman',3),(63,'Kabupaten Pasaman Barat',3),(64,'Kabupaten Pesisir Selatan',3),(65,'Kabupaten Sijunjung',3),(66,'Kabupaten Solok',3),(67,'Kabupaten Solok Selatan',3),(68,'Kabupaten Tanah Datar',3),(69,'Kota Bukittinggi',3),(70,'Kota Padang',3),(71,'Kota Padang Panjang',3),(72,'Kota Pariaman',3),(73,'Kota Payakumbuh',3),(74,'Kota Sawah Lunto',3),(75,'Kota Solok',3),(76,'Kabupaten Bengkalis',4),(77,'Kabupaten Indragiri Hilir',4),(78,'Kabupaten Indragiri Hulu',4),(79,'Kabupaten Kampar',4),(80,'Kabupaten Kuantan Singingi',4),(81,'Kabupaten Meranti',4),(82,'Kabupaten Pelalawan',4),(83,'Kabupaten Rokan Hilir',4),(84,'Kabupaten Rokan Hulu',4),(85,'Kabupaten Siak',4),(86,'Kota Dumai',4),(87,'Kota Pekanbaru',4),(88,'Kabupaten Bintan',5),(89,'Kabupaten Karimun',5),(90,'Kabupaten Kepulauan Anambas',5),(91,'Kabupaten Lingga',5),(92,'Kabupaten Natuna',5),(93,'Kota Batam',5),(94,'Kota Tanjung Pinang',5),(95,'Kabupaten Bangka',6),(96,'Kabupaten Bangka Barat',6),(97,'Kabupaten Bangka Selatan',6),(98,'Kabupaten Bangka Tengah',6),(99,'Kabupaten Belitung',6),(100,'Kabupaten Belitung Timur',6),(101,'Kota Pangkal Pinang',6),(102,'Kabupaten Kerinci',7),(103,'Kabupaten Merangin',7),(104,'Kabupaten Sarolangun',7),(105,'Kabupaten Batang Hari',7),(106,'Kabupaten Muaro Jambi',7),(107,'Kabupaten Tanjung Jabung Timur',7),(108,'Kabupaten Tanjung Jabung Barat',7),(109,'Kabupaten Tebo',7),(110,'Kabupaten Bungo',7),(111,'Kota Jambi',7),(112,'Kota Sungai Penuh',7),(113,'Kabupaten Bengkulu Selatan',8),(114,'Kabupaten Bengkulu Tengah',8),(115,'Kabupaten Bengkulu Utara',8),(116,'Kabupaten Kaur',8),(117,'Kabupaten Kepahiang',8),(118,'Kabupaten Lebong',8),(119,'Kabupaten Mukomuko',8),(120,'Kabupaten Rejang Lebong',8),(121,'Kabupaten Seluma',8),(122,'Kota Bengkulu',8),(123,'Kabupaten Banyuasin',9),(124,'Kabupaten Empat Lawang',9),(125,'Kabupaten Lahat',9),(126,'Kabupaten Muara Enim',9),(127,'Kabupaten Musi Banyu Asin',9),(128,'Kabupaten Musi Rawas',9),(129,'Kabupaten Ogan Ilir',9),(130,'Kabupaten Ogan Komering Ilir',9),(131,'Kabupaten Ogan Komering Ulu',9),(132,'Kabupaten Ogan Komering Ulu Se',9),(133,'Kabupaten Ogan Komering Ulu Ti',9),(134,'Kota Lubuklinggau',9),(135,'Kota Pagar Alam',9),(136,'Kota Palembang',9),(137,'Kota Prabumulih',9),(138,'Kabupaten Lampung Barat',10),(139,'Kabupaten Lampung Selatan',10),(140,'Kabupaten Lampung Tengah',10),(141,'Kabupaten Lampung Timur',10),(142,'Kabupaten Lampung Utara',10),(143,'Kabupaten Mesuji',10),(144,'Kabupaten Pesawaran',10),(145,'Kabupaten Pringsewu',10),(146,'Kabupaten Tanggamus',10),(147,'Kabupaten Tulang Bawang',10),(148,'Kabupaten Tulang Bawang Barat',10),(149,'Kabupaten Way Kanan',10),(150,'Kota Bandar Lampung',10),(151,'Kota Metro',10),(152,'Kabupaten Lebak',11),(153,'Kabupaten Pandeglang',11),(154,'Kabupaten Serang',11),(155,'Kabupaten Tangerang',11),(156,'Kota Cilegon',11),(157,'Kota Serang',11),(158,'Kota Tangerang',11),(159,'Kota Tangerang Selatan',11),(160,'Kabupaten Adm. Kepulauan Serib',12),(161,'Kota Jakarta Barat',12),(162,'Kota Jakarta Pusat',12),(163,'Kota Jakarta Selatan',12),(164,'Kota Jakarta Timur',12),(165,'Kota Jakarta Utara',12),(166,'Kabupaten Bandung',13),(167,'Kabupaten Bandung Barat',13),(168,'Kabupaten Bekasi',13),(169,'Kabupaten Bogor',13),(170,'Kabupaten Ciamis',13),(171,'Kabupaten Cianjur',13),(172,'Kabupaten Cirebon',13),(173,'Kabupaten Garut',13),(174,'Kabupaten Indramayu',13),(175,'Kabupaten Karawang',13),(176,'Kabupaten Kuningan',13),(177,'Kabupaten Majalengka',13),(178,'Kabupaten Purwakarta',13),(179,'Kabupaten Subang',13),(180,'Kabupaten Sukabumi',13),(181,'Kabupaten Sumedang',13),(182,'Kabupaten Tasikmalaya',13),(183,'Kota Bandung',13),(184,'Kota Banjar',13),(185,'Kota Bekasi',13),(186,'Kota Bogor',13),(187,'Kota Cimahi',13),(188,'Kota Cirebon',13),(189,'Kota Depok',13),(190,'Kota Sukabumi',13),(191,'Kota Tasikmalaya',13),(192,'Kabupaten Banjarnegara',14),(193,'Kabupaten Banyumas',14),(194,'Kabupaten Batang',14),(195,'Kabupaten Blora',14),(196,'Kabupaten Boyolali',14),(197,'Kabupaten Brebes',14),(198,'Kabupaten Cilacap',14),(199,'Kabupaten Demak',14),(200,'Kabupaten Grobogan',14),(201,'Kabupaten Jepara',14),(202,'Kabupaten Karanganyar',14),(203,'Kabupaten Kebumen',14),(204,'Kabupaten Kendal',14),(205,'Kabupaten Klaten',14),(206,'Kabupaten Kota Tegal',14),(207,'Kabupaten Kudus',14),(208,'Kabupaten Magelang',14),(209,'Kabupaten Pati',14),(210,'Kabupaten Pekalongan',14),(211,'Kabupaten Pemalang',14),(212,'Kabupaten Purbalingga',14),(213,'Kabupaten Purworejo',14),(214,'Kabupaten Rembang',14),(215,'Kabupaten Semarang',14),(216,'Kabupaten Sragen',14),(217,'Kabupaten Sukoharjo',14),(218,'Kabupaten Temanggung',14),(219,'Kabupaten Wonogiri',14),(220,'Kabupaten Wonosobo',14),(221,'Kota Magelang',14),(222,'Kota Pekalongan',14),(223,'Kota Salatiga',14),(224,'Kota Semarang',14),(225,'Kota Surakarta',14),(226,'Kota Tegal',14),(227,'Kabupaten Bantul',15),(228,'Kabupaten Gunung Kidul',15),(229,'Kabupaten Kulon Progo',15),(230,'Kabupaten Sleman',15),(231,'Kota Yogyakarta',15),(232,'Kabupaten Bangkalan',16),(233,'Kabupaten Banyuwangi',16),(234,'Kabupaten Blitar',16),(235,'Kabupaten Bojonegoro',16),(236,'Kabupaten Bondowoso',16),(237,'Kabupaten Gresik',16),(238,'Kabupaten Jember',16),(239,'Kabupaten Jombang',16),(240,'Kabupaten Kediri',16),(241,'Kabupaten Lamongan',16),(242,'Kabupaten Lumajang',16),(243,'Kabupaten Madiun',16),(244,'Kabupaten Magetan',16),(245,'Kabupaten Malang',16),(246,'Kabupaten Mojokerto',16),(247,'Kabupaten Nganjuk',16),(248,'Kabupaten Ngawi',16),(249,'Kabupaten Pacitan',16),(250,'Kabupaten Pamekasan',16),(251,'Kabupaten Pasuruan',16),(252,'Kabupaten Ponorogo',16),(253,'Kabupaten Probolinggo',16),(254,'Kabupaten Sampang',16),(255,'Kabupaten Sidoarjo',16),(256,'Kabupaten Situbondo',16),(257,'Kabupaten Sumenep',16),(258,'Kabupaten Trenggalek',16),(259,'Kabupaten Tuban',16),(260,'Kabupaten Tulungagung',16),(261,'Kota Batu',16),(262,'Kota Blitar',16),(263,'Kota Kediri',16),(264,'Kota Madiun',16),(265,'Kota Malang',16),(266,'Kota Mojokerto',16),(267,'Kota Pasuruan',16),(268,'Kota Probolinggo',16),(269,'Kota Surabaya',16),(270,'Kabupaten Badung',17),(271,'Kabupaten Bangli',17),(272,'Kabupaten Buleleng',17),(273,'Kabupaten Gianyar',17),(274,'Kabupaten Jembrana',17),(275,'Kabupaten Karang Asem',17),(276,'Kabupaten Klungkung',17),(277,'Kabupaten Tabanan',17),(278,'Kota Denpasar',17),(279,'Kabupaten Bima',18),(280,'Kabupaten Dompu',18),(281,'Kabupaten Lombok Barat',18),(282,'Kabupaten Lombok Tengah',18),(283,'Kabupaten Lombok Timur',18),(284,'Kabupaten Lombok Utara',18),(285,'Kabupaten Sumbawa',18),(286,'Kabupaten Sumbawa Barat',18),(287,'Kota Bima',18),(288,'Kota Mataram',18),(289,'Kabupaten Alor',19),(290,'Kabupaten Belu',19),(291,'Kabupaten Ende',19),(292,'Kabupaten Flores Timur',19),(293,'Kabupaten Kupang',19),(294,'Kabupaten Lembata',19),(295,'Kabupaten Manggarai',19),(296,'Kabupaten Manggarai Barat',19),(297,'Kabupaten Manggarai Timur',19),(298,'Kabupaten Nagekeo',19),(299,'Kabupaten Ngada',19),(300,'Kabupaten Rote Ndao',19),(301,'Kabupaten Sabu Raijua',19),(302,'Kabupaten Sikka',19),(303,'Kabupaten Sumba Barat',19),(304,'Kabupaten Sumba Barat Daya',19),(305,'Kabupaten Sumba Tengah',19),(306,'Kabupaten Sumba Timur',19),(307,'Kabupaten Timor Tengah Selatan',19),(308,'Kabupaten Timor Tengah Utara',19),(309,'Kota Kupang',19),(310,'Kabupaten Bengkayang',20),(311,'Kabupaten Kapuas Hulu',20),(312,'Kabupaten Kayong Utara',20),(313,'Kabupaten Ketapang',20),(314,'Kabupaten Kubu Raya',20),(315,'Kabupaten Landak',20),(316,'Kabupaten Melawi',20),(317,'Kabupaten Pontianak',20),(318,'Kabupaten Sambas',20),(319,'Kabupaten Sanggau',20),(320,'Kabupaten Sekadau',20),(321,'Kabupaten Sintang',20),(322,'Kota Pontianak',20),(323,'Kota Singkawang',20),(324,'Kabupaten Barito Selatan',21),(325,'Kabupaten Barito Timur',21),(326,'Kabupaten Barito Utara',21),(327,'Kabupaten Gunung Mas',21),(328,'Kabupaten Kapuas',21),(329,'Kabupaten Katingan',21),(330,'Kabupaten Kotawaringin Barat',21),(331,'Kabupaten Kotawaringin Timur',21),(332,'Kabupaten Lamandau',21),(333,'Kabupaten Murung Raya',21),(334,'Kabupaten Pulang Pisau',21),(335,'Kabupaten Seruyan',21),(336,'Kabupaten Sukamara',21),(337,'Kota Palangkaraya',21),(338,'Kabupaten Balangan',22),(339,'Kabupaten Banjar',22),(340,'Kabupaten Barito Kuala',22),(341,'Kabupaten Hulu Sungai Selatan',22),(342,'Kabupaten Hulu Sungai Tengah',22),(343,'Kabupaten Hulu Sungai Utara',22),(344,'Kabupaten Kota Baru',22),(345,'Kabupaten Tabalong',22),(346,'Kabupaten Tanah Bumbu',22),(347,'Kabupaten Tanah Laut',22),(348,'Kabupaten Tapin',22),(349,'Kota Banjar Baru',22),(350,'Kota Banjarmasin',22),(351,'Kabupaten Berau',23),(352,'Kabupaten Bulongan',23),(353,'Kabupaten Kutai Barat',23),(354,'Kabupaten Kutai Kartanegara',23),(355,'Kabupaten Kutai Timur',23),(356,'Kabupaten Malinau',23),(357,'Kabupaten Nunukan',23),(358,'Kabupaten Paser',23),(359,'Kabupaten Penajam Paser Utara',23),(360,'Kabupaten Tana Tidung',23),(361,'Kota Balikpapan',23),(362,'Kota Bontang',23),(363,'Kota Samarinda',23),(364,'Kota Tarakan',23),(365,'Kabupaten Boalemo',24),(366,'Kabupaten Bone Bolango',24),(367,'Kabupaten Gorontalo',24),(368,'Kabupaten Gorontalo Utara',24),(369,'Kabupaten Pohuwato',24),(370,'Kota Gorontalo',24),(371,'Kabupaten Bantaeng',25),(372,'Kabupaten Barru',25),(373,'Kabupaten Bone',25),(374,'Kabupaten Bulukumba',25),(375,'Kabupaten Enrekang',25),(376,'Kabupaten Gowa',25),(377,'Kabupaten Jeneponto',25),(378,'Kabupaten Luwu',25),(379,'Kabupaten Luwu Timur',25),(380,'Kabupaten Luwu Utara',25),(381,'Kabupaten Maros',25),(382,'Kabupaten Pangkajene Kepulauan',25),(383,'Kabupaten Pinrang',25),(384,'Kabupaten Selayar',25),(385,'Kabupaten Sidenreng Rappang',25),(386,'Kabupaten Sinjai',25),(387,'Kabupaten Soppeng',25),(388,'Kabupaten Takalar',25),(389,'Kabupaten Tana Toraja',25),(390,'Kabupaten Toraja Utara',25),(391,'Kabupaten Wajo',25),(392,'Kota Makassar',25),(393,'Kota Palopo',25),(394,'Kota Pare-pare',25),(395,'Kabupaten Bombana',26),(396,'Kabupaten Buton',26),(397,'Kabupaten Buton Utara',26),(398,'Kabupaten Kolaka',26),(399,'Kabupaten Kolaka Utara',26),(400,'Kabupaten Konawe',26),(401,'Kabupaten Konawe Selatan',26),(402,'Kabupaten Konawe Utara',26),(403,'Kabupaten Muna',26),(404,'Kabupaten Wakatobi',26),(405,'Kota Bau-bau',26),(406,'Kota Kendari',26),(407,'Kabupaten Banggai',27),(408,'Kabupaten Banggai Kepulauan',27),(409,'Kabupaten Buol',27),(410,'Kabupaten Donggala',27),(411,'Kabupaten Morowali',27),(412,'Kabupaten Parigi Moutong',27),(413,'Kabupaten Poso',27),(414,'Kabupaten Sigi',27),(415,'Kabupaten Tojo Una-Una',27),(416,'Kabupaten Toli Toli',27),(417,'Kota Palu',27),(418,'Kabupaten Bolaang Mangondow',28),(419,'Kabupaten Bolaang Mangondow Se',28),(420,'Kabupaten Bolaang Mangondow Ti',28),(421,'Kabupaten Bolaang Mangondow Ut',28),(422,'Kabupaten Kepulauan Sangihe',28),(423,'Kabupaten Kepulauan Siau Tagul',28),(424,'Kabupaten Kepulauan Talaud',28),(425,'Kabupaten Minahasa',28),(426,'Kabupaten Minahasa Selatan',28),(427,'Kabupaten Minahasa Tenggara',28),(428,'Kabupaten Minahasa Utara',28),(429,'Kota Bitung',28),(430,'Kota Kotamobagu',28),(431,'Kota Manado',28),(432,'Kota Tomohon',28),(433,'Kabupaten Majene',29),(434,'Kabupaten Mamasa',29),(435,'Kabupaten Mamuju',29),(436,'Kabupaten Mamuju Utara',29),(437,'Kabupaten Polewali Mandar',29),(438,'Kabupaten Buru',30),(439,'Kabupaten Buru Selatan',30),(440,'Kabupaten Kepulauan Aru',30),(441,'Kabupaten Maluku Barat Daya',30),(442,'Kabupaten Maluku Tengah',30),(443,'Kabupaten Maluku Tenggara',30),(444,'Kabupaten Maluku Tenggara Bara',30),(445,'Kabupaten Seram Bagian Barat',30),(446,'Kabupaten Seram Bagian Timur',30),(447,'Kota Ambon',30),(448,'Kota Tual',30),(449,'Kabupaten Halmahera Barat',31),(450,'Kabupaten Halmahera Selatan',31),(451,'Kabupaten Halmahera Tengah',31),(452,'Kabupaten Halmahera Timur',31),(453,'Kabupaten Halmahera Utara',31),(454,'Kabupaten Kepulauan Sula',31),(455,'Kabupaten Pulau Morotai',31),(456,'Kota Ternate',31),(457,'Kota Tidore Kepulauan',31),(458,'Kabupaten Fakfak',32),(459,'Kabupaten Kaimana',32),(460,'Kabupaten Manokwari',32),(461,'Kabupaten Maybrat',32),(462,'Kabupaten Raja Ampat',32),(463,'Kabupaten Sorong',32),(464,'Kabupaten Sorong Selatan',32),(465,'Kabupaten Tambrauw',32),(466,'Kabupaten Teluk Bintuni',32),(467,'Kabupaten Teluk Wondama',32),(468,'Kota Sorong',32),(469,'Kabupaten Merauke',33),(470,'Kabupaten Jayawijaya',33),(471,'Kabupaten Nabire',33),(472,'Kabupaten Kepulauan Yapen',33),(473,'Kabupaten Biak Numfor',33),(474,'Kabupaten Paniai',33),(475,'Kabupaten Puncak Jaya',33),(476,'Kabupaten Mimika',33),(477,'Kabupaten Boven Digoel',33),(478,'Kabupaten Mappi',33),(479,'Kabupaten Asmat',33),(480,'Kabupaten Yahukimo',33),(481,'Kabupaten Pegunungan Bintang',33),(482,'Kabupaten Tolikara',33),(483,'Kabupaten Sarmi',33),(484,'Kabupaten Keerom',33),(485,'Kabupaten Waropen',33),(486,'Kabupaten Jayapura',33),(487,'Kabupaten Deiyai',33),(488,'Kabupaten Dogiyai',33),(489,'Kabupaten Intan Jaya',33),(490,'Kabupaten Lanny Jaya',33),(491,'Kabupaten Mamberamo Raya',33),(492,'Kabupaten Mamberamo Tengah',33),(493,'Kabupaten Nduga',33),(494,'Kabupaten Puncak',33),(495,'Kabupaten Supiori',33),(496,'Kabupaten Yalimo',33),(497,'Kota Jayapura',33),(498,'Kabupaten Bulungan',34),(499,'Kabupaten Malinau',34),(500,'Kabupaten Nunukan',34),(501,'Kabupaten Tana Tidung',34),(502,'Kota Tarakan',34);

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

insert  into `menu_web`(`id_menu`,`link_menu`,`icon_menu`,`label_menu`,`class_menu`,`count_data`) values (1,'transaksi_pembelian','icon-user','Transaksi Pembelian','badge badge-success pull-right','echo (isset($count_transaksi_pembelian)?$count_transaksi_pembelian:\"\");'),(2,'transaksi_penjualan','icon-user','Invoice','badge badge-success pull-right','echo (isset($count_transaksi_penjualan)?$count_transaksi_penjualan:\"\");'),(3,'transaksi_service','icon-user','Transaksi Service','badge badge-success pull-right',''),(4,'surat_jalan','icon-user','Surat Jalan','badge badge-warning pull-right','echo (isset($count_surat_jalan)?$count_surat_jalan:\"\");'),(5,'generate_invoice','icon-user','Generate Invoice','badge badge-important pull-right','echo (isset($count_invoice)?$count_invoice:\"\");'),(6,'generate_penawaran','icon-user','Generate Penawaran','badge badge-warning pull-right',''),(77,'spk','icon-user','SPK','badge badge-important pull-right',''),(78,'koreksi_invoice','icon-user','Koreksi Invoice','badge badge-warning pull-right','echo (isset($count_transaksi_penjualan)?$count_transaksi_penjualan:\"\");');

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_supplier` int(11) DEFAULT NULL COMMENT 'Supplier',
  `account_id` bigint(20) DEFAULT NULL COMMENT 'Pelayan',
  `order_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_transaksi` decimal(20,2) DEFAULT NULL,
  `keterangan` text,
  `currency` char(3) DEFAULT 'IDR',
  `payment_status` enum('lunas','hutang') DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `account_id` (`account_id`),
  KEY `kode_customer` (`kode_supplier`),
  CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`kode_supplier`) REFERENCES `supplier` (`kode_supplier`),
  CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `user` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian` */

insert  into `pembelian`(`order_id`,`kode_supplier`,`account_id`,`order_timestamp`,`total_transaksi`,`keterangan`,`currency`,`payment_status`) values (6,1,8,'2015-11-04 16:21:23',10000.00,'1','IDR','lunas'),(7,1,8,'2015-11-10 22:35:21',1000.00,'1','IDR','lunas'),(8,1,8,'2015-11-16 23:16:03',11111.00,'a','IDR','lunas');

/*Table structure for table `pembelian_detail` */

DROP TABLE IF EXISTS `pembelian_detail`;

CREATE TABLE `pembelian_detail` (
  `order_id` int(11) NOT NULL,
  `order_detail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_master_id` int(11) DEFAULT NULL COMMENT 'kode barang',
  `qty` int(11) DEFAULT NULL,
  `buying_price` decimal(20,2) DEFAULT NULL,
  `sub_total` decimal(12,2) DEFAULT NULL,
  `order_detail_status` enum('active','delete') DEFAULT 'active',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`order_detail_id`),
  KEY `order_detail_id` (`order_detail_id`),
  KEY `order_master_id` (`order_master_id`),
  CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `pembelian` (`order_id`) ON DELETE CASCADE,
  CONSTRAINT `pembelian_detail_ibfk_2` FOREIGN KEY (`order_master_id`) REFERENCES `master_barang` (`kode_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian_detail` */

insert  into `pembelian_detail`(`order_id`,`order_detail_id`,`order_master_id`,`qty`,`buying_price`,`sub_total`,`order_detail_status`,`created_timestamp`) values (6,7,1,1000,10.00,10000.00,'active','2015-11-04 16:21:23'),(7,8,1,10,100.00,1000.00,'active','2015-11-10 22:35:21'),(8,9,3,1,11111.00,11111.00,'active','2015-11-16 23:16:03');

/*Table structure for table `stok_barang` */

DROP TABLE IF EXISTS `stok_barang`;

CREATE TABLE `stok_barang` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_id_beli` int(11) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `status` enum('barangmasuk','barangkeluar') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_stok`),
  KEY `kode_barang` (`kode_barang`),
  KEY `order_detail_id` (`order_id`),
  KEY `stok_barang_ibfk_3` (`order_id_beli`),
  CONSTRAINT `stok_barang_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`),
  CONSTRAINT `stok_barang_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `transaksi_detail` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stok_barang_ibfk_3` FOREIGN KEY (`order_id_beli`) REFERENCES `pembelian_detail` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `stok_barang` */

insert  into `stok_barang`(`id_stok`,`kode_barang`,`order_id`,`order_id_beli`,`qty`,`harga_beli`,`status`,`timestamp`) values (1,1,NULL,7,10,100,'barangmasuk','2015-11-10 22:35:21'),(8,1,12,NULL,-1,NULL,'barangkeluar','2015-11-14 23:52:24'),(15,2,11,NULL,-2,NULL,'barangkeluar','2015-11-15 01:48:26'),(16,1,22,NULL,-1,NULL,'barangkeluar','2015-11-15 16:57:44'),(17,1,23,NULL,-1,NULL,'barangkeluar','2015-11-15 17:20:10'),(18,3,NULL,8,1,11111,'barangmasuk','2015-11-16 23:16:03');

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `kode_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telfon` varchar(12) DEFAULT NULL,
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`kode_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `supplier`(`kode_supplier`,`nama_supplier`,`email`,`alamat`,`no_telfon`,`hapus`) values (1,'PT. ABC','abc@gmail.com','jakarta','11111111',0);

/*Table structure for table `surat_jalan` */

DROP TABLE IF EXISTS `surat_jalan`;

CREATE TABLE `surat_jalan` (
  `id_surat_jalan` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `id_teknisi` bigint(20) DEFAULT NULL,
  `kirim_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_surat_jalan`),
  KEY `order_id` (`order_id`),
  KEY `id_teknisi` (`id_teknisi`),
  CONSTRAINT `surat_jalan_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `transaksi` (`order_id`),
  CONSTRAINT `surat_jalan_ibfk_2` FOREIGN KEY (`id_teknisi`) REFERENCES `user` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `surat_jalan` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_customer` int(11) DEFAULT NULL COMMENT 'Customer',
  `up_customer` varchar(255) DEFAULT NULL COMMENT 'diperuntukkan',
  `account_id` bigint(20) DEFAULT NULL COMMENT 'Pelayan',
  `order_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_customer_price` decimal(20,2) DEFAULT NULL,
  `pph` int(11) DEFAULT '0',
  `total_customer_pph` decimal(20,2) DEFAULT NULL,
  `currency` char(3) DEFAULT 'IDR',
  `payment_status` enum('lunas','hutang') DEFAULT NULL,
  `no_spk` varchar(255) DEFAULT '0' COMMENT 'Buat Generate No SPK',
  PRIMARY KEY (`order_id`),
  KEY `account_id` (`account_id`),
  KEY `kode_customer` (`kode_customer`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `user` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`kode_customer`) REFERENCES `customer` (`kode_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`order_id`,`kode_customer`,`up_customer`,`account_id`,`order_timestamp`,`total_customer_price`,`pph`,`total_customer_pph`,`currency`,`payment_status`,`no_spk`) values (11,1,'sss',8,'2015-11-14 23:49:19',444444.00,1,4444.44,'IDR','lunas','0'),(12,1,'ss',8,'2015-11-14 23:52:24',100000.00,1,1000.00,'IDR','lunas','0'),(13,4,'sam',8,'2015-11-15 00:00:36',150000.00,1,1500.00,'IDR','lunas','0'),(14,4,'sam',8,'2015-11-15 00:00:50',150000.00,1,1500.00,'IDR','lunas','0'),(15,4,'sam',8,'2015-11-15 00:01:00',150000.00,1,1500.00,'IDR','lunas','0'),(16,4,'sss',8,'2015-11-15 00:01:48',150000.00,1,1500.00,'IDR','lunas','0'),(17,4,'sss',8,'2015-11-15 00:03:55',150000.00,1,1500.00,'IDR','lunas','0'),(18,4,'sss',8,'2015-11-15 00:04:38',150000.00,1,1500.00,'IDR','lunas','0'),(19,4,'sss',8,'2015-11-15 00:05:40',150000.00,1,1500.00,'IDR','lunas','0'),(20,4,'sss',8,'2015-11-15 00:06:11',150000.00,1,1500.00,'IDR','lunas','0'),(21,4,'a',8,'2015-11-15 00:06:27',100000.00,1,1000.00,'IDR','lunas','0'),(22,1,'sss',8,'2015-11-15 16:57:44',150000.00,1,1500.00,'IDR','lunas','0'),(23,4,'sss',8,'2015-11-15 17:20:10',200000.00,2,4000.00,'IDR','lunas','0');

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `order_id` int(11) NOT NULL,
  `order_detail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_master_id` int(11) NOT NULL COMMENT 'kode barang,0 = >pph',
  `qty` int(11) DEFAULT NULL,
  `selling_price` decimal(12,2) DEFAULT NULL COMMENT 'harga satuan,bila order_master_id 0 .selling_price berarti %',
  `sub_total` decimal(12,2) DEFAULT NULL COMMENT '@ x Qty',
  `order_detail_status` enum('active','delete') DEFAULT 'active',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`order_detail_id`,`order_master_id`),
  KEY `order_detail_id` (`order_detail_id`),
  KEY `order_master_id` (`order_master_id`),
  CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`order_master_id`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_detail_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `transaksi` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

insert  into `transaksi_detail`(`order_id`,`order_detail_id`,`order_master_id`,`qty`,`selling_price`,`sub_total`,`order_detail_status`,`created_timestamp`) values (11,27,2,2,222222.00,444444.00,'active','2015-11-15 01:48:26'),(12,16,1,1,100000.00,100000.00,'active','2015-11-14 23:52:24'),(15,17,2,15,10000.00,150000.00,'active','2015-11-15 00:01:00'),(16,18,2,10,15000.00,150000.00,'active','2015-11-15 00:01:48'),(20,19,2,10,15000.00,150000.00,'active','2015-11-15 00:06:11'),(21,20,2,1,100000.00,100000.00,'active','2015-11-15 00:06:27'),(22,28,1,1,150000.00,150000.00,'active','2015-11-15 16:57:44'),(23,29,1,1,200000.00,200000.00,'active','2015-11-15 17:20:10');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `account_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `keterangan` enum('teknisi','admin','kurir','root') DEFAULT NULL,
  `id_menu` varchar(255) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `hapus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`account_id`,`nama`,`email`,`password`,`keterangan`,`id_menu`,`lastlogin`,`regdate`,`status`,`hapus`) values (7,'Samuel','sam@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','admin','1,3,4,5,6,7,8,9,10,11,12,13,14','2015-11-16 03:39:50','2015-10-15 04:42:41',1,0),(8,'Admin','admin@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','admin','1,2,3,4,5,6,7,8,9,10,11,12,13,14','2015-11-16 06:33:02','2015-10-15 04:42:41',1,0),(9,'Martin','martin@gmail.com','21232f297a57a5a743894a0e4a801fc3','kurir','1,2,3,4,5,6,7,8,9,10,11,12,13,14','2015-11-05 03:41:35','2015-10-19 01:19:26',1,0),(10,'kurir','kurir@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','kurir',NULL,NULL,NULL,0,0),(11,'teknisi','teknisi@gmail.com','6894e45cd6c8b887f52ae3b59d8f15dc','teknisi',NULL,NULL,NULL,0,0),(12,'jomblo','jomjo@gmail.com','202cb962ac59075b964b07152d234b70','root',NULL,NULL,'2015-11-13 07:38:34',1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
