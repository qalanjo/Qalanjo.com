<?php
/**
 * 
 * These are transaction related to subscription ...
 * @author Allanaire
 *
 */

class SubscriptionTransaction extends AppModel {
	var $name = 'SubscriptionTransaction';

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
		),
		'SubscriptionType' => array(
			'className' => 'SubscriptionType',
			'foreignKey' => 'subscription_type_id',
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
	
	function checkIfSubscribeOrExpired($member_id){
		$this->unbindModel(array("belongsTo"=>array("CreditType", "PaymentMethod", "Member")));
		$transaction = $this->find("first", array("conditions"=>array("SubscriptionTransaction.member_id"=>$member_id), "order"=>"SubscriptionTransaction.created DESC", "recursive"=>1));
		if (!empty($transaction)){
			$months = $transaction["SubscriptionType"]["months"];
			$transaction = $this->find("first", array("conditions"=>array("SubscriptionTransaction.member_id"=>$member_id, "DATE_ADD(DATE(SubscriptionTransaction.created), INTERVAL $months MONTH) >= CURDATE()"), "order"=>"SubscriptionTransaction.created DESC", "recursive"=>-1));
			return $transaction;
		}
		return false;
	}
	
	function expireSubscription($member_id){
		$transaction = $this->find("first", array("conditions"=>array("SubscriptionTransaction.member_id"=>$member_id), "order"=>"SubscriptionTransaction.created DESC", "recursive"=>-1));
		if (!empty($transaction)){
			$this->id = $transaction["SubscriptionTransaction"]["id"];
			$this->saveField("expired", true);
		}
	}
	
}
?>