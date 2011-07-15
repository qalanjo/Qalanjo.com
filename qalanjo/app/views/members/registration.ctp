<div class="members form">
<?php echo $this->Form->create('Member');?>
	<fieldset>
 		<legend><?php __('Add Member'); ?></legend>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('birthdate');
		echo $this->Form->input('firstname');
		echo $this->Form->input('lastname');
		echo $this->Form->input('country_id');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('street');
		echo $this->Form->input('looking_for');
		echo $this->Form->input('AttributeOption');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
