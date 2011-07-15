<ul class="main-menu right clear">
	<?php 
		if (($this->action=="index")&&($this->name=="Matches")){		
	?>
		<li>
			<span>
				<?php echo $this->Html->link("Home", "/")?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
			</span>
		</li>
		<li class='active'>
			<span>
				<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
			</span>
		</li>
	<?php 		
		}else if (($this->action=="index")&&($this->name=="Members")){
	?>
		<li class='active'>
			<span>
				<?php echo $this->Html->link("Home", "/")?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
			</span>
		</li>
	<?php 
		}else if (($this->action=="edit")&&($this->name=="Members")){
	?>
		<li>
			<span>
				<?php echo $this->Html->link("Home", "/")?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
			</span>
		</li>
		<li class='active'>
			<span>
				<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
			</span>
		</li>
	<?php 
		}else if(($this->action=="match_settings")||($this->action=="account")){
	?>
		<li>
			<span>
				<?php echo $this->Html->link("Home", "/")?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
			</span>
		</li>
		<li class='active'>
			<span>
				<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
			</span>
		</li>
	<?php 
		}else if((($this->action=="search")||($this->action=="search_result"))&&($this->name=="Members")){
	?>
		<li>
			<span>
				<?php echo $this->Html->link("Home", "/")?>
			</span>
		</li>
		<li class='active'>
			<span>
				<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
			</span>
		</li>
	<?php 
		}else{
	?>
		<li>
			<span>
				<?php echo $this->Html->link("Home", "/")?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Searches", array("controller"=>"members", "action"=>"search"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Matches", array("controller"=>"matches", "action"=>"index"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Profile", array("controller"=>"members", "action"=>"edit"))?>
			</span>
		</li>
		<li>
			<span>
				<?php echo $this->Html->link("My Settings", array("controller"=>"members", "action"=>"account"))?>
			</span>
		</li>
	<?php }?>
</ul>