/**
 * Profile Completion script
 */

$(document).ready(function(){
	$(".picture-container img").live("click", function(){
		$(this).parent().parent().siblings().children().removeClass("active");
		var id = $(this).parent().addClass("active").attr("id").split("_");
		$("#answer_"+id[1]).val(id[2]);
	});
	$("#MemberProfileCompletionForm").validate();
});