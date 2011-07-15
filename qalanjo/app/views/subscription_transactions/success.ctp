<?php 
	$this->Html->css('blue/subscription_success', 'stylesheet', array('inline'=>false));
	echo $this->Html->scriptBlock("
		$(document).ready(function(){
			$('#button').click(function(){
				window.location.href='{$this->Html->url("/")}';
			});
		});
	
	");
?>
<div class="content-container">
	<div id="success-wrap" class="span-24">
		<div class="span-6">
		<?php 
			echo $this->Html->image("designs/blue/subscription_transactions/success/EmptyCart-success.png");
		?>
		</div>
		<div id="success" class="left">
			<div id="success-cont" class="left">
				<div id="success-text-container" class="left">
					<h2>Your order has succesfully processed.</h2>
					<p>You are now a subscribe member of Qalanjo.com. Please enjoy the benefits and happy matching.</p>
				</div>
			</div>
			<div id="btn-wrap" class="clear">
					<div id="button" class="clear">
						<p>Back to Main</p>
					</div>
			</div>
		</div>
	</div>
</div>