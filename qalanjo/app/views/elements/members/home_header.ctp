<div id="header" class="span-24 last container">
	    <div id="logo" class="span-8 container">
	    	
			<div id="logo_img" class="span-3">
			<?php 
	    		$image = $this->Html->image("designs/member/profile/qalanjo name and logo.png");
	    		echo $this->Html->link($image, array("controller"=>"members", "action"=>"index"), array("escape"=>false));
	    	?>   
	    	</div>
	    	<?php if (isset($member)){?>
		    	<div id="name" class="span-5 last">
					<h2>Welcome, <?php echo $member["Member"]["firstname"]?>!</h2>
				</div>
			<?php }?>
	    </div>
	   <?php if (isset($member)){?>
		   <div id="search" class="span-8">
		   		<?php 
		   			echo $this->Form->create("Member", array("url"=>"/member/search", "method"=>"GET"));
		   			echo $this->Form->input("q", array("class"=>"search_text", "div"=>false, "label"=>false));
		   			echo $this->Form->submit(" ", array("class"=>"search_button", "div"=>false, "label"=>false));
		   			echo $this->Form->end();
		   		?>
		   
		   </div> 
		    <div class="span-8 last">
			   <?php echo $this->element("members/menu")?>
		 	</div>
	 	<?php }?>
	</div>