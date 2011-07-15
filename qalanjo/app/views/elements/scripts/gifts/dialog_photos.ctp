<script type="text/javascript">

//<![CDATA[
         
$(document).ready(function(){
		$('.cart-btn, .blue-btn').css('cursor','pointer');
	
		$('.addtocart').click(function(){
			var id = $(this).attr('id');

			$('#confirm-addtocart').dialog('open');
		});
		
		$('#dialog-description').hide();

		$('#items-container img').click(function(){
			var url = $(this).attr('src');
			$('#dialog-description div.item img').remove();
			$('#dialog-description div.item').append('<img src="' + url + '"/>');
			$('#dialog-description').dialog('open');

			return false;
		});
		
		$('#close').click(function(){
			$('#dialog-description').dialog('close');
		});
		
		$('#dialog-description').dialog({
			autoOpen	: false,
			draggable	: false,
			resizable	: false,
			modal		: true,
			height		: 500,
			width		: 660,
			open: function(event, ui) {
				$(".ui-dialog-titlebar").hide();
			}
		});

		$('#confirm-addtocart').dialog({
			title		: 'Confirm Add',
			autoOpen	: false,
			draggable	: false,
			resizable	: false,
			modal		: true,
			buttons : {
				"Ok" : function() {
					$('#transaction_item').submit(function(){
						alert('test');
						return false;
					});

					$(this).dialog('close');
				},
				"Cancel" : function() {
					$(this).dialog('close');
				}
			}

		});

		if (first_item!=-1){
			$("#index-wrap").load(qalanjo_url+"gifts/search_by_category/"+first_item);
		}
		
});


//]]>

</script>