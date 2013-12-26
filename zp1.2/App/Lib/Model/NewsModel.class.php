<?php
// 新闻
class NewsModel extends CommonModel {
	public $_validate	=	array(
			array('title','require','请填写标题！'),
			//array('code','','code已经存在,请更换',Model::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
	);
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
	/**
	 * 取得所有数据列表
	 * @param sting $pid 级别
	 * @return array
	 */
	public function getList($allinone){
		//表名
		$this->table($this->getTableName().' '.$this->getSmallTableName());
	
		$join=array(
				//关联作品分类
				C('DB_PREFIX')."news_lang news_lang ON news_lang.mid=news.id"
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
		$this->field("news.*,"
				."news_lang.title,news_lang.keywords,news_lang.description,news_lang.contents "
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