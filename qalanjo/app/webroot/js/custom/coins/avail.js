/**
 * Coin Avail Transaction scripts
 */

$(document).ready(function(){
	$("#quantity").keyup(function(){
		
		var total = 0.2 * parseFloat($(this).val());
		total = total.toFixed(2);
		if (isNaN(total)){
			$("#total").html("$ 0");
				
		}else{
			$("#total").html("$ "+total);
			
		}
		
	});
	
	
	
});