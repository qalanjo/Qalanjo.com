<?php
	/*
	 * Header for Member
	 * @version 0.0.1
	 * @date 5/21/2011
	 */	
	$path = "designs/blue/members/general/";
?>
<div class="header">
	<h2>
		<?php 
			echo $this->Html->image($path."logo.png", array("url"=>"/", "alt"=>"Qalanjo"));		
		?>
	</h2>
	<div id="top-nav">
		<ul>
			<?php 
				if (($this->action=="index")&&($this->name=="Matches")){		
			?>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("Home", "/")?>
					<div class="menu-right"></div>
				</li>
				<li class="active">
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
					<div class="menu-right"></div>
				</li>
				
			<?php 		
				}else if (($this->action=="index")&&($this->name=="Members")){
			?>
				<li class="active">
					<div class="menu-left"></div>
					<?php echo $this->Html->link("Home", "/")?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
					<div class="menu-right"></div>
				</li>
			<?php 
				}else if (($this->action=="edit")&&($this->name=="Members")){
			?>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("Home", "/")?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
					<div class="menu-right"></div>
				</li>
				<li class="active">
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
					<div class="menu-right"></div>
				</li>
			<?php 
				}else if(($this->action=="match_settings")||($this->action=="account")){
			?>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("Home", "/")?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
					<div class="menu-right"></div>
				</li>
				<li class="active">
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
					<div class="menu-right"></div>
				</li>
			<?php 
				}else if(
				
				(($this->action=="search")||($this->action=="search_result"))&&($this->name=="Members")){
			?>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("Home", "/")?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
					<div class="menu-right"></div>
				</li>
				<li class="active">
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
					<div class="menu-right"></div>
				</li>
			<?php 
				}else{
			?>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("Home", "/")?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
					<div class="menu-right"></div>
				</li>
				<li>
					<div class="menu-left"></div>
					<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
					<div class="menu-right"></div>
				</li>
			<?php 
				}
			?>
			
			
		</ul>
	</div>
	
	<?php 
		echo $this->Html->link(" ", "/members/logout", array("id"=>"logout"));
	?>
</div>