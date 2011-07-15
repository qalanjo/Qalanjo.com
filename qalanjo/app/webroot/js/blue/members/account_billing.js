var options = {
	target:"#account-settings-content",
	beforeSubmit:showRequest
};

var validator = $("#member_billing").validate({
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
		"data[Member][city]": {
			minlength:3,
			maxlength:30
		},
		"data[Member][state]": {
			minlength:3,
			maxlength:30
		}
	}
});
function showRequest(formData, jqForm, options) { 
	 var queryString = $.param(formData); 
	 return true;
}
