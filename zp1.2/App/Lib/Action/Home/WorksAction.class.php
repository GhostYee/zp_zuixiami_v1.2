<?php
//作品
class WorksAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 列表
	 *
	 * @access  public
	 * @return  void
	 */
	public function index(){
		//跳转
		$this->redirect('works/submit');
		
		//替换模板SEO的值
		$seo['title']='最蝦米*鬼懿IT*作品秀';
		$seo['keywords']=C("CFG_SEO_KEYWORDS");
		$seo['description']=C("CFG_SEO_DESCRIPTION");
		$this->assign('seo',$seo);
		
		$this->display();
	}
	// ------------------------------------------------------------------------
	/**
	 * 作品提交列表
	 *
	 * @access  public
	 * @return  void
	 */
	public function submit(){
		$qq=$this->_get('qq');
		$url=$this->_get('url');
		
		if(empty($qq)){
			$qq=cookie('zuixiami_works_qq');
		}
		$works['qq']=$qq;
		$works['url']=$url;
		$this->assign('works',$works);
		
		//替换模板SEO的值
		$seo['title']='最蝦米*鬼懿IT*作品秀';
		$seo['keywords']=C("CFG_SEO_KEYWORDS");
		$seo['description']=C("CFG_SEO_DESCRIPTION");
		$this->assign('seo',$seo);
		
		$this->display();
	}
    // ------------------------------------------------------------------------
	/**
	 * 上传图片操作
	 *
	 * @access  public
	 * @return  void
	 */
	public function upload_file(){
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        
        $upload->maxSize = 1 * 1024 * 1024 ;
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->savePath =  './Uploads/Userimg/';
        $upload->saveRule = date('Ymd_His').'_'.rand(1000, 9999);
        
        $upload->thumb = true;
        $upload->thumbPath =  './Uploads/Userthumb/';
        $upload->thumbPrefix = 'm_,s_';
        $upload->thumbMaxWidth = '250,200';
        $upload->thumbMaxHeight = '250,200';
        
        $responce = array();
        if(!$upload->upload()) {
            $responce['status'] = 4;
            $responce['error'] = $upload->getErrorMsg();
        } else {
            $info = $upload->getUploadFileInfo();
            $responce['status'] = 1;
            $responce['img'] = CFG('cfg_weburl').'Uploads/Userimg/'.$info[0]['savename'];
            $responce['thumb'] = CFG('cfg_weburl').'Uploads/Userthumb/m_'.$info[0]['savename'];
        }
        echo json_encode($responce);
	}
	// ------------------------------------------------------------------------
	/**
	 * 作品提交操作
	 *
	 * @access  public
	 * @return  void
	 */
	public function post(){
		$act=$this->_post('save');
		$works=array(
				'id'=>$this->_post('id'),
				'qq'=>$this->_post('qq'),
				'name'=>$this->_post('name'),
				'url'=>$this->_post('url'),
				'description'=>$this->_post('description'),
				'addtime'=>time(),
				'status'=>1,
		);
		//远程图片地址
		$imgurl=$this->_post('imgurl');
		
		switch($act){
			case 'save':
				$dumpurl=__APP__.'/';
				break;
			case 'goon':
				$dumpurl=__URL__.'/submit';
				break;
			default:
				$dumpurl=__APP__.'/';
				$this->redirect($dumpurl);
				break;
		}
		
		if(empty($works['qq'])) $this->error('请填写QQ号码');
		if(empty($works['name'])) $this->error('请填写作品名称');
		if(empty($works['url'])) $this->error('请填写作品链接');
		
		$qun_member_model=D('qun_member');
		//qq号码取得分类
		$qun_sort_id=$qun_member_model->where("qq='$works[qq]'")->getField('qun_sort_id');
		if($qun_sort_id){
			$works['qun_sortid']=$qun_sort_id;
		}
		else{
			$this->error('您不在QQ群内，请先添加群，如有疑问，请留言管理员，谢谢');
		}
		
		//存cookie一年
		setcookie('zuixiami_works_qq',$works['qq'],3600*24*365);
		
		$works['url']=prep_url(trim($works['url']));
		$works['url']=str_replace(array(' ','　'),array('',''),$works['url']);
		
		//图片地址
		if($imgurl){
            if(strpos($imgurl, 'Uploads/Userimg/') != false) {
                $works['img']=$imgurl;
            } else {
                $works['img']=prep_url(trim($imgurl));
            }
		}
		$model=M('Works');
		if (false === $model->create ($works)) {
			$this->error ( $model->getError () );
		}
		//保存当前数据对象
        if(!empty($works['id'])) {
            unset($works['qq']);
            unset($works['addtime']);
            unset($works['status']);
            $list=$model->save ($works);
        } else {
            unset($works['id']);
            $list=$model->add ($works);
        }
        
		if ($list!==false) { //保存成功
			$this->success ('成功提交作品，请等待管理员审核！!',$dumpurl);
		} else {
			//失败提示
			$this->error ('提交失败！请重试!',$dumpurl);
		}
	}
	// ------------------------------------------------------------------------
	/**
	 * 首页作品提交操作
	 *
	 * @access  public
	 * @return  void
	 */
	public function post_quick(){
		$works=array(
				'qq'=>$this->_post('qq'),
				'url'=>$this->_post('url'),
		);	
		if(empty($works['qq'])) $this->error('请填写QQ号码');
		if(empty($works['url'])) $this->error('请填写作品链接');
		
		$this->redirect('works/submit/?qq='.$works['qq'].'&url='.$works['url']);
	}
	// ------------------------------------------------------------------------
	/**
	 * 搜索
	 *
	 * @access  public
	 * @return  void
	 */
	public function search(){
		$keywords=trim($_REQUEST['keywords']);
    	$keywords=!empty($keywords)?$keywords:'';
    	$status=empty($_REQUEST['status'])?'2':$_REQUEST['status'];
    	$author=empty($_REQUEST['author'])?'':$_REQUEST['author'];
    	
    	//没有关键词跳转到首页
    	if(empty($keywords)) redirect(__APP__);
    	
    	//取得当前登陆用户ID
    	$userid=session('we_userid');
    	
    	if($status==2 && !empty($author) && $author==$userid){
    		$this->_check_login();
    	}
    	//取得作者信息
    	$qun_member_model=M('qun_member');
    	$qun_member=$qun_member_model->getById($author);
    	$this->assign('qun_member',$qun_member);
    	
    	$works_model=D('works');
    	//状态 默认通过审核
    	$where.=" AND w.`status`='$status' ";
    	
    	if($qun_member && !empty($author)){
    		//作者
    		$where.=" AND qm.`id`='$author' ";
    	}

    	if(!empty($keywords)){
    		//查找作品名,作者,描述
    		$where.=" AND (w.`name` like '%$keywords%' or w.`author` like '%$keywords%' or w.`description` like '%$keywords%'  or qs.`name`='$keywords')";
    	}
    	
    	//判断排序
    	$index_works_order=CFG('cfg_index_works_order');
    	
    	if($index_works_order){
    		$orderby=" ORDER BY $index_works_order ";
    	}
    	else{
    		//排序推荐 降序，推荐排序降序，ID 升序
    		$orderby=" ORDER BY w.is_top DESC,w.top_sid DESC,w.id DESC ";
    	}
    	/*
    	//判断显示条数
    	$index_works_num=CFG('cfg_index_works_num');
    	if($index_works_num){
    		$limit=" limit $index_works_num ";
    	}
    	*/
    	// 取出需要的数据
    	$sql	= "SELECT w.*,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id author_id FROM ".C('DB_PREFIX')."works w ".
    			" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
    			" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
    			" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
    			" where 1 $where $orderby ";
    	$works	= $works_model->query($sql);
    	$this->assign('works',$works);
    	
    	//统计
    	$total['nochecked']=$this->_get_user_works_count(1,$keywords);
    	$total['checked']=$this->_get_user_works_count(2,$keywords);
    	$total['checkedn']=$this->_get_user_works_count(3,$keywords);
    	$total['total']=$this->_get_user_works_count('',$keywords);
    	$total['search_total']=$total['total'];
    	if($qun_member){
    		$total['user_total']=$this->_get_user_works_count('',$keywords,$qun_member[id]);
    		$total['search_total']=$this->_get_user_works_count('',$keywords,$qun_member[id]);
    	}
    	else if($userid){
    		$total['user_total']=$this->_get_user_works_count('',$keywords,$userid);
    	}
    	if($qun_member && !empty($author)){
    		$total['nochecked']=$this->_get_user_works_count(1,$keywords,$qun_member[id]);
    		$total['checked']=$this->_get_user_works_count(2,$keywords,$qun_member[id]);
    		$total['checkedn']=$this->_get_user_works_count(3,$keywords,$qun_member[id]);
    	}
    	$this->assign('total',$total);

    	$this->assign('keywords',$keywords);
    	$this->assign('status',$status);
    	$this->assign('author',$qun_member[id]);
    	$this->assign('userid',$userid);
		
		$this->display();
	}
	// ------------------------------------------------------------------------
	/**
	 * 状态变更
	 *
	 * @access  public
	 * @return  void
	 */
	function status(){
		$we_username=session('we_username');
		if(empty($we_username)){
			echo json_encode(array('msg'=>'jump'));exit;
		}
		$id=$_REQUEST['id'];
		$status=$_REQUEST['status'];
		
		$status_lang['1']='等待审核';
		$status_lang['2']='通过审核';
		$status_lang['3']='审核不通过';
		
		$model=M('Works');
		$works=$model->getById($id);
		if(!empty($works)){
			
			//更新状态
			$rs=$model->where("id='$id'")->setField('status',$status);
			if($rs!==false){
				$this->works_log($id,'status',$status_lang[$works[status]].' => '.$status_lang[$status]);
				
				$msg='提交成功';
				
				//查询作品列表
				$works_model=D('works');
				//状态
				$where.=" AND w.`status`='$works[status]' ";				 
				 
				//判断排序
				$index_works_order=CFG('cfg_index_works_order');
				 
				if($index_works_order){
					$orderby=" ORDER BY $index_works_order ";
				}
				else{
					//排序推荐 降序，推荐排序降序，ID 升序
					$orderby=" ORDER BY w.is_top DESC,w.top_sid DESC,w.id DESC ";
				}
				 
				//判断显示条数
				$index_works_num=CFG('cfg_index_works_num');
				if($index_works_num){
					$limit=" limit $index_works_num ";
				}
				// 取出需要的数据
				$sql	= "SELECT w.*,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id author_id FROM ".C('DB_PREFIX')."works w ".
						" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
						" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
						" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
						" where 1 $where $orderby $limit";
				$works	= $works_model->query($sql);
				$this->assign('works',$works);
				$this->assign('status',$works[status]);
				//$html=$this->fetch('Index:workslist');
				echo json_encode(array('msg'=>$msg,'workslist'=>$html));exit;
			}
			else {
				echo json_encode(array('msg'=>'提交失败'));exit;
			}
			
		}
	}
	/**
	 +----------------------------------------------------------
	 * 作品操作日志新增
	 +----------------------------------------------------------
	 */
	public function works_log($works_id,$action,$notice='') {
		$model=M('works_log');
		$works_log['works_id']=$works_id;
		$works_log['action']=$action;
		$works_log['notice']=$notice;
		$works_log['adduser']=session('we_username');
		$works_log['addtime']=time();
		$list=$model->add($works_log);
		if($list!==false){
			return true;
		}
		else{
			return false;
		}
	
	}
	// ------------------------------------------------------------------------
	// ------------------------------------------------------------------------
	// ------------------------------------------------------------------------
	// ------------------------------------------------------------------------
	/**
	 * 取得用户作品状态总计
	 *
	 * @access  public
	 * @return  void
	 */
	protected function _get_user_works_count($status='',$keywords='',$userid=''){
		$where='';
		if(!empty($userid)){
			$where.=" AND qm.`id`='$userid' ";
		}
		if(!empty($status)){
			$where.=" AND w.`status`='$status' ";
		}
		else{
			$where.=" AND w.`status` !='4' ";
		}
		if(!empty($keywords)){
			//查找作品名,作者,描述
			$where.=" AND (w.`name` like '%$keywords%' or w.`author` like '%$keywords%' or w.`description` like '%$keywords%'  or qs.`name`='$keywords')";
		}
		$works_model=D('works');
		//统计
		$sql	= "SELECT count(*) num FROM ".C('DB_PREFIX')."works w ".
				" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
				" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
				" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
				" where 1 $where ";
		$works=$works_model->query($sql);
		if($works!==false){
			return $works[0][num];
		}
	}
	/**
	 * 赞/期待操作 
	 * IP限制
	 *
	 * @access  public
	 * @return  void
	 */
	public function user_action(){
		$module=$this->_post('module');
		$mtype=$this->_post('mtype');
		$mid=$this->_post('mid');
		$ip=get_client_ip();
		$user_id=session("we_userid");
		
		if(empty($mid) || empty($module) || empty($mid)){ 
			echo json_encode(array('code'=>'error','msg'=>'参数为空!'));exit;
		}
		
		$mtype_lan['Works']['good']='赞';
		$mtype_lan['Qun_member']['await']='期待';
		
		//判断是否存在记录
		$model=M('user_action');
		$map['module']=$module;
		$map['mid']=$mid;
		$map['mtype']=$mtype;
		$map['ip']=$ip;
		$user_action_id=$model->where($map)->getField('id');
		$q=$user_action_id;
		
		//取得 最近一条记录,用于限制时间
		$map2['module']=$module;
		$map2['mtype']=$mtype;
		$map2['ip']=$ip;
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
	 * 评星
	 * IP限制
	 *
	 * @access  public
	 * @return  void
	 */
	public function user_action_rank(){
		$mid=$this->_post('mid');
		$score=$this->_post('score');//得分
		
		if(empty($mid) || empty($score)){ 
			echo json_encode(array('code'=>'error','msg'=>'参数为空!'));exit;
		}
		
		$ip=get_client_ip();
		$user_id=session("we_userid");
		
		$module='Works';
		$mtype='rank';
		
		//判断是否存在记录
		$model=M('user_action');
		$map['module']=$module;
		$map['mid']=$mid;
		$map['mtype']=$mtype;
		$map['ip']=$ip;
		$user_action_id=$model->where($map)->getField('id');
		$q=$user_action_id;
		
		//取得 最近一条记录,用于限制时间
		$map2['module']=$module;
		$map2['mtype']=$mtype;
		$map2['ip']=$ip;
		$user_action_addtime=$model->where($map2)->order("id desc")->getField('addtime');
		
		if(!empty($user_action_id)){//已操作
			echo json_encode(array('code'=>'error','msg'=>'亲,您已评过!'));exit;
		}
		else if((time()-$user_action_addtime)<5){//限制5秒后再点
			echo json_encode(array('code'=>'error','msg'=>'亲,您点得太快了!'));exit;
		}
		else{
			//入库
			$data['module']=$module;
			$data['mid']=$mid;
			$data['mtype']=$mtype;
			$data['value']=$score;
			$data['ip']=$ip;
			if(!empty($user_id)){
				$data['user_id']=$user_id;
			}			
			$data['addtime']=time();
			$result=$model->add($data);
			if($result!==false){
				//取得作品星级总评分/星级评分总次数 并进行更新操作
				$model_update=M($module);
				$num=$model_update->where("id='$mid'")->getField("rank_total,rank_count");
				$rank_total_update=$num[0]+$score;
				$rank_count_update=$num[1]+1;
				$rank_data=array('rank_total'=>$rank_total_update,'rank_count'=>$rank_count_update);
				$rs=$model_update->where("id='$mid'")->setField($rank_data);
				if($rs!==false){
					echo json_encode(array('code'=>'ok','msg'=>round($rank_total_update/$rank_count_update/10),1));exit;
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

	//查看作品
    public function view()
    {
    	$this->display();
    }
}