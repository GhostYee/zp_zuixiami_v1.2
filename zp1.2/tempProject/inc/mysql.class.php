<?php

/*
mysql数据库类

全局变量
//数据库配置
$db_host   = "localhost"; //连接地址
$db_name   = "dbname";     //数据库名
$db_user   = "user";      //连接用户
$db_pass   = "pass";		 //数据库密码
$table     = "xiami_";	  //表前辍
$charset   = "utf-8";     //网页字符utf-8 gb2312
$dbcharset = "UTF8";      //数据库字符 UTF8 GBK lain1

调用
$db = new mysql($db_host, $db_user, $db_pass, $db_name);
$db_host = $db_user = $db_pass = $db_name = NULL;

示例
$sql="SELECT count(id) FROM {$table}test";
$num=$db->getOne($sql);
*/

class mysql
{
    var $link    = NULL;

    function __construct($dbhost, $dbuser, $dbpw, $dbname = '', $pconnect = 0, $quiet = 0)
    {
        $this->mysql($dbhost, $dbuser, $dbpw, $dbname, $pconnect, $quiet);
    }

    function mysql($dbhost, $dbuser, $dbpw, $dbname = '', $pconnect = 0, $quiet = 0)
    {
        if ($quiet)
        {
            $this->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect, $quiet);
        }
        else
        {
            $this->settings = array(
                                    'dbhost'   => $dbhost,
                                    'dbuser'   => $dbuser,
                                    'dbpw'     => $dbpw,
                                    'dbname'   => $dbname,
                                    'charset'  => $charset,
                                    'pconnect' => $pconnect
                                    );
        }
    }
	
	/**
     * 数据库连接
     *
     * @param string $dbhost　连接地址
     * @param string $dbuser　用户名
     * @param string $dbpw　　密码
     * @param string $dbname　数据库名
     * @param int $pconnect　 是否永久连接
     * @param int $quiet
     * @return link
     */
    function connect($dbhost, $dbuser, $dbpw, $dbname = '', $pconnect = 0, $quiet = 0)
    {
		global $dbcharset;
        if ($pconnect)
        {
            if (!($this->link = @mysql_pconnect($dbhost, $dbuser, $dbpw)))
            {
                if (!$quiet)
                {
                    $this->ErrorMsg("Can't pConnect MySQL Server($dbhost)!");
                }
                return false;
            }
        }
        else
        {
            if (PHP_VERSION >= '4.2')
            {
                $this->link = @mysql_connect($dbhost, $dbuser, $dbpw, true);
            }
            else
            {
                $this->link = @mysql_connect($dbhost, $dbuser, $dbpw);
                mt_srand((double)microtime() * 1000000); 
            }
            if (!$this->link)
            {
                if (!$quiet)
                {
                    $this->ErrorMsg("Can't Connect MySQL Server($dbhost)!");
                }
                return false;
            }
        }

        $this->dbhash  = md5($this->root_path . $dbhost . $dbuser . $dbpw . $dbname);
        $this->version = mysql_get_server_info($this->link);
        if ($this->version > '4.1')
        {
            if ($dbcharset != 'latin1')
            {
                mysql_query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary", $this->link);
            }
            if ($this->version > '5.0.1')
            {
                mysql_query("SET sql_mode=''", $this->link);
            }
        }

        if ($dbname)
        {
            if (mysql_select_db($dbname, $this->link) === false )
            {
                if (!$quiet)
                {
                    $this->ErrorMsg("Can't select MySQL database($dbname)!");
                }

                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return true;
        }
    }
	
    /**
     * 数据库连接
     *
     * @param string $sql 查询sql
     * @param type $type  类型
     * @return res
     */
    function query($sql, $type = '')
    {
        if ($this->link === NULL)
        {
            $this->connect($this->settings['dbhost'], $this->settings['dbuser'], $this->settings['dbpw'], $this->settings['dbname'], $this->settings['charset'], $this->settings['pconnect']);
            $this->settings = array();
        }
        if ($this->queryCount++ <= 99)
        {
            $this->queryLog[] = $sql;
        }
        if ($this->queryTime == '')
        {
            if (PHP_VERSION >= '5.0.0')
            {
                $this->queryTime = microtime(true);
            }
            else
            {
                $this->queryTime = microtime();
            }
        }
        if (!($query = mysql_query($sql, $this->link)) && $type != 'SILENT')
        {
            $this->error_message[]['message'] = 'MySQL Query Error';
            $this->error_message[]['sql'] = $sql;
            $this->error_message[]['error'] = mysql_error($this->link);
            $this->error_message[]['errno'] = mysql_errno($this->link);

            $this->ErrorMsg();

            return false;
        }
        return $query;
    }
	/**
     * 取得前一次 MySQL 操作所影响的记录行数
     *
     * @return num
     */
    function affected_rows()
    {
        return mysql_affected_rows($this->link);
    }
    
    /**
     * 取得结果集中字段的数目
     *
     * @return fields num
     */
	function num_fields($query)
	{	
        return mysql_num_fields($query);
    }
    
    /**
     * 返回上一个 MySQL 操作产生的文本错误信息
     *
     * @return mysql error
     */
    function error()
    {
        return mysql_error($this->link);
    }
	
    /**
     * 返回上一个 MySQL 操作中的错误信息的数字编码
     *
     * @return mysql num
     */
    function errno()
    {
        return mysql_errno($this->link);
    }
	
    /**
     * 取得结果集中行的数目
     * @param $query
     * @return Row num
     */
    function num_rows($query)
    {
        return mysql_num_rows($query);
    }
	
    /**
     * 取得结果集中行的数目
     *
     * @return Row num
     */
    function insert_id()
    {
        return mysql_insert_id($this->link);
    }
    
     /**
     * 从结果集中取得一行作为枚举数组
     *
     * @return array
     */
    function fetchRow($query)
    {
        return mysql_fetch_assoc($query);
    }
	
     /**
     * 从结果集中取得一行作为关联数组，或数字数组，或二者兼有
     *
     * @return array
     */
	function fetcharray($query)
    {
        return mysql_fetch_array($query);
    }

    /**
     * 数据库版本
     *
     * @return version
     */
    function version()
    {
        return $this->version;
    }

    /**
     * 关闭数据库
     *
     * @return unknown
     */
    function close()
    {
        return mysql_close($this->link);
    }
    
	/**
     * 错误提示
     * @param string $message　错误信息
     * @param string $sql　　　
     *
     * @return msg
     */
    function ErrorMsg($message = '', $sql = '')
    {
        if ($message)
        {
            echo "$message\n\n";
        }
        else
        {
            echo "<b>MySQL server error report:";
            print_r($this->error_message);
        }

        exit;
    }
   
    /**
     * 限制条数
     * @param string $sql
     * @param int 	 $num　多少条
     * @param int    $start　哪条开始
     * @return array
     */
    function selectLimit($sql, $num, $start = 0)
    {
        if ($start == 0)
        {
            $sql .= ' LIMIT ' . $num;
        }
        else
        {
            $sql .= ' LIMIT ' . $start . ', ' . $num;
        }

        return $this->query($sql);
    }
	
    function getFields($table)
    {
        /* Internal counter */
        $index = 0;
        
        /* Get the fields */
        $ret = mysql_list_fields($dbname, $table);
        
        /* Store them into our final array: */
        while ($index < mysql_num_fields($ret)) {
           $fields[$index] = mysql_field_name($ret, $index);
           $index++;
        }
    
        /* Returns the array or NULL */
        return count($fields) > 0 ? $fields : NULL;
    }
	
	 function getTables()
    {
        /* Query to get the tables in the current database: */
        $ret = $this->Query("SHOW TABLES FROM {$this->curdb}");
        
        /* Fetchs the array to be returned: */
        while ($res = $this->fetchArray()) {
            $tables[] = $res[0];
        }

        /* Returns the array or NULL */
        return count($tables) > 0 ? $tables : NULL;        
    }
     
	/**
     * 获得sql一个字段数据
     *
     * @return array
     */
 	function getCol($sql)
    {
        $res = $this->query($sql);
        if ($res !== false)
        {
            $arr = array();
            while ($row = mysql_fetch_row($res))
            {
                $arr[] = $row[0];
            }

            return $arr;
        }
        else
        {
            return false;
        }
    }
	
	/**
     * 获得sql一个字段数据
     * @param bool $limited 是否使用limit 
     * @return array
     */
    function getOne($sql, $limited = false)
    {
        if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false)
        {
            $row = mysql_fetch_row($res);

            if ($row !== false)
            {
                return $row[0];
            }
            else
            {
                return '';
            }
        }
        else
        {
            return false;
        }
    }

 	/**
     * 取得所有数组
     *
     * @return array
     */
    function getAll($sql)
    {
        $res = $this->query($sql);
        if ($res !== false)
        {
            $arr = array();
            while ($row = mysql_fetch_assoc($res))
            {
                $arr[] = $row;
            }

            return $arr;
        }
        else
        {
            return false;
        }
    }

	/**
     * 获得数据
     * @param bool $limited 　true为限制为一条　false取所有  
     * 
     * @return array
     */
    function getRow($sql, $limited = false)
    {
        if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false)
        {
            return mysql_fetch_assoc($res);
        }
        else
        {
            return false;
        }
    }
    
	/**
     * 按字段更新添加，更新数据
     * @param string 		$table　			表名
     * @param array 		$field_values　　数组
     * @param INSERT UPDATE $mode			模式　INSERT插入,UPDATE更新
     * @param string 		$where			where条件判断
     * @param $querymode
     * 
     * @return true false
     */
	 function autoExecute($table, $field_values, $mode = 'INSERT', $where = '', $querymode = '')
    {
        $field_names = $this->getCol('DESC ' . $table);

        $sql = '';
        if ($mode == 'INSERT')
        {
            $fields = $values = array();
            foreach ($field_names AS $value)
            {
                if (array_key_exists($value, $field_values) == true)
                {
                    $fields[] = $value;
                    $values[] = "'" . $field_values[$value] . "'";
                }
            }

            if (!empty($fields))
            {
                $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
            }
        }
        else
        {
            $sets = array();
            foreach ($field_names AS $value)
            {
                if (array_key_exists($value, $field_values) == true)
                {
                    $sets[] = $value . " = '" . $field_values[$value] . "'";
                }
            }

            if (!empty($sets))
            {
                $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
            }
        }

        if ($sql)
        {
        	if($mode == 'INSERT'){
        		$this->query($sql, $querymode);
            	return $this->insert_id();
        	}
        	else{
        		return $this->query($sql, $querymode);
        	}
        }
        else
        {
            return false;
        }
    }
	
	function autoReplace($table, $field_values, $update_values, $where = '', $querymode = '')
    {
        $field_descs = $this->getAll('DESC ' . $table);

        $primary_keys = array();
        foreach ($field_descs AS $value)
        {
            $field_names[] = $value['Field'];
            if ($value['Key'] == 'PRI')
            {
                $primary_keys[] = $value['Field'];
            }
        }

        $fields = $values = array();
        foreach ($field_names AS $value)
        {
            if (array_key_exists($value, $field_values) == true)
            {
                $fields[] = $value;
                $values[] = "'" . $field_values[$value] . "'";
            }
        }

        $sets = array();
        foreach ($update_values AS $key => $value)
        {
            if (array_key_exists($key, $field_values) == true)
            {
                if (is_int($value) || is_float($value))
                {
                    $sets[] = $key . ' = ' . $key . ' + ' . $value;
                }
                else
                {
                    $sets[] = $key . " = '" . $value . "'";
                }
            }
        }

        $sql = '';
        if (empty($primary_keys))
        {
            if (!empty($fields))
            {
                $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
            }
        }
        else
        {
            if ($this->version() >= '4.1')
            {
                if (!empty($fields))
                {
                    $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
                    if (!empty($sets))
                    {
                        $sql .=  'ON DUPLICATE KEY UPDATE ' . implode(', ', $sets);
                    }
                }
            }
            else
            {
                if (empty($where))
                {
                    $where = array();
                    foreach ($primary_keys AS $value)
                    {
                        if (is_numeric($value))
                        {
                            $where[] = $value . ' = ' . $field_values[$value];
                        }
                        else
                        {
                            $where[] = $value . " = '" . $field_values[$value] . "'";
                        }
                    }
                    $where = implode(' AND ', $where);
                }

                if ($where && (!empty($sets) || !empty($fields)))
                {
                    if (intval($this->getOne("SELECT COUNT(*) FROM $table WHERE $where")) > 0)
                    {
                        if (!empty($sets))
                        {
                            $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
                        }
                    }
                    else
                    {
                        if (!empty($fields))
                        {
                            $sql = 'REPLACE INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
                        }
                    }
                }
            }
        }

        if ($sql)
        {
            return $this->query($sql, $querymode);
        }
        else
        {
            return false;
        }
    }
}
?>