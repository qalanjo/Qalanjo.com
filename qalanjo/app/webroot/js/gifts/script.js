$(document).ready(function() {
	var $firstInTheListGiftType = $('.container-nav li:first a.category-link');
	$firstInTheListGiftType.parent().addClass('selected');
	
	$.ajax({
		url: $firstInTheListGiftType.attr('href'),
		beforeSend: function() {
			$('#gifts').empty();
			$('<div></div>')
				.attr('class', 'spinner')
				.hide()
				.appendTo('#gifts')
				.fadeTo('slow', 0.6);
		},
		success: function(data) {
			$('#gifts').html(data);
		},
		complete: function() {
			$('.spinner').fadeOut('slow', function() {
				$(this).remove();
			});
		}
	});
	
	$('.gifts-container .container-content').css({
		'min-height': $('.container-nav').outerHeight() - 1
	});
	$('.category-link').click(function(e) {
		$('.container-nav li.selected').removeClass('selected');
		$(this).parent().addClass('selected');
		
		$.ajax({
			url: $(this).attr('href'),
			beforeSend: function() {
				$('#gifts').empty();
				$('<div></div>')
					.attr('class', 'spinner')
					.hide()
					.appendTo('#gifts')
					.fadeTo('slow', 0.6);
			},
			success: function(data) {
				$('#gifts').html(data);
			},
			complete: function() {
				$('.spinner').fadeOut('slow', function() {
					$(this).remove();
				});
			}
		});
		e.preventDefault();
	});
	$('a.lightbox').live('click', function(e) {
		$.ajax({
			url: $(this).attr('href'),
			beforeSend: function() {
				$('body').css('overflow-y', 'hidden');
				
				$('<div id="overlay"></div>')
					.css('top', $(document).scrollTop())
					.css('opacity', '0')
					.animate({'opacity': '0.5'}, 'slow')
					.appendTo('body');
				
				$('<div></div>')
					.attr('class', 'overlay-spinner')
					.hide()
					.appendTo('#overlay')
					.fadeTo('slow', 0.6);
				
				$('<div id="lightbox"></div>')
					.hide()
					.appendTo('body');
			},
			success: function(data) {
				$('#lightbox').html(data);
				positionLightboxImage(); 
			},
			complete: function() {
				$('.overlay-spinner').fadeOut('slow', function() {
					$(this).remove();
				});
			}
		});
				
		e.preventDefault();
	});
});

function positionLightboxImage() {
	var top = ($(window).height() - $('#lightbox').height()) / 2;
	var left = ($(window).width() - $('#lightbox').width()) / 2;
	$('#lightbox')
		.css({
			'top': top + $(document).scrollTop(),
			'left': left
		})
		.fadeIn('slow', function() {
			$('#lightbox .close').live('click', function() {
				removeLightbox();
				return false;
			});
			$('#lightbox .controls .buy-qpoints').live('click', function() {
			});
			
			$('#lightbox .controls .enabled.buy').live('click', function() {
				return false;
			});
			$('#lightbox .controls .enabled.buy').live('click', sendGift);
			
			$('#lightbox .controls .disabled.buy').live('click', function() {
				return false;
			});
			$('#lightbox .controls .cancel').live('click', function() {
				removeLightbox();
				return false;
			});
		});
}

function removeLightbox() {
	$('#overlay, #lightbox')
		.fadeOut('slow', function() {
			$(this).remove();
			$('body').css('overflow-y', 'auto');
		});
}

function sendGift() {
	$('#lightbox .controls .enabled.buy').die('click', sendGift);
	$.post($(this).attr('href'), {message: $('#message').attr('value')}, function(data){
		$('#lightbox .close').remove();
		$('#lightbox .ribbon').remove();
		$('#lightbox .middle').html(data);
		var top = ($(window).height() - $('#lightbox').height()) / 2;
		var left = ($(window).width() - $('#lightbox').width()) / 2;
		$('#lightbox')
			.css({
				'top': top + $(document).scrollTop(),
				'left': left
			});
	});
}