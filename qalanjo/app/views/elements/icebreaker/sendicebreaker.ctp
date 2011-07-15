<?php
	echo $this->Form->create("SentIceBreaker", array("url"=>"send"));
	echo $this->Form->input("ice_breaker_id", array("type"=>"select", "options"=>$icebreakers));
	echo $this->Form->input("member_id", array("type"=>"hidden", "value"=>$member_id));
	echo $this->Form->input("to_id", array("type"=>"hidden", "value"=>$to_id));
	echo $this->Form->button("Send icebreaker", array("type"=>"submit"));
	echo $this->Form->end();