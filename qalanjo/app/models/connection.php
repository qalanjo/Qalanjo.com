<?php
class Connection extends AppModel {
	var $name = 'Connection';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		), 
		'Partner' => array(
			'className' => 'Member',
			'foreignKey' => 'partner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ConnectionStage' => array(
			'className' => 'ConnectionStage',
			'foreignKey' => 'connection_stage_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		
	);
	
	function connect($data) {
		$this->set($data);
		$connection = $this->find("first", array("conditions"=>array("Connection.member_id"=>$this->data["Connection"]["member_id"], "Connection.partner_id"=>$this->data["Connection"]["partner_id"])));
		if (!$connection){
			$this->create($this->data);
			return $this->save($this->data, false);
		}else{
			return false;
		}
		
	}
	
}
?>