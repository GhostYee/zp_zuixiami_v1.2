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
            $.ajax({
                type:"post",
                data:{xuwm:"1"},
                url:"../pages/save",
                success:function(data){
                    alert(data);
                },
                error:function(data){
                   alert("1111");
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
        $("#editcontents").click(function(){
            pages.action.save();
        });
    });
})();
