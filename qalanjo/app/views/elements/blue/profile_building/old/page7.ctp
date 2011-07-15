<div class="left" id="content_header">
	<h2>Background</h2>
</div>

<?php 
	$options = array();
	$i=0;
	foreach($educationalLevels as $level){
		if ($i==5){
			break;
		}
		$options[$level["EducationalLevel"]["id"]] = $level["EducationalLevel"]["value"];
		$i++;
	}
?>
<div class="left" id="content_main">
	<p class="instruction">Check the following questions below:</p>
	<div class="left" id="profile_completion_box">
	<p>
		What is your highest educational attainment?
	</p>
	<?php 
			if (!empty($this->data)){
				if ((!isset($this->data["MemberProfileAttributeWeight"]["educational_level_id"]))&&(isset($error))||(($this->data["MemberProfileAttributeWeight"]["educational_level_id"]=="")&&isset($error))){
					$class = "class = 'left error'";
				}else{
					$class = "class = 'left'";
				}
				
			}
		
		?>
		<div  <?php echo $class?>>
			<ul class="background_list left">
			
				<?php 
					echo $this->Form->radio("MemberProfileAttributeWeight.educational_level_id", $options, array("legend"=>false, "separator"=>"<li/><li>", "before"=>"<li>", "hiddenField"=>false, "after"=>"</li>"));
					$options = array();
					for($i;$i<count($educationalLevels);$i++){
						$options[$educationalLevels[$i]["EducationalLevel"]["id"]] = $educationalLevels[$i]["EducationalLevel"]["value"];
					}
					
				?>
			</ul>	
			<ul class="background_list left">
				<?php 
					echo $this->Form->radio("MemberProfileAttributeWeight.educational_level_id", $options, array("legend"=>false, "separator"=>"<li/><li>", "before"=>"<li>", "hiddenField"=>false, "after"=>"</li>"));
				?>
			</ul>
		</div>
		
		
		<div class="clear"></div>	
		<p>
			Current Civil Status
		</p>
		<?php
			$options = array();
			foreach($statuses as $status){
				$options[$status["MaritalStatus"]["id"]] = $status["MaritalStatus"]["value"];
			}		 
			
		?>
		<?php 
			if (!empty($this->data)){
				if ((!isset($this->data["MemberProfile"]["marital_status_id"]))&&(isset($error))){
					$class = "class = 'background_list error'";
				}else{
					$class = "class = 'background_list'";
				}
				
			}
		
		?>
		
		<ul <?php echo $class?>>  
		<?php 
		echo $this->Form->radio("MemberProfile.marital_status_id", $options, array("legend"=>false, "separator"=>"<li/><li>", "before"=>"<li>", "after"=>"</li>", 'hiddenField' => false));			
		?>
		</ul>
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
       						echo $this->Form->input("MemberProfileAnswer.$i.item_id", array("type"=>"radio", "legend"=>false, "label"=>false, "options"=>$options, "separator"=>"</li><li>", "before"=>"<li>", "after"=>"</li>",'hiddenField' => false));		
       						echo $this->Form->input("MemberProfileAnswer.$i.question_id", array("type"=>"hidden","id"=>"answer", "value"=>$question["ProfileQuestion"]["id"]));
       					?>
       				</ul>
       				<?php 
       				
       				$i++;
       			}
       		
       		?>      
			<p class="image_set_bottom left">
				<span class="button left">
					<button type="submit"><span>Save and Continue</span></button>	
				</span>
			</p>
	</div>
</div>
							