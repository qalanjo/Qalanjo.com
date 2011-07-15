<div class="left clear header-cat">
	<p><span class="left title">Password</span>
	<span class="right">* Required Fields</span></p>
</div>

<div class="full left">					
	<div class="half-a left tar">
	<p>Your old password:</p>
	</div>
	<div class="half-a left input">
	<?php 
		echo $this->Form->input("Member.oldpassword", array("type"=>"password", "class"=>"span-6 tal", "div"=>false, "label"=>false));
		echo $this->Form->error("Member.oldpassword");
	?>
	</div>
</div>

<div class="full left">					
	<div class="half-a left tar">
	<p>New password:</p>
	</div>
	<div class="half-a left input">
	<?php 
		echo $this->Form->input("Member.password", array("class"=>"span-6 tal", "div"=>false, "label"=>false, "value"=>""));
		echo $this->Form->error("Member.password");
	?>
	</div>
</div>

<div class="full left">					
	<div class="half-a left tar">
	<p>Confirm new password:</p>
	</div>
	<div class="half-a left input">
	<?php 
		echo $this->Form->input("Member.confirm_password", array("type"=>"password","class"=>"span-6 tal", "div"=>false, "label"=>false));
		echo $this->Form->error("Member.confirm_password");
	?>
	</div>
</div>