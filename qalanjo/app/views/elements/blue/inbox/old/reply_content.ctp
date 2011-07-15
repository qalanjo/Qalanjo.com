<ul id="replies" class="replies">
	<li class="root">
		<?php
			$user = $message["PrivateMessage"]["Member"]["firstname"]." ".$message["PrivateMessage"]["Member"]["lastname"]; 
			$writer_id = $message["PrivateMessage"]["Member"]["id"];
			$profile = $this->requestAction("/member_profiles/find/".$writer_id);
			echo $this->Html->image("uploads/$writer_id/default/profile_thumb_".$profile["MemberProfile"]["picture_path"],
					 array("alt"=>$user, "class"=>"left profile-picture"
					));	
		?>
		<div class="left name-message">
			<span class="name left"><?php echo $user?></span>
			<span class="message clear left"><?php 
				echo $message["PrivateMessage"]["content"];
			?></span>
		</div>
		<span class="right time small">
			<?php 
				echo $this->AgoTime->time_since(strtotime($message["PrivateMessage"]["created"]));
			?>
		</span>
	</li>
	<?php 
		echo $this->element("blue/inbox/reply");
	?>
	
</ul>
<div class="replybox left">
	<?php 
		echo $this->Form->create("PrivateMessageReply", array("id"=>"reply_form", "action"=>"add"));
		echo $this->Form->input("PrivateMessageReply.content", array("class"=>"left replybox", "label"=>false, "div"=>false, "value"=>"Write a message..."));
		echo $this->Form->input("PrivateMessageReply.sender_id", array("type"=>"hidden", "value"=>$member_id));	
		echo $this->Form->input("PrivateMessageReply.to_id", array("value"=>$to_id, "type"=>"hidden"));
		echo $this->Form->input("PrivateMessageReply.private_message_id", array("value"=>$message["PrivateMessage"]["id"], "type"=>"hidden"));
		
		echo $this->Form->end();
	?>
	<span class="instruction left clear">
		Press <strong>Enter</strong> to send message.
	</span>
					
</div>
<script type="text/javascript">
//<![CDATA[
	$("#header").text("<?php echo $message["PrivateMessage"]["title"]?>");
//]]>
</script>
<?php echo $this->Js->writeBuffer();?>