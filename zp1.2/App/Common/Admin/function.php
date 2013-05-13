<?php
// $Id$
//公共函数
function toDate($time, $format = 'Y-m-d H:i:s') {
    if (empty($time)) {
        return '';
    }
    $format = str_replace('#', ':', $format);
    return date($format, $time);
}

// 缓存文件
function cmssavecache($name = '', $fields = '') {
    $Model = D($name);
    $list = $Model->select();
    $data = array();
    foreach ($list as $key => $val) {
        if (empty($fields)) {
            $data [$val [$Model->getPk()]] = $val;
        } else {
            // 获取需要的字段
            if (is_string($fields)) {
                $fields = explode(',', $fields);
            }
            if (count($fields) == 1) {
                $data [$val [$Model->getPk()]] = $val [$fields [0]];
            } else {
                foreach ($fields as $field) {
                    $data [$val [$Model->getPk()]] [] = $val [$field];
                }
            }
        }
    }
    $savefile = cmsgetcache($name);
    // 所有参数统一为大写
    $content = "<?php\nreturn " . var_export(array_change_key_case($data, CASE_UPPER), true) . ";\n?>";
    file_put_contents($savefile, $content);
}

function cmsgetcache($name = '') {
    return DATA_PATH . '~' . strtolower($name) . '.php';
}

function getStatus($status, $imageShow = true) {
    switch ($status) {
        case 0 :
            $showText = '禁用';
            $showImg = '<IMG SRC="' . __ROOT__.'/Public/Images/locked.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="禁用">';
            break;
        case 2 :
            $showText = '待审';
            $showImg = '<IMG SRC="' . __ROOT__.'/Public/Images/prected.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="待审">';
            break;
        case - 1 :
            $showText = '删除';
            $showImg = '<IMG SRC="' . __ROOT__.'/Public/Images/del.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="删除">';
            break;
        case 1 :
        default :
            $showText = '正常';
            $showImg = '<IMG SRC="' . __ROOT__.'/Public/Images/ok.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="正常">';
    }
    return ($imageShow === true) ? $showImg : $showText;
}

function getDefaultStyle($style) {
    if (empty($style)) {
        return 'blue';
    } else {
        return $style;
    }
}

function IP($ip = '', $file = 'UTFWry.dat') {
    $_ip = array();
    if (isset($_ip [$ip])) {
        return $_ip [$ip];
    } else {
        import("@.ORG.Net.IpLocation");
        $iplocation = new IpLocation($file);
        $location = $iplocation->getlocation($ip);
        $_ip [$ip] = $location ['country'] . $location ['area'];
    }
    return $_ip [$ip];
}

function getNodeName($id) {
    if (Session::is_set('nodeNameList')) {
        $name = Session::get('nodeNameList');
        return $name [$id];
    }
    $Group = D("Node");
    $list = $Group->getField('id,name');
    $name = $list [$id];
    Session::set('nodeNameList', $list);
    return $name;
}

function get_pawn($pawn) {
    if ($pawn == 0)
        return "<span style='color:green'>没有</span>";
    else
        return "<span style='color:red'>有</span>";
}

function get_patent($patent) {
    if ($patent == 0)
        return "<span style='color:green'>没有</span>";
    else
        return "<span style='color:red'>有</span>";
}

function getNodeGroupName($id) {
    if (empty($id)) {
        return '未分组';
    }
    if (isset($_SESSION ['nodeGroupList'])) {
        return $_SESSION ['nodeGroupList'] [$id];
    }
    $Group = D("Group");
    $list = $Group->getField('id,title');
    $_SESSION ['nodeGroupList'] = $list;
    $name = $list [$id];
    return $name;
}

function getCardStatus($status) {
    switch ($status) {
        case 0 :
            $show = '未启用';
            break;
        case 1 :
            $show = '已启用';
            break;
        case 2 :
            $show = '使用中';
            break;
        case 3 :
            $show = '已禁用';
            break;
        case 4 :
            $show = '已作废';
            break;
    }
    return $show;
}

// zhanghuihua@msn.com
function showStatus($status, $id, $callback="") {
    switch ($status) {
        case 0 :
            $info = '<a href="__URL__/resume/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="' . $callback . '">恢复</a>';
            break;
        case 2 :
            $info = '<a href="__URL__/pass/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="' . $callback . '">批准</a>';
            break;
        case 1 :
            $info = '<a href="__URL__/forbid/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="' . $callback . '">禁用</a>';
            break;
        case - 1 :
            $info = '<a href="__URL__/recycle/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="' . $callback . '">还原</a>';
            break;
    }
    return $info;
}

// tenking@live.cn
function isshow($status) {
    switch ($status) {
        case 0 :
            $info = '隐藏';
            break;
        case 1 :
            $info = '显示';
            break;
    }
    return $info;
}

function getGroupName($id) {
    if ($id == 0) {
        return '无上级组';
    }
    if ($list = F('groupName')) {
        return $list [$id];
    }
    $dao = D("Role");
    $list = $dao->field('id,name')->select();	
    foreach ($list as $vo) {
        $nameList [$vo ['id']] = $vo ['name'];
    }
    $name = $nameList [$id];
    F('groupName', $nameList);
    return $name;
}


function getGroupNameByUserId($id) {
    $RoleUser = M("RoleUser");
    $roleIdList = $RoleUser->where("user_id=$id")->find();
    $roleId = $roleIdList['role_id'];
    if ($roleId == 0) {
        return '无权限组';
    }

    $dao = D("Role");
    $list = $list = $dao->field('id,name')->select();
    foreach ($list as $vo) {
        $nameList [$vo ['id']] = $vo ['name'];
    }
    $name = $nameList [$roleId];
    return $name;
}

function sort_by($array, $keyname = null, $sortby = 'asc') {
    $myarray = $inarray = array();
    # First store the keyvalues in a seperate array
    foreach ($array as $i => $befree) {
        $myarray [$i] = $array [$i] [$keyname];
    }
    # Sort the new array by
    switch ($sortby) {
        case 'asc' :
            # Sort an array and maintain index association...
            asort($myarray);
            break;
        case 'desc' :
        case 'arsort' :
            # Sort an array in reverse order and maintain index association
            arsort($myarray);
            break;
        case 'natcasesor' :
            # Sort an array using a case insensitive "natural order" algorithm
            natcasesort($myarray);
            break;
    }
    # Rebuild the old array
    foreach ($myarray as $key => $befree) {
        $inarray [] = $array [$key];
    }
    return $inarray;
}

function pwdHash($password, $type = 'md5') {
    return hash($type, $password);
}
/**
 * 获取指定月份的第一天开始和最后一天结束的时间戳
 *
 * @param int $y 年份 $m 月份
 * @return array(本月开始时间，本月结束时间)
 */
function datetimeFristAndLast() {
    $t = time();
    $t1 = mktime(0, 0, 0, date("m", $t), date("d", $t), date("Y", $t));
    $t2 = mktime(0, 0, 0, date("m", $t), 1, date("Y", $t));
    $t3 = mktime(0, 0, 0, date("m", $t) - 1, 1, date("Y", $t));
    $t4 = mktime(0, 0, 0, 1, 1, date("Y", $t));
    $e1 = mktime(23, 59, 59, date("m", $t), date("d", $t), date("Y", $t));
    $e2 = mktime(23, 59, 59, date("m", $t), date("t"), date("Y", $t));
    $e3 = mktime(23, 59, 59, date("m", $t) - 1, date("t", $t3), date("Y", $t));
    $e4 = mktime(23, 59, 59, 12, 31, date("Y", $t));
    /* 		
     * //测试
      echo   date("当前   Y-m-d   H:i:s",$t)."   $t<br>";
      echo   date("今天起点   Y-m-d   H:i:s",$t1)."   $t1<br>";
      echo   date("今月起点   Y-m-d   H:i:s",$t2)."   $t2<br>";
      echo   date("上月起点   Y-m-d   H:i:s",$t3)."   $t3<br>";
      echo   date("今年起点   Y-m-d   H:i:s",$t4)."   $t4<br>";
      //测试
      echo   date("今天终点   Y-m-d   H:i:s",$e1)."   $e1<br>";
      echo   date("今月终点   Y-m-d   H:i:s",$e2)."   $e2<br>";
      echo   date("上月终点   Y-m-d   H:i:s",$e3)."   $e3<br>";
      echo   date("今年终点   Y-m-d   H:i:s",$e4)."   $e4<br>";
     */
    $returnTime = array();
    $returnTime['now'] = $t;
    $returnTime['todaybegintime'] = $t1;
    $returnTime['thismonthbegintime'] = $t2;
    $returnTime['lastmonthbegintime'] = $t3;
    $returnTime['thisyearbegintime'] = $t4;
    $returnTime['todayendtime'] = $e1;
    $returnTime['thismonthendtime'] = $e2;
    $returnTime['lastmonthendtime'] = $e3;
    $returnTime['thisyearendtime'] = $e4;
    return $returnTime;
}

/*
 * 比较时间段一与时间段二是否有交集
 */

function isMixTime($begintime1, $endtime1, $begintime2, $endtime2) {
    $status = $begintime2 - $begintime1;
    if ($status > 0) {
        $status2 = $begintime2 - $endtime1;
        if ($status2 > 0) {
            return false;
        } else {
            return true;
        }
    } else {
        $status2 = $begintime1 - $endtime2;
        if ($status2 > 0) {
            return false;
        } else {
            return true;
        }
    }
    return false;
}

/**
 * 转化 \ 为 /
 *
 * @param	string	$path	路径
 * @return	string	路径
 */
function dir_path($path) {
    $path = str_replace('\\', '/', $path);
    if (substr($path, -1) != '/')
        $path = $path . '/';
    return $path;
}

function dir_path2($path) {
    $path = str_replace('/', '\\', $path);
    if (substr($path, -1) != '\\')
        $path = $path . '\\';
    return $path;
}

/**
 * 创建目录
 *
 * @param	string	$path	路径
 * @param	string	$mode	属性
 * @return	string	如果已经存在则返回true，否则为flase
 */

/**
 * 创建目录
 *
 * @param	string	$path	路径
 * @param	string	$mode	属性
 * @return	string	如果已经存在则返回true，否则为flase
 */
function dir_create($path, $mode = 0777) {
    if (is_dir($path))
        return TRUE;
    $ftp_enable = 0;
    $path = dir_path($path);
    $temp = explode('/', $path);
    $cur_dir = '';
    $max = count($temp) - 1;
    for ($i = 0; $i < $max; $i++) {
        $cur_dir .= $temp[$i] . '/';
        if (@is_dir($cur_dir))
            continue;
        @mkdir($cur_dir, 0777, true);
        @chmod($cur_dir, 0777);
    }
    return is_dir($path);
}

/**
 * 拷贝目录及下面所有文件
 *
 * @param	string	$fromdir	原路径
 * @param	string	$todir		目标路径
 * @return	string	如果目标路径不存在则返回false，否则为true
 */
function dir_copy($fromdir, $todir) {
    $fromdir = dir_path($fromdir);
    $todir = dir_path($todir);
    if (!is_dir($fromdir))
        return FALSE;
    if (!is_dir($todir))
        dir_create($todir);
    $list = glob($fromdir . '*');
    if (!empty($list)) {
        foreach ($list as $v) {
            $path = $todir . basename($v);
            if (is_dir($v)) {
                dir_copy($v, $path);
            } else {
                copy($v, $path);
                @chmod($path, 0777);
            }
        }
    }
    return TRUE;
}

/**
 * 转换目录下面的所有文件编码格式
 *
 * @param	string	$in_charset		原字符集
 * @param	string	$out_charset	目标字符集
 * @param	string	$dir			目录地址
 * @param	string	$fileexts		转换的文件格式
 * @return	string	如果原字符集和目标字符集相同则返回false，否则为true
 */
function dir_iconv($in_charset, $out_charset, $dir, $fileexts = 'php|html|htm|shtml|shtm|js|txt|xml') {
    if ($in_charset == $out_charset)
        return false;
    $list = dir_list($dir);
    foreach ($list as $v) {
        if (preg_match("/\.($fileexts)/i", $v) && is_file($v)) {
            file_put_contents($v, iconv($in_charset, $out_charset, file_get_contents($v)));
        }
    }
    return true;
}

/**
 * 列出目录下所有文件
 *
 * @param	string	$path		路径
 * @param	string	$exts		扩展名
 * @param	array	$list		增加的文件列表
 * @return	array	所有满足条件的文件
 */
function dir_list($path, $exts = '', $list= array()) {
    $path = dir_path($path);
    $files = glob($path . '*');
    foreach ($files as $v) {
        $fileext = fileext($v);
        if (!$exts || preg_match("/\.($exts)/i", $v)) {
            $list[] = $v;
            if (is_dir($v)) {
                $list = dir_list($v, $exts, $list);
            }
        }
    }
    return $list;
}

/**
 * 设置目录下面的所有文件的访问和修改时间
 *
 * @param	string	$path		路径
 * @param	int		$mtime		修改时间
 * @param	int		$atime		访问时间
 * @return	array	不是目录时返回false，否则返回 true
 */
function dir_touch($path, $mtime = TIME, $atime = TIME) {
    if (!is_dir($path))
        return false;
    $path = dir_path($path);
    if (!is_dir($path))
        touch($path, $mtime, $atime);
    $files = glob($path . '*');
    foreach ($files as $v) {
        is_dir($v) ? dir_touch($v, $mtime, $atime) : touch($v, $mtime, $atime);
    }
    return true;
}

/**
 * 目录列表
 *
 * @param	string	$dir		路径
 * @param	int		$parentid	父id
 * @param	array	$dirs		传入的目录
 * @return	array	返回目录列表
 */
function dir_tree($dir, $parentid = 0, $dirs = array()) {
    global $id;
    if ($parentid == 0)
        $id = 0;
    $list = glob($dir . '*');
    foreach ($list as $v) {
        if (is_dir($v)) {
            $id++;
            $dirs[$id] = array('id' => $id, 'parentid' => $parentid, 'name' => basename($v), 'dir' => $v . '/');
            $dirs = dir_tree($v . '/', $id, $dirs);
        }
    }
    return $dirs;
}

/**
 * 删除目录及目录下面的所有文件
 *
 * @param	string	$dir		路径
 * @return	bool	如果成功则返回 TRUE，失败则返回 FALSE
 */
function dir_delete($dir) {
    $dir = dir_path($dir);
    if (!is_dir($dir))
        return FALSE;
    $list = glob($dir . '*');
    foreach ($list as $v) {
        is_dir($v) ? dir_delete($v) : @unlink($v);
    }
    return @rmdir($dir);
}
?>