<div class="activity-picture left">
	<?php 
		if (isset($viewer["MemberProfile"]["picture_path"])||($viewer["MemberProfile"]["picture_path"]!="")){
			echo $this->Html->image("uploads/".$viewer["Viewer"]["id"]."/default/profile_thumb_".$viewer["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$viewer["Viewer"]["id"]));
		}else if ($viewer["Viewer"]["gender_id"]==1){
			echo $this->Html->image($path."match-default-photo.jpg", array("url"=>"/members/profile/".$viewer["Viewer"]["id"]));
		}else{
			echo $this->Html->image($path."content-default-woman.jpg", array("url"=>"/members/profile/".$viewer["Viewer"]["id"]));	
		}
	?>
</div>
<div class="activity-content left">
	<div class="name-location no-bg left">														
		<h4 class="left"><?php 
				echo $this->Html->link($viewer["Viewer"]["firstname"]." ".$viewer["Viewer"]["lastname"], "/members/profile/".$viewer["Viewer"]["id"]);	
			
			?>
			 <span class="small">viewed your profile.</span></h4>
		<span class="location left clear"><?php echo $viewer["Viewer"]["state"].", ".$viewer["Country"]["name"]?></span>		
	</div>
	<div class="activity-content-button-date left">
		<?php echo $this->Html->link("<span class='left'>View Profile</span>", "#", array("class"=>"activity-content-button right", "escape"=>false))?>
	
	</div>
	
</div>
	
<div class="shadow left clear">
	
</div>