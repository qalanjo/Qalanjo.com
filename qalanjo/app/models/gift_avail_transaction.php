<?php
class GiftAvailTransaction extends AppModel {
	var $name = 'GiftAvailTransaction';

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	var $hasMany = array(
		'GiftAvailTransactionItem' => array(
			'className' => 'GiftAvailTransactionItem',
			'foreignKey' => 'gift_avail_transaction_id',
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

	
	/**
	 * 
	 * Save the transaction ...
	 */
	function save_transaction($member, $items){
		
		if(!empty($member) && !empty($items)){
			$new_data = array(
				'GiftAvailTransaction'=>array(
					'member_id'=>$member
				)
			);
			$this->create();
			if($this->save($new_data,false)){
				$last_transaction_id = $this->getLastInsertId();
				$isValid = true;
				foreach($items as $item){
					$new_data = array(
						'GiftAvailTransactionItem'=>array(
							'gift_avail_transaction_id'=>$last_transaction_id,
							'gift_id'=>$item['Gift']['id'],
							'quantity'=>$item['GiftAvailTransactionItem']['quantity']
						)
					);
					$this->GiftAvailTransactionItem->create();
					if(!$this->GiftAvailTransactionItem->save($new_data,false)){
						$isValid = false;
					}
					
					$this->GiftAvailTransactionItem->Gift->ShoppedItem->update_shopped_items($member,$item,'add_to_quantity');
						
				}
				return $isValid;
			}else{
				return false;	
			}
		}	
	}
	
	function get_members_who_bought($cart){
		$related_members = array();
		$conditions = array();
		if(!empty($cart)){
			foreach($cart as $item){
				$conditions['GiftAvailTransactionItem.gift_id'][] = $item['GiftAvailTransactionItem']['gift_id'];
				$not_in['NOT']['GiftAvailTransactionItem.gift_id'][] = $item['GiftAvailTransactionItem']['gift_id'];
			}
			
			// Get all Members who bought the items in the cart
			$related_members = $this->GiftAvailTransactionItem->find('all',
				array(
					'conditions'=>$conditions,
					'fields'=>array(
						'DISTINCT(GiftAvailTransaction.member_id)',
						'GiftAvailTransactionItem.gift_id'
					)
				)
			);
		}
		return $related_members;
	}
	
	function get_gifts_that_are_not_in($cart){
		$not_in = array();
		if(!empty($cart)){
			foreach($cart as $item){
				$not_in['NOT']['GiftAvailTransactionItem.gift_id'][] = $item['GiftAvailTransactionItem']['gift_id'];
			}
		}
		return $not_in;
	}
	
	
	function get_transactions_of($related_members,$not_this_member){
		$related_transactions = array();
		$conditions = array(); //reset the conditions array to give way for the related transactions conditions
		
		if(!empty($related_members)){
			foreach($related_members as $member){
				$conditions['GiftAvailTransaction.member_id'][] = $member['GiftAvailTransaction']['member_id'];
			}
			
			$conditions['GiftAvailTransaction.member_id <>'] = $not_this_member; //
			
			// Get all Transactions made by other 
			$related_transactions = $this->find('all',array(
				'conditions'=>array('AND'=>$conditions),
				'fields'=>array(
					'GiftAvailTransaction.id',
					
				)
			));
		}
		return $related_transactions;	
	}
	
	
	function get_item_that_was_added($id){
		$temp = $this->GiftAvailTransactionItem->Gift->find('first',
			array(
				'conditions'=>array('Gift.id'=>$id),
				'recursive'=>0,
				'fields'=>array(
					'Gift.name','Gift.price','Gift.picture_path'
				)
			)
		);
		return $temp;
	}
	
	function q_point_deduction($member,$total){
		$q_points = $this->Member->get_q_points($member);
		$new_credit = $q_points - $total;
		$this->Member->id = $member;
		return $this->Member->saveField('credit_points',$new_credit);
	}
	
}
?>