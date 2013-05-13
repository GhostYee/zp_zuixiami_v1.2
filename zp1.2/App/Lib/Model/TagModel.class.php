<?php
// 标签模型
class TagModel extends RelationModel {
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
}
?>
