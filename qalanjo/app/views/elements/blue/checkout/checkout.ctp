<?php 
	$path = "designs/blue/subscription_transactions/checkout/";
	echo $this->Form->create($model, array("class"=>"span-16", "id"=>"checkout"));
	echo $this->Form->input("{$model}.price", array("type"=>"hidden", "value"=>$price));
	echo $this->Form->input("{$model}.description", array("type"=>"hidden", "value"=>$description));
?>
<div class="span-14 content left">
	<h2 class="header left">Checkout</h2>
		<fieldset class="basic-information left">
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
		</fieldset>
</div>


<fieldset class="basic-information span-22 col-group left">
	<div class="col1 span-9 clear">
		<div class="span-10 clear label">
			<label class="span-8 last"><abbr>*</abbr>City</label>
			<span class="span-9 last required"></span>
			<span class="span-9 last">This is the city where you currently reside.</span>
		</div>

		<div class="span-9 clear">
			<?php 
				echo $this->Form->input("CreditCard.city", array("class"=>"span-8 last", "div"=>false, "label"=>false));
			?>						
		</div>
		
	</div>
	
	<div class="col1 span-9 left last">
		<div class="span-9 clear label">
			<label class="span-8 last"><abbr>*</abbr>Zip Code</label>	
			<span class="span-9 last required"></span>
			<span class="span-9 last">This is the zipcode of your current location.</span>
		</div>
		<div class="span-10 clear">
			<?php 
				echo $this->Form->input("CreditCard.zipcode", array("class"=>"span-8 last", "div"=>false, "label"=>false));
			?>					
		</div>
	</div>
	
	<div class="col1 span-9 left">
		<div class="span-9 clear label">
			<label class="span-8 last"><abbr>*</abbr>State/Province(Full)</label>
			<span class="span-9 last required"></span>
			<span class="span-9 last">This could be your state or the province where you live.</span>
		</div>
	
		<div class="span-9 clear">
			<?php 
				echo $this->Form->input("CreditCard.state", array("class"=>"span-8 last", "div"=>false, "label"=>false));
			?>					
		</div>
	</div>
		
	<div class="col1 span-9 left last">
		<div class="span-9 label">
			<label class="span-8 last"><abbr>*</abbr>Country</label>
			<span class="span-9 last required"></span>
			<span class="span-9 last">This is the country where you are currently at.</span>
		</div>
		<div class="span-9 clear">
			<?php 
				echo $this->Form->input("CreditCard.country_id", array("type"=>"select", "selected"=>"236", "div"=>false, "label"=>false, "class"=>"span-8 last", "options"=>$countries));
			?>
		</div>
	</div>
</fieldset>
<div class="cc left">
		<div class="cc-top clear left">
		
		</div>
		<div class="cc-form clear left">
			<h2>
				<span class="secured left">
					<?php 
						echo $this->Html->image($path."lock.png", array("alt"=>"Secured Credit Card Payment"));
					?>
				</span>
					
				<span class="left">
					<span class="loud span-8">Secure Credit Card Payment</span>
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
				?> / 
				<?php 
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
		</div>
		<div class="cc-bottom clear left">
		
		</div>
		
		<div class="left what-now">
			<h2 class="left">
				What now?
			</h2>
			
			<p class="left clear">
				Upon clicking the Process Payment, your order will be processed. You should have agreed to the <a>terms</a> before clicking on the button.							
			</p>
		</div>
		
		<div class="left">
			<button id="back" class="left back">
			</button>
			<button type="submit" class="left process-payment">
			</button>
		</div>
</div>
<?php 
	echo $this->Form->end();
?>