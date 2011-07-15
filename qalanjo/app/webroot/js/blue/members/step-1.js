/**
 * Javascript for step 1
 */

/**
 * Validation
 */
var validator;

function defaultSelected(value){
	return value!="-1";
}
function defaultSelectedState(value){
	if($('#country :selected').text() == 'United States') {
		return value!="0";	
	}
	return true;
}

$(document).ready(function(){
	$('#country').live("change", function() {
		if($('#country :selected').text() == 'United States') {
			$("#state").attr("disabled", false);
		} else {
			$("#state").attr("disabled", true);
		}
	});	
	$("#country").val(236);
	$.validator.addMethod("defaultSelected", function(value){
		return defaultSelected(value);
	});
	
	$.validator.addMethod("defaultSelectedState", function(value){
		return defaultSelectedState(value);
	});
	
	validator = $("#step-1").validate({
		errorElement: "em",
		errorPlacement: function(error, element) {
			element.removeClass("error").parent("dd").children(".required").html("");
			error.removeClass("error").addClass("error_label").appendTo(element.parent("dd").children(".required"));
		},
		success: function(label) {
			label.text("");
			if (validator.numberOfInvalids()==0){
				$("#summary").hide();	
			}
		},
		submitHandler:function(form){
			$(form).ajaxSubmit(options);
		},
		rules: {
			"data[Member][country_id]": {
				required:true,
				defaultSelected:true
				
			},
			"data[Member][state]":{
				defaultSelectedState:true,
				required:true
			},
			"data[Member][zipcode]": {
				required:true,
				number:true,
				minlength:4,
				maxlength:10
			}
		},
		messages:{
			"data[Member][country_id]":{
				defaultSelected:"Select the country where you live"
			},
			"data[Member][state]":{
				defaultSelectedState:"Select the state where you live"
			}
		}
	});
});