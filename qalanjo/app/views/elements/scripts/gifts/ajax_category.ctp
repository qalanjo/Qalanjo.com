
<?php 

/*
 * 	
 * 
 */

?>


<script type="text/javascript">

	$(document).ready(function(){
		
		
		$('#side-cat .cat-list').click(function(){
			var category_id = $(this).attr('id');

			$.ajax({
				type	: 'post',
				url		:	'<?php echo $path?>/gifts/categories',
				data	: {
					id	: category_id
				},
				success	: function(response){
					
				}
			});
			
			return false;
		});
		
	});

</script>