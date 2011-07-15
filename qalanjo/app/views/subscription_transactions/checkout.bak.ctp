<?php 
	$path = "designs/subscribe/";
	echo $this->Html->image($path."head.jpg");
	echo $this->Form->create("SubscriptionTransaction", array("url"=>"/subscription_transactions/checkout", "id"=>"checkout"));
	echo $this->Form->input("SubscriptionTransaction.price", array("type"=>"hidden", "value"=>$selectedSubscription["SubscriptionType"]["price"]));	
	echo $this->Form->input("SubscriptionTransaction.description", array("type"=>"hidden", "value"=>$selectedSubscription["SubscriptionType"]["description"]));	
?>

<div class="span-24 boxx last column">
		<div class="header-title span-12">
		<?php echo $this->Html->image($path."arrow.png")?><h2>Subscription Order</h2>							
		</div>
		<div class="span-24 clear">
			<p>You have chosen to purchase the subscription plan indicated below. As soon as you confirm to order this type of plan, you may fill out the section that follows with the information required. Please make sure that the following information you enter are valid and acceptable.</p>
			
			<div class="span-24 detail">
				<div class="span-6">
				<p class="bold-title">Premium Subscription</p>
				</div>
				<div class="span-6">									
					<p class="marg-x"><?php echo $selectedSubscription["SubscriptionType"]["description"]?></p>
				</div>
				<div class="span-3">									
				</div>
				<div class="span-10 last">
				<h3 class="marg-x">$ <?php echo $selectedSubscription["SubscriptionType"]["price"]?> X <?php echo $selectedSubscription["SubscriptionType"]["months"]?> months = $<?php echo ($selectedSubscription["SubscriptionType"]["price"]*$selectedSubscription["SubscriptionType"]["months"])?> </h3>									
				</div>
			</div>
		</div>
		</div>
	
	<div class="span-12 boxx content">
		<div class="span-12 header-title">
		<?php echo $this->Html->image($path."arrow.png")?><h2>Contact Information</h2>							
		</div>	
		<p class="bold-title clear">Name</p>
		<div class="span-12 input">		
			<?php echo $this->Form->input("Member.firstname", array("div"=>false, "label"=>false, "class"=>"text span-5 margin default"))?>
			<?php echo $this->Form->input("Member.lastname", array("div"=>false, "label"=>false, "class"=>"text span-4 default"))?>
		</div>
	
		<p class="bold-title">Country</p>
		<div class="span-12 input">							
			<?php echo $this->Form->input("Member.country_id", array("type"=>"select", "options"=>$countries, "selected"=>"236", "div"=>false, "label"=>false))?>
		</div>
		
	</div>
	
	<div id="contact-info2" class="span-12 last boxx content">
	
		<p class="bold-title prepend-top">Contact</p>
		<div class="span-12 input">							
			<?php 
				if ($this->data["Member"]["email"]!=""){
					echo $this->Form->input("Member.email", array("class"=>"text span-11 default", "div"=>false, "label"=>false));
				}else{
					echo $this->Form->input("Member.email", array("class"=>"text span-11 default", "div"=>false, "label"=>false, "value"=>"Email"));
				}
				if ($this->data["Member"]["country_code"]!=""){
					echo $this->Form->input("Member.country_code", array("class"=>"text span-2 default", "div"=>false, "label"=>false));
				}else{
					echo $this->Form->input("Member.country_code", array("class"=>"text span-2 default", "div"=>false, "label"=>false, "value"=>"Code"));
				}	
			?>
			<span class="left">
				&nbsp;-&nbsp;
			</span>
			<?php 
				if ($this->data["Member"]["contact_number"]!=""){
					echo $this->Form->input("Member.contact_number", array("class"=>"text span-8 default", "div"=>false, "label"=>false));
				}else{
					echo $this->Form->input("Member.contact_number", array("class"=>"text span-8 default", "div"=>false, "label"=>false, "value"=>"Number"));
				}	 
			?>
			
		</div>
		
		<p class="bold-title prepend-top">Address</p>
		<div class="span-12 input">		
		<?php 
			if ($this->data["Member"]["address1"]!=""){
				echo $this->Form->input("Member.address1", array("class"=>"text span-11 default", "div"=>false, "label"=>false));
			}else{
				echo $this->Form->input("Member.address1", array("class"=>"text span-11 default", "div"=>false, "label"=>false, "value"=>"Address 1"));	
			}
		
		?>
		<?php 
			if ($this->data["Member"]["city"]!=""){
				echo $this->Form->input("Member.city", array("class"=>"text span-11 default", "div"=>false, "label"=>false));
			}else{
				echo $this->Form->input("Member.city", array("class"=>"text span-11 default", "div"=>false, "label"=>false, "value"=>"City"));	
			}
		
		?>
		
		<?php 
			if ($this->data["Member"]["zipcode"]!=""){
				echo $this->Form->input("Member.zipcode", array("class"=>"text span-4 margin default", "div"=>false, "label"=>false));
			}else{
				echo $this->Form->input("Member.zipcode", array("class"=>"text span-4 margin default", "div"=>false, "label"=>false, "value"=>"Zip Code"));	
			}
		
		?>
		<?php 
			if ($this->data["Member"]["state"]!=""){
				echo $this->Form->input("Member.state", array("class"=>"text span-4 default", "div"=>false, "label"=>false));
			}else{
				echo $this->Form->input("Member.state", array("class"=>"text span-4 default", "div"=>false, "label"=>false, "value"=>"Zip Code"));	
			}
		
		?>
		
		</div>
		
	</div>
	
	<div class="span-24 boxx last column">
		<div class="span-12 header-title">
			<?php echo $this->Html->image($path."arrow.png")?><h2>Order Summary</h2>							
		</div>
		<div class="span-24 clear">
			<p>
				Please review your order summary before clicking the <strong>Proceed</strong> button.
			</p>		
			<div class="span-24 block-column">
				<div class="span-10">
				<p class="bold-title blue-h"></p>
				</div>
				<div class="span-5">									
				<p class="marg-x"><?php echo $selectedSubscription["SubscriptionType"]["description"]?></p>
				</div>
				<div class="span-3">									
				<p><input id="id_quantity" type="text" value="1" name="quantity" style="width:20px;" readonly ></p>									
				</div>
				<div class="span-2 last">
				<h3 class="marg-x">$<?php echo $selectedSubscription["SubscriptionType"]["price"]*$selectedSubscription["SubscriptionType"]["months"]?></h3>
				<p class="small marg-x">$<?php echo $selectedSubscription["SubscriptionType"]["price"]?>X<?php echo $selectedSubscription["SubscriptionType"]["months"]?></p>									
				</div>
			</div>
			
			<div class="span-24 block-column">
				<div class="span-10">
				<p class="bold-title blue-h">Total Overview</p>
				</div>
				<div class="span-5">									
				<p class="marg-x">&nbsp;</p>
				<p class="small marg-x">&nbsp;</p>
				</div>
				<div class="span-3">									
				<p>&nbsp;</p>									
				</div>
				<div class="span-2 last">
				<h3 class="marg-x blue-h">$<?php echo $selectedSubscription["SubscriptionType"]["price"]*$selectedSubscription["SubscriptionType"]["months"]?></h3>
												
				</div>
			</div>
	</div>
</div>
	
	
<div class="span-24 boxx last column">
	<div class="span-12 header-title">
	<?php echo $this->Html->image($path."arrow.png")?><h2>Payment Method</h2>							
	</div>
	<div>
	<p id="credit_card_instruction" class="clear">Provide the correct data necessary in the boxes that follow then hit the process order button to complete transaction. Our payment system assures you that your credit information is kept protected at all times. Thank you.</p>			
		
	<div class="span-24 block-column">
		<?php 	
			$i=0;
			foreach($credit_cards as $creditType){
				echo "<div class='span-2'>";
				if ($i==0){
					echo "<input type='radio'
									name='data[SubscriptionTransaction][credit_type_id]'
									value='{$creditType["CreditType"]["id"]}' class='payment_select' checked='checked'/>";
				}else{
					echo "<input type='radio'
									name='data[SubscriptionTransaction][credit_type_id]'
									value='{$creditType["CreditType"]["id"]}' class='payment_select'/>";
						
				}
				echo $this->Html->image("designs/creditcard/".$creditType["CreditType"]["paypal_name"].".png");
				echo "</div>";
				
				$i++;
			}
			
			echo "<div class='span-2'>";
				echo "<input type='radio'
								name='data[SubscriptionTransaction][credit_type_id]'
								value='-1' class='payment_select'/>";
				echo $this->Html->image("designs/creditcard/Paypal.png");
				
			echo "</div>";
		
		?>
		
		
	</div>
	
	
	<div id="credit_card_select">
		<p class="bold-title">Card Information</p>
		<div class="span-24 input">							
			<?php echo $this->Form->input("CreditCard.card_number", array("div"=>false, "label"=>false, "class"=>"text"))?>
			<?php echo $this->Form->input("CreditCard.cv_code", array("div"=>false, "label"=>false, "class"=>"text"))?>
		</div>
		
		<p class="bold-title">Name as it appears on card</p>
		<div class="span-24 input">							
			<?php echo $this->Form->input("CreditCard.firstname", array("div"=>false, "label"=>false, "class"=>"text span-6 margin"))?>
			<?php echo $this->Form->input("CreditCard.middlename", array("div"=>false, "label"=>false, "class"=>"text span-4 margin"))?>
			<?php echo $this->Form->input("CreditCard.lastname", array("div"=>false, "label"=>false, "class"=>"text span-6"))?>
		</div>
		<p class="bold-title">Expiration Date</p>
		<div class="span-24 input">
		<?php 
		echo $this->Form->month("CreditCard.expiration_month", null, array("monthNames"=>false, "div"=>false, "class"=>"span-4"));
		echo $this->Form->year("CreditCard.expiration_year", date("Y")+1, date("Y")+5, date("Y")+1, array("div"=>false, "class"=>"span-4"));
		?>
		</div>
	</div>
	
	<div id="paypal_select">
	
	
	</div>
</div>	
</div>


<div id="button-wrap" class="span-24">
		<?php echo $this->Form->submit("Process My Order", array("div"=>false, "id"=>"button"))?>
</div>

<?php echo $this->Form->end()?>