<script type="text/javascript">
	function autocomplete_member(){
		$("#member_search").autocomplete({
			source:'<?php echo $this->Html->url(array("action"=>"autocomplete_member", "controller"=>"members"))?>',
			minlength:2,
			select:function(event, ui){
				var items = ui.item.value.split(";");
				ui.item.value = items[0];
				$("#PrivateMessageToId").val(items[1]);			
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function(event, ui) {
				$( this ).removeClass( "ui-corner-top" );
						
			}
		}).data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( "<a>"+ item.label + "</a>" )
                .appendTo( ul );
        };;
	}
</script>