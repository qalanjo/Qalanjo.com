$(document).ready(function() {
	$('.main-menu li a').click(function() {
		var selectedButton = $(this);
		
		if (!selectedButton.parent().hasClass('selected')) {
			var previousSelectedButton = $('.main-menu li.selected a');
			
			selectedButton.parent().addClass('selected');
			previousSelectedButton.parent().removeClass('selected');
			
			var url;
			if (selectedButton.hasClass('about')) {
				$('.sub-menu .about').show();
				
				var selectedSubMenuItem = $('.sub-menu li.selected a');
				url = selectedSubMenuItem.attr('href');
				
			} else {
				$('.sub-menu .about').hide();
			}
			
			if (selectedButton.hasClass('contact')) {
				url = selectedButton.attr('href');
			} else {
			}
			
			$.ajax({
				url: url,
				beforeSend: function() {
					$('.updatable-container').empty();
					$('<div></div>')
						.attr('class', 'spinner')
						.hide()
						.appendTo('.updatable-container')
						.fadeTo('slow', 0.6);
				},
				success: function(data) {
					$('.updatable-container').html(data);
				},
				complete: function() {
					$('.spinner').fadeOut('slow', function() {
						$(this).remove();
					});
				}
			});
		}
		
		return false;
	});
	
	$('.sub-menu li a').click(function() {
		var selectedButton = $(this);
		
		if (!selectedButton.parent().hasClass('selected')) {
			var previousSelectedButton = $('.sub-menu li.selected a');
			
			selectedButton.parent().addClass('selected');
			previousSelectedButton.parent().removeClass('selected');
			
			var url = selectedButton.attr('href');
			$.ajax({
				url: url,
				beforeSend: function() {
					$('.updatable-container').empty();
					$('<div></div>')
						.attr('class', 'spinner')
						.hide()
						.appendTo('.updatable-container')
						.fadeTo('slow', 0.6);
				},
				success: function(data) {
					$('.updatable-container').html(data);
				},
				complete: function() {
					$('.spinner').fadeOut('slow', function() {
						$(this).remove();
					});
				}
			});
		}
		
		return false;
	});
});