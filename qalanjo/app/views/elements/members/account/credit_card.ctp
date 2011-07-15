<div class="form">
	<?php
	echo $this->Form->create("CreditCard",array('url'=>array('controller'=>'members','action'=>'activation')));
	echo $this->Form->input("CreditCard.id");
	echo $this->Form->input('CreditCard.member_id', array("type"=>"hidden", "value"=>$member_id));
	
	echo "<div class='span-12 last'>";
		echo $this->Form->label("CreditCard.credit_type_id", "Credit Card", array("class"=>"span-5"));
		echo $this->Form->input('CreditCard.credit_type_id', array("type"=>"select", "label"=>false,"options"=>$credit_types,"div"=>"span-7 last"));
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
		echo $this->Form->year('CreditCard.expiration_year', date("Y"), date("Y")+5,date("Y"),array("div"=>"span-7 last", "label"=>false, "empty"=>false));
	
	echo "</div>";
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("CreditCard.expiration_month", "Expiration Month", array("class"=>"span-5"));
		echo $this->Form->month('CreditCard.expiration_month', "January", array("div"=>"span-7 last", "label"=>false, "empty"=>false));
	
	echo "</div>";
	
	echo $this->Form->input("sk", array("value"=>"credit_card", "type"=>"hidden"));
	echo "<div class='span-12 clear'>";
	echo $this->Ajax->submit("Save", array("url"=>"/members/update_account", "update"=>"billing_edit"));
	echo "</div>";
	
	echo $this->Form->end();
	?>
</div>