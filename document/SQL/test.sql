/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.25 : Database - mitrasecure
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mitrasecure` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mitrasecure`;

/*Table structure for table `data_pesanan_detail` */

DROP TABLE IF EXISTS `data_pesanan_detail`;

CREATE TABLE `data_pesanan_detail` (
  `order_id` bigint(20) DEFAULT NULL,
  `order_detail_id` bigint(20) DEFAULT NULL,
  `order_type` enum('antivirus','payment') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_master_id` bigint(20) DEFAULT NULL COMMENT 'id barang',
  `order_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nama dari product',
  `qty` bigint(20) DEFAULT '0',
  `selling_currency` varchar(3) CHARACTER SET utf8 DEFAULT 'IDR' COMMENT 'currency',
  `selling_price` decimal(12,2) DEFAULT '0.00' COMMENT 'harga barang',
  `total_price` decimal(12,2) DEFAULT '0.00',
  `order_detail_status` enum('active','recheck','deleted','refund') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'active',
  `created_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'pertama kali order tersebut di create',
  KEY `order_id` (`order_id`,`order_detail_status`,`order_type`,`order_detail_id`),
  KEY `order_master_id` (`order_master_id`,`order_type`,`order_detail_status`),
  KEY `created_timestamp` (`created_timestamp`),
  KEY `order_type` (`order_type`,`order_detail_status`),
  KEY `order_detail_id` (`order_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
/*!50100 PARTITION BY RANGE (order_id)
(PARTITION p0000 VALUES LESS THAN (0) ENGINE = InnoDB,
 PARTITION p0001 VALUES LESS THAN (1000000) ENGINE = InnoDB,
 PARTITION p0002 VALUES LESS THAN (2000000) ENGINE = InnoDB,
 PARTITION p0003 VALUES LESS THAN (3000000) ENGINE = InnoDB,
 PARTITION p0004 VALUES LESS THAN (4000000) ENGINE = InnoDB,
 PARTITION p0005 VALUES LESS THAN (5000000) ENGINE = InnoDB,
 PARTITION p0006 VALUES LESS THAN (6000000) ENGINE = InnoDB,
 PARTITION p0007 VALUES LESS THAN (7000000) ENGINE = InnoDB,
 PARTITION p0008 VALUES LESS THAN (8000000) ENGINE = InnoDB,
 PARTITION p0009 VALUES LESS THAN (9000000) ENGINE = InnoDB,
 PARTITION p0010 VALUES LESS THAN (10000000) ENGINE = InnoDB,
 PARTITION p9999 VALUES LESS THAN MAXVALUE ENGINE = InnoDB) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
