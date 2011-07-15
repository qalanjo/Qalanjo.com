<div class="left" id="content_header">
	<h2>Physical Appearance</h2>
</div>
<div class="left" id="content_main">
	<p class="instruction">Your Hair Color.</p>
	
	<?php echo $this->Form->create("")?>
	<div class="left" id="profile_completion_box">
	
	<?php 
		$i=0;
		$first = 0;
		foreach($questions[0]["ProfileAnswer"] as $answer){
			if ($i==0){
				$class="class = 'active'";
				$first = $answer["id"];
			}
			else{
				$class = "";
			}
			
			if (count($questions[0]["ProfileAnswer"])==($i+1)){
				$center =  "class='profile_box center'";				
			}else{
				$center =  "class='profile_box'";
			}
			
			?>
			<div <?php echo $center?>>
				<a <?php echo $class?> id="item_<?php echo $answer["id"]?>">
					<div class="left">
						<div class="profile_border_image">
							<?php 
								if ($this->data["Gender"]["value"]=="Man"){
									$path = "designs/blue/members/profile_completion/page3/".strtolower($answer["answer"])."_hair_male.jpg";
								}else{
									$path = "designs/blue/members/profile_completion/page3/".strtolower($answer["answer"])."_hair.jpg";
								}
							?>
							
							
							<?php 
								echo $this->Html->image($path, array("alt"=>$answer["answer"]))
							?>
							<div class="clear"></div>
						</div>                      
							<p class="color_text">
								<?php 
									echo $answer["answer"];
								?>
							</p>                    
					</div>
				</a>
			</div>
			<?php	
			$i++;
			
		}
    	echo $this->Form->input("MemberProfileAnswer.0.item_id", array("type"=>"hidden","id"=>"answer", "value"=>$first));
    	echo $this->Form->input("MemberProfileAnswer.0.question_id", array("type"=>"hidden", "value"=>$questions[0]["ProfileQuestion"]["id"]));
    	
	?>
	 	<p class="image_set_bottom left">
            <span class="button left">
               <button type="submit"><span>Save and Continue</span></button>		
           </span>
       </p>
    </div>
    
</div>