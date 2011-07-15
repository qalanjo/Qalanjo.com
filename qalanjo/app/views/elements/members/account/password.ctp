<ul>
	<li>Do not use the same password that you use for other online accounts.</li>
	<li>Your new password must be at least 6 characters in length.</li>
	<li>Use a combination of letters, numbers, and punctuation.</li>
	<li>Passwords are case-sensitive. Remember to check your CAPS lock key.</li>
</ul>
<div class="form">
<?php 
	echo $this->Form->create("Member");
	echo $this->Form->input("Member.id");
	
	echo "<div class='span-12 last'>";
		echo $this->Form->label("Member.oldpassword", "Your old password", array("class"=>"span-5"));
		echo $this->Form->input("Member.oldpassword", array("type"=>"password", "label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.password", "Your new password", array("class"=>"span-5"));
		echo $this->Form->input("Member.password", array("type"=>"password", "label"=>false, "value"=>"", "div"=>"span-7 last"));
	echo "</div>";
	
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.confirm_password", "Confirm password", array("class"=>"span-5"));
		echo $this->Form->input("Member.confirm_password", array("type"=>"password", "label"=>false, "value"=>"", "div"=>"span-7 last"));
	echo "</div>";
	
	echo $this->Form->input("sk", array("value"=>"password", "type"=>"hidden"));
	echo "<div class='span-12 clear'>";
	
	echo $this->Ajax->submit("Save", array("url"=>"/members/update_account", "update"=>"password_edit"));
	echo "</div>";
	echo $this->Form->end();	
?>
</div>