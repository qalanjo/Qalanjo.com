<div class="left" id="content_header">
	<h2>Career cont'</h2>
</div>
	<div class="left" id="content_main">
		<p class="instruction">Answer the question below</p>
		<p class="image_set_top right">
		<?php 
			$path = "designs/blue/members/profile_completion/page11/";
		?>
			<?php echo $this->Html->image($path."woman1.jpg", array("alt"=>"Woman", "class"=>"right"))?>
		</p>
		<div class="left" id="profile_completion_box">
		<p>
			Say something about your current job.
		</p>
		<p>
			<?php 
				echo $this->Form->input("MemberProfile.current_job", array("rows"=>"5", "cols"=>60, "div"=>false, "label"=>false));
			?>
		</p>                    
	</div>
	<div class="clear"></div>
	<p class="image_set_bottom left">
		<span class="button left">
			<button type="submit"><span>Save and Continue</span></button>
		</span>
	</p>
</div>				