<?php
// 团队模型
class TeamModel extends CommonModel {
    public $_validate	=	array(
        array('teamname','require','团队名称必填')
    );

    public $_auto		=	array(
        array('creatime','time',self::MODEL_INSERT,'function'),
    );
    // ------------------------------------------------------------------------
    /**
     * 根据ID取得用户信息
     *
     * @access  public
     * @param int/string $id
     * @return  array/false
     */
    public function getTeamByID($id){
    	$map['team.id']=$id;
    	$limit=1;
    	$allinone['where']=$map;
    	$allinone['limit']=$limit;
    	$allinone['field']="IF(creatuser.is_open=1,creatuser.nickname,creatuser.auth_nickname) creatusername";
    	$allinone['join']=array(
    			C('DB_PREFIX')."user creatuser ON creatuser.id=team.creatuserid"
    		);
    	$data=$this->getTeamList($allinone);
    	if($this->getDbError()){
    		echo $this->getLastSql()."<br><br>";
    		echo $this->getDbError()."<br>";
    	}
    	if(!empty($data)){
    		return $data[0];
    	}
    	return false;
    }
    // ------------------------------------------------------------------------
    /**
     * 根据用户ID取得团队列表
     *
     * @access  public
     * @param int/string $user_id
     * @return  array/false
     */
    public function getTeamListByUserID($user_id){
    	$map['user.id']=$user_id;
    	$orderby="team.id desc";
    	    	
		$allinone['where']=$map;
    	$allinone['order']=$orderby;
    	$data=$this->getTeamList($allinone);
    	if($this->getDbError()){
    		echo $this->getLastSql()."<br><br>";
    		echo $this->getDbError()."<br>";
    	}
    	return $data;
    }
    /**
     +----------------------------------------------------------
     * 取得团队列表
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
    public function getTeamList($allinone){
    	//表名
		$this->table($this->getTableName().' '.$this->getSmallTableName());
		
		$join=array(
				//关联团队成员
    			C('DB_PREFIX')."team_user team_user ON team_user.teamid=team.id",
    			//关联用户表
    			C('DB_PREFIX')."user user ON user.id=team_user.userid"
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
		$this->field("team.*,"
				."(SELECT count(*) FROM ".C('DB_PREFIX')."team_user allteam_user WHERE allteam_user.userid=user.id) total_team_user,"
				."(SELECT count(*) FROM ".C('DB_PREFIX')."team_work allteam_work WHERE allteam_work.teamid=team.id) total_team_works "
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