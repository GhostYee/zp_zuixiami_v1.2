<?php
// 作品专题模型
class Works_specialModel extends CommonModel {
	public $_validate	=	array(
		array('title','require','请填写标题'),
	);
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
}
?>