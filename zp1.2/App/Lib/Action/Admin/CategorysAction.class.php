<?php
/**
 * 分类
 */
class CategorysAction extends CommonAction {
	/**
	 +----------------------------------------------------------
	 * 初始化action
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	function _initialize() {
		//继承
		parent::_initialize();
		
		$mtype=$_REQUEST['mtype']?$_REQUEST['mtype']:'News';
		//分类列表
		$model_name=$this->getActionName();
		$menu_model=D($model_name);
		$list = $menu_model->getListByModule($mtype);
		import('@.ORG.Util.Tree');
		$tree=new Tree($list);
		$list=$tree->getChildList();
		
		$mtype_list=array(
				'News'=>'新闻分类',
				//'Products'=>'产品分类',
				//'Goods'=>'商品分类',
		);
	
		$this->assign('alllist',$list);
		
		$this->assign('mtype',$mtype);
		$this->assign('mtype_list',$mtype_list);
		$this->mtype_list=$mtype_list;
	}
	/**
	 +----------------------------------------------------------
	 * 默认显示首页列表
	 * 可以在action控制器中重载
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	public function index() {
		$mtype=$_REQUEST['mtype']?$_REQUEST['mtype']:'News';
		
		$name=$this->getActionName();
		$model = D ($name);
		foreach($this->mtype_list as $key=>$val){
			$cate_list=array();
			$cate_list = $model->getListByModule($key);
			import("@.ORG.Util.Tree");
			$tree=new Tree($cate_list);
			$cate_list=$tree->getChildList();
			$list[$key]=$cate_list;
		}
		$this->assign('list', $list);
	
		//设置跳转地址
		Cookie::set('_currentUrl_', __SELF__);
		$this->display();
	}
	/**
	 +----------------------------------------------------------
	 * 添加前置
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	public function _before_add() {
		$name=$this->getActionName();
		$model = D ($name);
		$sid = $model->getMaxOrder();
		$this->assign('sid',$sid);
	}
	/**
	 +----------------------------------------------------------
	 * 删除前置
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	public function _before_delete() {
		$id=$_REQUEST['id'];
		$name=$this->getActionName();
		$model = D ($name);
		$haveone=$model->isHavePid($id);
		if($haveone){
			$this->error("存在下级分类，请下删除下级分类");
		}
		
	}
}

?>