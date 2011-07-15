<p>Choose your new username carefully.</p>
<div class="form">
	<?php 
		echo $this->Form->create("Member");
		echo $this->Form->input("Member.id");
		echo "<div class='span-12 last'>";
			echo $this->Form->label("Member.username", "Your username", array("class"=>"span-5"));
			echo $this->Form->input("Member.username", array("label"=>false, "div"=>"span-7 last"));
		echo "</div>";
		echo $this->Form->input("sk", array("value"=>"username", "type"=>"hidden"));
		echo "<div class='span-12 clear'>";	
			echo $this->Ajax->submit("Check Availability", array("url"=>"/members/update_account", "update"=>"username_edit"));
		echo "</div>";
		echo $this->Form->end();	
	?>
</div>
