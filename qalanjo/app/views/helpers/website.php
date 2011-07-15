<?php

/**
 * 
 * Helper for the Website Helper ...
 * @author Allanaire Tapion
 *
 */
class WebsiteHelper extends AppHelper{
	var $helpers = array('Html','Ajax','Session','Form');
	
	/**
	 * 
	 * Render the side navigation ...
	 * @param $member
	 */
	function renderSidebar($member=null){
		
		if (!empty($member)){
			$out= "<div><ul class='control_links'>";
				if ($member["Member"]["username"]!=""){
					$out.= "<li class='top_link'>{$this->Ajax->link("My Profile", array("controller"=>"members", "action"=>"profile", $member["Member"]["username"]), array("update"=>"updatable_div", "indicator"=>"loading"))}";
				}else{
					$out.= "<li class='top_link'>{$this->Ajax->link("My Profile", array("controller"=>"members", "action"=>"profile", $member["Member"]["id"]), array("update"=>"updatable_div", "indicator"=>"loading"))}";
				}
					$out.= "<ul class='sub_menus'>";
					$out.= "<li>{$this->Ajax->link("who viewed me?", array("controller"=>"members", "action"=>"viewers", $member["Member"]["id"]), array("update"=>"updatable_div", "indicator"=>"loading"))}</li>";
					$out.= "</ul>";
				$out.= "</li>";
				$out.= "<li class='top_link'>{$this->Ajax->link("My Photos", "#")}</li>";
				$out.= "<li class='top_link'>{$this->Ajax->link("Inbox", "#")}";
						if (isset($member['PrivateMessage'])){	
							$count = "(".count($member['PrivateMessage']).")";
						}else{
							$count = "";
							
						}
						$out.= "<ul class='sub_menus'>";
					
						$out.= "<li>{$this->Ajax->link("Messages$count" , array("controller"=>"private_messages", "action"=>"inbox", $member["Member"]["id"]), array("update"=>"updatable_div", "indicator"=>"loading"))}</li>";
						$out.= "<li>{$this->Ajax->link("Smiles", "#")}</li>";
						$out.= "<li>{$this->Ajax->link("Gifts", "#")}</li>";
					$out.= "</ul>";
				$out.= "</li>";
				$out.= "<li class='top_link'>{$this->Ajax->link("Action", "#")}";
					$out.= "<ul class='sub_menus'>";
						$out.= "<li>{$this->Ajax->link("Message Sent", "#")}</li>";
						$out.= "<li>{$this->Ajax->link("Smiles Sent", "#")}</li>";
						$out.= "<li>{$this->Ajax->link("Gifts Sent", "#")}</li>";
						$out.= "<li>{$this->Ajax->link("Viewed Profiles", "#")}</li>";				
					$out.= "</ul>";
				$out.= "</li>";
	
			$out.= "</ul></div>";
			return $out;					
		}	
	}
	

	/**
	 * 
	 * Profile box ...
	 * @param $member the member
	 */
	function renderProfileBox($member = null){
		if (!empty($member)){
			$out = "<div class='badge'>";
			if ($member["MemberProfile"]["picture_path"]!=""){
				$out.=$this->Html->image("uploads/".sha1($member["Member"]["id"])."/".$member["Member"]["picture_path"]);
			}else{
				$out.=$this->Html->image("member/profile picture.png");	
			}
			$out.=$this->renderProgressMeter();
			
			$out .= "</div>";
			return $out;
		}
			
	}
	
	
	private function renderProgressMeter(){
		return "";	
	}
	
	
 	function renderAlbumThumbs($member){
		$out="<ul class='albumlist'>";
		if (isset($member["Album"])){
					
		}else{
			$out.= "<li>{$this->Html->image("member/randpic2.png")}</li>";
			$out.= "<li>{$this->Html->image("member/randpic1.png")}</li>";
			$out.= "<li>{$this->Html->image("member/randpic2.png")}</li>";
		}
		$out.= "</ul>";
		return $out;
	}
}
