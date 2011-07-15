<div class="left" id="content_header">
		<h2>Crop the Picture</h2>
</div>

<div class="left" id="content_main">
	<?php echo $this->Html->image($filename_full, array("id"=>"cropbox"))?>
	<?php 
		echo $this->Form->create("MemberProfile", array("url"=>"/member_profiles/signup_upload_crop/".$filename));
		echo $this->Form->input("MemberProfile.x", array("type"=>"hidden", "id"=>"x"));
		echo $this->Form->input("MemberProfile.y", array("type"=>"hidden", "id"=>"y"));
		echo $this->Form->input("MemberProfile.width", array("type"=>"hidden", "id"=>"width"));
		echo $this->Form->input("MemberProfile.height", array("type"=>"hidden", "id"=>"height"));
	?>
		
		
		  <p class="image_set_bottom left">
		  	<span class="button left">
		  		<button type="submit"><span>Finish Cropping</span></button>
		  	</span>
		  </p>
	<?php 			
		echo $this->Form->end();
	?>		
</div>
