<?php
class Role extends AppModel {
	var $name = 'Role';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'role_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


	var $hasAndBelongsToMany = array(
		'Action' => array(
			'className' => 'Action',
			'joinTable' => 'roles_actions',
			'foreignKey' => 'role_id',
			'associationForeignKey' => 'action_id',
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
	
	function isAllowed($role_id, $action, $location_id){
		$this->unbindModel(array("hasMany"=>array("Member")));
		$role = $this->find("first", array("conditions"=>array("Role.id"=>$role_id)));
		if (count($role["Action"])!=0){
			foreach($role["Action"] as $temp){
				if (($temp["action"]==$action)&&($temp["location_id"]==$location_id)){
					return true;
				}
			}
		}
		
		return false;
		
	}
}
?>