<?php
// 系统配置模型
class ConfigModel extends CommonModel {
	public $_validate	=	array(
		array('textname','require','名称textname必须'),
		array('code','require','code必须'),
		array('type','require','请选择类型Type'),
		//array('code','','code已经存在,请更换',Model::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
	);
}
?>