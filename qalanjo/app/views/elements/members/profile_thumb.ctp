<?php 
	if (isset($member["MemberProfile"]["picture_path"])&&$member["MemberProfile"]["picture_path"]!=""){
		if (!isset($prefix)){
			echo $this->Html->image("uploads/".$member["Member"]["id"]."/default/profile_thumb_".$member["MemberProfile"]["picture_path"]);
		}else{
			echo $this->Html->image("uploads/".$member["Member"]["id"]."/default/$prefix".$member["MemberProfile"]["picture_path"]);
		}
	}else{
		if ($member["Gender"]["value"]=="Man"){
			echo $this->Html->image("designs/member/profile/silhoutte_boy.png");
		}else{
			echo $this->Html->image("designs/member/profile/silhoutte_girl.png");	
		}
		
	}
?>