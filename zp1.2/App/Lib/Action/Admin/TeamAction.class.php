<?php
/**
 * 团队管理.
 */
class TeamAction extends CommonAction{

    /**
    +----------------------------------------------------------
     * 查询关键字
    +----------------------------------------------------------
     */
    public function _filter(&$map) {
        if(!empty($_POST['keyword'])){
            $map['teamname'] = array('like', "%" . $_POST['keyword'] . "%");
            $map['_logic'] = 'or';
        }
    }

    /**
    +----------------------------------------------------------
     * 添加
    +----------------------------------------------------------
     */
    public function add() {
        $this->assign('acturl', 'insert');

        $this->display('edit');
    }
    /**
    +----------------------------------------------------------
     * 添加操作
    +----------------------------------------------------------
     */

    public function insert() {
        $name=$this->getActionName();
        $model = D ($name);
        if (false === $model->create ()) {
            $this->error ( $model->getError () );
        }
       // $model->creatime=time();

        //保存当前数据对象
        $list=$model->add();
        if ($list!==false) { //保存成功
            $this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
            $this->success ('新增成功!');
        } else {
            //失败提示
            $this->error ('新增失败!');
        }
    }
}