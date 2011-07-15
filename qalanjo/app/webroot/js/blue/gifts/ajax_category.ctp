
$(document).ready(function(){
	
	
	$('#side-cat .cat-list').click(function(){
		var category_id = $(this).attr('id');
		
		$.ajax({
			url		:	'<?php echo $path?>/gifts/categories',
			data	: {
				
			},
			success	: function(){
				
			}
		});
		
		return false;
	});
	
});