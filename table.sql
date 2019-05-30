	/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50628
Source Host           : localhost:3306
Source Database       : myarticle

Target Server Type    : MYSQL
Target Server Version : 50628
File Encoding         : 65001

Date: 2019-03-30 11:00:47
*/

SET FOREIGN_KEY_CHECKS=0;

#- ----------------------------
#- Table structure for my_article
#- ----------------------------
DROP TABLE IF EXISTS `my_article`;
CREATE TABLE `my_article` (
  `articleid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(10) NOT NULL DEFAULT '0',
  `posttime` int(10) unsigned NOT NULL DEFAULT '0',
  `author` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  `clicktimes` int(10) unsigned NOT NULL DEFAULT '0',
  `rating` int(2) NOT NULL DEFAULT '0',
  `votes` smallint(6) NOT NULL DEFAULT '0',
  `ipaddress` varchar(16) NOT NULL DEFAULT '',
  `commentnum` smallint(8) NOT NULL DEFAULT '0',
  `published` enum('y','n') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`articleid`),
  KEY `postid` (`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#- ----------------------------
#- Records of my_article
#- ----------------------------

#- ----------------------------
#- Table structure for my_cate
#- ----------------------------
DROP TABLE IF EXISTS `my_cate`;
CREATE TABLE `my_cate` (
  `cateid` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `displayorder` int(3) unsigned NOT NULL DEFAULT '1',
  `parentid` int(3) unsigned NOT NULL DEFAULT '0',
  `articles` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#- ----------------------------
#- Records of my_cate
#- ----------------------------

#- ----------------------------
#- Table structure for my_comment
#- ----------------------------
DROP TABLE IF EXISTS `my_comment`;
CREATE TABLE `my_comment` (
  `commentid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `email` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#- ----------------------------
#- Records of my_comment
#- ----------------------------

#- ----------------------------
#- Table structure for my_page
#- ----------------------------
DROP TABLE IF EXISTS `my_page`;
CREATE TABLE `my_page` (
  `pageid` int(10) NOT NULL AUTO_INCREMENT,
  `articleid` smallint(6) NOT NULL DEFAULT '0',
  `pagenum` smallint(6) NOT NULL DEFAULT '0',
  `subtitle` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `dateline` smallint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pageid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#- ----------------------------
#- Records of my_page
#- ----------------------------

#- ----------------------------
#- Table structure for my_permissions
#- ----------------------------
DROP TABLE IF EXISTS `my_permissions`;
CREATE TABLE `my_permissions` (
  `permissionid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usergroupid` int(10) unsigned NOT NULL DEFAULT '0',
  `cateid` int(10) unsigned NOT NULL DEFAULT '0',
  `canadd` enum('y','n') NOT NULL DEFAULT 'n',
  `canedit` enum('y','n') NOT NULL DEFAULT 'n',
  `cancomment` enum('y','n') NOT NULL DEFAULT 'n',
  `canpublish` enum('y','n') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`permissionid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#- ----------------------------
#- Records of my_permissions
#- ----------------------------

#- ----------------------------
#- Table structure for my_template
#- ----------------------------
DROP TABLE IF EXISTS `my_template`;
CREATE TABLE `my_template` (
  `templateid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL DEFAULT '',
  `template` text,
  `templatesetid` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`templateid`,`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


#- ----------------------------
-- Table structure for my_templateset
#- ----------------------------
DROP TABLE IF EXISTS `my_templateset`;
CREATE TABLE `my_templateset` (
  `templatesetid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`templatesetid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#- ----------------------------
#- Records of my_templateset
#- ----------------------------

#- ----------------------------
-- Table structure for my_user
#- ----------------------------
DROP TABLE IF EXISTS `my_user`;
CREATE TABLE `my_user` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `usergroupid` tinyint(6) NOT NULL DEFAULT '0',
  `email` varchar(35) NOT NULL DEFAULT '',
  `joindate` smallint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;




#- ----------------------------
-- Table structure for my_usergroup
#- ----------------------------
DROP TABLE IF EXISTS `my_usergroup`;
CREATE TABLE `my_usergroup` (
  `usergroupid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `canadd` enum('y','n') NOT NULL DEFAULT 'n',
  `canedit` enum('y','n') NOT NULL DEFAULT 'n',
  `cancomment` enum('y','n') NOT NULL DEFAULT 'n',
  `canpublish` enum('y','n') NOT NULL DEFAULT 'n',
  `canadmin` enum('y','n') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`usergroupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

#- ----------------------------
#- Records of my_usergroup
#- ----------------------------
INSERT INTO `my_usergroup` VALUES ('1', 'member', 'n', 'n', 'y', 'n', 'n');
INSERT INTO `my_usergroup` VALUES ('2', 'author', 'y', 'y', 'y', 'n', 'n');
INSERT INTO `my_usergroup` VALUES ('3', 'publisher', 'y', 'y', 'y', 'y', 'n');
INSERT INTO `my_usergroup` VALUES ('4', 'admin', 'y', 'y', 'y', 'y', 'y');
