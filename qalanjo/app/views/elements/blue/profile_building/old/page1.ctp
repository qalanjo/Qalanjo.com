<div class="left" id="content_header">
	<h2>Physical Appearance</h2>
</div>
<div class="left" id="content_main">
	<p class="instruction">Your Eye Color.</p>
	
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
								$path = "designs/blue/members/profile_completion/page1/";
								if ($this->data["Gender"]["value"]=="Man"){
									if ($answer["answer"]=="Black"){
										$path.="black_eye_male.jpg";
									}else if ($answer["answer"]=="Blue"){
										$path.="blue_eye_male.jpg";
									}else if ($answer["answer"]=="Gray"){
										$path.="gray_eye_male.jpg";
									}else if ($answer["answer"]=="Brown"){
										$path.="brown_eye_male.jpg";
									}else if ($answer["answer"]=="Green"){
										$path.="green_eye_male.jpg";
									}
								}else{
									if ($answer["answer"]=="Black"){
										$path.="black_eye.jpg";
									}else if ($answer["answer"]=="Blue"){
										$path.="blue_eye.jpg";
									}else if ($answer["answer"]=="Gray"){
										$path.="gray_eye.jpg";
									}else if ($answer["answer"]=="Brown"){
										$path.="brown_eye.jpg";
									}else if ($answer["answer"]=="Green"){
										$path.="green_eye.jpg";
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