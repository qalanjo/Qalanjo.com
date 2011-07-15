/**
 * Checkput.js - Javascript for the subscription Checkout page
 */
function createValidation(){
	create_defaults();
	$("#checkout").validate({
		rules:{
			"data[CreditCard][card_number]":{
				creditcard:true,
				required:true,
				cardnumberDefault:true
			},
			"data[Member][city]":{
				required:true,
				cityDefault:true
			},
			"data[Member][state]":{
				required:true,
				stateDefault:true
			}
		},
		messages:{
			"data[CreditCard][card_number]":{
				creditcard:"Must be a valid credit card",
				required:"This field is required",
				cardnumberDefault:"This field is required"
			}
		}
	});
}

function init(){
	$("#paypal_select").hide();
	$.ajax({
		url:qalanjo_url+"subscription_transactions/already_subscribe",
		success:function(data){
			if (data=="true"){
				location.href =qalanjo_url+"subscription_transactions/error";
			}else if (data=="invalid"){
				location.href =qalanjo_url+"login";
			}
		}
	})
	createValidation();
	/**
	 * Make default
	 */
	$("input.default").each(function() { //onblur
		$(this)
		.data('default', $(this).val())
		.addClass('inactive')
		.focus(function() {
			$(this).removeClass('inactive');
			if ($(this).val() == $(this).data('default') || '') {
				$(this).val('');
			}
			
		})
		.blur(function() {
			var default_val = $(this).data('default');
			if ($(this).val() == '') {
			$(this).addClass('inactive');
			$(this).val($(this).data('default'));
			}
		});
	});
	
	/**
	 * Selects for payment method...
	 */
	$(".payment_select").click(function(){
		if ($(this).val()==-1){
			if (!$("#paypal_select").is(":visible")){
				$("#paypal_select").fadeIn();
				$("#credit_card_select").fadeOut();
			}
		}else{
			if (!$("#credit_card_select").is(":visible")){
				$("#credit_card_select").fadeIn();
				$("#paypal_select").fadeOut();	
			}
		}
	});
	
	
}


$(document).ready(function(){
	init();
});