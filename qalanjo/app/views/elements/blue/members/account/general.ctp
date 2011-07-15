<?php 
	echo $this->Session->flash();
?>
<?php 
	echo $this->Form->create("Member", array("id"=>"member_account", "url"=>"/members/account/general"));
	echo $this->Form->input("Member.id");
?>
<div class="account-settings-content-header left">
	<h1 class="left">
		Name
	</h1>	
	<span class="left note clear">
		Your real name
	</span>									
</div>

<fieldset class="form left clear">

		<dl class="form-set">
			<dt>
				<span>
				First Name:
				</span>	
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("Member.firstname", array("class"=>"left", "div"=>false, "label"=>false))
				?>
				<label class="required"></label>
			</dd>
			<dt>
				<span>
				Last Name:
				</span>	
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("Member.lastname", array("class"=>"left", "div"=>false, "label"=>false))
				?>
				<label class="required"></label>
			</dd>
			<dt>
				<span>
					<abbr>*</abbr>
					Gender
				</span>
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("Member.gender_id", array("class"=>"left", "options"=>$genders,"div"=>false, "type"=>"select", "label"=>false))
				?>
				<label class="required"></label>
			</dd>
		</dl>
</fieldset>
<div class="account-settings-content-header left">
	<h1 class="left">
		Email
	</h1>	
	<span class="left note clear">
		Set your email contact information
	</span>									
</div>
<fieldset class="form left clear">
		<dl class="form-set">
			<dt>
				Your email:	
			</dt>
			<dd class="email">
				<?php 
					echo $this->data["Member"]["email"];
				?>
			</dd>
			<dt>
				<span>
					<abbr>*</abbr>
					New email
				</span>
				
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("Member.email", array("class"=>"left", "id"=>"email","div"=>false, "label"=>false, "value"=>false))
				?>	
				<label class="required"></label>
			</dd>
			<dt>
				<span>
					<abbr>*</abbr>
					Confirm email
				</span>
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("Member.confirm_email", array("class"=>"left", "id"=>"confirm-email", "div"=>false, "label"=>false))
				?>	
				<label class="required"></label>
			</dd>
			
		</dl>
</fieldset>

<div class="account-settings-content-header left">
	<h1 class="left">
		Password
	</h1>	
	<span class="left note clear">
		What you use to login
	</span>									
</div>

<fieldset class="form left clear">
		<dl class="form-set">
			<dt>			
				<span>
					<abbr>*</abbr>
					Old Password:	
				</span>
			</dt>
			<dd class="email">
				<?php 
					echo $this->Form->input("Member.oldpassword", array("class"=>"left", "div"=>false, "id"=>"old-password","type"=>"password", "label"=>false))
				?>	
				<label class="required"></label>
			</dd>
			<dt>
				<span>
					<abbr>*</abbr>
					New Password
				</span>
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("Member.password", array("class"=>"left", "div"=>false, "id"=>"new-password","label"=>false, "type"=>"password", "value"=>""))
				?>
				<label class="required"></label>
			</dd>
			<dt>
				<span>
					<abbr>*</abbr>
					Confirm password
				</span>
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("Member.confirm_password", array("class"=>"left", "id"=>"confirm-password","div"=>false, "label"=>false, "type"=>"password", "value"=>""))
				?>
				<label class="required"></label>
			</dd>
		</dl>
		<div class="submit-condense right">
			<button class="submit-button left" type="submit"></button>
		</div>
		
</fieldset>
<?php echo $this->Form->end()?>
<?php echo $this->Javascript->link("blue/members/account_general")?>