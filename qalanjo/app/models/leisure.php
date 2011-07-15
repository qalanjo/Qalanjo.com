<?php
class Leisure extends AppModel {
	var $name = 'Leisure';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Member' => array(
			'className' => 'Member',
			'joinTable' => 'members_leisures',
			'foreignKey' => 'leisure_id',
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