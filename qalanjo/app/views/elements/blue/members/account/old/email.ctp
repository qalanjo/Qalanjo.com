<div class="left clear header-cat">
	<p><span class="left title">Email Address</span>
	<span class="right">* Required Fields</span></p>
</div>

<div class="full left">					
	<div class="half-a left tar">
	<p>Your email address:</p>
	</div>
	<div class="half-a left input">
	<?php 
		echo $this->Form->input("Member.email", array("class"=>"span-6 tal", "div"=>false, "label"=>false))
	?>
	</div>
</div>

<div class="full left">					
	<div class="half-a left tar">
	<p>Confirm email address:</p>
	</div>
	<div class="half-a left input">
	<?php 
		echo $this->Form->input("Member.confirmemail", array("class"=>"span-6 tal", "div"=>false, "label"=>false))
	?>
	</div>
</div>