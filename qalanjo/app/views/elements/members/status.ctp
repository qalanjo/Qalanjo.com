
	<?php 
		if (isset($member["MemberProfile"]["status"])&&($member["MemberProfile"]["status"]!="")){
			//echo $member["MemberProfile"]["status"];	
			$status = $member["MemberProfile"]["status"];			
		}else{
			//echo "What is on your mind right now?";
			$status = "What is on your mind right now?";
			$class = "calign";
		}
		
		echo "<div class='title prepend-1'><input type='text' value='" . $status . "' class='ui-corner-all span-11' id='status'/></div>";
	?>
	