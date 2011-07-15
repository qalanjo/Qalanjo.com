<?php
/**
 * View for the Message Composer
 * @version 0.0.1
 * @date 5/26/2011
 * 
 */
?>

<div id="composer" title="Write New Message" class="ui-form">
	<?php if ($role==3){
			echo $this->Ajax->form(array("type"=>"post",
					'options' => array(
				        'model'=>'PrivateMessage',
				        'update'=>'message_result',
				        'url' => "/private_messages/writemessage/0",
						"complete"=>"close_window()"
				    )
				)
			);
		
	?>
	<fieldset class="dialog-content left">
		<div class="left icebreaker-profile-info">
			<div class="profile-picture left">
				<div class="profile-picture-bg left">
					<?php 
						if (isset($view_member["MemberProfile"]["picture_path"])||($view_member["MemberProfile"]["picture_path"]!="")){
							echo $this->Html->image("uploads/".$view_member["Member"]["id"]."/default/profile_thumb_".$view_member["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$view_member["Member"]["id"]));
						}else{
							if ($view_member["Member"]["gender_id"]==1){
								echo $this->Html->image($path."default.jpg", array("url"=>"/view_members/profile/".$view_member["Member"]["id"]));
							}else{
								echo $this->Html->image($path."woman-default-picture.jpg", array("url"=>"/view_members/profile/".$view_member["Member"]["id"]));
							}
						}
					?>
				</div>
			</div>
			<div class="profile-info left">
				<h4 class="left">
					<?php echo $view_member["Member"]["firstname"]." ".$view_member["Member"]["lastname"]?>
				</h4>
				<?php if (isset($age)){?>
					<span class="left clear age">
						<?php echo $age?> years old.
					</span>
				<?php }?>
				<?php if (($view_member["Member"]["address1"]!="")&&($view_member["Member"]["address2"]!="")&&($view_member["Member"]["city"]!="")){?>
					<span class="left clear location">
						<?php echo $view_member["Member"]["address1"].", ".$view_member["Member"]["address2"].", ".$view_member["Member"]["city"]?>
					</span>
				<?php }?>
				<span class="left clear location">
					<?php echo $view_member["Member"]["state"].", ".$view_member["Country"]["name"]?>
				</span>
			</div>
		</div>
		
		
		<dl class="left message-writer">
				<?php 
					echo $this->Form->input("PrivateMessage.member_id", array("type"=>"hidden", "value"=>$member["Member"]["id"]));
					echo $this->Form->input("PrivateMessage.to_id", array("type"=>"hidden", "value"=>$view_member["Member"]["id"]));
				?>
			
			<dt class="left">
				Subject:
			</dt>
			<dd class="left clear">
				<?php 
					echo $this->Form->input("PrivateMessage.title", array("div"=>false, "class"=>"subject-text left", "label"=>false));		
				?>
			</dd>
			<dt class="left clear">
				Message:
			</dt>
			<dd class="left clear">
				<?php 
					echo $this->Form->input("PrivateMessage.content", array("div"=>false, "class"=>"tinymce text_field left", "label"=>false));		
				?>
			</dd>
		
		</dl>
		
	</fieldset>
	<div class="buttonpane buttonpane-message ui-widget-content left ui-helper-clearfix">
		<div class="buttonset">
			<button type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
				<span class="ui-button-text">Send Message</span>
			</button>
		</div>
		
	</div>
	<?php
		echo $this->Form->end();
	}else{?>
		<div class="subscribe-message left">
			<div class="left message-notification">
				<p>You needed to subscribe to start communicating with the person.</p>
			</div>
			<div class="subscribe-information left">
				<div class="profile-picture left">
					<?php 
						if (isset($view_member["MemberProfile"]["picture_path"])||($view_member["MemberProfile"]["picture_path"]!="")){
							echo $this->Html->image("uploads/".$view_member["Member"]["id"]."/default/profile_thumb_".$view_member["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$view_member["Member"]["id"]));
						}else{
							if ($view_member["Member"]["gender_id"]==1){
								echo $this->Html->image($path."default.jpg", array("url"=>"/view_members/profile/".$view_member["Member"]["id"]));
							}else{
								echo $this->Html->image($path."woman-default-picture.jpg", array("url"=>"/view_members/profile/".$view_member["Member"]["id"]));
							}
						}
					?>
				</div>
				<div class="profile-info left">
					<span class="name left">
						<?php 
							echo $view_member["Member"]["firstname"]." ".$view_member["Member"]["lastname"];
						?>
					</span>	
					<span class="location left clear">
						<?php 
							echo $view_member["Member"]["state"]." ".$view_member["Country"]["name"];
						?>
					</span>	
					<div class="clear icon-set left">
						<?php 
							echo $this->Html->image("/css/img/blue/dialog/arrow-full.png", array("class"=>"left arrow-full"));
							echo $this->Html->image("/css/img/blue/dialog/arrow-blur.png", array("class"=>"left arrow-blur"));
							echo $this->Html->image("/css/img/blue/dialog/message-icon.png", array("class"=>"left message-icon"));
							echo $this->Html->image("/css/img/blue/dialog/subscribe-small.png", array("class"=>"left subscribe-small", "url"=>"subscribe"));
						?>
					</div>
				</div>
			</div>	
		</div>
	
		
	<?php }?>
</div>