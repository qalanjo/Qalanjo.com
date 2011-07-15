/**
 * 
 */

$(document).ready(function(){

	$("#height_weight").slider({
		max:7,
		min:1,
		slide:function(event, ui){
			$("#output_height_weight").html("<p>Value is "+ui.value+"</p>");
			$("#MemberProfileAttributeWeightHeightWeight").val(ui.value);
		}
	});
	
	$("#output_height_weight").html("<p>Value is 1</p>");
	$(".row:even").addClass("highlight");
	
	
});