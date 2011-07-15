var ft = false;
var inch = false;
$(document).ready(function(){
	
	$("#birthdate_weight").slider({
		max:5,
		min:1,
		slide:function(event, ui){
			$("#output_birthdate_weight").html("<p>Value is "+ui.value+"</p>");
			$("#MemberProfileAttributeWeightBirthdateWeight").val(ui.value);
		}
	});
	$("#output_birthdate_weight").html("<p>Value is 1</p>");
	$("#output_educational_weight").html("<p>Value is 1</p>");
	$("#birthdate_weight").value = 3;
	$(".row:even").addClass("highlight");
	validateForm();
});



function validateForm(){
	$.validator.addMethod("validft", function(value) {
		return value <= 7;
	}, 'Value must be below 8');
	
	
	
	$("#MemberProfileCompletionForm").validate({
		rules:{
			"data[MemberProfile][marital_status_id]":{
				required:true
			}, 
			"data[MemberProfileAnswer][0][item_id]":{
				required:true
			},
			"data[MemberProfile][height_ft]":{
				required:true,
				validft:true
			},
			"data[MemberProfile][height_inch]":{
				required:true
			},
			"data[MemberProfile][leisure_activity]":{
				required:true
			},
			"data[MemberProfile][match_want]":{
				required:true
			}
		},
		errorPlacement: function(error, element) {
			if(element.attr("name")=="data[MemberProfile][height_ft]"){
				if (!inch){
					error.appendTo( element.parent("div") );
					
				}else{
					inch = false;
				}
				
			}else{
				if (element.attr("name")=="data[MemberProfile][height_inch]"){
					if (!ft){
						error.appendTo( element.parent("div") );
						ft = false;
					}
				}else{
					error.appendTo( element.parent("div") );	
				}
			}
		}
		
	});
}