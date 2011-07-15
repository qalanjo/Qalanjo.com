<script type="text/javascript">
	function autocomplete_member(){
		$("#gift_search").autocomplete({
			source:'<?php echo $this->Html->url(array("action"=>"autocomplete", "controller"=>"gifts"))?>',
			minlength:2,
			select:function(event, ui){
				$("#PrivateMessageMemberId").val(ui.item.value);			
				var items = ui.item.value.split(";");
				ui.item.value = items[0];
				$("#PrivateMessageMemberId").val(items[1]);			
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function(event, ui) {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
						
			}
		});
	}
</script>