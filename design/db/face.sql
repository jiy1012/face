/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : localhost
 Source Database       : face

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : utf-8

 Date: 08/21/2016 19:08:17 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `app_passport`
-- ----------------------------
DROP TABLE IF EXISTS `app_passport`;
CREATE TABLE `app_passport` (
  `uid` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户uid',
  `email` varchar(128) NOT NULL DEFAULT '' COMMENT '邮箱',
  `username` varchar(128) NOT NULL DEFAULT '' COMMENT '用户名',
  `phone` varchar(24) NOT NULL DEFAULT '' COMMENT '手机号',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='注册账号密码表';

-- ----------------------------
--  Table structure for `id_generator`
-- ----------------------------
DROP TABLE IF EXISTS `id_generator`;
CREATE TABLE `id_generator` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='id申请生成表';

-- ----------------------------
--  Table structure for `user_profile`
-- ----------------------------
DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile` (
  `uid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'uid',
  `nickname` varchar(128) NOT NULL DEFAULT '' COMMENT '昵称',
  `head_img` varchar(128) NOT NULL DEFAULT '' COMMENT '头像url',
  `twitter` varchar(512) NOT NULL DEFAULT '' COMMENT '说说',
  `introduction` text NOT NULL COMMENT '个人简介',
  `area` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '地区',
  `profession` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '行业',
  `company` varchar(128) NOT NULL DEFAULT '' COMMENT '公司',
  `job` varchar(128) NOT NULL DEFAULT '' COMMENT '职业',
  `school` varchar(128) NOT NULL DEFAULT '' COMMENT '学校',
  `major` varchar(56) NOT NULL DEFAULT '' COMMENT '专业',
  `reg_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '注册ip',
  `login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '登录ip',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
