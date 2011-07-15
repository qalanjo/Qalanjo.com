<div class="results span-14">
	<?php
	if (isset($members)){
		foreach ($members as $member){
		?>
		<div class="member_profile_quick span-14 last">
			<div class="picture span-3 append-1">
				<?php 
					echo $this->Html->image("uploads/".$member["Member"]["id"]."/default/profile_thumb_".$member["MemberProfile"]["picture_path"]);
				?>
			</div>
			<div class="member_profile_detail span-10 last">
				<h2><?php echo $member["Member"]["firstname"]." ".$member["Member"]["lastname"]?></h2>
				<p>years old</p>				
			</div>
			
		</div>
		<?php 
			}
	
		?>
		<div id="paginator">
			<?php 
				if (!($page-1<=0)){
					$prev = $page-1;
					echo $this->Html->link("<<Previous", "/members/find_by_criteria/$option/page:$prev/page_count:$page_count");
				}
			?>
			<ul>
			<?php 
				$total = floor($record_total/$page_count)+1;
				for($i=1;$i<$total;$i++){
					$class = "";
					if ($page==$i){
						$class = "class = 'current'";
					}
					$link = $this->Html->link($i, "/members/find_by_criteria/$option/page:$i/page_count:$page_count");
					echo "<li $class>$link</li>";		
				}
			?>
			</ul>
			<?php 
				if (($page+1)==floor($record_total/$page_count)){
					$next = $page+1;
					echo $this->Html->link("Next", "/members/find_by_criteria/$option/page:$next/page_count:$page_count");
				}
			?>
		</div>
	<?php }else{
		echo $this->Session->flash();
	}?>
</div>