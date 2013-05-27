<?php
//作者相关
class AuthorAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index()
    {
    	$userid=$this->_get('id')?intval($this->_get('id')):'0';
    	$sort=$this->_get('sort')?$this->_get('sort'):'time';//排序
    	
    	//取得作者信息
    	$user_model=D('User');
    	$author=$user_model->getUserByID($userid);
    	$this->assign('author',$author);
    	if(empty($author)){
    		$this->error('未找到此作者信息');
    	}		
    		
    		//取得作品列表
    		$works_model=D('Works');
    		$where['user.id']=$userid;
    		
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
    		 
    		// 取出需要的数据
    		$allinone['where']=$where;
    		$allinone['order']=$orderby;
    		$workslist  = $works_model->getWorksList($allinone);
    		$this->assign('workslist',$workslist);
			
	    	//替换模板SEO的值
	    	$seo['title']=$author['nickname'].'的作品列表'.'--'.CFG('cfg_webname');
	    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
	    	$seo['description']=C("CFG_SEO_DESCRIPTION");
	    	$this->assign('seo',$seo);
	    	
	    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 作者团队列表
     *
     * @access  public
     * @return  void
     */
    public function team()
    {
    	$userid=$this->_get('id')?intval($this->_get('id')):'0';//取得用户ID
    	//取得作者信息
    	$user_model=D('User');
    	$author=$user_model->getUserByID($userid);
    	$this->assign('author',$author);
    	
    	if(empty($author)){
    		$this->error('未找到此作者信息');
    	}	
    	
    	//团队列表
    	$team_model=D("Team");
    	$teamlist=$team_model->getTeamListByUserID($userid);
    	$this->assign('teamlist',$teamlist);
    	
    	//替换模板SEO的值
    	$seo['title']=$author['nickname'].'的团队列表'.'--'.CFG('cfg_webname');
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	
    	$this->display();
    }
    /**
     * 作者留言列表
     *
     * @access  public
     * @return  void
     */
    public function message()
    {
    	$userid=$this->_get('id')?intval($this->_get('id')):'0';//取得用户ID
    	//取得作者信息
    	$user_model=D('User');
    	$author=$user_model->getUserByID($userid);
    	$this->assign('author',$author);
    	if(empty($author)){
    		$this->error('未找到此作者信息');
    	}	
    	
    	//替换模板SEO的值
    	$seo['title']=$author['nickname'].'的留言列表'.'--'.CFG('cfg_webname');
    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
    	$seo['description']=C("CFG_SEO_DESCRIPTION");
    	$this->assign('seo',$seo);
    	
    	$this->display();
    }    
    // ------------------------------------------------------------------------
}