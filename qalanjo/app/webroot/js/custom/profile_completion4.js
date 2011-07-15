/**
 * 
 */
$(document).ready(function(){
$("#educational_weight").slider({
		max:5,
		min:1,
		slide:function(event, ui){
			$("#output_educational_weight").html("<p>Value is "+ui.value+"</p>");
			$("#MemberProfileAttributeWeightEducationalLevelWeight").val(ui.value);
		}
	});
	$("#output_educational_weight").html("<p>Value is 1</p>");
	$(".row:even").addClass("highlight");
});
