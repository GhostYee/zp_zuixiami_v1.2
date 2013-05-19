<?php
/**
 * 团队成员管理
 */
class Team_qunmemberAction extends CommonAction {
    /**
    +----------------------------------------------------------
     * 团队成员列表管理
    +----------------------------------------------------------
     */
    public function index() {
        $team_model = D ( 'team' );
        $team_id = $_REQUEST ['id'];

        $team=$team_model->find($team_id);
        $this->assign('team',$team);

        //列表过滤器，生成查询Map对象
        $search['keyword']=$_REQUEST['keyword'];

        $where=array();
        if(!empty($search['keyword'])){
            $where['team.teamname'] = array('like', "%" . $search['keyword'] . "%");
            $where['qun_member.name'] = array('like', "%" . $search['keyword'] . "%");
            $where['_logic'] = 'or';
        }
        if($where){
            $map['_complex'] = $where;
        }
        $map['team_qunmember.teamid']=$team_id;

        $model = D ( 'Team_qunmember' );
        if (! empty ( $model )) {
            $allinone['where']=$map;
            $allinone['field']='Team.teamname team_name,Team_qunmember.*,qun_member.name qun_member';
            $allinone['join']=array(C('DB_PREFIX')."qun_member qun_member ON Team_qunmember.qunmemberid=qun_member.id",C('DB_PREFIX')."team team ON Team_qunmember.teamid=team.id");
            $allinone['order']='team_qunmember.id DESC';
            $this->_list_sql ( $model, $allinone );
        }

        $this->assign('search',$search);
        $this->assign('team_id',$team_id);

        $this->display ();
    }
}
?>
