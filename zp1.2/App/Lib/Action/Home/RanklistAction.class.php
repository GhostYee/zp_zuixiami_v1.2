<?php
//热度排行榜
class RanklistAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	$works_model=D('Works');
    	
    	$orderby="star desc";
    	
    	$limit="20";
		
    	// 取出需要的数据
    	$allinone['where']=$where;
    	$allinone['order']=$orderby;
    	$allinone['limit']=$limit;
    	$works  = $works_model->getWorksList($allinone);    	
    	$this->assign('works',$works);	
    	
    	//替换模板SEO的值
    	$seo['title']='热度排行榜'.'--'.CFG('cfg_webname');
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);

    	$this->display();
    }
    // ------------------------------------------------------------------------
}