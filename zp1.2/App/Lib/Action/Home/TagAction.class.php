<?php
//Tag标签
class TagAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index()
    {
    	$tag_model=D("Tag");
    	$tags=$tag_model->getTagList();
    	$this->assign("list",$tags);
		
		//替换模板SEO的值
		$this->seo('Tag标签'.'--'.CFG('cfg_webname'),CFG('cfg_seo_keywords'),CFG('cfg_seo_description'));
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 标签作品列表
     *
     * @access  public
     * @return  void
     */
    public function view()
    {
    	$tagid=$this->_get('id')?intval($this->_get('id')):'0';
    	
    	//标签作品列表
    	$works_model=D('Works');
    	$works  = $works_model->getWorksByTagID($tagid);
    	$this->assign('works',$works);
    	
    	//标签名
    	$tag_model=D("Tag");
    	$tag=$tag_model->getTagByID($tagid);
    	$this->assign('tag',$tag);
    	
    	//标签列表
    	$tags  = $tag_model->getIndexTags('10');
    	$this->assign('tags',$tags);
    	
    	//排行榜列表
    	$rankList  = $works_model->getWorksGoodRanking(5);
    	$this->assign('rankList',$rankList);
    	
    	//搜索词当前页标记
    	$currPage="tag";
    	$this->assign('currPage',$currPage);
		
		//替换模板SEO的值
		$this->seo($tag['tagname'].' Tag标签'.'--'.CFG('cfg_webname'),CFG('cfg_seo_keywords'),CFG('cfg_seo_description'));
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
}