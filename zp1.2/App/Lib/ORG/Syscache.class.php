<?php
/****************************************************
 * 生成系统缓存
 ***************************************************/

class Syscache {
	//文件名
	var $filename;
	//文件名前辍
	var $prefix='cache_';

    /**
     * 初始化
     * @access public
     * @return string
     */
     function __construct($filename) {
         if(C('SYSCACHE_PREFIX')) 
		 	$this->prefix=C('SYSCACHE_PREFIX').'_';
		 
		 if(is_array($filename)){
			 foreach($filename as $val){
				$this->$val();
			 }
		 }
		 else{
		 	$this->$filename();
		 }
     }

    /**
     * 生成系统配置
     */
    public function sysconfig() {
    	$config=D('config');
    	$configList = $config->select();	
		foreach($configList as $val){
			$data[$val['code']]=$val['value'];
		}
		F($this->prefix.'sysconfig',$data);
	}
}