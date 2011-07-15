<?php if(!empty($type['Gift'])):?>
	<!-- "previous page" action -->
	<a class="prev browse left prev<?php echo $type['GiftType']['id'];?>"></a>
	
	<?php if($type['EOF'] == 1):?>
		<?php $eof = $type['EOF'];?>
	<?php else:?>
		<?php $eof = 0;?>
	<?php endif;?>
	
	<?php if(!empty($type['Gift'])):?>
		<?php $last_gift_id = $type['Gift'][sizeof($type['Gift'])-1]['id'];?>
	<?php else:?>
		<?php $last_gift_id = 0;?>
	<?php endif;?>
	
	<!-- "next page" action -->
	<?php echo $this->Ajax->link('',
		array(
			'controller'=>'gifts',
			'action'=>'update_by_type',
			$type['GiftType']['id'],
			$eof,
			$last_gift_id
		),
		array(
			'class'=>'next browse right next'.$type['GiftType']['id'],
			'id'=>'nextFor'.$type['GiftType']['id'],
			'complete'=>'addItem('.$type['GiftType']['id'].')',
			'update'=>'newItemFor'.$type['GiftType']['id']
		)
	);?>
<?php endif;?>