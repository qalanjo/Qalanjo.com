<?php 
$this->Paginator->options(array(
    'update' => '#messages',
    'evalScripts' => true
));
if (!empty($messages)){
	echo $this->Form->create("ReceiveMessage");
?>
	<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages% messages', true)
));
?>	</p>
	<div class="control">
		<div id="marker_controls">
		
			<?php
				$path = "/receive_messages/delete_selected/$option";
				if ($option=="trash"){
					echo $this->Ajax->submit("Delete", array("class"=>"marker_control", "url"=>$path, "update"=>"messages","before"=>"setAction('4')", "div"=>false));
				}
				if ($option!="trash"){ 
					echo $this->Ajax->submit("Move to Trash", array("class"=>"marker_control", "url"=>$path, "update"=>"messages","before"=>"setAction('3')", "div"=>false));
				}
				if ($option!="read"){
					echo $this->Ajax->submit("Mark as read", array("class"=>"marker_control", "url"=>$path, "update"=>"messages","before"=>"setAction('1')", "div"=>false));
				}
				if ($option!="unread"){
					echo $this->Ajax->submit("Mark as unread", array("class"=>"marker_control", "url"=>$path, "update"=>"messages","before"=>"setAction('2')", "div"=>false));
				}
			?>		
		</div>
		<div id="checker">
		<?php 
			echo $this->Form->checkbox("", array("id"=>"selector"));
			echo $this->Form->input("action", array("id"=>"action", "type"=>"hidden"));
		?>
		</div>
	</div>
	<table id="table_message">
		<tbody>
			<?php
				$i=0;
				foreach($messages as $message){	
					$reply = $this->requestAction("/private_message_replies/latestReply/".$message["PrivateMessage"]["id"]);
					?>
					<tr class='<?php echo $message["MessageStatus"]["value"]?>'>
						<td class='checkbox' width="5%">
							<?php 
								echo $this->Form->checkbox("checkbox.$i", array("value"=>$message["ReceiveMessage"]["id"], "class"=>"control_check"));
							?>
						</td>
						<td class='sender' width="20%">
						<?php 
							if (!empty($reply)){
								$sender_id = $reply["PrivateMessageReply"]["sender_id"];
							}else{
								$sender_id = $message["PrivateMessage"]["member_id"];
							}
							$temp = $this->requestAction("/member_profiles/getProfileOnly/".$sender_id);
							$sender = $this->requestAction("/members/getMember/".$sender_id);
							$img = $this->Html->image("uploads/$sender_id/default/profile_thumb_".$temp["MemberProfile"]["picture_path"], array("class"=>"picture"));
							$link = $this->Html->link($img, "/members/profile/".$sender_id, array("escape"=>false));
							echo $link;
							$link = $this->Html->link($sender["Member"]["firstname"]." ".$sender["Member"]["lastname"], "/members/profile/".$sender_id, array("escape"=>false));
							echo "<br/>".$link;
						?>
						</td>
			
						<td class="content" width="50%">
						<?php 
							if (!empty($reply)){
								echo "<p>{$this->Ajax->link($message["PrivateMessage"]["title"], "/private_messages/read/".$message["ReceiveMessage"]["id"], array("update"=>"updatable_div"))}</p>";
								if (strlen($reply["PrivateMessageReply"]["content"])>20){
									$temp = substr($reply["PrivateMessageReply"]["content"], 0, 20);	
								}else{
									$temp = $reply["PrivateMessageReply"]["content"];	
								}
								echo "<p class='content_message'>$temp...</p>";
							}else{
								echo "<p>{$this->Ajax->link($message["PrivateMessage"]["title"], "/private_messages/read/".$message["ReceiveMessage"]["id"], array("update"=>"updatable_div"))}</p>";
								if (strlen($message["PrivateMessage"]["content"])>20){
									$temp = substr($message["PrivateMessage"]["content"], 0, 20);	
								}else{
									$temp = $message["PrivateMessage"]["content"];	
								}
								echo "<p class='content_message'>$temp...</p>";
							}
						?>
						</td>
						<td class="date" width="25%">
						<?php 
							echo "<p>{$this->AgoTime->time_since(strtotime($message["ReceiveMessage"]["created"]))}</p>";
						?>
						</td>
					</tr>
					
				<?php 
					$i++;
				}
			?>
		</tbody>
	</table>
	
	<?php 
		echo $this->Form->end();
		
	?>
	
	<?php echo $this->Html->scriptBlock("
		$('#selector').change(function(){
			$('.control_check').attr('checked', $(this).attr('checked'));
		});
		
		function setAction(action){
			$('#action').val(action);
		}
	");?>

<?php }?>

<?php 
	if (!empty($messages)){
?>
	<div class="paging container span-4">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array("update"=>"messages"), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
	 
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
<?php }?>