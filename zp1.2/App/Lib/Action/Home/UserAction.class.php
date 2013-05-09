<?php
//用户
class UserAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	//跳转
    	$this->redirect('user/workslist');
    	
    	//替换模板SEO的值
    	$seo['title']='最蝦米*鬼懿IT*作品秀';
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户作品列表管理
     *
     * @access  public
     * @return  void
     */
    public function workslist(){
    	$keywords=trim($_POST['keywords']);
    	$keywords=!empty($keywords)?$keywords:'';
    	$status=empty($_REQUEST['status'])?'2':$_REQUEST['status'];
    	 
    	//判断是否登陆
    	$this->_check_login();
    	$id=session('we_userid');
    	 
    	//取得用户信息
    	$qun_member_model=M('qun_member');
    	$qun_member=$qun_member_model->where("`id`='$id'")->find();
    	 
    	if($qun_member){
    		$works_model=D('works');
    		//状态
    		$where.=" AND w.`status`='$status' ";
    
    		//作者
    		$where.=" AND qm.`id`='$qun_member[id]' ";    		
    
    		//判断排序
    		$index_works_order=CFG('cfg_index_works_order');
    
    		if($index_works_order){
    			$orderby=" ORDER BY $index_works_order ";
    		}
    		else{
    			//排序推荐 降序，推荐排序降序，ID 升序
    			$orderby=" ORDER BY w.is_top DESC,w.top_sid DESC,w.id DESC ";
    		}
    		/*
    		 //判断显示条数
    		$index_works_num=CFG('cfg_index_works_num');
    		if($index_works_num){
    		$limit=" limit $index_works_num ";
    		}
    		*/
    		// 取出需要的数据
    		$sql	= "SELECT w.*,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id author_id FROM ".C('DB_PREFIX')."works w ".
    				" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
    				" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
    				" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
    				" where 1 $where $orderby";
    		$works	= $works_model->query($sql);
    		
    		//统计
    		$total['nochecked']=$this->_get_user_works_count(1,$qun_member[id]);
    		$total['checked']=$this->_get_user_works_count(2,$qun_member[id]);
    		$total['checkedn']=$this->_get_user_works_count(3,$qun_member[id]);
    		$this->assign('total',$total);
    		
    
    		$this->assign('works',$works);
    		$this->assign('keywords',$keywords);
    		$this->assign('status',$status);
    		$this->assign('id',$qun_member['id']);
    		$this->assign('qun_member',$qun_member);
    
    		//替换模板SEO的值
    		$seo['title']='最蝦米*鬼懿IT*作品秀';
    		$seo['keywords']=C("CFG_SEO_KEYWORDS");
    		$seo['description']=C("CFG_SEO_DESCRIPTION");
    		$this->assign('seo',$seo);
    
    		$this->display();
    	}
    	else{
    		$this->error('未找到此作者信息');
    	}
    }
    // ------------------------------------------------------------------------
    /**
     * 用户作品添加
     *
     * @access  public
     * @return  void
     */
    function worksadd(){
        $this->_check_login();
        
    	$works['qq']=session('we_username');
    	$this->assign('works',$works);
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户作品添加操作
     *
     * @access  public
     * @return  void
     */
    function worksinsert(){
        $this->_check_login();
    	R('Home/Works/post');
    }
    // ------------------------------------------------------------------------
    /**
     * 用户作品编辑
     *
     * @access  public
     * @return  void
     */
    function worksedit(){
        $this->_check_login();
    	$id=$this->_get('id');
    	$model=M("Works");
    	$works=$model->getById($id);
    	$this->assign('works',$works);
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户作品编辑操作
     *
     * @access  public
     * @return  void
     */
    function worksupdate(){
        $this->_check_login();
    	R('Home/Works/post');
    }
    // ------------------------------------------------------------------------
    /**
     * 用户作品删除
     *
     * @access  public
     * @return  void
     */
    function worksdelete(){
    	$this->_check_login();
    	$id=$_REQUEST['id'];
    	$userid=session('we_userid');
    
    	$status_lang['1']='等待审核';
    	$status_lang['2']='通过审核';
    	$status_lang['3']='审核不通过';
    	
    	//取得用户信息
    	$qun_member_model=M('qun_member');
    	$qun_member=$qun_member_model->where("`id`='$userid'")->find();
    	
    	//取得作品信息
	    $model=M('Works');
	    $works=$model->where("`id`='$id' and qq='$qun_member[qq]'")->find();
	    if(!empty($works)){
	    		//更新状态
	    		$rs=$model->where("id='$id'")->setField('status','4');
	    		if($rs!==false){
	    			R('Home/Works/works_log',array($id,'status',$status_lang[$works[status]].' => 回收站'));
	    			$this->success('删除成功');
	    		}
	    		else {
	    			$this->error('删除失败');
	    		}
	    			
	    }
	    else{
	    	$this->error('未找到此作者作品信息');
	    }

    }
	// ------------------------------------------------------------------------
	/**
	 * 会员登陆显示页
	 *
	 * @access  public
	 * @return  void
	 */
	public function login(){
		$fromurl=$this->_get('fromurl');
		$this->assign('fromurl',$fromurl);
		
		//替换模板SEO的值
		$seo['title']='最蝦米*鬼懿IT*作品秀';
		$seo['keywords']=C("CFG_SEO_KEYWORDS");
		$seo['description']=C("CFG_SEO_DESCRIPTION");
		$this->assign('seo',$seo);
		
		$this->display();
	}
	// ------------------------------------------------------------------------
	/**
	 * 会员登陆操作
	 *
	 * @access  public
	 * @return  void
	 */
	public function login_do(){
		$username=$this->_post('qqusername');
		$fromurl=$this->_post('fromurl');
		
		$model=D('qun_member');
		//判断是否群成员
		$map['qq']=$username;
		$qun_member=$model->where($map)->find();
		if($qun_member){
			session('we_userid',$qun_member['id']);
			session('we_username',$username);
			//存cookie一年
			cookie("zuixiami_works_qq",$username,3600*24*365);
			if(!empty($fromurl)){
				$jump_url=__APP__.base64_decode($fromurl);//进入最后浏览页
			}
			else{
				$jump_url=__APP__.'/user';//进入会员中心
			}
			$this->success('登陆成功',$jump_url,'1000');
		}
		else{
			if(!empty($fromurl)){
				$jump_url=__APP__.'/user/fromurl/'.$fromurl;//进入会员中心
			}
			$this->success('QQ号码错误,请重新输入!',__URL__/login,'1000');
		}
	}
	// ------------------------------------------------------------------------
	/**
	 * 会员退出操作
	 *
	 * @access  public
	 * @return  void
	 */
	public function logout(){
		session_destroy();
		$this->success('注销成功',__APP__,'1000');
	}
	// ------------------------------------------------------------------------
	// ------------------------------------------------------------------------
	// ------------------------------------------------------------------------
	// ------------------------------------------------------------------------
	/**
	 * 取得用户作品状态总计
	 *
	 * @access  public
	 * @return  void
	 */
	protected function _get_user_works_count($status='',$userid=''){
		$where='';
		if($userid){
			$where.=" AND qm.`id`='$userid' ";
		}
		if($status){
			$where.=" AND w.`status`='$status' ";
		}
		$works_model=D('works');
		//统计
		$sql	= "SELECT count(*) num FROM ".C('DB_PREFIX')."works w ".
				" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
				" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
				" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
				" where 1 $where ";
		$works=$works_model->query($sql);
		if($works!==false){
			return $works[0][num];
		}
	}
    // ------------------------------------------------------------------------
	
}