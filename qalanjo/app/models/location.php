<?php
class Location extends AppModel {
	var $name = 'Location';
	var $displayField = 'description';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'location_id',
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
	
	
	function getLocationId($name){
		$this->removeHasMany();
		$location = $this->findByDescription($name, array("id"));
		return $location["Location"]["id"];
	}

}
?>