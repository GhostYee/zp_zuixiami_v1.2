<?php
// 用户模型
class UserModel extends CommonModel {
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
	// ------------------------------------------------------------------------
	/**
	 * 根据ID取得用户信息
	 *
	 * @access  public
	 * @param int/string $id
	 * @return  array/false
	 */
	public function getUserByID($id){
		$map['user.id']=$id;
		$limit=1;
		$allinone['where']=$map;
		$allinone['limit']=$limit;
		$data=$this->getUserList($allinone);
		if($this->getDbError()){
			echo $this->getLastSql()."<br><br>";
			echo $this->getDbError()."<br>";
		}
		if(!empty($data)){
			return $data[0];
		}
		return false;
	}
	/**
	 * 根据作品ID取得用户信息
	 *
	 * @access  public
	 * @param int/string $id
	 * @return  array/false
	 */
	public function getUserByWorksID($works_id){
		$map['works.id']=$works_id;
		$limit=1;
		
		$allinone['where']=$map;
		$allinone['limit']=$limit;
		$allinone['join']=array(
					C('DB_PREFIX')."works works ON works.userid=user.id"
				);
		$data=$this->getUserList($allinone);
		if($this->getDbError()){
			echo $this->getLastSql()."<br><br>";
			echo $this->getDbError()."<br>";
		}
		if(!empty($data)){
			return $data[0];
		}
		return false;
	}
	/**
	 * 根据团队ID取得用户列表
	 *
	 * @access  public
	 * @param int/string $teamid
	 * @return  array/false
	 */
	public function getUserListByTeamID($teamid,$allinone){
		$map['team_user.teamid']=$teamid;
	
		$all['where']=$map;
		$all['join']=array(
				C('DB_PREFIX')."team_user team_user ON team_user.userid=user.id"
		);
		if($allinone){
			$all=array_merge($all,$allinone);
		}
		$data=$this->getUserList($all);
		if($this->getDbError()){
			echo $this->getLastSql()."<br><br>";
			echo $this->getDbError()."<br>";
		}
		return $data;
	}
	/**
	 +----------------------------------------------------------
	 * 取得用户列表
	 * 进行列表过滤
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param Model $model 数据对象
	 * @param mix $allinone DB操作
	 *  //where
	 //field 请注意已默认的字段
	 //join array()方式获取
	 //union  //未测试
	 //group  //未测试
	 //having //未测试
	 //relation //未测试
	 //page
	 //order
	 *
	 +----------------------------------------------------------
	 * @return void
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	public function getUserList($allinone){
		//表名
		$this->table($this->getTableName().' '.$this->getSmallTableName());
	
		$join=array(
				//关联群成员
			    C('DB_PREFIX')."qun_member qun_member ON qun_member.qq=user.qq",
				//关联群分类
				C('DB_PREFIX')."qun_sort qun_sort ON qun_sort.id=qun_member.qun_sort_id"
		);
	
		//条件
		if($allinone['where']){
			$this->where($allinone['where']);
		}
		//查询字段
		if($allinone['field']){
			$field=', '.$allinone['field'];
		}
		//join
		if($allinone['join']){
			$join=array_merge($join,$allinone['join']);
		}
		//联合
		if($allinone['union']){
			$this->union($allinone['union']);
		}
		//分组
		if($allinone['group']){
			$this->group($allinone['group']);
		}
		//having
		if($allinone['having']){
			$this->having($allinone['having']);
		}
		//关联查询
		if($allinone['relation']){
			$this->relation($allinone['relation']);
		}
		//排序
		if($allinone['order']){
			$this->ORDER($allinone['order']);
		}
		//limit
		if(!empty($allinone['limit'])){
			$this->limit($allinone['limit']);
		}
		//分页
		if(!empty($allinone['page'])){
			$this->page($allinone['page']);
		}
	
		//查询字段
		$this->field("user.*,IF(user.is_open=1,user.nickname,user.auth_nickname) nickname,qun_sort.name qunname,"
				."(SELECT count(*) FROM ".C('DB_PREFIX')."works works WHERE works.userid=user.id) total_user_works"
				.$field);
		//join
		$this->join($join);
		$data  =$this->select();
	
		if($this->getDbError()){
			echo $this->getLastSql()."<br><br>";
			echo $this->getDbError()."<br>";
		}
		return $data;
	}
}
?>