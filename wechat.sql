/*
MySQL Data Transfer
Source Host: 121.199.40.122
Source Database: wechat
Target Host: 121.199.40.122
Target Database: wechat
Date: 2016/5/25 16:46:37
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for we_company
-- ----------------------------
CREATE TABLE `we_company` (
  `companyid` int(10) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `systemid` varchar(32) DEFAULT NULL COMMENT '系统标识  公司编号+sys+管理员账号',
  `company` varchar(100) DEFAULT NULL COMMENT '公司名称',
  `website` varchar(255) DEFAULT NULL COMMENT '官网链接',
  `address` varchar(255) DEFAULT NULL COMMENT '公司地址',
  `linkman` varchar(50) DEFAULT NULL COMMENT '公司联系人',
  `telephone` varchar(50) DEFAULT NULL COMMENT '联系电话',
  `seatnum` int(10) DEFAULT '2' COMMENT '客服席位数量',
  `receptnum` int(10) DEFAULT '10' COMMENT '席位最大接待量',
  `savetime` int(10) DEFAULT '0' COMMENT '聊天记录保存时间 单位天',
  `style` char(20) DEFAULT 'default' COMMENT '客户端样式',
  `title` varchar(20) DEFAULT NULL COMMENT '浮动框标题',
  `welcome` varchar(255) DEFAULT NULL COMMENT '欢迎语设置',
  `status` tinyint(1) DEFAULT '1' COMMENT '公司状态 0禁用 1待审核 2审核不通过 3审核通过 4暂时关闭',
  PRIMARY KEY (`companyid`),
  UNIQUE KEY `systemid` (`systemid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='公司表';

-- ----------------------------
-- Table structure for we_dialog_content
-- ----------------------------
CREATE TABLE `we_dialog_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `dialogid` int(10) DEFAULT NULL COMMENT '对话编号',
  `content` text COMMENT '对话详情',
  `type` char(10) DEFAULT 'chat' COMMENT 'chat 聊天  message留言',
  `sendtime` int(10) DEFAULT '0' COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=utf8 COMMENT='对话内容表';

-- ----------------------------
-- Table structure for we_dialog_relation
-- ----------------------------
CREATE TABLE `we_dialog_relation` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `companyid` int(10) DEFAULT NULL COMMENT '公司编号',
  `cuid` int(10) DEFAULT NULL COMMENT '客服编号',
  `visitid` varchar(32) DEFAULT NULL COMMENT '访客编号',
  `creattime` int(10) DEFAULT '0' COMMENT '对话创建时间',
  `neartime` int(10) DEFAULT '0' COMMENT '近最对话时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COMMENT='对话关系表';

-- ----------------------------
-- Table structure for we_user
-- ----------------------------
CREATE TABLE `we_user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `account` varchar(50) DEFAULT NULL COMMENT '用户账号',
  `truename` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `nickname` varchar(50) DEFAULT NULL COMMENT '用户昵称',
  `password` varchar(32) DEFAULT NULL COMMENT '用户密码',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `auth` tinyint(1) DEFAULT '2' COMMENT '权限 1客服超级管理员 2普通客服',
  `companyid` int(10) DEFAULT NULL COMMENT '所属公司id',
  `regtime` int(10) DEFAULT '0' COMMENT '注册时间',
  `regip` varchar(50) DEFAULT NULL COMMENT '册注ip',
  `logintime` int(10) DEFAULT '0' COMMENT '最后登录时间',
  `loginip` varchar(50) DEFAULT NULL COMMENT '最后登录ip',
  `status` tinyint(1) DEFAULT '1' COMMENT '用户状态 0禁用 1待审核 2审核不通过 3审核通过',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `account` (`account`),
  KEY `companyid` (`auth`,`companyid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Table structure for we_visitor
-- ----------------------------
CREATE TABLE `we_visitor` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `visitid` varchar(32) DEFAULT NULL COMMENT '访客编号',
  `username` varchar(50) DEFAULT NULL COMMENT '姓名',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `region` varchar(20) DEFAULT NULL COMMENT '地区',
  `address` varchar(100) DEFAULT NULL COMMENT '详细地址',
  `ip` varchar(50) DEFAULT NULL COMMENT 'ip地址',
  `terminal` varchar(255) DEFAULT NULL COMMENT '终端信息',
  PRIMARY KEY (`id`),
  UNIQUE KEY `visitnum` (`visitid`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COMMENT='访客信息表';

-- ----------------------------
-- Records 
-- ----------------------------

INSERT INTO `we_company` VALUES ('4', '22ff8396577d3fab74042bb33a50d907', null, null, null, null, null, '2', '10', '0', 'default', null, null, '3');
INSERT INTO `we_company` VALUES ('5', 'a97d64b7eec04170c15083eb5553be65', null, null, null, null, null, '2', '10', '0', 'default', null, null, '3');
INSERT INTO `we_company` VALUES ('6', '32da85b536538c50d952f6491a36e0f1', null, null, null, null, null, '2', '10', '0', 'default', null, null, '3');
INSERT INTO `we_company` VALUES ('7', 'a3853439a705fe5fbf99b2399175d4c7', null, null, null, null, null, '2', '10', '0', 'default', null, null, '3');
INSERT INTO `we_dialog_content` VALUES ('7', '1', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460707446');
INSERT INTO `we_dialog_content` VALUES ('8', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460709958');
INSERT INTO `we_dialog_content` VALUES ('9', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460709984');
INSERT INTO `we_dialog_content` VALUES ('10', '2', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"你好\";s:4:\"from\";s:2:\"18\";s:2:\"to\";s:20:\"7f0000010b5400000003\";}', 'chat', '1460710002');
INSERT INTO `we_dialog_content` VALUES ('11', '2', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:5:\"hello\";s:4:\"from\";s:2:\"18\";s:2:\"to\";s:20:\"7f0000010b5400000003\";}', 'chat', '1460710004');
INSERT INTO `we_dialog_content` VALUES ('12', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710029');
INSERT INTO `we_dialog_content` VALUES ('13', '2', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"年后\";s:4:\"from\";s:20:\"7f0000010b5400000003\";s:2:\"to\";s:2:\"18\";}', 'chat', '1460710032');
INSERT INTO `we_dialog_content` VALUES ('14', '2', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_8]\";s:4:\"from\";s:20:\"7f0000010b5400000003\";s:2:\"to\";s:2:\"18\";}', 'chat', '1460710036');
INSERT INTO `we_dialog_content` VALUES ('15', '2', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:9:\"哈哈哈\";s:4:\"from\";s:20:\"7f0000010b5400000003\";s:2:\"to\";s:2:\"18\";}', 'chat', '1460710039');
INSERT INTO `we_dialog_content` VALUES ('16', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710046');
INSERT INTO `we_dialog_content` VALUES ('17', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710098');
INSERT INTO `we_dialog_content` VALUES ('18', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710762');
INSERT INTO `we_dialog_content` VALUES ('19', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710798');
INSERT INTO `we_dialog_content` VALUES ('20', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710832');
INSERT INTO `we_dialog_content` VALUES ('21', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710862');
INSERT INTO `we_dialog_content` VALUES ('22', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710895');
INSERT INTO `we_dialog_content` VALUES ('23', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710938');
INSERT INTO `we_dialog_content` VALUES ('24', '2', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"阿萨\";s:4:\"from\";s:20:\"7f0000010b5400000003\";s:2:\"to\";s:2:\"18\";}', 'chat', '1460710944');
INSERT INTO `we_dialog_content` VALUES ('25', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710947');
INSERT INTO `we_dialog_content` VALUES ('26', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710954');
INSERT INTO `we_dialog_content` VALUES ('27', '2', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"你好\";s:4:\"from\";s:2:\"18\";s:2:\"to\";s:20:\"7f0000010b5400000003\";}', 'chat', '1460710965');
INSERT INTO `we_dialog_content` VALUES ('28', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710980');
INSERT INTO `we_dialog_content` VALUES ('29', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460710998');
INSERT INTO `we_dialog_content` VALUES ('30', '2', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460711523');
INSERT INTO `we_dialog_content` VALUES ('31', '2', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"年后\";s:4:\"from\";s:20:\"7f0000010b5400000003\";s:2:\"to\";s:2:\"18\";}', 'chat', '1460711530');
INSERT INTO `we_dialog_content` VALUES ('32', '3', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460713932');
INSERT INTO `we_dialog_content` VALUES ('33', '3', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"年后\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b5400000003\";}', 'chat', '1460713945');
INSERT INTO `we_dialog_content` VALUES ('34', '3', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"阿萨\";s:4:\"from\";s:20:\"7f0000010b5400000003\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460713949');
INSERT INTO `we_dialog_content` VALUES ('35', '3', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460713954');
INSERT INTO `we_dialog_content` VALUES ('36', '3', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460713956');
INSERT INTO `we_dialog_content` VALUES ('37', '3', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460714026');
INSERT INTO `we_dialog_content` VALUES ('38', '4', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460729714');
INSERT INTO `we_dialog_content` VALUES ('39', '5', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460729738');
INSERT INTO `we_dialog_content` VALUES ('40', '5', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_1]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b5400000013\";}', 'chat', '1460729750');
INSERT INTO `we_dialog_content` VALUES ('41', '5', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"123\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b5400000013\";}', 'chat', '1460729761');
INSERT INTO `we_dialog_content` VALUES ('42', '5', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:11:\"[em_3]5555.\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b5400000013\";}', 'chat', '1460729772');
INSERT INTO `we_dialog_content` VALUES ('43', '5', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:19:\"j n s n[em_4]\";s:4:\"from\";s:20:\"7f0000010b5400000013\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460729872');
INSERT INTO `we_dialog_content` VALUES ('44', '5', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"你好\";s:4:\"from\";s:20:\"7f0000010b5400000013\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460729877');
INSERT INTO `we_dialog_content` VALUES ('45', '6', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460729923');
INSERT INTO `we_dialog_content` VALUES ('46', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"亲亲\";s:4:\"from\";s:20:\"7f0000010b540000001d\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460729933');
INSERT INTO `we_dialog_content` VALUES ('47', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_1]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000001d\";}', 'chat', '1460729946');
INSERT INTO `we_dialog_content` VALUES ('48', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:4:\"haha\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000001d\";}', 'chat', '1460729950');
INSERT INTO `we_dialog_content` VALUES ('49', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_6]\";s:4:\"from\";s:20:\"7f0000010b540000001d\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460729951');
INSERT INTO `we_dialog_content` VALUES ('50', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:5:\"hello\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000001d\";}', 'chat', '1460729956');
INSERT INTO `we_dialog_content` VALUES ('51', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:7:\"[em_10]\";s:4:\"from\";s:20:\"7f0000010b540000001d\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460729964');
INSERT INTO `we_dialog_content` VALUES ('52', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_1]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000001d\";}', 'chat', '1460729992');
INSERT INTO `we_dialog_content` VALUES ('53', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"1\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000001d\";}', 'chat', '1460729997');
INSERT INTO `we_dialog_content` VALUES ('54', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"1\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000001d\";}', 'chat', '1460729997');
INSERT INTO `we_dialog_content` VALUES ('55', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"1\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000001d\";}', 'chat', '1460729997');
INSERT INTO `we_dialog_content` VALUES ('56', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"1\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000001d\";}', 'chat', '1460729998');
INSERT INTO `we_dialog_content` VALUES ('57', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"1\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000001d\";}', 'chat', '1460729998');
INSERT INTO `we_dialog_content` VALUES ('58', '6', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_5]\";s:4:\"from\";s:20:\"7f0000010b540000001d\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460730014');
INSERT INTO `we_dialog_content` VALUES ('59', '5', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:9:\"吧吧吧\";s:4:\"from\";s:20:\"7f0000010b5400000013\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460730083');
INSERT INTO `we_dialog_content` VALUES ('60', '7', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460730096');
INSERT INTO `we_dialog_content` VALUES ('61', '7', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:8:\"qq[em_2]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b5400000029\";}', 'chat', '1460730105');
INSERT INTO `we_dialog_content` VALUES ('62', '7', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"11\";s:4:\"from\";s:20:\"7f0000010b5400000029\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460730109');
INSERT INTO `we_dialog_content` VALUES ('63', '7', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:7:\"[em_11]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b5400000029\";}', 'chat', '1460730114');
INSERT INTO `we_dialog_content` VALUES ('64', '7', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_9]\";s:4:\"from\";s:20:\"7f0000010b5400000029\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460730121');
INSERT INTO `we_dialog_content` VALUES ('65', '5', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:7:\"[em_11]\";s:4:\"from\";s:20:\"7f0000010b5400000013\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460730289');
INSERT INTO `we_dialog_content` VALUES ('66', '5', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_8]\";s:4:\"from\";s:20:\"7f0000010b5400000013\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460730293');
INSERT INTO `we_dialog_content` VALUES ('67', '8', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460730396');
INSERT INTO `we_dialog_content` VALUES ('68', '9', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460730496');
INSERT INTO `we_dialog_content` VALUES ('69', '9', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"哈比\";s:4:\"from\";s:20:\"7f0000010b540000004e\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460730503');
INSERT INTO `we_dialog_content` VALUES ('70', '9', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"2.\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000004e\";}', 'chat', '1460730530');
INSERT INTO `we_dialog_content` VALUES ('71', '9', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_1]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000004e\";}', 'chat', '1460730534');
INSERT INTO `we_dialog_content` VALUES ('72', '9', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_4]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000004e\";}', 'chat', '1460730538');
INSERT INTO `we_dialog_content` VALUES ('73', '9', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_2]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000004e\";}', 'chat', '1460730656');
INSERT INTO `we_dialog_content` VALUES ('74', '9', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:7:\"[em_11]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000004e\";}', 'chat', '1460730662');
INSERT INTO `we_dialog_content` VALUES ('75', '7', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_2]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b5400000029\";}', 'chat', '1460730869');
INSERT INTO `we_dialog_content` VALUES ('76', '4', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460731128');
INSERT INTO `we_dialog_content` VALUES ('77', '4', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_1]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b540000000d\";}', 'chat', '1460731140');
INSERT INTO `we_dialog_content` VALUES ('78', '4', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460731145');
INSERT INTO `we_dialog_content` VALUES ('79', '4', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460731151');
INSERT INTO `we_dialog_content` VALUES ('80', '4', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"212\";s:4:\"from\";s:20:\"7f0000010b540000000d\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460731159');
INSERT INTO `we_dialog_content` VALUES ('81', '4', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460731165');
INSERT INTO `we_dialog_content` VALUES ('82', '5', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"说啥\";s:4:\"from\";s:20:\"7f0000010b5400000013\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460731655');
INSERT INTO `we_dialog_content` VALUES ('83', '10', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460777417');
INSERT INTO `we_dialog_content` VALUES ('84', '10', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_2]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b560000000c\";}', 'chat', '1460777786');
INSERT INTO `we_dialog_content` VALUES ('85', '10', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_2]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b560000000c\";}', 'chat', '1460778591');
INSERT INTO `we_dialog_content` VALUES ('86', '10', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_2]\";s:4:\"from\";s:20:\"7f0000010b560000000c\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460778597');
INSERT INTO `we_dialog_content` VALUES ('87', '11', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460779437');
INSERT INTO `we_dialog_content` VALUES ('88', '10', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460816523');
INSERT INTO `we_dialog_content` VALUES ('89', '10', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460816540');
INSERT INTO `we_dialog_content` VALUES ('90', '12', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460940331');
INSERT INTO `we_dialog_content` VALUES ('91', '12', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_2]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b5700000035\";}', 'chat', '1460940337');
INSERT INTO `we_dialog_content` VALUES ('92', '12', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"阿萨\";s:4:\"from\";s:20:\"7f0000010b5700000035\";s:2:\"to\";s:2:\"14\";}', 'chat', '1460940342');
INSERT INTO `we_dialog_content` VALUES ('93', '13', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460940985');
INSERT INTO `we_dialog_content` VALUES ('94', '13', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460941020');
INSERT INTO `we_dialog_content` VALUES ('95', '13', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:5:\"hello\";s:4:\"from\";s:20:\"7f0000010b5700000049\";s:2:\"to\";s:2:\"19\";}', 'chat', '1460941027');
INSERT INTO `we_dialog_content` VALUES ('96', '13', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460941045');
INSERT INTO `we_dialog_content` VALUES ('97', '13', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460941050');
INSERT INTO `we_dialog_content` VALUES ('98', '13', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1460941069');
INSERT INTO `we_dialog_content` VALUES ('99', '3', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461140410');
INSERT INTO `we_dialog_content` VALUES ('100', '3', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"562\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b5400000003\";}', 'chat', '1461140415');
INSERT INTO `we_dialog_content` VALUES ('101', '3', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"62\";s:4:\"from\";s:20:\"7f0000010b5400000003\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461140421');
INSERT INTO `we_dialog_content` VALUES ('102', '3', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461140673');
INSERT INTO `we_dialog_content` VALUES ('103', '14', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461286814');
INSERT INTO `we_dialog_content` VALUES ('104', '15', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461286835');
INSERT INTO `we_dialog_content` VALUES ('105', '16', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461287102');
INSERT INTO `we_dialog_content` VALUES ('106', '17', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461287115');
INSERT INTO `we_dialog_content` VALUES ('107', '17', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461287118');
INSERT INTO `we_dialog_content` VALUES ('108', '17', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461287244');
INSERT INTO `we_dialog_content` VALUES ('109', '18', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461287249');
INSERT INTO `we_dialog_content` VALUES ('110', '19', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461288749');
INSERT INTO `we_dialog_content` VALUES ('111', '20', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:7:\"阿萨.\";s:4:\"from\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461288754');
INSERT INTO `we_dialog_content` VALUES ('112', '21', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"啊\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";}', 'chat', '1461288762');
INSERT INTO `we_dialog_content` VALUES ('113', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461288929');
INSERT INTO `we_dialog_content` VALUES ('114', '22', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"阿萨\";s:4:\"from\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461288930');
INSERT INTO `we_dialog_content` VALUES ('115', '22', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"啊\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";}', 'chat', '1461288936');
INSERT INTO `we_dialog_content` VALUES ('116', '22', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_3]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";}', 'chat', '1461288948');
INSERT INTO `we_dialog_content` VALUES ('117', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461288960');
INSERT INTO `we_dialog_content` VALUES ('118', '22', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"在\";s:4:\"from\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461288962');
INSERT INTO `we_dialog_content` VALUES ('119', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461289076');
INSERT INTO `we_dialog_content` VALUES ('120', '22', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_3]\";s:4:\"from\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461289088');
INSERT INTO `we_dialog_content` VALUES ('121', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461289353');
INSERT INTO `we_dialog_content` VALUES ('122', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461289436');
INSERT INTO `we_dialog_content` VALUES ('123', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461289473');
INSERT INTO `we_dialog_content` VALUES ('124', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461301122');
INSERT INTO `we_dialog_content` VALUES ('125', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461301274');
INSERT INTO `we_dialog_content` VALUES ('126', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461301276');
INSERT INTO `we_dialog_content` VALUES ('127', '22', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_3]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";}', 'chat', '1461301280');
INSERT INTO `we_dialog_content` VALUES ('128', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461301284');
INSERT INTO `we_dialog_content` VALUES ('129', '22', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"阿萨\";s:4:\"from\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461301285');
INSERT INTO `we_dialog_content` VALUES ('130', '22', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_3]\";s:4:\"from\";s:32:\"8d0f0f38f529dd211512642976eb6b87\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461301290');
INSERT INTO `we_dialog_content` VALUES ('131', '22', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461301756');
INSERT INTO `we_dialog_content` VALUES ('132', '23', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461302906');
INSERT INTO `we_dialog_content` VALUES ('133', '23', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461303058');
INSERT INTO `we_dialog_content` VALUES ('134', '23', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461303106');
INSERT INTO `we_dialog_content` VALUES ('135', '23', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"as\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b54000000b5\";}', 'chat', '1461303110');
INSERT INTO `we_dialog_content` VALUES ('136', '23', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"as\";s:4:\"from\";s:20:\"7f0000010b54000000b5\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461303112');
INSERT INTO `we_dialog_content` VALUES ('137', '23', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_6]\";s:4:\"from\";s:20:\"7f0000010b54000000b5\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461303118');
INSERT INTO `we_dialog_content` VALUES ('138', '23', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:7:\"[em_11]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b54000000b5\";}', 'chat', '1461303192');
INSERT INTO `we_dialog_content` VALUES ('139', '23', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461303199');
INSERT INTO `we_dialog_content` VALUES ('140', '24', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461307855');
INSERT INTO `we_dialog_content` VALUES ('141', '24', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:10:\"1131313165\";s:4:\"from\";s:32:\"4cfe333475e4d7342efc04fefb6ad344\";s:2:\"to\";s:2:\"20\";}', 'chat', '1461307903');
INSERT INTO `we_dialog_content` VALUES ('142', '24', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_5]\";s:4:\"from\";s:32:\"4cfe333475e4d7342efc04fefb6ad344\";s:2:\"to\";s:2:\"20\";}', 'chat', '1461307940');
INSERT INTO `we_dialog_content` VALUES ('143', '25', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461308152');
INSERT INTO `we_dialog_content` VALUES ('144', '25', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461308156');
INSERT INTO `we_dialog_content` VALUES ('145', '25', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:4:\"asas\";s:4:\"from\";s:20:\"7f0000010b54000000b5\";s:2:\"to\";s:2:\"20\";}', 'chat', '1461308162');
INSERT INTO `we_dialog_content` VALUES ('146', '25', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"你好\";s:4:\"from\";s:20:\"7f0000010b54000000b5\";s:2:\"to\";s:2:\"20\";}', 'chat', '1461308164');
INSERT INTO `we_dialog_content` VALUES ('147', '25', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_4]\";s:4:\"from\";s:20:\"7f0000010b54000000b5\";s:2:\"to\";s:2:\"20\";}', 'chat', '1461308169');
INSERT INTO `we_dialog_content` VALUES ('148', '25', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_3]\";s:4:\"from\";s:20:\"7f0000010b54000000b5\";s:2:\"to\";s:2:\"20\";}', 'chat', '1461308183');
INSERT INTO `we_dialog_content` VALUES ('149', '25', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461309098');
INSERT INTO `we_dialog_content` VALUES ('150', '25', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461309099');
INSERT INTO `we_dialog_content` VALUES ('151', '25', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461309103');
INSERT INTO `we_dialog_content` VALUES ('152', '25', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"as\";s:4:\"from\";s:20:\"7f0000010b54000000b5\";s:2:\"to\";s:2:\"20\";}', 'chat', '1461309105');
INSERT INTO `we_dialog_content` VALUES ('153', '25', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461309106');
INSERT INTO `we_dialog_content` VALUES ('154', '25', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_4]\";s:4:\"from\";s:20:\"7f0000010b54000000b5\";s:2:\"to\";s:2:\"20\";}', 'chat', '1461309119');
INSERT INTO `we_dialog_content` VALUES ('155', '26', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1461478403');
INSERT INTO `we_dialog_content` VALUES ('156', '26', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_3]\";s:4:\"from\";s:32:\"c36c852318b1454efddcdbab171ba4f9\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461478407');
INSERT INTO `we_dialog_content` VALUES ('157', '26', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_2]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"c36c852318b1454efddcdbab171ba4f9\";}', 'chat', '1461478413');
INSERT INTO `we_dialog_content` VALUES ('158', '26', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_4]\";s:4:\"from\";s:32:\"c36c852318b1454efddcdbab171ba4f9\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461478421');
INSERT INTO `we_dialog_content` VALUES ('159', '26', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:4:\"haha\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"c36c852318b1454efddcdbab171ba4f9\";}', 'chat', '1461478424');
INSERT INTO `we_dialog_content` VALUES ('160', '26', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_4]\";s:4:\"from\";s:32:\"c36c852318b1454efddcdbab171ba4f9\";s:2:\"to\";s:2:\"14\";}', 'chat', '1461478446');
INSERT INTO `we_dialog_content` VALUES ('161', '27', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463045050');
INSERT INTO `we_dialog_content` VALUES ('162', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_3]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";}', 'chat', '1463045055');
INSERT INTO `we_dialog_content` VALUES ('163', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_5]\";s:4:\"from\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463045064');
INSERT INTO `we_dialog_content` VALUES ('164', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"asd\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";}', 'chat', '1463045088');
INSERT INTO `we_dialog_content` VALUES ('165', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"naihao\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";}', 'chat', '1463045090');
INSERT INTO `we_dialog_content` VALUES ('166', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:4:\"haha\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";}', 'chat', '1463045091');
INSERT INTO `we_dialog_content` VALUES ('167', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"as\";s:4:\"from\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463045100');
INSERT INTO `we_dialog_content` VALUES ('168', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"a\";s:4:\"from\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463045102');
INSERT INTO `we_dialog_content` VALUES ('169', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"a\";s:4:\"from\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463045102');
INSERT INTO `we_dialog_content` VALUES ('170', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"62\";s:4:\"from\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463045115');
INSERT INTO `we_dialog_content` VALUES ('171', '27', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"ok\";s:4:\"from\";s:32:\"704cf2db8f4144cabaab59d3cbf27eb4\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463045117');
INSERT INTO `we_dialog_content` VALUES ('172', '27', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463045138');
INSERT INTO `we_dialog_content` VALUES ('173', '28', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463637393');
INSERT INTO `we_dialog_content` VALUES ('174', '28', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"阿萨\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"38159be26df745a3642df5c06d1dced5\";}', 'chat', '1463637398');
INSERT INTO `we_dialog_content` VALUES ('175', '28', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"a\";s:4:\"from\";s:32:\"38159be26df745a3642df5c06d1dced5\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463637401');
INSERT INTO `we_dialog_content` VALUES ('176', '28', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463637409');
INSERT INTO `we_dialog_content` VALUES ('177', '29', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463637428');
INSERT INTO `we_dialog_content` VALUES ('178', '29', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"你好\";s:4:\"from\";s:32:\"9d0ed6d7f0259004de0ba42504cb0d2f\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463637440');
INSERT INTO `we_dialog_content` VALUES ('179', '29', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_1]\";s:4:\"from\";s:32:\"9d0ed6d7f0259004de0ba42504cb0d2f\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463637442');
INSERT INTO `we_dialog_content` VALUES ('180', '29', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"123\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"9d0ed6d7f0259004de0ba42504cb0d2f\";}', 'chat', '1463637447');
INSERT INTO `we_dialog_content` VALUES ('181', '29', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_3]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"9d0ed6d7f0259004de0ba42504cb0d2f\";}', 'chat', '1463637451');
INSERT INTO `we_dialog_content` VALUES ('182', '29', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_3]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"9d0ed6d7f0259004de0ba42504cb0d2f\";}', 'chat', '1463637481');
INSERT INTO `we_dialog_content` VALUES ('183', '29', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"哈哈\";s:4:\"from\";s:32:\"9d0ed6d7f0259004de0ba42504cb0d2f\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463637503');
INSERT INTO `we_dialog_content` VALUES ('184', '29', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:9:\"寄回家\";s:4:\"from\";s:32:\"9d0ed6d7f0259004de0ba42504cb0d2f\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463637509');
INSERT INTO `we_dialog_content` VALUES ('185', '29', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"465\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"9d0ed6d7f0259004de0ba42504cb0d2f\";}', 'chat', '1463637514');
INSERT INTO `we_dialog_content` VALUES ('186', '28', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"a\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"38159be26df745a3642df5c06d1dced5\";}', 'chat', '1463644231');
INSERT INTO `we_dialog_content` VALUES ('187', '28', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"阿萨\";s:4:\"from\";s:32:\"38159be26df745a3642df5c06d1dced5\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463645478');
INSERT INTO `we_dialog_content` VALUES ('188', '30', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645521');
INSERT INTO `we_dialog_content` VALUES ('189', '31', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645536');
INSERT INTO `we_dialog_content` VALUES ('190', '32', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645538');
INSERT INTO `we_dialog_content` VALUES ('191', '33', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645540');
INSERT INTO `we_dialog_content` VALUES ('192', '34', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645555');
INSERT INTO `we_dialog_content` VALUES ('193', '35', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645585');
INSERT INTO `we_dialog_content` VALUES ('194', '36', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645879');
INSERT INTO `we_dialog_content` VALUES ('195', '37', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645886');
INSERT INTO `we_dialog_content` VALUES ('196', '38', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645888');
INSERT INTO `we_dialog_content` VALUES ('197', '39', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463645890');
INSERT INTO `we_dialog_content` VALUES ('198', '40', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646197');
INSERT INTO `we_dialog_content` VALUES ('199', '41', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646246');
INSERT INTO `we_dialog_content` VALUES ('200', '42', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646300');
INSERT INTO `we_dialog_content` VALUES ('201', '43', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646305');
INSERT INTO `we_dialog_content` VALUES ('202', '44', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646307');
INSERT INTO `we_dialog_content` VALUES ('203', '45', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646311');
INSERT INTO `we_dialog_content` VALUES ('204', '46', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646313');
INSERT INTO `we_dialog_content` VALUES ('205', '47', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646314');
INSERT INTO `we_dialog_content` VALUES ('206', '48', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646316');
INSERT INTO `we_dialog_content` VALUES ('207', '49', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646318');
INSERT INTO `we_dialog_content` VALUES ('208', '50', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646320');
INSERT INTO `we_dialog_content` VALUES ('209', '51', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646322');
INSERT INTO `we_dialog_content` VALUES ('210', '52', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646324');
INSERT INTO `we_dialog_content` VALUES ('211', '53', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646353');
INSERT INTO `we_dialog_content` VALUES ('212', '54', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646491');
INSERT INTO `we_dialog_content` VALUES ('213', '55', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646495');
INSERT INTO `we_dialog_content` VALUES ('214', '55', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"那你\";s:4:\"from\";s:32:\"8ec00101a2c62d2a1ffaa1be76e7e1b2\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463646500');
INSERT INTO `we_dialog_content` VALUES ('215', '55', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"哈哈\";s:4:\"from\";s:32:\"8ec00101a2c62d2a1ffaa1be76e7e1b2\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463646509');
INSERT INTO `we_dialog_content` VALUES ('216', '56', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646514');
INSERT INTO `we_dialog_content` VALUES ('217', '56', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:9:\"家教啊\";s:4:\"from\";s:32:\"907619c0c4807b6ecbc5cc545447d894\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463646524');
INSERT INTO `we_dialog_content` VALUES ('218', '57', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646756');
INSERT INTO `we_dialog_content` VALUES ('219', '58', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646770');
INSERT INTO `we_dialog_content` VALUES ('220', '59', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646792');
INSERT INTO `we_dialog_content` VALUES ('221', '60', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646800');
INSERT INTO `we_dialog_content` VALUES ('222', '61', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646804');
INSERT INTO `we_dialog_content` VALUES ('223', '62', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646809');
INSERT INTO `we_dialog_content` VALUES ('224', '63', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646811');
INSERT INTO `we_dialog_content` VALUES ('225', '64', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646812');
INSERT INTO `we_dialog_content` VALUES ('226', '65', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646816');
INSERT INTO `we_dialog_content` VALUES ('227', '66', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646817');
INSERT INTO `we_dialog_content` VALUES ('228', '67', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463646859');
INSERT INTO `we_dialog_content` VALUES ('229', '68', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647419');
INSERT INTO `we_dialog_content` VALUES ('230', '69', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647421');
INSERT INTO `we_dialog_content` VALUES ('231', '70', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647424');
INSERT INTO `we_dialog_content` VALUES ('232', '71', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647426');
INSERT INTO `we_dialog_content` VALUES ('233', '72', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647428');
INSERT INTO `we_dialog_content` VALUES ('234', '73', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647430');
INSERT INTO `we_dialog_content` VALUES ('235', '74', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647432');
INSERT INTO `we_dialog_content` VALUES ('236', '75', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647433');
INSERT INTO `we_dialog_content` VALUES ('237', '76', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647438');
INSERT INTO `we_dialog_content` VALUES ('238', '77', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647597');
INSERT INTO `we_dialog_content` VALUES ('239', '78', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463647612');
INSERT INTO `we_dialog_content` VALUES ('240', '79', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463649959');
INSERT INTO `we_dialog_content` VALUES ('241', '79', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:7:\"aaaaaaa\";s:4:\"from\";s:32:\"16285d72dd9c032082d0e1a9d49fefd9\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463650004');
INSERT INTO `we_dialog_content` VALUES ('242', '79', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"a\";s:4:\"from\";s:32:\"16285d72dd9c032082d0e1a9d49fefd9\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463650277');
INSERT INTO `we_dialog_content` VALUES ('243', '79', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"a\";s:4:\"from\";s:32:\"16285d72dd9c032082d0e1a9d49fefd9\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463650277');
INSERT INTO `we_dialog_content` VALUES ('244', '79', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"aa\";s:4:\"from\";s:32:\"16285d72dd9c032082d0e1a9d49fefd9\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463650278');
INSERT INTO `we_dialog_content` VALUES ('245', '79', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"a\";s:4:\"from\";s:32:\"16285d72dd9c032082d0e1a9d49fefd9\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463650279');
INSERT INTO `we_dialog_content` VALUES ('246', '79', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:1:\"a\";s:4:\"from\";s:32:\"16285d72dd9c032082d0e1a9d49fefd9\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463650280');
INSERT INTO `we_dialog_content` VALUES ('247', '80', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463713259');
INSERT INTO `we_dialog_content` VALUES ('248', '80', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"阿萨\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:32:\"be155b877f816c96ab30651a80912ffd\";}', 'chat', '1463713263');
INSERT INTO `we_dialog_content` VALUES ('249', '80', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"as\";s:4:\"from\";s:32:\"be155b877f816c96ab30651a80912ffd\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463713267');
INSERT INTO `we_dialog_content` VALUES ('250', '80', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463713275');
INSERT INTO `we_dialog_content` VALUES ('251', '81', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463715590');
INSERT INTO `we_dialog_content` VALUES ('252', '81', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_4]\";s:4:\"from\";s:32:\"8487dd032e7098bca129af2e769fed9c\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463715604');
INSERT INTO `we_dialog_content` VALUES ('253', '81', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"您拿\";s:4:\"from\";s:32:\"8487dd032e7098bca129af2e769fed9c\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463726540');
INSERT INTO `we_dialog_content` VALUES ('254', '81', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"我\";s:4:\"from\";s:32:\"8487dd032e7098bca129af2e769fed9c\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463726544');
INSERT INTO `we_dialog_content` VALUES ('255', '81', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:12:\"们的生活\";s:4:\"from\";s:32:\"8487dd032e7098bca129af2e769fed9c\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463726545');
INSERT INTO `we_dialog_content` VALUES ('256', '81', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:9:\"方式，\";s:4:\"from\";s:32:\"8487dd032e7098bca129af2e769fed9c\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463726546');
INSERT INTO `we_dialog_content` VALUES ('257', '81', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"我\";s:4:\"from\";s:32:\"8487dd032e7098bca129af2e769fed9c\";s:2:\"to\";s:2:\"14\";}', 'chat', '1463726546');
INSERT INTO `we_dialog_content` VALUES ('258', '82', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463735647');
INSERT INTO `we_dialog_content` VALUES ('259', '82', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463735679');
INSERT INTO `we_dialog_content` VALUES ('260', '82', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463735682');
INSERT INTO `we_dialog_content` VALUES ('261', '83', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463736242');
INSERT INTO `we_dialog_content` VALUES ('262', '84', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1463736700');
INSERT INTO `we_dialog_content` VALUES ('263', '82', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:2:\"as\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b54000001c2\";}', 'chat', '1463736703');
INSERT INTO `we_dialog_content` VALUES ('264', '82', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:3:\"as3\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b54000001c2\";}', 'chat', '1463736782');
INSERT INTO `we_dialog_content` VALUES ('265', '85', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1464157236');
INSERT INTO `we_dialog_content` VALUES ('266', '85', 'a:4:{s:4:\"type\";s:4:\"text\";s:7:\"content\";s:6:\"[em_2]\";s:4:\"from\";s:2:\"14\";s:2:\"to\";s:20:\"7f0000010b560000023b\";}', 'chat', '1464157248');
INSERT INTO `we_dialog_content` VALUES ('267', '85', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1464157260');
INSERT INTO `we_dialog_content` VALUES ('268', '85', 'a:1:{s:4:\"type\";s:4:\"chat\";}', 'chat', '1464157264');
INSERT INTO `we_dialog_relation` VALUES ('2', '3', '18', '7f0000010b5400000003', '1460709958', '1460711530');
INSERT INTO `we_dialog_relation` VALUES ('3', '3', '14', '7f0000010b5400000003', '1460713932', '1461140421');
INSERT INTO `we_dialog_relation` VALUES ('4', '3', '14', '7f0000010b540000000d', '1460729714', '1460731159');
INSERT INTO `we_dialog_relation` VALUES ('5', '3', '14', '7f0000010b5400000013', '1460729738', '1460731655');
INSERT INTO `we_dialog_relation` VALUES ('6', '3', '14', '7f0000010b540000001d', '1460729923', '1460730014');
INSERT INTO `we_dialog_relation` VALUES ('7', '3', '14', '7f0000010b5400000029', '1460730096', '1460730869');
INSERT INTO `we_dialog_relation` VALUES ('8', '3', '14', '7f0000010b5400000047', '1460730396', '1460730396');
INSERT INTO `we_dialog_relation` VALUES ('9', '3', '14', '7f0000010b540000004e', '1460730496', '1460730662');
INSERT INTO `we_dialog_relation` VALUES ('10', '3', '14', '7f0000010b560000000c', '1460777417', '1460778597');
INSERT INTO `we_dialog_relation` VALUES ('11', '3', '14', '7f0000010b5600000006', '1460779437', '1460779437');
INSERT INTO `we_dialog_relation` VALUES ('12', '3', '14', '7f0000010b5700000035', '1460940331', '1460940342');
INSERT INTO `we_dialog_relation` VALUES ('13', '5', '19', '7f0000010b5700000049', '1460940985', '1460941027');
INSERT INTO `we_dialog_relation` VALUES ('14', '3', '14', '13c360ac10cfc264a896', '1461286814', '1461286814');
INSERT INTO `we_dialog_relation` VALUES ('15', '3', '14', 'dfea2693a31881eed5a0', '1461286835', '1461286835');
INSERT INTO `we_dialog_relation` VALUES ('16', '3', '14', 'dfea2693a31881eed5a0', '1461287102', '1461287102');
INSERT INTO `we_dialog_relation` VALUES ('17', '3', '14', '0.510802001461287115', '1461287115', '1461287115');
INSERT INTO `we_dialog_relation` VALUES ('18', '3', '14', '8d0f0f38f529dd211512', '1461287249', '1461287249');
INSERT INTO `we_dialog_relation` VALUES ('19', '3', '14', '8d0f0f38f529dd211512', '1461288749', '1461288749');
INSERT INTO `we_dialog_relation` VALUES ('20', '3', '14', '8d0f0f38f529dd211512', '1461288754', '1461288754');
INSERT INTO `we_dialog_relation` VALUES ('21', '3', '14', '8d0f0f38f529dd211512', '1461288762', '1461288762');
INSERT INTO `we_dialog_relation` VALUES ('22', '3', '14', '8d0f0f38f529dd211512642976eb6b87', '1461288929', '1461301290');
INSERT INTO `we_dialog_relation` VALUES ('23', '3', '14', '7f0000010b54000000b5', '1461302906', '1461303192');
INSERT INTO `we_dialog_relation` VALUES ('24', '6', '20', '4cfe333475e4d7342efc04fefb6ad344', '1461307855', '1461307940');
INSERT INTO `we_dialog_relation` VALUES ('25', '6', '20', '7f0000010b54000000b5', '1461308152', '1461309119');
INSERT INTO `we_dialog_relation` VALUES ('26', '3', '14', 'c36c852318b1454efddcdbab171ba4f9', '1461478403', '1461478446');
INSERT INTO `we_dialog_relation` VALUES ('27', '3', '14', '704cf2db8f4144cabaab59d3cbf27eb4', '1463045050', '1463045117');
INSERT INTO `we_dialog_relation` VALUES ('28', '3', '14', '38159be26df745a3642df5c06d1dced5', '1463637393', '1463645478');
INSERT INTO `we_dialog_relation` VALUES ('29', '3', '14', '9d0ed6d7f0259004de0ba42504cb0d2f', '1463637428', '1463637514');
INSERT INTO `we_dialog_relation` VALUES ('30', '3', '14', '17f9cdc2a7d3c52b83d856f08359a26c', '1463645521', '1463645521');
INSERT INTO `we_dialog_relation` VALUES ('31', '3', '14', 'edfdd9421f25e8ad572bd1fa82492a48', '1463645536', '1463645536');
INSERT INTO `we_dialog_relation` VALUES ('32', '3', '14', 'f87bb3a2a9c508de0afae2a3d07db747', '1463645538', '1463645538');
INSERT INTO `we_dialog_relation` VALUES ('33', '3', '14', '7b81202120b592fe1ee3b66bc8f9b872', '1463645540', '1463645540');
INSERT INTO `we_dialog_relation` VALUES ('34', '3', '14', '94f5f478b0dde81e3929addae008eb4e', '1463645555', '1463645555');
INSERT INTO `we_dialog_relation` VALUES ('35', '3', '14', '3820d11eb2b8a88434113e5c81af483f', '1463645585', '1463645585');
INSERT INTO `we_dialog_relation` VALUES ('36', '3', '14', 'b72f75cc3d028e3a94ccf4f7ab9232f0', '1463645879', '1463645879');
INSERT INTO `we_dialog_relation` VALUES ('37', '3', '14', '53f71a1fb4c07ff6815b03415fa8d585', '1463645886', '1463645886');
INSERT INTO `we_dialog_relation` VALUES ('38', '3', '14', '02ea8ea6a9323eab86b2b79fc99f403a', '1463645888', '1463645888');
INSERT INTO `we_dialog_relation` VALUES ('39', '3', '14', '12be088b2dfa305e547614a2008a0a49', '1463645890', '1463645890');
INSERT INTO `we_dialog_relation` VALUES ('40', '3', '14', '847f2ee521daf0f39cb052893de06194', '1463646197', '1463646197');
INSERT INTO `we_dialog_relation` VALUES ('41', '3', '14', '003ff60818fa1e7726aff65f9643fde2', '1463646246', '1463646246');
INSERT INTO `we_dialog_relation` VALUES ('42', '3', '14', '0b1a760e392a52538e67a10b1a5ef5ff', '1463646300', '1463646300');
INSERT INTO `we_dialog_relation` VALUES ('43', '3', '14', 'e41a98228dd6965406fef9f1d9e08349', '1463646305', '1463646305');
INSERT INTO `we_dialog_relation` VALUES ('44', '3', '14', '48384c36285feb547b7d3bec454eccf1', '1463646307', '1463646307');
INSERT INTO `we_dialog_relation` VALUES ('45', '3', '14', '3c519900e1ae3246744f302c2c9eeb36', '1463646311', '1463646311');
INSERT INTO `we_dialog_relation` VALUES ('46', '3', '14', '5e3978e46cfd572a791187c66c6b2a9e', '1463646313', '1463646313');
INSERT INTO `we_dialog_relation` VALUES ('47', '3', '14', '92c656573b77151eee0e265a41084272', '1463646314', '1463646314');
INSERT INTO `we_dialog_relation` VALUES ('48', '3', '14', '1195e38581b7135cdbf4c7a871e1636f', '1463646316', '1463646316');
INSERT INTO `we_dialog_relation` VALUES ('49', '3', '14', 'fac8e1472eceebbd81864e5c3ad6e6ad', '1463646318', '1463646318');
INSERT INTO `we_dialog_relation` VALUES ('50', '3', '14', '69f631cef506e827da8451ceedb4d738', '1463646320', '1463646320');
INSERT INTO `we_dialog_relation` VALUES ('51', '3', '14', 'd2cdd9758f61efcb07ec1ab1796e5eba', '1463646322', '1463646322');
INSERT INTO `we_dialog_relation` VALUES ('52', '3', '14', 'ffd1f99b0729c90b9a9671f7c997f89d', '1463646324', '1463646324');
INSERT INTO `we_dialog_relation` VALUES ('53', '3', '14', 'e7f50349c6705d8efe3372be3c358a26', '1463646353', '1463646353');
INSERT INTO `we_dialog_relation` VALUES ('54', '3', '14', 'e5320325b456b093ddffa106cf2f19be', '1463646491', '1463646491');
INSERT INTO `we_dialog_relation` VALUES ('55', '3', '14', '8ec00101a2c62d2a1ffaa1be76e7e1b2', '1463646495', '1463646509');
INSERT INTO `we_dialog_relation` VALUES ('56', '3', '14', '907619c0c4807b6ecbc5cc545447d894', '1463646514', '1463646524');
INSERT INTO `we_dialog_relation` VALUES ('57', '3', '14', 'f7a0360bef0583940d8ea938a0c877e7', '1463646756', '1463646756');
INSERT INTO `we_dialog_relation` VALUES ('58', '3', '14', '5a266ee48b6d8fd12da9d4a35051f0e0', '1463646770', '1463646770');
INSERT INTO `we_dialog_relation` VALUES ('59', '3', '14', '680749212d9bf86d6ad380a0cfef12a8', '1463646792', '1463646792');
INSERT INTO `we_dialog_relation` VALUES ('60', '3', '14', 'be66d10ed0a301fac0420f979a823d39', '1463646800', '1463646800');
INSERT INTO `we_dialog_relation` VALUES ('61', '3', '14', '397f2500c11bdebc9876722f296705ab', '1463646804', '1463646804');
INSERT INTO `we_dialog_relation` VALUES ('62', '3', '14', '9b860c81d6cff9d2f621d03fe0c062f0', '1463646809', '1463646809');
INSERT INTO `we_dialog_relation` VALUES ('63', '3', '14', '341ea2cfc58a96d08b368eb0b98732ee', '1463646811', '1463646811');
INSERT INTO `we_dialog_relation` VALUES ('64', '3', '14', 'ddcedf9a42341acd8edbda072e621ac2', '1463646812', '1463646812');
INSERT INTO `we_dialog_relation` VALUES ('65', '3', '14', 'a54a2384cf4371dda45d9ce745b3e7b3', '1463646816', '1463646816');
INSERT INTO `we_dialog_relation` VALUES ('66', '3', '14', '0cbc243fa868054c18ce86b4bcc02e22', '1463646817', '1463646817');
INSERT INTO `we_dialog_relation` VALUES ('67', '3', '14', '6040bef8834e198baefeb063675d3e64', '1463646859', '1463646859');
INSERT INTO `we_dialog_relation` VALUES ('68', '3', '14', 'fc585f7356aeb3eeb7d513e0c18138a8', '1463647419', '1463647419');
INSERT INTO `we_dialog_relation` VALUES ('69', '3', '14', 'a76b933b3b8ac58eae818235ae1a3cea', '1463647421', '1463647421');
INSERT INTO `we_dialog_relation` VALUES ('70', '3', '14', 'dc6e7119d8cbc6dc8e661c25e843a1fe', '1463647424', '1463647424');
INSERT INTO `we_dialog_relation` VALUES ('71', '3', '14', 'ed8843505d8b6787e450aefb55bc1d38', '1463647426', '1463647426');
INSERT INTO `we_dialog_relation` VALUES ('72', '3', '14', 'c873c73da2035c55f141df9e4761d38a', '1463647428', '1463647428');
INSERT INTO `we_dialog_relation` VALUES ('73', '3', '14', '57796e983b8186095fc7d15af51d886d', '1463647430', '1463647430');
INSERT INTO `we_dialog_relation` VALUES ('74', '3', '14', '21a2aea235c67dbef2c6127d7a15e5a1', '1463647432', '1463647432');
INSERT INTO `we_dialog_relation` VALUES ('75', '3', '14', 'fa75e8b54bb679eb3fe5c487800c3d64', '1463647433', '1463647433');
INSERT INTO `we_dialog_relation` VALUES ('76', '3', '14', 'e1ad3f99ef8dc382c6d811b448d277ec', '1463647438', '1463647438');
INSERT INTO `we_dialog_relation` VALUES ('77', '3', '14', 'e3a5c4134e44ffd0016697148f07e717', '1463647597', '1463647597');
INSERT INTO `we_dialog_relation` VALUES ('78', '3', '14', '30cd40be002f228b5f67018819dae40e', '1463647612', '1463647612');
INSERT INTO `we_dialog_relation` VALUES ('79', '3', '14', '16285d72dd9c032082d0e1a9d49fefd9', '1463649959', '1463650280');
INSERT INTO `we_dialog_relation` VALUES ('80', '3', '14', 'be155b877f816c96ab30651a80912ffd', '1463713259', '1463713267');
INSERT INTO `we_dialog_relation` VALUES ('81', '3', '14', '8487dd032e7098bca129af2e769fed9c', '1463715590', '1463726546');
INSERT INTO `we_dialog_relation` VALUES ('82', '3', '14', '7f0000010b54000001c2', '1463735647', '1463736782');
INSERT INTO `we_dialog_relation` VALUES ('83', '3', '14', '7f0000010b54000001e4', '1463736242', '1463736242');
INSERT INTO `we_dialog_relation` VALUES ('84', '3', '14', '7f0000010b54000001f3', '1463736700', '1463736700');
INSERT INTO `we_dialog_relation` VALUES ('85', '3', '14', '7f0000010b560000023b', '1464157236', '1464157248');

INSERT INTO `we_visitor` VALUES ('1', '7f0000010b5400000001', null, null, null, null, null, '127.0.0.1', null);

INSERT INTO `we_visitor` VALUES ('3', '7f0000010b540000021e', null, null, null, null, null, '127.0.0.1', null);
INSERT INTO `we_visitor` VALUES ('4', '7f0000010b5400000224', null, null, null, null, '', '127.0.0.1', null);
INSERT INTO `we_visitor` VALUES ('5', '7f0000010b540000000d', '', '', '', null, null, '183.192.31.1', null);
INSERT INTO `we_visitor` VALUES ('6', '7f0000010b5400000013', '', '', '', null, '', '183.192.31.1', null);
INSERT INTO `we_visitor` VALUES ('7', '7f0000010b540000001d', null, null, null, null, null, '183.192.31.1', null);
INSERT INTO `we_visitor` VALUES ('8', '7f0000010b5400000029', '', '', '', null, '', '183.192.31.1', null);
INSERT INTO `we_visitor` VALUES ('9', '7f0000010b5400000047', '', '', '', null, '', '211.161.245.109', null);
INSERT INTO `we_visitor` VALUES ('10', '7f0000010b540000004e', null, null, null, null, null, '218.82.189.19', null);
INSERT INTO `we_visitor` VALUES ('11', '7f0000010b5600000006', null, null, null, null, '', '211.161.245.237', null);
INSERT INTO `we_visitor` VALUES ('12', '7f0000010b5400000095', null, null, null, null, null, '1.198.36.122', null);
INSERT INTO `we_visitor` VALUES ('13', '7f0000010b560000000c', null, null, null, null, null, '183.192.31.1', null);
INSERT INTO `we_visitor` VALUES ('14', '7f0000010b54000000a3', null, null, null, null, null, '183.195.146.67', null);
INSERT INTO `we_visitor` VALUES ('15', '7f0000010b54000000ac', null, null, null, null, null, '112.17.238.14', null);
INSERT INTO `we_visitor` VALUES ('16', '7f0000010b5700000035', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('17', '7f0000010b5700000049', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('18', '7f0000010b54000000b1', null, null, null, null, null, '183.195.146.64', null);
INSERT INTO `we_visitor` VALUES ('19', '7f0000010b560000007e', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('20', '7f0000010b5500000070', null, null, null, null, null, '61.151.214.71', null);
INSERT INTO `we_visitor` VALUES ('21', '7f0000010b570000008a', null, null, null, null, null, '42.120.235.213', null);
INSERT INTO `we_visitor` VALUES ('29', '0.510802001461287115', '', '', null, null, '', '127.0.0.1', null);
INSERT INTO `we_visitor` VALUES ('30', '8d0f0f38f529dd211512642976eb6b87', '李笑笑', '186451', '', null, '', '127.0.0.1', null);
INSERT INTO `we_visitor` VALUES ('31', '7f0000010b55000000a9', null, null, null, null, null, '42.120.161.19', null);
INSERT INTO `we_visitor` VALUES ('32', '7f0000010b54000000b5', '张安', '', '', null, '', '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('33', '4cfe333475e4d7342efc04fefb6ad344', null, null, null, null, null, '171.15.198.138', null);
INSERT INTO `we_visitor` VALUES ('34', '682ea8780f520988197b9e25d3f851b6', null, null, null, null, null, '218.82.189.132', null);
INSERT INTO `we_visitor` VALUES ('35', '7f0000010b56000000bf', null, null, null, null, null, '199.187.241.236', null);
INSERT INTO `we_visitor` VALUES ('36', 'fd7fc558c33dc572ed757392bd53e9dc', null, null, null, null, null, '223.104.5.202', null);
INSERT INTO `we_visitor` VALUES ('37', 'c36c852318b1454efddcdbab171ba4f9', '', '', null, null, null, '183.192.31.1', null);
INSERT INTO `we_visitor` VALUES ('38', '7f0000010b57000000e5', null, null, null, null, null, '140.205.145.254', null);
INSERT INTO `we_visitor` VALUES ('39', '7f0000010b57000000e9', null, null, null, null, null, '120.32.116.19', null);
INSERT INTO `we_visitor` VALUES ('40', '7f0000010b54000000c6', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('41', '7f0000010b54000000de', null, null, null, null, null, '192.154.110.90', null);
INSERT INTO `we_visitor` VALUES ('42', '7f0000010b56000000f3', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('43', '7f0000010b54000000e6', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('44', 'bccaae49db7a9fb47813d29aecc32b35', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('45', '7f0000010b560000012c', null, null, null, null, null, '42.156.139.19', null);
INSERT INTO `we_visitor` VALUES ('46', '7f0000010b570000013d', null, null, null, null, null, '42.156.138.20', null);
INSERT INTO `we_visitor` VALUES ('47', '7f0000010b5500000118', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('48', '7f0000010b550000011d', null, null, null, null, null, '42.156.139.5', null);
INSERT INTO `we_visitor` VALUES ('49', '7f0000010b5600000145', null, null, null, null, null, '116.247.112.152', null);
INSERT INTO `we_visitor` VALUES ('50', '7f0000010b5700000153', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('51', '7f0000010b5600000161', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('52', '704cf2db8f4144cabaab59d3cbf27eb4', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('53', '7f0000010b560000016b', null, null, null, null, null, '111.40.4.8', null);
INSERT INTO `we_visitor` VALUES ('54', '7f0000010b5600000170', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('55', '7f0000010b5600000194', null, null, null, null, null, '114.33.131.76', null);
INSERT INTO `we_visitor` VALUES ('56', '38159be26df745a3642df5c06d1dced5', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('57', '9d0ed6d7f0259004de0ba42504cb0d2f', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('58', '7f0000010b5700000192', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('59', '17f9cdc2a7d3c52b83d856f08359a26c', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('60', 'edfdd9421f25e8ad572bd1fa82492a48', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('61', 'f87bb3a2a9c508de0afae2a3d07db747', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('62', '7b81202120b592fe1ee3b66bc8f9b872', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('63', '94f5f478b0dde81e3929addae008eb4e', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('64', '3820d11eb2b8a88434113e5c81af483f', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('65', 'b72f75cc3d028e3a94ccf4f7ab9232f0', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('66', '53f71a1fb4c07ff6815b03415fa8d585', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('67', '02ea8ea6a9323eab86b2b79fc99f403a', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('68', '12be088b2dfa305e547614a2008a0a49', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('69', '847f2ee521daf0f39cb052893de06194', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('70', '003ff60818fa1e7726aff65f9643fde2', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('71', '0b1a760e392a52538e67a10b1a5ef5ff', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('72', 'e41a98228dd6965406fef9f1d9e08349', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('73', '48384c36285feb547b7d3bec454eccf1', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('74', '3c519900e1ae3246744f302c2c9eeb36', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('75', '5e3978e46cfd572a791187c66c6b2a9e', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('76', '92c656573b77151eee0e265a41084272', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('77', '1195e38581b7135cdbf4c7a871e1636f', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('78', 'fac8e1472eceebbd81864e5c3ad6e6ad', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('79', '69f631cef506e827da8451ceedb4d738', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('80', 'd2cdd9758f61efcb07ec1ab1796e5eba', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('81', 'ffd1f99b0729c90b9a9671f7c997f89d', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('82', 'e7f50349c6705d8efe3372be3c358a26', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('83', 'e5320325b456b093ddffa106cf2f19be', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('84', '8ec00101a2c62d2a1ffaa1be76e7e1b2', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('85', '907619c0c4807b6ecbc5cc545447d894', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('86', 'f7a0360bef0583940d8ea938a0c877e7', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('87', '5a266ee48b6d8fd12da9d4a35051f0e0', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('88', '680749212d9bf86d6ad380a0cfef12a8', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('89', 'be66d10ed0a301fac0420f979a823d39', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('90', '397f2500c11bdebc9876722f296705ab', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('91', '9b860c81d6cff9d2f621d03fe0c062f0', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('92', '341ea2cfc58a96d08b368eb0b98732ee', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('93', 'ddcedf9a42341acd8edbda072e621ac2', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('94', 'a54a2384cf4371dda45d9ce745b3e7b3', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('95', '0cbc243fa868054c18ce86b4bcc02e22', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('96', '6040bef8834e198baefeb063675d3e64', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('97', 'fc585f7356aeb3eeb7d513e0c18138a8', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('98', 'a76b933b3b8ac58eae818235ae1a3cea', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('99', 'dc6e7119d8cbc6dc8e661c25e843a1fe', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('100', 'ed8843505d8b6787e450aefb55bc1d38', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('101', 'c873c73da2035c55f141df9e4761d38a', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('102', '57796e983b8186095fc7d15af51d886d', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('103', '21a2aea235c67dbef2c6127d7a15e5a1', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('104', 'fa75e8b54bb679eb3fe5c487800c3d64', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('105', 'e1ad3f99ef8dc382c6d811b448d277ec', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('106', 'e3a5c4134e44ffd0016697148f07e717', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('107', '30cd40be002f228b5f67018819dae40e', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('108', '16285d72dd9c032082d0e1a9d49fefd9', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('109', 'be155b877f816c96ab30651a80912ffd', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('110', '8487dd032e7098bca129af2e769fed9c', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('111', '7f0000010b54000001a9', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('112', '7f0000010b54000001c2', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('113', '7f0000010b54000001e4', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('114', '7f0000010b54000001f3', null, null, null, null, null, '117.184.120.234', null);
INSERT INTO `we_visitor` VALUES ('115', '7f0000010b57000001ff', null, null, null, null, null, '180.168.160.38', null);
INSERT INTO `we_visitor` VALUES ('116', '7f0000010b5600000201', null, null, null, null, null, '58.246.4.182', null);
INSERT INTO `we_visitor` VALUES ('117', '7f0000010b5600000209', null, null, null, null, null, '223.104.5.206', null);
INSERT INTO `we_visitor` VALUES ('118', '7f0000010b540000020d', null, null, null, null, null, '183.192.24.25', null);
INSERT INTO `we_visitor` VALUES ('119', '7f0000010b55000001fe', null, null, null, null, null, '139.227.150.118', null);
INSERT INTO `we_visitor` VALUES ('120', '7f0000010b570000022a', null, null, null, null, null, '183.192.24.25', null);
INSERT INTO `we_visitor` VALUES ('121', '7f0000010b560000023b', null, null, null, null, null, '180.168.160.38', null);
