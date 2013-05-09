<?php
// 用户模型
class MessageModel extends CommonModel {
	public $_validate	=	array(
			array('qq','require','请填写QQ号码'),
			array('content','require','请填写建议意见'),
		);

	public $_auto		=	array(
		array('addtime','time',self::MODEL_INSERT,'function'),
		);
}
?>