/*
Navicat MySQL Data Transfer

Source Server         : root@123.207.74.118
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : blogdb

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-01-21 10:14:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for adminuser
-- ----------------------------
DROP TABLE IF EXISTS `adminuser`;
CREATE TABLE `adminuser` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL COMMENT '用户名',
  `nickname` varchar(128) DEFAULT NULL COMMENT '昵称',
  `password` varchar(128) NOT NULL COMMENT '密码',
  `email` varchar(128) NOT NULL COMMENT '邮箱',
  `profile` text COMMENT '头像',
  `auth_key` varchar(32) NOT NULL COMMENT '验证字段',
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adminuser
-- ----------------------------
INSERT INTO `adminuser` VALUES ('1', 'huimingdeng', '邓晖明', '*', 'huimingdeng@fulengen.com', '超级管理员', '_OEVXlllxIKVmf_AfoAhK8AydaBwhQ1I', '$2y$13$972hb.Nv29Bw5MbGrOvriejuq5GfMqc8tln19jFV4kh61SP.lSzay', null);
INSERT INTO `adminuser` VALUES ('2', 'zaisuoliu', '再梭', '*1', '1458575181@qq.com', '文章管理员', '9Fnzkdaw7WooOG4vTBk0N2o5h_X9ZqgE', '$2y$13$AUgYZJSisXh8aAEThn7cqOMZhP.woBhJCc/i4aFBA8lbjuPLAcOOS', null);

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('admin', '1', '1524038235');
INSERT INTO `auth_assignment` VALUES ('commentAuditor', '4', '1524038235');
INSERT INTO `auth_assignment` VALUES ('postAdmin', '2', '1524038235');
INSERT INTO `auth_assignment` VALUES ('postOperator', '3', '1524038235');

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('admin', '1', '系统管理员', null, null, '1524038235', '1524038235');
INSERT INTO `auth_item` VALUES ('approveComment', '2', '审核评论', null, null, '1524038235', '1524038235');
INSERT INTO `auth_item` VALUES ('commentAuditor', '1', '评论审核员', null, null, '1524038235', '1524038235');
INSERT INTO `auth_item` VALUES ('createPost', '2', '新增文章', null, null, '1524038235', '1524038235');
INSERT INTO `auth_item` VALUES ('deletePost', '2', '删除文章', null, null, '1524038235', '1524038235');
INSERT INTO `auth_item` VALUES ('postAdmin', '1', '文章管理员', null, null, '1524038235', '1524038235');
INSERT INTO `auth_item` VALUES ('postOperator', '1', '文章操作员', null, null, '1524038235', '1524038235');
INSERT INTO `auth_item` VALUES ('updatePost', '2', '修改文章', null, null, '1524038235', '1524038235');

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('commentAuditor', 'approveComment');
INSERT INTO `auth_item_child` VALUES ('admin', 'commentAuditor');
INSERT INTO `auth_item_child` VALUES ('postAdmin', 'createPost');
INSERT INTO `auth_item_child` VALUES ('postAdmin', 'deletePost');
INSERT INTO `auth_item_child` VALUES ('postOperator', 'deletePost');
INSERT INTO `auth_item_child` VALUES ('admin', 'postAdmin');
INSERT INTO `auth_item_child` VALUES ('postAdmin', 'updatePost');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL COMMENT '分类名称',
  `description` text COMMENT '分类描述，参照wp',
  `slug` varchar(128) NOT NULL COMMENT '别名',
  `frequency` int(11) unsigned zerofill DEFAULT '00000000000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '未分类', '默认发布文章分类', 'uncategorized', '00000000000');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `status` int(11) unsigned DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `postid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_postid` (`postid`),
  KEY `fk_status` (`status`),
  KEY `fk_userid` (`userid`),
  CONSTRAINT `fk_postid` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status` FOREIGN KEY (`status`) REFERENCES `commentstatus` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for commentstatus
-- ----------------------------
DROP TABLE IF EXISTS `commentstatus`;
CREATE TABLE `commentstatus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL COMMENT '评论状态',
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of commentstatus
-- ----------------------------

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1523518041');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1523518063');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1524034795');
INSERT INTO `migration` VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', '1524034795');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `tags` text,
  `categoryid` int(11) unsigned DEFAULT '1',
  `status` int(11) unsigned DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_autho` (`author_id`) USING BTREE,
  KEY `fk_categoryid` (`categoryid`),
  KEY `fk_poststatus` (`status`),
  CONSTRAINT `fk_author` FOREIGN KEY (`author_id`) REFERENCES `adminuser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_categoryid` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_poststatus` FOREIGN KEY (`status`) REFERENCES `poststatus` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------

-- ----------------------------
-- Table structure for poststatus
-- ----------------------------
DROP TABLE IF EXISTS `poststatus`;
CREATE TABLE `poststatus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章状态主键，作为关联用',
  `name` varchar(128) NOT NULL COMMENT '文章状态',
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of poststatus
-- ----------------------------
INSERT INTO `poststatus` VALUES ('1', '草稿', null);
INSERT INTO `poststatus` VALUES ('2', '已发布', null);
INSERT INTO `poststatus` VALUES ('3', '审核中', null);
INSERT INTO `poststatus` VALUES ('4', '不通过', null);
INSERT INTO `poststatus` VALUES ('5', '已删除', null);

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL COMMENT '标签名',
  `frequency` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'huimingdeng', 'oq1jmUPdfnB2-L0zoqAyKzuguBba3-nl', '$2y$13$E/AtZVfQNiD53YMi.m2e2OzSmf4IBhnTn.yizp08aBqFccC4gP602', null, 'huimingdeng@fulengen.com', '10', '1523518257', '1523518257');
DROP TRIGGER IF EXISTS `add_total_category`;
DELIMITER ;;
CREATE TRIGGER `add_total_category` AFTER INSERT ON `posts` FOR EACH ROW BEGIN
      UPDATE `category` SET frequency=frequency+1 WHERE id=NEW.categoryid;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `del_total_category`;
DELIMITER ;;
CREATE TRIGGER `del_total_category` AFTER DELETE ON `posts` FOR EACH ROW BEGIN
      UPDATE `category` SET frequency=frequency-1 WHERE id=OLD.categoryid;
END
;;
DELIMITER ;
