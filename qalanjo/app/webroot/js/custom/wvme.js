function message_viewer(member_id){
	$("#to_id").val(member_id);
	$.ajax({
		url: qalanjo_url+"members/find_for_message/"+member_id,
		success:function(data){
			$("#to").html(data);
			show_composer();
		}
	});
}
function init(){
	$("#composer").hide();
	$("#message_result").hide();
	$("#wink").hide();
}
function askAndWinkMe(id){
	$.ajax({
		url: qalanjo_url+"members/find_for_wink/"+id,
		success:function(data){
			$("#view_name").html(data);
			askAndWink(id);
		}
	});
}
$(document).ready(function(){
	init();
});