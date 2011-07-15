<ul class="left">
	<li>
<?php if($hasUpdate) { ?>
	<?php foreach($photoUpdates as $photo) { ?>
		<div class="activity-picture left">
			<?php 
				echo $this->Html->image(str_replace('//','/', $uploadsPath .'/'.$member_id.'/'.$albumName.'/thumb_'. $photo['Photo']['picture_path']), 
												array( 'url' => '/photos/album/' . $photo['Photo']['album_id']));
			?>
		</div>
	<?php } //end foreach ?>
<?php } else { ?>	
			<div class="activity-picture left">
				<h5> No updates yet </h5>
			</div>
<?php } ?>
		<div class="shadow left clear">
			
		</div>
	</li>
<?php if($hasUpdate) { ?>
	<li class="last">
		<div class="view-all">
			<?php echo $this->Html->link('View All Photos (' . count($photoUpdates) . ')',
							 array('controller'=>'photos',
							 			'action'=>'album', $album_id));?>
		</div>
	</li>
<?php } //end if ?>
</ul>