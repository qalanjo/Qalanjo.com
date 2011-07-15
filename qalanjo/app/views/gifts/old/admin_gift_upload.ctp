
<?php echo $session->flash();?>
<div class='instruction'>
	<p>Select a file with .jpg, .gif, or .png extensions.</p>
	<p>Then click on the "Upload Picture" link to process the upload.</p>
</div>

<div class="uploader">
				<input id="file_upload" name="file_upload" type="file" />
				<p>
					<a href="javascript:$('#file_upload').uploadifyUpload()">Upload Picture</a>
				</p>
			</div>

<div id="progress">
							
		</div>
			
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Gifts', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Gift Types', true), array('controller' => 'gift_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Type', true), array('controller' => 'gift_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gift Avail Transaction Items', true), array('controller' => 'gift_avail_transaction_items', 'action' => 'index')); ?> </li>
	
	</ul>
</div>