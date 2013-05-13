<?php
//网站更新日志
class MessageAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	//$this->_check_login();
    	
    	//替换模板SEO的值
    	$seo['title']='最蝦米*鬼懿IT*作品秀';
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 提交留言
     *
     * @access  public
     * @return  void
     */
    public function post(){    	
    	$model = D ('Message');
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		$model->ip=get_client_ip();
		$model->addtime=time();
		//保存当前数据对象
		$list=$model->add ();
		if ($list!==false) { //保存成功
			$this->success ('新增成功!');
		} else {
			//失败提示
			$this->error ('新增失败!');
		}
    }
    // ------------------------------------------------------------------------
}