<fieldset class="span-12 container" id="credit_card">
<legend>Payment Information</legend>
<?php 
	echo "<div class='span-12 last'>";
		echo $this->Form->label("Member.firstname", "First Name", array("class"=>"span-5"));
		echo $this->Form->input('Member.firstname', array("label"=>false,"div"=>"span-7 last", "value"=>$member["Member"]["firstname"]));
	echo "</div>";
	echo "<div class='span-12 last'>";
		echo $this->Form->label("Member.lastname", "Last Name", array("class"=>"span-5"));
		echo $this->Form->input('Member.lastname', array("label"=>false,"div"=>"span-7 last", "value"=>$member["Member"]["lastname"]));
	echo "</div>";
	echo "<div class='span-12 last'>";
		echo $this->Form->label("CreditCard.credit_type", "Credit Card", array("class"=>"span-5"));
		echo $this->Form->input('CreditCard.credit_type', array("type"=>"select", "label"=>false,"options"=>$credit_cards,"div"=>"span-7 last"));
	echo "</div>";
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("CreditCard.card_number", "Card Number", array("class"=>"span-5"));
		echo $this->Form->input("CreditCard.card_number", array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("CreditCard.cv_code", "Card Verification Code", array("class"=>"span-5"));
		echo $this->Form->input('CreditCard.cv_code', array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("CreditCard.expiration_year", "Expiration Year", array("class"=>"span-5"));
		echo $this->Form->year('CreditCard.expiration_year', date("Y"), date("Y")+5,date("Y")+1,array("div"=>"span-7 last", "label"=>false, "empty"=>false));
	echo "</div>";
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("CreditCard.expiration_month", "Expiration Month", array("class"=>"span-5"));
		echo $this->Form->month('CreditCard.expiration_month', "January", array("div"=>"span-7 last", "label"=>false, "empty"=>false));
	
	echo "</div>";


?>
</fieldset>