<?php 
class Website_logAction extends CommonAction {
	
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['title'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['contents'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['adduser'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
	}

    
	// 添加操作
	function add() {
		$data['adduser']=session('loginUserName');
		$this->assign('data', $data);
        $this->assign('module', 'insert');
        
		$this->display('edit');
	}
    
    // 编辑操作
	function edit() {
        $id = $_GET['_URL_'][4];
        
        $db = M('website_log');
        $data = $db->find($id);
        $this->assign('data', $data);
        $this->assign('module', 'update');
        
        $this->display();
	}
	
}