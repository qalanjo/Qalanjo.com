<div class="span-15 form_container last">
	<?php 
		$image = "designs/member/edit/".strtolower($type)."_header.png";
		echo $this->Html->image($image);
	?>
</div>

<div class="span-14 form" id="interests">
	<p class="instruction">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
	<?php 
		echo $this->Form->create("Member");
		$i=0;
		foreach($interests as $interest){
			$id = $interest["Interest"]["id"];
			if (($i+1)%7==0){
				$class="interest span-2 last";
			}else if (($i+1)==count($interests)){
				$class="interest span-2 last";
				
			}else{
				$class = "interest span-2";
			}
			
			
			
			
	?>
		<div class='<?php echo $class;?>' id="interest<?php echo $id?>">
			<?php
				$interest_type = $interest["InterestType"]["description"]; 
				strtolower($interest_type);
				echo $this->Html->image("designs/member/profile/".$interest_type."_loading.png", array("id"=>"pic_interest_".$id));
			?>
			<?php 
				echo $this->Form->input("Interest.$i.interest_id", array("type"=>"hidden", "value"=>$id));
				echo $this->Form->input("Interest.$i.member_id", array("type"=>"hidden", "value"=>$member_id));
				echo $this->Form->input("Interest.$i.interest_type_id", array("type"=>"hidden", "value"=>$interest["InterestType"]["id"]));
				echo $this->Form->input("Interest.$i.selected", array("type"=>"checkbox", "label"=>$interest["Interest"]["description"]));
				
				echo $this->element("members/edit/flickr", array("description"=>$interest["Interest"]["description"], "picture"=>"pic_interest_".$id, "type"=>$interest_type));
			?>
		</div>
	<?php 	
			$i++;
		}
		echo $this->Form->submit("Save", array("div"=>"clear"));
		echo $this->Form->end();
	?>

</div>
