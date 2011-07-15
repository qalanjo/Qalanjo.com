/**
 * 
 */

$(document).ready(function(){
	$("#form").submit(function(){
		return false;
	});
	$("#floatbutton").click(function(e){
		window.location.href = qalanjo_url+"matches";
		e.preventDefault();
	});
});