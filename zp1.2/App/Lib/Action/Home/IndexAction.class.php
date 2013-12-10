<?php
//首页
class IndexAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function index()
    {   
        //标签列表
        $tag_model=D('Tag');
        $tags  = $tag_model->getIndexTags('10');        
        $this->assign('tags',$tags);
        
        //排行榜列表
        $works_model=D('Works');
        $works  = $works_model->getWorksGoodRanking(5); 
        $this->assign('rankList',$works);
        
        //作品列表    	     
    	//$this->load_works_top();
        $this->load_works();

    	$this->display();
    }

    public function load_works_top()
    {
        
    }
    // ------------------------------------------------------------------------

    //装载 作品 数据
    public function load_works()
    {   
    	$keywords=!empty($_POST['keywords'])?trim($_POST['keywords']):'';
    	
        $works_model=D('Works');
        
        //状态 默认通过审核
        $where['works.status']=2;       
		
        //查找关键词作品名,作者,描述
        if(!empty($keywords)){
        	$map['works.name'] = array('like', "%" . $keywords . "%");
        	$map['works.author'] = array('like', "%" . $keywords . "%");
        	$map['works.description'] = array('like', "%" . $keywords . "%");
        	$map['qun_sort.name'] = array('like', "%" . $keywords . "%");
        	$map['_logic'] = 'or';
        	$where['_complex']=$map;
        }
            
        //判断排序
        $index_works_order=CFG('cfg_index_works_order');        
        if($index_works_order){
          // $orderby=$index_works_order;
            $orderby="rand()";
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