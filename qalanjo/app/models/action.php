<?php
class Action extends AppModel {
	var $name = 'Action';
	var $displayField = 'action';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Role' => array(
			'className' => 'Role',
			'joinTable' => 'roles_actions',
			'foreignKey' => 'action_id',
			'associationForeignKey' => 'role_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);


	
	function getActionId($name){
		$action = $this->find("first", array("conditions"=>array("Action.action"=>$name), "fields"=>array("id")));
		return $action["Action"]["id"];
	}

}
?>