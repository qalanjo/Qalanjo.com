<?php

/**
 * 
 * Object to represent a subscription type ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class SubscriptionType extends AppModel {
	var $name = 'SubscriptionType';
	var $displayField = 'description';
	
	var $hasMany = array(
		'SubscriptionTransaction' => array(
			'className' => 'SubscriptionTransaction',
			'foreignKey' => 'subscription_type_id',
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