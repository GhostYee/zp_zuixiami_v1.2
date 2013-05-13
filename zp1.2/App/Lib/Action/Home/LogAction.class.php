<?php
//网站更新日志
class LogAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	$model=D('website_log');
    	$website_log=$model->order('id desc')->select();
    	
    	$this->assign('website_log',$website_log);
    	
    	//替换模板SEO的值
    	$seo['title']='最蝦米*鬼懿IT*作品秀';
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
}