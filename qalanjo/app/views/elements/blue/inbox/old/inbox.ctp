<?php 
$this->Paginator->options(array(
    'update' => '#messages',
    'evalScripts' => true
));
if (!empty($messages)){
	echo $this->Form->create("ReceiveMessage", array("id"=>"selector"));
	?>
	<div class="inbox-header">
		<ul>
			<li class="checkbox">
				<input type="checkbox" id="checkbox1" name="checkbox1" class="left" />
			</li>
			<li class="from">
				&nbsp;|&nbsp;<span>From</span>
			</li>
			<li class="subject">
				&nbsp;|&nbsp;<span>Subject</span>
			</li>
			<li class="date">
				&nbsp;|&nbsp;<span>Date</span>
			</li>
		</ul>
		
	</div>
	<ul>
<?php
	$i=0;
	 foreach($messages as $message){
		$reply = $this->requestAction("/private_message_replies/latestReply/".$message["PrivateMessage"]["id"]);
		$class = "odd left";
		if ($i%2==1){
			$class="even left";
		}
	 	if (!empty($reply)){
			$sender_id = $reply["PrivateMessageReply"]["sender_id"];
		}else{
			$sender_id = $message["PrivateMessage"]["member_id"];
		}
		$sender = $this->requestAction("/members/getMember/".$sender_id);
		
		
	?>
	
		<li class="message <?php echo strtolower($message["MessageStatus"]["value"])?>" id="message_<?php echo $message["ReceiveMessage"]["id"]?>">
			<div class="checkbox left">										
				<?php 
					echo $this->Form->checkbox("checkbox.$i", array("value"=>$message["ReceiveMessage"]["id"], "class"=>"control_check left", 'hiddenField' => false));	
				?>
			</div>						
			<div class="from left">										
				<span class="item"><?php echo $sender["Member"]["firstname"]." ".$sender["Member"]["lastname"]?></span>
			</div>						
			<div class="subject left">										
				<span class="item"><?php echo $message["PrivateMessage"]["title"]?></span>
			</div>						
			<div class="date left">		
				<span class="item"><?php echo date("D d/8 h:m A", strtotime($message["ReceiveMessage"]["created"]))?></span>
			</div>						
						
		</li>     
<?php 
	$i++;
	}//loop over messages
	echo $this->Form->input("action", array("type"=>"hidden", "id"=>"action"));
	?>
	</ul>
	<?php 
	echo $this->Form->end();
}
?>

