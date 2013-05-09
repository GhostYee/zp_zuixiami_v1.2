<?php
// 单页模型
class Qun_sortModel extends CommonModel {
	public $_validate	=	array(
			array('code','','code已经存在,请更换',Model::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
	);
}
?>