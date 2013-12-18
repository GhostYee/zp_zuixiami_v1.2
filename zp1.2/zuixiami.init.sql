-- phpMyAdmin SQL Dump
-- version 3.3.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost:8809
-- 生成日期: 2013 年 12 月 03 日 13:03
-- 服务器版本: 5.5.20
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `zuixiami`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiami_access`
--

CREATE TABLE IF NOT EXISTS `xiami_access` (
  `role_id` smallint(6) unsigned NOT NULL COMMENT '角色分组ID对应role表',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '节点ID对应node表',
  `level` tinyint(1) NOT NULL COMMENT '级别',
  `pid` smallint(6) NOT NULL COMMENT '上级ID',
  `module` varchar(50) NOT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台权限';

--
-- 转存表中的数据 `xiami_access`
--

INSERT INTO `xiami_access` (`role_id`, `node_id`, `level`, `pid`, `module`) VALUES
(7, 153, 3, 87, ''),
(7, 152, 3, 87, ''),
(7, 151, 3, 87, ''),
(7, 150, 3, 87, ''),
(7, 149, 3, 87, ''),
(7, 148, 3, 87, ''),
(7, 147, 3, 87, ''),
(7, 146, 3, 87, ''),
(7, 87, 2, 1, ''),
(7, 85, 2, 1, ''),
(7, 50, 3, 40, ''),
(7, 1, 1, 0, ''),
(7, 30, 2, 1, ''),
(7, 40, 2, 1, ''),
(9, 1, 1, 0, ''),
(1, 277, 3, 6, ''),
(1, 276, 3, 218, ''),
(1, 275, 3, 218, ''),
(1, 274, 3, 218, ''),
(1, 273, 3, 218, ''),
(1, 272, 3, 218, ''),
(1, 271, 3, 218, ''),
(1, 270, 3, 218, ''),
(1, 269, 3, 218, ''),
(1, 268, 3, 219, ''),
(1, 267, 3, 219, ''),
(1, 266, 3, 219, ''),
(1, 265, 3, 219, ''),
(1, 264, 3, 219, ''),
(1, 263, 3, 219, ''),
(1, 262, 3, 219, ''),
(1, 261, 3, 219, ''),
(1, 260, 3, 220, ''),
(1, 259, 3, 220, ''),
(1, 258, 3, 220, ''),
(1, 257, 3, 220, ''),
(1, 256, 3, 220, ''),
(1, 255, 3, 220, ''),
(1, 254, 3, 220, ''),
(1, 253, 3, 220, ''),
(1, 252, 3, 221, ''),
(1, 251, 3, 221, ''),
(1, 250, 3, 221, ''),
(1, 249, 3, 221, ''),
(1, 248, 3, 221, ''),
(1, 247, 3, 221, ''),
(1, 246, 3, 221, ''),
(1, 245, 3, 221, ''),
(1, 244, 3, 222, ''),
(1, 243, 3, 222, ''),
(1, 242, 3, 222, ''),
(1, 241, 3, 222, ''),
(1, 240, 3, 222, ''),
(1, 239, 3, 222, ''),
(1, 238, 3, 222, ''),
(1, 237, 3, 222, ''),
(1, 236, 3, 223, ''),
(1, 235, 3, 223, ''),
(1, 234, 3, 223, ''),
(1, 233, 3, 223, ''),
(1, 232, 3, 223, ''),
(1, 231, 3, 223, ''),
(1, 230, 3, 223, ''),
(1, 229, 3, 223, ''),
(1, 228, 3, 86, ''),
(1, 227, 3, 86, ''),
(1, 226, 3, 86, ''),
(1, 225, 3, 86, ''),
(1, 224, 3, 87, ''),
(1, 223, 2, 1, ''),
(1, 222, 2, 1, ''),
(1, 221, 2, 1, ''),
(1, 220, 2, 1, ''),
(1, 219, 2, 1, ''),
(1, 218, 2, 1, ''),
(1, 217, 3, 209, ''),
(1, 216, 3, 209, ''),
(1, 215, 3, 209, ''),
(1, 214, 3, 209, ''),
(1, 213, 3, 209, ''),
(1, 212, 3, 209, ''),
(1, 211, 3, 209, ''),
(1, 210, 3, 209, ''),
(1, 209, 2, 1, ''),
(1, 208, 3, 90, ''),
(1, 207, 3, 88, ''),
(1, 206, 3, 7, ''),
(1, 205, 3, 7, ''),
(1, 204, 3, 30, ''),
(1, 203, 3, 30, ''),
(1, 202, 3, 30, ''),
(1, 193, 3, 6, ''),
(1, 192, 3, 6, ''),
(1, 191, 3, 6, ''),
(1, 190, 3, 6, ''),
(1, 189, 3, 6, ''),
(1, 188, 3, 6, ''),
(1, 187, 3, 6, ''),
(1, 186, 3, 6, ''),
(1, 185, 3, 7, ''),
(1, 184, 3, 7, ''),
(1, 183, 3, 7, ''),
(1, 182, 3, 7, ''),
(1, 181, 3, 7, ''),
(1, 180, 3, 7, ''),
(1, 179, 3, 7, ''),
(1, 178, 3, 7, ''),
(1, 169, 3, 85, ''),
(1, 168, 3, 85, ''),
(1, 167, 3, 85, ''),
(1, 166, 3, 85, ''),
(1, 165, 3, 85, ''),
(1, 164, 3, 85, ''),
(1, 163, 3, 85, ''),
(1, 162, 3, 85, ''),
(1, 161, 3, 86, ''),
(1, 160, 3, 86, ''),
(7, 162, 3, 85, ''),
(7, 163, 3, 85, ''),
(7, 164, 3, 85, ''),
(7, 165, 3, 85, ''),
(7, 166, 3, 85, ''),
(7, 167, 3, 85, ''),
(7, 168, 3, 85, ''),
(7, 169, 3, 85, ''),
(7, 202, 3, 30, ''),
(7, 203, 3, 30, ''),
(7, 204, 3, 30, ''),
(1, 159, 3, 86, ''),
(1, 158, 3, 86, ''),
(1, 157, 3, 86, ''),
(1, 156, 3, 86, ''),
(1, 155, 3, 86, ''),
(1, 154, 3, 86, ''),
(1, 153, 3, 87, ''),
(1, 152, 3, 87, ''),
(1, 151, 3, 87, ''),
(1, 150, 3, 87, ''),
(1, 149, 3, 87, ''),
(1, 148, 3, 87, ''),
(1, 147, 3, 87, ''),
(1, 146, 3, 87, ''),
(1, 145, 3, 88, ''),
(1, 144, 3, 88, ''),
(1, 143, 3, 88, ''),
(1, 142, 3, 88, ''),
(1, 141, 3, 88, ''),
(1, 140, 3, 88, ''),
(1, 139, 3, 88, ''),
(1, 138, 3, 88, ''),
(1, 137, 3, 89, ''),
(1, 136, 3, 89, ''),
(1, 135, 3, 89, ''),
(1, 134, 3, 89, ''),
(1, 133, 3, 89, ''),
(1, 132, 3, 89, ''),
(1, 131, 3, 89, ''),
(1, 130, 3, 89, ''),
(1, 129, 3, 90, ''),
(1, 128, 3, 90, ''),
(1, 127, 3, 90, ''),
(1, 126, 3, 90, ''),
(1, 125, 3, 90, ''),
(1, 124, 3, 90, ''),
(1, 123, 3, 90, ''),
(1, 122, 3, 96, ''),
(1, 121, 3, 96, ''),
(1, 120, 3, 96, ''),
(1, 119, 3, 96, ''),
(1, 118, 3, 96, ''),
(1, 117, 3, 96, ''),
(1, 116, 3, 96, ''),
(1, 115, 3, 96, ''),
(1, 114, 3, 97, ''),
(1, 113, 3, 97, ''),
(1, 112, 3, 97, ''),
(1, 111, 3, 97, ''),
(1, 110, 3, 97, ''),
(1, 109, 3, 97, ''),
(1, 108, 3, 97, ''),
(1, 107, 3, 97, ''),
(1, 106, 3, 98, ''),
(1, 98, 2, 1, ''),
(1, 97, 2, 1, ''),
(1, 96, 2, 1, ''),
(1, 95, 3, 90, ''),
(1, 94, 3, 91, ''),
(1, 93, 3, 6, ''),
(1, 92, 3, 6, ''),
(1, 91, 2, 1, ''),
(1, 90, 2, 1, ''),
(1, 89, 2, 1, ''),
(1, 88, 2, 1, ''),
(1, 87, 2, 1, ''),
(1, 86, 2, 1, ''),
(1, 85, 2, 1, ''),
(1, 50, 3, 40, ''),
(1, 1, 1, 0, ''),
(1, 6, 2, 1, ''),
(1, 7, 2, 1, ''),
(1, 30, 2, 1, ''),
(1, 100, 3, 98, ''),
(1, 101, 3, 98, ''),
(1, 102, 3, 98, ''),
(1, 103, 3, 98, ''),
(1, 104, 3, 98, ''),
(1, 99, 3, 98, ''),
(1, 40, 2, 1, ''),
(9, 204, 3, 30, ''),
(9, 203, 3, 30, ''),
(9, 202, 3, 30, ''),
(9, 169, 3, 85, ''),
(9, 168, 3, 85, ''),
(9, 167, 3, 85, ''),
(9, 166, 3, 85, ''),
(9, 165, 3, 85, ''),
(9, 164, 3, 85, ''),
(9, 163, 3, 85, ''),
(9, 162, 3, 85, ''),
(9, 85, 2, 1, ''),
(9, 50, 3, 40, ''),
(9, 40, 2, 1, ''),
(9, 30, 2, 1, ''),
(1, 105, 3, 98, ''),
(2, 277, 3, 6, ''),
(2, 204, 3, 30, ''),
(2, 203, 3, 30, ''),
(2, 202, 3, 30, ''),
(2, 201, 3, 2, ''),
(2, 200, 3, 2, ''),
(2, 199, 3, 2, ''),
(2, 198, 3, 2, ''),
(2, 197, 3, 2, ''),
(2, 196, 3, 2, ''),
(2, 195, 3, 2, ''),
(2, 194, 3, 2, ''),
(2, 193, 3, 6, ''),
(2, 192, 3, 6, ''),
(2, 191, 3, 6, ''),
(2, 190, 3, 6, ''),
(2, 189, 3, 6, ''),
(2, 188, 3, 6, ''),
(2, 187, 3, 6, ''),
(2, 186, 3, 6, ''),
(2, 177, 3, 84, ''),
(2, 176, 3, 84, ''),
(2, 175, 3, 84, ''),
(2, 174, 3, 84, ''),
(2, 173, 3, 84, ''),
(2, 172, 3, 84, ''),
(2, 171, 3, 84, ''),
(2, 170, 3, 84, ''),
(2, 93, 3, 6, ''),
(13, 277, 3, 6, ''),
(13, 206, 3, 7, ''),
(13, 205, 3, 7, ''),
(13, 204, 3, 30, ''),
(13, 203, 3, 30, ''),
(13, 202, 3, 30, ''),
(13, 201, 3, 2, ''),
(13, 200, 3, 2, ''),
(13, 199, 3, 2, ''),
(13, 196, 3, 2, ''),
(13, 195, 3, 2, ''),
(13, 194, 3, 2, ''),
(13, 193, 3, 6, ''),
(13, 192, 3, 6, ''),
(13, 191, 3, 6, ''),
(13, 190, 3, 6, ''),
(13, 189, 3, 6, ''),
(13, 188, 3, 6, ''),
(13, 187, 3, 6, ''),
(13, 186, 3, 6, ''),
(13, 185, 3, 7, ''),
(13, 184, 3, 7, ''),
(13, 183, 3, 7, ''),
(13, 182, 3, 7, ''),
(13, 181, 3, 7, ''),
(13, 180, 3, 7, ''),
(13, 179, 3, 7, ''),
(13, 178, 3, 7, ''),
(13, 177, 3, 84, ''),
(13, 176, 3, 84, ''),
(13, 175, 3, 84, ''),
(13, 172, 3, 84, ''),
(13, 171, 3, 84, ''),
(13, 170, 3, 84, ''),
(13, 93, 3, 6, ''),
(13, 92, 3, 6, ''),
(13, 284, 3, 283, ''),
(13, 283, 2, 1, ''),
(13, 84, 2, 1, ''),
(13, 50, 3, 40, ''),
(13, 1, 1, 0, ''),
(13, 2, 2, 1, ''),
(13, 6, 2, 1, ''),
(13, 7, 2, 1, ''),
(13, 30, 2, 1, ''),
(13, 40, 2, 1, ''),
(2, 92, 3, 6, ''),
(2, 284, 3, 283, ''),
(2, 283, 2, 1, ''),
(2, 84, 2, 1, ''),
(2, 50, 3, 40, ''),
(2, 1, 1, 0, ''),
(2, 2, 2, 1, ''),
(2, 6, 2, 1, ''),
(2, 7, 2, 1, ''),
(2, 30, 2, 1, ''),
(2, 40, 2, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `xiami_admin`
--

CREATE TABLE IF NOT EXISTS `xiami_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `account` varchar(64) NOT NULL COMMENT '用户名',
  `nickname` varchar(50) NOT NULL COMMENT '姓名',
  `password` char(32) NOT NULL COMMENT '密码',
  `bind_account` varchar(50) NOT NULL,
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(40) NOT NULL COMMENT '最后登录IP',
  `login_count` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `verify` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT 'email',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `type_id` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `info` text NOT NULL,
  `customerid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台管理员' AUTO_INCREMENT=50 ;

--
-- 转存表中的数据 `xiami_admin`
--

INSERT INTO `xiami_admin` (`id`, `account`, `nickname`, `password`, `bind_account`, `last_login_time`, `last_login_ip`, `login_count`, `verify`, `email`, `remark`, `create_time`, `update_time`, `status`, `type_id`, `info`, `customerid`) VALUES
(1, 'zuixiami', 'zuixiami', 'e43e4cebfa924e04ce29eadbf7737b71', '', 1385636375, '127.0.0.1', 0, '8888', '', '备注信息', 1222907803, 1222907803, 1, 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_config`
--

CREATE TABLE IF NOT EXISTS `xiami_config` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `textname` varchar(100) NOT NULL COMMENT '名称',
  `code` varchar(100) NOT NULL COMMENT '代码',
  `type` varchar(10) NOT NULL DEFAULT '' COMMENT '类型',
  `store_range` varchar(255) NOT NULL DEFAULT '' COMMENT '存储值',
  `store_dir` varchar(255) NOT NULL DEFAULT '' COMMENT '存储目录',
  `value` text NOT NULL COMMENT '值',
  `range_desc` varchar(255) NOT NULL COMMENT '存储值说明',
  `cfg_desc` varchar(255) NOT NULL COMMENT '描述',
  `sid` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `parent_id` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台系统配置表' AUTO_INCREMENT=211 ;

--
-- 转存表中的数据 `xiami_config`
--

INSERT INTO `xiami_config` (`id`, `pid`, `textname`, `code`, `type`, `store_range`, `store_dir`, `value`, `range_desc`, `cfg_desc`, `sid`) VALUES
(1, 0, '网站信息', 'cfg_web_info', 'group', '', '', '', '', '', 1),
(2, 0, '基本设置', 'cfg_basic', 'group', '', '', '', '', '', 2),
(5, 0, '邮件设置', 'cfg_mail', 'group', '', '', '', '', '', 5),
(4, 0, '水印设置', 'cfg_water', 'group', '', '', '', '', '', 4),
(101, 1, '网站名称', 'cfg_webname', 'text', '', '', '最虾米', '', '不超过60个字符,中文占用2字符 ', 5),
(102, 1, '网站地址', 'cfg_weburl', 'text', '', '', 'http://zp.zuixiami.com/', '', '', 6),
(103, 1, '网站备案号', 'cfg_icp', 'text', '', '', '网站备案号:', '', '', 7),
(104, 1, '加密字符', 'cfg_crypt', 'text', '', '', 'weweaicomweb', '', '', 8),
(106, 5, '开启邮件发送', 'cfg_sendmail', 'select', '1,0', '', '0', '开启,关闭', '', 1),
(107, 5, '邮件发送方式', 'cfg_mail_mailsend', 'select', 'mail,smtp,sendmail', '', 'mail', '通过 PHP 函数的 sendmail 发送(推荐此方式)<br>,通过 SOCKET 连接 SMTP 服务器发送(支持 ESMTP 验证)<br>,通过 PHP 函数 SMTP 发送 Email(仅 Windows 主机下有效 不支持 ESMTP 验证)<br>', '', 2),
(108, 5, 'SMTP 服务器', 'cfg_mail_server', 'text', '', '', 'sv52.wadax.ne.jp', '', '', 3),
(109, 5, 'SMTP 端口', 'cfg_mail_port', 'text', '', '', '25', '', '', 4),
(110, 5, 'SMTP 身份验证', 'cfg_mail_auth', 'select', '1,0', '', '0', '是,否', '', 5),
(111, 5, '发信人邮件地址', 'cfg_mail_from', 'text', '', '', 'wei5634@126.com', '', '', 9),
(112, 5, 'SMTP 身份验证用户名', 'cfg_mail_auth_username', 'text', '', '', 'wewe', '', '', 6),
(113, 5, 'SMTP 身份验证密码', 'cfg_mail_auth_password', 'password', '', '', 'wei1024', '', '', 7),
(114, 5, '邮件头的分隔符', 'cfg_mail_maildelimiter', 'select', '1,2,3', '', '1', '使用 CRLF 作为分隔符(通常为 Windows 主机)<br>,使用 LF 作为分隔符(通常为 Unix/Linux 主机)<br>,使用 CR 作为分隔符(通常为 Mac 主机)<br>', '', 18),
(116, 5, '发送方式', 'cfg_mail_sendmail_mime', 'text', '', '', 'html', '', '默认text,常用html', 20),
(117, 5, '邮件编码', 'cfg_mail_charset', 'text', '', '', 'UTF-8', '', 'UTF-8,GB2312 ', 21),
(118, 5, '邮件标题前缀', 'cfg_mail_bbname', 'text', '', '', '最蝦米*鬼懿IT**', '', '', 10),
(119, 5, '发件人姓名', 'cfg_mail_from_name', 'text', '', '', '最蝦米', '', '', 8),
(122, 1, '网站是否关闭', 'cfg_web_close', 'select', '1,0', '', '0', '是,否', '', 24),
(123, 1, '网站关闭原因', 'cfg_web_close_notice', 'textarea', '', '', '网站关闭原因', '', '', 25),
(100, 1, '前台模板地址', 'cfg_tplname', 'text', '', '', 'default', '', '', 27),
(99, 1, '后台模板地址', 'cfg_backend_tplname', 'text', '', '', 'admin', '', '', 27),
(181, 5, '服务接收邮箱', 'cfg_mail_service_address', 'text', '', '', 'wei5634@126.com', '', '', 28),
(182, 1, '后台目录', 'cfg_backend_access_point', 'text', '', '', 'wewe', '', '', 1),
(183, 1, '前台特别说明', 'cfg_notice_info', 'textarea', '', '', '鬼群高级群QQ群号：19046753（聚合前端业界人才，建立良好技术讨论氛围）<br/>\r\n      鬼群成长群QQ群号：181368696 （通过成长群筛选进入高级群，提交作品或者blog）', '', '', 29),
(184, 1, '统计代码', 'cfg_tongji', 'textarea', '', '', '<script src="//hm.baidu.com/h.js?d82d94085def6e342e036d021e453a4f"></script>', '', '统计代码', 30),
(185, 2, '首页作品显示数', 'cfg_index_works_num', 'text', '', '', '27', '', '', 31),
(186, 2, '首页作品排序', 'cfg_index_works_order', 'text', '', '', 'works.is_top DESC,works.top_sid DESC,works.id DESC', '', '<br>排序sql<br>\r\nw.is_top 是否推荐 1,0<br>\r\nw.top_sid 推荐排序<br>\r\nw.id  ID排序<br>\r\n默认w.is_top DESC,w.top_sid DESC,w.id DESC<br>\r\n推荐 倒序，推荐排序倒序，ID 倒序', 32),
(3, 0, '文件管理', 'cfg_file', 'group', '', '', '', '', '', 3),
(194, 3, '文件上传php地址', 'cfg_file_uploadurl', 'text', '', '', 'upload.php', '', '', 32),
(195, 3, '文件上传图片格式', 'cfg_file_upimg_ext', 'text', '', '', 'jpg,jpeg,gif,png', '', '逗号分开', 32),
(196, 3, '文件上传Flash格式', 'cfg_file_upflash_ext', 'text', '', '', 'swf', '', '逗号分开', 32),
(197, 3, '文件上传视频格式', 'cfg_file_upmedia_ext', 'text', '', '', 'avi', '', '逗号分开', 32),
(198, 3, '文件上传其他格式', 'cfg_file_uplink_ext', 'text', '', '', 'zip,rar,txt', '', '逗号分开', 32),
(199, 3, '最大文件大小', 'cfg_file_maxsize', 'text', '', '', '900', '', '单位K,-1不限制', 32),
(200, 3, '文件保存目录', 'cfg_file_save_path', 'text', '', '', 'Uploads', '', '最后不加/', 32),
(201, 3, '图片是否生成缩略图', 'cfg_file_is_thumb', 'select', '1,0', '', '1', '是,否', '', 32),
(202, 3, '缩略图文件前辍', 'cfg_file_thumb_prefix', 'text', '', '', 'm_,s_', '', '生成多个缩略图,请用,分开', 32),
(203, 3, '缩略图最大宽度', 'cfg_file_thumb_max_width', 'text', '', '', '400,100', '', '生成多个缩略图,请用,分开', 32),
(204, 3, '缩略图最大高度', 'cfg_file_thumb_max_height', 'text', '', '', '400,100', '', '生成多个缩略图,请用,分开', 32),
(205, 3, '是否删除原图', 'cfg_file_thumb_remove_origin', 'select', '1,0', '', '0', '是,否', '', 32),
(206, 4, '水印图片地址', 'cfg_water_image_url', 'text', '', '', 'Public/Images/logo.png', '', '', 32),
(207, 4, '水印透明度alpha', 'cfg_water_image_alpha', 'text', '', '', '80', '', '默认为80，范围为0~100', 32),
(208, 4, '是否开启水印', 'cfg_water_open', 'select', '1,0', '', '0', '开启,关闭', '', 30),
(210, 3, '文件缩略图保存目录', 'cfg_file_thumb_save_path', 'text', '', '', 'thumb', '', '在文件保存目录下面,请自行建立', 32);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_group`
--

CREATE TABLE IF NOT EXISTS `xiami_group` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT '分组标示',
  `title` varchar(50) NOT NULL COMMENT '分组名',
  `create_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `show` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台菜单分组' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `xiami_group`
--

INSERT INTO `xiami_group` (`id`, `name`, `title`, `create_time`, `update_time`, `status`, `sort`, `show`) VALUES
(2, 'System', '系统管理', 1222841259, 0, 1, 5, 1),
(14, 'Website', '功能', 1361863955, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_message`
--

CREATE TABLE IF NOT EXISTS `xiami_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mtype` varchar(100) NOT NULL,
  `lang` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `reply` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `dianhua` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `qq` varchar(50) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `addtime` int(11) NOT NULL DEFAULT '0',
  `checkuser` varchar(50) NOT NULL,
  `checktime` int(10) NOT NULL DEFAULT '0',
  `is_check` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `xiami_message`
--

INSERT INTO `xiami_message` (`id`, `mtype`, `lang`, `title`, `content`, `reply`, `name`, `dianhua`, `email`, `qq`, `ip`, `addtime`, `checkuser`, `checktime`, `is_check`) VALUES
(6, '', '', '', 'fds', '', '', '', '', 'fds', '113.247.242.59', 1368461669, '', 0, 0),
(7, '', '', '', 'This site is like a claosrsom, except I don''t hate it. lol', '', '', '', '', 'hrp0appzIKh', '94.23.238.222', 1377887321, '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_node`
--

CREATE TABLE IF NOT EXISTS `xiami_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(20) NOT NULL COMMENT '标识',
  `title` varchar(50) NOT NULL COMMENT '菜单名',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `sort` smallint(6) unsigned NOT NULL COMMENT '排序',
  `pid` smallint(6) unsigned NOT NULL COMMENT '上级ID',
  `level` tinyint(1) unsigned NOT NULL COMMENT '级别',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '后台分组ID对应group表',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='节点管理' AUTO_INCREMENT=300 ;

--
-- 转存表中的数据 `xiami_node`
--

INSERT INTO `xiami_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`, `type`, `group_id`) VALUES
(105, 'resume', '恢复', 1, '', 0, 98, 3, 0, 0),
(40, 'Index', '默认模块', 1, '', 1, 1, 2, 0, 0),
(99, 'index', '列表', 1, '', 0, 98, 3, 0, 0),
(104, 'forbid', '禁用', 1, '', 0, 98, 3, 0, 0),
(103, 'update', '更新', 1, '', 0, 98, 3, 0, 0),
(102, 'insert', '写入', 1, '', 0, 98, 3, 0, 0),
(101, 'edit', '编辑', 1, '', 0, 98, 3, 0, 0),
(100, 'add', '新增', 1, '', 0, 98, 3, 0, 0),
(30, 'Public', '公共模块', 1, '', 2, 1, 2, 0, 0),
(7, 'Admin', '管理员', 1, '', 0, 1, 2, 0, 2),
(6, 'Role', '角色管理', 1, '', 1, 1, 2, 0, 2),
(2, 'Node', '节点管理', 1, '', 2, 1, 2, 0, 2),
(1, 'Admin', '后台管理', 1, '', 0, 0, 1, 0, 0),
(50, 'index', '空白首页', 1, '', 0, 40, 3, 0, 0),
(84, 'Group', '后台菜单分组', 1, '', 3, 1, 2, 0, 2),
(283, 'Syslogs', '后台管理日志', 1, '', 4, 1, 2, 0, 2),
(284, 'index', '首页', 1, '', 0, 283, 3, 0, 0),
(92, 'access', '授权', 1, '', 0, 6, 3, 0, 0),
(93, 'user', '用户列表', 1, '', 0, 6, 3, 0, 0),
(94, 'index', '日志信息', 1, '', 0, 91, 3, 0, 0),
(95, 'index', '广告业务类型首页', 1, '', 0, 90, 3, 0, 0),
(106, 'foreverdelete', '删除', 1, '', 0, 98, 3, 0, 0),
(107, 'index', '列表', 1, '', 0, 97, 3, 0, 0),
(108, 'add', '新增', 1, '', 0, 97, 3, 0, 0),
(109, 'edit', '编辑', 1, '', 0, 97, 3, 0, 0),
(110, 'insert', '写入', 1, '', 0, 97, 3, 0, 0),
(111, 'update', '更新', 1, '', 0, 97, 3, 0, 0),
(112, 'forbid', '禁用', 1, '', 0, 97, 3, 0, 0),
(113, 'resume', '恢复', 1, '', 0, 97, 3, 0, 0),
(114, 'foreverdelete', '删除', 1, '', 0, 97, 3, 0, 0),
(115, 'index', '列表', 1, '', 0, 96, 3, 0, 0),
(116, 'add', '新增', 1, '', 0, 96, 3, 0, 0),
(117, 'edit', '编辑', 1, '', 0, 96, 3, 0, 0),
(118, 'insert', '写入', 1, '', 0, 96, 3, 0, 0),
(119, 'update', '更新', 1, '', 0, 96, 3, 0, 0),
(120, 'forbid', '禁用', 1, '', 0, 96, 3, 0, 0),
(121, 'resume', '恢复', 1, '', 0, 96, 3, 0, 0),
(122, 'foreverdelete', '删除', 1, '', 0, 96, 3, 0, 0),
(123, 'add', '新增', 1, '', 0, 90, 3, 0, 0),
(124, 'edit', '编辑', 1, '', 0, 90, 3, 0, 0),
(125, 'insert', '写入', 1, '', 0, 90, 3, 0, 0),
(126, 'update', '更新', 1, '', 0, 90, 3, 0, 0),
(127, 'forbid', '禁用', 1, '', 0, 90, 3, 0, 0),
(128, 'resume', '恢复', 1, '', 0, 90, 3, 0, 0),
(129, 'foreverdelete', '删除', 1, '', 0, 90, 3, 0, 0),
(130, 'index', '列表', 1, '', 0, 89, 3, 0, 0),
(131, 'add', '新增', 1, '', 0, 89, 3, 0, 0),
(132, 'edit', '编辑', 1, '', 0, 89, 3, 0, 0),
(133, 'insert', '写入', 1, '', 0, 89, 3, 0, 0),
(134, 'update', '更新', 1, '', 0, 89, 3, 0, 0),
(135, 'forbid', '禁用', 1, '', 0, 89, 3, 0, 0),
(136, 'resume', '恢复', 1, '', 0, 89, 3, 0, 0),
(137, 'foreverdelete', '删除', 1, '', 0, 89, 3, 0, 0),
(138, 'index', '列表', 1, '', 0, 88, 3, 0, 0),
(139, 'add', '新增', 1, '', 0, 88, 3, 0, 0),
(140, 'edit', '编辑', 1, '', 0, 88, 3, 0, 0),
(141, 'insert', '写入', 1, '', 0, 88, 3, 0, 0),
(142, 'update', '更新', 1, '', 0, 88, 3, 0, 0),
(143, 'forbid', '禁用', 1, '', 0, 88, 3, 0, 0),
(144, 'resume', '恢复', 1, '', 0, 88, 3, 0, 0),
(145, 'foreverdelete', '删除', 1, '', 0, 88, 3, 0, 0),
(146, 'index', '列表', 1, '', 0, 87, 3, 0, 0),
(147, 'add', '新增', 1, '', 0, 87, 3, 0, 0),
(148, 'edit', '编辑', 1, '', 0, 87, 3, 0, 0),
(149, 'insert', '写入', 1, '', 0, 87, 3, 0, 0),
(150, 'update', '更新', 1, '', 0, 87, 3, 0, 0),
(151, 'forbid', '禁用', 1, '', 0, 87, 3, 0, 0),
(152, 'resume', '恢复', 1, '', 0, 87, 3, 0, 0),
(153, 'foreverdelete', '删除', 1, '', 0, 87, 3, 0, 0),
(154, 'index', '列表', 1, '', 0, 86, 3, 0, 0),
(155, 'add', '新增', 1, '', 0, 86, 3, 0, 0),
(156, 'edit', '编辑', 1, '', 0, 86, 3, 0, 0),
(157, 'insert', '写入', 1, '', 0, 86, 3, 0, 0),
(158, 'update', '更新', 1, '', 0, 86, 3, 0, 0),
(159, 'forbid', '禁用', 1, '', 0, 86, 3, 0, 0),
(160, 'resume', '恢复', 1, '', 0, 86, 3, 0, 0),
(161, 'foreverdelete', '删除', 1, '', 0, 86, 3, 0, 0),
(162, 'index', '列表', 1, '', 0, 85, 3, 0, 0),
(163, 'add', '新增', 1, '', 0, 85, 3, 0, 0),
(164, 'edit', '编辑', 1, '', 0, 85, 3, 0, 0),
(165, 'insert', '写入', 1, '', 0, 85, 3, 0, 0),
(166, 'update', '更新', 1, '', 0, 85, 3, 0, 0),
(167, 'forbid', '禁用', 1, '', 0, 85, 3, 0, 0),
(168, 'resume', '恢复', 1, '', 0, 85, 3, 0, 0),
(169, 'foreverdelete', '删除', 1, '', 0, 85, 3, 0, 0),
(170, 'index', '列表', 1, '', 0, 84, 3, 0, 0),
(171, 'add', '新增', 1, '', 0, 84, 3, 0, 0),
(172, 'edit', '编辑', 1, '', 0, 84, 3, 0, 0),
(173, 'insert', '写入', 1, '', 0, 84, 3, 0, 0),
(174, 'update', '更新', 1, '', 0, 84, 3, 0, 0),
(175, 'forbid', '禁用', 1, '', 0, 84, 3, 0, 0),
(176, 'resume', '恢复', 1, '', 0, 84, 3, 0, 0),
(177, 'foreverdelete', '删除', 1, '', 0, 84, 3, 0, 0),
(178, 'index', '列表', 1, '', 0, 7, 3, 0, 0),
(179, 'add', '新增', 1, '', 0, 7, 3, 0, 0),
(180, 'edit', '编辑', 1, '', 0, 7, 3, 0, 0),
(181, 'insert', '写入', 1, '', 0, 7, 3, 0, 0),
(182, 'update', '更新', 1, '', 0, 7, 3, 0, 0),
(183, 'forbid', '禁用', 1, '', 0, 7, 3, 0, 0),
(184, 'resume', '恢复', 1, '', 0, 7, 3, 0, 0),
(185, 'foreverdelete', '删除', 1, '', 0, 7, 3, 0, 0),
(186, 'index', '列表', 1, '', 0, 6, 3, 0, 0),
(187, 'add', '新增', 1, '', 0, 6, 3, 0, 0),
(188, 'edit', '编辑', 1, '', 0, 6, 3, 0, 0),
(189, 'insert', '写入', 1, '', 0, 6, 3, 0, 0),
(190, 'update', '更新', 1, '', 0, 6, 3, 0, 0),
(191, 'forbid', '禁用', 1, '', 0, 6, 3, 0, 0),
(192, 'resume', '恢复', 1, '', 0, 6, 3, 0, 0),
(193, 'foreverdelete', '删除', 1, '', 0, 6, 3, 0, 0),
(194, 'index', '列表', 1, '', 0, 2, 3, 0, 0),
(195, 'add', '新增', 1, '', 0, 2, 3, 0, 0),
(196, 'edit', '编辑', 1, '', 0, 2, 3, 0, 0),
(197, 'insert', '写入', 1, '', 0, 2, 3, 0, 0),
(198, 'update', '更新', 1, '', 0, 2, 3, 0, 0),
(199, 'forbid', '禁用', 1, '', 0, 2, 3, 0, 0),
(200, 'resume', '恢复', 1, '', 0, 2, 3, 0, 0),
(201, 'foreverdelete', '删除', 1, '', 0, 2, 3, 0, 0),
(202, 'menu', '菜单', 1, '', 0, 30, 3, 0, 0),
(203, 'main', '系统信息', 1, '', 0, 30, 3, 0, 0),
(204, 'index', '首页', 1, '', 0, 30, 3, 0, 0),
(205, 'resetPwd', '保存修改密码', 1, '', 0, 7, 3, 0, 0),
(206, 'password', '修改密码', 1, '', 0, 7, 3, 0, 0),
(207, 'getAdResourcesList', '选择默认资源', 1, '', 0, 88, 3, 0, 0),
(208, 'getAdPositionList', '选择广告位信息', 1, '', 0, 90, 3, 0, 0),
(210, 'index', '列表', 1, '', 0, 209, 3, 0, 0),
(211, 'add', '新增', 1, '', 0, 209, 3, 0, 0),
(212, 'edit', '编辑', 1, '', 0, 209, 3, 0, 0),
(213, 'insert', '写入', 1, '', 0, 209, 3, 0, 0),
(214, 'update', '更新', 1, '', 0, 209, 3, 0, 0),
(215, 'forbid', '禁用', 1, '', 0, 209, 3, 0, 0),
(216, 'resume', '恢复', 1, '', 0, 209, 3, 0, 0),
(217, 'foreverdelete', '删除', 1, '', 0, 209, 3, 0, 0),
(224, 'defaultCreate', '生成发送包', 1, '', 0, 87, 3, 0, 0),
(225, 'getAdTypeList', '业务类型列表', 1, '', 0, 86, 3, 0, 0),
(226, 'getAdResourcesList', '资源列表', 1, '', 0, 86, 3, 0, 0),
(227, 'getPositionList', '获取广告位', 1, '', 0, 86, 3, 0, 0),
(228, 'getEditPositionList', '编辑时获取广告位', 1, '', 0, 86, 3, 0, 0),
(229, 'index', '列表', 1, '', 0, 223, 3, 0, 0),
(230, 'add', '新增', 1, '', 0, 223, 3, 0, 0),
(231, 'edit', '编辑', 1, '', 0, 223, 3, 0, 0),
(232, 'insert', '写入', 1, '', 0, 223, 3, 0, 0),
(233, 'update', '更新', 1, '', 0, 223, 3, 0, 0),
(234, 'forbid', '禁用', 1, '', 0, 223, 3, 0, 0),
(235, 'resume', '恢复', 1, '', 0, 223, 3, 0, 0),
(236, 'foreverdelete', '删除', 1, '', 0, 223, 3, 0, 0),
(237, 'index', '列表', 1, '', 0, 222, 3, 0, 0),
(238, 'add', '新增', 1, '', 0, 222, 3, 0, 0),
(239, 'edit', '编辑', 1, '', 0, 222, 3, 0, 0),
(240, 'insert', '写入', 1, '', 0, 222, 3, 0, 0),
(241, 'update', '更新', 1, '', 0, 222, 3, 0, 0),
(242, 'forbid', '禁用', 1, '', 0, 222, 3, 0, 0),
(243, 'resume', '恢复', 1, '', 0, 222, 3, 0, 0),
(244, 'foreverdelete', '删除', 1, '', 0, 222, 3, 0, 0),
(245, 'index', '列表', 1, '', 0, 221, 3, 0, 0),
(246, 'add', '新增', 1, '', 0, 221, 3, 0, 0),
(247, 'edit', '编辑', 1, '', 0, 221, 3, 0, 0),
(248, 'insert', '写入', 1, '', 0, 221, 3, 0, 0),
(249, 'update', '更新', 1, '', 0, 221, 3, 0, 0),
(250, 'forbid', '禁用', 1, '', 0, 221, 3, 0, 0),
(251, 'resume', '恢复', 1, '', 0, 221, 3, 0, 0),
(252, 'foreverdelete', '删除', 1, '', 0, 221, 3, 0, 0),
(253, 'index', '列表', 1, '', 0, 220, 3, 0, 0),
(254, 'add', '新增', 1, '', 0, 220, 3, 0, 0),
(255, 'edit', '编辑', 1, '', 0, 220, 3, 0, 0),
(256, 'insert', '写入', 1, '', 0, 220, 3, 0, 0),
(257, 'update', '更新', 1, '', 0, 220, 3, 0, 0),
(258, 'forbid', '禁用', 1, '', 0, 220, 3, 0, 0),
(259, 'resume', '恢复', 1, '', 0, 220, 3, 0, 0),
(260, 'foreverdelete', '删除', 1, '', 0, 220, 3, 0, 0),
(261, 'index', '列表', 1, '', 0, 219, 3, 0, 0),
(262, 'add', '新增', 1, '', 0, 219, 3, 0, 0),
(263, 'edit', '编辑', 1, '', 0, 219, 3, 0, 0),
(264, 'insert', '写入', 1, '', 0, 219, 3, 0, 0),
(265, 'update', '更新', 1, '', 0, 219, 3, 0, 0),
(266, 'forbid', '禁用', 1, '', 0, 219, 3, 0, 0),
(267, 'resume', '恢复', 1, '', 0, 219, 3, 0, 0),
(268, 'foreverdelete', '删除', 1, '', 0, 219, 3, 0, 0),
(269, 'index', '列表', 1, '', 0, 218, 3, 0, 0),
(270, 'add', '新增', 1, '', 0, 218, 3, 0, 0),
(271, 'edit', '编辑', 1, '', 0, 218, 3, 0, 0),
(272, 'insert', '写入', 1, '', 0, 218, 3, 0, 0),
(273, 'update', '更新', 1, '', 0, 218, 3, 0, 0),
(274, 'forbid', '禁用', 1, '', 0, 218, 3, 0, 0),
(275, 'resume', '恢复', 1, '', 0, 218, 3, 0, 0),
(276, 'foreverdelete', '删除', 1, '', 0, 218, 3, 0, 0),
(277, 'setGroupAll', '设置权限', 1, '', 0, 6, 3, 0, 0),
(288, 'Config', '系统配置', 1, '', 0, 1, 2, 0, 2),
(289, 'Sysconfig', '系统配置管理', 1, '', 0, 1, 2, 0, 2),
(290, 'Works', '作品列表', 1, '', 0, 1, 2, 0, 14),
(291, 'Works_sort', '作品分类', 1, '', 0, 1, 2, 0, 14),
(292, 'Qun_member', '成员管理', 1, '', 0, 1, 2, 0, 14),
(293, 'Qun_sort', '成员分类', 1, '', 0, 1, 2, 0, 14),
(294, 'Message', '留言建议', 1, '', 0, 1, 2, 0, 14),
(295, 'Pages', '单页管理', 1, '', 0, 1, 2, 0, 14),
(296, 'Website_log', '网站更新日志', 1, '', 0, 1, 2, 0, 14),
(297, 'Syscache', '更新缓存', 1, '', 0, 1, 2, 0, 2),
(298, 'Uploads', '附件管理', 1, '', 0, 1, 2, 0, 14),
(299, 'Works_special', '作品专题', 1, '', 0, 1, 2, 0, 14);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_pages`
--

CREATE TABLE IF NOT EXISTS `xiami_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(128) NOT NULL COMMENT '标题',
  `code` varchar(128) NOT NULL COMMENT '代码',
  `contents` text NOT NULL COMMENT '内容',
  `adduser` varchar(100) NOT NULL COMMENT '添加人',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `is_open_edit` tinyint(1) NOT NULL COMMENT '是否允许前台编辑',
  PRIMARY KEY (`id`),
  KEY `slug` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='单页管理' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `xiami_pages`
--

INSERT INTO `xiami_pages` (`id`, `title`, `code`, `contents`, `adduser`, `addtime`, `is_open_edit`) VALUES
(14, '联系我们', 'about', '<p>最虾米*作品秀&nbsp;</p><p>V1.1</p><p>update 2013/3/15</p><p><br /></p><p>最虾米来源闽南话中的意思：做什么。</p><p>一路的成长我们曾多少次的迷茫，都在想做什么</p><p>别想了，开始做吧。</p><p>最虾米目前以收集鬼群的<strong>前端开发</strong>作品为主，建立和推广作品</p><p>让前端开发从技术实现到产品，到商品价值的过程。</p><p><br /></p><p>我们还在不断改进，我们还有很长很长的路要走，</p><p>不管我们是否中途就“挂了”，但是我们开始做了，</p><p>请给我们一些时间，也希望多多支持</p><p>有什么建议，意见，纠错欢迎提出</p><p><br /></p><p>鬼懿成长QQ群：181368696</p><p>鬼懿IT：19046753（第8年）</p><p>新浪官方微博：@最虾米网站</p><p><br /></p><p><strong>特别感谢最虾米团队</strong></p><p>焰之翼（wewe）</p><p>Travis<br /></p><p>Sam</p><p>TGL</p><p>光敏</p><p><strong>感谢参谋</strong></p><p>胡尐睿</p><p>漫步</p><p>加入最虾米团队，加qq群：256732638</p><p><br /></p>', 'zuixiami', 1360851430, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_qun_member`
--

CREATE TABLE IF NOT EXISTS `xiami_qun_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `qun_sort_id` int(11) NOT NULL DEFAULT '0' COMMENT '群分类ID对应works_sort',
  `qq` varchar(100) NOT NULL COMMENT 'qq号码',
  `name` varchar(100) NOT NULL COMMENT 'qq名',
  `await` bigint(20) NOT NULL COMMENT '期待作者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='群成员表' AUTO_INCREMENT=496 ;

--
-- 转存表中的数据 `xiami_qun_member`
--

-- 忽略

-- --------------------------------------------------------

--
-- 表的结构 `xiami_qun_sort`
--

CREATE TABLE IF NOT EXISTS `xiami_qun_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '群分类ID',
  `name` varchar(100) NOT NULL COMMENT '群分类名',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='群分类' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `xiami_qun_sort`
--

INSERT INTO `xiami_qun_sort` (`id`, `name`, `sid`) VALUES
(1, '成长群', 1),
(2, '高级群', 2);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_role`
--

CREATE TABLE IF NOT EXISTS `xiami_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(20) NOT NULL COMMENT '组名',
  `pid` smallint(6) NOT NULL COMMENT '上级ID',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `ename` varchar(5) NOT NULL,
  `create_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `ename` (`ename`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='角色分组' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `xiami_role`
--

INSERT INTO `xiami_role` (`id`, `name`, `pid`, `status`, `remark`, `ename`, `create_time`, `update_time`) VALUES
(1, '管理组', 0, 1, '', '', 1208784792, 1305166068),
(2, '编辑组', 0, 1, '', '', 1215496283, 1305166076),
(9, '信息组', 0, 1, '', '', 1307071286, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_role_user`
--

CREATE TABLE IF NOT EXISTS `xiami_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL COMMENT '角色授权ID对应role表',
  `user_id` char(32) DEFAULT NULL COMMENT '用户ID',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色授权表';

--
-- 转存表中的数据 `xiami_role_user`
--

INSERT INTO `xiami_role_user` (`role_id`, `user_id`) VALUES
(4, '27'),
(4, '26'),
(4, '30'),
(5, '31'),
(3, '22'),
(3, '1'),
(1, '4'),
(1, '39'),
(1, '39'),
(3, '35'),
(3, '36'),
(1, '2'),
(2, '3'),
(1, '39'),
(1, '39'),
(1, '39'),
(1, '40'),
(11, '41'),
(0, '42'),
(0, '42'),
(11, '41'),
(1, '40'),
(10, '43'),
(10, '43'),
(11, '41'),
(10, '44'),
(10, '44'),
(10, '43'),
(11, '41'),
(1, '45'),
(0, '46'),
(0, '47'),
(2, '48'),
(2, '48'),
(1, '49'),
(NULL, '49');

-- --------------------------------------------------------

--
-- 表的结构 `xiami_syslogs`
--

CREATE TABLE IF NOT EXISTS `xiami_syslogs` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `modulename` varchar(30) NOT NULL COMMENT '分组',
  `actionname` varchar(30) NOT NULL COMMENT '模块',
  `opname` varchar(30) NOT NULL COMMENT '操作',
  `message` varchar(30) DEFAULT NULL COMMENT '备注',
  `userid` smallint(5) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `userip` varchar(40) NOT NULL COMMENT '用户IP',
  `create_time` int(11) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员操作日志表' AUTO_INCREMENT=78 ;

--
-- 转存表中的数据 `xiami_syslogs`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiami_tag`
--

CREATE TABLE IF NOT EXISTS `xiami_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tagname` varchar(200) NOT NULL COMMENT '标签名称',
  `hits` bigint(20) NOT NULL COMMENT '点击量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `xiami_tag`
--


-- --------------------------------------------------------

--
-- 表的结构 `xiami_tag_relationship`
--

CREATE TABLE IF NOT EXISTS `xiami_tag_relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tagid` int(11) NOT NULL COMMENT '标签ID',
  `workid` int(11) NOT NULL COMMENT '作品ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `xiami_tag_relationship`
--


-- --------------------------------------------------------

--
-- 表的结构 `xiami_team`
--

CREATE TABLE IF NOT EXISTS `xiami_team` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `teamname` varchar(100) NOT NULL COMMENT '团队名称',
  `teamimg` varchar(200) NOT NULL COMMENT '团队头像',
  `teamurl` varchar(200) NOT NULL COMMENT '团队地址',
  `notice` varchar(255) NOT NULL COMMENT '团队介绍',
  `creatuserid` int(11) NOT NULL COMMENT '创建人',
  `creatime` int(10) NOT NULL DEFAULT '0' COMMENT '团队创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 1回收站 0正常使用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='团队表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `xiami_team`
--


-- --------------------------------------------------------

--
-- 表的结构 `xiami_team_qunmember`
--

CREATE TABLE IF NOT EXISTS `xiami_team_qunmember` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '团队成员主键ID',
  `teamid` int(10) NOT NULL COMMENT '团队ID',
  `qunmemberid` int(10) NOT NULL COMMENT '团队成员ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='团队成员表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `xiami_team_qunmember`
--


-- --------------------------------------------------------

--
-- 表的结构 `xiami_team_user`
--

CREATE TABLE IF NOT EXISTS `xiami_team_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '团队成员主键ID',
  `teamid` int(10) NOT NULL COMMENT '团队ID',
  `userid` int(11) NOT NULL COMMENT '用户ID关联user表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='团队成员表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `xiami_team_user`
--


-- --------------------------------------------------------

--
-- 表的结构 `xiami_team_work`
--

CREATE TABLE IF NOT EXISTS `xiami_team_work` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '团队作品主键ID',
  `workid` int(10) NOT NULL COMMENT '团队作品id',
  `teamid` int(10) NOT NULL COMMENT '团队id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='团队作品表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `xiami_team_work`
--


-- --------------------------------------------------------

--
-- 表的结构 `xiami_t_members`
--

CREATE TABLE IF NOT EXISTS `xiami_t_members` (
  `id` varchar(100) NOT NULL COMMENT '自增ID',
  `qqnumber` varchar(100) NOT NULL COMMENT 'QQ号码',
  `qqname` varchar(100) NOT NULL COMMENT '昵称',
  KEY `qqnumber` (`qqnumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='原始QQ群记录需要处理到qun_member内';

--
-- 转存表中的数据 `xiami_t_members`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiami_uploads`
--

CREATE TABLE IF NOT EXISTS `xiami_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(40) NOT NULL COMMENT '模块',
  `mid` int(11) NOT NULL DEFAULT '0' COMMENT '模块ID',
  `title` varchar(255) NOT NULL COMMENT '标题/图片描述',
  `url` varchar(255) NOT NULL COMMENT '地址',
  `mediatype` varchar(100) NOT NULL COMMENT '媒体类型',
  `filesize` varchar(30) NOT NULL COMMENT '文件大小',
  `extension` varchar(20) NOT NULL COMMENT '后缀名',
  `thumburl_0` varchar(255) NOT NULL COMMENT '缩略图1',
  `thumburl_1` varchar(255) NOT NULL COMMENT '缩略图2',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `hit` int(11) NOT NULL DEFAULT '0' COMMENT '点击率',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='附件管理' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `xiami_uploads`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiami_user`
--

CREATE TABLE IF NOT EXISTS `xiami_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `qun_sort_id` int(11) NOT NULL DEFAULT '0' COMMENT '群分类ID',
  `type` varchar(100) NOT NULL DEFAULT '0' COMMENT '登录类型',
  `openid` varchar(100) NOT NULL DEFAULT '0' COMMENT '返回开放ID',
  `nickname` varchar(100) NOT NULL DEFAULT '0' COMMENT '昵称',
  `figureurl` varchar(255) NOT NULL DEFAULT '' COMMENT '头像地址',
  `qq` varchar(20) NOT NULL DEFAULT '0' COMMENT 'QQ号码',
  `userurl` varchar(200) NOT NULL DEFAULT '0' COMMENT '用户blog地址',
  `notice` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户介绍',
  `is_open` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启自定义昵称',
  `is_locked` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否停用用户',
  `await` bigint(20) NOT NULL DEFAULT '0' COMMENT '期待作者',
  `hits` bigint(20) NOT NULL DEFAULT '0' COMMENT '点击量',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=501 ;

--
-- 转存表中的数据 `xiami_user`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiami_user_action`
--

CREATE TABLE IF NOT EXISTS `xiami_user_action` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL COMMENT '模块',
  `mtype` varchar(100) NOT NULL COMMENT '类型',
  `mid` int(11) NOT NULL COMMENT '模块ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `value` varchar(20) NOT NULL COMMENT '值',
  `ip` varchar(100) NOT NULL COMMENT '当前IP',
  `addtime` int(10) NOT NULL COMMENT '当前时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户操作暂用于赞/期待/rank' AUTO_INCREMENT=213 ;

--
-- 转存表中的数据 `xiami_user_action`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiami_website_log`
--

CREATE TABLE IF NOT EXISTS `xiami_website_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL COMMENT '标题',
  `contents` text NOT NULL COMMENT '内容',
  `adduser` varchar(100) NOT NULL COMMENT '添加人',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='网站更新日志' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `xiami_website_log`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiami_works`
--

CREATE TABLE IF NOT EXISTS `xiami_works` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `sortid` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID对应works_sort表',
  `qun_sortid` int(11) NOT NULL DEFAULT '0' COMMENT '群分类对应qun_sort表',
  `name` varchar(100) NOT NULL DEFAULT '0' COMMENT '作品名称',
  `author` varchar(50) NOT NULL DEFAULT '0' COMMENT '作者',
  `url` varchar(200) NOT NULL DEFAULT '0' COMMENT '1.1用，1.2后废除地址',
  `demourl` varchar(255) NOT NULL DEFAULT '0' COMMENT '演示地址',
  `openurl` varchar(255) NOT NULL DEFAULT '0' COMMENT '开源地址',
  `img` varchar(200) NOT NULL DEFAULT '0' COMMENT '图片缩略图',
  `qq` varchar(20) NOT NULL DEFAULT '0' COMMENT 'qq',
  `description` text NOT NULL COMMENT '描述',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '申请时间',
  `checkuser` varchar(100) NOT NULL DEFAULT '0' COMMENT '审核人',
  `checktime` int(10) NOT NULL DEFAULT '0' COMMENT '审核时间',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `top_sid` int(11) NOT NULL DEFAULT '0' COMMENT '推荐排序',
  `good` bigint(20) NOT NULL DEFAULT '0' COMMENT '赞',
  `rank_total` bigint(20) NOT NULL DEFAULT '0' COMMENT '星级总评分',
  `rank_count` bigint(20) NOT NULL DEFAULT '0' COMMENT '星级评分总次数',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态   1等待审核 2审核通过  3审核不通过  4回收站(用户删除)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品列表' AUTO_INCREMENT=185 ;

--
-- 转存表中的数据 `xiami_works`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiami_works_log`
--

CREATE TABLE IF NOT EXISTS `xiami_works_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `works_id` int(11) NOT NULL COMMENT '作品ID对应works表',
  `action` varchar(30) NOT NULL COMMENT '操作',
  `notice` varchar(255) NOT NULL COMMENT '备注',
  `adduser` varchar(100) NOT NULL COMMENT '操作用户',
  `addtime` int(10) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品日志表' AUTO_INCREMENT=56 ;

--
-- 转存表中的数据 `xiami_works_log`
--

-- --------------------------------------------------------

--
-- 表的结构 `xiami_works_sort`
--

CREATE TABLE IF NOT EXISTS `xiami_works_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父类ID',
  `layer` int(11) NOT NULL DEFAULT '0' COMMENT '所在层',
  `orders` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `name` varchar(100) NOT NULL COMMENT '标题',
  `othername` varchar(100) NOT NULL COMMENT '别名',
  `code` varchar(100) NOT NULL COMMENT 'url代码',
  `is_hide` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品分类' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `xiami_works_sort`
--

INSERT INTO `xiami_works_sort` (`id`, `pid`, `layer`, `orders`, `name`, `othername`, `code`, `is_hide`) VALUES
(1, 0, 1, 0, '书籍', '书籍', 'book', 0),
(2, 0, 1, 0, 'CSS作品', 'CSS作品', 'css', 0),
(3, 0, 1, 0, 'js作品', 'js作品', 'js', 0),
(4, 0, 1, 0, 'blog作品', 'blog作品', 'blog', 0),
(5, 0, 1, 0, '教程', '教程', 'study', 0),
(6, 1, 2, 1, '原著', '原著', 'original', 0),
(7, 1, 2, 1, '译作', '译作', 'translate', 0),
(8, 2, 2, 1, 'css库', 'css库', 'libraries', 0),
(9, 2, 2, 1, 'cssDemo', 'cssDemo', 'cssdemo', 0),
(10, 3, 2, 1, 'js库', 'js库', 'jslib', 0),
(11, 3, 2, 1, 'js项目', 'js项目', 'jsproject', 0),
(15, 0, 0, 2, '框架平台', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_works_special`
--

CREATE TABLE IF NOT EXISTS `xiami_works_special` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `qishu` varchar(100) NOT NULL COMMENT '第几期',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `notice` varchar(255) NOT NULL COMMENT '备注',
  `code` varchar(100) NOT NULL COMMENT '代码伪静态用',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `top_sid` int(11) NOT NULL DEFAULT '0' COMMENT '推荐排序',
  `adduser` varchar(100) NOT NULL COMMENT '添加人',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `img` varchar(255) NOT NULL COMMENT '缩略图',
  `award` varchar(50) NOT NULL COMMENT '奖励',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品专题' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `xiami_works_special`
--

INSERT INTO `xiami_works_special` (`id`, `qishu`, `title`, `description`, `notice`, `code`, `is_top`, `top_sid`, `adduser`, `addtime`, `img`, `award`) VALUES
(1, '第一期', 'WebOS 专题', '', '', '', 0, 0, '', 1363331552, '', ''),
(2, '第二期', '那些前端的书籍你是否都看过', '', '', '', 0, 0, '', 1363331940, '', ''),
(3, '第三期', '游戏？娱乐？太少了', '', '', '', 0, 0, '', 1365732471, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `xiami_works_special_mid`
--

CREATE TABLE IF NOT EXISTS `xiami_works_special_mid` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `special_id` int(11) NOT NULL COMMENT '专题ID对应works_special',
  `works_id` int(10) NOT NULL COMMENT '作品ID对应works表',
  `adduser` varchar(100) NOT NULL COMMENT '添加人',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `special_id` (`special_id`),
  KEY `mid` (`works_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品专题一对多' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `xiami_works_special_mid`
--

INSERT INTO `xiami_works_special_mid` (`id`, `special_id`, `works_id`, `adduser`, `addtime`) VALUES
(1, 1, 104, '', 1363331621),
(2, 1, 51, '', 1363331621),
(3, 2, 59, '', 1363332110),
(4, 2, 58, '', 1363332110),
(5, 2, 57, '', 1363332110),
(6, 2, 54, '', 1363332110),
(7, 2, 52, '', 1363332110),
(8, 2, 50, '', 1363332110),
(9, 3, 136, '', 1365732561),
(10, 3, 134, '', 1365732561),
(11, 3, 117, '', 1365732561),
(12, 3, 113, '', 1365732561),
(13, 3, 75, '', 1365732561),
(14, 3, 73, '', 1365732561);
