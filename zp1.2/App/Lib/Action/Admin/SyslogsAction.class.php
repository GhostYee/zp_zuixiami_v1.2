<?php
/**
 * 系统日志模块
 */
class SyslogsAction extends CommonAction {
	function _filter(&$map) {
        $map['modulename'] = array('like', "%" . $_POST['keyword'] . "%");
        $map['actionname'] = array('like', "%" . $_POST['keyword'] . "%");
        $map['opname'] = array('like', "%" . $_POST['keyword'] . "%");
        $map['message'] = array('like', "%" . $_POST['keyword'] . "%");
        $map['username'] = array('like', "%" . $_POST['keyword'] . "%");
        $map['userid'] = array('like', "%" . $_POST['keyword'] . "%");
        $map['userip'] = array('like', "%" . $_POST['keyword'] . "%");
        $map['_logic'] = 'or';
    }

    

    

    /**
      +----------------------------------------------------------
     * 默认删除操作
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    public function delete() {
        //删除指定记录
        $name = $this->getActionName();
        $model = M($name);
        if (!empty($model)) {
            $pk = $model->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $model->where($condition)->setField('status', - 1);
                if ($list !== false) {
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }
}

?>