<?php
/**
 * 框架首页
 */
class IndexAction extends CommonAction {
    public function index() {
        if (isset($_SESSION [C('USER_AUTH_KEY')])) {
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
            if(isset($_SESSION [C('_ACCESS_LIST')])) {
            	$accessList = $_SESSION [C('_ACCESS_LIST')];
            }else{
            	import('@.ORG.Util.RBAC');
            	$accessList =   RBAC::getAccessList($_SESSION[C('USER_AUTH_KEY')]);
            }
            //dump($accessList);
            foreach ($list as $key => $module) {
                if (isset($accessList [strtoupper(GROUP_NAME)] [strtoupper($module ['name'])]) || $_SESSION[C('ADMIN_AUTH_KEY')]) {
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
		//dump($_SESSION);
        $this->display();
    }

}

?>