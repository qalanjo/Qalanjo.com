<?php
class CreditType extends AppModel {
	var $name = 'CreditType';
	var $displayField = 'value';
	
	var $hasMany = array(
		'CreditCard' => array(
			'className' => 'CreditCard',
			'foreignKey' => 'credit_type_id',
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