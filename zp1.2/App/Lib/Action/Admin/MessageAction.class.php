<?php 
class MessageAction extends CommonAction {
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['qq'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['content'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
	}	
}