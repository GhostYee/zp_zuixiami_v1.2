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
    	$sort=$this->_get('sort')?$this->_get('sort'):'time';//排序
    	//取得团队信息
    	$team_model=D("Team");
    	$team=$team_model->getTeamByID($teamid);
    	$this->assign('team',$team);
    	
    	//取得用户列表
    	$user_model=D("User");
    	//判断排序
    	switch($sort){
    		case 'time':
    			$orderby=" user.addtime DESC ";
    			break;
    		case 'hits':
    			$orderby=" user.hits DESC ";
    			break;
    		case 'await':
    			$orderby=" user.await DESC ";
    			break;
    		default:
    			$orderby=" works.await DESC ";
    			break;
    	}
    	$allinone['order']=$orderby;
    	$userlist=$user_model->getUserListByTeamID($teamid,$allinone);
    	$this->assign('userlist',$userlist);

    	 
    	//替换模板SEO的值
    	$seo['title']=$team['teamname'].'团队成员'.'--'.CFG('cfg_webname');
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
    public function view(){
    	$teamid=$this->_get('id')?intval($this->_get('id')):'0';
    	$sort=$this->_get('sort')?$this->_get('sort'):'time';//排序
    	
    	//取得团队信息
    	$team_model=D("Team");
    	$team=$team_model->getTeamByID($teamid);
    	$this->assign('team',$team);
    	
    	//作品列表
    	$works_model=D('Works');
    	//判断排序
    	switch($sort){
    		case 'time':
    			$orderby=" works.addtime DESC ";
    			break;
    		case 'good':
    			$orderby=" works.good DESC ";
    			break;
    		case 'rank':
    			$orderby=" star DESC ";
    			break;
    		default:
    			$orderby=" works.good DESC ";
    			break;
    	}
		
    	$allinone['order']=$orderby;
    	$allinone['join']=array(
    			C('DB_PREFIX')."team_work team_work ON team_work.workid=works.id ",
    			C('DB_PREFIX')."team team ON team.id=team_work.teamid"
    	);
    	$workslist  = $works_model->getWorksListByTeamID($teamid,$allinone);
    	$this->assign('workslist',$workslist);
    	
    	//替换模板SEO的值
    	$seo['title']=$team['teamname'].'团队作品'.'--'.CFG('cfg_webname');
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	
    	$this->display();		
    }
    // ------------------------------------------------------------------------
    /**
     * 提交
     *
     * @access  public
     * @return  void
     */
    public function submit(){
    	$this->display();
    }
    // ------------------------------------------------------------------------

}