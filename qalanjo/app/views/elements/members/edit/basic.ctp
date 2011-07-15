<div class="span-15 form_container last">
	<?php echo $this->Html->image("designs/member/edit/basic_header.png")?>
</div>
<div class="span-14 form last">
	<p class="instruction">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
	<?php 	
	echo $this->Form->create("Member", array("class"=>"ui-helper-clearfix ui-form"));
	?>
	<label class="span-2">Name </label>
	<?php 
	echo "<div class='span-12 last'>";
		echo $this->data["Member"]["firstname"]." ".$this->data["Member"]["lastname"];
	echo "</div>";
	?>
	<label class="span-2">Age </label>
	<?php 
	echo "<div class='span-12 last'>";
		echo $this->data["Member"]["age"]." years old";
	echo "</div>";
	?>
	<label class="span-2">Location </label>
	<?php 
	echo $this->Form->input("MemberProfile.id", array("type"=>"hidden"));
	echo "<div class='span-12 last'>";
		echo $this->data["Member"]["state"].", ".$this->data["Country"]["name"];
	echo "</div>";
	echo $this->Form->label("MemberProfile.occupation", "Occupation", array("class"=>"span-2"));
	echo "<div class='span-12 last'>";
		echo $this->Form->input("MemberProfile.occupation", array("div"=>false, "label"=>false));
	echo "</div>";
	echo $this->Form->label("MemberProfile.height", "Height", array("class"=>"span-2"));
	echo "<div class='span-12 last'>";
		echo $this->Form->input("MemberProfile.height_ft", array("div"=>false, "label"=>false, "class"=>"numeric"));
		echo $this->Form->label("MemberProfile.height_ft", "&nbsp;ft&nbsp;");
		echo $this->Form->input("MemberProfile.height_inch", array("div"=>false, "label"=>false, "class"=>"numeric"));
		echo $this->Form->label("MemberProfile.height_inch", "&nbsp;inch&nbsp;");
	echo "</div>";
	echo $this->Form->label("MemberProfile.weight", "Weight", array("class"=>"span-2"));
	echo "<div class='span-12 last'>";
		echo $this->Form->input("MemberProfile.weight", array("div"=>false, "label"=>false, "class"=>"numeric"));
		echo $this->Form->label("MemberProfile.weight", "&nbsp;lbs");
	echo "</div>";
	echo $this->Form->input("MemberProfile.member_id", array("type"=>"hidden", "value"=>$member_id));
	echo $this->Form->input("sk", array("type"=>"hidden", "value"=>$sk));
	echo $this->Ajax->submit("Save", array("url"=>"/members/edit", "update"=>"updatable_div", "div"=>"span-12"));			
	
	
	echo $this->Form->end();	
	?>		
</div>