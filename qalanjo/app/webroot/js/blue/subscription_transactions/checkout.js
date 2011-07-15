/**
 * Checkout.js - Javascript for checkout form
 */
var validator;
$(document).ready(function(){
	interval = setInterval("updateStatus()", 1000, "javaScript");
	$("#summary").removeClass("error");
	$(".required").hide();
	validator = $("#checkout").bind("invalid-form.validate", function() {
		$("#summary").addClass("error").html("We have found " + validator.numberOfInvalids() + " errors, see details below.").fadeIn(100);
	}).validate({
		errorElement: "em",
		errorContainer: $("#summary"),
		errorPlacement: function(error, element) {
			$(".required").show();
			element.parent().prev(".label").children(".required").html("");
			element.removeClass("error");
			error.removeClass("error").appendTo(element.parent().prev(".label").children(".required"));
		},
		success: function(label) {
			label.text("");
			if (validator.numberOfInvalids()==0){
				$("#summary").removeClass("error").html("&nbsp;");	
			}
		},
		rules: {
			"data[CreditCard][firstname]": {
				required:true,
				minlength:3,
				maxlength:30
			},
			"data[CreditCard][lastname]": {
				required:true,
				minlength:3,
				maxlength:30
			},
			"data[CreditCard][card_number]": {
				required:true,
				minlength:3,
				maxlength:30,
				creditcard:true
			},
			"data[CreditCard][cv_code]": {
				required:true,
				minlength:3,
				maxlength:3
			},
			"data[CreditCard][address1]": {
				required:true,
				minlength:3
			},
			"data[Country][country_id]": {
				required:true
			},
			
			"data[CreditCard][city]": {
				required:true,
				minlength:3
			},
			"data[CreditCard][state]": {
				required:true,
				minlength:3
			},
			"data[CreditCard][zipcode]": {
				required:true,
				minlength:3,
				number:true
			},
			
			"data[CreditCard][expiration_year]": {
				required:true
			},
			"data[CreditCard][expiration_month]": {
				required:true
			}
			
			
		}
	});
	$("span.card img").click(function(){
		$("span.card.active").removeClass("active");
		var value = $(this).attr("alt");
		$(this).parent().addClass("active");
		var numeric = 1;
		if (value=="American Express"){
			numeric = 3;
		}else if (value=="Visa"){
			numeric = 1;	
		}else if (value=="Master Card"){
			numeric = 2;			
		}
		$("#creditcardValue").val(numeric);
	});
	
	$("#back").click(function(e){
		window.location.href = qalanjo_url+"subscribe";
		e.preventDefault();
	})
	
});