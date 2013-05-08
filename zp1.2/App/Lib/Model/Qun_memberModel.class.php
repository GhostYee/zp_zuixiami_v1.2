<?php
// 群成员模型
class Qun_memberModel extends CommonModel {
	public $_validate	=	array(
			array('qq','require','请填写QQ号码'),
	);
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
}
?>