<?php
	echo $this->element("messaging/render_message", array("messages"=>$messages, "option"=>"option"));
	echo $this->Js->writeBuffer();
?>