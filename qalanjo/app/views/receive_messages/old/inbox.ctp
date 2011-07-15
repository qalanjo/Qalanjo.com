<?php 
	/*
	 * Design for inbox
	 */	
	$path =  "designs/blue/inbox/";
if ($action=="render"){?>
<div class="content-container">
	<div class="left left-bar-controls">
		<h2 class="header">
			Qmail Controls
		</h2>
		
		<div class="content">
			<div class="control">
				<a href="#" id="checkmail" class="checkmail left">
				</a>
				<a href="#" class="new left" id="new_message">
				</a>
				
			</div>
			
			<ul class="control">
				<li id="inbox-link" class="active">
					<?php 
						echo $this->Html->image($path."inboxmail.png", array("alt"=>"Inbox", "class"=>"left"));
						echo $this->Html->link("Inbox <strong id='inbox-items'>()</strong>", "/receive_messages/load_inbox/1", array("escape"=>false));
					?>	
				</li>
				<li>
					<?php 
						echo $this->Html->image($path."sentmail.png", array("alt"=>"Sent Items", "class"=>"left"));
						echo $this->Html->link("Sent Items <strong id='sent-items'>()</strong>", "/receive_messages/load_inbox/2", array("escape"=>false));
					?>	
				</li>
				<li>
					<?php 
						echo $this->Html->image($path."trash.png", array("alt"=>"Trash", "class"=>"left"));
						echo $this->Html->link("Trash <strong id='trash-items'>()</strong>", "/receive_messages/load_inbox/3", array("escape"=>false));
					?>		
				</li>
			</ul>	
		</div>
	</div>
	<div class="left inbox">
		<h2 id="header" class="header">
			My QMail
		</h2>
		<div class="content">
			<div class="control">
				<a id="delete-selected-button" href="#" class="delete left">
					
				</a>
				
				<a id="back-button" href="#" class="back left">
					
				</a>
				
				<a id="delete-message-button" href="#" class="delete left">
					
				</a>
				<a id="spam-button" href="#" class="spam left">
					
				</a>
			</div>
			
			<div id="messages" class="messages">
				<?php 
					echo $this->element("blue/inbox/inbox");
				?>     
			</div>
		</div>
	</div>
</div>
		
	<?php 
		echo $this->element("compose_write",array("from_id"=>$member_id));
		echo $this->element("match-selector");
	?>
	
	<div id="result" class="result left">
	
	</div>
	
	
	
	<div id="deletebox">
		Do you want to delete the selected items?
	</div>
	
<?php }else{
	echo $this->element("blue/inbox/inbox");
}?>