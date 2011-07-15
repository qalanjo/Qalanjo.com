<div class="profile-wizard-content fill">
<?php 
	echo $this->Session->flash();
	echo $this->Form->create('Member',array('url'=>"/members/edit/sk:$sk"));
	echo $this->Form->input('MemberProfileAttributeWeight.member_id',array('value'=>$member_id,'type'=>'hidden'));
	echo $this->Form->input('MemberProfileAttributeWeight.id',array('type'=>'hidden'));
	echo $this->Form->input('MemberProfile.member_id',array('value'=>$member_id,'type'=>'hidden'));
	echo $this->Form->input('MemberProfile.id',array('type'=>'hidden', "value"=>$this->data["MemberProfile"]["id"]));
	echo $this->Form->input('Member.id',array('type'=>'hidden', "value"=>$this->data["Member"]["id"]));	
?>
<fieldset class="image-based">
	<h2><span>Pets</span></h2>
	<dl>
		<dt>
			What kind of pets do you have or want to have? (Check only 3)
		</dt>
		<dd>
			<ul class="image-list pets">
				<?php 
					echo $this->element("blue/members/edit/populatelist");
				?>
				<li class="answer11">
					<label>
						<em></em>
						<input type="checkbox" class="no-check"/>
						<span>I don't like pets.</span>
					</label>
				</li>
				
				
			</ul>
		</dd>
	</dl>
	<button type=submit><span>Save and Continue</span></button>
</fieldset>
<?php echo $this->Form->end()?>
</div>
	