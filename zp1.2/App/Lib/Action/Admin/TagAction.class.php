<?php
/**
 * 标签管理 
 */
class TagAction extends CommonAction {
	/**
	    +----------------------------------------------------------
	    * 查询关键字
	    +----------------------------------------------------------
	    */
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['tagname'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
	}
}
