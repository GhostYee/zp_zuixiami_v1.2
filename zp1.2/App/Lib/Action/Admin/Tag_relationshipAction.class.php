<?php
/**
 * 标签作品管理
 */
class Tag_relationshipAction extends CommonAction {
	/**
		 +----------------------------------------------------------
		 * 标签作品列表管理
		 +----------------------------------------------------------
		 */
	public function index() {
		$tag_model = D ( 'tag' );
		$tag_id = $_REQUEST ['id'];
		
		$tag=$tag_model->find($tag_id);
		$this->assign('tag',$tag);
		
		//列表过滤器，生成查询Map对象
		$search['keyword']=$_REQUEST['keyword'];
		
		$where=array();
		if(!empty($search['keyword'])){
			$where['tag.tagname'] = array('like', "%" . $search['keyword'] . "%");
			$where['works.name'] = array('like', "%" . $search['keyword'] . "%");
			$where['_logic'] = 'or';
		}
		if($where){
			$map['_complex'] = $where;
		}
		$map['tag_relationship.tagid']=$tag_id;

		$model = D ( 'Tag_relationship' );
		if (! empty ( $model )) {
			$allinone['where']=$map;
			$allinone['field']='Tag.tagname tag_name,Tag_relationship.*,works.name works_name';
			$allinone['join']=array(C('DB_PREFIX')."works works ON Tag_relationship.workid=works.id",C('DB_PREFIX')."tag tag ON Tag_relationship.tagid=tag.id");
			$allinone['order']='tag_relationship.id DESC';
			$this->_list_sql ( $model, $allinone );
		}
		
		$this->assign('search',$search);
		$this->assign('tag_id',$tag_id);
		
		$this->display ();
	}
}
?>
