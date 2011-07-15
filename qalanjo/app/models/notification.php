<?php
class Notification extends AppModel {
	var $name = 'Notification';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function notify($message, $member_id, $options=array()){
		$data["Notification"]["message"] = $message;
		$data["Notification"]["member_id"] = $member_id;
		if (!empty($options)){
			$data["Notification"]["details"] = json_encode($options);
		}
		$this->set($data);
		$this->create($this->data);
		$this->save($this->data, false);
	}
	
	
	function notifyV2($data){
		$this->set($data);
		$this->create($this->data);
		$this->save($this->data, false);
	}
}
?>