<?php
//正则路由配置
return array(
	//'配置项'=>'配置值'
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则
		//单页
		'/^pages\/(\w+)$/'               => 'Pages/view?id=:1',
		//作品详情页
		'/^works\/(\d+)$/'               => 'works/view?id=:1',
		'/^works\/(\d+)\/(\w+)$/'               => 'works/view?id=:1&sort=:2',
		//专题页
	    '/^works_special\/message\/(\d+)$/'            => 'works_special/message?id=:1',
		'/^works_special\/time\/(\d+)$/'               => 'works_special/view?id=:1&sort=time',
		'/^works_special\/good\/(\d+)$/'               => 'works_special/view?id=:1&sort=good',
		'/^works_special\/rank\/(\d+)$/'               => 'works_special/view?id=:1&sort=rank',
		'/^works_special\/(\d+)$/'               => 'works_special/view?id=:1',
		'/^works_special\/(\d+)\/(\w+)$/'        => 'works_special/view?id=:1&sort=:2',
		//tag页面	
		'/^tag\/(\d+)$/'               => 'tag/view?id=:1',
		//sort页面	
		'/^sort\/(\d+)$/'               => 'sort/view?id=:1',
		//作者
		'/^author\/(\d+)$/'        					=> 'author/index?id=:1',
		'/^author\/message\/(\d+)$/'            => 'author/message?id=:1',
		'/^author\/team\/(\d+)$/'            => 'author/team?id=:1',
		'/^author\/time\/(\d+)$/'               => 'author/index?id=:1&sort=time',
		'/^author\/good\/(\d+)$/'               => 'author/index?id=:1&sort=good',
		'/^author\/rank\/(\d+)$/'               => 'author/index?id=:1&sort=rank',
		//团队
		'/^team\/(\d+)$/'        			=> 'team/view?id=:1',
		'/^team\/user\/(\d+)$/'             => 'team/user?id=:1',
		'/^team\/user\/time\/(\d+)$/'       => 'team/user?id=:1&sort=time',
		'/^team\/user\/hits\/(\d+)$/'       => 'team/user?id=:1&sort=hits',
		'/^team\/user\/await\/(\d+)$/'      => 'team/user?id=:1&sort=await',		
	),
);
?>
