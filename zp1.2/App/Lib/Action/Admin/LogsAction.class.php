<?php
/**
 * 通用日志管理
 */
class LogsAction extends CommonAction {
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
	}
	public function _filter(&$map) {
		if(!empty($_POST['keywords'])){
			$where['module'] = array('like', "%" . $_POST['keywords'] . "%");
			$where['status'] = array('like', "%" . $_POST['keywords'] . "%");
			$where['notice'] = array('like', "%" . $_POST['keywords'] . "%");
			$where['_logic'] = 'or';
		}
		if($where){
			$map['_complex'] = $where;
		}
		if(!empty($_POST['lang_code'])){
			$map['lang']=$_POST['lang_code'];
		}
	}
}

?>