/**
 * Session Checker
 */
var interval;
var finished = true;
function updateStatus(){
	if (finished){
		finished = false;
		$.ajax({
			url:qalanjo_url+"members/check_session/"+userid,
			success:function(data){
				if (($.trim(data)=="true")||($.trim(data)=="truetrue")){				
					$.ajax({
						url:qalanjo_url+"members/update_online",
						success:function(data){
							finished = true;
						}
					});
				}else if (data=="false"){
					clearInterval(interval);
					alert("Please login to continue");
					window.location.href = qalanjo_url+"members/login";
				}
			}
		});		
	}
}