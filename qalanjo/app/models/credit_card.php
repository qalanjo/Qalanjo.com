<?php
class CreditCard extends AppModel {
	var $name = 'CreditCard';
	var $validate = array(
		'card_number' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Credit Card must be numeric',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The field should not be blank',
			),
			'creditcard'=>array(
				'rule' => array('cc', array('visa', 'mc'), false, null)
			)
			
		),
		'expiration_year' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Expiration year must be in numeric form',
			),
		),
		'expiration_month' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Expiration month must not be empty',
			),
		),
		'cv_code' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'CV Code must be numeric',
			),
		),
	);
	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CreditType' => array(
			'className' => 'CreditType',
			'foreignKey' => 'credit_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>