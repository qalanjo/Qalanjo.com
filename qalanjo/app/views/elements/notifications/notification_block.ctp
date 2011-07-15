<div class="span-15 last" id="notification_content">
	<?php 
		$messages = array();
		foreach ($notifications as $notification){
			?>
				<div class="span-15 clear last notif_line">
					<div class="span-13">
						<?php echo $this->NotificationCompletor->transformMessage($notification)?>			
					</div>
					<div class="span-2 delete_notification last">
						<?php 
							$link = $this->Ajax->link("X", "/members/notification_delete/".$notification["Notification"]["id"], array("update"=>"notification_content"));
							echo "<span>$link</span>";
						?>
					</div>
				</div>	
			<?php 
		}
	?>
</div>
