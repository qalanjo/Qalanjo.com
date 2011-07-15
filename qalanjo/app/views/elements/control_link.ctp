<div class='control_top'>
	<ul>
		<li><?php echo $this->Html->link("Help", "/help")?></li>
		<li><?php echo $this->Html->link("My Account", array("controller"=>"members", "action"=>"setup"))?></li>
		<li><?php echo $this->Html->link("Log Out", array("controller"=>"members", "action"=>"logout"))?></li>
	</ul>
</div>