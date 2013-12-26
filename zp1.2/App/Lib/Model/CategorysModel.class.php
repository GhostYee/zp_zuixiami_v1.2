<?php
// 分类
class CategorysModel extends CommonModel {
	public $_validate	=	array(
			//array('title','require','请填写标题！'),
			//array('code','','code已经存在,请更换',Model::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
	);
	public $_auto		=	array(
			//array('addtime','time',self::MODEL_INSERT,'function'),
	);
	/**
	 * 取得某类型下所有数据列表
	 * @param sting $module 模块
	 * @return array
	 */
	public function getListByModule($module){
		$map['module']=$module;
		$orderby['sid']='asc';
		$orderby['id']='asc';
		$data=$this->where($map)->order($orderby)->select();
		return $data;
	}
	/**
	 * 所有菜单列表
	 */
	public function getAllList(){
		$orderby['sid']='asc';
		$orderby['id']='asc';
		$data=$this->order($orderby)->select();
		return $data;
	}
	/**
	 * 取得某级别最大排序据
	 * @return int
	 */
	public function getMaxOrder(){
		//$map['pid']=$pid;
		$orderby['sid']='asc';
		$orderby['id']='asc';
		$data=$this->where($map)->order($orderby)->getField("max(sid)");
		return $data+1;
	}
	/**
	 * 取得某类型下所有数据列表
	 * @param sting $mtype 类别
	 * @return array
	 */
	public function getCateNameByID($id){
		$map['id']=$id;
		$data=$this->where($map)->getField("title");
		if(!empty($data)){
			return $data;
		}
		return false;
	}
	/**
	 * 某分类下是否存在子分类
	 * @return int
	 */
	public function isHavePid($id){
		$map['pid']=$id;
		$data=$this->where($map)->getField("id");
		return $data;
	}
}
?>