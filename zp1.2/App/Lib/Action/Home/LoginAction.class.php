<?php
//用户登录
class LoginAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 会员登陆显示页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	$fromurl=$this->_get('fromurl');
		$this->assign('fromurl',$fromurl);
		//session_destroy();
		//session('xiami_userid',1);
		//session('xiami_username','用户名');
		
		//替换模板SEO的值
		$this->seo('会员绑定登录'.'--'.CFG('cfg_webname'),CFG('cfg_seo_keywords'),CFG('cfg_seo_description'));
		
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
			session('xiami_userid',$qun_member['id']);
			session('we_username',$username);
			//存cookie一年
			cookie("zuixiami_works_qq",$username,3600*24*30);
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
	/**
	 * 第三方登录入口
	 *
	 * @access  public
	 * @return  void
	 */
	public function auth_login($type = null){
		empty($type) && $this->error('参数错误');
		
		//加载ThinkOauth类并实例化一个对象
		import("ORG.ThinkSDK.ThinkOauth");
		$sns  = ThinkOauth::getInstance($type);
		
		//跳转到授权页面
		redirect($sns->getRequestCodeURL());
	}
	// ------------------------------------------------------------------------
	/**
	 * 第三方登录回调地址测试
	 *
	 * @access  public
	 * @return  void
	 */
	public function auth_callback($type = null, $code = null){
		(empty($type) || empty($code)) && $this->error('参数错误');		
		
		//加载ThinkOauth类并实例化一个对象
		import("ORG.ThinkSDK.ThinkOauth");
		$sns  = ThinkOauth::getInstance($type);
		
		//请妥善保管这里获取到的Token信息，方便以后API调用
		//调用方法，实例化SDK对象的时候直接作为构造函数的第二个参数传入
		//如： $qq = ThinkOauth::getInstance('qq', $token);
		$token = $sns->getAccessToken($code , null);
		
		//获取当前登录用户信息
		$userInfo=null;
		if(is_array($token)){
			switch ($type) {
				case 'qq':
					$qq   = ThinkOauth::getInstance('qq', $token);
					$data = $qq->call('user/get_user_info');
					$userInfo["openid"]=$token["openid"];
					if($data['ret'] == 0){
						$userInfo['type'] = 'QQ';
						$userInfo['nickname'] = $data['nickname'];				
						$userInfo['figureurl'] = $data['figureurl_qq_2'];				
					} else {
						throw_exception("获取腾讯QQ用户信息失败：{$data['msg']}");
						echo("获取腾讯QQ用户信息失败：{$data['msg']}");
					}			
				break;	
				case 'sina':
				    $token['uid']=$token['openid'];
					$sina   = ThinkOauth::getInstance('sina', $token);									
					$data = $sina->call('users/show','uid='.$token['uid'].'&access_token='.$token['access_token']);					
					$userInfo["openid"]=$token["openid"];
					if($data['ret'] == 0){
						$userInfo['type'] = $type;
						$userInfo['nickname'] = $data['name'];				
						$userInfo['figureurl'] = $data['profile_image_url'];				
					} else {
						throw_exception("获取新浪用户信息失败：{$data['msg']}");
						echo("获取新浪用户信息失败：{$data['msg']}");
					}							
				default:
					# code...
					break;
			}
			
		}
		// 是否已经有该openid		
		$model = D ('user');	
		if(!empty($userInfo["openid"])){
    		$have_openid=$model->where("openid='".$userInfo["openid"]."'")->find(); 

    		if($have_openid)
    		{
    			if(!empty($have_openid["qq"]) || $have_openid["qq"]!='0' )
    			{
    				session('xiami_userid',$have_openid["id"]);
					session('xiami_username',$have_openid['nickname']);
					session('xiami_userqq',$have_openid['qq']);
					redirect("../user/");    				
    			}    			
    		}
    	}
    	$this->assign('userInfo',$userInfo);    	
    	$this->display('index');		
	}

	public function relogin() {	
     	$this->display('login-select-type');     	
    }



    // ------------------------------------------------------------------------

     public function insert() {	
     	
     	$openid=$_POST['openid'];
     	$type=$_POST['type'];
     	$nickname=$_POST['nickname'];
     	$figureurl=$_POST['figureurl'];
     	$qq=$_POST['qq'];
     	$id=0;
     	
    	$model = D ('user');
    	$have_openid=$model->where("qq='".$qq."'")->find();     	  	
    	if(count($have_openid))
    	{    		
    		$id=$have_openid["id"];
			$sql="update xiami_user set openid='".$openid."',type='".$type."',nickname='".$nickname."',figureurl='".$figureurl."',qq='".$qq."' where id=".$have_openid["id"]." and ((openid='0' || openid = '') or type!='".$type."')";
			$model->query($sql);    		
    	}
    	else
    	{
    		$sql="insert into xiami_user (openid,type,nickname,figureurl,qq) values ('".$openid."','".$type."','".$nickname."','".$figureurl."','".$qq."')";
			$model->query($sql);
			$id=mysql_insert_id();
    	}
    	$model=D('works');
    	$sql="update xiami_works set userid='".$id."',type='".$type."',author='".$nickname."' where qq='".$qq."'";
		$model->query($sql);    	
    	session('xiami_userid',$id);
		session('xiami_username',$nickname);
		session('xiami_userqq',$qq);

    	redirect("../user/");
    }
}