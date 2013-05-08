<?php
//正则路由配置
return array(
	//'配置项'=>'配置值'
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则
		'about'               => 'Pages/view?id=about',
		//首页
		'/^index\/nochecked$/'        		=> 'Index/index?status=1',
		'/^index\/checkedn$/'        		=> 'Index/index?status=3',
		//作者列表
		'/^author\/(\d+)\/nochecked$/'        		=> 'Author/index?id=:1&status=1',
		'/^author\/(\d+)\/checkedn$/'        		=> 'Author/index?id=:1&status=3',
		'/^author\/(\d+)$/'        					=> 'Author/index?id=:1&status=2',
		//作者作品列表
		'/^user\/workslist\/nochecked$/'     => 'user/workslist?status=1',
		'/^user\/workslist\/checkedn$/'      => 'user/workslist?status=3',
		'/^user\/workslist$/'        		=> 'user/workslist?status=2',
	),
);
?>