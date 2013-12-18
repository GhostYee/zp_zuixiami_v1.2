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
		$works_special=$model->getWorksSpecialList();
				 
		$this->assign('list',$works_special);
		
		//替换模板SEO的值
		$this->seo('专题列表'.'--'.CFG('cfg_webname'),CFG('cfg_seo_keywords'),CFG('cfg_seo_description'));	
		
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
		$special_id=$this->_get('id')?$this->_get('id'):'';//专题ID
		$sort=$this->_get('sort')?$this->_get('sort'):'time';//排序

		//专题详情
		$works_special_model=D('Works_special');		
		$works_special=$works_special_model->getWorksSpecialByID($special_id);
		$this->assign('works_special',$works_special);
		
		
		//作品列表
		$works_model=D('Works');		
		if(is_numeric($special_id)){
			$where['works_special_mid.special_id']=$special_id;
		}
		else{
			$where['works_special.code']=$special_id;
		}
		
		//判断排序
    	switch($sort){
    		case 'time':
    			$orderby=" works.addtime DESC ";
    			break;
    		case 'good':
    			$orderby=" works.good DESC ";
    			break;
    		case 'rank':
    			$orderby=" star DESC ";
    			break;
    		default:
    			$orderby=" works.good DESC ";
    			break;
    	}
    	
    	// 取出需要的数据    	
    	$allinone['where']=$where;
    	$allinone['order']=$orderby;
    	$allinone['join']=array(
    	 			C('DB_PREFIX')."works_special_mid works_special_mid ON works_special_mid.works_id=works.id ",
    	 			C('DB_PREFIX')."works_special works_special ON works_special.id=works_special_mid.special_id"
    	 		);
    	$works  = $works_model->getWorksList($allinone);
    	
    	//总作品数
    	$works_total=count($works);

		$this->assign('workslist',$works);
		$this->assign('works_total',$works_total);
		
		//替换模板SEO的值
		$this->seo($works_special['title'].'--'.CFG('cfg_webname'),CFG('cfg_seo_keywords'),CFG('cfg_seo_description'));
		
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