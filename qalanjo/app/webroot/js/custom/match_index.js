/**
 * Transform div into tab
 */
$("#match_tab").tabs({
	ajaxOptions: {
		error: function( xhr, status, index, anchor ) {
			$( anchor.hash ).html(
				"Couldn't load this tab. We'll try to fix this as soon as possible. " +
				"" );
		}
	}
});



function updateSK(value){
	$("#MatchSk").val(value);
}
