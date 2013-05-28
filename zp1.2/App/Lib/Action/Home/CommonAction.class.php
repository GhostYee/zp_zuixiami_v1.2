<?php
/**
 * 通用Action入口模块
 */
class CommonAction extends Action {
	/**
      +----------------------------------------------------------
     * 初始化action
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    function _initialize() {
    	import("@.ORG.Util.Cookie"); //by wewe
		//取得CFG
		$this->assign("CFG",CFG(NULL,sysconfig));
		
		//替换模板SEO的值
		$seo['title']=C("CFG_SEO_TITLE");
		$seo['keywords']=C("CFG_SEO_KEYWORDS");
		$seo['description']=C("CFG_SEO_DESCRIPTION");
		$this->assign('seo',$seo);
		
    }
	/**
      +----------------------------------------------------------
     * 默认显示首页列表
     * 可以在action控制器中重载
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
	public function index() {
		
		//列表过滤器，生成查询Map对象
		$map = $this->_search ();
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		
		$this->display ();
		return;
		
	}
	// ------------------------------------------------------------------------
	/**
	 * 判断用户是否登陆
	 *
	 * @access  public
	 * @return  void
	 */
	public function _check_login(){
		$fromurl=__INFO__;
		$xiami_userid=session('xiami_userid');
		if(empty($xiami_userid)){
			//$this->error('请登录用户！',__APP__.'/user/login/?fromurl='.base64_encode($fromurl));
			$this->redirect('user/login/?fromurl='.base64_encode($fromurl));
		}
	}
	// ------------------------------------------------------------------------
	/**
	 * 404
	 *
	 * @access  public
	 * @return  void
	 */
	public function _empty(){
		header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
		$this->display("Public:404");
	}
	// ------------------------------------------------------------------------
}
?>