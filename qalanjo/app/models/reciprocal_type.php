<?php
class ReciprocalType extends AppModel {
	var $name = 'ReciprocalType';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Reciprocal' => array(
			'className' => 'Reciprocal',
			'foreignKey' => 'reciprocal_type_id',
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
