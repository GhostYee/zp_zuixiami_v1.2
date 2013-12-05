<?php include '../inc/header.php'; ?>
<?php
  $qq='';
  $nickname='';
  $userid='';
  $workid=getRequest("wordid");
  session_start();
  if(empty($_SESSION['xiami_userid']))
  {
    header("Location: ../../login/relogin/");    
  }
  if (!empty($_SESSION['xiami_userid'])){
    $userid=$_SESSION['xiami_userid'];
    $nickname=$_SESSION['xiami_username'];
    $qq=$_SESSION['xiami_userqq'];
  }
  
  if(!empty($workid))
  {    
    $work=mysql_query("SELECT * from xiami_works where id='".$workid."' and userid=".$userid);
    $work=mysql_fetch_array($work);  
  }
  else
  {
    header("Location: ../../user/"); 
  }
?>

<body>
<div class="l-container">
  <?php include '../inc/wgt-rainbow.php'; ?>
  <div class="l-b-row ta-c">
    <div class="l-b-col l-side">
      <div class="box-shadow">
        <?php include '../inc/wgt-logo.php'; ?>
        <div class="wgt-searchBar">
          <form action="../../works/search/" method="post">
            <input type="text" name="keywords" id="" placeholder="请输入作品、标签">
            <button class="btn-search" type="submit"> <i class="icon-search"></i>
            </button>
          </form>
        </div>
      </div>

      <div class="wgt-nav box-shadow">
        <ul class="nav nav-list">
          <li><a href="../../user">个人信息管理</a></li>
          <li class="active"><a href="../../user/workslist">作品管理</a></li>          
          <li><a href="../../login/logout">退出</a></li>  
        </ul>
      </div>
      
    </div>
    <div class="l-b-col l-main">
      <div class="l-inner">
        <div class="l-header">
          <a href="zp-submit-1.html" class="btn-submitZP"> <em>+</em>
            提交作品
          </a>
        </div>
        <div class="l-b-row row-fluid">
          <div class="wgt-zp-edit box-shadow">
            <div class="inner clearfix">
              <div class="step-1"  >
                <form action="formTo.php" method="POST">
                  <fieldset class="wgt-submitFrom form-horizontal">
                    <div class="wgt-steps">
                      <ul class="clearfix  steps-3">
                        <li  class="current">
                          1.填写基本信息 <em></em> <i></i>
                        </li>
                        <li>
                          2.上传图片
                          <em></em> <i></i>
                        </li>
                        <li>
                          3.完成
                          <em></em>
                          <i></i>
                        </li>
                      </ul>
                    </div>
                    <legend class="page-title" >作品编辑-基本信息</legend>
                    <div class="control-group">
                      <label class="control-label">QQ号码：</label>
                      <div class="controls">
                        <input type="text" class="input-xlarge" value="<?php echo $qq ?>" id="inputUserQQ" ></div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">作者：</label>
                      <div class="controls">
                        <input type="text" class="input-xlarge" value="<?php echo $nickname ?>" id="inputAuthor" ></div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" >作品名称：</label>
                      <div class="controls">
                        <input type="text" class="input-xlarge"  id="inputZpName" value="<?php echo $work['name'] ?>" ></div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" >演示地址：</label>
                      <div class="controls">
                        <div class="input-prepend">
                          <span class="add-on">http://</span>
                          <input type="text" class="span2" id="inputDemoUrl" value="<?php echo $work['demourl']; ?>"  placeholder="演示地址" value=""></div>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" >开源地址：</label>
                      <div class="controls">
                        <div class="input-prepend">
                          <span class="add-on">http://</span>
                          <input type="text" class="span2" id="inputOpenUrl"   placeholder="开源地址" value="<?php echo $work['openurl']; ?>"></div>
                        <span class="help-block" >
                          推荐代码存放:
                          <a href="#" >Gitub</a>
                          、
                          <a href="http://jsbin.com/">jsbin</a>
                          、
                          <a href="http://jsfiddle.net/">jsfiddle</a>
                          .
                        </span>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">作品描述：</label>
                      <div class="controls">
                        <textarea name="description" id="inputDescription" class="input-xlarge" placeholder="从作品本身的功能性和技术性描述" rows="4"><?php echo $work['description']; ?></textarea>
                      </div>
                    </div>
                    <div class="form-actions">
                      <a href="javascript:;" class="btn-default btn-submit-to-2" >下一步</a>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="step-2">
                <fieldset class="wgt-submitFrom form-horizontal">
                  <legend class="page-title" >作品提交-上传图片</legend>
                  <div class="wgt-steps ">
                    <ul class="clearfix steps-3">
                      <li>
                        1.填写基本信息
                        <em></em>
                        <i></i>
                      </li>
                      <li class="current" >
                        2.上传图片
                        <em></em>
                        <i></i>
                      </li>
                      <li>
                        3.完成
                        <em></em>
                        <i></i>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <span class="btn-default fileinput-button">                      
                      <span>添加图片</span>
                      <!-- The file input field used as target for the file upload widget -->
                      <input id="fileupload" type="file" name="files[]"></span>
                    <!-- The global progress bar -->
                    <div id="progress" class="progress">
                      <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <!-- The container for the uploaded files -->
                    <div id="files" class="files">
                      <?php 
                      if (!empty($work['img']))
                      {
                        $deleteImg=split("/",$work[img]);
                        $deleteImg="http://zp.zuixiami.com/tempProject/page/server/php/?files=".$deleteImg[count($deleteImg)-1];
                        echo '<p><img src="'.$work['img'].'" /><button class="btn-img btn-default"  data-type="DELETE" data-url="'.$deleteImg.'">删除</button></p>';
                      }
                      ?>
                    </div>
                  </div>
                  <div class="form-actions ta-c">
                    <input type="hidden" value="<?php echo $work['img'] ?>" id="imgUrl">
                    <a class="btn-default btn-submit-to-1" href="javascript:;">上一步</a>
                    <a href="javascript:;" class="btn-default btn-submit-to-3 btn-submit-save" >提交保存</a>                  
                  </div>

                </fieldset>
              </div>
              <div class="step-3">
                <fieldset class="wgt-submitFrom  form-horizontal">
                  <legend class="page-title" >作品提交-完成</legend>
                  <div class="wgt-steps">
                    <ul class="clearfix steps-3">
                      <li>
                        1.填写基本信息
                        <em></em>
                        <i></i>
                      </li>
                      <li>
                        2.上传图片
                        <em></em>
                        <i></i>
                      </li>
                      <li class="current">
                        3.完成
                        <em></em>
                        <i></i>
                      </li>
                    </ul>
                  </div>
                  <div class="tip-ok" >
                    <div class="progress progress-striped active ">
                      <div class="bar" style="width: 100%;"></div>
                    </div>
                    <div class="tip-ok-message hide">                       
                    <a href="http://zp.zuixiami.com/works/<?php echo $work['id'] ?>" target="_blank" >[预览]</a>,如果显示不正常,赶紧联系管理员
                    </div>
                  </div>
                  <div class="form-actions ta-c">
                    <input type="hidden" id="zpID" value="<?php echo $work['id'] ?>">
                    <a href="JavaScript:;" class="btn-default btn-submit-to-1" >修改信息</a>
                    <a href="../../user/workslist" class="btn-default" >作品列表</a>                   
                  </div>
                </fieldset>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../asset/js/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="../asset/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="../asset/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="../asset/js/jquery.fileupload.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="../asset/js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<script type="text/javascript">
  $(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',        
        acceptFileTypes:/(\.|\/)(gif|jpe?g|png)$/i,
        maxNumberOfFiles:1,
        done: function (e, data) {         
            $.each(data.result.files, function (index, file) {
                console.log(file);
                $('<p/>').html("<img src=\""+file.url+"\" /><button class=\"btn-img btn-default\"  data-type=\""+file.deleteType+"\" data-url=\""+file.deleteUrl+"\">删除</button>").appendTo('#files');
                var imgUrl=$("#imgUrl");
                var imgUrlValue=$("#imgUrl").val();                
                $("#imgUrl").val(imgUrlValue+file.url);                
            }); 
        },
        progressall: function (e, data) {
            var obj=$('#progress .progress-bar');
            var progress = parseInt(data.loaded / data.total * 100, 10);
            obj.css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    $(".btn-img").live("click",function(){
      var obj=$(this);
      var url=obj.attr("data-url");
      $.ajax({
        type: "DELETE",
        url: url,
        success:function(data){           
          obj.parent().hide("fast",function(){
            $(this).remove();
            if($("#files>p").length<=0){
              var obj=$('#progress .progress-bar');
              obj.css('width','0%');
              $("#imgUrl").val("");
            }
          })
        }        
      });      
    });
});

</script>
<?php include '../inc/footer.php'; ?></body>
</html>