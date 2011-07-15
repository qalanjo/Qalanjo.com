<?php 
		foreach($matches as $match){
		?>
		<div class="quick_match span-15 last">
			<div class="span-3">
				<?php echo $this->element("members/profile_thumb", array("member"=>$match))?>
			</div>
			<div class="span-8 prepend-1">
				<div class="span-8 last">
					<h2 class="match_name">
						<?php 
							$name = $match["Member"]["firstname"]." ".$match["Member"]["lastname"];
							echo $this->Html->link($name, "/profile/".$match["Member"]["id"]);
							echo ", ".$match["Member"]["age"]." years old"
						?>
					
					</h2>
				</div>
				<div class="span-8 last match_status">
					<h2 class="status"><?php echo $match["MemberProfile"]["status"]?>
					</h2>	
				</div>
			</div>
			<div class="span-3 last">
				<div class="span-3 last">
					<p>
						<?php 
							if ($match["Gender"]["value"]=="Man"){
								echo "He's";
							
							}else{
								echo "She's";
							}
						?>
						a match.
					</p>
				</div>
				<div class="span-2 last">
					<?php 
						echo $this->Html->link("View Profile", "/profile/".$match["Member"]["id"]);
					?>
				</div>
				
			
			</div>
			
		</div>
	<?php 			
		}
	
	?>