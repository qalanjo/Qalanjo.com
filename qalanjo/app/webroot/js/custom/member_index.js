function define_inline(){
	$('.editable, .editable-area').hover(function(){
		$(this).toggleClass('over-inline');
	}).click(function(e){
		var editable = $(this);
		if (editable.hasClass('active-inline')) {
			return;
		}
		var contents = $.trim(editable.html());
		editable.addClass('active-inline').empty();
		var editElement = editable.hasClass("editable")?"<input type='text' class='inline_text'/>":"<textarea class='inline_text'></textarea>";
		$(editElement).val(contents).appendTo(editable).focus().blur(function(e){
			editable.trigger("blur");
		});
		
	}).blur(function(e){
		var editable = $(this);
		var textbox = editable.find(':first-child:input');
		var contents = textbox.val();
		editable.contents().removeClass('active-inline').replaceWith(contents);
		
	});
}

/**
 * Execution code
 */
define_inline();