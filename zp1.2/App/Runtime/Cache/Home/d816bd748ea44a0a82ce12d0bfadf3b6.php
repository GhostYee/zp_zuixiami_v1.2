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
      <div class="wgt-teamInfo-base box-shadow ">
	<span class="state-make isTeam">团</span>
	<div class="inner l-b-row">
		<a href="__APP__/team/<?php echo ($team['id']); ?>" class="team-header">
			<img src="<?php echo ($team['teamimg']); ?>" alt=""></a>
		<div class="info-1">
			<p>
				<a href="__APP__/team/<?php echo ($team['id']); ?>"><?php echo ($team['teamname']); ?></a>
			</p>
			<p>
				成员：
				<a href="__APP__/team/user/<?php echo ($team['id']); ?>"><?php echo ($team['total_team_user']); ?></a>
			</p>
			<p>
				作品：
				<a href="__APP__/team/<?php echo ($team['id']); ?>"><?php echo ($team['total_team_works']); ?></a>
			</p>
		</div>
		<div class="info-2">
			创建：
			<a href="__APP__/author/<?php echo ($team['creatuserid']); ?>"><?php echo ($team['creatusername']); ?></a>
            <?php if($team['teamurl'] != ''): ?><span class="division">|</span>
			Blog：
			<a href="<?php echo ($team['teamurl']); ?>" target="_blank">点击进入</a><?php endif; ?>
            <?php if($team['notice'] != ''): ?><span class="division">|</span>
			简介：<?php echo ($team['notice']); endif; ?>
		</div>
	</div>
</div>
      <div class="wgt-nav box-shadow">
        <ul class="nav nav-list">
          <li><a href="__APP__/team/<?php echo ($team['id']); ?>">团队作品</a></li>
          <li class="active"><a href="__APP__/team/user/<?php echo ($team['id']); ?>">团队成员</a></li>
        </ul>
      </div>
    </div>
    <div class="l-b-col l-main">
      <div class="l-inner">
        <div class="l-header" >
          <div class="wgt-breadcrumb">
            <a href="__APP__/">首页</a>
            /
            <a href="__APP__/team">团队列表</a>
            /
            <span>团队成员</span>
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
              <div class="wgt-team-member">
  <h2 class="page-title">w3cplus 团队成员</h2>
  <ul class="media-list">
    <?php if(is_array($userlist)): foreach($userlist as $key=>$val): ?><li class="media"> <a class="pull-left" href="__APP__/author/<?php echo ($val['id']); ?>"> <img class="media-object" src="<?php echo ($val['figureurl']); ?>"></a>
      <div class="media-body">
        <h4 class="media-heading"> <a href="__APP__/author/<?php echo ($val['id']); ?>"><?php echo ($val['nickname']); ?></a> </h4>
        <p> 来自： <a href="#"><?php echo ($val['qunname']); ?></a> </p>
        <p> 作品数： <a href="__APP__/author/<?php echo ($val['id']); ?>"><?php echo ($val['total_user_works']); ?></a> <span class="division" >|</span> 期待数： <a href="javascript:void(0)" onClick="do_good_await('User','await',<?php echo ($val['id']); ?>)"><span id="do_await_<?php echo ($val['id']); ?>"><?php echo ($val['await']); ?></span></a> </p>
        <p> Blog： <a href="<?php echo ($val['userurl']); ?>" target="_blank"><?php echo ($val['userurl']); ?></a> </p>
        <p class="opts"> <span> <a href="__APP__/author/message/<?php echo ($val['id']); ?>" >留言</a> </span> <a href="__APP__/author/<?php echo ($val['id']); ?>" class="btn-default" >查看作品</a> </p>
        <blockquote><?php echo ($val['notice']); ?></blockquote>
      </div>
    </li><?php endforeach; endif; ?>
  </ul>
</div>

              </div>
              <div class="wgt-zp-opts span2">
                <div class="btn-group open">
                  <a class="btn-default" href="javascript:;" data-toggle="dropdown">
                    默认排序
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="__APP__/team/user/time/<?php echo ($team['id']); ?>">按时间排序</a>
                    </li>
                    <li>
                      <a href="__APP__/team/user/hits/<?php echo ($team['id']); ?>">按人气排序</a>
                    </li>
                    <li>
                      <a href="__APP__/team/user/await/<?php echo ($team['id']); ?>">按期待排序</a>
                    </li>
                  </ul>
                </div>
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