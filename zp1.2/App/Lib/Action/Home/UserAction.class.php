<?php
//用户
class UserAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 初始化
	 *
	 * @access  public
	 * @return  void
	 */
	public function _initialize(){
		//判断是否登陆
		$this->_check_login();
	}
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	$userid=session("xiami_userid");
    	
    	//用户信息
    	$user_model=D("User");
    	$userinfo=$user_model->getUserByID($userid); 	
    	//全部作品统计
    	$works_model=D("Works");
    	$userinfo['total_all_user_works']=$works_model->getTotalWorksByUserID($userid);
    	//团队统计
    	$team_model=D("Team_user");
    	$userinfo['total_user_team']=$team_model->getTotalTeamByUserID($userid);
    	//专题统计
    	$works_special_mid_model=D("Works_special_mid");
    	$userinfo['total_user_works_special']=$works_special_mid_model->getTotalWorksSpecialByUserID($userid);
    	
    	$this->assign('userinfo',$userinfo);
    	
    	//替换模板SEO的值
    	$seo['title']='用户中心'.'--'.CFG('cfg_webname');;
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 更新用户信息
     *
     * @access  public
     * @return  void
     */
    public function update(){
    	$userid=session("xiami_userid");
    	
    	$user=array(
    			'id'=>$userid,
    			'nickname'=>$this->_post('nickname'),
    			'figureurl'=>$this->_post('figureurl'),
    			'userurl'=>$this->_post('userurl'),
    			'notice'=>$this->_post('notice'),
    	);
    	
    	//用户信息
    	$user_model=D("User");
    	$userinfo=$user_model->getUserByID($userid);
    	
    	//处理用户地址
    	$user['userurl']=prep_url(trim($user['userurl']));
    	$user['userurl']=str_replace(array(' ','　'),array('',''),$user['userurl']);
    	
    	if (false === $user_model->create ($user)) {
    		$this->error ( $user_model->getError () );
    	}
    	if(empty($userinfo['is_open'])){
    		unset($user['nickname']);
    		unset($user['figureurl']);
    	}
    	$list=$user_model->save ($user);
    	
    	if ($list!==false) { //保存成功
    		$this->success ('保存成功！');
    	} else {
    		//失败提示
    		$this->error ('提交失败！请重试!');
    	}
    	
    }
    // ------------------------------------------------------------------------
    /**
     * 用户信息解除绑定
     *
     * @access  public
     * @return  void
     */
    public function unbind(){
    	$userid=session("xiami_userid");
    	
    	$user['id']=$userid;
    	$user['is_open']=1;
    	
    	$user_model=D("User");

    	if (false === $user_model->create ($user)) {
    		$this->error ( $user_model->getError () );
    	}
    	$list=$user_model->save ($user);
    	 
    	if ($list!==false) { //保存成功
    		$this->success ('解除绑定成功！');
    	} else {
    		//失败提示
    		$this->error ('提交失败！请重试!');
    	}
    	
    }
    
    // ------------------------------------------------------------------------
    /**
     * 用户作品列表
     *
     * @access  public
     * @return  void
     */
    public function works(){
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户团队列表
     *
     * @access  public
     * @return  void
     */
    public function team(){
    	$userid=session("xiami_userid");
    	$sort=$this->_get('sort')?$this->_get('sort'):'time';//排序
    	
    	switch($sort){
    		case 'time':
    			$orderby="team.creatime desc";
    			break;
    		case 'works':
    			$orderby="total_team_works desc";
    			break;
    		case 'user':
    			$orderby="total_team_user desc";
    			break;
    	}
    	$team_model=D("Team");
    	$teamlist=$team_model->getTeamListByUserID($userid,$orderby);
    	$this->assign('teamlist',$teamlist);
    		
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户团队编辑
     *
     * @access  public
     * @return  void
     */
    public function teamEdit(){
    	$userid=session("xiami_userid");
    
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户团队编辑
     *
     * @access  public
     * @return  void
     */
    public function teamUserList(){
    	$userid=session("xiami_userid");
    
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户团队编辑
     *
     * @access  public
     * @return  void
     */
    public function teamDel(){
    	$userid=session("xiami_userid");
    }
    // ------------------------------------------------------------------------
    /**
     * 用户留言列表
     *
     * @access  public
     * @return  void
     */
    public function message(){
    	 
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
    	 
    	$id=session('xiami_userid');
    	 
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
    	$id=$_REQUEST['id'];
    	$userid=session('xiami_userid');
    
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