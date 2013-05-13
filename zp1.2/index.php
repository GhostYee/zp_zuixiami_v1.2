<?php
define( 'ZUIXIAMI_ROOT', dirname( __FILE__ ).'/' );
//开启调试模式
define('APP_DEBUG', true);

//ThinkPHP路径
define('THINK_PATH','./ThinkPHP/');
//定义项目名称和路径
define('APP_NAME', 'App');
define('APP_PATH', './App/');
// 加载框架入口文件
require( THINK_PATH.'ThinkPHP.php');
