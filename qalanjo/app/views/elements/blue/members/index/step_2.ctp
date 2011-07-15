<?php 
	$this->Html->css("blue/steps-initial", "stylesheet", array("inline"=>false));
?>
<div class="arrow-steps left">
	<div class="arrow-step arrow-step-1 left">
		<div class="number-1 left"></div>
		<h2 class="left">Profile Information</h2>
	</div>
	<div class="arrow-step arrow-step-2 left arrow-step-active">
		<div class="number-2 left"></div>
		<h2 class="left">About Me</h2>
	</div>
	<div class="arrow-step arrow-step-3 left">
		<div class="number-3 left"></div>
		<h2 class="left">Profile Picture</h2>
	</div>
</div>
<div class="header-cap left">
	<h1>About me</h1>
	<span class="instruction">This information will help you find your matches on Qalanjo</span>
	<div class="shadow"></div>
</div>
<div class="spacer left clear"></div>
<div class="form-content left">
	<?php
		echo $this->Form->create("Member", array("url"=>"/members/step/2"));	
	?>
	<?php echo $this->Form->input("Member.id", array("type"=>"hidden"))?>
	<?php echo $this->Form->input("MemberProfile.id", array("type"=>"hidden"))?>
	
		<div class="form-container left">
			<div class="form-about left">
					<dl class="left">
						<dt>
							I am passionate about:
						</dt>
						<dd>
							<?php echo $this->Form->input("MemberProfile.passionate_about", array("div"=>false, "label"=>false))?>
							
						</dd>
						<dt>
							I am looking for:
						</dt>
						<dd>
							<?php echo $this->Form->input("MemberProfile.looking_for_details", array("div"=>false, "label"=>false))?>
							
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