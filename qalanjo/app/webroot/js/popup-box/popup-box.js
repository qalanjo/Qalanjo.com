/****************************
 *		 functions
 *
 **************************/

function removeUploadDialog() {
	$('#select-file-overlay')
		.fadeOut('slow', function() {
			$(this).remove();
		});

	$('#select-file-dialog').fadeOut();
	$('#file_upload').parent().remove();
}

function positionUploadDialog() {
	$('<div id="select-file-overlay"></div>')
	.css('top', $(document).scrollTop())
	.css('opacity', 0)
	.animate({'opacity': '0.1'}, 'slow')
	.appendTo('body');

	$('<div class="overlay-spinner"></div>')
	.hide()
	.appendTo('#select-file-overlay')
	.fadeTo('slow', 0.6);	
	
	var top = ($(window).height() - $('#select-file-dialog').height()) / 2;
	var left = ($(window).width() - $('#select-file-dialog').width()) / 2;

	$('#select-file-dialog')
		.css({
			'top': top + $(document).scrollTop() - 50,
			'left': left
		})
		.fadeIn();
	$('#progress-content').hide();
	
}

function loadProgressDialog() {
	$('#albumNameFlag').val('');
	$('#albumDescFlag').val('');
	$('#progress-content').show();

	$.ajax({
		type		: 'post',
		url			: qalanjo_url + 'photos/checkAlbumName/',
		success : function(data) {
			var response = $.parseJSON(data);
			$('#albumName, #albumNameFlag').val(response.albumName);
		}
	});
}

function unloadProgressDialog() {
	$('#select-file-content').show();
	$('#progress-content').hide();
}
