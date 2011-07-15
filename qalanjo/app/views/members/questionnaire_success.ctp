<?php 
	$this->Html->css("blue/successpage", "stylesheet", array("inline"=>false));
	$this->Javascript->link("blue/members/questionnaire_success", false);
?>
<div class="item-set-female item-set-content left">
	<form id="form">
		<div class="button-set floatmargin">
			<div class="message right">
				<strong>Congratulations!</strong>
				<h2> we have found</h2>
				<h2>
				<span><?php $count?></span> matches for you
				</h2>
			</div>
			<div>
			</div>
			<button class="floatbutton right clear save-and-continue" id="floatbutton" type="submit">
			</button>
		</div>
	</form>
</div>