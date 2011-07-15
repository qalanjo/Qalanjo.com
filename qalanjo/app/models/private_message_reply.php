<?php
class PrivateMessageReply extends AppModel {
	var $name = 'PrivateMessageReply';
	var $validate = array(
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'PrivateMessage' => array(
			'className' => 'PrivateMessage',
			'foreignKey' => 'private_message_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Sender' => array(
			'className' => 'Member',
			'foreignKey' => 'sender_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	 * 
	 * Write reply for a message ...
	 * @param unknown_type $data
	 */
	function writeReply($data){
		$this->set($data);
		$isValidated = $this->validates(
										array("fieldList"=>
												array("content")
											));
		if ($isValidated){
			return $this->save($this->data, false);
		}
		return $isValidated;
	}
	
	
		
	
}
?>