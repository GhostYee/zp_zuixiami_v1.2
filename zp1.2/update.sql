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
INSERT INTO  `zuixiami`.`xiami_node` (
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

--
-- 导出表中的数据 `xiami_team`
--

INSERT INTO `xiami_team` VALUES (8, '团队1', 1368927890);
INSERT INTO `xiami_team` VALUES (9, '团队2', 1368927897);
INSERT INTO `xiami_team` VALUES (10, '团队3', 1368927908);
INSERT INTO `xiami_team` VALUES (11, '团队4', 1368956179);

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
ALTER TABLE  `xiami_works` ADD  `openurl` VARCHAR( 255 ) NOT NULL COMMENT  '开源地址' AFTER  `demourl` ;;