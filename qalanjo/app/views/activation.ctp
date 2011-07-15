<div id="centercontent">
	<div id="main_display">
		<div id="signup">
			<h1>Sign Up</h1>
			<span class='subheader'>Find your match for <strong>FREE</strong></span>
			<fieldset>
			<?php 
				echo $this->Session->flash();
				echo $this->Form->create("Member",array('url'=>array('controller'=>'members','action'=>'activation')));
				echo $this->Form->input('activation_email');
				echo $this->Form->input("activate_code", array("label"=>"Activation Code:", "div"=>"input"));
				echo $this->Form->end('Submit');
			?>
			</fieldset>
		</div>
	</div>
</div>