--
-- 新建首页banner表 by wewe 20131216
--
CREATE TABLE IF NOT EXISTS `xiami_banner` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `img` varchar(100) NOT NULL COMMENT '图片',
  `url` varchar(100) NOT NULL COMMENT '地址',
  `sid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `img` (`img`),
  KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='首页banner管理';

-- --------------------------------------------------------
--
-- 新建session表 by wewe 20131217
--
CREATE TABLE IF NOT EXISTS `xiami_session` (
  `session_id` varchar(255) NOT NULL,
  `session_expire` int(11) NOT NULL COMMENT '过期时间',
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='session表';

-- --------------------------------------------------------
--
-- 插入节点管理 by wewe 20131217
--
INSERT INTO `xiami_node` ( `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`, `type`, `group_id`) VALUES ('User', '用户管理', 1, '', 0, 1, 2, 0, 14),
( 'Banner', '首页Banner管理', 1, '', 0, 1, 2, 0, 14);

-- --------------------------------------------------------
--
-- 插入单页管理 by wewe 20131217
--
INSERT INTO `xiami_pages` (`id`, `title`, `code`, `contents`, `adduser`, `addtime`, `is_open_edit`) VALUES
(15, '鬼懿IT QQ群 （鬼群）介绍', 'qun', '            <dl>                  <dt>高级群（19046753）</dt>                  <dd>——本群不开放自主加群。                    <p>创建于2005年12月 ，聚集的业内人事包括：阿当，大漠，辣妈，Rei，周裕波，司徒正美，丸子，鬼森林，寒冬，franky，林小志，飘飘,老赵，大城小胖，tension, 石头，aliui的团队成员,汤姆大叔，in.js作者，拔赤，月影，玉伯，勾三股四，阮一峰等，涵盖Taobao UED，WebQQ团队-腾讯AlloyTeam，百度，盛大研究院，360，一淘，W3C中国，Nodejs，sina，阿里中国，盛大在线等团队，以及来自硅谷的前端开发工程师，微软的工程师（印度人）。更有新生力量不断涌现，在国内前端事业中做出突出贡献的狂人，牛人。</p>                    <p>                      鬼群管理良好，热情积极有爱互助，秉持有效沟通的原则，倡导清晰有效的提问和发表需求的方式，建立气氛良好的前端技术学习讨论群，打破QQ群技术讨论质量低的局面。                    </p>                  </dd>                </dl>                <dl>                  <dt>成长群 （181368696）</dt>                  <dd>——本群开放加群。验证：自己的技能偏好                    <p>                      本群为高级群提供一个筛选的平台，以严格，严谨的态度帮助大家成长，包括做事方法，提问方式。成长群秉持和高级群一样的人性化的管理，通过QQ网络面试，提交的作品，和Blog，以及在成长群的表现的审核进入到高级群和更高级的人讨论和学习。                    </p>                    <p>成长群特点</p>                    <p>1.营造共同维护环境</p>                    <p>2.培养管理员作为技术先锋，不仅在技术上能带领，并能对群有突出贡献</p>                    <p>3.鼓励和施压基础比较薄弱的人员，学习和总结，改进提问方式，改进讨论质量使其进步</p>                    <p>4.对于不能进步人，清退。但不阻止再次加群。</p>                  </dd>                </dl>                              ', '', 0, 0),
(16, '最虾米团队', 'team', '          <div class="tip">加入我们？加QQ群：256732638；验证：最虾米。（以下是按加入时间排序）</div>                <h6>视觉设计组</h6>                <dl>                  <dt>@Thewei</dt>                  <dd>——十八般武艺样样精通，超人。负责项目原型设计，视觉设计，十项全能</dd>                </dl>                <dl>                  <dt>@AB</dt>                  <dd>——媒体工作者，超凡想象力，给最虾米新的生机。负责项目动画，创意实现</dd>                </dl>                <h6>后端开发组</h6>                <dl>                  <dt>@wewe(焰之翼)</dt>                  <dd>——超级奶爸，高级php工程师，网络管理，最虾米团队的恩人。负责项目开发和管理</dd>                </dl>                <dl>                  <dt>@Travis</dt>                  <dd>——前端新力量，前后端通吃。负责项目部分后端功能开发</dd>                </dl>                <dl>                  <dt>@Feenan</dt>                  <dd>——前端爱好者，前后端通吃，研究Nodejs。负责项目部分后端功能开发</dd>                </dl>                <dl>                  <dt>@水聚云合</dt>                  <dd>——前端爱好者，具有后端开发经验。负责项目部分后端功能开发</dd>                </dl>                 <dl>                  <dt>@240(Igin)</dt>                  <dd>——html5游戏开发达人 <a href="http://zp.zuixiami.com/author/500">进入游戏专辑</a>，高级全端人才，膜拜吧</dd>                </dl>                <h6>前端开发组</h6>                <dl>                  <dt>@Scorpio</dt>                  <dd>——前端爱好者。负责项目部分前端功能开发</dd>                </dl>                <h6>技术支持组</h6>                <dl>                  <dt>@Catty</dt>                  <dd>——前端狂热者，百度贴吧前端开发工程师。负责项目GIT指导，前端架构指导</dd>                </dl>                <dl>                  <dt>@寻寻道人</dt>                  <dd>——前端爱好者，具有后端开发经验。负责项目GIT指导</dd>                </dl>                <dl>                  <dt>@TGL</dt>                  <dd>——又一奶爸，前后端通吃，深厚功底。负责项目QQ群信息同步</dd>                </dl>                <h6>建议组</h6>                <dl>                  <dt>@hooray</dt>                  <dd>——WEBOS Hooray 系统开发者。前后端通吃。</dd>                </dl>                <dl>                  <dt>@litj</dt>                  <dd>——高级交互设计师（鬼懿交互的师傅），女生。</dd>                </dl>                                <dl>                  <dt>@Lyn_振华</dt>                  <dd>——高级前端开发工程师。对1.2版本有指导性的作用</dd>                </dl>                 <h6>项目发起人</h6>                <dl>                  <dt>@鬼懿</dt>                </dl>                <div class="tip">加入我们？加QQ群：256732638；验证：最虾米</div>              ', '', 0, 0),
(17, '加入最虾米', 'join', '', '', 0, 0),
(18, '捐助我们', 'offer', '', '', 0, 0),
(19, '联系我们', 'contact', '', '', 0, 0);


-- --------------------------------------------------------
--
-- 系统配置,增加SEO项 by wewe 20131217
--
INSERT INTO `xiami_config` (`id`, `pid`, `textname`, `code`, `type`, `store_range`, `store_dir`, `value`, `range_desc`, `cfg_desc`, `sid`) VALUES (211, 1, '首页SEO标题', 'cfg_seo_title', 'text', '', '', '最虾米-发现前端价值', '', '', 32),
(212, 1, '首页SEO关键词', 'cfg_seo_keywords', 'textarea', '', '', '', '', '', 32),
(213, 1, '首页SEO描述', 'cfg_seo_description', 'textarea', '', '', '', '', '', 32);

-- --------------------------------------------------------
--
-- 评论留言表 by wewe 20131217
--
DROP TABLE  `xiami_message`;
CREATE TABLE IF NOT EXISTS `xiami_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `module` varchar(50) NOT NULL COMMENT '模块',
  `mid` int(11) NOT NULL COMMENT '模块ID',
  `from_user_id` int(11) NOT NULL COMMENT '发送者用户ID',
  `to_user_id` int(11) NOT NULL COMMENT '接收者用户ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `contents` text NOT NULL COMMENT '内容',
  `ip` varchar(50) NOT NULL COMMENT '当前IP',
  `support` bigint(20) NOT NULL COMMENT '支持',
  `oppose` bigint(20) NOT NULL COMMENT '反对',
  `is_show` tinyint(1) NOT NULL COMMENT '是否显示',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `module` (`module`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论留言表';

ALTER TABLE  `xiami_message` CHANGE  `is_show`  `status` TINYINT( 1 ) NOT NULL COMMENT  '状态   1显示 2用户隐藏  3管理员隐藏 4回收站(用户删除)';

-- --------------------------------------------------------
--
-- 系统配置，增加留言是否需要审核 by wewe 20131223
--

INSERT INTO `xiami_config` (`id`, `pid`, `textname`, `code`, `type`, `store_range`, `store_dir`, `value`, `range_desc`, `cfg_desc`, `sid`) VALUES
(214, 2, '留言审核', 'cfg_message_check', 'select', '1,0', '', '1', '需要审核,不需要审核', '', 32);

-- --------------------------------------------------------
--
-- 节点管理，增加Tag管理 by wewe 20131225
--
INSERT INTO `xiami_node` ( `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`, `type`, `group_id`) VALUES
( 'Tag', 'Tag管理', 1, '', 0, 1, 2, 0, 14);

-- --------------------------------------------------------
--
-- 附件管理表更改 by wewe 20131225
--
ALTER TABLE  `xiami_uploads` CHANGE  `id`  `id` BIGINT NOT NULL AUTO_INCREMENT COMMENT  '自增ID';
ALTER TABLE  `xiami_uploads` CHANGE  `module`  `module` VARCHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模块 1.2后弃用',
CHANGE  `mid`  `mid` INT( 11 ) NOT NULL DEFAULT  '0' COMMENT  '模块ID 1.2后弃用';
ALTER TABLE  `xiami_uploads` CHANGE  `thumburl_0`  `thumburl_0` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '缩略图1 1.2后弃用',
CHANGE  `thumburl_1`  `thumburl_1` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT  '缩略图2 1.2后弃用';
ALTER TABLE  `xiami_uploads` ADD  `filename` VARCHAR( 255 ) NOT NULL COMMENT  '文件名' AFTER  `title` ;
ALTER TABLE  `xiami_uploads` ADD  `thumbpath` VARCHAR( 255 ) NOT NULL COMMENT  '缩略图目录' AFTER  `extension` ;
ALTER TABLE  `xiami_uploads` ADD  `adduser` VARCHAR( 100 ) NOT NULL COMMENT  '添加人' AFTER  `thumburl_1` ;
ALTER TABLE  `xiami_uploads` ADD  `filepath` VARCHAR( 255 ) NOT NULL COMMENT  '文件地址' AFTER  `url` ;
ALTER TABLE  `xiami_uploads` ADD  `is_thumb` TINYINT( 1 ) NOT NULL COMMENT  '是否缩略图' AFTER  `thumburl_1` ;
ALTER TABLE  `xiami_uploads` ADD  `userid` INT NOT NULL COMMENT  '用户ID 关联user表' AFTER  `is_thumb` ;
ALTER TABLE  `xiami_uploads` ADD  `status` TINYINT NOT NULL COMMENT  '状态 预留' AFTER  `hit` ;
ALTER TABLE  `xiami_uploads` CHANGE  `filepath`  `fileurl` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文件地址';

ALTER TABLE  `xiami_banner` ADD  `uploads_id` BIGINT NOT NULL COMMENT  '附件上传ID' AFTER  `id` ;
ALTER TABLE  `xiami_works_special` ADD  `uploads_id` BIGINT NOT NULL COMMENT  '附件上传ID' AFTER  `id`;
ALTER TABLE  `xiami_works` ADD  `uploads_id` BIGINT NOT NULL COMMENT  '附件上传ID' AFTER  `id`; 

-- --------------------------------------------------------
--
-- 新建分类表 by wewe 20131226
--
CREATE TABLE IF NOT EXISTS `xiami_categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `pid` int(11) NOT NULL COMMENT '父ID',
  `module` varchar(100) NOT NULL COMMENT '模块',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `sid` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='分类';

-- --------------------------------------------------------
--
-- 新建友情链接表 by wewe 20131226
--
CREATE TABLE IF NOT EXISTS `xiami_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uploads_id` bigint(20) NOT NULL COMMENT '附件上传ID',
  `webname` varchar(30) NOT NULL COMMENT '网站名',
  `url` varchar(100) NOT NULL COMMENT '地址',
  `sid` mediumint(6) NOT NULL COMMENT '排序',
  `logo` varchar(50) NOT NULL COMMENT 'LOGO图片',
  PRIMARY KEY (`id`),
  KEY `webname` (`webname`),
  KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接管理';

-- --------------------------------------------------------
--
-- 新建通用日志表 by wewe 20131226
--
CREATE TABLE IF NOT EXISTS `xiami_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL COMMENT '模块',
  `mid` int(11) NOT NULL COMMENT '模块ID',
  `status` varchar(100) NOT NULL COMMENT '状态',
  `notice` text NOT NULL COMMENT '备注',
  `adduser` varchar(30) NOT NULL COMMENT '操作人',
  `addtime` int(10) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='通用日志记录' ;

-- --------------------------------------------------------
--
-- 新建新闻表 by wewe 20131226
--
CREATE TABLE IF NOT EXISTS `xiami_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `catid` int(11) NOT NULL COMMENT '分类ID',
  `uploads_id` bigint(20) NOT NULL COMMENT '附件上传ID 缩略图地址',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `contents` text NOT NULL COMMENT '内容',
  `img` varchar(255) NOT NULL COMMENT '缩略图',
  `adduser` varchar(100) NOT NULL COMMENT '添加人',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `tplname` varchar(50) NOT NULL COMMENT '模板名',
  `url` varchar(100) NOT NULL COMMENT 'URL跳转地址',
  `hit` int(11) NOT NULL DEFAULT '50' COMMENT '点击量',
  `sid` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `is_hide` tinyint(1) unsigned NOT NULL COMMENT '是否隐藏',
  `is_top` tinyint(1) unsigned NOT NULL COMMENT '是否推荐',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `is_show` (`is_hide`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='新闻表';

-- --------------------------------------------------------
--
-- 节点管理，增加 by wewe 20131225
--
INSERT INTO `xiami_node` ( `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`, `type`, `group_id`) VALUES
( 'Categorys', '分类管理', 1, '', 0, 1, 2, 0, 14);
INSERT INTO `xiami_node` ( `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`, `type`, `group_id`) VALUES
( 'Logs', '日志管理', 1, '', 0, 1, 2, 0, 14);
INSERT INTO `xiami_node` ( `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`, `type`, `group_id`) VALUES
( 'News', '新闻管理', 1, '', 0, 1, 2, 0, 14);
INSERT INTO `xiami_node` ( `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`, `type`, `group_id`) VALUES
( 'Links', '友情连接管理', 1, '', 0, 1, 2, 0, 14);
-- --------------------------------------------------------
--
-- banner管理，增加状态判断 by wewe 20131225
--
ALTER TABLE  `xiami_banner` ADD  `status` TINYINT NOT NULL DEFAULT  '0' COMMENT  '状态' AFTER  `sid` ;

-- --------------------------------------------------------
--
-- 作品管理，增加审核不通过原因 by wewe 20131227
--
ALTER TABLE  `xiami_works` ADD  `not_pass_reason` VARCHAR( 255 ) NOT NULL COMMENT  '审核不通过原因' AFTER  `rank_count` ;
ALTER TABLE  `xiami_works` CHANGE  `not_pass_reason`  `not_pass_reason` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '0' COMMENT  '审核不通过原因'
