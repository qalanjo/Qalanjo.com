/**
 * Script for Viewing the profile
 * @version 0.0.1
 * @date 5/26/2011
 */

$(document).ready(function(){
	interval = setInterval("updateStatus()", 1000, "javaScript");
	$("#composer").hide();
	$("#wink").hide();
	$("#message_result").hide();
	$("#icebreaker").hide();
	
	$(".message_link").click(function(e){
		if (role==2){
			$("#composer").dialog(
				{modal:true,
				height:307,
				width:396,
				title:"Write your message",
				show:"fade",
				hide:"fade", 
				buttons:{
					Exit:function(){
						$("#composer").dialog("close");
					}
				}}
			);
		}else{
			$("#composer").dialog(
				{modal:true, height:475, width:460, title:"Write your message to:", show:"fade", resizable:false, hide:"fade"}
			);
		}
		
		e.preventDefault();
	});
	$("#icebreaker_link").click(function(){
		$("#icebreaker").html("<div class='spinner'></div>");
		$("#icebreaker").dialog({
			height:293,
			width:420,
			title:"Send Icebreaker to",
			buttons: {
				Send: function() {
					$.post(qalanjo_url+"sent_ice_breakers/send", $("#breaker_form").serialize(), function(data){
						
						$("#message_result").html(data);
						show_message();
						$('.ui-dialog-title').text('Ice breaker');
						$("#icebreaker").dialog( "close" );
					});
					$("#icebreaker").html("<div class='spinner'></div>");
				}
			},
			show:"fade",
			hide:"fade",
			resizable:false
		});
		$.ajax({
			url:qalanjo_url+"sent_ice_breakers/send/viewed_id:"+to_id,
			success:function(data){
				$("#icebreaker").html(data);
			}
			
		});
		e.preventDefault();
	});
	
	$(".winker").click(function(e){
		askAndWink(to_id);
		e.preventDefault();
	});
	/*
	$.ajax({
		url:qalanjo_url+"sent_ice_breakers/test_fail",
		success:function(data){
			$("#message_result").html(data).addClass("result-icebreaker");
			show_message();
			$('.ui-dialog-title').text('Ice breaker');
		}
	});
	*/
});