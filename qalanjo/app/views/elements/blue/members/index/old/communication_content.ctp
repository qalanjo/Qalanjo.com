<?php 
	/**
	 * Communication Content for Member Index
	 * @version 0.0.1
	 * @date 5/21/2011
	 * 
	 */

?>

<ul>
	<?php
		$count = count($loadedMessages)+count($winks)+count($sentIceBreakers);
		$path = "designs/blue/members/index/";
		$i = 0;
		foreach($loadedMessages as $message){
			?>
			<li>
				<div class="content-list-item">
					<div class="content-image-holder">
						<?php 
							if (isset($message["MemberProfile"]["picture_path"])||($message["MemberProfile"]["picture_path"]!="")){
								echo $this->Html->image("uploads/".$message["Member"]["id"]."/default/profile_thumb_".$message["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$message["Member"]["id"]));
							}else if ($message["Member"]["gender_id"]==1){
								echo $this->Html->image($path."match-default-photo.jpg", array("url"=>"/members/profile/".$message["Member"]["id"]));
							}else{
								echo $this->Html->image($path."content-default-woman.jpg", array("url"=>"/members/profile/".$message["Member"]["id"]));	
							}
						?>		
					</div>
					<div class="content-list-item-details">
						<div class="content-info-container">
							<h4>
							<?php echo $this->Html->link($message["Member"]["firstname"], "/members/profile/".$message["Member"]["id"])?>
							 sent you a message</h4>
							<h5><?php echo $message["Member"]["state"].", ".$message["Country"]["name"]?></h5>
						</div>
						<div class="content-controls-container">
							<?php echo $this->Html->link("Show Message", "/private_messages/read/".$message["ReceiveMessage"]["id"], array("class"=>"activity-content-listitem-button"))?>
								
							<a class="activity-content-listitem-button" href="#">Show Message</a>
							<span class="date-send"><?php echo $this->AgoTime->dateMe($message["PrivateMessage"]["created"])?></span>
						</div>
						<div class="content-shoutbox-container">
							<div class="content-shoutbox">
								<?php 
									$latestReply = $this->requestAction("/private_message_replies/latestReply/".$message["PrivateMessage"]["id"]);
									if (!empty($latestReply)){
										echo $latestReply["PrivateMessageReply"]["content"];
									}else{
										echo $message["PrivateMessage"]["content"];
									}
								?>
							</div>
						</div>
					</div>
					
				</div>
			</li>
			<?php 
			$i++;
			if ($i==$limit){
				break;
			}
		}
	?>
	
	
	<?php
		if ($i!=$limit){
			foreach($winks as $wink){
				
				?>
				<li>
					<div class="content-list-item">
						<div class="content-image-holder">
							<?php 
								if (isset($wink["MemberProfile"]["picture_path"])||($wink["MemberProfile"]["picture_path"]!="")){
									echo $this->Html->image("uploads/".$wink["Winker"]["id"]."/default/profile_thumb_".$wink["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$wink["Winker"]["id"]));
								}else if ($wink["Winker"]["gender_id"]==1){
									echo $this->Html->image($path."match-default-photo.jpg", array("url"=>"/members/profile/".$wink["Winker"]["id"]));
								}else{
									echo $this->Html->image($path."content-default-woman.jpg", array("url"=>"/members/profile/".$wink["Winker"]["id"]));	
								}
							?>		
						
						</div>
						<div class="content-list-item-details">
							<div class="content-info-container-no-pointer">
								<h4>
								
							
							<?php echo $this->Html->link($wink["Winker"]["firstname"], "/members/profile/".$wink["Winker"]["id"])?> winked at you</h4>
								<h5><?php echo $wink["Winker"]["state"].", ".$wink["Country"]["name"]?></h5>
							</div>
							<div class="content-controls-container">
								<a class="activity-content-listitem-button winker" id="wink_<?php echo $wink["Winker"]["id"]?>" href="#">Wink Back</a>
								<span class="date-send"><?php echo $this->AgoTime->dateMe($wink["Wink"]["created"])?></span>
							</div>
						</div>
					</div>
				</li>
				<?php 
				$i++;
				if ($i==$limit){
					break;
				}
			}
				
		}
	
	?>
	<?php 
		
		if ($i!=$limit){
			foreach($sentIceBreakers as $breaker){
				
				?>
				<li>
					<div class="content-list-item">
						<div class="content-image-holder">
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
						<div class="content-list-item-details">
							<div class="content-info-container">
								<h4><a href="#"><?php echo $breaker["Member"]["firstname"]?></a> sent an icebreaker</h4>
								<h5><?php echo $breaker["Member"]["state"].", ".$breaker["Country"]["name"]?></h5>
							</div>
							<div class="content-controls-container">
								<a class="activity-content-listitem-button" href="#">View Icebreaker</a>
								<span class="date-send"><?php echo $this->AgoTime->dateMe($breaker["SentIceBreaker"]["created"])?></span>
							</div>
						</div>
						<div class="content-shoutbox-container">
							<div class="content-shoutbox">
								<?php 
									echo $breaker["IceBreaker"]["value"];
								?>
							</div>
						</div>
					</div>
				</li>
				<?php 
				$i++;
				if ($i==$limit){
					break;
				}
			}
				
		}
	?>
	
	
	<?php 
		if ($limit==3){
	?>
		<li>
			<div class="view-all">
				<a href="#" id="view_all_communications_link">View All Communications (<?php echo $count?>)</a>
			</div>
		</li>
	<?php 
		}
	?>
	
</ul>