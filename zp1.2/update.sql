--
--  用户操作表user_action 增加value 暂用于存放rank值 by wewe 20130509
--
ALTER TABLE  `xiami_user_action` ADD  `value` VARCHAR( 20 ) NOT NULL COMMENT  '值' AFTER  `user_id` ;
ALTER TABLE  `xiami_user_action` COMMENT =  '用户操作暂用于赞/期待/rank';

--
--  作品表works增加 星级总评分 评分总次数  by wewe 20130509
--
ALTER TABLE  `xiami_works` ADD  `rank_total` BIGINT NOT NULL DEFAULT  '0' COMMENT  '星级总评分' AFTER  `good` ,
ADD  `rank_count` BIGINT NOT NULL DEFAULT  '0' COMMENT  '星级评分总次数' AFTER  `rank_total` ;

ALTER TABLE  `xiami_works_special` ADD  `description` VARCHAR( 255 ) NOT NULL COMMENT  '描述' AFTER  `title` ;
ALTER TABLE  `xiami_works_special` ADD  `img` VARCHAR( 200 ) NOT NULL COMMENT  '缩略图';
ALTER TABLE  `xiami_works_special` ADD  `award` VARCHAR( 50 ) NOT NULL COMMENT  '奖励';
ALTER TABLE  `xiami_works_special` ADD  `is_top` TINYINT( 1 ) NOT NULL DEFAULT  '0' COMMENT  '是否推荐' AFTER  `code` ,
ADD  `top_sid` INT NOT NULL DEFAULT  '0' COMMENT  '推荐排序' AFTER  `is_top` ;

--
--  by Feenan 向作品标签 关系 表增加数据
--
INSERT INTO xiami_tag_relationship(`tagid`,`workid`) VALUES('1','150');
INSERT INTO xiami_tag_relationship(`tagid`,`workid`) VALUES('1','151');
INSERT INTO xiami_tag_relationship(`tagid`,`workid`) VALUES('1','152');

--
-- 向node表里插入团队管理项. by Feenan add on 20130519
--
INSERT INTO  `xiami_node` (
`name` ,
`title` ,
`status` ,
`remark` ,
`sort` ,
`pid` ,
`level` ,
`type` ,
`group_id`
)
VALUES ('Team',  '团队管理',  '1', '' ,  '34',  '1',  '2',  '0',  '14'
);
--
--  创建团队相关表，并插入测试数据.by Feenan add on 20130519
--
--
-- 表的结构 `xiami_team`
--

CREATE TABLE IF NOT EXISTS `xiami_team` (
  `id` int(10) NOT NULL auto_increment COMMENT '自增ID',
  `teamname` varchar(100) NOT NULL COMMENT '团队名称',
  `creatime` int(10) NOT NULL default '0' COMMENT '团队创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='团队表' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `xiami_team_qunmember`
--

CREATE TABLE IF NOT EXISTS `xiami_team_qunmember` (
  `id` int(10) NOT NULL auto_increment COMMENT '团队成员主键ID',
  `teamid` int(10) NOT NULL COMMENT '团队ID',
  `qunmemberid` int(10) NOT NULL COMMENT '团队成员ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='团队成员表' AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `xiami_team_qunmember`
--

INSERT INTO `xiami_team_qunmember` VALUES (1, 8, 1);

-- --------------------------------------------------------

--
-- 表的结构 `xiami_team_work`
--

CREATE TABLE IF NOT EXISTS `xiami_team_work` (
  `id` int(10) NOT NULL auto_increment COMMENT '团队作品主键ID',
  `workid` int(10) NOT NULL COMMENT '团队作品id',
  `teamid` int(10) NOT NULL COMMENT '团队id',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='团队作品表' AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `xiami_team_work`
--

INSERT INTO `xiami_team_work` VALUES (1, 150, 8);
INSERT INTO `xiami_team_work` VALUES (2, 151, 8);

--
--  增加单页管理 by wewe
--
INSERT INTO `xiami_pages` (`id`, `title`, `code`, `contents`, `adduser`, `addtime`) VALUES
(15, '了解鬼群', 'qun', '', NULL, 0),
(16, '加入最虾米', 'join', '', NULL, 0),
(17, '捐助我们', 'offer', '', NULL, 0),
(18, '联系我们', 'contact', '', NULL, 0);
UPDATE `xiami_pages` SET  `title` =  '关于我们' WHERE  `id` =14 LIMIT 1 ;

--
--  增加标签点击量,确认热门标签 by wewe
--
ALTER TABLE  `xiami_tag` ADD  `hits` BIGINT NOT NULL COMMENT  '点击量' AFTER  `tagname` ;

--
--  首页作品排序 by wewe
--
UPDATE  `xiami_config` SET  `value` =  'works.is_top DESC,works.top_sid DESC,works.id DESC' WHERE  `xiami_config`.`id` =186 LIMIT 1 ;
UPDATE  `xiami_config` SET  `value` =  'wewe' WHERE  `xiami_config`.`id` =113 LIMIT 1 ;

--
--  作品表增加地址字段,区分演示地址开源地址by wewe
--
ALTER TABLE  `xiami_works` CHANGE  `url`  `demourl` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT  '演示地址';
ALTER TABLE  `xiami_works` ADD  `openurl` VARCHAR( 255 ) NOT NULL COMMENT  '开源地址' AFTER  `demourl` ;

--
--  增加用户表xiami_user,期待作者转到该表  by wewe
--
CREATE TABLE  `xiami_user` (
`id` INT NOT NULL COMMENT  '自增ID',
`qun_sort_id` INT NOT NULL COMMENT  '群分类ID',
`type` VARCHAR( 100 ) NOT NULL COMMENT  '登录类型',
`openid` BIGINT NOT NULL COMMENT  '返回开放ID',
`nickname` VARCHAR( 100 ) NOT NULL COMMENT  '昵称',
`figureurl` VARCHAR( 255 ) NOT NULL COMMENT  '头像地址',
`qq` VARCHAR( 20 ) NOT NULL COMMENT  'QQ号码',
`userurl` VARCHAR( 200 ) NOT NULL COMMENT  '用户blog地址',
`notice` VARCHAR( 255 ) NOT NULL COMMENT  '用户介绍',
`is_open` TINYINT( 1 ) NOT NULL COMMENT  '是否开启自定义昵称',
`is_locked` TINYINT( 1 ) NOT NULL COMMENT  '是否停用用户',
`await` bigint( 20 ) NOT NULL COMMENT  '期待作者',
`hits` bigint( 20 ) NOT NULL COMMENT  '点击量',
`addtime` INT( 10 ) NOT NULL COMMENT  '添加时间',
PRIMARY KEY (  `id` )
) ENGINE = MYISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

--
--  用户表xiami_user测试数据  by wewe
--
INSERT INTO  `xiami_user` (
`id` ,
`qun_sort_id`,
`type` ,
`openid` ,
`nickname` ,
`figureurl` ,
`qq` ,
`is_open` ,
`is_locked` ,
`await` ,
`addtime`
)
VALUES (
'1','2',  'qq',  '',  'auth_nickname',  'auth_figureurl',  '304327508','',  '',  '',  ''
);

--
--  作品表增加用户ID userid  by wewe
--
ALTER TABLE  `xiami_works` ADD  `userid` INT NOT NULL COMMENT  '用户ID' AFTER  `id` ;
update `xiami_works` set userid=1;

--
--  新团队成员表  by wewe
--
CREATE TABLE IF NOT EXISTS `xiami_team_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '团队成员主键ID',
  `teamid` int(10) NOT NULL COMMENT '团队ID',
  `userid` int(11) NOT NULL COMMENT '用户ID关联user表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='团队成员表';

--
--  新团队成员表测试数据  by wewe
--
INSERT INTO  `xiami_team_user` (
`id` ,
`teamid` ,
`userid`
)
VALUES (
NULL ,  '8',  '1'
);

--
--  团队表增加团队地址，团队头像,团队介绍,创建人  by wewe
--
ALTER TABLE  `xiami_team` ADD  `teamimg` VARCHAR( 200 ) NOT NULL COMMENT  '团队头像' AFTER  `teamname` ;
ALTER TABLE  `xiami_team` ADD  `teamurl` VARCHAR( 200 ) NOT NULL COMMENT  '团队地址' AFTER  `teamimg` ;
ALTER TABLE  `xiami_team` ADD  `notice` VARCHAR( 255 ) NOT NULL COMMENT  '团队介绍' AFTER  `teamurl` ;
ALTER TABLE  `xiami_team` ADD  `creatuserid` INT NOT NULL COMMENT  '创建人' AFTER  `notice` ;

--
-- 导出表中的数据 `xiami_team`
--

INSERT INTO `xiami_team` (`id`, `teamname`, `teamimg`, `teamurl`, `notice`, `creatuserid`, `creatime`) VALUES
(8, '团队1', 'teamimg', 'http://www.baidu.com', 'notice', 1, 1368927890),
(9, '团队2', 'teamimg', 'http://www.baidu.com', 'notice', 1, 1368927897),
(10, '团队3', '', '', '', 0, 1368927908),
(11, '团队4', '', '', '', 0, 1368956179);

--
--  团队表测试数据 by wewe
--
UPDATE  `xiami_team` SET  `creatuserid` =  '1',`teamimg` =  'teamimg',`teamurl` =  'http://www.baidu.com',`notice` =  'notice' WHERE  `xiami_team`.`id` =8 LIMIT 1 ;
UPDATE  `xiami_team` SET    `creatuserid` =  '1',`teamimg` =  'teamimg',`teamurl` =  'http://www.baidu.com',`notice` =  'notice'  WHERE  `xiami_team`.`id` =9 LIMIT 1 ;
