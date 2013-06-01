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
       if(IS_AJAX){
           //此处保存数据到后台.by feenan
           $newcontent=urldecode($_POST['html']);
           $model = D('Pages');
           $pages=$model->getPagesByID($_POST['id']);
           $model->contents=$newcontent;
           $model->id=$pages["id"];
           $model->save();
           $this->ajaxReturn("ok",'添加成功',1);
       }else{
            $page=$this->_get('id')?$this->_get('id'):'about';
            $model = D('Pages');
            $pages=$model->getPagesByID($page);

            $this->assign('pages',$pages);
            $this->assign('id',$page);
            $this->display();
        }
	}
    // ------------------------------------------------------------------------
}