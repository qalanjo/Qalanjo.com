<?php 
	$this->Html->css('gifts/styles', 'stylesheet', array('inline'=>false));
	$javascript->link(array('jquery', 'gifts/script'), false);
?>

<div class="content-container">
	<div class="gifts-container-header">
		<?php 
			echo $this->Html->image("designs/blue/gifts/bluegift.jpg");
		?>
	</div>
	<div class="buy-qpoints">
		<div class="float-left">Please choose gift to send to <strong><?php echo $viewedMember['Member']['firstname']; ?></strong></div>
		<div class="float-right">You have <strong><?php echo $member['Member']['credit_points']; ?> QPoints</strong>. You want some more?! <?php echo $html->link('Click here!', array('controller'=>'qpoints', 'action'=>'buy'), array('escape'=>false)); ?></div>
	</div>
	<div class="gifts-container">
		<ul class="container-nav">
			<?php 
				foreach($giftTypes as $giftType):
			?>
			<li><?php echo $html->link('<span>' . $giftType['GiftType']['value'] . '</span>', array('controller'=>'gifts', 'action'=>'get_gifts', $giftType['GiftType']['id']), array('class'=>'category-link', 'escape'=>false))?></li>
			<?php 
				endforeach;
			?>
		</ul>
		<div class="container-content">
			<div id="gifts">
			</div>
			<div class="right">
			</div>
		</div>
	</div>
</div>
