<?php 
	$path = "designs/member/congrats/";

?>
<div class="left" id="content_header">
	<h2>Congratulations!</h2>
</div>
<div class="left" id="content_main">
	<div class="left" id="congratulations_box">
		<p class="left">
			<?php 
				echo $this->Html->image($path."check.gif", array("class"=>"left"));
			?>
		</p>                        
		<p class="left">
			An email has been dispatched for the activation.
		</p>
		<p class="left">
			You have succesfully taken the last step towards finding a successful relationship.
		</p>
		<p class="left">
			Welcome to <b>Qalanjo.com</b> - Road to Love.
		</p> 
	</div>
	<p class="image_set_bottom left">
		<?php 
			echo $this->Html->image($path."womanman1.jpg", array("class"=>"left"));
		?>
	</p>                         
	<p class="image_set_top left" style="margin: -250px 0 0 230px; padding: 0;">
		<span class="button">
			<button id="start" type="submit"><span>Start Viewing Your Match</span></button>
		</span>
	</p> 
</div>                  