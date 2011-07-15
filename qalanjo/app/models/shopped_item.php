<?php
/**
 * 
 * These are shopped item ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class ShoppedItem extends AppModel {
	var $name = 'ShoppedItem';

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
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
	
	/**
	 * 
	 * Update the list of shopped items ...
	 * @param $member The Member who bought the item
	 * @param $item The item who bought it
	 * @param $operation The operation done
	 */
	function update_shopped_items($member, $item, $operation){
		$shopped_item = $this->find('first',array('conditions'=>
			array(
				'ShoppedItem.member_id'=>$member,
				'ShoppedItem.gift_id'=>$item['Gift']['id']
			)
		));
		
		if(!empty($shopped_item)){
			
			if(isset($item['GiftAvailTransactionItem']['quantity'])){
				$new_quantity = $item['GiftAvailTransactionItem']['quantity'];	
			}else{
				$new_quantity = 1;	
			}
			
			$this->id = $shopped_item['ShoppedItem']['id'];
			
			$this->$operation($shopped_item['ShoppedItem']['quantity'],$new_quantity);
		}else{
			$new_data = array(
				'ShoppedItem'=>array(
					'member_id'=>$member,
					'gift_id'=>$item['Gift']['id'],
					'quantity'=>$item['GiftAvailTransactionItem']['quantity']
				)
			);
			$this->create();
			$this->save($new_data);
		}	
	}
	
	/**
	 * 
	 * Add a quantity ...
	 * @param $current_quantity
	 * @param $new_quantity
	 */
	function add_to_quantity($current_quantity,$new_quantity){
		$this->saveField('quantity',$current_quantity + $new_quantity);
	}
	
	/**
	 * 
	 * Subtract a quantity ...
	 * @param $current_quantity The current quantity
	 * @param $new_quantity The new quantity
	 */
	function subtract_to_quantity($current_quantity,$new_quantity){
		$this->saveField('quantity',$current_quantity - $new_quantity);
	}
	
	/**
	 * 
	 * Get the list of gift ...
	 * @param $id the member's id
	 */
	
	function get_gift_inventory($id){
		$inventory = $this->find('all',array(
			'conditions'=>array(
				'ShoppedItem.member_id'=>$id
			),
			'fields'=>array(
				'ShoppedItem.member_id','ShoppedItem.gift_id','ShoppedItem.quantity',
				'Gift.name','Gift.picture_path','Gift.id'
				
			)
		));
		return $inventory;
	}
}
?>