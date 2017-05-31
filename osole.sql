/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : osole

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2017-05-31 06:17:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for osole_admin
-- ----------------------------
DROP TABLE IF EXISTS `osole_admin`;
CREATE TABLE `osole_admin` (
`id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`user`  varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`email`  varchar(320) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`password`  varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`visible`  tinyint(4) NOT NULL DEFAULT 1 ,
`remember_token`  varchar(320) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`access`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`role`  enum('sadmin','admin') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'admin' ,
`created_at`  timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ,
`updated_at`  timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=6

;

-- ----------------------------
-- Records of osole_admin
-- ----------------------------
BEGIN;
INSERT INTO `osole_admin` VALUES ('1', 'admin', 'admin@admin.com', '42ecbddef0eeee365b2a1b7ea4876a84', '1', '1BDKEm5eS4czU3aypCCpuSlcd4cjzfmNI7Qm9MEhQ57sc87xIBRh5WkHuPjU', 'O:8:\"stdClass\":10:{s:5:\"admin\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}s:5:\"users\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}s:12:\"carrers_jobs\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}s:11:\"carrers_con\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}s:4:\"news\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}s:9:\"campaigns\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}s:8:\"releases\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}s:6:\"slider\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}s:8:\"products\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}s:9:\"nutrition\";O:8:\"stdClass\":5:{s:6:\"create\";i:1;s:6:\"delete\";i:1;s:4:\"edit\";i:1;s:4:\"view\";i:1;s:6:\"export\";i:1;}}', 'sadmin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('4', 'pelusa', '', '20216fc820577a2d3d17b3153b8faf93', '1', null, '', 'admin', '2017-05-31 07:07:39', '2017-05-31 07:07:39');
COMMIT;

-- ----------------------------
-- Table structure for osole_admin_accesos
-- ----------------------------
DROP TABLE IF EXISTS `osole_admin_accesos`;
CREATE TABLE `osole_admin_accesos` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`id_admin`  int(11) NULL DEFAULT NULL ,
`acceso_correcto`  int(11) NULL DEFAULT NULL ,
`acceso_incorrecto`  int(11) NULL DEFAULT NULL ,
`ip`  text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`created_at`  datetime NULL DEFAULT NULL ,
`updated_at`  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=7

;

-- ----------------------------
-- Records of osole_admin_accesos
-- ----------------------------
BEGIN;
INSERT INTO `osole_admin_accesos` VALUES ('1', '1', null, '1', null, null, null), ('2', '4', null, '1', null, null, null), ('3', '1', '1', null, null, null, null), ('4', '1', '1', null, '::1', null, null), ('5', '1', null, '1', '::1', '2017-05-31 08:26:34', null), ('6', '1', '1', null, '::1', '2017-05-31 08:29:22', null);
COMMIT;

-- ----------------------------
-- Auto increment value for osole_admin
-- ----------------------------
ALTER TABLE `osole_admin` AUTO_INCREMENT=6;

-- ----------------------------
-- Auto increment value for osole_admin_accesos
-- ----------------------------
ALTER TABLE `osole_admin_accesos` AUTO_INCREMENT=7;
