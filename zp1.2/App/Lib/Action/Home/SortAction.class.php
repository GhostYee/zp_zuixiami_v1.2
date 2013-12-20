<?php
//首页
class SortAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function view()
    { 
            
        $sortid=$this->_get('id')?intval($this->_get('id')):'0';

        $zpClass_model=D();
        $zpClass=$zpClass_model->query("SELECT COUNT( * ) AS num, s.name, s.id FROM xiami_works AS w LEFT JOIN xiami_works_sort AS s ON s.id = w.sortid WHERE s.id IS NOT NULL GROUP BY sortid ");
        $sort=$zpClass_model->query("SELECT * from xiami_works_sort where id=".$sortid);
        $sort=$sort[0];
        $this->assign('tags',$zpClass);             
        $this->assign('currPage',"sort");   
        $this->assign('sort',$sort);
        
        $this->load_works($sortid); 

    	$this->display();
    }


   

    // ------------------------------------------------------------------------

    //装载 作品 数据
    public function load_works($sortid)
    {   
    	
    	
        $works_model=D('Works');
        
        //状态 默认通过审核
        $where['works.status']=2;       
		$where['works.is_top']=0;
        $where['works.sortid']=$sortid;       
        
            
        //判断排序
        $index_works_order=CFG('cfg_index_works_order');        
        if($index_works_order){
          // $orderby=$index_works_order;
            $orderby="addtime DESC";
        }
        else{
            //排序推荐 降序，推荐排序降序，ID 升序
            $orderby="works.is_top DESC,works.top_sid DESC,works.id DESC ";
           // $orderby="rand()";
        }        
        //判断显示条数
        $index_works_num=CFG('cfg_index_works_num');
        if($index_works_num){
            $limit= $index_works_num;
        }
        
        // 取出需要的数据
        $allinone['where']=$where;
        $allinone['order']=$orderby;
        $allinone['limit']=$limit;
        $works  = $works_model->getWorksList($allinone);   
        //dump($works);
        $this->assign('works',$works);
        
        //解决__info__ 为空显示__info__ bug
        $fromurl=__INFO__;
        if($fromurl=='__INFO__'){
            $fromurl='/';
        }
        $this->assign('fromurl',$fromurl);
    }
    // ------------------------------------------------------------------------
}