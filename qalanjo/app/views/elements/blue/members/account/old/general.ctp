<div class="left clear header-cat">
	<p><span class="left title">General Information</span>
	<span class="right">* Required Fields</span></p>
</div>
<div class="full left">					
	<div class="half-a left tar">
	<p>*First Name:</p>
	</div>
	<div class="half-a left input">
	<?php 
		echo $this->Form->input("Member.firstname", array("class"=>"span-6 tal", "div"=>false, "label"=>false))
	?>
	</div>
</div>

<div class="full left">					
	<div class="half-a left tar">
	<p>*Last Name:</p>
	</div>
	<div class="half-a left input">
	<?php 
		echo $this->Form->input("Member.lastname", array("class"=>"span-6 tal", "div"=>false, "label"=>false))
	?>
	</div>
</div>

<div class="full left">					
	<div class="half-a left tar">
	<p>*Gender:</p>
	</div>
	<div class="half-a left input">
	<?php 
		echo $this->Form->input("Member.gender_id", array("class"=>"span-6 tal", "options"=>$genders,"div"=>false, "type"=>"select", "label"=>false))
	?>
	</div>
</div>



<div class="full left">					
	<div class="half-a left tar">
	<p>*Email:</p>
	</div>
	<div class="half-a left text">
		<p>
			<?php 
				echo $this->data["Member"]["email"]." ";
				echo $this->Html->link("Edit","/members/account/email");
			?>
		</p>
		
	</div>
</div>
