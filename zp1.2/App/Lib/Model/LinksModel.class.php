<?php
// 友情链接
class LinksModel extends CommonModel {
	public $_validate	=	array(
			//array('title','require','请填写标题！'),
			//array('code','','code已经存在,请更换',Model::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
	);
	public $_auto		=	array(
			//array('addtime','time',self::MODEL_INSERT,'function'),
	);
}
?>