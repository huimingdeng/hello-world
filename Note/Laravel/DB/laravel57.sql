/*
Navicat MySQL Data Transfer

Source Server         : laravel57@localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : laravel57

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-01-23 16:42:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_user
-- ----------------------------
DROP TABLE IF EXISTS `app_user`;
CREATE TABLE `app_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户编号',
  `app_type` int(11) NOT NULL COMMENT 'app类型',
  `app_user_id` int(11) NOT NULL COMMENT 'app用户ID',
  `access_token` varchar(100) NOT NULL COMMENT '令牌',
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_user_id` (`app_user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `app_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方登陆信息表,设计不完整';

-- ----------------------------
-- Records of app_user
-- ----------------------------

-- ----------------------------
-- Table structure for catagories
-- ----------------------------
DROP TABLE IF EXISTS `catagories`;
CREATE TABLE `catagories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pubdate` datetime DEFAULT NULL,
  `editdate` datetime DEFAULT NULL,
  `pid` int(10) unsigned DEFAULT NULL COMMENT '父编号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniquename` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of catagories
-- ----------------------------
INSERT INTO `catagories` VALUES ('1', 'cDNA Clone', 'orf_cdna_clone', 'cDNA克隆', '2019-01-22 06:51:03', '2019-01-22 06:51:03', null);

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品标识主键',
  `goods_name` varchar(50) NOT NULL COMMENT '商品名',
  `price` int(11) NOT NULL COMMENT '商品价格',
  `disprice` int(11) NOT NULL COMMENT '商品折扣价',
  `pubdate` int(11) NOT NULL COMMENT '发布时间Unix时间戳',
  `editdate` int(11) DEFAULT NULL COMMENT '修改时间',
  `cid` int(11) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `goods_name` (`goods_name`),
  KEY `foreignkey_cid` (`cid`),
  CONSTRAINT `foreignkey_cid` FOREIGN KEY (`cid`) REFERENCES `catagories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='商品表-验证事务功能-未完成';

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', 'LPP-NEG-Lv105-025-C', '1024', '819', '1548140458', '1548140458', '1', null);
INSERT INTO `goods` VALUES ('5', 'LPP-NEG-Lv105-100-C', '1024', '819', '1548140883', '1548140883', '1', null);
INSERT INTO `goods` VALUES ('6', 'LPP-EGFP-Lv105-100-C', '1024', '819', '1548141269', '1548141269', '1', null);
INSERT INTO `goods` VALUES ('7', 'LPP-EGFP-Lv105-025-C', '924', '739', '1548141329', '1548141329', '1', null);
INSERT INTO `goods` VALUES ('8', 'ULP-NEG-Lv105-025-C', '950', '855', '1548171446', '1548171446', '1', null);
INSERT INTO `goods` VALUES ('9', 'ULP-NEG-Lv105-100-C', '1000', '900', '1548171671', '1548171671', '1', null);
INSERT INTO `goods` VALUES ('10', 'ULP-EGFP-Lv105-025-C', '980', '882', '1548171743', '1548171743', '1', null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名，唯一',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称,唯一',
  `email` varchar(50) NOT NULL COMMENT '邮件',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机86135...',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `Postcode` varchar(10) NOT NULL COMMENT '邮政编码',
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `status` int(2) NOT NULL COMMENT '状态-0-1-2',
  `registertime` int(11) DEFAULT NULL COMMENT '注册时间Unix',
  `registerip` varchar(20) DEFAULT NULL COMMENT '注册IP',
  `logintime` int(11) DEFAULT NULL COMMENT '登录时间Unix',
  `loginip` varchar(20) DEFAULT NULL COMMENT '登陆IP',
  `logincount` int(11) DEFAULT NULL COMMENT '登陆次数',
  `role` int(11) DEFAULT NULL COMMENT '角色',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`nickname`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
