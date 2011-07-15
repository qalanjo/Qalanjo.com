<?php 
	$this->Html->css("blue/steps-initial", "stylesheet", array("inline"=>false));
	$this->Javascript->link("blue/members/step-1", false);
?>
<div class="arrow-steps left">
	<div class="arrow-step arrow-step-1 left arrow-step-active">
		<div class="number-1 left"></div>
		<h2 class="left">Profile Information</h2>
	</div>
	<div class="arrow-step arrow-step-2 left">
		<div class="number-2 left"></div>
		<h2 class="left">About Me</h2>
	</div>
	<div class="arrow-step arrow-step-3 left">
		<div class="number-3 left"></div>
		<h2 class="left">Profile Picture</h2>
	</div>
</div>
<div class="header-cap left">
	<h1>Fill out your Profile Info</h1>
	<span class="instruction">This information will help you find your matches on Qalanjo</span>
	<div class="shadow"></div>
</div>
<div class="spacer left clear"></div>
<div class="form-content left">
	<?php echo $this->Form->create("Member", array("url"=>"/members/step/1", "id"=>"step-1"))?>
	<?php echo $this->Form->input("Member.id", array("type"=>"hidden"))?>
	<?php echo $this->Form->input("MemberProfile.id", array("type"=>"hidden"))?>
		<div class="form-container left">
			<div class="form-profile left">
					<dl class="left">
						<dt class="left">
							Country
						</dt>
						<dd class="left">
							<?php 
								echo $this->Form->input("Member.country_id", array("options"=>$countries, "div"=>false, "label"=>false, "id"=>"country","type"=>"select", "selected"=>"United States"));
							?>
							<label class="required clear">
                        	</label>
						</dd>
						<dt class="left clear">
							State
						</dt>
						<dd class="left">
							<?php 
								echo $this->Form->input("Member.state", array("options"=>$states, "div"=>false, "label"=>false, "type"=>"select", "id"=>"state"));
							?>
							<label class="required clear">
                        	</label>
						</dd>
						<dt class="left clear">
							Zip Code
						</dt>
						<dd class="left">
							<?php echo $this->Form->input("Member.zipcode", array("class"=>"zipcode", "div"=>false, "label"=>false, "id"=>"zipcode"))?>
							<label class="required clear">
	                        </label>
						</dd>
						
					</dl>
					 
			</div>	
		</div>
		<div class="buttonset right">
			<button class="continue"></button>
		</div>
		
	<?php echo $this->Form->end()?>
</div>
<div class="spacer left"></div>