-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1:3306
-- 生成日期: 2013 年 05 月 07 日 14:01
-- 服务器版本: 5.1.28
-- PHP 版本: 5.2.6

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

DROP TABLE IF EXISTS `xiami_access`;
CREATE TABLE IF NOT EXISTS `xiami_access` (
  `role_id` smallint(6) unsigned NOT NULL COMMENT '角色分组ID对应role表',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '节点ID对应node表',
  `level` tinyint(1) NOT NULL COMMENT '级别',
  `pid` smallint(6) NOT NULL COMMENT '上级ID',
  `module` varchar(50) DEFAULT NULL COMMENT '模块',
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台权限';

--
-- 导出表中的数据 `xiami_access`
--

INSERT INTO `xiami_access` (`role_id`, `node_id`, `level`, `pid`, `module`) VALUES
(7, 153, 3, 87, NULL),
(7, 152, 3, 87, NULL),
(7, 151, 3, 87, NULL),
(7, 150, 3, 87, NULL),
(7, 149, 3, 87, NULL),
(7, 148, 3, 87, NULL),
(7, 147, 3, 87, NULL),
(7, 146, 3, 87, NULL),
(7, 87, 2, 1, NULL),
(7, 85, 2, 1, NULL),
(7, 50, 3, 40, NULL),
(7, 1, 1, 0, NULL),
(7, 30, 2, 1, NULL),
(7, 40, 2, 1, NULL),
(9, 1, 1, 0, NULL),
(1, 277, 3, 6, NULL),
(1, 276, 3, 218, NULL),
(1, 275, 3, 218, NULL),
(1, 274, 3, 218, NULL),
(1, 273, 3, 218, NULL),
(1, 272, 3, 218, NULL),
(1, 271, 3, 218, NULL),
(1, 270, 3, 218, NULL),
(1, 269, 3, 218, NULL),
(1, 268, 3, 219, NULL),
(1, 267, 3, 219, NULL),
(1, 266, 3, 219, NULL),
(1, 265, 3, 219, NULL),
(1, 264, 3, 219, NULL),
(1, 263, 3, 219, NULL),
(1, 262, 3, 219, NULL),
(1, 261, 3, 219, NULL),
(1, 260, 3, 220, NULL),
(1, 259, 3, 220, NULL),
(1, 258, 3, 220, NULL),
(1, 257, 3, 220, NULL),
(1, 256, 3, 220, NULL),
(1, 255, 3, 220, NULL),
(1, 254, 3, 220, NULL),
(1, 253, 3, 220, NULL),
(1, 252, 3, 221, NULL),
(1, 251, 3, 221, NULL),
(1, 250, 3, 221, NULL),
(1, 249, 3, 221, NULL),
(1, 248, 3, 221, NULL),
(1, 247, 3, 221, NULL),
(1, 246, 3, 221, NULL),
(1, 245, 3, 221, NULL),
(1, 244, 3, 222, NULL),
(1, 243, 3, 222, NULL),
(1, 242, 3, 222, NULL),
(1, 241, 3, 222, NULL),
(1, 240, 3, 222, NULL),
(1, 239, 3, 222, NULL),
(1, 238, 3, 222, NULL),
(1, 237, 3, 222, NULL),
(1, 236, 3, 223, NULL),
(1, 235, 3, 223, NULL),
(1, 234, 3, 223, NULL),
(1, 233, 3, 223, NULL),
(1, 232, 3, 223, NULL),
(1, 231, 3, 223, NULL),
(1, 230, 3, 223, NULL),
(1, 229, 3, 223, NULL),
(1, 228, 3, 86, NULL),
(1, 227, 3, 86, NULL),
(1, 226, 3, 86, NULL),
(1, 225, 3, 86, NULL),
(1, 224, 3, 87, NULL),
(1, 223, 2, 1, NULL),
(1, 222, 2, 1, NULL),
(1, 221, 2, 1, NULL),
(1, 220, 2, 1, NULL),
(1, 219, 2, 1, NULL),
(1, 218, 2, 1, NULL),
(1, 217, 3, 209, NULL),
(1, 216, 3, 209, NULL),
(1, 215, 3, 209, NULL),
(1, 214, 3, 209, NULL),
(1, 213, 3, 209, NULL),
(1, 212, 3, 209, NULL),
(1, 211, 3, 209, NULL),
(1, 210, 3, 209, NULL),
(1, 209, 2, 1, NULL),
(1, 208, 3, 90, NULL),
(1, 207, 3, 88, NULL),
(1, 206, 3, 7, NULL),
(1, 205, 3, 7, NULL),
(1, 204, 3, 30, NULL),
(1, 203, 3, 30, NULL),
(1, 202, 3, 30, NULL),
(1, 193, 3, 6, NULL),
(1, 192, 3, 6, NULL),
(1, 191, 3, 6, NULL),
(1, 190, 3, 6, NULL),
(1, 189, 3, 6, NULL),
(1, 188, 3, 6, NULL),
(1, 187, 3, 6, NULL),
(1, 186, 3, 6, NULL),
(1, 185, 3, 7, NULL),
(1, 184, 3, 7, NULL),
(1, 183, 3, 7, NULL),
(1, 182, 3, 7, NULL),
(1, 181, 3, 7, NULL),
(1, 180, 3, 7, NULL),
(1, 179, 3, 7, NULL),
(1, 178, 3, 7, NULL),
(1, 169, 3, 85, NULL),
(1, 168, 3, 85, NULL),
(1, 167, 3, 85, NULL),
(1, 166, 3, 85, NULL),
(1, 165, 3, 85, NULL),
(1, 164, 3, 85, NULL),
(1, 163, 3, 85, NULL),
(1, 162, 3, 85, NULL),
(1, 161, 3, 86, NULL),
(1, 160, 3, 86, NULL),
(7, 162, 3, 85, NULL),
(7, 163, 3, 85, NULL),
(7, 164, 3, 85, NULL),
(7, 165, 3, 85, NULL),
(7, 166, 3, 85, NULL),
(7, 167, 3, 85, NULL),
(7, 168, 3, 85, NULL),
(7, 169, 3, 85, NULL),
(7, 202, 3, 30, NULL),
(7, 203, 3, 30, NULL),
(7, 204, 3, 30, NULL),
(1, 159, 3, 86, NULL),
(1, 158, 3, 86, NULL),
(1, 157, 3, 86, NULL),
(1, 156, 3, 86, NULL),
(1, 155, 3, 86, NULL),
(1, 154, 3, 86, NULL),
(1, 153, 3, 87, NULL),
(1, 152, 3, 87, NULL),
(1, 151, 3, 87, NULL),
(1, 150, 3, 87, NULL),
(1, 149, 3, 87, NULL),
(1, 148, 3, 87, NULL),
(1, 147, 3, 87, NULL),
(1, 146, 3, 87, NULL),
(1, 145, 3, 88, NULL),
(1, 144, 3, 88, NULL),
(1, 143, 3, 88, NULL),
(1, 142, 3, 88, NULL),
(1, 141, 3, 88, NULL),
(1, 140, 3, 88, NULL),
(1, 139, 3, 88, NULL),
(1, 138, 3, 88, NULL),
(1, 137, 3, 89, NULL),
(1, 136, 3, 89, NULL),
(1, 135, 3, 89, NULL),
(1, 134, 3, 89, NULL),
(1, 133, 3, 89, NULL),
(1, 132, 3, 89, NULL),
(1, 131, 3, 89, NULL),
(1, 130, 3, 89, NULL),
(1, 129, 3, 90, NULL),
(1, 128, 3, 90, NULL),
(1, 127, 3, 90, NULL),
(1, 126, 3, 90, NULL),
(1, 125, 3, 90, NULL),
(1, 124, 3, 90, NULL),
(1, 123, 3, 90, NULL),
(1, 122, 3, 96, NULL),
(1, 121, 3, 96, NULL),
(1, 120, 3, 96, NULL),
(1, 119, 3, 96, NULL),
(1, 118, 3, 96, NULL),
(1, 117, 3, 96, NULL),
(1, 116, 3, 96, NULL),
(1, 115, 3, 96, NULL),
(1, 114, 3, 97, NULL),
(1, 113, 3, 97, NULL),
(1, 112, 3, 97, NULL),
(1, 111, 3, 97, NULL),
(1, 110, 3, 97, NULL),
(1, 109, 3, 97, NULL),
(1, 108, 3, 97, NULL),
(1, 107, 3, 97, NULL),
(1, 106, 3, 98, NULL),
(1, 98, 2, 1, NULL),
(1, 97, 2, 1, NULL),
(1, 96, 2, 1, NULL),
(1, 95, 3, 90, NULL),
(1, 94, 3, 91, NULL),
(1, 93, 3, 6, NULL),
(1, 92, 3, 6, NULL),
(1, 91, 2, 1, NULL),
(1, 90, 2, 1, NULL),
(1, 89, 2, 1, NULL),
(1, 88, 2, 1, NULL),
(1, 87, 2, 1, NULL),
(1, 86, 2, 1, NULL),
(1, 85, 2, 1, NULL),
(1, 50, 3, 40, NULL),
(1, 1, 1, 0, NULL),
(1, 6, 2, 1, NULL),
(1, 7, 2, 1, NULL),
(1, 30, 2, 1, NULL),
(1, 100, 3, 98, NULL),
(1, 101, 3, 98, NULL),
(1, 102, 3, 98, NULL),
(1, 103, 3, 98, NULL),
(1, 104, 3, 98, NULL),
(1, 99, 3, 98, NULL),
(1, 40, 2, 1, NULL),
(9, 204, 3, 30, NULL),
(9, 203, 3, 30, NULL),
(9, 202, 3, 30, NULL),
(9, 169, 3, 85, NULL),
(9, 168, 3, 85, NULL),
(9, 167, 3, 85, NULL),
(9, 166, 3, 85, NULL),
(9, 165, 3, 85, NULL),
(9, 164, 3, 85, NULL),
(9, 163, 3, 85, NULL),
(9, 162, 3, 85, NULL),
(9, 85, 2, 1, NULL),
(9, 50, 3, 40, NULL),
(9, 40, 2, 1, NULL),
(9, 30, 2, 1, NULL),
(1, 105, 3, 98, NULL),
(2, 277, 3, 6, NULL),
(2, 204, 3, 30, NULL),
(2, 203, 3, 30, NULL),
(2, 202, 3, 30, NULL),
(2, 201, 3, 2, NULL),
(2, 200, 3, 2, NULL),
(2, 199, 3, 2, NULL),
(2, 198, 3, 2, NULL),
(2, 197, 3, 2, NULL),
(2, 196, 3, 2, NULL),
(2, 195, 3, 2, NULL),
(2, 194, 3, 2, NULL),
(2, 193, 3, 6, NULL),
(2, 192, 3, 6, NULL),
(2, 191, 3, 6, NULL),
(2, 190, 3, 6, NULL),
(2, 189, 3, 6, NULL),
(2, 188, 3, 6, NULL),
(2, 187, 3, 6, NULL),
(2, 186, 3, 6, NULL),
(2, 177, 3, 84, NULL),
(2, 176, 3, 84, NULL),
(2, 175, 3, 84, NULL),
(2, 174, 3, 84, NULL),
(2, 173, 3, 84, NULL),
(2, 172, 3, 84, NULL),
(2, 171, 3, 84, NULL),
(2, 170, 3, 84, NULL),
(2, 93, 3, 6, NULL),
(13, 277, 3, 6, NULL),
(13, 206, 3, 7, NULL),
(13, 205, 3, 7, NULL),
(13, 204, 3, 30, NULL),
(13, 203, 3, 30, NULL),
(13, 202, 3, 30, NULL),
(13, 201, 3, 2, NULL),
(13, 200, 3, 2, NULL),
(13, 199, 3, 2, NULL),
(13, 196, 3, 2, NULL),
(13, 195, 3, 2, NULL),
(13, 194, 3, 2, NULL),
(13, 193, 3, 6, NULL),
(13, 192, 3, 6, NULL),
(13, 191, 3, 6, NULL),
(13, 190, 3, 6, NULL),
(13, 189, 3, 6, NULL),
(13, 188, 3, 6, NULL),
(13, 187, 3, 6, NULL),
(13, 186, 3, 6, NULL),
(13, 185, 3, 7, NULL),
(13, 184, 3, 7, NULL),
(13, 183, 3, 7, NULL),
(13, 182, 3, 7, NULL),
(13, 181, 3, 7, NULL),
(13, 180, 3, 7, NULL),
(13, 179, 3, 7, NULL),
(13, 178, 3, 7, NULL),
(13, 177, 3, 84, NULL),
(13, 176, 3, 84, NULL),
(13, 175, 3, 84, NULL),
(13, 172, 3, 84, NULL),
(13, 171, 3, 84, NULL),
(13, 170, 3, 84, NULL),
(13, 93, 3, 6, NULL),
(13, 92, 3, 6, NULL),
(13, 284, 3, 283, NULL),
(13, 283, 2, 1, NULL),
(13, 84, 2, 1, NULL),
(13, 50, 3, 40, NULL),
(13, 1, 1, 0, NULL),
(13, 2, 2, 1, NULL),
(13, 6, 2, 1, NULL),
(13, 7, 2, 1, NULL),
(13, 30, 2, 1, NULL),
(13, 40, 2, 1, NULL),
(2, 92, 3, 6, NULL),
(2, 284, 3, 283, NULL),
(2, 283, 2, 1, NULL),
(2, 84, 2, 1, NULL),
(2, 50, 3, 40, NULL),
(2, 1, 1, 0, NULL),
(2, 2, 2, 1, NULL),
(2, 6, 2, 1, NULL),
(2, 7, 2, 1, NULL),
(2, 30, 2, 1, NULL),
(2, 40, 2, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_admin`
--

DROP TABLE IF EXISTS `xiami_admin`;
CREATE TABLE IF NOT EXISTS `xiami_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `account` varchar(64) NOT NULL COMMENT '用户名',
  `nickname` varchar(50) NOT NULL COMMENT '姓名',
  `password` char(32) NOT NULL COMMENT '密码',
  `bind_account` varchar(50) NOT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(40) DEFAULT NULL COMMENT '最后登录IP',
  `login_count` mediumint(8) unsigned DEFAULT '0' COMMENT '登录次数',
  `verify` varchar(32) DEFAULT NULL,
  `email` varchar(50) NOT NULL COMMENT 'email',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `type_id` tinyint(2) unsigned DEFAULT '0',
  `info` text NOT NULL,
  `customerid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台管理员' AUTO_INCREMENT=50 ;

--
-- 导出表中的数据 `xiami_admin`
--

INSERT INTO `xiami_admin` (`id`, `account`, `nickname`, `password`, `bind_account`, `last_login_time`, `last_login_ip`, `login_count`, `verify`, `email`, `remark`, `create_time`, `update_time`, `status`, `type_id`, `info`, `customerid`) VALUES
(2, 'zuixiami', 'zuixiami', 'e10adc3949ba59abbe56e057f20f883e', '', 1367906369, '127.0.0.1', 1182, '8888', 'wewe@wewe.com', '备注信息', 1222907803, 1363330270, 1, 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_config`
--

DROP TABLE IF EXISTS `xiami_config`;
CREATE TABLE IF NOT EXISTS `xiami_config` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `textname` varchar(100) NOT NULL COMMENT '名称',
  `code` varchar(100) NOT NULL COMMENT '代码',
  `type` varchar(10) NOT NULL COMMENT '类型',
  `store_range` varchar(255) NOT NULL COMMENT '存储值',
  `store_dir` varchar(255) NOT NULL COMMENT '存储目录',
  `value` text NOT NULL COMMENT '值',
  `range_desc` varchar(255) NOT NULL COMMENT '存储值说明',
  `cfg_desc` varchar(255) NOT NULL COMMENT '描述',
  `sid` tinyint(5) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `parent_id` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台系统配置表' AUTO_INCREMENT=211 ;

--
-- 导出表中的数据 `xiami_config`
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
(107, 5, '邮件发送方式', 'cfg_mail_mailsend', 'select', 'mail,smtp,sendmail', '', 'smtp', '通过 PHP 函数的 sendmail 发送(推荐此方式)<br>,通过 SOCKET 连接 SMTP 服务器发送(支持 ESMTP 验证)<br>,通过 PHP 函数 SMTP 发送 Email(仅 Windows 主机下有效 不支持 ESMTP 验证)<br>', '', 2),
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
(184, 1, '统计代码', 'cfg_tongji', 'textarea', '', '', '<script type="text/javascript">\r\nvar _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");\r\ndocument.write(unescape("%3Cscript src=''" + _bdhmProtocol + "hm.baidu.com/h.js%3Fd82d94085def6e342e036d021e453a4f'' type=''text/javascript''%3E%3C/script%3E"));\r\n</script>', '', '统计代码', 30),
(185, 2, '首页作品显示数', 'cfg_index_works_num', 'text', '', '', '50', '', '', 31),
(186, 2, '首页作品排序', 'cfg_index_works_order', 'text', '', '', 'w.is_top DESC,w.top_sid DESC,w.id DESC', '', '<br>排序sql<br>\r\nw.is_top 是否推荐 1,0<br>\r\nw.top_sid 推荐排序<br>\r\nw.id  ID排序<br>\r\n默认w.is_top DESC,w.top_sid DESC,w.id DESC<br>\r\n推荐 倒序，推荐排序倒序，ID 倒序', 32),
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

DROP TABLE IF EXISTS `xiami_group`;
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
-- 导出表中的数据 `xiami_group`
--

INSERT INTO `xiami_group` (`id`, `name`, `title`, `create_time`, `update_time`, `status`, `sort`, `show`) VALUES
(2, 'System', '系统管理', 1222841259, 0, 1, 5, 1),
(14, 'Website', '功能', 1361863955, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_message`
--

DROP TABLE IF EXISTS `xiami_message`;
CREATE TABLE IF NOT EXISTS `xiami_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mtype` varchar(100) DEFAULT NULL,
  `lang` varchar(50) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `reply` text,
  `name` varchar(50) DEFAULT NULL,
  `dianhua` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `qq` varchar(50) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `addtime` int(11) NOT NULL DEFAULT '0',
  `checkuser` varchar(50) DEFAULT NULL,
  `checktime` int(10) NOT NULL DEFAULT '0',
  `is_check` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `xiami_message`
--


-- --------------------------------------------------------

--
-- 表的结构 `xiami_node`
--

DROP TABLE IF EXISTS `xiami_node`;
CREATE TABLE IF NOT EXISTS `xiami_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(20) NOT NULL COMMENT '标识',
  `title` varchar(50) DEFAULT NULL COMMENT '菜单名',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` smallint(6) unsigned DEFAULT NULL COMMENT '排序',
  `pid` smallint(6) unsigned NOT NULL COMMENT '上级ID',
  `level` tinyint(1) unsigned NOT NULL COMMENT '级别',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned DEFAULT '0' COMMENT '后台分组ID对应group表',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='节点管理' AUTO_INCREMENT=300 ;

--
-- 导出表中的数据 `xiami_node`
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
(290, 'Works', '作品列表', 1, '', 30, 1, 2, 0, 14),
(291, 'Works_sort', '作品分类', 1, '', 31, 1, 2, 0, 14),
(292, 'Qun_member', '成员管理', 1, '', 41, 1, 2, 0, 14),
(293, 'Qun_sort', '成员分类', 1, '', 40, 1, 2, 0, 14),
(294, 'Message', '留言建议', 1, '', 50, 1, 2, 0, 14),
(295, 'Pages', '单页管理', 1, '', 48, 1, 2, 0, 14),
(296, 'Website_log', '网站更新日志', 1, '', 49, 1, 2, 0, 14),
(297, 'Syscache', '更新缓存', 1, '', 0, 1, 2, 0, 2),
(298, 'Uploads', '附件管理', 1, '', 51, 1, 2, 0, 14),
(299, 'Works_special', '作品专题', 1, '', 32, 1, 2, 0, 14);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_pages`
--

DROP TABLE IF EXISTS `xiami_pages`;
CREATE TABLE IF NOT EXISTS `xiami_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(128) DEFAULT NULL COMMENT '标题',
  `code` varchar(128) DEFAULT NULL COMMENT '代码',
  `contents` text COMMENT '内容',
  `adduser` varchar(100) DEFAULT NULL COMMENT '添加人',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `slug` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='单页管理' AUTO_INCREMENT=15 ;

--
-- 导出表中的数据 `xiami_pages`
--

INSERT INTO `xiami_pages` (`id`, `title`, `code`, `contents`, `adduser`, `addtime`) VALUES
(14, '联系我们', 'about', '<p>最虾米*作品秀&nbsp;</p><p>V1.1</p><p>update 2013/3/15</p><p><br /></p><p>最虾米来源闽南话中的意思：做什么。</p><p>一路的成长我们曾多少次的迷茫，都在想做什么</p><p>别想了，开始做吧。</p><p>最虾米目前以收集鬼群的<strong>前端开发</strong>作品为主，建立和推广作品</p><p>让前端开发从技术实现到产品，到商品价值的过程。</p><p><br /></p><p>我们还在不断改进，我们还有很长很长的路要走，</p><p>不管我们是否中途就“挂了”，但是我们开始做了，</p><p>请给我们一些时间，也希望多多支持</p><p>有什么建议，意见，纠错欢迎提出</p><p><br /></p><p>鬼懿成长QQ群：181368696</p><p>鬼懿IT：19046753（第8年）</p><p>新浪官方微博：@最虾米网站</p><p><br /></p><p><strong>特别感谢最虾米团队</strong></p><p>焰之翼（wewe）</p><p>Travis<br /></p><p>Sam</p><p>TGL</p><p>光敏</p><p><strong>感谢参谋</strong></p><p>胡尐睿</p><p>漫步</p><p>加入最虾米团队，加qq群：256732638</p><p><br /></p>', 'zuixiami', 1360851430);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_qun_member`
--

DROP TABLE IF EXISTS `xiami_qun_member`;
CREATE TABLE IF NOT EXISTS `xiami_qun_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `qun_sort_id` int(11) NOT NULL DEFAULT '0' COMMENT '群分类ID对应works_sort',
  `qq` varchar(100) DEFAULT NULL COMMENT 'qq号码',
  `name` varchar(100) DEFAULT NULL COMMENT 'qq名',
  `await` bigint(20) NOT NULL COMMENT '期待作者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='群成员表' AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `xiami_qun_member`
--

INSERT INTO `xiami_qun_member` (`id`, `qun_sort_id`, `qq`, `name`, `await`) VALUES
(1, 2, '304327508', '胡少睿', 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_qun_sort`
--

DROP TABLE IF EXISTS `xiami_qun_sort`;
CREATE TABLE IF NOT EXISTS `xiami_qun_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '群分类ID',
  `name` varchar(100) DEFAULT NULL COMMENT '群分类名',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='群分类' AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `xiami_qun_sort`
--

INSERT INTO `xiami_qun_sort` (`id`, `name`, `sid`) VALUES
(1, '成长群', 1),
(2, '高级群', 2);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_role`
--

DROP TABLE IF EXISTS `xiami_role`;
CREATE TABLE IF NOT EXISTS `xiami_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(20) NOT NULL COMMENT '组名',
  `pid` smallint(6) DEFAULT NULL COMMENT '上级ID',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `ename` varchar(5) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `ename` (`ename`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='角色分组' AUTO_INCREMENT=15 ;

--
-- 导出表中的数据 `xiami_role`
--

INSERT INTO `xiami_role` (`id`, `name`, `pid`, `status`, `remark`, `ename`, `create_time`, `update_time`) VALUES
(1, '管理组', 0, 1, '', '', 1208784792, 1305166068),
(2, '编辑组', 0, 1, '', '', 1215496283, 1305166076),
(9, '信息组', 0, 1, '', NULL, 1307071286, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_role_user`
--

DROP TABLE IF EXISTS `xiami_role_user`;
CREATE TABLE IF NOT EXISTS `xiami_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL COMMENT '角色授权ID对应role表',
  `user_id` char(32) DEFAULT NULL COMMENT '用户ID',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色授权表';

--
-- 导出表中的数据 `xiami_role_user`
--

INSERT INTO `xiami_role_user` (`role_id`, `user_id`) VALUES
(1, '2');

-- --------------------------------------------------------

--
-- 表的结构 `xiami_syslogs`
--

DROP TABLE IF EXISTS `xiami_syslogs`;
CREATE TABLE IF NOT EXISTS `xiami_syslogs` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(30) DEFAULT NULL COMMENT '分组',
  `actionname` varchar(30) DEFAULT NULL COMMENT '模块',
  `opname` varchar(30) DEFAULT NULL COMMENT '操作',
  `message` varchar(30) DEFAULT NULL COMMENT '备注',
  `userid` smallint(5) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `username` varchar(64) DEFAULT NULL COMMENT '用户名',
  `userip` varchar(40) DEFAULT NULL COMMENT '用户IP',
  `create_time` int(11) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员操作日志表' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `xiami_syslogs`
--


-- --------------------------------------------------------

--
-- 表的结构 `xiami_t_members`
--

DROP TABLE IF EXISTS `xiami_t_members`;
CREATE TABLE IF NOT EXISTS `xiami_t_members` (
  `id` varchar(100) NOT NULL COMMENT '自增ID',
  `qqnumber` varchar(100) NOT NULL COMMENT 'QQ号码',
  `qqname` varchar(100) NOT NULL COMMENT '昵称',
  KEY `qqnumber` (`qqnumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='原始QQ群记录需要处理到qun_member内';

--
-- 导出表中的数据 `xiami_t_members`
--


-- --------------------------------------------------------

--
-- 表的结构 `xiami_uploads`
--

DROP TABLE IF EXISTS `xiami_uploads`;
CREATE TABLE IF NOT EXISTS `xiami_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(40) DEFAULT NULL COMMENT '模块',
  `mid` int(11) NOT NULL DEFAULT '0' COMMENT '模块ID',
  `title` varchar(255) DEFAULT NULL COMMENT '标题/图片描述',
  `url` varchar(255) DEFAULT NULL COMMENT '地址',
  `mediatype` varchar(100) DEFAULT NULL COMMENT '媒体类型',
  `filesize` varchar(30) NOT NULL COMMENT '文件大小',
  `extension` varchar(20) NOT NULL COMMENT '后缀名',
  `thumburl_0` varchar(255) NOT NULL COMMENT '缩略图1',
  `thumburl_1` varchar(255) NOT NULL COMMENT '缩略图2',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `hit` int(11) NOT NULL DEFAULT '0' COMMENT '点击率',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='附件管理' AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `xiami_uploads`
--

INSERT INTO `xiami_uploads` (`id`, `module`, `mid`, `title`, `url`, `mediatype`, `filesize`, `extension`, `thumburl_0`, `thumburl_1`, `addtime`, `hit`) VALUES
(1, 'Works', 128, '安卓界面 （特价）.JPG', 'Uploads/20130315/5142c7e52b334.JPG', 'image/jpeg', '642810', 'JPG', 'Uploads/thumb/20130315/m_5142c7e52b334.JPG', 'Uploads/thumb/20130315/s_5142c7e52b334.JPG', 1363331045, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_user_action`
--

DROP TABLE IF EXISTS `xiami_user_action`;
CREATE TABLE IF NOT EXISTS `xiami_user_action` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL COMMENT '模块',
  `mtype` varchar(100) NOT NULL COMMENT '类型',
  `mid` int(11) NOT NULL COMMENT '模块ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `ip` varchar(100) NOT NULL COMMENT '当前IP',
  `addtime` int(10) NOT NULL COMMENT '当前时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户操作暂用于赞/期待' AUTO_INCREMENT=112 ;

--
-- 导出表中的数据 `xiami_user_action`
--

INSERT INTO `xiami_user_action` (`id`, `module`, `mtype`, `mid`, `user_id`, `ip`, `addtime`) VALUES
(1, 'Qun_member', 'await', 107, 0, '124.160.29.190', 1363330284),
(2, 'Works', 'good', 123, 72, '175.43.62.74', 1363330920),
(3, 'Works', 'good', 100, 72, '175.43.62.74', 1363330927),
(4, 'Qun_member', 'await', 62, 72, '175.43.62.74', 1363330951),
(5, 'Works', 'good', 88, 72, '175.43.62.74', 1363330955),
(6, 'Works', 'good', 51, 0, '124.160.29.190', 1363331628),
(7, 'Works', 'good', 61, 0, '124.160.29.190', 1363331655),
(8, 'Works', 'good', 75, 0, '210.13.211.218', 1363331972),
(9, 'Works', 'good', 91, 0, '113.107.7.26', 1363331996),
(10, 'Works', 'good', 87, 0, '119.139.175.81', 1363332019),
(11, 'Works', 'good', 69, 0, '114.222.169.162', 1363332495),
(12, 'Works', 'good', 117, 0, '183.246.21.199', 1363332500),
(13, 'Works', 'good', 117, 0, '59.174.70.142', 1363332708),
(14, 'Works', 'good', 88, 0, '113.247.57.109', 1363334582),
(15, 'Works', 'good', 80, 0, '180.111.111.87', 1363335248),
(16, 'Works', 'good', 126, 107, '124.160.29.190', 1363340768),
(17, 'Works', 'good', 88, 0, '106.2.228.254', 1363342769),
(18, 'Works', 'good', 100, 0, '106.2.228.254', 1363342777),
(19, 'Works', 'good', 82, 0, '106.2.228.254', 1363342786),
(20, 'Works', 'good', 125, 0, '124.193.184.2', 1363344368),
(21, 'Works', 'good', 84, 0, '118.120.220.125', 1363347986),
(22, 'Works', 'good', 123, 0, '114.245.231.105', 1363355033),
(23, 'Works', 'good', 126, 0, '116.28.20.236', 1363357125),
(24, 'Works', 'good', 123, 0, '113.107.205.39', 1363609681),
(25, 'Works', 'good', 117, 0, '124.202.191.223', 1363611709),
(26, 'Works', 'good', 126, 0, '183.235.249.203', 1363615851),
(27, 'Qun_member', 'await', 203, 0, '218.1.19.26', 1363668453),
(28, 'Works', 'good', 125, 0, '192.168.7.208', 1363671256),
(29, 'Qun_member', 'await', 203, 0, '218.85.143.110', 1363671903),
(30, 'Qun_member', 'await', 203, 0, '59.174.70.142', 1363672246),
(31, 'Works', 'good', 93, 0, '121.14.96.125', 1363674223),
(32, 'Works', 'good', 93, 0, '112.95.138.22', 1363674225),
(33, 'Works', 'good', 91, 0, '27.154.58.130', 1363845870),
(34, 'Works', 'good', 97, 0, '27.154.58.130', 1363845881),
(35, 'Works', 'good', 126, 0, '60.176.47.66', 1364114914),
(36, 'Qun_member', 'await', 62, 0, '175.0.172.168', 1364271234),
(37, 'Qun_member', 'await', 62, 68, '120.42.91.121', 1364277292),
(38, 'Works', 'good', 130, 0, '113.88.155.42', 1364281289),
(39, 'Works', 'good', 126, 0, '61.131.11.23', 1364305639),
(40, 'Works', 'good', 126, 0, '183.235.249.72', 1364311313),
(41, 'Qun_member', 'await', 62, 0, '124.160.29.190', 1364351256),
(42, 'Works', 'good', 134, 0, '218.66.59.169', 1364355504),
(43, 'Works', 'good', 134, 0, '121.35.223.94', 1364357234),
(44, 'Works', 'good', 134, 0, '58.55.124.226', 1364360536),
(45, 'Works', 'good', 87, 0, '124.160.92.82', 1364371994),
(46, 'Works', 'good', 88, 0, '124.160.92.82', 1364372010),
(47, 'Works', 'good', 100, 0, '124.160.92.82', 1364372016),
(48, 'Works', 'good', 123, 0, '61.135.172.68', 1364376368),
(49, 'Works', 'good', 118, 0, '222.130.135.227', 1364377456),
(50, 'Works', 'good', 118, 0, '123.123.251.183', 1364377475),
(51, 'Works', 'good', 117, 0, '123.123.251.183', 1364377512),
(52, 'Works', 'good', 126, 0, '183.235.249.103', 1364395059),
(53, 'Works', 'good', 136, 286, '1.202.241.190', 1364459137),
(54, 'Works', 'good', 135, 286, '1.202.241.190', 1364459146),
(55, 'Works', 'good', 117, 0, '114.221.64.53', 1364530416),
(56, 'Qun_member', 'await', 413, 0, '222.46.22.168', 1364619699),
(57, 'Works', 'good', 137, 0, '10.74.142.242', 1364892581),
(58, 'Works', 'good', 135, 0, '10.74.142.242', 1364892656),
(59, 'Works', 'good', 135, 0, '124.228.195.64', 1364920568),
(60, 'Works', 'good', 135, 0, '124.228.195.67', 1364920683),
(61, 'Works', 'good', 134, 0, '58.55.124.228', 1364920687),
(62, 'Works', 'good', 134, 0, '124.228.195.64', 1364920690),
(63, 'Works', 'good', 137, 0, '124.228.195.64', 1364920710),
(64, 'Works', 'good', 135, 0, '124.228.195.66', 1364957985),
(65, 'Works', 'good', 134, 0, '58.55.124.227', 1364958000),
(66, 'Works', 'good', 117, 0, '211.151.238.51', 1364979917),
(67, 'Qun_member', 'await', 443, 0, '14.18.25.148', 1365080085),
(68, 'Works', 'good', 88, 0, '58.219.2.137', 1365383091),
(69, 'Works', 'good', 85, 0, '119.145.0.157', 1365398818),
(70, 'Works', 'good', 88, 62, '218.213.228.173', 1365472657),
(71, 'Works', 'good', 100, 62, '218.213.228.173', 1365472663),
(72, 'Works', 'good', 130, 62, '218.213.228.173', 1365472670),
(73, 'Qun_member', 'await', 62, 0, '211.103.188.86', 1365479879),
(74, 'Qun_member', 'await', 62, 0, '218.213.228.173', 1365480681),
(75, 'Works', 'good', 141, 0, '218.247.180.194', 1365481482),
(76, 'Works', 'good', 137, 0, '218.247.180.194', 1365481487),
(77, 'Works', 'good', 117, 0, '218.247.180.194', 1365481629),
(78, 'Works', 'good', 113, 0, '123.124.206.69', 1365483856),
(79, 'Works', 'good', 117, 0, '111.175.73.122', 1365730374),
(80, 'Works', 'good', 104, 0, '183.166.187.131', 1365742410),
(81, 'Works', 'good', 145, 28, '123.124.206.69', 1365750352),
(82, 'Works', 'good', 145, 0, '183.246.21.245', 1365754911),
(83, 'Works', 'good', 117, 0, '124.73.85.25', 1365784689),
(84, 'Works', 'good', 145, 0, '121.34.147.115', 1365925191),
(85, 'Works', 'good', 146, 0, '121.34.147.115', 1365927302),
(86, 'Works', 'good', 145, 0, '221.0.93.7', 1365988115),
(87, 'Works', 'good', 145, 0, '112.65.138.202', 1365988123),
(88, 'Works', 'good', 145, 0, '121.14.96.125', 1365990154),
(89, 'Works', 'good', 145, 0, '140.206.97.115', 1365991196),
(90, 'Works', 'good', 117, 0, '113.116.205.192', 1365991666),
(91, 'Works', 'good', 147, 28, '123.124.206.69', 1365991922),
(92, 'Works', 'good', 113, 0, '180.184.16.56', 1365992434),
(93, 'Works', 'good', 118, 0, '222.130.138.42', 1365992758),
(94, 'Works', 'good', 117, 0, '222.130.138.42', 1365992766),
(95, 'Works', 'good', 143, 0, '58.246.246.187', 1366026811),
(96, 'Works', 'good', 145, 0, '124.202.191.212', 1366031961),
(97, 'Works', 'good', 147, 28, '124.202.191.212', 1366032029),
(98, 'Works', 'good', 136, 28, '124.202.191.212', 1366032367),
(99, 'Works', 'good', 117, 0, '221.234.215.76', 1366122909),
(100, 'Works', 'good', 147, 0, '183.246.21.76', 1366256182),
(101, 'Works', 'good', 144, 0, '123.125.220.50', 1366341421),
(102, 'Works', 'good', 147, 0, '124.160.29.190', 1366365223),
(103, 'Works', 'good', 126, 0, '121.229.12.16', 1366381332),
(104, 'Works', 'good', 123, 0, '222.69.250.234', 1366555564),
(105, 'Qun_member', 'await', 203, 0, '59.174.69.32', 1367462836),
(106, 'Works', 'good', 123, 0, '101.69.163.144', 1367465898),
(107, 'Works', 'good', 120, 0, '127.0.0.1', 1367896582),
(108, 'Works', 'good', 134, 0, '127.0.0.1', 1367896588),
(109, 'Works', 'good', 114, 0, '127.0.0.1', 1367896603),
(110, 'Works', 'good', 93, 0, '127.0.0.1', 1367896609),
(111, 'Works', 'good', 98, 0, '127.0.0.1', 1367896617);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_website_log`
--

DROP TABLE IF EXISTS `xiami_website_log`;
CREATE TABLE IF NOT EXISTS `xiami_website_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL COMMENT '标题',
  `contents` text COMMENT '内容',
  `adduser` varchar(100) DEFAULT NULL COMMENT '添加人',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='网站更新日志' AUTO_INCREMENT=16 ;

--
-- 导出表中的数据 `xiami_website_log`
--

INSERT INTO `xiami_website_log` (`id`, `title`, `contents`, `adduser`, `addtime`) VALUES
(13, '标题', '内容', '0', 1359863495),
(14, '321323123219999', '<p>132321999</p>', '0', 1359863772);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_works`
--

DROP TABLE IF EXISTS `xiami_works`;
CREATE TABLE IF NOT EXISTS `xiami_works` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `sortid` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID对应works_sort表',
  `qun_sortid` int(11) NOT NULL DEFAULT '0' COMMENT '群分类对应qun_sort表',
  `name` varchar(100) DEFAULT NULL COMMENT '作品名称',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `url` varchar(200) DEFAULT NULL COMMENT '链接地址',
  `img` varchar(200) DEFAULT NULL COMMENT '图片缩略图',
  `qq` varchar(20) DEFAULT NULL COMMENT 'qq',
  `description` text COMMENT '描述',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '申请时间',
  `checkuser` varchar(100) DEFAULT NULL COMMENT '审核人',
  `checktime` int(10) NOT NULL DEFAULT '0' COMMENT '审核时间',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `top_sid` int(11) DEFAULT '0' COMMENT '推荐排序',
  `good` bigint(20) NOT NULL COMMENT '赞',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品列表' AUTO_INCREMENT=156 ;

--
-- 导出表中的数据 `xiami_works`
--

INSERT INTO `xiami_works` (`id`, `sortid`, `qun_sortid`, `name`, `author`, `url`, `img`, `qq`, `description`, `addtime`, `checkuser`, `checktime`, `is_top`, `top_sid`, `good`, `status`) VALUES
(51, 15, 1, 'HoorayOS', '胡少睿', 'http://hoorayos.com', 'http://zp.zuixiami.com/Uploads/20130313/e195f7008fe07fc8d1fcaf9bbfcfdf8d.png', '304327508', '这是一款 Web 桌面应用框架，你可以用它二次开发出类似 Q+Web 这类的桌面应用网站，也可以开发出适合各种项目的桌面管理系统。', 1360163571, 'zuixiami', 1360163571, 0, 0, 1, 2),
(155, 15, 2, 'HoorayOS', '胡少睿', 'http://hoorayos.com', 'http://zp.zuixiami.com/Uploads/20130313/e195f7008fe07fc8d1fcaf9bbfcfdf8d.png', '304327508', '这是一款 Web 桌面应用框架，你可以用它二次开发出类似 Q+Web 这类的桌面应用网站，也可以开发出适合各种项目的桌面管理系统。', 1360163571, 'zuixiami', 1360163571, 0, 0, 1, 2),
(154, 15, 2, 'HoorayOS', '胡少睿', 'http://hoorayos.com', 'http://zp.zuixiami.com/Uploads/20130313/e195f7008fe07fc8d1fcaf9bbfcfdf8d.png', '304327508', '这是一款 Web 桌面应用框架，你可以用它二次开发出类似 Q+Web 这类的桌面应用网站，也可以开发出适合各种项目的桌面管理系统。', 1360163571, 'zuixiami', 1360163571, 0, 0, 1, 3),
(153, 15, 2, 'HoorayOS', '胡少睿', 'http://hoorayos.com', 'http://zp.zuixiami.com/Uploads/20130313/e195f7008fe07fc8d1fcaf9bbfcfdf8d.png', '304327508', '这是一款 Web 桌面应用框架，你可以用它二次开发出类似 Q+Web 这类的桌面应用网站，也可以开发出适合各种项目的桌面管理系统。', 1360163571, 'zuixiami', 1360163571, 0, 0, 1, 2),
(152, 15, 2, 'HoorayOS', '胡少睿', 'http://hoorayos.com', 'http://zp.zuixiami.com/Uploads/20130313/e195f7008fe07fc8d1fcaf9bbfcfdf8d.png', '304327508', '这是一款 Web 桌面应用框架，你可以用它二次开发出类似 Q+Web 这类的桌面应用网站，也可以开发出适合各种项目的桌面管理系统。', 1360163571, 'zuixiami', 1367906423, 0, 0, 1, 2),
(151, 15, 2, 'HoorayOS', '胡少睿', 'http://hoorayos.com', 'http://zp.zuixiami.com/Uploads/20130313/e195f7008fe07fc8d1fcaf9bbfcfdf8d.png', '304327508', '这是一款 Web 桌面应用框架，你可以用它二次开发出类似 Q+Web 这类的桌面应用网站，也可以开发出适合各种项目的桌面管理系统。', 1360163571, 'zuixiami', 1360163571, 0, 0, 1, 2),
(149, 15, 2, 'HoorayOS', '胡少睿', 'http://hoorayos.com', 'http://zp.zuixiami.com/Uploads/20130313/e195f7008fe07fc8d1fcaf9bbfcfdf8d.png', '304327508', '这是一款 Web 桌面应用框架，你可以用它二次开发出类似 Q+Web 这类的桌面应用网站，也可以开发出适合各种项目的桌面管理系统。', 1360163571, 'zuixiami', 1360163571, 0, 0, 1, 2),
(150, 15, 2, 'HoorayOS', '胡少睿', 'http://hoorayos.com', 'http://zp.zuixiami.com/Uploads/20130313/e195f7008fe07fc8d1fcaf9bbfcfdf8d.png', '304327508', '这是一款 Web 桌面应用框架，你可以用它二次开发出类似 Q+Web 这类的桌面应用网站，也可以开发出适合各种项目的桌面管理系统。', 1360163571, 'zuixiami', 1360163571, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_works_log`
--

DROP TABLE IF EXISTS `xiami_works_log`;
CREATE TABLE IF NOT EXISTS `xiami_works_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `works_id` int(11) NOT NULL COMMENT '作品ID对应works表',
  `action` varchar(30) NOT NULL COMMENT '操作',
  `notice` varchar(255) NOT NULL COMMENT '备注',
  `adduser` varchar(100) NOT NULL COMMENT '操作用户',
  `addtime` int(10) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品日志表' AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `xiami_works_log`
--

INSERT INTO `xiami_works_log` (`id`, `works_id`, `action`, `notice`, `adduser`, `addtime`) VALUES
(1, 154, 'status', '通过审核 => 等待审核', '304327508', 1367906316),
(2, 152, 'status', '通过审核 => 等待审核', '304327508', 1367906322),
(3, 150, 'status', '通过审核 => 等待审核', '304327508', 1367906325),
(4, 154, 'status', '等待审核 => 审核不通过', '304327508', 1367906331);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_works_sort`
--

DROP TABLE IF EXISTS `xiami_works_sort`;
CREATE TABLE IF NOT EXISTS `xiami_works_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父类ID',
  `layer` int(11) NOT NULL DEFAULT '0' COMMENT '所在层',
  `orders` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `name` varchar(100) DEFAULT NULL COMMENT '标题',
  `othername` varchar(100) DEFAULT NULL COMMENT '别名',
  `code` varchar(100) DEFAULT NULL COMMENT 'url代码',
  `is_hide` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品分类' AUTO_INCREMENT=17 ;

--
-- 导出表中的数据 `xiami_works_sort`
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

DROP TABLE IF EXISTS `xiami_works_special`;
CREATE TABLE IF NOT EXISTS `xiami_works_special` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `qishu` varchar(100) NOT NULL COMMENT '第几期',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `notice` varchar(255) NOT NULL COMMENT '备注',
  `code` varchar(100) NOT NULL COMMENT '代码伪静态用',
  `adduser` varchar(100) NOT NULL COMMENT '添加人',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品专题' AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `xiami_works_special`
--

INSERT INTO `xiami_works_special` (`id`, `qishu`, `title`, `notice`, `code`, `adduser`, `addtime`) VALUES
(1, '第一期', 'WebOS 专题', '', '', '', 1363331552),
(2, '第二期', '那些前端的书籍你是否都看过', '', '', '', 1363331940),
(3, '第三期', '游戏？娱乐？太少了', '', '', '', 1365732471);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_works_special_mid`
--

DROP TABLE IF EXISTS `xiami_works_special_mid`;
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
-- 导出表中的数据 `xiami_works_special_mid`
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


-- 
-- 表的结构 `xiami_tag` .by Feenan add on 20130509
-- 

DROP TABLE IF EXISTS `xiami_tag`;
CREATE TABLE IF NOT EXISTS `xiami_tag` (
  `id` int(11) NOT NULL auto_increment COMMENT '自增ID',
  `tagname` varchar(200) NOT NULL COMMENT '标签名称',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标签表' AUTO_INCREMENT=1 ;


-- 
-- 表的结构 `xiami_tag_relationship` .by Feenan add on 20130509
-- 

DROP TABLE IF EXISTS `xiami_tag_relationship`;
CREATE TABLE IF NOT EXISTS `xiami_tag_relationship` (
  `id` int(11) NOT NULL auto_increment COMMENT '自增ID',
  `tagid` int(11) NOT NULL COMMENT '标签ID',
  `workid` int(11) NOT NULL COMMENT '作品ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标签作品关系表一对多' AUTO_INCREMENT=1 ;

