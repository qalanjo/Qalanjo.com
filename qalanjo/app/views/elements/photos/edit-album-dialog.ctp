<?php 
	//debug($myAlbums);
?>

<?php foreach($myAlbums as $id => $album) { ?>
	<div class="album-row">
		<div class="album-img left">
		<?php 
			if($album['name'] == $profileAlbum) { //default album cant be modified
				continue;	
			}
			
			if(!$album['cover_pic']) {
				echo $this->Html->image('photos/shout-q-image.png');	
			} else {
				echo $this->Html->image(str_replace('//','/', $uploadsPath .'/'.$member_id.'/'.$album['name'].'/thumb_'. $album['cover_pic']),
								array('width'=>76, 'height'=>73));
			}	
			
		?>
		</div>
		<div class="album-name left">
			<?php echo $album['name']?>
		</div>
		<div class="clear"></div>
			
	</div>
<?php } //end foreach ?>

