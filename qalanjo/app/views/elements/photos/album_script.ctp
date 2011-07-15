<script type="text/javascript">

/*
 * script for lightbox settings and actions
 */

$(document).ready(function(){
	$('.hide').hide();
	//append element on the bottom part of the lightbox
	$('#lbBottom').append('<?php echo $this->element('photos/photos_options') ?>');
	
	//delete or set profile photo on lightbox
	$('#deletePhoto, #make_profile, #change_profile').click(function(){
		//get url of image
		var bgImage = $('#lbImage').css('background-image');
		
		//get the image filename
		bgImagePath = bgImage.split('/');
		var path = bgImagePath[bgImagePath.length -1];
		path = path.substring(0, path.length -1);
		path = path.replace('profile_', '');
		$('#photo_id').val($('a[href$='+ path +']').attr('id')); //set flag.. photo_id to be passed on the controller
		
		var myId = $(this).attr('id'); //id of the button clicked
		
		if(myId == 'deletePhoto') {
			$('#delete-photo-dialog').dialog('open');	
		} else if(myId == 'make_profile'){
			window.location.href = qalanjo_url + 'photos/crop_picture/' + $('#photo_id').val();
		} else if(myId == 'change_profile') {
			
			$.ajax({
				type			: 'post',
				url				: qalanjo_url + '/photos/changeProfilePicture/' + $('#photo_id').val(),
				success : function(data) {
					var response = $.parseJSON(data);
					if(response.msg == 'success') {
						alert('Profile Picture Changed !');
					} else if(response.msg == 'failed') {
						alert('Already set as profile picture');
					}
				}
			});
			
		}
		
		return false;	
	});

	//drag and drop sorting
	var isDragging = false;
	    $("#thumbnails")
	    .mousedown(function() {
	        $(window).mousemove(function() {
	            isDragging = true;
	            $(window).unbind("mousemove");
	        });
	    })
	    .mouseup(function() {
	        var wasDragging = isDragging;
	        isDragging = false;
	        $(window).unbind("mousemove");
	        if (!wasDragging) {
	        	$('#thumbnails a[rel^=lightbox]').slimbox({
	        		loop: true,
	        		captionAnimationDuration: 100,
	        		cursor: 'move'
	        	});
	        }
	    });

	    $('a[rel^=lightbox-]').slimbox({
    		loop: true,
    		captionAnimationDuration: 100,
    		cursor: 'move'
    	});

	//sorting of thumbs	
	$('#thumbnails').sortable({
		update: function() {
			$.ajax({
				type:	'POST',
				url:	qalanjo_url+'/photos/sort_order',
				data:	{
					thumb: $('#thumbnails').sortable('serialize')
				}
			});
		}
	});

	
	$('#delete-photo-dialog').dialog({
			title		: 'Delete Photo',
			autoOpen	: false,
			draggable	: false,
			resizable	: false,
			modal		: true,
			hide		: true,

			buttons : {
				'DELETE' : function() {
						$.ajax({
							type	: 'post',
							url		: qalanjo_url + '/photos/deletePhoto/' + $('#photo_id').val(),
							success: function(data){
								var response = $.parseJSON(data);

								if(response.msg == 'success') {
									$(this).dialog('close');
									window.location.reload();
								}
							}
						});
				}, //end delete button

				'Cancel' : function() {
					$(this).dialog('close');
				}
			}// buttons
			
	}); //end delete-photo-dialog

});

</script>