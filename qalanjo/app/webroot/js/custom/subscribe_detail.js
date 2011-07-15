/**
 * Javascript for subscribe detail form
 */

function showBillingInfo(){
	$('#checkout').dialog({autoOpen:false, modal:true, height:300, width:650, title:"Verify Payment Information"});
	$.fx.speeds._default = 1000;
	$('#checkout').dialog('open');		
}

$(document).ready(function(){
	$("#subscription_form").validate({
		rules:{
			"data[SubscriptionTransaction][subscription_type_id]":{
				required:true
			},
			"data[SubscriptionTransaction][credit_type_id]":{
				required:true
			},
			"data[CreditCard][cardnumber]":{
				required:true
			}
			
			
		},
		messages:{
			
		}
		
		
	});
});


