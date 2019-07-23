/*
Navicat MySQL Data Transfer

Source Server         : user-root@localhost@phpStudy2018
Source Server Version : 50725
Source Host           : localhost:3306
Source Database       : studentscore

Target Server Type    : MYSQL
Target Server Version : 50725
File Encoding         : 65001

Date: 2019-07-23 17:01:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for studentscore
-- ----------------------------
DROP TABLE IF EXISTS `studentscore`;
CREATE TABLE `studentscore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` int(11) DEFAULT NULL,
  `student` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `score` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of studentscore
-- ----------------------------
INSERT INTO `studentscore` VALUES ('1', '1', 'Jim', '语文', '100');
INSERT INTO `studentscore` VALUES ('2', '1', 'Jim', '数学', '99');
INSERT INTO `studentscore` VALUES ('3', '1', 'Jim', '英语', '79');
INSERT INTO `studentscore` VALUES ('4', '1', 'Jim', '数学', '99');
INSERT INTO `studentscore` VALUES ('5', '1', 'Lucy', '语文', '92');
INSERT INTO `studentscore` VALUES ('6', '1', 'Lucy', '数学', '87');
INSERT INTO `studentscore` VALUES ('7', '1', 'Lucy', '英语', '98');
INSERT INTO `studentscore` VALUES ('8', '1', 'Tom', '语文', '81');
INSERT INTO `studentscore` VALUES ('9', '1', 'Tom', '数学', '100');
INSERT INTO `studentscore` VALUES ('10', '1', 'Tom', '英语', '99');
INSERT INTO `studentscore` VALUES ('11', '1', 'Tom', '语文', '81');
