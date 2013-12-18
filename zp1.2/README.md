#### 一: 环境 ####
php5.2.0 + mysql5

php框架thinkphp 3.1.3  http://www.thinkphp.cn

后台模板DWZ 1.45 http://www.j-ui.com

需要开启伪静态

#### 二:数据库文件 ####
在MySQL命令行执行zuixiami.init.sql文件创建数据库和表

配置数据库连接

App/Conf/db.php
(先将App/Conf/目录下的db.sample.php文件改名为db.php)

>'DB_TYPE'	=>	'mysql',
>'DB_HOST'	=>	'localhost',
>	
'DB_NAME'	=>	'zuixiami', //数据库名
>	
'DB_USER'	=>	'root',     //数据库用户名
>	
'DB_PWD'	=>	'',         //数据库密码
>	
'DB_PORT'	=>	'3306',
>	
'DB_PREFIX'	=>	'xiami_',
>	

#### 三:用户后台地址 ####
地址Admin  
如http://127.0.0.1/zuixiami/Admin

用户:zuixiami

密码:Zp.Zuixiami.com~^_^~2013

如不能访问请开启下伪静态


#### 四:目录说明 ####
以thinkphp规则为主

App/Lib/Action/Admin 后台程序

App/Lib/Action/Home  前台程序

App/Lib/Tpl/default/Admin    后台模板

App/Lib/Tpl/default/Home     前台模板



thinkphp核心修改以下兼容DWZ

1:加__MODULE__

2:修改ajaxReturn函数

3:修改dispatchJump函数

具体可搜索by wewe查修改部分


前台启用以下,后台默认无设置

>
'URL_CASE_INSENSITIVE' =>true //URL大小写
>


#### 五:数据库mysql版本管理 ####
git还不知道用什么进行版本管理,先接下面的进行

zuixiami.sql 基础数据库 一般不做改动

update.sql 更新的数据  有修改的数据结构等都放这边

