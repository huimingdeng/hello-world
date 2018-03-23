/*
Navicat MySQL Data Transfer

Source Server         : localDB
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : testdb

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-23 14:39:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for depart
-- ----------------------------
DROP TABLE IF EXISTS `depart`;
CREATE TABLE `depart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dname` varchar(20) NOT NULL,
  `num` int(10) unsigned zerofill DEFAULT '0000000000',
  `comid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `dname` (`dname`),
  KEY `fk_comid` (`comid`),
  CONSTRAINT `fk_comid` FOREIGN KEY (`comid`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
DROP TRIGGER IF EXISTS `trigger_delete_employee`;
DELIMITER ;;
CREATE TRIGGER `trigger_delete_employee` AFTER DELETE ON `depart` FOR EACH ROW BEGIN
    DELETE FROM `employee` WHERE dprtid = OLD.id;
END
;;
DELIMITER ;
