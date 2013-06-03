/**
 * Created with JetBrains PhpStorm.
 * User: xuwm
 * Date: 13-5-30
 * Time: 下午9:30
 * To change this template use File | Settings | File Templates.
 */
;(function(){
    var pages={};
    pages.action=(function(){
        var _save=function(){
            //获取CK的html内容

            var editor=CKEDITOR.instances["ckeditor1"];
            var _html=editor.getData();
            var html=encodeURIComponent(_html);
            var data={
                ajax:true,
                id:$("#id").val(),
                html:html
            };
            $.ajax({
                type:"post",
                data:data,
                url:"../pages/ajax",
                success:function(data){
                    //保存数据成功则，隐藏编辑器
                    //$("#pagecontent").html(data);
                    //alert(data);
                    if(data && data.data==='ok'){
                        //说明保存成功！
                        $("#pagecontent").html(_html);
                    }
                },
                error:function(data){
                }
            });
        };
        return {
            save:function(){
                _save();
            }
        }
    })();
    $(function(){
         //初始化的时候检查编辑按钮是否显示
        if (!$("#code").val()){
            $("#editcontents").hide();
        }
        //编辑内容
        $("#editcontents").click(function(){
            $("#ckcontaines").show();
            $("#savecontents").show();
            $("#pagecontent").hide();
            $("#editcontents").hide();
        });
        //保存内容
        $("#savecontents").click(function(){
            pages.action.save();
            $("#editcontents").show();
            $("#pagecontent").show();
            $("#savecontents").hide();
            $("#ckcontaines").hide();
        });
    });
})();
