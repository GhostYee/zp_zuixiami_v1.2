<?php
// 用户模型
class MessageModel extends CommonModel {
	/*
	public $_validate	=	array(
			array('qq','require','请填写QQ号码'),
			array('content','require','请填写建议意见'),
		);
	*/
	public $_auto		=	array(
		array('addtime','time',self::MODEL_INSERT,'function'),
	);
	/**
	 +----------------------------------------------------------
	 * 取得信息列表
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
	public function getList($allinone){
		//表名
		$this->table($this->getTableName().' '.$this->getSmallTableName());
	
		$join=array(
				//关联用户
				C('DB_PREFIX')."user from_user ON from_user.id=message.from_user_id",
				//关联用户
				C('DB_PREFIX')."user to_user ON to_user.id=message.to_user_id"
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
		$this->field("message.*,from_user.nickname from_user_nickname,from_user.figureurl from_user_figureurl,to_user.nickname to_user_nickname "
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
}
?>