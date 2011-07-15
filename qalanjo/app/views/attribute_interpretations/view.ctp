<div class="attributeInterpretations view">
<h2><?php  __('Attribute Interpretation');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attributeInterpretation['AttributeInterpretation']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Attribute'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($attributeInterpretation['Attribute']['attribute'], array('controller' => 'attributes', 'action' => 'view', $attributeInterpretation['Attribute']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Response'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attributeInterpretation['AttributeInterpretation']['response']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Interpretation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attributeInterpretation['AttributeInterpretation']['interpretation']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attribute Interpretation', true), array('action' => 'edit', $attributeInterpretation['AttributeInterpretation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Attribute Interpretation', true), array('action' => 'delete', $attributeInterpretation['AttributeInterpretation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attributeInterpretation['AttributeInterpretation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attribute Interpretations', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute Interpretation', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributes', true), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute', true), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
	</ul>
</div>
