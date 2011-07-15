<?php 
	$this->Html->css(array("blue/profile_building/profile-building"), "stylesheet", array("inline"=>false));
	$this->Javascript->link(array("blue/members/profile_completion"), false);

?>
<div class="item-set-content left">
	<?php 
		echo $this->element("blue/profile_building/form");
	?>
	<ul class="block-set item-set-asset">
		<?php 
			echo $this->element("blue/profile_building/radioset", array("order"=>array(0)));
		?>
	</ul>
	<ul class="block-set block-set-blue ">
		<li>
			<dl class="radio-set">
				<dt>
					What do you usually do during your leisure time?
				</dt>
				<dl>
					<div class="radio-set">
						<label>
							<?php 
								echo $this->Form->input("MemberProfile.leisure_activity", array("rows"=>"5", "cols"=>60, "class"=>"Multilinebox",  "div"=>false, "label"=>false));
							?>
						</label>
						<br />
					</div>
				</dl>
			</dl>
		</li>
		<?php 
			echo $this->element("blue/profile_building/radioset", array("order"=>array(1)));
		?>
	
	</ul>
	
	<ul class="block-set block-set-blue item-set-telme">
		<li>
			<dl class="radio-set">
				<dt>
					Tell something briefly about what you are passionate about.
				</dt>
				<dl>
					<div class="radio-set">
	
						<label>
							<?php 
								echo $this->Form->input("MemberProfile.passionate_about", array("rows"=>50, "cols"=>5, "class"=>"Multilinebox", "div"=>false, "label"=>false));
	                        ?>
						</label>
						<br />
					</div>
				</dl>
			</dl>
		</li>
		<li>
			<dl class="radio-set">
				<dt>
					Tell something briefly about what you were looking for a match.
				</dt>
				<dl>
					<div class="radio-set">
	
						<label>
							<?php 
								echo $this->Form->input("MemberProfile.passionate_about", array("rows"=>50, "cols"=>5, "div"=>false, "class"=>"Multilinebox", "label"=>false));
	                        ?>
						</label>
						<br />
					</div>
				</dl>
			</dl>
		</li>
		<li>
			<dl class="radio-set">
				<dt>
					Tell something briefly that you want to say to your match.
				</dt>
				<dl>
					<div class="radio-set">
	
						<label>
							<?php 
								echo $this->Form->input("MemberProfile.match_want", array("rows"=>50, "cols"=>5, "div"=>false, "class"=>"Multilinebox", "label"=>false));
	                        ?>
						</label>
						<br />
					</div>
				</dl>
			</dl>
		</li>
	</ul>
	<div class="button-set">
		<p>
			<strong>Thank you for answering all the questions.</strong> Kindly save and continue.
		</p>
		<button class="clear save-and-continue" type="submit">
		</button>
	</div>
	<?php echo $this->Form->end()?>
</div>