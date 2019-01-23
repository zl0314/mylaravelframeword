/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50547
 Source Host           : localhost:3306
 Source Schema         : laravel_frm

 Target Server Type    : MySQL
 Target Server Version : 50547
 File Encoding         : 65001

 Date: 21/01/2019 20:12:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_role`;
CREATE TABLE `admin_user_role`  (
  `admin_user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`admin_user_id`, `role_id`) USING BTREE,
  INDEX `admin_user_role_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `admin_user_role_ibfk_1` FOREIGN KEY (`admin_user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
INSERT INTO `admin_user_role` VALUES (2, 14);
INSERT INTO `admin_user_role` VALUES (2, 17);

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `authpwd` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 'zhanglong', '74e5266cc690cc57de3a0263f7eb1a5f', '$2y$10$yQToHFkBxe7LpHY.g4NsCek2BN1Ia6eYgDZd70O6YbXMXhV.0RqGa', 1, '2018-04-28 16:31:30', '2019-01-21 16:31:51');
INSERT INTO `admin_users` VALUES (2, 'ceshi', 'abc541fa9d6c908192cf3453ee29bbb7', '$2y$10$QY890snBRmuYVArASNrP5Oiow.m/Xl3.0vJrkEXkgkVMJAASWEqgi', 0, '2018-04-26 18:44:49', '2018-04-26 18:44:49');

-- ----------------------------
-- Table structure for admins_profile
-- ----------------------------
DROP TABLE IF EXISTS `admins_profile`;
CREATE TABLE `admins_profile`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_users_id` int(10) UNSIGNED NOT NULL,
  `realname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admins_profile_admin_users_id_index`(`admin_users_id`) USING BTREE,
  CONSTRAINT `admins_profile_ibfk_1` FOREIGN KEY (`admin_users_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admins_profile
-- ----------------------------
INSERT INTO `admins_profile` VALUES (1, '2018-04-20 11:07:48', '2018-04-20 11:07:48', 1, '张龙');
INSERT INTO `admins_profile` VALUES (2, '2018-04-24 19:08:12', '2018-04-24 19:12:33', 2, '测试');

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `listorder` int(10) UNSIGNED NULL DEFAULT NULL,
  `position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `position`(`position`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES (1, NULL, '首页轮播', '/uploads/banners/2019/01/21/8229/ab90c76b6e6f052d2494bd000c2441f3.jpg', 12, 'index-top', '2019-01-21 19:33:41', '2019-01-21 19:33:41');
INSERT INTO `banners` VALUES (2, NULL, '首页轮播', '/uploads/banners/2019/01/21/9438/e097a687b43da7fb49439122ce01e336.jpg', NULL, 'index-top', '2019-01-21 19:41:43', '2019-01-21 19:41:43');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2017_12_11_124753_adminUsers', 1);
INSERT INTO `migrations` VALUES (2, '2017_12_13_140106_AdminProfile', 1);
INSERT INTO `migrations` VALUES (3, '2018_04_19_155401_setting', 1);
INSERT INTO `migrations` VALUES (4, '2018_04_25_104724_Rbac', 1);
INSERT INTO `migrations` VALUES (5, '2018_04_25_104853_AdminUserRole', 1);
INSERT INTO `migrations` VALUES (6, '2018_11_22_101208_Banners', 1);

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `source` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '来源 ',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `type` tinyint(1) NULL DEFAULT 1 COMMENT '类别 \r\n1 公司动态\r\n2 行业动态',
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `to_index` tinyint(1) UNSIGNED NULL DEFAULT 0 COMMENT '1推荐到首页 0不鬼剑',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `type`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1, '人西去取经只有法显一人回国 海路归来时曾漂到岛国耶婆提', '人西去取经只有法显一人回国 海路归来时曾漂到岛国耶婆提', NULL, '&lt;p style=&quot;border: 0px none; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; text-size-adjust: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(119, 119, 119); font-family: &amp;quot;Microsoft YaHei&amp;quot;, SimHei, SimSun; font-size: 13px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;法显以年过花甲的高龄，完成了穿行亚洲大陆又经南洋海路归国的远途陆海旅行的惊人壮举，他留下的杰作《佛国记》，不仅在佛教界受到称誉，而且也得到了中外学者的高度评价。梁启超说：“法显横雪山而入天竺，赍佛典多种以归，著《佛国记》，我国人之至印度者，此为第一。”&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;border: 0px none; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; text-size-adjust: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(119, 119, 119); font-family: &amp;quot;Microsoft YaHei&amp;quot;, SimHei, SimSun; font-size: 13px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;法显以年过花甲的高龄，完成了穿行亚洲大陆又经南洋海路归国的远途陆海旅行的惊人壮举，他留下的杰作《佛国记》，不仅在佛教界受到称誉，而且也得到了中外学者的高度评价。梁启超说：“法显横雪山而入天竺，赍佛典多种以归，著《佛国记》，我国人之至印度者，此为第一。”&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '2018-12-25 15:15:28', '2019-01-04 10:50:46', 1, '/static/web/img/inp01.jpg', 1);
INSERT INTO `news` VALUES (2, '致初心 | 初心地产，品质地产的践行者致初心', '最近上映的电影里面，不少还是引发关注与热议的。比如《地球最后的夜晚》，这样的电影，故事的情节很简单，那就是，一个男人，多年后去寻找自己遗失的爱情，也就是说，去找一个女人', NULL, '&lt;p&gt;最近上映的电影里面，不少还是引发关注与热议的。比如《地球最后的夜晚》，这样的电影，故事的情节很简单，那就是，一个男人，多年后去寻找自己遗失的爱情，也就是说，去找一个女人。也就是说，这是一个浪漫的故事。也因为这样，外界给这样的作品的定义，便是文艺片。这样的定义与标签，还是蛮客观的。因为，这样的作品，就是文艺片，这一点，没有任何的悬念。或许，也是因为有着事先不错的宣传，这样的作品第一天的票房，居然超过了2亿。&lt;/p&gt;', '2019-01-04 13:18:01', '2019-01-04 15:35:51', 1, '/static/web/img/inp01.jpg', 1);
INSERT INTO `news` VALUES (3, '贾乃亮带甜馨出去吃饭，甜馨却满脸心事，李小璐去哪儿了？', '相比于2018年，2019年的年初除了赵丽颖宣布怀孕之外，娱乐圈显得平静得多啊~要知道去年的年初，李小璐出轨皮几万那件事情，可以说是闹得沸沸扬扬。', NULL, '&lt;div&gt;&lt;img class=&quot;large&quot; src=&quot;https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=1459036139,2694028050&amp;fm=173&amp;app=49&amp;f=JPEG?w=640&amp;h=427&amp;s=ED0FA55750E38AADBE10D1B70300C021&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;事情已经过了一年了，最可怜的也是贾乃亮，不仅被自己老婆戴了绿帽，每次有一点关于李小璐的消息传出，贾乃亮必定会被媒体和网友带下场顶上热搜。而贾乃亮和李小璐到底有没有离婚，也是扑朔迷离。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;近日，贾乃亮现身被网友偶遇。有网友在餐厅遇见贾乃亮带着甜馨出来吃饭。当天贾乃亮穿着羽绒服和白色T恤衬衫，坐下来后就脱掉了羽绒服，和自己的女儿甜馨面对面坐着。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;normal&quot; width=&quot;440px&quot; src=&quot;https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=1897584871,1765201875&amp;fm=173&amp;app=49&amp;f=JPEG?w=440&amp;h=370&amp;s=FA9204C40C43AE5D889D5D3903005042&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;甜馨当天扎着小辫子，五官随着年龄也越来越精致，非常可爱，也十分有小大人的模样。坐下来后，甜馨就开始认真的看菜单，估计在看有没有自己喜欢吃的，而贾乃亮则安静地在对面坐着。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;normal&quot; width=&quot;440px&quot; src=&quot;https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=303887754,3159386195&amp;fm=173&amp;app=49&amp;f=JPEG?w=440&amp;h=366&amp;s=FA980CC44C43AF5D089D5D390300D042&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;现场李小璐不在，看来这次是贾乃亮独自带女儿甜馨出来吃饭，其实事件发生后，大家也鲜少在新闻上看到贾乃亮和李小璐同框了。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;normal&quot; width=&quot;440px&quot; src=&quot;https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=4229888435,4164559294&amp;fm=173&amp;app=49&amp;f=JPEG?w=440&amp;h=366&amp;s=FE8404C40051A7CE7C956D3C0300C042&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;不知道是知道旁边有人注意到父女俩还是什么，不管是贾乃亮还是甜馨，都鲜少笑容，神情十分严肃。以前在亲子节目中，贾乃亮和甜馨可以说是非常活泼的，然而现在两人却满脸心事的感觉。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;normal&quot; width=&quot;440px&quot; src=&quot;https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=1743592919,4288198448&amp;fm=173&amp;app=49&amp;f=JPEG?w=440&amp;h=470&amp;s=57BA3DC7546306ADA49CE0F303001063&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;有网友表示心疼贾乃亮和甜馨，尤其是甜馨，小小年纪就要经历这些家庭风波，也难怪那么快成长成一个小大人了。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;normal&quot; width=&quot;440px&quot; src=&quot;https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=1517899179,3212862457&amp;fm=173&amp;app=49&amp;f=JPEG?w=440&amp;h=535&amp;s=72C8F3050E0356D47E01F5AA03003007&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;不过，对于这次父女俩吃饭照片的曝光，有不少网友替贾乃亮不平，并且希望大家不要去打扰他的生活。&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;large&quot; src=&quot;https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=1070167017,1511159412&amp;fm=173&amp;app=49&amp;f=JPEG?w=640&amp;h=799&amp;s=B40F9D57ECEB36846A0C91260300A013&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;其实的确如此，想想李小璐和皮几万的事情淡了几个月后，又被李雨桐跳出来爆薛之谦和李小璐的料，贾乃亮瞬间又被拉下场，再次被推到风口浪尖之处。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;large&quot; src=&quot;https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=862854423,1825180991&amp;fm=173&amp;app=49&amp;f=JPEG?w=640&amp;h=335&amp;s=D301990B1ABB26920511809F0300F083&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;也许是多次被谈论，贾乃亮真的忍不了了，那次之后还特意发了微博表示自己一个人过得很好，并且希望大家不要再带他下场。不过当时这条微博，也让大家纷纷猜测他是不是已经和李小璐离婚，所以才自称一个人。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;normal&quot; width=&quot;536px&quot; src=&quot;https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=2816633876,3752504446&amp;fm=173&amp;app=49&amp;f=JPEG?w=536&amp;h=157&amp;s=6C16ED1385745C215C7D54DE0000D0B1&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;如今的贾乃亮已经一改从前的风格，留起板寸头尽显男人魅力，不过却也有藏不住的忧伤，也许是家庭风波对他的打击真的很大吧！&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;normal&quot; width=&quot;440px&quot; src=&quot;https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=3153450201,3985799194&amp;fm=173&amp;app=49&amp;f=JPEG?w=440&amp;h=660&amp;s=F7950F6450F9739C362469920100E0E2&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;而甜馨现在年纪还小，但肯定也是能听到一些流言蜚语的，或者对贾乃亮最大的困扰，是李小璐的事情，让甜馨有一个不好的回忆吧~&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot; style=&quot;margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;large&quot; src=&quot;https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=15303632,497293576&amp;fm=173&amp;app=49&amp;f=JPEG?w=600&amp;h=470&amp;s=ABABE305146A571D6B3D0DAD0300D006&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;其实这段时间，贾乃亮和甜馨同框并不少见，看来贾乃亮是真的很爱甜馨，当然李小璐和甜馨同框的次数也不少，如果他们俩真离婚了，你们觉得甜馨跟谁更合适呢？&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;&gt;文/阿 思&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '2019-01-04 13:53:05', '2019-01-04 15:40:28', 1, '/static/web/img/inp01.jpg', 4);
INSERT INTO `news` VALUES (4, '不忘初心、牢记使命”主题教育', '“不忘初心、牢记使命”主题教育是在全党范围内开展的主题教育活动，是推动全党更加自觉地为实现新时代党的历史使命不懈奋斗的重要内容。', NULL, '&lt;div&gt;“不忘初心、牢记使命”主题教育是在全党范围内开展的主题教育活动，是推动全党更加自觉地为实现新时代党的历史使命不懈奋斗的重要内容。&amp;nbsp;[1]&lt;a&gt;&amp;nbsp;&lt;/a&gt;&lt;/div&gt;&lt;div&gt;2017年10月18日，习近平总书记在十九大报告中指出，在全党开展“不忘初心、牢记使命”主题教育，用党的创新理论武装头脑，推动全党更加自觉地为实现新时代党的历史使命不懈奋斗。&amp;nbsp;[2]&lt;a&gt;&amp;nbsp;&lt;/a&gt;&lt;/div&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '2019-01-04 14:37:04', '2019-01-04 14:37:48', 2, '/static/web/img/inp01.jpg', 2);
INSERT INTO `news` VALUES (5, '走近笔若——走近初心与纯粹的笔若', '协的档案群里，只是因为我提出的一个问题，询问易白老师说起的许多专业术语的概念和解释。于是，在三个小时之内，他发了很长，很官方，很严肃的解释给我，前面还有一两百字他自己的理解，我顿时感觉有些瞠目结舌，因为在我看来', NULL, '&lt;p&gt;走近笔若——走近初心与纯粹&lt;/p&gt;&lt;p&gt;笔若，我第一次见他，是在中青作协的档案群里，只是因为我提出的一个问题，询问易白老师说起的许多专业术语的概念和解释。于是，在三个小时之内，他发了很长，很官方，很严肃的解释给我，前面还有一两百字他自己的理解，我顿时感觉有些瞠目结舌，因为在我看来，这个概念问题，只需要二十几个字就能解决的，何必写成这样？于是，我对他的背景乃至价值观啥的，产生了浓厚的兴趣，于是我去翻看了他的空间，发现他居然是一个文艺全能王，还是文武双全的跆拳道黑带，除此之外，具体的就是他的摄影，他的诗都显得很暖心，我瞬间就被他的才华迷倒了。&lt;br/&gt;后来发现笔若的确在关注我，给我提供了许多平台渠道，并且进了许多群，在我们资源对接以后，我发现他的思路清晰，说话也有条不紊，我很少佩服人，因为能让我服气的太少，他是其中一个，办公司，也就24岁，以后的未来是光明无限的，我喜欢文艺气息浓的，也许也有主观性，但我认为是可以避免的主观认知。&lt;br/&gt;笔若的诗歌是越读越有感觉的，他是青年，依旧怀揣着梦想工作到很晚，但却从来没有因为现实而放弃梦想，始终走在第一线，做各种事务，真的是能者多劳。&lt;br/&gt;有人说，不要因为没有掌声而放弃梦想，我和笔若在这一点上是一样的，对梦想的追逐从未停歇，随时休息随时启程，和笔若一样，也预备有一家自己平台的合作一向书。也就是说办证件的事情一个星期内就八九不离十了。&lt;br/&gt;笔若对人才也是有种惺惺相惜之感，不因学历而看不上任何人，只因有一个共同目标又喜欢传统文化的朋友。也许，他正是刘备那样的贤明之心吧，在他的口中我听不到一句让自己不舒服的话，听不到一句思路不清晰的话，他像是很早就在社会上摸爬滚打好多年的资深人士一样。总有人告诉我说，我们不像是大学生，像极了中学生的时候，我们只能满脸无奈的笑笑，不反驳什么。&lt;br/&gt;和笔若认识到今天也应该只有一个多月的时间把，不能说很了解他，但我对他的价值观已经有了一个初步的了解，是啊，每一个实干家都曾是一个梦想家，每一个梦想家又都曾经是一个失败者，还可能不止失败一两次，而是无数次的跌倒再爬起，像我们这样的人在崭露头角之前，受过的讽刺和嘲笑兴许不比那些碌碌无为的人少，有的时候，兴许比他们惨，因为我们稍一不留意就会超出常规，被别人毫不留情的贴上疯子的标签，但又有谁知道，我们只是思想境界还是你们不想乃至不愿意去相信与落实的，我们看起来不正常，所以比起碌碌无为的人，他们反倒是更正常，所以，呵呵，悲催了。但久而久之，我们也习惯了，就像笔若一样，他可能在之前很长一段时间内，他也是一个普通孩子，家里没啥资本给他，而他却自学成了全才，我很难想象，一个如此年轻的人怎么会有这么大的执行力和魄力呢？但是他的确是做到了，而且牛逼哄哄。如今他有许多的节目邀请，但是，被邀请的久了，能推掉的也就赶紧推掉，感觉参加多了也没啥感觉了。我也是同样，在外面的时候，想进区，在里面又想出来，貌似很不安宁，是在找什么东西么？哦，也许一直在找那份初心，那份纯粹，在找内心的那份安宁充实与自由吧。&lt;br/&gt;网络作家基本就没有不知道易白的，易白是文艺全能退役军人，他也是那种天之吝啬的骄子，自学领悟能力特强，笔若就是他这一类，但易白是易白，笔若是笔若，我们不必在意别人的眼光，只要方向不错，怎么走又如何呢，只要不触及到底线就没问题。&lt;br/&gt;笔若，我更想把他比喻成我们所有文人创作的初心，一颗赤子情怀的心，一颗始终愿意将作品落实现实的心，一颗不达梦想不罢休的心，一颗燃烧着一代青年热血的中国心。&lt;br/&gt;笔若的原名绍乾也很好听，虽然也不懂什么意思，但我知道乾坤的意思，乾即天，天的胸怀有多大呢，无法估计，但比天还要大的，是我们的胸怀，而笔若的才华与之吻合，才创造了一个奇迹——青星书艺文化传媒有限公司，这可能只是我看到的冰山一角吧。&lt;br/&gt;我们这些文人是幸运的，恰逢其时，碰到了互联网时代，出作品可以是分分钟的事情，也因为作品泛滥而没有留下几篇真正的精华，这到底是谁的错，我们普遍变得浮躁起来，不再像那个刚从大学里面出来稚气未脱的俊朗少年，不再像当时的自己一样很单纯了，而是极力的去掩饰疲惫，用面具遮盖自己易碎的面孔，呵呵，多少人纸醉金迷不复从前，多少人醉卧酒场难得偷闲，为什么？他们不是曾经满腹理想抱负的少年么，那到底是为什么让他们失去了最后的生活动力变得不可理喻，也许只是因为丢了信仰，而信仰却是可以在像笔若易白这样的人身上可以去洞见的，心若没有消亡，哪里都可远方！就让笔若易白长驻你的心房，不再迷茫！&lt;br/&gt;其实，生活就是一本很好的书，每天都有美丽的风景值得欣赏，每天都有温暖的阳光照在你的心房，每天都有爱你的人给你一个拥抱，每天都有可口的饭菜放在桌上，人生如此，夫复何求？&lt;br/&gt;归根结底，我们一辈子所追求的事情，不过就是为了有一张可以容得下你的床，一个每天可以陪你睡觉，陪你思考的人，和一些你有可无的人，人生到底，一无所有，但当初又为什么要去争呢，也许只是为了当我们老了的时候可以回首之时面带笑容，争的是什么？我有个答案，不管它对不对，都有意义，那就是我们来到人间的这数十年是为了留下每一个瞬间，或甜蜜，或苦楚，没有好坏，而和那些人经历那些事的每一个瞬间，就是永远！永远有多远，永远，也许就是远在天边，近在眼前的你，正如笔若一样明媚的青年——洪绍乾！&lt;br/&gt;爱你的小粉丝——郁之&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '2019-01-04 14:50:32', '2019-01-04 14:51:16', 2, '/static/web/img/inp01.jpg', 3);
INSERT INTO `news` VALUES (6, '项目动态', '项目动态', '状元村建设', '&lt;p&gt;项目动态123&lt;/p&gt;', '2019-01-04 15:41:30', '2019-01-21 20:09:56', 2, '/static/web/img/inp01.jpg', 5);

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `permission_role_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `permission_role_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES (1, 14);
INSERT INTO `permission_role` VALUES (2, 14);
INSERT INTO `permission_role` VALUES (3, 14);
INSERT INTO `permission_role` VALUES (25, 17);
INSERT INTO `permission_role` VALUES (26, 17);
INSERT INTO `permission_role` VALUES (28, 17);
INSERT INTO `permission_role` VALUES (29, 17);
INSERT INTO `permission_role` VALUES (30, 17);
INSERT INTO `permission_role` VALUES (39, 17);
INSERT INTO `permission_role` VALUES (40, 17);
INSERT INTO `permission_role` VALUES (41, 17);
INSERT INTO `permission_role` VALUES (42, 17);
INSERT INTO `permission_role` VALUES (43, 17);
INSERT INTO `permission_role` VALUES (44, 17);
INSERT INTO `permission_role` VALUES (45, 17);
INSERT INTO `permission_role` VALUES (46, 17);
INSERT INTO `permission_role` VALUES (47, 17);
INSERT INTO `permission_role` VALUES (48, 17);
INSERT INTO `permission_role` VALUES (49, 17);
INSERT INTO `permission_role` VALUES (50, 17);
INSERT INTO `permission_role` VALUES (51, 17);
INSERT INTO `permission_role` VALUES (52, 17);
INSERT INTO `permission_role` VALUES (55, 17);
INSERT INTO `permission_role` VALUES (56, 17);
INSERT INTO `permission_role` VALUES (57, 17);
INSERT INTO `permission_role` VALUES (58, 17);
INSERT INTO `permission_role` VALUES (59, 17);
INSERT INTO `permission_role` VALUES (60, 17);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '菜单父ID',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_menu` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否作为菜单显示,[1|0]',
  `init_curd` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否初始化增删改权限节点,[1|0]',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 0, '#1273639', '首页', '顶部首页按钮', 1, 1, 100, '2018-04-23 10:16:35', '2019-01-21 19:27:23');
INSERT INTO `permissions` VALUES (2, 1, '#121258896', '系统管理', NULL, 1, 0, 2018, '2018-04-23 11:51:34', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (3, 2, 'home.index', '系统信息', NULL, 1, 1, 2018, '2018-04-23 11:51:34', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (24, 2, 'setting.index', '网站配置', '网站常用 设置', 1, 0, 2018, '2018-04-23 11:51:34', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (25, 0, '#505999', '用户中心', '用户中心， 管理员+用户', 1, 1, 99, '2018-04-23 17:48:14', '2019-01-21 19:27:30');
INSERT INTO `permissions` VALUES (26, 25, '#453512', '管理员管理', '管理员管理', 1, 1, 2018, '2018-04-23 17:52:08', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (28, 26, 'adminusers.index', '管理员列表', NULL, 1, 1, 2018, '2018-04-23 17:58:03', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (29, 26, 'roles.index', '角色列表', NULL, 1, 1, 2018, '2018-04-23 17:56:54', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (30, 26, 'permissions.index', '权限列表', NULL, 1, 1, 2018, '2018-04-23 17:57:23', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (33, 24, 'setting.create', '新增表单页面', NULL, 0, 1, 2018, '2018-04-24 15:17:28', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (34, 24, 'setting.store', '设置保存', NULL, 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (35, 24, 'setting.edit', '编辑页面', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (36, 24, 'setting.update', '编辑保存', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (37, 24, 'setting.destroy', '删除', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (38, 24, 'setting.batch_destroy', '批量删除', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (39, 28, 'my.index', '我的资料', NULL, 0, 1, 2018, '2018-04-24 19:57:14', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (40, 28, 'my.store', '我的资料保存', NULL, 0, 1, 2018, '2018-04-24 20:07:57', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (41, 28, 'my.chpass', '修改我的密码', NULL, 0, 1, 2018, '2018-04-24 20:08:49', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (42, 28, 'my.storepass', '修改密码保存', NULL, 0, 1, 2018, '2018-04-24 20:09:13', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (43, 28, 'adminusers.create', '新增表单页面', NULL, 0, 1, 2018, '2018-04-24 15:17:28', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (44, 28, 'adminusers.store', '保存', NULL, 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (45, 28, 'adminusers.edit', '编辑页面', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (46, 28, 'adminusers.update', '编辑保存', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (47, 28, 'adminusers.destroy', '删除', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (48, 28, 'adminusers.batch_destroy', '批量删除', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (49, 29, 'roles.create', '新增表单页面', NULL, 0, 1, 2018, '2018-04-24 15:17:28', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (50, 29, 'roles.store', '保存', NULL, 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (51, 29, 'roles.edit', '编辑页面', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (52, 29, 'roles.update', '编辑保存', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (53, 29, 'roles.destroy', '删除', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (54, 29, 'roles.batch_destroy', '批量删除', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (55, 30, 'permissions.create', '新增表单页面', NULL, 0, 1, 2018, '2018-04-24 15:17:28', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (56, 30, 'permissions.store', '保存', NULL, 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (57, 30, 'permissions.edit', '编辑页面', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (58, 30, 'permissions.update', '编辑保存', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (59, 30, 'permissions.destroy', '删除', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (60, 30, 'permissions.batch_destroy', '批量删除', '', 0, 1, 2018, '2018-04-24 15:19:18', '0000-00-00 00:00:00');
INSERT INTO `permissions` VALUES (61, 2, 'banners.index', '轮播图', NULL, 1, 1, 1, '2019-01-21 19:26:26', '2019-01-21 19:29:38');
INSERT INTO `permissions` VALUES (62, 61, 'banners.create', '新增表单页面', NULL, 0, 0, 0, '2019-01-21 19:26:26', '2019-01-21 19:26:26');
INSERT INTO `permissions` VALUES (63, 61, 'banners.store', '设置保存', NULL, 0, 0, 0, '2019-01-21 19:26:27', '2019-01-21 19:26:27');
INSERT INTO `permissions` VALUES (64, 61, 'banners.edit', '编辑页面', NULL, 0, 0, 0, '2019-01-21 19:26:27', '2019-01-21 19:26:27');
INSERT INTO `permissions` VALUES (65, 61, 'banners.update', '编辑保存', NULL, 0, 0, 0, '2019-01-21 19:26:27', '2019-01-21 19:26:27');
INSERT INTO `permissions` VALUES (66, 61, 'banners.destroy', '删除', NULL, 0, 0, 0, '2019-01-21 19:26:27', '2019-01-21 19:26:27');
INSERT INTO `permissions` VALUES (67, 61, 'banners.batch_destroy', '批量删除', NULL, 0, 0, 0, '2019-01-21 19:26:27', '2019-01-21 19:26:27');
INSERT INTO `permissions` VALUES (68, 1, '#1273639.create', '新增表单页面', NULL, 0, 0, 0, '2019-01-21 19:27:23', '2019-01-21 19:27:23');
INSERT INTO `permissions` VALUES (69, 1, '#1273639.store', '设置保存', NULL, 0, 0, 0, '2019-01-21 19:27:23', '2019-01-21 19:27:23');
INSERT INTO `permissions` VALUES (70, 1, '#1273639.edit', '编辑页面', NULL, 0, 0, 0, '2019-01-21 19:27:23', '2019-01-21 19:27:23');
INSERT INTO `permissions` VALUES (71, 1, '#1273639.update', '编辑保存', NULL, 0, 0, 0, '2019-01-21 19:27:23', '2019-01-21 19:27:23');
INSERT INTO `permissions` VALUES (72, 1, '#1273639.destroy', '删除', NULL, 0, 0, 0, '2019-01-21 19:27:23', '2019-01-21 19:27:23');
INSERT INTO `permissions` VALUES (73, 1, '#1273639.batch_destroy', '批量删除', NULL, 0, 0, 0, '2019-01-21 19:27:23', '2019-01-21 19:27:23');
INSERT INTO `permissions` VALUES (74, 25, '#505999.create', '新增表单页面', NULL, 0, 0, 0, '2019-01-21 19:27:30', '2019-01-21 19:27:30');
INSERT INTO `permissions` VALUES (75, 25, '#505999.store', '设置保存', NULL, 0, 0, 0, '2019-01-21 19:27:30', '2019-01-21 19:27:30');
INSERT INTO `permissions` VALUES (76, 25, '#505999.edit', '编辑页面', NULL, 0, 0, 0, '2019-01-21 19:27:30', '2019-01-21 19:27:30');
INSERT INTO `permissions` VALUES (77, 25, '#505999.update', '编辑保存', NULL, 0, 0, 0, '2019-01-21 19:27:30', '2019-01-21 19:27:30');
INSERT INTO `permissions` VALUES (78, 25, '#505999.destroy', '删除', NULL, 0, 0, 0, '2019-01-21 19:27:30', '2019-01-21 19:27:30');
INSERT INTO `permissions` VALUES (79, 25, '#505999.batch_destroy', '批量删除', NULL, 0, 0, 0, '2019-01-21 19:27:30', '2019-01-21 19:27:30');
INSERT INTO `permissions` VALUES (80, 1, '#1548072359322', '新闻中心', NULL, 1, 0, 1, '2019-01-21 20:05:59', '2019-01-21 20:05:59');
INSERT INTO `permissions` VALUES (81, 80, 'news.index', '新闻列表', NULL, 1, 1, 1, '2019-01-21 20:06:18', '2019-01-21 20:06:18');
INSERT INTO `permissions` VALUES (82, 81, 'news.create', '新增表单页面', NULL, 0, 0, 0, '2019-01-21 20:06:18', '2019-01-21 20:06:18');
INSERT INTO `permissions` VALUES (83, 81, 'news.store', '设置保存', NULL, 0, 0, 0, '2019-01-21 20:06:18', '2019-01-21 20:06:18');
INSERT INTO `permissions` VALUES (84, 81, 'news.edit', '编辑页面', NULL, 0, 0, 0, '2019-01-21 20:06:19', '2019-01-21 20:06:19');
INSERT INTO `permissions` VALUES (85, 81, 'news.update', '编辑保存', NULL, 0, 0, 0, '2019-01-21 20:06:19', '2019-01-21 20:06:19');
INSERT INTO `permissions` VALUES (86, 81, 'news.destroy', '删除', NULL, 0, 0, 0, '2019-01-21 20:06:19', '2019-01-21 20:06:19');
INSERT INTO `permissions` VALUES (87, 81, 'news.batch_destroy', '批量删除', NULL, 0, 0, 0, '2019-01-21 20:06:19', '2019-01-21 20:06:19');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (14, '元帅', '元帅', '测试组', '2018-04-23 09:35:50', '2018-04-23 09:35:50');
INSERT INTO `roles` VALUES (17, '将军', '将军', NULL, '2018-04-23 09:35:50', '2018-04-23 09:35:50');
INSERT INTO `roles` VALUES (22, '123', '123', '123', '2018-04-26 18:57:04', '2018-04-26 18:57:04');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `intro` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `settings_key_index`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (3, '网站标题', 'sitetitle', '状元村', 4);
INSERT INTO `settings` VALUES (4, '站点描述', 'description', '描述', 4);
INSERT INTO `settings` VALUES (5, '底部版权', 'bottom_copyright', 'COPYRIGHT 2008-2019 状元村建设 ALL RIGHTS RESERVED <br />京ICP备05082983号-1  <a href=\"http:///\" target=\"_black\">技术支持：TO-DREAM</a>', 1);
INSERT INTO `settings` VALUES (6, '底部_右侧_电话和工作时间', 'bottom_right_tel', '<p class=\"wz24 hg30 en\"><b><a href=\"tel:078-742-7283\">TEL 078-742-7283</a></b></p>\r\n                    <p class=\"mb20\">周一到周五　Am9:00-pM6:00</p>', 1);
INSERT INTO `settings` VALUES (7, '首页_状元村建设', 'index_zyc_jianshe', '<p class=\"wz20 pb10\">北京状元村建设有限公司</p><p class=\"cc3hyc mb50\">Beijing chuxin real estate development co., LTD., has the national first-class real estate development qualification. Since its establishment, it has gradually formed a diver</p>', 3);
INSERT INTO `settings` VALUES (8, '法律声明', 'lagel', '<p class=\"wz18 hongse\">一、 网站内容使用</p><p><br/></p><p>泰羽子瑞网（xxxx.com）拥有本网站内容的最终解释权。未经本网站授权，任何个人或组织不得抄袭、转载、摘编、修改本网站内容；本网站与他人另有协议或法律另有规定的除外。本站上的内容及编辑等形式均受版权法等法律保护，任何未经授权的使用都可能构成对版权、商标和其他法律权利的侵犯。</p><p>转载、摘编本网站刊登、发布的作品的，须按有关规定向著作权人或本网站支付报酬并注明出处，且不得超过本网站刊登、转载该作品的范围；著作权人声明或本网站受著作权人授权声明不得转载、摘编其作品的，任何人不得擅自转载、摘编，否则必须承担一切法律后果。</p><p><br/></p><p class=\"wz18 hongse\">二、 网站信息发布</p><p><br/></p><p>网站对网民上载的数字化作品著作权归属不负事先审查义务；上载人应当在确信自己没有侵害他人著作权的前提之下，向本网站上载数字化作品，否则应当自行承担有关法律责任。</p><p>用户通过（xxxx.com）途径发表的一切原创信息，包括但不限于文章、图片、FLASH、影音文件等，其版权归xxxx.com及该用户共同所有。xxxx.com有权在www.xxxx.com网站及xxxx.com自行开设或与合作伙伴共同开设的其他专栏内摘录、转载和引用此类信息全部的或部分的内容。</p><p>本网站转载的文章，其中之观点仅代表作者本人观点，并不代表本网观点，亦不应视为本网赞同和支持其观点。</p><p><br/></p><p class=\"wz18 hongse\">三、 用户隐私权</p><p><br/></p><p>泰羽子瑞网尊重广大用户的隐私，未经用户的同意，我们不搜集用户的资料。对于因服务或统计的需要而掌握的用户的IP地址、电子邮件、电话、通信地址及其他信息，我们承诺非经用户允许，不向任何第三方提供。</p><p><br/></p><p class=\"wz18 hongse\">四、 其他</p><p><br/></p><p>著作权人发现本网站载有侵害其合法权益的内容或作品，要求本网站提供侵权人注册资料或删除所谓侵权内容，必须向本网站版权律师提供下列6项材料，否则本网站视其著作权权属抗议无效：</p><p>1． 本人的身份证明文件；</p><p>2． 著作权权属证明；</p><p>3． 侵害著作权作品在本网站的所在位置；</p><p>4． 著作权人的必要的真实的联系方法；</p><p>5． 对于自身提供的上述资料的真实性的书面保证；</p><p>6． 法律明文要求的其他资料。</p>', 3);

SET FOREIGN_KEY_CHECKS = 1;
