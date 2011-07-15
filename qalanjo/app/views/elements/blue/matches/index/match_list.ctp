<?php 
	/**
	 * Loaded the match list
	 * @version 0.0.1
	 * @date 5/23/2011
	 * 
	 */	
	$path = "designs/blue/members/index/";
?>

<ul>
	<li class="header">
		<div>Match Details</div>
		<div>Communication Stage</div>
		<div>Next Steps</div>
	</li>
	<?php 
		foreach($matches as $match){
			?>
			<li>
				<div class="match-details">
					<div class="matches-list-image-holder">
						<?php 
						
							if (isset($match["MemberProfile"]["picture_path"])||($match["MemberProfile"]["picture_path"]!="")){
								echo $this->Html->image("uploads/".$match["Matched"]["id"]."/default/profile_thumb_".$match["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$match["Matched"]["id"]));
							}else if ($match["Matched"]["gender_id"]==1){
								echo $this->Html->image($path."match-default-photo.jpg", array("url"=>"/members/profile/".$match["Matched"]["id"]));
							}else{
								echo $this->Html->image($path."content-default-woman.jpg", array("url"=>"/members/profile/".$match["Matched"]["id"]));	
							}
						?>
					</div>
					<div class="matches-list-details">
						<div class="personal-info">
							<?php 
								echo $this->Html->link($match["Matched"]["firstname"], "/members/profile/".$match["Matched"]["id"]);
							?>
							<span class="age">, <?php echo $match["Matched"]["age"]?> </span>
							<span class="match-status">
							<?php 
								if ($this->AgoTime->dateMe($match["Match"]["created"])=="Today"){
									echo "NEW";
								
								}
							?></span>
						</div>
						<div class="address">
							<span><?php echo $match["Matched"]["state"]?>, <?php echo $match["Country"]["name"]?></span>
						</div>
						<div class="date">
							<span>match on: <?php echo date("F d, Y", strtotime($match["Match"]["created"]))?></span>
						</div>
					</div>
				</div>
				<div class="communication-stage">
					<?php 
						echo $this->Html->link($match["MatchStatus"]["value"], "#");
					?>
				</div>
				<div class="next-steps">
					<?php 
						echo $this->Html->link("View Match Detail", "/members/profile/".$match["Matched"]["id"]);
					?>
				</div>
			</li>
			<?php 
		}
	?>
</ul>