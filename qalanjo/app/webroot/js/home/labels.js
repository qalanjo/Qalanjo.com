(function($) {

	function toggleLabel() {
		var input = $(this);
		setTimeout(function() {
			var def = input.attr('title');
			if(!input.val() || (input.val() == def)) {
				input.prev('span').css('visibility', '');
				if(def) {
					var dummy = $('<label></label>').text(def).css('visibility', 'hidden').appendTo('body');
					input.prev('span').css('margin-left', dummy.width() + 3 + 'px');
					dummy.remove();
				}
			} else {
				input.prev('span').css('visibility', 'hidden');
			}
		}, 0);
	};
	
	function resetField() {
		var def = $(this).attr('title');
		if (!$(this).val() || ($(this).val() == def)) {
			$(this).val(def);
			$(this).prev('span').css('visibility', '');
		}
	};
	
	$('input, textarea').live('keydown', function(){
		toggleLabel.call(this);
	});
	$('input, textarea').live('paste', toggleLabel);
	$('select').live('change', toggleLabel);
	
	$('input, textarea').live('focusin', function() {
		$(this).parent().css('background-position', '-203px 0px');
	    $(this).prev('span').css('color', '#5fb6d9');
	});
	
	$('input, textarea').live('focusout', function() {
		$(this).parent().css('background-position', '0px 0px');
		$(this).prev('span').css('color', '#4f96b3');
	});

	$(function() {
		$('input, textarea').each(function() { toggleLabel.call(this); });
	});
})(jQuery);
