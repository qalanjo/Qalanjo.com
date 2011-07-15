<?php echo $html->link('', '', array('class'=>'close')); ?>
<div class="top"></div>
<div class="middle">
	<div class="content">
		<div class="left">
			<div class="image-container">
				<?php echo $html->image('gifts/category/' . strtolower($typeName) . '/' . $gift['Gift']['picture_path']); ?>
			</div>
			<div class="message-box">
				<dl>
					<dt>
						Message<em>(Optional)</em>:
					</dt>
					<dd>
						<textarea id="message"></textarea>
					</dd>
				</dl>
			</div>
		</div>
		<div class="details">
			<div class="name"><?php echo $gift['Gift']['name'] ?></div>
			<div class="description"><?php echo $gift['Gift']['description'] ?></div>
			<div class="row"><span class="label">You have:</span><span class="value"><?php echo $member['Member']['credit_points'] ?> QPoints</span></div>
			<div class="row"><span class="label">Price:</span><span class="value"><?php echo $gift['Gift']['price']?> QPoints</span></div>
			<?php $remainingQPoints = $member['Member']['credit_points'] - $gift['Gift']['price']; ?>
			<?php 
				if ($remainingQPoints >= 0) {
			?>
				<div class="row"><span class="label">Remaining QPoints:</span><span class="value"><?php echo $remainingQPoints; ?> QPoints</span></div>
			<?php 
				} else {
			?>
				<div class="row"><span class="label warning">Remaining QPoints:</span><span class="value warning"><?php echo $remainingQPoints; ?> QPoints</span></div>
			<?php 
				}
			?>
		</div>
	</div>
	<div class="controls">
		<?php echo $html->link('<span>Buy QPoints</span>', array('controller'=>'qpoints', 'action'=>'buy'), array('class'=>'button enabled buy-qpoints', 'escape'=>false)) ?>
		<?php 
			if ( $remainingQPoints < 0 ) {
		?>
		<div class="warning">You don't have enough QPoints</div>
		<?php 
			}
		?>
		<?php echo $html->link('<span>Cancel</span>', '', array('class'=>'button enabled cancel', 'escape'=>false)) ?>
		<?php 
			if ( $remainingQPoints >= 0 ) {
				echo $html->link('<span>Buy & Send</span>', array('controller'=>'gifts', 'action'=>'send_gift', $viewedMemberId, $gift['Gift']['id'], $member['Member']['id']), array('class'=>'button enabled buy', 'escape'=>false));
			} else {
				echo $html->link('<span>Buy & Send</span>', array('controller'=>'gifts', 'action'=>'send_gift', $viewedMemberId, $gift['Gift']['id'], $member['Member']['id']), array('class'=>'button disabled buy', 'escape'=>false));	
			} 
		?>
	</div>
</div>
<div class="bottom"></div>
<div class="ribbon"></div>