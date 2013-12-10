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
 * 文件上传入附件库
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
// ------------------------------------------------------------------------
?>