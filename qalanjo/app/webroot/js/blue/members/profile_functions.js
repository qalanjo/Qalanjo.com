/**
 * Profile Javascript File
 */

function show_composer(){
	$("#composer").dialog(
		{modal:true, height:400, width:450, title:"Write your message", show:"fade", hide:"fade"}
	);
}
function close_window(){
	$("#composer").dialog('close');
	show_message();
}

function show_message(){
	$("#message_result").dialog({
		modal:true, height:280, width:339,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}			
		},
		show:"fade",
		hide:"fade",
		resizable:false
	});
}
function askAndWink(id){
	$( "#wink" ).dialog( "destroy" );
	$( "#wink" ).dialog({
		resizable: false,
		height:280,
		width:339,
		modal: true,
		title:"Send Wink",
		buttons: {
			Wink: function() {
				$("#message_result").load(qalanjo_url+'members/wink/'+id, function(){
					show_message();
					$('.ui-dialog-title').text('Wink sent!');
					$("#wink").dialog( "close" );
				});
				
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		},
		show:"fade",
		hide:"fade"
	});
}