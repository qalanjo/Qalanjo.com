<?php
/**
 * 
 * Creation of profile completion ...
 * @author Josef Balisalisa and Allanaire Tapion
 *
 */
class NotificationCompletorHelper extends AppHelper{
	var $helpers = array('Html','Ajax','Session','Form');
	
	function transformMessage($notification){
		if ($notification["Notification"]["details"]!=""){
			$details = json_decode($notification["Notification"]["details"]);
			$message = "";
			$action="";
			$size = "";
			$member_id = "";
			foreach($details as $key=>$value){
				if ($key=="action"){
					$action = $value;
				}else if ($key == "member_id"){
					$member_id = $value;
				}else if($key == "size"){
					$size = $value;	
				}
			}
			if ($action=="wink"){
				$member=$this->requestAction("/members/getMember/".$member_id);
				$message = $this->Html->link($member["Member"]["firstname"]." ".$member["Member"]["lastname"], "/profile/".$member["Member"]["id"]);
				return $this->Html->image("designs/member/profile/eye.png", array("class"=>"left"))."<span class='left'>".$message.$notification["Notification"]["message"]."</span>"; 	
			}
			
			if($action == 'gift_received'){
				$member=$this->requestAction("/members/getMember/".$member_id);
				$message = $this->Html->link($member["Member"]["firstname"]." ".$member["Member"]["lastname"], "/profile/".$member["Member"]["id"]);
				
				if($size == 'one'){
					$word = 'check it out';
				}else{
					$word = 'check them out';
				}
				$my_gift_page = $this->Html->link($word,array('controller'=>'gifts','action'=>'my_gifts'),array('div'=>false));
				return "<span>".$message.$notification["Notification"]["message"].$my_gift_page.'!</span>';
			}
		}else{
			return $notification["Notification"]["message"];
		}
	}
	
	function transformMessageV2($notification){
		if ($notification["Notification"]["details"]!=""){
			$details = json_decode($notification["Notification"]["details"]);
			$message = "";
			$action="";
			$size = "";
			$member_id = "";
			foreach($details as $key=>$value){
				if ($key=="action"){
					$action = $value;
				}else if ($key == "member_id"){
					$member_id = $value;
				}else if($key == "size"){
					$size = $value;	
				}
			}
			if ($action=="wink"){
				$member=$this->requestAction("/members/getMember/".$member_id);
				$message = $this->Html->link($member["Member"]["firstname"]." ".$member["Member"]["lastname"], "/profile/".$member["Member"]["id"]);
				return $message.$notification["Notification"]["message"]; 	
			}
			
			if($action == 'gift_received'){
				$member=$this->requestAction("/members/getMember/".$member_id);
				$message = $this->Html->link($member["Member"]["firstname"]." ".$member["Member"]["lastname"], "/profile/".$member["Member"]["id"]);
				
				if($size == 'one'){
					$word = 'check it out';
				}else{
					$word = 'check them out';
				}
				$my_gift_page = $this->Html->link($word,array('controller'=>'gifts','action'=>'my_gifts'),array('div'=>false));
				return $message.$notification["Notification"]["message"].$my_gift_page.'!';
			}
		}else{
			return $notification["Notification"]["message"];
		}
	}
	
	
	
}