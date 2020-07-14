-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: task
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `t_admin_access`
--

DROP TABLE IF EXISTS `t_admin_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_admin_access` (
  `role_id` smallint unsigned NOT NULL DEFAULT '0',
  `node_id` smallint unsigned NOT NULL DEFAULT '0',
  `level` tinyint unsigned NOT NULL DEFAULT '0',
  `pid` smallint unsigned NOT NULL DEFAULT '0',
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_access`
--

LOCK TABLES `t_admin_access` WRITE;
/*!40000 ALTER TABLE `t_admin_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_admin_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_group`
--

DROP TABLE IF EXISTS `t_admin_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_admin_group` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT 'icon小图标',
  `sort` int unsigned NOT NULL DEFAULT '50',
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `isdelete` tinyint unsigned NOT NULL DEFAULT '0',
  `create_time` int unsigned NOT NULL DEFAULT '0',
  `update_time` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_group`
--

LOCK TABLES `t_admin_group` WRITE;
/*!40000 ALTER TABLE `t_admin_group` DISABLE KEYS */;
INSERT INTO `t_admin_group` VALUES (1,'系统管理','&#xe61d;',2,1,'',0,1450752856,1516632762),(2,'工具','&#xe616;',50,0,'',0,1476016712,1517468602),(3,'用户管理','&#xe62c;',3,1,'',0,1512978708,1515163451),(4,'基础数据','&#xe63c;',7,1,'球员，队别，赛事',0,1515051871,1515051871),(5,'网站配置','&#xe62e;',6,1,'',0,1515137739,1515137739),(6,'订单管理','&#xe627;',5,1,'',0,1515168049,1515168049),(7,'业务管理','&#xe639;',4,1,'',0,1515399836,1515399836);
/*!40000 ALTER TABLE `t_admin_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_node`
--

DROP TABLE IF EXISTS `t_admin_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_admin_node` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint unsigned NOT NULL DEFAULT '0',
  `group_id` tinyint unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `level` tinyint unsigned NOT NULL DEFAULT '0',
  `type` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '节点类型，1-控制器 | 0-方法',
  `sort` smallint unsigned NOT NULL DEFAULT '50',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `isdelete` tinyint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`),
  KEY `isdelete` (`isdelete`),
  KEY `sort` (`sort`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_node`
--

LOCK TABLES `t_admin_node` WRITE;
/*!40000 ALTER TABLE `t_admin_node` DISABLE KEYS */;
INSERT INTO `t_admin_node` VALUES (1,0,1,'Admin','后台管理','后台管理，不可更改',1,1,1,1,0),(2,1,1,'AdminGroup','分组管理',' ',2,1,1,1,0),(3,1,1,'AdminNode','节点管理',' ',2,1,2,1,0),(4,1,1,'AdminRole','角色管理',' ',2,1,3,1,0),(5,1,1,'AdminUser','用户管理','',2,1,4,1,0),(6,1,0,'Index','首页','',2,1,50,1,0),(7,6,0,'welcome','欢迎页','',3,0,50,1,0),(8,6,0,'index','未定义','',3,0,50,1,0),(9,1,2,'Generate','代码自动生成','',2,1,1,1,0),(10,1,2,'Demo/excel','Excel一键导出','',2,0,2,1,0),(11,1,2,'Demo/download','下载','',2,0,3,1,0),(12,1,2,'Demo/downloadImage','远程图片下载','',2,0,4,1,0),(13,1,2,'Demo/mail','邮件发送','',2,0,5,1,0),(14,1,2,'Demo/qiniu','七牛上传','',2,0,6,1,0),(15,1,2,'Demo/hashids','ID加密','',2,0,7,1,0),(16,1,2,'Demo/layer','丰富弹层','',2,0,8,1,0),(17,1,2,'Demo/tableFixed','表格溢出','',2,0,9,1,0),(18,1,2,'Demo/ueditor','百度编辑器','',2,0,10,1,0),(19,1,2,'Demo/imageUpload','图片上传','',2,0,11,1,0),(20,1,2,'Demo/qrcode','二维码生成','',2,0,12,1,0),(21,1,1,'NodeMap','节点图','',2,1,5,1,0),(22,1,1,'WebLog','操作日志','',2,1,6,1,0),(23,1,1,'LoginLog','登录日志','',2,1,7,1,0),(59,1,2,'one.two.three.Four/index','多级节点','',2,0,50,1,0),(24,23,0,'index','首页','',3,0,50,1,0),(25,22,0,'index','列表','',3,0,50,1,0),(26,22,0,'detail','详情','',3,0,50,1,0),(27,21,0,'load','自动导入','',3,0,50,1,0),(28,21,0,'index','首页','',3,0,50,1,0),(29,5,0,'add','添加','',3,0,51,1,0),(30,21,0,'edit','编辑','',3,0,50,1,0),(31,21,0,'deleteForever','永久删除','',3,0,50,1,0),(32,9,0,'index','首页','',3,0,50,1,0),(33,9,0,'generate','生成方法','',3,0,50,1,0),(34,5,0,'password','修改密码','',3,0,50,1,0),(35,5,0,'index','首页','',3,0,50,1,0),(36,5,0,'add','添加','',3,0,50,1,0),(37,5,0,'edit','编辑','',3,0,50,1,0),(38,4,0,'user','用户列表','',3,0,50,1,0),(39,4,0,'access','授权','',3,0,50,1,0),(40,4,0,'index','首页','',3,0,50,1,0),(41,4,0,'add','添加','',3,0,50,1,0),(42,4,0,'edit','编辑','',3,0,50,1,0),(43,4,0,'forbid','默认禁用操作','',3,0,50,1,0),(44,4,0,'resume','默认恢复操作','',3,0,50,1,0),(45,3,0,'load','节点快速导入测试','',3,0,50,1,0),(46,3,0,'index','首页','',3,0,50,1,0),(47,3,0,'add','添加','',3,0,50,1,0),(48,3,0,'edit','编辑','',3,0,50,1,0),(49,3,0,'forbid','默认禁用操作','',3,0,50,1,0),(50,3,0,'resume','默认恢复操作','',3,0,50,1,0),(51,2,0,'index','首页','',3,0,50,1,0),(52,2,0,'add','添加','',3,0,50,1,0),(53,2,0,'edit','编辑','',3,0,50,1,0),(54,2,0,'forbid','默认禁用操作','',3,0,51,1,0),(55,2,0,'resume','默认恢复操作','',3,0,50,1,0),(56,1,2,'one','一级菜单','',2,1,13,1,0),(60,56,2,'two','二级','',3,1,50,1,0),(61,60,2,'three','三级菜单','',4,1,50,1,0),(62,61,2,'Four','四级菜单','',5,1,50,1,0),(69,1,4,'Member','球员(会员)管理','',2,1,2,1,0),(65,1,3,'User/commonlist','普通用户','',2,0,3,1,0),(66,65,0,'forbid','禁用','',3,0,3,1,1),(71,69,0,'index','首页','',3,0,1,1,0),(77,1,4,'Team','球队管理','',2,1,3,1,0),(78,77,0,'index','首页','',3,0,4,1,0),(79,69,0,'add','添加','',3,0,4,1,0),(80,65,0,'edit','编辑','',3,0,4,1,1),(81,1,4,'Competition','赛事管理','',2,1,4,1,0),(82,81,0,'index','首页','',3,0,1,1,0),(83,77,0,'add','添加','',3,0,2,1,0),(85,69,0,'edit','编辑','',3,0,5,1,0),(86,69,0,'deleteForever','永久删除','',3,0,6,1,0),(87,1,5,'Banners','广告位管理','',2,1,1,1,0),(88,87,0,'index','首页','',3,0,1,1,0),(89,1,6,'Order','订单列表','',2,1,1,1,0),(90,1,3,'User/memberlist','会员用户','',2,0,2,1,0),(92,1,3,'User','所有用户','',2,1,1,1,0),(93,1,1,'Feeds','意见反馈','',2,1,10,1,0),(94,1,7,'Business','业务列表','',2,1,1,1,0),(95,94,0,'index','首页','',3,0,1,1,0),(96,94,0,'add','添加','',3,0,2,1,0),(97,94,0,'edit','编辑','',3,0,2,1,0),(98,1,7,'Category','业务分类','',2,1,2,1,0),(99,98,0,'index','首页','',3,0,1,1,0),(100,98,0,'add','添加','',3,0,2,1,0),(101,98,0,'edit','编辑','',3,0,3,1,0),(103,1,2,'Demo/alioss','阿里OSS对象存储','',1,0,50,1,0),(104,1,4,'CompetitionLive','直播管理','',2,1,5,1,0),(105,104,0,'index','首页','',3,0,1,1,0),(106,104,0,'add','添加','',3,0,2,1,0),(107,77,0,'edit','编辑','',3,0,3,1,0),(108,77,0,'deleteForever','永久删除','',3,0,4,1,0),(109,81,0,'add','添加','',3,0,2,1,0),(110,81,0,'edit','编辑','',3,0,3,1,0),(111,81,0,'deleteForever','永久删除','',3,0,4,1,0),(112,104,0,'edit','编辑','',3,0,3,1,0),(113,104,0,'deleteForever','永久删除','',3,0,4,1,0),(114,93,0,'index','首页','',3,1,1,1,0),(115,93,0,'edit','编辑','',3,0,2,1,0),(116,93,0,'deleteForever','永久删除','',3,0,3,1,0),(117,90,0,'resume','恢复','',3,0,4,1,1),(118,90,0,'edit','编辑','',3,0,2,1,1),(119,65,0,'resume','恢复','',3,0,4,1,1),(120,90,0,'forbid','禁用','',3,0,3,1,1),(121,92,0,'edit','编辑','',3,0,2,1,0),(122,92,0,'forbid','禁用','',3,0,3,1,0),(123,92,0,'resume','恢复','',3,0,4,1,0),(124,94,0,'deleteForever','永久删除','',3,0,6,1,0),(125,98,0,'deleteForever','永久删除','',3,0,5,1,0),(126,94,0,'forbid','禁用','',3,0,4,1,0),(127,94,0,'resume','恢复','',3,0,5,1,0),(128,89,0,'index','首页','',3,0,1,1,0),(129,89,0,'edit','编辑','',3,0,2,1,0),(130,89,0,'detail','详情','',3,0,3,1,0),(131,89,0,'deleteForever','永久删除','',3,0,5,1,0),(132,87,0,'edit','编辑','',3,0,2,1,0),(133,87,0,'add','添加','',3,0,3,1,0),(134,87,0,'forbid','禁用','',3,0,4,1,0),(135,87,0,'resume','恢复','',3,0,5,1,0),(136,87,0,'deleteForever','永久删除','',3,0,6,1,0),(137,65,0,'deleteForever','永久删除','',3,0,50,1,1),(138,90,0,'deleteForever','永久删除','',3,0,50,1,1),(139,92,0,'deleteForever','永久删除','',3,0,50,1,0),(140,92,0,'index','首页','',3,0,1,1,0),(141,69,0,'team','参与球队','',3,0,6,1,0),(142,1,4,'CompetitionVideo','影音管理','',2,1,7,1,0),(144,142,0,'index','首页','',3,0,1,1,0),(145,142,0,'add',' 添加','',3,0,2,1,0),(146,142,0,'edit','编辑','',3,0,3,1,0),(147,142,0,'deleteForever','永久删除','',3,0,6,1,0),(148,81,0,'team',' 球队列表','',3,0,10,1,0),(150,92,0,'member','绑定会员','',3,0,10,1,0),(149,69,0,'detail','详情','',3,0,7,1,0),(151,92,0,'unbind','解绑会员','',3,0,12,1,0),(152,1,3,'CompetitionApply','赛事报名','',2,1,5,1,0),(153,152,0,'index','首页','',3,0,1,1,0),(154,104,0,'play','播放','',3,0,8,1,0),(155,92,0,'recycleBin','回收站','',3,0,10,1,0),(156,92,0,'delete','删除','',3,0,12,1,0),(157,92,0,'recycle','还原','',3,0,14,1,0),(158,94,0,'recycleBin','回收站','',3,0,10,1,0),(159,94,0,'delete','删除','',3,0,14,1,0),(160,94,0,'recycle','还原','',3,0,15,1,0),(161,94,0,'clear','清空回收站','',3,0,16,1,0),(162,92,0,'clear','清空回收站','',3,0,16,1,0),(163,98,0,'saveOrder','排序','',3,0,10,1,0),(164,89,0,'recycleBin','回收站','',3,0,10,1,0),(165,89,0,'delete','删除','',3,0,11,1,0),(166,89,0,'recycle','还原','',3,0,12,1,0),(167,89,0,'clear','清空回收站','',3,0,1,1,0),(168,87,0,'saveOrder','排序','',3,0,10,1,0),(169,87,0,'clear','清空回收站','',3,0,12,1,0),(170,87,0,'recycle','还原','',3,0,14,1,0),(171,69,0,'recycle','还原','',3,0,10,1,0),(172,77,0,'recycle','还原','',3,0,10,1,0),(173,81,0,'recycle','还原','',3,0,10,1,0),(174,104,0,'recycle','还原','',3,0,10,1,0),(175,142,0,'recycle','还原','',3,0,10,1,0),(176,69,0,'recycleBin','回收站','',3,0,12,1,0),(177,77,0,'recycleBin','回收站','',3,0,12,1,0),(178,81,0,'recycleBin','回收站','',3,0,12,1,0),(179,104,0,'recycleBin','回收站','',3,0,12,1,0),(180,142,0,'recycleBin','回收站','',3,0,12,1,0),(181,77,0,'delete','删除','',3,0,13,1,0),(182,81,0,'delete','删除','',3,0,13,1,0),(183,104,0,'delete','删除','',3,0,13,1,0),(184,142,0,'delete','删除','',3,0,13,1,0),(185,69,0,'forbid','禁用','',3,0,14,1,0),(186,77,0,'forbid','禁用','',3,0,14,1,0),(187,81,0,'forbid','禁用','',3,0,14,1,0),(188,104,0,'forbid','禁用','',3,0,10,1,0),(189,142,0,'forbid','禁用','',3,0,14,1,0),(190,81,0,'resume','恢复','',3,0,15,1,0),(191,77,0,'resume','恢复','',3,0,15,1,0),(192,104,0,'resume','恢复','',3,0,15,1,0),(193,142,0,'resume','恢复','',3,0,50,1,0),(194,69,0,'clear','清空回收站','',3,0,16,1,0),(195,77,0,'clear','清空回收站','',3,0,16,1,0),(196,81,0,'clear','清空回收站','',3,0,16,1,0),(197,104,0,'clear','清空回收站','',3,0,16,1,0),(198,142,0,'clear','清空回收站','',3,0,16,1,0),(199,81,0,'saveOrder','排序','',3,0,17,1,0),(200,69,0,'delete','删除','',3,0,18,1,0),(201,87,0,'delete','删除','',3,0,18,1,0);
/*!40000 ALTER TABLE `t_admin_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_node_load`
--

DROP TABLE IF EXISTS `t_admin_node_load`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_admin_node_load` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='节点快速导入';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_node_load`
--

LOCK TABLES `t_admin_node_load` WRITE;
/*!40000 ALTER TABLE `t_admin_node_load` DISABLE KEYS */;
INSERT INTO `t_admin_node_load` VALUES (4,'编辑','edit',1),(5,'添加','add',1),(6,'首页','index',1),(7,'删除','delete',1);
/*!40000 ALTER TABLE `t_admin_node_load` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_role`
--

DROP TABLE IF EXISTS `t_admin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_admin_role` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `status` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `isdelete` tinyint unsigned NOT NULL DEFAULT '0',
  `create_time` int unsigned NOT NULL DEFAULT '0',
  `update_time` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `status` (`status`),
  KEY `isdelete` (`isdelete`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_role`
--

LOCK TABLES `t_admin_role` WRITE;
/*!40000 ALTER TABLE `t_admin_role` DISABLE KEYS */;
INSERT INTO `t_admin_role` VALUES (1,0,'领导组',' ',1,0,1208784792,1254325558),(2,0,'网编组',' ',0,0,1215496283,1454049929);
/*!40000 ALTER TABLE `t_admin_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_role_user`
--

DROP TABLE IF EXISTS `t_admin_role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_admin_role_user` (
  `role_id` mediumint unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_role_user`
--

LOCK TABLES `t_admin_role_user` WRITE;
/*!40000 ALTER TABLE `t_admin_role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_admin_role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_user`
--

DROP TABLE IF EXISTS `t_admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_admin_user` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT,
  `account` char(32) NOT NULL DEFAULT '',
  `realname` varchar(255) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `last_login_time` int unsigned NOT NULL DEFAULT '0',
  `last_login_ip` char(15) NOT NULL DEFAULT '',
  `login_count` mediumint unsigned NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint unsigned NOT NULL DEFAULT '50',
  `isdelete` tinyint unsigned NOT NULL DEFAULT '0',
  `create_time` int unsigned NOT NULL DEFAULT '0',
  `update_time` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `accountpassword` (`account`,`password`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_user`
--

LOCK TABLES `t_admin_user` WRITE;
/*!40000 ALTER TABLE `t_admin_user` DISABLE KEYS */;
INSERT INTO `t_admin_user` VALUES (1,'admin','超级管理员','e10adc3949ba59abbe56e057f20f883e',1593846293,'127.0.0.1',427,'tianpian0805@gmail.com','13121126169','我是超级管理员',1,0,1222907803,1451033528),(2,'demo','测试','e10adc3949ba59abbe56e057f20f883e',1481206367,'127.0.0.1',5,'','','',1,0,1476777133,1477399793);
/*!40000 ALTER TABLE `t_admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_banners`
--

DROP TABLE IF EXISTS `t_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_banners` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '广告名称',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `type` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '类型:1移动端2PC端',
  `position` tinyint NOT NULL DEFAULT '0' COMMENT '位置',
  `image_id` int NOT NULL DEFAULT '0',
  `from` tinyint(1) NOT NULL DEFAULT '1',
  `img_url` varchar(500) NOT NULL COMMENT '图片路径',
  `jump_url` varchar(500) NOT NULL COMMENT '链接',
  `display` tinyint(1) NOT NULL DEFAULT '1' COMMENT ' 是否显示',
  `sort` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '状态',
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int NOT NULL COMMENT '创建时间',
  `update_time` int NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_banners`
--

LOCK TABLES `t_banners` WRITE;
/*!40000 ALTER TABLE `t_banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_category`
--

DROP TABLE IF EXISTS `t_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL COMMENT '分類名',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT 'イメージ',
  `sort` tinyint NOT NULL DEFAULT '0' COMMENT 'ソート',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(32) NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='タスク分類';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_category`
--

LOCK TABLES `t_category` WRITE;
/*!40000 ALTER TABLE `t_category` DISABLE KEYS */;
INSERT INTO `t_category` VALUES (1,'Task','',0,1,'','2020-02-02 12:12:12','2020-02-02 12:12:12');
/*!40000 ALTER TABLE `t_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_chatting`
--

DROP TABLE IF EXISTS `t_chatting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_chatting` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL DEFAULT '0',
  `user_id` int unsigned NOT NULL DEFAULT '0',
  `user_type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '0、applyer;1,offer owmer',
  `content` text NOT NULL,
  `file` varchar(225) NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='チャット表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_chatting`
--

LOCK TABLES `t_chatting` WRITE;
/*!40000 ALTER TABLE `t_chatting` DISABLE KEYS */;
INSERT INTO `t_chatting` VALUES (1,3,5,1,'&amp;lt;a&amp;gt;&amp;lt;/a&amp;gt;','','2020-07-06 16:42:27','2020-07-06 16:42:27');
/*!40000 ALTER TABLE `t_chatting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_config`
--

DROP TABLE IF EXISTS `t_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_config` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL,
  `value` text NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='構成アイテム';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_config`
--

LOCK TABLES `t_config` WRITE;
/*!40000 ALTER TABLE `t_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_feeds`
--

DROP TABLE IF EXISTS `t_feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_feeds` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint NOT NULL DEFAULT '1' COMMENT '类型：2投诉，1建议，3其它',
  `user_id` int NOT NULL DEFAULT '0',
  `title` varchar(25) NOT NULL COMMENT '标题',
  `phone` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `source` tinyint NOT NULL DEFAULT '1' COMMENT '来源：1，公众号；2，APP',
  `create_time` int NOT NULL DEFAULT '0',
  `update_time` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='意见反馈表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_feeds`
--

LOCK TABLES `t_feeds` WRITE;
/*!40000 ALTER TABLE `t_feeds` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_file`
--

DROP TABLE IF EXISTS `t_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_file` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `cate` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '文件类型，1-image | 2-file',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `original` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `domain` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT '',
  `size` int unsigned NOT NULL DEFAULT '0',
  `from` tinyint(1) NOT NULL DEFAULT '1' COMMENT '来源1本地2公网',
  `mtime` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_file`
--

LOCK TABLES `t_file` WRITE;
/*!40000 ALTER TABLE `t_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_login_log`
--

DROP TABLE IF EXISTS `t_login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_login_log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint unsigned NOT NULL DEFAULT '0',
  `login_ip` char(15) NOT NULL DEFAULT '',
  `login_location` varchar(255) NOT NULL DEFAULT '',
  `login_browser` varchar(255) NOT NULL DEFAULT '',
  `login_os` varchar(255) NOT NULL DEFAULT '',
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_login_log`
--

LOCK TABLES `t_login_log` WRITE;
/*!40000 ALTER TABLE `t_login_log` DISABLE KEYS */;
INSERT INTO `t_login_log` VALUES (42,1,'127.0.0.1','本机地址 本机地址  ','Chrome(83.0.4103.116)','Windows 10','2020-07-04 07:04:53');
/*!40000 ALTER TABLE `t_login_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_node_map`
--

DROP TABLE IF EXISTS `t_node_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_node_map` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(255) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(255) NOT NULL DEFAULT '' COMMENT '方法',
  `method` char(6) NOT NULL DEFAULT '' COMMENT '请求方式',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '节点图描述',
  PRIMARY KEY (`id`),
  KEY `map` (`method`,`module`,`controller`,`action`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='节点图';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_node_map`
--

LOCK TABLES `t_node_map` WRITE;
/*!40000 ALTER TABLE `t_node_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_node_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_offer`
--

DROP TABLE IF EXISTS `t_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_offer` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL DEFAULT '0',
  `request_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'リクエストの種類：1、ASK；2、TAKE',
  `title` varchar(225) NOT NULL COMMENT 'タイトル',
  `category_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '分類ID',
  `description` text NOT NULL COMMENT '紹介',
  `key_word` varchar(255) NOT NULL DEFAULT '' COMMENT 'キーワード',
  `image` varchar(225) NOT NULL DEFAULT '' COMMENT 'イメージ',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状態：1、正常、0、無効',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_offer`
--

LOCK TABLES `t_offer` WRITE;
/*!40000 ALTER TABLE `t_offer` DISABLE KEYS */;
INSERT INTO `t_offer` VALUES (1,1,3,'dddddddddddddddd',1,'hhhhhhhhhhhhhhhhh','adsfasdf','','',1,'2020-02-02 15:55:00','2020-07-05 23:48:39'),(2,1,2,'白',2,'ddd','ggg','','ggg',1,'2020-02-02 15:55:00','2020-02-02 15:55:00'),(3,1,3,'dddddddddddddddd',0,'hhhhhhhhhhhhhhhhh','adsfasdf','','',1,'2020-07-05 23:35:59','2020-07-05 23:49:26');
/*!40000 ALTER TABLE `t_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_one_two_three_four`
--

DROP TABLE IF EXISTS `t_one_two_three_four`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_one_two_three_four` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '四级控制器主键',
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
  `sort` smallint DEFAULT '50' COMMENT '排序',
  `status` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '状态，1-正常 | 0-禁用',
  `isdelete` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，1-删除 | 0-正常',
  `create_time` int unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='四级控制器';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_one_two_three_four`
--

LOCK TABLES `t_one_two_three_four` WRITE;
/*!40000 ALTER TABLE `t_one_two_three_four` DISABLE KEYS */;
INSERT INTO `t_one_two_three_four` VALUES (1,'yuan1994','tpadmin','2','1',NULL,'2222','https://github.com/yuan1994/tpadmin','2016-12-07','13012345678','tianpian0805@gmail.com',50,1,0,1481947278,1481947353);
/*!40000 ALTER TABLE `t_one_two_three_four` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_order`
--

DROP TABLE IF EXISTS `t_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_order` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(45) NOT NULL COMMENT '注文コード',
  `price` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '値段金額',
  `quote_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '見積もりユーザ：0、オーナーない；1、オーナー',
  `user_id` int NOT NULL DEFAULT '0' COMMENT 'ユーザーID',
  `offer_id` int unsigned NOT NULL DEFAULT '0' COMMENT 'タスクID',
  `pay_amount` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '実際払う金額',
  `pay_way` tinyint(1) NOT NULL DEFAULT '0' COMMENT '払う方法：1、銀行で口座振替；2、他の',
  `pay_time` datetime DEFAULT NULL COMMENT '実際払う時間',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '備考',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '注文の状態：-1、無効；0、両方確認待ち；1、支払い待ち；2、運営方お金を確認；3、タスク済みの確認；4、全額支払い済み確認；5、キャンセル',
  `snap_items` text NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_no_UNIQUE` (`order_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='注文表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_order`
--

LOCK TABLES `t_order` WRITE;
/*!40000 ALTER TABLE `t_order` DISABLE KEYS */;
INSERT INTO `t_order` VALUES (1,'12',222,0,1,1,1000,1,'2020-02-01 12:12:12','aaa',1,'asasas','2020-02-01 12:12:12','2020-02-01 12:12:12'),(2,'0.61626300 1594001940',0,0,5,1,0,0,NULL,'',-1,'{\"id\":1,\"user_id\":1,\"request_type\":3,\"title\":\"dddddddddddddddd\",\"category_id\":1,\"description\":\"hhhhhhhhhhhhhhhhh\",\"key_word\":\"adsfasdf\",\"image\":\"\",\"remark\":\"\",\"status\":1,\"isdelete\":0,\"create_time\":\"2020-02-02 15:55:00\",\"update_time\":\"2020-07-05 23:48:39\"}','2020-07-06 11:19:00','2020-07-06 11:44:59'),(3,'20200706112232000000',1000,1,5,1,0,0,NULL,'',3,'{\"id\":1,\"user_id\":1,\"request_type\":3,\"title\":\"dddddddddddddddd\",\"category_id\":1,\"description\":\"hhhhhhhhhhhhhhhhh\",\"key_word\":\"adsfasdf\",\"image\":\"\",\"remark\":\"\",\"status\":1,\"isdelete\":0,\"create_time\":\"2020-02-02 15:55:00\",\"update_time\":\"2020-07-05 23:48:39\"}','2020-07-06 11:22:32','2020-07-06 13:59:25'),(4,'20200706112441046127',0,0,5,1,0,0,NULL,'',0,'{\"id\":1,\"user_id\":1,\"request_type\":3,\"title\":\"dddddddddddddddd\",\"category_id\":1,\"description\":\"hhhhhhhhhhhhhhhhh\",\"key_word\":\"adsfasdf\",\"image\":\"\",\"remark\":\"\",\"status\":1,\"isdelete\":0,\"create_time\":\"2020-02-02 15:55:00\",\"update_time\":\"2020-07-05 23:48:39\"}','2020-07-06 11:24:41','2020-07-06 11:24:41'),(5,'TASK20200706112628203415',0,0,5,1,0,0,NULL,'',0,'{\"id\":1,\"user_id\":1,\"request_type\":3,\"title\":\"dddddddddddddddd\",\"category_id\":1,\"description\":\"hhhhhhhhhhhhhhhhh\",\"key_word\":\"adsfasdf\",\"image\":\"\",\"remark\":\"\",\"status\":1,\"isdelete\":0,\"create_time\":\"2020-02-02 15:55:00\",\"update_time\":\"2020-07-05 23:48:39\"}','2020-07-06 11:26:28','2020-07-06 11:26:28');
/*!40000 ALTER TABLE `t_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ユーザー表',
  `e_mail` varchar(45) NOT NULL COMMENT 'メール',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT 'ニックネーム',
  `realname` varchar(32) NOT NULL DEFAULT '' COMMENT '氏名（銀行口座一致',
  `password` char(32) NOT NULL COMMENT 'パスワード(md5)',
  `head_img` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `introduce` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT 'ユーザー状態：１、正常；０、禁止',
  `login_time` datetime NOT NULL COMMENT 'ログインタイム',
  `new_message_num` int NOT NULL DEFAULT '0' COMMENT '新しいメッセージ数',
  `bank_name` varchar(32) NOT NULL DEFAULT '' COMMENT '銀行名',
  `bank_branch` varchar(32) NOT NULL DEFAULT '' COMMENT '銀行支店名',
  `bank_account` varchar(32) NOT NULL DEFAULT '' COMMENT '銀行口座',
  `token` varchar(100) NOT NULL DEFAULT '' COMMENT '令牌',
  `register_time` datetime NOT NULL COMMENT '登録タイム',
  `update_time` datetime NOT NULL COMMENT '更新タイム',
  PRIMARY KEY (`id`),
  UNIQUE KEY `e_mail_UNIQUE` (`e_mail`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES (1,'366585748@qq.com','caicaizi','','e10adc3949ba59abbe56e057f20f883e','','',1,'2020-07-06 10:11:10',0,'aaaaaaa','bbbbbbbbbb','1233211312312','','2020-07-04 23:52:15','2020-07-06 10:11:10'),(5,'332902909@qq.com','caiyingwen','','e10adc3949ba59abbe56e057f20f883e','','',1,'2020-07-06 16:59:43',0,'','','','','2020-07-06 10:40:52','2020-07-06 16:59:43');
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_web_log_001`
--

DROP TABLE IF EXISTS `t_web_log_001`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_web_log_001` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '日志主键',
  `uid` smallint unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
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
  `create_at` int unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `ip` (`ip`),
  KEY `create_at` (`create_at`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='网站日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_web_log_001`
--

LOCK TABLES `t_web_log_001` WRITE;
/*!40000 ALTER TABLE `t_web_log_001` DISABLE KEYS */;
INSERT INTO `t_web_log_001` VALUES (1,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/','admin','Index','index','GET','a:0:{}',1593846283),(2,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/pub/login.html','admin','Pub','login','GET','a:0:{}',1593846283),(3,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/pub/checklogin.html','admin','Pub','checklogin','POST','a:3:{s:7:\"account\";s:5:\"admin\";s:8:\"password\";s:6:\"123456\";s:7:\"captcha\";s:4:\"scij\";}',1593846293),(4,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/index.html','admin','Index','index','GET','a:0:{}',1593846293),(5,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/welcome.html','admin','Index','welcome','GET','a:0:{}',1593846294),(6,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_group/index.html','admin','AdminGroup','index','GET','a:0:{}',1593846308),(7,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/index.html','admin','Index','index','GET','a:0:{}',1593847916),(8,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/welcome.html','admin','Index','welcome','GET','a:0:{}',1593847916),(9,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/index.html','admin','Index','index','GET','a:0:{}',1593847921),(10,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/welcome.html','admin','Index','welcome','GET','a:0:{}',1593847921),(11,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/index.html','admin','Index','index','GET','a:0:{}',1593847975),(12,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/welcome.html','admin','Index','welcome','GET','a:0:{}',1593847975),(13,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/index.html','admin','Index','index','GET','a:0:{}',1593856617),(14,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/welcome.html','admin','Index','welcome','GET','a:0:{}',1593856617),(15,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_group/index.html','admin','AdminGroup','index','GET','a:0:{}',1593856732),(16,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_node/index.html','admin','AdminNode','index','GET','a:0:{}',1593856747),(17,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_node/index','admin','AdminNode','index','POST','a:2:{s:4:\"type\";s:5:\"group\";s:9:\"module_id\";s:1:\"1\";}',1593856748),(18,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_node/index','admin','AdminNode','index','POST','a:3:{s:4:\"type\";s:4:\"node\";s:9:\"module_id\";s:1:\"1\";s:8:\"group_id\";s:1:\"1\";}',1593856748),(19,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_role/index.html','admin','AdminRole','index','GET','a:0:{}',1593856749),(20,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/node_map/index.html','admin','NodeMap','index','GET','a:0:{}',1593856751),(21,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/web_log/index.html','admin','WebLog','index','GET','a:0:{}',1593856752),(22,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/node_map/index.html','admin','NodeMap','index','GET','a:0:{}',1593856753),(23,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_user/index.html','admin','AdminUser','index','GET','a:0:{}',1593856755),(24,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_node/index.html','admin','AdminNode','index','GET','a:0:{}',1593856763),(25,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_node/index','admin','AdminNode','index','POST','a:2:{s:4:\"type\";s:5:\"group\";s:9:\"module_id\";s:1:\"1\";}',1593856764),(26,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_node/index','admin','AdminNode','index','POST','a:3:{s:4:\"type\";s:4:\"node\";s:9:\"module_id\";s:1:\"1\";s:8:\"group_id\";s:1:\"1\";}',1593856764),(27,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/admin_group/index.html','admin','AdminGroup','index','GET','a:0:{}',1593856767),(28,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin','admin','Index','index','GET','a:0:{}',1593857415),(29,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/welcome.html','admin','Index','welcome','GET','a:0:{}',1593857415),(30,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/banners/index.html','admin','Banners','index','GET','a:0:{}',1593857531),(31,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin','admin','Index','index','GET','a:0:{}',1593861894),(32,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/index/welcome.html','admin','Index','welcome','GET','a:0:{}',1593861895),(33,1,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/pub/logout.html','admin','Pub','logout','GET','a:0:{}',1593861902),(34,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/pub/login.html','admin','Pub','login','GET','a:0:{}',1593861905),(35,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin','admin','Index','index','GET','a:0:{}',1593921836),(36,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/pub/login.html','admin','Pub','login','GET','a:0:{}',1593921836),(37,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/pub/login.html','admin','Pub','login','GET','a:0:{}',1593921911),(38,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/pub/login.html','admin','Pub','login','GET','a:0:{}',1593922495),(39,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin','admin','Index','index','GET','a:0:{}',1593941335),(40,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/pub/login.html','admin','Pub','login','GET','a:0:{}',1593941335),(41,0,'127.0.0.1','本机地址 本机地址  ','Windows 10','Chrome(83.0.4103.116)','http://www.task.jp/admin/pub/login.html','admin','Pub','login','GET','a:0:{}',1593941336);
/*!40000 ALTER TABLE `t_web_log_001` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_web_log_all`
--

DROP TABLE IF EXISTS `t_web_log_all`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_web_log_all` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '日志主键',
  `uid` smallint unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
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
  `create_at` int unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `ip` (`ip`) USING BTREE,
  KEY `create_at` (`create_at`) USING BTREE
) ENGINE=MRG_MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC INSERT_METHOD=LAST UNION=(`t_web_log_001`) COMMENT='网站日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'task'
--

--
-- Dumping routines for database 'task'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-06 18:52:29
