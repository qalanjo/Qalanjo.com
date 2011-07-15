/**
 * 
 */
var options = {
	target:"#account-settings-content",
	beforeSubmit:showRequest
};

function customValidateRequireEmail(value){
	var confirmEmail = $("#confirm-email").val();
	var email = $("#email").val();
	if (($.trim(confirmEmail)=="")&&($.trim(email)=="")){
		return true;
	}else{
		return $.trim(value)!="";
	}
}
function customValidateRequirePassword(value){
	var confirmPassword = $("#confirm-password").val();
	var newPassword = $("#new-password").val();
	var oldPassword = $("#old-password").val();
	if (($.trim(confirmPassword)=="")&&($.trim(newPassword)=="")&&($.trim(oldPassword)=="")){
		return true;
	}else{
		return $.trim(value)!="";
	}
}

$.validator.addMethod("customValidateRequireEmail", function(value){
	return customValidateRequireEmail(value);
});
$.validator.addMethod("customValidateRequirePassword", function(value){
	return customValidateRequirePassword(value);
});

var validator = $("#member_account").validate({
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
		"data[Member][firstname]": {
			minlength:3,
			maxlength:30
		},
		"data[Member][lastname]": {
			minlength:3,
			maxlength:30
		},
		"data[Member][email]":{
			email:true,
			customValidateRequireEmail:true
		},
		"data[Member][confirm_email]":{
			email:true,
			equalTo:"#email",
			customValidateRequireEmail:true
		},
		"data[Member][password]":{
			minlength:5,
			customValidateRequirePassword:true
		},
		"data[Member][confirm_password]":{
			minlength:5,
			customValidateRequirePassword:true,
			equalTo:"#new-password"
			
		},
		"data[Member][oldpassword]":{
			minlength:5,
			customValidateRequirePassword:true
		},
		
	
	},
	messages:{
		"data[Member][email]":{
			customValidateRequireEmail:"This field is required"
		},
		"data[Member][confirm_email]":{
			customValidateRequireEmail:"This field is required"
		},
		"data[Member][password]":{
			customValidateRequirePassword:"This field is required"
		},
		"data[Member][confirm_password]":{
			customValidateRequirePassword:"This field is required"
		},
		"data[Member][oldpassword]":{
			customValidateRequirePassword:"This field is required"
		}
	}
});
function showRequest(formData, jqForm, options) { 
	 var queryString = $.param(formData); 
	 return true;
}
