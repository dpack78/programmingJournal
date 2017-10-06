$(function(){
	overlayShowing = false;
	$("#menuIcon").click(function(){
		if(!overlayShowing){
			overlayShowing = true;
			$("header").append("<div id='overlay' class='overlay'></div>");
			$("#overlay").fadeIn("fast",function(){
				$("#headerNavMenu").show();
			});
		}else{
			hideOverlay();
		}
	});
	
	$(document).on("click","#overlay",function(){
		hideOverlay();
	});
})

function hideOverlay(){
	$("#headerNavMenu").hide();
	$("#overlay").fadeOut();
	overlayShowing = false;
}
