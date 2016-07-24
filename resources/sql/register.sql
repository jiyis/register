/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.7.9 : Database - register
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`register` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `register`;

/*Table structure for table `jiyi_admin_password_resets` */

DROP TABLE IF EXISTS `jiyi_admin_password_resets`;

CREATE TABLE `jiyi_admin_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `admin_password_resets_email_index` (`email`),
  KEY `admin_password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_admin_password_resets` */

/*Table structure for table `jiyi_admin_users` */

DROP TABLE IF EXISTS `jiyi_admin_users`;

CREATE TABLE `jiyi_admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_super` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否超级管理员',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_name_unique` (`name`),
  UNIQUE KEY `admin_users_nickname_unique` (`nickname`),
  UNIQUE KEY `admin_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_admin_users` */

insert  into `jiyi_admin_users`(`id`,`name`,`nickname`,`email`,`password`,`is_super`,`remember_token`,`created_at`,`updated_at`) values (1,'admin','记忆','425995717@qq.com','$2y$10$tg34bc0xdnZ2kQCsFhpIpey9zSibiEWA0UGeQhzhhlgmKFhuY91ou',1,'xz7A2Z7PMDIpnFaMt06VCznkcAocJ3O0QqOimqLInateKItI2vcn6VKfMTgO','2016-06-02 07:33:41','2016-07-18 13:43:12');

/*Table structure for table `jiyi_migrations` */

DROP TABLE IF EXISTS `jiyi_migrations`;

CREATE TABLE `jiyi_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_migrations` */

insert  into `jiyi_migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_06_01_054136_create_admin_users_table',1),('2016_06_01_055221_create_admin_password_resets_table',1),('2016_06_01_055303_entrust_setup_tables',1),('2016_06_29_024136_create_registers_table',1),('2016_06_29_025419_add_users_column',1),('2016_07_08_083535_edit_registers_table',2),('2016_07_24_091307_create_system_table',3);

/*Table structure for table `jiyi_password_resets` */

DROP TABLE IF EXISTS `jiyi_password_resets`;

CREATE TABLE `jiyi_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_password_resets` */

/*Table structure for table `jiyi_permission_role` */

DROP TABLE IF EXISTS `jiyi_permission_role`;

CREATE TABLE `jiyi_permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `jiyi_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `jiyi_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_permission_role` */

insert  into `jiyi_permission_role`(`permission_id`,`role_id`) values (20,1),(21,1),(22,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(20,2),(21,2),(22,2),(35,2),(36,2),(37,2),(42,2),(44,2),(45,2),(47,2),(51,2),(52,2),(54,2),(56,2),(59,2),(60,2),(61,2),(64,2);

/*Table structure for table `jiyi_permissions` */

DROP TABLE IF EXISTS `jiyi_permissions`;

CREATE TABLE `jiyi_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单父ID',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标class',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_menu` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否作为菜单显示,[1|0]',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_permissions` */

insert  into `jiyi_permissions`(`id`,`fid`,`icon`,`name`,`display_name`,`description`,`is_menu`,`sort`,`created_at`,`updated_at`) values (20,0,'edit','#-1456129983','系统设置','',1,100,'2016-02-22 09:33:03','2016-02-22 09:33:03'),(21,20,'','admin.users.index','用户权限','查看后台用户列表',1,0,'2016-02-18 08:56:26','2016-02-18 08:56:26'),(22,20,'','admin.users.create','创建后台用户','页面',0,0,'2016-02-23 04:48:18','2016-02-23 04:48:18'),(35,0,'home','admin.home','控制台','后台首页',1,0,'2016-04-13 08:46:58','2016-04-13 06:46:58'),(36,0,'graduation-cap','#-1467094682','报名管理','',1,0,'2016-04-20 04:19:15','2016-06-28 06:18:02'),(37,36,'','admin.registers.index','报名列表','',1,0,'2016-02-22 10:15:48','2016-06-28 08:27:18'),(38,20,'','admin.users.store','保存新建后台用户','操作',0,0,'2016-02-23 04:48:52','2016-02-23 04:48:52'),(39,20,'','admin.users.destroy','删除后台用户','操作',0,0,'2016-02-23 04:49:09','2016-02-23 04:49:09'),(40,20,'','admin.users.destory.all','批量后台用户删除','操作',0,0,'2016-02-23 05:01:01','2016-02-23 05:01:01'),(42,20,'','admin.users.edit','编辑后台用户','页面',0,0,'2016-02-23 04:48:35','2016-02-23 04:48:35'),(43,20,'','admin.users.update','保存编辑后台用户','操作',0,0,'2016-02-23 04:50:12','2016-02-23 04:50:12'),(44,20,'','admin.permission.index','权限管理','页面',0,0,'2016-02-23 04:51:36','2016-02-23 04:51:36'),(45,20,'','admin.permission.create','新建权限','页面',0,0,'2016-02-23 04:52:16','2016-02-23 04:52:16'),(46,20,'','admin.permission.store','保存新建权限','操作',0,0,'2016-02-23 04:52:38','2016-02-23 04:52:38'),(47,20,'','admin.permission.edit','编辑权限','页面',0,0,'2016-02-23 04:53:29','2016-02-23 04:53:29'),(48,20,'','admin.permission.update','保存编辑权限','操作',0,0,'2016-02-23 04:53:56','2016-02-23 04:53:56'),(49,20,'','admin.permission.destroy','删除权限','操作',0,0,'2016-02-23 04:54:27','2016-02-23 04:54:27'),(50,20,'','admin.permission.destory.all','批量删除权限','操作',0,0,'2016-02-23 04:55:17','2016-02-23 04:55:17'),(51,20,'','admin.role.index','角色管理','页面',0,0,'2016-02-23 04:56:07','2016-02-23 04:56:07'),(52,20,'','admin.role.create','新建角色','页面',0,0,'2016-02-23 04:56:33','2016-02-23 04:56:33'),(53,20,'','admin.role.store','保存新建角色','操作',0,0,'2016-02-23 04:57:26','2016-02-23 04:57:26'),(54,20,'','admin.role.edit','编辑角色','页面',0,0,'2016-02-23 04:58:25','2016-02-23 04:58:25'),(55,20,'','admin.role.update','保存编辑角色','操作',0,0,'2016-02-23 04:58:50','2016-02-23 04:58:50'),(56,20,'','admin.role.permissions','角色权限设置','',0,0,'2016-02-23 04:59:26','2016-02-23 04:59:26'),(57,20,'','admin.role.destroy','角色删除','操作',0,0,'2016-02-23 04:59:49','2016-02-23 04:59:49'),(58,20,'','admin.role.destory.all','批量删除角色','',0,0,'2016-02-23 05:01:58','2016-02-23 05:01:58'),(59,0,'user','#-1467387837','学生管理','',1,0,'2016-07-01 15:43:35','2016-07-01 15:43:57'),(60,59,'','admin.students.index','学生列表','',1,0,'2016-07-01 15:44:54','2016-07-01 15:44:54'),(61,59,'','admin.students.edit','学生编辑','',0,0,'2016-07-01 15:45:12','2016-07-01 15:45:48'),(62,59,'','admin.students.store','保存新建学生信息','',0,0,'2016-07-01 15:46:49','2016-07-01 15:47:37'),(63,59,'','admin.students.update','更新学生信息','',0,0,'2016-07-01 15:47:21','2016-07-01 15:47:21'),(64,59,'','admin.students.create','新增学生','',0,0,'2016-07-01 15:48:24','2016-07-01 15:48:24'),(65,59,'','admin.students.destroy','删除学生','',0,0,'2016-07-01 15:48:54','2016-07-01 15:48:54'),(66,59,'','admin.students.destroyAll','批量删除学生','',0,0,'2016-07-01 15:49:17','2016-07-01 15:49:17'),(67,20,'','admin.systems.index','报名设置','开启和关闭报名以及开启和关闭初审',1,0,'2016-07-24 09:36:38','2016-07-24 09:36:38');

/*Table structure for table `jiyi_registers` */

DROP TABLE IF EXISTS `jiyi_registers`;

CREATE TABLE `jiyi_registers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stature` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `academy` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `middleschool` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `telphone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `family` text COLLATE utf8_unicode_ci NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `hobby` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `reward` text COLLATE utf8_unicode_ci NOT NULL,
  `personal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `certificate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `review_state` tinyint(1) NOT NULL DEFAULT '0',
  `register_state` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_registers` */

insert  into `jiyi_registers`(`id`,`user_id`,`email`,`province`,`gender`,`stature`,`academy`,`middleschool`,`telphone`,`postcode`,`address`,`family`,`reason`,`hobby`,`reward`,`personal`,`certificate`,`review_state`,`register_state`,`created_at`,`updated_at`,`deleted_at`) values (2,23,'425995717@qq.com','140000','1','180','1300','广饶一中','15606137330','215009','山东省东营市广饶县李鹊镇董家村','{\"name1\":\"1a\",\"age1\":\"2\",\"relation1\":\"3\",\"work1\":\"4\",\"position1\":\"5\",\"healthy1\":\"6\",\"tel1\":\"7\",\"name2\":\"11\",\"age2\":\"22\",\"relation2\":\"33\",\"work2\":\"44\",\"position2\":\"55\",\"healthy2\":\"66\",\"tel2\":\"77\",\"name3\":\"\",\"age3\":\"\",\"relation3\":\"\",\"work3\":\"\",\"position3\":\"\",\"healthy3\":\"\",\"tel3\":\"\",\"name4\":\"\",\"age4\":\"\",\"relation4\":\"\",\"work4\":\"\",\"position4\":\"\",\"healthy4\":\"\",\"tel4\":\"\"}','发射点发射点发射点','示范点发射点','{\"name1\":\"aa\",\"level1\":\"bb\",\"time1\":\"cc\",\"deparment1\":\"dd\",\"name2\":\"a\",\"level2\":\"c\",\"time2\":\"c\",\"deparment2\":\"d\",\"name3\":\"\",\"level3\":\"\",\"time3\":\"\",\"deparment3\":\"\",\"name4\":\"\",\"level4\":\"\",\"time4\":\"\",\"deparment4\":\"\",\"name5\":\"\",\"level5\":\"\",\"time5\":\"\",\"deparment5\":\"\"}','uploads/student/11320102470155-尚宇伦/personal-11320102470155.jpg','uploads/student/11320102470155/certificate-11320102470155.zip',1,0,'2016-07-09 10:48:23','2016-07-24 14:28:03',NULL),(3,24,'425995717@qq.com','120000','1','151','1100','12','15606137330','122121','1221','{\"name1\":\"1\",\"age1\":\"1\",\"relation1\":\"1\",\"work1\":\"1\",\"position1\":\"1\",\"healthy1\":\"1\",\"tel1\":\"1\",\"name2\":\"1\",\"age2\":\"1\",\"relation2\":\"1\",\"work2\":\"1\",\"position2\":\"1\",\"healthy2\":\"1\",\"tel2\":\"1\",\"name3\":\"\",\"age3\":\"\",\"relation3\":\"\",\"work3\":\"\",\"position3\":\"\",\"healthy3\":\"\",\"tel3\":\"\",\"name4\":\"\",\"age4\":\"\",\"relation4\":\"\",\"work4\":\"\",\"position4\":\"\",\"healthy4\":\"\",\"tel4\":\"\"}','111','11','{\"name1\":\"1\",\"level1\":\"1\",\"time1\":\"1\",\"deparment1\":\"1\",\"name2\":\"1\",\"level2\":\"1\",\"time2\":\"1\",\"deparment2\":\"1\",\"name3\":\"\",\"level3\":\"\",\"time3\":\"\",\"deparment3\":\"\",\"name4\":\"\",\"level4\":\"\",\"time4\":\"\",\"deparment4\":\"\",\"name5\":\"\",\"level5\":\"\",\"time5\":\"\",\"deparment5\":\"\"}','uploads/student/11320102450202/personal-11320102450202.png','uploads/student/11320102450202/certificate-11320102450202.zip',2,1,'2016-07-16 15:38:31','2016-07-24 15:06:17',NULL),(5,27,'425995717@qq.com','120000','1','150','1200','12','15606137330','1','1','{\"name1\":\"1\",\"age1\":\"1\",\"relation1\":\"1\",\"work1\":\"1\",\"position1\":\"1\",\"healthy1\":\"1\",\"tel1\":\"1\",\"name2\":\"\",\"age2\":\"\",\"relation2\":\"\",\"work2\":\"\",\"position2\":\"\",\"healthy2\":\"\",\"tel2\":\"\",\"name3\":\"\",\"age3\":\"\",\"relation3\":\"\",\"work3\":\"\",\"position3\":\"\",\"healthy3\":\"\",\"tel3\":\"\",\"name4\":\"\",\"age4\":\"\",\"relation4\":\"\",\"work4\":\"\",\"position4\":\"\",\"healthy4\":\"\",\"tel4\":\"\"}','1','1','{\"name1\":\"\",\"level1\":\"\",\"time1\":\"\",\"deparment1\":\"\",\"name2\":\"\",\"level2\":\"\",\"time2\":\"\",\"deparment2\":\"\",\"name3\":\"\",\"level3\":\"\",\"time3\":\"\",\"deparment3\":\"\",\"name4\":\"\",\"level4\":\"\",\"time4\":\"\",\"deparment4\":\"\",\"name5\":\"\",\"level5\":\"\",\"time5\":\"\",\"deparment5\":\"\"}','uploads/student/11320102470134/personal-11320102470134.png','',2,2,'2016-07-20 14:25:11','2016-07-24 15:32:56',NULL),(6,28,'425995717@qq.com','110000','1','151','1100','12','15606137330','122121','1','{\"name1\":\"1\",\"age1\":\"1\",\"relation1\":\"1\",\"work1\":\"1\",\"position1\":\"1\",\"healthy1\":\"1\",\"tel1\":\"1\",\"name2\":\"\",\"age2\":\"\",\"relation2\":\"\",\"work2\":\"\",\"position2\":\"\",\"healthy2\":\"\",\"tel2\":\"\",\"name3\":\"\",\"age3\":\"\",\"relation3\":\"\",\"work3\":\"\",\"position3\":\"\",\"healthy3\":\"\",\"tel3\":\"\",\"name4\":\"\",\"age4\":\"\",\"relation4\":\"\",\"work4\":\"\",\"position4\":\"\",\"healthy4\":\"\",\"tel4\":\"\"}','111','11','{\"name1\":\"1\",\"level1\":\"1\",\"time1\":\"1\",\"deparment1\":\"1\",\"name2\":\"\",\"level2\":\"\",\"time2\":\"\",\"deparment2\":\"\",\"name3\":\"\",\"level3\":\"\",\"time3\":\"\",\"deparment3\":\"\",\"name4\":\"\",\"level4\":\"\",\"time4\":\"\",\"deparment4\":\"\",\"name5\":\"\",\"level5\":\"\",\"time5\":\"\",\"deparment5\":\"\"}','uploads/student/11320102470139/personal-11320102470139.zip','uploads/student/11320102470139/certificate-11320102470139.zip',2,2,'2016-07-23 02:23:34','2016-07-24 15:01:23',NULL);

/*Table structure for table `jiyi_role_user` */

DROP TABLE IF EXISTS `jiyi_role_user`;

CREATE TABLE `jiyi_role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `jiyi_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `jiyi_admin_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_role_user` */

insert  into `jiyi_role_user`(`user_id`,`role_id`) values (1,1);

/*Table structure for table `jiyi_roles` */

DROP TABLE IF EXISTS `jiyi_roles`;

CREATE TABLE `jiyi_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_roles` */

insert  into `jiyi_roles`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (1,'administrator','超级管理员','拥有所有的权限','2016-06-03 02:26:42','2016-06-15 08:23:10'),(2,'developer','开发RD','开发人员','2016-06-13 15:20:55','2016-06-15 07:42:49');

/*Table structure for table `jiyi_systems` */

DROP TABLE IF EXISTS `jiyi_systems`;

CREATE TABLE `jiyi_systems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `register_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0：关闭报名 1：开启报名',
  `review_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0：关闭初审 1：开始初审',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_systems` */

insert  into `jiyi_systems`(`id`,`register_status`,`review_status`,`created_at`,`updated_at`) values (1,0,0,NULL,'2016-07-24 15:35:25');

/*Table structure for table `jiyi_users` */

DROP TABLE IF EXISTS `jiyi_users`;

CREATE TABLE `jiyi_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idcard` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userpic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_student_id_unique` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_users` */

insert  into `jiyi_users`(`id`,`student_id`,`name`,`email`,`idcard`,`password`,`userpic`,`remember_token`,`created_at`,`updated_at`) values (23,'11320102450159','张智杰','11320102450159@usts.edu.com','123456','e10adc3949ba59abbe56e057f20f883e','uploads/student/11320102450159/userpic-11320102450159.jpg','NMS1uBGxknJtPZfengBXMXZ2B77AerKAwzYBBm5YZrbGNjuUkDk3d42YFIbB','2016-07-09 10:23:16','2016-07-24 11:35:54'),(24,'11320102450202','沈伟','11320102450202@usts.edu.com','123456','e10adc3949ba59abbe56e057f20f883e','uploads/student/11320102450202/userpic-11320102450202.png',NULL,'2016-07-09 10:23:16','2016-07-16 15:37:04'),(25,'11320102450246','李嘉懿','11320102450246@usts.edu.com','123456','099b2c28682879238af3e2461495969a','',NULL,'2016-07-09 10:23:16',NULL),(26,'11320102470040','汪渊昊','11320102470040@usts.edu.com','123456','2f5b5933fa1a75748fd9c0bc1a4b3599','',NULL,'2016-07-09 10:23:16',NULL),(27,'11320102470134','吕菲','11320102470134@usts.edu.com','123456','e10adc3949ba59abbe56e057f20f883e','uploads/student/11320102470134/userpic-11320102470134.jpg','rQbXTAvbSq8UEQq0HbsjI5wa3hnSIpERLO2KP5XAYmTIuGpPaoMYj86VukrK','2016-07-09 10:23:16','2016-07-24 15:36:14'),(28,'11320102470139','詹宇佳','11320102470139@usts.edu.com','123456','e10adc3949ba59abbe56e057f20f883e','uploads/student/11320102470134/userpic-11320102470134.jpg',NULL,'2016-07-09 10:23:16','2016-07-23 02:05:05'),(29,'11320102470155','尚宇伦','11320102470155@usts.edu.com','123456','e10adc3949ba59abbe56e057f20f883e','uploads/student/11320102470155/userpic-11320102470155.jpg',NULL,'2016-07-09 10:23:16','2016-07-21 13:48:01'),(30,'342423423432','aaa','','123456','e10adc3949ba59abbe56e057f20f883e','uploads/student/[object HTMLInputElement]/userpic-[object HTMLInputElement].png',NULL,'2016-07-16 15:36:07','2016-07-16 15:36:07');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
