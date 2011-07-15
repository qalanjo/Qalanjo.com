<?php
$i=0;
foreach($members as $member){
	if ($member["Member"]["id"]!=$member_id){
		$response[$i]["value"] = $member["Member"]["firstname"]." ".$member["Member"]["lastname"].";".$member["Member"]["id"];
				
		$img = $this->Html->image("uploads/{$member["Member"]["id"]}/default/profile_thumb_".$member["MemberProfile"]["picture_path"], array("class"=>"picture_search"));		
		$response[$i]["label"]	= "<span>$img".$member["Member"]["firstname"]." ".$member["Member"]["lastname"]."</span>";
		$i++;
	}
}
echo json_encode($response);