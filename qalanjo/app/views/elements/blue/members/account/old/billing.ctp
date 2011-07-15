




<div class="left clear header-cat">
		<p><span class="left title">Billing Address</span>
		<span class="right">* Required Fields</span></p>
	</div>
	
	<div class="full left">					
		<div class="half-a left tar">
		<p>Street Address:</p>
		</div>
		<div class="half-a left input">
		<?php 
			echo $this->Form->input("Member.address1", array("class"=>"span-6 tal", "div"=>false, "label"=>false))
		?>
		</div>
	</div>
	
	<div class="full left">					
		<div class="half-a left tar">
		<p>Street Address 2:</p>
		</div>
		<div class="half-a left input">
		<?php 
			echo $this->Form->input("Member.address2", array("class"=>"span-6 tal", "div"=>false, "label"=>false))
		?>
		</div>
	</div>
	
	<div class="full left">					
		<div class="half-a left tar">
		<p>City:</p>
		</div>
		<div class="half-a left input">
		<?php 
			echo $this->Form->input("Member.city", array("class"=>"span-6 tal", "div"=>false, "label"=>false))
		?>
		</div>
	</div>
	
	<div class="full left">					
		<div class="half-a left tar">
		<p>*ZIP Code/Postal Code</p>
		</div>
		<div class="half-a left input">
		<?php 
			echo $this->Form->input("Member.zipcode", array("class"=>"span-6 tal", "div"=>false, "label"=>false))
		?>
		</div>
	</div>
	
	<div class="full left">					
		<div class="half-a left tar">
		<p>*State/Province</p>
		</div>
		<div class="half-a left input">
		<?php 
			echo $this->Form->input("Member.state", array("class"=>"span-6 tal", "div"=>false, "label"=>false))
		?>
		</div>
	</div>
	
	
	<div class="full left">					
		<div class="half-a left tar">
		<p>*Country:</p>
		</div>
		<div class="half-a left input">
		<?php 
			echo $this->Form->input("Member.country_id", array("class"=>"span-6 tal", "type"=>"select", "options"=>$countries,  "div"=>false, "label"=>false))
		?>
	</div>
	
	
</div>
