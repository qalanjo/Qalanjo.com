<?php
if (!empty($messages)){
	
?>
<div class="messages">
	<div class="message-control left">
		<div class="left qmail-item">
			My Qmail
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
	<div id="messages" class="left clear">
	<?php echo $this->Form->create("ReceiveMessage", array("id"=>"selector"));?>
		<div class="left message-header">
			<ul>
				<li class="checkbox">
					<input type="checkbox" id="checkbox1" name="checkbox1" class="left"/>
				</li>
				<li class="from">
					<span class="left">From</span>
				</li>
				<li class="message">
					<span class="left">Message</span>
				</li>
				<li class="date">
					<span class="left">Date</span>
				</li>
			</ul>
		</div>
		<?php 
		$i=0;
		 foreach($messages as $message){
			$reply = $this->requestAction("/private_message_replies/latestReply/".$message["PrivateMessage"]["id"]);
			$class = "left message";
			if ($i%2==1){
				$class="message left even";
			}
			if ($message["ReceiveMessage"]["message_status_id"]==2){
				$class.=" unread";
			}
		 	if (!empty($reply)){
				$sender_id = $reply["PrivateMessageReply"]["sender_id"];
			}else{
				$sender_id = $message["PrivateMessage"]["member_id"];
			}
			$sender = $this->requestAction("/members/getMember/".$sender_id);
		?>
			<div class="<?php echo $class?> message" id="message_<?php echo $message["ReceiveMessage"]["id"]?>">
				<ul>
					<li class="checkbox">
						<?php 
							echo $this->Form->checkbox("checkbox.$i", array("value"=>$message["ReceiveMessage"]["id"], "class"=>"control_check", 'hiddenField' => false));	
						?>
					</li>
					<li class="from">
						<span class="left"><?php echo $sender["Member"]["firstname"]." ".$sender["Member"]["lastname"]?></span>
					</li>
					<li class="message">
						<span class="left"><?php echo $message["PrivateMessage"]["title"]?></span>
					</li>
					<li class="date">
						<span class="left"><?php echo date("D d/8 h:m A", strtotime($message["ReceiveMessage"]["created"]))?></span>
					</li>
				</ul>
			</div>
	<?php 
		 $i++;
		 }?>
	<?php echo $this->Form->end()?>
	</div>
</div>

<?php 
}else{
?>
	<div class="messages">
		<p>You have no recent messages</p>
	</div>	
<?php 
}