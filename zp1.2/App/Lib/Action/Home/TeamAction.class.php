<?php
//团队相关
class TeamAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	//取得团队列表
    	$team_model=D("Team");
    	$allinone['order']="team.id desc";
    	$teamlist=$team_model->getTeamList($allinone);
    	$this->assign('teamlist',$teamlist);
    	
    	//替换模板SEO的值
    	$seo['title']='团队列表'.'--'.CFG('cfg_webname');
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	
    	$this->display();		
    }
    // ------------------------------------------------------------------------
    /**
     * 用户列表
     *
     * @access  public
     * @return  void
     */
    public function user(){
    	$teamid=$this->_get('id')?intval($this->_get('id')):'0';
    	//取得团队信息
    	$team_model=D("Team");
    	$team=$team_model->getTeamByID($teamid);
    	$this->assign('team',$team);
    	
    	//取得用户列表
    	$user_model=D("User");
    	$userlist=$user_model->getUserListByTeamID($teamid);
    	$this->assign('userlist',$userlist);
    	 
    	//替换模板SEO的值
    	$seo['title']=$team['teamname'].'用户列表'.'--'.CFG('cfg_webname');
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	 
    	$this->display();
    }
    // ------------------------------------------------------------------------

    public function view(){
    	$teamid=$this->_get('id')?intval($this->_get('id')):'0';
    	$this->display();		
    }


    public function members(){
    	$this->display();
    }

}