var windowheight = $(window).height();
	var titlebarheight = $("#titlebar").height();
	var codecontainerheight = windowheight-titlebarheight-5;

	$(".codecontainer").height(codecontainerheight + "px");

	$(".toggle").click(function(){
		$(this).toggleClass("selected");

		var activDiv = $(this).html();
		
		$("#" + activDiv + "container").toggle();

		var showingDivs = $(".codecontainer").filter(function(){

			return($(this).css("display") != "none");
		}).length;

		if(showingDivs == 1)
		{
			$(".codecontainer").css("width", "100%");
		}
		if(showingDivs == 2)
		{
			$(".codecontainer").css("width", "50%");
		}
		if(showingDivs == 3)
		{
			$(".codecontainer").css("width", "33%");
		}
		if(showingDivs == 4)
		{
			$(".codecontainer").css("width", "25%");
		}


	});
$("#runbutton").click(function(){
	$("iframe").contents().find("html").html('<style>' + $("#csscode").val() + '</style>' + $("#htmlcode").val());
	
	document.getElementById('resultframe').contentWindow.eval($("#javascriptcode").val());

	}
);