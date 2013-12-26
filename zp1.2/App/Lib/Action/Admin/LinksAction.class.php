<?php
/**
 * 友情链接管理
 */
class LinksAction extends CommonAction {
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
		
	}
	public function _filter(&$map) {
		if(!empty($_POST['keywords'])){
			$where['webname'] = array('like', "%" . $_POST['keywords'] . "%");
			$where['url'] = array('like', "%" . $_POST['keywords'] . "%");			
			$where['_logic'] = 'or';
		}
	}
	/**
	 +----------------------------------------------------------
	 * 添加操作
	 +----------------------------------------------------------
	 */
	
	public function insert() {
		$name=$this->getActionName();
		$model = D ($name);
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
			
		//替换URL空格
		$model->url=str_replace(array(' ','　'),array('',''),$model->url);
		//处理URL
		$model->url=prep_url($model->url);
			
		//保存当前数据对象
		$list=$model->add();
		if ($list!==false) { //保存成功
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
				//dump($file_info);exit;
				//赋值当前表图片地址
				$data['uploads_id']=$file_info[0]['id'];
				$data['logo']=$file_info[0]['fileurl'];
				$model->where("id='$list'")->save($data);
			}
			$this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
			$this->success ('新增成功!');
		} else {
			//失败提示
			$this->error ('新增失败!');
		}
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
			$model->logo=$file_info[0]['fileurl'];
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