<div id="header">
	<div id="header-container">
		<div id="header-logo" class="span-6">
		</div>
		<div id="header-others" class="span-18 last">
			<div id="header-others-top" class="span-18 last">
				<div class="right">
					<?php echo $this->Html->link("Logout", "/logout")?>
				</div>
			</div>
			<div id="header-others-bottom" class="span-18 last">
				<ul>
					<?php 
						if ($process=="profile"){
							?>
							<li><?php echo $this->Html->link("Account", "/members/account")?></li>
							<li class="active"><?php echo $this->Html->link("Profile", "/profile/".$member["Member"]["id"])?></li>
							<li><?php echo $this->Html->link("Home", "/welcome")?></li>
							<?php 			
						}else if ($process=="home"){
							?>
							<li><?php echo $this->Html->link("Account", "/members/account")?></li>
							<li><?php echo $this->Html->link("Profile", "/profile/".$member["Member"]["id"])?></li>
							<li class="active"><?php echo $this->Html->link("Home", "/welcome")?></li>
							<?php 
						}else{
							?>
							<li class="active"><?php echo $this->Html->link("Account", "/members/account")?></li>
							<li><?php echo $this->Html->link("Profile", "/profile/".$member["Member"]["id"])?></li>
							<li><?php echo $this->Html->link("Home", "/welcome")?></li>
							<?php
						}
					
					?>
				</ul>
				<?php 
					if (isset($member)){
				?>
				<form method="post" action="#" id="search-form">
					<input type="text" id="search-box"></input>
					<button type="submit" id="search-button"></button>
				</form>
				<?php 
					}
				?>
			</div>
		</div>
	</div>
	<div id="content-wrap-top">
	</div>
</div>