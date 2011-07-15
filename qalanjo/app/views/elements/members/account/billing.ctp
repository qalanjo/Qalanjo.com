<p>Choose your new username carefully.</p>
<div class="form">
	<?php
	echo $this->Form->create("Member",array('url'=>array('controller'=>'members','action'=>'activation')));
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.country_id", "Country", array("class"=>"span-5"));
		echo $this->Form->input("Member.country_id", array("label"=>false, "div"=>"span-7 last", "options"=>$countries));
	echo "</div>";
	
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.address1", "Address 1", array("class"=>"span-5"));
		echo $this->Form->input("Member.address1", array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.address2", "Address 2", array("class"=>"span-5"));
		echo $this->Form->input("Member.address2", array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.city", "City", array("class"=>"span-5"));
		echo $this->Form->input("Member.city", array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	
		
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.state", "State", array("class"=>"span-5"));
		echo $this->Form->input("Member.state", array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.zip_code", "Zip Code", array("class"=>"span-5"));
		echo $this->Form->input("Member.zip_code", array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	
	echo $this->Form->input("sk", array("value"=>"billing", "type"=>"hidden"));
	
	echo "<div class='span-12 clear'>";
		echo $this->Ajax->submit("Save", array("url"=>"/members/update_account", "update"=>"billing_edit"));
	echo "</div>";
	echo $this->Form->end();
	?>
</div>