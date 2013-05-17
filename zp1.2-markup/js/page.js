$(document).ready(function() {
	initPageBanner();
	theHomePageAni();
});


/***** code by perkyliu@126.com *****/

function initPageBanner() {
	var focusScroll = new ScrollPic();
	focusScroll.scrollContId = "page-banner"; //内容容器ID
	focusScroll.dotClassName = ""; //点className
	focusScroll.dotOnClassName = "cur"; //当前点className
	focusScroll.listType = ""; //列表类型(number:数字，其它为空)
	focusScroll.listEvent = "onmouseover"; //切换事件
	focusScroll.frameWidth = 494; //显示框宽度
	focusScroll.pageWidth = 494; //翻页宽度
	focusScroll.upright = false; //垂直滚动
	focusScroll.speed = 10; //移动速度(单位毫秒，越小越快)
	focusScroll.space = 40; //每次移动像素(单位px，越大越快)
	focusScroll.autoPlay = true; //自动播放
	focusScroll.autoPlayTime = 5; //自动播放间隔时间(秒)
	focusScroll.circularly = true;
	focusScroll.initialize(); //初始化

	$('#page-btn-prev').click(function() {
		focusScroll.pre();
		return false;
	})

	$('#page-btn-next').click(function() {
		focusScroll.next();
		return false;
	})
}

/***** code by zmy *****/

function theHomePageAni() {
	if(getCookie("rainbow-ani")=="")
	{
		$(".wgt-rainbow").parent().addClass("rainbow-ani");
		setCookie("rainbow-ani","yet");
	}
}

//获得coolie 的值

function getCookie(name) {
	var cookieArray = document.cookie.split("; "); //得到分割的cookie名值对  
	var cookie = new Object();
	for (var i = 0; i < cookieArray.length; i++) {
		var arr = cookieArray[i].split("="); //将名和值分开   
		if (arr[0] == name) return unescape(arr[1]); //如果是指定的cookie，则返回它的值 
	}
	return "";
}

function delCookie(name) {
	document.cookie = name + "=;expires=" + (new Date(0)).toGMTString();
}

function addCookie(objName, objValue, objHours) { //添加cookie
	var str = objName + "=" + escape(objValue);
	if (objHours > 0) { //为时不设定过期时间，浏览器关闭时cookie自动消失
		var date = new Date();
		var ms = objHours * 3600 * 1000;
		date.setTime(date.getTime() + ms);
		str += "; expires=" + date.toGMTString();
	}
	document.cookie = str;
}

function setCookie(name, value) {
	var Days = 30; //此 cookie 将被保存 30 天
	var exp = new Date(); //new Date("December 31, 9998");
	exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
	document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();

}