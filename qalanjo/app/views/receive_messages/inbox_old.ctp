
<div class="full_block">
<?php if ($action=="render"){?>
	<h1 class="section">Inbox</h1>
	<div id="control_top">
		<ul class='inline_command' id="inline_left_command">
			<li class="control_link"><?php echo $this->Ajax->link("All", "/receive_messages/inbox/".$member_id."/all/update", array("update"=>"messages"))?></li>
			<li class="control_link"><?php echo $this->Ajax->link("Unread", "/receive_messages/inbox/".$member_id."/unread/update", array("update"=>"messages"))?></li>
			<li class="control_link"><?php echo $this->Ajax->link("Read", "/receive_messages/inbox/".$member_id."/read/update", array("update"=>"messages"))?></li>
			<li class="control_link link_long"><?php echo $this->Ajax->link("Sent Items", "/receive_messages/inbox/".$member_id."/sent/update", array("update"=>"messages"))?></li>	
			<li class="control_link"><?php echo $this->Ajax->link("Trash", "/receive_messages/inbox/".$member_id."/trash/update", array("update"=>"messages"))?></li>	
		</ul>
		<ul class='inline_command' id="inline_right_command">
			<li class="control_link link_long2"><?php echo $this->Html->link("Write a message", "#", array("id"=>"writemessage", "onclick"=>"createDialog()"))?></li>
			<li><?php 
			echo $this->Form->create("PrivateMessage");
			echo $this->Ajax->submit(" ", array("url"=>"/private_messages/find", "update"=>"messages", "class"=>"marker_control", "div"=>false));
			echo $this->Form->input("PrivateMessage.query", array("type"=>"text", "id"=>"search_mail", "label"=>false, "div"=>false));
			echo $this->Form->end();
			?></li>
		</ul>
	</div>
	<div id='messages'>
		<?php echo $this->element("messaging/render_message", array("messages"=>$messages, "option"=>$option))?>
	</div>
	
	<?php 
		echo $this->element("compose_write",array("from_id"=>$member_id));
	?>
	<script type="text/javascript">
	//<![CDATA[
		<?php echo $this->element("scripts/autocomplete_messaging")?>
		<?php echo $this->element("scripts/messaging")?>
		$("#writeMessageDialog input:submit").button();
		autocomplete_member();
		autocomplete_searchmail();
		validation_writer();
	 //]]>
	</script>
<?php }else{
	echo $this->element("messaging/render_message", array("messages"=>$messages));
}
echo $this->Js->writeBuffer();
?>
</div>
