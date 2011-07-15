<?php 
	echo $this->element('photos/album_script');
	//debug($myAlbums);
?>
<div class="content-container"> 
					<div class="album-container left"> 
						<div class="left-container left"> 
							<h1 class='left'><?php echo $album['Album']['name']?></h1> 
							<div class="left clear by">
								<strong>By:</strong>
									<span class='name'>
										<?php echo $html->link($profileInfo['Member']['firstname'] . ' ' . $profileInfo['Member']['lastname'], '/members/profile/' . $member_id);?>
									</span> 
							</div> 
							<div class="left clear controls"> 
								<?php if(!$visitor && !$defaultAlbum) { ?>
								<span class="left">Album</span> 
								<ul class="controls left"> 
									<li> 
										<a href="#" id="edit-album"><?php echo $html->image('photos/edit.gif', array('class'=>'left', 'alt'=>'edit album'))?> <span class="left">edit</span></a> 
									</li> 
									<li> 
										<a href="#" id="delete-album"> 
											<?php echo $html->image('photos/album_delete.gif', array('class'=>'left', 'alt'=>'delete album'))?> <span class="left">delete</span> 
										</a> 
									</li> 
								</ul>
								<?php } //end if?>
							</div>
							<?php if(!$visitor && !$defaultAlbum) { ?>
							<div class="right clear upload"> 
								<button id="add-photos" class="cursor"> 
									
								</button> 
							</div> 
							<?php } //end if?>
							<div id="album-list" class="clear left"> 
								<ul class="albums"> 
							<?php if(isset($photos)) { ?>
									<?php foreach($photos as $photo) {?>
									<li> 
									<div class="photo">				
											<div class="photo-bg"> 
											<?php 
											if($defaultAlbum) { //show as profile picture..
												$lbFull = str_replace('//','/', $uploadsPath .'/'.$member_id.'/'.$album['Album']['name'].'/profile_thumb_'. $photo['Photo']['picture_path']);
											} else {
												$lbFull = str_replace('//','/', $uploadsPath .'/'.$member_id.'/'.$album['Album']['name'].'/'. $photo['Photo']['picture_path']);
											}
												$full = str_replace('//','/', $uploadsPath .'/'.$member_id.'/'.$album['Album']['name'].'/'. $photo['Photo']['picture_path']);
												$path = explode('/', $full);
												//$thumb = $path[count($path) - 1];
												$path[count($path) - 1] = 'thumb_' . $path[count($path) - 1];
												$path = implode('/', $path);
												echo '<a  id="'. $photo['Photo']['id'] .'" title="'. $photo['Photo']['caption'] .'" rel="lightbox-gallery" href="' . $fullImagePath . '/' . $lbFull . '">'.$this->Html->image($path).'</a>';
											?>
											</div>
									</div> 
									</li> 
								<?php } //end foreach ?>	
							<?php } //end if ?>
								</ul> 
							</div> 
							
						</div> <!-- end left-container -->
						<?php echo $this->element('photos/right-container'); //right-container ?>
					
					</div>	<!-- end album-container -->
</div><!-- end content-container -->

<!-- edit-album -->
<?php echo $form->create('Photo',
					array('url'=>'/photos/editAlbum/', 'id'=>'editAlbumForm', 'class'=>'left')); 
?>	
				<input type="hidden" name="data[Album][id]" value="<?php echo $album['Album']['id']?>"/>
				<input type="hidden" id="albumName" name="data[Album][name]" value="<?php echo $album['Album']['name']?>" />
				<?php if (isset($album['Album']['description'])){?>
					<input type="hidden" id="albumDesc" name="data[Album][description]" value="<?php echo $album['Album']['description']?>"/>
				<?php }else{
				?>
					<input type="hidden" id="albumDesc" name="data[Album][description]" value=""/>
				<?php 
				}?>
<?php echo $form->end();?>

<div id="edit-album-dialog">
	<div id="album-content">
		<div class="album-row"> 
			<h6 class="left desc-span">Album Name:</h6><input type="text" id="albumNameFlag" />
		</div>
		<div class="album-row"> 
			<h6 class="left desc-span">Description: </h6><textarea id="albumDescFlag" rows="7" cols="30" class="left" ></textarea>
		</div>
	</div>
</div>
<!-- end edit-album -->

<!-- delete-album -->
<?php echo $form->create('Photo',
					array('url'=>'/photos/deleteAlbum', 'id'=>'deleteAlbumForm', 'class'=>'left')); 
?>	
				<input type="hidden" name="data[Album][id]" value="<?php echo $album['Album']['id']?>"/>
<?php echo $form->end();?>

<div id="delete-album-dialog"></div>
<!-- end-delete-album -->

<!-- add-photos -->
<div id="add-photos-dialog">
	<div id="upload-content">
		<div id="select-file-content">
			<div id="instruction-image" class="left"></div>
			<span id="instruction-span left"><h4 class="notification"> Notification! </h4> Upload will automatically starts after you selected the files </span>
		</div>
	</div>
	<div id="progressbar"></div>
</div>
<?php echo $form->create('Photo',
					array('type'=>'file','url'=>'/photos/upload/', 'id'=>'uploadPhotoForm')); 
?>
		<input type="hidden" id="action" name="data[action]" value="add"/>
		<input type="hidden" name="data[Album][id]" value="<?php echo $album['Album']['id']?>"/>
		<div id="uploadQueue"></div>
<?php echo $form->end();?>
<input type="hidden" id="uploading" value="false" />
<input type="hidden" id="photo_id" value="" />
<!-- end add-photos -->

<div id="delete-photo-dialog"></div>



