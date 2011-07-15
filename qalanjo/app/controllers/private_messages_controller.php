<?php
App::import("Sanitize");
class PrivateMessagesController extends AppController {
	var $name = 'PrivateMessages';
	/**
	 * 
	 * Write the message ...
	 * @param $sender_id
	 */
	function writemessage($redirect=1){
		if (!empty($this->data)){
			$this->data["PrivateMessage"]["content"] = Sanitize::stripScripts($this->data["PrivateMessage"]["content"]);
			$this->data["PrivateMessage"]["title"] = Sanitize::stripScripts($this->data["PrivateMessage"]["title"]);
			$this->data["PrivateMessage"]["member_id"] = $this->Session->read("Member.id");
			$this->layout = "ajax";
			if ($this->PrivateMessage->writeMessage($this->data)){
				$this->Session->setFlash("Your message has been sent", "flash_success");		
				$to_id = $this->data["PrivateMessage"]["to_id"];
				$this->data["ReceiveMessage"]["private_message_id"] = $this->PrivateMessage->getLastInsertId();
				$this->data["ReceiveMessage"]["member_id"] = $to_id;
				if ($this->data["ReceiveMessage"]["private_message_id"]!=""){
					$this->PrivateMessage->ReceiveMessage->create($this->data);
					$this->PrivateMessage->ReceiveMessage->save($this->data);
				}
				$this->loadModel("Match");
				$this->Match->updateMatchStatus($this->Session->read("Member.id"), $to_id, 2);
				if ($redirect){
					$this->redirect("/");
				}
			}else{
				$this->Session->setFlash("Message sending failed", "flash_failed");		
				$this->render("writemessage_failed", "ajax");
			}
		}
		/*
		if ($sender_id!=-1){
			$this->layout="ajax";
			$sender = $this->PrivateMessage->find("first", array("conditions"=>array("Member.id"=>$sender_id), "recursive"=>0));
			$this->set("sender", $sender);
		}
		*/
	}

	/**
	 * 
	 * Reads a current message ...
	 * @param int $message_id
	 */
	function read($message_id = -1){
		$member_id = $this->Session->read("Member.id");
		$role = $this->Member->getRole($member_id);
		if (($role!=3)&&(!$this->RequestHandler->isAjax())){
			$this->redirect("/subscribe");	
		}
		if ($message_id!=-1){
			if ($this->RequestHandler->isAjax()){
				$this->layout="ajax";
				$this->set("action", "ajax");
			}else{
				$this->layout="blue_full_block";
				$this->set("action", "render");
			}
			$this->loadModel("ReceiveMessage");
			
			$message = $this->ReceiveMessage->find("first", array("conditions"=>array("ReceiveMessage.id"=>$message_id), "recursive"=>2));
			if ($message["ReceiveMessage"]["message_status_id"]==-1){
				$message = $this->ReceiveMessage->find("first", array("conditions"=>
															array("ReceiveMessage.private_message_id"=>$message["ReceiveMessage"]["private_message_id"],
																	"ReceiveMessage.message_status_id <>"=>-1)
															, "recursive"=>2, "order"=>"ReceiveMessage.created DESC"));
			
			}
			$this->loadModel("PrivateMessageReply");
			$message_replies = $this->PrivateMessageReply->find("all", array("conditions"=>array("PrivateMessageReply.private_message_id"=>$message["PrivateMessage"]["id"]), "order"=>"PrivateMessageReply.created", "recursive"=>2));
			$member = $this->Session->read("Member.id");
			$this->ReceiveMessage->mark_as($message_id);
			$this->set("message", $message);
			$this->set("message_replies", $message_replies);
			$this->set("member_id", $member);
			$this->set("to_id", $message["ReceiveMessage"]["member_id"]);
		}
	}
	
	
	
	/**
	 * Action to mark the current status ...
	 * @param int $message_id The message
	 * @param boolean $status The current status of reading
	 */
	function mark_as($message_id=-1, $status=2){
		if ($message_id!=-1){
			$this->loadModel("ReceiveMessage");
			$this->ReceiveMessage->mark_as($message_id, $status);
		}
	}
	
	
	/**
	 * 
	 * Action to mark current status of sent items ...
	 * @param unknown_type $message_id
	 * @param unknown_type $status
	 */
	function mark_sent_as($message_id, $status){
		if ($message_id==-1){
			$message = $this->PrivateMessage->find("first", array("conditions"=>array("PrivateMessage.id"=>$message_id), "recursive"=>1));
			$this->PrivateMessage->mark_as($message_id, status);
			$this->inbox($message["Member"]["id"]);
			$this->render("inbox", "ajax");
		}
	}
	
	
	/**
	 * 
	 * Delete a message ...
	 * @param unknown_type $message_id
	 */
	function delete($message_id){
		if (!$message_id){
			if ($this->PrivateMessage->delete($message_id)){
				$this->Session->setFlash("Message has been deleted", "flash_success");
				$member_id = $this->Session->read("Member.id");
				$this->redirect(array("action"=>"inbox", $member_id));	
			}
		}	
	}
	
	/**
	 * 
	 * Auto complete ...
	 */
	function autocomplete(){
		if ($this->RequestHandler->isAjax()){
			Configure::write ( 'debug', 0 );
			$this->layout = 'ajax';
			$query = $_GET["term"];
			$query = Sanitize::escape($query);
			$member_id = $this->Session->read("Member.id");
			$messages = $this->PrivateMessage->autocomplete($query, $member_id);
			$this->set ( "messages", $messages );
		}
	}
	
	
	/**
	 * 
	 * Find specific messages ...
	 */
	function find(){
		if ($this->RequestHandler->isAjax()){
			$member_id = $this->Session->read("Member.id");
			$query = $this->data["PrivateMessage"]["query"];
			$query = Sanitize::escape($query);
			$messages = $this->PrivateMessage->find("all", array("conditions"=>array("PrivateMessage.title"=>$query, "PrivateMessage.member_id"=>$member_id), "recursive"=>2));
			$this->set("messages", $messages);
			$this->render("inbox_update", "ajax");
			$this->set("option", "find");
		}
	}
	
	function mark_selected($status, $option, $sent = false){
		if ($this->RequestHandler->isAjax()){
			$member_id = $this->Session->read("Member.id");
			foreach($this->data["checkbox"] as $value){
				if (!$sent){
					$this->PrivateMessage->mark_as($value,$status);
				}
			}
			$this->inbox($member_id, $option, "update");
			$this->render("inbox", "ajax");
		}

	}
	function delete_selected($option){
		$action = $this->data["PrivateMessage"]["action"];
		if (!empty($this->data)){
			$this->mark_selected($action, $option);
		}
	}
}