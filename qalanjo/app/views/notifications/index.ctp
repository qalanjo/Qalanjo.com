<div id="breadcrumb" class="span-24 last">
	<span><?php echo $this->Html->link("HOME", "/")?></span> <span>&gt;&gt;</span> <span>NOTIFICATIONS</span>  
</div>
<div id="notification_delete_update">

<?php 
	echo $this->element("notifications/update", array("notifications"=>$notifications))
?>

</div>