<?php
/**
 * 群成员管理
 */
class Qun_memberAction extends CommonAction {
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['qq'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['name'] = array('like', "%" . $_POST['keyword'] . "%");
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
			$map['qun_member.qq'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['qun_member.name'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$allinone['where']=$map;
			$allinone['field']='qun_member.*,s.name qun_sort_name';
			$allinone['join']=array(C('DB_PREFIX')."qun_sort as s ON s.id=qun_member.qun_sort_id");
			$allinone['order']='qun_member.id DESC';
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
    	$model = D ('qun_member');
    	if (false === $model->create ()) {
    		$this->error ( $model->getError () );
    	}
    	
    	if(!empty($model->qq)){
    		$have_qq=$model->where("qq='".$model->qq."'")->find();
    		if($have_qq){
    			$this->error('qq号码存在'.$model->qq.'请更换!');
    		}
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
    	$model = M ( 'qun_member' );
    	$id = $_REQUEST ['id'];
    	$qun_member = $model->find ( $id );
    	$this->assign('vo',$qun_member);
    	
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
    	$model = D ('qun_member');
    	if (false === $model->create ()) {
    		$this->error ( $model->getError () );
    	}
    	
    	if(!empty($model->qq)){
    		$have_qq=$model->where("qq='".$model->qq."' and id!='$id' ")->find();
    		if($have_qq){
    			$this->error('qq号码存在'.$model->qq.'请更换!');
    		}
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
    function update_member(){
    	$model_t_member=M('t_members');
    	$list=$model_t_member->group('qqnumber')->select();
    	
    	$model=M('qun_member');
    	$qun_member_list=$model->group('qq')->select();
    	foreach($qun_member_list as $val){
    		//删除重复数据
    		$num='';$mid='';
    		$num=$model->where("qq='$val[qq]'")->getField('count(*)');
    		if($num>1){
    			echo '删除重复'.$val[qq].'<br>';
    			$model->where("qq='$val[qq]' and qun_sort_id=1")->delete();
    		}
    		
    		//删除没有在新数据内数据
    		$mid=$model_t_member->where("qqnumber='$val[qq]'")->getField('qqnumber');
    		if(empty($mid)){
    			echo '删除新数据'.$val[qq].'<br>';
    			$model->where("qq='$val[qq]'")->delete();
    		}
    	}
    	
    	foreach($list as $val){
    		$mid='';$data=array();
    		//判断成员内是否存在
    		$mid=$model->where("qq='$val[qqnumber]'")->getField('id');
    		if(!empty($mid)){//更新
    			$data['name']=$val['qqname'];
    			$data['qun_sort_id']=$val['id'];
    			$model->where("id='$mid'")->save($data);
    		}
    		else{
    			$data['qq']=$val['qqnumber'];
    			$data['name']=$val['qqname'];
    			$data['qun_sort_id']=$val['id'];
    			$model->add($data);
    		}
    	}
    	echo '更新成功!'.'<br>';
    	$model_t_member=M('t_members');
    	$list_all=$model_t_member->select();
    	$qun_member_all=$model->select();
    	$qun_member_now=$model->group('qq')->select();
    	echo '新数据总'.count($list_all).'<br>';
    	echo '新数据唯一'.count($list).'<br>';
    	echo '成员表总'.count($qun_member_all).'<br>';
    	echo '成员表唯一'.count($qun_member_now).'<br>';
    		
    }
	// ------------------------------------------------------------------------
}
?>