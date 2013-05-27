<?php
//作者相关
class TeamAction extends CommonAction {
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

    public function view(){
    	$this->display();		
    }


    public function members(){
    	$this->display();
    }

}