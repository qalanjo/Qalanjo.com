<?php 
	foreach($matches as $match){
		$name = $match["Matched"]["firstname"]." ".$match["Matched"]["lastname"];
		?>
		<li id="match_<?php echo $match["Matched"]["id"]?>" class="match-list-item clear">
			<?php 
				echo $this->Html->image("uploads/{$match["Matched"]["id"]}/default/profile_thumb_".$match["Matched"]["MemberProfile"]["picture_path"], array("class"=>"left profile-picture", "alt"=>$name))
			?>
			<div class="left name-message">
				<span class="name left"><?php echo $name?></span>
			</div>
		</li>
		<?php 	
	}
?>