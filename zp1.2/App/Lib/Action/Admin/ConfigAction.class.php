<?php
/**
 * 系统配置
 */
class ConfigAction extends CommonAction {
	/**
	 +----------------------------------------------------------
	 * 默认显示首页列表
	 * 可以在action控制器中重载
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 * @throws ThinkExecption
	 +----------------------------------------------------------
	 */
	public function index() {
		$group_list=$this->get_settings();
		$this->assign('group_list',$group_list);
		$this->display();
		return;
	}
	
	// ------------------------------------------------------------------------
	/**
	 * 配置页修改
	 *
	 * @access  public
	 * @return  void
	 */
	function post(){
		$value=$_POST['value'];
		$count = count($value);
	
		$arr = array();
		$config=D('config');
		$configList = $config->select();
		
		foreach ($configList as $row)
		{
			$arr[$row['id']] = $row['value'];
		}
		foreach ($value AS $key => $val)
		{
			if($arr[$key] != $val)
			{
				//更新
				$data['value']=stripslashes(trim($val));
				$config->where(array('id'=>$key))->save($data);
			}
		}
		
		import('@.ORG.Syscache');
		new Syscache('sysconfig');
		
		$this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
		$this->success ('编辑成功!');
	}
	
	// ------------------------------------------------------------------------
	/**
	 * 获得设置信息
	 *
	 * @param   array   $groups     需要获得的设置组
	 * @param   array   $excludes   不需要获得的设置组
	 *
	 * @return  array
	 */
	function get_settings($groups=null, $excludes=null)
	{
		
		$model=M();
		$config_groups = '';
		$excludes_groups = '';
	
		if (!empty($groups))
		{
			foreach ($groups AS $key=>$val)
			{
				$config_groups .= " AND (id='$val' OR pid='$val')";
			}
		}
	
		if (!empty($excludes))
		{
			foreach ($excludes AS $key=>$val)
			{
				$excludes_groups .= " AND (pid<>'$val' AND id<>'$val')";
			}
		}
	
		/* 取出全部数据：分组和变量 */
		$sql = "SELECT * FROM ".C('DB_PREFIX')."config WHERE type<>'hidden' $config_groups $excludes_groups ORDER BY pid, sid, id";
		//echo $sql;exit;
		$item_list =$model->query($sql);
	
		/* 整理数据 */
		$group_list = array();
		foreach ($item_list AS $key => $item)
		{
			$pid = $item['pid'];
			//$item['desc'] = isset($_LANG['cfg_desc'][$item['code']]) ? $_LANG['cfg_desc'][$item['code']] : '';
	
			if ($pid == 0)
			{
				/* 分组 */
				if ($item['type'] == 'group')
				{
					$group_list[$item['id']] = $item;
				}
			}
			else
			{
				/* 变量 */
				if (isset($group_list[$pid]))
				{
					if ($item['store_range'])
					{
						$item['store_options'] = explode(',', $item['store_range']);
						$item['range_desc'] = explode(',', $item['range_desc']);
	
						foreach ($item['store_options'] AS $k => $v)
						{
							$item['display_options'][$k] = $item['range_desc'][$k];
						}
					}
					$group_list[$pid]['vars'][] = $item;
				}
			}
	
		}
	
		return $group_list;
	}
}
?>