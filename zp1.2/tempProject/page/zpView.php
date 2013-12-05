<?php include '../inc/header.php'; ?>
<?php 
    if(empty($_REQUEST['zpid']))
    {      
      header("Location: home.php"); 
      exit;
    }
    $zpid=$_REQUEST['zpid'];
    $work = mysql_query("SELECT * from xiami_works WHERE status=2 AND id=".$zpid);
    $work = mysql_fetch_array($work);   
   // $author=mysql_query("SELECT * from xiami_user WHERE id=".$work['userid']);   
   // $author = mysql_fetch_array($author);
?>
<body>
<div class="l-container">
  <?php include '../inc/wgt-rainbow.php'; ?>
  <div class="l-b-row ta-c">
    <div class="l-b-col l-side">
      <div class="box-shadow">
        <?php include '../inc/wgt-logo.php'; ?></div>
      <div class="wgt-userInfo-base box-shadow">
        <div class="inner">
          <a href="authorView.html" class="user-header">
            <?php 
            //  if($author['figureurl']=='auth_figureurl' || $author['figureurl']=='')
            //  {
            ?>
            <img src="../images/uheader.jpg" alt="" />
            <?php
            //}
            //else{
            ?>
           
            <?php
             //}
            ?>
          </a>
          <div class="con">
            <p>
              <a href="authorView.php?userid=<?php echo $work['author'] ?>" class="user-name" ><?php echo $work['author'] ?> </a>
            </p>                      
                           
            </div>
          </div>
        </div>

        <div class="wgt-nav box-shadow">
          <ul class="nav nav-list">
            <li class="active" >
              <a href="authorView.html">Ta的作品集</a>
            </li>           
          </ul>
        </div>
      </div>
      <div class="l-b-col l-main">
        <div class="l-inner">
          <div class="l-header" >
            <div class="wgt-breadcrumb">
              <a href="home.php">首页</a>
              /
              <span><?php echo $work['name'] ?></span>
            </div>
            <nav class="wgt-topNav">
              <li>
                <a href="tools.html">工具箱</a>
              </li>
            </nav>
          </div>
          <div class="l-b-row row-fluid">
            <div class="wgt-detail box-shadow span10">
              <h2><?php echo $work['name'] ?></h2>
              <div class="pic">
                <img src="<?php echo $work['img'] ?>" alt=""></div>             
              <div class="intr">
                <blockquote> <em class="dqm" >“</em>
                  <?php echo $work['description'] ?>
                </blockquote>
              </div>
              <div class="info">
                <p>
                  演示地址：
                  <a href="<?php echo $work['demourl'] ?>"><?php echo $work['demourl'] ?></a>
                </p>      
                <p class="pubtime" >发表于：<?php echo date("Y-m-d H:i:s",$work['addtime']) ?></p>
              </div>
            </div>
            <div class="wgt-zp-opts span2">              
              <a href="<?php echo $work['demourl'] ?>" class="btn-default" >查看源地址</a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include '../inc/footer.php'; ?></body></html>