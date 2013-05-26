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
	/**
	 * 取得首页tag列表
	 *
	 * @access  public
	 * @param int $limit 数量
	 * @return  array
	 */
	public function getIndexTags($limit='10'){
		$sql    = "SELECT * from ".C('DB_PREFIX')."tag order by hits desc limit $limit";
		$tags  = $this->query($sql);
		return $tags;
	}
	
}
?>
