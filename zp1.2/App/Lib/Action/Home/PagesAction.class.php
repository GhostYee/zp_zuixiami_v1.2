<?php
//单页
class PagesAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	
    	//替换模板SEO的值
    	$seo['title']='最蝦米*鬼懿IT*作品秀';
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 单页查看页
     *
     * @access  public
     * @return  void
     */
	public function view(){
		$page=$this->_get('id')?$this->_get('id'):'about';
		$model = D ('pages');
		if(is_numeric($page)){
			$model->where("`id`='$page'");
		}
		else{
			$model->where("`code`='$page'");
		}
		$pages=$model->find();
		$this->assign('pages',$pages);
		$this->assign('id',$page);
		
		//替换模板SEO的值
		$seo['title']='最蝦米*鬼懿IT*作品秀';
		$seo['keywords']=C("CFG_SEO_KEYWORDS");
		$seo['description']=C("CFG_SEO_DESCRIPTION");
		$this->assign('seo',$seo);
		$this->display();
	}
    // ------------------------------------------------------------------------
}