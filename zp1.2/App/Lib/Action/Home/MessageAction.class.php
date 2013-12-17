<?php
//意见和建议
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
		$this->seo('意见和建议'.'--'.CFG('cfg_webname'),CFG('cfg_seo_keywords'),CFG('cfg_seo_description'));
    	
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