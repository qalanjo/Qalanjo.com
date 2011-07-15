<?php
class Falsifiable extends AppModel {
	var $name = 'Falsifiable';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FalsifiableType' => array(
			'className' => 'FalsifiableType',
			'foreignKey' => 'falsifiable_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Member' => array(
			'className' => 'Member',
			'joinTable' => 'members_falsifiables',
			'foreignKey' => 'falsifiable_id',
			'associationForeignKey' => 'member_id',
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

}
?>