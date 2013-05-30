<?php
//单页
class PagesAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 单页查看页
     *
     * @access  public
     * @return  void
     */
	public function view(){
        if(!empty($_POST['xuwm'])){
           echo 'xuwenmin';
           return;
       }
		$page=$this->_get('id')?$this->_get('id'):'about';
		$model = D('Pages');
		$pages=$model->getPagesByID($page);
		
		$this->assign('pages',$pages);
		$this->assign('id',$page);
		$this->display();
	}
    // ------------------------------------------------------------------------
}