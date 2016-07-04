/*
SQLyog Ultimate v12.09 (64 bit)
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

insert  into `jiyi_admin_users`(`id`,`name`,`nickname`,`email`,`password`,`is_super`,`remember_token`,`created_at`,`updated_at`) values (1,'admin','记忆','425995717@qq.com','$2y$10$tg34bc0xdnZ2kQCsFhpIpey9zSibiEWA0UGeQhzhhlgmKFhuY91ou',1,'NO9rPEYy2XR8BpjcJquvHwNeQsB8WVTkSSE9wgovWtgz3RyjJKLmA9icRF27','2016-06-02 07:33:41','2016-07-04 01:43:12');

/*Table structure for table `jiyi_migrations` */

DROP TABLE IF EXISTS `jiyi_migrations`;

CREATE TABLE `jiyi_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_migrations` */

insert  into `jiyi_migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_06_01_054136_create_admin_users_table',1),('2016_06_01_055221_create_admin_password_resets_table',1),('2016_06_01_055303_entrust_setup_tables',1),('2016_06_21_085137_create_tests_table',2),('2016_06_28_082244_create_registers_table',3),('2016_06_29_024136_create_registers_table',4),('2016_06_29_025419_add_users_column',5);

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

insert  into `jiyi_permission_role`(`permission_id`,`role_id`) values (20,1),(21,1),(22,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1);

/*Table structure for table `jiyi_permissions` */

DROP TABLE IF EXISTS `jiyi_permissions`;

CREATE TABLE `jiyi_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) unsigned DEFAULT '0' COMMENT '菜单父ID',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标class',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_menu` tinyint(1) DEFAULT '0' COMMENT '是否作为菜单显示,[1|0]',
  `sort` tinyint(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_permissions` */

insert  into `jiyi_permissions`(`id`,`fid`,`icon`,`name`,`display_name`,`description`,`is_menu`,`sort`,`created_at`,`updated_at`) values (20,0,'edit','#-1456129983','系统设置','',1,100,'2016-02-22 09:33:03','2016-02-22 09:33:03'),(21,20,'','admin.users.index','用户权限','查看后台用户列表',1,0,'2016-02-18 08:56:26','2016-02-18 08:56:26'),(22,20,'','admin.users.create','创建后台用户','页面',0,0,'2016-02-23 04:48:18','2016-02-23 04:48:18'),(35,0,'home','admin.home','控制台','后台首页',1,0,'2016-04-13 08:46:58','2016-04-13 06:46:58'),(36,0,'graduation-cap','#-1467094682','报名管理','',1,0,'2016-04-20 04:19:15','2016-06-28 06:18:02'),(37,36,'','admin.registers.index','报名列表','',1,0,'2016-02-22 10:15:48','2016-06-28 08:27:18'),(38,20,'','admin.users.store','保存新建后台用户','操作',0,0,'2016-02-23 04:48:52','2016-02-23 04:48:52'),(39,20,'','admin.users.destroy','删除后台用户','操作',0,0,'2016-02-23 04:49:09','2016-02-23 04:49:09'),(40,20,'','admin.users.destory.all','批量后台用户删除','操作',0,0,'2016-02-23 05:01:01','2016-02-23 05:01:01'),(42,20,'','admin.users.edit','编辑后台用户','页面',0,0,'2016-02-23 04:48:35','2016-02-23 04:48:35'),(43,20,'','admin.users.update','保存编辑后台用户','操作',0,0,'2016-02-23 04:50:12','2016-02-23 04:50:12'),(44,20,'','admin.permission.index','权限管理','页面',0,0,'2016-02-23 04:51:36','2016-02-23 04:51:36'),(45,20,'','admin.permission.create','新建权限','页面',0,0,'2016-02-23 04:52:16','2016-02-23 04:52:16'),(46,20,'','admin.permission.store','保存新建权限','操作',0,0,'2016-02-23 04:52:38','2016-02-23 04:52:38'),(47,20,'','admin.permission.edit','编辑权限','页面',0,0,'2016-02-23 04:53:29','2016-02-23 04:53:29'),(48,20,'','admin.permission.update','保存编辑权限','操作',0,0,'2016-02-23 04:53:56','2016-02-23 04:53:56'),(49,20,'','admin.permission.destroy','删除权限','操作',0,0,'2016-02-23 04:54:27','2016-02-23 04:54:27'),(50,20,'','admin.permission.destory.all','批量删除权限','操作',0,0,'2016-02-23 04:55:17','2016-02-23 04:55:17'),(51,20,'','admin.role.index','角色管理','页面',0,0,'2016-02-23 04:56:07','2016-02-23 04:56:07'),(52,20,'','admin.role.create','新建角色','页面',0,0,'2016-02-23 04:56:33','2016-02-23 04:56:33'),(53,20,'','admin.role.store','保存新建角色','操作',0,0,'2016-02-23 04:57:26','2016-02-23 04:57:26'),(54,20,'','admin.role.edit','编辑角色','页面',0,0,'2016-02-23 04:58:25','2016-02-23 04:58:25'),(55,20,'','admin.role.update','保存编辑角色','操作',0,0,'2016-02-23 04:58:50','2016-02-23 04:58:50'),(56,20,'','admin.role.permissions','角色权限设置','',0,0,'2016-02-23 04:59:26','2016-02-23 04:59:26'),(57,20,'','admin.role.destroy','角色删除','操作',0,0,'2016-02-23 04:59:49','2016-02-23 04:59:49'),(58,20,'','admin.role.destory.all','批量删除角色','',0,0,'2016-02-23 05:01:58','2016-02-23 05:01:58'),(59,0,'user','#-1467615305','学生管理','',1,0,'2016-07-04 06:54:34','2016-07-04 06:55:05'),(60,59,'','admin.students.index','学生列表','',1,0,'2016-07-04 06:56:22','2016-07-04 06:56:22'),(61,59,'','admin.students.create','新建学生','',0,NULL,'2016-07-04 14:57:39','2016-07-04 14:57:42'),(62,59,'','admin.students.store','保存新建学生','',0,NULL,'2016-07-04 14:58:11','2016-07-04 14:58:13'),(63,59,'','admin.students.edit','编辑学生信息','',0,NULL,'2016-07-04 14:59:05','2016-07-04 14:59:07'),(64,59,'','admin.students.update','更新学生信息','',0,NULL,'2016-07-04 14:59:34','2016-07-04 14:59:36'),(65,59,'','admin.students.destroy','删除学生信息','',0,NULL,'2016-07-04 15:00:03','2016-07-04 15:00:04'),(66,59,'','admin.students.destroy.all','批量删除学生信息','',0,NULL,'2016-07-04 15:00:45','2016-07-04 15:00:46');

/*Table structure for table `jiyi_registers` */

DROP TABLE IF EXISTS `jiyi_registers`;

CREATE TABLE `jiyi_registers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `politics` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `stature` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `academy` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `profession` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `middleschool` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `telphone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `family` text COLLATE utf8_unicode_ci NOT NULL,
  `hobby` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `reward` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `certificate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_registers` */

insert  into `jiyi_registers`(`id`,`user_id`,`province`,`gender`,`politics`,`stature`,`academy`,`profession`,`middleschool`,`telphone`,`postcode`,`address`,`family`,`hobby`,`reward`,`personal`,`certificate`,`video`,`state`,`created_at`,`updated_at`,`deleted_at`) values (1,1,'120000','0','0','152','1000','1010','dsa','15606137330','adsdas','dasdsa','{\"name1\":\"1\",\"age1\":\"1\",\"relation1\":\"1\",\"work1\":\"1\",\"position1\":\"1\",\"salary1\":\"1\",\"healthy1\":\"1\",\"tel1\":\"1\",\"name2\":\"1\",\"age2\":\"1\",\"relation2\":\"1\",\"work2\":\"1\",\"position2\":\"1\",\"salary2\":\"1\",\"healthy2\":\"1\",\"tel2\":\"1\"}','1','1','uploads/student/123456/personal-123456.png','uploads/student/123456/certificate-123456.7z','uploads/student/123456/video-123456.mp4',0,'2016-07-01 02:26:19','2016-07-04 07:43:38',NULL);

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

/*Table structure for table `jiyi_users` */

DROP TABLE IF EXISTS `jiyi_users`;

CREATE TABLE `jiyi_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userpic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_student_id_unique` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jiyi_users` */

insert  into `jiyi_users`(`id`,`student_id`,`name`,`email`,`password`,`userpic`,`remember_token`,`created_at`,`updated_at`) values (1,123456,'张三','425995717@qq.com','$2y$10$2V2.J1GBjZt6DdSvDN4QXuV/PcjscFXihmZhoc7dz0WZG9gKVT.gK','uploads/student/123456/userpic-123456.jpg',NULL,'2016-06-29 06:45:36','2016-07-04 05:38:34');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
