/*
Navicat MySQL Data Transfer

Source Server         : iku
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : sendpost

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-09-26 16:56:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_birth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `load_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'hubert', 'hao', 'li', 'xxx@gmail.com', '186222222', 'aaaAAA11', '343', 'CA', 'en', 'Los Angeles', 'zhongguo', 'zhongguo', '1111', 'image.png', 'United States', '90028', '6838 Hollywood Boulevard');
INSERT INTO `user` VALUES ('2', 'ca.king.test.v3hji.ca', 'test', 'king', 'klslkjsdf@gmail.com', '+17785581998', null, '345', 'CA', 'en', 'Los Angeles', 'CA', 'CA', 'V3hji', 'http://localhost/cana_ui/assets/user_images/ca.king.test.v3hji.ca.jpg', 'United States', '90028', '6838 Hollywood Boulevard');
INSERT INTO `user` VALUES ('3', 'ca.6666.test.6666.ca', 'test', '6666', 'klslkytrdf@gmail.com', '+8613082428932', null, 'trtet', 'CA', 'en', 'Los Angeles', 'CA', 'CA', '6666', 'http://localhost/cana_ui/assets/user_images/ca.6666.test.6666.ca.jpg', 'United States', '90028', '6838 Hollywood Boulevard');
INSERT INTO `user` VALUES ('4', 'ca.tsfgyhh.tewrter.khjkg.ca', 'tewrter', 'tsfgyhh', 'ooosdf@gmail.com', '+8613082428932', null, 'gdsfgsd', 'CA', 'en', 'Los Angeles', 'CA', 'CA', 'khjkg', 'http://localhost/cana_ui/assets/user_images/ca.tsfgyhh.tewrter.khjkg.ca.jpg', 'United States', '90028', '6838 Hollywood Boulevard');
