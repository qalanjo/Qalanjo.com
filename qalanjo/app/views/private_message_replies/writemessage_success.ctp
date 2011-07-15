<?php 
	$writer_id = $reply["PrivateMessageReply"]["sender_id"];
	$name = $reply["Sender"]["firstname"]." ".$reply["Sender"]["lastname"];
	$profile = $this->requestAction("/member_profiles/find/".$writer_id);
?>
<li class="left clear">
	<div class="sender-picture left">
		<?php 
			echo $this->Html->image("uploads/$writer_id/default/profile_thumb_".$profile["MemberProfile"]["picture_path"], array("class"=>"left profile-picture", "alt"=>$name))	
		?>
	</div>
	<div class="profile-info left">
		<span class="name left"><?php echo $name?></span>
		<span class="message left clear small"><?php echo $reply["PrivateMessageReply"]["content"];?></span>
	</div>
	<div class="right time">
		<?php echo $this->Time->timeAgoInWords($reply["PrivateMessageReply"]["created"])?>
	</div>
</li>