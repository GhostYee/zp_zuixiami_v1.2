<?php 
class MessageAction extends CommonAction {
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
		parent::_initialize();
		
		$module_list=array(
				'Works'=>'作品评论',		
				'Author'=>'作者留言',
				'WorksSpecial'=>'专题评论',
				'Team'=>'团队评论',
				'Message'=>'留言建议',
		);
		$this->assign('module_list',$module_list);
		
		$status_list=array(
				'1'=>'显示',
				'2'=>'用户隐藏',
				'3'=>'管理员隐藏',
				'4'=>'回收站(用户删除)',
		);
		$this->assign('status_list',$status_list);
	}
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['qq'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['content'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
	}
}