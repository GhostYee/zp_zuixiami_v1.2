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
INSERT INTO `xiami_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`, `type`, `group_id`) VALUES (300, 'User', '用户管理', 1, '', 0, 1, 2, 0, 14),
(301, 'Banner', '首页Banner管理', 1, '', 0, 1, 2, 0, 14);

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