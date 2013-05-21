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
        $this->load_thisBase();
    	$this->load_works();    	
    	$this->display();
    }

    //查询-作品
    public function search()
    {
        $currPage="search";
        $this->assign('currPage',$currPage); 
        $this->index();       
    }

    //标签-作品
    public function tag()
    {
        $this->load_thisBase();  
        $tagid=trim($_REQUEST['tagid']);    
        $tag=trim($_REQUEST['tag']);

        $works_model=M('works');
        $sql    = "SELECT w.*,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id".
                  " author_id FROM ".C('DB_PREFIX')."works w ".
                  " LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
                  " LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
                  " LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
                  " LEFT JOIN ".C('DB_PREFIX')."tag_relationship tr on tr.workid=w.id ".
                  " WHERE w.status=2 AND tr.tagid=$tagid order by w.id desc ";
        $works  = $works_model->query($sql); 
        $this->assign('works',$works);  

        $currPage="tag";
        $this->assign('currPage',$currPage); 
        $this->assign('tag',$tag); 
        $this->display("Index:search");       
    }


    // ------------------------------------------------------------------------

    // 转载 首页 基本数据
    private function load_thisBase()
    {
        $this->load_seo();
        $this->load_tags();    
        $this->load_rankList(); 
    }

    //装载 排行版 数据
    private function load_rankList()
    {
        $works_model=M('works');
        $sql    = "SELECT * FROM xiami_works order by good DESC LIMIT 5 ";
        $works  = $works_model->query($sql); 
        $this->assign('rankList',$works);          
    }
   
    //装载 tags 数据
    private function load_tags()
    {
        $tag_model=M('tags');
        $sql    = "SELECT * from xiami_tag ";
        $tags  = $tag_model->query($sql);        
        $this->assign('tags',$tags);
    }


    //装载 SEO 数据
    private function load_seo()
    {
        //替换模板SEO的值
        $seo['title']='最蝦米*鬼懿IT*作品秀';
        $seo['keywords']=C("CFG_SEO_KEYWORDS");
        $seo['description']=C("CFG_SEO_DESCRIPTION");
        $this->assign('seo',$seo);        
    }

    //装载 作品 数据
    private function load_works()
    {
        $keywords=trim($_POST['keywords']);
        $keywords=!empty($keywords)?$keywords:'';
        $status=empty($_REQUEST['status'])?'2':$_REQUEST['status'];
        $works_model=D('works');
        //状态 默认通过审核
        $where.=" AND w.`status`='$status' ";
        //$where=' AND w.`status`=2 ';        
        if(!empty($keywords)){
            //查找作品名,作者,描述
            $where.=" AND (w.`name` like '%$keywords%' or w.`author` like '%$keywords%' or w.`description` like '%$keywords%'  or qs.`name`='$keywords')";
        }        
        //判断排序
        $index_works_order=CFG('cfg_index_works_order');        
        if($index_works_order){
            $orderby=" ORDER BY $index_works_order ";
        }
        else{
            //排序推荐 降序，推荐排序降序，ID 升序
            $orderby=" ORDER BY w.is_top DESC,w.top_sid DESC,w.id DESC ";
        }        
        //判断显示条数
        $index_works_num=CFG('cfg_index_works_num');
        if($index_works_num){
            $limit=" limit $index_works_num ";
        }
        // 取出需要的数据
        $sql    = "SELECT w.*,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id author_id FROM ".C('DB_PREFIX')."works w ".
                " LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
                " LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
                " LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
                " where 1 $where $orderby $limit";
        $works  = $works_model->query($sql);        
        $this->assign('works',$works);
        $this->assign('keywords',$keywords);
        $this->assign('status',$status);
        
        //解决__info__ 为空显示__info__ bug
        $fromurl=__INFO__;
        if($fromurl=='__INFO__'){
            $fromurl='/';
        }
        $this->assign('fromurl',$fromurl);
    }
    // ------------------------------------------------------------------------
}