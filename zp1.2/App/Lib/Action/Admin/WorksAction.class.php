<?php
/**
 * 作品管理
 */
class WorksAction extends CommonAction {
	/**
	 +----------------------------------------------------------
	 * 显示首页列表
	 +----------------------------------------------------------
	 */
	public function index() {
		//列表过滤器，生成查询Map对象
		$search['keyword']=$_REQUEST['keyword'];
		$search['works_qun_sortid']=$_REQUEST['works_qun_sortid'];
		$search['works_sortid']=$_REQUEST['works_sortid'];
		$search['works_is_top']=$_REQUEST['works_is_top'];
		$search['works_status']=$_REQUEST['works_status'];
		
		if(!empty($search['keyword'])){
			$map['works.qq'] = array('like', "%" . $search['keyword'] . "%");
			$map['works.name'] = array('like', "%" . $search['keyword'] . "%");
			$map['works.author'] = array('like', "%" . $search['keyword'] . "%");
			$map['works.description'] = array('like', "%" . $search['keyword'] . "%");
			$map['works.url'] = array('like', "%" . $search['keyword'] . "%");
			$map['_logic'] = 'or';
		}
		if(!empty($search['works_qun_sortid'])){
			$map['works.qun_sortid'] = $search['works_qun_sortid'];
		}
		if(!empty($search['works_sortid'])){
			$map['works.sortid'] = $search['works_sortid'];
		}
		if(!empty($search['works_is_top'])){
			$map['works.is_top'] = $search['works_is_top'];
		}
		if(!empty($search['works_status'])){
			$map['works.status'] = $search['works_status'];
		}		
		
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$allinone['where']=$map;
			$allinone['field']='works.*,s.name sortname,qs.name qunname';
			$allinone['join']=array(C('DB_PREFIX')."works_sort s ON s.id=works.sortid",C('DB_PREFIX')."qun_sort qs ON qs.id=works.qun_sortid");
			$allinone['order']='works.id DESC';
			$this->_list_sql ( $model, $allinone );
		}
		
		//成员分类
		$qun_sort_model=M('qun_sort');
		$qun_sort_list=$qun_sort_model->order('sid asc,id desc')->select();
		$this->assign('qun_sort_list',$qun_sort_list);
		
		//取得作品分类数据
		$works_sort_model=M('works_sort');
		$rows=$works_sort_model->order("orders asc,id desc")->select();
		import("@.ORG.Util.Tree");
        $tree=new Tree($rows);
		$works_sort_list= $tree->getChildList();
		$this->assign('works_sort_list',$works_sort_list);
		
		//echo $model->getDbError();
		//echo $model->getLastSql();
		
		$this->assign('search',$search);
	
        $this->display();
    }
    
    /**
     +----------------------------------------------------------
     * 添加
     +----------------------------------------------------------
     */
    public function add() {
    	
    	//成员分类
		$qun_sort_model=M('qun_sort');
		$qun_sort_list=$qun_sort_model->order('sid asc,id desc')->select();
		$this->assign('qun_sort_list',$qun_sort_list);
		
		//取得作品分类数据
		$works_sort_model=M('works_sort');
		$rows=$works_sort_model->order("orders asc,id desc")->select();
		import("@.ORG.Util.Tree");
        $tree=new Tree($rows);
		$works_sort_list= $tree->getChildList();
		$this->assign('works_sort_list',$works_sort_list);
		
		$this->assign('acturl','insert');

		$this->display('edit');
    }
    
    /**
     +----------------------------------------------------------
     * 添加操作
     +----------------------------------------------------------
     */
    
    public function insert() {
    	$name=$this->getActionName();
		$model = D ($name);
    	if (false === $model->create ()) {
    		$this->error ( $model->getError () );
    	}
    	
    	//替换URL空格
    	$model->url=str_replace(array(' ','　'),array('',''),$model->url);
    	//处理URL
    	$model->url=prep_url($model->url);
    	//审核更新审核信息
    	if($model->status==2){
	    	$model->checkuser=session('loginUserName');
	    	$model->checktime=time();
    	}
    	
    	//保存当前数据对象
    	$list=$model->add();
    	if ($list!==false) { //保存成功
    		//上传图片
    		if(!empty($_FILES['fileimg']['name'])){
    			//导入上传类
    			import('@.ORG.WeUploadFile');
    			$upload = new WeUploadFile();
    			//只允许图片上传
    			$upload->allow_type='image';
    			if (!$upload->upload()) {
    				//捕获上传异常
    				$this->error($upload->getErrorMsg());
    			} else {
    				//取得成功上传的文件信息
    				$file_info = $upload->getUploadFileInfo();
    			}
    			//dump($file_info);exit;
    			//赋值当前表图片地址
    			$data['uploads_id']=$file_info[0]['id'];
    			$data['img']=$file_info[0]['fileurl'];
    			$model->where("id='$list'")->save($data);
    		}
    		//作品日志
    		$this->works_log($list,ACTION_NAME);
    		
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
    	$name=$this->getActionName();
    	$model = D ($name);
    	
    	$id = $_REQUEST ['id'];
    	$works = $model->find ( $id );
    	$this->assign('vo',$works);
    	 
    	//成员分类
    	$qun_sort_model=M('qun_sort');
    	$qun_sort_list=$qun_sort_model->order('sid asc,id desc')->select();
    	$this->assign('qun_sort_list',$qun_sort_list);
    	
    	//取得作品分类数据
    	$works_sort_model=M('works_sort');
    	$rows=$works_sort_model->order("orders asc,id desc")->select();
    	import("@.ORG.Util.Tree");
    	$tree=new Tree($rows);
    	$works_sort_list= $tree->getChildList();
    	$this->assign('works_sort_list',$works_sort_list);
    	
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
    	$name=$this->getActionName();
		$model = D ($name);
    	if (false === $model->create ()) {
    		$this->error ( $model->getError () );
    	}
    	//替换URL空格
    	$model->url=str_replace(array(' ','　'),array('',''),$model->url);
    	//处理URL
    	$model->url=prep_url($model->url);
    	//审核更新审核信息
    	if($model->status==2){
    		$model->checkuser=session('loginUserName');
    		$model->checktime=time();
    	}
    	//上传图片
		if(!empty($_FILES['fileimg']['name'])){			
			//导入上传类
			import('@.ORG.WeUploadFile');
			$upload = new WeUploadFile();
			//只允许图片上传
			$upload->allow_type='image';
			if (!$upload->upload()) {
				//捕获上传异常
				$this->error($upload->getErrorMsg());
			} else {
				//取得成功上传的文件信息
				$file_info = $upload->getUploadFileInfo();
			}
			//删除修改前文件
			if($model->uploads_id){
				$model_uploads = D('Uploads');
				$model_uploads->deleteByID($model->uploads_id);
			}
			//赋值当前表图片地址
			$model->uploads_id=$file_info[0]['id'];
			$model->img=$file_info[0]['fileurl'];
		}
    	// 更新数据
    	$list=$model->save ();
    	if (false !== $list) {
    		//作品日志
    		$this->works_log($id,ACTION_NAME);
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
     * 前置删除
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function _before_foreverdelete(){
    	//删除附件表上传图片
    	$name=$this->getActionName();
    	$model = D ($name);
    	$id=$_REQUEST['id'];
    	$data=$model->getByid($id);
    	if($data['uploads_id']){
    		$model_uploads=D('Uploads');
    		$model_uploads->deleteByID($data['uploads_id']);
    	}
    }
    /**
     +----------------------------------------------------------
     * 审核操作
     +----------------------------------------------------------
     */
    public function check() {
    	$name=$this->getActionName();
    	$model = D ($name);
    	
    	$id = $_REQUEST ['id'];
    	
    	$works['status']='2';
    	$works['checkuser']=session('loginUserName');
    	$works['checktime']=time();
    	
    	// 更新数据
    	$list=$model->where("id='$id'")->save ($works);
    	if (false !== $list) {
    		//成功提示
    		$this->success ('审核成功!');
    	} else {
    		//错误提示
    		$this->error ('审核失败!');
    	}
    }
    /**
     +----------------------------------------------------------
     * 选中批量审核操作
     +----------------------------------------------------------
     */
    public function selectedCheck() {
    	//审核指定记录
    	$name = $this->getActionName();
    	$model = D($name);
    	if (!empty($model)) {
    		$pk = $model->getPk();
    		$id = $_REQUEST ['ids'];
    		if (isset($id)) {
    			$condition = array($pk => array('in', explode(',', $id)));
    			$works['status']='2';
    			$works['checkuser']=session('loginUserName');
    			$works['checktime']=time();
    			if (false !== $model->where($condition)->save($works)) {
    				//echo $model->getlastsql();
    				$this->success('全部审核成功！');
    			} else {
    				$this->error('审核失败！');
    			}
    		} else {
    			$this->error('非法操作');
    		}
    	}
    	$this->forward();
    }
    /**
     +----------------------------------------------------------
     * 选中批量推荐操作
     +----------------------------------------------------------
     */
    public function selectedTop() {
    	//审核指定记录
    	$name = $this->getActionName();
    	$model = D($name);
    	if (!empty($model)) {
    		$pk = $model->getPk();
    		$id = $_REQUEST ['ids'];
    		if (isset($id)) {
    			$condition = array($pk => array('in', explode(',', $id)));
    			$works['is_top']='1';
    			if (false !== $model->where($condition)->save($works)) {
    				//echo $model->getlastsql();
    				//作品日志
    				$this->works_log($id,ACTION_NAME);
    				$this->success('全部推荐成功！');
    			} else {
    				$this->error('推荐失败！');
    			}
    		} else {
    			$this->error('非法操作');
    		}
    	}
    	$this->forward();
    }
    /**
     +----------------------------------------------------------
     * 选中批量不推荐操作
     +----------------------------------------------------------
     */
    public function selectedNottop() {
    	//审核指定记录
    	$name = $this->getActionName();
    	$model = D($name);
    	if (!empty($model)) {
    		$pk = $model->getPk();
    		$id = $_REQUEST ['ids'];
    		if (isset($id)) {
    			$condition = array($pk => array('in', explode(',', $id)));
    			$works['is_top']='0';
    			if (false !== $model->where($condition)->save($works)) {
    				//echo $model->getlastsql();
    				//作品日志
    				$this->works_log($id,ACTION_NAME);
    				$this->success('全部不推荐成功！');
    			} else {
    				$this->error('推荐失败！');
    			}
    		} else {
    			$this->error('非法操作');
    		}
    	}
    	$this->forward();
    }
    /**
     +----------------------------------------------------------
     * 作品操作日志列表
     +----------------------------------------------------------
     */
    public function log() {
    	$works_id = $_REQUEST ['id'];
    	$model=M('works_log');
    	$map['works_id']=$works_id;
    	$list=$model->where($map)->order('`id` desc')->select();
    	$this->assign('list',$list);
    	$this->display();
    
    }
    /**
     +----------------------------------------------------------
     * 作品操作日志新增
     +----------------------------------------------------------
     */
    public function works_log($works_id,$action,$notice='') {
    	$model=M('works_log');
    	$works_log['works_id']=$works_id;
    	$works_log['action']=$action;
    	$works_log['notice']=$notice;
    	$works_log['adduser']=session('loginUserName');
    	$works_log['addtime']=time();
    	$list=$model->add($works_log);
    	if($list!==false){
    		return true;
    	}
    	else{
    		return false;
    	}
    		
    }
    /**
     +----------------------------------------------------------
     * 同步作品表评星与用户操作内的用户评星
     +----------------------------------------------------------
     */
    public function syncUserActionWorksRank() {
    	$model_user_action=M('user_action');
    	$model_works=D('Works');
    	$where['module']='Works';
    	$where['mtype']='rank';
    	$user_action_list=$model_user_action->field("id,mid,count(*) rank_count,sum(value) rank_total")->where($where)->group('mid')->select();
    	if($user_action_list){
    		foreach($user_action_list as $val){
    			$data=array();
    			$data['rank_count']=$val['rank_count'];
    			$data['rank_total']=$val['rank_total'];
    			$data['id']=$val['mid'];
    			$model_works->save($data);
    		}
    	}
    	//echo $model_user_action->getLastSql();
    	echo 'Sync OK';  	
    
    }
	// ------------------------------------------------------------------------
}
?>