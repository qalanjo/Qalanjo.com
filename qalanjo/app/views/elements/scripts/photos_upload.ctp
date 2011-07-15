<script type="text/javascript">
//<![CDATA[

$(document).ready(function(){
		$("#file_upload").uploadify({
			'uploader':'<?php echo $this->Html->url("/js/uploader/uploadify.swf")?>',
			'folder':'/qalanjo/app/webroot/img/uploads/<?php echo $member_id;?>/default',
			'auto':false, 
			'script':'<?php echo $this->Html->url("/js/uploader/uploadify.php")?>',
			'cancelImg':'<?php echo $this->Html->url("/js/uploader/cancel.png")?>',
			'onComplete'  : function(event, ID, fileObj, response, data) {
			     window.location = '<?php echo $this->Html->url("/member_profiles/process_signup_upload/")?>'+response;
			},
		 	'fileExt'     : '*.jpg;*.gif;*.png',
		 	'fileDesc'    : 'Image Files'
		});

		window.alert("hoy");
});

//]]>
</script>