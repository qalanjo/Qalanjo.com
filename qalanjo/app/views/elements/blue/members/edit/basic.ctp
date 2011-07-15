<div class="profile-wizard-content">


<?php 
	echo $this->Session->flash();
	echo $this->Form->create('Member',array('url'=>"/members/edit/sk:$sk"));
	echo $this->Form->input('MemberProfileAttributeWeight.member_id',array('value'=>$member_id,'type'=>'hidden'));
	echo $this->Form->input('MemberProfileAttributeWeight.id',array('type'=>'hidden'));
	echo $this->Form->input('MemberProfile.member_id',array('value'=>$member_id,'type'=>'hidden'));
	echo $this->Form->input('MemberProfile.id',array('type'=>'hidden', "value"=>$this->data["MemberProfile"]["id"]));
	echo $this->Form->input('Member.id',array('type'=>'hidden', "value"=>$this->data["Member"]["id"]));	
?>
		<fieldset class="basics">
			<h2><span>Basics</span></h2>
			<dl>
				<dt>
					Name
				</dt>
				<dd>
					<?php 
						echo $this->data["Member"]["firstname"]." ".$this->data["Member"]["lastname"];
					?>
				</dd>
				<?php if ($this->data["Member"]["age"]!=""){?>
					<dt>
						Age
					</dt>
					<dd>
						<?php echo $this->data["Member"]["age"]?>
					</dd>
				<?php }?>
				
				<dt>
					Location
				</dt>
				<dd>
					<?php echo $this->data["Member"]["state"]?>, <?php echo $this->data["Country"]["name"]?>
					
				</dd>
				<dt>
					Birth Date:
				</dt>
				<dd>
					<?php 
						echo $this->Form->input("MemberProfile.birthdate", array( 'label' => false, "div"=>false
						                                    	, 'dateFormat' => 'MDY', 
						                                    	'minYear' => date('Y') - 70  ,
						                                    	'maxYear' => date('Y') - 18 ));
					
					?>
				</dd>
				<dt>
					Occupation
				</dt>
				<dd>
					<?php 
						echo $this->Form->input("MemberProfile.occupation", array("id"=>"occupation", "size"=>45, "div"=>false, "label"=>false));
					
					?>
				</dd>
				<dt>
					Height
				</dt>
				<dd>
					<span>
						<?php 
							echo $this->Form->input("MemberProfile.height_ft", array("id"=>"feet", "size"=>3, "div"=>false, "label"=>false));
							
						?>
						<span>ft</span>
						<?php 
							echo $this->Form->input("MemberProfile.height_inch", array("id"=>"feet", "size"=>3, "div"=>false, "label"=>false));
							
						?>
						<span>in.</span>
					</span>
				</dd>
				<dt>
					Education
				</dt>
				<dd>
					<?php 
						echo $this->Form->input("MemberProfileAttributeWeight.educational_level_id", array("type"=>"select", "options"=>$educationalLevels, "div"=>false, "label"=>false, "id"=>"education"))
					?>
				</dd>
				
				<div class="twoline">
					<dt>
						What university/college did you attend?
					</dt>
					<dd>
						<?php 
							echo $this->Form->input("MemberProfile.education_institution", array("size"=>45, "div"=>false, "label"=>false));
						?>
					</dd>
				</div>
				
				<dt>
					Kids
				</dt>
				<dd>
					<?php 
						echo $this->Form->input("MemberProfileAnswer.4.profile_answer_id", array("type"=>"select", "options"=>$kidList, "selected"=>$kid["ProfileAnswer"]["id"], "div"=>false, "label"=>false));
						echo $this->Form->input("MemberProfileAnswer.4.member_id", array("type"=>"hidden", "value"=>$member_id))
						
					?>
				</dd>
				
				<dt>
					Smokes
				</dt>
				<dd>
				
					<?php 
						echo $this->Form->input("MemberProfileAnswer.0.profile_answer_id", array("type"=>"select", "options"=>$smokeList, "selected"=>$smoke["ProfileAnswer"]["id"], "div"=>false, "label"=>false));
						echo $this->Form->input("MemberProfileAnswer.0.member_id", array("type"=>"hidden", "value"=>$member_id))
						
					?>
					
				</dd>
				<dt>
					Drinks
				</dt>
				<dd>
					<?php 
						echo $this->Form->input("MemberProfileAnswer.1.profile_answer_id", array("type"=>"select", "options"=>$drinkList, "selected"=>$drink["ProfileAnswer"]["id"], "div"=>false, "label"=>false));
						echo $this->Form->input("MemberProfileAnswer.0.member_id", array("type"=>"hidden", "value"=>$member_id))
						
					?>
				</dd>
				<dt>
					Diet
				</dt>
				<dd>
					<?php 
						echo $this->Form->input("MemberProfileAnswer.2.profile_answer_id", array("type"=>"select", "options"=>$dietList, "selected"=>$diet["ProfileAnswer"]["id"], "div"=>false, "label"=>false));
						echo $this->Form->input("MemberProfileAnswer.2.member_id", array("type"=>"hidden", "value"=>$member_id))
						
					?>
				</dd>
				<dt>
					Gym
				</dt>
				<dd>
					<?php 
						echo $this->Form->input("MemberProfileAnswer.3.profile_answer_id", array("type"=>"select", "options"=>$gymList, "selected"=>$gym["ProfileAnswer"]["id"], "div"=>false, "label"=>false));
						echo $this->Form->input("MemberProfileAnswer.3.member_id", array("type"=>"hidden", "value"=>$member_id))
						
					?>
				</dd>
				
			</dl>
			<button type=submit><span>Save and Continue</span></button>
		</fieldset>
		<?php 
			echo $this->Form->input("sk", array("type"=>"hidden", "value"=>$sk));
		?>
<?php echo $this->Form->end()?>
</div>
<div class="profile-wizard-supplement">
	<?php 
		echo $this->Html->image("designs/blue/members/edit/profile adviser.png");
	?>

</div>