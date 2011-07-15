<h2><span><?php echo $typeName ?></span></h2>
<ul class="gifts-list">
	<?php
		foreach($gifts as $gift):	
	?>
	<li>
		<?php echo $html->link($this->element('gifts/gift_thumbnail', array('typeName'=>$typeName, 'gift'=>$gift)), array('controller'=>'gifts', 'action'=>'get_gift', $typeName, $gift['Gift']['id']), array('class'=>'lightbox', 'escape'=>false)) ?>
	</li>
	<?php 
		endforeach;
	?>
</ul>