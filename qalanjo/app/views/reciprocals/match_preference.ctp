<?php
foreach($items as $item){
	
}
$this->Html->css("blue/profile_building/reciprocal", "stylesheet", array("inline"=>false));
?>


<div class="item-set-content left">
	<?php echo $this->Form->create("MemberReciprocalWeight", array("url"=>"/reciprocals/match_preference/".$page))?>
		<?php 
			$i = 0;
			$j=0;
			foreach($items as $key => $item){
				foreach($item as $key=>$temp){
				if ($i%2==0){
					$class = " item-set-blue item-set-".strtolower($key);
				}else{
					$class = " item-set-".strtolower($key);
				}
				?>
				<h1 class="reciprocal-header left clear">
					<span class="titlereciprocal left"><?php echo $key?></span>
					<span class="yesorno right"> No</span>
					<span class="yesorno right">Yes</span>
				</h1>
				<ul class="block-set<?php echo $class?>">
					<li>
						<div class="spacing left">
							<ol start="<?php echo $j+1?>">
							<?php 
								foreach($temp as $temps){
									
									?>
									<li>
										<?php echo $temps["Reciprocal"]["question"]?>
									</li>
									<?php 
								}
							?>
							</ol>
						</div>
						<div class="spacing div right">
						<?php 
							foreach($temp as $temps){
								$options = array(0=>" ",1=>" ");
								?>
									
									<div>
										<?php 
											echo $this->Form->input("MemberReciprocalWeight.$j.weight", array("type"=>"radio", "before"=>"<label>", "separator"=>"</label><label>", "after"=>"</label>", "options"=>$options, "legend"=>false, "div"=>false, "label"=>false));
											echo $this->Form->input("MemberReciprocalWeight.$j.member_id", array("type"=>"hidden", "value"=>$member_id));
											echo $this->Form->input("MemberReciprocalWeight.$j.reciprocal_id", array("type"=>"hidden", "value"=>$temps["Reciprocal"]["id"]));
										?>
									
									</div>
								<?php 
								$j++;
							}
						?>
					
						</div>
					</li>
				</ul>
				<?php 
				
				?>
				<?php 
				$i++;
				}
				
			}
		?>
		
		<div class="button-set">
			<p>
				<strong>Thank you for answering all the questions.</strong> Kindly save and continue.
			</p>
			<button class="clear save-and-continue" type="submit">
			</button>
		</div>
	<?php echo $this->Form->end();?>
</div>
