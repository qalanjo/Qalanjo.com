<div class="left icebreaker-profile-info">
	<div class="profile-picture left">
		<div class="profile-picture-bg left">
			<?php 
				if (isset($view_member["MemberProfile"]["picture_path"])||($view_member["MemberProfile"]["picture_path"]!="")){
					echo $this->Html->image("uploads/".$view_member["Member"]["id"]."/default/profile_thumb_".$view_member["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$view_member["Member"]["id"]));
				}else{
					if ($view_member["Member"]["gender_id"]==1){
						echo $this->Html->image($path."default.jpg", array("url"=>"/view_members/profile/".$view_member["Member"]["id"]));
					}else{
						echo $this->Html->image($path."woman-default-picture.jpg", array("url"=>"/view_members/profile/".$view_member["Member"]["id"]));
					}
				}
			?>
		</div>
	</div>
	<div class="profile-info left">
		<h4 class="left">
			<?php echo $view_member["Member"]["firstname"]." ".$view_member["Member"]["lastname"]?>
		</h4>
		<span class="left clear age">
			<?php echo $age?> years old.
		</span>
		<?php if (($view_member["Member"]["address1"]!="")&&($view_member["Member"]["address2"]!="")&&($view_member["Member"]["city"]!="")){?>
			<span class="left clear location">
				<?php echo $view_member["Member"]["address1"].", ".$view_member["Member"]["address2"].", ".$view_member["Member"]["city"]?>
			</span>
		<?php }?>
		<span class="left clear location">
			<?php echo $view_member["Member"]["state"].", ".$view_member["Country"]["name"]?>
		</span>
	</div>
</div>

<div class="right icebreaker-form clear">
	<?php
		echo $this->Form->create("SentIceBreaker", array("id"=>"breaker_form"));
		echo $this->Form->label("SentIceBreaker.ice_breaker_id", "Ice breaker", array("class"=>"left"));
		echo $this->Form->input("SentIceBreaker.ice_breaker_id", array(
							"type"=>"select", "options"=>$breakers,
							 "div"=>false, "label"=>false, "class"=>"left"));
		echo $this->Form->input("SentIceBreaker.to_id", array(
							"type"=>"hidden","value"=>$view_id));
		echo $this->Form->input("SentIceBreaker.member_id", array(
							"type"=>"hidden","value"=>$member_id));
		echo $this->Form->end();
	?>
</div>
