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
				
				<?php echo $this->Form->create("Member", array("url"=>"/members/match_settings/distance"))?>	
				<?php echo $this->Form->input("Member.id")?>
				<?php echo $this->Form->input("MemberSetting.member_id", array("type"=>"hidden"))?>
				<?php echo $this->Form->input("MemberSetting.id", array("type"=>"hidden"))?>
				<div class="m-container left clear">
					<div id="distance" class="left">
							<fieldset class="span-5">
							<div class="span-5 clear">
								<p class="span-5 last"><abbr>*</abbr> My  Zip/Postal Code:</p>												
							</div>
							<div class="span-5 clear">
								<?php 
									echo $this->Form->input("Member.zipcode", array("div"=>false, "label"=>false, "class"=>"span-5 last"));
								?>
							</div>
							<div class="span-5 clear">
								<p class="span-5 last"><abbr>*</abbr> My City:</p>											
							</div>
							<div class="span-5 clear">
								<?php 
									echo $this->Form->input("Member.city", array("div"=>false, "label"=>false, "class"=>"span-5 last"));
								?>					
							</div>
							
							<div class="span-5 clear">
								<p class="span-5 last"><abbr>*</abbr> My Country</p>										
							</div>
							<div class="span-5 clear">
								<?php 
									echo $this->Form->input("Member.country_id", array("div"=>false, "label"=>false, "options"=>$countries, "class"=>"span-5 last"));
								?>
							</div>
						</fieldset>										
						
					
							<div id="buttons">
							<button type="submit" value="Cancel" class="left cancel">
							<p>Cancel</p>
							</button>
							
							<button type="submit" value="Save" class="left save">
							<p>Save</p>
							</button>									
							</div>
					</div>
					
					<div id="how-far" class="left">
							<div class="span-12 clear">
								<p class="span-12 last">How far do you want us to search for your matches?</p>						
							</div>
							<div class="span-12 clear">
								<?php 
									echo $this->Form->input("MemberSetting.distance_id", array("div"=>false, "label"=>false, "options"=>$distances, "class"=>"span-10 last"));
								?>
							</div>											
					</div>
				</div>
				<?php echo $this->Form->end();?>		
	</div>
</div>