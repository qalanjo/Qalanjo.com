<?php 
	$this->Html->css("blue/forgot-password-1", "stylesheet", array("inline"=>false));
?>
<h1 class="forgot">Having trouble signing in? We can help.</h1>
<div class="forgot-password-cap left">
	<h2 class="forgot-success">Account Information</h2>
	<p>We emailed you a link and instructions for updating your password.</p>
	<div class="shadow"></div>
</div>
<div class="left clear orange-side"></div>
<div class="left forgot-main-container">
	<div class="center-forgot">
		<div class="forgot-success">
			<h1 class="blue-message">It should be there momentarily. <br/>Please check your email and click the link in the message.</h1>
			<div class="success-check"></div>
			<?php echo $this->Html->link(" ", "/members/login", array("class"=>"continue-sign-in"))?>
		</div>	
	</div>
	
</div>
<div class="left orange-side"></div>
<div class="form-shadow left clear"></div>