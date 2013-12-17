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
           $model->contents=$newcontent;
           $model->id=$_POST['id'];
           $model->addtime=time();
           $model->save();
           $this->ajaxReturn("ok",'添加成功',1);
       }else{
            $page=$this->_get('id')?$this->_get('id'):'about';
            $model = D('Pages');
            $pages=$model->getPagesByID($page);

            $this->assign('pages',$pages);
            $this->assign('id',$page);
			
			//替换模板SEO的值
			$this->seo($pages['title'].'--'.CFG("cfg_webname"),$pages['keywords'],$pages['description']);
			
            $this->display();
        }		
	}
    // ------------------------------------------------------------------------
}