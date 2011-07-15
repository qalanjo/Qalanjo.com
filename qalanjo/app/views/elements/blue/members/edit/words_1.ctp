<div class="profile-wizard-content">
	
	<?php 
		echo $this->Form->create('InMyOwnWordsAnswer',array('url'=>"/members/edit/sk:$sk/page:$page"));
	?>
	<fieldset class="in-my-own-words">
		<h2><span>In My Own Words</span></h2>	
		<dl>
			<?php 
				$i=0;
				foreach($questions as $question){
					?>
					
					<dt>
						<?php echo $question["InMyOwnWordsQuestion"]["question"]?>
					</dt>
					<dd>
						<?php		
							$found = false;
							foreach($this->data["InMyOwnWordsAnswer"] as $answer){
								if ($answer["in_my_own_words_question_id"]==$question["InMyOwnWordsQuestion"]["id"]){
									echo $this->Form->input("InMyOwnWordsAnswer.$i.answer", array("div"=>false, "label"=>false, "value"=>$answer["answer"], "class"=>"answer-box"));
									$found=true;
								}
							}
							if (!$found){
								echo $this->Form->input("InMyOwnWordsAnswer.$i.answer", array("div"=>false, "label"=>false));	
							}
							echo $this->Form->input("InMyOwnWordsAnswer.$i.member_id", array("type"=>"hidden", "value"=>$member_id));
							echo $this->Form->input("InMyOwnWordsAnswer.$i.in_my_own_words_question_id", array("type"=>"hidden", "value"=>$question["InMyOwnWordsQuestion"]["id"]));
							$i++;
						?>
						<div class="countdown-status">650 characters remaining</div>
					</dd>	
					<?php 
				}
			?>
		
		</dl>
		<button type=submit><span>Save and Continue</span></button>
	</fieldset>
</div>
<div class="profile-wizard-supplement">
	<?php 
		echo $this->Html->image("designs/blue/members/edit/profile adviser.png");
	?>
</div>
