<div class="main-content-tab-bar left clear">
	<ul>
	
		<?php if ($type=="basic"){?>
			<li  class="active">
				
				<?php 
					echo $this->Html->link("<span class=\"tab-left\"></span>
					<span>Basic Preferences</span>
					<span class=\"tab-right\"></span>", "/members/match_settings/basic", array("escape"=>false));
				?>
				
			</li>
			<li>
				<?php 
					echo $this->Html->link("<span class=\"tab-left\"></span>
					<span>Distance</span>
					<span class=\"tab-right\"></span>", "/members/match_settings/distance", array("escape"=>false));
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("<span class=\"tab-left\"></span>
					<span>Personal Preferences</span>
					<span class=\"tab-right\"></span>", "/members/match_settings/personal", array("escape"=>false));
				?>
			</li>
		<?php }else if ($type=="distance"){
		?>
			<li>
				
				<?php 
					echo $this->Html->link("<span class=\"tab-left\"></span>
					<span>Basic Preferences</span>
					<span class=\"tab-right\"></span>", "/members/match_settings/basic", array("escape"=>false));
				?>
				
			</li>
			<li class="active">
				<?php 
					echo $this->Html->link("<span class=\"tab-left\"></span>
					<span>Distance</span>
					<span class=\"tab-right\"></span>", "/members/match_settings/distance", array("escape"=>false));
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("<span class=\"tab-left\"></span>
					<span>Personal Preferences</span>
					<span class=\"tab-right\"></span>", "/members/match_settings/personal", array("escape"=>false));
				?>
			</li>	
		<?php 
		}else if ($type=="personal"){
		?>
			<li>
				
				<?php 
					echo $this->Html->link("<span class=\"tab-left\"></span>
					<span>Basic Preferences</span>
					<span class=\"tab-right\"></span>", "/members/match_settings/basic", array("escape"=>false));
				?>
				
			</li>
			<li>
				<?php 
					echo $this->Html->link("<span class=\"tab-left\"></span>
					<span>Distance</span>
					<span class=\"tab-right\"></span>", "/members/match_settings/distance", array("escape"=>false));
				?>
			</li>
			<li class="active">
				<?php 
					echo $this->Html->link("<span class=\"tab-left\"></span>
					<span>Personal Preferences</span>
					<span class=\"tab-right\"></span>", "/members/match_settings/personal", array("escape"=>false));
				?>
			</li>	
		<?php 
		}?>		
	</ul>
</div>