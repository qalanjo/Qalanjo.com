<div class="activity-picture left">
	<?php 
		if (isset($breaker["MemberProfile"]["picture_path"])||($breaker["MemberProfile"]["picture_path"]!="")){
			echo $this->Html->image("uploads/".$breaker["Member"]["id"]."/default/profile_thumb_".$breaker["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$breaker["Member"]["id"]));
		}else if ($breaker["Member"]["gender_id"]==1){
			echo $this->Html->image($path."match-default-photo.jpg", array("url"=>"/members/profile/".$breaker["Member"]["id"]));
		}else{
			echo $this->Html->image($path."content-default-woman.jpg", array("url"=>"/members/profile/".$breaker["Member"]["id"]));	
		}
	?>		
</div>
<div class="activity-content left">
	<div class="name-location left">														
		<h4 class="left"><?php echo $this->Html->link($breaker["Member"]["firstname"]." ".$breaker["Member"]["lastname"], "/profile/".$breaker["Member"]["id"])?></h4>
		<span class="location left clear"><?php echo $breaker["Member"]["state"].", ".$breaker["Country"]["name"]?></span>		
	</div>
	<div class="activity-content-button-date left">
		<?php echo $this->Html->link("<span class='left'>Show Icebreaker</span>", "#", array("class"=>"activity-content-button right", "escape"=>false))?>
	</div>
	<div class="message-stream clear left">
		<p>
			<?php 
				echo $breaker["IceBreaker"]["value"];
			?>
		</p>
	</div>
		
</div>
	
<div class="shadow left clear">
	
</div>