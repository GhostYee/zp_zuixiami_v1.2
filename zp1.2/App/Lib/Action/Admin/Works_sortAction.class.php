<?php 
class Works_sortAction extends CommonAction {
	
	public function index() {
        
        $db = M('works_sort');
        
        $data = $db->order('orders')->select();
        
        $list = $this->_totree($data);

        $this->assign('list', $list);
        $this->display();
        
	}
    
    private function _totree($list, $root = 0, $pk = 'id', $pid = 'pid', $child = 'child') {
        $tree = array();
        if(is_array($list)) {
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }
    
    // 添加操作
	public function add() {
        $db = M('works_sort');
        $sort = $db->order('orders')->where('pid=0')->select();
        $this->assign('sort', $sort);
        
        $this->assign('module', 'addone');
		$this->display('edit');
	}
    
    // 编辑操作
	public function edit() {
        $id = $_GET['_URL_'][4];
        
        $db = M('works_sort');
        $data = $db->find($id);
        
        $sort = $db->order('orders')->where('pid=0')->select();
        
        $this->assign('data', $data);
        $this->assign('sort', $sort);
        $this->assign('module', 'update');
        
        $this->display();
	}
	
    public function addone() {
        $pid = $this->_post('pid');
        $_POST['layer'] = !empty($pid) ? 2 : 1;
        $this->insert();
    }
}