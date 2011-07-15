<?php
class ChatsController extends AppController {

	var $name = 'Chats';
	
	function loadContent($member_id, $member2_id){
		$chats = $this->Chat->find("all", array(
			"conditions"=>
				array(
					"OR"=>
						array(
							"AND"=>array("Chat.member_id"=>$member_id, "Chat.to_id"=>$member2_id),
							"AND"=>array("Chat.member_id"=>$member2_id, "Chat.to_id"=>$member_id),
						), "order"=>"Chat.created DESC")
		));
		$this->set("chats", $chats);
	}
	
	function send(){
		if (!empty($this->data)){
			$this->Chat->create($this->data);
			if ($this->Chat->save($this->data)){
				$this->set("response", "true");
			}else{
				$this->set("response", "false");
			}
			$this->render("/elements/responses", "ajax");
		}
	}
	
	function index($chat_id){
		$member_id = $this->Session->read("Member.id");
		$this->set("chat_id", $chat_id);
		$this->set("member_id", $member_id);
	}
	
}
?>