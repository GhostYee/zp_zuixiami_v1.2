<?php
// 作品专题模型
class Works_specialModel extends CommonModel {
	public $_validate	=	array(
		array('title','require','请填写标题'),
	);
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
	/**
	 * 根据专题ID取得专题信息
	 *
	 * @access  public
	 * @param int/string $special_id
	 * @return  array/false
	 */
	public function getWorksSpecialList(){
		$data=$this->order('id desc')->select();
		if(!empty($data)){
			return $data;
		}
		return false;
	}
	/**
	 * 根据专题ID取得专题信息
	 *
	 * @access  public
	 * @param int/string $special_id
	 * @return  array/false
	 */
	public function getWorksSpecialByID($special_id){
		if(is_numeric($special_id)){
			$map['id']=$special_id;
		}
		else{
			$map['code']=$special_id;
		}
		$data=$this->where($map)->select();
		if(!empty($data)){
			return $data[0];
		}
		return false;
	}
	/**
	 * 作品ID取得专题列表
	 *
	 * @access  public
	 * @param int $worksid  作品ID
	 * @return  array
	 */
	public function getWorksSpecialListByWorksID($worksid){
		$where['works_special_mid.works_id']=$worksid;
		//表名
		$this->table($this->getTableName().' '.$this->getSmallTableName());
		$this->where($where);
		$this->order("works_special.id desc");
		$this->join(C('DB_PREFIX')."works_special_mid works_special_mid on works_special_mid.special_id=works_special.id");
		$data=$this->select();
		if($this->getDbError()){
			echo $this->getLastSql()."<br><br>";
			echo $this->getDbError()."<br>";
		}
		return $data;
	}
}
?>