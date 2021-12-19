/*
SQLyog Community v13.1.5  (32 bit)
MySQL - 5.7.36 : Database - retailmart
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`retailmart` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `retailmart`;

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ssnorderid` varchar(255) NOT NULL,
  `orderid` int(11) unsigned NOT NULL DEFAULT '0',
  `itemid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) unsigned NOT NULL DEFAULT '0',
  `isfree` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `cart` */

insert  into `cart`(`id`,`ssnorderid`,`orderid`,`itemid`,`name`,`price`,`qty`,`isfree`) values 
(1,'cf1ba65f-c64f-4c5f-a33b-9637b5502a04',0,2,'Vegetables ',50.00,3,'0'),
(18,'1b88eceb-8d11-4ddd-b374-df688f9885c4',0,2,'Vegetables ',50.00,1,'0'),
(3,'cf1ba65f-c64f-4c5f-a33b-9637b5502a04',0,3,'Ready to Eatables',75.00,3,'0'),
(4,'cf1ba65f-c64f-4c5f-a33b-9637b5502a04',0,2,'Vegetables ',50.00,1,'0'),
(5,'cf1ba65f-c64f-4c5f-a33b-9637b5502a04',0,5,'Bakery item',30.00,4,'0'),
(6,'cf1ba65f-c64f-4c5f-a33b-9637b5502a04',0,4,'Grocery ',25.00,2,'0'),
(7,'cf1ba65f-c64f-4c5f-a33b-9637b5502a04',0,4,'Grocery ',25.00,1,'0'),
(8,'cf1ba65f-c64f-4c5f-a33b-9637b5502a04',0,4,'Grocery ',25.00,1,'0'),
(10,'cf1ba65f-c64f-4c5f-a33b-9637b5502a04',0,1,'Fruits ',100.00,1,'0'),
(20,'5c952ec6-937f-469a-8da5-2d3efcaea892',0,1,'Fruits ',100.00,3,'0'),
(19,'1b88eceb-8d11-4ddd-b374-df688f9885c4',0,3,'Ready to Eatables',75.00,1,'0'),
(17,'1b88eceb-8d11-4ddd-b374-df688f9885c4',0,1,'Fruits ',100.00,1,'0'),
(21,'5c952ec6-937f-469a-8da5-2d3efcaea892',0,1,'Fruits ',100.00,1,'0'),
(22,'5c952ec6-937f-469a-8da5-2d3efcaea892',0,1,'Fruits ',100.00,1,'0'),
(23,'5c952ec6-937f-469a-8da5-2d3efcaea892',0,1,'Fruits ',100.00,1,'0'),
(24,'5c952ec6-937f-469a-8da5-2d3efcaea892',0,6,'Dry Fruits',300.00,1,'0'),
(25,'cafa9226-6660-4ac7-9664-3058edde25e0',0,1,'Fruits ',100.00,1,'0'),
(26,'cafa9226-6660-4ac7-9664-3058edde25e0',0,2,'Vegetables ',50.00,1,'0'),
(27,'cafa9226-6660-4ac7-9664-3058edde25e0',0,3,'Ready to Eatables',75.00,1,'0'),
(28,'cafa9226-6660-4ac7-9664-3058edde25e0',0,4,'Grocery ',25.00,1,'0'),
(29,'cafa9226-6660-4ac7-9664-3058edde25e0',0,6,'Dry Fruits',300.00,3,'0'),
(30,'cafa9226-6660-4ac7-9664-3058edde25e0',0,5,'Bakery item',0.00,1,'1');

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-In Active,1-Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `items` */

insert  into `items`(`id`,`name`,`price`,`status`) values 
(1,'Fruits ',100.00,'1'),
(2,'Vegetables ',50.00,'1'),
(3,'Ready to Eatables',75.00,'1'),
(4,'Grocery ',25.00,'1'),
(5,'Bakery item',30.00,'1'),
(6,'Dry Fruits',300.00,'1');

/*Table structure for table `orderidgen` */

DROP TABLE IF EXISTS `orderidgen`;

CREATE TABLE `orderidgen` (
  `orderid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `orderidgen` */

insert  into `orderidgen`(`orderid`) values 
(1);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ssnorderid` varchar(255) NOT NULL,
  `orderid` int(11) unsigned NOT NULL DEFAULT '0',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discamt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cashdisc` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amttopay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paytype` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0-None,1-Cash,2-Credit',
  `paidstatus` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-UnPaid,1-Paid',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`ssnorderid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`id`,`ssnorderid`,`orderid`,`total`,`discamt`,`cashdisc`,`amttopay`,`paytype`,`paidstatus`) values 
(1,'cf1ba65f-c64f-4c5f-a33b-9637b5502a04',0,745.00,74.50,0.00,0.00,'0','0'),
(6,'1b88eceb-8d11-4ddd-b374-df688f9885c4',0,225.00,0.00,0.00,225.00,'2','1'),
(7,'5c952ec6-937f-469a-8da5-2d3efcaea892',0,900.00,90.00,16.20,793.80,'1','1'),
(8,'cafa9226-6660-4ac7-9664-3058edde25e0',1,1150.00,115.00,0.00,1035.00,'2','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
