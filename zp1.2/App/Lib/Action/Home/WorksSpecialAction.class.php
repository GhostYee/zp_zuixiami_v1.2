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
		$sort=$this->_get('sort')?$this->_get('sort'):'time';
		
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
    	switch($sort){
    		case 'time':
    			$orderby=" ORDER BY w.addtime DESC ";
    			break;
    		case 'good':
    			$orderby=" ORDER BY w.addtime DESC ";
    			break;
    		case 'rank':
    			$orderby=" ORDER BY star DESC ";
    			break;
    		default:
    			$orderby=" ORDER BY w.good DESC ";
    			break;
    		
    	}
    	
    	// 取出需要的数据
    	$sql	= "SELECT w.*,ceil(w.rank_total/w.rank_count) as star,round(ceil(w.rank_total/w.rank_count)/10,1) rank ,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id author_id FROM ".C('DB_PREFIX')."works w ".
    			" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
    			" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
    			" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
    			" LEFT JOIN ".C('DB_PREFIX')."works_special_mid special_mid ON special_mid.works_id=w.id ".
    			" LEFT JOIN ".C('DB_PREFIX')."works_special special ON special.id=special_mid.special_id ".
    			" where 1 $where $orderby ";
    	$works	= $works_model->query($sql);
    	
    	$works_total=count($works);

		$this->assign('works',$works);
		$this->assign('works_total',$works_total);
		
		$this->display();
	}
	// ------------------------------------------------------------------------
	/**
	 * 留言页
	 *
	 * @access  public
	 * @return  void
	 */
	public function message(){
		$this->display();
	}
    // ------------------------------------------------------------------------
}