<?php
// 作品专题模型
class Works_special_midModel extends CommonModel {
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
	/**
	 * 用户ID取得单用户专题总数
	 *
	 * @access  public
	 * @param int $userid  用户ID
	 * @return  int
	 */
	public function getTotalWorksSpecialByUserID($userid){
		$where['user.id']=$userid;
		//表名
		$this->table($this->getTableName().' '.$this->getSmallTableName());
		$this->where($where);
		$this->field("count(*) total");
		//$this->order("works_special.id desc");
		$this->join(C('DB_PREFIX')."works works on works.id=works_special_mid.works_id");
		$this->join(C('DB_PREFIX')."user user on user.id=works.userid");
		$data=$this->select();
		if($this->getDbError()){
			echo $this->getLastSql()."<br><br>";
			echo $this->getDbError()."<br>";
		}
		if(!empty($data)){
			return $data['0']['total'];
		}
		return false;
	}
}
?>