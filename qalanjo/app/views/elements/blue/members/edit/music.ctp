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
	<h2><span>Music</span></h2>
	<dl>
		<?php /*?>
		<dt>
			<?php echo $expressMusic["ExpressQuestion"]["question"]?>
		</dt>
		<dd>
		</dd>
		*/?>
		
		<dt>
			What particular genre do you mostly listen to?
		</dt>
		<dd>
			<ul class="image-list musics">
				<?php 
					echo $this->element("blue/members/edit/populatelist");
				?>
				<li class="answer14">
					<label>
						<em></em>
						<input type="checkbox" class="no-check"/>
						<span>I don't like music.</span>
					</label>
				</li>
				
				
			</ul>
		</dd>
		
		<?php /*?>
		<dt>
			<?php echo $musicQuestion["InMyOwnWordsQuestion"]["question"]?>
		</dt>
		<dd>
		
		</dd>
		*/?>
	</dl>
	<button type=submit><span>Save and Continue</span></button>
</fieldset>
<?php echo $this->Form->end()?>
</div>
	