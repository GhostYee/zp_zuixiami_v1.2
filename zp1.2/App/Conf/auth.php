<?php
//各平台登录配置

//定义回调URL通用的URL
define('URL_CALLBACK', 'http://zp.zuixiami.com/index.php?m=User&a=auth_callback&type=');
return array(
	//'配置项'=>'配置值'
	
	//腾讯QQ登录配置
	'THINK_SDK_QQ' => array(
		'APP_KEY'    => '100403953', //应用注册成功后分配的 APP ID
		'APP_SECRET' => '18fa7c3d307c30c5160210dcdb33dc5e', //应用注册成功后分配的KEY
		'CALLBACK'   => URL_CALLBACK . 'qq',
	),
);
?>