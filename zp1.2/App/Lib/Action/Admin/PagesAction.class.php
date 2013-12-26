<?php
/**
 * 单页管理
 */
class PagesAction extends CommonAction {
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['title'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['code'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['contents'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['adduser'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
	}
	// ------------------------------------------------------------------------
}
?>