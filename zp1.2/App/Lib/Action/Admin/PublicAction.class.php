<?php
/**
 * 公用模块
 */
class PublicAction extends Action {

	// 检查用户是否登录

	protected function checkUser() {
		if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->assign('jumpUrl', 'Public/login');
			$this->error('没有登录');
		}
	}

	// 顶部页面
	public function top() {
		C('SHOW_RUN_TIME',false);			// 运行时间显示
		C('SHOW_PAGE_TRACE',false);
		$model	=	M("Group");
		$list	=	$model->where('status=1')->getField('id,title');
		$this->assign('nodeGroupList',$list);
		$this->display();
	}
	// 尾部页面
	public function footer() {
		C('SHOW_RUN_TIME',false);			// 运行时间显示
		C('SHOW_PAGE_TRACE',false);
		$this->display();
	}
	// 菜单页面
	public function menu() {
		$this->checkUser();
		if (isset($_SESSION[C('USER_AUTH_KEY')])) {
			//显示菜单项
			$menu = array();

			//读取数据库模块列表生成菜单项
			$node = M("Node");
			$id = $node->getField("id");
			$where['level'] = 2;
			$where['status'] = 1;
			$where['pid'] = $id;
			$list = $node->where($where)->field('id,name,group_id,title')->order('sort asc')->select();
			if(isset($_SESSION [C('_ACCESS_LIST')])) {
                $accessList = $_SESSION [C('_ACCESS_LIST')];
            }else{
               	import("@.ORG.Util.RBAC");//by wewe
                $accessList =   RBAC::getAccessList($_SESSION[C('USER_AUTH_KEY')]);
            }
			foreach ($list as $key => $module) {
				if (isset($accessList[strtoupper(GROUP_NAME)][strtoupper($module['name'])]) || $_SESSION[C('ADMIN_AUTH_KEY')]) {
					//设置模块访问权限
					$module['access'] = 1;
					$menu[$key] = $module;
				}
			}

			$group = D("Group");
			$userMenu = array();
			$userAccessGroup = array();
			$userAccessGroup = $group->where('status=1 and `show`=1')->order("sort")->select();
			foreach ($userAccessGroup as $v) {
				$userMenu[$v['id']]['id'] = $v['id'];
				$userMenu[$v['id']]['name'] = $v['name'];
				$userMenu[$v['id']]['title'] = $v['title'];
				$flag = true;
				foreach ($menu as $mv) {
					if ($v['id'] == $mv['group_id']) {
						$userMenu[$v['id']]['submenu'][] = $mv;
						$flag = false;
					}
				}
				if ($flag) {
					$userMenu[$v['id']]['submenu'][] = "";
				}
			}


			//$res = $all_node;
			//dump($accessList);
			$this->assign('menu', $userMenu);
		}
		C('SHOW_RUN_TIME', false);   // 运行时间显示
		C('SHOW_PAGE_TRACE', false);
		$this->display();
	}

	// 后台首页 查看系统信息
	public function main() {
		$info = array(
            '操作系统' => PHP_OS,
            '运行环境' => $_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式' => php_sapi_name(),
            'ThinkPHP版本' => THINK_VERSION . ' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
			'DWZ版本' => '1.45 [ <a href="http://j-ui.com" target="_blank">查看最新版本</a> ]',
            '上传附件限制' => ini_get('upload_max_filesize'),
            '执行时间限制' => ini_get('max_execution_time') . '秒', //by wewe
            '服务器时间' => date("Y年n月j日 H:i:s"),
            '北京时间' => gmdate("Y年n月j日 H:i:s", time() + 8 * 3600),
            '服务器域名/IP' => $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]',
            '剩余空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
            'register_globals' => get_cfg_var("register_globals") == "1" ? "ON" : "OFF",
            'magic_quotes_gpc' => (1 === get_magic_quotes_gpc()) ? 'YES' : 'NO',
            'magic_quotes_runtime' => (1 === get_magic_quotes_runtime()) ? 'YES' : 'NO',
		);
		$this->assign('info', $info);
		$this->display();
	}

	// 用户登录页面
	public function login() {
		if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->display();
		} else {
			$this->redirect('Index/index');
		}
	}

	public function index() {
		//如果通过认证跳转到首页
		redirect(__APP__);
	}

	// 用户登出
	public function logout() {
		if (isset($_SESSION[C('USER_AUTH_KEY')])) {
			unset($_SESSION[C('USER_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
			$this->redirect('Index/index');
		} else {
			$this->error('已经登出！');
		}
	}

	// 登录检测
	public function checkLogin() {
		if (empty($_POST['account'])) {
			$this->error('帐号错误！');
		} elseif ($_POST['password'] != '0' && empty($_POST['password'])) {
			$this->error('密码必须！');
		}
		/* elseif (empty($_POST['verify'])){
		 $this->error('验证码必须！');
		 } */
		//生成认证条件
		$map = array();
		// 支持使用绑定帐号登录
		$map['account'] = $_POST['account'];
		$map["status"] = array('gt', 0);
		/* if ($_SESSION['verify'] != md5($_POST['verify'])) {
		 $this->error('验证码错误！');
		 } */
		import("@.ORG.Util.RBAC"); //by wewe
		$authInfo = RBAC::authenticate($map);
		//使用用户名、密码和状态的方式进行认证
		if (false === $authInfo) {
			  $this->error('帐号不存在或已禁用！');
		} else {
			if ($authInfo['password'] != md5($_POST['password'])) {
				$this->error('密码错误！');
			}
			$_SESSION[C('USER_AUTH_KEY')] = $authInfo['id'];
			$_SESSION['email'] = $authInfo['email'];
			$_SESSION['loginUserName'] = $authInfo['nickname'];
			$_SESSION['lastLoginTime'] = $authInfo['last_login_time'];
			$_SESSION['login_count'] = $authInfo['login_count'];
			$_SESSION['login_account'] = $authInfo['account'];
			if ($authInfo['account'] == 'zmyfujian' || $authInfo['account'] == 'wewe') {
				$_SESSION[C('ADMIN_AUTH_KEY')] = true;
			}
			//保存登录信息
			$Admin = M('Admin');
			$ip = get_client_ip();
			$time = time();
			$data = array();
			$data['id'] = $authInfo['id'];
			$data['last_login_time'] = $time;
			$data['login_count'] = array('exp', 'login_count+1');
			$data['last_login_ip'] = $ip;
			$Admin->save($data);

			// 缓存访问权限
			RBAC::saveAccessList();
			//$this->success('登录成功！');
			$this->redirect('Index/index');
		}
	}

	// 更换密码
	public function changePwd() {
		$this->checkUser();
		/* //对表单提交处理进行处理或者增加非表单数据
		 if (md5($_POST['verify']) != $_SESSION['verify']) {
		 $this->error('验证码错误！');
		 } */
		$map = array();
        if($_POST['password']!=$_POST['repassword'])
        {
        	$this->error('两次输入密码不一致！');
        }
		$map['password'] = pwdHash($_POST['oldpassword']);
		if (isset($_POST['account'])) {
			$map['account'] = $_POST['account'];
		} elseif (isset($_SESSION[C('USER_AUTH_KEY')])) {
			$map['id'] = $_SESSION[C('USER_AUTH_KEY')];
		}
		//检查用户
		$Admin = M("Admin");
		if (!$Admin->where($map)->field('id')->find()) {
			$this->error('旧密码不符或者用户名错误！');
		} else {
			if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
				$this->error('密码长度必须大于6个字符！');
			}
			$Admin->password = pwdHash($_POST['password']);
			$Admin->save();
			$this->success('密码修改成功！');
		}
	}

	public function profile() {
		$this->checkUser();
		$Admin = M("Admin");
		$vo = $Admin->getById($_SESSION[C('USER_AUTH_KEY')]);
		$this->assign('vo', $vo);
		$this->display();
	}

	public function verify() {
		$type = isset($_GET['type']) ? $_GET['type'] : 'gif';
		//import("@.ORG.Image");
                import("@.ORG.Util.Image");
		Image::buildImageVerify(4, 1, $type);
	}

	// 修改资料
	public function change() {
		$this->checkUser();
		$Admin = D("Admin");
		if (!$Admin->create()) {
			$this->error($Admin->getError());
		}
		$result = $Admin->save();
		if (false !== $result) {
			$this->success('资料修改成功！');
		} else {
			$this->error('资料修改失败!');
		}
	}
	function UploadModel() {
		//import('@.ORG.UploadFile');
        import("ORG.Net.UploadFile");
		$upload = new UploadFile();
		$upload->savePath = '../Public/upload/';
		$upload->saveRule = 'time';
		$result = $upload->upload();

		if (!$result) {
			return $upload->getErrorMsg();
		} else {
			$uploadList = $upload->getUploadFileInfo();
			return $uploadList;
		}
	}

	function DeleteImages($imagename) {
		$dir = '../Public/upload/';
		unlink($dir . $imagename);
	}
	public function uploadpicture()
	{
		if (isset($_REQUEST['PHPSESSID'])) session_id($_REQUEST['PHPSESSID']);
		session_start();
		if (isset($_REQUEST['user_id'])) $_SESSION[C('USER_AUTH_KEY')] =  $_REQUEST['user_id'];
		$uploadfile = $_FILES['Filedata']['tmp_name'];
		if ($uploadfile != "") {

			$uploadList = $this->UploadModel();
			$filepath = $uploadList[0]['savename'];
			$filesize = $uploadList[0]['size'];
			$picwidth = $uploadList[0]['width'];
			$picheight = $uploadList[0]['height'];
			$data  =  array();
			$data['filepath'] = $filepath;
			$data['filesize'] = $filesize;
			$data['picwidth'] = $picwidth;
			$data['picheight'] =$picheight;
			$result  =  array();
			$result['status']  =  1;
			$result['statusCode']  =  1;	// zhanghuihua@msn.com
			$result['navTabId']  =  $_REQUEST['navTabId'];	// zhanghuihua@msn.com
			$result['message'] =  "";
			$result['data'] = $data;
			// 返回JSON数据格式到客户端 包含状态信息
			header("Content-Type:text/html; charset=utf-8");
			exit(json_encode($result));
		}

	}
	public function uploadvedio()
	{
		if (isset($_REQUEST['PHPSESSID'])) session_id($_REQUEST['PHPSESSID']);
		session_start();
		if (isset($_REQUEST['user_id'])) $_SESSION[C('USER_AUTH_KEY')] =  $_REQUEST['user_id'];
		$uploadfile = $_FILES['Filedata']['tmp_name'];
		if ($uploadfile != "") {

			$uploadList = $this->UploadModel();
			$filepath = $uploadList[0]['savename'];
			$filesize = $uploadList[0]['size'];
			$data  =  array();
			$data['filepath'] = $filepath;
			$data['filesize'] = $filesize;
			$result  =  array();
			$result['status']  =  1;
			$result['statusCode']  =  1;	// zhanghuihua@msn.com
			$result['navTabId']  =  $_REQUEST['navTabId'];	// zhanghuihua@msn.com
			$result['message'] =  "";
			$result['data'] = $data;
			// 返回JSON数据格式到客户端 包含状态信息
			header("Content-Type:text/html; charset=utf-8");
			exit(json_encode($result));
		}
	}
}

?>