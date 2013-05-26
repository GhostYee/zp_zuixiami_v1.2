<?php
// 单页模型
class PagesModel extends CommonModel {
	public $_validate	=	array(
			array('code','','code已经存在,请更换',Model::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
	);
	/**
	 * 根据单页ID取得单页信息
	 *
	 * @access  public
	 * @param int/string $special_id
	 * @return  array/false
	 */
	public function getPagesByID($page_id){
		if(is_numeric($page_id)){
			$map['id']=$page_id;
		}
		else{
			$map['code']=$page_id;
		}
		$data=$this->where($map)->select();
		if(!empty($data)){
			return $data[0];
		}
		return false;
	}
}
?>