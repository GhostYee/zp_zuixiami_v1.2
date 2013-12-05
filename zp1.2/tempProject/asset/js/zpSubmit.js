define(function(require, exports, module) {
	exports.steps = function() {
		$(".btn-submit-to-2").click(function(){
			switchStep(2);			
		});
		$(".btn-submit-to-1").click(function(){
			switchStep(1);
		});
		$(".btn-submit-to-3.btn-submit-save").click(function(){
			switchStep(3);
			var userQQ=$("#inputUserQQ").val();
			var zpName=$("#inputZpName").val();
			var demoUrl=$("#inputDemoUrl").val();			
			var openUrl=$("#inputOpenUrl").val(); 
			var description=$("#inputDescription").val(); 
			var imgUrl=$("#imgUrl").val(); 
			var zpID=$("#zpID").val();
			var author=$("#inputAuthor").val();
			$.post("ajax/zpSubmit.php",{ 
				"userQQ":encodeURI(userQQ),
				"zpName": encodeURI(zpName),
				"demoUrl": encodeURI(demoUrl),
				"openUrl":encodeURI(openUrl),
				"description":encodeURI(description),
				"imgUrl":encodeURI(imgUrl),
				"zpID":encodeURI(zpID),
				"author":encodeURI(author)
				 },function(result){
   				$("#zpID").val(result);
   				$(".tip-ok .progress").hide("fast");
   				$(".tip-ok .tip-ok-message").show("fast");   				
   				$(".tip-ok .tip-ok-message>a").attr("href","http://zp.zuixiami.com/works/"+result);
  			});
		});
	}

	function switchStep(step){
		$(".wgt-zp-edit>.inner").animate({ 
		    left: -(step-1)*740		    
		  }, 800 );
	}
});