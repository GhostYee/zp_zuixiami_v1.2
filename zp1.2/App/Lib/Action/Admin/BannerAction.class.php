<?php
/**
 * 首页banner管理
 */
class BannerAction extends CommonAction {
	public function _filter(&$map) {
		if(!empty($_POST['keyword'])){
			$map['title'] = array('like', "%" . $_POST['keyword'] . "%");
			$map['_logic'] = 'or';
		}
	}
	/**
      +----------------------------------------------------------
     * 显示添加页
      +----------------------------------------------------------
     */
	public function add() {
		$this->assign('acturl','insert');
		$this->display ('edit');
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
				$file_info=upload(MODULE_NAME,$list,'','image');
				if(!is_array($file_info)){
					$this->error($file_info);
				}
				$data['img']='/'.$file_info[0]['fileurl']; //CFG('cfg_weburl')
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
	 * 显示编辑页
	 +----------------------------------------------------------
	 */
	public function edit() {
		$name=$this->getActionName();
		$model = M ( $name );
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById ( $id );
		$this->assign ( 'vo', $vo );
		
		$this->assign('acturl','update');
		
		$this->display ();
	}
	/**
	 +----------------------------------------------------------
	 * 编辑操作
	 +----------------------------------------------------------
	 */
	public function update() {
		$id = $_REQUEST ['id'];
		$name=$this->getActionName();
		$model = D ($name);
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		//替换URL空格
		$model->url=str_replace(array(' ','　'),array('',''),$model->url);
		//处理URL
		$model->url=prep_url($model->url);

		//上传图片
		if(!empty($_FILES['fileimg']['name'])){
			R('Admin/Uploads/delete_mid_file',array(MODULE_NAME,intval($id)));
			$file_info=upload(MODULE_NAME,$id,'','image');
			if(!is_array($file_info)){
				$this->error($file_info);
			}
			$model->img='/'.$file_info[0][fileurl]; //CFG('cfg_weburl')
		}
		// 更新数据
		$list=$model->save ();
		if (false !== $list) {
			//成功提示
			$this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
			$this->success ('编辑成功!');
		} else {
			//错误提示
			$this->error ('编辑失败!');
		}
	}
}

?>