/***** code by perkyliu@126.com *****/
function initPageBanner(){
	var focusScroll = new ScrollPic();
	focusScroll.scrollContId = "page-banner"; //内容容器ID
	focusScroll.dotClassName = "";//点className
	focusScroll.dotOnClassName = "cur";//当前点className
	focusScroll.listType = "";//列表类型(number:数字，其它为空)
	focusScroll.listEvent = "onmouseover"; //切换事件
	focusScroll.frameWidth = 494;//显示框宽度
	focusScroll.pageWidth = 494; //翻页宽度
	focusScroll.upright = false; //垂直滚动
	focusScroll.speed = 10; //移动速度(单位毫秒，越小越快)
	focusScroll.space = 40; //每次移动像素(单位px，越大越快)
	focusScroll.autoPlay = true; //自动播放
	focusScroll.autoPlayTime = 5; //自动播放间隔时间(秒)
	focusScroll.circularly = true;
	focusScroll.initialize(); //初始化

	$('#page-btn-prev').click(function(){
	  focusScroll.pre();
	  return false;
	}) 

	$('#page-btn-next').click(function(){
	    focusScroll.next();
	    return false;
	})
}

$(document).ready(function() {
	initPageBanner();
});