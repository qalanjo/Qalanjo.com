<?php

/**
 * 
 * Object to represent value statement types ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class ValueStatementType extends AppModel {
	var $name = 'ValueStatementType';
	var $displayField = 'value';

	var $hasMany = array(
		'ValueStatement' => array(
			'className' => 'ValueStatement',
			'foreignKey' => 'value_statement_type_id',
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