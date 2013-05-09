<?php
/**
 * 成员分类
 */
class Qun_sortAction extends CommonAction {
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['name'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
	}
	/**
      +----------------------------------------------------------
     * 显示添加页
      +----------------------------------------------------------
     */
	public function add() {
		$this->assign('acturl','insert');
		$this->display ('edit');
	}
	/**
	 +----------------------------------------------------------
	 * 显示编辑页
	 +----------------------------------------------------------
	 */
	public function edit() {
		$name=$this->getActionName();
		$model = M ( $name );
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById ( $id );
		$this->assign ( 'vo', $vo );
		
		$this->assign('acturl','update');
		
		$this->display ();
	}
}

?>