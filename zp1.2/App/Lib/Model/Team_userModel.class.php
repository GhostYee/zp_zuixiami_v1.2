<?php
// 团队用户模型
class Team_userModel extends CommonModel {
	
	/**
	 * 根据用户ID取得单用户团队总数
	 *
	 * @access  public
	 * @param int $userid
	 * @return  array
	 */
	public function getTotalTeamByUserID($userid){
		$where['user.id']=$userid;
	
		$this->table($this->getTableName().' '.$this->getSmallTableName());
		$this->where($where);
		$this->field("count(*) total");
		$this->join(C('DB_PREFIX')."user user on user.id=team_user.userid");
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