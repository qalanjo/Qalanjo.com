var currentId = 0;
$(document).ready(function(){
	interval = setInterval("updateStatus()", 1000, "javaScript");
	$(".join a").click(function(e){
		$("#viewport").animate({
			marginLeft:"-840px"
		}, 300, "linear");
		var id = $(this).attr("id").split("_");
		currentId = id[1];
		e.preventDefault();
	});
	$("#arrow-back").click(function(e){
		$("#viewport").animate({
			marginLeft:"0px"
		}, 300, "linear");
		e.preventDefault();
	});
	$(".paypal-pay").click(function(e){
		window.location.href=qalanjo_url+"qpoints/checkout_paypal/"+currentId;
		e.preventDefault();
	});
	$(".cc-pay").click(function(e){
		window.location.href=qalanjo_url+"qpoints/checkout/"+currentId;
		e.preventDefault();
	});
});