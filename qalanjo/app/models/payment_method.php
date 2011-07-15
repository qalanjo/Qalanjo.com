<?php
class PaymentMethod extends AppModel {
	var $name = 'PaymentMethod';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'GiftAvailTransaction' => array(
			'className' => 'GiftAvailTransaction',
			'foreignKey' => 'payment_method_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SubscriptionTransaction' => array(
			'className' => 'SubscriptionTransaction',
			'foreignKey' => 'payment_method_id',
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