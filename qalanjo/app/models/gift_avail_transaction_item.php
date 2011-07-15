<?php
class GiftAvailTransactionItem extends AppModel {
	var $name = 'GiftAvailTransactionItem';
	
	var $validate = array(
		'quantity'=>array(
			'rule'=>'numeric',
			'message'=>'Quantity must numbers only'
		)
	);
	
	var $belongsTo = array(
		'GiftAvailTransaction' => array(
			'className' => 'GiftAvailTransaction',
			'foreignKey' => 'gift_avail_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Gift' => array(
			'className' => 'Gift',
			'foreignKey' => 'gift_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>