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
--  增加单页管理
--
INSERT INTO `xiami_pages` (`id`, `title`, `code`, `contents`, `adduser`, `addtime`) VALUES
(15, '了解鬼群', 'qun', '', NULL, 0),
(16, '加入最虾米', 'join', '', NULL, 0),
(17, '捐助我们', 'offer', '', NULL, 0),
(18, '联系我们', 'contact', '', NULL, 0);
UPDATE `xiami_pages` SET  `title` =  '关于我们' WHERE  `id` =14 LIMIT 1 ;