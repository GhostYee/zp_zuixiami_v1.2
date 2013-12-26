<?php
return array(
	//'配置项'=>'配置值'
	'SHOW_PAGE_TRACE'	=>	0,
	
	'VAR_PAGE' => 'pageNum',
	
	'SESSION_OPTIONS'=>array(
		'expire'=>'1800',
	),
	//启用session数据库保存
	'SESSION_TYPE' => 'db', //保存方式
	'SESSION_TABLE' =>'xiami_session',//session表
	'SESSION_EXPIRE'=>'1800',//过期时间
	
	//RBAC配置
	'USER_AUTH_ON' => true,
	'USER_AUTH_TYPE' => 2, // 默认认证类型 1 登录认证 2 实时认证
	'USER_AUTH_KEY' => 'basecmsauthId', // 用户认证SESSION标记
	'_ACCESS_LIST' => '_ACCESS_LIST', // 用户访问SESSION标记
	'ADMIN_AUTH_KEY' => 'basecmsadministrator',
	'USER_AUTH_MODEL' => 'Admin', // 默认验证数据表模型
	'AUTH_PWD_ENCODER' => 'md5', // 用户认证密码加密方式
	'USER_AUTH_GATEWAY' => '/Admin/Public/login', // 默认认证网关
	'NOT_AUTH_MODULE' => 'Public', // 默认无需认证模块
	'REQUIRE_AUTH_MODULE' => '', // 默认需要认证模块
	'NOT_AUTH_ACTION' => '', // 默认无需认证操作
	'REQUIRE_AUTH_ACTION' => '', // 默认需要认证操作
	'GUEST_AUTH_ON' => false, // 是否开启游客授权访问
	'GUEST_AUTH_ID' => 0, // 游客的用户ID
	'DB_LIKE_FIELDS' => 'title|remark',
	'RBAC_ROLE_TABLE'   => 'xiami_role',
	'RBAC_USER_TABLE'   => 'xiami_role_user',
	'RBAC_ACCESS_TABLE' => 'xiami_access',
	'RBAC_NODE_TABLE'   => 'xiami_node',
);
?>