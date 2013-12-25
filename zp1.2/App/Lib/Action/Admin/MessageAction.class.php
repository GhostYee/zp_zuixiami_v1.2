<?php 
class MessageAction extends CommonAction {
	/**
	 +----------------------------------------------------------
	 * 初始化action
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	function _initialize() {
		parent::_initialize();
		
		$module_list=array(
				'Works'=>'作品评论',		
				'Author'=>'作者留言',
				'WorksSpecial'=>'专题评论',
				'Team'=>'团队评论',
				'Message'=>'留言建议',
		);
		$this->assign('module_list',$module_list);
		
		$status_list=array(
				'0'=>'未审核',
				'1'=>'显示',
				'2'=>'用户隐藏',
				'3'=>'管理员隐藏',
				'4'=>'回收站(用户删除)',
		);
		$this->assign('status_list',$status_list);
	}
	/**
	 +----------------------------------------------------------
	 * 显示首页列表
	 +----------------------------------------------------------
	 */
	public function index() {
		//列表过滤器，生成查询Map对象
		$search['keyword']=$_REQUEST['keyword'];
		$search['message_module']=$_REQUEST['message_module'];
		$search['message_status']=$_REQUEST['message_status'];
	
		if(!empty($search['keyword'])){
			$map['message.title'] = array('like', "%" . $search['keyword'] . "%");
			$map['message.contents'] = array('like', "%" . $search['keyword'] . "%");
			$map['message.ip'] = array('like', "%" . $search['keyword'] . "%");
			$map['message.module'] = array('like', "%" . $search['keyword'] . "%");
			$map['_logic'] = 'or';
		}
		if(!empty($search['message_module'])){
			$map['message.module'] = $search['message_module'];
		}
		if(!empty($search['message_status'])){
			$map['message.status'] = $search['message_status'];
		}

		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$allinone['where']=$map;
			$allinone['field']='message.*,from_user.nickname from_user_nickname,to_user.nickname to_user_nickname';
			$allinone['join']=array(C('DB_PREFIX')."user from_user ON from_user.id=message.from_user_id",C('DB_PREFIX')."user to_user ON to_user.id=message.to_user_id");
			$allinone['order']='message.id DESC';
			$this->_list_sql ( $model, $allinone );
		}
	
		$this->assign('search',$search);
	
		$this->display();
	}
	/**
	 +----------------------------------------------------------
	 * 对编辑页显示重新赋值
	 +----------------------------------------------------------
	 */
	public function _fill_edit(&$vo) {
		//模块信息
		if($vo['module'] && $vo['mid']){
			$vo['module_title']=$this->_get_module_title($vo['module'],$vo['mid']);
		}
		$model_user=D('user');
		//发送人名
		if($vo['from_user_id']){
			$vo['from_user_nickname']=$model_user->getFieldByid($vo['from_user_id'],'nickname');
		}
		//接收人名
		if($vo['to_user_id']){
			$vo['to_user_nickname']=$model_user->getFieldByid($vo['to_user_id'],'nickname');
		}
		
	}
	/**
	 +----------------------------------------------------------
	 * 取得模块信息标题
	 * @param array $module 模块名
	 * @param int   $mid    模块ID
	 * @return string 标题名
	 +----------------------------------------------------------
	 */
	protected function _get_module_title($module,$mid) {
		if($module && $mid){
			$model_module=D($module);
			switch ($module){
				//作品评论
				case 'Works':
					$field='name';
					break;
				//作者留言
				case 'User':
					$field='nickname';
					break;
				//专题评论
				case 'WorksSpecial':
					$field='title';
					break;
				//团队评论
				case 'Team':
					$field='teamname';
					break;
				//留言建议
				case 'Message':
					$field='title';
					break;
			}
			return $model_module->getFieldByid($mid,$field);
		}
	}
}