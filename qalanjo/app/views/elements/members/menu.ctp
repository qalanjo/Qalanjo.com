<ul id="nav">
	<li><?php echo $this->Html->link("HOME", "/")?></li>
	<li><?php echo $this->Html->link("PROFILE", "/profile/".$member["Member"]["id"])?>
	
	</li>
	<li><a href="#">ACCOUNT</a>
	<ul>
		<li><?php echo $this->Html->link("My Account", array("action"=>"account", "controller"=>"members"))?></li>
		<li><?php echo $this->Html->link("My Credits", array("action"=>"credits", "controller"=>"members"))?></li>
		<li><?php echo $this->Html->link("My Settings", array("action"=>"settings", "controller"=>"members"))?></li>
		<li><?php echo $this->Html->link("Logout", array("action"=>"logout", "controller"=>"members"))?></li>
	</ul>			
		<div class="clear"></div>
	</li>
</ul>

<div class="clear"></div>