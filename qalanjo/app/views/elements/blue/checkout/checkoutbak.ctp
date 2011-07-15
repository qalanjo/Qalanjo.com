<?php 
	$path = "designs/blue/subscription_transactions/checkout/";
?>
<div id="subscription" class="span-16 form">
	
	<h1 class="span-16"><span class="left">Checkout</span></h1>
	<?php 
		echo $this->Form->create($model, array("class"=>"span-16", "id"=>"checkout"));
		echo $this->Form->input("{$model}.price", array("type"=>"hidden", "value"=>$price));
		echo $this->Form->input("{$model}.description", array("type"=>"hidden", "value"=>$description));
		
	?>
			
		<!-- Billing Address -->
		<fieldset id="basic-inf" class="span-16">
			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>First Name</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">This is your first name that appears in the card</span>
			</div>
			<div class="span-11 clear">
				<?php 
					echo $this->Form->input("CreditCard.firstname", array("class"=>"span-8 last", "div"=>false, "label"=>false));
				?>					
			</div>
			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>Last Name</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">This is your last name that appears in the card</span>
			</div>
			<div class="span-11 clear">
				<?php 
					echo $this->Form->input("CreditCard.lastname", array("class"=>"span-8 last", "div"=>false, "label"=>false));
				?>						
			</div>
			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>Address 1</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">This can be your street number.</span>
			</div>
			<div class="span-11 clear">
				<?php 
					echo $this->Form->input("CreditCard.address1", array("class"=>"span-8 last", "div"=>false, "label"=>false));
				?>				
			</div>
			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>City</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">This is the city where you currently reside.</span>
			</div>
			<div class="span-11 clear">
				<?php 
					echo $this->Form->input("CreditCard.city", array("class"=>"span-8 last", "div"=>false, "label"=>false));
				?>						
			</div>

			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>State/Province(Full)</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">This could be your state or the province where you live.</span>
			</div>
			<div class="span-11 clear">
				<?php 
					echo $this->Form->input("CreditCard.state", array("class"=>"span-8 last", "div"=>false, "label"=>false));
				?>					
			</div>
			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>Zip Code</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">This is the zipcode of your current location.</span>
			</div>
			<div class="span-11 clear">
				<?php 
					echo $this->Form->input("CreditCard.zipcode", array("class"=>"span-8 last", "div"=>false, "label"=>false));
				?>					
			</div>
			
			
			
			<div class="span-11 clear label">

				<label class="span-8 last"><abbr>*</abbr>Country</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">This is the country where you are currently at.</span>
			</div>
			<div class="span-11 clear">
				<?php 
					echo $this->Form->input("CreditCard.country_id", array("type"=>"select", "selected"=>"236", "div"=>false, "label"=>false, "class"=>"span-8 last", "options"=>$countries));
				?>
			</div>
			
			
			
		</fieldset>	
		
		
		<fieldset id="creditcard" class="span-16">

			<h2>
				<span class="left">
					<?php 
						echo $this->Html->image($path."lock.png", array("alt"=>"Secured Credit Card Payment"));
					?>
				</span>
				
				<span class="left">
				<span class="span-8">Secure Credit Card Payment</span>
				<span class="span-8 light clear">This is 128-bit SSL encrypted payment</span>
				</span>

			</h2>
			
			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>Card type</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">Select one of the icons below.</span>
			</div>
			
			<div class="span-11 clear">
				<span class="left card active">
					<?php 
						echo $this->Html->image("designs/creditcard/Visa.png", array("alt"=>"Visa"));
						
					?>
				</span>
				<span class="left card">
					<?php 
						echo $this->Html->image("designs/creditcard/MasterCard.png", array("alt"=>"Master Card"));
					?>
				</span>
				<span class="left card">
					<?php 
						echo $this->Html->image("designs/creditcard/Amex.png", array("alt"=>"American Express"));
					?>
				</span>
				<?php 
					echo $this->Form->input("{$model}.credit_type_id", array("type"=>"hidden", "id"=>"creditcardValue", "value"=>1));		
				?>
			</div>
			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>Credit Card Number</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">The 16 number in front of your credit card.</span>
			</div>
			<div class="span-11 clear">
				<?php echo $this->Form->input("CreditCard.card_number", array("div"=>false, "label"=>false, "class"=>"span-8 last"))?>
								
			</div>

			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>Expiration Date</label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">The date your credit expires. Find this at front of your credit card.</span>
			</div>
			<div class="span-11 clear">
				<?php 
					echo $this->Form->month("CreditCard.expiration_month", "01", array("monthNames"=>false, "div"=>false, "empty"=>false));
				?> / <?php 
					echo $this->Form->year("CreditCard.expiration_year", date("Y")+1, date("Y")+5, date("Y")+1, array("div"=>false, "empty"=>false));
				?>				
			</div>

			<div class="span-11 clear label">
				<label class="span-8 last"><abbr>*</abbr>Security Code <span class="light">(or "CVC" or "CVV")</span></label>
				<span class="span-9 last required"></span>
				<span class="span-9 last">The last 3 digits displayed on the back of your credit card.</span>
			</div>
			<div class="span-11 clear">
				<?php echo $this->Form->input("CreditCard.cv_code", array("div"=>false, "label"=>false, "class"=>"small_sized"))?>			
			</div>

			
		</fieldset>	
		
		<div class="span-16 instruction">
			<p class="strong">What happens now?</p>
			<p>Upon clicking the Process Payment button, your order will be processed. You should have agreed to the <?php echo $this->Html->link("terms", "/terms")?> before clicking on the button.</p>	
		</div>
		
		<div id="next" class="span-16">
			<?php
				echo $this->Form->button("Back", array("class"=>"button", "div"=>false, "id"=>"back"));	 
				echo $this->Form->submit("Process Payment", array("div"=>false, "class"=>"button"));
			?>			
		</div>
	<?php echo $this->Form->end()?>
</div>