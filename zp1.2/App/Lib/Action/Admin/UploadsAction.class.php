<?php 
class UploadsAction extends CommonAction {
	function _filter(&$map) {
		$map['title'] = array('like', "%" . $_POST['keyword'] . "%");
		//$map['name'] = array('like', "%" . $_POST['keyword'] . "%");
		//$map['_logic'] = 'or';
	}
	/**
	 +----------------------------------------------------------
	 * 前置首页列表
	 +----------------------------------------------------------
	 */
	function _before_index(){
		$model=M('Uploads');
		$module_list=$model->field("distinct(module)")->select();
		$this->assign('module_list',$module_list);
		
		$extension_list=$model->field("distinct(extension)")->select();
		$this->assign('extension_list',$extension_list);
		
		$mediatype_list=$model->field("distinct(mediatype)")->select();
		$this->assign('mediatype_list',$mediatype_list);
	}
	/**
	 +----------------------------------------------------------
	 * 选择上传
	 +----------------------------------------------------------
	 */
	function selectupload(){
		$this->display();
	}
	/**
	 +----------------------------------------------------------
	 * 永久删除操作
	 +----------------------------------------------------------
	 */
	public function foreverdelete() {
		//删除指定记录
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$pk = $model->getPk ();
			$id = $_REQUEST [$pk];
			if (isset ( $id )) {
				$log_id=explode (',', $id );
				if (false !== $model->deleteByID($id)) {
					$this->sysLogs('删除成功ID:'.$log_id);
					$this->success ('删除成功！');
				} else {
					$this->sysLogs('删除失败ID:'.$log_id);
					$this->error ('删除失败！');
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
	}
	/**
	 +----------------------------------------------------------
	 * 选中删除操作
	 +----------------------------------------------------------
	 */
	public function selectedDelete() {
		//删除指定记录
		$name = $this->getActionName();
		$model = D($name);
		if (!empty($model)) {
			$pk = $model->getPk();
			$id = $_REQUEST ['ids'];
			if (isset($id)) {
				$log_id=explode (',', $id );
				if (false !== $model->deleteByID($id)) {
					$this->sysLogs('选择删除成功ID:'.$log_id);
					$this->success('删除成功！');
				} else {
					$this->sysLogs('选择删除失败ID:'.$log_id);
					$this->error('删除失败！');
				}
			} else {
				$this->sysLogs('选择删除非法操作');
				$this->error('非法操作');
			}
		}
	}
}