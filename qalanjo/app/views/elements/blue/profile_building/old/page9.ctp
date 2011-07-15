<div class="left" id="content_header">
	<h2>Career</h2>
</div>
	<div class="left" id="content_main">
		<p class="instruction">Check the following questions below:</p>
       	<div class="left" id="profile_completion_box">
       		<?php 
       			$i=0;
       			foreach($questions as $question){
       				if (isset($error)){
       					$class = $this->ProfileCompletor->validateIfSelected($this->data, $question, "background_list");
       				}else{
       					$class = "class = 'background_list'";
       				}
       				?>
       				<p>
       					<?php 
       						echo $question["ProfileQuestion"]["question"]; 					
       					?>
       					
       				</p>
       				<ul <?php echo $class?>>
       					<?php 
       						$options = array();
							foreach($question["ProfileAnswer"] as $answer){
								$options[$answer["id"]] = $answer["answer"];
							}
							if ($question["ProfileQuestionType"]["value"]=="radio"){
								echo $this->Form->radio("MemberProfileAnswer.$i.item_id", $options, array("legend"=>false, "separator"=>"</li><li>", "before"=>"<li>", "after"=>"</li>", 'hiddenField' => false));
							}else{
								echo $this->Form->input("MemberProfileAnswer.$i.item_id", array("type"=>"select", "label"=>false, "multiple"=>"checkbox", "options"=>$options, "separator"=>"</li><li>", "before"=>"<li>", "after"=>"</li>", 'hiddenField' => false));		
							}
							echo $this->Form->input("MemberProfileAnswer.$i.question_id", array("type"=>"hidden","id"=>"answer", "value"=>$question["ProfileQuestion"]["id"]));
       					?>
       				
       				
       				</ul>
       				
       				
       				<?php 
       				
       				$i++;
       			}
       		
       		?>                  
       		</div>
       		<p class="image_set_bottom left">
       			<span class="button left">
       			<button type="submit"><span>Save and Continue</span></button>
       			</span>
       		</p>
</div>					