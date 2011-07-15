<?php
	$this->Html->css('qpoints/styles', 'stylesheet', array('inline'=>false));
?>
<div class="content-container">
	<div class="qpoints-container-header">
	</div>
	<div class="qpoints-left">
		You have <strong><?php echo $member['Member']['credit_points']; ?> QPoints</strong>.You want some more?! Choose a package below.
	</div>
	<div class="main-content">
		<ul>
			<li class="package-one">
				<div class="qpoints-container">
					<em></em>
					<div class="qpoints-box">
						<h2>500 QPoints</h2>
						<span>$12.99</span>
					</div>
				</div>
				<?php echo $html->link('<span>Buy QPoints</span>', array('controller'=>'qpoints', 'action'=>'checkout', 3), array('class'=>'button', 'escape'=>false)); ?>
			</li>
			<li class="package-two">
				<div class="qpoints-container">
					<em></em>
					<div class="qpoints-box">
						<h2>1000 QPoints</h2>
						<span>$19.99</span>
					</div>
				</div>
				<?php echo $html->link('<span>Buy QPoints</span>', array('controller'=>'qpoints', 'action'=>'checkout', 2), array('class'=>'button', 'escape'=>false)); ?>
			</li>
			<li class="package-three last">
				<div class="qpoints-container">
					<em></em>
					<div class="qpoints-box">
						<h2>2500 QPoints</h2>
						<span>$39.99</span>
					</div>
				</div>
				<?php echo $html->link('<span>Buy QPoints</span>', array('controller'=>'qpoints', 'action'=>'checkout', 1), array('class'=>'button', 'escape'=>false)); ?>
			</li>
		</ul>
		<p><a>Pricing Terms and Conditions</a></p>
		<p>All amounts shown are in US Dollars.</p>
	</div>
</div>