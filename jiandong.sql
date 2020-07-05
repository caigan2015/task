/*
Navicat MySQL Data Transfer

Source Server         : winUt8
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : jiandong

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2018-02-04 23:10:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_admin_access`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_access`;
CREATE TABLE `t_admin_access` (
  `role_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `node_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0',
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_admin_access
-- ----------------------------

-- ----------------------------
-- Table structure for `t_admin_group`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_group`;
CREATE TABLE `t_admin_group` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT 'icon小图标',
  `sort` int(11) unsigned NOT NULL DEFAULT '50',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_admin_group
-- ----------------------------
INSERT INTO `t_admin_group` VALUES ('1', '系统管理', '&#xe61d;', '2', '1', '', '0', '1450752856', '1516632762');
INSERT INTO `t_admin_group` VALUES ('2', '工具', '&#xe616;', '50', '0', '', '0', '1476016712', '1517468602');
INSERT INTO `t_admin_group` VALUES ('3', '用户管理', '&#xe62c;', '3', '1', '', '0', '1512978708', '1515163451');
INSERT INTO `t_admin_group` VALUES ('4', '基础数据', '&#xe63c;', '7', '1', '球员，队别，赛事', '0', '1515051871', '1515051871');
INSERT INTO `t_admin_group` VALUES ('5', '网站配置', '&#xe62e;', '6', '1', '', '0', '1515137739', '1515137739');
INSERT INTO `t_admin_group` VALUES ('6', '订单管理', '&#xe627;', '5', '1', '', '0', '1515168049', '1515168049');
INSERT INTO `t_admin_group` VALUES ('7', '业务管理', '&#xe639;', '4', '1', '', '0', '1515399836', '1515399836');

-- ----------------------------
-- Table structure for `t_admin_node`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_node`;
CREATE TABLE `t_admin_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '节点类型，1-控制器 | 0-方法',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '50',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`),
  KEY `isdelete` (`isdelete`),
  KEY `sort` (`sort`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_admin_node
-- ----------------------------
INSERT INTO `t_admin_node` VALUES ('1', '0', '1', 'Admin', '后台管理', '后台管理，不可更改', '1', '1', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('2', '1', '1', 'AdminGroup', '分组管理', ' ', '2', '1', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('3', '1', '1', 'AdminNode', '节点管理', ' ', '2', '1', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('4', '1', '1', 'AdminRole', '角色管理', ' ', '2', '1', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('5', '1', '1', 'AdminUser', '用户管理', '', '2', '1', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('6', '1', '0', 'Index', '首页', '', '2', '1', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('7', '6', '0', 'welcome', '欢迎页', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('8', '6', '0', 'index', '未定义', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('9', '1', '2', 'Generate', '代码自动生成', '', '2', '1', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('10', '1', '2', 'Demo/excel', 'Excel一键导出', '', '2', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('11', '1', '2', 'Demo/download', '下载', '', '2', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('12', '1', '2', 'Demo/downloadImage', '远程图片下载', '', '2', '0', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('13', '1', '2', 'Demo/mail', '邮件发送', '', '2', '0', '5', '1', '0');
INSERT INTO `t_admin_node` VALUES ('14', '1', '2', 'Demo/qiniu', '七牛上传', '', '2', '0', '6', '1', '0');
INSERT INTO `t_admin_node` VALUES ('15', '1', '2', 'Demo/hashids', 'ID加密', '', '2', '0', '7', '1', '0');
INSERT INTO `t_admin_node` VALUES ('16', '1', '2', 'Demo/layer', '丰富弹层', '', '2', '0', '8', '1', '0');
INSERT INTO `t_admin_node` VALUES ('17', '1', '2', 'Demo/tableFixed', '表格溢出', '', '2', '0', '9', '1', '0');
INSERT INTO `t_admin_node` VALUES ('18', '1', '2', 'Demo/ueditor', '百度编辑器', '', '2', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('19', '1', '2', 'Demo/imageUpload', '图片上传', '', '2', '0', '11', '1', '0');
INSERT INTO `t_admin_node` VALUES ('20', '1', '2', 'Demo/qrcode', '二维码生成', '', '2', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('21', '1', '1', 'NodeMap', '节点图', '', '2', '1', '5', '1', '0');
INSERT INTO `t_admin_node` VALUES ('22', '1', '1', 'WebLog', '操作日志', '', '2', '1', '6', '1', '0');
INSERT INTO `t_admin_node` VALUES ('23', '1', '1', 'LoginLog', '登录日志', '', '2', '1', '7', '1', '0');
INSERT INTO `t_admin_node` VALUES ('59', '1', '2', 'one.two.three.Four/index', '多级节点', '', '2', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('24', '23', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('25', '22', '0', 'index', '列表', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('26', '22', '0', 'detail', '详情', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('27', '21', '0', 'load', '自动导入', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('28', '21', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('29', '5', '0', 'add', '添加', '', '3', '0', '51', '1', '0');
INSERT INTO `t_admin_node` VALUES ('30', '21', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('31', '21', '0', 'deleteForever', '永久删除', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('32', '9', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('33', '9', '0', 'generate', '生成方法', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('34', '5', '0', 'password', '修改密码', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('35', '5', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('36', '5', '0', 'add', '添加', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('37', '5', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('38', '4', '0', 'user', '用户列表', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('39', '4', '0', 'access', '授权', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('40', '4', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('41', '4', '0', 'add', '添加', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('42', '4', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('43', '4', '0', 'forbid', '默认禁用操作', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('44', '4', '0', 'resume', '默认恢复操作', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('45', '3', '0', 'load', '节点快速导入测试', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('46', '3', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('47', '3', '0', 'add', '添加', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('48', '3', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('49', '3', '0', 'forbid', '默认禁用操作', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('50', '3', '0', 'resume', '默认恢复操作', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('51', '2', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('52', '2', '0', 'add', '添加', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('53', '2', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('54', '2', '0', 'forbid', '默认禁用操作', '', '3', '0', '51', '1', '0');
INSERT INTO `t_admin_node` VALUES ('55', '2', '0', 'resume', '默认恢复操作', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('56', '1', '2', 'one', '一级菜单', '', '2', '1', '13', '1', '0');
INSERT INTO `t_admin_node` VALUES ('60', '56', '2', 'two', '二级', '', '3', '1', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('61', '60', '2', 'three', '三级菜单', '', '4', '1', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('62', '61', '2', 'Four', '四级菜单', '', '5', '1', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('69', '1', '4', 'Member', '球员(会员)管理', '', '2', '1', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('65', '1', '3', 'User/commonlist', '普通用户', '', '2', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('66', '65', '0', 'forbid', '禁用', '', '3', '0', '3', '1', '1');
INSERT INTO `t_admin_node` VALUES ('71', '69', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('77', '1', '4', 'Team', '球队管理', '', '2', '1', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('78', '77', '0', 'index', '首页', '', '3', '0', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('79', '69', '0', 'add', '添加', '', '3', '0', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('80', '65', '0', 'edit', '编辑', '', '3', '0', '4', '1', '1');
INSERT INTO `t_admin_node` VALUES ('81', '1', '4', 'Competition', '赛事管理', '', '2', '1', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('82', '81', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('83', '77', '0', 'add', '添加', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('85', '69', '0', 'edit', '编辑', '', '3', '0', '5', '1', '0');
INSERT INTO `t_admin_node` VALUES ('86', '69', '0', 'deleteForever', '永久删除', '', '3', '0', '6', '1', '0');
INSERT INTO `t_admin_node` VALUES ('87', '1', '5', 'Banners', '广告位管理', '', '2', '1', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('88', '87', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('89', '1', '6', 'Order', '订单列表', '', '2', '1', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('90', '1', '3', 'User/memberlist', '会员用户', '', '2', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('92', '1', '3', 'User', '所有用户', '', '2', '1', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('93', '1', '1', 'Feeds', '意见反馈', '', '2', '1', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('94', '1', '7', 'Business', '业务列表', '', '2', '1', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('95', '94', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('96', '94', '0', 'add', '添加', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('97', '94', '0', 'edit', '编辑', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('98', '1', '7', 'Category', '业务分类', '', '2', '1', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('99', '98', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('100', '98', '0', 'add', '添加', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('101', '98', '0', 'edit', '编辑', '', '3', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('103', '1', '2', 'Demo/alioss', '阿里OSS对象存储', '', '1', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('104', '1', '4', 'CompetitionLive', '直播管理', '', '2', '1', '5', '1', '0');
INSERT INTO `t_admin_node` VALUES ('105', '104', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('106', '104', '0', 'add', '添加', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('107', '77', '0', 'edit', '编辑', '', '3', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('108', '77', '0', 'deleteForever', '永久删除', '', '3', '0', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('109', '81', '0', 'add', '添加', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('110', '81', '0', 'edit', '编辑', '', '3', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('111', '81', '0', 'deleteForever', '永久删除', '', '3', '0', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('112', '104', '0', 'edit', '编辑', '', '3', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('113', '104', '0', 'deleteForever', '永久删除', '', '3', '0', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('114', '93', '0', 'index', '首页', '', '3', '1', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('115', '93', '0', 'edit', '编辑', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('116', '93', '0', 'deleteForever', '永久删除', '', '3', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('117', '90', '0', 'resume', '恢复', '', '3', '0', '4', '1', '1');
INSERT INTO `t_admin_node` VALUES ('118', '90', '0', 'edit', '编辑', '', '3', '0', '2', '1', '1');
INSERT INTO `t_admin_node` VALUES ('119', '65', '0', 'resume', '恢复', '', '3', '0', '4', '1', '1');
INSERT INTO `t_admin_node` VALUES ('120', '90', '0', 'forbid', '禁用', '', '3', '0', '3', '1', '1');
INSERT INTO `t_admin_node` VALUES ('121', '92', '0', 'edit', '编辑', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('122', '92', '0', 'forbid', '禁用', '', '3', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('123', '92', '0', 'resume', '恢复', '', '3', '0', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('124', '94', '0', 'deleteForever', '永久删除', '', '3', '0', '6', '1', '0');
INSERT INTO `t_admin_node` VALUES ('125', '98', '0', 'deleteForever', '永久删除', '', '3', '0', '5', '1', '0');
INSERT INTO `t_admin_node` VALUES ('126', '94', '0', 'forbid', '禁用', '', '3', '0', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('127', '94', '0', 'resume', '恢复', '', '3', '0', '5', '1', '0');
INSERT INTO `t_admin_node` VALUES ('128', '89', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('129', '89', '0', 'edit', '编辑', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('130', '89', '0', 'detail', '详情', '', '3', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('131', '89', '0', 'deleteForever', '永久删除', '', '3', '0', '5', '1', '0');
INSERT INTO `t_admin_node` VALUES ('132', '87', '0', 'edit', '编辑', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('133', '87', '0', 'add', '添加', '', '3', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('134', '87', '0', 'forbid', '禁用', '', '3', '0', '4', '1', '0');
INSERT INTO `t_admin_node` VALUES ('135', '87', '0', 'resume', '恢复', '', '3', '0', '5', '1', '0');
INSERT INTO `t_admin_node` VALUES ('136', '87', '0', 'deleteForever', '永久删除', '', '3', '0', '6', '1', '0');
INSERT INTO `t_admin_node` VALUES ('137', '65', '0', 'deleteForever', '永久删除', '', '3', '0', '50', '1', '1');
INSERT INTO `t_admin_node` VALUES ('138', '90', '0', 'deleteForever', '永久删除', '', '3', '0', '50', '1', '1');
INSERT INTO `t_admin_node` VALUES ('139', '92', '0', 'deleteForever', '永久删除', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('140', '92', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('141', '69', '0', 'team', '参与球队', '', '3', '0', '6', '1', '0');
INSERT INTO `t_admin_node` VALUES ('142', '1', '4', 'CompetitionVideo', '影音管理', '', '2', '1', '7', '1', '0');
INSERT INTO `t_admin_node` VALUES ('144', '142', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('145', '142', '0', 'add', ' 添加', '', '3', '0', '2', '1', '0');
INSERT INTO `t_admin_node` VALUES ('146', '142', '0', 'edit', '编辑', '', '3', '0', '3', '1', '0');
INSERT INTO `t_admin_node` VALUES ('147', '142', '0', 'deleteForever', '永久删除', '', '3', '0', '6', '1', '0');
INSERT INTO `t_admin_node` VALUES ('148', '81', '0', 'team', ' 球队列表', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('150', '92', '0', 'member', '绑定会员', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('149', '69', '0', 'detail', '详情', '', '3', '0', '7', '1', '0');
INSERT INTO `t_admin_node` VALUES ('151', '92', '0', 'unbind', '解绑会员', '', '3', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('152', '1', '3', 'CompetitionApply', '赛事报名', '', '2', '1', '5', '1', '0');
INSERT INTO `t_admin_node` VALUES ('153', '152', '0', 'index', '首页', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('154', '104', '0', 'play', '播放', '', '3', '0', '8', '1', '0');
INSERT INTO `t_admin_node` VALUES ('155', '92', '0', 'recycleBin', '回收站', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('156', '92', '0', 'delete', '删除', '', '3', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('157', '92', '0', 'recycle', '还原', '', '3', '0', '14', '1', '0');
INSERT INTO `t_admin_node` VALUES ('158', '94', '0', 'recycleBin', '回收站', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('159', '94', '0', 'delete', '删除', '', '3', '0', '14', '1', '0');
INSERT INTO `t_admin_node` VALUES ('160', '94', '0', 'recycle', '还原', '', '3', '0', '15', '1', '0');
INSERT INTO `t_admin_node` VALUES ('161', '94', '0', 'clear', '清空回收站', '', '3', '0', '16', '1', '0');
INSERT INTO `t_admin_node` VALUES ('162', '92', '0', 'clear', '清空回收站', '', '3', '0', '16', '1', '0');
INSERT INTO `t_admin_node` VALUES ('163', '98', '0', 'saveOrder', '排序', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('164', '89', '0', 'recycleBin', '回收站', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('165', '89', '0', 'delete', '删除', '', '3', '0', '11', '1', '0');
INSERT INTO `t_admin_node` VALUES ('166', '89', '0', 'recycle', '还原', '', '3', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('167', '89', '0', 'clear', '清空回收站', '', '3', '0', '1', '1', '0');
INSERT INTO `t_admin_node` VALUES ('168', '87', '0', 'saveOrder', '排序', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('169', '87', '0', 'clear', '清空回收站', '', '3', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('170', '87', '0', 'recycle', '还原', '', '3', '0', '14', '1', '0');
INSERT INTO `t_admin_node` VALUES ('171', '69', '0', 'recycle', '还原', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('172', '77', '0', 'recycle', '还原', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('173', '81', '0', 'recycle', '还原', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('174', '104', '0', 'recycle', '还原', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('175', '142', '0', 'recycle', '还原', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('176', '69', '0', 'recycleBin', '回收站', '', '3', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('177', '77', '0', 'recycleBin', '回收站', '', '3', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('178', '81', '0', 'recycleBin', '回收站', '', '3', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('179', '104', '0', 'recycleBin', '回收站', '', '3', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('180', '142', '0', 'recycleBin', '回收站', '', '3', '0', '12', '1', '0');
INSERT INTO `t_admin_node` VALUES ('181', '77', '0', 'delete', '删除', '', '3', '0', '13', '1', '0');
INSERT INTO `t_admin_node` VALUES ('182', '81', '0', 'delete', '删除', '', '3', '0', '13', '1', '0');
INSERT INTO `t_admin_node` VALUES ('183', '104', '0', 'delete', '删除', '', '3', '0', '13', '1', '0');
INSERT INTO `t_admin_node` VALUES ('184', '142', '0', 'delete', '删除', '', '3', '0', '13', '1', '0');
INSERT INTO `t_admin_node` VALUES ('185', '69', '0', 'forbid', '禁用', '', '3', '0', '14', '1', '0');
INSERT INTO `t_admin_node` VALUES ('186', '77', '0', 'forbid', '禁用', '', '3', '0', '14', '1', '0');
INSERT INTO `t_admin_node` VALUES ('187', '81', '0', 'forbid', '禁用', '', '3', '0', '14', '1', '0');
INSERT INTO `t_admin_node` VALUES ('188', '104', '0', 'forbid', '禁用', '', '3', '0', '10', '1', '0');
INSERT INTO `t_admin_node` VALUES ('189', '142', '0', 'forbid', '禁用', '', '3', '0', '14', '1', '0');
INSERT INTO `t_admin_node` VALUES ('190', '81', '0', 'resume', '恢复', '', '3', '0', '15', '1', '0');
INSERT INTO `t_admin_node` VALUES ('191', '77', '0', 'resume', '恢复', '', '3', '0', '15', '1', '0');
INSERT INTO `t_admin_node` VALUES ('192', '104', '0', 'resume', '恢复', '', '3', '0', '15', '1', '0');
INSERT INTO `t_admin_node` VALUES ('193', '142', '0', 'resume', '恢复', '', '3', '0', '50', '1', '0');
INSERT INTO `t_admin_node` VALUES ('194', '69', '0', 'clear', '清空回收站', '', '3', '0', '16', '1', '0');
INSERT INTO `t_admin_node` VALUES ('195', '77', '0', 'clear', '清空回收站', '', '3', '0', '16', '1', '0');
INSERT INTO `t_admin_node` VALUES ('196', '81', '0', 'clear', '清空回收站', '', '3', '0', '16', '1', '0');
INSERT INTO `t_admin_node` VALUES ('197', '104', '0', 'clear', '清空回收站', '', '3', '0', '16', '1', '0');
INSERT INTO `t_admin_node` VALUES ('198', '142', '0', 'clear', '清空回收站', '', '3', '0', '16', '1', '0');
INSERT INTO `t_admin_node` VALUES ('199', '81', '0', 'saveOrder', '排序', '', '3', '0', '17', '1', '0');
INSERT INTO `t_admin_node` VALUES ('200', '69', '0', 'delete', '删除', '', '3', '0', '18', '1', '0');
INSERT INTO `t_admin_node` VALUES ('201', '87', '0', 'delete', '删除', '', '3', '0', '18', '1', '0');

-- ----------------------------
-- Table structure for `t_admin_node_load`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_node_load`;
CREATE TABLE `t_admin_node_load` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='节点快速导入';

-- ----------------------------
-- Records of t_admin_node_load
-- ----------------------------
INSERT INTO `t_admin_node_load` VALUES ('4', '编辑', 'edit', '1');
INSERT INTO `t_admin_node_load` VALUES ('5', '添加', 'add', '1');
INSERT INTO `t_admin_node_load` VALUES ('6', '首页', 'index', '1');
INSERT INTO `t_admin_node_load` VALUES ('7', '删除', 'delete', '1');

-- ----------------------------
-- Table structure for `t_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_role`;
CREATE TABLE `t_admin_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `status` (`status`),
  KEY `isdelete` (`isdelete`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_admin_role
-- ----------------------------
INSERT INTO `t_admin_role` VALUES ('1', '0', '领导组', ' ', '1', '0', '1208784792', '1254325558');
INSERT INTO `t_admin_role` VALUES ('2', '0', '网编组', ' ', '0', '0', '1215496283', '1454049929');

-- ----------------------------
-- Table structure for `t_admin_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_role_user`;
CREATE TABLE `t_admin_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of t_admin_role_user
-- ----------------------------

-- ----------------------------
-- Table structure for `t_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_user`;
CREATE TABLE `t_admin_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(32) NOT NULL DEFAULT '',
  `realname` varchar(255) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0',
  `last_login_ip` char(15) NOT NULL DEFAULT '',
  `login_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `accountpassword` (`account`,`password`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_admin_user
-- ----------------------------
INSERT INTO `t_admin_user` VALUES ('1', 'admin', '超级管理员', 'e10adc3949ba59abbe56e057f20f883e', '1517660017', '127.0.0.1', '426', 'tianpian0805@gmail.com', '13121126169', '我是超级管理员', '1', '0', '1222907803', '1451033528');
INSERT INTO `t_admin_user` VALUES ('2', 'demo', '测试', 'e10adc3949ba59abbe56e057f20f883e', '1481206367', '127.0.0.1', '5', '', '', '', '1', '0', '1476777133', '1477399793');

-- ----------------------------
-- Table structure for `t_banners`
-- ----------------------------
DROP TABLE IF EXISTS `t_banners`;
CREATE TABLE `t_banners` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '广告名称',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型:1移动端2PC端',
  `position` tinyint(5) NOT NULL DEFAULT '0' COMMENT '位置',
  `image_id` int(11) NOT NULL DEFAULT '0',
  `from` tinyint(1) NOT NULL DEFAULT '1',
  `img_url` varchar(500) NOT NULL COMMENT '图片路径',
  `jump_url` varchar(500) NOT NULL COMMENT '链接',
  `display` tinyint(1) NOT NULL DEFAULT '1' COMMENT ' 是否显示',
  `sort` tinyint(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for `t_feeds`
-- ----------------------------
DROP TABLE IF EXISTS `t_feeds`;
CREATE TABLE `t_feeds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(5) NOT NULL DEFAULT '1' COMMENT '类型：2投诉，1建议，3其它',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(25) NOT NULL COMMENT '标题',
  `phone` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `source` tinyint(5) NOT NULL DEFAULT '1' COMMENT '来源：1，公众号；2，APP',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='意见反馈表';

-- ----------------------------
-- Table structure for `t_file`
-- ----------------------------
DROP TABLE IF EXISTS `t_file`;
CREATE TABLE `t_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '文件类型，1-image | 2-file',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `original` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `domain` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT '',
  `size` int(10) unsigned NOT NULL DEFAULT '0',
  `from` tinyint(1) NOT NULL DEFAULT '1' COMMENT '来源1本地2公网',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for `t_login_log`
-- ----------------------------
DROP TABLE IF EXISTS `t_login_log`;
CREATE TABLE `t_login_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `login_ip` char(15) NOT NULL DEFAULT '',
  `login_location` varchar(255) NOT NULL DEFAULT '',
  `login_browser` varchar(255) NOT NULL DEFAULT '',
  `login_os` varchar(255) NOT NULL DEFAULT '',
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for `t_node_map`
-- ----------------------------
DROP TABLE IF EXISTS `t_node_map`;
CREATE TABLE `t_node_map` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(255) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(255) NOT NULL DEFAULT '' COMMENT '方法',
  `method` char(6) NOT NULL DEFAULT '' COMMENT '请求方式',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '节点图描述',
  PRIMARY KEY (`id`),
  KEY `map` (`method`,`module`,`controller`,`action`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='节点图';

-- ----------------------------
-- Table structure for `t_one_two_three_four`
-- ----------------------------
DROP TABLE IF EXISTS `t_one_two_three_four`;
CREATE TABLE `t_one_two_three_four` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '四级控制器主键',
  `field1` varchar(255) DEFAULT NULL COMMENT '字段一',
  `option` varchar(255) DEFAULT NULL COMMENT '选填',
  `select` varchar(255) DEFAULT NULL COMMENT '下拉框',
  `radio` varchar(255) DEFAULT NULL COMMENT '单选',
  `checkbox` varchar(255) DEFAULT NULL COMMENT '复选框',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `textarea` varchar(255) DEFAULT NULL COMMENT '文本域',
  `date` varchar(255) DEFAULT NULL COMMENT '日期',
  `mobile` varchar(255) DEFAULT NULL COMMENT '手机号',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `sort` smallint(5) DEFAULT '50' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态，1-正常 | 0-禁用',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，1-删除 | 0-正常',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='四级控制器';

-- ----------------------------
-- Records of t_one_two_three_four
-- ----------------------------
INSERT INTO `t_one_two_three_four` VALUES ('1', 'yuan1994', 'tpadmin', '2', '1', null, '2222', 'https://github.com/yuan1994/tpadmin', '2016-12-07', '13012345678', 'tianpian0805@gmail.com', '50', '1', '0', '1481947278', '1481947353');

-- ----------------------------
-- Table structure for tp_web_log_001
-- ----------------------------
DROP TABLE IF EXISTS `t_web_log_001`;
CREATE TABLE `t_web_log_001` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志主键',
  `uid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `ip` char(15) NOT NULL DEFAULT '' COMMENT '访客ip',
  `location` varchar(255) NOT NULL DEFAULT '' COMMENT '访客地址',
  `os` varchar(255) NOT NULL DEFAULT '' COMMENT '操作系统',
  `browser` varchar(255) NOT NULL DEFAULT '' COMMENT '浏览器',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'url',
  `module` varchar(255) NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(255) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(255) NOT NULL DEFAULT '' COMMENT '方法',
  `method` char(6) NOT NULL DEFAULT '' COMMENT '请求方式',
  `data` text COMMENT '请求的param数据，serialize后的',
  `create_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `ip` (`ip`),
  KEY `create_at` (`create_at`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站日志';

-- ----------------------------
-- Table structure for `t_web_log_all`
-- ----------------------------
DROP TABLE IF EXISTS `t_web_log_all`;
CREATE TABLE `t_web_log_all` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志主键',
  `uid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `ip` char(15) NOT NULL DEFAULT '' COMMENT '访客ip',
  `location` varchar(255) NOT NULL DEFAULT '' COMMENT '访客地址',
  `os` varchar(255) NOT NULL DEFAULT '' COMMENT '操作系统',
  `browser` varchar(255) NOT NULL DEFAULT '' COMMENT '浏览器',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'url',
  `module` varchar(255) NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(255) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(255) NOT NULL DEFAULT '' COMMENT '方法',
  `method` char(6) NOT NULL DEFAULT '' COMMENT '请求方式',
  `data` text COMMENT '请求的param数据，serialize后的',
  `create_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `ip` (`ip`) USING BTREE,
  KEY `create_at` (`create_at`) USING BTREE
) ENGINE=MRG_MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC INSERT_METHOD=LAST UNION=(`t_web_log_001`) COMMENT='网站日志';

-- ----------------------------
-- Records of t_web_log_all
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
