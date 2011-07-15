<?php
class NotificationsController extends AppController {

	var $name = 'Notifications';

	function index() {
		$this->layout = "full_block";
		$member_id = $this->Session->read("Member.id");
		$this->load_index();
		$this->paginate = array("conditions"=>
								array("Notification.member_id"=>$member_id),
								 "order"=>"Notification.created desc", "recursive"=>1);
		$this->Notification->recursive = 0;
		$this->set("process", "notifications");
		$this->set('notifications', $this->paginate());
	}

	function delete($id){
		$this->Notification->delete($id);	
		$this->layout = "ajax";
		$member_id = $this->Session->read("Member.id");
		$this->paginate = array("conditions"=>
								array("Notification.member_id"=>$member_id),
								 "order"=>"Notification.created desc", "recursive"=>1);
		$this->Notification->recursive = 0;
		$this->set("process", "notifications");
		$this->set('notifications', $this->paginate());
	}
	
	function quick($layout = "ajax") {
		$this->layout = $layout;
		$member_id = $this->Session->read("Member.id");
		$this->load_index();
		$this->paginate = array("conditions"=>
								array("Notification.member_id"=>$member_id, "DATE(Notification.created) BETWEEN (SELECT DATE_SUB(CURDATE(), INTERVAL 1 DAY)) AND CURDATE()"),
								 "order"=>"Notification.created desc", "recursive"=>1);					
		$this->Notification->recursive = 0;
		$this->set("process", "notifications");
		$this->set("render", $layout);
		$this->set('notifications', $this->paginate());
	}
}
?>