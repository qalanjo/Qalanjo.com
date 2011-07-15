/**
 * Script for Forgot Password
 */
var validator;
var state = 0;


$(document).ready(function(){
	var options = {
		target:"output"
	};
	$("h3.required").hide();
	$("#alterns dl.choice").css("margin-left", "-200px").css("margin-top", "-73px");
	$(".radio-select-recover").click(function(e){
		var value = $(this).val();
		if (value==1){
			$("#alterns dl.choice").animate(
				{marginLeft:"0px", marginTop:"0px"},
				500
			);
			$("#emails dl.choice").animate(
				{marginLeft:"-200px", marginTop:"-73px"},
				500
			);
			state = 1;
		}else{
			$("#alterns dl.choice").animate(
				{marginLeft:"-200px", marginTop:"-73px"},
				500
			);
			$("#emails dl.choice").animate(
					{marginLeft:"0px", marginTop:"0px"},
					500
			);
			state = 0;	
		}
		$("#state").val(state);
	});
	$("#forgot").submit(function(){
		if (state==0){
			var email = $("#email-text").fieldValue();
			if (!email[0]){
				$("#error").html("Field is required");
				$("h3.required").fadeIn();
				$(".spacer").hide();
				return false;
			}
		}else{
			var alternEmail = $("#altern-email-text").fieldValue();
			if (!alternEmail[0]){
				$("#error").html("Field is required");
				$("h3.required").fadeIn();
				$(".spacer").hide();
				return false;
			}
		}
		$("h3.required").fadeOut(100, function(){
			$(".spacer").show();
		});
		$.post(qalanjo_url+"members/forgot_password",$("#forgot").serialize(), function(data){
			if ($.trim(data)=="true"){
				location.href = qalanjo_url+"members/forgot_password_success";
			}else{
				var result = $.parseJSON(data);
				$("#error").html(result.error);
				$("h3.required").fadeIn();
				$(".spacer").hide();
				return false;
			}
		});
		return false;
	});
	
});
