/*!
 * jquery.scrollLoading.js 
 */
(function($) {
  $.fn.scrollLoading = function(options) {
    var defaults = {
      attr: "data-url",
      container: $(window),
      callback: $.noop
    };
    var params = $.extend({}, defaults, options || {});    
    obj=$(this);
    url = obj.attr(params.attr);
    console.log(url);
    callback=params.callback;
    if(url==null || typeof(url) == "undefined" || url=="" )
    {
      return;
    }
    //动态显示数据
    var loading = function() {
      var st=$(window).scrollTop();
      var ost=obj.offset().top;
      var wh=$(window).height();
      if((ost-st)<=wh)
      {
        $.get(url,{},function(data) {
          //var html = params.container.html();
          params.container.append(data);          
        });
      }
    };

    //事件触发
    //加载完毕即执行
    loading();
    //滚动执行
    $(window).bind("scroll", loading);
  };
})(jQuery);