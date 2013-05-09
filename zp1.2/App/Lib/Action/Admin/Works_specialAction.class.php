<?php
/**
 * 作品专题管理
 */
class Works_specialAction extends CommonAction {
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['title'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['qishu'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['notice'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['adduser'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
	}
    
    /**
     +----------------------------------------------------------
     * 添加
     +----------------------------------------------------------
     */
    public function add() {		
    	$this->assign('acturl', 'insert');

    	$this->display('edit');
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
	// ------------------------------------------------------------------------
}
?>