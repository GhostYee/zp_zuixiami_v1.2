<?php
/**
 * 系统配置管理
 */
class SysconfigAction extends CommonAction {
	/**
	 +----------------------------------------------------------
	 * 默认显示首页列表
	 * 可以在action控制器中重载
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	public function index() {
        $model = D("Config");
        $list = $model->order("`sid` ASC")->select();
        
        import("@.ORG.Util.Tree");
        $tree=new Tree($list);
        $sysconfig=$tree->getChildList();
        $this->assign('sysconfig', $sysconfig);
        $this->display();
    }
    
    /**
     +----------------------------------------------------------
     * 添加
     +----------------------------------------------------------
     */
    public function add() {
    	$model = D("Config");
    	$list = $model->where("pid=0")->order("`sid` ASC")->select();
    	
    	$sysconfig['sid']=$model->getField("max(sid)");
		
    	$this->assign('acturl', 'insert');
    	$this->assign('sysconfig', $sysconfig);
    	$this->assign('sysconfig_list', $list);
    	$this->display('edit');
    }
    
    /**
     +----------------------------------------------------------
     * 添加操作
     +----------------------------------------------------------
     */
    
    public function insert() {
    	$model = D ('config');
    	if (false === $model->create ()) {
    		$this->error ( $model->getError () );
    	}
    	//保存当前数据对象
    	$list=$model->add();
    	if ($list!==false) { //保存成功
    		$this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
    		$this->success ('新增成功!');
    	} else {
    		//失败提示
    		$this->error ('新增失败!');
    	}
    }
    /**
     +----------------------------------------------------------
     * 显示编辑页
     */
    public function edit() {
    	$model = M ( 'config' );
    	$id = $_REQUEST [$model->getPk ()];
    	$sysconfig = $model->getById ( $id );
    	
    	$list = $model->where("pid=0")->order("`sid` ASC")->select();
    	    	
    	$this->assign('acturl', 'update');
    	$this->assign('sysconfig', $sysconfig);
    	$this->assign('sysconfig_list', $list);
    	$this->display ();
    }
    /**
     +----------------------------------------------------------
     * 编辑操作
     +----------------------------------------------------------
     */
    public function update() {
    	$model = D ( 'config' );
    	if (false === $model->create ()) {
    		$this->error ( $model->getError () );
    	}
    	// 更新数据
    	$list=$model->save ();
    	if (false !== $list) {
    		//成功提示
    		$this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
    		$this->success ('编辑成功!');
    	} else {
    		//错误提示
    		$this->error ('编辑失败!');
    	}
    }
	
	/**
      +----------------------------------------------------------
     * 永久删除操作
      +----------------------------------------------------------
     */
	public function foreverdelete() {
		//删除指定记录
		$model = D ('config');
		if (! empty ( $model )) {
			$pk = $model->getPk ();
			$id = $_REQUEST [$pk];
			if (isset ( $id )) {
				$condition = array ($pk => array ('in', explode ( ',', $id ) ) );
				if (false !== $model->where ( $condition )->delete ()) {
					$this->success ('删除成功！');
				} else {
					$this->error ('删除失败！');
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
		$this->forward ();
	}
	/**
	 +----------------------------------------------------------
	 * 选中删除操作
	 */
	public function selectedDelete() {
		//删除指定记录
		$model = D('config');
		if (!empty($model)) {
			$pk = $model->getPk();
			$id = $_REQUEST ['ids'];
			if (isset($id)) {
				$condition = array($pk => array('in', explode(',', $id)));
				if (false !== $model->where($condition)->delete()) {
					//echo $model->getlastsql();
					$this->success('删除成功！');
				} else {
					$this->error('删除失败！');
				}
			} else {
				$this->error('非法操作');
			}
		}
		$this->forward();
	}
	// ------------------------------------------------------------------------
}
?>