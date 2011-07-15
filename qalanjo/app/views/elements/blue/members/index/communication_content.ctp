<?php 
	/**
	 * Communication Content for Member Index
	 * @version 0.0.1
	 * @date 6/17/2011
	 * 
	 */

?>
<ul class="left">
	<?php
		$count = count($loadedMessages)+count($winks)+count($sentIceBreakers);
		$path = "designs/blue/members/index/";
		$i = 0;
		foreach($loadedMessages as $message){
			?>
			<li>
				<div class="activity-picture left">
					<?php 
						if (isset($message["MemberProfile"]["picture_path"])||($message["MemberProfile"]["picture_path"]!="")){
							echo $this->Html->image("uploads/".$message["Member"]["id"]."/default/profile_thumb_".$message["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$message["Member"]["id"]));
						}else if ($message["Member"]["gender_id"]==1){
							echo $this->Html->image($path."s-men.jpg", array("url"=>"/members/profile/".$message["Member"]["id"]));
						}else{
							echo $this->Html->image($path."dontent-default-woman.jpg", array("url"=>"/members/profile/".$message["Member"]["id"]));	
						}
					?>		
				</div>
				<div class="activity-content left">
					<div class="name-location left">														
						<h4 class="left"><?php echo $this->Html->link($message["Member"]["firstname"]." ".$message["Member"]["lastname"], "/profile/".$message["Member"]["id"])?></h4>
						<span class="location left clear">
						<?php 
						if ($message["Member"]["state"]!=""){
							echo $message["Member"]["state"].", ".$message["Country"]["name"];
						}else{
							echo $message["Country"]["name"];
						}?></span>		
					</div>
					<div class="activity-content-button-date left">
						<?php echo $this->Html->link("<span class='left'>Show Message</span>", "/private_messages/read/".$message["ReceiveMessage"]["id"], array("class"=>"activity-content-button right", "escape"=>false))?>
						<span class="time right clear"><?php echo $this->Time->timeAgoInWords($message["ReceiveMessage"]["created"])?></span>
					</div>
					<div class="message-stream clear left">
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
					
				<div class="shadow left clear"></div>
			</li>
			
		<?php
			$i++;
			if ($i==$limit){
				break;
			}
		}
		if ($i!=$limit){
			foreach($winks as $wink){
				
		?>
			<li>
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
						
						<span class="location left clear"><?php 
						if ($wink["Winker"]["state"]!=""){
							echo $wink["Winker"]["state"].", ".$wink["Country"]["name"];
						}else{
							echo $wink["Country"]["name"];
						
						}?></span>		
					</div>
					<div class="activity-content-button-date left">
						<?php echo $this->Html->link("<span class='left'>Wink Back</span>", "#", array("class"=>"activity-content-button right winker", "id"=>"wink_{$wink["Winker"]["id"]}", "escape"=>false))?>
						<span class="time right clear"><?php echo $this->Time->timeAgoInWords($wink["Wink"]["created"])?></span>
					</div>
				</div>
					
				<div class="shadow left clear"></div>
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
						<span class="location left clear">
						<?php 
							if ($breaker["Member"]["state"]!=""){
								echo $breaker["Member"]["state"].", ".$breaker["Country"]["name"];
							}else{
								echo $breaker["Country"]["name"];
							}?></span>		
					</div>
					<div class="activity-content-button-date left">
						<?php echo $this->Html->link("<span class='left'>Show Icebreaker</span>", "#", array("class"=>"activity-content-button right", "escape"=>false))?>
						<span class="time right clear"><?php echo $this->Time->timeAgoInWords($breaker["SentIceBreaker"]["created"])?></span>
					</div>
					<div class="message-stream clear left">
						<p>
							<?php 
								echo $breaker["IceBreaker"]["value"];
							?>
						</p>
					</div>
						
				</div>
					
				<div class="shadow left clear"></div>
			</li>
	
			<?php 
				$i++;
				if ($i==$limit){
					break;
				}
			}
		}
	?>
	<li class="last">
		<div class="view-all">
			<a href="#" id="view_all_communications_link">View All Communications (<?php echo $count?>)</a>
		</div>
	</li>
</ul>