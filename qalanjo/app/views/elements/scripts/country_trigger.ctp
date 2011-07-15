<script type="text/javascript">
//<![CDATA[
	var country_code = "AF";
	$("#country").change(function(){
		var val = $(this).val();
		$.ajax({
			url:'<?php echo $this->Html->url("/countries/getcode/");?>'+val,
			success:function(data){
				country_code = data;
			}
		})
	});

	/**
	 * activate autocomplete
	 */
	$(".location").autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "http://ws.geonames.org/searchJSON",
				dataType: "jsonp",
				data: {
					featureClass: "P",
					style: "full",
					maxRows: 12,
					name_startsWith: request.term,
					country:country_code
				},
				success: function( data ) {
					response( $.map( data.geonames, function( item ) {
						return {
							label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
							value: item.name
						}
					}));
				}
			});
		},
		minLength: 2,
		select: function( event, ui ) {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		close: function() {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		}
	});
	
	$(".location").blur(function(){
		$( this ).removeClass( "ui-corner-all" ).removeClass("ui-corner-top");
	});


	

//]]>
</script>