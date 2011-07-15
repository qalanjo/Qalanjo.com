/**
 * @author Allanaire
 */
var isAnimate = false;
var state = "close";
$(document).ready(function(){
	$("#MemberGenderId").change(function(){
		selected = $(this).val();
		swap(selected, $("#MemberLookingForId"));
	});
	$("#MemberLookingForId").change(function(){
		selected = $(this).val();
		swap(selected, $("#MemberGenderId"));
	});
	$("#result").hide();
	validateForm();
	var options = {
		target:"#result",
		success:loginSuccess,
		url:qalanjo_url+"members/ajax_login"
	};
	$("#loginForm").ajaxForm(options);

	

	$(".login").css("top", "-169px");
	$("#login").hide();
	$("#login-button, .login-button").click(function(e){
		if (!isAnimate){
			isAnimate = true;
			if (state=="close"){
				$(".login").animate({
					top:"0px"
				}, 1000, function(){
					$("#login").fadeIn(100);
					isAnimate = false;
					state="open";
				});
			}else{
				$(".login").animate({
					top:"-169px"
				}, 1000, function(){
					$("#login").fadeOut(100);
					isAnimate = false;
					state="close";
				});
			}
		}
	});
});
function swap(selected, target){
	if (selected==1){
		target.val(2);
	}else if (selected==2){
		target.val(1);
	}
}

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


function validateForm(){
	
	
	$(".required").hide();
	$.validator.addMethod("defaultSelected", function(value){
		return defaultSelected(value);
	});
	
	$.validator.addMethod("defaultSelectedState", function(value){
		return defaultSelectedState(value);
	});
	
	validator = $("#signup-form").validate({
		errorElement: "em",
		errorPlacement: function(error, element) {
			element.parent().children(".required").show().html("");
			element.removeClass("error");
			error.removeClass("error").appendTo(element.parent().children(".required"));
			
		},
		success: function(label) {
			label.text("");
			if (validator.numberOfInvalids()==0){
				$("#summary").hide();	
			}

		},
		rules: {
			"data[Member][firstname]": {
				required:true,
				minlength:3,
				maxlength:30
			},
			"data[Member][lastname]": {
				required:true,
				minlength:3,
				maxlength:30
			},
			"data[Member][email]":{
				email:true,
				required:true
			},
			"data[Member][confirm_email]":{
				email:true,
				required:true,
				equalTo:"#email"
			},
			"data[Member][password]":{
				required:true,
				minlength:5
			},
			"data[Member][idea_id]":{
				required:true,
				defaultSelected:true
			}
		
		},
		messages:{
			"data[Member][idea_id]":{
				defaultSelected:"Select where you here the idea about us"
			}
			
		}
	});
}

function loginSuccess(responseText, statusText, xhr, $form)  {
	if ($.trim(responseText)=="true"){
		window.location.href = qalanjo_url+"welcome";
	}else{
		
	}
}

function showRequest(formData, jqForm, options) { 
	 var queryString = $.param(formData);
	 return true;
}
function signupSuccess(responseText, statusText, xhr, $form)  {
	alert($.trim(responseText));
	if ($.trim(responseText)=="true"){
		window.location.href = qalanjo_url+"members/step";
	}else{
		$("#result").html(responseText).show();
	}
}


