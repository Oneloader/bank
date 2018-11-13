/*
 Navicat Premium Data Transfer

 Source Server         : k11
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : bank_change_system

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 13/11/2018 10:35:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ka_activity
-- ----------------------------
DROP TABLE IF EXISTS `ka_activity`;
CREATE TABLE `ka_activity`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '银行支行名称',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '封面图片',
  `back_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '活动内页顶部图片',
  `back_color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '活动内页背景颜色',
  `nav_color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '客户经理页面顶部导航颜色',
  `is_level` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0:不分级   1:分级',
  `is_stock` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0:不显示库存  1:显示库存',
  `is_price` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0:不显示价格  1:显示价格',
  `choice_num` tinyint(1) NOT NULL COMMENT '0:不能选择商品数量  1:可以选择商品数量',
  `must_name_id` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0:不显示客户姓名、身份证号 1:显示客户姓名、身份证号',
  `must_user_phone` tinyint(1) NOT NULL COMMENT '0:不显示客户手机号 1:显示客户手机号',
  `id_length` int(2) UNSIGNED NOT NULL COMMENT '需要输入的身份证号长度',
  `start_time` int(10) UNSIGNED NOT NULL COMMENT '活动开始时间',
  `end_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动类型  1:顾客自助兑换 2:销售经理兑换',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0:屏蔽   1:可用   2:删除',
  `sid` mediumint(5) UNSIGNED NOT NULL DEFAULT 0,
  `new_field` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '自定义字段',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '活动表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ka_activity
-- ----------------------------
INSERT INTO `ka_activity` VALUES (5, '国庆兑换活动', 'http://l.bank.cn/public/upload/activity/2018/09-27/848daa2535b8d6b0da8fde7c0a1a53cd.png', '', '', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1540915200, 1, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (6, '元旦兑换活动', 'http://l.bank.cn/public/upload/activity/2018/09-27/2c93c52d5c7da0d5af8663c4d9f06bf1.png', '', '', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 1540569600, 1, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (7, '自助兑换活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/abd882b8c3a44f97cfcf7042b1cb6e23.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/261270fd7ddddad11bae1d6807e8d2e5.jpg', '#770b22', NULL, 0, 0, 1, 0, 0, 0, 0, 0, 1540972505, 1, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (8, 'test', 'http://l.bank.cn/public/upload/activity/2018/09-28/21234447f957b9fee9ae2b309b29f035.png', '', '', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1538808698, 1, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (9, 'abcde', 'http://ex.li99.com.cn/public/upload/activity/2018/10-22/a2fdb86ffa49277bc3765a89922dcf09.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-22/c34bec24cceccc80c0ab6d767e8d7149.jpg', '#f03939', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1546325698, 2, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (10, '客户经理兑换活动测试', 'http://ex.li99.com.cn/public/upload/activity/2018/10-22/50b93ae4df9c1642e714e7ecdbf05f82.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-22/5b0323236aa08a9f7d9a2148624307eb.jpg', '#d94141', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1546326027, 2, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (11, '自助兑换测试活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/cadeeab39df60329586d34343dd53213.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/eac33da7c636093c01774513d47275ac.jpg', '#750c22', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1540978238, 2, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (12, '自助兑换测试活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/903465918322b31e66e271a377743ec6.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/1d17a7043a4346eaf258a6edbdc88aaa.jpg', '#750c22', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1540978298, 1, 1, 31, NULL);
INSERT INTO `ka_activity` VALUES (13, '春节测试兑换活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/f5f925ff6ec84dc5a13f1c4af3b148dd.png', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/0ed88775bafdabf9c6a35ac0bbd59c70.png', '#91d1de', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1540978749, 2, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (14, '双十一测试兑换活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/fe6f10d1d9b5922c7233e168a03ce377.png', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/03f9449d7101921c9582476d2264fa7d.png', '#aaf7cf', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1540979167, 2, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (15, '双十一测试兑换活动', 'http://www.bank.com/public/upload/activity/2018/10-17/4c26f8d29aceb2f6e0749411b4188c44.png', 'http://www.bank.com/public/upload/activity/2018/10-17/889bc131ea281792ba1cf1ffaa5dbfd9.png', '#911a1a', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 1540979241, 1, 2, 31, NULL);
INSERT INTO `ka_activity` VALUES (16, '双十一测试兑换活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/42cf36742bcdde173f0edf76be3f6b35.png', 'http://ex.li99.com.cn/public/upload/activity/2018/10-17/e7640a2409621e9e65b9de51823cab47.png', '#c8e4e6', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1541670738, 1, 0, 31, NULL);
INSERT INTO `ka_activity` VALUES (17, '2018年贵宾客户生日礼招募礼兑换活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-23/9297023af277bbbc8642768bcc8e38bc.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-23/2bfcb8d1522a28843d96e17b2fef0147.jpg', '#fcfcfc', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 1571443200, 1, 1, 33, NULL);
INSERT INTO `ka_activity` VALUES (18, '客户经理发放活动测试', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/5ce8619e051f41faffb7a0ba26f071cd.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/ec418287d86a08f97526859beb659564.jpg', '#750b21', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1540979230, 1, 2, 32, NULL);
INSERT INTO `ka_activity` VALUES (19, '95561降级挽回活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/9337f92c90a974457042f31a3c4b7356.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/8acacf65a6413d607675aedd7202a335.jpg', '#ffffff', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 1546214400, 1, 2, 37, NULL);
INSERT INTO `ka_activity` VALUES (20, '95561降级挽回活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/bde7908ef25f8870ee814979567808f4.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/6c4b5bd1c27e84d08d2722d5bf9923dd.jpg', '#fcfcfc', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 1546214400, 1, 2, 37, NULL);
INSERT INTO `ka_activity` VALUES (21, '客户经理发放活动', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/7e508ae543d4cddfc934e3b873dce1c9.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/4ea8b327deb46c5390c16691ec95e940.jpg', '#760c22', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1540980649, 1, 2, 37, NULL);
INSERT INTO `ka_activity` VALUES (22, '发放活动测试', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/47864915dd6f10c03dbc8468d6e4aeed.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/04ac3c31ea09623505a8fc1801b25a66.jpg', '#760c22', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1540980819, 1, 1, 36, NULL);
INSERT INTO `ka_activity` VALUES (23, '测试销售活动', 'http://www.bank.com/public/upload/activity/2018/10-24/c4e3502aae6985e2736c711d60454d99.png', 'http://www.bank.com/public/upload/activity/2018/10-24/ae1d3c4eccc101d3034f1309f4d0dc7f.png', '#d44444', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1540376388, 2, 2, 37, NULL);
INSERT INTO `ka_activity` VALUES (24, '测试用户活动', 'http://www.bank.com/public/upload/activity/2018/10-24/bad98b16b8426c7b316376b7a10a4944.jpg', 'http://www.bank.com/public/upload/activity/2018/10-24/c4c44e7d13f79e2ceb3b3e20ce6030f1.png', '#d11919', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1540376556, 1, 2, 37, NULL);
INSERT INTO `ka_activity` VALUES (25, '测试用户活动', 'http://www.bank.com/public/upload/activity/2018/10-24/bad98b16b8426c7b316376b7a10a4944.jpg', 'http://www.bank.com/public/upload/activity/2018/10-24/c4c44e7d13f79e2ceb3b3e20ce6030f1.png', '#d11919', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1540376556, 1, 2, 37, NULL);
INSERT INTO `ka_activity` VALUES (26, '测试销售活动test', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/30b3767ab150da2639c946812e898e97.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/ca5f63efeaa5fce2c8fd25dd14156741.jpg', '#e32d2d', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1540376686, 2, 2, 37, NULL);
INSERT INTO `ka_activity` VALUES (27, '发放活动测试', '', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/2b43ab1ca740814a082625e961d7b8d8.jpg', '#750c22', NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1540981666, 2, 2, 37, NULL);
INSERT INTO `ka_activity` VALUES (28, '95561降级挽回活动', '', 'http://ex.li99.com.cn/public/upload/activity/2018/10-24/249496525efa82340beb28a2cd13fba4.jpg', '#ffffff', NULL, 1, 0, 0, 0, 0, 0, 0, 0, 1546300800, 1, 2, 37, NULL);
INSERT INTO `ka_activity` VALUES (29, '95561降级挽回活动', 'http://www.bank.com/public/upload/activity/2018/10-30/770524992e71b6891e24fa9cce51bab3.jpg', 'http://ex.li99.com.cn/public/upload/activity/2018/10-25/2be62ccc9e5d5bc5e14d807c173f6afa.gif', '#b22c29', NULL, 1, 1, 0, 1, 1, 0, 6, 1538370715, 1546300800, 2, 1, 37, '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"remarks\":\"\\u8bf7\\u8f93\\u5165\\u5b66\\u6821\\u5168\\u79f0\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"remarks\":\"\\u662f\\u5426\\u7ed3\\u5a5a\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"remarks\":\"\\u662f\\u6216\\u5426\"}]');
INSERT INTO `ka_activity` VALUES (30, '兑换活动test', 'http://www.bank.com/public/upload/activity/2018/10-29/6474bfe1398932a86205eb324ee84a38.jpg', 'http://www.bank.com/public/upload/activity/2018/10-29/25d10b8aead0aabe0f8d9fd8c25dd276.jpg', '#ba3737', '#421111', 1, 0, 1, 0, 1, 1, 4, 1538323200, 1546327360, 1, 1, 37, '[{\"title\":\"41\",\"en_title\":\"41\",\"remarks\":\"41\"},{\"title\":\"14\",\"en_title\":\"14\",\"remarks\":\"14\"}]');
INSERT INTO `ka_activity` VALUES (31, '测试活动test', 'http://www.bank.com/public/upload/activity/2018/10-29/0ec127712f8115a12b87ac5ecf9e471e.jpg', 'http://www.bank.com/public/upload/activity/2018/10-29/592cd0a0aab19da637ee8c93ae664c69.png', '#9c5353', '#505299', 0, 1, 0, 0, 0, 0, 6, 1540806048, 1548927651, 2, 1, 37, '[{\"title\":\"12\",\"en_title\":\"12\",\"remarks\":\"12\"},{\"title\":\"21\",\"en_title\":\"21\",\"remarks\":\"21\"}]');
INSERT INTO `ka_activity` VALUES (32, '测试活动', 'http://www.bank.com/public/upload/activity/2018/11-12/fa3d049f88742ac0dfcbd8229c8fd610.jpg', 'http://www.bank.com/public/upload/activity/2018/11-12/554e29e612da136fc9b51e59d233c8c8.png', '#d43b3b', NULL, 0, 0, 0, 0, 0, 0, 4, 1541994750, 1548388352, 1, 1, 37, NULL);

-- ----------------------------
-- Table structure for ka_activity_auth
-- ----------------------------
DROP TABLE IF EXISTS `ka_activity_auth`;
CREATE TABLE `ka_activity_auth`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `aid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动id',
  `sales_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '销售经理id',
  `is_leader` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1:活动领导   0:普通销售经理',
  `sid` mediumint(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `as`(`aid`, `sid`) USING BTREE,
  INDEX `ss`(`sales_id`, `sid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 155 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '活动权限表（与销售经理关系表）' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_activity_auth
-- ----------------------------
INSERT INTO `ka_activity_auth` VALUES (2, 6, 2, 0, 31);
INSERT INTO `ka_activity_auth` VALUES (3, 6, 3, 0, 31);
INSERT INTO `ka_activity_auth` VALUES (5, 5, 3, 0, 31);
INSERT INTO `ka_activity_auth` VALUES (6, 9, 3, 1, 31);
INSERT INTO `ka_activity_auth` VALUES (7, 7, 2, 1, 31);
INSERT INTO `ka_activity_auth` VALUES (8, 7, 3, 0, 31);
INSERT INTO `ka_activity_auth` VALUES (11, 10, 3, 0, 31);
INSERT INTO `ka_activity_auth` VALUES (13, 10, 2, 0, 31);
INSERT INTO `ka_activity_auth` VALUES (14, 10, 4, 1, 31);
INSERT INTO `ka_activity_auth` VALUES (15, 10, 6, 1, 31);
INSERT INTO `ka_activity_auth` VALUES (16, 29, 10, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (17, 29, 11, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (19, 29, 9, 1, 37);
INSERT INTO `ka_activity_auth` VALUES (20, 29, 12, 1, 37);
INSERT INTO `ka_activity_auth` VALUES (21, 29, 13, 1, 37);
INSERT INTO `ka_activity_auth` VALUES (22, 29, 8, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (23, 29, 14, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (24, 29, 15, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (25, 29, 16, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (26, 29, 17, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (27, 29, 18, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (28, 29, 19, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (29, 29, 20, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (30, 29, 21, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (31, 29, 22, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (32, 29, 23, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (33, 29, 24, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (34, 29, 25, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (35, 29, 26, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (36, 29, 27, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (37, 29, 28, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (38, 29, 29, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (39, 29, 30, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (40, 29, 31, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (41, 29, 32, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (42, 29, 33, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (43, 29, 34, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (44, 29, 35, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (45, 29, 36, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (46, 29, 37, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (47, 29, 38, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (48, 29, 39, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (49, 29, 40, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (50, 29, 41, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (51, 29, 42, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (52, 29, 43, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (53, 29, 44, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (54, 29, 136, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (55, 29, 46, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (56, 29, 47, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (57, 29, 48, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (58, 29, 49, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (59, 29, 50, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (60, 29, 51, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (61, 29, 52, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (62, 29, 53, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (63, 29, 54, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (64, 29, 55, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (65, 29, 56, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (66, 29, 57, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (67, 29, 58, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (68, 29, 59, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (69, 29, 60, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (70, 29, 61, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (71, 29, 62, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (72, 29, 63, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (73, 29, 64, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (74, 29, 65, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (75, 29, 66, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (76, 29, 67, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (77, 29, 68, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (78, 29, 69, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (79, 29, 70, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (80, 29, 71, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (81, 29, 72, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (82, 29, 73, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (83, 29, 74, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (84, 29, 75, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (85, 29, 76, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (86, 29, 77, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (87, 29, 78, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (88, 29, 79, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (89, 29, 80, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (90, 29, 81, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (91, 29, 82, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (92, 29, 83, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (93, 29, 84, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (94, 29, 85, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (95, 29, 86, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (96, 29, 87, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (97, 29, 88, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (98, 29, 89, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (99, 29, 90, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (100, 29, 91, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (101, 29, 92, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (102, 29, 93, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (103, 29, 94, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (104, 29, 95, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (105, 29, 96, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (106, 29, 97, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (107, 29, 98, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (108, 29, 99, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (109, 29, 100, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (110, 29, 101, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (111, 29, 102, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (112, 29, 103, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (113, 29, 104, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (114, 29, 105, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (115, 29, 106, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (116, 29, 107, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (117, 29, 108, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (118, 29, 109, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (119, 29, 110, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (120, 29, 111, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (121, 29, 112, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (122, 29, 113, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (123, 29, 114, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (124, 29, 115, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (125, 29, 116, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (126, 29, 117, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (127, 29, 118, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (128, 29, 119, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (129, 29, 120, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (130, 29, 121, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (131, 29, 122, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (132, 29, 123, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (133, 29, 124, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (134, 29, 125, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (135, 29, 126, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (136, 29, 127, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (137, 29, 128, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (138, 29, 129, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (139, 29, 130, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (140, 29, 131, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (141, 29, 132, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (142, 29, 133, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (143, 29, 134, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (144, 29, 135, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (149, 29, 137, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (150, 29, 138, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (152, 29, 139, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (153, 31, 12, 0, 37);
INSERT INTO `ka_activity_auth` VALUES (154, 29, 140, 1, 37);

-- ----------------------------
-- Table structure for ka_activity_goods
-- ----------------------------
DROP TABLE IF EXISTS `ka_activity_goods`;
CREATE TABLE `ka_activity_goods`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `aid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动id',
  `level_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动兑换档次',
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `store` mediumint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品活动库存',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0:屏蔽  1:显示',
  `sid` mediumint(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `ag`(`aid`, `goods_id`) USING BTREE,
  INDEX `alg`(`aid`, `level_id`, `goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_activity_goods
-- ----------------------------
INSERT INTO `ka_activity_goods` VALUES (1, 5, 0, 2, 20, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (2, 5, 0, 3, 300, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (6, 6, 5, 2, 10, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (10, 6, 7, 3, 9, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (11, 6, 7, 4, 8, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (13, 7, 0, 5, 99, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (14, 12, 8, 5, 91, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (15, 12, 9, 6, 10, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (16, 16, 10, 5, 10, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (17, 9, 0, 5, 0, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (22, 17, 17, 14, 499, 1, 33);
INSERT INTO `ka_activity_goods` VALUES (23, 17, 17, 15, 500, 1, 33);
INSERT INTO `ka_activity_goods` VALUES (25, 17, 16, 13, 500, 1, 33);
INSERT INTO `ka_activity_goods` VALUES (26, 17, 15, 10, 100, 1, 33);
INSERT INTO `ka_activity_goods` VALUES (27, 17, 15, 11, 100, 1, 33);
INSERT INTO `ka_activity_goods` VALUES (28, 17, 15, 12, 100, 1, 33);
INSERT INTO `ka_activity_goods` VALUES (29, 17, 14, 7, 99, 1, 33);
INSERT INTO `ka_activity_goods` VALUES (30, 17, 14, 8, 100, 1, 33);
INSERT INTO `ka_activity_goods` VALUES (32, 10, 13, 26, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (33, 10, 13, 27, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (34, 10, 13, 28, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (35, 10, 13, 29, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (36, 10, 13, 30, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (37, 10, 13, 31, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (38, 10, 13, 32, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (39, 10, 12, 7, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (40, 10, 12, 8, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (41, 10, 12, 9, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (42, 10, 12, 10, 100, 1, 31);
INSERT INTO `ka_activity_goods` VALUES (46, 28, 18, 16, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (47, 28, 18, 17, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (48, 28, 18, 18, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (49, 28, 18, 19, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (50, 28, 18, 20, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (53, 28, 19, 21, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (54, 28, 19, 22, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (55, 28, 19, 23, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (56, 28, 19, 24, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (57, 28, 19, 25, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (58, 28, 19, 26, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (60, 28, 20, 27, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (61, 28, 20, 28, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (62, 28, 20, 29, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (63, 28, 20, 30, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (64, 28, 20, 31, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (65, 28, 20, 32, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (67, 29, 21, 16, 51, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (68, 29, 21, 17, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (69, 29, 21, 18, 92, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (70, 29, 21, 19, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (71, 29, 21, 20, 99, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (74, 29, 22, 21, 99, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (75, 29, 22, 22, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (76, 29, 22, 23, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (77, 29, 22, 24, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (78, 29, 22, 25, 90, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (79, 29, 22, 26, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (81, 29, 23, 27, 96, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (82, 29, 23, 28, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (83, 29, 23, 29, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (84, 29, 23, 30, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (85, 29, 23, 31, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (86, 29, 23, 32, 100, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (88, 17, 16, 42, 500, 1, 33);
INSERT INTO `ka_activity_goods` VALUES (89, 30, 25, 18, 50, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (90, 30, 25, 20, 50, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (91, 30, 25, 21, 49, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (92, 30, 25, 25, 50, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (96, 30, 24, 12, 43, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (97, 30, 24, 13, 49, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (98, 30, 24, 14, 50, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (99, 30, 24, 15, 49, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (103, 31, 0, 7, 10, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (104, 31, 0, 10, 10, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (105, 31, 0, 11, 10, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (106, 31, 0, 12, 10, 1, 37);
INSERT INTO `ka_activity_goods` VALUES (107, 32, 0, 12, 3, 1, 37);

-- ----------------------------
-- Table structure for ka_ad
-- ----------------------------
DROP TABLE IF EXISTS `ka_ad`;
CREATE TABLE `ka_ad`  (
  `ad_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '广告位置ID',
  `ad_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告名称',
  `ad_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片地址',
  `start_time` int(11) NOT NULL DEFAULT 0 COMMENT '投放时间',
  `end_time` int(11) NOT NULL DEFAULT 0 COMMENT '结束时间',
  `enabled` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否显示',
  `orderby` smallint(6) NULL DEFAULT 50 COMMENT '排序',
  `g_id` int(50) NULL DEFAULT NULL COMMENT '根据cat查询出是商品|品牌|优惠券的id保存',
  `g_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '类别:1.商品2.品牌3.优惠券',
  `sid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`ad_id`) USING BTREE,
  INDEX `enabled`(`enabled`) USING BTREE,
  INDEX `position_id`(`pid`) USING BTREE,
  INDEX `s`(`sid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ka_ad_position
-- ----------------------------
DROP TABLE IF EXISTS `ka_ad_position`;
CREATE TABLE `ka_ad_position`  (
  `position_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '表id',
  `position_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告位置名称',
  `position_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告描述',
  `is_open` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0关闭1开启',
  PRIMARY KEY (`position_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ka_admin
-- ----------------------------
DROP TABLE IF EXISTS `ka_admin`;
CREATE TABLE `ka_admin`  (
  `admin_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'email',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `ec_salt` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '秘钥',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `last_login` int(11) NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `last_ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `nav_list` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '权限',
  `lang_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'lang_type',
  `agency_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'agency_id',
  `suppliers_id` smallint(5) UNSIGNED NULL DEFAULT 0 COMMENT 'suppliers_id',
  `todolist` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'todolist',
  `sid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '关联商城id',
  `role_id` smallint(5) NULL DEFAULT 0 COMMENT '角色id',
  PRIMARY KEY (`admin_id`) USING BTREE,
  INDEX `user_name`(`user_name`) USING BTREE,
  INDEX `agency_id`(`agency_id`) USING BTREE,
  INDEX `sid`(`sid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_admin
-- ----------------------------
INSERT INTO `ka_admin` VALUES (1, 'admin', '654345353@qq.com', '773f53c7a16fde9dc1e4d042b9cee221', NULL, 1496768089, 1541993245, '127.0.0.1', '', '', 0, 0, NULL, 0, 1);
INSERT INTO `ka_admin` VALUES (2, 'wuzhi0913', '', '3975656c1468b9a88430c4a687b557cf', NULL, 1540387322, 0, '', NULL, '', 0, 0, NULL, 37, 0);
INSERT INTO `ka_admin` VALUES (3, 'wangdi', '', '6f6430dcd6121af71f514c38afe79dfd', NULL, 1541410676, 1541478843, '127.0.0.1', NULL, '', 0, 0, NULL, 37, 2);

-- ----------------------------
-- Table structure for ka_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `ka_admin_log`;
CREATE TABLE `ka_admin_log`  (
  `log_id` bigint(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '表id',
  `admin_id` int(10) NULL DEFAULT NULL COMMENT '管理员id',
  `action` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `log_info` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '日志描述',
  `log_ip` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ip地址',
  `log_time` int(10) NULL DEFAULT NULL COMMENT '日志时间',
  `sid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`log_id`) USING BTREE,
  INDEX `a`(`action`, `sid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3316 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_admin_log
-- ----------------------------
INSERT INTO `ka_admin_log` VALUES (2584, 1, 'n', '后台登录', '127.0.0.1', 1537862299, 0);
INSERT INTO `ka_admin_log` VALUES (2585, 1, 'n', '后台登录', '127.0.0.1', 1537862619, 0);
INSERT INTO `ka_admin_log` VALUES (2586, 1, 'n', '添加银行:农业银行', '127.0.0.1', 1537863062, 0);
INSERT INTO `ka_admin_log` VALUES (2587, 1, 'n', '后台登录', '127.0.0.1', 1537864959, 0);
INSERT INTO `ka_admin_log` VALUES (2588, 1, 'n', '后台登录', '127.0.0.1', 1537865124, 0);
INSERT INTO `ka_admin_log` VALUES (2589, 1, 'n', '后台登录', '127.0.0.1', 1537865176, 0);
INSERT INTO `ka_admin_log` VALUES (2590, 1, 'n', '后台登录', '127.0.0.1', 1537866442, 0);
INSERT INTO `ka_admin_log` VALUES (2591, 1, 'n', '后台登录', '127.0.0.1', 1537927098, 0);
INSERT INTO `ka_admin_log` VALUES (2592, 1, 'n', '添加支行【测试】成功', '127.0.0.1', 1537945227, 31);
INSERT INTO `ka_admin_log` VALUES (2593, 1, 'n', '编辑支行【测试dfasf】成功', '127.0.0.1', 1537945233, 31);
INSERT INTO `ka_admin_log` VALUES (2594, 1, 'n', '删除支行成功【测试dfasf】', '127.0.0.1', 1537945286, 31);
INSERT INTO `ka_admin_log` VALUES (2595, 1, 'n', '添加销售经理【18782985560】成功', '127.0.0.1', 1537946462, 31);
INSERT INTO `ka_admin_log` VALUES (2596, 1, 'n', '编辑销售经理【18782985561】成功', '127.0.0.1', 1537946729, 31);
INSERT INTO `ka_admin_log` VALUES (2597, 1, 'n', '编辑销售经理【18782985560】成功', '127.0.0.1', 1537946735, 31);
INSERT INTO `ka_admin_log` VALUES (2598, 1, 'n', '删除支行成功【18782985560】', '127.0.0.1', 1537946802, 31);
INSERT INTO `ka_admin_log` VALUES (2599, 1, 'n', '添加销售经理【18782985560】成功', '127.0.0.1', 1537947279, 31);
INSERT INTO `ka_admin_log` VALUES (2600, 1, 'n', '添加兑换等级【一等奖】成功', '127.0.0.1', 1537947396, 31);
INSERT INTO `ka_admin_log` VALUES (2601, 1, 'n', '编辑兑换等级【特等奖】成功', '127.0.0.1', 1537947472, 31);
INSERT INTO `ka_admin_log` VALUES (2602, 1, 'n', '删除兑换等级成功【特等奖】', '127.0.0.1', 1537947476, 31);
INSERT INTO `ka_admin_log` VALUES (2603, 1, 'n', '添加兑换等级【一等奖】成功', '127.0.0.1', 1537947489, 31);
INSERT INTO `ka_admin_log` VALUES (2604, 1, 'n', '编辑销售经理【18782985560】成功', '127.0.0.1', 1537949037, 31);
INSERT INTO `ka_admin_log` VALUES (2605, 1, 'n', '后台登录', '127.0.0.1', 1538013889, 0);
INSERT INTO `ka_admin_log` VALUES (2606, 1, 'n', '添加支行【aaa】成功', '127.0.0.1', 1538014383, 31);
INSERT INTO `ka_admin_log` VALUES (2607, 1, 'n', '删除支行成功【aaa】', '127.0.0.1', 1538014406, 31);
INSERT INTO `ka_admin_log` VALUES (2608, 1, 'n', '添加活动【】成功', '127.0.0.1', 1538015766, 31);
INSERT INTO `ka_admin_log` VALUES (2609, 1, 'n', '添加活动【】成功', '127.0.0.1', 1538015820, 31);
INSERT INTO `ka_admin_log` VALUES (2610, 1, 'n', '添加销售经理【18782985561】成功', '127.0.0.1', 1538034684, 31);
INSERT INTO `ka_admin_log` VALUES (2611, 1, 'n', '编辑销售经理【18782985561】成功', '127.0.0.1', 1538035112, 31);
INSERT INTO `ka_admin_log` VALUES (2612, 1, 'n', '编辑兑换等级【一等奖1】成功', '127.0.0.1', 1538041304, 31);
INSERT INTO `ka_admin_log` VALUES (2613, 1, 'n', '编辑兑换等级【一等奖】成功', '127.0.0.1', 1538041310, 31);
INSERT INTO `ka_admin_log` VALUES (2614, 1, 'n', '添加兑换等级【二等奖】成功', '127.0.0.1', 1538041321, 31);
INSERT INTO `ka_admin_log` VALUES (2615, 1, 'n', '添加兑换等级【三等奖】成功', '127.0.0.1', 1538041849, 31);
INSERT INTO `ka_admin_log` VALUES (2616, 1, 'n', '编辑兑换等级【三等奖1】成功', '127.0.0.1', 1538042080, 31);
INSERT INTO `ka_admin_log` VALUES (2617, 1, 'n', '编辑兑换等级【三等奖】成功', '127.0.0.1', 1538042086, 31);
INSERT INTO `ka_admin_log` VALUES (2618, 1, 'n', '后台登录', '127.0.0.1', 1538099070, 0);
INSERT INTO `ka_admin_log` VALUES (2619, 1, 'n', '后台登录', '127.0.0.1', 1538108577, 0);
INSERT INTO `ka_admin_log` VALUES (2620, 1, 'n', '添加活动【】成功', '127.0.0.1', 1538117305, 31);
INSERT INTO `ka_admin_log` VALUES (2621, 1, 'n', '添加活动【】成功', '127.0.0.1', 1538117502, 31);
INSERT INTO `ka_admin_log` VALUES (2622, 1, 'n', '添加活动【】成功', '127.0.0.1', 1538117741, 31);
INSERT INTO `ka_admin_log` VALUES (2623, 1, 'n', '删除兑换活动成功【test】', '127.0.0.1', 1538117904, 31);
INSERT INTO `ka_admin_log` VALUES (2624, 1, 'n', '添加活动【】成功', '127.0.0.1', 1538118030, 31);
INSERT INTO `ka_admin_log` VALUES (2625, 1, 'n', '后台登录', '127.0.0.1', 1538205728, 0);
INSERT INTO `ka_admin_log` VALUES (2626, 1, 'n', '后台登录', '127.0.0.1', 1538273314, 0);
INSERT INTO `ka_admin_log` VALUES (2627, 1, 'n', '生成兑换码成功，批次编号【201809301041_6_1】', '127.0.0.1', 1538275277, 31);
INSERT INTO `ka_admin_log` VALUES (2628, 1, 'n', '生成兑换码成功，批次编号【201809301134_6_3】', '127.0.0.1', 1538278462, 31);
INSERT INTO `ka_admin_log` VALUES (2629, 1, 'n', '生成兑换码成功，批次编号【201809301253_5_1】', '127.0.0.1', 1538283859, 31);
INSERT INTO `ka_admin_log` VALUES (2630, 1, 'n', '生成兑换码成功，批次编号【201809301311_6_1】', '127.0.0.1', 1538284321, 31);
INSERT INTO `ka_admin_log` VALUES (2631, 1, 'n', '生成兑换码成功，批次编号【201809301312_6_5】', '127.0.0.1', 1538284363, 31);
INSERT INTO `ka_admin_log` VALUES (2632, 1, 'n', '生成兑换码成功，批次编号【201809301314_6_1】', '127.0.0.1', 1538284452, 31);
INSERT INTO `ka_admin_log` VALUES (2633, 1, 'n', '后台登录', '127.0.0.1', 1538292424, 0);
INSERT INTO `ka_admin_log` VALUES (2634, 1, 'n', '后台登录', '127.0.0.1', 1538298302, 0);
INSERT INTO `ka_admin_log` VALUES (2635, 1, 'n', '后台登录', '127.0.0.1', 1538963483, 0);
INSERT INTO `ka_admin_log` VALUES (2636, 1, 'n', '添加银行【中国农业银行】', '127.0.0.1', 1538971447, 0);
INSERT INTO `ka_admin_log` VALUES (2637, 1, 'n', '生成兑换码成功，批次编号【201810081220_5_1】', '127.0.0.1', 1538972418, 31);
INSERT INTO `ka_admin_log` VALUES (2638, 1, 'n', '生成兑换码成功，批次编号【201810081227_5_2】', '127.0.0.1', 1538972871, 31);
INSERT INTO `ka_admin_log` VALUES (2639, 1, 'n', '后台登录', '127.0.0.1', 1539062417, 0);
INSERT INTO `ka_admin_log` VALUES (2640, 1, 'n', '后台登录', '127.0.0.1', 1539062436, 0);
INSERT INTO `ka_admin_log` VALUES (2641, 1, 'n', '后台登录', '127.0.0.1', 1539135380, 0);
INSERT INTO `ka_admin_log` VALUES (2642, 1, 'n', '后台登录', '127.0.0.1', 1539138611, 0);
INSERT INTO `ka_admin_log` VALUES (2643, 1, 'n', '生成兑换码成功，批次编号【201810101045_6_1】', '127.0.0.1', 1539139538, 31);
INSERT INTO `ka_admin_log` VALUES (2644, 1, 'n', '生成兑换码成功，批次编号【201810101338_7_1】', '127.0.0.1', 1539149894, 31);
INSERT INTO `ka_admin_log` VALUES (2645, 1, 'n', '生成兑换码成功，批次编号【201810101520_6_2】', '127.0.0.1', 1539156037, 31);
INSERT INTO `ka_admin_log` VALUES (2646, 1, 'n', '后台登录', '127.0.0.1', 1539156141, 0);
INSERT INTO `ka_admin_log` VALUES (2647, 1, 'n', '后台登录', '127.0.0.1', 1539156608, 0);
INSERT INTO `ka_admin_log` VALUES (2648, 1, 'n', '后台登录', '127.0.0.1', 1539157184, 0);
INSERT INTO `ka_admin_log` VALUES (2649, 1, 'n', '后台登录', '127.0.0.1', 1539158839, 0);
INSERT INTO `ka_admin_log` VALUES (2650, 1, 'n', '生成兑换码成功，批次编号【201810101810_7_2】', '127.0.0.1', 1539166219, 31);
INSERT INTO `ka_admin_log` VALUES (2651, 1, 'n', '生成兑换码成功，批次编号【201810101811_7_3】', '127.0.0.1', 1539166313, 31);
INSERT INTO `ka_admin_log` VALUES (2652, 1, 'n', '后台登录', '127.0.0.1', 1539221674, 0);
INSERT INTO `ka_admin_log` VALUES (2653, 1, 'n', '后台登录', '127.0.0.1', 1539221847, 0);
INSERT INTO `ka_admin_log` VALUES (2654, 1, 'n', '生成兑换码成功，批次编号【201810110939_5_1】', '127.0.0.1', 1539221950, 31);
INSERT INTO `ka_admin_log` VALUES (2655, 1, 'n', '生成兑换码成功，批次编号【201810110943_5_2】', '127.0.0.1', 1539222296, 31);
INSERT INTO `ka_admin_log` VALUES (2656, 1, 'n', '后台登录', '127.0.0.1', 1539308809, 0);
INSERT INTO `ka_admin_log` VALUES (2657, 1, 'n', '后台登录', '127.0.0.1', 1539567181, 0);
INSERT INTO `ka_admin_log` VALUES (2658, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539593185, 31);
INSERT INTO `ka_admin_log` VALUES (2659, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539595362, 31);
INSERT INTO `ka_admin_log` VALUES (2660, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539595387, 31);
INSERT INTO `ka_admin_log` VALUES (2661, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539595528, 31);
INSERT INTO `ka_admin_log` VALUES (2662, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539595565, 31);
INSERT INTO `ka_admin_log` VALUES (2663, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539596257, 31);
INSERT INTO `ka_admin_log` VALUES (2664, 1, 'n', '后台登录', '127.0.0.1', 1539655174, 0);
INSERT INTO `ka_admin_log` VALUES (2665, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539670121, 31);
INSERT INTO `ka_admin_log` VALUES (2666, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539670274, 31);
INSERT INTO `ka_admin_log` VALUES (2667, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539671140, 31);
INSERT INTO `ka_admin_log` VALUES (2668, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539671383, 31);
INSERT INTO `ka_admin_log` VALUES (2669, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539671405, 31);
INSERT INTO `ka_admin_log` VALUES (2670, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1539671419, 31);
INSERT INTO `ka_admin_log` VALUES (2671, 1, 'n', '后台登录', '127.0.0.1', 1539740405, 0);
INSERT INTO `ka_admin_log` VALUES (2672, 1, 'n', '后台登录', '125.71.150.74', 1539760509, 0);
INSERT INTO `ka_admin_log` VALUES (2673, 1, 'n', '后台登录', '125.71.150.74', 1539760911, 0);
INSERT INTO `ka_admin_log` VALUES (2674, 1, 'n', '后台登录', '125.71.150.74', 1539761729, 0);
INSERT INTO `ka_admin_log` VALUES (2675, 1, 'n', '后台登录', '125.71.150.74', 1539762341, 0);
INSERT INTO `ka_admin_log` VALUES (2676, 1, 'n', '后台登录', '125.71.150.74', 1539762344, 0);
INSERT INTO `ka_admin_log` VALUES (2677, 1, 'n', '编辑活动【】成功', '125.71.150.74', 1539762912, 31);
INSERT INTO `ka_admin_log` VALUES (2678, 1, 'n', '编辑活动【】成功', '125.71.150.74', 1539762965, 31);
INSERT INTO `ka_admin_log` VALUES (2679, 1, 'n', '后台登录', '125.71.150.74', 1539763110, 0);
INSERT INTO `ka_admin_log` VALUES (2680, 1, 'n', '后台登录', '125.71.150.74', 1539763815, 0);
INSERT INTO `ka_admin_log` VALUES (2681, 1, 'n', '后台登录', '127.0.0.1', 1539764694, 0);
INSERT INTO `ka_admin_log` VALUES (2682, 1, 'n', '后台登录', '125.71.150.74', 1539766491, 0);
INSERT INTO `ka_admin_log` VALUES (2683, 1, 'n', '后台登录', '125.71.150.74', 1539766511, 0);
INSERT INTO `ka_admin_log` VALUES (2684, 1, 'n', '后台登录', '127.0.0.1', 1539766493, 0);
INSERT INTO `ka_admin_log` VALUES (2685, 1, 'n', '删除兑换活动成功【元旦兑换活动】', '125.71.150.74', 1539766899, 31);
INSERT INTO `ka_admin_log` VALUES (2686, 1, 'n', '删除兑换活动成功【国庆兑换活动】', '125.71.150.74', 1539766904, 31);
INSERT INTO `ka_admin_log` VALUES (2687, 1, 'n', '生成兑换码成功，批次编号【201810171710_7_1】', '125.71.150.74', 1539767431, 31);
INSERT INTO `ka_admin_log` VALUES (2688, 1, 'n', '编辑活动【】成功', '125.71.150.74', 1539767531, 31);
INSERT INTO `ka_admin_log` VALUES (2689, 1, 'n', '删除兑换活动成功【自助兑换活动】', '125.71.150.74', 1539768571, 31);
INSERT INTO `ka_admin_log` VALUES (2690, 1, 'n', '添加活动【】成功', '125.71.150.74', 1539768643, 31);
INSERT INTO `ka_admin_log` VALUES (2691, 1, 'n', '添加活动【】成功', '125.71.150.74', 1539768705, 31);
INSERT INTO `ka_admin_log` VALUES (2692, 1, 'n', '添加活动【】成功', '125.71.150.74', 1539769192, 31);
INSERT INTO `ka_admin_log` VALUES (2693, 1, 'n', '添加活动【】成功', '125.71.150.74', 1539769608, 31);
INSERT INTO `ka_admin_log` VALUES (2694, 1, 'n', '添加活动【】成功', '127.0.0.1', 1539769644, 31);
INSERT INTO `ka_admin_log` VALUES (2695, 1, 'n', '添加兑换等级【100-1000元】成功', '125.71.150.74', 1539769685, 31);
INSERT INTO `ka_admin_log` VALUES (2696, 1, 'n', '删除兑换活动成功【双十一测试兑换活动】', '125.71.150.74', 1539769714, 31);
INSERT INTO `ka_admin_log` VALUES (2697, 1, 'n', '添加兑换等级【1000-5000元】成功', '125.71.150.74', 1539769717, 31);
INSERT INTO `ka_admin_log` VALUES (2698, 1, 'n', '删除兑换活动成功【双十一测试兑换活动】', '125.71.150.74', 1539769719, 31);
INSERT INTO `ka_admin_log` VALUES (2699, 1, 'n', '删除兑换活动成功【春节测试兑换活动】', '125.71.150.74', 1539769722, 31);
INSERT INTO `ka_admin_log` VALUES (2700, 1, 'n', '删除兑换活动成功【自助兑换测试活动】', '125.71.150.74', 1539769734, 31);
INSERT INTO `ka_admin_log` VALUES (2701, 1, 'n', '添加活动【】成功', '125.71.150.74', 1539769998, 31);
INSERT INTO `ka_admin_log` VALUES (2702, 1, 'n', '生成兑换码成功，批次编号【201810171752_12_1】', '125.71.150.74', 1539770016, 31);
INSERT INTO `ka_admin_log` VALUES (2703, 1, 'n', '生成兑换码成功，批次编号【201810171756_12_2】', '125.71.150.74', 1539770208, 31);
INSERT INTO `ka_admin_log` VALUES (2704, 1, 'n', '后台登录', '125.71.150.74', 1539770781, 0);
INSERT INTO `ka_admin_log` VALUES (2705, 1, 'n', '添加兑换等级【100-500】成功', '127.0.0.1', 1539770776, 31);
INSERT INTO `ka_admin_log` VALUES (2706, 1, 'n', '生成兑换码成功，批次编号【201810171806_12_3】', '125.71.150.74', 1539770830, 31);
INSERT INTO `ka_admin_log` VALUES (2707, 1, 'n', '生成兑换码成功，批次编号【201810171806_16_1】', '127.0.0.1', 1539770811, 31);
INSERT INTO `ka_admin_log` VALUES (2708, 1, 'n', '生成兑换码成功，批次编号【201810171811_12_4】', '125.71.150.74', 1539771171, 31);
INSERT INTO `ka_admin_log` VALUES (2709, 1, 'n', '生成兑换码成功，批次编号【201810171813_12_5】', '125.71.150.74', 1539771243, 31);
INSERT INTO `ka_admin_log` VALUES (2710, 1, 'n', '生成兑换码成功，批次编号【201810171815_12_6】', '125.71.150.74', 1539771316, 31);
INSERT INTO `ka_admin_log` VALUES (2711, 1, 'n', '生成兑换码成功，批次编号【201810171817_12_1】', '125.71.150.74', 1539771472, 31);
INSERT INTO `ka_admin_log` VALUES (2712, 1, 'n', '生成兑换码成功，批次编号【201810171828_12_1】', '125.71.150.74', 1539772099, 31);
INSERT INTO `ka_admin_log` VALUES (2713, 1, 'n', '订单【orderid：1】发货成功', '127.0.0.1', 1539772893, 31);
INSERT INTO `ka_admin_log` VALUES (2714, 1, 'n', '订单【orderid：1】发货成功', '127.0.0.1', 1539772908, 31);
INSERT INTO `ka_admin_log` VALUES (2715, 1, 'n', '后台登录', '125.71.150.74', 1539827086, 0);
INSERT INTO `ka_admin_log` VALUES (2716, 1, 'n', '后台登录', '127.0.0.1', 1539828972, 0);
INSERT INTO `ka_admin_log` VALUES (2717, 1, 'n', '订单【orderid：2】发货成功', '125.71.150.74', 1539829369, 31);
INSERT INTO `ka_admin_log` VALUES (2718, 1, 'n', '后台登录', '125.71.150.74', 1539835456, 0);
INSERT INTO `ka_admin_log` VALUES (2719, 1, 'n', '后台登录', '125.71.150.74', 1539837585, 0);
INSERT INTO `ka_admin_log` VALUES (2720, 1, 'n', '订单【orderid：3】发货成功', '125.71.150.74', 1539842971, 31);
INSERT INTO `ka_admin_log` VALUES (2721, 1, 'n', '订单【orderid：3】发货成功', '125.71.150.74', 1539844065, 31);
INSERT INTO `ka_admin_log` VALUES (2722, 1, 'n', '订单【orderid：3】发货成功', '125.71.150.74', 1539844302, 31);
INSERT INTO `ka_admin_log` VALUES (2723, 1, 'n', '订单【orderid：3】发货成功', '125.71.150.74', 1539844528, 31);
INSERT INTO `ka_admin_log` VALUES (2724, 1, 'n', '订单【orderid：3】发货成功', '125.71.150.74', 1539844587, 31);
INSERT INTO `ka_admin_log` VALUES (2725, 1, 'n', '订单【orderid：3】发货成功', '125.71.150.74', 1539844652, 31);
INSERT INTO `ka_admin_log` VALUES (2726, 1, 'n', '订单【orderid：3】发货成功', '125.71.150.74', 1539844741, 31);
INSERT INTO `ka_admin_log` VALUES (2727, 1, 'n', '订单【orderid：3】发货成功', '125.71.150.74', 1539844779, 31);
INSERT INTO `ka_admin_log` VALUES (2728, 1, 'n', '订单【orderid：3】发货成功', '127.0.0.1', 1539844779, 31);
INSERT INTO `ka_admin_log` VALUES (2729, 1, 'n', '订单【orderid：3】发货成功', '127.0.0.1', 1539844841, 31);
INSERT INTO `ka_admin_log` VALUES (2730, 1, 'n', '订单【orderid：3】发货成功', '127.0.0.1', 1539844893, 31);
INSERT INTO `ka_admin_log` VALUES (2731, 1, 'n', '订单【orderid：3】发货成功', '127.0.0.1', 1539844964, 31);
INSERT INTO `ka_admin_log` VALUES (2732, 1, 'n', '订单【orderid：3】发货成功', '127.0.0.1', 1539845276, 31);
INSERT INTO `ka_admin_log` VALUES (2733, 1, 'n', '订单【orderid：4】发货成功', '125.71.150.74', 1539845435, 31);
INSERT INTO `ka_admin_log` VALUES (2734, 1, 'n', '后台登录', '125.71.150.74', 1539847464, 0);
INSERT INTO `ka_admin_log` VALUES (2735, 1, 'n', '后台登录', '125.71.150.74', 1539847566, 0);
INSERT INTO `ka_admin_log` VALUES (2736, 1, 'n', '后台登录', '125.71.150.74', 1539847703, 0);
INSERT INTO `ka_admin_log` VALUES (2737, 1, 'n', '后台登录', '125.71.150.74', 1539847744, 0);
INSERT INTO `ka_admin_log` VALUES (2738, 1, 'n', '后台登录', '125.71.150.74', 1539847840, 0);
INSERT INTO `ka_admin_log` VALUES (2739, 1, 'n', '后台登录', '127.0.0.1', 1539847848, 0);
INSERT INTO `ka_admin_log` VALUES (2740, 1, 'n', '后台登录', '127.0.0.1', 1539847864, 0);
INSERT INTO `ka_admin_log` VALUES (2741, 1, 'n', '后台登录', '127.0.0.1', 1539847953, 0);
INSERT INTO `ka_admin_log` VALUES (2742, 1, 'n', '后台登录', '125.71.150.74', 1539848094, 0);
INSERT INTO `ka_admin_log` VALUES (2743, 1, 'n', '编辑活动【】成功', '125.71.150.74', 1539855471, 31);
INSERT INTO `ka_admin_log` VALUES (2744, 1, 'n', '后台登录', '171.214.139.33', 1539861212, 0);
INSERT INTO `ka_admin_log` VALUES (2745, 1, 'n', '后台登录', '125.70.203.223', 1539861222, 0);
INSERT INTO `ka_admin_log` VALUES (2746, 1, 'n', '添加兑换等级【500-1000】成功', '171.214.139.33', 1539861429, 31);
INSERT INTO `ka_admin_log` VALUES (2747, 1, 'n', '后台登录', '127.0.0.1', 1539913481, 0);
INSERT INTO `ka_admin_log` VALUES (2748, 1, 'n', '后台登录', '125.71.150.74', 1539923808, 0);
INSERT INTO `ka_admin_log` VALUES (2749, 1, 'n', '添加兑换等级【100-500】成功', '127.0.0.1', 1539926729, 31);
INSERT INTO `ka_admin_log` VALUES (2750, 1, 'n', '添加兑换等级【500-1000】成功', '127.0.0.1', 1539926737, 31);
INSERT INTO `ka_admin_log` VALUES (2751, 1, 'n', '后台登录', '110.184.40.72', 1539934625, 0);
INSERT INTO `ka_admin_log` VALUES (2752, 1, 'n', '添加银行【浦发银行】', '110.184.40.72', 1539934782, 0);
INSERT INTO `ka_admin_log` VALUES (2753, 1, 'n', '添加活动【】成功', '110.184.40.72', 1539937273, 33);
INSERT INTO `ka_admin_log` VALUES (2754, 1, 'n', '添加兑换等级【白金生日礼】成功', '110.184.40.72', 1539937329, 33);
INSERT INTO `ka_admin_log` VALUES (2755, 1, 'n', '添加兑换等级【钻石生日礼】成功', '110.184.40.72', 1539937339, 33);
INSERT INTO `ka_admin_log` VALUES (2756, 1, 'n', '添加兑换等级【白金招募礼】成功', '110.184.40.72', 1539937350, 33);
INSERT INTO `ka_admin_log` VALUES (2757, 1, 'n', '添加兑换等级【钻石招募礼】成功', '110.184.40.72', 1539937360, 33);
INSERT INTO `ka_admin_log` VALUES (2758, 1, 'n', '编辑活动【】成功', '110.184.40.72', 1539937423, 33);
INSERT INTO `ka_admin_log` VALUES (2759, 1, 'n', '后台登录', '182.149.188.74', 1540004727, 0);
INSERT INTO `ka_admin_log` VALUES (2760, 1, 'n', '后台登录', '182.149.188.74', 1540005610, 0);
INSERT INTO `ka_admin_log` VALUES (2761, 1, 'n', '生成兑换码成功，批次编号【201810201208_17_1】', '182.149.188.74', 1540008542, 33);
INSERT INTO `ka_admin_log` VALUES (2762, 1, 'n', '生成兑换码成功，批次编号【201810201209_17_2】', '182.149.188.74', 1540008554, 33);
INSERT INTO `ka_admin_log` VALUES (2763, 1, 'n', '生成兑换码成功，批次编号【201810201209_17_3】', '182.149.188.74', 1540008566, 33);
INSERT INTO `ka_admin_log` VALUES (2764, 1, 'n', '生成兑换码成功，批次编号【201810201209_17_4】', '182.149.188.74', 1540008588, 33);
INSERT INTO `ka_admin_log` VALUES (2765, 1, 'n', '后台登录', '182.149.188.74', 1540009287, 0);
INSERT INTO `ka_admin_log` VALUES (2766, 1, 'n', '编辑活动【】成功', '182.149.188.74', 1540011359, 33);
INSERT INTO `ka_admin_log` VALUES (2767, 1, 'n', '编辑活动【】成功', '182.149.188.74', 1540011492, 33);
INSERT INTO `ka_admin_log` VALUES (2768, 1, 'n', '编辑活动【】成功', '182.149.188.74', 1540011519, 33);
INSERT INTO `ka_admin_log` VALUES (2769, 1, 'n', '编辑活动【】成功', '182.149.188.74', 1540011613, 33);
INSERT INTO `ka_admin_log` VALUES (2770, 1, 'n', '订单【orderid：10】发货成功', '182.149.188.74', 1540012459, 33);
INSERT INTO `ka_admin_log` VALUES (2771, 1, 'n', '后台登录', '127.0.0.1', 1540172302, 0);
INSERT INTO `ka_admin_log` VALUES (2772, 1, 'n', '后台登录', '182.149.67.78', 1540180263, 0);
INSERT INTO `ka_admin_log` VALUES (2773, 1, 'n', '编辑活动【】成功', '182.149.67.78', 1540180296, 31);
INSERT INTO `ka_admin_log` VALUES (2774, 1, 'n', '编辑活动【】成功', '182.149.67.78', 1540180329, 31);
INSERT INTO `ka_admin_log` VALUES (2775, 1, 'n', '编辑活动【】成功', '182.149.67.78', 1540180412, 31);
INSERT INTO `ka_admin_log` VALUES (2776, 1, 'n', '后台登录', '182.149.67.78', 1540187470, 0);
INSERT INTO `ka_admin_log` VALUES (2777, 1, 'n', '后台登录', '127.0.0.1', 1540259284, 0);
INSERT INTO `ka_admin_log` VALUES (2778, 1, 'n', '后台登录', '182.149.67.78', 1540261913, 0);
INSERT INTO `ka_admin_log` VALUES (2779, 1, 'n', '编辑销售经理【18782985561】成功', '127.0.0.1', 1540273800, 31);
INSERT INTO `ka_admin_log` VALUES (2780, 1, 'n', '后台登录', '182.149.67.78', 1540275575, 0);
INSERT INTO `ka_admin_log` VALUES (2781, 1, 'n', '后台登录', '182.149.67.78', 1540275751, 0);
INSERT INTO `ka_admin_log` VALUES (2782, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540276018, 31);
INSERT INTO `ka_admin_log` VALUES (2783, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540276064, 31);
INSERT INTO `ka_admin_log` VALUES (2784, 1, 'n', '后台登录', '110.184.46.241', 1540276961, 0);
INSERT INTO `ka_admin_log` VALUES (2785, 1, 'n', '编辑活动【】成功', '110.184.46.241', 1540277046, 33);
INSERT INTO `ka_admin_log` VALUES (2786, 1, 'n', '编辑活动【】成功', '110.184.46.241', 1540277958, 33);
INSERT INTO `ka_admin_log` VALUES (2787, 1, 'n', '编辑活动【】成功', '110.184.46.241', 1540278047, 33);
INSERT INTO `ka_admin_log` VALUES (2788, 1, 'n', '编辑销售经理【18782985561】成功', '127.0.0.1', 1540278703, 31);
INSERT INTO `ka_admin_log` VALUES (2789, 1, 'n', '编辑销售经理【18782985561】成功', '127.0.0.1', 1540279306, 31);
INSERT INTO `ka_admin_log` VALUES (2790, 1, 'n', '编辑销售经理【18782985561】成功', '127.0.0.1', 1540279920, 31);
INSERT INTO `ka_admin_log` VALUES (2791, 1, 'n', '后台登录', '110.184.46.241', 1540280284, 0);
INSERT INTO `ka_admin_log` VALUES (2792, 1, 'n', '添加销售经理【18140191539】成功', '127.0.0.1', 1540286957, 31);
INSERT INTO `ka_admin_log` VALUES (2793, 1, 'n', '编辑销售经理【18140191539】成功', '127.0.0.1', 1540286968, 31);
INSERT INTO `ka_admin_log` VALUES (2794, 1, 'n', '编辑销售经理【18140191539】成功', '127.0.0.1', 1540287162, 31);
INSERT INTO `ka_admin_log` VALUES (2795, 1, 'n', '后台登录', '110.184.46.241', 1540289345, 0);
INSERT INTO `ka_admin_log` VALUES (2796, 1, 'n', '后台登录', '127.0.0.1', 1540345566, 0);
INSERT INTO `ka_admin_log` VALUES (2797, 1, 'n', '后台登录', '182.149.189.198', 1540352292, 0);
INSERT INTO `ka_admin_log` VALUES (2798, 1, 'n', '后台登录', '182.149.67.78', 1540353073, 0);
INSERT INTO `ka_admin_log` VALUES (2799, 1, 'n', '订单【orderid：25】发货成功', '127.0.0.1', 1540359062, 31);
INSERT INTO `ka_admin_log` VALUES (2800, 1, 'n', '后台登录', '182.149.189.198', 1540360902, 0);
INSERT INTO `ka_admin_log` VALUES (2801, 1, 'n', '后台登录', '182.149.189.198', 1540361366, 0);
INSERT INTO `ka_admin_log` VALUES (2802, 1, 'n', '后台登录', '182.149.189.198', 1540362555, 0);
INSERT INTO `ka_admin_log` VALUES (2803, 1, 'n', '后台登录', '182.149.67.78', 1540362623, 0);
INSERT INTO `ka_admin_log` VALUES (2804, 1, 'n', '后台登录', '182.149.189.198', 1540364183, 0);
INSERT INTO `ka_admin_log` VALUES (2805, 1, 'n', '后台登录', '182.149.67.78', 1540365229, 0);
INSERT INTO `ka_admin_log` VALUES (2806, 1, 'n', '添加支行【高新区支行】成功', '127.0.0.1', 1540367066, 32);
INSERT INTO `ka_admin_log` VALUES (2807, 1, 'n', '添加销售经理【18140191539】成功', '127.0.0.1', 1540367083, 32);
INSERT INTO `ka_admin_log` VALUES (2808, 1, 'n', '添加销售经理【18981940330】成功', '182.149.67.78', 1540367556, 31);
INSERT INTO `ka_admin_log` VALUES (2809, 1, 'n', '后台登录', '182.149.67.78', 1540368792, 0);
INSERT INTO `ka_admin_log` VALUES (2810, 1, 'n', '后台登录', '182.149.67.78', 1540373175, 0);
INSERT INTO `ka_admin_log` VALUES (2811, 1, 'n', '编辑活动【】成功', '182.149.67.78', 1540373460, 31);
INSERT INTO `ka_admin_log` VALUES (2812, 1, 'n', '删除兑换活动成功【abcde】', '182.149.67.78', 1540373752, 31);
INSERT INTO `ka_admin_log` VALUES (2813, 1, 'n', '删除支行成功【18782985561】', '182.149.67.78', 1540373891, 31);
INSERT INTO `ka_admin_log` VALUES (2814, 1, 'n', '删除支行成功【18782985560】', '182.149.67.78', 1540373894, 31);
INSERT INTO `ka_admin_log` VALUES (2815, 1, 'n', '添加销售经理【18981940330】成功', '182.149.67.78', 1540374104, 32);
INSERT INTO `ka_admin_log` VALUES (2816, 1, 'n', '后台登录', '182.149.189.198', 1540374330, 0);
INSERT INTO `ka_admin_log` VALUES (2817, 1, 'n', '添加活动【】成功', '182.149.67.78', 1540374437, 32);
INSERT INTO `ka_admin_log` VALUES (2818, 1, 'n', '添加银行【招商银行】', '127.0.0.1', 1540374821, 0);
INSERT INTO `ka_admin_log` VALUES (2819, 1, 'n', '添加银行【中国银行】', '182.149.67.78', 1540375007, 0);
INSERT INTO `ka_admin_log` VALUES (2820, 1, 'n', '添加银行【测试银行】', '182.149.67.78', 1540375080, 0);
INSERT INTO `ka_admin_log` VALUES (2821, 1, 'n', '后台登录', '182.149.189.198', 1540375229, 0);
INSERT INTO `ka_admin_log` VALUES (2822, 1, 'n', '添加银行【兴业银行】', '182.149.189.198', 1540375359, 35);
INSERT INTO `ka_admin_log` VALUES (2823, 1, 'n', '添加活动【】成功', '182.149.189.198', 1540375584, 37);
INSERT INTO `ka_admin_log` VALUES (2824, 1, 'n', '添加活动【】成功', '182.149.189.198', 1540375706, 37);
INSERT INTO `ka_admin_log` VALUES (2825, 1, 'n', '添加活动【】成功', '182.149.67.78', 1540375897, 37);
INSERT INTO `ka_admin_log` VALUES (2826, 1, 'n', '删除兑换活动成功【客户经理发放活动】', '182.149.67.78', 1540375911, 37);
INSERT INTO `ka_admin_log` VALUES (2827, 1, 'n', '添加活动【】成功', '182.149.67.78', 1540376022, 36);
INSERT INTO `ka_admin_log` VALUES (2828, 1, 'n', '添加活动【】成功', '127.0.0.1', 1540376393, 37);
INSERT INTO `ka_admin_log` VALUES (2829, 1, 'n', '添加活动【】成功', '127.0.0.1', 1540376559, 37);
INSERT INTO `ka_admin_log` VALUES (2830, 1, 'n', '添加活动【】成功', '127.0.0.1', 1540376561, 37);
INSERT INTO `ka_admin_log` VALUES (2831, 1, 'n', '添加活动【】成功', '182.149.67.78', 1540376740, 37);
INSERT INTO `ka_admin_log` VALUES (2832, 1, 'n', '删除兑换活动成功【测试用户活动】', '182.149.67.78', 1540376760, 37);
INSERT INTO `ka_admin_log` VALUES (2833, 1, 'n', '删除兑换活动成功【测试用户活动】', '182.149.67.78', 1540376768, 37);
INSERT INTO `ka_admin_log` VALUES (2834, 1, 'n', '删除兑换活动成功【测试销售活动】', '182.149.67.78', 1540376829, 37);
INSERT INTO `ka_admin_log` VALUES (2835, 1, 'n', '删除兑换活动成功【测试销售活动test】', '182.149.67.78', 1540376835, 37);
INSERT INTO `ka_admin_log` VALUES (2836, 1, 'n', '后台登录', '182.149.189.198', 1540376848, 0);
INSERT INTO `ka_admin_log` VALUES (2837, 1, 'n', '添加活动【】成功', '182.149.67.78', 1540376869, 37);
INSERT INTO `ka_admin_log` VALUES (2838, 1, 'n', '添加支行【草堂支行】成功', '182.149.189.198', 1540376929, 37);
INSERT INTO `ka_admin_log` VALUES (2839, 1, 'n', '添加支行【康河丽景社区支行】成功', '182.149.189.198', 1540376949, 37);
INSERT INTO `ka_admin_log` VALUES (2840, 1, 'n', '添加支行【蓝谷地社区支行】成功', '182.149.189.198', 1540376961, 37);
INSERT INTO `ka_admin_log` VALUES (2841, 1, 'n', '添加支行【红枫林社区支行】成功', '182.149.189.198', 1540376973, 37);
INSERT INTO `ka_admin_log` VALUES (2842, 1, 'n', '添加支行【锦城世家社区支行】成功', '182.149.189.198', 1540376985, 37);
INSERT INTO `ka_admin_log` VALUES (2843, 1, 'n', '添加支行【成华支行】成功', '182.149.189.198', 1540376997, 37);
INSERT INTO `ka_admin_log` VALUES (2844, 1, 'n', '添加销售经理【13683458286】成功', '182.149.189.198', 1540377038, 37);
INSERT INTO `ka_admin_log` VALUES (2845, 1, 'n', '删除兑换活动成功【95561降级挽回活动】', '182.149.189.198', 1540377061, 37);
INSERT INTO `ka_admin_log` VALUES (2846, 1, 'n', '删除兑换活动成功【95561降级挽回活动】', '182.149.189.198', 1540377067, 37);
INSERT INTO `ka_admin_log` VALUES (2847, 1, 'n', '删除兑换活动成功【发放活动测试】', '182.149.189.198', 1540377075, 37);
INSERT INTO `ka_admin_log` VALUES (2848, 1, 'n', '添加活动【】成功', '182.149.189.198', 1540377249, 37);
INSERT INTO `ka_admin_log` VALUES (2849, 1, 'n', '添加兑换等级【30元档】成功', '182.149.189.198', 1540377285, 37);
INSERT INTO `ka_admin_log` VALUES (2850, 1, 'n', '添加兑换等级【50元档】成功', '182.149.189.198', 1540377296, 37);
INSERT INTO `ka_admin_log` VALUES (2851, 1, 'n', '添加兑换等级【100元档】成功', '182.149.189.198', 1540377306, 37);
INSERT INTO `ka_admin_log` VALUES (2852, 1, 'n', '后台登录', '127.0.0.1', 1540377666, 0);
INSERT INTO `ka_admin_log` VALUES (2853, 1, 'n', '添加活动【】成功', '182.149.189.198', 1540377768, 37);
INSERT INTO `ka_admin_log` VALUES (2854, 1, 'n', '添加销售经理【18981940330】成功', '182.149.67.78', 1540377773, 37);
INSERT INTO `ka_admin_log` VALUES (2855, 1, 'n', '删除兑换活动成功【95561降级挽回活动】', '182.149.189.198', 1540377779, 37);
INSERT INTO `ka_admin_log` VALUES (2856, 1, 'n', '后台登录', '127.0.0.1', 1540377748, 0);
INSERT INTO `ka_admin_log` VALUES (2857, 1, 'n', '添加兑换等级【30元档】成功', '182.149.189.198', 1540377795, 37);
INSERT INTO `ka_admin_log` VALUES (2858, 1, 'n', '添加兑换等级【50元档】成功', '182.149.189.198', 1540377804, 37);
INSERT INTO `ka_admin_log` VALUES (2859, 1, 'n', '添加兑换等级【100档】成功', '182.149.189.198', 1540377815, 37);
INSERT INTO `ka_admin_log` VALUES (2860, 1, 'n', '后台登录', '127.0.0.1', 1540377800, 0);
INSERT INTO `ka_admin_log` VALUES (2861, 1, 'n', '后台登录', '127.0.0.1', 1540377856, 0);
INSERT INTO `ka_admin_log` VALUES (2862, 1, 'n', '后台登录', '127.0.0.1', 1540377954, 0);
INSERT INTO `ka_admin_log` VALUES (2863, 1, 'n', '添加支行【测试】成功', '182.149.189.198', 1540378082, 37);
INSERT INTO `ka_admin_log` VALUES (2864, 1, 'n', '添加销售经理【13032880424】成功', '182.149.189.198', 1540378147, 37);
INSERT INTO `ka_admin_log` VALUES (2865, 1, 'n', '添加销售经理【15982106350】成功', '182.149.189.198', 1540378163, 37);
INSERT INTO `ka_admin_log` VALUES (2866, 1, 'n', '后台登录', '127.0.0.1', 1540378163, 0);
INSERT INTO `ka_admin_log` VALUES (2867, 1, 'n', '编辑销售经理【18981940330】成功', '182.149.67.78', 1540378269, 37);
INSERT INTO `ka_admin_log` VALUES (2868, 1, 'n', '后台登录', '127.0.0.1', 1540378251, 0);
INSERT INTO `ka_admin_log` VALUES (2869, 1, 'n', '后台登录', '127.0.0.1', 1540378449, 0);
INSERT INTO `ka_admin_log` VALUES (2870, 1, 'n', '添加销售经理【18140191539】成功', '182.149.67.78', 1540379337, 37);
INSERT INTO `ka_admin_log` VALUES (2871, 1, 'n', '添加支行【中德英伦联邦社区支行】成功', '182.149.189.198', 1540379415, 37);
INSERT INTO `ka_admin_log` VALUES (2872, 1, 'n', '添加支行【慕和南道社区支行】成功', '182.149.189.198', 1540379428, 37);
INSERT INTO `ka_admin_log` VALUES (2873, 1, 'n', '添加支行【复地社区支行】成功', '182.149.189.198', 1540379443, 37);
INSERT INTO `ka_admin_log` VALUES (2874, 1, 'n', '添加支行【锦天府社区支行】成功', '182.149.189.198', 1540379454, 37);
INSERT INTO `ka_admin_log` VALUES (2875, 1, 'n', '添加支行【康郡社区支行】成功', '182.149.189.198', 1540379467, 37);
INSERT INTO `ka_admin_log` VALUES (2876, 1, 'n', '添加支行【翡翠城社区支行】成功', '182.149.189.198', 1540379479, 37);
INSERT INTO `ka_admin_log` VALUES (2877, 1, 'n', '添加支行【橡树林社区支行】成功', '182.149.189.198', 1540379489, 37);
INSERT INTO `ka_admin_log` VALUES (2878, 1, 'n', '添加支行【德盛苑社区支行】成功', '182.149.189.198', 1540379501, 37);
INSERT INTO `ka_admin_log` VALUES (2879, 1, 'n', '添加支行【德阳分行】成功', '182.149.189.198', 1540379559, 37);
INSERT INTO `ka_admin_log` VALUES (2880, 1, 'n', '添加支行【什邡支行】成功', '182.149.189.198', 1540379572, 37);
INSERT INTO `ka_admin_log` VALUES (2881, 1, 'n', '添加支行【德阳和泰锦苑社区支行】成功', '182.149.189.198', 1540379583, 37);
INSERT INTO `ka_admin_log` VALUES (2882, 1, 'n', '添加支行【德阳水印康桥社区支行】成功', '182.149.189.198', 1540379601, 37);
INSERT INTO `ka_admin_log` VALUES (2883, 1, 'n', '添加支行【德阳太平洋国际社区支行】成功', '182.149.189.198', 1540379614, 37);
INSERT INTO `ka_admin_log` VALUES (2884, 1, 'n', '添加支行【德阳万兴魅力城社区支行】成功', '182.149.189.198', 1540379624, 37);
INSERT INTO `ka_admin_log` VALUES (2885, 1, 'n', '添加支行【广汉支行】成功', '182.149.189.198', 1540379636, 37);
INSERT INTO `ka_admin_log` VALUES (2886, 1, 'n', '添加支行【什邡时代明珠社区支行】成功', '182.149.189.198', 1540379650, 37);
INSERT INTO `ka_admin_log` VALUES (2887, 1, 'n', '添加支行【旌阳支行】成功', '182.149.189.198', 1540379660, 37);
INSERT INTO `ka_admin_log` VALUES (2888, 1, 'n', '添加支行【都江堰支行】成功', '182.149.189.198', 1540379670, 37);
INSERT INTO `ka_admin_log` VALUES (2889, 1, 'n', '添加支行【灌口社区支行】成功', '182.149.189.198', 1540379680, 37);
INSERT INTO `ka_admin_log` VALUES (2890, 1, 'n', '添加支行【分行营业部】成功', '182.149.189.198', 1540379706, 37);
INSERT INTO `ka_admin_log` VALUES (2891, 1, 'n', '添加销售经理【13982124142】成功', '182.149.189.198', 1540379726, 37);
INSERT INTO `ka_admin_log` VALUES (2892, 1, 'n', '添加支行【麓山国际社区支行】成功', '182.149.189.198', 1540379828, 37);
INSERT INTO `ka_admin_log` VALUES (2893, 1, 'n', '添加支行【亲水湾社区支行】成功', '182.149.189.198', 1540379838, 37);
INSERT INTO `ka_admin_log` VALUES (2894, 1, 'n', '添加支行【高新区支行】成功', '182.149.189.198', 1540379849, 37);
INSERT INTO `ka_admin_log` VALUES (2895, 1, 'n', '添加支行【中海锦城社区支行】成功', '182.149.189.198', 1540379860, 37);
INSERT INTO `ka_admin_log` VALUES (2896, 1, 'n', '添加支行【天府长城社区支行】成功', '182.149.189.198', 1540379871, 37);
INSERT INTO `ka_admin_log` VALUES (2897, 1, 'n', '添加支行【广汉金雁明珠社区支行】成功', '182.149.189.198', 1540379884, 37);
INSERT INTO `ka_admin_log` VALUES (2898, 1, 'n', '添加支行【红牌楼支行】成功', '182.149.189.198', 1540379898, 37);
INSERT INTO `ka_admin_log` VALUES (2899, 1, 'n', '添加支行【碧云路社区支行】成功', '182.149.189.198', 1540379908, 37);
INSERT INTO `ka_admin_log` VALUES (2900, 1, 'n', '添加支行【鹭岛国际社区支行】成功', '182.149.189.198', 1540379917, 37);
INSERT INTO `ka_admin_log` VALUES (2901, 1, 'n', '添加支行【环球中心支行】成功', '182.149.189.198', 1540379928, 37);
INSERT INTO `ka_admin_log` VALUES (2902, 1, 'n', '添加支行【华宇锦城名都社区支行】成功', '182.149.189.198', 1540379939, 37);
INSERT INTO `ka_admin_log` VALUES (2903, 1, 'n', '添加支行【狮子山街办社区支行】成功', '182.149.189.198', 1540379954, 37);
INSERT INTO `ka_admin_log` VALUES (2904, 1, 'n', '添加支行【金牛支行】成功', '182.149.189.198', 1540379964, 37);
INSERT INTO `ka_admin_log` VALUES (2905, 1, 'n', '添加支行【金沙支行】成功', '182.149.189.198', 1540379972, 37);
INSERT INTO `ka_admin_log` VALUES (2906, 1, 'n', '添加支行【同盛路社区支行】成功', '182.149.189.198', 1540379983, 37);
INSERT INTO `ka_admin_log` VALUES (2907, 1, 'n', '添加支行【金沙云庭社区支行】成功', '182.149.189.198', 1540379993, 37);
INSERT INTO `ka_admin_log` VALUES (2908, 1, 'n', '添加支行【金堂支行】成功', '182.149.189.198', 1540380003, 37);
INSERT INTO `ka_admin_log` VALUES (2909, 1, 'n', '添加支行【锦江支行】成功', '182.149.189.198', 1540380024, 37);
INSERT INTO `ka_admin_log` VALUES (2910, 1, 'n', '添加支行【新都马超路社区支行】成功', '182.149.189.198', 1540380041, 37);
INSERT INTO `ka_admin_log` VALUES (2911, 1, 'n', '添加支行【锦都社区支行】成功', '182.149.189.198', 1540380064, 37);
INSERT INTO `ka_admin_log` VALUES (2912, 1, 'n', '添加支行【新都保利198社区支行】成功', '182.149.189.198', 1540380079, 37);
INSERT INTO `ka_admin_log` VALUES (2913, 1, 'n', '添加支行【新都双河鹭岛社区支行】成功', '182.149.189.198', 1540380091, 37);
INSERT INTO `ka_admin_log` VALUES (2914, 1, 'n', '添加支行【外滩社区支行】成功', '182.149.189.198', 1540380102, 37);
INSERT INTO `ka_admin_log` VALUES (2915, 1, 'n', '添加支行【乐山支行】成功', '182.149.189.198', 1540380119, 37);
INSERT INTO `ka_admin_log` VALUES (2916, 1, 'n', '添加支行【峨眉山水晶广场】成功', '182.149.189.198', 1540380131, 37);
INSERT INTO `ka_admin_log` VALUES (2917, 1, 'n', '添加支行【犍为鹭岛国际】成功', '182.149.189.198', 1540380143, 37);
INSERT INTO `ka_admin_log` VALUES (2918, 1, 'n', '添加支行【翡翠国际社区支行】成功', '182.149.189.198', 1540380160, 37);
INSERT INTO `ka_admin_log` VALUES (2919, 1, 'n', '编辑支行【犍为鹭岛国际社区支行】成功', '182.149.189.198', 1540380170, 37);
INSERT INTO `ka_admin_log` VALUES (2920, 1, 'n', '添加支行【嘉州新城社区支行】成功', '182.149.189.198', 1540380197, 37);
INSERT INTO `ka_admin_log` VALUES (2921, 1, 'n', '添加支行【莱佛士社区支行】成功', '182.149.189.198', 1540380207, 37);
INSERT INTO `ka_admin_log` VALUES (2922, 1, 'n', '添加支行【亚马逊社区支行】成功', '182.149.189.198', 1540380218, 37);
INSERT INTO `ka_admin_log` VALUES (2923, 1, 'n', '添加支行【西城国际社区支行】成功', '182.149.189.198', 1540380230, 37);
INSERT INTO `ka_admin_log` VALUES (2924, 1, 'n', '添加支行【青果山花城社区支行】成功', '182.149.189.198', 1540380241, 37);
INSERT INTO `ka_admin_log` VALUES (2925, 1, 'n', '添加支行【新广场社区支行】成功', '182.149.189.198', 1540380250, 37);
INSERT INTO `ka_admin_log` VALUES (2926, 1, 'n', '添加支行【龙府花园社区支行】成功', '182.149.189.198', 1540380264, 37);
INSERT INTO `ka_admin_log` VALUES (2927, 1, 'n', '添加支行【金税苑社区支行】成功', '182.149.189.198', 1540380274, 37);
INSERT INTO `ka_admin_log` VALUES (2928, 1, 'n', '添加支行【东山国际社区支行】成功', '182.149.189.198', 1540380283, 37);
INSERT INTO `ka_admin_log` VALUES (2929, 1, 'n', '添加支行【龙泉驿支行】成功', '182.149.189.198', 1540380293, 37);
INSERT INTO `ka_admin_log` VALUES (2930, 1, 'n', '添加支行【霏红榭社区支行】成功', '182.149.189.198', 1540380303, 37);
INSERT INTO `ka_admin_log` VALUES (2931, 1, 'n', '添加支行【十陵社区支行】成功', '182.149.189.198', 1540380314, 37);
INSERT INTO `ka_admin_log` VALUES (2932, 1, 'n', '添加支行【泸州龙马大道社区支行】成功', '182.149.189.198', 1540380324, 37);
INSERT INTO `ka_admin_log` VALUES (2933, 1, 'n', '添加支行【南光路社区支行】成功', '182.149.189.198', 1540380333, 37);
INSERT INTO `ka_admin_log` VALUES (2934, 1, 'n', '添加支行【白招牌社区支行】成功', '182.149.189.198', 1540380345, 37);
INSERT INTO `ka_admin_log` VALUES (2935, 1, 'n', '添加支行【泸州江阳支行】成功', '182.149.189.198', 1540380356, 37);
INSERT INTO `ka_admin_log` VALUES (2936, 1, 'n', '订单【orderid：1】发货成功', '182.149.67.78', 1540380364, 37);
INSERT INTO `ka_admin_log` VALUES (2937, 1, 'n', '添加支行【龙透关社区支行】成功', '182.149.189.198', 1540380371, 37);
INSERT INTO `ka_admin_log` VALUES (2938, 1, 'n', '添加支行【泸州分行】成功', '182.149.189.198', 1540380385, 37);
INSERT INTO `ka_admin_log` VALUES (2939, 1, 'n', '添加支行【绵阳支行】成功', '182.149.189.198', 1540380396, 37);
INSERT INTO `ka_admin_log` VALUES (2940, 1, 'n', '添加支行【绵阳解放路社区支行】成功', '182.149.189.198', 1540380405, 37);
INSERT INTO `ka_admin_log` VALUES (2941, 1, 'n', '添加支行【绵阳万达广场社区支行】成功', '182.149.189.198', 1540380415, 37);
INSERT INTO `ka_admin_log` VALUES (2942, 1, 'n', '添加支行【绵阳奥林春天社区支行】成功', '182.149.189.198', 1540380425, 37);
INSERT INTO `ka_admin_log` VALUES (2943, 1, 'n', '添加支行【绵阳长虹世纪城社区支行】成功', '182.149.189.198', 1540380436, 37);
INSERT INTO `ka_admin_log` VALUES (2944, 1, 'n', '添加支行【绵阳江油小微支行】成功', '182.149.189.198', 1540380446, 37);
INSERT INTO `ka_admin_log` VALUES (2945, 1, 'n', '添加支行【磨子桥支行】成功', '182.149.189.198', 1540380455, 37);
INSERT INTO `ka_admin_log` VALUES (2946, 1, 'n', '添加支行【群众路社区支行】成功', '182.149.189.198', 1540380474, 37);
INSERT INTO `ka_admin_log` VALUES (2947, 1, 'n', '添加支行【蓝光香江国际社区支行】成功', '182.149.189.198', 1540380485, 37);
INSERT INTO `ka_admin_log` VALUES (2948, 1, 'n', '添加支行【南充分行】成功', '182.149.189.198', 1540380496, 37);
INSERT INTO `ka_admin_log` VALUES (2949, 1, 'n', '添加支行【鹤鸣路社区支行】成功', '182.149.189.198', 1540380530, 37);
INSERT INTO `ka_admin_log` VALUES (2950, 1, 'n', '添加支行【江天一色社区支行】成功', '182.149.189.198', 1540380544, 37);
INSERT INTO `ka_admin_log` VALUES (2951, 1, 'n', '添加支行【春风玫瑰园社区支行】成功', '182.149.189.198', 1540380556, 37);
INSERT INTO `ka_admin_log` VALUES (2952, 1, 'n', '添加支行【郫都支行】成功', '182.149.189.198', 1540380569, 37);
INSERT INTO `ka_admin_log` VALUES (2953, 1, 'n', '添加支行【郫县中信未来城社区支行】成功', '182.149.189.198', 1540380585, 37);
INSERT INTO `ka_admin_log` VALUES (2954, 1, 'n', '添加支行【郫都犀浦镇社区支行】成功', '182.149.189.198', 1540380597, 37);
INSERT INTO `ka_admin_log` VALUES (2955, 1, 'n', '添加支行【金沙十年社区支行】成功', '182.149.189.198', 1540380608, 37);
INSERT INTO `ka_admin_log` VALUES (2956, 1, 'n', '添加支行【青羊支行】成功', '182.149.189.198', 1540380618, 37);
INSERT INTO `ka_admin_log` VALUES (2957, 1, 'n', '添加支行【盛畅园社区支行】成功', '182.149.189.198', 1540380628, 37);
INSERT INTO `ka_admin_log` VALUES (2958, 1, 'n', '添加支行【瑞南街社区支行】成功', '182.149.189.198', 1540380638, 37);
INSERT INTO `ka_admin_log` VALUES (2959, 1, 'n', '添加支行【人北支行】成功', '182.149.189.198', 1540380647, 37);
INSERT INTO `ka_admin_log` VALUES (2960, 1, 'n', '添加支行【金域蓝湾社区支行】成功', '182.149.189.198', 1540380659, 37);
INSERT INTO `ka_admin_log` VALUES (2961, 1, 'n', '添加支行【人民南路支行】成功', '182.149.189.198', 1540380670, 37);
INSERT INTO `ka_admin_log` VALUES (2962, 1, 'n', '添加支行【中华名园社区支行】成功', '182.149.189.198', 1540380681, 37);
INSERT INTO `ka_admin_log` VALUES (2963, 1, 'n', '添加支行【西府少城社区支行】成功', '182.149.189.198', 1540380691, 37);
INSERT INTO `ka_admin_log` VALUES (2964, 1, 'n', '添加支行【中海名城社区支行】成功', '182.149.189.198', 1540380707, 37);
INSERT INTO `ka_admin_log` VALUES (2965, 1, 'n', '添加支行【置信丽都花园城社区支行】成功', '182.149.189.198', 1540380720, 37);
INSERT INTO `ka_admin_log` VALUES (2966, 1, 'n', '添加支行【中海国际社区支行】成功', '182.149.189.198', 1540380839, 37);
INSERT INTO `ka_admin_log` VALUES (2967, 1, 'n', '添加支行【锦官秀城社区支行】成功', '182.149.189.198', 1540380852, 37);
INSERT INTO `ka_admin_log` VALUES (2968, 1, 'n', '添加支行【小天北街社区支行】成功', '182.149.189.198', 1540380862, 37);
INSERT INTO `ka_admin_log` VALUES (2969, 1, 'n', '添加支行【沙湾支行】成功', '182.149.189.198', 1540380871, 37);
INSERT INTO `ka_admin_log` VALUES (2970, 1, 'n', '添加支行【浅水半岛社区支行】成功', '182.149.189.198', 1540380880, 37);
INSERT INTO `ka_admin_log` VALUES (2971, 1, 'n', '添加支行【双流支行】成功', '182.149.189.198', 1540380889, 37);
INSERT INTO `ka_admin_log` VALUES (2972, 1, 'n', '添加支行【蓝光空港晶座社区支行】成功', '182.149.189.198', 1540380900, 37);
INSERT INTO `ka_admin_log` VALUES (2973, 1, 'n', '添加支行【双楠支行】成功', '182.149.189.198', 1540380910, 37);
INSERT INTO `ka_admin_log` VALUES (2974, 1, 'n', '添加支行【提督街支行】成功', '182.149.189.198', 1540380921, 37);
INSERT INTO `ka_admin_log` VALUES (2975, 1, 'n', '添加支行【温江支行】成功', '182.149.189.198', 1540380929, 37);
INSERT INTO `ka_admin_log` VALUES (2976, 1, 'n', '添加支行【温江永宁社区支行】成功', '182.149.189.198', 1540380941, 37);
INSERT INTO `ka_admin_log` VALUES (2977, 1, 'n', '添加支行【武侯祠支行】成功', '182.149.189.198', 1540380950, 37);
INSERT INTO `ka_admin_log` VALUES (2978, 1, 'n', '添加支行【金泽路社区支行】成功', '182.149.189.198', 1540380960, 37);
INSERT INTO `ka_admin_log` VALUES (2979, 1, 'n', '添加支行【龙湖三千里社区支行】成功', '182.149.189.198', 1540380971, 37);
INSERT INTO `ka_admin_log` VALUES (2980, 1, 'n', '添加支行【新华大道支行】成功', '182.149.189.198', 1540380981, 37);
INSERT INTO `ka_admin_log` VALUES (2981, 1, 'n', '添加支行【前锋社区支行】成功', '182.149.189.198', 1540380990, 37);
INSERT INTO `ka_admin_log` VALUES (2982, 1, 'n', '添加支行【紫竹广场社区支行】成功', '182.149.189.198', 1540380999, 37);
INSERT INTO `ka_admin_log` VALUES (2983, 1, 'n', '添加支行【摩玛新城社区支行】成功', '182.149.189.198', 1540381009, 37);
INSERT INTO `ka_admin_log` VALUES (2984, 1, 'n', '添加支行【宜宾分行】成功', '182.149.189.198', 1540381020, 37);
INSERT INTO `ka_admin_log` VALUES (2985, 1, 'n', '添加支行【宜宾鼎业兴城社区支行】成功', '182.149.189.198', 1540381033, 37);
INSERT INTO `ka_admin_log` VALUES (2986, 1, 'n', '添加支行【宜宾西区财富广场中心支行】成功', '182.149.189.198', 1540381046, 37);
INSERT INTO `ka_admin_log` VALUES (2987, 1, 'n', '添加支行【宜宾江北五粮液大道支行】成功', '182.149.189.198', 1540381056, 37);
INSERT INTO `ka_admin_log` VALUES (2988, 1, 'n', '添加支行【莱茵河畔社区支行】成功', '182.149.189.198', 1540381065, 37);
INSERT INTO `ka_admin_log` VALUES (2989, 1, 'n', '添加支行【临港地中海蓝湾社区支行】成功', '182.149.189.198', 1540381074, 37);
INSERT INTO `ka_admin_log` VALUES (2990, 1, 'n', '添加支行【石油路社区支行】成功', '182.149.189.198', 1540381119, 37);
INSERT INTO `ka_admin_log` VALUES (2991, 1, 'n', '后台登录', '182.149.189.198', 1540381766, 0);
INSERT INTO `ka_admin_log` VALUES (2992, 1, 'n', '添加销售经理【15902858116】成功', '182.149.189.198', 1540382147, 37);
INSERT INTO `ka_admin_log` VALUES (2993, 1, 'n', '添加销售经理【15008287017】成功', '182.149.189.198', 1540382168, 37);
INSERT INTO `ka_admin_log` VALUES (2994, 1, 'n', '添加销售经理【15196643369】成功', '182.149.189.198', 1540382188, 37);
INSERT INTO `ka_admin_log` VALUES (2995, 1, 'n', '添加销售经理【13666205007】成功', '182.149.189.198', 1540382218, 37);
INSERT INTO `ka_admin_log` VALUES (2996, 1, 'n', '添加销售经理【13808085758】成功', '182.149.189.198', 1540382244, 37);
INSERT INTO `ka_admin_log` VALUES (2997, 1, 'n', '添加销售经理【13438275098】成功', '182.149.189.198', 1540382266, 37);
INSERT INTO `ka_admin_log` VALUES (2998, 1, 'n', '添加销售经理【13880921594】成功', '182.149.189.198', 1540382290, 37);
INSERT INTO `ka_admin_log` VALUES (2999, 1, 'n', '添加销售经理【15208321658】成功', '182.149.189.198', 1540382311, 37);
INSERT INTO `ka_admin_log` VALUES (3000, 1, 'n', '添加销售经理【13308224113】成功', '182.149.189.198', 1540382339, 37);
INSERT INTO `ka_admin_log` VALUES (3001, 1, 'n', '添加销售经理【18280010305】成功', '182.149.189.198', 1540382360, 37);
INSERT INTO `ka_admin_log` VALUES (3002, 1, 'n', '添加销售经理【13980083277】成功', '182.149.189.198', 1540382386, 37);
INSERT INTO `ka_admin_log` VALUES (3003, 1, 'n', '编辑活动【】成功', '182.149.67.78', 1540382400, 37);
INSERT INTO `ka_admin_log` VALUES (3004, 1, 'n', '添加销售经理【13699065104】成功', '182.149.189.198', 1540382407, 37);
INSERT INTO `ka_admin_log` VALUES (3005, 1, 'n', '添加销售经理【17381964007】成功', '182.149.189.198', 1540382427, 37);
INSERT INTO `ka_admin_log` VALUES (3006, 1, 'n', '添加销售经理【18683677845】成功', '182.149.189.198', 1540382447, 37);
INSERT INTO `ka_admin_log` VALUES (3007, 1, 'n', '添加销售经理【18683636990】成功', '182.149.189.198', 1540382465, 37);
INSERT INTO `ka_admin_log` VALUES (3008, 1, 'n', '添加销售经理【13778203391】成功', '182.149.189.198', 1540382486, 37);
INSERT INTO `ka_admin_log` VALUES (3009, 1, 'n', '添加销售经理【13550664486】成功', '182.149.189.198', 1540382505, 37);
INSERT INTO `ka_admin_log` VALUES (3010, 1, 'n', '添加销售经理【13981027814】成功', '182.149.189.198', 1540382531, 37);
INSERT INTO `ka_admin_log` VALUES (3011, 1, 'n', '添加销售经理【15283837120】成功', '182.149.189.198', 1540382551, 37);
INSERT INTO `ka_admin_log` VALUES (3012, 1, 'n', '添加销售经理【13890257330】成功', '182.149.189.198', 1540382576, 37);
INSERT INTO `ka_admin_log` VALUES (3013, 1, 'n', '添加销售经理【18283873443】成功', '182.149.189.198', 1540382595, 37);
INSERT INTO `ka_admin_log` VALUES (3014, 1, 'n', '添加销售经理【13658108857】成功', '182.149.189.198', 1540382618, 37);
INSERT INTO `ka_admin_log` VALUES (3015, 1, 'n', '添加销售经理【18602895676】成功', '182.149.189.198', 1540382642, 37);
INSERT INTO `ka_admin_log` VALUES (3016, 1, 'n', '添加销售经理【13551046041】成功', '182.149.189.198', 1540382666, 37);
INSERT INTO `ka_admin_log` VALUES (3017, 1, 'n', '添加销售经理【15283326352】成功', '182.149.189.198', 1540382686, 37);
INSERT INTO `ka_admin_log` VALUES (3018, 1, 'n', '添加销售经理【15928858804】成功', '182.149.189.198', 1540382712, 37);
INSERT INTO `ka_admin_log` VALUES (3019, 1, 'n', '添加销售经理【18010600019】成功', '182.149.189.198', 1540382740, 37);
INSERT INTO `ka_admin_log` VALUES (3020, 1, 'n', '添加销售经理【18782297718】成功', '182.149.189.198', 1540382768, 37);
INSERT INTO `ka_admin_log` VALUES (3021, 1, 'n', '添加销售经理【15908148064】成功', '182.149.189.198', 1540382793, 37);
INSERT INTO `ka_admin_log` VALUES (3022, 1, 'n', '添加销售经理【15882314328】成功', '182.149.189.198', 1540382817, 37);
INSERT INTO `ka_admin_log` VALUES (3023, 1, 'n', '添加销售经理【13881038195】成功', '182.149.189.198', 1540382835, 37);
INSERT INTO `ka_admin_log` VALUES (3024, 1, 'n', '添加销售经理【18696779797】成功', '182.149.189.198', 1540382867, 37);
INSERT INTO `ka_admin_log` VALUES (3025, 1, 'n', '添加销售经理【18982222687】成功', '182.149.189.198', 1540382954, 37);
INSERT INTO `ka_admin_log` VALUES (3026, 1, 'n', '删除支行成功【18696779797】', '182.149.189.198', 1540382969, 37);
INSERT INTO `ka_admin_log` VALUES (3027, 1, 'n', '添加销售经理【18628085033】成功', '182.149.189.198', 1540382998, 37);
INSERT INTO `ka_admin_log` VALUES (3028, 1, 'n', '添加销售经理【13541051111】成功', '182.149.189.198', 1540383024, 37);
INSERT INTO `ka_admin_log` VALUES (3029, 1, 'n', '添加销售经理【13540005593】成功', '182.149.189.198', 1540383049, 37);
INSERT INTO `ka_admin_log` VALUES (3030, 1, 'n', '添加销售经理【13880002868】成功', '182.149.189.198', 1540383076, 37);
INSERT INTO `ka_admin_log` VALUES (3031, 1, 'n', '添加销售经理【13518159683】成功', '182.149.189.198', 1540383100, 37);
INSERT INTO `ka_admin_log` VALUES (3032, 1, 'n', '添加销售经理【18080071002】成功', '182.149.189.198', 1540383122, 37);
INSERT INTO `ka_admin_log` VALUES (3033, 1, 'n', '添加销售经理【18108061278】成功', '182.149.189.198', 1540383147, 37);
INSERT INTO `ka_admin_log` VALUES (3034, 1, 'n', '添加销售经理【18380116119】成功', '182.149.189.198', 1540383171, 37);
INSERT INTO `ka_admin_log` VALUES (3035, 1, 'n', '添加销售经理【13550330000】成功', '182.149.189.198', 1540383193, 37);
INSERT INTO `ka_admin_log` VALUES (3036, 1, 'n', '添加销售经理【13699065755】成功', '182.149.189.198', 1540383215, 37);
INSERT INTO `ka_admin_log` VALUES (3037, 1, 'n', '添加销售经理【18782931844】成功', '182.149.189.198', 1540383247, 37);
INSERT INTO `ka_admin_log` VALUES (3038, 1, 'n', '添加销售经理【13980586395】成功', '182.149.189.198', 1540383287, 37);
INSERT INTO `ka_admin_log` VALUES (3039, 1, 'n', '添加销售经理【13708070195】成功', '182.149.189.198', 1540383307, 37);
INSERT INTO `ka_admin_log` VALUES (3040, 1, 'n', '添加销售经理【18108152535】成功', '182.149.189.198', 1540383330, 37);
INSERT INTO `ka_admin_log` VALUES (3041, 1, 'n', '添加销售经理【18380442572】成功', '182.149.189.198', 1540383352, 37);
INSERT INTO `ka_admin_log` VALUES (3042, 1, 'n', '添加销售经理【17711276307】成功', '182.149.189.198', 1540383376, 37);
INSERT INTO `ka_admin_log` VALUES (3043, 1, 'n', '添加销售经理【13696168882】成功', '182.149.189.198', 1540383397, 37);
INSERT INTO `ka_admin_log` VALUES (3044, 1, 'n', '添加销售经理【13890636412】成功', '182.149.189.198', 1540383419, 37);
INSERT INTO `ka_admin_log` VALUES (3045, 1, 'n', '添加销售经理【18683312899】成功', '182.149.189.198', 1540383438, 37);
INSERT INTO `ka_admin_log` VALUES (3046, 1, 'n', '添加销售经理【15283320552】成功', '182.149.189.198', 1540383461, 37);
INSERT INTO `ka_admin_log` VALUES (3047, 1, 'n', '添加销售经理【18683381303】成功', '182.149.189.198', 1540383491, 37);
INSERT INTO `ka_admin_log` VALUES (3048, 1, 'n', '添加销售经理【15983370222】成功', '182.149.189.198', 1540383521, 37);
INSERT INTO `ka_admin_log` VALUES (3049, 1, 'n', '添加销售经理【15283308321】成功', '182.149.189.198', 1540383543, 37);
INSERT INTO `ka_admin_log` VALUES (3050, 1, 'n', '添加销售经理【13540542627】成功', '182.149.189.198', 1540383568, 37);
INSERT INTO `ka_admin_log` VALUES (3051, 1, 'n', '添加销售经理【15808330331】成功', '182.149.189.198', 1540383590, 37);
INSERT INTO `ka_admin_log` VALUES (3052, 1, 'n', '添加销售经理【18608025977】成功', '182.149.189.198', 1540383611, 37);
INSERT INTO `ka_admin_log` VALUES (3053, 1, 'n', '添加销售经理【15882161159】成功', '182.149.189.198', 1540383633, 37);
INSERT INTO `ka_admin_log` VALUES (3054, 1, 'n', '添加销售经理【13558721519】成功', '182.149.189.198', 1540383656, 37);
INSERT INTO `ka_admin_log` VALUES (3055, 1, 'n', '添加销售经理【18200123639】成功', '182.149.189.198', 1540383681, 37);
INSERT INTO `ka_admin_log` VALUES (3056, 1, 'n', '添加销售经理【13060003094】成功', '182.149.189.198', 1540383703, 37);
INSERT INTO `ka_admin_log` VALUES (3057, 1, 'n', '添加销售经理【13678132593】成功', '182.149.189.198', 1540383726, 37);
INSERT INTO `ka_admin_log` VALUES (3058, 1, 'n', '添加销售经理【15892907570】成功', '182.149.189.198', 1540383751, 37);
INSERT INTO `ka_admin_log` VALUES (3059, 1, 'n', '添加销售经理【13458705682】成功', '182.149.189.198', 1540383777, 37);
INSERT INTO `ka_admin_log` VALUES (3060, 1, 'n', '添加销售经理【18982782807】成功', '182.149.189.198', 1540383805, 37);
INSERT INTO `ka_admin_log` VALUES (3061, 1, 'n', '添加销售经理【15328334071】成功', '182.149.189.198', 1540383834, 37);
INSERT INTO `ka_admin_log` VALUES (3062, 1, 'n', '添加销售经理【18181877602】成功', '182.149.189.198', 1540383863, 37);
INSERT INTO `ka_admin_log` VALUES (3063, 1, 'n', '添加销售经理【18808300880】成功', '182.149.189.198', 1540383890, 37);
INSERT INTO `ka_admin_log` VALUES (3064, 1, 'n', '添加销售经理【18281602999】成功', '182.149.189.198', 1540383945, 37);
INSERT INTO `ka_admin_log` VALUES (3065, 1, 'n', '添加销售经理【18228089044】成功', '182.149.189.198', 1540383966, 37);
INSERT INTO `ka_admin_log` VALUES (3066, 1, 'n', '添加销售经理【13158869676】成功', '182.149.189.198', 1540383988, 37);
INSERT INTO `ka_admin_log` VALUES (3067, 1, 'n', '添加销售经理【13881196688】成功', '182.149.189.198', 1540384011, 37);
INSERT INTO `ka_admin_log` VALUES (3068, 1, 'n', '添加销售经理【18011110319】成功', '182.149.189.198', 1540384035, 37);
INSERT INTO `ka_admin_log` VALUES (3069, 1, 'n', '添加销售经理【18380227595】成功', '182.149.189.198', 1540384055, 37);
INSERT INTO `ka_admin_log` VALUES (3070, 1, 'n', '添加销售经理【15828224949】成功', '182.149.189.198', 1540384076, 37);
INSERT INTO `ka_admin_log` VALUES (3071, 1, 'n', '添加销售经理【15884507811】成功', '182.149.189.198', 1540384098, 37);
INSERT INTO `ka_admin_log` VALUES (3072, 1, 'n', '添加销售经理【13698281781】成功', '182.149.189.198', 1540384122, 37);
INSERT INTO `ka_admin_log` VALUES (3073, 1, 'n', '添加销售经理【13990771350】成功', '182.149.189.198', 1540384148, 37);
INSERT INTO `ka_admin_log` VALUES (3074, 1, 'n', '添加销售经理【18608200708】成功', '182.149.189.198', 1540384168, 37);
INSERT INTO `ka_admin_log` VALUES (3075, 1, 'n', '添加销售经理【13980317563】成功', '182.149.189.198', 1540384188, 37);
INSERT INTO `ka_admin_log` VALUES (3076, 1, 'n', '添加销售经理【13708278989】成功', '182.149.189.198', 1540384207, 37);
INSERT INTO `ka_admin_log` VALUES (3077, 1, 'n', '添加销售经理【13881865817】成功', '182.149.189.198', 1540384228, 37);
INSERT INTO `ka_admin_log` VALUES (3078, 1, 'n', '添加销售经理【18200360548】成功', '182.149.189.198', 1540384250, 37);
INSERT INTO `ka_admin_log` VALUES (3079, 1, 'n', '添加销售经理【13458588390】成功', '182.149.189.198', 1540384271, 37);
INSERT INTO `ka_admin_log` VALUES (3080, 1, 'n', '添加销售经理【13550098147】成功', '182.149.189.198', 1540384292, 37);
INSERT INTO `ka_admin_log` VALUES (3081, 1, 'n', '添加销售经理【13551816984】成功', '182.149.189.198', 1540384312, 37);
INSERT INTO `ka_admin_log` VALUES (3082, 1, 'n', '添加销售经理【13550252804】成功', '182.149.189.198', 1540384338, 37);
INSERT INTO `ka_admin_log` VALUES (3083, 1, 'n', '添加销售经理【18608029367】成功', '182.149.189.198', 1540384358, 37);
INSERT INTO `ka_admin_log` VALUES (3084, 1, 'n', '添加销售经理【13541047082】成功', '182.149.189.198', 1540384378, 37);
INSERT INTO `ka_admin_log` VALUES (3085, 1, 'n', '添加销售经理【13880492246】成功', '182.149.189.198', 1540384402, 37);
INSERT INTO `ka_admin_log` VALUES (3086, 1, 'n', '添加销售经理【13438163445】成功', '182.149.189.198', 1540384440, 37);
INSERT INTO `ka_admin_log` VALUES (3087, 1, 'n', '添加销售经理【13980496626】成功', '182.149.189.198', 1540384464, 37);
INSERT INTO `ka_admin_log` VALUES (3088, 1, 'n', '添加销售经理【13880602411】成功', '182.149.189.198', 1540384488, 37);
INSERT INTO `ka_admin_log` VALUES (3089, 1, 'n', '添加销售经理【13980587575】成功', '182.149.189.198', 1540384513, 37);
INSERT INTO `ka_admin_log` VALUES (3090, 1, 'n', '添加销售经理【13108075229】成功', '182.149.189.198', 1540384536, 37);
INSERT INTO `ka_admin_log` VALUES (3091, 1, 'n', '添加销售经理【13551359467】成功', '182.149.189.198', 1540384557, 37);
INSERT INTO `ka_admin_log` VALUES (3092, 1, 'n', '添加销售经理【15228968691】成功', '182.149.189.198', 1540384670, 37);
INSERT INTO `ka_admin_log` VALUES (3093, 1, 'n', '添加销售经理【18615781682】成功', '182.149.189.198', 1540384696, 37);
INSERT INTO `ka_admin_log` VALUES (3094, 1, 'n', '添加销售经理【18683426868】成功', '182.149.189.198', 1540384720, 37);
INSERT INTO `ka_admin_log` VALUES (3095, 1, 'n', '添加销售经理【18683662712】成功', '182.149.189.198', 1540384740, 37);
INSERT INTO `ka_admin_log` VALUES (3096, 1, 'n', '添加销售经理【15202812607】成功', '182.149.189.198', 1540384757, 37);
INSERT INTO `ka_admin_log` VALUES (3097, 1, 'n', '添加销售经理【15828035565】成功', '182.149.189.198', 1540384778, 37);
INSERT INTO `ka_admin_log` VALUES (3098, 1, 'n', '添加销售经理【18628118415】成功', '182.149.189.198', 1540384797, 37);
INSERT INTO `ka_admin_log` VALUES (3099, 1, 'n', '添加销售经理【17345007881】成功', '182.149.189.198', 1540384815, 37);
INSERT INTO `ka_admin_log` VALUES (3100, 1, 'n', '添加销售经理【18682580227】成功', '182.149.189.198', 1540384833, 37);
INSERT INTO `ka_admin_log` VALUES (3101, 1, 'n', '添加销售经理【18380115476】成功', '182.149.189.198', 1540384849, 37);
INSERT INTO `ka_admin_log` VALUES (3102, 1, 'n', '添加销售经理【13540416977】成功', '182.149.189.198', 1540384868, 37);
INSERT INTO `ka_admin_log` VALUES (3103, 1, 'n', '添加销售经理【13568950239】成功', '182.149.189.198', 1540384895, 37);
INSERT INTO `ka_admin_log` VALUES (3104, 1, 'n', '添加销售经理【13881789337】成功', '182.149.189.198', 1540384914, 37);
INSERT INTO `ka_admin_log` VALUES (3105, 1, 'n', '添加销售经理【13666132704】成功', '182.149.189.198', 1540384940, 37);
INSERT INTO `ka_admin_log` VALUES (3106, 1, 'n', '添加销售经理【13980835598】成功', '182.149.189.198', 1540384958, 37);
INSERT INTO `ka_admin_log` VALUES (3107, 1, 'n', '添加销售经理【15983403638】成功', '182.149.189.198', 1540384976, 37);
INSERT INTO `ka_admin_log` VALUES (3108, 1, 'n', '添加销售经理【18782923374】成功', '182.149.189.198', 1540384997, 37);
INSERT INTO `ka_admin_log` VALUES (3109, 1, 'n', '添加销售经理【15183154832】成功', '182.149.189.198', 1540385015, 37);
INSERT INTO `ka_admin_log` VALUES (3110, 1, 'n', '添加销售经理【18380407960】成功', '182.149.189.198', 1540385034, 37);
INSERT INTO `ka_admin_log` VALUES (3111, 1, 'n', '添加销售经理【15082620607】成功', '182.149.189.198', 1540385052, 37);
INSERT INTO `ka_admin_log` VALUES (3112, 1, 'n', '添加销售经理【13419257997】成功', '182.149.189.198', 1540385076, 37);
INSERT INTO `ka_admin_log` VALUES (3113, 1, 'n', '添加销售经理【13096211321】成功', '182.149.189.198', 1540385105, 37);
INSERT INTO `ka_admin_log` VALUES (3114, 1, 'n', '添加销售经理【13619039972】成功', '182.149.189.198', 1540385130, 37);
INSERT INTO `ka_admin_log` VALUES (3115, 1, 'n', '添加销售经理【15882405936】成功', '182.149.189.198', 1540385150, 37);
INSERT INTO `ka_admin_log` VALUES (3116, 1, 'n', '添加销售经理【13808187435】成功', '182.149.189.198', 1540385182, 37);
INSERT INTO `ka_admin_log` VALUES (3117, 1, 'n', '后台登录', '127.0.0.1', 1540388440, 0);
INSERT INTO `ka_admin_log` VALUES (3118, 1, 'n', '后台登录', '182.149.165.224', 1540388732, 0);
INSERT INTO `ka_admin_log` VALUES (3119, 1, 'n', '编辑兑换等级【金级30积点】成功', '182.149.189.198', 1540391399, 37);
INSERT INTO `ka_admin_log` VALUES (3120, 1, 'n', '编辑兑换等级【白金级50积点】成功', '182.149.189.198', 1540391417, 37);
INSERT INTO `ka_admin_log` VALUES (3121, 1, 'n', '编辑兑换等级【黑金级100积点】成功', '182.149.189.198', 1540391435, 37);
INSERT INTO `ka_admin_log` VALUES (3122, 1, 'n', '后台登录', '110.185.88.36', 1540393795, 0);
INSERT INTO `ka_admin_log` VALUES (3123, 1, 'n', '编辑活动【】成功', '182.149.189.198', 1540396869, 37);
INSERT INTO `ka_admin_log` VALUES (3124, 1, 'n', '后台登录', '127.0.0.1', 1540431350, 0);
INSERT INTO `ka_admin_log` VALUES (3125, 1, 'n', '后台登录', '110.184.43.15', 1540432143, 0);
INSERT INTO `ka_admin_log` VALUES (3126, 1, 'n', '编辑活动【】成功', '110.184.43.15', 1540432203, 37);
INSERT INTO `ka_admin_log` VALUES (3127, 1, 'n', '后台登录', '182.149.67.78', 1540433265, 0);
INSERT INTO `ka_admin_log` VALUES (3128, 1, 'n', '编辑活动【】成功', '110.184.43.15', 1540436880, 37);
INSERT INTO `ka_admin_log` VALUES (3129, 1, 'n', '后台登录', '110.184.43.15', 1540437422, 0);
INSERT INTO `ka_admin_log` VALUES (3130, 1, 'n', '后台登录', '182.149.67.78', 1540438102, 0);
INSERT INTO `ka_admin_log` VALUES (3131, 1, 'n', '后台登录', '110.184.43.15', 1540438450, 0);
INSERT INTO `ka_admin_log` VALUES (3132, 1, 'n', '编辑活动【】成功', '182.138.150.205', 1540440647, 37);
INSERT INTO `ka_admin_log` VALUES (3133, 1, 'n', '编辑支行【测试支行】成功', '110.184.43.15', 1540445341, 37);
INSERT INTO `ka_admin_log` VALUES (3134, 1, 'n', '后台登录', '182.149.67.78', 1540446835, 0);
INSERT INTO `ka_admin_log` VALUES (3135, 1, 'n', '删除兑换活动成功【客户经理发放活动测试】', '182.138.150.205', 1540447466, 32);
INSERT INTO `ka_admin_log` VALUES (3136, 1, 'n', '删除兑换活动成功【客户经理兑换活动测试】', '182.138.150.205', 1540447485, 31);
INSERT INTO `ka_admin_log` VALUES (3137, 1, 'n', '编辑兑换等级【黄金级30积点】成功', '110.184.43.15', 1540448090, 37);
INSERT INTO `ka_admin_log` VALUES (3138, 1, 'n', '编辑支行【测试支行测试支行测试支行】成功', '110.184.43.15', 1540449849, 37);
INSERT INTO `ka_admin_log` VALUES (3139, 1, 'n', '编辑支行【测试支行】成功', '110.184.43.15', 1540449940, 37);
INSERT INTO `ka_admin_log` VALUES (3140, 1, 'n', '订单【orderid：10】发货成功', '127.0.0.1', 1540450348, 37);
INSERT INTO `ka_admin_log` VALUES (3141, 1, 'n', '订单【orderid：11】发货成功', '127.0.0.1', 1540450479, 37);
INSERT INTO `ka_admin_log` VALUES (3142, 1, 'n', '后台登录', '182.149.67.78', 1540452775, 0);
INSERT INTO `ka_admin_log` VALUES (3143, 1, 'n', '添加销售经理【18782410707】成功', '110.184.43.15', 1540453402, 37);
INSERT INTO `ka_admin_log` VALUES (3144, 1, 'n', '添加销售经理【18583616136】成功', '110.184.43.15', 1540453436, 37);
INSERT INTO `ka_admin_log` VALUES (3145, 1, 'n', '编辑支行【测试测试测试测试支行】成功', '110.184.43.15', 1540454056, 37);
INSERT INTO `ka_admin_log` VALUES (3146, 1, 'n', '编辑支行【测试测试测试测试支支行】成功', '110.184.43.15', 1540454084, 37);
INSERT INTO `ka_admin_log` VALUES (3147, 1, 'n', '编辑支行【测试支行】成功', '110.184.43.15', 1540454108, 37);
INSERT INTO `ka_admin_log` VALUES (3148, 1, 'n', '编辑支行【支行测试支行测试支行】成功', '110.184.43.15', 1540454588, 37);
INSERT INTO `ka_admin_log` VALUES (3149, 1, 'n', '编辑支行【测试支行】成功', '110.184.43.15', 1540454639, 37);
INSERT INTO `ka_admin_log` VALUES (3150, 1, 'n', '编辑支行【测试支行测试支行测试支行】成功', '127.0.0.1', 1540455050, 37);
INSERT INTO `ka_admin_log` VALUES (3151, 1, 'n', '后台登录', '110.184.43.15', 1540455319, 0);
INSERT INTO `ka_admin_log` VALUES (3152, 1, 'n', '编辑支行【测试支行】成功', '110.184.43.15', 1540455841, 37);
INSERT INTO `ka_admin_log` VALUES (3153, 1, 'n', '编辑支行【测试支行测试支行测试支行】成功', '127.0.0.1', 1540455930, 37);
INSERT INTO `ka_admin_log` VALUES (3154, 1, 'n', '添加销售经理【18010671913】成功', '110.184.43.15', 1540456164, 37);
INSERT INTO `ka_admin_log` VALUES (3155, 1, 'n', '后台登录', '182.149.67.78', 1540461252, 0);
INSERT INTO `ka_admin_log` VALUES (3156, 1, 'n', '后台登录', '182.149.188.188', 1540516492, 0);
INSERT INTO `ka_admin_log` VALUES (3157, 1, 'n', '后台登录', '182.149.188.188', 1540516762, 0);
INSERT INTO `ka_admin_log` VALUES (3158, 1, 'n', '后台登录', '127.0.0.1', 1540518267, 0);
INSERT INTO `ka_admin_log` VALUES (3159, 1, 'n', '后台登录', '182.138.150.205', 1540520864, 0);
INSERT INTO `ka_admin_log` VALUES (3160, 1, 'n', '后台登录', '182.149.67.78', 1540522135, 0);
INSERT INTO `ka_admin_log` VALUES (3161, 1, 'n', '后台登录', '182.149.67.78', 1540541301, 0);
INSERT INTO `ka_admin_log` VALUES (3162, 1, 'n', '后台登录', '182.149.188.188', 1540563027, 0);
INSERT INTO `ka_admin_log` VALUES (3163, 1, 'n', '订单【orderid：12】发货成功', '182.149.188.188', 1540563384, 37);
INSERT INTO `ka_admin_log` VALUES (3164, 1, 'n', '后台登录', '125.71.75.236', 1540651146, 0);
INSERT INTO `ka_admin_log` VALUES (3165, 1, 'n', '后台登录', '182.149.124.87', 1540690792, 0);
INSERT INTO `ka_admin_log` VALUES (3166, 1, 'n', '后台登录', '171.214.136.7', 1540776601, 0);
INSERT INTO `ka_admin_log` VALUES (3167, 1, 'n', '后台登录', '127.0.0.1', 1540777106, 0);
INSERT INTO `ka_admin_log` VALUES (3168, 1, 'n', '后台登录', '182.149.67.78', 1540778065, 0);
INSERT INTO `ka_admin_log` VALUES (3169, 1, 'n', '后台登录', '127.0.0.1', 1540795834, 0);
INSERT INTO `ka_admin_log` VALUES (3170, 1, 'n', '添加活动【】成功', '127.0.0.1', 1540797764, 37);
INSERT INTO `ka_admin_log` VALUES (3171, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540799852, 37);
INSERT INTO `ka_admin_log` VALUES (3172, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540800135, 37);
INSERT INTO `ka_admin_log` VALUES (3173, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540802021, 37);
INSERT INTO `ka_admin_log` VALUES (3174, 1, 'n', '添加兑换等级【100~500】成功', '127.0.0.1', 1540803741, 37);
INSERT INTO `ka_admin_log` VALUES (3175, 1, 'n', '添加兑换等级【500~1000】成功', '127.0.0.1', 1540803751, 37);
INSERT INTO `ka_admin_log` VALUES (3176, 1, 'n', '生成兑换码成功，批次编号【201810291704_30_1】', '127.0.0.1', 1540803854, 37);
INSERT INTO `ka_admin_log` VALUES (3177, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540804736, 37);
INSERT INTO `ka_admin_log` VALUES (3178, 1, 'n', '添加活动【】成功', '127.0.0.1', 1540806056, 37);
INSERT INTO `ka_admin_log` VALUES (3179, 1, 'n', '后台登录', '127.0.0.1', 1540865412, 0);
INSERT INTO `ka_admin_log` VALUES (3180, 1, 'n', '后台登录', '127.0.0.1', 1540875381, 0);
INSERT INTO `ka_admin_log` VALUES (3181, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540875840, 37);
INSERT INTO `ka_admin_log` VALUES (3182, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540876320, 37);
INSERT INTO `ka_admin_log` VALUES (3183, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540877084, 37);
INSERT INTO `ka_admin_log` VALUES (3184, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540877157, 37);
INSERT INTO `ka_admin_log` VALUES (3185, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540877268, 37);
INSERT INTO `ka_admin_log` VALUES (3186, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540877480, 37);
INSERT INTO `ka_admin_log` VALUES (3187, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540877773, 37);
INSERT INTO `ka_admin_log` VALUES (3188, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540877785, 37);
INSERT INTO `ka_admin_log` VALUES (3189, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540877848, 37);
INSERT INTO `ka_admin_log` VALUES (3190, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540878758, 37);
INSERT INTO `ka_admin_log` VALUES (3191, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540879910, 37);
INSERT INTO `ka_admin_log` VALUES (3192, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540880467, 37);
INSERT INTO `ka_admin_log` VALUES (3193, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540880581, 37);
INSERT INTO `ka_admin_log` VALUES (3194, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540880594, 37);
INSERT INTO `ka_admin_log` VALUES (3195, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540880708, 37);
INSERT INTO `ka_admin_log` VALUES (3196, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540880985, 37);
INSERT INTO `ka_admin_log` VALUES (3197, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540881010, 37);
INSERT INTO `ka_admin_log` VALUES (3198, 1, 'n', '生成兑换码成功，批次编号【201810301445_30_1】', '127.0.0.1', 1540881965, 37);
INSERT INTO `ka_admin_log` VALUES (3199, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540884120, 37);
INSERT INTO `ka_admin_log` VALUES (3200, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540884840, 37);
INSERT INTO `ka_admin_log` VALUES (3201, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540884854, 37);
INSERT INTO `ka_admin_log` VALUES (3202, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540884866, 37);
INSERT INTO `ka_admin_log` VALUES (3203, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540884884, 37);
INSERT INTO `ka_admin_log` VALUES (3204, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540884911, 37);
INSERT INTO `ka_admin_log` VALUES (3205, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540885092, 37);
INSERT INTO `ka_admin_log` VALUES (3206, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540885106, 37);
INSERT INTO `ka_admin_log` VALUES (3207, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540885134, 37);
INSERT INTO `ka_admin_log` VALUES (3208, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540885181, 37);
INSERT INTO `ka_admin_log` VALUES (3209, 1, 'n', '生成兑换码成功，批次编号【201810301540_30_2】', '127.0.0.1', 1540885244, 37);
INSERT INTO `ka_admin_log` VALUES (3210, 1, 'n', '后台登录', '127.0.0.1', 1540967423, 0);
INSERT INTO `ka_admin_log` VALUES (3211, 1, 'n', '编辑支行【测试支行测试】成功', '127.0.0.1', 1540967504, 37);
INSERT INTO `ka_admin_log` VALUES (3212, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540970134, 37);
INSERT INTO `ka_admin_log` VALUES (3213, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540971106, 37);
INSERT INTO `ka_admin_log` VALUES (3214, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540971244, 37);
INSERT INTO `ka_admin_log` VALUES (3215, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540971780, 37);
INSERT INTO `ka_admin_log` VALUES (3216, 1, 'n', '订单【orderid：14】发货成功', '127.0.0.1', 1540975935, 37);
INSERT INTO `ka_admin_log` VALUES (3217, 1, 'n', '订单【orderid：13】发货成功', '127.0.0.1', 1540975962, 37);
INSERT INTO `ka_admin_log` VALUES (3218, 1, 'n', '订单【orderid：15】发货成功', '127.0.0.1', 1540976071, 37);
INSERT INTO `ka_admin_log` VALUES (3219, 1, 'n', '订单【orderid：16】发货成功', '127.0.0.1', 1540976800, 37);
INSERT INTO `ka_admin_log` VALUES (3220, 1, 'n', '订单【orderid：17】发货成功', '127.0.0.1', 1540976854, 37);
INSERT INTO `ka_admin_log` VALUES (3221, 1, 'n', '订单【orderid：18】发货成功', '127.0.0.1', 1540977064, 37);
INSERT INTO `ka_admin_log` VALUES (3222, 1, 'n', '订单【orderid：19】发货成功', '127.0.0.1', 1540977078, 37);
INSERT INTO `ka_admin_log` VALUES (3223, 1, 'n', '订单【orderid：20】发货成功', '127.0.0.1', 1540977114, 37);
INSERT INTO `ka_admin_log` VALUES (3224, 1, 'n', '订单【orderid：33】发货成功', '127.0.0.1', 1540978763, 37);
INSERT INTO `ka_admin_log` VALUES (3225, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1540979014, 37);
INSERT INTO `ka_admin_log` VALUES (3226, 1, 'n', '后台登录', '127.0.0.1', 1541045205, 0);
INSERT INTO `ka_admin_log` VALUES (3227, 1, 'n', '后台登录', '127.0.0.1', 1541382522, 0);
INSERT INTO `ka_admin_log` VALUES (3228, 1, 'n', '订单【orderid：47】发货成功', '127.0.0.1', 1541390063, 37);
INSERT INTO `ka_admin_log` VALUES (3229, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541394718, 37);
INSERT INTO `ka_admin_log` VALUES (3230, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541396294, 37);
INSERT INTO `ka_admin_log` VALUES (3231, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541396325, 37);
INSERT INTO `ka_admin_log` VALUES (3232, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541397442, 37);
INSERT INTO `ka_admin_log` VALUES (3233, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541397602, 37);
INSERT INTO `ka_admin_log` VALUES (3234, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541397642, 37);
INSERT INTO `ka_admin_log` VALUES (3235, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541398646, 37);
INSERT INTO `ka_admin_log` VALUES (3236, 1, 'n', '管理角色测试支行二级管理员', '127.0.0.1', 1541405059, 37);
INSERT INTO `ka_admin_log` VALUES (3237, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541408161, 37);
INSERT INTO `ka_admin_log` VALUES (3238, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541408892, 37);
INSERT INTO `ka_admin_log` VALUES (3239, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541408952, 37);
INSERT INTO `ka_admin_log` VALUES (3240, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541410610, 37);
INSERT INTO `ka_admin_log` VALUES (3241, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541410614, 37);
INSERT INTO `ka_admin_log` VALUES (3242, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541410618, 37);
INSERT INTO `ka_admin_log` VALUES (3243, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541410626, 37);
INSERT INTO `ka_admin_log` VALUES (3244, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541410633, 37);
INSERT INTO `ka_admin_log` VALUES (3245, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541410638, 37);
INSERT INTO `ka_admin_log` VALUES (3246, 3, 'n', '后台登录', '127.0.0.1', 1541410701, 37);
INSERT INTO `ka_admin_log` VALUES (3247, 1, 'n', '后台登录', '127.0.0.1', 1541410724, 0);
INSERT INTO `ka_admin_log` VALUES (3248, 3, 'n', '后台登录', '127.0.0.1', 1541411413, 37);
INSERT INTO `ka_admin_log` VALUES (3249, 1, 'n', '后台登录', '127.0.0.1', 1541411481, 0);
INSERT INTO `ka_admin_log` VALUES (3250, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541411819, 37);
INSERT INTO `ka_admin_log` VALUES (3251, 3, 'n', '后台登录', '127.0.0.1', 1541411910, 37);
INSERT INTO `ka_admin_log` VALUES (3252, 3, 'n', '后台登录', '127.0.0.1', 1541412311, 0);
INSERT INTO `ka_admin_log` VALUES (3253, 3, 'n', '后台登录', '127.0.0.1', 1541412333, 37);
INSERT INTO `ka_admin_log` VALUES (3254, 1, 'n', '后台登录', '127.0.0.1', 1541412390, 0);
INSERT INTO `ka_admin_log` VALUES (3255, 3, 'n', '后台登录', '127.0.0.1', 1541412522, 37);
INSERT INTO `ka_admin_log` VALUES (3256, 1, 'n', '后台登录', '127.0.0.1', 1541412551, 0);
INSERT INTO `ka_admin_log` VALUES (3257, 1, 'n', '后台登录', '127.0.0.1', 1541469884, 0);
INSERT INTO `ka_admin_log` VALUES (3258, 3, 'n', '后台登录', '127.0.0.1', 1541470023, 37);
INSERT INTO `ka_admin_log` VALUES (3259, 1, 'n', '后台登录', '127.0.0.1', 1541470107, 0);
INSERT INTO `ka_admin_log` VALUES (3260, 3, 'n', '后台登录', '127.0.0.1', 1541470408, 37);
INSERT INTO `ka_admin_log` VALUES (3261, 1, 'n', '后台登录', '127.0.0.1', 1541470499, 0);
INSERT INTO `ka_admin_log` VALUES (3262, 3, 'n', '后台登录', '127.0.0.1', 1541470575, 37);
INSERT INTO `ka_admin_log` VALUES (3263, 1, 'n', '后台登录', '127.0.0.1', 1541470621, 0);
INSERT INTO `ka_admin_log` VALUES (3264, 1, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541470807, 37);
INSERT INTO `ka_admin_log` VALUES (3265, 3, 'n', '后台登录', '127.0.0.1', 1541470819, 37);
INSERT INTO `ka_admin_log` VALUES (3266, 3, 'n', '管理角色该银行下二级管理员', '127.0.0.1', 1541470948, 37);
INSERT INTO `ka_admin_log` VALUES (3267, 3, 'n', '后台登录', '127.0.0.1', 1541470975, 37);
INSERT INTO `ka_admin_log` VALUES (3268, 1, 'n', '后台登录', '127.0.0.1', 1541471057, 0);
INSERT INTO `ka_admin_log` VALUES (3269, 1, 'n', '管理角色二级管理员', '127.0.0.1', 1541471192, 37);
INSERT INTO `ka_admin_log` VALUES (3270, 3, 'n', '后台登录', '127.0.0.1', 1541477439, 37);
INSERT INTO `ka_admin_log` VALUES (3271, 1, 'n', '后台登录', '127.0.0.1', 1541477888, 0);
INSERT INTO `ka_admin_log` VALUES (3272, 1, 'n', '管理角色二级管理员', '127.0.0.1', 1541477906, 37);
INSERT INTO `ka_admin_log` VALUES (3273, 3, 'n', '后台登录', '127.0.0.1', 1541477923, 37);
INSERT INTO `ka_admin_log` VALUES (3274, 1, 'n', '后台登录', '127.0.0.1', 1541478337, 0);
INSERT INTO `ka_admin_log` VALUES (3275, 1, 'n', '管理角色二级管理员', '127.0.0.1', 1541478472, 37);
INSERT INTO `ka_admin_log` VALUES (3276, 3, 'n', '后台登录', '127.0.0.1', 1541478482, 37);
INSERT INTO `ka_admin_log` VALUES (3277, 3, 'n', '订单【orderid：49】发货成功', '127.0.0.1', 1541478503, 37);
INSERT INTO `ka_admin_log` VALUES (3278, 1, 'n', '后台登录', '127.0.0.1', 1541478534, 0);
INSERT INTO `ka_admin_log` VALUES (3279, 1, 'n', '管理角色二级管理员', '127.0.0.1', 1541478831, 37);
INSERT INTO `ka_admin_log` VALUES (3280, 3, 'n', '后台登录', '127.0.0.1', 1541478843, 37);
INSERT INTO `ka_admin_log` VALUES (3281, 1, 'n', '后台登录', '127.0.0.1', 1541479045, 0);
INSERT INTO `ka_admin_log` VALUES (3282, 1, 'n', '添加销售经理【18140191530】成功', '127.0.0.1', 1541491271, 37);
INSERT INTO `ka_admin_log` VALUES (3283, 1, 'n', '后台登录', '127.0.0.1', 1541579699, 0);
INSERT INTO `ka_admin_log` VALUES (3284, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541588151, 37);
INSERT INTO `ka_admin_log` VALUES (3285, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541589672, 37);
INSERT INTO `ka_admin_log` VALUES (3286, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541590729, 37);
INSERT INTO `ka_admin_log` VALUES (3287, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541590751, 37);
INSERT INTO `ka_admin_log` VALUES (3288, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541590760, 37);
INSERT INTO `ka_admin_log` VALUES (3289, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541590786, 37);
INSERT INTO `ka_admin_log` VALUES (3290, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541591191, 37);
INSERT INTO `ka_admin_log` VALUES (3291, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541591679, 37);
INSERT INTO `ka_admin_log` VALUES (3292, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541592179, 37);
INSERT INTO `ka_admin_log` VALUES (3293, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541592179, 37);
INSERT INTO `ka_admin_log` VALUES (3294, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541592194, 37);
INSERT INTO `ka_admin_log` VALUES (3295, 1, 'n', '后台登录', '127.0.0.1', 1541646516, 0);
INSERT INTO `ka_admin_log` VALUES (3296, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541670009, 37);
INSERT INTO `ka_admin_log` VALUES (3297, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541671685, 37);
INSERT INTO `ka_admin_log` VALUES (3298, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541671693, 37);
INSERT INTO `ka_admin_log` VALUES (3299, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541671703, 37);
INSERT INTO `ka_admin_log` VALUES (3300, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541672003, 37);
INSERT INTO `ka_admin_log` VALUES (3301, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541675850, 37);
INSERT INTO `ka_admin_log` VALUES (3302, 1, 'n', '后台登录', '127.0.0.1', 1541727397, 0);
INSERT INTO `ka_admin_log` VALUES (3303, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541729336, 37);
INSERT INTO `ka_admin_log` VALUES (3304, 1, 'n', '生成兑换码成功，批次编号【201811091420_30_1】', '127.0.0.1', 1541744447, 37);
INSERT INTO `ka_admin_log` VALUES (3305, 1, 'n', '生成兑换码成功，批次编号【201811091420_30_2】', '127.0.0.1', 1541744464, 37);
INSERT INTO `ka_admin_log` VALUES (3306, 1, 'n', '后台登录', '127.0.0.1', 1541759699, 0);
INSERT INTO `ka_admin_log` VALUES (3307, 1, 'n', '后台登录', '127.0.0.1', 1541993245, 0);
INSERT INTO `ka_admin_log` VALUES (3308, 1, 'n', '生成兑换码成功，批次编号【201811121127_30_1】', '127.0.0.1', 1541993339, 37);
INSERT INTO `ka_admin_log` VALUES (3309, 1, 'n', '添加活动【】成功', '127.0.0.1', 1541994757, 37);
INSERT INTO `ka_admin_log` VALUES (3310, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541994767, 37);
INSERT INTO `ka_admin_log` VALUES (3311, 1, 'n', '生成兑换码成功，批次编号【201811121154_32_1】', '127.0.0.1', 1541994858, 37);
INSERT INTO `ka_admin_log` VALUES (3312, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541995542, 37);
INSERT INTO `ka_admin_log` VALUES (3313, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541995556, 37);
INSERT INTO `ka_admin_log` VALUES (3314, 1, 'n', '生成兑换码成功，批次编号【201811121207_32_2】', '127.0.0.1', 1541995638, 37);
INSERT INTO `ka_admin_log` VALUES (3315, 1, 'n', '编辑活动【】成功', '127.0.0.1', 1541995727, 37);

-- ----------------------------
-- Table structure for ka_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `ka_admin_role`;
CREATE TABLE `ka_admin_role`  (
  `role_id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `role_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '角色名称',
  `act_list` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '权限列表',
  `role_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '角色描述',
  `aid` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '关联活动',
  `sid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '关联商城id',
  PRIMARY KEY (`role_id`) USING BTREE,
  INDEX `s`(`sid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_admin_role
-- ----------------------------
INSERT INTO `ka_admin_role` VALUES (1, '超级管理员', 'all', '管理全站', NULL, 0);
INSERT INTO `ka_admin_role` VALUES (2, '二级管理员', '64,63', '其权限只用于查看及下载测试支行对应的某一活动的兑换订单表', '30,29', 37);

-- ----------------------------
-- Table structure for ka_banks
-- ----------------------------
DROP TABLE IF EXISTS `ka_banks`;
CREATE TABLE `ka_banks`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '银行支行名称',
  `sid` mediumint(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 130 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ka_banks
-- ----------------------------
INSERT INTO `ka_banks` VALUES (1, '高新天府支行', 31);
INSERT INTO `ka_banks` VALUES (2, '武侯大道支行', 31);
INSERT INTO `ka_banks` VALUES (5, '高新区支行', 32);
INSERT INTO `ka_banks` VALUES (6, '草堂支行', 37);
INSERT INTO `ka_banks` VALUES (7, '康河丽景社区支行', 37);
INSERT INTO `ka_banks` VALUES (8, '蓝谷地社区支行', 37);
INSERT INTO `ka_banks` VALUES (9, '红枫林社区支行', 37);
INSERT INTO `ka_banks` VALUES (10, '锦城世家社区支行', 37);
INSERT INTO `ka_banks` VALUES (11, '成华支行', 37);
INSERT INTO `ka_banks` VALUES (12, '测试支行测试', 37);
INSERT INTO `ka_banks` VALUES (13, '中德英伦联邦社区支行', 37);
INSERT INTO `ka_banks` VALUES (14, '慕和南道社区支行', 37);
INSERT INTO `ka_banks` VALUES (15, '复地社区支行', 37);
INSERT INTO `ka_banks` VALUES (16, '锦天府社区支行', 37);
INSERT INTO `ka_banks` VALUES (17, '康郡社区支行', 37);
INSERT INTO `ka_banks` VALUES (18, '翡翠城社区支行', 37);
INSERT INTO `ka_banks` VALUES (19, '橡树林社区支行', 37);
INSERT INTO `ka_banks` VALUES (20, '德盛苑社区支行', 37);
INSERT INTO `ka_banks` VALUES (21, '德阳分行', 37);
INSERT INTO `ka_banks` VALUES (22, '什邡支行', 37);
INSERT INTO `ka_banks` VALUES (23, '德阳和泰锦苑社区支行', 37);
INSERT INTO `ka_banks` VALUES (24, '德阳水印康桥社区支行', 37);
INSERT INTO `ka_banks` VALUES (25, '德阳太平洋国际社区支行', 37);
INSERT INTO `ka_banks` VALUES (26, '德阳万兴魅力城社区支行', 37);
INSERT INTO `ka_banks` VALUES (27, '广汉支行', 37);
INSERT INTO `ka_banks` VALUES (28, '什邡时代明珠社区支行', 37);
INSERT INTO `ka_banks` VALUES (29, '旌阳支行', 37);
INSERT INTO `ka_banks` VALUES (30, '都江堰支行', 37);
INSERT INTO `ka_banks` VALUES (31, '灌口社区支行', 37);
INSERT INTO `ka_banks` VALUES (32, '分行营业部', 37);
INSERT INTO `ka_banks` VALUES (33, '麓山国际社区支行', 37);
INSERT INTO `ka_banks` VALUES (34, '亲水湾社区支行', 37);
INSERT INTO `ka_banks` VALUES (35, '高新区支行', 37);
INSERT INTO `ka_banks` VALUES (36, '中海锦城社区支行', 37);
INSERT INTO `ka_banks` VALUES (37, '天府长城社区支行', 37);
INSERT INTO `ka_banks` VALUES (38, '广汉金雁明珠社区支行', 37);
INSERT INTO `ka_banks` VALUES (39, '红牌楼支行', 37);
INSERT INTO `ka_banks` VALUES (40, '碧云路社区支行', 37);
INSERT INTO `ka_banks` VALUES (41, '鹭岛国际社区支行', 37);
INSERT INTO `ka_banks` VALUES (42, '环球中心支行', 37);
INSERT INTO `ka_banks` VALUES (43, '华宇锦城名都社区支行', 37);
INSERT INTO `ka_banks` VALUES (44, '狮子山街办社区支行', 37);
INSERT INTO `ka_banks` VALUES (45, '金牛支行', 37);
INSERT INTO `ka_banks` VALUES (46, '金沙支行', 37);
INSERT INTO `ka_banks` VALUES (47, '同盛路社区支行', 37);
INSERT INTO `ka_banks` VALUES (48, '金沙云庭社区支行', 37);
INSERT INTO `ka_banks` VALUES (49, '金堂支行', 37);
INSERT INTO `ka_banks` VALUES (50, '锦江支行', 37);
INSERT INTO `ka_banks` VALUES (51, '新都马超路社区支行', 37);
INSERT INTO `ka_banks` VALUES (52, '锦都社区支行', 37);
INSERT INTO `ka_banks` VALUES (53, '新都保利198社区支行', 37);
INSERT INTO `ka_banks` VALUES (54, '新都双河鹭岛社区支行', 37);
INSERT INTO `ka_banks` VALUES (55, '外滩社区支行', 37);
INSERT INTO `ka_banks` VALUES (56, '乐山支行', 37);
INSERT INTO `ka_banks` VALUES (57, '峨眉山水晶广场', 37);
INSERT INTO `ka_banks` VALUES (58, '犍为鹭岛国际社区支行', 37);
INSERT INTO `ka_banks` VALUES (59, '翡翠国际社区支行', 37);
INSERT INTO `ka_banks` VALUES (60, '嘉州新城社区支行', 37);
INSERT INTO `ka_banks` VALUES (61, '莱佛士社区支行', 37);
INSERT INTO `ka_banks` VALUES (62, '亚马逊社区支行', 37);
INSERT INTO `ka_banks` VALUES (63, '西城国际社区支行', 37);
INSERT INTO `ka_banks` VALUES (64, '青果山花城社区支行', 37);
INSERT INTO `ka_banks` VALUES (65, '新广场社区支行', 37);
INSERT INTO `ka_banks` VALUES (66, '龙府花园社区支行', 37);
INSERT INTO `ka_banks` VALUES (67, '金税苑社区支行', 37);
INSERT INTO `ka_banks` VALUES (68, '东山国际社区支行', 37);
INSERT INTO `ka_banks` VALUES (69, '龙泉驿支行', 37);
INSERT INTO `ka_banks` VALUES (70, '霏红榭社区支行', 37);
INSERT INTO `ka_banks` VALUES (71, '十陵社区支行', 37);
INSERT INTO `ka_banks` VALUES (72, '泸州龙马大道社区支行', 37);
INSERT INTO `ka_banks` VALUES (73, '南光路社区支行', 37);
INSERT INTO `ka_banks` VALUES (74, '白招牌社区支行', 37);
INSERT INTO `ka_banks` VALUES (75, '泸州江阳支行', 37);
INSERT INTO `ka_banks` VALUES (76, '龙透关社区支行', 37);
INSERT INTO `ka_banks` VALUES (77, '泸州分行', 37);
INSERT INTO `ka_banks` VALUES (78, '绵阳支行', 37);
INSERT INTO `ka_banks` VALUES (79, '绵阳解放路社区支行', 37);
INSERT INTO `ka_banks` VALUES (80, '绵阳万达广场社区支行', 37);
INSERT INTO `ka_banks` VALUES (81, '绵阳奥林春天社区支行', 37);
INSERT INTO `ka_banks` VALUES (82, '绵阳长虹世纪城社区支行', 37);
INSERT INTO `ka_banks` VALUES (83, '绵阳江油小微支行', 37);
INSERT INTO `ka_banks` VALUES (84, '磨子桥支行', 37);
INSERT INTO `ka_banks` VALUES (85, '群众路社区支行', 37);
INSERT INTO `ka_banks` VALUES (86, '蓝光香江国际社区支行', 37);
INSERT INTO `ka_banks` VALUES (87, '南充分行', 37);
INSERT INTO `ka_banks` VALUES (88, '鹤鸣路社区支行', 37);
INSERT INTO `ka_banks` VALUES (89, '江天一色社区支行', 37);
INSERT INTO `ka_banks` VALUES (90, '春风玫瑰园社区支行', 37);
INSERT INTO `ka_banks` VALUES (91, '郫都支行', 37);
INSERT INTO `ka_banks` VALUES (92, '郫县中信未来城社区支行', 37);
INSERT INTO `ka_banks` VALUES (93, '郫都犀浦镇社区支行', 37);
INSERT INTO `ka_banks` VALUES (94, '金沙十年社区支行', 37);
INSERT INTO `ka_banks` VALUES (95, '青羊支行', 37);
INSERT INTO `ka_banks` VALUES (96, '盛畅园社区支行', 37);
INSERT INTO `ka_banks` VALUES (97, '瑞南街社区支行', 37);
INSERT INTO `ka_banks` VALUES (98, '人北支行', 37);
INSERT INTO `ka_banks` VALUES (99, '金域蓝湾社区支行', 37);
INSERT INTO `ka_banks` VALUES (100, '人民南路支行', 37);
INSERT INTO `ka_banks` VALUES (101, '中华名园社区支行', 37);
INSERT INTO `ka_banks` VALUES (102, '西府少城社区支行', 37);
INSERT INTO `ka_banks` VALUES (103, '中海名城社区支行', 37);
INSERT INTO `ka_banks` VALUES (104, '置信丽都花园城社区支行', 37);
INSERT INTO `ka_banks` VALUES (105, '中海国际社区支行', 37);
INSERT INTO `ka_banks` VALUES (106, '锦官秀城社区支行', 37);
INSERT INTO `ka_banks` VALUES (107, '小天北街社区支行', 37);
INSERT INTO `ka_banks` VALUES (108, '沙湾支行', 37);
INSERT INTO `ka_banks` VALUES (109, '浅水半岛社区支行', 37);
INSERT INTO `ka_banks` VALUES (110, '双流支行', 37);
INSERT INTO `ka_banks` VALUES (111, '蓝光空港晶座社区支行', 37);
INSERT INTO `ka_banks` VALUES (112, '双楠支行', 37);
INSERT INTO `ka_banks` VALUES (113, '提督街支行', 37);
INSERT INTO `ka_banks` VALUES (114, '温江支行', 37);
INSERT INTO `ka_banks` VALUES (115, '温江永宁社区支行', 37);
INSERT INTO `ka_banks` VALUES (116, '武侯祠支行', 37);
INSERT INTO `ka_banks` VALUES (117, '金泽路社区支行', 37);
INSERT INTO `ka_banks` VALUES (118, '龙湖三千里社区支行', 37);
INSERT INTO `ka_banks` VALUES (119, '新华大道支行', 37);
INSERT INTO `ka_banks` VALUES (120, '前锋社区支行', 37);
INSERT INTO `ka_banks` VALUES (121, '紫竹广场社区支行', 37);
INSERT INTO `ka_banks` VALUES (122, '摩玛新城社区支行', 37);
INSERT INTO `ka_banks` VALUES (123, '宜宾分行', 37);
INSERT INTO `ka_banks` VALUES (124, '宜宾鼎业兴城社区支行', 37);
INSERT INTO `ka_banks` VALUES (125, '宜宾西区财富广场中心支行', 37);
INSERT INTO `ka_banks` VALUES (126, '宜宾江北五粮液大道支行', 37);
INSERT INTO `ka_banks` VALUES (127, '莱茵河畔社区支行', 37);
INSERT INTO `ka_banks` VALUES (128, '临港地中海蓝湾社区支行', 37);
INSERT INTO `ka_banks` VALUES (129, '石油路社区支行', 37);

-- ----------------------------
-- Table structure for ka_change_level
-- ----------------------------
DROP TABLE IF EXISTS `ka_change_level`;
CREATE TABLE `ka_change_level`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '兑换档次名称',
  `aid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动id',
  `sid` mediumint(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `as`(`aid`, `sid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ka_change_level
-- ----------------------------
INSERT INTO `ka_change_level` VALUES (5, '一等奖', 6, 31);
INSERT INTO `ka_change_level` VALUES (6, '二等奖', 6, 31);
INSERT INTO `ka_change_level` VALUES (7, '三等奖', 6, 31);
INSERT INTO `ka_change_level` VALUES (8, '100-1000元', 12, 31);
INSERT INTO `ka_change_level` VALUES (9, '1000-5000元', 12, 31);
INSERT INTO `ka_change_level` VALUES (10, '100-500', 16, 31);
INSERT INTO `ka_change_level` VALUES (11, '500-1000', 16, 31);
INSERT INTO `ka_change_level` VALUES (12, '100-500', 10, 31);
INSERT INTO `ka_change_level` VALUES (13, '500-1000', 10, 31);
INSERT INTO `ka_change_level` VALUES (14, '白金生日礼', 17, 33);
INSERT INTO `ka_change_level` VALUES (15, '钻石生日礼', 17, 33);
INSERT INTO `ka_change_level` VALUES (16, '白金招募礼', 17, 33);
INSERT INTO `ka_change_level` VALUES (17, '钻石招募礼', 17, 33);
INSERT INTO `ka_change_level` VALUES (18, '30元档', 28, 37);
INSERT INTO `ka_change_level` VALUES (19, '50元档', 28, 37);
INSERT INTO `ka_change_level` VALUES (20, '100元档', 28, 37);
INSERT INTO `ka_change_level` VALUES (21, '黄金级30积点', 29, 37);
INSERT INTO `ka_change_level` VALUES (22, '白金级50积点', 29, 37);
INSERT INTO `ka_change_level` VALUES (23, '黑金级100积点', 29, 37);
INSERT INTO `ka_change_level` VALUES (24, '100~500', 30, 37);
INSERT INTO `ka_change_level` VALUES (25, '500~1000', 30, 37);

-- ----------------------------
-- Table structure for ka_codes
-- ----------------------------
DROP TABLE IF EXISTS `ka_codes`;
CREATE TABLE `ka_codes`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `aid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动id',
  `level_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动兑换档次',
  `batch` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '兑换码批次编号',
  `code` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '兑换码',
  `code_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '二维码地址',
  `create_date` date NOT NULL COMMENT '创建日期',
  `create_time` datetime NOT NULL,
  `use_status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0:未使用  1:已使用  2:作废',
  `use_orderid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '兑换订单id',
  `use_time` datetime NULL DEFAULT NULL COMMENT '核销时间',
  `sid` mediumint(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `ag`(`aid`, `code`) USING BTREE,
  INDEX `alg`(`aid`, `level_id`, `code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 68 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_codes
-- ----------------------------
INSERT INTO `ka_codes` VALUES (1, 12, 8, '201810171828_12_1', 'JMMKOVOH', '/public/upload/ercode/201810171828_12_1/JMMKOVOH.png', '2018-10-17', '2018-10-17 18:28:19', 0, 0, NULL, 31);
INSERT INTO `ka_codes` VALUES (2, 12, 8, '201810171828_12_1', 'EEUBE1KD', '/public/upload/ercode/201810171828_12_1/EEUBE1KD.png', '2018-10-17', '2018-10-17 18:28:19', 1, 22, '2018-10-23 14:56:34', 31);
INSERT INTO `ka_codes` VALUES (3, 12, 8, '201810171828_12_1', 'BNDMWSTM', '/public/upload/ercode/201810171828_12_1/BNDMWSTM.png', '2018-10-17', '2018-10-17 18:28:19', 1, 26, '2018-10-24 10:55:54', 31);
INSERT INTO `ka_codes` VALUES (4, 12, 8, '201810171828_12_1', '77EBBZDE', '/public/upload/ercode/201810171828_12_1/77EBBZDE.png', '2018-10-17', '2018-10-17 18:28:19', 1, 25, '2018-10-23 18:44:42', 31);
INSERT INTO `ka_codes` VALUES (5, 12, 8, '201810171828_12_1', 'GNHGXK13', '/public/upload/ercode/201810171828_12_1/GNHGXK13.png', '2018-10-17', '2018-10-17 18:28:19', 1, 7, '2018-10-19 17:44:24', 31);
INSERT INTO `ka_codes` VALUES (6, 12, 8, '201810171828_12_1', 'TD3EB8QB', '/public/upload/ercode/201810171828_12_1/TD3EB8QB.png', '2018-10-17', '2018-10-17 18:28:19', 1, 6, '2018-10-19 17:12:27', 31);
INSERT INTO `ka_codes` VALUES (7, 12, 8, '201810171828_12_1', 'AVPFG5MD', '/public/upload/ercode/201810171828_12_1/AVPFG5MD.png', '2018-10-17', '2018-10-17 18:28:19', 1, 5, '2018-10-19 15:53:10', 31);
INSERT INTO `ka_codes` VALUES (8, 12, 8, '201810171828_12_1', 'PFXGKQ5J', '/public/upload/ercode/201810171828_12_1/PFXGKQ5J.png', '2018-10-17', '2018-10-17 18:28:19', 1, 4, '2018-10-18 14:50:06', 31);
INSERT INTO `ka_codes` VALUES (9, 12, 8, '201810171828_12_1', 'BKFBE3GK', '/public/upload/ercode/201810171828_12_1/BKFBE3GK.png', '2018-10-17', '2018-10-17 18:28:19', 1, 13, '2018-10-27 22:40:59', 31);
INSERT INTO `ka_codes` VALUES (10, 12, 8, '201810171828_12_1', 'ALKQSHXY', '/public/upload/ercode/201810171828_12_1/ALKQSHXY.png', '2018-10-17', '2018-10-17 18:28:19', 1, 10, '2018-10-25 13:11:05', 31);
INSERT INTO `ka_codes` VALUES (16, 17, 14, '201810201208_17_1', 'DYNOLFBD', '/public/upload/ercode/201810201208_17_1/DYNOLFBD.png', '2018-10-20', '2018-10-20 12:09:02', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (17, 17, 14, '201810201208_17_1', 'KH2ELFLW', '/public/upload/ercode/201810201208_17_1/KH2ELFLW.png', '2018-10-20', '2018-10-20 12:09:02', 1, 23, '2018-10-23 16:06:18', 33);
INSERT INTO `ka_codes` VALUES (18, 17, 14, '201810201208_17_1', 'QNNUM9J6', '/public/upload/ercode/201810201208_17_1/QNNUM9J6.png', '2018-10-20', '2018-10-20 12:09:02', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (19, 17, 14, '201810201208_17_1', 'SPQY6GMG', '/public/upload/ercode/201810201208_17_1/SPQY6GMG.png', '2018-10-20', '2018-10-20 12:09:02', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (20, 17, 14, '201810201208_17_1', 'X4HPH3G2', '/public/upload/ercode/201810201208_17_1/X4HPH3G2.png', '2018-10-20', '2018-10-20 12:09:02', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (23, 17, 15, '201810201209_17_2', 'GPOVJQJ4', '/public/upload/ercode/201810201209_17_2/GPOVJQJ4.png', '2018-10-20', '2018-10-20 12:09:14', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (24, 17, 15, '201810201209_17_2', 'G198EPKF', '/public/upload/ercode/201810201209_17_2/G198EPKF.png', '2018-10-20', '2018-10-20 12:09:14', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (25, 17, 15, '201810201209_17_2', 'ERRLDFGM', '/public/upload/ercode/201810201209_17_2/ERRLDFGM.png', '2018-10-20', '2018-10-20 12:09:14', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (26, 17, 15, '201810201209_17_2', '6MJCEJB2', '/public/upload/ercode/201810201209_17_2/6MJCEJB2.png', '2018-10-20', '2018-10-20 12:09:14', 1, 10, '2018-10-20 13:13:34', 33);
INSERT INTO `ka_codes` VALUES (27, 17, 15, '201810201209_17_2', 'B6UFONQR', '/public/upload/ercode/201810201209_17_2/B6UFONQR.png', '2018-10-20', '2018-10-20 12:09:14', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (30, 17, 16, '201810201209_17_3', 'LETJCN7C', '/public/upload/ercode/201810201209_17_3/LETJCN7C.png', '2018-10-20', '2018-10-20 12:09:26', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (31, 17, 16, '201810201209_17_3', 'YEJ2DAHN', '/public/upload/ercode/201810201209_17_3/YEJ2DAHN.png', '2018-10-20', '2018-10-20 12:09:26', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (32, 17, 16, '201810201209_17_3', 'KKT4XKD8', '/public/upload/ercode/201810201209_17_3/KKT4XKD8.png', '2018-10-20', '2018-10-20 12:09:26', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (33, 17, 16, '201810201209_17_3', 'JKJGQT9R', '/public/upload/ercode/201810201209_17_3/JKJGQT9R.png', '2018-10-20', '2018-10-20 12:09:26', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (34, 17, 16, '201810201209_17_3', 'RKH9RB4E', '/public/upload/ercode/201810201209_17_3/RKH9RB4E.png', '2018-10-20', '2018-10-20 12:09:26', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (37, 17, 17, '201810201209_17_4', '9KXDGYLR', '/public/upload/ercode/201810201209_17_4/9KXDGYLR.png', '2018-10-20', '2018-10-20 12:09:48', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (38, 17, 17, '201810201209_17_4', 'LVHOTPBN', '/public/upload/ercode/201810201209_17_4/LVHOTPBN.png', '2018-10-20', '2018-10-20 12:09:48', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (39, 17, 17, '201810201209_17_4', 'HKNGVLLB', '/public/upload/ercode/201810201209_17_4/HKNGVLLB.png', '2018-10-20', '2018-10-20 12:09:48', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (40, 17, 17, '201810201209_17_4', 'IQNUI3JC', '/public/upload/ercode/201810201209_17_4/IQNUI3JC.png', '2018-10-20', '2018-10-20 12:09:48', 0, 0, NULL, 33);
INSERT INTO `ka_codes` VALUES (41, 17, 17, '201810201209_17_4', 'WXTDHDKC', '/public/upload/ercode/201810201209_17_4/WXTDHDKC.png', '2018-10-20', '2018-10-20 12:09:48', 1, 50, '2018-11-06 14:29:27', 33);
INSERT INTO `ka_codes` VALUES (44, 30, 24, '201810291704_30_1', 'NQHDADE4', '/public/upload/ercode/201810291704_30_1/NQHDADE4.png', '2018-10-29', '2018-10-29 17:04:14', 2, 0, NULL, 37);
INSERT INTO `ka_codes` VALUES (45, 30, 24, '201810291704_30_1', 'TAWAE7EG', '/public/upload/ercode/201810291704_30_1/TAWAE7EG.png', '2018-10-29', '2018-10-29 17:04:14', 2, 0, NULL, 37);
INSERT INTO `ka_codes` VALUES (46, 30, 24, '201810291704_30_1', 'WMEKHR41', '/public/upload/ercode/201810291704_30_1/WMEKHR41.png', '2018-10-29', '2018-10-29 17:04:14', 2, 0, NULL, 37);
INSERT INTO `ka_codes` VALUES (47, 30, 24, '201810291704_30_1', 'EFJTN2AC', '/public/upload/ercode/201810291704_30_1/EFJTN2AC.png', '2018-10-29', '2018-10-29 17:04:14', 1, 40, '2018-10-31 17:49:54', 37);
INSERT INTO `ka_codes` VALUES (48, 30, 24, '201810291704_30_1', 'HAHN3HEE', '/public/upload/ercode/201810291704_30_1/HAHN3HEE.png', '2018-10-29', '2018-10-29 17:04:14', 1, 39, '2018-10-31 15:46:28', 37);
INSERT INTO `ka_codes` VALUES (49, 30, 24, '201810291704_30_1', 'JAEJDEFE', '/public/upload/ercode/201810291704_30_1/JAEJDEFE.png', '2018-10-29', '2018-10-29 17:04:14', 1, 37, '2018-10-31 15:39:18', 37);
INSERT INTO `ka_codes` VALUES (50, 30, 24, '201810291704_30_1', 'BEFXB1UB', '/public/upload/ercode/201810291704_30_1/BEFXB1UB.png', '2018-10-29', '2018-10-29 17:04:14', 1, 35, '2018-10-30 17:38:14', 37);
INSERT INTO `ka_codes` VALUES (51, 30, 24, '201810291704_30_1', 'FMMGXPKB', '/public/upload/ercode/201810291704_30_1/FMMGXPKB.png', '2018-10-29', '2018-10-29 17:04:14', 1, 32, '2018-10-30 15:40:08', 37);
INSERT INTO `ka_codes` VALUES (52, 30, 24, '201810291704_30_1', 'GGE5DEDZ', '/public/upload/ercode/201810291704_30_1/GGE5DEDZ.png', '2018-10-29', '2018-10-29 17:04:14', 1, 31, '2018-10-30 15:39:11', 37);
INSERT INTO `ka_codes` VALUES (53, 30, 24, '201810291704_30_1', 'CNU75ECT', '/public/upload/ercode/201810291704_30_1/CNU75ECT.png', '2018-10-29', '2018-10-29 17:04:14', 1, 27, '2018-10-30 14:32:11', 37);
INSERT INTO `ka_codes` VALUES (54, 30, 24, '201810301445_30_1', 'CBC_E3ZDGWAS', '/public/upload/ercode/201810301445_30_1/CBC_E3ZDGWAS.png', '2018-10-30', '2018-10-30 14:46:05', 0, 0, NULL, 37);
INSERT INTO `ka_codes` VALUES (55, 30, 25, '201810301540_30_2', 'BCB_UBFKAOLC', '/public/upload/ercode/201810301540_30_2/BCB_UBFKAOLC.png', '2018-10-30', '2018-10-30 15:40:44', 0, 0, NULL, 37);
INSERT INTO `ka_codes` VALUES (56, 30, 25, '201810301540_30_2', 'BCB_CMQMKK9Y', '/public/upload/ercode/201810301540_30_2/BCB_CMQMKK9Y.png', '2018-10-30', '2018-10-30 15:40:44', 1, 33, '2018-10-30 15:42:56', 37);
INSERT INTO `ka_codes` VALUES (57, 30, 24, '201811091420_30_1', 'QYSBLELZ', '/public/upload/ercode/201811091420_30_1/QYSBLELZ.png', '2018-11-09', '2018-11-09 14:20:47', 0, 0, NULL, 37);
INSERT INTO `ka_codes` VALUES (58, 30, 24, '201811091420_30_2', 'ABCOIPPW4JH', '/public/upload/ercode/201811091420_30_2/ABCOIPPW4JH.png', '2018-11-09', '2018-11-09 14:21:04', 1, 71, '2018-11-09 19:10:12', 37);
INSERT INTO `ka_codes` VALUES (59, 30, 24, '201811121127_30_1', 'LPQXNZOG', '/public/upload/ercode/201811121127_30_1/LPQXNZOG.png', '2018-11-12', '2018-11-12 11:28:59', 1, 72, '2018-11-12 11:37:25', 37);
INSERT INTO `ka_codes` VALUES (60, 32, 0, '201811121154_32_1', 'testD9HB389P', '/public/upload/ercode/201811121154_32_1/testD9HB389P.png', '2018-11-12', '2018-11-12 11:54:18', 1, 74, '2018-11-12 12:06:36', 37);
INSERT INTO `ka_codes` VALUES (61, 32, 0, '201811121154_32_1', 'test633GFP16', '/public/upload/ercode/201811121154_32_1/test633GFP16.png', '2018-11-12', '2018-11-12 11:54:18', 1, 73, '2018-11-12 11:55:02', 37);
INSERT INTO `ka_codes` VALUES (63, 32, 0, '201811121207_32_2', 'againGK3MZW9G', '/public/upload/ercode/201811121207_32_2/againGK3MZW9G.png', '2018-11-12', '2018-11-12 12:07:18', 1, 2, '2018-11-12 12:30:47', 37);
INSERT INTO `ka_codes` VALUES (64, 32, 0, '201811121207_32_2', 'againKHZNF3N1', '/public/upload/ercode/201811121207_32_2/againKHZNF3N1.png', '2018-11-12', '2018-11-12 12:07:18', 1, 1, '2018-11-12 12:30:10', 37);
INSERT INTO `ka_codes` VALUES (65, 32, 0, '201811121207_32_2', 'againFDLK5BLP', '/public/upload/ercode/201811121207_32_2/againFDLK5BLP.png', '2018-11-12', '2018-11-12 12:07:18', 1, 77, '2018-11-12 12:09:12', 37);
INSERT INTO `ka_codes` VALUES (66, 32, 0, '201811121207_32_2', 'againOCHSLBNZ', '/public/upload/ercode/201811121207_32_2/againOCHSLBNZ.png', '2018-11-12', '2018-11-12 12:07:18', 1, 76, '2018-11-12 12:08:23', 37);
INSERT INTO `ka_codes` VALUES (67, 32, 0, '201811121207_32_2', 'againSMVWXPKF', '/public/upload/ercode/201811121207_32_2/againSMVWXPKF.png', '2018-11-12', '2018-11-12 12:07:18', 1, 75, '2018-11-12 12:07:49', 37);

-- ----------------------------
-- Table structure for ka_goods
-- ----------------------------
DROP TABLE IF EXISTS `ka_goods`;
CREATE TABLE `ka_goods`  (
  `goods_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `cat_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类id',
  `goods_name` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_name_en` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `goods_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '商品价格',
  `goods_spu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规格属性',
  `goods_remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品简单描述',
  `goods_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '商品详细描述',
  `original_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品上传原始图',
  `is_on_sale` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0:下架  1:上架  2:上架但不显示',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `last_update` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后更新时间',
  PRIMARY KEY (`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_goods
-- ----------------------------
INSERT INTO `ka_goods` VALUES (1, 0, 'aaaa123456', 'bbbb123456', 0.00, '', 'dfasdfasf', '<p>dfasfdaffdasfda<br/></p>', 'http://l.bank.cn/public/upload/goods/2018/09-28/e062a82296e7e3f4f39c16916e36df32.png', 3, 0, 1538107845);
INSERT INTO `ka_goods` VALUES (2, 1, 'ccceee', 'ga', 20.00, 'dfsfdd', 'dfasdfadfasdfa', '<p>dfasfd<br/></p>', 'http://l.bank.cn/public/upload/goods/2018/09-28/a60927e4a1dcf291e6587dcd48e2fc4e.png', 3, 0, 1539158054);
INSERT INTO `ka_goods` VALUES (3, 1, 'hhhh', 'bbb', 5.00, 'dfasdfasfdaf', 'dfdddeeee', '<p><img src=\"/public/upload/ueditor/image/20181015/1539593915286548.jpg\" title=\"1539593915286548.jpg\" alt=\"u=200522347,1824897008&amp;fm=26&amp;gp=0.jpg\"/></p><p>这是商品详情</p><p><img src=\"/public/upload/ueditor/image/20181015/1539593931100492.jpg\" title=\"1539593931100492.jpg\"/></p><p><img src=\"/public/upload/ueditor/image/20181015/1539593931364694.png\" title=\"1539593931364694.png\"/></p><p><img src=\"/public/upload/ueditor/image/20181015/1539593931787911.png\" title=\"1539593931787911.png\"/></p><p><br/></p>', 'http://www.bank.com/public/upload/goods/2018/10-15/f5dde2edc242000537c58e2bc9502773.jpg', 3, 1538107908, 1539593947);
INSERT INTO `ka_goods` VALUES (4, 1, 'TEST', '', 0.90, '10', 'TESTTESTTEST', '<p>TESTTESTTESTTEST</p>', 'http://www.bank.com/public/upload/goods/2018/10-10/6c3139fe5eb6d3f784a176adf3cfa8e8.png', 3, 1539156217, 1539158041);
INSERT INTO `ka_goods` VALUES (5, 4, '苏泊尔（SUPOR）电饭煲电饭锅', '', 299.00, '', '4L容量球釜内胆拉丝不锈钢机身', '<p><img src=\"/public/upload/ueditor/image/20181017/1539761786764809.png\" title=\"1539761786764809.png\"/></p><p><img src=\"/public/upload/ueditor/image/20181017/1539761786126114.png\" title=\"1539761786126114.png\"/></p><p><img src=\"/public/upload/ueditor/image/20181017/1539761786698605.png\" title=\"1539761786698605.png\"/></p><p><img src=\"/public/upload/ueditor/image/20181017/1539761787468956.png\" title=\"1539761787468956.png\"/></p><p><img src=\"/public/upload/ueditor/image/20181017/1539761787609481.png\" title=\"1539761787609481.png\"/><br/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-17/a2ccafcf047e73b9d04b122ad80f293a.jpg', 3, 1539761791, 1539769641);
INSERT INTO `ka_goods` VALUES (6, 7, 'Apple iPad mini 4', '平板电脑 7.9英寸（128G WLAN版/A8芯片/Retina显示屏/Touch ID技术 MK9Q2CH）金色', 2799.00, '', '平板电脑 7.9英寸（128G WLAN版/A8芯片/Retina显示屏/Touch ID技术 MK9Q2CH）金色', '<p><img src=\"/public/upload/ueditor/image/20181017/1539769528935658.jpg\" title=\"1539769528935658.jpg\" alt=\"详情1.jpg\"/><br/><img src=\"/public/upload/ueditor/image/20181017/1539769535440461.jpg\" title=\"1539769535440461.jpg\" alt=\"详情2.jpg\"/><br/><img src=\"/public/upload/ueditor/image/20181017/1539769546244417.jpg\" title=\"1539769546244417.jpg\" alt=\"详情3.jpg\"/><br/><img src=\"/public/upload/ueditor/image/20181017/1539769552341294.jpg\" title=\"1539769552341294.jpg\" alt=\"详情4.jpg\"/><br/><img src=\"/public/upload/ueditor/image/20181017/1539769558260472.jpg\" title=\"1539769558260472.jpg\" alt=\"详情5.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-17/021f4e0dd70d7e2212084d0a1ac6a469.jpg', 3, 1539769567, 1539769567);
INSERT INTO `ka_goods` VALUES (7, 12, '德福隆壹品珍菌风味套装', '', 299.00, '', '德福隆壹品珍菌风味套装', '<p><img src=\"/public/upload/ueditor/image/20181020/1540005801825579.jpg\" title=\"1540005801825579.jpg\" alt=\"640德福隆壹品珍菌风味套装 拷贝.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/a3a13e7aa2b527094fa25fc8f4ba5982.jpg', 1, 1540005860, 1540005860);
INSERT INTO `ka_goods` VALUES (8, 12, '中粮福临门金盈珍粹杂粮礼盒', '', 299.00, '', '中粮福临门金盈珍粹杂粮礼盒', '<p><img src=\"/public/upload/ueditor/image/20181020/1540005924967059.jpg\" title=\"1540005924967059.jpg\" alt=\"640中粮福临门金盈珍粹杂粮礼盒 拷贝.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/e3ff4691b703df9dbf63a9db47a339bc.jpg', 1, 1540005929, 1540005929);
INSERT INTO `ka_goods` VALUES (9, 12, '中粮时怡每日坚果礼盒', '', 299.00, '', '中粮时怡每日坚果礼盒', '<p><img src=\"/public/upload/ueditor/image/20181020/1540005977203015.jpg\" title=\"1540005977203015.jpg\" alt=\"640中粮时怡每日坚果礼盒 拷贝.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/a70b72c528cc443e98ae250547505fda.jpg', 1, 1540005982, 1540005982);
INSERT INTO `ka_goods` VALUES (10, 12, '百草味金玉满堂礼盒', '', 499.00, '', '百草味金玉满堂礼盒', '<p><img src=\"/public/upload/ueditor/image/20181020/1540006040402065.jpg\" title=\"1540006040402065.jpg\" alt=\"640百草味金玉满堂礼盒.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-23/6c1b9a83511971aa586460e2bcbaf042.jpg', 1, 1540006052, 1540280353);
INSERT INTO `ka_goods` VALUES (11, 12, '中粮安荟堂物华天宝山珍礼盒', '', 499.00, '', '中粮安荟堂物华天宝山珍礼盒', '<p><img src=\"/public/upload/ueditor/image/20181020/1540006088959295.jpg\" title=\"1540006088959295.jpg\" alt=\"640中粮安荟堂物华天宝山珍礼盒 拷贝.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/51c04d3aaaaa5fbeada636a32c14172b.jpg', 1, 1540006099, 1540006099);
INSERT INTO `ka_goods` VALUES (12, 12, '德福隆有机杂粮礼盒', 'test', 499.00, '', '德福隆有机杂粮礼盒', '<p><img src=\"/public/upload/ueditor/image/20181020/1540006143976404.jpg\" title=\"1540006143976404.jpg\" alt=\"640德福隆有机杂粮礼盒 拷贝.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/55eb18097ebe5901f1e7b174f464badf.jpg', 1, 1540006148, 1540883315);
INSERT INTO `ka_goods` VALUES (13, 12, '新疆库尔勒香梨', '', 299.00, '', '新疆库尔勒香梨', '<p><img title=\"1540691865740463.jpg\" alt=\"香梨-缩小图.jpg\" src=\"/public/upload/ueditor/image/20181028/1540691865740463.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/f51cd52fdabf96e297eebbb8e6bbb35a.jpg', 1, 1540007548, 1540691875);
INSERT INTO `ka_goods` VALUES (14, 12, '新西兰佳沛金奇异果', '', 499.00, '', '新西兰佳沛金奇异果', '<p><img title=\"1540692629917374.jpg\" alt=\"金果-缩小图.jpg\" src=\"/public/upload/ueditor/image/20181028/1540692629917374.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/c22b0fa201b282bcc3d14d3bcbf07082.jpg', 1, 1540007692, 1540692663);
INSERT INTO `ka_goods` VALUES (15, 12, '软籽石榴（尊享装）', '', 499.00, '', '软籽石榴（尊享装）', '<p><img src=\"/public/upload/ueditor/image/20181020/1540007733134723.jpg\" title=\"1540007733134723.jpg\" alt=\"2.jpg\"/><img src=\"/public/upload/ueditor/image/20181020/1540007737796478.jpg\" title=\"1540007737796478.jpg\" alt=\"3.jpg\"/><img src=\"/public/upload/ueditor/image/20181020/1540007741315569.jpg\" title=\"1540007741315569.jpg\" alt=\"4.jpg\"/><img src=\"/public/upload/ueditor/image/20181020/1540007744639216.jpg\" title=\"1540007744639216.jpg\" alt=\"5.jpg\"/><img src=\"/public/upload/ueditor/image/20181020/1540007747328007.jpg\" title=\"1540007747328007.jpg\" alt=\"6.jpg\"/><img src=\"/public/upload/ueditor/image/20181020/1540007750300206.jpg\" title=\"1540007750300206.jpg\" alt=\"7.jpg\"/><img src=\"/public/upload/ueditor/image/20181020/1540007754109156.jpg\" title=\"1540007754109156.jpg\" alt=\"8.jpg\"/><img src=\"/public/upload/ueditor/image/20181020/1540007757918249.jpg\" title=\"1540007757918249.jpg\" alt=\"9.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/76f1972391759943b5c81ced8db82493.jpg', 1, 1540007759, 1540007759);
INSERT INTO `ka_goods` VALUES (16, 13, '斯密欧 丹尼尔弹跳杯', 'MR027-450', 148.00, '', 'MR027-450', '<p><img src=\"/public/upload/ueditor/image/20181024/1540353293696829.jpg\" title=\"1540353293696829.jpg\" alt=\"丹尼尔弹跳杯（MR027-450）-长图-缩小.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/93f4f7ca8a50be637282fb9ddabe7b3f.jpg', 1, 1540353332, 1540353332);
INSERT INTO `ka_goods` VALUES (17, 6, '万德霍 天作之合汤蒸锅', '天作之合', 108.00, '', '万德霍天作之合汤蒸锅', '<p><img src=\"/public/upload/ueditor/image/20181024/1540361727747207.jpg\" title=\"1540361727747207.jpg\" alt=\"万德霍天作之合汤蒸锅-长图-1-缩小.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361739224280.jpg\" title=\"1540361739224280.jpg\" alt=\"万德霍天作之合汤蒸锅-长图-2-缩小.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/387d264b48c24d198afd94beeffca076.jpg', 1, 1540361742, 1540362775);
INSERT INTO `ka_goods` VALUES (18, 14, '折叠双肩包（颜色随机）', '折叠双肩包', 96.00, '', '折叠双肩包', '<p><img src=\"/public/upload/ueditor/image/20181024/1540361842770475.gif\" title=\"1540361842770475.gif\" alt=\"详情图 (1).gif\"/><img src=\"/public/upload/ueditor/image/20181024/1540361847609820.jpg\" title=\"1540361847609820.jpg\" alt=\"详情图 (1).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361851106280.jpg\" title=\"1540361851106280.jpg\" alt=\"详情图 (2).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361855925996.jpg\" title=\"1540361855925996.jpg\" alt=\"详情图 (3).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361859523132.jpg\" title=\"1540361859523132.jpg\" alt=\"详情图 (4).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361869179290.jpg\" title=\"1540361869179290.jpg\" alt=\"详情图 (5).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361873576183.jpg\" title=\"1540361873576183.jpg\" alt=\"详情图 (6).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361876266731.jpg\" title=\"1540361876266731.jpg\" alt=\"详情图 (7).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361881327774.jpg\" title=\"1540361881327774.jpg\" alt=\"详情图 (8).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361962815095.jpg\" title=\"1540361962815095.jpg\" alt=\"详情图 (9).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361968889355.jpg\" title=\"1540361968889355.jpg\" alt=\"详情图 (10).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361973496290.jpg\" title=\"1540361973496290.jpg\" alt=\"详情图 (11).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361976236940.jpg\" title=\"1540361976236940.jpg\" alt=\"详情图 (12).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361981154220.jpg\" title=\"1540361981154220.jpg\" alt=\"详情图 (13).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361984901847.jpg\" title=\"1540361984901847.jpg\" alt=\"详情图 (14).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361991797101.jpg\" title=\"1540361991797101.jpg\" alt=\"详情图 (15).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540361996113377.jpg\" title=\"1540361996113377.jpg\" alt=\"详情图 (16).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362000795858.jpg\" title=\"1540362000795858.jpg\" alt=\"详情图 (17).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362004483009.jpg\" title=\"1540362004483009.jpg\" alt=\"详情图 (18).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362009209896.jpg\" title=\"1540362009209896.jpg\" alt=\"详情图 (19).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362012422207.jpg\" title=\"1540362012422207.jpg\" alt=\"详情图 (20).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362018918231.jpg\" title=\"1540362018918231.jpg\" alt=\"详情图 (21).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362022857193.jpg\" title=\"1540362022857193.jpg\" alt=\"详情图 (22).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362025986107.jpg\" title=\"1540362025986107.jpg\" alt=\"详情图 (23).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362029354834.jpg\" title=\"1540362029354834.jpg\" alt=\"详情图 (24).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362033350998.jpg\" title=\"1540362033350998.jpg\" alt=\"详情图 (25).jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540362038598971.png\" title=\"1540362038598971.png\" alt=\"详情图（26）.png\"/><img src=\"/public/upload/ueditor/image/20181024/1540362048659594.png\" title=\"1540362048659594.png\" alt=\"详情图（27）.png\"/><img src=\"/public/upload/ueditor/image/20181024/1540362054129202.png\" title=\"1540362054129202.png\" alt=\"详情图（28）.png\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/3ac4aca65a41039f94390b8a22a17330.jpg', 1, 1540362058, 1540437480);
INSERT INTO `ka_goods` VALUES (19, 6, '赫曼德 小米兰厨房五件套', 'HM-ML002', 88.00, '', 'HM-ML002', '<p><img src=\"/public/upload/ueditor/image/20181024/1540362159895276.jpg\" title=\"1540362159895276.jpg\" alt=\"厨房五件套-长图-缩小.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/52b13eb98c5efccd9a1347d89430c665.jpg', 1, 1540362166, 1540362166);
INSERT INTO `ka_goods` VALUES (20, 15, '内野 古系列毛巾1条装', 'JD5325-N-I', 58.00, '', 'JD5325-N-I', '<p><img src=\"/public/upload/ueditor/image/20181024/1540362255669770.jpg\" title=\"1540362255669770.jpg\" alt=\"内野古系列1条装（粉白色）（JD5325-N-I）-长图.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/7f11f3d6dd7c77da66e7c2d833e4132f.jpg', 1, 1540362262, 1540362262);
INSERT INTO `ka_goods` VALUES (21, 6, 'I Do 香草物语双层保温餐桶', 'FU-E51', 218.00, '', 'FU-E51', '<p><img src=\"/public/upload/ueditor/image/20181024/1540362353258409.jpg\" title=\"1540362353258409.jpg\" alt=\"I Do香草物语双层保温餐桶（FU-E51）-长图.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/5f5a63bd8dc327271f2dc2eef34ba596.jpg', 1, 1540362360, 1540362360);
INSERT INTO `ka_goods` VALUES (22, 17, '乐扣乐扣 法兰绒盖毯', 'HLW516KKIFU', 80.00, '', 'HLW516KKIFU', '<p><img src=\"/public/upload/ueditor/image/20181024/1540362626136367.jpg\" title=\"1540362626136367.jpg\" alt=\"乐扣乐扣法兰绒盖毯（HLW516KKIFU）-长图-缩小.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/9ed907055ab41af67424653f45a3ad8e.jpg', 1, 1540362634, 1540362765);
INSERT INTO `ka_goods` VALUES (23, 6, '乐美雅 特瑞欧餐具7件套', 'N5124', 148.00, '', 'N5124', '<p><img src=\"/public/upload/ueditor/image/20181024/1540362750706576.jpg\" title=\"1540362750706576.jpg\" alt=\"特瑞欧餐具7件套（N5124）-长图.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/b0f627b733def6fa954951cc7b65f4dc.jpg', 1, 1540362756, 1540362756);
INSERT INTO `ka_goods` VALUES (24, 16, '酷龙达 单把折叠椅', 'CLDY-06', 99.00, '', 'CLDY-06', '<p><img src=\"/public/upload/ueditor/image/20181025/1540437645812872.jpg\" title=\"1540437645812872.jpg\" alt=\"酷龙达单把折叠椅（CLDY-06）-长图-缩小.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/8819f73b45eb75b286eb89c5efb0fcc1.jpg', 1, 1540362871, 1540438597);
INSERT INTO `ka_goods` VALUES (25, 17, '绮露 太空记忆枕', 'QL-Z1505', 308.00, '', 'QL-Z1505', '<p><img src=\"/public/upload/ueditor/image/20181024/1540362942197382.jpg\" title=\"1540362942197382.jpg\" alt=\"太空记忆枕-长图-缩小.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/87637dcf328e580d3566ecd59312e907.jpg', 1, 1540362950, 1540363037);
INSERT INTO `ka_goods` VALUES (26, 18, '乐扣乐扣 美体机械人体秤', 'LSC-A07FU', 108.00, '', 'LSC-A07FU', '<p><img src=\"/public/upload/ueditor/image/20181024/1540363021569962.jpg\" title=\"1540363021569962.jpg\" alt=\"乐扣乐扣美体机械人体秤（LSC-A07FU）-长图.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/a0c053509d6dc8d1dfa2b2f5c733b704.jpg', 1, 1540363030, 1540363030);
INSERT INTO `ka_goods` VALUES (27, 16, '户外懒人沙发（颜色随机）', 'CL-LR01', 168.00, '', 'CL-LR01', '<p><img src=\"/public/upload/ueditor/image/20181024/1540363104192679.jpg\" title=\"1540363104192679.jpg\" alt=\"户外懒人沙发-长图-缩小.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/5104a7876b32348c86a3e6948305a047.jpg', 1, 1540363115, 1540438490);
INSERT INTO `ka_goods` VALUES (28, 16, '单层双人帐篷（颜色随机）', 'CLD-ZP001', 198.00, '', 'CLD-ZP001', '<p><img src=\"/public/upload/ueditor/image/20181024/1540363173866121.jpg\" title=\"1540363173866121.jpg\" alt=\"单层双人帐篷-长图-缩小-1.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363185681790.jpg\" title=\"1540363185681790.jpg\" alt=\"单层双人帐篷-长图-缩小-2.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/4e44e42ee4454af61db474f710e6f897.jpg', 1, 1540363197, 1540438480);
INSERT INTO `ka_goods` VALUES (29, 17, 'KENZO 虎头毯', 'KRT-005S', 690.00, '', 'KRT-005S', '<p><img src=\"/public/upload/ueditor/image/20181024/1540363267170801.jpg\" title=\"1540363267170801.jpg\" alt=\"KENZO 虎头毯（蓝）-长图-缩小.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/d98ffd595ee633bb4ec6a3ca5fe33de6.jpg', 1, 1540363278, 1540363278);
INSERT INTO `ka_goods` VALUES (30, 1, '伊莱克斯 电炖锅', 'EGSC250', 428.00, '', 'EGSC250', '<p><img src=\"/public/upload/ueditor/image/20181024/1540363338832130.jpg\" title=\"1540363338832130.jpg\" alt=\"伊莱克斯True-love电炖锅-长图-缩小.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/466d586480057ddd224be285ebf4f0cc.jpg', 1, 1540363345, 1540438467);
INSERT INTO `ka_goods` VALUES (31, 1, '惠而浦 手持挂烫机', 'WS-JM1701B', 379.00, '', 'WS-JM1701B', '<p><img src=\"/public/upload/ueditor/image/20181024/1540363400910690.jpg\" title=\"1540363400910690.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-1.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363407594963.jpg\" title=\"1540363407594963.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-2.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363411947503.jpg\" title=\"1540363411947503.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-3.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363415614558.jpg\" title=\"1540363415614558.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-4.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363418121865.jpg\" title=\"1540363418121865.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-5.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363422471636.jpg\" title=\"1540363422471636.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-6.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363426893250.jpg\" title=\"1540363426893250.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-7.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363432252144.jpg\" title=\"1540363432252144.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-8.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363454875309.jpg\" title=\"1540363454875309.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-9.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363458991005.jpg\" title=\"1540363458991005.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-10.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363461455228.jpg\" title=\"1540363461455228.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-11.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363464336128.jpg\" title=\"1540363464336128.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-12.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363467936981.jpg\" title=\"1540363467936981.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-13.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363471148214.jpg\" title=\"1540363471148214.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-14.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363474890427.jpg\" title=\"1540363474890427.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-15.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363478210181.jpg\" title=\"1540363478210181.jpg\" alt=\"手持挂烫机（WS-JM1701B）-长图-16.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/bbf3a85ec4b139b5af8c3a533979d934.jpg', 1, 1540363483, 1540363483);
INSERT INTO `ka_goods` VALUES (32, 1, '欧慕 滴漏式咖啡茶饮机', 'NKF6002', 199.00, '', 'NKF6002', '<p><img src=\"/public/upload/ueditor/image/20181024/1540363586900018.jpg\" title=\"1540363586900018.jpg\" alt=\"滴漏式咖啡茶饮机（NKF6002）-长图-缩小-1.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363593159529.jpg\" title=\"1540363593159529.jpg\" alt=\"滴漏式咖啡茶饮机（NKF6002）-长图-缩小-2.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363597398100.jpg\" title=\"1540363597398100.jpg\" alt=\"滴漏式咖啡茶饮机（NKF6002）-长图-缩小-3.jpg\"/><img src=\"/public/upload/ueditor/image/20181024/1540363601902823.jpg\" title=\"1540363601902823.jpg\" alt=\"滴漏式咖啡茶饮机（NKF6002）-长图-缩小-4.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/6c4c11875e38ec42723baf9fc162ad59.jpg', 1, 1540363623, 1540455616);
INSERT INTO `ka_goods` VALUES (33, 0, 'test', '', 12.00, '', 'test', '<p>test<br/></p>', 'http://www.bank.com/public/upload/goods/2018/10-25/64827c836df99a787939b5472ddbce43.png', 3, 1540443240, 1540443240);
INSERT INTO `ka_goods` VALUES (34, 0, 'test', '', 12.00, '', 'test', '<p>test</p>', 'http://www.bank.com/public/upload/goods/2018/10-25/bd54d0a718333af419b4e9bcc595b1c9.png', 3, 1540443372, 1540443372);
INSERT INTO `ka_goods` VALUES (35, 0, 'test', '', 12.00, '', 'test', '<p>test</p>', 'http://www.bank.com/public/upload/goods/2018/10-25/9bfc19b1f5aa8668979ff36a459953b0.png', 3, 1540443456, 1540443456);
INSERT INTO `ka_goods` VALUES (36, 0, 'test', '', 12.00, '', 'test', '<p>test</p>', 'http://www.bank.com/public/upload/goods/2018/10-25/086cdf3dbee06daf9d2feb58bbe804e1.png', 3, 1540443579, 1540443579);
INSERT INTO `ka_goods` VALUES (37, 0, 'test', '', 12.00, '', 'test', '<p>test</p>', 'http://www.bank.com/public/upload/goods/2018/10-25/086cdf3dbee06daf9d2feb58bbe804e1.png', 3, 1540443580, 1540443580);
INSERT INTO `ka_goods` VALUES (38, 0, 'test', '', 12.00, '', 'test', '<p>test</p>', 'http://www.bank.com/public/upload/goods/2018/10-25/795310f2b5bea593b79828b83d68e7d2.png', 3, 1540443948, 1540443948);
INSERT INTO `ka_goods` VALUES (39, 0, 'test', '', 12.00, '', 'test', '<p>test</p>', 'http://www.bank.com/public/upload/goods/2018/10-25/f7f58d149afbcfffcb165f773f03eda5.jpg', 3, 1540443969, 1540443969);
INSERT INTO `ka_goods` VALUES (40, 0, 'test', '', 12.00, '', 'test', '<p>test</p>', 'http://www.bank.com/public/upload/goods/2018/10-25/f7f58d149afbcfffcb165f773f03eda5.jpg', 3, 1540443970, 1540443970);
INSERT INTO `ka_goods` VALUES (41, 0, 'test', '', 12.00, '', 'test', '<p>test</p>', 'http://www.bank.com/public/upload/goods/2018/10-25/a0b64abb757a7699f563600b3e12be58.jpg', 3, 1540444032, 1540444032);
INSERT INTO `ka_goods` VALUES (42, 12, '褚橙 11月下旬上市 勿兑换', '', 299.00, '', '褚橙', '<p><img title=\"1540693045637576.jpg\" alt=\"褚橙-缩小图-1.jpg\" src=\"/public/upload/ueditor/image/20181028/1540693045637576.jpg\"/><img title=\"1540693052256609.jpg\" alt=\"褚橙-缩小图-2.jpg\" src=\"/public/upload/ueditor/image/20181028/1540693052256609.jpg\"/></p>', 'http://ex.li99.com.cn/public/upload/goods/2018/10-28/84a134fb84f8ddc1b62032709f19cb8c.jpg', 1, 1540693057, 1540693632);
INSERT INTO `ka_goods` VALUES (43, 1, '测试商品test', 'TEST_01', 199.00, '', 'test测试商品test测试商品test测试商品', '<p><img src=\"/public/upload/ueditor/image/20181029/1540797951713251.png\" title=\"1540797951713251.png\"/></p><p><img src=\"/public/upload/ueditor/image/20181029/1540797951622712.png\" title=\"1540797951622712.png\"/></p><p><img src=\"/public/upload/ueditor/image/20181029/1540797951265032.png\" title=\"1540797951265032.png\"/></p><p><img src=\"/public/upload/ueditor/image/20181029/1540797951120351.png\" title=\"1540797951120351.png\"/></p><p><img src=\"/public/upload/ueditor/image/20181029/1540797951212749.png\" title=\"1540797951212749.png\"/></p><p><br/></p>', 'http://www.bank.com/public/upload/goods/2018/10-29/42ba1fe003bcb03eb57b74e5d77f6172.jpg', 1, 1540797889, 1540797954);

-- ----------------------------
-- Table structure for ka_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `ka_goods_category`;
CREATE TABLE `ka_goods_category`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品分类id',
  `name` varchar(90) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品分类名称',
  `name_en` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `parent_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父id',
  `parent_id_path` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '家族图谱',
  `level` tinyint(1) NOT NULL DEFAULT 0 COMMENT '等级',
  `sort_order` tinyint(1) UNSIGNED NOT NULL DEFAULT 50 COMMENT '顺序排序',
  `is_show` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否显示',
  `is_hot` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否推荐为热门分类',
  `sid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_goods_category
-- ----------------------------
INSERT INTO `ka_goods_category` VALUES (1, '小电器', '', 0, '0_1', 1, 10, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (4, '家用电器', '', 0, '0_4', 1, 50, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (6, '厨具类', '', 0, '0_6', 1, 50, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (7, '数码电子', '', 0, '0_7', 1, 50, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (12, '食品类', '', 0, '0_12', 1, 50, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (13, '杯壶类', '', 0, '0_13', 1, 50, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (14, '箱包类', '', 0, '0_14', 1, 50, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (15, '纺织类', '', 0, '0_15', 1, 50, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (16, '户外用品', '', 0, '0_16', 1, 50, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (17, '床上用品', '', 0, '0_17', 1, 50, 1, 0, 0);
INSERT INTO `ka_goods_category` VALUES (18, '衡器类', '', 0, '0_18', 1, 50, 1, 0, 0);

-- ----------------------------
-- Table structure for ka_goods_imgs
-- ----------------------------
DROP TABLE IF EXISTS `ka_goods_imgs`;
CREATE TABLE `ka_goods_imgs`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `img_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片地址',
  `goods_id` int(10) UNSIGNED NOT NULL COMMENT '品牌id',
  `sid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `s`(`sid`) USING BTREE,
  INDEX `b`(`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_goods_imgs
-- ----------------------------
INSERT INTO `ka_goods_imgs` VALUES (8, 'http://ex.li99.com.cn/public/upload/goods/2018/10-17/2c52be1f12e65e82c3a614f609e8c408.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (9, 'http://ex.li99.com.cn/public/upload/goods/2018/10-17/c047593547d79a5a7697e9e9b2102d4c.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (10, 'http://ex.li99.com.cn/public/upload/goods/2018/10-17/021f4e0dd70d7e2212084d0a1ac6a469.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (11, 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/a3a13e7aa2b527094fa25fc8f4ba5982.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (12, 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/e3ff4691b703df9dbf63a9db47a339bc.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (13, 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/a70b72c528cc443e98ae250547505fda.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (14, 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/23e38e6d5fba006c38218c8dfd6d0985.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (15, 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/51c04d3aaaaa5fbeada636a32c14172b.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (16, 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/55eb18097ebe5901f1e7b174f464badf.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (17, 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/f51cd52fdabf96e297eebbb8e6bbb35a.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (18, 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/c22b0fa201b282bcc3d14d3bcbf07082.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (19, 'http://ex.li99.com.cn/public/upload/goods/2018/10-20/76f1972391759943b5c81ced8db82493.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (20, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/93f4f7ca8a50be637282fb9ddabe7b3f.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (21, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/387d264b48c24d198afd94beeffca076.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (22, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/1980768b9ad824bc8d0dcf976fa764ac.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (23, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/52b13eb98c5efccd9a1347d89430c665.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (24, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/7f11f3d6dd7c77da66e7c2d833e4132f.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (25, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/5f5a63bd8dc327271f2dc2eef34ba596.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (26, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/9ed907055ab41af67424653f45a3ad8e.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (27, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/b0f627b733def6fa954951cc7b65f4dc.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (28, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/8819f73b45eb75b286eb89c5efb0fcc1.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (29, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/87637dcf328e580d3566ecd59312e907.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (30, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/a0c053509d6dc8d1dfa2b2f5c733b704.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (31, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/5104a7876b32348c86a3e6948305a047.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (32, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/4e44e42ee4454af61db474f710e6f897.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (33, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/d98ffd595ee633bb4ec6a3ca5fe33de6.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (34, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/466d586480057ddd224be285ebf4f0cc.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (35, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/bbf3a85ec4b139b5af8c3a533979d934.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (36, 'http://ex.li99.com.cn/public/upload/goods/2018/10-24/6c4c11875e38ec42723baf9fc162ad59.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (37, 'http://www.bank.com/public/upload/goods/2018/10-25/64827c836df99a787939b5472ddbce43.png', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (38, 'http://www.bank.com/public/upload/goods/2018/10-25/bd54d0a718333af419b4e9bcc595b1c9.png', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (39, 'http://www.bank.com/public/upload/goods/2018/10-25/9bfc19b1f5aa8668979ff36a459953b0.png', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (40, 'http://www.bank.com/public/upload/goods/2018/10-25/086cdf3dbee06daf9d2feb58bbe804e1.png', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (41, 'http://www.bank.com/public/upload/goods/2018/10-25/795310f2b5bea593b79828b83d68e7d2.png', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (42, 'http://www.bank.com/public/upload/goods/2018/10-25/f7f58d149afbcfffcb165f773f03eda5.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (43, 'http://www.bank.com/public/upload/goods/2018/10-25/a0b64abb757a7699f563600b3e12be58.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (44, 'http://ex.li99.com.cn/public/upload/goods/2018/10-28/84a134fb84f8ddc1b62032709f19cb8c.jpg', 0, 0);
INSERT INTO `ka_goods_imgs` VALUES (45, 'http://www.bank.com/public/upload/goods/2018/10-29/42ba1fe003bcb03eb57b74e5d77f6172.jpg', 0, 0);

-- ----------------------------
-- Table structure for ka_message_limit
-- ----------------------------
DROP TABLE IF EXISTS `ka_message_limit`;
CREATE TABLE `ka_message_limit`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `num` int(2) NOT NULL,
  `date` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `code` int(4) NULL DEFAULT NULL COMMENT '验证码',
  `expire_time` int(11) NULL DEFAULT NULL COMMENT '验证码过期时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ka_message_limit
-- ----------------------------
INSERT INTO `ka_message_limit` VALUES (1, '18130191539', 1, 1537501407, 1537545599, NULL, NULL);
INSERT INTO `ka_message_limit` VALUES (2, '13888888888', 1, 1538209662, 1538236799, NULL, NULL);
INSERT INTO `ka_message_limit` VALUES (3, '18140191539', 10, 1540440021, 1540483199, 123456, 1541761402);
INSERT INTO `ka_message_limit` VALUES (4, '18782985561', 3, 1540367233, 1540396799, NULL, NULL);
INSERT INTO `ka_message_limit` VALUES (5, '18981940330', 2, 1540438099, 1540483199, 1478, 1540651243);
INSERT INTO `ka_message_limit` VALUES (6, '15982106350', 2, 1540438298, 1540483199, 3529, 1540690652);
INSERT INTO `ka_message_limit` VALUES (7, '13982124142', 1, 1540432859, 1540483199, 5880, 1540776723);
INSERT INTO `ka_message_limit` VALUES (8, '18080929722', 1, 1540385797, 1540396799, NULL, NULL);
INSERT INTO `ka_message_limit` VALUES (9, '15682106350', 1, 1540389013, 1540396799, NULL, NULL);
INSERT INTO `ka_message_limit` VALUES (10, '13032880424', 3, 1540435492, 1540483199, NULL, NULL);
INSERT INTO `ka_message_limit` VALUES (11, '13678132593', 1, 1540707456, 1540742399, 6403, 1540707516);
INSERT INTO `ka_message_limit` VALUES (12, '18140191530', 1, 1541491284, 1541519999, 123456, 1541493680);

-- ----------------------------
-- Table structure for ka_orders
-- ----------------------------
DROP TABLE IF EXISTS `ka_orders`;
CREATE TABLE `ka_orders`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_sn` char(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `goods_id` int(10) NOT NULL,
  `goods_num` mediumint(5) NOT NULL,
  `aid` int(10) NOT NULL,
  `create_time` datetime NOT NULL,
  `time` int(10) NOT NULL,
  `shipping_time` int(10) NOT NULL,
  `operator_id` int(10) NOT NULL,
  `shipping_id` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `sid` mediumint(5) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of ka_orders
-- ----------------------------
INSERT INTO `ka_orders` VALUES (1, '201811121230105353', 12, 1, 32, '2018-11-12 12:30:10', 1541997010, 0, 64, 78, 1, 37);
INSERT INTO `ka_orders` VALUES (2, '201811121230476202', 12, 1, 32, '2018-11-12 12:30:47', 1541997047, 0, 63, 79, 1, 37);

-- ----------------------------
-- Table structure for ka_sales_man
-- ----------------------------
DROP TABLE IF EXISTS `ka_sales_man`;
CREATE TABLE `ka_sales_man`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '销售经理姓名',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '所属支行id',
  `sid` mediumint(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `b`(`branch_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 141 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ka_sales_man
-- ----------------------------
INSERT INTO `ka_sales_man` VALUES (8, '张雪媛', '13683458286', 6, 37);
INSERT INTO `ka_sales_man` VALUES (7, '谭佳', '18981940330', 5, 32);
INSERT INTO `ka_sales_man` VALUES (4, '王迪', '18140191539', 2, 31);
INSERT INTO `ka_sales_man` VALUES (5, '王迪', '18140191539', 5, 32);
INSERT INTO `ka_sales_man` VALUES (6, '谭佳', '18981940330', 1, 31);
INSERT INTO `ka_sales_man` VALUES (9, '谭佳', '18981940330', 12, 37);
INSERT INTO `ka_sales_man` VALUES (10, '付彬杨', '13032880424', 12, 37);
INSERT INTO `ka_sales_man` VALUES (11, '黎力', '15982106350', 12, 37);
INSERT INTO `ka_sales_man` VALUES (12, '王迪', '18140191539', 12, 37);
INSERT INTO `ka_sales_man` VALUES (13, '郑克峰', '13982124142', 12, 37);
INSERT INTO `ka_sales_man` VALUES (14, '周宛枫', '15902858116', 7, 37);
INSERT INTO `ka_sales_man` VALUES (15, '杨玲', '15008287017', 8, 37);
INSERT INTO `ka_sales_man` VALUES (16, '伏三磊', '15196643369', 9, 37);
INSERT INTO `ka_sales_man` VALUES (17, '卢泽宇', '13666205007', 10, 37);
INSERT INTO `ka_sales_man` VALUES (18, '王冉', '13808085758', 11, 37);
INSERT INTO `ka_sales_man` VALUES (19, '王智琴', '13438275098', 13, 37);
INSERT INTO `ka_sales_man` VALUES (20, '余庆', '13880921594', 14, 37);
INSERT INTO `ka_sales_man` VALUES (21, '王玉林', '15208321658', 15, 37);
INSERT INTO `ka_sales_man` VALUES (22, '毛泽琴', '13308224113', 16, 37);
INSERT INTO `ka_sales_man` VALUES (23, '刘迷', '18280010305', 17, 37);
INSERT INTO `ka_sales_man` VALUES (24, '易琦', '13980083277', 18, 37);
INSERT INTO `ka_sales_man` VALUES (25, '李元兴', '13699065104', 19, 37);
INSERT INTO `ka_sales_man` VALUES (26, '王潇', '17381964007', 20, 37);
INSERT INTO `ka_sales_man` VALUES (27, '王彤羽', '18683677845', 21, 37);
INSERT INTO `ka_sales_man` VALUES (28, '文颖', '18683636990', 22, 37);
INSERT INTO `ka_sales_man` VALUES (29, '李雪', '13778203391', 23, 37);
INSERT INTO `ka_sales_man` VALUES (30, '周敏', '13550664486', 24, 37);
INSERT INTO `ka_sales_man` VALUES (31, '周静', '13981027814', 25, 37);
INSERT INTO `ka_sales_man` VALUES (32, '钟敏', '15283837120', 26, 37);
INSERT INTO `ka_sales_man` VALUES (33, '唐萍', '13890257330', 27, 37);
INSERT INTO `ka_sales_man` VALUES (34, '黄语萱', '18283873443', 28, 37);
INSERT INTO `ka_sales_man` VALUES (35, '胡佩琳', '13658108857', 29, 37);
INSERT INTO `ka_sales_man` VALUES (36, '文丹', '18602895676', 30, 37);
INSERT INTO `ka_sales_man` VALUES (37, '杨晗', '13551046041', 31, 37);
INSERT INTO `ka_sales_man` VALUES (38, '刘于嘉', '15283326352', 32, 37);
INSERT INTO `ka_sales_man` VALUES (39, '徐文婷', '15928858804', 33, 37);
INSERT INTO `ka_sales_man` VALUES (40, '袁德利', '18010600019', 34, 37);
INSERT INTO `ka_sales_man` VALUES (41, '孙珺捷', '18782297718', 35, 37);
INSERT INTO `ka_sales_man` VALUES (42, '陈苏珊', '15908148064', 36, 37);
INSERT INTO `ka_sales_man` VALUES (43, '杨诗琴', '15882314328', 37, 37);
INSERT INTO `ka_sales_man` VALUES (44, '李林蔚', '13881038195', 38, 37);
INSERT INTO `ka_sales_man` VALUES (47, '郑珊珊', '18628085033', 41, 37);
INSERT INTO `ka_sales_man` VALUES (46, '杨凤', '18982222687', 40, 37);
INSERT INTO `ka_sales_man` VALUES (48, '向乔楚', '13541051111', 42, 37);
INSERT INTO `ka_sales_man` VALUES (49, '杨城', '13540005593', 43, 37);
INSERT INTO `ka_sales_man` VALUES (50, '檀晋良', '13880002868', 44, 37);
INSERT INTO `ka_sales_man` VALUES (51, '关祖敏', '13518159683', 45, 37);
INSERT INTO `ka_sales_man` VALUES (52, '曾乐惠', '18080071002', 46, 37);
INSERT INTO `ka_sales_man` VALUES (53, '郭威', '18108061278', 47, 37);
INSERT INTO `ka_sales_man` VALUES (54, '邱诗', '18380116119', 48, 37);
INSERT INTO `ka_sales_man` VALUES (55, '周鸿梅', '13550330000', 49, 37);
INSERT INTO `ka_sales_man` VALUES (56, '曾靖', '13699065755', 50, 37);
INSERT INTO `ka_sales_man` VALUES (57, '邓逸夫', '18782931844', 51, 37);
INSERT INTO `ka_sales_man` VALUES (58, '张佳秋', '13980586395', 52, 37);
INSERT INTO `ka_sales_man` VALUES (59, '蒋奇玲', '13708070195', 53, 37);
INSERT INTO `ka_sales_man` VALUES (60, '曾玙', '18108152535', 54, 37);
INSERT INTO `ka_sales_man` VALUES (61, '周洁莹', '18380442572', 55, 37);
INSERT INTO `ka_sales_man` VALUES (62, '彭辞桥', '17711276307', 56, 37);
INSERT INTO `ka_sales_man` VALUES (63, '戈咏雪', '13696168882', 57, 37);
INSERT INTO `ka_sales_man` VALUES (64, '黄丽娟', '13890636412', 58, 37);
INSERT INTO `ka_sales_man` VALUES (65, '郭莹', '18683312899', 59, 37);
INSERT INTO `ka_sales_man` VALUES (66, '林潇瑜', '15283320552', 60, 37);
INSERT INTO `ka_sales_man` VALUES (67, '宋孟霞', '18683381303', 61, 37);
INSERT INTO `ka_sales_man` VALUES (68, '杨晓黎', '15983370222', 62, 37);
INSERT INTO `ka_sales_man` VALUES (69, '姜韬', '15283308321', 63, 37);
INSERT INTO `ka_sales_man` VALUES (70, '甄芳', '13540542627', 64, 37);
INSERT INTO `ka_sales_man` VALUES (71, '刘婕', '15808330331', 65, 37);
INSERT INTO `ka_sales_man` VALUES (72, '刘怡青', '18608025977', 66, 37);
INSERT INTO `ka_sales_man` VALUES (73, '张旭敏', '15882161159', 67, 37);
INSERT INTO `ka_sales_man` VALUES (74, '李梁晖', '13558721519', 68, 37);
INSERT INTO `ka_sales_man` VALUES (75, '刘豪杰', '18200123639', 69, 37);
INSERT INTO `ka_sales_man` VALUES (76, '武珺', '13060003094', 70, 37);
INSERT INTO `ka_sales_man` VALUES (77, '张帅帅', '13678132593', 71, 37);
INSERT INTO `ka_sales_man` VALUES (78, '王霞', '15892907570', 72, 37);
INSERT INTO `ka_sales_man` VALUES (79, '邓燕', '13458705682', 73, 37);
INSERT INTO `ka_sales_man` VALUES (80, '范丽娟', '18982782807', 74, 37);
INSERT INTO `ka_sales_man` VALUES (81, '赖敏', '15328334071', 75, 37);
INSERT INTO `ka_sales_man` VALUES (82, '罗庆旭', '18181877602', 76, 37);
INSERT INTO `ka_sales_man` VALUES (83, '林之清', '18808300880', 77, 37);
INSERT INTO `ka_sales_man` VALUES (84, '贾春梅', '18281602999', 78, 37);
INSERT INTO `ka_sales_man` VALUES (85, '李蕙', '18228089044', 79, 37);
INSERT INTO `ka_sales_man` VALUES (86, '张涵月', '13158869676', 80, 37);
INSERT INTO `ka_sales_man` VALUES (87, '张坤', '13881196688', 81, 37);
INSERT INTO `ka_sales_man` VALUES (88, '何敏', '18011110319', 82, 37);
INSERT INTO `ka_sales_man` VALUES (89, '何蕊', '18380227595', 83, 37);
INSERT INTO `ka_sales_man` VALUES (90, '孟好', '15828224949', 84, 37);
INSERT INTO `ka_sales_man` VALUES (91, '刘军', '15884507811', 85, 37);
INSERT INTO `ka_sales_man` VALUES (92, '雷筱', '13698281781', 86, 37);
INSERT INTO `ka_sales_man` VALUES (93, '王诗琪', '13990771350', 87, 37);
INSERT INTO `ka_sales_man` VALUES (94, '潘莎莎', '18608200708', 88, 37);
INSERT INTO `ka_sales_man` VALUES (95, '张曛', '13980317563', 89, 37);
INSERT INTO `ka_sales_man` VALUES (96, '马芳', '13708278989', 90, 37);
INSERT INTO `ka_sales_man` VALUES (97, '万清尹', '13881865817', 91, 37);
INSERT INTO `ka_sales_man` VALUES (98, '杨菲', '18200360548', 92, 37);
INSERT INTO `ka_sales_man` VALUES (99, '张泓', '13458588390', 93, 37);
INSERT INTO `ka_sales_man` VALUES (100, '王丽莉', '13550098147', 94, 37);
INSERT INTO `ka_sales_man` VALUES (101, '林琳', '13551816984', 95, 37);
INSERT INTO `ka_sales_man` VALUES (102, '江楠', '13550252804', 96, 37);
INSERT INTO `ka_sales_man` VALUES (103, '梁国兰', '18608029367', 97, 37);
INSERT INTO `ka_sales_man` VALUES (104, '王忠翠', '13541047082', 98, 37);
INSERT INTO `ka_sales_man` VALUES (105, '舒娇', '13880492246', 99, 37);
INSERT INTO `ka_sales_man` VALUES (106, '何鹏', '13438163445', 100, 37);
INSERT INTO `ka_sales_man` VALUES (107, '罗文博', '13980496626', 101, 37);
INSERT INTO `ka_sales_man` VALUES (108, '何莉', '13880602411', 102, 37);
INSERT INTO `ka_sales_man` VALUES (109, '阮巧玉', '13980587575', 103, 37);
INSERT INTO `ka_sales_man` VALUES (110, '潘露', '13108075229', 104, 37);
INSERT INTO `ka_sales_man` VALUES (111, '吴慧', '13551359467', 105, 37);
INSERT INTO `ka_sales_man` VALUES (112, '徐莉黎', '15228968691', 106, 37);
INSERT INTO `ka_sales_man` VALUES (113, '税红', '18615781682', 107, 37);
INSERT INTO `ka_sales_man` VALUES (114, '刘英', '18683426868', 108, 37);
INSERT INTO `ka_sales_man` VALUES (115, '冯灿', '18683662712', 109, 37);
INSERT INTO `ka_sales_man` VALUES (116, '黄鲜', '15202812607', 110, 37);
INSERT INTO `ka_sales_man` VALUES (117, '张燕', '15828035565', 111, 37);
INSERT INTO `ka_sales_man` VALUES (118, '楚艺', '18628118415', 112, 37);
INSERT INTO `ka_sales_man` VALUES (119, '杨芳琴', '17345007881', 113, 37);
INSERT INTO `ka_sales_man` VALUES (120, '苏娟', '18682580227', 114, 37);
INSERT INTO `ka_sales_man` VALUES (121, '彭艳', '18380115476', 115, 37);
INSERT INTO `ka_sales_man` VALUES (122, '刘丹', '13540416977', 116, 37);
INSERT INTO `ka_sales_man` VALUES (123, '郭加', '13568950239', 117, 37);
INSERT INTO `ka_sales_man` VALUES (124, '孙雁', '13881789337', 118, 37);
INSERT INTO `ka_sales_man` VALUES (125, '王娟', '13666132704', 119, 37);
INSERT INTO `ka_sales_man` VALUES (126, '练莉', '13980835598', 120, 37);
INSERT INTO `ka_sales_man` VALUES (127, '魏霞', '15983403638', 121, 37);
INSERT INTO `ka_sales_man` VALUES (128, '宋淏阳', '18782923374', 122, 37);
INSERT INTO `ka_sales_man` VALUES (129, '聂艺', '15183154832', 123, 37);
INSERT INTO `ka_sales_man` VALUES (130, '赵誉婷', '18380407960', 124, 37);
INSERT INTO `ka_sales_man` VALUES (131, '王建强', '15082620607', 125, 37);
INSERT INTO `ka_sales_man` VALUES (132, '莫玲', '13419257997', 126, 37);
INSERT INTO `ka_sales_man` VALUES (133, '陈婷婷', '13096211321', 127, 37);
INSERT INTO `ka_sales_man` VALUES (134, '许倩', '13619039972', 128, 37);
INSERT INTO `ka_sales_man` VALUES (135, '张翔', '15882405936', 129, 37);
INSERT INTO `ka_sales_man` VALUES (136, '覃涵', '13808187435', 39, 37);
INSERT INTO `ka_sales_man` VALUES (137, '陈思涵', '18782410707', 12, 37);
INSERT INTO `ka_sales_man` VALUES (138, '彭婷', '18583616136', 12, 37);
INSERT INTO `ka_sales_man` VALUES (139, '吴智', '18010671913', 12, 37);
INSERT INTO `ka_sales_man` VALUES (140, '王迪', '18140191530', 7, 37);

-- ----------------------------
-- Table structure for ka_shipping
-- ----------------------------
DROP TABLE IF EXISTS `ka_shipping`;
CREATE TABLE `ka_shipping`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shipping_com` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '快递公司名称（拼音）',
  `shipping_sn` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '发货单号',
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '客户姓名',
  `user_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '客户电话',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '联系电话',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货地址',
  `ID_num` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '身份证号码',
  `consignee` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人姓名',
  `remarks` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '备注',
  `new_field` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '后台自定义字段',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 80 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '订单发货表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_shipping
-- ----------------------------
INSERT INTO `ka_shipping` VALUES (10, 'YTO', '513126846', '付', NULL, '13032880424', '北京市/北京市市辖区/东城区/你80528052号', '666666', '我', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (11, 'YTO', '990003452064325942', '郑克峰', NULL, '13982124142', '四川省/成都市/锦江区/三槐树路3号', '080920', '郑克峰', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (12, 'YZPY', '9568077760502', '测试', NULL, '15682106350', '北京市/北京市市辖区/东城区/测试地址', '000777', '测试', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (13, 'YZPY', '2132135646', '巴蒂', NULL, '18981940330', '北京市/北京市市辖区/东城区/成都', '123456', '巴蒂', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (14, '快狗打车', '132132132156456', '王迪', NULL, '18140191539', '四川省/成都市/武侯区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (15, 'YZPY', '203888803865940205', '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (16, 'YZPY', '3901850478576', '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (17, 'YTO', '3901850478576', '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (18, 'YTO', '3901850478576', '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (19, '特斯拉', '203888803865940205', '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (20, 'SF', '990003452064325942', '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (21, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (22, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (23, '', NULL, '', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (24, '', NULL, '', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (25, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (26, '', NULL, '', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (27, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '121', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (28, '', NULL, '', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (29, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (30, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (31, '', NULL, '', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (32, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (33, 'EMS', '203888803865940205', '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (34, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (35, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (36, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (37, '', NULL, '王迪盛大萨达阿盛大的', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (38, '', NULL, '一土之由', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (39, '', NULL, '王迪一土之由', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (40, '', NULL, '阿斯顿飞规划局看阿士大夫', NULL, '18140191539', '北京市/北京市市辖区/东城区/第三方刚会尽快', '1115', '说大发光火卷卡式带飞规划局', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (41, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1231', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (42, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '213', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (43, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '2131', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (44, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1231', '哇啊的', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (45, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '123112', '哇啊的', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (46, '', NULL, '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '0000', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (47, 'YTO', '3901850478576', '王迪', NULL, '18140191539', '北京市/北京市市辖区/东城区/天府三街', '000015', '李馨', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (48, '', NULL, '', '18140191539', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (49, 'YTO', '3901850478576', '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '121211', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (50, '', NULL, '', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (51, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', NULL, NULL);
INSERT INTO `ka_shipping` VALUES (52, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', '', NULL);
INSERT INTO `ka_shipping` VALUES (53, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', '自行车v呢生日体育ios东方跟红警咖啡的行政村v帮你买奶粉的萨斯费跟红警卡', NULL);
INSERT INTO `ka_shipping` VALUES (54, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', '                自行车v呢生日体育ios东方跟红警咖啡的行政村v帮你买奶粉的萨斯费跟红警卡自行车v呢生日体育ios东方跟红警咖啡的行政村v帮你买奶粉的萨斯费跟红警卡自行车v呢生日体育ios东方跟红警咖啡的行政村v帮你买奶粉的萨斯费跟红警卡自行车v呢生日体育ios东方跟红警咖啡的行政村v帮你买奶粉的萨斯费跟红警卡自行车v呢生日体育ios东方跟红警咖啡的行政村v帮你买奶粉的萨斯费跟红警卡自行车v呢生日体育ios东方跟红警咖啡的行政村v帮你买奶粉的萨斯费跟红警卡自行车v呢生日体育ios东方跟红警咖啡的行政村v帮你买奶粉的萨斯费跟红警卡', NULL);
INSERT INTO `ka_shipping` VALUES (55, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', '                ', NULL);
INSERT INTO `ka_shipping` VALUES (56, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '121111', '王迪', '231', NULL);
INSERT INTO `ka_shipping` VALUES (57, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', 'test', NULL);
INSERT INTO `ka_shipping` VALUES (58, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/test again', '111115', '王迪', 'test again', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"test again\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"test again\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"test again\"},{\"title\":\"\\u8eab\\u9ad8\",\"content\":\"test again\"},{\"title\":\"\\u4f53\\u91cd\",\"content\":\"test again\"}]');
INSERT INTO `ka_shipping` VALUES (59, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/他自行车', '123412', '王迪', '爱填不填', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"\\u5b66\\u6821\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"\\u672a\\u5a5a\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\\u5426\"},{\"title\":\"\\u8eab\\u9ad8\",\"content\":\"168\"},{\"title\":\"\\u4f53\\u91cd\",\"content\":\"134\"}]');
INSERT INTO `ka_shipping` VALUES (60, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', '爱填不填', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"\\u4ec0\\u4e48\\u5b66\\u6821\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"\\u672a\\u5a5a\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\\u5426\"},{\"title\":\"\\u8eab\\u9ad8\",\"content\":\"168\"},{\"title\":\"\\u4f53\\u91cd\",\"content\":\"134\"},{\"title\":\"\\u65b0\\u6765\\u7684\",\"content\":\"\\u65b0\\u7684?\"}]');
INSERT INTO `ka_shipping` VALUES (61, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', '爱填不填', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"\\u8363\\u6606\\u5c0f\\u5b66\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"\\u672a\\u5a5a\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\\u5426\"}]');
INSERT INTO `ka_shipping` VALUES (62, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/阿斯顿', '111115', '王迪', '5如天热规范化将', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"157\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"\\u98de\\u6d12\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\\u54c8\\u5c71\\u4e1c\\u521a\\u5085\\u9f0e\\u751f\"}]');
INSERT INTO `ka_shipping` VALUES (63, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '111115', '王迪', '', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\"}]');
INSERT INTO `ka_shipping` VALUES (64, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/撒地方刚', '125467', '王迪', '', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"1\\u963f\\u65af\\u987f\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"21354 \"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\\u5927\\u5e05\\u5e9c\"}]');
INSERT INTO `ka_shipping` VALUES (65, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/撒地方刚', '125467', '王迪', '', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"1\\u963f\\u65af\\u987f\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"21354 \"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\\u5927\\u5e05\\u5e9c\"}]');
INSERT INTO `ka_shipping` VALUES (66, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/撒地方刚', '125467', '王迪', '', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"1\\u963f\\u65af\\u987f\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"21354 \"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\\u5927\\u5e05\\u5e9c\"}]');
INSERT INTO `ka_shipping` VALUES (67, '', NULL, '阿士大夫', '', '18140191539', '北京市/北京市市辖区/东城区/阿斯顿飞规划局', '123456', '阿斯顿法国', '这些', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"\\u81ea\\u884c\\u8f66v\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"\\u81ea\\u884c\\u8f66v\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"12345\"}]');
INSERT INTO `ka_shipping` VALUES (68, '', NULL, '阿萨法刚', '', '18140191539', '北京市/北京市市辖区/东城区/松岛枫跟红警', '123456', '阿斯顿飞规划局看', '阿斯顿法国和飞', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"\\u662f\\u68b5\\u8482\\u5188\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"\\u677e\\u5c9b\\u67ab\\u8ddf\\u7ea2\\u8b66\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\\u963f\\u65af\\u987f\\u6cd5\\u56fd\\u548c\"}]');
INSERT INTO `ka_shipping` VALUES (69, '', NULL, '阿斯顿法国和', '', '18140191539', '北京市/北京市市辖区/东城区/打手犯规和', '123456', '打手犯规', '打手犯规和', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"\\u6253\\u624b\\u72af\\u89c4\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"\\u6492\\u5730\\u65b9\\u521a\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"\\u6253\\u624b\\u72af\\u89c4\"}]');
INSERT INTO `ka_shipping` VALUES (70, '', NULL, '王迪', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '123456', '王迪', '', '[{\"title\":\"\\u5b66\\u6821\\u540d\",\"content\":\"124\"},{\"title\":\"\\u5a5a\\u59fb\\u72b6\\u51b5\",\"content\":\"124\"},{\"title\":\"\\u662f\\u5426\\u6709\\u5b50\\u5973\",\"content\":\"1231\"}]');
INSERT INTO `ka_shipping` VALUES (71, '', NULL, '王迪', '18140191539', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1234', '王迪', '', '[{\"title\":\"41\",\"content\":\"123\"},{\"title\":\"14\",\"content\":\"1241\"}]');
INSERT INTO `ka_shipping` VALUES (72, '', NULL, '王迪', '18140191539', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1115', '王迪', '', '[{\"title\":\"41\",\"content\":\"41\"},{\"title\":\"14\",\"content\":\"14\"}]');
INSERT INTO `ka_shipping` VALUES (73, '', NULL, '', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', '', NULL);
INSERT INTO `ka_shipping` VALUES (74, '', NULL, '王迪', '18140191539', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1115', '我', '', '[{\"title\":\"test1\",\"content\":\"\\u6d4b\\u8bd5?\"}]');
INSERT INTO `ka_shipping` VALUES (75, '', NULL, '王迪', '18140191539', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1115', '王迪', '', '[{\"title\":\"test1\",\"content\":\"\\u662f\\u4e48?\"}]');
INSERT INTO `ka_shipping` VALUES (76, '', NULL, '王迪', '18140191539', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '1115', '王迪1', '', '[{\"title\":\"test1\",\"content\":\"\\u55ef\\u54ea\"}]');
INSERT INTO `ka_shipping` VALUES (77, '', NULL, '', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '的', '', NULL);
INSERT INTO `ka_shipping` VALUES (78, '', NULL, '', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', '', NULL);
INSERT INTO `ka_shipping` VALUES (79, '', NULL, '', '', '18140191539', '北京市/北京市市辖区/东城区/天府三街', '', '王迪', '', NULL);

-- ----------------------------
-- Table structure for ka_shop
-- ----------------------------
DROP TABLE IF EXISTS `ka_shop`;
CREATE TABLE `ka_shop`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商城名称',
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'logo地址',
  `sign` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '销售活动内页顶部logo标志',
  `add_time` date NULL DEFAULT NULL COMMENT '授权时间',
  `nav_color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '顶部导航色',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '微商城表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_shop
-- ----------------------------
INSERT INTO `ka_shop` VALUES (31, '中国建设银行', 'http://ex.li99.com.cn/public/upload/logo/2018/10-24/fa4905da5849a204ca4992ec5cd7b26c.png', 'http://ex.li99.com.cn/public/upload/sign/2018/10-25/56b93bba0766a8c62638de8e3935b097.png', '2018-09-25', '');
INSERT INTO `ka_shop` VALUES (32, '中国农业银行', 'http://ex.li99.com.cn/public/upload/logo/2018/10-19/05bed71ede0a3b128b0a7ac13ab77c10.jpg', '', '2018-10-08', '');
INSERT INTO `ka_shop` VALUES (33, '浦发银行', 'http://ex.li99.com.cn/public/upload/logo/2018/10-24/5ee11ae34cda09af47ebe3c244255427.png', '', '2018-10-19', '');
INSERT INTO `ka_shop` VALUES (34, '招商银行', 'http://ex.li99.com.cn/public/upload/logo/2018/10-24/b66c5806d4296a2529741f0d82bdd1c3.png', '', '2018-10-24', '');
INSERT INTO `ka_shop` VALUES (35, '中国银行', 'http://ex.li99.com.cn/public/upload/logo/2018/10-24/522a68d3d43995da44d6f4239fe9f2f5.png', '', '2018-10-24', '');
INSERT INTO `ka_shop` VALUES (37, '兴业银行', 'http://ex.li99.com.cn/public/upload/logo/2018/10-24/c84ef3df3c7f9172006c7ed157d906e3.png', 'http://ex.li99.com.cn/public/upload/sign/2018/10-25/f39057f3d8b30e41fe665f76f3c9e35b.png', '2018-10-24', '#453982');

-- ----------------------------
-- Table structure for ka_system_menu
-- ----------------------------
DROP TABLE IF EXISTS `ka_system_menu`;
CREATE TABLE `ka_system_menu`  (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '权限名字',
  `group` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '所属分组',
  `right` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '权限码(控制器+动作)',
  `is_del` tinyint(1) NULL DEFAULT 0 COMMENT '删除状态 1删除,0正常',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 65 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_system_menu
-- ----------------------------
INSERT INTO `ka_system_menu` VALUES (6, '权限资源', 'system', 'System@right_list,System@edit_right', 1);
INSERT INTO `ka_system_menu` VALUES (8, '管理员管理', 'system', 'Admin@index,Admin@admin_info,Admin@adminHandle', 0);
INSERT INTO `ka_system_menu` VALUES (9, '角色管理', 'system', 'Admin@role,Admin@role_info,Admin@roleSave,Admin@roleDel', 0);
INSERT INTO `ka_system_menu` VALUES (16, '线下商品编辑', 'goods', 'Goods@addEditGoods,Goods@delGoods,Goods@del_goods_images,Goods@set_price,Goods@set_price_detail,Goods@set_goods_tags,Goods@setTags,Goods@setCoupons', 0);
INSERT INTO `ka_system_menu` VALUES (17, '线下商品列表', 'goods', 'Goods@goodsList,Goods@ajaxGoodsList,Goods@updateField', 0);
INSERT INTO `ka_system_menu` VALUES (19, '商品分类', 'goods', 'Goods@categoryList,Goods@addEditCategory,Goods@delGoodsCategory,Goods@setTagsToCat', 0);
INSERT INTO `ka_system_menu` VALUES (49, '操作日志', 'system', 'Admin@log,Order@order_log', 0);
INSERT INTO `ka_system_menu` VALUES (61, '刷新缓存', 'system', 'System@cleanCache,System@ClearGoodsHtml,System@ClearGoodsThumb,System@ClearAritcleHtml', 0);
INSERT INTO `ka_system_menu` VALUES (62, '修改管理员密码', 'system', 'Admin@modify_pwd', 0);
INSERT INTO `ka_system_menu` VALUES (63, '订单管理', 'count', 'Orders@code_exchange,Orders@sales_exchange,Orders@order_list,Orders@do_shipping,Orders@save_shipping,Orders@check_logistics', 0);
INSERT INTO `ka_system_menu` VALUES (64, '活动管理', 'system', 'Index@code_exchange', 0);

-- ----------------------------
-- Table structure for ka_system_module
-- ----------------------------
DROP TABLE IF EXISTS `ka_system_module`;
CREATE TABLE `ka_system_module`  (
  `mod_id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module` enum('top','menu','module') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'module',
  `level` tinyint(1) NULL DEFAULT 3,
  `ctl` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `act` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `visible` tinyint(1) NULL DEFAULT 1,
  `parent_id` smallint(6) NULL DEFAULT 0,
  `orderby` smallint(6) NULL DEFAULT 50,
  `icon` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`mod_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 155 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ka_system_module
-- ----------------------------
INSERT INTO `ka_system_module` VALUES (1, 'top', 1, '', '', '系统', 1, 0, 50, '0');
INSERT INTO `ka_system_module` VALUES (2, 'top', 1, '', '', '设置', 1, 0, 50, '0');
INSERT INTO `ka_system_module` VALUES (3, 'top', 1, '', '', '会员', 1, 0, 50, '0');
INSERT INTO `ka_system_module` VALUES (4, 'top', 1, '', '', '商家', 1, 0, 50, '0');
INSERT INTO `ka_system_module` VALUES (5, 'top', 1, '', '', '内容', 1, 0, 50, '0');
INSERT INTO `ka_system_module` VALUES (6, 'top', 1, '', '', '运营', 1, 0, 50, 'fa-home');
INSERT INTO `ka_system_module` VALUES (7, 'menu', 2, '', '', '权限管理', 1, 1, 2, 'fa-cog');
INSERT INTO `ka_system_module` VALUES (8, 'menu', 2, '', '', '模块管理', 1, 1, 3, 'fa-table');
INSERT INTO `ka_system_module` VALUES (9, 'menu', 2, '', '', '网站设置', 1, 2, 50, 'fa-pencil');
INSERT INTO `ka_system_module` VALUES (10, 'menu', 2, '', '', '会员管理', 1, 3, 50, 'fa-user');
INSERT INTO `ka_system_module` VALUES (11, 'menu', 2, '', '', '商品管理', 1, 4, 50, 'fa-tasks');
INSERT INTO `ka_system_module` VALUES (12, 'menu', 2, '', '', '内容管理', 1, 5, 50, 'fa-navicon');
INSERT INTO `ka_system_module` VALUES (13, 'menu', 2, '', '', '广告管理', 1, 6, 50, 'fa-star');
INSERT INTO `ka_system_module` VALUES (14, 'menu', 2, '', '', '促销管理', 1, 4, 50, 'fa-retweet');
INSERT INTO `ka_system_module` VALUES (15, 'menu', 2, '', '', '插件工具', 1, 6, 20, 'fa-plug');
INSERT INTO `ka_system_module` VALUES (16, 'menu', 2, '', '', '微信管理', 1, 6, 50, 'fa-home');
INSERT INTO `ka_system_module` VALUES (17, 'menu', 2, '', '', '订单管理', 1, 4, 50, 'fa-flag');
INSERT INTO `ka_system_module` VALUES (18, 'module', 3, 'Comment', 'index', '评论管理', 1, 10, 50, '0');
INSERT INTO `ka_system_module` VALUES (19, 'module', 3, 'Admin', 'role', '角色管理', 1, 7, 50, '0');
INSERT INTO `ka_system_module` VALUES (20, 'module', 3, 'Admin', 'index', '管理员列表', 1, 7, 50, '0');
INSERT INTO `ka_system_module` VALUES (21, 'module', 3, 'System', 'menu', '菜单管理', 1, 8, 50, '0');
INSERT INTO `ka_system_module` VALUES (22, 'module', 3, 'System', 'module', '模块管理', 1, 8, 50, '0');
INSERT INTO `ka_system_module` VALUES (23, 'module', 3, 'Admin', 'log', '管理员日志', 1, 7, 50, '0');
INSERT INTO `ka_system_module` VALUES (24, 'module', 3, 'Goods', 'categoryList', '商品分类', 1, 11, 50, '0');
INSERT INTO `ka_system_module` VALUES (25, 'module', 3, 'Goods', 'goodsList', '商品列表', 1, 11, 50, '0');
INSERT INTO `ka_system_module` VALUES (26, 'module', 3, 'Goods', 'goodsTypeList', '商品类型', 1, 11, 50, '0');
INSERT INTO `ka_system_module` VALUES (27, 'module', 3, 'Goods', 'specList', '商品规格', 1, 11, 50, '0');
INSERT INTO `ka_system_module` VALUES (28, 'module', 3, 'Goods', 'goodsAttributeList', '商品属性', 1, 11, 50, '0');
INSERT INTO `ka_system_module` VALUES (29, 'module', 3, 'Goods', 'brandList', '商品品牌', 1, 11, 50, '0');
INSERT INTO `ka_system_module` VALUES (30, 'module', 3, 'Order', 'index', '订单列表', 1, 17, 50, '0');
INSERT INTO `ka_system_module` VALUES (31, 'module', 3, 'Order', 'delivery_list', '发货单列表', 1, 17, 50, '0');
INSERT INTO `ka_system_module` VALUES (32, 'module', 3, 'Order', 'return_list', '退货单列表', 1, 17, 50, '0');
INSERT INTO `ka_system_module` VALUES (33, 'module', 3, 'User', 'levelList', '会员等级', 1, 10, 50, '0');
INSERT INTO `ka_system_module` VALUES (34, 'module', 3, 'User', 'index', '会员列表', 1, 10, 50, '0');
INSERT INTO `ka_system_module` VALUES (35, 'module', 3, 'System', 'index', '网站设置', 1, 9, 50, '0');
INSERT INTO `ka_system_module` VALUES (36, 'module', 3, 'System', 'navigationList', '导航设置', 1, 9, 50, '0');
INSERT INTO `ka_system_module` VALUES (37, 'module', 3, 'Ad', 'positionList', '广告位', 1, 13, 50, '0');
INSERT INTO `ka_system_module` VALUES (38, 'module', 3, 'Ad', 'adList', '广告列表', 1, 13, 50, '0');
INSERT INTO `ka_system_module` VALUES (39, 'module', 3, 'Article', 'categoryList', '文章分类', 1, 12, 50, '0');
INSERT INTO `ka_system_module` VALUES (40, 'module', 3, 'Article', 'articleList', '文章列表', 1, 12, 50, '0');
INSERT INTO `ka_system_module` VALUES (41, 'module', 3, 'Article', 'linkList', '友情链接', 1, 12, 50, '0');
INSERT INTO `ka_system_module` VALUES (42, 'module', 3, 'Topic', 'topicList', '专题列表', 1, 12, 50, '0');
INSERT INTO `ka_system_module` VALUES (43, 'module', 3, 'Coupon', 'index', '优惠券', 1, 14, 50, '0');
INSERT INTO `ka_system_module` VALUES (44, 'module', 3, 'Wechat', 'index', '公众号管理', 1, 16, 50, '0');
INSERT INTO `ka_system_module` VALUES (45, 'module', 3, 'Wechat', 'menu', '微信菜单管理', 1, 16, 50, '0');
INSERT INTO `ka_system_module` VALUES (46, 'module', 3, 'Wechat', 'text', '文本回复', 1, 16, 50, '0');
INSERT INTO `ka_system_module` VALUES (47, 'module', 3, 'Wechat', 'img', '图文回复', 1, 16, 50, '0');
INSERT INTO `ka_system_module` VALUES (48, 'module', 3, 'Wechat', 'nes', '组合回复', 1, 16, 50, '0');
INSERT INTO `ka_system_module` VALUES (49, 'module', 3, 'Plugin', 'index', '插件列表', 1, 15, 50, '0');
INSERT INTO `ka_system_module` VALUES (50, 'module', 3, 'Promotion', 'index', '组合促销', 0, 14, 50, '0');
INSERT INTO `ka_system_module` VALUES (51, 'menu', 2, '', '', '模板管理', 1, 2, 50, 'fa-book');
INSERT INTO `ka_system_module` VALUES (52, 'module', 3, 'Template', 'templateList?t=pc', 'PC端模板', 1, 51, 50, '0');
INSERT INTO `ka_system_module` VALUES (53, 'module', 3, 'Template', 'templateList?t=mobile', '手机端模板', 1, 51, 50, '0');
INSERT INTO `ka_system_module` VALUES (54, 'module', 3, 'Tools', 'index', '数据备份', 1, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (55, 'menu', 2, '', '', '报表统计', 1, 6, 50, 'fa-bar-chart');
INSERT INTO `ka_system_module` VALUES (56, 'module', 3, 'report', 'index', '销售概况', 1, 55, 50, NULL);
INSERT INTO `ka_system_module` VALUES (57, 'module', 3, 'report', 'saleTop', '销售排行', 1, 55, 50, NULL);
INSERT INTO `ka_system_module` VALUES (58, 'module', 3, 'report', 'userTop', '会员排行', 1, 55, 50, NULL);
INSERT INTO `ka_system_module` VALUES (59, 'module', 3, 'Promotion', 'group_buy_list', '团购管理', 1, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (60, 'module', 3, 'report', 'saleList', '销售明细', 1, 55, 50, NULL);
INSERT INTO `ka_system_module` VALUES (61, 'module', 3, 'report', 'user', '会员统计', 1, 55, 50, NULL);
INSERT INTO `ka_system_module` VALUES (62, 'module', 3, 'Promotion', 'flash_sale', '限时抢购', 1, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (63, 'module', 3, 'Tools', 'restore', '数据还原', 1, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (64, 'module', 3, 'Order', 'add_order', '添加订单', 1, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (65, 'module', 3, 'report', 'finance', '财务统计', 1, 55, 50, NULL);
INSERT INTO `ka_system_module` VALUES (66, 'module', 3, 'Admin', 'role_info', '编辑角色', 0, 7, 50, NULL);
INSERT INTO `ka_system_module` VALUES (67, 'module', 3, 'Admin', 'role_save', '保存角色', 0, 7, 50, NULL);
INSERT INTO `ka_system_module` VALUES (68, 'module', 3, 'Admin', 'roleDel', '删除角色', 0, 7, 50, NULL);
INSERT INTO `ka_system_module` VALUES (69, 'module', 3, 'Admin', 'admin_info', '编辑管理员', 0, 7, 50, NULL);
INSERT INTO `ka_system_module` VALUES (70, 'module', 3, 'Admin', 'adminHandle', '保存管理员', 0, 7, 50, NULL);
INSERT INTO `ka_system_module` VALUES (71, 'module', 3, 'System', 'create_menu', '添加菜单', 0, 8, 50, NULL);
INSERT INTO `ka_system_module` VALUES (72, 'module', 3, 'System', 'menuSave', '保存菜单', 0, 8, 50, NULL);
INSERT INTO `ka_system_module` VALUES (73, 'module', 3, 'System', 'ctl_detail', '添加控制模块', 0, 8, 50, NULL);
INSERT INTO `ka_system_module` VALUES (74, 'module', 3, 'System', 'ctlSave', '保存控制模块', 0, 8, 50, NULL);
INSERT INTO `ka_system_module` VALUES (75, 'module', 3, 'System', 'handle', '保存设置', 0, 9, 50, NULL);
INSERT INTO `ka_system_module` VALUES (76, 'module', 3, 'System', 'addEditNav', '保存导航', 0, 9, 50, NULL);
INSERT INTO `ka_system_module` VALUES (77, 'module', 3, 'Template', 'changeTemplate', '切换模板', 0, 51, 50, NULL);
INSERT INTO `ka_system_module` VALUES (78, 'module', 3, 'System', 'delNav', '删除导航', 0, 9, 50, NULL);
INSERT INTO `ka_system_module` VALUES (79, 'module', 3, 'Comment', 'detail', '评论详情', 0, 10, 50, NULL);
INSERT INTO `ka_system_module` VALUES (80, 'module', 3, 'Comment', 'op', '评论回复', 0, 10, 50, NULL);
INSERT INTO `ka_system_module` VALUES (81, 'module', 3, 'Comment', 'del', '删除评论', 0, 10, 50, NULL);
INSERT INTO `ka_system_module` VALUES (82, 'module', 3, 'User', 'level', '新增等级', 0, 10, 50, NULL);
INSERT INTO `ka_system_module` VALUES (83, 'module', 3, 'User', 'levelHandle', '保存等级', 0, 10, 50, NULL);
INSERT INTO `ka_system_module` VALUES (84, 'module', 3, 'User', 'detail', '查看会员', 0, 10, 50, NULL);
INSERT INTO `ka_system_module` VALUES (85, 'module', 3, 'User', 'account_log', '会员消费记录', 0, 10, 50, NULL);
INSERT INTO `ka_system_module` VALUES (86, 'module', 3, 'User', 'account_edit', '会员资金调节', 0, 10, 50, NULL);
INSERT INTO `ka_system_module` VALUES (87, 'module', 3, 'User', 'address', '会员收货地址', 0, 10, 50, NULL);
INSERT INTO `ka_system_module` VALUES (88, 'module', 3, 'Goods', 'addEditGoods', '新增商品', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (89, 'module', 3, 'Goods', 'addEditCategory', '编辑商品分类', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (90, 'module', 3, 'Goods', 'delGoodsCategory', '删除商品分类', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (91, 'module', 3, 'Goods', 'changeGoodsField', '修改商品字段', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (92, 'module', 3, 'Goods', 'addEditGoodsType', '编辑商品类型', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (93, 'module', 3, 'Goods', 'addEditGoodsAttribute', '编辑商品属性', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (94, 'module', 3, 'Goods', 'delGoods', '删除商品', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (95, 'module', 3, 'Goods', 'delGoodsType', '删除商品类型', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (96, 'module', 3, 'Goods', 'delGoodsAttribute', '删除商品属性', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (97, 'module', 3, 'Goods', 'delGoodsSpec', '删除商品规格', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (98, 'module', 3, 'Goods', 'addEditSpec', '编辑商品规格', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (99, 'module', 3, 'Goods', 'addEditBrand', '编辑品牌', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (100, 'module', 3, 'Goods', 'delBrand', '删除品牌', 0, 11, 50, NULL);
INSERT INTO `ka_system_module` VALUES (101, 'module', 3, 'Coupon', 'coupon_info', '添加优惠券', 0, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (102, 'module', 3, 'Promotion', 'group_buy', '添加团购', 0, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (103, 'module', 3, 'Promotion', 'groupbuyHandle', '保存团购', 0, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (104, 'module', 3, 'Promotion', 'get_goods', '选择商品', 0, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (105, 'module', 3, 'Coupon', 'coupon_info', '编辑优惠券', 0, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (106, 'module', 3, 'Coupon', 'del_coupon', '删除优惠券', 0, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (107, 'module', 3, 'Coupon', 'send_coupon', '发放优惠券', 0, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (108, 'module', 3, 'Order', 'edit_order', '编辑订单', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (109, 'module', 3, 'Order', 'split_order', '拆分订单', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (110, 'module', 3, 'Order', 'deatil', '订单详情', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (111, 'module', 3, 'Order', 'editprice', '修改订单金额', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (112, 'module', 3, 'Order', 'delete_order', '删除订单', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (113, 'module', 3, 'Order', 'pay_cancel', '取消付款', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (114, 'module', 3, 'Order', 'order_print', '订单打印', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (115, 'module', 3, 'Order', 'shipping_print', '打印快递', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (116, 'module', 3, 'Order', 'deliveryHandle', '发货处理', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (117, 'module', 3, 'Order', 'delivery_info', '发货单详情', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (118, 'module', 3, 'Order', 'return_info', '退货单信息', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (119, 'module', 3, 'Order', 'return_del', '删除退货单', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (120, 'module', 3, 'Order', 'order_action', '订单流程处理', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (121, 'module', 3, 'Order', 'export_order', '导出订单', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (122, 'module', 3, 'Order', 'search_goods', '搜索商品', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (123, 'module', 3, 'Order', 'add_return_goods', '生成退货单', 0, 17, 50, NULL);
INSERT INTO `ka_system_module` VALUES (124, 'module', 3, 'Article', 'category', '编辑文章分类', 0, 12, 50, NULL);
INSERT INTO `ka_system_module` VALUES (125, 'module', 3, 'Article', 'categoryHandle', '保存文章分类', 0, 12, 50, NULL);
INSERT INTO `ka_system_module` VALUES (126, 'module', 3, 'Article', 'article', '编辑文章', 0, 12, 50, NULL);
INSERT INTO `ka_system_module` VALUES (127, 'module', 3, 'Article', 'aticleHandle', '保存文章', 0, 12, 50, NULL);
INSERT INTO `ka_system_module` VALUES (128, 'module', 3, 'Article', 'link', '编辑友情链接', 0, 12, 50, NULL);
INSERT INTO `ka_system_module` VALUES (129, 'module', 3, 'Article', 'linkHandle', '保存友情链接', 0, 12, 50, NULL);
INSERT INTO `ka_system_module` VALUES (130, 'module', 3, 'Topic', 'topic', '新增专题', 0, 12, 50, NULL);
INSERT INTO `ka_system_module` VALUES (131, 'module', 3, 'Topic', 'topicHandle', '保存专题', 0, 12, 50, NULL);
INSERT INTO `ka_system_module` VALUES (132, 'module', 3, 'Ad', 'position', '添加广告位', 0, 13, 50, NULL);
INSERT INTO `ka_system_module` VALUES (133, 'module', 3, 'Ad', 'positionHandle', '保存广告位', 0, 13, 50, NULL);
INSERT INTO `ka_system_module` VALUES (134, 'module', 3, 'Ad', 'ad', '添加广告', 0, 13, 50, NULL);
INSERT INTO `ka_system_module` VALUES (135, 'module', 3, 'Ad', 'adHandle', '保存广告', 0, 13, 50, NULL);
INSERT INTO `ka_system_module` VALUES (136, 'module', 3, 'Tools', 'backup', '生成备份文件', 0, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (137, 'module', 3, 'Tools', 'restoreData', '还原SQL文件', 0, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (138, 'module', 3, 'Tools', 'optimize', '优化数据表', 0, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (139, 'module', 3, 'Tools', 'repair', '修改数据表', 0, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (140, 'module', 3, 'Tools', 'restoreUpload', '上传SQL文件', 0, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (141, 'module', 3, 'Tools', 'downFile', '下载SQL文件', 0, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (142, 'module', 3, 'Tools', 'delSqlFiles', '删除SQL文件', 0, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (143, 'module', 3, 'Promotion', 'prom_order_list', '订单促销', 1, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (144, 'module', 3, 'Promotion', 'bargain', '砍价管理', 0, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (145, 'menu', 2, '', '', '分销管理', 1, 6, 50, 'fa-user');
INSERT INTO `ka_system_module` VALUES (146, 'module', 3, 'Promotion', 'prom_goods_list', '商品促销', 1, 14, 50, NULL);
INSERT INTO `ka_system_module` VALUES (148, 'module', 3, 'Distribut', 'tree', '分销关系', 1, 145, 50, NULL);
INSERT INTO `ka_system_module` VALUES (149, 'module', 3, 'Distribut', 'set', '分销设置', 1, 145, 50, NULL);
INSERT INTO `ka_system_module` VALUES (150, 'module', 3, 'Distribut', 'withdrawals', '提现申请记录', 1, 145, 50, NULL);
INSERT INTO `ka_system_module` VALUES (151, 'module', 3, 'Distribut', 'remittance', '汇款记录', 1, 145, 50, NULL);
INSERT INTO `ka_system_module` VALUES (152, 'module', 3, 'Distribut', 'rebate_log', '分成记录', 1, 145, 50, NULL);
INSERT INTO `ka_system_module` VALUES (153, 'module', 3, 'Tools', 'region', '地区管理', 1, 15, 50, NULL);
INSERT INTO `ka_system_module` VALUES (154, 'module', 3, 'Comment', 'ask_list', '商品咨询', 1, 10, 50, NULL);

SET FOREIGN_KEY_CHECKS = 1;
