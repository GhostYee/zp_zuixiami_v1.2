<?php
// 团队模型
class TeamModel extends CommonModel {
    public $_validate	=	array(
        array('teamname','require','团队名称必填')
    );

    public $_auto		=	array(
        array('creatime','time',self::MODEL_INSERT,'function'),
    );
}
?>