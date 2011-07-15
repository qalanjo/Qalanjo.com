<div class="left" id="content_header">
	<h2>Physical Appearance con't</h2>
</div>
<div class="left" id="content_main">
	<p class="instruction">Your Hair Length.</p>
	
	<div class="left" id="profile_completion_box">
	
	<?php 
		$i=0;
		$first = 0;
		foreach($questions[0]["ProfileAnswer"] as $answer){
			if ($i==0){
				$class="class = 'active'";
				$first = $answer["id"];
			}else{
				$class = "";
			}
			?>
			<div class="profile_box">
				<a <?php echo $class?> id="item_<?php echo $answer["id"]?>">
					<div class="left">
						<div class="profile_border_image">
							<?php 
								$path = "designs/blue/members/profile_completion/page2/";
								if ($this->data["Gender"]["value"]=="Man"){
									if ($answer["answer"]=="Short"){
										$path.="short_hair_male.jpg";
									}else if ($answer["answer"]=="Medium"){
										$path.="medium_hair_male.jpg";
									}else if ($answer["answer"]=="Shoulder length"){
										$path.="clean_hair_male.jpg";
									}else if ($answer["answer"]=="Long"){
										$path.="long_hair_male.jpg";
									}
								}else{
									if ($answer["answer"]=="Short"){
										$path.="short_hair.jpg";
									}else if ($answer["answer"]=="Medium"){
										$path.="medium_hair.jpg";
									}else if ($answer["answer"]=="Shoulder length"){
										$path.="shoulder_length_hair.jpg";
									}else if ($answer["answer"]=="Long"){
										$path.="long_hair.jpg";
									}
								}
							
							?>
							
							
							<?php 
								echo $this->Html->image($path, array("alt"=>$answer["answer"]))
							?>
							<div class="clear"></div>
						</div>                      
							<p class="color_text">
								<?php 
									if ($this->data["Gender"]["value"]=="Man"){
										if ($answer["answer"]=="Shoulder length"){
											echo "Clean";
										}else{									
											echo $answer["answer"];
										}
									}
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