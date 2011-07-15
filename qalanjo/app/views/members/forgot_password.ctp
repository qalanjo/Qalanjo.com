<?php 
	$this->Html->css("blue/forgot-password-1", "stylesheet", array("inline"=>false));
	$this->Javascript->link("blue/members/forgot-password", false);
?>
<h1 class="forgot">Having trouble signing in? We can help.</h1>
<div class="forgot-password-cap left">
	<h2>Account Information</h2>
	<p>We will send password reset instructions to the email address associated with your account.</p>
	<div class="shadow"></div>
</div>
<div class="left clear orange-side"></div>
<div class="left forgot-main-container">
	<?php echo $this->Form->create("Member", array("id"=>"forgot", "url"=>"/members/forgot_password"))?>
		<div class="forgot-form">
			<h3 class="required error">
				Sorry, there were problems with your input.<br/>
				<span id="error">User <span class="account">Danilo</span> Was Not Found</span>	
			</h3>
			<div class="spacer"></div>
			<ul class="choices">
				<li>
					<label class="choice">
						<input type="radio" class="radio-select-recover" name="radio" checked="checked" value="0"/>									
						<span class="label">I forgot my password</span>
					</label>
					<div class="label" id="emails">
						<dl class="choice">
							<dt>Your Qalanjo Email</dt>
							<dd>
							<?php echo $this->Form->input("forgot_email", array("class"=>"email", "id"=>"email-text", "div"=>false, "label"=>false))?>
							</dd>
						</dl>
						<hr/>
					</div>
				</li>
				<li>
					<label class="choice">
						<input type="radio" class="radio-select-recover" name="radio" value="1"/>
						<span class="label">I forgot my email</span>
					</label>
					<div class="label" id="alterns">
						<dl class="choice">
							<dt>Your alternate Email</dt>
							<dd>
							<?php echo $this->Form->input("alternate_email", array("class"=>"email", "id"=>"altern-email-text", "div"=>false, "label"=>false))?>
							</dd>	
						</dl>
					</div>
				</li>
			</ul>
				
		</div>
		<div class="buttonset">
			<div class="right">
				<button type="submit" id="send-instruction" class="send-instruction"></button>
				<button class="cancel" id="cancel"></button>
			</div>
		</div>
	<?php 
	echo $this->Form->input("state", array("type"=>"hidden", "id"=>"state"));	
	echo $this->Form->end()?>
</div>
<div class="left orange-side"></div>
<div class="form-shadow left clear"></div>
<div id="output"></div>