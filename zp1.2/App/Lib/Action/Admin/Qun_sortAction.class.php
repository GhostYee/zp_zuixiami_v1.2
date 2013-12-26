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
}

?>