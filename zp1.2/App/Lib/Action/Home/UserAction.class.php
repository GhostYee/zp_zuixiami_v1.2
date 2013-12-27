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
    	
    	//当前页标志用户wgt_userNav
    	$this->assign('currentpage','userinfo');
    	
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
    	session('xiami_username',$user['nickname']);
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
    public function worksList(){
    	$userid=session("xiami_userid");
    	$sort=$this->_get('sort')?$this->_get('sort'):'time';//排序
    	$status=$this->_get('status')?intval($this->_get('status')):'0';//状态
    	$whois=$this->_get('whois')?$this->_get('whois'):'0';//归属
    	switch($sort){
            case 'time':
                $orderby=" addtime DESC ";
                break;
            case 'good':
                $orderby=" good DESC ";
                break;
            case 'rank':
                $orderby=" star DESC ";
                break;           
            default:
                $orderby=" addtime DESC ";
                break;
        }

    	$works_model=D("Works");
    	//个人作品
        $sql="SELECT * FROM xiami_works WHERE userid=".$userid." and status!=4 order by ".$orderby;
    	$userlist=$works_model->query($sql);
    	
    	//团队作品
    	$team_model=D("Team");
    	$teamlist=$team_model->getTeamListByUserID($userid);
    	if(!empty($teamlist)){
	    	foreach ($teamlist as $key=>$val){
	    		$teamlist[$key]['workslist']=$works_model->getWorksListWhoisByTeamID($val['id'],$sort,$status);
	    	}
    	}
    	
    	
    	//专题作品
    	
    	
    	
    	$this->assign('personlist',$userlist);
    	$this->assign('teamlist',$teamlist);
    	$this->assign('works_speciallist',works_speciallist);
    	
    	//当前页标志用户wgt_userNav
    	$this->assign('currentpage','works');
    	
    	$this->display();
    }


   

    // ------------------------------------------------------------------------
    /**
     * 用户团队列表
     *
     * @access  public
     * @return  void
     */
    public function teamList(){
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
    	
    	//当前页标志用户wgt_userNav
    	$this->assign('currentpage','team');
    		
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
    	$teamid=$this->_get('teamid')?intval($this->_get('teamid')):'0';
    	if(empty($teamid)) $this->error("找不到ID");
    	//团队信息
    	$team_model=D("Team");
    	$team=$team_model->getTeamByID($teamid);
    	$this->assign('team',$team);
    	
    	//当前页标志用户wgt_userNav
    	$this->assign('currentpage','team');
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户团队放入回收站
     *
     * @access  public
     * @return  void
     */
    public function teamDel(){
    	$userid=session("xiami_userid");
    	$teamid=$this->_get('teamid')?intval($this->_get('teamid')):'0';
    	if(empty($teamid)) $this->error("找不到ID");
    	 
    	$team_model=D("Team");
    	$where['id']=$teamid;
    	$list=$team_model->resume($where);
    	if(FALSE!==$list){
    		$this->success("删除成功");
    	}
    	else{
    		$this->error("删除失败");
    	}
    	 
    }
    // ------------------------------------------------------------------------
    /**
     * 用户团队用户列表
     *
     * @access  public
     * @return  void
     */
    public function teamUserList(){
    	$userid=session("xiami_userid");
    	$teamid=$this->_get('teamid')?intval($this->_get('teamid')):'0';
    	if(empty($teamid)) $this->error("找不到ID");
    	
    	//团队信息
    	$team_model=D("Team");
    	$team=$team_model->getTeamByID($teamid);
    	$this->assign('team',$team);
    	
    	//团队成员
    	$user_model=D("User");
    	$userlist=$user_model->getUserListByTeamID($teamid);
    	$this->assign('userlist',$userlist);
    	
    	//当前页标志用户wgt_userNav
    	$this->assign('currentpage','team');
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户团队用户删除
     *
     * @access  public
     * @return  void
     */
    public function teamUserDel(){
    	$userid=session("xiami_userid");
    	$teamid=$this->_get('teamid')?intval($this->_get('teamid')):'0';
    	$uid=$this->_get('uid')?intval($this->_get('uid')):'0';//团队用户ID
    	if(empty($teamid)) $this->error("找不到团队ID");
    	if(empty($uid)) $this->error("找不到团队用户ID");
    	 
    	$team_user_model=D("Team_user");
    	$where['teamid']=$teamid;
    	$where['userid']=$uid;
    	$list=$team_user_model->delete($where);
    	if(FALSE!==$list){
    		$this->success("删除成功");
    	}
    	else{
    		$this->error("删除失败");
    	}
    	 
    }
    // ------------------------------------------------------------------------
    /**
     * 用户留言列表
     *
     * @access  public
     * @return  void
     */
    public function message(){
    	
    	//当前页标志用户wgt_userNav
    	$this->assign('currentpage','message');
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 用户作品添加
     *
     * @access  public
     * @return  void
     */
    function worksAdd(){        
    	$works['qq']=session('we_username');
    	$this->assign('works',$works);
    	
    	//当前页标志用户wgt_userNav
    	$this->assign('currentpage','works');
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
    	
    	//当前页标志用户wgt_userNav
    	$this->assign('currentpage','works');
    	
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
    /**
     * 用户作品讨论区
     *
     * @access  public
     * @return  void
     */
    function worksMessageList(){
    	$id=$this->_get('id');
    	$model=M("Works");
    	$works=$model->getById($id);
    	$this->assign('works',$works);
    	
    	//取得评论列表
    	$model_message=D("Message");
    	$allinone_m['where']="(message.status=1 or message.status=2) and message.module='Works' and mid='".$id."' ";
    	$allinone_m['order']="message.id desc";
    	$message=$model_message->getList($allinone_m);
    	$this->assign('message',$message);
    	 
    	//当前页标志用户wgt_userNav
    	$this->assign('currentpage','message');
    	
    	//当前页标志评论留言wgt_userMessage
    	$this->assign('currPage','Works');
    	$this->assign('currId',$id);
    	$this->assign('fromurl',__INFO__);
    	 
    	$this->display();
    }
    // ------------------------------------------------------------------------
	
}