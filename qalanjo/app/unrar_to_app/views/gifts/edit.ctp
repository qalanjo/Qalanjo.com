<div class="gifts form">
<?php echo $this->Form->create('Gift');?>
	<fieldset>
 		<legend><?php __('Edit Gift'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('gift_type_id');
		echo $this->Form->input('price');
		echo $this->Form->input('picture_path');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Gift.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Gift.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Gifts', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Gift Types', true), array('controller' => 'gift_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Type', true), array('controller' => 'gift_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gift Avail Transaction Items', true), array('controller' => 'gift_avail_transaction_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Avail Transaction Item', true), array('controller' => 'gift_avail_transaction_items', 'action' => 'add')); ?> </li>
	</ul>
</div>