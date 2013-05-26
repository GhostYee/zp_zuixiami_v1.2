<?php
// 标签模型
class TagModel extends CommonModel {
	// 自动验证设置
	protected $_validate         =         array(
		array('tagname','require','标签名称必需填写！',1)
		);
	protected $_link = array(
		'Tag_relationship' => array(
			'mapping_type' => HAS_MANY,
			'class_name'   =>'Tag_relationship',
			'foreign_key' => 'tagid',
			)
		);
	/**
	 * 取得首页tag列表
	 *
	 * @access  public
	 * @param int $limit 数量
	 * @return  array
	 */
	public function getIndexTags($limit='10'){
		$this->ORDER("hits desc");
		$this->limit($limit);
		$tags=$this->select();
		if(!empty($tags)){
			return $tags;
		}
		return false;		
	}
	/**
	 * 作品ID取得标签列表
	 *
	 * @access  public
	 * @param int $worksid ID
	 * @return  array
	 */
	public function getTagListByWorksID($worksid){
		//表名
		$this->table($this->getTableName().' '.$this->getSmallTableName());
		$where['tag_relationship.workid']=$worksid;
		$this->where($where);
		$this->order("tag.id asc");
		$this->join(C('DB_PREFIX')."tag_relationship tag_relationship on tag_relationship.tagid=tag.id");
		$data=$this->select();
		if($this->getDbError()){
			echo $this->getLastSql()."<br><br>";
			echo $this->getDbError()."<br>";
		}
		return $data;
	}
	
}
?>
