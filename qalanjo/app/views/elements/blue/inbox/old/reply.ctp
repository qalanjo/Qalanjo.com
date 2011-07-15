<?php
	foreach($message_replies as $reply){
			$writer_id = $reply["Sender"]["id"];
			$name = $reply["Sender"]["firstname"]." ".$reply["Sender"]["lastname"];
		?>
		
		<li>
			<?php 
				echo $this->Html->image("uploads/$writer_id/default/profile_thumb_".$reply["Sender"]["MemberProfile"]["picture_path"], array("class"=>"left profile-picture", "alt"=>$name))
			?>
			<div class="left name-message">
				<span class="name left"><?php echo $name?></span>
				<span class="message clear left"><?php 
					echo $reply["PrivateMessageReply"]["content"];
				?></span>
			</div>
			<span class="right time small">
				<?php 
					echo $this->AgoTime->time_since(strtotime($reply["PrivateMessageReply"]["created"]));
				?>
			</span>
		</li>	
		<?php 
	}
?>