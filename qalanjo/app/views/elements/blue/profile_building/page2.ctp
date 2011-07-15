<?php 
	$this->Html->css(array("blue/profile_building/profile-building"), "stylesheet", array("inline"=>false));
	$this->Javascript->link(array("blue/members/profile_completion"), false);
?>
<div class="item-set-content left">
	<?php 
		echo $this->element("blue/profile_building/form");
		echo $this->element("blue/profile_building/questionset", array("order"=>array(1, 2), "name"=>"block-set-blue item-set-smoking"));
		echo $this->element("blue/profile_building/questionset", array("order"=>array(0, 3, 4), "name"=>"")); 
		echo $this->element("blue/profile_building/questionset", array("order"=>array(6, 5), "name"=>"block-set-blue item-set-maid"));
	?>
	<div class="button-set">
		<p>
			<strong>Thank you for answering all the questions.</strong> Kindly save and continue.
		</p>
		<button class="clear save-and-continue" type="submit">
		</button>
	</div>
	<?php echo $this->Form->end()?>
</div>