<div class="item-set-content left">
<?php 
	$this->Html->css("blue/profile_building/personality-assessment", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/questionnaire/questionset-".($page+4), "stylesheet", array("inline"=>false));
	$this->Javascript->link("blue/attributes/questionnaire", false);
	echo $this->Form->create("MemberAttributeWeight", array("url"=>"/attributes/questionnaire/".($page+1)));
?>
<?php 
	$i = 1;
	$j=0;
	foreach($items as $itemSet){
		if (empty($itemSet)){
			continue;
		}
		if ($i%2==1){
			$class = "block-set block-set-blue sliders item-".$i;
		}else{
			$class = "block-set sliders item-".$i;
		}
		?>
		<ul class="<?php echo $class?>">
			<li class="li-slider-header">
            	<div class="col1 left">&nbsp;</div>
            	<ul class="slider-header col2 left">
            		<li>
            			Strongly<br/> Agree
            		</li>
            		<li>
            			Agree
            		</li>
            		<li>
            			Neither Agree or<br/> Disagree
            		</li>
            		<li>
            			Disagree
            		</li>
            		<li>
            			Strongly <br/>Disagree
            		</li>
            		
               	</ul>
            </li>
               							
			<?php
				
				foreach($itemSet as $question){
					?>
					<li class="item clear">
               			<div class="col1 left"><?php echo $question["Attribute"]["question"]?></div>
               			<div class="col2 left"><div class="slider" id="slider_<?php echo $question["Attribute"]["id"]?>"></div>
               			</div>
               		</li>
               		<?php 
						$out = "";
						$out.=$this->Form->input("MemberAttributeWeight.$j.weight", array("type"=>"hidden", "id"=>"weight".$question["Attribute"]["id"],"value"=>1));
						$out.=$this->Form->input("MemberAttributeWeight.$j.attribute_id", array("type"=>"hidden", "value"=>$question["Attribute"]["id"]));
						$out.=$this->Form->input("MemberAttributeWeight.$j.member_id", array("type"=>"hidden", "value"=>$member_id));
						echo $out;
						$j++;
					?>
					<?php 
				}
			?>					
		</ul>
		<?php 
		$i++;
	}
?>
<div class="button-set">
	<p><strong>Thank you for answering all the questions.</strong> Kindly save and continue.</p>
	<button class="clear save-and-continue" type="submit"></button>
</div>	
<?php 
	echo $this->Form->end();
?>
</div>