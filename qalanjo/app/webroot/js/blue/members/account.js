/**
 * @author Allanaire
 */

var current;
$(document).ready(function(){
	interval = setInterval("updateStatus()", 1000, "javaScript");
	current = "general_information.html";
	$("#summary").removeClass("error").html("");
	$.ajax({
		url:qalanjo_url+"members/account/general",
		success:function(data){
			$("#account-settings-content").html(data).hide().fadeIn();		
		}
	});
	
	var height = $("#account-settings-content").css("height").split("p");
	var width = $("#account-settings-content").css("width").split("p");
	$(".spinner").css("left", width[0]/2).css("top", height[0]/2);
	$(".left-navigation ul li a").click(function(e){
		var href = $(this).attr("href");
		$(".left-navigation li.active").removeClass("active");
		$(this).parent().addClass("active");
		
		if (current!=href){
			var height = $("#account-settings-content").css("height").split("p");
			var width = $("#account-settings-content").css("width").split("p");
			$("<div class='spinner'></div>").css("left", width[0]/2).css("top", height[0]/2).appendTo("#account-settings-content");
			$.ajax({
				url:href,
				success:function(data){
					$("#account-settings-content").html(data).hide().fadeIn();		
				}
			});
		}
		current = href;
		e.preventDefault();
		e.stopPropagation();
	});

});

function showRequest(formData, jqForm, options){
	var queryString = $.param(formData); 
	return false; 
}