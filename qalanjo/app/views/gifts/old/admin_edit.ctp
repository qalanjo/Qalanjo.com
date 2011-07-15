<?php echo $session->flash();?>
<div class="gifts form">
<?php echo $this->Form->create('Gift');?>
	<fieldset>
 		<legend><?php __('Admin Edit Gift'); ?></legend>
 		<?php echo $this->Html->image('gifts/'.$picture_path,array('div'=>false));?>
 		<?php echo $this->Html->link(__('Change The Photo', true), array('action' => 'gift_upload',$this->Form->data['Gift']['id'],$picture_path)); ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('gift_type_id');
		echo $this->Form->input('price');
		echo $this->Form->input('picture_path',array('div'=>false,'value'=>$picture_path,'type'=>'hidden'));
		echo $this->Form->input('old_name',array('type'=>'hidden','value'=>$old_name));
		echo $this->Form->input('description');
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

	</ul>
</div>