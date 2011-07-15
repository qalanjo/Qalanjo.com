/**
 * Profile Javascript File
 */

function show_composer(){
	$("#composer").dialog(
		{modal:true, height:550, width:600, title:"Write a message", show:"fade", hide:"fade"}
	);
}
function close_window(){
	$("#composer").dialog('close');
	show_message();
}

function show_message(){
	$("#message_result").dialog({
		modal:true, height:200, width:250,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		},
		show:"fade",
		hide:"fade"
	});
}
function askAndWink(id){
	$( "#wink" ).dialog( "destroy" );
	$( "#wink" ).dialog({
		resizable: false,
		height:140,
		modal: true,
		buttons: {
			Wink: function() {
				$("#message_result").load(qalanjo_url+'members/wink/'+id, function(){
					show_message();
					$("#wink").dialog( "close" );
				
				});
				
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});
}