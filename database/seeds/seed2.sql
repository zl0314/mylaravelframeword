/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : larafrm

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-04-28 16:33:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins_profile
-- ----------------------------
CREATE TABLE IF NOT EXISTS  `admins_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_users_id` int(10) unsigned NOT NULL,
  `realname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admins_profile_admin_id_index` (`admin_users_id`) USING BTREE,
  CONSTRAINT `admins_profile_admin_id_foreign` FOREIGN KEY (`admin_users_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins_profile
-- ----------------------------
INSERT INTO `admins_profile` VALUES ('1', '2018-04-20 11:07:48', '2018-04-20 11:07:48', '1', '张龙');
INSERT INTO `admins_profile` VALUES ('2', '2018-04-24 19:08:12', '2018-04-24 19:12:33', '2', '测试');

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
CREATE TABLE IF NOT EXISTS  `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `authpwd` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('1', 'zhanglong', '1b34348b166705293ca30f8675d40e31', '$2y$10$yQToHFkBxe7LpHY.g4NsCek2BN1Ia6eYgDZd70O6YbXMXhV.0RqGa', '1', '2018-04-28 16:31:30', '2018-04-28 16:31:30');
INSERT INTO `admin_users` VALUES ('2', 'ceshi', 'abc541fa9d6c908192cf3453ee29bbb7', '$2y$10$QY890snBRmuYVArASNrP5Oiow.m/Xl3.0vJrkEXkgkVMJAASWEqgi', '0', '2018-04-26 18:44:49', '2018-04-26 18:44:49');

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
CREATE TABLE IF NOT EXISTS  `admin_user_role` (
  `admin_user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`admin_user_id`,`role_id`),
  KEY `admin_user_role_role_id_foreign` (`role_id`),
  CONSTRAINT `admin_user_roles_admin_user_id_foreign` FOREIGN KEY (`admin_user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
INSERT INTO `admin_user_role` VALUES ('2', '14');
INSERT INTO `admin_user_role` VALUES ('2', '17');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
CREATE TABLE IF NOT EXISTS  `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
CREATE TABLE IF NOT EXISTS  `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单父ID',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_menu` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否作为菜单显示,[1|0]',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', '0', '#1273639', '首页', '顶部首页按钮 ', '1', '2', '2018-04-23 10:16:33', '2018-04-23 10:16:35',0);
INSERT INTO `permissions` VALUES ('2', '1', '#121258896', '系统管理', null, '1', '0', '2018-04-23 11:51:34', '2018-04-23 11:51:34',0);
INSERT INTO `permissions` VALUES ('3', '2', 'home.index', '系统信息', null, '1', '1', '2018-04-23 11:51:34', '2018-04-23 11:51:34',0);
INSERT INTO `permissions` VALUES ('24', '2', 'setting.index', '网站配置', '网站常用 设置', '1', '0', '2018-04-23 11:51:34', '2018-04-23 11:51:34',0);
INSERT INTO `permissions` VALUES ('25', '0', '#505999', '用户中心', '用户中心， 管理员+用户', '1', '1', '2018-04-23 17:48:14', '2018-04-23 17:48:14',0);
INSERT INTO `permissions` VALUES ('26', '25', '#453512', '管理员管理', '管理员管理', '1', '1', '2018-04-23 17:52:08', '2018-04-23 17:52:08',0);
INSERT INTO `permissions` VALUES ('28', '26', 'adminusers.index', '管理员列表', null, '1', '1', '2018-04-23 17:56:27', '2018-04-23 17:58:03',0);
INSERT INTO `permissions` VALUES ('29', '26', 'roles.index', '角色列表', null, '1', '1', '2018-04-23 17:56:54', '2018-04-23 17:56:54',0);
INSERT INTO `permissions` VALUES ('30', '26', 'permissions.index', '权限列表', null, '1', '1', '2018-04-23 17:57:23', '2018-04-23 17:57:23',0);
INSERT INTO `permissions` VALUES ('33', '24', 'setting.create', '新增表单页面', null, '0', '1', '2018-04-24 15:17:28', '2018-04-24 15:17:28',0);
INSERT INTO `permissions` VALUES ('34', '24', 'setting.store', '设置保存', null, '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('35', '24', 'setting.edit', '编辑页面', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('36', '24', 'setting.update', '编辑保存', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('37', '24', 'setting.destroy', '删除', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('38', '24', 'setting.batch_destroy', '批量删除', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('39', '28', 'my.index', '我的资料', null, '0', '1', '2018-04-24 19:57:14', '2018-04-24 19:57:14',0);
INSERT INTO `permissions` VALUES ('40', '28', 'my.store', '我的资料保存', null, '0', '1', '2018-04-24 20:07:57', '2018-04-24 20:07:57',0);
INSERT INTO `permissions` VALUES ('41', '28', 'my.chpass', '修改我的密码', null, '0', '1', '2018-04-24 20:08:49', '2018-04-24 20:08:49',0);
INSERT INTO `permissions` VALUES ('42', '28', 'my.storepass', '修改密码保存', null, '0', '1', '2018-04-24 20:09:13', '2018-04-24 20:09:13',0);
INSERT INTO `permissions` VALUES ('43', '28', 'adminusers.create', '新增表单页面', null, '0', '1', '2018-04-24 15:17:28', '2018-04-24 15:17:28',0);
INSERT INTO `permissions` VALUES ('44', '28', 'adminusers.store', '保存', null, '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('45', '28', 'adminusers.edit', '编辑页面', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('46', '28', 'adminusers.update', '编辑保存', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('47', '28', 'adminusers.destroy', '删除', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('48', '28', 'adminusers.batch_destroy', '批量删除', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('49', '29', 'roles.create', '新增表单页面', null, '0', '1', '2018-04-24 15:17:28', '2018-04-24 15:17:28',0);
INSERT INTO `permissions` VALUES ('50', '29', 'roles.store', '保存', null, '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('51', '29', 'roles.edit', '编辑页面', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('52', '29', 'roles.update', '编辑保存', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('53', '29', 'roles.destroy', '删除', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('54', '29', 'roles.batch_destroy', '批量删除', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('55', '30', 'permissions.create', '新增表单页面', null, '0', '1', '2018-04-24 15:17:28', '2018-04-24 15:17:28',0);
INSERT INTO `permissions` VALUES ('56', '30', 'permissions.store', '保存', null, '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('57', '30', 'permissions.edit', '编辑页面', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('58', '30', 'permissions.update', '编辑保存', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('59', '30', 'permissions.destroy', '删除', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);
INSERT INTO `permissions` VALUES ('60', '30', 'permissions.batch_destroy', '批量删除', '', '0', '1', '2018-04-24 15:19:18', '2018-04-24 15:19:18',0);

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
CREATE TABLE IF NOT EXISTS  `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '14');
INSERT INTO `permission_role` VALUES ('2', '14');
INSERT INTO `permission_role` VALUES ('3', '14');
INSERT INTO `permission_role` VALUES ('25', '17');
INSERT INTO `permission_role` VALUES ('26', '17');
INSERT INTO `permission_role` VALUES ('28', '17');
INSERT INTO `permission_role` VALUES ('29', '17');
INSERT INTO `permission_role` VALUES ('30', '17');
INSERT INTO `permission_role` VALUES ('39', '17');
INSERT INTO `permission_role` VALUES ('40', '17');
INSERT INTO `permission_role` VALUES ('41', '17');
INSERT INTO `permission_role` VALUES ('42', '17');
INSERT INTO `permission_role` VALUES ('43', '17');
INSERT INTO `permission_role` VALUES ('44', '17');
INSERT INTO `permission_role` VALUES ('45', '17');
INSERT INTO `permission_role` VALUES ('46', '17');
INSERT INTO `permission_role` VALUES ('47', '17');
INSERT INTO `permission_role` VALUES ('48', '17');
INSERT INTO `permission_role` VALUES ('49', '17');
INSERT INTO `permission_role` VALUES ('50', '17');
INSERT INTO `permission_role` VALUES ('51', '17');
INSERT INTO `permission_role` VALUES ('52', '17');
INSERT INTO `permission_role` VALUES ('55', '17');
INSERT INTO `permission_role` VALUES ('56', '17');
INSERT INTO `permission_role` VALUES ('57', '17');
INSERT INTO `permission_role` VALUES ('58', '17');
INSERT INTO `permission_role` VALUES ('59', '17');
INSERT INTO `permission_role` VALUES ('60', '17');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
CREATE TABLE IF NOT EXISTS  `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('14', '元帅', '元帅', '测试组', '2018-04-23 09:35:50', '2018-04-23 09:35:50');
INSERT INTO `roles` VALUES ('17', '将军', '将军', null, '2018-04-23 09:35:50', '2018-04-23 09:35:50');
INSERT INTO `roles` VALUES ('22', '123', '123', '123', '2018-04-26 18:57:04', '2018-04-26 18:57:04');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
CREATE TABLE IF NOT EXISTS  `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intro` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `settings`
ADD COLUMN `type`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1  AFTER `value`;


-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('3', '网站标题', 'sitetitle', 'LARAFRM',1);
INSERT INTO `settings` VALUES ('4', '站点描述', 'description', '描述',1);