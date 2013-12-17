<?php
return array(
	//'配置项'=>'配置值'
	'LOAD_EXT_CONFIG' => 'route,db,auth', //加载扩展配置
	'LOAD_EXT_FILE'	 => 'extend', //加载扩展函数库
	
	'URL_MODEL'	=>	2, // 如果你的环境不支持PATHINFO 请设置为3	
	'APP_GROUP_LIST' => 'Home,Admin', //项目分组设定
	'DEFAULT_GROUP'  => 'Home', //默认分组
	'OUTPUT_ENCODE' => false, //关闭 页面压缩输出
	
	'SESSION_AUTO_START'        =>  true,//开启session
	'SESSION_OPTIONS'=>array(
		'expire'=>'1800',
	),
	//启用session数据库保存
	'SESSION_TYPE' => 'db', //保存方式
	'SESSION_TABLE' =>'xiami_session',//session表
	'SESSION_EXPIRE'=>'1800',//过期时间
	
	
	'APP_AUTOLOAD_PATH'=>'@.TagLib',
	
	//开启模板主题切换
	'DEFAULT_THEME'  	=> 	'default',
    'THEME_LIST'		=>	'default,zuixiami',
    'TMPL_DETECT_THEME' => 	true, // 自动侦测模板主题

	
	
	//以下为自定义配置项
	'SYSCACHE_PREFIX'=>'cache', //定义系统缓存文件前辍
	
	//定义系统缓存数组
	'SYSCACHE_FILE'=>array(
		'sysconfig'=>'系统配置缓存'
	), 
);
?>