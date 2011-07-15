
<?php 
	$this->Html->css("blue/settings", "stylesheet", array("inline"=>false));
	$this->Javascript->link("blue/members/account", false);
?>
<div class="content-container">
	<div class="settings-container left">
		<div class="left settings-header">					
			<h1 class='left'>My Settings</h1>
			<ul class="controls right">
				<li>
					<?php 
						echo $this->Html->link("<span class=\"left\">Match Settings</span>", 
											"/members/match_settings", array("escape"=>false));
					?>
				</li>
				<li>
					|
				</li>
				<li class="active">
					<a href="#" class="left">
						<span class="left">Account Settings</span>
					</a>
					<?php 
						echo $this->Html->image("/css/img/blue/settings/screw.png");
					?>
				</li>
			</ul>
		</div>
		<div id="summary" class="error left">
			We have found 8 errors, see details below.
		</div>
		<div id="settings-container" class="settings-content-container left clear">
			<div class="left-navigation left">
				<ul class="left">
					<li class="active">
						<?php 
							echo $this->Html->link("<span>General Information</span>", "/members/account/general", array("escape"=>false));
						?>
					</li>
					<li>
						<?php 
							echo $this->Html->link("<span>Profile Picture</span>", "/members/account/profile_picture", array("escape"=>false));
						?>
					</li>
					<li>
						<?php 
							echo $this->Html->link("<span>Billing Address</span>", "/members/account/billing", array("escape"=>false));
						?>
					</li>
					<li>
						<?php 
							echo $this->Html->link("<span>Subscription</span>", "/members/account/subscribe", array("escape"=>false));
						?>
					</li>
				</ul>
				
			</div>
			<div id="account-settings-content" class="account-settings-content left">
				<div class="spinner"></div>
			</div>
		</div>
	</div>	
</div>
<div id="result" class="left">
</div>