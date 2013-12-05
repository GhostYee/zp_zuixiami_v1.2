define(function(require, exports, module) {
	var cookies = require('cookies');
	exports.theHomePageAni = function() {
		if (cookies.get("rainbow-ani") == "") {
			$(".wgt-rainbow").parent().addClass("rainbow-ani");
			cookies.set("rainbow-ani", "yet");
		}
	}
});