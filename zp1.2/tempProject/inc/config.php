<?php
header('Content-type: text/html; charset=utf-8');

//数据库配置

$db_host='127.0.0.1';
$db_port='3306';
$db_user='root';
$db_pwd='';
$db_db='zuixiamiZP';

//基本配置
//首页
$home_words_start=0;
$home_words_step=15;


Function getRequest($key) 
{ 	
	if(!isset($_REQUEST[$key]))
	{
		return "";
	}
	else
	{
		return urldecode($_REQUEST[$key]);
	}
} 

function prep_url($str = '')
	{
		if ($str == 'http://' OR $str == '')
		{
			return '';
		}
		$url = parse_url($str);

		if ( ! $url OR ! isset($url['scheme']))
		{
			$str = 'http://'.$str;
		}

		return $str;
	}
?>