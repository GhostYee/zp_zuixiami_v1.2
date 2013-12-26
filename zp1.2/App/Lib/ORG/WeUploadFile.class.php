<?php
/**
 * 当前系统文件上传类
 * @author    wewe
 */
class WeUploadFile {//类定义开始

    private $config =   array(
        'allow_type'           => 'all',    // 上传类型 image/flash/media/other/all 默认all
		'remove_origin'		   => FALSE,    //强制删除原图，优先于系统配置
    	'not_thumb'		   		=> FALSE,    //强制不生成缩略图 优先于系统配置
    );

    // 错误信息
    private $error = '';
    // 上传成功的文件信息
    private $uploadFileInfo ;

    public function __get($name){
        if(isset($this->config[$name])) {
            return $this->config[$name];
        }
        return null;
    }

    public function __set($name,$value){
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }

    public function __isset($name){
        return isset($this->config[$name]);
    }
    
    /**
     * 架构函数
     * @access public
     * @param array $config  上传参数
     */
    public function __construct($config=array()) {
        if(is_array($config)) {
            $this->config   =   array_merge($this->config,$config);
        }
    }
	
    // ------------------------------------------------------------------------
    /**
     * 文件上传入附件库
     *
     * @access  public
     * @param string/array $module 模块名或者全集
     * @param string $mid 模块ID
     * @param string $title 标题
     * @return  array/error string
     */
    function upload($module='',$mid='',$title='',$is_thumb='0',$status=''){
    	if(is_array($module)){    		
    		$mid=$module['mid'];
    		$title=$module['title'];
    		$is_thumb=$module['is_thumb'];
    		$status=$module['status'];
    		$module=$module['module'];
    	}
    	
    	//文件后辍类型
    	$allow_exts=array();
    	switch(strtolower($this->allow_type)){
    		case 'image':
    			if(CFG('cfg_file_upimg_ext'))
    				$allow_exts=explode(',',CFG('cfg_file_upimg_ext'));
    			$save_mid_path='images';
    			break;
    		case 'flash':
    			if(CFG('cfg_file_upflash_ext'))
    				$allow_exts=explode(',',CFG('cfg_file_upflash_ext'));
    			$save_mid_path='flash';
    			break;
    		case 'media':
    			if(CFG('cfg_file_upmedia_ext'))
    				$allow_exts=explode(',',CFG('cfg_file_upmedia_ext'));
    			$save_mid_path='media';
    			break;
    		case 'other':
    			if(CFG('cfg_file_uplink_ext'))
    				$allow_exts=explode(',',CFG('cfg_file_uplink_ext'));
    			$save_mid_path='other';
    			break;
    		case 'all':
    			if(CFG('cfg_file_upimg_ext')) $cfg_file_upimg_ext=explode(',',CFG('cfg_file_upimg_ext'));
    			if(CFG('cfg_file_upflash_ext')) $cfg_file_upflash_ext=explode(',',CFG('cfg_file_upflash_ext'));
    			if(CFG('cfg_file_upmedia_ext')) $cfg_file_upmedia_ext=explode(',',CFG('cfg_file_upmedia_ext'));
    			if(CFG('cfg_file_uplink_ext')) $cfg_file_uplink_ext=explode(',',CFG('cfg_file_uplink_ext'));
    
    			$allow_exts=array_merge($cfg_file_upimg_ext,$cfg_file_upflash_ext,$cfg_file_upmedia_ext,$cfg_file_uplink_ext);
    			$save_mid_path='all';
    			break;
    	}
    	//导入上传类
    	import('@.ORG.Net.UploadFile');    	
    	$upload = new UploadFile();
    	//设置上传文件大小 ,M以上
    	$upload->maxSize            = CFG('cfg_file_maxsize')*1024;
    	//设置上传文件类型
    	$upload->allowExts          = $allow_exts;
    	//设置附件上传目录
    	$upload->savePath           = CFG('cfg_file_save_path').'/'.$save_mid_path.'/';
    	//设置需要生成缩略图，仅对图像文件有效
    	if($this->not_thumb===TRUE){
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
    	$upload->thumbPath        = CFG('cfg_file_save_path').'/'.$save_mid_path.'_'.CFG('cfg_file_thumb_save_path').'/';
    	//设置需要生成缩略图的文件后缀
    	$upload->thumbPrefix        = CFG('cfg_file_thumb_prefix');  //生成2张缩略图
    	//设置缩略图最大宽度
    	$upload->thumbMaxWidth      = CFG('cfg_file_thumb_max_width');
    	//设置缩略图最大高度
    	$upload->thumbMaxHeight     = CFG('cfg_file_thumb_max_height');
    
    	//设置上传文件规则
    	$upload->saveRule           = 'uniqid';
    	//删除原图
    	if($this->remove_origin===true){
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
    		$this->error=$upload->getErrorMsg();
    		return false;
    	} else {
    		//取得成功上传的文件信息
    		$uploadList = $upload->getUploadFileInfo();
    
    		$thumb=@explode(',', CFG('cfg_file_thumb_prefix'));
    		$num=count($thumb);
    		$ids=array();
    		$isUpload   = false;
    		foreach($uploadList as $key=>$val){
    			$uploads_arr=array();
    			$res='';
    			$uploadList[$key]['fileurl']=$val['savepath'].$val['savename'];
    			$model=D('Uploads');
    			$uploads_arr['module']=$module;
    			$uploads_arr['mid']=$mid;
    			$uploads_arr['title']=empty($title)?$uploadList[$key]['name']:$title;
    			$uploads_arr['filename']=$val['filename'];
    			$uploads_arr['fileurl']=$uploadList[$key]['fileurl'];
    			$uploads_arr['mediatype']=$uploadList[$key]['type'];
    			$uploads_arr['filesize']=$uploadList[$key]['size'];
    			$uploads_arr['extension']=$uploadList[$key]['extension'];
    			$uploads_arr['thumbpath']=$upload->thumbPath.date("Ymd").'/';
    			//组合缩略图地址
    			if($num>0){
    				for($i=0;$i<$num;$i++){
    					$uploads_arr['thumburl_'.$i]=$uploads_arr['thumbpath'].$thumb[$i].$val['filename'];
    				}
    			}
    			$uploads_arr['is_thumb']=$is_thumb;
    			$uploads_arr['userid']=session('xiami_userid');
    			$uploads_arr['addtime']=time();
    			$uploads_arr['status']=$status;
    			$res=$model->add($uploads_arr);
    			array_push($ids,$res);//ID组合
    			$uploads_arr['id']=$res;
    			//$uploadList[$key]=$uploads_arr;
    			$uploadList[$key]=array_merge($val,$uploads_arr);//合并数据库及原文件信息
    			$isUpload   = true;
    		}
    		if(isset($ids)) $ids=implode(",",$ids);
    		$uploadList['ids']=$ids;//ID集合，逗号分开
    
    		//判断是否开启水印
    		if(CFG('cfg_water_open')=='1'){
    			import('@.ORG.Util.Image');
    			foreach($uploadList as $key=>$val){
    				//原图片加水印
    				if(CFG('cfg_file_thumb_remove_origin')!='1'){
    					$kk=Image::water($val['url'],CFG('cfg_water_image_url'),null,CFG('cfg_water_image_alpha'));
    				}
    				//给缩略图添加水印,
    				if($num>0){
    					for($i=0;$i<$num;$i++){
    						Image::water($val['thumbpath'].$thumb[$i].$val['filename'], CFG('cfg_water_image_url'),null,CFG('cfg_water_image_alpha'));
    					}
    				}
    			}
    		}
    		if($isUpload) {
    			$this->uploadFileInfo=$uploadList;
    			return true;
    		}else {
    			$this->error  =  '没有上传文件';
    			return false;
    		}
    	}
    
    }
    
    /**
     * 取得上传文件的信息
     * @access public
     * @return array
     */
    public function getUploadFileInfo() {
    	return $this->uploadFileInfo;
    }

    /**
     * 取得最后一次错误信息
     * @access public
     * @return string
     */
    public function getErrorMsg() {
        return $this->error;
    }
}