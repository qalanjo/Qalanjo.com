<?php
/**
 * 
 * These are sent gift ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class SentGift extends AppModel {
	var $name = 'SentGift';
	var $validate = array(
		'message' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
			),
		),
		'gift_id'=>array(
			'not_null' => array(
				'rule' => array('not_null'),
			),
		)
	);
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
		),
		'Sender'=>array(
			'className' => 'Member',
			'foreignKey' => 'from_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	/**
	 * 
	 * Custom validation to check if gift_id is not empty ...
	 * @param $check value to be checked
	 */
	function not_null($check){
		if(empty($check['gift_id'])){
			return false;	
		}	
		return true;
	}
	
	/**
	 * 
	 * Save Details and Gifts ...
	 * @param $gift_details The gift details
	 * @param $sent_gifts The sent gifts
	 */
	function save_data($gift_details,$sent_gifts){
		$valid = true;
		foreach($sent_gifts as $gift){
			$new_data = array(
				'SentGift'=>array(
					'member_id'=>$gift_details['SentGift']['member_id'],
					'from_id'=>$gift_details['SentGift']['from_id'],
					'message'=>$gift_details['SentGift']['message_number_'.$gift['Gift']['id']],
					'gift_id'=>$gift['Gift']['id']
				)
			);
			
			$this->Gift->ShoppedItem->update_shopped_items($gift_details['SentGift']['from_id'],$gift,'subtract_to_quantity');
			
			$this->create();
			$valid = $this->save($new_data,false);
			if(!$valid){
				return false;	
			}
		}
		return $valid;
	}
	
	/**
	 * 
	 * Get the list of gift informations ...
	 * @param $gift_details The gift details
	 * @param $sent_gifts The Sent Gifts
	 */
	function get_gift_info($gift_details,$sent_gifts){
		$sent_gifts_info = array();
		foreach($sent_gifts as $key=>$gift){
			$sent_gifts_info[$key]['Gift'] = $gift['Gift'];
			$sent_gifts_info[$key]['SentGift']['message'] = $gift_details['SentGift']['message_number_'.$gift['Gift']['id']];
		}
		return $sent_gifts_info;	
	}
	
	/**
	 * 
	 * Get the list of received gifts ...
	 * @param $id
	 */
	function get_received_gifts($id){
		$received_gifts = $this->find('all',array(
			'conditions'=>
				array(	
					'SentGift.member_id'=>$id
				),
			'fields'=>
				array(
					'SentGift.gift_id','SentGift.message','SentGift.from_id',
					'Sender.id','Sender.firstname','Sender.lastname','Sender.gender_id',
					'Gift.id','Gift.name','Gift.picture_path'
				)
		));
		foreach($received_gifts as $key=>$gift){
			$temp = $this->Sender->find('first',array(
				'conditions'=>array(
					'Sender.id'=>$gift['Sender']['id']
				),
				'fields'=>array(
					'Sender.id',
					'MemberProfile.picture_path'
				),
				'recursive'=>0
			));
			$received_gifts[$key]['MemberProfile']['picture_path'] = $temp['MemberProfile']['picture_path'];
		}
		return $received_gifts;
	}
	
	function loadSentGift($member_id, $limit){
		$this->unbindModel(array("belongsTo"=>array("Member")));			
		$sentGifts = $this->find("all", array("conditions"=>
									array("SentGift.member_id"=>$member_id)
					, "order"=>"SentGift.created DESC", "limit"=>$limit, "recursive"=>1));
		return $sentGifts;
	}
	
	function getSentGift($id){
		$this->unbindModel(array("belongsTo"=>array("Member")));			
		$sentGift = $this->find("first", array("conditions"=>
									array("SentGift.id"=>$id)
					, "recursive"=>1));
		return $sentGift;
	}
}
?>