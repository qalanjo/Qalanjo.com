<?php
App::import("Sanitize");
class PrivateMessageRepliesController extends AppController {

	var $name = 'PrivateMessageReplies';
	/**
	 * 
	 * Write the message reply for a certain message ...
	 * @param $message_id the root message
	 */
	function writeMessage($message_id=null){
		$this->data["PrivateMessageReply"]["message_id"] = $message_id;
		if (!empty($this->data)){
			$this->data["PrivateMessageReply"]["content"] = Sanitize::clean($this->data["PrivateMessageReply"]["content"]);
			$this->loadModel("ReceiveMessage");
			$this->loadModel("PrivateMessage");
			$message_id = $this->data["PrivateMessageReply"]["private_message_id"];
			$member_id = $this->data["PrivateMessageReply"]["to_id"];
			if ($this->PrivateMessageReply->writeReply($this->data)){	
				$this->data["ReceiveMessage"]["private_message_id"] = $message_id;
				$this->data["ReceiveMessage"]["member_id"]= $member_id;
				$member_id = $this->Session->read("Member.id");
				$message = $this->PrivateMessage->find("first",
								array("PrivateMessage.id"=>$message_id));
				if ($message["PrivateMessage"]["member_id"]!=$member_id){
					$this->data["ReceiveMessage"]["member_id"] = $message["PrivateMessage"]["member_id"];
				}else{
					$messages = $this->ReceiveMessage->find("all", array("conditions"=>
													array("ReceiveMessage.private_message_id"=>$message_id)));
					foreach($messages as $message){
						if ($message["ReceiveMessage"]["member_id"]!=$member_id){
							$this->data["ReceiveMessage"]["member_id"] = $message["ReceiveMessage"]["member_id"];		
							break;
						}
					}			
					
				}
				$this->ReceiveMessage->writeReply($this->data);
				$this->set("member_id", $member_id);
				$reply_id = $this->PrivateMessageReply->getLastInsertId();
				$reply = $this->PrivateMessageReply->find("first", array(
														"conditions"=>array("PrivateMessageReply.id"=>$reply_id), "recursive"=>1));
				$this->set("reply", $reply);
				$this->loadModel("MemberProfile");
				$profile = $this->MemberProfile->find("first", array("conditions"=>
																	array("MemberProfile.member_id"=>$reply["Sender"]["id"])));
				$this->set("profile", $profile);
				
				$this->render("writemessage_success", "ajax");
			}else{
				$this->Session->setFlash("Message sending failed");		
				$this->render("writemessage_failed", "ajax");
			}
		}
	}
	
	
	/**
	 * 
	 * Delete the message reply ...
	 * @param $message_id
	 */
	function delete($message_id){
		if (!$message_id){
			if ($this->PrivateMessageReply->delete($message_id)){
				$member_id = $this->Session->read("Member.id");
				$this->redirect(array("action"=>"inbox", $member_id));	
			}
		}
		$this->render("delete_success", "ajax");
	}
	
	
	function latestReply($message_id){
		return $this->PrivateMessageReply->find("first", 
					array("conditions"=>
							array("PrivateMessageReply.private_message_id"=>$message_id),
							"recursive"=>-1,
							"order"=>"PrivateMessageReply.created desc"
					));
	}
	
}
?>