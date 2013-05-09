<?php
/**
 * 系统 缓存
 */
class SyscacheAction extends CommonAction {
	/**
	 +----------------------------------------------------------
	 * 显示首页列表
	 +----------------------------------------------------------
	 */
	public function index() {
        $syscache=C('SYSCACHE_FILE');
        $this->assign('list',$syscache);
        $this->display();
    }
	/**
	 +----------------------------------------------------------
	 * 操作
	 +----------------------------------------------------------
	 */
	public function post() {
		$syscache=$_REQUEST['ids'];
		//dump($syscache);exit;
		import('@.ORG.Syscache');
		new Syscache($syscache);
		$this->success('更新成功');
	}
	// ------------------------------------------------------------------------
}
?>