/**
 * 
 */
$(document).ready(function(){
	$("#personal_income_weight").slider({
		max:5,
		min:1,
		slide:function(event, ui){
			$("#output_personalincome_weight").html("<p>Value is "+ui.value+"</p>");
			$("#MemberProfileAttributeWeightPersonalIncomeWeight").val(ui.value);
		}
	});
	$("#output_personalincome_weight").html("<p>Value is 1</p>");
	$(".row:even").addClass("highlight");
});