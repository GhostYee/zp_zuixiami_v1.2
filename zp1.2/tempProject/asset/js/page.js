define(function(require, exports, module) {

	
	//  base lib
	var $ = require('jquery');

	//  animation
	var ant = require('ant');
	ant.theHomePageAni();

	//  banner
	var scrollpic = require("scrollpic");
	scrollpic.initPageBanner();


	var zpSubmit=require("zpSubmit");
	zpSubmit.steps();



});