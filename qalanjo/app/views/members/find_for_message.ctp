<?php
	echo "<p>";
	echo $this->element("members/profile_thumb", array("prefix"=>"thumb_", "member"=>$member));		
	echo "&nbsp;".$member["Member"]["firstname"]." ".$member["Member"]["lastname"];