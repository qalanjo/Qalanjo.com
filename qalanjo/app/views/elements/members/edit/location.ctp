
<div class="span-15 form_container last">
	<?php echo $this->Html->image("designs/member/edit/location_header.png")?>
</div>

<div class="span-14 form last">
<p class="instruction">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
<?php 
	echo $this->Form->create("Member", array("class"=>"ui-helper-clearfix ui-form"));
	echo $this->Form->input("Member.id", array("type"=>"hidden", "value"=>$member["Member"]["id"]));
	echo $this->Form->label("Member.country_id", "Country", array("class"=>"span-2"));
	echo "<div class='span-12 last'>";
		echo $this->Form->input("Member.country_id", array("div"=>false, "label"=>false, "options"=>$countries, "id"=>"country"));
	echo "</div>";
	echo $this->Form->label("Member.address1", "Address 1", array("class"=>"span-2"));
	echo "<div class='span-12 last'>";
		echo $this->Form->input("Member.address1", array("div"=>false, "label"=>false));
	echo "</div>";
	echo $this->Form->label("Member.address2", "Address 2", array("class"=>"span-2"));
	echo "<div class='span-12 last'>";
		echo $this->Form->input("Member.address2", array("div"=>false, "label"=>false));
	echo "</div>";
	echo $this->Form->label("Member.city", "City", array("class"=>"span-2"));
	echo "<div class='span-12 last'>";
		echo $this->Form->input("Member.city", array("div"=>false, "label"=>false, "class"=>"location"));
	echo "</div>";
	echo $this->Form->label("Member.state", "State", array("class"=>"span-2"));
	echo "<div class='span-12 last'>";
		echo $this->Form->input("Member.state", array("div"=>false, "label"=>false, "class"=>"location"));
	echo "</div>";
	
	echo $this->Form->input("sk", array("type"=>"hidden", "value"=>$sk));
	echo $this->Ajax->submit("Save", array("url"=>"/members/edit", "update"=>"updatable_div", "div"=>"span-12"));			
	echo $this->Form->end();
?>
</div>
<?php echo $this->element("scripts/country_trigger")?>