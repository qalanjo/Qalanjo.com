<?php echo $session->flash();?>
<div class="gifts form">

<?php echo $this->Form->create('Gift',array('url'=>array('action'=>'add',$picture_path)));?>
	<fieldset>
 		<legend><?php __('Admin Add Gift'); ?></legend>
 	<?php echo $this->Html->image('gifts/'.$picture_path,array('div'=>false));?>
 	<?php echo $this->Html->link(__('Change The Photo', true), array('action' => 'gift_upload','nill',$picture_path)); ?>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('gift_type_id');
		echo $this->Form->input('price');
		echo $this->Form->input('picture_path',array('value'=>$picture_path,'type'=>'hidden'));
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
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