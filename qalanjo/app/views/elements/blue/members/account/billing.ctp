<?php 
	echo $this->Session->flash();
?>
<?php 
	echo $this->Form->create("Member", array("id"=>"member_billing", "url"=>"/members/account/billing"));
	echo $this->Form->input("Member.id");
?>
<div class="account-settings-content-header left">
	<h1 class="left">
		Address
	</h1>	
	<span class="left note clear">
		Your current location
	</span>									
</div>

<fieldset class="form left clear">
	<form action="#">
		<dl class="form-set">
			<dt>			
				<span>
					<abbr>*</abbr>
					Street Address 1:	
				</span>
			</dt>
			<dd class="email">
				<?php 
				echo $this->Form->input("Member.address1", array("class"=>"left", "div"=>false, "label"=>false))
				?>
			</dd>
			<dt>
				<span>
					<abbr>*</abbr>
					Street Address 2:
				</span>
			</dt>
			<dd>
				<?php 
				echo $this->Form->input("Member.address2", array("class"=>"left", "div"=>false, "label"=>false))
				?>
			</dd>
			<dt>
				<span>
					<abbr>*</abbr>
					City:
				</span>
			</dt>
			<dd>
				<?php 
				echo $this->Form->input("Member.city", array("class"=>"left", "div"=>false, "label"=>false))
				?>	
			</dd>
			<dt>
				<span>
					<abbr>*</abbr>
					State:
				</span>
			</dt>
			<dd>
				<?php 
				echo $this->Form->input("Member.state", array("class"=>"left", "div"=>false, "label"=>false))
				?>	
			</dd>
			<dt>
				<span>
					<abbr>*</abbr>
					Country:
				</span>
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("Member.country_id", array("class"=>"span-6 tal", "type"=>"select", "options"=>$countries,  "div"=>false, "label"=>false))
				?>
			</dd>
		</dl>
		<div class="submit-condense right">
			<button class="submit-button left" type="submit"></button>
		</div>
		
</fieldset>
<?php echo $this->Form->end()?>

<?php echo $this->Javascript->link("blue/members/account_billing")?>