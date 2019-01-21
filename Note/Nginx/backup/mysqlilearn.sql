/*
Navicat MySQL Data Transfer

Source Server         : root@123.207.74.118
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : mysqlilearn

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-01-21 10:14:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `passwd` varchar(128) NOT NULL COMMENT 'md5加密密码',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `email` varchar(50) NOT NULL COMMENT '联系邮箱',
  `phone` varchar(18) DEFAULT NULL COMMENT '联系电话',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'huimingdeng', '426147691c5781ca4e2f3fe391ca8b1e', 'ming', '1458575181@qq.com', '13570313864', null);
