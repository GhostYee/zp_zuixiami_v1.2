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
		
		session('xiami_userid',1);
		session('xiami_username','用户名');
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
			session('xiami_userid',$qun_member['id']);
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
		$token = $sns->getAccessToken($code , $extend);
		
		//获取当前登录用户信息
		if(is_array($token)){
			$qq   = ThinkOauth::getInstance('qq', $token);
			$data = $qq->call('user/get_user_info');
			
			if($data['ret'] == 0){
				$userInfo['type'] = 'QQ';
				$userInfo['name'] = $data['nickname'];
				$userInfo['nick'] = $data['nickname'];
				$userInfo['head'] = $data['figureurl_2'];
			} else {
				throw_exception("获取腾讯QQ用户信息失败：{$data['msg']}");
			}
		
			echo("<h1>恭喜！使用 {$type} 用户登录成功</h1><br>");
			echo("授权信息为：<br>");
			dump($token);
			echo("当前登录用户信息为：<br>");
			dump($user_info);
		}
	}
    // ------------------------------------------------------------------------
}