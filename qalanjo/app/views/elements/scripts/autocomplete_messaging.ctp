function autocomplete_searchmail(){
	$("#search_mail").autocomplete({
		source:'<?php echo $this->Html->url(array("action"=>"autocomplete_member", "controller"=>"private_messages"))?>',
		minlength:2,
		select:function(event, ui){
			var items = ui.item.value.split(";");
			ui.item.value = items[0];			
		},
		open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		close: function(event, ui) {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
					
		},
		blur:function(){
			$( this ).removeClass( "ui-corner-top" ).removeClass( "ui-corner-all" );
		
		}
	});
}
