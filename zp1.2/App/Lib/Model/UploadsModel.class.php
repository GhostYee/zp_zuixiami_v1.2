<?php
// 附件管理
class UploadsModel extends CommonModel {
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
}
?>