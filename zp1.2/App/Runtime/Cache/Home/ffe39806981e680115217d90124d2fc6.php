<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($seo["title"]); ?></title>
<meta name="keywords" content="<?php echo ($seo["keywords"]); ?>">
<meta name="description" content="<?php echo ($seo["description"]); ?>">
<link href="../Public/css/style-1.css" media="screen" rel="stylesheet" type="text/css" />


</head>
<body>
<div class="l-container">
  <div class="l-b-row">
    <ul class="wgt-rainbow" >
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
</ul>
<div class="logo-ani">
	<div class="logo-ani-detail">
		<img src="../Public/img/logo_ani.png" alt=""></div>
</div>
  </div>
  <div class="l-b-row ta-c">
    <div class="l-b-col l-side">
      <div class="box-shadow">
        <h1 class="wgt-logo"> <a href="__APP__/">最虾米-发现前端价值</a> </h1>
        <div class="wgt-searchBar">
	<form action="__APP__/works/search/" method="post">
		<input type="text" name="keywords" id="" placeholder="请输入作品、标签" >
		<button class="btn-search" type="submit" > <i class="icon-search"></i>
		</button>
	</form>
</div>      
      </div>
      
      <div class="wgt-nav box-shadow">
        <ul class="nav nav-list">
          <li class="active"><a href="__APP__/user">个人信息管理</a></li>
          <li><a href="__APP__/user/works">作品管理</a></li>
          <li><a href="__APP__/user/team">团队管理</a></li>
          <li><a href="__APP__/user/message">评论管理</a></li>
          <li><a href="__APP__/user/logout">退出</a></li>  
        </ul>
      </div>
    </div>
    <div class="l-b-col l-main">
      <div class="l-inner">
        <div class="l-header" >
          <div class="wgt-breadcrumb">
            <a href="__APP__/">首页</a>/<a href="__APP__/user">用户中心</a>/<span>个人信息编辑</span>
          </div>          
          <nav class="wgt-topNav">
	<li>
		<a href="__APP__/user">登录/注册</a>
	</li>
	<li>
		<a href="__APP__/pages/tools">工具箱</a>
	</li>
</nav>
        </div>
        <div class="l-b-row row-fluid">
          <div class="wgt-uc-info box-shadow">
			<form method="post" action="__APP__/user/update" enctype="multipart/form-data" >
            <fieldset class="wgt-submitFrom  form-horizontal">
            <legend class="page-title" >个人信息编辑</legend>
             <div class="control-group">
              <label class="control-label">统计信息：</label>
              <div class="controls">                
                <p class="labelInfo" >
                  <span>
                    上传 <a href="#"><strong><?php echo ($userinfo['total_all_user_works']); ?></strong></a> 件作品；
                  </span>
                  / 
                  <span>
                    审核通过 <a href="#"><strong><?php echo ($userinfo['total_user_works']); ?></strong></a> 件；
                  </span>
                  <span>
                    加入 <a href="#"><strong><?php echo ($userinfo['total_user_team']); ?></strong></a> 个团队;
                  </span>
                  /
                  <span>
                    参加 <a href="#"><strong><?php echo ($userinfo['total_user_works_special']); ?></strong></a> 个专题;
                  </span>
                </p>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">QQ号码：</label>
              <div class="controls">
                <input type="text" class="input-xlarge" readonly="readonly" name="qq" id="qq" value="<?php echo ($userinfo['qq']); ?>">        
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">昵称：</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="nickname" id="nickname" value="<?php echo ($userinfo['nickname']); ?>" <?php if($userinfo['is_open'] == '0'): ?>readonly="readonly"<?php endif; ?>> 
                <span class="help-block" >默认显示绑定QQ的昵称；<a href="#">解除绑定</a></span>          
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">头像：</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="figureurl" id="figureurl" value="<?php echo ($userinfo['figureurl']); ?>" <?php if($userinfo['is_open'] == '0'): ?>readonly="readonly"<?php endif; ?>>      
              </div>
            </div>
			<?php if($userinfo['qun_sort_id'] != '0'): ?><div class="control-group">
              <label class="control-label">所属群：</label>
              <div class="controls">
                <select name="qun_sort_id" id="qun_sort_id" >
                  <option value="1" <?php if($userinfo['qun_sort_id'] == '1'): ?>selected="selected"<?php endif; ?>>成长群</option>
                  <option value="2" <?php if($userinfo['qun_sort_id'] == '2'): ?>selected="selected"<?php endif; ?>>高级群</option>
                </select> 
                <span class="help-block" >周期性更新，群员归属</span>
              </div>
            </div><?php endif; ?>
            <div class="control-group">
              <label class="control-label">BLOG：</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="userurl" id="userurl" value="<?php echo ($userinfo['userurl']); ?>">         
              </div>
            </div>

           
            <div class="control-group">
              <label class="control-label">自我简介：</label>
              <div class="controls">
                <textarea name="notice" id="notice" class="input-xlarge" rows="3"><?php echo ($userinfo['notice']); ?></textarea>
              </div>
            </div>
            <div class="form-actions">
              <input type="submit"  class="btn-default" value="保存"  />   
              <!--<a href="#" class="btn-default" >保存</a>-->         
            </div>
            </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="ta-c l-footer">  
    <nav class="wgt-footerNav" > <a href="__APP__/pages/about">关于最虾米</a> | <a href="#">联系我们</a> | <a href="__APP__/message">意见反馈</a> </nav>
    <div class="wgt-copyright"> Copyright ©2013 www.zuixiami.com, All Rights Reserved </div>
</div>
<script type="text/javascript" src="../Public/js/jquery.min.js"></script>
<script type="text/javascript" src="../Public/js/jquery.base64.min.js"></script>
<script type="text/javascript" src="../Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../Public/js/jquery.transit.js"></script>
<script type="text/javascript" src="../Public/js/page.js"></script>
<div class="hide">
<?php echo ($CFG['cfg_tongji']); ?>
</div>

<script language="javascript">
//赞/期待 by wewe
function do_good_await(module,mtype,mid){
  if(module!='' && mtype!='' && mid!='')
  {
    $.ajax({
      type: "POST",
      url: "<?php echo __APP__;?>/works/user_action",
      data: "module="+module+"&mtype="+mtype+"&mid="+mid,
      dataType: "json",
      success: function(data){
        if(data.code=='ok'){          
          $("#do_"+mtype+"_"+mid).html(data.msg); 
        }
        else if(data.code=='error'){
          //alert(data.msg);
        }
      }
    });
  }
}
</script>
</body>
</html>