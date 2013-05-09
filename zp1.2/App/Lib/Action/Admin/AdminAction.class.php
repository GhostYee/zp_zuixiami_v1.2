<?php
/**
 * 后台用户模块
 */
class AdminAction extends CommonAction {
    private $mname = '系统管理';
    private $aname = '用户管理';
    function _filter(&$map) {
        $map['id'] = array('egt', 2);
        $map['account'] = array('like', "%" . $_POST['account'] . "%");
    }
	    
 // 检查帐号
    public function checkAccount() {
        if (!preg_match('/^[a-z]\w{4,}$/i', $_POST['account'])) {
            $this->error('用户名必须是字母，且5位以上！');
        }
        $Admin = M("Admin");
        // 检测用户名是否冲突
        $name = $_REQUEST['account'];
        $result = $Admin->getByAccount($name);
        if ($result) {
            $this->error('该用户名已经存在！');
        } else {
            $this->success('该用户名可以使用！');
        }
    }


    //重置密码
    public function resetPwd() {
        $id = $_POST['id'];
        $password = $_POST['password'];
        if (empty($password) || strlen($password) < 6) {
            $this->error('密码长度必须大于6个字符！');
        }
        if ('' == trim($password)) {
            $this->error('密码不能为空！');
        }
        $Admin = M('Admin');
        $Admin->password = md5($password);
        $Admin->id = $id;
        $result = $Admin->save();
        if (false !== $result) {
            $this->sysLogs($this->mname, $this->aname, "修改当前密码", '成功');
            $this->success("密码修改为$password");
        } else {
            $this->sysLogs($this->mname, $this->aname, "修改当前密码", '失败');
            $this->error('修改密码失败！');
        }
    }
    public function password()
    {
        $this->display();
    }

    // 插入数据
    public function insert() {
        // 创建数据对象
        $Admin = D("Admin");
        if (!$Admin->create()) {
            $this->error($Admin->getError());
        } else {
            // 写入帐号数据
            $roleId = isset($_REQUEST['roleId'])?$_REQUEST['roleId']:0;
            $result = $Admin->add();
            if ( $result!==false) {
                $this->addRole($result,$roleId);
                $this->sysLogs($this->mname, $this->aname, "添加用户", '用户id'.$result);
                $this->success('用户添加成功！');
            } else {
                $this->sysLogs($this->mname, $this->aname, "添加用户", '失败');
                $this->error('用户添加失败！');
            }
        }
    }

    protected function addRole($userId,$roleId) {
        //新增用户自动加入相应权限组
        $RoleUser = M("RoleUser");
        $RoleUser->user_id = $userId;
        $RoleUser->role_id = $roleId;
        $RoleUser->add();
    }
   protected function editRole($userId,$roleId) {
        //新增用户自动加入相应权限组
        $RoleUser = M("RoleUser");
        $RoleUser->role_id = $roleId;
        if(!$RoleUser->where("user_id=$userId")->save()){
            $RoleUser->user_id = $userId;
            $RoleUser->add();
        }
    }

    public function add() {
       $role = D("Role");
        $classTree = $role->field('id,name,pid')->select();
        $list = list_to_tree($classTree,'id','pid','_child',0);
        $this->assign('list', $list);
       $this->display();
    }

    function read() {
        $this->edit();
    }

    function edit() {
        $name = $this->getActionName();
        $model = M($name);
        $id = $_REQUEST [$model->getPk()];
        $vo = $model->getById($id);
        $role = D("Role");
        $classTree = $role->field('id,name,pid')->select();
        $list = list_to_tree($classTree,'id','pid','_child',0);
        $RoleUser = M("RoleUser");
        $roleidList = $RoleUser->where('user_id='.$id)->find();
        $roleid = $roleidList['role_id'];
        $vo['roleid'] = $roleid;
        $this->assign('list', $list);
        $this->assign('vo', $vo);
        $this->display();
    }

    function update() {
        //B('FilterString');
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        // 更新数据
        $list = $model->save();
        $userid = $_REQUEST['id'];
        $roleId = isset($_REQUEST['roleId'])?$_REQUEST['roleId']:0;
        if (false !== $list) {
            $this->editRole($userid,$roleId);
            //成功提示
            $this->sysLogs($this->mname, $this->aname, "编辑用户".$userid, '成功');
            $this->assign('jumpUrl', Cookie::get('_currentUrl_'));
            $this->success('编辑成功!');
        } else {
            //错误提示
            $this->sysLogs($this->mname, $this->aname, "编辑用户".$userid, '失败');
            $this->error('编辑失败!');
        }
    }
    /**
      +----------------------------------------------------------
     * 默认禁用操作
     *
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws FcsException
      +----------------------------------------------------------
     */
    public function forbid() {
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_REQUEST [$pk];
        $condition = array($pk => array('in', $id));
        $list = $model->forbid($condition);
        if ($list !== false) {
            $this->sysLogs($this->mname, $this->aname, "状态禁用成功", "用户ID".$id);
            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->success('状态禁用成功');
        } else {
            $this->sysLogs($this->mname, $this->aname, "状态禁用失败", "用户ID".$id);
            $this->error('状态禁用失败！');
        }
    }
}

?>