<?php
/**
 * 通用Action入口模块
 */
class CommonAction extends Action {
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
		import("@.ORG.Util.Cookie"); //by wewe
        // 用户权限检查
        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
        	
            //import('@.ORG.RBAC');
            import("@.ORG.Util.RBAC");//by wewe
            if (!RBAC::AccessDecision(GROUP_NAME)) {
                //检查认证识别号
                if (!$_SESSION [C('USER_AUTH_KEY')]) {
					if ($this->isAjax()){ // by wewe
						$this->ajaxReturn(true, "", 301);
					} else {
						//跳转到认证网关
						redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
		    		}
                }
                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
                    if (C('GUEST_AUTH_ON')) {
                        $this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
                    }
                    // 提示错误信息
                    $this->error(L('_VALID_ACCESS_'));
                }
            }
            
        }
        $sysconfig=F('cache_sysconfig');
        $this->assign("CFG",CFG(NULL,'sysconfig'));
    }
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
		//列表过滤器，生成查询Map对象
		$map = $this->_search ();
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		
		$this->display ();
		return;
	}
	
	/**
      +----------------------------------------------------------
     * 取得操作成功后要返回的URL地址
     * 默认返回当前模块的默认操作
     * 可以在action控制器中重载
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    function getReturnUrl() {
        return __URL__ . '?' . C('VAR_MODULE') . '=' . MODULE_NAME . '&' . C('VAR_ACTION') . '=' . C('DEFAULT_ACTION');
    }
	
    /**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param Model $model 数据对象
     * @param HashMap $map 过滤条件
     * @param string $sortBy 排序
     * @param boolean $asc 是否正序
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _list($model, $map, $sortBy = '', $asc = false) {
        //排序字段 默认为主键名
        if (!empty($_REQUEST ['_order'])) {
            $order = $_REQUEST ['_order'];
        } else {
            $order = !empty($sortBy) ? $sortBy : $model->getPk();
        }
        //排序方式默认按照倒序排列
        //接受 sost参数 0 表示倒序 非0都 表示正序
        if (isset($_REQUEST ['_sort'])) {
            //$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
			$sort = $_REQUEST ['_sort'] == 'asc' ? 'asc' : 'desc'; //by wewe
        } else {
            $sort = $asc ? 'asc' : 'desc';
        }
        //取得满足条件的记录数
        $count = $model->where($map)->count('id');
        if ($count > 0) {
            import("@.ORG.Util.Page");
            //创建分页对象
            if (!empty($_REQUEST ['listRows'])) {
                $listRows = $_REQUEST ['listRows'];
            } else {
                $listRows = '';
            }
            $p = new Page($count, $listRows);
            //分页查询数据

            $voList = $model->where($map)->order("`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select();
            //echo $model->getlastsql();
            //定义_fill_list方法用于对列表重新赋值
            if (method_exists ( $this, '_fill_list' )) {
            	$this->_fill_list ( $voList );
            }
            //分页跳转的时候保证查询条件
            foreach ($map as $key => $val) {
                if (!is_array($val)) {
                    $p->parameter .= "$key=" . urlencode($val) . "&";
                }
            }
            //分页显示
            $page = $p->show();
            //列表排序显示
            $sortImg = $sort; //排序图标
            $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
            $sort = $sort == 'desc' ? 1 : 0; //排序方式
            //模板赋值显示
            $this->assign('list', $voList);
            $this->assign('sort', $sort);
            $this->assign('order', $order);
            $this->assign('sortImg', $sortImg);
            $this->assign('sortType', $sortAlt);
            $this->assign("page", $page);
        }
        $this->assign('totalCount', $count);
        //$this->assign('numPerPage', C('PAGE_LISTROWS'));
		$this->assign('numPerPage', $p->listRows); //by wewe
        $this->assign('currentPage', !empty($_REQUEST[C('VAR_PAGE')]) ? $_REQUEST[C('VAR_PAGE')] : 1);

        Cookie::set('_currentUrl_', __SELF__);
        return;
    }
    /**
     +----------------------------------------------------------
     * sql列表
     * 进行列表过滤
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param Model $model 数据对象
     * @param mix $allinone DB操作 
     *  //where
    	//field
    	//join
    	//union
    	//group
    	//order
    	//sortby
    	//asc
     * 
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    protected function _list_sql($model,$allinone) {
    	//where
    	//field
    	//join
    	//union
    	//group
    	//order
    	//sortby
    	//asc
    	//排序字段
    	if (!empty($_REQUEST ['_order'])) {
    		$sortby = $_REQUEST ['_order'];
    	} 
    	//排序方式默认按照倒序排列
    	//接受 sost参数 0 表示倒序 非0都 表示正序
    	if (isset($_REQUEST ['_sort'])) {
    		$asc = $_REQUEST ['_sort'] == 'asc' ? 'asc' : 'desc'; //by wewe
    	}
    	//取得当前表名
    	$nowtable=$model->getTableName().' '.$model->getSmallTableName();
    	//取得满足条件的记录数
    	//join
    	if($allinone['join']){
    		$model->table($nowtable);
    		$model->join($allinone['join']);
    	}
    	//联合
    	if($allinone['union']){
    		$model->union($allinone['union']);
    	}
    	//分组
    	if($allinone['group']){
    		$model->group($allinone['group']);
    	}
    	$count = $model->where($allinone['where'])->count();
    	
    	if($model->getDbError()){
    		echo $model->getDbError()."<br>";
    	}
    	if ($count > 0) {
    		import("@.ORG.Util.Page");
    		//创建分页对象
    		if (!empty($_REQUEST ['listRows'])) {
    			$listRows = $_REQUEST ['listRows'];
    		} else {
    			$listRows = '';
    		}
    		$p = new Page($count, $listRows);
    		//分页查询数据
    		
    		//条件
    		if($allinone['where']){
    				$model->where($allinone['where']);
    		}
    		//查询字段
    		if($allinone['field']){
    			$model->field($allinone['field']);
    		}
    		//join
    		if($allinone['join']){
    			$model->table($nowtable);
    			$model->join($allinone['join']);
    		}
    		//联合
    		if($allinone['union']){
    			$model->union($allinone['union']);
    		}
    		//分组
    		if($allinone['group']){
    			$model->group($allinone['group']);
    		}
    		//排序
    		if($sortby && $asc){
    			$model->order(" $sortby.' '.$asc ");
    		}
    		else if($allinone['order']){
    			$model->order($allinone['order']);
    		}
    		$voList = $model->limit($p->firstRow . ',' . $p->listRows)->select();
	    	if($model->getDbError()){
	    		echo $model->getDbError()."<br>";
	    	}
	    	//dump($allinone['where']);
    		//分页跳转的时候保证查询条件
    		foreach ($allinone['where'] as $key => $val) {
    			if (!is_array($val)) {
    				$p->parameter .= "$key=" . urlencode($val) . "&";
    			}
    		}
    		//echo $p->parameter;
    		//分页显示
    		$page = $p->show();
    		//echo $page;
    		//列表排序显示
    		$sortImg = $asc; //排序图标
    		$sortAlt = $asc == 'desc' ? '升序排列' : '倒序排列'; //排序提示
    		$sort = $asc == 'desc' ? 1 : 0; //排序方式
    		//模板赋值显示
    		$this->assign('list', $voList);
    		$this->assign('sort', $sort);
    		$this->assign('order', $sortby);
    		$this->assign('sortImg', $sortImg);
    		$this->assign('sortType', $sortAlt);
    		$this->assign("page", $page);
    	}
    	$this->assign('totalCount', $count);
    	//$this->assign('numPerPage', C('PAGE_LISTROWS'));
    	$this->assign('numPerPage', $p->listRows); //by wewe
    	$this->assign('currentPage', !empty($_REQUEST[C('VAR_PAGE')]) ? $_REQUEST[C('VAR_PAGE')] : 1);
    
    	Cookie::set('_currentUrl_', __SELF__);
    	return;
    }
    /**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param string $name 数据对象名称
      +----------------------------------------------------------
     * @return HashMap
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _search($name = '') {
        //生成查询条件
        if (empty($name)) {
            $name = $this->getActionName();
        }
        $name = $this->getActionName();
        $model = D($name);
        $map = array();
        foreach ($model->getDbFields() as $key => $val) {
            if (isset($_REQUEST [$val]) && $_REQUEST [$val] != '') {
                $map [$val] = $_REQUEST [$val];
            }
        }
        return $map;
    }
	/**
      +----------------------------------------------------------
     * 默认显示添加页
     * 可以在action控制器中重载
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
	public function add() {
		//form默认提交操作insert
		$this->assign('acturl','insert');
		$this->display ('edit');
	}
	
	/**
      +----------------------------------------------------------
     * 默认添加操作
     * 可以在action控制器中重载
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
	
	public function insert() {
		//B('FilterString');
		$name=$this->getActionName();
		$model = D ($name);
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		//定义_fill_insert方法用于对插入重新赋值
		if (method_exists ( $this, '_fill_insert' )) {
			$this->_fill_insert ( $model );
		}
		//保存当前数据对象
		$list=$model->add ();
		if ($list!==false) { //保存成功
			$this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
			$this->sysLogs('新增ID:'.$list.'成功');
			$this->success ('新增成功!');
		} else {
			$this->sysLogs('新增失败');
			//失败提示
			$this->error ('新增失败!');
		}
	}
	
	/**
      +----------------------------------------------------------
     * 默认读取操作
     * 可以在action控制器中重载
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
	public function read() {
		$this->edit ();
	}
	
	/**
      +----------------------------------------------------------
     * 默认显示编辑页
     * 可以在action控制器中重载
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
	public function edit() {
		$name=$this->getActionName();
		$model = M ( $name );
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById ( $id );
		//定义_fill_edit方法用于对编辑页显示重新赋值
		if (method_exists ( $this, '_fill_edit' )) {
			$this->_fill_edit ( $vo );
		}
		$this->assign ( 'vo', $vo );
		
		//form默认提交操作insert
		$this->assign('acturl','update');
		$this->display ();
	}
	/**
      +----------------------------------------------------------
     * 默认编辑操作
     * 可以在action控制器中重载
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
	public function update() {
		//B('FilterString');
		$name=$this->getActionName();
		$model = D ( $name );
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		//定义_fill_update方法用于对编辑操作重新赋值
		if (method_exists ( $this, '_fill_update' )) {
			$this->_fill_update ( $model );
		}
		// 更新数据
		$list=$model->save ();
		if (false !== $list) {
			//成功提示
			$this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
			$pk = $model->getPk ();
			$id = $_REQUEST [$pk];
			$this->sysLogs('编辑ID:'.$id.'成功');
			$this->success ('编辑成功!');
		} else {
			$this->sysLogs('编辑失败');
			//错误提示
			$this->error ('编辑失败!');
		}
	}
    
	/**
     +----------------------------------------------------------
	 * 默认删除到回收站操作 
	 * status改为-1
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
		$name=$this->getActionName();
		$model = M ($name);
		if (! empty ( $model )) {
			$pk = $model->getPk ();
			$id = $_REQUEST [$pk];
			if (isset ( $id )) {
				$condition = array ($pk => array ('in', explode ( ',', $id ) ) );
				$list=$model->where ( $condition )->setField ( 'status', - 1 );
				if ($list!==false) {
					$this->sysLogs('删除成功ID:'.$id);
					$this->success ('删除成功！' );
				} else {
					$this->sysLogs('删除失败ID:'.$id);
					$this->error ('删除失败！');
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
	}
	/**
      +----------------------------------------------------------
     * 关联删除单条主表记录
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
	public function deleterelation() {
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$pk = $model->getPk ();
			$id = $_REQUEST [$pk];
			if (isset ( $id )) {
				//$condition = array ($pk => array ('in', explode ( ',', $id ) ) );
				if (false !== $model->relation(true)->delete ($id)) {
					//echo $model->getlastsql();
					$this->sysLogs('删除成功ID:'.$id);
					$this->success ('删除成功！');
				} else {
					$this->sysLogs('删除失败ID:'.$id);
					$this->error ('删除失败！');
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
	}
	
	/**
      +----------------------------------------------------------
     * 默认永久删除操作
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
	public function foreverdelete() {
		//删除指定记录
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$pk = $model->getPk ();
			$id = $_REQUEST [$pk];
			if (isset ( $id )) {
				$condition = array ($pk => array ('in', explode ( ',', $id ) ) );
				if (false !== $model->where ( $condition )->delete ()) {
					//echo $model->getlastsql();
					$this->sysLogs('删除成功ID:'.$id);
					$this->success ('删除成功！');
				} else {
					$this->sysLogs('删除失败ID:'.$id);
					$this->error ('删除失败！');
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
	}
	/**
      +----------------------------------------------------------
     * 默认选中删除操作
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    public function selectedDelete() {
        //删除指定记录
        $name = $this->getActionName();
        $model = D($name);
        if (!empty($model)) {
            $pk = $model->getPk();
            $id = $_REQUEST ['ids'];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                if (false !== $model->where($condition)->delete()) {
                    //echo $model->getlastsql();
                	$this->sysLogs('选择删除成功ID:'.$id);
                    $this->success('删除成功！');
                } else {
                	$this->sysLogs('选择删除失败ID:'.$id);
                    $this->error('删除失败！');
                }
            } else {
            	$this->sysLogs('选择删除非法操作');
                $this->error('非法操作');
            }
        }
        $this->forward();
    }
	/**
      +----------------------------------------------------------
     * 默认清除操作
	 * status变-1 并跳转
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
	public function clear() {
		//删除指定记录
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			if (false !== $model->where ( 'status=-1' )->delete ()) {
				$this->assign ( "jumpUrl", $this->getReturnUrl () );
				$this->success ( L ( '_DELETE_SUCCESS_' ) );
			} else {
				$this->error ( L ( '_DELETE_FAIL_' ) );
			}
		}
	}
	/**
     +----------------------------------------------------------
	 * 默认状态禁用操作
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
		$name=$this->getActionName();
		$model = D ($name);
		$pk = $model->getPk ();
		$id = $_REQUEST [$pk];
		$condition = array ($pk => array ('in', $id ) );
		$list=$model->forbid ( $condition );
		if ($list!==false) {
			$this->assign ( "jumpUrl", $this->getReturnUrl () );
			$this->sysLogs('状态禁用成功ID:'.$id);
			$this->success ( '状态禁用成功' );
		} else {
			$this->sysLogs('状态禁用失败ID:'.$id);
			$this->error  (  '状态禁用失败！' );
		}
	}
	
	/**
     +----------------------------------------------------------
	 * 默认状态批准操作
	 *
     +----------------------------------------------------------
	 * @access public
     +----------------------------------------------------------
	 * @return string
     +----------------------------------------------------------
	 * @throws FcsException
     +----------------------------------------------------------
	 */
    public function checkPass() {
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_GET [$pk];
        $condition = array($pk => array('in', $id));
        if (false !== $model->checkPass($condition)) {
            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->sysLogs('状态批准成功ID:'.$id);
            $this->success('状态批准成功！');
        } else {
        	$this->sysLogs('状态批准失败ID:'.$id);
            $this->error('状态批准失败！');
        }
    }
	
	/**
     +----------------------------------------------------------
	 * 默认状态还原操作
	 *
     +----------------------------------------------------------
	 * @access public
     +----------------------------------------------------------
	 * @return string
     +----------------------------------------------------------
	 * @throws FcsException
     +----------------------------------------------------------
	 */
    public function recycle() {
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_GET [$pk];
        $condition = array($pk => array('in', $id));
        if (false !== $model->recycle($condition)) {

            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->sysLogs('状态还原成功ID:'.$id);
            $this->success('状态还原成功！');
        } else {
        	$this->sysLogs('状态还原失败ID:'.$id);
            $this->error('状态还原失败！');
        }
    }
	/**
     +----------------------------------------------------------
	 * 默认状态还原
	 *
     +----------------------------------------------------------
	 * @access public
     +----------------------------------------------------------
	 * @return string
     +----------------------------------------------------------
	 * @throws FcsException
     +----------------------------------------------------------
	 */
    public function recycleBin() {
        $map = $this->_search();
        $map ['status'] = - 1;
        $name = $this->getActionName();
        $model = D($name);
        if (!empty($model)) {
            $this->_list($model, $map);
        }
        $this->display();
    }
	/**
     +----------------------------------------------------------
	 * 默认状态恢复操作
	 *
     +----------------------------------------------------------
	 * @access public
     +----------------------------------------------------------
	 * @return string
     +----------------------------------------------------------
	 * @throws FcsException
     +----------------------------------------------------------
	 */
	function resume() {
		//恢复指定记录
		$name=$this->getActionName();
		$model = D ($name);
		$pk = $model->getPk ();
		$id = $_GET [$pk];
		$condition = array ($pk => array ('in', $id ) );
		if (false !== $model->resume ( $condition )) {
			$this->assign ( "jumpUrl", $this->getReturnUrl () );
			$this->sysLogs('状态恢复成功ID:'.$id);
			$this->success ( '状态恢复成功！' );
		} else {
			$this->sysLogs('状态恢复失败ID:'.$id);
			$this->error ( '状态恢复失败！' );
		}
	}
	
	/**
     +----------------------------------------------------------
	 * saveSort
	 *
     +----------------------------------------------------------
	 * @access public
     +----------------------------------------------------------
	 * @return string
     +----------------------------------------------------------
	 * @throws FcsException
     +----------------------------------------------------------
	 */
    public function saveSort() {
        $seqNoList = $_POST ['seqNoList'];
        if (!empty($seqNoList)) {
            //更新数据对象
            $name = $this->getActionName();
            $model = D($name);
            $col = explode(',', $seqNoList);
            //启动事务
            $model->startTrans();
            foreach ($col as $val) {
                $val = explode(':', $val);
                $model->id = $val [0];
                $model->sort = $val [1];
                $result = $model->save();
                if (!$result) {
                    break;
                }
            }
            //提交事务
            $model->commit();
            if ($result !== false) {
                //采用普通方式跳转刷新页面
                $this->success('更新成功');
            } else {
                $this->error($model->getError());
            }
        }
    }
	
	/**
     +----------------------------------------------------------
	 * 日志入库
	 *
     +----------------------------------------------------------
	 * @access public
     +----------------------------------------------------------
	 * @return string
     +----------------------------------------------------------
	 * @throws FcsException
     +----------------------------------------------------------
	 */

    public function sysLogs($message='未知') {
        $syslogs = D("Syslogs");
        $data = array();
        $ip = get_client_ip();
        $data['modulename'] = $this->_getNodeTitle(GROUP_NAME,1);
        $data['actionname'] = $this->_getNodeTitle(MODULE_NAME,2);
        $data['opname'] = $this->_getNodeTitle(ACTION_NAME,3);
        $data['message'] = $message;
        $data['username'] = $_SESSION['loginUserName'] . "(" . $_SESSION['login_account'] . ")";
        $data['userid'] = $_SESSION[C('USER_AUTH_KEY')];
        $data['userip'] = $ip;
        $data['create_time'] = time();
        $result = $syslogs->add($data);
    }
    
     protected function _getNodeTitle($name,$level='1'){
     	$model=M('Node');
     	$title=$model->where("name='$name' and level='$level'")->getField('title');
     	return $title;
     }

}

?>