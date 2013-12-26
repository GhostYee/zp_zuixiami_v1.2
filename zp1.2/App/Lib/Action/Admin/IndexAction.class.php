<?php
/**
 * 框架首页
 */
class IndexAction extends CommonAction {
    public function index() {
    	$session_user_auth_key=session(C('USER_AUTH_KEY'));
        if (isset($session_user_auth_key)) {
            //显示菜单项
            $menu = array();

            //读取数据库模块列表生成菜单项
            $node = M("Node");
            $id = $node->getField("id");
            $where ['level'] = 2;
            $where ['status'] = 1;
            $where ['pid'] = $id;
            $list = $node->where($where)->field('id,name,group_id,title')->order('sort asc')->select();
            //dump($list);
            $session__access_list=session(C('_ACCESS_LIST'));
            if(isset($session__access_list)) {
            	$accessList = session(C('_ACCESS_LIST'));
            }else{
            	import('@.ORG.Util.RBAC');
            	$accessList =   RBAC::getAccessList(session(C('USER_AUTH_KEY')));
            }
            //dump($accessList);
            foreach ($list as $key => $module) {
                if (isset($accessList [strtoupper(GROUP_NAME)] [strtoupper($module ['name'])]) || session(C('ADMIN_AUTH_KEY'))) {
                    //设置模块访问权限
                    $module ['access'] = 1;
                    $menu [$key] = $module;
                }
            }
            //dump($menu);

            if (!empty($_GET ['tag'])) {
                $this->assign('menuTag', $_GET ['tag']);
            }
            $this->assign('menu', $menu);
        }
        C('SHOW_RUN_TIME', false); // 运行时间显示
        //C('SHOW_PAGE_TRACE', false);
        $this->display();
    }

}

?>