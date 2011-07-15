<?php echo $session->flash();?>

<div class="gifts view">
<h2><?php  __('Gift');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Picture Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image('gifts/'.$gift['Gift']['picture_path'],array('div'=>false));?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gift['Gift']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gift['Gift']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gift Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($gift['GiftType']['value'], array('controller' => 'gift_types', 'action' => 'view', $gift['GiftType']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gift['Gift']['price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gift['Gift']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gift['Gift']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gift', true), array('action' => 'edit', $gift['Gift']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Gift', true), array('action' => 'delete', $gift['Gift']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gift['Gift']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Gifts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gift Types', true), array('controller' => 'gift_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Type', true), array('controller' => 'gift_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gift Avail Transaction Items', true), array('controller' => 'gift_avail_transaction_items', 'action' => 'index')); ?> </li>
		
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Gift Avail Transaction Items');?></h3>
	<?php if (!empty($gift['GiftAvailTransactionItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Gift Avail Transaction Id'); ?></th>
		<th><?php __('Gift Id'); ?></th>
		<th><?php __('Quantity'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($gift['GiftAvailTransactionItem'] as $giftAvailTransactionItem):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $giftAvailTransactionItem['id'];?></td>
			<td><?php echo $giftAvailTransactionItem['gift_avail_transaction_id'];?></td>
			<td><?php echo $giftAvailTransactionItem['gift_id'];?></td>
			<td><?php echo $giftAvailTransactionItem['quantity'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'gift_avail_transaction_items', 'action' => 'view', $giftAvailTransactionItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
