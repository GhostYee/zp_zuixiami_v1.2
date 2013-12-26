<?php
// 附件管理
class UploadsModel extends CommonModel {
	public $_auto		=	array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
	/**
	 * ID删除附件管理记录及文件
	 * @param string $id ID
	 * @return array
	 */
	public function deleteByID($id){
		$condition['id'] = array ('in', explode ( ',', $id ) );
		$data=$this->where( $condition )->select();
		foreach($data as $val){
			//删除原图
			@unlink(ZUIXIAMI_ROOT.$val['fileurl']);
			//删除缩略图
			$cfg_file_thumb_prefix=CFG('cfg_file_thumb_prefix');
			if($cfg_file_thumb_prefix){
				$prefix=explode ( ',',$cfg_file_thumb_prefix);
	
				foreach($prefix as $v){
					@unlink(ZUIXIAMI_ROOT.$val['thumbpath'].$v.$val['filename']);
				}
			}
		}
		//删除数据
		$res=$this->where($condition)->delete();
		return $res;
	}
	/**
	 * 模块,模块ID删除附件管理记录/附件文件
	 * @param string $module 模块ID
	 * @param string/array $mid 模块ID
	 * @param bool	 $del_table 是否删除当前表记录
	 * @return mixed
	 */
	public function deleteByMid($module,$mid){
		$condition['module']=array('eq',$module);
		$condition['mid'] = array ('in', explode ( ',', $mid ) );
		$data=$this->where( $condition )->select();
		foreach($data as $val){
			//删除原图
			@unlink(ZUIXIAMI_ROOT.$val['fileurl']);
			//删除缩略图
			$cfg_file_thumb_prefix=CFG('cfg_file_thumb_prefix');
			if($cfg_file_thumb_prefix){
				$prefix=explode ( ',',$cfg_file_thumb_prefix);
	
				foreach($prefix as $v){
					@unlink(ZUIXIAMI_ROOT.$val['thumbpath'].$v.$val['filename']);
				}
			}
		}
		//删除数据
		$res=$this->where($condition)->delete();
		return $res;
	}
}
?>