<?php
// 群成员模型
class Website_logModel extends CommonModel {
	public $_validate	=	array(
			array('title','require','请填写标题'),
	);
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
}
?>