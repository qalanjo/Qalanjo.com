<?php
class CoinAvailTransaction extends AppModel {
	var $name = 'CoinAvailTransaction';
	var $displayField = 'id';
	var $validate = array(
		'coins' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PaymentMethod' => array(
			'className' => 'PaymentMethod',
			'foreignKey' => 'payment_method_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
}
?>