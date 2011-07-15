
<div id="select-file-dialog">
	<div id="upload-content">
		<div id="select-file-content">
			<div id="instruction-image" class="left"></div>
			<span id="instruction-span left"><h4 class="notification"> Notification! </h4> Upload will automatically starts after you selected the files </span>
		</div>
		
		<div id="progress-content">
			<div id="progressbar"></div>
			<h5> Create your album while you wait.. </h5>
			<div id="album-content">
				<div class="album-row"> 
					<h6 class="left desc-span">Album Name:</h6> <input type="text" id="albumNameFlag" />
				</div>
				<div class="album-row"> 
					<h6 class="left desc-span">Description: </h6><textarea id="albumDescFlag" name="data[Album][description]" rows="7" cols="30" class="left"></textarea>
				</div>
			</div>
		</div>
	</div>
	
	<?php echo $form->create('Photo',
					array('type'=>'file','url'=>'/photos/upload/', 'id'=>'uploadPhotoForm')); 
	?>
		<input type="hidden" id="action" name="data[action]" value="create"/>
		<input type="hidden" id="albumName" name="data[Album][name]" />
		<input type="hidden" id="albumDesc" name="data[Album][description]" />
		<div id="uploadQueue"></div>
	<?php echo $form->end();?>
	
</div>
<input type="hidden" id="uploading" value="false" />
