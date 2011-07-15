<?php echo $session->flash();?>

<div class="gifts index">
	<h2><?php __('Gifts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('gift_type_id');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('picture_path');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($gifts as $gift):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $gift['Gift']['id']; ?>&nbsp;</td>
		<td><?php echo $gift['Gift']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($gift['GiftType']['value'], array('controller' => 'gift_types', 'action' => 'view', $gift['GiftType']['id'])); ?>
		</td>
		<td><?php echo $gift['Gift']['price']; ?>&nbsp;</td>
		<td><?php echo $gift['Gift']['picture_path']; ?>&nbsp;</td>
		<td><?php echo $gift['Gift']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $gift['Gift']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $gift['Gift']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $gift['Gift']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gift['Gift']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Gift', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Gift Types', true), array('controller' => 'gift_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Type', true), array('controller' => 'gift_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gift Avail Transaction Items', true), array('controller' => 'gift_avail_transaction_items', 'action' => 'index')); ?> </li>
		
	</ul>
</div>