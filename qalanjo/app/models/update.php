<?php
class Update extends AppModel {
	var $name = 'Update';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UpdateType' => array(
			'className' => 'UpdateType',
			'foreignKey' => 'update_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getUpdates($member_id){
		$this->unbindModel(array("belongsTo"=>array("Member")));		
		$updates = $this->find("all", array(
								"conditions"=>array("Update.member_id"=>$member_id),
								"order"=>"Update.created DESC",
								"limit"=>100		
				));
		return $updates;
	}
	
	function createUpdate($member_id, $specific_id, $status_id){
		$update["Update"]["member_id"] = $member_id;
		$update["Update"]["specific_id"] = $specific_id;
		$update["Update"]["update_type_id"] = $status_id;
		$this->set($update);
		$this->create($this->data);
		$this->save($this->data, false);
	}
}
