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
      </div>
    </div>
    <div class="l-b-col l-main">
      <div class="l-inner">
        <div class="l-header" >
          <div class="wgt-breadcrumb">
            <a href="__APP__/">首页</a>
            /
            <span>团队列表</span>
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
          <div class="box-shadow span10">
            <div class="wgt-team">
  <h2 class="page-title">团队列表</h2>
  <div class="team-list">
    <ul class="media-list">
      <?php if(is_array($teamlist)): foreach($teamlist as $key=>$val): ?><li class="media">
        <a class="pull-left" href="__APP__/team/<?php echo ($val['id']); ?>">
          <img class="media-object" data-src="holder.js/100x100" alt="100x100" style="width: 100px; height: 100px;" src="<?php echo ($val['teamimg']); ?>"></a>
        <div class="media-body">
          <h4 class="media-heading">
            <a href="__APP__/team/<?php echo ($val['id']); ?>"><?php echo ($val['teamname']); ?></a>
          </h4>
          <?php if($val['teamurl'] != ''): ?><p>
            团队网站：
            <a href="<?php echo ($val['teamurl']); ?>" target="_blank"><?php echo ($val['teamurl']); ?></a>
          </p><?php endif; ?>
          <p>
            团队成员：
            <a href="__APP__/team/user/<?php echo ($val['id']); ?>"><?php echo ($val['total_team_user']); ?></a>
            <span class="division">|</span>
            团队作品：
            <a href="__APP__/team/<?php echo ($val['id']); ?>"><?php echo ($val['total_team_works']); ?></a>
          </p>
          <p class="opts">
            <a href="__APP__/team/<?php echo ($val['id']); ?>" class="btn-default">查看作品</a>
          </p>
          <blockquote><?php echo ($val['notice']); ?></blockquote>
        </div>
      </li><?php endforeach; endif; ?>    
    </ul>
  </div>
</div>  
          </div>          
          <div class="wgt-zp-opts span2"> <a href="__APP__/team/submit" class="btn-default">创建</a> </div>
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

<script type="text/javascript" src="../Public/js/scrollpic.js"></script>
</body>
</html>