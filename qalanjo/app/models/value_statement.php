<?php

/**
 * 
 * Represents a value statement. These are certain statement which has a topic which maybe a basis for 
 * judging someone personality ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class ValueStatement extends AppModel {
	var $name = 'ValueStatement';
	
	var $belongsTo = array(
		'ValueStatementType' => array(
			'className' => 'ValueStatementType',
			'foreignKey' => 'value_statement_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Member' => array(
			'className' => 'Member',
			'joinTable' => 'members_value_statements',
			'foreignKey' => 'value_statement_id',
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