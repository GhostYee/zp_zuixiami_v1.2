define(function(require, exports, module) {
	module.exports = {
		debug:function(){
			console.log("This is cookit module!");
		},
		get: function(name) {
			var cookieArray = document.cookie.split("; "); //得到分割的cookie名值对  
			var cookie = new Object();
			
			for (var i = 0; i < cookieArray.length; i++) {
				var arr = cookieArray[i].split("="); //将名和值分开   
				if (arr[0] == name) return unescape(arr[1]); //如果是指定的cookie，则返回它的值 
			}
			return "";
		},
		del: function(name) {
			document.cookie = name + "=;expires=" + (new Date(0)).toGMTString();
		},

		add: function(objName, objValue, objHours) { //添加cookie
			var str = objName + "=" + escape(objValue);
			if (objHours > 0) { //为时不设定过期时间，浏览器关闭时cookie自动消失
				var date = new Date();
				var ms = objHours * 3600 * 1000;
				date.setTime(date.getTime() + ms);
				str += "; expires=" + date.toGMTString();
			}
			document.cookie = str;
		},
		set: function(name, value) {
			var Days = 30; //此 cookie 将被保存 30 天
			var exp = new Date(); //new Date("December 31, 9998");
			exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
			document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
		}
	}
});

