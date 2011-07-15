<div class="span-15 form_container last">
	<?php echo $this->Html->image("designs/member/edit/education_header.png")?>
</div>


<div class="span-14 form">
	<p class="instruction">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
<?php 

	echo $this->Form->create("Member");
	echo $this->Form->input("Member.id", array("type"=>"hidden", "value"=>$member["Member"]["id"]));
	echo $this->Form->input("MemberProfileAttributeWeight.id", array("type"=>"hidden", "value"=>$member["MemberProfileAttributeWeight"]["id"]));
	echo $this->Form->input("MemberProfile.id", array("type"=>"hidden", "value"=>$member["MemberProfile"]["id"]));
	
	echo $this->Form->label("MemberProfile.employer", "Employer", array("class"=>"span-4"));
	echo "<div class='span-10 last'>";
		echo $this->Form->input("MemberProfile.employer", array("div"=>false, "label"=>false));
	echo "</div>";
	
	echo $this->Form->label("MemberProfileAttributeWeight.educational_level_id", "Highest educational attainment", array("class"=>"span-4 clear"));
	echo "<div class='span-10 last'>";
		echo $this->Form->input("MemberProfileAttributeWeight.educational_level_id", array("div"=>false, "label"=>false, "type"=>"select", "options"=>$educationalLevels));
	echo "</div>";
	
	echo $this->Form->label("MemberProfile.college", "College", array("class"=>"span-4 clear"));
	echo "<div class='span-10 last'>";
		echo $this->Form->input("MemberProfile.college", array("div"=>false, "label"=>false));
	echo "</div>";
	echo $this->Form->label("MemberProfile.highschool", "High School", array("class"=>"span-4 clear"));
	echo "<div class='span-10 last'>";
		echo $this->Form->input("MemberProfile.highschool", array("div"=>false, "label"=>false));
	echo "</div>";	
	echo $this->Form->input("sk", array("type"=>"hidden", "value"=>$sk));
	echo $this->Ajax->submit("Save", array("url"=>"/members/edit", "update"=>"updatable_div", "div"=>"span-12"));			
	echo $this->Form->end();
?>
</div>
<?php echo $this->element("scripts/country_trigger")?>