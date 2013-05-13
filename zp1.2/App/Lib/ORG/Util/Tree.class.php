<?php
/****************************************************
 * 用于将数据库中的数组按照从属关系整理成树或列表
 ***************************************************/

    class Tree {
        var $primary_key    = 'id' ;
        var $parent_key     = 'pid' ;
        var $begin_key      = 0 ;
        var $level          = 0 ;
        
        var $arr			= array();
        var $child_tree		= array();
        var $parent_tree	= array();
        
        var $tmp	= array();
        
        function __construct($arr) {
        	$this->_setArr($arr);
        }
        
        function init() {
        	if (!count($this->tmp_tree))
        	{
        		$this->_tempTree($this->arr);
        	}
        }
        
        function _setArr($arr) {
        	if ($arr != $this->arr)
        	{
        		$this->arr		= $arr;
        		$this->_tempTree($arr);
        	}
        }
        
        // 返回父列表
        function getParentList($node_id = null, $level=null) {
        	$node_id	= is_null($node_id)?$this->begin_key:$node_id;
        	return $this->_parent($node_id , $level);
        }
        
        // 返回子列表
        function getChildList($node_id = null , $level = 0) {
        	$node_id	= is_null($node_id)?$this->begin_key:$node_id;
        	return $this->_child($node_id , $level);
        }
        
        // 返回子树
        function getChildTree($node_id = null , $level = 0) {
        	$node_id	= is_null($node_id)?$this->begin_key:$node_id;
        	return $this->_child($node_id , $level , 'tree');
        }
        
        // 返回节点
        function getNode($node_id = null) {
        	$node_id	= is_null($node_id)?$this->begin_key:$node_id;
        	return $this->arr[$node_id];
        }
        
        function _tempTree($arr) {
        	if (!is_array($arr)) {
                return false;
            }
            
            foreach ($arr as $value) {
                $child_tree[$value[$this->parent_key]][$value[$this->primary_key]] = $value;
                $parent_tree[$value[$this->primary_key]]	= $arr[$value[$this->parent_key]];
            }
			$this->child_tree	= $child_tree;
			$this->parent_tree	= $parent_tree;
        }
        
        function _child($node_id , $level = 0, $type = 'list' , $this_level = 0) {
        	$arr	= $this->child_tree[$node_id];
        	$new_arr	= array();
        	
        	if ($arr) {
        		$this_level++;
        		foreach ($arr as $id => $node) {
        			$arr[$id]['level']	= $this_level;
        			$arr[$id]['child_count']	= count($this->child_tree[$id]);
        			//if ($level != 0 && $this_level >= $level) {
		        	//	return $arr;
		        	//}
		        	
		        	if ($type == 'list') {
		        		$new_arr	= $new_arr + array($id => $arr[$id]);
		        	}
		        	
		        	if ($level == 0 || $this_level < $level) {
		        		if ($this->child_tree[$id]) {
	        				$child	= $this->_child($id , $level , $type , $this_level);
	        				if ($type == 'tree') {
	        					$arr[$id]['child']	= $child;
	        				} else  {
	        					$new_arr	= $new_arr + $child;
	        				}
	        			}
		        	}
        		}
        		if (count($new_arr)) {
        			return $new_arr;
        		}
        		return $arr;
        	}
        }
        
        function _parent($node_id , $level = 0, $this_level = 0) {
        	$t	= $this->parent_tree[$node_id];
        	$parent_id	= $t[$this->primary_key];
        	$parent[$parent_id]	= $t;
        	if (!$parent[$parent_id])
        		return null;
    		
    		if ($this->parent_tree[$parent_id])
    		{
    			$node	= $this->_parent($parent_id);
    			if ($node)
    			{
    				$parent	= $node + $parent;
    			}
    		}
    		return $parent;
        }
      
    }

?>