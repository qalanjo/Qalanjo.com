<div class="left" id="messages">

</div>
<div class="left">
	<?php
		echo $this->Form->create("Chat", array("id"=>"chatter"));
		echo $this->Form->input("Chat.message");
		echo $this->Form->input("Chat.to_id", array("type"=>"hidden"));
		echo $this->Form->input("Chat.member_id", array("type"=>"hidden"));
	?>
		<button type="submit"><span>Send</span></button>
	<?php echo $this->Form->end()?>
</div>

