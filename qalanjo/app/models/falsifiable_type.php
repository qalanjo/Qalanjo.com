<?php
class FalsifiableType extends AppModel {
	var $name = 'FalsifiableType';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Falsifiable' => array(
			'className' => 'Falsifiable',
			'foreignKey' => 'falsifiable_type_id',
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