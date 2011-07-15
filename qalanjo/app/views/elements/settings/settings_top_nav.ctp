<?php
$link_match = $this->Html->link("Match Settings", array("controller"=>"members", "action"=>"match_settings"));
$link_email = $this->Html->link("Email Settings", array("controller"=>"members", "action"=>"email_settings"));
$link_sharing = $this->Html->link("Sharing Settings", array("controller"=>"members", "action"=>"sharing_settings"));
$link_account = $this->Html->link("Account Settings", array("controller"=>"members", "action"=>"account"));
if ($settings == "match"){
	echo "<span class='selected'>Match Settings</span> | ";	
	echo "<span>{$link_account}</span>";	
	
}else if ($settings=="email"){
	echo "<span>{$link_match}</span> | ";	
	echo "<span>{$link_account}</span>";	
	
}else if ($settings=="sharing"){
	echo "<span>{$link_match}</span> | ";	
	echo "<span>{$link_account}</span>";	
	
}else if ($settings=="account"){
	echo "<span>{$link_match}</span> | ";	
	echo "<span class=\"selected\">Account Settings</span>";	
	
}