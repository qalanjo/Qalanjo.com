<ul>
	<?php 
		$i=0;
		foreach($items as $item){
			if ($i==0){
				$class = " class='first'";
			}else{
				$class = "";
			}
			?>
				<li<?php echo $class?>>
					<span class="left question"><?php echo $item["Attribute"]["question"]?></span>
					<div class="slider left" id="slider_<?php echo $item["Attribute"]["id"]?>">
						
					</div>
					<?php 
						$out = "";
						$out.=$this->Form->input("MemberAttributeWeight.$i.weight", array("type"=>"hidden", "id"=>"weight".$item["Attribute"]["id"],"value"=>1));
						$out.=$this->Form->input("MemberAttributeWeight.$i.attribute_id", array("type"=>"hidden", "value"=>$item["Attribute"]["id"]));
						$out.=$this->Form->input("MemberAttributeWeight.$i.member_id", array("type"=>"hidden", "value"=>$member_id));
						echo $out;
					?>							
				</li>						
			<?php 
			$i++;
		}
	?>
</ul>