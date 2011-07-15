<div class="activity-picture left">
	<?php 
		if (isset($wink["MemberProfile"]["picture_path"])||($wink["MemberProfile"]["picture_path"]!="")){
			echo $this->Html->image("uploads/".$wink["Winker"]["id"]."/default/profile_thumb_".$wink["MemberProfile"]["picture_path"], array("url"=>"/profile/".$wink["Winker"]["id"]));
		}else if ($wink["Winker"]["gender_id"]==1){
			echo $this->Html->image($path."match-default-photo.jpg", array("url"=>"/Winkers/profile/".$wink["Winker"]["id"]));
		}else{
			echo $this->Html->image($path."content-default-woman.jpg", array("url"=>"/Winkers/profile/".$wink["Winker"]["id"]));	
		}
	?>		
</div>
<div class="activity-content left">
	<div class="name-location no-bg left">														
		<h4 class="left"><?php echo $this->Html->link($wink["Winker"]["firstname"]." ".$wink["Winker"]["lastname"], "/profile/".$wink["Winker"]["id"])?> <span>winked at you</span></h4>
		
		<span class="location left clear"><?php echo $wink["Winker"]["state"].", ".$wink["Country"]["name"]?></span>		
	</div>
	<div class="activity-content-button-date left">
		<?php echo $this->Html->link("<span class='left'>Wink Back</span>", "#", array("class"=>"activity-content-button right winker", "id"=>"wink_{$wink["Winker"]["id"]}", "escape"=>false))?>
	</div>
</div>
	
<div class="shadow left clear">
	
</div>