<?php
// ------------------------------------------------------------------------
/**
 * 数字日期转中文汉字几天前
 *
 * @access	public
 * @param	string	
 * @return	mixed
 */
if ( ! function_exists('inttodate_han'))
{
	function inttodate_han($time)
	{
		if(empty($time)){ return '';}
		$now=strtotime(date('Y-m-d',strtotime("+1 day")));
		$jiange=$now-$time;

		if($jiange<0){
			return false;
		}
		elseif($jiange<=3600*24){
			return '今天';
		}
		elseif($jiange<=3600*24*2){
			return '昨天';
		}
		elseif($jiange<=3600*24*4){
			return '三天前';
		}
		elseif($jiange<=3600*24*8){
			return '一星期前';
		}
		elseif($jiange<=3600*24*31){
			return '一个月前';
		}
		elseif($jiange<=3600*24*93){
			return '三个月前';
		}
	}
}

?>