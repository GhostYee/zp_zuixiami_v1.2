<?php
/**
 * 用户管理
 */
class UserAction extends CommonAction {
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['qq'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['nickname'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['notice'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
	}
	/**
	 +----------------------------------------------------------
	 * 显示首页列表
	 +----------------------------------------------------------
	 */
	public function index() {
		//列表过滤器，生成查询Map对象
		if(!empty($_POST['keyword'])){
			$map['qq'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['nickname'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['notice'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$allinone['where']=$map;
			$allinone['field']='user.*,s.name qun_sort_name';
			$allinone['join']=array(C('DB_PREFIX')."qun_sort as s ON s.id=user.qun_sort_id");
			$allinone['order']='user.id DESC';
			$this->_list_sql ( $model, $allinone );
		}
	
        $this->display();
    }
    
    /**
     +----------------------------------------------------------
     * 添加
     +----------------------------------------------------------
     */
    public function add() {
    	$qun_sort_model=D('qun_sort');
    	
    	//群分类
		$qun_sort_list=$qun_sort_model->order(" sid asc,id desc")->select();
		$this->assign('qun_sort_list',$qun_sort_list);
		
		$this->assign('acturl','insert');

		$this->display('edit');
    }
    
    /**
     +----------------------------------------------------------
     * 添加操作
     +----------------------------------------------------------
     */
    
    public function insert() {
    	$model = D ('user');
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
    	$model = M ( 'user' );
    	$id = $_REQUEST ['id'];
    	$user = $model->find ( $id );
    	$this->assign('vo',$user);
    	
    	//群分类
    	$qun_sort_model=D('qun_sort');
		$qun_sort_list=$qun_sort_model->order(" sid asc,id desc")->select();
		$this->assign('qun_sort_list',$qun_sort_list);
    	    	
    	$this->assign('acturl', 'update');
    	$this->display ();
    }
    /**
     +----------------------------------------------------------
     * 编辑操作
     +----------------------------------------------------------
     */
    public function update() {
    	$id = $_REQUEST ['id'];
    	$model = D ('user');
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
	// ------------------------------------------------------------------------
}
?>