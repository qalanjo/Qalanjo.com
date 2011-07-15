<div class="left" id="content_header">
	<h2>Physical Appearance cont'</h2>
</div>
	<div class="left" id="content_main">
		<p class="instruction">Your Body Build:</p>
       	<p class="image_set_top right">
       		<?php 
				$path = "designs/blue/members/profile_completion/page4/";
				echo $this->Html->image($path."woman1.png", array("alt"=>"Woman", "class"=>"right"));
			?>		
       	</p>
       	<div class="left" id="profile_completion_box">
       		<?php 
       			$i=0;
       			foreach($questions as $question){
       				if (isset($error)){
       					$class = $this->ProfileCompletor->validateIfSelected($this->data, $question, "physical_appearance_list");
       				}else{
       					$class = "class = 'physical_appearance_list'";
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
       						echo $this->Form->input("MemberProfileAnswer.$i.item_id", array("type"=>"radio", "label"=>false, "options"=>$options, "separator"=>"</li><li>", "before"=>"<li>", "after"=>"</li>",'hiddenField' => false, "legend"=>false));		
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