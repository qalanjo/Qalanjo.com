<?php 
foreach($order as $i){
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
							if ($question["ProfileQuestionType"]["value"]=="radio"){
       							echo $this->Form->input("MemberProfileAnswer.$i.item_id", array("type"=>"radio", "label"=>false, "options"=>$options, 'separator'=>"</label><br/><label class='clear'>", "before"=>$before, "after"=>$after,'hiddenField' => false, "legend"=>false));
							}else{
								echo $this->Form->input("MemberProfileAnswer.$i.item_id", array("type"=>"select", "label"=>false, "multiple"=>"checkbox", "options"=>$options, "separator"=>"</label><br/><label class='clear'>", "before"=>$before, "after"=>$after, 'hiddenField' => false));
							}
       						echo $this->Form->input("MemberProfileAnswer.$i.question_id", array("type"=>"hidden","id"=>"answer", "value"=>$question["ProfileQuestion"]["id"]));
						?>
					
				</div>
			</dl>
		</dl>
	</li>
<?php 	
}
?>