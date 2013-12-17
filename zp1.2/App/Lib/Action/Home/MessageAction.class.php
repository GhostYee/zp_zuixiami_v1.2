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
    	$model = D ('Message');
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		$model->ip=get_client_ip();
		$model->addtime=time();
		//保存当前数据对象
		$list=$model->add ();
		if ($list!==false) { //保存成功
			$this->success ('新增成功!');
		} else {
			//失败提示
			$this->error ('新增失败!');
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
		
		if(empty($mid) || empty($module) || empty($mid)){ 
			echo json_encode(array('code'=>'error','msg'=>'参数为空!'));exit;
		}
		
		$mtype_lan['Message']['support']='支持';
		$mtype_lan['Message']['oppose']='反对';
		
		//判断是否存在记录
		$model=M('user_action');
		$map['module']=$module;
		$map['mid']=$mid;
		$map['mtype']=$mtype;
		$map['ip']=$ip;
		if(!empty($user_id)){
			$map['user_id']=$user_id;
		}
		$user_action_id=$model->where($map)->getField('id');
		$q=$user_action_id;
		
		//取得 最近一条记录,用于限制时间
		$map2['module']=$module;
		$map2['mtype']=$mtype;
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
}