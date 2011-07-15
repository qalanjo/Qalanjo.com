<script type="text/javascript"><!--
//<![CDATA[


$(document).ready(function(){
		//deletes the album created on uploading when the user leaves or refreshes the page
		$(window).bind('beforeunload', function(e) {
			if($('#deleteBeforeUnload').val() == 'true') {
				$.ajax({
					type			: 'post',
					url				: qalanjo_url + 'photos/deleteBeforeUnload/',
	
					success : function(data) {
						
					}
				});
			}
		});

		//when upload photo is click.. 
		$('#upload-photos, #add-photos').click(function(e){
			$('.uploader').remove(); //append the upload button on dialog.. remove if exist
			$('<div class="uploader left"><input id="file_upload" name="file_upload" type="file" /></div>')
				.appendTo('.ui-dialog-buttonset');
			$('.uploader').hide();

			var activeButton = $(this).attr('id');
			
			//check if member is subscribe
			$.ajax({
				type	:	'post',
				url		:	qalanjo_url + 'subscription_transactions/already_subscribe',
				success	:	function(response) {
					if(response == 'true') { // subscribed
						if(activeButton == 'upload-photos') {
							$('#upload-dialog').dialog('open');
						} else {
							$('.uploader').show();
							$('#add-photos-dialog').dialog('open');
						}
					}
					else if (response == 'false'){ // unsubscribed
						location.href = qalanjo_url + 'subscription_transactions/error';
					} else if (response == 'invalid'){ // not signed in
						location.href = qalanjo_url + 'login';
					}
				}
			});

			var totalSize = 0;
			var bytesUpload = 0;
			
			$("#file_upload").uploadify({						
				'uploader'		: '<?php echo $this->Html->url("/js/uploader/uploadify.swf")?>',
				'folder'		: qalanjo_url + '/app/webroot/img/uploads/<?php echo $member_id;?>/', 
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
					$('#file_upload'+ID)
						.append('<input type=text name=data[' + img.ctr + '][Photo][caption] /><img src="' + img.thumb + '" /><input type=hidden id=' + ID + ' name=data[' + img.ctr + '][Photo][picture_path] value="' + img.full + '"/>');
					$('#album_name').remove();
					$('<input type="hidden" id="album_name" name="data[Album][name]" value="' + img.album + '" />')
						.insertAfter('#album');

					bytesUpload += fileObj.size;
				},

				onProgress : function(event,ID,fileObj,data) {
					var progress = (( data.bytesLoaded + bytesUpload ) / totalSize ) * 100;
					 $("#progressbar .ui-progressbar-value").animate({width: progress+"%"});
				},
				
				onAllComplete : function(event, ID, fileObj, response, data) {
					$('#progressbar').progressbar('destroy');
					window.alert('Upload Complete');
					$('.uploader').hide();
					$('.ui-button-text:contains(Create Album)').parent().show();
					$('.ui-button-text:contains(Add Photos)').parent().show();
				},

				onSelectOnce: function(event, data) {
					$('#file_upload').uploadifySettings(
							'scriptData', {
								'album' 	: $('#album').val()
							}
					);
					$('#file_upload').uploadifyUpload();
					$('#uploadQueue').hide();
					$('#progressbar').progressbar({value : 0});
					
					//flag.. delete album before unload
					$('#deleteBeforeUnload').val('true');

				},

				onSelect : function(event, data, fileObj) {
					totalSize += fileObj.size;
				},

				onError : function (event,ID,fileObj,errorObj) {
					 alert(errorObj.type + ' Error: ' + errorObj.info);
				},

				onCheck : function(event, data, key) {
					alert('same file name');
				},

				onCancel : function (event, ID, fileObj, data) {
			         var dir = $('#' + ID).val();
			         $('#cancelled_images')
			        	.append('<input type=hidden name=data[Cancelled][' + ID + '] value=' + dir + '>');
			    }
			});

			e.preventDefault();
			return false;
		}); //end upload-photos

		//upload dialog box settings..
		$('#upload-dialog').dialog({
			title		: 'Upload Photos',
			autoOpen	: false,
			closeOnEscape: false,
			draggable	: false,
			resizable	: false,
			modal		: true,
			hide		: true,
			
			buttons	: {
				'Create Album' : function() {
					//flag.. delete album before unload
					$('#deleteBeforeUnload').val('false');
					$(this).dialog('close');
					$('#uploadPhoto').submit();
					$().toastmessage('showToast', {
						text		: 'Photos Successfully Uploaded !!',
						stayTime	: 3000,
						position	: 'middle-center',
						sticky		: false,
						type		: 'success'
					});
				}, //end create album
				
				'Continue' : function(event, ui) {
					if($('#album').val() == '') { //album name cannot be empty
						alert('Please enter album name');
					} else { //if not empty.. check if there is an existing album name
						$.ajax({
							type		: 'post',
							url			: qalanjo_url + '/photos/checkAlbumName/' + $('#album').val(),
							success : function(data) {
								var response = $.parseJSON(data);
									$('.ui-button-text:contains(Continue)').parent().hide();
									$('#album').val(response.albumName);
									$('.uploader').show('normal');
									$('#album-wrap').hide();
									$('#instruction-image').show();
								
							}
						});
					}
				}, //end continue
				
				'Cancel' : function() {
					$('.ui-button-text:contains(Continue)').parent().show();
					$('.uploader').hide();

					if($('.ui-button-text:contains(Create Album)').parent().is(':visible')) {
						$.ajax({
							type		: 'post',
							url			: qalanjo_url +'/photos/cancelUpload',
							data		: {
								albumName : $('#album').val()
							},
	
							success : function(response) {
								
							}
						});
					}
					$(this).dialog('close');
				} //end cancel
			},
			open : function(event, ui) {
				$('#album-wrap').show();
				var d = new Date();
				var m = new Array(12);
				m[0] = 'January';
				m[1] = 'February';
				m[2] = 'March';
				m[3] = 'April';
				m[4] = 'May';
				m[5] = 'June';
				m[6] = 'July';
				m[7] = 'August';
				m[8] = 'September';
				m[9] = 'October';
				m[10] = 'November';
				m[11] = 'December';
				
				var month = m[d.getMonth()];
				var day = d.getDate();
				var yr = d.getFullYear();
				$('#album').val( month + '-' + day + '-' + yr); //default album name.. current date

				//check if album exist.. if album exist add suffix on the album name
				$.ajax({
					type		: 'post',
					url			: qalanjo_url + '/photos/checkAlbumName/' + $('#album').val(),
					success : function(data) {
						var response = $.parseJSON(data);
						//change album name with the suffix generated name
						$('#album').val(response.albumName);
					}
				});
				
				$('#instruction-image').hide();
				$('.ui-button-text:contains(Create Album)').parent().hide();
				$(".ui-dialog-titlebar-close").hide();
			}
		}); //end upload-dialog


		//upload dialog box settings..
		$('#add-photos-dialog').dialog({
			title		: 'Add Photos',
			closeOnEscape: false,
			autoOpen	: false,
			draggable	: false,
			resizable	: false,
			modal		: true,
			hide		: true,
			
			buttons	: {
				'Add Photos' : function() {
					//flag.. delete album before unload
					$('#deleteBeforeUnload').val('false');
					$(this).dialog('close');
					$('#action').val('save');
					$('#uploadPhoto').submit();
					$().toastmessage('showToast', {
						text		: 'Photos Successfully Uploaded !!',
						stayTime	: 3000,
						position	: 'middle-center',
						sticky		: false,
						type		: 'success'
					});
				},
				
				'Cancel' : function() {
					$('.uploader').hide();
					$(this).dialog('close');
					if($('.ui-button-text:contains(Add Photos)').parent().is(':visible')) {
						$('#action').val('delete');
						$('#uploadPhoto').submit();
					}
				} //end cancel
			},

			open : function() {
				$('.ui-button-text:contains(Add Photos)').parent().hide();
				$(".ui-dialog-titlebar-close").hide();
			},
			
			close : function() {
				
			}
		}); //end add-photos-dialog
		
});



//]]>

--></script>