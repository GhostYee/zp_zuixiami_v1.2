<?php
/**
 * 作品专题管理
 */
class Works_special_midAction extends CommonAction {
/**
	 +----------------------------------------------------------
	 * 专题作品列表管理
	 +----------------------------------------------------------
	 */
	public function index() {
		$works_special_model = D ( 'works_special' );
		$special_id = $_REQUEST ['id'];
		
		$works_special=$works_special_model->find($special_id);
		$this->assign('works_special',$works_special);
		
		//列表过滤器，生成查询Map对象
		$search['keyword']=$_REQUEST['keyword'];
		
		$where=array();
		if(!empty($search['keyword'])){
			$where['works.qq'] = array('like', "%" . $search['keyword'] . "%");
			$where['works.name'] = array('like', "%" . $search['keyword'] . "%");
			$where['works.author'] = array('like', "%" . $search['keyword'] . "%");
			$where['works.description'] = array('like', "%" . $search['keyword'] . "%");
			$where['works.url'] = array('like', "%" . $search['keyword'] . "%");
			$where['_logic'] = 'or';
		}
		if($where){
			$map['_complex'] = $where;
		}
		$map['works_special_mid.special_id']=$special_id;

		$model = D ( 'Works_special_mid' );
		if (! empty ( $model )) {
			$allinone['where']=$map;
			$allinone['field']='Works_special_mid.*,works.name works_name, works.demourl, works.img';
			$allinone['join']=array(C('DB_PREFIX')."works works ON works_special_mid.works_id=works.id");
			$allinone['order']='works_special_mid.id DESC';
			$this->_list_sql ( $model, $allinone );
		}
		
		$this->assign('search',$search);
		$this->assign('special_id',$special_id);
	
		$this->display ();
	}
    
    /**
     +----------------------------------------------------------
     * 添加
     +----------------------------------------------------------
     */
    public function add() {
    	$works_special_model = D ( 'works_special' );
    	$special_id = $_REQUEST ['id'];    	
    	$works_special=$works_special_model->getById($special_id);
    	$this->assign('works_special',$works_special);
    	
    	$this->assign('acturl', 'insert');

    	$this->display('edit');
    }
	/**
	 +----------------------------------------------------------
	 * 添加操作
	 +----------------------------------------------------------
	 */
	public function insert() {
		$special_id=$_REQUEST['id'];
		$works_id=$_REQUEST['orgLookup_id'];
		$works_id=explode(',',$works_id);
		$num=count($works_id);
		$model=D('Works_special_mid');
		for($i=0;$i<$num;$i++){
			$list=$model->where("special_id='$special_id' and works_id='$works_id'")->find();
			if($list===null){
				$data=array(
						'special_id'=>$special_id,
						'works_id'=>$works_id[$i],
						'addtime'=>time()					
				);
				$model->add($data);
			}
		}
		$this->success('添加成功');
	}
	/**
	 +----------------------------------------------------------
	 * 作品suggest查找
	 +----------------------------------------------------------
	 */
	public function works_search_json() {
		$model=D('Works');
		$works=$model->field('id,name')->where("name!=''")->order('id desc')->select();
		echo json_encode($works);
	}
	/**
	 +----------------------------------------------------------
	 * 多选作品列表
	 +----------------------------------------------------------
	 */
	public function workslist_selected() {
		$special_id=$_REQUEST['id'];
		$keyword=$_REQUEST['keyword'];
		
		$where="name!='' and id not in (select works_id from ".C('DB_PREFIX')."works_special_mid where special_id='$special_id')";
		if($keyword){
			$where.=" and name like '%$keyword%' ";
		}

		$model=D('Works');
		$works=$model->where($where)->order('id desc')->select();
		foreach($works as $key=>$val){
			$works[$key]['json']=json_encode(array('id'=>$val['id'],'name'=>$val['name']));
		}
		$this->assign('list',$works);
		
		$this->assign('special_id',$special_id);
		$this->display();
	}
	// ------------------------------------------------------------------------
}
?>