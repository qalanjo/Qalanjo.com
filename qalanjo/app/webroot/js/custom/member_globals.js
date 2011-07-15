/**
 * Member global functions
 */
function resize(size){
	if (size=='full'){
		$("#updatable_div").addClass("fixed_top");
	}else{
		$("#updatable_div").removeClass("fixed_top");
	}
}



function load_matches(){
	$("#matches_loader").load(qalanjo_url+"matches/daily_matches");
}

/**
 * Initialization for member home page
 */

$(document).ready(function(){
	$(".navigation").click(function(){
		$("#content-tabs li.active").removeClass("active");
		$(this).parent().parent().parent().addClass("active");
		/*
		if ($(this).html()!="HOME"){
			$("li.active-nav").removeClass("active-nav");	
			$(this).parent().addClass("active-nav");	
		}else{
			$("li.active-nav").removeClass("active-nav");
			$("#profile_nav").addClass("active-nav");
		}
		*/
	});
	$(".navigation_left").click(function(){
		$("li.active").removeClass("active");
		$(this).parent().addClass("active");
	});
	drop_down();
	load_matches();
		
});