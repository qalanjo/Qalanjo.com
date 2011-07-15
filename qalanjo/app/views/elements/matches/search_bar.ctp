<div class="search_bar span-14 last">
	<?php 
		echo $this->Form->create("Matches");
		echo $this->Form->input("Match.sk", array("type"=>"hidden"));
	?>
	<div class="span-1">
		Search:
	</div>
	<div class="span-9">
		<?php 
			echo $this->Form->input("Match.search", array("div"=>false, "label"=>false));
		?>
	</div>
	<div class="span-4 last">
		<?php 
			echo $this->Ajax->submit("Search", array("url"=>"/matches/search", "div"=>false, "label"=>false, "update"=>"matches"));
		?>
	</div>
	<?php echo $this->Form->end();?>
</div>