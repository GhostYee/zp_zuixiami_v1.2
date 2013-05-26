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
	 * 根据TagID取得作品信息列表
	 *
	 * @access  public
	 * @param int $tagid
	 * @return  array
	 */	 
	public function getWorksByTagID($tagid){
		$sql    = "SELECT w.*,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id".
				" author_id FROM ".C('DB_PREFIX')."works w ".
				" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
				" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
				" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
				" LEFT JOIN ".C('DB_PREFIX')."tag_relationship tr on tr.workid=w.id ".
				" WHERE w.status=2 AND tr.tagid=$tagid order by w.id desc ";
		$works  = $this->query($sql);
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
		$sql    = "SELECT * FROM ".C('DB_PREFIX')."works order by good DESC LIMIT $limit ";
		$works  =$this->query($sql);
		return $works;
	}
	/**
	 * 取得作品列表
	 *
	 * @access  public
	 * @param int $limit 数目
	 * @return  array
	 */
	public function getWorks($where='',$orderby='',$limit='20'){
		$sql    = "SELECT w.*,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id author_id FROM ".C('DB_PREFIX')."works w ".
				" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
				" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
				" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
				" where 1 $where $orderby $limit";
		$works  =$this->query($sql);
		return $works;
	}
	
}
?>