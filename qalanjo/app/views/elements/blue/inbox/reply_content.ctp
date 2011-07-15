<?php 
	$user = $message["PrivateMessage"]["Member"]["firstname"]." ".$message["PrivateMessage"]["Member"]["lastname"]; 
	$writer_id = $message["PrivateMessage"]["Member"]["id"];
	$profile = $this->requestAction("/member_profiles/find/".$writer_id);
?>
<div id="message-content-list" class="message-content-list">
	<div class="message-control left">
		<div class="left qmail-item">
			<span class="left">Message Sent To:</span> 
			<div class="left sender"><?php echo $user?></div>
		</div>
		<div class="right qmail-control-items">
			<ul>
				<li class="divider">
					<a href="#">Delete</a>
				</li>
				<li>
					<a href="#">Spam</a>
				</li>
			</ul>
		</div>
		
	</div>
	<ul id="replies_<?php echo $message["PrivateMessage"]["id"]?>" class="left message-content-list clear">
		<li class="left clear root">
			<div class="sender-picture left">
				<?php 
					echo $this->Html->image("uploads/$writer_id/default/profile_thumb_".$profile["MemberProfile"]["picture_path"],
					 array("alt"=>$user, "class"=>"left profile-picture"
					));	
				?>
			</div>
			<div class="profile-info left">
				<span class="name left"><?php echo $user?></span>
				<span class="message left clear small"><?php echo $message["PrivateMessage"]["content"]?></span>
			</div>
			<div class="right time">
				<?php echo $this->Time->timeAgoInWords($message["PrivateMessage"]["created"])?>
			</div>
		</li>
		<?php 
			echo $this->element("blue/inbox/reply");
		?>
	</ul>
	<div class="left clear messager">
		<div class="left clear messager-container">
		<?php 
			echo $this->Form->create("PrivateMessageReply", array("id"=>"reply_form_".$message["PrivateMessage"]["id"], "url"=>"/private_message_replies/writeMessage"));
			echo $this->Form->input("PrivateMessageReply.sender_id", array("type"=>"hidden", "value"=>$member_id));	
			echo $this->Form->input("PrivateMessageReply.to_id", array("value"=>$to_id, "type"=>"hidden"));
			echo $this->Form->input("PrivateMessageReply.private_message_id", array("value"=>$message["PrivateMessage"]["id"], "type"=>"hidden"));
		?>
			<div class="left clear container-textarea">
				<?php echo $this->Form->input("PrivateMessageReply.content", array("class"=>"left small replybox", "label"=>false, "div"=>false, "value"=>"Write a message..."));?>
			</div>
			<div class="left clear">
				<input type="checkbox" id="check_<?php echo $message["PrivateMessage"]["id"]?>" checked="checked"/>
				<?php echo $this->Html->image("/css/img/blue/inbox/arrow.png")?>
				<span class="instruction small"><em>Enable Enter Key to send the message</em></span>
			</div>
			<div class="right">
				<button id="reply" class="reply-button"></button>
			</div>
		<?php echo $this->Form->end()?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(".replybox").TextAreaExpander().live("keypress", function(e){
		var self = $(this);
		if ($("#check_<?php echo $message["PrivateMessage"]["id"]?>").is(":checked")){
			if (e.which == 13) {
				if ($.trim(self.html())!=""){
					$.post(qalanjo_url+"private_message_replies/writeMessage", $("#reply_form_<?php echo $message["PrivateMessage"]["id"]?>").serialize(), function(data){
								self.val("");
								$(data).appendTo("#replies_<?php echo $message["PrivateMessage"]["id"]?>").hide().fadeIn();
							});
				}else{
					alert("Please enter a message");
				}
				e.preventDefault();	
			}
		}
	}).addClass('inactive')
	.live("focus", function() {
		$(this).removeClass('inactive');
		if ($.trim($(this).val()) == 'Write a message...' || '') {
			$(this).val("");
		}
	}).live("blur", function() {
		var default_val = default_text;
		if ($.trim($(this).val()) == '') {
			$(this).addClass('inactive');
			$(this).val('Write a message...');
		}
	}).html("Write a message...");


</script>