<div class="full_block">
	<div id="search_quick" class="prepend-1 span-10 search_form">
		<?php 
			echo $this->Form->create("Member", array("class"=>"ui-helper-clearfix"));
			echo "<div class='span-10 last'>";
				echo $this->Form->label("Member.looking_for_id", "I am seeking for a", array("class"=>"span-3"));
				echo $this->Form->input("Member.looking_for_id", array("label"=>false, "div"=>"span-6 last", "type"=>"select", "options"=>$genders));	
			echo "</div>";
			echo "<div class='span-10 last'>";
				echo $this->Form->label("Member.country_id", "Country", array("class"=>"span-3"));
				echo $this->Form->input("Member.country_id", array("label"=>false, "div"=>"span-6 last", "type"=>"select", "options"=>$countries));
			echo "</div>";
			echo "<div class='span-10 last'>";
				echo $this->Form->label("Member.range", "Between ages", array("class"=>"span-3"));
				echo $this->Form->input("Member.from", array("label"=>false, "div"=>"span-1", "class"=>"numeric age", "value"=>18));	
				echo $this->Form->label("Member.to", "and", array("class"=>"span-1 calign"));
				echo $this->Form->input("Member.to", array("label"=>false, "div"=>"span-1 last", "class"=>"numeric age", "value"=>60));	
			echo "</div>";
			echo "<div class='span-10 last'>";
				echo $this->Form->label("Member.zipcode", "Zip Code:", array("class"=>"span-3"));
				echo "<div class='ui-corner-all'>";
					echo $this->Form->input("Member.zipcode", array("label"=>false, "div"=>"span-6 last"));
				echo "</div>";
			echo "</div>";
			
			echo "<div class='span-10 last'>";
				echo $this->Form->input("Member.show_picture", array("label"=>"Show only profiles with pictures", "type"=>"checkbox", "div"=>"check"));
			echo "</div>";
			echo "<div class='span-10 last'>";
				echo $this->Ajax->submit("Search", array("url"=>"/members/find_by_criteria/1", "update"=>"search_result", "div"=>false));
			echo "</div>";
			echo $this->Form->end();			
		?>
	</div>
	<div class="span-6">
	
	</div>
</div>