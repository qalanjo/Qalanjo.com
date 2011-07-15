

<p>Please allow 24 hours for name changes to take effect.</p>
<div class="form">
<?php 
	echo $this->Form->create("Member");
	echo $this->Form->input("Member.id");
	echo "<div class='span-12 last'>";
		echo $this->Form->label("Member.firstname", "First Name", array("class"=>"span-5"));
		echo $this->Form->input("Member.firstname", array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.lastname", "Last Name", array("class"=>"span-5"));
		echo $this->Form->input("Member.lastname", array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	
	echo "<div class='span-12 clear'>";
		echo $this->Form->label("Member.middlename", "Middle Name (optional)", array("class"=>"span-5"));
		echo $this->Form->input("Member.middlename", array("label"=>false, "div"=>"span-7 last"));
	echo "</div>";
	echo $this->Form->input("sk", array("value"=>"name", "type"=>"hidden"));
	echo "<div class='span-12 clear'>";	
		echo $this->Ajax->submit("Save", array("url"=>"/members/update_account", "update"=>"name_edit", "div"=>"span-12 last"));
	echo "</div>";
	
	echo $this->Form->end();	
?>
</div>