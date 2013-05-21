<?php
//作者相关
class AuthorAction extends CommonAction {
	// ------------------------------------------------------------------------
	/**
	 * 首页
	 *
	 * @access  public
	 * @return  void
	 */
    public function _initialize() {
        
        $id = !empty($_GET['_URL_'][2]) ? (int)$_GET['_URL_'][2] : 0;
        $action = !empty($_GET['_URL_'][1]) ? $_GET['_URL_'][1] : 'view';
        $qunMemberModel = M('qun_member');
        $authorSql = 'SELECT m.*, s.name as qun_sort_name FROM xiami_qun_member AS m LEFT JOIN xiami_qun_sort AS s ON m.qun_sort_id=s.sid '.
            'WHERE m.id='.$id;
        
        $author	= $qunMemberModel->query($authorSql);
        $this->assign('author', $author[0]);
        $this->assign('active', array($action =>' class="active"'));
    }    
    
    public function index(){
    	$keywords=trim($_POST['keywords']);
    	$keywords=!empty($keywords)?$keywords:'';
    	$id=$_REQUEST['id'];
    	$status=empty($_REQUEST['status'])?'2':$_REQUEST['status'];
    	
    	//取得用户信息
    	$qun_member_model=M('qun_member');
    	$qun_member=$qun_member_model->where("`id`='$id'")->find();
    	
		if($qun_member){
	    	$works_model=D('works');
	    	//状态
	    	$where.=" AND w.`status`='$status' ";
	    	
	    	//作者
	    	$where.=" AND qm.`id`='$qun_member[id]' ";
	    	
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
	    	
			/*
	    	//判断显示条数
	    	$index_works_num=CFG('cfg_index_works_num');
	    	if($index_works_num){
	    		$limit=" limit $index_works_num ";
	    	}
			*/
	    	// 取出需要的数据
	    	$sql	= "SELECT w.*,IFNULL(author,qm.name) author,s.name sortname,qs.name qunname,qm.id author_id FROM ".C('DB_PREFIX')."works w ".
	    			" LEFT JOIN ".C('DB_PREFIX')."works_sort s ON s.id=w.sortid ".
	    			" LEFT JOIN ".C('DB_PREFIX')."qun_sort qs ON qs.id=w.qun_sortid ".
	    			" LEFT JOIN ".C('DB_PREFIX')."qun_member qm ON qm.qq=w.qq ".
	    			" where 1 $where $orderby $limit";
	    	$works	= $works_model->query($sql);
	    	
	    	$this->assign('works',$works);
	    	$this->assign('keywords',$keywords);
	    	$this->assign('status',$status);
	    	$this->assign('id',$qun_member['id']);
	    	$this->assign('author',$qun_member['id']);
	    	$this->assign('qun_member',$qun_member);
	    	
	    	//替换模板SEO的值
	    	$seo['title']='最蝦米*鬼懿IT*作品秀';
	    	$seo['keywords']=C("CFG_SEO_KEYWORDS");
	    	$seo['description']=C("CFG_SEO_DESCRIPTION");
	    	$this->assign('seo',$seo);
	    	
	    	$this->display();
		}
		else{
			$this->error('未找到此作者信息');
		}
    }
    // ------------------------------------------------------------------------
    
    public function view() {
        $id = !empty($_GET['_URL_'][2]) ? (int)$_GET['_URL_'][2] : 0;

        $worksModel = M('works');
        $worksWhere['author_id'] = $id;
        $works = $worksModel->where($worksWhere)->order('id desc')->select();
        
        $this->assign('works', $works);
        $this->display();
    }
    
    public function team() {
        $this->display();
    }
    
    public function message() {
        $this->display();
    }
}