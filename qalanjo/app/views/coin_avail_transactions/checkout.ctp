<?php 
	$path = "designs/blue/subscription_transactions/checkout/";
	$this->Html->css("blue/checkout", "stylesheet", array("inline"=>false));
	$this->Javascript->link("blue/subscription_transactions/checkout", false);
?>
<div class="content-container">
	<div class="subscription-form left">
			<div id="summary" class="error left form">
				&nbsp;
			</div>
			<h2 class="step-arrow left">
				<span>Step 2</span>
			</h2>
			<div class="order-form right">
				<h2 class="left"><span class="right">Order Summary</span></h2>
				<div class="order-summary left">
					<div class="description left">
						<?php echo round($package["CoinPackage"]["coins"])?> QPoints
					</div>
					<div class="details right">
						<span class="right">1</span>
						<span class="times left clear">X</span>
						<span class="right">$ <?php echo round($package["CoinPackage"]["amount"], 2)?></span>
							
					</div>
					<div class="total left clear">
						Total Amount
					</div>
					<div class="total right amount">
						<span class="right">$ <?php echo round($package["CoinPackage"]["amount"], 2)?></span>
					</div>
				</div>
			</div>
			<?php echo $this->element("blue/checkout/checkout", array(
							"model"=>"CoinAvailTransaction",
							"price"=>round($package["CoinPackage"]["amount"], 2),
							"description"=>$package["CoinPackage"]["package"],
							"type"=>$package["CoinPackage"]["id"]))?>
	</div>
</div>