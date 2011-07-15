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
	<div id="content-wrap-top">
	</div>
</div>