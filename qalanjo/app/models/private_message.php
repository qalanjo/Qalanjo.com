<?php

class PrivateMessage extends AppModel {
	var $name = 'PrivateMessage';
	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title should not be blank',
				//allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MessageStatus'=>array(
			'className'=>'MessageStatus',
			'foreignKey' => 'message_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
	
	
	var $hasMany = array(
		"ReceiveMessage" =>array(
			'className' => 'ReceiveMessage',
			'foreignKey' => 'private_message_id',
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
	 * Load inbox of the specified member ...
	 * @param int $member_id
	 */
	function loadInbox($member_id, $limit=10){
		return $this->find("all", array("conditions"=>array("PrivateMessage.member_id"=>$member_id), "order"=>"created desc", "limit"=>$limit));	
	}
	
	
	/**
	 * 
	 * Write the message for the special someone ...
	 * @param $data
	 */
	function writeMessage($data){
		$this->set($data);
		$isValidated = $this->validates(
										array("fieldList"=>
												array("title", "content")
											));									
		
		if ($isValidated){
			$message = $this->find("first", array("conditions"=>array("PrivateMessage.title"=>$this->data["PrivateMessage"]["title"], "PrivateMessage.content"=>$this->data["PrivateMessage"]["content"], "PrivateMessage.member_id"=>$data["PrivateMessage"]["member_id"], "DATE(PrivateMessage.created) = CURDATE()")));
			if (!$message){
				$this->create($this->data);
				return $this->save($this->data, false);
			}
			return true;
		}
		return $isValidated;
		
	}
	
	/**
	 * 
	 * Mark message as. 1 = read, 2 = unread, 3 = trash 
	 * @param  $message_id
	 * @param unknown_type $status
	 */
	function mark_as($message_id, $status=1){
		$message = $this->find("first", array("conditions"=>array("PrivateMessage.id"=>$message_id), "recursive"=>0));
		$message["PrivateMessage"]["message_status_id"] = $status;
	
		$this->save($message, false);
	}
	
	
	/**
	 * 
	 * Autocomplete search ...
	 * @param $q The Query
	 */
	function autocomplete($q, $member_id, $recursive=0){
		$options['conditions'] = array( 
		   "PrivateMessage.title LIKE "=>"$q%", "PrivateMessage.member_id"=>$member_id
		);
		$options["fields"] =  array("DISTINCT id", "DISTINCT title"
		);
		$options["recursive"] = $recursive;
		return $this->find("all", $options);		
	}
	
	
	
	
	function loadMessageForCommunication($member_id){
		$this->unbindModel(array("hasMany"=>array("ReceiveMessage")));
		return $this->find("first", array("conditions"=>
						array("PrivateMessage.id"=>$member_id),
						"contain"=>array(
							"Member.id",
							"Member.lastname",
							"Member.firstname",
							"Member.gender_id",
							"Member.city",
							"Member.state",
							"Member.country_id"
						)
						
						));
	}

	
	
}
?>