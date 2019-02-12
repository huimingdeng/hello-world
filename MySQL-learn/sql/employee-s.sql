/*
Navicat MySQL Data Transfer

Source Server         : localDB
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : testdb

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-23 14:37:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `sex` tinyint(3) unsigned zerofill DEFAULT NULL,
  `age` int(10) DEFAULT NULL,
  `income` double(16,2) DEFAULT NULL,
  `dprtid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `depart_id` (`dprtid`),
  CONSTRAINT `depart_id` FOREIGN KEY (`dprtid`) REFERENCES `depart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
DROP TRIGGER IF EXISTS `trigger_update_num`;
DELIMITER ;;
CREATE TRIGGER `trigger_update_num` AFTER INSERT ON `employee` FOR EACH ROW BEGIN
      UPDATE `depart` SET num=num+1 WHERE id=NEW.dprtid;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_delete_num`;
DELIMITER ;;
CREATE TRIGGER `trigger_delete_num` AFTER DELETE ON `employee` FOR EACH ROW BEGIN
    UPDATE `depart` SET num=num-1 WHERE id = OLD.dprtid;
END
;;
DELIMITER ;
