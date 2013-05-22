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
    	$works_model=D('works');
    	
    	$orderby=" ORDER BY star desc ";
    	
    	$limit=" limit 20 ";
		
    	// 取出需要的数据
    	$sql	= "SELECT w.*,ceil(w.rank_total/w.rank_count) as star,round(ceil(w.rank_total/w.rank_count)/10,1) rank ,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id author_id ".
				" FROM ".C('DB_PREFIX')."works w ".
    			" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
    			" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
    			" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
    			" where 1 $where $orderby $limit";
    	$works	= $works_model->query($sql);
    	
    	$this->assign('works',$works);	
    	
    	//替换模板SEO的值
    	$seo['title']='最蝦米*鬼懿IT*作品秀';
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);

    	$this->display();
    }
    // ------------------------------------------------------------------------
}