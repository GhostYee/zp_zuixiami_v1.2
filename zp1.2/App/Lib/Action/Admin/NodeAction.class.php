<?php
/**
 * 节点模块
 */
class NodeAction extends CommonAction {

    public function _filter(&$map) {
        if (!empty($_GET['group_id'])) {
            $map['group_id'] = $_GET['group_id'];
            $this->assign('nodeName', '分组');
        } elseif (empty($_POST['search']) && !isset($map['pid'])) {
            $map['pid'] = 0;
        }
		if(!empty($_POST['keyword'])){
			$map['title'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['name'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
        if ($_REQUEST['pid'] != '') {
            $map['pid'] = $_REQUEST['pid'];
        }
        session('currentNodeId',$map['pid']);
        //获取上级节点
        $node = M("Node");
        if (isset($map['pid'])) {
            if ($node->getById($map['pid'])) {
                $this->assign('level', $node->level + 1);
                $this->assign('nodeName', $node->name);
                $this->assign('rebackid', $node->pid);
                $this->assign('currentid', $_REQUEST['pid']);
            } else {
                $this->assign('level', 1);
                $this->assign('rebackid', 0);
            }
        }
    }

    public function _before_index() {
        $model = M("Group");
        $list = $model->where('status=1')->getField('id,title');
        $this->assign('groupList', $list);
    }

    // 获取配置类型
    public function _before_add() {
        $model = M("Group");
        $list = $model->where('status=1')->select();
        $this->assign('list', $list);
        $node = M("Node");
        $node->getById(session('currentNodeId'));
        $this->assign('pid', $node->id);
        $this->assign('level', $node->level + 1);
    }

    public function _before_patch() {
        $model = M("Group");
        $list = $model->where('status=1')->select();
        $this->assign('list', $list);
        $node = M("Node");
        $node->getById(session('currentNodeId'));
        $this->assign('pid', $node->id);
        $this->assign('level', $node->level + 1);
    }

    public function _before_edit() {
        $model = M("Group");
        $list = $model->where('status=1')->select();
        $this->assign('list', $list);
    }

    /**
      +----------------------------------------------------------
     * 默认排序操作
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     */
    public function sort() {
        $node = M('Node');
        if (!empty($_GET['sortId'])) {
            $map = array();
            $map['status'] = 1;
            $map['id'] = array('in', $_GET['sortId']);
            $sortList = $node->where($map)->order('sort asc')->select();
        } else {
            if (!empty($_GET['pid'])) {
                $pid = $_GET['pid'];
            } else {
                $pid = session('currentNodeId');
            }
            if ($node->getById($pid)) {
                $level = $node->level + 1;
            } else {
                $level = 1;
            }
            $this->assign('level', $level);
            $sortList = $node->where('status=1 and pid=' . $pid . ' and level=' . $level)->order('sort asc')->select();
        }
        $this->assign("sortList", $sortList);
        $this->display();
        return;
    }
}

?>