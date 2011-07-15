function close_window(){
	$('#writeMessageDialog').dialog('close');
}

/**
* Creates a new dialog for messaging
*/

function createDialog(){
	var writeMessageDialog =  $('#writeMessageDialog').dialog({autoOpen:false, modal:true, height:475, width:600});
	$.fx.speeds._default = 1000;
	$('#writeMessageDialog').dialog('open');
	$("#member_search").val("");
	$("#PrivateMessageTitle").val("");
	$("#PrivateMessageContent").val("");
	//transform_editor();
	 //transform editor to TinyMCE control
		
}


function validation_writer(){
	$("#PrivateMessageWritemessageForm").validate({
		rules:{
			"data[PrivateMessage][title]":{
				required:true,
				minlength:5,
			},
			"data[PrivateMessage][content]":{
				required:true,
				minlength:4,
			},
			"data[PrivateMessage][member]":{
				required:true,
			}
		}
	});
}