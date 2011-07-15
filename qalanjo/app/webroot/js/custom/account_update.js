/**
 * Account update related scripts
 */

$("#name_edit").hide();
$("#username_edit").hide();
$("#password_edit").hide();
$("#billing_edit").hide();


$(".toggle_control").click(function(){
	var hidden_box =$(this).parent().parent().siblings(".hidden_box");
	if (hidden_box.is(":visible")){
		hidden_box.hide();
	}else{
		hidden_box.show();
	}
});