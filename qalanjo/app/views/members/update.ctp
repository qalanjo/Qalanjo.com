<div class="inner_block">
<?php 
	echo $this->Form->create("MemberProfile");
	echo $this->Form->input("MemberProfile.id");
	echo $this->Form->label("MemberProfile.$field", "What is on your mind right now?");
	echo "<div class='status'>";
	echo $this->Form->input("MemberProfile.$field", array("label"=>false, "div"=>false));
	echo "</div>";
	echo $this->Ajax->submit("Save", array("url"=>"/members/update", "update"=>"status-content"));
	echo $this->Form->end();
?>
</div>