<?php 
	$this->Html->css(array("blue/profile_building/profile-building"), "stylesheet", array("inline"=>false));
	$this->Javascript->link(array("blue/members/profile_completion"), false);
	if ($this->data["Gender"]["value"]=="Man"){
		$attach = "m";
	}else{
		$attach = "w";
	}
	?>
	
<div class="item-set-1<?php echo $attach?> item-set-content left">
	<?php 
		echo $this->element("blue/profile_building/form");
	?>
		<dl class="picture-select-set">
			<dt>
				Eye Color
			</dt>
			<dd>
				<ul class="picture-select-set-item">
					<?php 
						$i=0;
						$first = 0;
						foreach($questions[0]["ProfileAnswer"] as $answer){
							if ($i==0){
								$class="active";
								$first = $answer["id"];
							}else{
								$class = "";
							}
							?>
							<li>
								<div class="picture-container <?php echo $class?>" id="item_<?php echo $questions[0]["ProfileQuestion"]["id"]?>_<?php echo $answer["id"]?>">
									<?php 
									$path = "/css/img/blue/questionnaire/questionset/";
									if ($this->data["Gender"]["value"]=="Man"){
									 	$path.="m";
									}else{
									 	$path.="w";
									}
									echo $this->Html->image($path.strtolower($answer["answer"])."eye.jpg");
									?>
								</div>
								<span>
								<?php 
									echo $answer["answer"];
								?></span>
							</li>	
							<?php 
							$i++;
						}
					?>
				</ul>
				<?php 
					echo $this->Form->input("MemberProfileAnswer.0.item_id", array("type"=>"hidden","id"=>"answer_".$questions[0]["ProfileQuestion"]["id"], "value"=>$first));
    				echo $this->Form->input("MemberProfileAnswer.0.question_id", array("type"=>"hidden", "value"=>$questions[0]["ProfileQuestion"]["id"]));
				?>
			</dd>
			<dt class="clear">
				Hair Length
			</dt>
			<dd>
				<ul class="picture-select-set-item">
					<?php
						$i=0;
						$first = 0;
						foreach($questions[1]["ProfileAnswer"] as $answer){
							if ($i==0){
								$class="active";
								$first = $answer["id"];
							}else{
								$class = "";
							}
							?>
							<li>
								<div class="picture-container <?php echo $class?>" id="item_<?php echo $questions[1]["ProfileQuestion"]["id"]?>_<?php echo $answer["id"]?>">
									<?php 
									$path = "/css/img/blue/questionnaire/questionset/";
									if ($this->data["Gender"]["value"]=="Man"){
									 	$path.="m";
									}else{
									 	$path.="w";
									}
									if ($answer["answer"]=="Shoulder length"){
										if ($this->data["Gender"]["value"]=="Man"){
											echo $this->Html->image("/css/img/blue/questionnaire/questionset/mclean.jpg");
										}else{
											echo $this->Html->image("/css/img/blue/questionnaire/questionset/wshoulder.jpg");
										}
									}else{	
										echo $this->Html->image($path.strtolower($answer["answer"]).".jpg");
									}
									?>
								</div>
								<span>
								<?php 
								
									if ($answer["answer"]=="Shoulder length"){
										if ($this->data["Gender"]["value"]=="Man"){
											echo "Clean";
										}else{
											echo $answer["answer"];
										}
									}else{
										echo $answer["answer"];
									}
								?></span>
							</li>
							<?php
							$i++; 
						}
					?>
					<?php 
						echo $this->Form->input("MemberProfileAnswer.1.item_id", array("type"=>"hidden","id"=>"answer_".$questions[1]["ProfileQuestion"]["id"], "value"=>$first));
	    				echo $this->Form->input("MemberProfileAnswer.1.question_id", array("type"=>"hidden", "value"=>$questions[1]["ProfileQuestion"]["id"]));
					?>
				</ul>
			</dd>
			<dt class="clear">
				Hair Color
			</dt>
			
			<dd>
				<ul class="picture-select-set-item">
					<?php 
						$i=0;
						$first = 0;
						foreach($questions[2]["ProfileAnswer"] as $answer){
							if ($i==0){
								$class="active";
								$first = $answer["id"];
							}else{
								$class = "";
							}
					?>
					
					<li>
						<div class="picture-container <?php echo $class?>" id="item_<?php echo $questions[2]["ProfileQuestion"]["id"]?>_<?php echo $answer["id"]?>">
							<?php 
								$path = "/css/img/blue/questionnaire/questionset/";
								
								echo $this->Html->image($path."hair".strtolower($answer["answer"]).".jpg");
							?>
						</div>
						<span><?php echo $answer["answer"]?></span>
					</li>
					<?php 
						$i++;
						}
					?>
					<?php 
						echo $this->Form->input("MemberProfileAnswer.2.item_id", array("type"=>"hidden","id"=>"answer_".$questions[2]["ProfileQuestion"]["id"], "value"=>$first));
	    				echo $this->Form->input("MemberProfileAnswer.2.question_id", array("type"=>"hidden", "value"=>$questions[2]["ProfileQuestion"]["id"]));
					?>
				</ul>
			</dd>
		</dl>
		<ul class="block-set block-set-blue">
			<?php 
			for($i=3;$i<count($questions);$i++){
			?>
				<li>
					<dl class="radio-set">
						<dt>
							<?php 
								echo $questions[$i]["ProfileQuestion"]["question"];
							?>
						</dt>
						<dl>
							<div class="radio-set">
								<?php 
									$question = $questions[$i];
		       						$options = array();
									foreach($question["ProfileAnswer"] as $answer){
										$options[$answer["id"]] = $answer["answer"];
									}
									$before = "<label class='clear'>";
									$after = "</label>";
		       						echo $this->Form->input("MemberProfileAnswer.$i.item_id", array("type"=>"radio", "label"=>false, "options"=>$options, 'separator'=>"</label><br/><label class='clear'>", "before"=>$before, "after"=>$after,'hiddenField' => false, "legend"=>false));
									echo $this->Form->input("MemberProfileAnswer.$i.question_id", array("type"=>"hidden","id"=>"answer", "value"=>$question["ProfileQuestion"]["id"]));
								?>
								
							</div>
						</dl>
					</dl>
				</li>
			<?php 
			}
			?>
		
		</ul>
		<div class="button-set">
			<p>
				<strong>Thank you for answering all the questions.</strong> Kindly save and continue.
			</p>
			<button class="clear save-and-continue" type="submit">
			</button>
		</div>
	<?php echo $this->Form->end()?>
</div>