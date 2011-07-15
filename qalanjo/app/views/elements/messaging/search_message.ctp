<?php 
		echo $this->Form->create("PrivateMessage");
		echo $this->Form->input("PrivateMessage.query", array("type"=>"text", "id"=>"search_mail", "label"=>"Search by title or content"));
		echo $this->Ajax->submit("Search Mail", array("url"=>"/private_messages/find", "update"=>"messages"));
		echo $this->Form->end();
?>