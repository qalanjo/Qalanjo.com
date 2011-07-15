<div class="attributeInterpretations form">
<?php echo $this->Form->create('AttributeInterpretation');?>
	<fieldset>
 		<legend><?php __('Edit Attribute Interpretation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('attribute_id');
		echo $this->Form->input('response');
		echo $this->Form->input('interpretation');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('AttributeInterpretation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('AttributeInterpretation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Attribute Interpretations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Attributes', true), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute', true), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
	</ul>
</div>