<?php
// 作品模型
class WorksModel extends CommonModel {
	public $_validate	=	array(
		array('qq','require','QQ号码必须'),
		array('url','require','作品地址必须'),
	);
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
	
	/**
	 * 根据ID取得单个作品信息
	 *
	 * @access  public
	 * @param int $tagid
	 * @return  array
	 */
	public function getWorksByID($works_id,$allinone){
		$where['works.id']=$works_id;
		$limit="1";
		$all['where']=$where;
		$all['limit']=$limit;
		if($allinone){
			$all=array_merge($all,$allinone);
		}
		$works  = $this->getWorksList($all);
		if($works){
			return $works[0];
		}
		return false;
	}
	/**
	 * 根据用户ID取得作品列表
	 *
	 * @access  public
	 * @param int $userid
	 * @return  array
	 */
	public function getWorksListByUserID($userid,$allinone){
		$where['works.userid']=$userid;
		$all['where']=$where;
		if($allinone){
			$all=array_merge($all,$allinone);
		}
		$works  = $this->getWorksList($all);
		return $works;
	}
	/**
	 * 根据用户ID及归属取得作品列表
	 *
	 * @access  public
	 * @param int $userid 用户ID
	 * @param int $status 状态
	 * @param string $whois 归属 用户user/团队team
	 * @param string $sort 排序time/good/rank
	 * @return  array
	 */
	public function getUserWorksListByUserID($userid,$status='',$sort=''){
		//状态
		if(!empty($status)) $where['works.status']=$status;
		//归属
		$where['teamid']=array('eq','');
		$where['works.userid']=	$userid;	
		//判断排序
		switch($sort){
			case 'time':
    			$orderby=" works.addtime DESC ";
    			break;
    		case 'good':
    			$orderby=" works.good DESC ";
    			break;
    		case 'rank':
    			$orderby=" star DESC ";
    			break;
    		default:
    			$orderby=" works.good DESC ";
    			break;
		}
		$allinone['where']=$where;
		$allinone['order']=$orderby;
		$allinone['field']="team_work.teamid teamid";
		$allinone['join']=array(
				C('DB_PREFIX')."team_work team_work on team_work.workid=works.id",
			);
		$works  = $this->getWorksListByUserID($userid,$allinone);
		return $works;
	}
	/**
	 * 根据团队ID取得作品列表
	 *
	 * @access  public
	 * @param int $team_id
	 * @return  array
	 */
	public function getWorksListByTeamID($team_id,$allinone){
		$where['team.id']=$team_id;
		$all['where']=$where;
		if($allinone){
			$all=array_merge($all,$allinone);
		}
		$works  = $this->getWorksList($all);
		return $works;
	}
	/**
	 * 根据用户ID及归属取得作品列表
	 *
	 * @access  public
	 * @param int $userid 用户ID
	 * @param int $status 状态
	 * @param string $whois 归属 用户user/团队team
	 * @param string $sort 排序time/good/rank
	 * @return  array
	 */
	public function getWorksListWhoisByTeamID($teamid,$status='',$sort=''){
		//状态
		if(!empty($status)) $where['works.status']=$status;
		//判断排序
		switch($sort){
			case 'time':
				$orderby=" works.addtime DESC ";
				break;
			case 'good':
				$orderby=" works.good DESC ";
				break;
			case 'rank':
				$orderby=" star DESC ";
				break;
			default:
				$orderby=" works.good DESC ";
				break;
		}
		$allinone['where']=$where;
		$allinone['order']=$orderby;
		$allinone['join']=array(
				C('DB_PREFIX')."team_work team_work on team_work.workid=works.id",
		);
		$works  = $this->getWorksListByTeamID($teamid,$allinone);
		if($this->getDbError()){
			echo $this->getLastSql()."<br><br>";
			echo $this->getDbError()."<br>";
		}
		return $works;
	}
	
	/**
	 * 根据TagID取得作品信息列表
	 *
	 * @access  public
	 * @param int $tagid
	 * @return  array
	 */	 
	public function getWorksByTagID($tagid){
		$where['works.status']=2;
		$where['tag_relationship.tagid']=$tagid;		
		$orderby="works.id desc";
		$allinone['where']=$where;
		$allinone['order']=$orderby;
		$allinone['join']=array(
				C('DB_PREFIX')."tag_relationship tag_relationship ON tag_relationship.workid=works.id ",
				C('DB_PREFIX')."tag tag ON tag.id=tag_relationship.tagid"
		);
		$works  = $this->getWorksList($allinone);
		return $works;
	}
	/**
	 * 取得作品热度排行
	 *
	 * @access  public
	 * @param int $limit 数目
	 * @return  array
	 */
	public function getWorksGoodRanking($limit='5'){
		$sql    = "SELECT * FROM ".C('DB_PREFIX')."works where status=2 order by addtime DESC LIMIT $limit ";
		$works  =$this->query($sql);
		return $works;
	}
	/**
     +----------------------------------------------------------
     * 取得作品列表
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
	public function getWorksList($allinone){
		//表名
		$this->table($this->getTableName().' '.$this->getSmallTableName());
		
		$join=array(
				//关联作品分类
				C('DB_PREFIX')."works_sort works_sort ON works_sort.id=works.sortid",
				//关联用户
				C('DB_PREFIX')."user user ON user.id=works.userid",
				//关联群分类
				C('DB_PREFIX')."qun_sort qun_sort ON qun_sort.id=works.qun_sortid",
				//关联群成员
				C('DB_PREFIX')."qun_member qun_member ON qun_member.qq=works.qq"
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
		$this->field("works.*,user.figureurl figureurl,user.await await,"
				."user.nickname nickname,IFNULL(works.author,nickname) author,"
				."works_sort.name sortname,qun_sort.name qunname,"
				."ceil(works.rank_total/works.rank_count) as star,round(ceil(works.rank_total/works.rank_count)/10,1) rank "
				.$field);
		//join
		$this->join($join);
		
		$works  =$this->select();
		if($this->getDbError()){
			echo $this->getLastSql()."<br><br>";
			echo $this->getDbError()."<br>";
		}
		
		return $works;
	}
	/**
	 * 根据用户ID取得单用户作品总数
	 *
	 * @access  public
	 * @param int $userid
	 * @param int $works_status 作品状态
	 * @return  array
	 */
	public function getTotalWorksByUserID($userid,$works_status=''){
		$where['user.id']=$userid;
		if($works_status) $where['works.status']=$works_status;
		
		$this->table($this->getTableName().' '.$this->getSmallTableName());
		$this->where($where);
		$this->field("count(*) total");
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