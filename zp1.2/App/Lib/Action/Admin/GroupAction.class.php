<?php
/**
 * 菜单/分组模块
 */
class GroupAction extends CommonAction {
	function _filter(&$map) {
        $map['title'] = array('like', "%" . $_POST['keyword'] . "%");
        $map['name'] = array('like', "%" . $_POST['keyword'] . "%");
        $map['_logic'] = 'or';
    }

    /**
      +----------------------------------------------------------
     * 默认排序操作
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     * @throws FcsException
      +----------------------------------------------------------
     */
    public function sort() {
        $node = M('Group');
        if (!empty($_GET['sortId'])) {
            $map = array();
            $map['status'] = 1;
            $map['show'] = 1;
            $map['id'] = array('in', $_GET['sortId']);
            $sortList = $node->where($map)->order('sort asc')->select();
        } else {
            $sortList = $node->where('status=1 and `show`=1')->order('sort asc')->select();
        }
        $this->assign("sortList", $sortList);
        $this->display();
        return;
    }    
}
?>