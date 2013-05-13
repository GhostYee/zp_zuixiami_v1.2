;$(document).ready(function(){	
	var c=$("#zpList"),
			cWidth,
			elWidth = 250,
			fluid = function(){
				m = ($('#worksList').width()%elWidth)/2-5;
				if($(window).width()>(elWidth+50)){
					c.css('margin', '0 ' + m +'px');
				}else{
					c.css('margin', '0 auto');
				}
    		c.isotope('reLayout');
			};
	c.isotope({
    itemSelector : 'li',
    layoutMode : 'masonry',
    resizable : false,
    masonry: {
	    columnWidth: elWidth
	  }
	})
  // change size of clicked element
  .delegate( 'li', 'click', function(){
    $(this).toggleClass('large');
    c.isotope('reLayout');
  });
	fluid();
  $(window).smartresize(fluid);
});
