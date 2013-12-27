<?php
// $Id$
//公共函数

// ------------------------------------------------------------------------
/**
 * 读取系统缓存配置
 *
 * @access  public
 * @return  void
 */
function CFG($name='',$file='sysconfig'){
	$prefix=C('SYSCACHE_PREFIX')?C('SYSCACHE_PREFIX'):'cache';
	$filename=$prefix.'_'.$file; //文件名
	if(!file_exists(DATA_PATH.$filename)){
		import('@.ORG.Syscache');
		new Syscache($file);
	}
	$val=F($filename);
	if(empty($name) || $name===NULL){
		return $val;
	}
	return $val[$name];
}
// ------------------------------------------------------------------------
/**
 * xheditor编辑器
 *
 * @access  public
 * @param string $name 名称
 * @param string $content 内容
 * @param intval $rows 行数
 * @param intval $cols 字符宽度
 * @return  void
 */
function xheditor($name,$content='',$rows='10',$cols="100"){
	$uploadurl=CFG('cfg_file_uploadurl');
	$up_link_ext=CFG('cfg_file_uplink_ext')?CFG('cfg_file_uplink_ext'):'zip,rar,txt';
	$up_img_ext=CFG('cfg_file_upimg_ext')?CFG('cfg_file_upimg_ext'):'jpg,jpeg,gif,png';
	$up_flash_ext=CFG('cfg_file_upflash_ext')?CFG('cfg_file_upflash_ext'):'swf';
	$up_media_ext=CFG('cfg_file_upmedia_ext')?CFG('cfg_file_upmedia_ext'):'avi';
	
	$html='<textarea class="editor" name="'.$name.'" rows="'.$rows.'" cols="'.$cols.'"
								upLinkUrl="'.$uploadurl.'" upLinkExt="'.$up_link_ext.'" 
								upImgUrl="'.$uploadurl.'" upImgExt="'.$up_img_ext.'" 
								upFlashUrl="'.$uploadurl.'" upFlashExt="'.$up_flash_ext.'"
								upMediaUrl="'.$uploadurl.'" upMediaExt:"'.$up_media_ext.'">'.$content.'</textarea>';
	return $html;
}
// ------------------------------------------------------------------------
/**
 * editor编辑器
 *
 * @access  public
 * @param string $name 名称
 * @param string $content 内容
 * @param string $width 宽
 * @param string $height 高
 * @param string $editors 编辑器类型
 * @param string $id textarea ID
 * @return  void
 */
function editor($name,$content='',$width="600px",$height="300px",$editors='kindeditor',$id=''){
	if($id){
		$editor=array('id'=>$id,'name'=>$name,'value'=>$content,'minWidth'=>$width,'height'=>$height);
	}
	else{
		$editor=array('id'=>$name,'name'=>$name,'value'=>$content,'minWidth'=>$width,'height'=>$height);
	}
	import('@.ORG.Editors');
	$e=new Editors();
	return $e->getedit($editor,$editors);
}
// ------------------------------------------------------------------------
/*
 * 文件上传入附件库 1.2后弃用
 *
 * @access  public
 * @param string $module 模块名
 * @param string $mid 模块ID
 * @param string $title 标题
 * @param string $allow_type 上传类型 image/flash/media/other/all 默认all
 * @param bool 	 $remove_origin 强制删除原图，优先于系统配置
 * @param bool 	 $not_thumb 强制不生成缩略图 优先于系统配置
 * @return  array/error string
 */
function upload($module='',$mid='',$title='',$allow_type='all',$remove_origin=FALSE,$not_thumb=FALSE){
		//文件后辍类型
		$allow_exts=array();
		switch($allow_type){
			case 'image':
				if(CFG('cfg_file_upimg_ext')) 
					$allow_type=explode(',',CFG('cfg_file_upimg_ext'));
			break;
			case 'flash':
				if(CFG('cfg_file_upflash_ext')) 
					$allow_type=explode(',',CFG('cfg_file_upflash_ext'));
			break;
			case 'media':
				if(CFG('cfg_file_upmedia_ext')) 
					$allow_type=explode(',',CFG('cfg_file_upmedia_ext'));
			break;
			case 'other':
				if(CFG('cfg_file_uplink_ext')) 
					$allow_type=explode(',',CFG('cfg_file_uplink_ext'));
			break;
			case 'all':
				if(CFG('cfg_file_upimg_ext')) $cfg_file_upimg_ext=explode(',',CFG('cfg_file_upimg_ext'));
				if(CFG('cfg_file_upflash_ext')) $cfg_file_upflash_ext=explode(',',CFG('cfg_file_upflash_ext'));
				if(CFG('cfg_file_upmedia_ext')) $cfg_file_upmedia_ext=explode(',',CFG('cfg_file_upmedia_ext'));
				if(CFG('cfg_file_uplink_ext')) $cfg_file_uplink_ext=explode(',',CFG('cfg_file_uplink_ext'));
				$allow_exts=array_merge($cfg_file_upimg_ext,$cfg_file_upflash_ext,$cfg_file_upmedia_ext,$cfg_file_uplink_ext);
				break;
		}
		//
		import('@.ORG.Net.UploadFile');
        //导入上传类
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize            = CFG('cfg_file_maxsize')*1024;
        //设置上传文件类型
        $upload->allowExts          = $allow_exts;
        //设置附件上传目录
        $upload->savePath           = CFG('cfg_file_save_path').'/';
        //设置需要生成缩略图，仅对图像文件有效
		if($not_thumb===TRUE){
        	$upload->thumbRemoveOrigin  = FALSE;
        }
		else if(CFG('cfg_file_is_thumb')==1){
        	$upload->thumb              = true;
		}
		else if(CFG('cfg_file_is_thumb')==0){
        	$upload->thumb              = FALSE;
		}
        // 设置引用图片类库包路径
        $upload->imageClassPath     = '@.ORG.Util.Image';
        //设置缩略图保存目录
        $upload->thumbPath        = CFG('cfg_file_save_path').'/'.CFG('cfg_file_thumb_save_path').'/';
        //设置需要生成缩略图的文件后缀
        $upload->thumbPrefix        = CFG('cfg_file_thumb_prefix');  //生产2张缩略图
        //设置缩略图最大宽度
        $upload->thumbMaxWidth      = CFG('cfg_file_thumb_max_width');
        //设置缩略图最大高度
        $upload->thumbMaxHeight     = CFG('cfg_file_thumb_max_height');
        
        //设置上传文件规则
        $upload->saveRule           = 'uniqid';
        //删除原图
        if($remove_origin===true){
        	$upload->thumbRemoveOrigin  = true;
        }
		else if(CFG('cfg_file_thumb_remove_origin')=='1'){
        	$upload->thumbRemoveOrigin  = true;
		}
		//是否使用子目录保存上传文件
		$upload->autoSub			=true;
		//子目录创建方式，默认为hash，可以设置为hash或者date
		$upload->subType			='date';
        if (!$upload->upload()) {
            //捕获上传异常
            return $upload->getErrorMsg();
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();
            
            $thumb=@explode(',', CFG('cfg_file_thumb_prefix'));         	
            $num=count($thumb);
			foreach($uploadList as $key=>$val){
				$uploadList[$key]['fileurl']=$val['savepath'].$val['savename'];
				//缩略图地址
				if($num>0){
					for($i=0;$i<$num;$i++){
						$uploadList[$key]['thumburl_'.$i]=$upload->thumbPath.date("Ymd").'/'.$thumb[$i].$val['filename'];
					}
				}
				$model=D('Uploads');
				$uploads_arr['module']=$module;
				$uploads_arr['mid']=$mid;
				$uploads_arr['title']=empty($title)?$uploadList[$key]['name']:$title;
				$uploads_arr['url']=$uploadList[$key]['fileurl'];
				$uploads_arr['mediatype']=$uploadList[$key]['type'];
				$uploads_arr['filesize']=$uploadList[$key]['size'];
				$uploads_arr['extension']=$uploadList[$key]['extension'];
				if(!empty($uploadList[$key]['thumburl_0'])){
				$uploads_arr['thumburl_0']=$uploadList[$key]['thumburl_0'];
				}
				if(!empty($uploadList[$key]['thumburl_1'])){
				$uploads_arr['thumburl_1']=$uploadList[$key]['thumburl_1'];
				}
				$uploads_arr['addtime']=time();
				$model->add($uploads_arr);
			}
			//判断是否开启水印
			if(CFG('cfg_water_open')=='1'){
	            import('@.ORG.Util.Image');
	            foreach($uploadList as $key=>$val){
		            //原图片加水印
		            if(CFG('cfg_file_thumb_remove_origin')!='1'){
		            	$kk=Image::water($val['fileurl'],CFG('cfg_water_image_url'),null,CFG('cfg_water_image_alpha'));
		            }
		            //给缩略图添加水印,
		            if($num>0){
		            	for($i=0;$i<$num;$i++){
		            		Image::water($val['thumburl_'.$i], CFG('cfg_water_image_url'),null,CFG('cfg_water_image_alpha'));
		            	}
		            }
	            }
	           
	            
			}
			return $uploadList;
        }
}
// ------------------------------------------------------------------------
/**
 * 加密解密函数
 *
 * @access  public
 * @param string $string 模块名
 * @param string $operation DECODE表示解密,其它表示加密
 * @param string $key 密匙
 * @param string $expiry 密文有效期
 * @example authcode($str, 'ENCODE'); //加密
 * @example authcode($str, 'DECODE'); //解密
 * @return  array/error string
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	global $CFG;
	// 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙 取值 0-32;
	$ckey_length = 4;

	// 密匙
	$key = md5($key ? $key : $CFG[api_crypt]);

	// 密匙a会参与加解密
	$keya = md5(substr($key, 0, 16));
	// 密匙b会用来做数据完整性验证
	$keyb = md5(substr($key, 16, 16));
	// 密匙c用于变化生成的密文
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	// 参与运算的密匙
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	// 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
	// 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = array();
	// 产生密匙簿
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}
	// 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	// 核心加解密部分
	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		// 从密匙簿得出密匙进行异或，再转成字符
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if($operation == 'DECODE') {
		// substr($result, 0, 10) == 0 验证数据有效性
		// substr($result, 0, 10) - time() > 0 验证数据有效性
		// substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
		// 验证数据有效性，请看未加密明文的格式
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		// 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
		// 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}
// ------------------------------------------------------------------------
/**
 * 多维对像转多维数组
 *
 * @access  public
 * @return string
 */
function objectToArray($d) {
	if (is_object($d)) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars($d); //将第一层对象转换为数组
	}

	if (is_array($d)) {
		/*
		 * Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map(__FUNCTION__, $d);//如果是数组使用array_map递归调用自身处理数组元素
	}
	else {
		// Return array
		return $d;
	}
}
// ------------------------------------------------------------------------
/**
 * 多维数组转多维对像
 *
 * @access  public
 * @return string
 */
function arrayToObject($d) {
	if (is_array($d)) {
		/*
		 * Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return (object) array_map(__FUNCTION__, $d);
	}
	else {
		// Return object
		return $d;
	}
}

// ------------------------------------------------------------------------

/**
 * 
 * 在URL中没有http://的情况下,这个函数可以附加上.
 * Prep URL
 *
 * Simply adds the http:// part if no scheme is included
 *
 * @access	public
 * @param	string	the URL
 * @return	string
 */
	function prep_url($str = '')
	{

		if ($str == 'http://' OR $str == '')
		{
			return '';
		}

		/**
		 * 站内相对路径不需要加http://
		 * 测试：
		 * var_export(array(
		 * prep_url(''),             
		 * prep_url('http://'),      
		 * prep_url('http://a.com/'),
		 * prep_url('a.com'),        
		 * prep_url('a.com/'),       
		 * prep_url('../images/'),   
		 * prep_url('./images/'),    
		 * prep_url('/images/'),     
		 * prep_url('images/')       
		 * ));
		 */
		if (preg_match("/^\/|^\.|^[^\.\/]+(\/|$)/i", $str))
		{
			return $str;
		}

		$url = parse_url($str);

		if ( ! $url OR ! isset($url['scheme']))
		{

			$str = 'http://'.$str;
		}		
		return $str;
	}
// ------------------------------------------------------------------------
/**
     * 整数时间转时间格式
     *
     * @access  public
     * @param   int    $time 整数形时间
     * @param   string $mtype 类型 time or date
     * @return  date
     */
    function inttodate($time,$mtype = 'time'){    	
    	if($time==0 || $time==''){
    		$times='';
    	}
    	else {
	    	if($mtype=='date'){
	    		$times=date("Y-m-d",$time);
	    	}
	    	else if($mtype=='time'){
	    		$times=date("Y-m-d H:i:s",$time);
	    	}
	    	else{
	    		$times=date($mtype,$time);
	    	}
    	}
    	return $times;
    }
	/**
 * 递归方式的对变量中的特殊字符进行转义
 *
 * @access  public
 * @param   mix     $value
 *
 * @return  mix
 */
function addslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
    }
}

/**
 * 将对象成员变量或者数组的特殊字符进行转义
 *
 * @access   public
 * @param    mix        $obj      对象或者数组
 * @author   Xuan Yan
 *
 * @return   mix                  对象或者数组
 */
function addslashes_deep_obj($obj)
{
    if (is_object($obj) == true)
    {
        foreach ($obj AS $key => $val)
        {
            $obj->$key = addslashes_deep($val);
        }
    }
    else
    {
        $obj = addslashes_deep($obj);
    }

    return $obj;
}

/**
 * 递归方式的对变量中的特殊字符去除转义
 *
 * @access  public
 * @param   mix     $value
 *
 * @return  mix
 */
function stripslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
    }
}
// ------------------------------------------------------------------------
?>