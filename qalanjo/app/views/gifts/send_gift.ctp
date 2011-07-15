<div class="content">
	<div class="lightbox-notice-header">
		Notice
	</div>
	<div class="lightbox-notice">
		<?php if($success == true) { ?>
			The gift has been successfully send to <?php echo $viewedMember['Member']['firstname'] ?>
		<?php } else { ?>
			Send gift failed!
		<?php } ?>
	</div>
</div>
<div class="controls">
	<?php 
		if ($success == true) {
			echo $html->link('<span>Ok</span>', array('controller'=>'members', 'action'=>'profile', $viewedMember['Member']['id']), array('class'=>'button enabled ok', 'escape'=>false));
		} else {
			echo $html->link('<span>Ok</span>', array('controller'=>'gifts', 'action'=>'index'), array('class'=>'button enabled ok', 'escape'=>false));
		}
	?>
</div>
