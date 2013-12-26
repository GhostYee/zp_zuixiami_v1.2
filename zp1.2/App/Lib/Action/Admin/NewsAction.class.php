<?php
/**
 * 新闻
 */
class NewsAction extends CommonAction {
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
		//继承
		parent::_initialize();
	
		$mtype=$this->getActionName();
		
		//菜单列表
		$menu_model=D('Categorys');
		$list = $menu_model->getListByModule($mtype);
		import('@.ORG.Util.Tree');
		$tree=new Tree($list);
		$list=$tree->getChildList();	
	
		$this->assign('catelist',$list);
		$this->assign('mtype',$mtype);
	}
	public function _filter(&$map) {
		if(!empty($_POST['keywords'])){
			$map['title'] = array('like', "%" . $_POST['keywords'] . "%");
			$map['keywords'] = array('like', "%" . $_POST['keywords'] . "%");
			$map['description'] = array('like', "%" . $_POST['keywords'] . "%");
			$map['contents'] = array('like', "%" . $_POST['keywords'] . "%");
			
			$map['_logic'] = 'or';
		}
	}
	/**
	 +----------------------------------------------------------
	 * 赋值列表页数据
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 */
	function _fill_list(&$voList){
		$model_cate=D("Categorys");
		foreach($voList as $key=>$val){
			$voList[$key]['catname']=$model_cate->getCateNameByID($val['catid']);
		}
	}
	/**
	 +----------------------------------------------------------
	 * 添加前置
	 +----------------------------------------------------------
	 */
	public function _before_add() {
		$vo['adduser']=session('loginUserName');
		$vo['addtime']=time();
		$this->assign('vo',$vo);
	}
	/**
	 +----------------------------------------------------------
	 * 赋值添加操作数据
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 */
	function _fill_insert(&$model){
		if(!empty($_FILES['fileimg']['name'])){
			//上传图片
			if(!empty($_FILES['fileimg']['name'])){
				//导入上传类
				import('@.ORG.WeUploadFile');				
				$upload = new WeUploadFile();
				//只允许图片上传
				$upload->allow_type='image';
				if (!$upload->upload()) {
					//捕获上传异常
					$this->error($upload->getErrorMsg());
				} else {
					//取得成功上传的文件信息
					$file_info = $upload->getUploadFileInfo();
				}
				//赋值当前表图片地址
				$model->uploads_id=$file_info[0]['id'];
				$model->img=$file_info[0]['fileurl'];
			}
		}
	}
	/**
	 +----------------------------------------------------------
	 * 赋值编辑页数据
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 */
	function _fill_edit(&$vo){		
		$model_upload=D("Uploads");
		$uploads=$model_upload->getByid($vo['uploads_id']);
		$vo['image']=$uploads['url'];
	}
	
	/**
	 +----------------------------------------------------------
	 * 赋值添加操作数据
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 */
	function _fill_update(&$model){				
		//上传图片
		if(!empty($_FILES['fileimg']['name'])){			
			//导入上传类
			import('@.ORG.WeUploadFile');
			$upload = new WeUploadFile();
			//只允许图片上传
			$upload->allow_type='image';
			if (!$upload->upload()) {
				//捕获上传异常
				$this->error($upload->getErrorMsg());
			} else {
				//取得成功上传的文件信息
				$file_info = $upload->getUploadFileInfo();
			}
			//删除修改前文件
			if($model->uploads_id){
				$model_uploads = D('Uploads');
				$model_uploads->deleteByID($model->uploads_id);
			}
			//赋值当前表图片地址
			$model->uploads_id=$file_info[0]['id'];
			$model->img=$file_info[0]['fileurl'];
		}
	}
	/**
	 +----------------------------------------------------------
	 * 前置删除
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 */
	public function _before_foreverdelete(){
		//删除附件表上传图片
		$name=$this->getActionName();
		$model = D ($name);
		$id=$_REQUEST['id'];
		$data=$model->getByid($id);
		if($data['uploads_id']){
			$model_uploads=D('Uploads');
			$model_uploads->deleteByID($data['uploads_id']);
		}
	}
}

?>