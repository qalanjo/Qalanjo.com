<?php 
$path = "designs/subscribe/";
echo $this->Html->image($path."head.jpg");
echo $this->Form->create("SubscriptionTransaction", array("id"=>"subscription_form"));?>
<?php 
	$i=0;
	foreach($types as $type){
		if ($i==0){
			?>
				<div class="span-8 boxx content">
					<div class="span-8 header-title">
						<?php echo $this->Html->image($path.($i+1).".png")?><h2>Plan A</h2><br/>							
					</div>
					<p class="bold-title">Choose your plans and join today!</p>
					<div class="selection">
						<h3>
						<?php 
							echo "<input type='radio'
								name='data[SubscriptionTransaction][subscription_type_id]'
								value='{$type["SubscriptionType"]["id"]}' checked=\"checked\"/>";
								echo $this->Form->label("subscription_type_id", $type["SubscriptionType"]["name"]." ".$type["SubscriptionType"]["description"], array("class"=>"primer_subscription_label"));
												
						?>	
						</h3>
					</div>		
					<p><?php echo $type["SubscriptionType"]["details"]?></p>						
					<p>All prices include VAT or GST as applicable</p>
				</div>
			
			<?php 
		}else{
			?>
				<div class="span-8 boxx content">
					<div class="span-8 header-title">
						<?php echo $this->Html->image($path.($i+1).".png")?><h2>Plan 
						<?php 
						if ($i==1){
							echo "B";
						}else{
							echo "C";
						}?></h2><br/>							
					</div>
					<p class="bold-title">Choose your plans and join today!</p>
					<div class="selection">
						<h3>
						<?php 
							echo "<input type='radio'
								name='data[SubscriptionTransaction][subscription_type_id]'
								value='{$type["SubscriptionType"]["id"]}'/>";
								echo $this->Form->label("subscription_type_id", $type["SubscriptionType"]["name"]." ".$type["SubscriptionType"]["description"], array("class"=>"primer_subscription_label"));
												
						?>	
						</h3>
					</div>		
					<p><?php echo $type["SubscriptionType"]["details"]?></p>						
				</div>
			<?php 
		}
		
		$i++;
	}
	echo $this->Form->submit("Checkout", array("id"=>"button", "div"=>"span-24 last calign"));
?>
<?php echo $this->Form->end();?>