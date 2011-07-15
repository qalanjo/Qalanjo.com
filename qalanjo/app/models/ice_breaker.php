<?php
class IceBreaker extends AppModel {
	var $name = 'IceBreaker';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'SentIceBreaker' => array(
			'className' => 'SentIceBreaker',
			'foreignKey' => 'ice_breaker_id',
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