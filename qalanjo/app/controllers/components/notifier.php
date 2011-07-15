<?php
/**
 * 
 * Notifier Component. Used in notification purposes
 * @author TapsRakista
 *
 */
class NotifierComponent extends Object{
	function initialize($controller, $settings = array()){
		$this->controller = $controller;
		$this->controller->loadModel("Notification");
		$this->controller->loadModel("NotificationType");
		
		$this->controller->loadModel("ViewActivity");
	}
	

	function redirectSomewhere($value) {
		// utilizing a controller method
		$this->controller->redirect($value);
	}
	
	/**
	 * 
	 * Write notification ...
	 * @param $message The message of the notification
	 * @param $member_id If nothing is supplies, the member who will be notified
	 */
	function writeNotification($message="", $member_id=-1, $options=array()){
		if ($member_id==-1){
			$member_id = $this->controller->Session->read("Member.id");			
		}
		$this->controller->Notification->notify($message, $member_id, $options);
	}
	
	function writeNotificationV2($message, $action, $member_id=-1, $options= array()){
		if ($member_id==-1){
			$member_id = $this->controller->Session->read("Member.id");			
		}
		$data["Notification"]["message"] = $message;
		$type = $this->controller->NotificationType->find("first", array("conditions"=>array("NotificationType.value"=>$action), "recursive"=>-1));
		$data["Notification"]["notification_type_id"] = $type["NotificationType"]["id"];
		if (!empty($options)){
			$data["Notification"]["details"] = json_encode($options);
		}
		$data["Notification"]["member_id"] = $member_id;
		$this->controller->Notification->create($this->data);
		$this->controller->Notification->save($this->data, false);
		
	}
	
	
	
	
	/**
	 * 
	 * Record the view activity ...
	 * @param $viewee
	 */
	function recordViewActivity($viewee = null){
		if(!empty($viewee)){
			$viewer = $this->controller->Session->read("Member.id"); //read over currently logged user and registers as viewer
			$this->controller->ViewActivity->register($viewer, $viewee); //register activity
			return $this->controller->ViewActivity->getLastInsertId();
		}		
	}
	
	
	/**
	 * 
	 * List the viewers of the member ...
	 */
	function listViewers($member_id=-1){
		if ($member_id==-1){
			$member_id = $this->controller->Session->read("Member.id");
		}
		return $this->controller->ViewActivity->listViewers($member_id);
	}
	
	function transformMessage($notification){
		$details = json_decode($notification["Notification"]["details"]);
	}
	
	
} 