<ul>
	<li class="active" id="basic">
		<?php echo $this->Html->link("Basic", "#")?>
	</li>
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Basic Information", "/members/edit/ajax/sk:basic", array("update"=>"updatable_div", "class"=>"navigation_left"))?> 
	</li>
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Location", "/members/edit/ajax/sk:location", array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li>	
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Education", "/members/edit/ajax/sk:education", array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li>
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Interests", "/members/edit/ajax/sk:interests", array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li>
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Music", "/members/edit/ajax/sk:music", array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li> 		
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Entertainment", "/members/edit/ajax/sk:entertainment", array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li> 		
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Sports", "/members/edit/ajax/sk:sports", array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li>
	<li class="inner_nav">
		 <?php echo $this->Ajax->link("Animals", "/members/edit/ajax/sk:animals", array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li> 					

     <li id="own">
     	<?php echo $this->Html->link("In Your Own Words", "#")?>
     </li>
     <li class="inner_nav"><?php echo $this->Ajax->link("Page 1", "/members/edit/ajax/sk:words/page:1", array("update"=>"updatable_div", "class"=>"navigation_left"))?></li>
     <li class="inner_nav"><?php echo $this->Ajax->link("Page 2", "/members/edit/ajax/sk:words/page:2", array("update"=>"updatable_div", "class"=>"navigation_left"))?></li>      				
     <li id="values">
       		<?php echo $this->Html->link("Values", "#")?>
	 </li>
	 <li class="inner_nav"><?php echo $this->Ajax->link("Must have", "/members/edit/ajax/sk:values/page:1", array("update"=>"updatable_div", "class"=>"navigation_left"))?></li>
	 <li class="inner_nav"><?php echo $this->Ajax->link("Can't stand", "/members/edit/ajax/sk:values/page:2", array("update"=>"updatable_div", "class"=>"navigation_left"))?></li>      			
</ul>