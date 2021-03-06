/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : docking

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 12/03/2021 14:05:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for fa_admin
-- ----------------------------
DROP TABLE IF EXISTS `fa_admin`;
CREATE TABLE `fa_admin`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '昵称',
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '密码盐',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '头像',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '电子邮箱',
  `loginfailure` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '失败次数',
  `logintime` int(10) NULL DEFAULT NULL COMMENT '登录时间',
  `loginip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '登录IP',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `token` varchar(59) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'Session标识',
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_admin
-- ----------------------------
INSERT INTO `fa_admin` VALUES (1, 'admin', 'Admin', '4c39215188c0d057d3160fe6e30e7296', '5e0721', '/assets/img/avatar.png', 'admin@admin.com', 0, 1615519848, '127.0.0.1', 1492186163, 1615519848, 'c7b147e6-4e78-4662-8170-3602af062f9b', 'normal');

-- ----------------------------
-- Table structure for fa_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `fa_admin_log`;
CREATE TABLE `fa_admin_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '管理员ID',
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '管理员名字',
  `url` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '操作页面',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '日志标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'IP',
  `useragent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'User-Agent',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_admin_log
-- ----------------------------
INSERT INTO `fa_admin_log` VALUES (1, 0, 'Unknown', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '登录', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admim\",\"password\":\"***\",\"captcha\":\"axmw\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614648832);
INSERT INTO `fa_admin_log` VALUES (2, 1, 'admin', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '登录', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"evux\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614648840);
INSERT INTO `fa_admin_log` VALUES (3, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/multi', '权限管理 / 菜单规则', '{\"action\":\"\",\"ids\":\"3\",\"params\":\"ismenu=0\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614649128);
INSERT INTO `fa_admin_log` VALUES (4, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/multi', '权限管理 / 菜单规则', '{\"action\":\"\",\"ids\":\"66\",\"params\":\"ismenu=0\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614649131);
INSERT INTO `fa_admin_log` VALUES (5, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/multi', '权限管理 / 菜单规则', '{\"action\":\"\",\"ids\":\"1\",\"params\":\"ismenu=0\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614649137);
INSERT INTO `fa_admin_log` VALUES (6, 1, 'admin', '/ozEyjwQdGP.php/addon/install', '插件管理', '{\"name\":\"command\",\"force\":\"0\",\"uid\":\"4349\",\"token\":\"***\",\"version\":\"1.0.6\",\"faversion\":\"1.2.0.20210125_beta\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614649201);
INSERT INTO `fa_admin_log` VALUES (7, 1, 'admin', '/ozEyjwQdGP.php/command/get_field_list', '在线命令管理', '{\"table\":\"fa_admin\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650249);
INSERT INTO `fa_admin_log` VALUES (8, 1, 'admin', '/ozEyjwQdGP.php/command/get_field_list', '在线命令管理', '{\"table\":\"fa_push_log\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650254);
INSERT INTO `fa_admin_log` VALUES (9, 1, 'admin', '/ozEyjwQdGP.php/command/command/action/command', '在线命令管理', '{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"0\",\"table\":\"fa_push_log\",\"controller\":\"\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650259);
INSERT INTO `fa_admin_log` VALUES (10, 1, 'admin', '/ozEyjwQdGP.php/command/command/action/execute', '在线命令管理', '{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"0\",\"table\":\"fa_push_log\",\"controller\":\"\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650260);
INSERT INTO `fa_admin_log` VALUES (11, 1, 'admin', '/ozEyjwQdGP.php/command/get_controller_list', '在线命令管理', '{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650262);
INSERT INTO `fa_admin_log` VALUES (12, 1, 'admin', '/ozEyjwQdGP.php/command/get_controller_list', '在线命令管理', '{\"q_word\":[\"\"],\"pageNumber\":\"2\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650265);
INSERT INTO `fa_admin_log` VALUES (13, 1, 'admin', '/ozEyjwQdGP.php/command/get_controller_list', '在线命令管理', '{\"q_word\":[\"\"],\"pageNumber\":\"2\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650267);
INSERT INTO `fa_admin_log` VALUES (14, 1, 'admin', '/ozEyjwQdGP.php/command/command/action/command', '在线命令管理', '{\"commandtype\":\"menu\",\"allcontroller\":\"0\",\"delete\":\"0\",\"force\":\"0\",\"controllerfile_text\":\"\",\"controllerfile\":\"PushLog.php\",\"action\":\"command\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650268);
INSERT INTO `fa_admin_log` VALUES (15, 1, 'admin', '/ozEyjwQdGP.php/command/command/action/execute', '在线命令管理', '{\"commandtype\":\"menu\",\"allcontroller\":\"0\",\"delete\":\"0\",\"force\":\"0\",\"controllerfile_text\":\"\",\"controllerfile\":\"PushLog.php\",\"action\":\"execute\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650269);
INSERT INTO `fa_admin_log` VALUES (16, 1, 'admin', '/ozEyjwQdGP.php/push_log/add?dialog=1', '推送日志管理 / 添加', '{\"dialog\":\"1\",\"row\":{\"push_type\":\"create\",\"trigger_time\":\"2021-03-02 09:58:27\",\"push_data\":\"1\",\"sync_status\":\"1\",\"sync_result\":\"2\",\"sync_time\":\"2021-03-02 09:58:27\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650313);
INSERT INTO `fa_admin_log` VALUES (17, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/edit/ids/92?dialog=1', '权限管理 / 菜单规则 / 编辑', '{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"0\",\"name\":\"push_log\",\"title\":\"推送日志管理\",\"icon\":\"fa fa-location-arrow\",\"weigh\":\"0\",\"condition\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"92\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650492);
INSERT INTO `fa_admin_log` VALUES (18, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/multi', '权限管理 / 菜单规则', '{\"action\":\"\",\"ids\":\"85\",\"params\":\"ismenu=0\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650501);
INSERT INTO `fa_admin_log` VALUES (19, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/multi', '权限管理 / 菜单规则', '{\"action\":\"\",\"ids\":\"4\",\"params\":\"ismenu=0\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614650506);
INSERT INTO `fa_admin_log` VALUES (20, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"youzanyun\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614655175);
INSERT INTO `fa_admin_log` VALUES (21, 1, 'admin', '/ozEyjwQdGP.php/general.config/add', '常规管理 / 系统配置 / 添加', '{\"__token__\":\"***\",\"row\":{\"group\":\"basic\",\"type\":\"array\",\"name\":\"youzanyun\",\"title\":\"有赞配置\",\"setting\":{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"},\"value\":\"\",\"content\":\"value1|title1\\r\\nvalue2|title2\",\"tip\":\"\",\"rule\":\"\",\"extend\":\"\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614655183);
INSERT INTO `fa_admin_log` VALUES (22, 1, 'admin', '/ozEyjwQdGP.php/general/config/del', '常规管理 / 系统配置 / 删除', '{\"name\":\"youzanyun\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614655193);
INSERT INTO `fa_admin_log` VALUES (23, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"youzan\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614655200);
INSERT INTO `fa_admin_log` VALUES (24, 1, 'admin', '/ozEyjwQdGP.php/general.config/add', '常规管理 / 系统配置 / 添加', '{\"__token__\":\"***\",\"row\":{\"group\":\"basic\",\"type\":\"array\",\"name\":\"youzan\",\"title\":\"有赞配置\",\"setting\":{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"},\"value\":\"\",\"content\":\"value1|title1\\r\\nvalue2|title2\",\"tip\":\"\",\"rule\":\"\",\"extend\":\"\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614655206);
INSERT INTO `fa_admin_log` VALUES (25, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614655232);
INSERT INTO `fa_admin_log` VALUES (26, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa678&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614663216);
INSERT INTO `fa_admin_log` VALUES (27, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614663222);
INSERT INTO `fa_admin_log` VALUES (28, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa678&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614663280);
INSERT INTO `fa_admin_log` VALUES (29, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa678&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614663289);
INSERT INTO `fa_admin_log` VALUES (30, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614663295);
INSERT INTO `fa_admin_log` VALUES (31, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa678&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614663325);
INSERT INTO `fa_admin_log` VALUES (32, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614663337);
INSERT INTO `fa_admin_log` VALUES (33, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa678&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614663438);
INSERT INTO `fa_admin_log` VALUES (34, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614663443);
INSERT INTO `fa_admin_log` VALUES (35, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"fxiaoke\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614667061);
INSERT INTO `fa_admin_log` VALUES (36, 1, 'admin', '/ozEyjwQdGP.php/general.config/add', '常规管理 / 系统配置 / 添加', '{\"__token__\":\"***\",\"row\":{\"group\":\"basic\",\"type\":\"array\",\"name\":\"fxiaoke\",\"title\":\"纷享销客CRM配置\",\"setting\":{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"},\"value\":\"\",\"content\":\"value1|title1\\r\\nvalue2|title2\",\"tip\":\"\",\"rule\":\"\",\"extend\":\"\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614667073);
INSERT INTO `fa_admin_log` VALUES (37, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;&quot;,&quot;appSecret&quot;:&quot;&quot;,&quot;permanentCode&quot;:&quot;&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614667098);
INSERT INTO `fa_admin_log` VALUES (38, 0, 'Unknown', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"ygbp\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614907356);
INSERT INTO `fa_admin_log` VALUES (39, 1, 'admin', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '登录', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"kxxt\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614907361);
INSERT INTO `fa_admin_log` VALUES (40, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614907614);
INSERT INTO `fa_admin_log` VALUES (41, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614908554);
INSERT INTO `fa_admin_log` VALUES (42, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614910858);
INSERT INTO `fa_admin_log` VALUES (43, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"crm_user_mobile\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614914464);
INSERT INTO `fa_admin_log` VALUES (44, 1, 'admin', '/ozEyjwQdGP.php/general.config/add', '常规管理 / 系统配置 / 添加', '{\"__token__\":\"***\",\"row\":{\"group\":\"basic\",\"type\":\"string\",\"name\":\"crm_user_mobile\",\"title\":\"CRM接口权限账号\",\"setting\":{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"},\"value\":\"13439302541\",\"content\":\"value1|title1\\r\\nvalue2|title2\",\"tip\":\"\",\"rule\":\"\",\"extend\":\"\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614914507);
INSERT INTO `fa_admin_log` VALUES (45, 1, 'admin', '/ozEyjwQdGP.php/general/config/del', '常规管理 / 系统配置 / 删除', '{\"name\":\"crm_user_mobile\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614914678);
INSERT INTO `fa_admin_log` VALUES (46, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"crm_open_userid\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614914693);
INSERT INTO `fa_admin_log` VALUES (47, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"openUserId\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614914697);
INSERT INTO `fa_admin_log` VALUES (48, 1, 'admin', '/ozEyjwQdGP.php/general.config/add', '常规管理 / 系统配置 / 添加', '{\"__token__\":\"***\",\"row\":{\"group\":\"basic\",\"type\":\"string\",\"name\":\"openUserId\",\"title\":\"CRM接口权限账号openUserId\",\"setting\":{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"},\"value\":\"1\",\"content\":\"value1|title1\\r\\nvalue2|title2\",\"tip\":\"\",\"rule\":\"\",\"extend\":\"\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614914719);
INSERT INTO `fa_admin_log` VALUES (49, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"corpId\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614914768);
INSERT INTO `fa_admin_log` VALUES (50, 1, 'admin', '/ozEyjwQdGP.php/general.config/add', '常规管理 / 系统配置 / 添加', '{\"__token__\":\"***\",\"row\":{\"group\":\"basic\",\"type\":\"string\",\"name\":\"corpId\",\"title\":\"企业ID\",\"setting\":{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"},\"value\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\",\"content\":\"value1|title1\\r\\nvalue2|title2\",\"tip\":\"\",\"rule\":\"\",\"extend\":\"\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614914777);
INSERT INTO `fa_admin_log` VALUES (51, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\",\"openUserId\":\"FSUID_AA4249653FB37294711EB0C2462DDC5C\",\"corpId\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614915681);
INSERT INTO `fa_admin_log` VALUES (52, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\",\"openUserId\":\"FSUID_AA4249653FB37294711EB0C2462DDC5C\",\"corpId\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1614916079);
INSERT INTO `fa_admin_log` VALUES (53, 0, 'Unknown', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"wuqb\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 1615010910);
INSERT INTO `fa_admin_log` VALUES (54, 0, 'Unknown', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"jwow\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 1615010920);
INSERT INTO `fa_admin_log` VALUES (55, 1, 'admin', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '登录', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"vrnj\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 1615010924);
INSERT INTO `fa_admin_log` VALUES (56, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/multi', '权限管理 / 菜单规则', '{\"action\":\"\",\"ids\":\"85\",\"params\":\"ismenu=1\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 1615038228);
INSERT INTO `fa_admin_log` VALUES (57, 1, 'admin', '/ozEyjwQdGP.php/command/execute/ids/1', '在线命令管理 / 运行', '{\"ids\":\"1\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 1615038233);
INSERT INTO `fa_admin_log` VALUES (58, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/multi', '权限管理 / 菜单规则', '{\"action\":\"\",\"ids\":\"85\",\"params\":\"ismenu=0\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 1615038245);
INSERT INTO `fa_admin_log` VALUES (59, 1, 'admin', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '登录', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"pmcy\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 1615081904);
INSERT INTO `fa_admin_log` VALUES (60, 0, 'Unknown', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"lyoj\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615179841);
INSERT INTO `fa_admin_log` VALUES (61, 1, 'admin', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '登录', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"rmtv\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615179845);
INSERT INTO `fa_admin_log` VALUES (62, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/multi', '权限管理 / 菜单规则', '{\"action\":\"\",\"ids\":\"85\",\"params\":\"ismenu=1\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615182111);
INSERT INTO `fa_admin_log` VALUES (63, 1, 'admin', '/ozEyjwQdGP.php/command/get_field_list', '在线命令管理', '{\"table\":\"fa_admin\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615182114);
INSERT INTO `fa_admin_log` VALUES (64, 1, 'admin', '/ozEyjwQdGP.php/command/get_field_list', '在线命令管理', '{\"table\":\"fa_not_push_log\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615182118);
INSERT INTO `fa_admin_log` VALUES (65, 1, 'admin', '/ozEyjwQdGP.php/command/command/action/command', '在线命令管理', '{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"0\",\"table\":\"fa_not_push_log\",\"controller\":\"\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615182120);
INSERT INTO `fa_admin_log` VALUES (66, 1, 'admin', '/ozEyjwQdGP.php/command/command/action/execute', '在线命令管理', '{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"0\",\"table\":\"fa_not_push_log\",\"controller\":\"\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615182120);
INSERT INTO `fa_admin_log` VALUES (67, 1, 'admin', '/ozEyjwQdGP.php/command/execute/ids/1', '在线命令管理 / 运行', '{\"ids\":\"1\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615182954);
INSERT INTO `fa_admin_log` VALUES (68, 1, 'admin', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '登录', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"yjkd\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615252637);
INSERT INTO `fa_admin_log` VALUES (69, 1, 'admin', '/ozEyjwQdGP.php/auth/rule/multi', '权限管理 / 菜单规则', '{\"action\":\"\",\"ids\":\"85\",\"params\":\"ismenu=0\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615252647);
INSERT INTO `fa_admin_log` VALUES (70, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\",\"openUserId\":\"FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1\",\"corpId\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615252928);
INSERT INTO `fa_admin_log` VALUES (71, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"business\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615254461);
INSERT INTO `fa_admin_log` VALUES (72, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"business\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615254471);
INSERT INTO `fa_admin_log` VALUES (73, 1, 'admin', '/ozEyjwQdGP.php/general/config/check', '常规管理 / 系统配置', '{\"row\":{\"name\":\"businessCategory\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615254477);
INSERT INTO `fa_admin_log` VALUES (74, 1, 'admin', '/ozEyjwQdGP.php/general.config/add', '常规管理 / 系统配置 / 添加', '{\"__token__\":\"***\",\"row\":{\"group\":\"basic\",\"type\":\"string\",\"name\":\"businessCategory\",\"title\":\"工商分类ID\",\"setting\":{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"},\"value\":\"7\",\"content\":\"value1|title1\\r\\nvalue2|title2\",\"tip\":\"\",\"rule\":\"\",\"extend\":\"\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615254491);
INSERT INTO `fa_admin_log` VALUES (75, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\",\"openUserId\":\"FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1\",\"corpId\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\",\"businessCategory\":\"59\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615254529);
INSERT INTO `fa_admin_log` VALUES (76, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\",\"openUserId\":\"FSUID_AA4249653FB37294711EB0C2462DDC5C\",\"corpId\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\",\"businessCategory\":\"59\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615254972);
INSERT INTO `fa_admin_log` VALUES (77, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\",\"openUserId\":\"FSUID_AA4249653FB37294711EB0C2462DDC5C\",\"corpId\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\",\"businessCategory\":\"7\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615255476);
INSERT INTO `fa_admin_log` VALUES (78, 1, 'admin', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '登录', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"invl\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615424986);
INSERT INTO `fa_admin_log` VALUES (79, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\",\"openUserId\":\"FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1\",\"corpId\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\",\"businessCategory\":\"7\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615425167);
INSERT INTO `fa_admin_log` VALUES (80, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\",\"openUserId\":\"FSUID_AA4249653FB37294711EB0C2462DDC5C\",\"corpId\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\",\"businessCategory\":\"7\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615427998);
INSERT INTO `fa_admin_log` VALUES (81, 1, 'admin', '/ozEyjwQdGP.php/general.config/edit', '常规管理 / 系统配置 / 编辑', '{\"__token__\":\"***\",\"row\":{\"name\":\"我的网站\",\"beian\":\"\",\"cdnurl\":\"\",\"version\":\"1.0.1\",\"timezone\":\"Asia\\/Shanghai\",\"forbiddenip\":\"\",\"languages\":\"{&quot;backend&quot;:&quot;zh-cn&quot;,&quot;frontend&quot;:&quot;zh-cn&quot;}\",\"fixedpage\":\"dashboard\",\"youzan\":\"{&quot;client_id&quot;:&quot;c346b8b39599aaa677&quot;,&quot;client_secret&quot;:&quot;b27a803f9bcbd1de827381d1908bb00e&quot;}\",\"fxiaoke\":\"{&quot;appId&quot;:&quot;FSAID_131984d&quot;,&quot;appSecret&quot;:&quot;fffa814258734095aba2a1004fb21575&quot;,&quot;permanentCode&quot;:&quot;EA7EE44BAC06A6184B9EB6387E797D1F&quot;}\",\"openUserId\":\"FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1\",\"corpId\":\"FSCID_9A5F069FC01BD6193463F2E71672CD0A\",\"businessCategory\":\"7\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615428227);
INSERT INTO `fa_admin_log` VALUES (82, 1, 'admin', '/ozEyjwQdGP.php/index/login?url=%2FozEyjwQdGP.php', '登录', '{\"url\":\"\\/ozEyjwQdGP.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"k7rn\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', 1615519848);

-- ----------------------------
-- Table structure for fa_area
-- ----------------------------
DROP TABLE IF EXISTS `fa_area`;
CREATE TABLE `fa_area`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pid` int(10) NULL DEFAULT NULL COMMENT '父id',
  `shortname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '简称',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '名称',
  `mergename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '全称',
  `level` tinyint(4) NULL DEFAULT NULL COMMENT '层级 0 1 2 省市区县',
  `pinyin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '拼音',
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '长途区号',
  `zip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮编',
  `first` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '首字母',
  `lng` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '经度',
  `lat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '纬度',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '地区表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fa_attachment
-- ----------------------------
DROP TABLE IF EXISTS `fa_attachment`;
CREATE TABLE `fa_attachment`  (
  `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '管理员ID',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员ID',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '物理路径',
  `imagewidth` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '宽度',
  `imageheight` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '高度',
  `imagetype` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '图片类型',
  `imageframes` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片帧数',
  `filename` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '文件名称',
  `filesize` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文件大小',
  `mimetype` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'mime类型',
  `extparam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '透传数据',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建日期',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `uploadtime` int(10) NULL DEFAULT NULL COMMENT '上传时间',
  `storage` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local' COMMENT '存储位置',
  `sha1` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '文件 sha1编码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '附件表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_attachment
-- ----------------------------
INSERT INTO `fa_attachment` VALUES (1, 1, 0, '/assets/img/qrcode.png', '150', '150', 'png', 0, 'qrcode.png', 21859, 'image/png', '', 1499681848, 1499681848, 1499681848, 'local', '17163603d0263e4838b9387ff2cd4877e8b018f6');

-- ----------------------------
-- Table structure for fa_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `fa_auth_group`;
CREATE TABLE `fa_auth_group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父组别',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '组名',
  `rules` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规则ID',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '分组表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_auth_group
-- ----------------------------
INSERT INTO `fa_auth_group` VALUES (1, 0, 'Admin group', '*', 1490883540, 149088354, 'normal');
INSERT INTO `fa_auth_group` VALUES (2, 1, 'Second group', '13,14,16,15,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,40,41,42,43,44,45,46,47,48,49,50,55,56,57,58,59,60,61,62,63,64,65,1,9,10,11,7,6,8,2,4,5', 1490883540, 1505465692, 'normal');
INSERT INTO `fa_auth_group` VALUES (3, 2, 'Third group', '1,4,9,10,11,13,14,15,16,17,40,41,42,43,44,45,46,47,48,49,50,55,56,57,58,59,60,61,62,63,64,65,5', 1490883540, 1502205322, 'normal');
INSERT INTO `fa_auth_group` VALUES (4, 1, 'Second group 2', '1,4,13,14,15,16,17,55,56,57,58,59,60,61,62,63,64,65', 1490883540, 1502205350, 'normal');

-- ----------------------------
-- Table structure for fa_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `fa_auth_group_access`;
CREATE TABLE `fa_auth_group_access`  (
  `uid` int(10) UNSIGNED NOT NULL COMMENT '会员ID',
  `group_id` int(10) UNSIGNED NOT NULL COMMENT '级别ID',
  UNIQUE INDEX `uid_group_id`(`uid`, `group_id`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '权限分组表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_auth_group_access
-- ----------------------------
INSERT INTO `fa_auth_group_access` VALUES (1, 1);

-- ----------------------------
-- Table structure for fa_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `fa_auth_rule`;
CREATE TABLE `fa_auth_rule`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` enum('menu','file') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'file' COMMENT 'menu为菜单,file为权限节点',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父ID',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '规则名称',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '规则名称',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '图标',
  `condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '条件',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '备注',
  `ismenu` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否为菜单',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT 0 COMMENT '权重',
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE,
  INDEX `weigh`(`weigh`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 99 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '节点表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_auth_rule
-- ----------------------------
INSERT INTO `fa_auth_rule` VALUES (1, 'file', 0, 'dashboard', 'Dashboard', 'fa fa-dashboard', '', 'Dashboard tips', 0, 1497429920, 1614649137, 143, 'normal');
INSERT INTO `fa_auth_rule` VALUES (2, 'file', 0, 'general', 'General', 'fa fa-cogs', '', '', 1, 1497429920, 1497430169, 137, 'normal');
INSERT INTO `fa_auth_rule` VALUES (3, 'file', 0, 'category', 'Category', 'fa fa-leaf', '', 'Category tips', 0, 1497429920, 1614649128, 119, 'normal');
INSERT INTO `fa_auth_rule` VALUES (4, 'file', 0, 'addon', 'Addon', 'fa fa-rocket', '', 'Addon tips', 0, 1502035509, 1614650506, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (5, 'file', 0, 'auth', 'Auth', 'fa fa-group', '', '', 1, 1497429920, 1497430092, 99, 'normal');
INSERT INTO `fa_auth_rule` VALUES (6, 'file', 2, 'general/config', 'Config', 'fa fa-cog', '', 'Config tips', 1, 1497429920, 1497430683, 60, 'normal');
INSERT INTO `fa_auth_rule` VALUES (7, 'file', 2, 'general/attachment', 'Attachment', 'fa fa-file-image-o', '', 'Attachment tips', 1, 1497429920, 1497430699, 53, 'normal');
INSERT INTO `fa_auth_rule` VALUES (8, 'file', 2, 'general/profile', 'Profile', 'fa fa-user', '', '', 1, 1497429920, 1497429920, 34, 'normal');
INSERT INTO `fa_auth_rule` VALUES (9, 'file', 5, 'auth/admin', 'Admin', 'fa fa-user', '', 'Admin tips', 1, 1497429920, 1497430320, 118, 'normal');
INSERT INTO `fa_auth_rule` VALUES (10, 'file', 5, 'auth/adminlog', 'Admin log', 'fa fa-list-alt', '', 'Admin log tips', 1, 1497429920, 1497430307, 113, 'normal');
INSERT INTO `fa_auth_rule` VALUES (11, 'file', 5, 'auth/group', 'Group', 'fa fa-group', '', 'Group tips', 1, 1497429920, 1497429920, 109, 'normal');
INSERT INTO `fa_auth_rule` VALUES (12, 'file', 5, 'auth/rule', 'Rule', 'fa fa-bars', '', 'Rule tips', 1, 1497429920, 1497430581, 104, 'normal');
INSERT INTO `fa_auth_rule` VALUES (13, 'file', 1, 'dashboard/index', 'View', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 136, 'normal');
INSERT INTO `fa_auth_rule` VALUES (14, 'file', 1, 'dashboard/add', 'Add', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 135, 'normal');
INSERT INTO `fa_auth_rule` VALUES (15, 'file', 1, 'dashboard/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 133, 'normal');
INSERT INTO `fa_auth_rule` VALUES (16, 'file', 1, 'dashboard/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 134, 'normal');
INSERT INTO `fa_auth_rule` VALUES (17, 'file', 1, 'dashboard/multi', 'Multi', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 132, 'normal');
INSERT INTO `fa_auth_rule` VALUES (18, 'file', 6, 'general/config/index', 'View', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 52, 'normal');
INSERT INTO `fa_auth_rule` VALUES (19, 'file', 6, 'general/config/add', 'Add', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 51, 'normal');
INSERT INTO `fa_auth_rule` VALUES (20, 'file', 6, 'general/config/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 50, 'normal');
INSERT INTO `fa_auth_rule` VALUES (21, 'file', 6, 'general/config/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 49, 'normal');
INSERT INTO `fa_auth_rule` VALUES (22, 'file', 6, 'general/config/multi', 'Multi', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 48, 'normal');
INSERT INTO `fa_auth_rule` VALUES (23, 'file', 7, 'general/attachment/index', 'View', 'fa fa-circle-o', '', 'Attachment tips', 0, 1497429920, 1497429920, 59, 'normal');
INSERT INTO `fa_auth_rule` VALUES (24, 'file', 7, 'general/attachment/select', 'Select attachment', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 58, 'normal');
INSERT INTO `fa_auth_rule` VALUES (25, 'file', 7, 'general/attachment/add', 'Add', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 57, 'normal');
INSERT INTO `fa_auth_rule` VALUES (26, 'file', 7, 'general/attachment/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 56, 'normal');
INSERT INTO `fa_auth_rule` VALUES (27, 'file', 7, 'general/attachment/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 55, 'normal');
INSERT INTO `fa_auth_rule` VALUES (28, 'file', 7, 'general/attachment/multi', 'Multi', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 54, 'normal');
INSERT INTO `fa_auth_rule` VALUES (29, 'file', 8, 'general/profile/index', 'View', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 33, 'normal');
INSERT INTO `fa_auth_rule` VALUES (30, 'file', 8, 'general/profile/update', 'Update profile', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 32, 'normal');
INSERT INTO `fa_auth_rule` VALUES (31, 'file', 8, 'general/profile/add', 'Add', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 31, 'normal');
INSERT INTO `fa_auth_rule` VALUES (32, 'file', 8, 'general/profile/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 30, 'normal');
INSERT INTO `fa_auth_rule` VALUES (33, 'file', 8, 'general/profile/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 29, 'normal');
INSERT INTO `fa_auth_rule` VALUES (34, 'file', 8, 'general/profile/multi', 'Multi', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 28, 'normal');
INSERT INTO `fa_auth_rule` VALUES (35, 'file', 3, 'category/index', 'View', 'fa fa-circle-o', '', 'Category tips', 0, 1497429920, 1497429920, 142, 'normal');
INSERT INTO `fa_auth_rule` VALUES (36, 'file', 3, 'category/add', 'Add', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 141, 'normal');
INSERT INTO `fa_auth_rule` VALUES (37, 'file', 3, 'category/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 140, 'normal');
INSERT INTO `fa_auth_rule` VALUES (38, 'file', 3, 'category/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 139, 'normal');
INSERT INTO `fa_auth_rule` VALUES (39, 'file', 3, 'category/multi', 'Multi', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 138, 'normal');
INSERT INTO `fa_auth_rule` VALUES (40, 'file', 9, 'auth/admin/index', 'View', 'fa fa-circle-o', '', 'Admin tips', 0, 1497429920, 1497429920, 117, 'normal');
INSERT INTO `fa_auth_rule` VALUES (41, 'file', 9, 'auth/admin/add', 'Add', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 116, 'normal');
INSERT INTO `fa_auth_rule` VALUES (42, 'file', 9, 'auth/admin/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 115, 'normal');
INSERT INTO `fa_auth_rule` VALUES (43, 'file', 9, 'auth/admin/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 114, 'normal');
INSERT INTO `fa_auth_rule` VALUES (44, 'file', 10, 'auth/adminlog/index', 'View', 'fa fa-circle-o', '', 'Admin log tips', 0, 1497429920, 1497429920, 112, 'normal');
INSERT INTO `fa_auth_rule` VALUES (45, 'file', 10, 'auth/adminlog/detail', 'Detail', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 111, 'normal');
INSERT INTO `fa_auth_rule` VALUES (46, 'file', 10, 'auth/adminlog/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 110, 'normal');
INSERT INTO `fa_auth_rule` VALUES (47, 'file', 11, 'auth/group/index', 'View', 'fa fa-circle-o', '', 'Group tips', 0, 1497429920, 1497429920, 108, 'normal');
INSERT INTO `fa_auth_rule` VALUES (48, 'file', 11, 'auth/group/add', 'Add', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 107, 'normal');
INSERT INTO `fa_auth_rule` VALUES (49, 'file', 11, 'auth/group/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 106, 'normal');
INSERT INTO `fa_auth_rule` VALUES (50, 'file', 11, 'auth/group/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 105, 'normal');
INSERT INTO `fa_auth_rule` VALUES (51, 'file', 12, 'auth/rule/index', 'View', 'fa fa-circle-o', '', 'Rule tips', 0, 1497429920, 1497429920, 103, 'normal');
INSERT INTO `fa_auth_rule` VALUES (52, 'file', 12, 'auth/rule/add', 'Add', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 102, 'normal');
INSERT INTO `fa_auth_rule` VALUES (53, 'file', 12, 'auth/rule/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 101, 'normal');
INSERT INTO `fa_auth_rule` VALUES (54, 'file', 12, 'auth/rule/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1497429920, 1497429920, 100, 'normal');
INSERT INTO `fa_auth_rule` VALUES (55, 'file', 4, 'addon/index', 'View', 'fa fa-circle-o', '', 'Addon tips', 0, 1502035509, 1502035509, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (56, 'file', 4, 'addon/add', 'Add', 'fa fa-circle-o', '', '', 0, 1502035509, 1502035509, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (57, 'file', 4, 'addon/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1502035509, 1502035509, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (58, 'file', 4, 'addon/del', 'Delete', 'fa fa-circle-o', '', '', 0, 1502035509, 1502035509, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (59, 'file', 4, 'addon/downloaded', 'Local addon', 'fa fa-circle-o', '', '', 0, 1502035509, 1502035509, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (60, 'file', 4, 'addon/state', 'Update state', 'fa fa-circle-o', '', '', 0, 1502035509, 1502035509, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (63, 'file', 4, 'addon/config', 'Setting', 'fa fa-circle-o', '', '', 0, 1502035509, 1502035509, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (64, 'file', 4, 'addon/refresh', 'Refresh', 'fa fa-circle-o', '', '', 0, 1502035509, 1502035509, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (65, 'file', 4, 'addon/multi', 'Multi', 'fa fa-circle-o', '', '', 0, 1502035509, 1502035509, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (66, 'file', 0, 'user', 'User', 'fa fa-list', '', '', 0, 1516374729, 1614649131, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (67, 'file', 66, 'user/user', 'User', 'fa fa-user', '', '', 1, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (68, 'file', 67, 'user/user/index', 'View', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (69, 'file', 67, 'user/user/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (70, 'file', 67, 'user/user/add', 'Add', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (71, 'file', 67, 'user/user/del', 'Del', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (72, 'file', 67, 'user/user/multi', 'Multi', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (73, 'file', 66, 'user/group', 'User group', 'fa fa-users', '', '', 1, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (74, 'file', 73, 'user/group/add', 'Add', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (75, 'file', 73, 'user/group/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (76, 'file', 73, 'user/group/index', 'View', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (77, 'file', 73, 'user/group/del', 'Del', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (78, 'file', 73, 'user/group/multi', 'Multi', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (79, 'file', 66, 'user/rule', 'User rule', 'fa fa-circle-o', '', '', 1, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (80, 'file', 79, 'user/rule/index', 'View', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (81, 'file', 79, 'user/rule/del', 'Del', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (82, 'file', 79, 'user/rule/add', 'Add', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (83, 'file', 79, 'user/rule/edit', 'Edit', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (84, 'file', 79, 'user/rule/multi', 'Multi', 'fa fa-circle-o', '', '', 0, 1516374729, 1516374729, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (85, 'file', 0, 'command', '在线命令管理', 'fa fa-terminal', '', '', 0, 1614649201, 1615252647, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (86, 'file', 85, 'command/index', '查看', 'fa fa-circle-o', '', '', 0, 1614649201, 1614649201, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (87, 'file', 85, 'command/add', '添加', 'fa fa-circle-o', '', '', 0, 1614649201, 1614649201, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (88, 'file', 85, 'command/detail', '详情', 'fa fa-circle-o', '', '', 0, 1614649201, 1614649201, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (89, 'file', 85, 'command/execute', '运行', 'fa fa-circle-o', '', '', 0, 1614649201, 1614649201, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (90, 'file', 85, 'command/del', '删除', 'fa fa-circle-o', '', '', 0, 1614649201, 1614649201, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (91, 'file', 85, 'command/multi', '批量更新', 'fa fa-circle-o', '', '', 0, 1614649201, 1614649201, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (92, 'file', 0, 'push_log', '推送日志管理', 'fa fa-location-arrow', '', '', 1, 1614650269, 1614650492, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (93, 'file', 92, 'push_log/import', 'Import', 'fa fa-circle-o', '', '', 0, 1614650269, 1614650269, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (94, 'file', 92, 'push_log/index', '查看', 'fa fa-circle-o', '', '', 0, 1614650269, 1614650269, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (95, 'file', 92, 'push_log/add', '添加', 'fa fa-circle-o', '', '', 0, 1614650269, 1614650269, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (96, 'file', 92, 'push_log/edit', '编辑', 'fa fa-circle-o', '', '', 0, 1614650269, 1614650269, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (97, 'file', 92, 'push_log/del', '删除', 'fa fa-circle-o', '', '', 0, 1614650269, 1614650269, 0, 'normal');
INSERT INTO `fa_auth_rule` VALUES (98, 'file', 92, 'push_log/multi', '批量更新', 'fa fa-circle-o', '', '', 0, 1614650269, 1614650269, 0, 'normal');

-- ----------------------------
-- Table structure for fa_category
-- ----------------------------
DROP TABLE IF EXISTS `fa_category`;
CREATE TABLE `fa_category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父ID',
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '栏目类型',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '',
  `flag` set('hot','index','recommend') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '',
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '图片',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '描述',
  `diyname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '自定义名称',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT 0 COMMENT '权重',
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `weigh`(`weigh`, `id`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_category
-- ----------------------------
INSERT INTO `fa_category` VALUES (1, 0, 'page', '官方新闻', 'news', 'recommend', '/assets/img/qrcode.png', '', '', 'news', 1495262190, 1495262190, 1, 'normal');
INSERT INTO `fa_category` VALUES (2, 0, 'page', '移动应用', 'mobileapp', 'hot', '/assets/img/qrcode.png', '', '', 'mobileapp', 1495262244, 1495262244, 2, 'normal');
INSERT INTO `fa_category` VALUES (3, 2, 'page', '微信公众号', 'wechatpublic', 'index', '/assets/img/qrcode.png', '', '', 'wechatpublic', 1495262288, 1495262288, 3, 'normal');
INSERT INTO `fa_category` VALUES (4, 2, 'page', 'Android开发', 'android', 'recommend', '/assets/img/qrcode.png', '', '', 'android', 1495262317, 1495262317, 4, 'normal');
INSERT INTO `fa_category` VALUES (5, 0, 'page', '软件产品', 'software', 'recommend', '/assets/img/qrcode.png', '', '', 'software', 1495262336, 1499681850, 5, 'normal');
INSERT INTO `fa_category` VALUES (6, 5, 'page', '网站建站', 'website', 'recommend', '/assets/img/qrcode.png', '', '', 'website', 1495262357, 1495262357, 6, 'normal');
INSERT INTO `fa_category` VALUES (7, 5, 'page', '企业管理软件', 'company', 'index', '/assets/img/qrcode.png', '', '', 'company', 1495262391, 1495262391, 7, 'normal');
INSERT INTO `fa_category` VALUES (8, 6, 'page', 'PC端', 'website-pc', 'recommend', '/assets/img/qrcode.png', '', '', 'website-pc', 1495262424, 1495262424, 8, 'normal');
INSERT INTO `fa_category` VALUES (9, 6, 'page', '移动端', 'website-mobile', 'recommend', '/assets/img/qrcode.png', '', '', 'website-mobile', 1495262456, 1495262456, 9, 'normal');
INSERT INTO `fa_category` VALUES (10, 7, 'page', 'CRM系统 ', 'company-crm', 'recommend', '/assets/img/qrcode.png', '', '', 'company-crm', 1495262487, 1495262487, 10, 'normal');
INSERT INTO `fa_category` VALUES (11, 7, 'page', 'SASS平台软件', 'company-sass', 'recommend', '/assets/img/qrcode.png', '', '', 'company-sass', 1495262515, 1495262515, 11, 'normal');
INSERT INTO `fa_category` VALUES (12, 0, 'test', '测试1', 'test1', 'recommend', '/assets/img/qrcode.png', '', '', 'test1', 1497015727, 1497015727, 12, 'normal');
INSERT INTO `fa_category` VALUES (13, 0, 'test', '测试2', 'test2', 'recommend', '/assets/img/qrcode.png', '', '', 'test2', 1497015738, 1497015738, 13, 'normal');

-- ----------------------------
-- Table structure for fa_command
-- ----------------------------
DROP TABLE IF EXISTS `fa_command`;
CREATE TABLE `fa_command`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '类型',
  `params` varchar(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '参数',
  `command` varchar(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '命令',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '返回结果',
  `executetime` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '执行时间',
  `createtime` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '更新时间',
  `status` enum('successed','failured') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'failured' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '在线命令表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_command
-- ----------------------------
INSERT INTO `fa_command` VALUES (1, 'crud', '[\"--table=fa_push_log\"]', 'php think crud --table=fa_push_log', 'Build Successed', 1614650260, 1614650260, 1614650260, 'successed');
INSERT INTO `fa_command` VALUES (2, 'menu', '[\"--controller=PushLog\"]', 'php think menu --controller=PushLog', 'Build Successed!', 1614650269, 1614650269, 1614650269, 'successed');
INSERT INTO `fa_command` VALUES (3, 'crud', '[\"--table=fa_push_log\"]', 'php think crud --table=fa_push_log', 'Build Successed', 1615038233, 1615038233, 1615038233, 'successed');
INSERT INTO `fa_command` VALUES (4, 'crud', '[\"--table=fa_not_push_log\"]', 'php think crud --table=fa_not_push_log', 'Build Successed', 1615182120, 1615182120, 1615182120, 'successed');
INSERT INTO `fa_command` VALUES (5, 'crud', '[\"--table=fa_push_log\"]', 'php think crud --table=fa_push_log', 'Build Successed', 1615182954, 1615182954, 1615182954, 'successed');

-- ----------------------------
-- Table structure for fa_config
-- ----------------------------
DROP TABLE IF EXISTS `fa_config`;
CREATE TABLE `fa_config`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '变量名',
  `group` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '分组',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '变量标题',
  `tip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '变量描述',
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '类型:string,text,int,bool,array,datetime,date,file',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '变量值',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '变量字典数据',
  `rule` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '验证规则',
  `extend` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '扩展属性',
  `setting` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '配置',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '系统配置' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_config
-- ----------------------------
INSERT INTO `fa_config` VALUES (1, 'name', 'basic', 'Site name', '请填写站点名称', 'string', '我的网站', '', 'required', '', NULL);
INSERT INTO `fa_config` VALUES (2, 'beian', 'basic', 'Beian', '粤ICP备15000000号-1', 'string', '', '', '', '', NULL);
INSERT INTO `fa_config` VALUES (3, 'cdnurl', 'basic', 'Cdn url', '如果全站静态资源使用第三方云储存请配置该值', 'string', '', '', '', '', NULL);
INSERT INTO `fa_config` VALUES (4, 'version', 'basic', 'Version', '如果静态资源有变动请重新配置该值', 'string', '1.0.1', '', 'required', '', NULL);
INSERT INTO `fa_config` VALUES (5, 'timezone', 'basic', 'Timezone', '', 'string', 'Asia/Shanghai', '', 'required', '', NULL);
INSERT INTO `fa_config` VALUES (6, 'forbiddenip', 'basic', 'Forbidden ip', '一行一条记录', 'text', '', '', '', '', NULL);
INSERT INTO `fa_config` VALUES (7, 'languages', 'basic', 'Languages', '', 'array', '{\"backend\":\"zh-cn\",\"frontend\":\"zh-cn\"}', '', 'required', '', NULL);
INSERT INTO `fa_config` VALUES (8, 'fixedpage', 'basic', 'Fixed page', '请尽量输入左侧菜单栏存在的链接', 'string', 'dashboard', '', 'required', '', NULL);
INSERT INTO `fa_config` VALUES (9, 'categorytype', 'dictionary', 'Category type', '', 'array', '{\"default\":\"Default\",\"page\":\"Page\",\"article\":\"Article\",\"test\":\"Test\"}', '', '', '', '');
INSERT INTO `fa_config` VALUES (10, 'configgroup', 'dictionary', 'Config group', '', 'array', '{\"basic\":\"Basic\",\"email\":\"Email\",\"dictionary\":\"Dictionary\",\"user\":\"User\",\"example\":\"Example\"}', '', '', '', '');
INSERT INTO `fa_config` VALUES (11, 'mail_type', 'email', 'Mail type', '选择邮件发送方式', 'select', '1', '[\"请选择\",\"SMTP\"]', '', '', '');
INSERT INTO `fa_config` VALUES (12, 'mail_smtp_host', 'email', 'Mail smtp host', '错误的配置发送邮件会导致服务器超时', 'string', 'smtp.qq.com', '', '', '', '');
INSERT INTO `fa_config` VALUES (13, 'mail_smtp_port', 'email', 'Mail smtp port', '(不加密默认25,SSL默认465,TLS默认587)', 'string', '465', '', '', '', '');
INSERT INTO `fa_config` VALUES (14, 'mail_smtp_user', 'email', 'Mail smtp user', '（填写完整用户名）', 'string', '10000', '', '', '', '');
INSERT INTO `fa_config` VALUES (15, 'mail_smtp_pass', 'email', 'Mail smtp password', '（填写您的密码或授权码）', 'string', 'password', '', '', '', '');
INSERT INTO `fa_config` VALUES (16, 'mail_verify_type', 'email', 'Mail vertify type', '（SMTP验证方式[推荐SSL]）', 'select', '2', '[\"无\",\"TLS\",\"SSL\"]', '', '', '');
INSERT INTO `fa_config` VALUES (17, 'mail_from', 'email', 'Mail from', '', 'string', '10000@qq.com', '', '', '', '');
INSERT INTO `fa_config` VALUES (19, 'youzan', 'basic', '有赞配置', '', 'array', '{\"client_id\":\"c346b8b39599aaa677\",\"client_secret\":\"b27a803f9bcbd1de827381d1908bb00e\"}', '{\"value1\":\"title1\",\"value2\":\"title2\"}', '', '', '{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"}');
INSERT INTO `fa_config` VALUES (20, 'fxiaoke', 'basic', '纷享销客CRM配置', '', 'array', '{\"appId\":\"FSAID_131984d\",\"appSecret\":\"fffa814258734095aba2a1004fb21575\",\"permanentCode\":\"EA7EE44BAC06A6184B9EB6387E797D1F\"}', '{\"value1\":\"title1\",\"value2\":\"title2\"}', '', '', '{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"}');
INSERT INTO `fa_config` VALUES (22, 'openUserId', 'basic', 'CRM接口权限账号openUserId', '', 'string', 'FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1', '', '', '', '{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"}');
INSERT INTO `fa_config` VALUES (23, 'corpId', 'basic', '企业ID', '', 'string', 'FSCID_9A5F069FC01BD6193463F2E71672CD0A', '', '', '', '{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"}');
INSERT INTO `fa_config` VALUES (24, 'businessCategory', 'basic', '工商分类ID', '', 'string', '7', '', '', '', '{\"table\":\"\",\"conditions\":\"\",\"key\":\"\",\"value\":\"\"}');

-- ----------------------------
-- Table structure for fa_ems
-- ----------------------------
DROP TABLE IF EXISTS `fa_ems`;
CREATE TABLE `fa_ems`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `event` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '事件',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '邮箱',
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '验证码',
  `times` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '验证次数',
  `ip` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'IP',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '邮箱验证码表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fa_not_push_log
-- ----------------------------
DROP TABLE IF EXISTS `fa_not_push_log`;
CREATE TABLE `fa_not_push_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `msg_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '消息唯一标示',
  `push_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '触发场景',
  `trigger_time` int(10) NULL DEFAULT NULL COMMENT '触发时间',
  `push_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '推送消息',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '未同步日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fa_push_log
-- ----------------------------
DROP TABLE IF EXISTS `fa_push_log`;
CREATE TABLE `fa_push_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `msg_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '消息唯一标示',
  `order_sn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单号',
  `push_type` enum('create','paid','success') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '触发场景:create=交易创建,paid=交易支付,success=交易成功',
  `trigger_time` int(10) NULL DEFAULT NULL COMMENT '触发时间',
  `push_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '推送消息',
  `sync_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT 'CRM同步状态:0=失败,1=成功',
  `sync_result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'CRM返回结果',
  `sync_time` int(10) NULL DEFAULT NULL COMMENT '同步时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '推送日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fa_sms
-- ----------------------------
DROP TABLE IF EXISTS `fa_sms`;
CREATE TABLE `fa_sms`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `event` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '事件',
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '手机号',
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '验证码',
  `times` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '验证次数',
  `ip` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'IP',
  `createtime` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '短信验证码表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fa_test
-- ----------------------------
DROP TABLE IF EXISTS `fa_test`;
CREATE TABLE `fa_test`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(10) NOT NULL DEFAULT 0 COMMENT '管理员ID',
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类ID(单选)',
  `category_ids` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类ID(多选)',
  `week` enum('monday','tuesday','wednesday') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '星期(单选):monday=星期一,tuesday=星期二,wednesday=星期三',
  `flag` set('hot','index','recommend') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '标志(多选):hot=热门,index=首页,recommend=推荐',
  `genderdata` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male' COMMENT '性别(单选):male=男,female=女',
  `hobbydata` set('music','reading','swimming') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '爱好(多选):music=音乐,reading=读书,swimming=游泳',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '图片',
  `images` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '图片组',
  `attachfile` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '附件',
  `keywords` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '描述',
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '省市',
  `json` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '配置:key=名称,value=值',
  `price` float(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '价格',
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '点击',
  `startdate` date NULL DEFAULT NULL COMMENT '开始日期',
  `activitytime` datetime(0) NULL DEFAULT NULL COMMENT '活动时间(datetime)',
  `year` year NULL DEFAULT NULL COMMENT '年',
  `times` time(0) NULL DEFAULT NULL COMMENT '时间',
  `refreshtime` int(10) NULL DEFAULT NULL COMMENT '刷新时间(int)',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `deletetime` int(10) NULL DEFAULT NULL COMMENT '删除时间',
  `weigh` int(10) NOT NULL DEFAULT 0 COMMENT '权重',
  `switch` tinyint(1) NOT NULL DEFAULT 0 COMMENT '开关',
  `status` enum('normal','hidden') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal' COMMENT '状态',
  `state` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '状态值:0=禁用,1=正常,2=推荐',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '测试表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_test
-- ----------------------------
INSERT INTO `fa_test` VALUES (1, 0, 12, '12,13', 'monday', 'hot,index', 'male', 'music,reading', '我是一篇测试文章', '<p>我是测试内容</p>', '/assets/img/avatar.png', '/assets/img/avatar.png,/assets/img/qrcode.png', '/assets/img/avatar.png', '关键字', '描述', '广西壮族自治区/百色市/平果县', '{\"a\":\"1\",\"b\":\"2\"}', 0.00, 0, '2017-07-10', '2017-07-10 18:24:45', 2017, '18:24:45', 1499682285, 1499682526, 1499682526, NULL, 0, 1, 'normal', '1');

-- ----------------------------
-- Table structure for fa_user
-- ----------------------------
DROP TABLE IF EXISTS `fa_user`;
CREATE TABLE `fa_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '组别ID',
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '昵称',
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '密码盐',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '电子邮箱',
  `mobile` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '手机号',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '头像',
  `level` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '等级',
  `gender` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '性别',
  `birthday` date NULL DEFAULT NULL COMMENT '生日',
  `bio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '格言',
  `money` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '余额',
  `score` int(10) NOT NULL DEFAULT 0 COMMENT '积分',
  `successions` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT '连续登录天数',
  `maxsuccessions` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT '最大连续登录天数',
  `prevtime` int(10) NULL DEFAULT NULL COMMENT '上次登录时间',
  `logintime` int(10) NULL DEFAULT NULL COMMENT '登录时间',
  `loginip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '登录IP',
  `loginfailure` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '失败次数',
  `joinip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '加入IP',
  `jointime` int(10) NULL DEFAULT NULL COMMENT '加入时间',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `token` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'Token',
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '状态',
  `verification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '验证',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `username`(`username`) USING BTREE,
  INDEX `email`(`email`) USING BTREE,
  INDEX `mobile`(`mobile`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_user
-- ----------------------------
INSERT INTO `fa_user` VALUES (1, 1, 'admin', 'admin', 'bc21a85249e6ca0c9d52604fb2221e47', 'e2cafd', 'admin@163.com', '13888888888', '', 0, 0, '2017-04-15', '', 0.00, 0, 1, 1, 1516170492, 1516171614, '127.0.0.1', 0, '127.0.0.1', 1491461418, 0, 1516171614, '', 'normal', '');

-- ----------------------------
-- Table structure for fa_user_group
-- ----------------------------
DROP TABLE IF EXISTS `fa_user_group`;
CREATE TABLE `fa_user_group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '组名',
  `rules` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '权限节点',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '添加时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `status` enum('normal','hidden') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员组表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_user_group
-- ----------------------------
INSERT INTO `fa_user_group` VALUES (1, '默认组', '1,2,3,4,5,6,7,8,9,10,11,12', 1515386468, 1516168298, 'normal');

-- ----------------------------
-- Table structure for fa_user_money_log
-- ----------------------------
DROP TABLE IF EXISTS `fa_user_money_log`;
CREATE TABLE `fa_user_money_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员ID',
  `money` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '变更余额',
  `before` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '变更前余额',
  `after` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '变更后余额',
  `memo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '备注',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员余额变动表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fa_user_rule
-- ----------------------------
DROP TABLE IF EXISTS `fa_user_rule`;
CREATE TABLE `fa_user_rule`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) NULL DEFAULT NULL COMMENT '父ID',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '名称',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '标题',
  `remark` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '备注',
  `ismenu` tinyint(1) NULL DEFAULT NULL COMMENT '是否菜单',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `weigh` int(10) NULL DEFAULT 0 COMMENT '权重',
  `status` enum('normal','hidden') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员规则表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fa_user_rule
-- ----------------------------
INSERT INTO `fa_user_rule` VALUES (1, 0, 'index', 'Frontend', '', 1, 1516168079, 1516168079, 1, 'normal');
INSERT INTO `fa_user_rule` VALUES (2, 0, 'api', 'API Interface', '', 1, 1516168062, 1516168062, 2, 'normal');
INSERT INTO `fa_user_rule` VALUES (3, 1, 'user', 'User Module', '', 1, 1515386221, 1516168103, 12, 'normal');
INSERT INTO `fa_user_rule` VALUES (4, 2, 'user', 'User Module', '', 1, 1515386221, 1516168092, 11, 'normal');
INSERT INTO `fa_user_rule` VALUES (5, 3, 'index/user/login', 'Login', '', 0, 1515386247, 1515386247, 5, 'normal');
INSERT INTO `fa_user_rule` VALUES (6, 3, 'index/user/register', 'Register', '', 0, 1515386262, 1516015236, 7, 'normal');
INSERT INTO `fa_user_rule` VALUES (7, 3, 'index/user/index', 'User Center', '', 0, 1516015012, 1516015012, 9, 'normal');
INSERT INTO `fa_user_rule` VALUES (8, 3, 'index/user/profile', 'Profile', '', 0, 1516015012, 1516015012, 4, 'normal');
INSERT INTO `fa_user_rule` VALUES (9, 4, 'api/user/login', 'Login', '', 0, 1515386247, 1515386247, 6, 'normal');
INSERT INTO `fa_user_rule` VALUES (10, 4, 'api/user/register', 'Register', '', 0, 1515386262, 1516015236, 8, 'normal');
INSERT INTO `fa_user_rule` VALUES (11, 4, 'api/user/index', 'User Center', '', 0, 1516015012, 1516015012, 10, 'normal');
INSERT INTO `fa_user_rule` VALUES (12, 4, 'api/user/profile', 'Profile', '', 0, 1516015012, 1516015012, 3, 'normal');

-- ----------------------------
-- Table structure for fa_user_score_log
-- ----------------------------
DROP TABLE IF EXISTS `fa_user_score_log`;
CREATE TABLE `fa_user_score_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员ID',
  `score` int(10) NOT NULL DEFAULT 0 COMMENT '变更积分',
  `before` int(10) NOT NULL DEFAULT 0 COMMENT '变更前积分',
  `after` int(10) NOT NULL DEFAULT 0 COMMENT '变更后积分',
  `memo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '备注',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员积分变动表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fa_user_token
-- ----------------------------
DROP TABLE IF EXISTS `fa_user_token`;
CREATE TABLE `fa_user_token`  (
  `token` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Token',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员ID',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  `expiretime` int(10) NULL DEFAULT NULL COMMENT '过期时间',
  PRIMARY KEY (`token`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员Token表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fa_version
-- ----------------------------
DROP TABLE IF EXISTS `fa_version`;
CREATE TABLE `fa_version`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `oldversion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '旧版本号',
  `newversion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '新版本号',
  `packagesize` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '包大小',
  `content` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '升级内容',
  `downloadurl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '下载地址',
  `enforce` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '强制更新',
  `createtime` int(10) NULL DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT 0 COMMENT '权重',
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '版本表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
