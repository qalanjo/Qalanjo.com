<?php
/**
 * 
 * These are receive messages ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class ReceiveMessage extends AppModel {
	var $name = 'ReceiveMessage';

	var $validate = array(
		'member_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'First name must not be empty',
			)
		),
		'private_message_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'First name must not be empty',
			)
		)
	);
	
	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MessageStatus' => array(
			'className' => 'MessageStatus',
			'foreignKey' => 'message_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PrivateMessage' => array(
			'className' => 'PrivateMessage',
			'foreignKey' => 'private_message_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	 * 
	 * Mark message as. 1 = read, 2 = unread, 3 = trash 
	 * @param $message_id The message
	 * @param $status The status
	 */
	function mark_as($message_id, $status=1){
		$this->id = $message_id;
		$this->saveField("message_status_id", $status);
	}
	
	/**
	 * 
	 * Write Reply ...
	 * @param  $data The message
	 */
	function writeReply($data){
		$this->set($data);
		
		$items = $this->find("all", array("conditions"=>array("ReceiveMessage.private_message_id"=>$this->data["ReceiveMessage"]["private_message_id"], 
			"ReceiveMessage.member_id"=>$this->data["ReceiveMessage"]["member_id"])));
		foreach($items as $item){
			$item["ReceiveMessage"]["message_status_id"] = -1;
			$this->save($item);
		}
		$this->set($data);
		$this->create($this->data);
		$this->save($this->data, false);
	}
	
	
	function loadMessages($member_id, $status=2){
		$this->unbindModel(array("belongsTo"=>array("Member", "MessageStatus")));
		$messages =  $this->find("all", 
					array(
						"conditions"=>array("ReceiveMessage.member_id"=>$member_id, "ReceiveMessage.message_status_id"=>$status),			
					 	"recursive"=>1,
						"order"=>"ReceiveMessage.created DESC"
				));
		return $messages;
		
	}
	
	function countType($message_status, $member_id){
		if ($message_status==1){
			return $this->find("count", 
						array("conditions"=>array("ReceiveMessage.message_status_id IN (1, 2)",
											      "ReceiveMessage.member_id"=>$member_id)));	
		}else {
			return $this->find("count", 
							array("conditions"=>array("ReceiveMessage.message_status_id"=>$message_status,
													"ReceiveMessage.member_id"=>$member_id
												      )));	
		}

	}
}
?>