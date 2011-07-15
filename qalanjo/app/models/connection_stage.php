<?php
class ConnectionStage extends AppModel {
	var $name = 'ConnectionStage';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Connection' => array(
			'className' => 'Connection',
			'foreignKey' => 'connection_stage_id',
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

}
?>