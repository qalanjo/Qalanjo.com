<?php
	foreach($message_replies as $reply){
			$writer_id = $reply["Sender"]["id"];
			$name = $reply["Sender"]["firstname"]." ".$reply["Sender"]["lastname"];
		?>
		<li class="left clear">
			<div class="sender-picture left">
				<?php 
					echo $this->Html->image("uploads/$writer_id/default/profile_thumb_".$reply["Sender"]["MemberProfile"]["picture_path"], array("class"=>"left profile-picture", "alt"=>$name))
				?>
			</div>
			<div class="profile-info left">
				<span class="name left"><?php echo $name?></span>
				<span class="message left clear small"><?php echo nl2br($reply["PrivateMessageReply"]["content"]);?></span>
			</div>
			<div class="right time">
				<?php echo $this->Time->timeAgoInWords($reply["PrivateMessageReply"]["created"])?>
			</div>
		</li>
<?php }?>