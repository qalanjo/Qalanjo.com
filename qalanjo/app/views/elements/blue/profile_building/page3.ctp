<?php 
	$this->Html->css(array("blue/profile_building/profile-building"), "stylesheet", array("inline"=>false));
	$this->Javascript->link(array("blue/members/profile_completion"), false);
	?>
<div class="item-set-content left">
		<?php 
			echo $this->element("blue/profile_building/form");
			$before = "<label class='clear'>";
			$after = "</label>";
			$separator = "</label><br/><label class='clear'>";
		?>
		<ul class="block-set block-set-blue item-set-graduates">
			<?php 
				if (!empty($this->data)){
					if ((!isset($this->data["MemberProfileAttributeWeight"]["educational_level_id"]))&&(isset($error))||(($this->data["MemberProfileAttributeWeight"]["educational_level_id"]=="")&&isset($error))){
						$class = "class = 'left error'";
					}else{
						$class = "class = 'left'";
					}	
				}
			?>
			<li>
				<dl class="radio-set">
					<dt>
						What is your highest educational attainment?
					</dt>
					<dd>
						<div class="radio-set">
							<?php 
								$options = array();
								for($i=0;$i<count($educationalLevels);$i++){
									$options[$educationalLevels[$i]["EducationalLevel"]["id"]] = $educationalLevels[$i]["EducationalLevel"]["value"];
								}
								echo $this->Form->radio("MemberProfileAttributeWeight.educational_level_id", $options, array("legend"=>false, "separator"=>$separator, "before"=>$before, "hiddenField"=>false, "after"=>$after));
								
							?>
						</div>
					</dd>
				</dl>
			</li>
			<?php
				$options = array();
				foreach($statuses as $status){
					$options[$status["MaritalStatus"]["id"]] = $status["MaritalStatus"]["value"];
				}
			?>
			<?php 
				if (!empty($this->data)){
					if ((!isset($this->data["MemberProfile"]["marital_status_id"]))&&(isset($error))){
						$class = "class = 'background_list error'";
					}else{
						$class = "class = 'background_list'";
					}	
				}
			?>
			<li>
				<dl class="radio-set">
					<dt>
						Your current civil status
					</dt>
					<dd>
						<div class="radio-set">
							<?php 
							echo $this->Form->radio("MemberProfile.marital_status_id", $options, array("legend"=>false, "separator"=>$separator, "before"=>$before, "after"=>$after, 'hiddenField' => false));			
							?>
						</div>
					</dd>
				</dl>
			</li>
			<?php 
				echo $this->element("blue/profile_building/radioset", array("order"=>array(0, 4)));
			?>
		</ul>
        <h2 class="floatpart"><span>Openness</span><span class="line"></span></h2>
        <ul class="block-set block-set-blue item-set-job">
        	<?php 
				echo $this->element("blue/profile_building/radioset", array("order"=>array(1, 2, 3)));
			?>
			<li>
				<label> What is your current occupation?</label>
				<br />
				<?php 
       				echo $this->Form->input("MemberProfile.occupation", array("id"=>"occupation", "div"=>false, "label"=>false))
       			?>	
					
				
			</li>
			<li>
				<label> Say something about your current job.</label>
				<br />
				<?php 
					echo $this->Form->input("MemberProfile.current_job", array("rows"=>"5", "cols"=>60,"div"=>false, "label"=>false));
				?>
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