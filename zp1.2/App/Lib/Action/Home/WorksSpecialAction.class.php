<?php
//作品专题
class WorksSpecialAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 列表
	 *
	 * @access  public
	 * @return  void
	 */
	public function index(){
		$model=D('Works_special');
		$works_special=$model->order('id desc')->select();
		 
		$this->assign('list',$works_special);
		
		//替换模板SEO的值
		$seo['title']='最蝦米*鬼懿IT*作品秀';
		$seo['keywords']=C("CFG_SEO_KEYWORDS");
		$seo['description']=C("CFG_SEO_DESCRIPTION");
		$this->assign('seo',$seo);
		
		$this->display();
	}
	// ------------------------------------------------------------------------
	/**
	 * 查看页
	 *
	 * @access  public
	 * @return  void
	 */
	public function view(){		
		$special_id=$this->_get('id')?$this->_get('id'):'';
		
		$works_special_model=D('works_special');
		if(is_numeric($special_id)){
			$map['id']=$special_id;
		}
		else{
			$map['code']=$special_id;
		}
		$works_special=$works_special_model->where($map)->select();
		$this->assign('works_special',$works_special[0]);
		
		$works_model=D('works');
		
		if(is_numeric($special_id)){
			$where.=" AND special_mid.special_id='$special_id' ";
		}
		else{
			$where.=" AND special.code='$special_id' ";
		}
		
		//判断排序
    	$index_works_order=CFG('cfg_index_works_order');
    	
    	if($index_works_order){
    		$orderby=" ORDER BY $index_works_order ";
    	}
    	else{
    		//排序推荐 降序，推荐排序降序，ID 升序
    		$orderby=" ORDER BY w.is_top DESC,w.top_sid DESC,w.id DESC ";
    	}
    	
    	// 取出需要的数据
    	$sql	= "SELECT w.*,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id author_id FROM ".C('DB_PREFIX')."works w ".
    			" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
    			" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
    			" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
    			" LEFT JOIN ".C('DB_PREFIX')."works_special_mid special_mid ON special_mid.works_id=w.id ".
    			" LEFT JOIN ".C('DB_PREFIX')."works_special special ON special.id=special_mid.special_id ".
    			" where 1 $where $orderby ";
    	$works	= $works_model->query($sql);

		$this->assign('works',$works);
		
		$this->display();
	}
    // ------------------------------------------------------------------------
}