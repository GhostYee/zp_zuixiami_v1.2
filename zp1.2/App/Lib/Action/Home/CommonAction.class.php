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
		$this->seo(CFG("cfg_seo_title"),CFG("cfg_seo_keywords"),CFG("cfg_seo_description"));
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
		//临时设置
		session('xiami_userid',17);

		$xiami_userid=session('xiami_userid');
		if(empty($xiami_userid)){
			$this->redirect('login/relogin/?fromurl='.base64_encode($fromurl));
		}
	}
	// ------------------------------------------------------------------------
    /**
     * 网站SEO
     *
     * @access  public
     * @return  void
     */
    public function seo($title='',$keyworks='',$description=''){
    	//替换模板SEO的值
	    $seo['title']=$title;
	    $seo['keywords']=$keyworks;
	    $seo['description']=$description;
	    $this->assign('seo',$seo);
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