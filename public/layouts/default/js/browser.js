
$(document).ready(function(){
	if ($.browser.msie && $.browser.version < 9) { 
		    $("#getBrowser").show();  
		 }
	$("#getBrowser .close").click(function(){
		$("#getBrowser").slideUp();
	});
});