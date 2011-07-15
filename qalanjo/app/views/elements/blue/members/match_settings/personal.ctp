<div class="content-container">
	<div id="header-wrap" class="left clear">
		<div id="header-title" class="left half">
			<p>My Settings</p>
		</div>
		
		<div id="header-links" class="left half">
			<ul>
			<li class="active-link">
			Match Settings
			</li>
			<li>|</li>
			<li>
			<?php 
				echo $this->Html->link("Account Settings", "/members/account")
			?></li>
			</ul>
		</div>
	</div>
	
	<?php if ($role==2){?>
		<div id="teaser" class="left clear">
			<p>Join Qalanjo and take the next step towards finding your soul mate! <span><?php echo $this->Html->link("Join Qalanjo", "/subscribe")?></span></p>
		</div>
	<?php }?>
	<div id="excerpt-text" class="left clear">
	<p><span class="bold">We encourage you to keep your match settings as broad as possible.</span> Narrow selections may restrict the number of matches you receive.</p>
	</div>
	
	
	<div class="left clear">
		<?php 
			echo $this->Session->flash();
		?>
	</div>
	
	<div id="main-wrap">
		<?php echo $this->element("blue/members/match_settings/tab")?>
				<div class="tab-content-container-top left clear">
				</div>
				<?php echo $this->Form->create("Member", array("url"=>"/members/match_settings/personal"))?>	
				<?php echo $this->Form->input("Member.id")?>
				<?php echo $this->Form->input("MemberSetting.member_id", array("type"=>"hidden"))?>
				<?php echo $this->Form->input("MemberSetting.id", array("type"=>"hidden"))?>
				
				<div class="m-container left clear">
					
					<div class="col-container-wrap left clear">
						<div class="left col-left">															
							<div class="title-wrapper">
							<h4 class="bold">Smoking</h4>
							<p>How much do you smoke?</p>
							<?php 
								echo $this->Form->input("Member.smoking", array("class"=>"span-5 last", "options"=>$smoking, "selected"=>$selectedSmoke["MemberProfileAnswer"]["profile_answer_id"], "label"=>false));
							?>
							</div>
						
						</div>
						
						<div class="left col-right p-top">
						<div class="title-wrapper">											
							<p>Please indicate the most that you would accept that your ideal match smoke.</p>
							
							<?php 
								echo $this->Form->input("MemberSetting.smoking", array("class"=>"span-5 last", "options"=>$smoking, "selected"=>$this->data["MemberSetting"]["smoking"], "label"=>false));						
							?>						
							</div>
																	
						</div>
						<div class="line clear"></div>
					</div>
					
					<div class="col-container-wrap left clear">
						<div class="left col-left">															
							<div class="title-wrapper">
							<h4 class="bold">Drinking</h4>
							<p>How much do you drink?</p>
							<?php 
								echo $this->Form->input("Member.drinking", array("class"=>"span-5 last", "options"=>$drinking,"selected"=>$selectedDrink["MemberProfileAnswer"]["profile_answer_id"], "label"=>false));
							
							?>
							</div>
						
						</div>
						
						<div class="left col-right p-top">
						<div class="title-wrapper">											
							<p>Please indicate the most that you would accept that your ideal match drink.</p>
							<?php 
								echo $this->Form->input("MemberSetting.drinking", array("class"=>"span-5 last", "options"=>$drinking, "selected"=>$this->data["MemberSetting"]["drinking"], "label"=>false));						
							?>	
						</div>
																	
						</div>
						<div class="line clear"></div>
					</div>
					
					<div class="col-container-wrap left clear">
						<div class="left col-left">															
							<div class="title-wrapper">
							<h4 class="bold">Age</h4>
							<p>Your Age is <?php echo $age;
							?>
							</p>											
							</div>
						
						</div>
						
						<div class="left col-right p-top div-age">
						<div class="title-wrapper">											
							<p>I would like my matches to be between the ages of 
							<?php echo $this->Form->input("MemberSetting.age_from", array("div"=>false, "class"=>"age","label"=>false, "size"=>3))?>
							
							 to <?php echo $this->Form->input("MemberSetting.age_to", array("div"=>false, "class"=>"age","label"=>false, "size"=>3))?></p>
							</div>
																	
						</div>
						<div class="line clear"></div>
						
						<div id="buttons">
						<button class="left cancel" name="Cancel" value="Cancel" type="submit">
						<p>Cancel</p>
						</button>
						<button class="left save" name="Save" value="Save" type="submit">
						<p>Save</p>
						</button>
						</div>
					</div>
				</div>
				<?php echo $this->Form->end()?>				
	</div>
</div>