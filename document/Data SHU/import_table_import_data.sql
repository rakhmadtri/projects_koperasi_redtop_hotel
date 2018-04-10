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

/*Table structure for table `import_data` */

DROP TABLE IF EXISTS `import_data`;

CREATE TABLE `import_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_type` enum('elektronik','lain_lain','pinjaman','pos') DEFAULT NULL,
  `nominal` decimal(20,2) DEFAULT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `import_data` */

LOCK TABLES `import_data` WRITE;

insert  into `import_data`(`id`,`transaksi_type`,`nominal`,`created_timestamp`) values (1,'pinjaman',57863199.98,'2016-12-31 00:00:00'),(2,'lain_lain',8086250.33,'2016-12-31 00:00:00'),(3,'pos',2855950.00,'2016-12-31 00:00:00'),(4,'elektronik',7172096.00,'2016-12-31 00:00:00');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
