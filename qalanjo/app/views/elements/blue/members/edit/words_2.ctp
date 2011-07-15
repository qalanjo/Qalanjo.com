<div class="profile-wizard-content">
<?php 
	echo $this->Session->flash();
	echo $this->Form->create('Member',array('url'=>"/members/edit/sk:$sk/page:$page"));
	echo $this->Form->input('MemberProfileAttributeWeight.member_id',array('value'=>$member_id,'type'=>'hidden'));
	echo $this->Form->input('MemberProfileAttributeWeight.id',array('type'=>'hidden'));
	echo $this->Form->input('MemberProfile.member_id',array('value'=>$member_id,'type'=>'hidden'));
	echo $this->Form->input('MemberProfile.id',array('type'=>'hidden', "value"=>$this->data["MemberProfile"]["id"]));
	echo $this->Form->input('Member.id',array('type'=>'hidden', "value"=>$this->data["Member"]["id"]));	
?>
		<fieldset class="in-my-own-words">
			<h2><span>In My Own Words</span></h2>
			<dl>
				<dt>
					What are you most passionate about?
				</dt>
				<dd>
					<?php 
						echo $this->Form->input("MemberProfile.passionate_about", array("div"=>false, "label"=>false, "class"=>"textarea answer-box"));		
					?>
					<div class="countdown-status">650 characters remaining</div>
				</dd>
				<dt>
					The four things your friends say about you are:
				</dt>
				<dd>
					<div class="friends-say">
					<?php 
						echo $this->Form->input("FriendSayTrait", array("multiple"=>"checkbox", "div"=>false, "label"=>false,"options"=>$friendSays));
				
					?>
					</div>
				</dd>
				
				<dt>
					How do you typically spend your leisure time?
				</dt>
				<dd>
					<?php 
						echo $this->Form->input("MemberProfile.leisure_activity", array("class"=>"textarea answer-box", "div"=>false, "label"=>false))
					?>
					<div class="countdown-status">650 characters remaining</div>
				</dd>
			</dl>
			<button type=submit><span>Save and Continue</span></button>
			<button>Skip</button>
		</fieldset>
	<?php 
		echo $this->Form->end();
	?>
</div>
<div class="profile-wizard-supplement">
	<?php 
		echo $this->Html->image("designs/blue/members/edit/profile adviser.png");
	?>
</div>