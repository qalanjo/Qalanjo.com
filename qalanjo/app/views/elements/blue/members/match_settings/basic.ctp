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
			<?php echo $this->Form->create("Member", array("url"=>"/members/match_settings/basic"))?>	
			<?php echo $this->Form->input("Member.id")?>
			<?php echo $this->Form->input("MemberSetting.member_id", array("type"=>"hidden", "value"=>$member_id))?>
			<?php echo $this->Form->input("MemberSetting.id", array("type"=>"hidden"))?>
			
			
			<div class="m-container left clear">
				
				<?php /*?>
				<div class="title-wrapper">
					<h4 class="bold">Matching</h4>
					<p>Matching Choices</p>
				</div>
				
				<div class="choices">
					<ul>
					<li><input type="radio"> Yes, please send me new matches.</li>
					<li><input type="radio"> No, please do not send me new matches until I say otherwise.</li>
					</ul>
				</div>
				<div class="line"></div>
				*/?>
				
				<div class="title-wrapper">
					<h4 class="bold">Auto-Archive</h4>										
				</div>
				<div class="choices">
				
					
					<ul>
					<?php 		
						echo $this->Form->input("MemberSetting.auto_archive",
							 array("legend"=>false,
							  "before"=>" <li>",
							  "after"=>" </li>",
							 "separator"=>"</li><li>",
							 "div"=>false,
							 "between"=>"",
							  "options"=>$auto_archive,
							 "type"=>"radio"));				
			
					?>
					</ul>
				</div>
				
				<div id="buttons">
				<button type="submit" value="Cancel" class="left cancel">
				<p>Cancel</p>
				</button>
				
				<button type="submit" value="Save" class="left save">
				<p>Save</p>
				</button>
				
				</div>
			</div>
			<?php echo $this->Form->end();?>					
	</div>
</div>