<?php
//评论留言
class MessageAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index(){
    	//$this->_check_login();
    	
    	//替换模板SEO的值
		$this->seo('意见和建议'.'--'.CFG('cfg_webname'),CFG('cfg_seo_keywords'),CFG('cfg_seo_description'));
    	
    	$this->display();
    }
    // ------------------------------------------------------------------------
    /**
     * 提交留言
     *
     * @access  public
     * @return  void
     */
    public function post(){
    	
    	if(IS_POST && IS_AJAX){
    		$userid=session("xiami_userid");
    		
    		//判断是否登陆
    		//if(empty($userid)) {echo json_encode(array('code'=>'jump'));exit;}
    		
    		$model=D("Message");
	    	$data=array(
		    	'module'=>$this->_post('module'), //模块
		    	'mid'=>$this->_post('mid'), //模块ID
		    	'from_user_id'=>$userid, //发送者用户ID
		    	'to_user_id'=>$this->_post('to_user_id'), //接收者用户ID
		    	'contents'=>$this->_post('contents'), //内容
		    	'ip'=>get_client_ip(), //IP
	    		'status'=>'1', //状态 0 未审核1显示 2用户隐藏 3管理员隐藏 4回收站(用户删除)
		    	'addtime'=>time(),
			);
	    	//判断系统配置是否需要审核
	    	if(CFG('cfg_message_check')=='1') $data['status']=0; 
	    	
	    	
	    	//最后申请记录
	    	$map['module']=$data['module'];
			$map['mid']=$data['mid'];
			//$map['ip']=$data['ip'];
			$map['from_user_id']=$data['from_user_id'];
			$last_message_addtime=$model->where($map)->order("id desc")->getField('addtime');
			
			if($last_message_addtime && (time()-$last_message_addtime)<5) {
				echo json_encode(array('code'=>'error','msg'=>'亲,您点得太快了!'));exit;
			}
			
			//5秒后留言
	    	if($data['module'] && $data['mid'] && $data['from_user_id']){
				//保存当前数据对象
				$list=$model->add ($data);
				if ($list!==false) { //保存成功
					$msg=$this->_getMessageLiList($data['module'],$data['mid']);
					echo json_encode(array('code'=>'ok','msg'=>$msg));exit;
				} else {
					//失败提示
					echo json_encode(array('code'=>'error','msg'=>'操作失败,请重试!'));exit;
				}
		    }
    	}
    }
    
	/**
	 * 用户操作支持/反对 
	 * IP限制及用户ID
	 *
	 * @access  public
	 * @return  void
	 */
	public function user_action(){
		$module=$this->_post('module'); //模块
		$mtype=$this->_post('mtype');//类型
		$mid=$this->_post('mid');//模块ID
		$ip=get_client_ip();//IP
		$user_id=session("we_userid");//用户ID
		
		if(empty($mid) || empty($module) || empty($mtype)){ 
			echo json_encode(array('code'=>'error','msg'=>'参数为空!'));exit;
		}
		
		$mtype_lan['Message']['support']='支持';
		$mtype_lan['Message']['oppose']='反对';
		
		//判断是否存在记录
		$model=M('user_action');
		$map['module']=$module;
		$map['mid']=$mid;
		//$map['mtype']=$mtype;
		$map['ip']=$ip;
		if(!empty($user_id)){
			$map['user_id']=$user_id;
		}
		$user_action_id=$model->where($map)->getField('id');
		$q=$user_action_id;
		
		//取得 最近一条记录,用于限制时间
		$map2['module']=$module;
		//$map2['mtype']=$mtype;
		$map2['ip']=$ip;
		if(!empty($user_id)){
			$map2['user_id']=$user_id;
		}
		$user_action_addtime=$model->where($map2)->order("id desc")->getField('addtime');
		if(!empty($user_action_id)){//已操作
			echo json_encode(array('code'=>'error','msg'=>'亲,您已'.$mtype_lan[$module][$mtype].'过!'));exit;
		}
		else if((time()-$user_action_addtime)<5){//限制5秒后再点
			echo json_encode(array('code'=>'error','msg'=>'亲,您点得太快了!'));exit;
		}
		else{
			//入库
			$data['module']=$module;
			$data['mid']=$mid;
			$data['mtype']=$mtype;
			$data['ip']=$ip;
			if(!empty($user_id)){
				$data['user_id']=$user_id;
			}
			$data['addtime']=time();
			$result=$model->add($data);
			if($result!==false){
				//+1
				$model_update=M($module);
				$num=$model_update->where("id='$mid'")->getField($mtype);
				$rs=$model_update->where("id='$mid'")->setField($mtype,$num+1);
				if($rs!==false){
					echo json_encode(array('code'=>'ok','msg'=>$num+1));exit;
				}
				else{
					echo json_encode(array('code'=>'error','msg'=>'操作失败,请重试!'));exit;
				}
			}
			else{
				echo json_encode(array('code'=>'error','msg'=>'操作失败,请重试!'));exit;
			}
		}
	}
	// ------------------------------------------------------------------------
	/**
	 * 取得留言列表
	 *
	 * @access  public
	 * @return  void
	 */
	public function _getMessageLiList($module,$mid){
		//取得评论列表
		$model_message=D("Message");
		$allinone_m['where']="message.status=1 and message.module='".$module."' and mid='".$mid."' ";
		$allinone_m['order']="message.id desc";
		$message=$model_message->getList($allinone_m);
		$this->assign('message',$message);
		return $this->fetch("wgt:messageLiList");
	}
    // ------------------------------------------------------------------------
}