<?php
// 群成员分类模型
class Qun_sortModel extends CommonModel {
	public $_validate	=	array(
			array('name','require','请填写分类名'),
	);
}
?>