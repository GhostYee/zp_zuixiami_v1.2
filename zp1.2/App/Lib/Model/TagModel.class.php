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
}
?>
