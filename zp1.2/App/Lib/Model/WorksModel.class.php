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
}
?>