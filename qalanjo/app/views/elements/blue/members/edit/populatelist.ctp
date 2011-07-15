<?php 
/**
 * 
 * Populate list for the interest ...
 * @version 0.0.1
 * 
 */

$i = 0;
foreach($interests["Interest"] as $interest){
	?>
	<li class="answer<?php echo $i+1?>">
		<label>
			<em></em>
			<?php 
				$found = false;

				foreach($this->data["MembersInterest"] as $temp){
					if ($interest["id"]==$temp["interest_id"]){
						echo $this->Form->checkbox("Interest.$i.interest_id", 
									array("value"=>$interest["id"],
									 'hiddenField' => false,
									 "div"=>false,
									 "label"=>false, 
									 "class"=>"control-check",
									"checked"=>"checked"));
						echo $this->Form->input("Interest.$i.member_id", 
									array("type"=>"hidden",
										"value"=>$this->data["Member"]["id"]));
						echo $this->Form->input("Interest.$i.interest_type_id",
									array("type"=>"hidden",
										"value"=>$interests["InterestType"]["id"]));
						$found =  true;
						break;	
					}
				}
				if (!$found){
					echo $this->Form->checkbox("Interest.$i.interest_id", 
								array("value"=>$interest["id"],
								 'hiddenField' => false,
								 "div"=>false,
								 "label"=>false, 
								 "class"=>"control-check"));
					echo $this->Form->input("Interest.$i.member_id", 
								array("type"=>"hidden",
									"value"=>$this->data["Member"]["id"]));
					echo $this->Form->input("Interest.$i.interest_type_id",
								array("type"=>"hidden",
									"value"=>$interests["InterestType"]["id"]));
					
					
				}
							
			?>
			<span><?php echo $interest["description"]?></span>
		
		</label>
	</li>
	<?php
		$i++; 
	}
?>