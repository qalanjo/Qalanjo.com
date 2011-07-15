<script type="text/javascript">

//<![CDATA[
         
$(document).ready(function(){
		
		$('#dialog-description').hide();
		
		$('#items-container img').click(function(){
			alert('click');
			var url = $(this).attr('src');
			$('#dialog-description div.item img').remove();
			$('#dialog-description div.item').append('<img src="' + url + '"/>');
			$('#dialog-description').dialog('open');
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
		
		
});


//]]>

</script>