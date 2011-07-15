<script type="text/javascript">

$(document).ready(function(){
	$('#select-file-dialog').hide();
	//hand pointers on element with class 'cursor'..
	$('.cursor').css('cursor', 'pointer');

	$(window).bind('beforeunload', function(e) {
		if($('#uploading').val() == 'true') {
			return 'leaving this page will not save your photos';
		}
	});

	$('#upload-photos, #add-photos').live('click', function(){
		var activeButton = $(this).attr('id');
		//check if member is subscribe
		$.ajax({
			type	:	'post',
			url		:	qalanjo_url + 'subscription_transactions/already_subscribe',
			success	:	function(response) {
				if(response == 'invalid') { // not signed in
					location.href = qalanjo_url + 'login';
				}
				else if (response == 'false'){ // unsubscribed
					location.href = qalanjo_url + 'subscribe';
				} else if (response == 'true'){ // subscribed
					if(activeButton == 'upload-photos') {
						$('#select-file-dialog').dialog('open');
					} else {
						$('#add-photos-dialog').dialog('open');
					}
					
					$.ajax({ // delete the temp folder
						type			: 'post',
						url				: qalanjo_url + 'photos/deleteTempFolder'
					});
					
					var totalSize = 0;
					var bytesUpload = 0;
					
					$("#file_upload").uploadify({						
						'uploader'		: '<?php echo $this->Html->url("/js/uploader/uploadify.swf")?>',
						'folder'		: qalanjo_url + 'app/webroot/img/uploads/<?php echo $member_id;?>/', 
						'script'		: '<?php echo $this->Html->url("/js/uploader/photos_uploadify.php")?>',
						'checkScript'	: '<?php echo $this->Html->url("/js/uploader/check.php")?>',
						'cancelImg'		: '<?php echo $this->Html->url("/js/uploader/cancel.png")?>',
					 	'fileExt'		: '*.jpg;*.gif;*.png',
					 	'fileDesc'		: 'Image Files',
					 	'buttonText'	: 'Select Photos',
					 	'queueID'		: 'uploadQueue',
						'multi'			: true,
						'auto'			: true,
						'removeCompleted' : false,
						'wmode'      	 : 'transparent',
						'sizeLimit'		: 4194304 , //4MB

						onComplete : function(event, ID, fileObj, response, data) {
							var img = $.parseJSON(response);
							$('#file_upload' + 	ID ).append('<input type="hidden" name=data[' + ID + '][Photo][picture_path] value="' + img.full + '"/>');
							bytesUpload += fileObj.size;
						},

						onProgress : function(event,ID,fileObj,data) {
							var progress = (( data.bytesLoaded + bytesUpload ) / totalSize ) * 100;
							 $('#progressbar .ui-progressbar-value').animate({width: progress+'%'});
						},
						
						onAllComplete : function(event, ID, fileObj, response, data) {
							$('#progressbar').progressbar('destroy');
							$('#file_upload').parent().remove(); //remove select file button
							//append the create album button
							$('#create-album, #save-photos').remove();
							if(activeButton == 'upload-photos') {
								$('<button id="create-album" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Create Album</span></button>')
									.prependTo('.ui-dialog-buttonset');
							} else if(activeButton == 'add-photos') {
								$('<button id="save-photos" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Save</span></button>')
									.prependTo('.ui-dialog-buttonset');
							}
						},

						onSelectOnce: function(event, data) {
							$('#uploadQueue').hide();
							$('#file_upload').uploadifyUpload();
							$('#uploading').val('true');
							$('#select-file-content').hide();
							$('#progressbar').progressbar({value : 0});
							
							if(activeButton == 'upload-photos') {
								loadProgressDialog();
							}
						},

						onSelect : function(event, data, fileObj) {
							totalSize += fileObj.size;
						},

						onError : function (event,ID,fileObj,errorObj) {
							alert(errorObj);
						},

						onCheck : function(event, data, key) {
							
						},

						onCancel : function (event, ID, fileObj, data) {
					        
					    }
					});
				}
			}
		});
		
		return false;
	});

	$('#create-album').live('click', function() {
		$('#uploading').val('false');
		$('#albumName').val($('#albumNameFlag').val());
		$('#albumDesc').val($('#albumDescFlag').val());
		$('#uploadPhotoForm').submit();
	});

	$('#save-photos').live('click', function() {
		$('#uploading').val('false');
		$('#uploadPhotoForm').submit();
	});

	//renaming of album.. sets up the data to be passed via ajax
	$('#delete-album, #edit-album').live('click', function(){
		$('#' + $(this).attr('id') + '-dialog').dialog('open');
		return false;
	});

	$('#edit-album-dialog').dialog({
		title		: 'Edit Album',
		closeOnEscape: false,
		autoOpen	: false,
		draggable	: false,
		resizable	: false,
		modal		: true,
		hide		: true,
		width		: 400
	});

	$('#select-file-dialog').dialog({
		title		: 'Upload Photos',
		closeOnEscape: false,
		autoOpen	: false,
		draggable	: false,
		resizable	: false,
		modal		: true,
		hide		: true,
		width		: 500,
		height		: 350,

		buttons : {
			'Cancel' : function() {
				if($('#uploading').val() == 'true') {
					window.location.reload();
				} else {
					$(this).dialog('close');
				}
			}
		},

		open : function() {
			$('#progress-content').hide();
			$('#file_upload').parent().remove();
			$('a.ui-dialog-titlebar-close').remove();
			$('<div class="upload-dialog-button left"><input id="file_upload" name="file_upload" class="upload-dialog-input" type="file" /></div>')
				.insertBefore($('.ui-button-text:contains(Cancel)').parent());
		}
	});

	$('#add-photos-dialog').dialog({
		title		: 'Add Photos',
		closeOnEscape: false,
		autoOpen	: false,
		draggable	: false,
		resizable	: false,
		modal		: true,
		hide		: true,
		width		: 500,
		height		: 350,

		buttons : {
			'Cancel' : function() {
				if($('#uploading').val() == 'true') {
					window.location.reload();
				} else {
					$(this).dialog('close');
				}
			}
		},

		open : function() {
			$('#progress-content').hide();
			$('#file_upload').parent().remove();
			$('a.ui-dialog-titlebar-close').remove();
			$('<div class="upload-dialog-button left"><input id="file_upload" name="file_upload" class="upload-dialog-input" type="file" /></div>')
				.insertBefore($('div[aria-labelledby$=add-photos-dialog] .ui-button-text:contains(Cancel)').parent());
		}
	});

	$('#edit-album-dialog').dialog({
		title		: 'Edit Album',
		closeOnEscape: false,
		autoOpen	: false,
		draggable	: false,
		resizable	: false,
		modal		: true,
		hide		: true,
		width		: 500,
		height		: 350,

		buttons : {
			'Save' : function() {
				if($('#albumNameFlag').val() != '') {
					$('#albumName').val($('#albumNameFlag').val());
					$('#albumDesc').val($('#albumDescFlag').val());
					$('#editAlbumForm').submit();
				} else {
					alert('album name cant be empty');
				}
			},
			
			'Cancel' : function() {
				$(this).dialog('close');
			}
		},

		open : function() {
			$('#albumNameFlag').val($('#albumName').val());
			$('#albumDescFlag').val($('#albumDesc').val());
		}
	});

	$('#delete-album-dialog').dialog({
		title		: 'Delete Album',
		closeOnEscape: false,
		autoOpen	: false,
		draggable	: false,
		resizable	: false,
		modal		: true,
		hide		: true,
		width		: 500,
		height		: 250,

		buttons : {
			'Delete' : function() {
				$('#deleteAlbumForm').submit();
			},
			
			'Cancel' : function() {
				$(this).dialog('close');
			}
		}
	});


});

</script>