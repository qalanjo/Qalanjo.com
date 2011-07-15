<?php
class ReceiveMessagesController extends AppController {

	var $name = 'ReceiveMessages';
	/**
	 * 
	 * Load the inbox of the current user ...
	 * @param $member_id
	 */
	function inbox($option="all"){
		$member_id = $this->Session->read("Member.id");
		$role = $this->Member->getRole($member_id);
		if (($role!=3)&&(!$this->RequestHandler->isAjax())){
			$this->redirect("/subscribe");	
		}
		if ($option=="sent"){
			$pagination = array("conditions"=>
								array("PrivateMessage.member_id"=>$member_id,
								 "PrivateMessage.message_status_id <>"=>3),
								 "order"=>"PrivateMessage.created desc");
		}else if ($option=="all"){
			$pagination = array("conditions"=>array("ReceiveMessage.member_id"=>$member_id, "ReceiveMessage.message_status_id IN (1, 2)"),
								 "order"=>"ReceiveMessage.created desc",
								 "recursive"=>1);
		}else if ($option=="read"){
			$pagination = array("conditions"=>
					array("ReceiveMessage.member_id"=>$member_id,
					 "ReceiveMessage.message_status_id"=>1),
					 "order"=>"PrivateMessage.created desc"
					);
			
		}else if ($option=="trash"){
			$pagination = array("conditions"=>
					array("ReceiveMessage.member_id"=>$member_id,
					 "ReceiveMessage.message_status_id"=>3),
					 "order"=>"PrivateMessage.created desc");
		}else{
			$pagination = array("conditions"=>
				array("ReceiveMessage.member_id"=>$member_id,
				 "ReceiveMessage.message_status_id"=>2
			), "order"=>"PrivateMessage.created desc");
		}
		$this->paginate = $pagination;
		if ($this->RequestHandler->isAjax()){
			$action = "ajax";
			$this->layout = "ajax";
		}else{
			$action = "render";
			$this->layout = "blue_full_block";
		}
		$this->set("messages", $this->paginate());
		$this->set("member_id", $member_id);
		$this->set("action", $action);
		$this->set("option", $option);
	}
	
	function load_inbox($type=2){	
		if ($this->RequestHandler->isAjax()){
			$this->layout = "ajax";
			$member_id = $this->Session->read("Member.id");
			$messages = $this->ReceiveMessage->find("all", array("conditions"=>
					array("ReceiveMessage.message_status_id"=>$type,
					"ReceiveMessage.member_id"=>$member_id
						), "order"=>"ReceiveMessage.created DESC"));
						
			$this->set("messages", $messages);
		}
	}
	
	
	
	/**
	 * 
	 * Mark selected ...
	 * @param $status The status
	 * @param $sent To mark as sent
	 */
	function mark_selected($status, $sent = false){
		if ($this->RequestHandler->isAjax()){
			$member_id = $this->Session->read("Member.id");
			foreach($this->data["checkbox"] as $value){
				if (!$sent){
					$this->ReceiveMessage->mark_as($value,$status);
				}
			}
			$this->set("response", "true");
			$this->render("/elements/response", "ajax");
		}
		
	}
	
	function delete_selected($option="all", $action=""){
		if (!empty($this->data)){
			$action = $this->data["ReceiveMessage"]["action"];
			$this->mark_selected($action, $option);
		}
	}
	
	
	function count_unread(){
		if ($this->RequestHandler->isAjax()){
			$this->layout = "ajax";
			$member_id = $this->Session->read("Member.id");
			$this->set("count", $this->ReceiveMessage->find('count', array("conditions"=>array("ReceiveMessage.member_id"=>$member_id, "ReceiveMessage.message_status_id"=>2))));
		}
	}
	
	function countType(){
		if ($this->RequestHandler->isAjax()){
			$member_id = $this->Session->read("Member.id");
			$result["inbox"] = $this->ReceiveMessage->countType(1, $member_id);
			$result["sent"] = $this->ReceiveMessage->countType(3, $member_id);
			$result["trash"] = $this->ReceiveMessage->countType(4, $member_id);		
			$this->set("response", json_encode($result));
			$this->render("/elements/response", "ajax");
		}
	}
}
?>