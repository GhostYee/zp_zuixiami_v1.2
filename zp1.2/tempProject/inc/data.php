<?php
$db_con = mysql_connect($db_host.':'.$db_port, $db_user, $db_pwd);
if (!$db_con) {
    die('Could not connect: ' . mysql_error());
}
mb_internal_encoding("UTF-8");
mysql_select_db($db_db, $db_con);
mysql_query("SET NAMES 'UTF8'"); 
mysql_query("SET CHARACTER SET UTF8"); 
mysql_query("SET CHARACTER_SET_RESULTS=UTF8"); 

?>