<ul class="left">

<?php
	foreach($updates as $update){
	?>
		<li>
			<?php 
				if ($update["UpdateType"]["value"]=="Wink"){
					echo $this->element("blue/members/index/wink-item", array("wink"=>$update["Specific"]));		
				}else if ($update["UpdateType"]["value"]=="SentIceBreaker"){
					echo $this->element("blue/members/index/senticebreaker-item", array("breaker"=>$update["Specific"]));		
				}else if ($update["UpdateType"]["value"]=="ViewActivity"){
					echo $this->element("blue/members/index/viewactivity-item", array("viewer"=>$update["Specific"]));		
				}else if ($update["UpdateType"]["value"]=="SentGift"){
					echo $this->element("blue/members/index/sent-gift-item", array("gift"=>$update["Specific"]));		
				}
			?>
		</li>
	<?php 		
	}	
?>
</ul>