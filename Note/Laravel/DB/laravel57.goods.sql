/*
Navicat MySQL Data Transfer

Source Server         : laravel57@localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : laravel57

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-01-14 15:04:40
*/

SET FOREIGN_KEY_CHECKS=0;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='商品表-验证事务功能-未完成';
