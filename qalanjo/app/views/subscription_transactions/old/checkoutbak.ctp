<?php 
	$path = "designs/blue/subscription_transactions/checkout/";

?>
<div class="content-container">
	<div id="summary" class="span-16 form error">
		
	</div>
	
	<?php echo $this->element("blue/checkout/checkout", array(
							"model"=>"SubscriptionTransaction",
							"price"=>round($selectedSubscription["SubscriptionType"]["price"]*$selectedSubscription["SubscriptionType"]["months"], 2),
							"description"=>$selectedSubscription["SubscriptionType"]["description"],
							"type"=>$selectedSubscription["SubscriptionType"]["id"]))?>
							
	<div id="sidebar" class="span-6 last">
		<h3>Your Checkout Order</h3>
		<span id="time" class="left t-center"> <?php echo $selectedSubscription["SubscriptionType"]["months"]?> months </span>					
		<span id="offered-price" class="left t-center clear"> $ <?php echo $selectedSubscription["SubscriptionType"]["price"]?> </span>
		<span id="permonth" class="left t-center clear"> per month </span>
		<span id="time" class="left t-center"> Total Amount </span>					
		<span id="price" class="left t-center clear"> $ <?php echo round($selectedSubscription["SubscriptionType"]["price"]*$selectedSubscription["SubscriptionType"]["months"], 2)?> </span>									
	</div>
</div>
