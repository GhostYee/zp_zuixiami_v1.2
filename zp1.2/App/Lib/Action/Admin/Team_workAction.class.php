<?php
/**
 * 团队作品管理
 */
class Team_workAction extends CommonAction {
    /**
    +----------------------------------------------------------
     * 团队作品列表管理
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
            $where['works.name'] = array('like', "%" . $search['keyword'] . "%");
            $where['_logic'] = 'or';
        }
        if($where){
            $map['_complex'] = $where;
        }
        $map['team_work.teamid']=$team_id;

        $model = D ( 'Team_work' );
        if (! empty ( $model )) {
            $allinone['where']=$map;
            $allinone['field']='Team.teamname team_name,Team_work.*,works.name works_name';
            $allinone['join']=array(C('DB_PREFIX')."works works ON Team_work.workid=works.id",C('DB_PREFIX')."team team ON Team_work.teamid=team.id");
            $allinone['order']='team_work.id DESC';
            $this->_list_sql ( $model, $allinone );
        }

        $this->assign('search',$search);
        $this->assign('team_id',$team_id);

        $this->display ();
    }
}
?>
