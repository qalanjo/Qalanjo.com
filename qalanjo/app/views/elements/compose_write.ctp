<div id="writeMessageDialog" title="Write New Message" class="ui-form">
	<fieldset class="dialog-content" class="left">
		<?php 
			echo $this->Form->create("PrivateMessage", array("action"=>"writemessage"));
		?>
		<dl>
			<dt>
				To:
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("PrivateMessage.member", array("div"=>false, "class"=>"to-member", "label"=>false, "id"=>"member_search"));		
					echo $this->Form->input("PrivateMessage.to_id", array("type"=>"hidden"));
				?>
				<button class="match-selector">
						<span>
							Select
						</span>
				</button>
			</dd>
			<dt>
				Subject:
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("PrivateMessage.title", array("div"=>false, "class"=>"subject-text", "label"=>false));		
				?>
			</dd>
			<dt>
				Message:
			</dt>
			<dd>
				<?php 
					echo $this->Form->input("PrivateMessage.content", array("div"=>false, "class"=>"tinymce text_field", "label"=>false));		
				?>
			</dd>
		
		</dl>
		<?php 
			echo $this->Ajax->submit("Send", array("url"=>"/private_messages/writemessage/0", "update"=>"result", "complete"=>"close_window()", "div"=>"span-10 clear"));		
			echo $this->Form->end();
		?>
	</fieldset>
	
</div>