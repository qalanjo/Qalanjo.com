<?php
class Member extends AppModel {
	var $name = 'Member';
	var $validate = array(
		'firstname' => array(
			'maxlength' => array(
				'rule' => array('maxlength',30),
				'message' => 'Too long, max of 30 characters',
			),
			'minlength' => array(
				'rule' => array('minlength',2),
				'message' => 'Too short, minimum of 2 characters',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'First name must not be empty',
			),
			'alphaonly'=>array(
				'rule' => '/^[a-zA-Z ]{2,30}$/i',
				'message'=>'Letters only',  
			),
		),
		'lastname' => array(
			'maxlength' => array(
				'rule' => array('maxlength',30),
				'message' => 'Too long, max of 30 characters',
			),
			'minlength' => array(
				'rule' => array('minlength',2),
				'message' => 'Too short, minimum of 2 characters',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'First name must not be empty',
			),
			'alphaonly'=>array(
				'rule' => '/^[a-zA-Z ]{2,30}$/i',
				'message'=>'Letters only',  
			),
		),
		'country_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
		),
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Invalid email format',
			),
			'email' => array(
				'rule' => array('email'),
			),
			'existing'=>array(
				'rule'=>array('email_exist'),
				'message'=>'Email already exists',
			),
		),
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'password' => array(
			'maxlength' => array(
				'rule' => array('maxlength',12),
				'message' => 'Password too long, maximum of 12 characters',
			),
			'minlength' => array(
				'rule' => array('minlength',6),
				'message' => 'Password too short, minimun of 6 characters',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please specify your password',
			),
		),
		'confirm_password'=>array(
			'matching'=>array(
				'rule'=>array('password_match'),
				'message'=>'Passwords did not match'
			),
		),
		'oldpassword'=>array(
			'matching'=>array(
				'rule'=>array('old_password_match'),
				'message'=>'Passwords did not match'
			),
		),
		
		'confirmemail'=>array(
			'match'=>array(
				'rule'=>array('email_match'),
				'message'=>'Emails did not match'
			)
		),
		'shortbio' => array(
			'maxlength' => array(
				'rule' => array('maxlength',700),
			),
		),
		'activate_code'=>array(
			'check_activation'=>array(
				'rule'=>array('check_activation'),
				'message'=>'Activation code is invalid'
			),
		),
		'activation_email'=>array(
			'chech_activation_email'=>array(
				'rule'=>array('check_activation_email'),
				'message'=>'The email you have entered is not in our database'
			),
		),
		
		'zipcode'=>array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please confirm a zipcode',
			),
			'numeric'=>array(
				'rule'=>array('numeric'),
				'message'=>'The zipcode you entered appears to be invalid'
			),
		),
		'state'=>array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please confirm a state',
			),
		),
		
		'from'=>array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The field is required',
			),
			'numeric'=>array(
				'rule'=>array('numeric'),
				'message'=>'The age you entered is not numeric'
			),
			'range'=>array(
				'rule'=>array("range", 15, 100),
				'message'=>'Value must be between 15 to 100'		
			)
		
		),
		'to'=>array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The field is required',
			),
			'numeric'=>array(
				'rule'=>array('numeric'),
				'message'=>'The age you entered is not numeric'
			),
			'range'=>array(
				'rule'=>array("range", 15, 100),
				'message'=>'Value must be between 15 to 100'		
			)	
		),
		'keyword'=>array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The field is required',
			)
		),
		"FriendSayTrait"=>array("rule"=>"checkFriendSay")
		
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Idea' => array(
			'className' => 'Idea',
			'foreignKey' => 'idea_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Gender' =>array(
			'className'=>'Gender',
			'foreignKey'=>'gender_id',
			'dependent'=>true
		),
		"Role"=>array(
			"className"=>"Role",
			'foreignKey'=>'gender_id',
			'dependent'=>true
		)
	);
	var $hasOne = array(
		'MemberProfile'=>array(
			'className'=>'MemberProfile',
			'foreignKey'=>'member_id',
			'dependent'=>true	
		),
		'MemberProfileAttributeWeight' =>array(
			'className'=>'MemberProfileAttributeWeight',
			'foreignKey'=>'member_id',
			'dependent'=>true
		),
		"MemberSetting"=>array(
			'className'=>'MemberSetting',
			'foreignKey'=>'member_id',
			'dependent'=>true
		)
		
	);

	var $hasMany = array(
		'GiftAvailTransaction' => array(
			'className' => 'GiftAvailTransaction',
			'foreignKey' => 'member_id',
			'dependent' => false,
		),
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'member_id',
			'dependent' => false,
		),
		'CreditCard' => array(
			'className' => 'CreditCard',
			'foreignKey' => 'member_id',
			'dependent' => true,
		),
		'PrivateMessage' => array(
			'className' => 'PrivateMessage',
			'foreignKey' => 'member_id',
			'dependent' => false,
		),
		'SentGift' => array(
			'className' => 'SentGift',
			'foreignKey' => 'member_id',
			'dependent' => false,
		),
		'SubscriptionTransaction' => array(
			'className' => 'SubscriptionTransaction',
			'foreignKey' => 'member_id',
			'dependent' => false,
		),
		'MemberProfileAnswer' => array(
			'className' => 'MemberProfileAnswer',
			'foreignKey' => 'member_id',
			'dependent' => true,
		),
		'MemberAttributeWeight'=>array(
			'className'=>'MemberAttributeWeight',
			'foreignKey'=>'member_id',
			'dependent'=>true
		),
		'Album'=>array(
			'className'=>'Album',
			'foreignKey'=>'member_id',
			'dependent'=>true
		),
		'InMyOwnWordsAnswer'=>array(
			'className'=>'InMyOwnWordsAnswer',
			'foreignKey'=>'member_id',
			'dependent'=>true
		),
		'MembersInterest'=>array(
			'className'=>'MembersInterest',
			'foreignKey'=>'member_id',
			'dependent'=>true
		),
		'Connection'=>array(
			'className'=>'Connection',
			'foreignKey'=>'partner_id',
			'dependent'=>true
		),
		"ReceiveMessage"=>array(
			"className"=>"ReceiveMessage",
			"foreignKey"=>"member_id",
			"dependent"=>true
		),
		'ShoppedItem' => array(
				'className' => 'ShoppedItem',
				'foreignKey' => 'member_id',
				'dependent' => true,
		),
		"Update"=>array(
			'className' => 'Update',
			'foreignKey' => 'member_id',
			'dependent' => true
		),
		"Match"=>array(
			"className"=>"Match",
			"foreignKey"=>"matched_id",
			"dependent"=>true
		)
	);
	
	var $hasAndBelongsToMany = array(
		'ValueStatement' => array(
			'className' => 'ValueStatement',
			'joinTable' => 'members_value_statements',
			'foreignKey' => 'member_id',
			'associationForeignKey' => 'value_statement_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Falsifiable' => array(
			'className' => 'Falsifiable',
			'joinTable' => 'members_falsifiables',
			'foreignKey' => 'member_id',
			'associationForeignKey' => 'falsifiable_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'FriendSayTrait' => array(
			'className' => 'FriendSayTrait',
			'joinTable' => 'members_friend_say_traits',
			'foreignKey' => 'member_id',
			'associationForeignKey' => 'friend_say_trait_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Interest' => array(
			'className' => 'Interest',
			'joinTable' => 'members_interests',
			'foreignKey' => 'member_id',
			'associationForeignKey' => 'interest_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Leisure' => array(
			'className' => 'Leisure',
			'joinTable' => 'members_leisures',
			'foreignKey' => 'member_id',
			'associationForeignKey' => 'leisure_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	
	
	/**
	 * 
	 * Custom validation to check if email exist ...
	 * @param $check
	 */
	function email_exist($check){
		$value = array_values($check);
		$value = $value[0];
		$valid = true;
		if($this->find('first',array('conditions'=>array('Member.email'=>$value)))){
			$valid = false;	
		}
		return $valid;
	}
	
 	function checkFriendSay() {
       if(!empty($this->data[FriendSayTrait][FriendSayTrait])) {
           if (count($this->data[FriendSayTrait][FriendSayTrait])<=4){
	           	return true;
           }
       		
       }else{
	       	return true;
       }

       return false;
    }
	
	
	/**
	 * 
	 * Password input did match custom validation ...
	 * @param $check
	 */
	function password_match($check){
		$value = array_values($check);
		$value = $value[0];
		$valid = true;
		if(sha1($this->data['Member']['password']) != sha1($value)){
			$valid = false;	
		}
		return $valid;
	}
	
	
	/**
	 * 
	 * Password input did match custom validation ...
	 * @param $check
	 */
	function old_password_match($check){
		$value = array_values($check);
		$value = $value[0];
		$valid = true;
		$member = $this->find("first", array("conditions"=>array("Member.id"=>$this->data["Member"]["id"])));
		if ($member["Member"]["password"]!=sha1($value)){
			$valid = false;
		}
		return $valid;
	}
	
	/**
	 * 
	 * Email match ...
	 * @param  $check
	 */
	function email_match($check){
		$value = array_values($check);
		$value = $value[0];
		$valid = true;
		if($this->data['Member']['email'] != $value){
			$valid = false;	
		}
		return $valid;
	}
	
	/**
	 * 
	 * Action responsible for signup of a user ...
	 * @param Array $data
	 */
	function signup($data){
		
		$this->set($data);
		$validates = $this->validates(array("fieldList"=>array("Member.firstname", "Member.lastname", "Member.password", "Member.email", "Member.confirm_email")));
		if ($validates){
			$this->data["Member"]["activation_code"] = $this->getActivationHash();
			$this->data['Member']['password'] = sha1($this->data['Member']['password']);
			if($this->save($this->data, false)){
				$member_id = $this->getLastInsertID();
				$profile = array('MemberProfile'=>array(
					'member_id'=>$member_id,
					"birthdate"=>$data["MemberProfile"]["birthdate"]
				));
				$profAttrib = array('MemberProfileAttributeWeight'=>array(
					'member_id'=>$member_id,
				));
				if($this->create_profile($profile)){
					return $this->create_profile_attribute_weight($profAttrib);
				}
				return true;
				
			}	
		}
		return $validates;
	}
	
	
	
	
	
	function beforeSave(){
		return true;
	}
	
	/**
	 * 
	 * Login ...
	 */
	function login(){
		$viaEmail = $this->find('first',array('conditions'=>array(
					'AND'=>array(
							'Member.email'=>$this->data['Member']['email'],
							'Member.password'=>sha1($this->data['Member']['password']
					))), "recursive"=>-1));
		$viaUsername = $this->find('first',array('conditions'=>array(
					'AND'=>array(
							'Member.username'=>$this->data['Member']['email'],
							'Member.password'=>sha1($this->data['Member']['password']
					))), "recursive"=>-1));
		
		if(!empty($viaEmail)){
			return $viaEmail;	
		}elseif(!empty($viaUsername)){
			return $viaUsername;
		}
		return false;
	}
	
	
	
	function create_profile($new){
			$this->MemberProfile->create($new);
			return $this->MemberProfile->save($new, false);
	}
	
	function create_profile_attribute_weight($new){
		$this->MemberProfileAttributeWeight->create($new);
		return $this->MemberProfileAttributeWeight->save($new, false);
	}
	
	
	function save_1_completion(){
		if(!empty($this->data)){
			$valid = false;
			if($this->MemberProfile->validates(array('fieldList'=>array('marital_status_id', "height_ft", "height_inch", "birthdate", "leisure_activity", "match_want")))){
				if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('birthdate_weight')))){
					$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
					return $valid;
				}
			}
		}
		return $valid;
	}
	
	
	function save_2_completion(){
		if(!empty($this->data)){	
			$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
				
		}
		return $valid;
	}
	function save_3_completion(){
		return $this->save_2_completion();
	}
	function save_4_completion(){
		if(!empty($this->data)){
			$valid = false;
			if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('educational_level_id')))){
				$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
			}
			return $valid;
		}
		return false;
	}
	function save_5_completion(){
		if(!empty($this->data)){
			$valid = false;
			if ($this->MemberProfile->validates(array('fieldList'=>array('occupation')))){
				if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('personal_income_id')))){
					$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
				}
			}
			return $valid;
		}
		return false;
	}
	function save_6_completion(){
		if(!empty($this->data)){
			$valid = false;
			if ($this->MemberProfile->validates(array('fieldList'=>array('occupation')))){
				if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('personal_income_id')))){
					$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
				}
			}
			return $valid;
		}
		return false;
	}
	function save_7_completion(){
		if(!empty($this->data)){
			$valid = false;
			$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
			return $valid;
		}
		return false;
	}
	function save_8_completion(){
		if(!empty($this->data)){
			$valid = false;
			if ($this->MemberProfile->validates(array('fieldList'=>array('occupation')))){
				if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('personal_income_id')))){
					$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
				}
			}
			return $valid;
		}
		return false;
	}
	
	
	function save_9_completion(){
		if(!empty($this->data)){
			$valid = false;
			if ($this->MemberProfile->validates(array('fieldList'=>array('occupation')))){
				if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('personal_income_id')))){
					$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
				}
			}
			return $valid;
		}
		return false;
	}
	function save_10_completion(){
		if(!empty($this->data)){
			$valid = false;
			if ($this->MemberProfile->validates(array('fieldList'=>array('occupation')))){
				if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('personal_income_id')))){
					$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
				}
			}
			return $valid;
		}
		return false;
	}
	function save_11_completion(){
		if(!empty($this->data)){
			$valid = false;
			if ($this->MemberProfile->validates(array('fieldList'=>array('current_job')))){
				$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
			}
			return $valid;
		}
		return false;
	}
	function save_12_completion(){
		if(!empty($this->data)){
			$valid = false;
			if ($this->MemberProfile->validates(array('fieldList'=>array('occupation')))){
				if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('personal_income_id')))){
					$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
				}
			}
			return $valid;
		}
		return false;
	}
	function save_13_completion(){
		if(!empty($this->data)){
			$valid = false;
			if ($this->MemberProfile->validates(array('fieldList'=>array('occupation')))){
				if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('personal_income_id')))){
					$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
				}
			}
			return $valid;
		}
		return false;
	}
	
	function save_14_completion(){
		if(!empty($this->data)){
			$valid = false;
			if ($this->MemberProfile->validates(array('fieldList'=>array('occupation')))){
				if($this->MemberProfileAttributeWeight->validates(array('fieldList'=>array('personal_income_id')))){
					$valid = $this->save_profile_after_validation($this->data['MemberProfile']['id'],$this->data['MemberProfileAttributeWeight']['id']);
				}
			}
			return $valid;
		}
		return false;
	}
	function save_profile_after_validation($memberProfile_id, $memberProfileAttrib_id){
			$validProf = false;
			$validAttrib = false;
			$this->MemberProfile->id = $memberProfile_id;
			$this->MemberProfileAttributeWeight->id = $memberProfileAttrib_id;
			
			$this->MemberProfile->set($this->data);;
			if($this->MemberProfile->save($this->MemberProfile->data, false)){
				$validProf = true;	
			}
			if($this->MemberProfileAttributeWeight->save($this->MemberProfileAttributeWeight->data, false)){
				$validAttrib = true;	
			}
			
			if($validProf && $validAttrib){
				return true;	
			}
			return false;
	}
	
	/**
	 * 
	 * Check the activation email ...
	 * @param $check
	 */
	
	function check_activation_email($check){
		$value = array_values($check);
		$value = $value[0];
		$valid = true;
		$validMember = $this->find('first',array('conditions'=>array('Member.email'=>$this->data['Member']['activation_email'])));
		if(empty($validMember)){
			$valid = false;
		}
		return $valid;
	}
	
	/**
	 * 
	 * Check for activation ...
	 * @param $check
	 */
	function check_activation($check){
		$value = array_values($check);
		$value = $value[0];
		$valid = true;
		$validCode = $this->find('first',array('conditions'=>array('Member.email'=>$this->data['Member']['activation_email']),'recursive'=>0));
		if($value != $validCode['Member']['activation_code']){
			$valid = false;
		}
		return $valid;
	}
	
	/**
	 * 
	 * Activates the user ...
	 */
	function activateCode(){
		if($this->validates(array('fieldList'=>array('activate_code','activation_email')))){
			$member = $this->find('first',array('conditions'=>array('Member.email'=>$this->data['Member']['activation_email']),'recursive'=>0));
			$this->id = $member['Member']['id'];
			$this->saveField('activated',1);
			return true;	
		}
		return false;
	}
	
	/**
	 * Get the activation hash
	 * (non-PHPdoc)
	 * @see AppModel::getActivationHash()
	 */
	function getActivationHash(){
		$a = getdate();
		return substr(sha1($a['seconds'].$a['minutes'].$a['hours'].$a['mday'].$a['mon'].$a['year']),0,8);
	}
	
	/**
	 * 
	 * Forgot password ...
	 * @param unknown_type $member
	 */
	function forgot_password($member = array()){
		$validMember = $this->find('first',array('conditions'=>array('Member.email'=>$member['forgot_email'])));
		if($validMember){
			return $this->reset_password($validMember['id']);
		}
		return false;
	}
	
	
	/**
	 * 
	 * Reset the password of the user ...
	 * @param $id
	 */
	function reset_password($id){
		if(!empty($id)){
			$temp =substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ) , 0 , 6 );
			$this->id=$id;
			$this->saveField('password',sha1($temp));
			return $temp;
		}
		return false;
	}
	
	
	/**
	 * 
	 * Get the member information using key value such as username or id ...
	 * @param unknown_type $key
	 */
	function get_by_key($key=""){
		$member = $this->find("first", array("conditions"=>array("Member.username"=>$key)));
		if (!$member){
			$member = $this->find("first", array("conditions"=>array("Member.id"=>$key)));
		}
		return $member;
	}
	
	

	/**
	 * 
	 * Save current progress of the questionnaire ...
	 * @param $member_id
	 * @param $page
	 */
	function save_progress($member_id, $page){
		$this->id = $member_id;
		$this->saveField("progress", $page);		
	}
	
	/**
	 * 
	 * Autocomplete search ...
	 * @param $q The Query
	 */
	function autocomplete($q){
		$options['conditions'] = array( 
		   "MATCH(Member.lastname,Member.firstname)  
		          AGAINST('$q*' IN BOOLEAN MODE)" 
		);

		return $this->find("all", $options);		
	}

	/**
	 * 
	 * Autocomplete message ...
	 * @param $q The Query
	 */
	function autocomplete_message($q, $id){
		$query = "SELECT Member.id, Member.lastname, Member.firstname, MemberProfile.picture_path FROM matches INNER JOIN members Member ON matches.matched_id = Member.id LEFT JOIN member_profiles MemberProfile ON MemberProfile.member_id = Member.id WHERE MATCH (Member.lastname, Member.firstname) AGAINST('$q*' IN BOOLEAN MODE) AND matches.member_id = $id LIMIT 5";
		debug($query);
		$res = $this->query($query);	
		return $res;
	}
	
	
	function findByCriteria($data, $member_id){
		$this->set($data);
		$validates = true;
		if ($validates){
			$from = $this->data["Member"]["from"];
			$to = $this->data["Member"]["to"];
			$country_id = $this->data["Member"]["country_id"];
			$looking_for_id = $this->data["Member"]["looking_for_id"];
			$zipcode = $this->data["Member"]["zipcode"];
			$options["conditions"] = array(
				"(DATE_FORMAT( FROM_DAYS( TO_DAYS( now( ) ) - TO_DAYS( birthdate ) ) , '%Y' ) +0) BETWEEN ? AND ?" => array($from, $to),
				"Member.country_id" => $country_id,
				"Member.gender_id" => $looking_for_id,
				"Member.zipcode" => $zipcode,
				"Member.id <>"=>$member_id,
			);
			if ($this->data["Member"]["show_picture"]){
				$options["conditions"]["MemberProfile.picture_path <>"] = "";
			}			
			return $this->find("all", $options);
		}
		return $validates;
	}
	
	
	function findByKeyword($data, $member_id){
		$this->set($data);
		$validates = $this->validates(
						array("fieldList"=>
							array("keyword")
						));
		if ($validates){
			$q = $this->data["Member"]["keyword"];
			$options['conditions'] = array( 
			   "MATCH(InMyOwnWordsAnswer.answer)  
			          AGAINST('$q*' IN BOOLEAN MODE)" 
			);
		
			$options["recursive"] = 2;
			$options["fields"] = array("DISTINCT Member.id", "Member.lastname", "Member.firstname");
			$answers = $this->InMyOwnWordsAnswer->find("all", $options);
			
			$options['conditions'] = array( 
			   "MATCH(MemberProfile.short_bio)  
			          AGAINST('$q*' IN BOOLEAN MODE)" 
			);
		
			$options["recursive"] = 2;
			$options["fields"] = array("DISTINCT Member.id", "Member.lastname", "Member.firstname", "MemberProfile.picture_path");
			$members = $this->find("all", $options);
			
			$new_members = array();
			
			
			foreach($answers as $answer){
				$answer = $this->find("first", array(
						"conditions"=>array("Member.id"=>$answer["Member"]["id"]),
						"fields"=>array("Member.id", "Member.lastname", "Member.firstname", "MemberProfile.picture_path")));
				$new_members[] = $answer;
				
			}
			
			if (empty($new_members)){
				foreach($members as $member){
					$new_members[] = $member;
					
				}	
			}else{
				foreach($members as $member){
					$hasMatch = false;
					foreach($answers as $temp){		
						if($temp["Member"]["id"] == $member["Member"]["id"]){					
							$hasMatch = true;
							continue;
						}
					}
					if (!$hasMatch){
						$new_members[] = $member;
					}
				}
			}
			return $new_members;
		}
		return $validates;
	}
	
	function get_q_points($id){
			$temp = $this->find('first',array('conditions'=>array('Member.id'=>$id),'recursive'=>-1));
			return $temp['Member']['credit_points'];	
	}
	
	
	function add_q_points($member_id, $q_points){
		$this->update_q_points($member_id, $this->get_q_points($member_id)+$q_points);
	}
	
	function subtract_q_points($member_id, $q_points){
		$total = $this->get_q_points($member_id);
		if ($q_points>$total){
			return false;
		}else{
			return $this->update_q_points($member_id, $total - $q_points);
		}
	}
	
	function update_q_points($member_id, $q_points){
		$this->id = $member_id;
		$this->saveField("credit_points", $q_points);	
		return true;
	}
	
	function updateRole($role_id, $member_id){
		$this->id = $member_id;
		$this->saveField("role_id", $role_id);	
		return  true;	
	}
	
	function q_point_deduction($member,$total){
		$q_points = $this->get_q_points($member);
		$new_credit = $q_points - $total;
		$this->id = $member;
		return $this->saveField('credit_points',$new_credit);
	}
	
	/**
	 * 
	 * Get the current role of the user ...
	 * @param $member_id
	 */
	function getRole($member_id){
		$role = $this->find("first",array("conditions"=>array("Member.id"=>$member_id), "recursive"=>-1, array("fields"=>"role_id")));
		return $role["Member"]["role_id"];
	}
	
	function hasManyV2(){
		$this->unbindModel(array("hasMany"=>array("GiftAvailTransaction", "Notification", "CreditCard", "PrivateMessage", "SentGift", "SubscriptionTransaction", "MemberProfileAnswer", "MemberAttributeWeight", "Album", "InMyOwnWordsAnswer", "MembersInterest", "Connection", "ReceiveMessage", "ShoppedItem")));
	}
	
	/**
	 * 
	 * Load for receive messages of users ...
	 * @param $member_id
	 */
	function loadMessages($member_id){
		$this->unbindModel(array("hasMany"=>array("GiftAvailTransaction", "Notification", "CreditCard", "PrivateMessage", "SentGift", "SubscriptionTransaction", "MemberProfileAnswer", "MemberAttributeWeight", "Album", "InMyOwnWordsAnswer", "MembersInterest", "Connection", "ShoppedItem")));
		$this->unbindModel(array("hasAndBelongsToMany"=>array("ValueStatement", "FriendSayTrait", "Falsifiable", "Leisure")));
		$this->unbindModel(array("belongsTo"=>array("Country", "Idea", "Gender", "Role")));
		$this->unbindModel(array("hasOne"=>array("MemberProfile", "MemberProfileAttributeWeight","MemberSetting")));
		$member = $this->find("first", array("conditions"=>array("Member.id"=>$member_id), "fields"=>array("id", "firstname")));
		return $member;
		
	}
	
	
	function getMemberForMatching($member_id){
		$this->unbindModel(array("hasMany"=>array("GiftAvailTransaction", "Notification", "CreditCard", "PrivateMessage", "SentGift", "SubscriptionTransaction", "Album", "InMyOwnWordsAnswer", "MembersInterest", "Connection", "ShoppedItem")));
		$this->unbindModel(array("hasAndBelongsToMany"=>array("ValueStatement", "FriendSayTrait", "Falsifiable", "Leisure")));
		$member = $this->find("first", array(
				"conditions"=>array("Member.id"=>$member_id), 
				));
		return $member;		
	}
	
	
	function getProfileInfo($member_id) {
	  return $this->find('first', array(
	     'conditions'=>array(
	      'Member.id'=>$member_id),
	     'fields'=>array(
	      'Member.firstname',
	      'Member.lastname'),
	     'recursive'=>-1));
	 }
	
	function isExisting($member_id) {
		$member = $this->find ( 'first', array ('conditions' => array ('Member.id' => $member_id ),
				 'fields' => array ('Member.id' ),
				 'recursive' => - 1 ) );
		if (! empty ( $member )) {
			return true;
		} else {
			return false;
		}
	}
	
	function requestFriends($member_id, $view_member_id){
		$this->query("INSERT INTO userlist(userid, relationid, friend) VALUES ($member_id, $view_member_id, 'yes')");	
		$this->query("INSERT INTO userlist(userid, relationid, friend) VALUES ($view_member_id, $member_id, 'no')");	
	}

	function updateOnline($member_id, $state){
		$this->id = $member_id;
		$this->saveField("online", $state);
	}
	
	function isOnline($member_id){
		$member = $this->Member->find("all", array("conditions"=>array("Member.id"=>$member_id), "recursive"=>-1, "fields"=>array("online")));
		return $member["Member"]["online"];
	}
	
function getPhotos($member_id) {
		$albumList = $this->getAlbumsList($member_id);
		
		if(!empty($albumList)) {
			$albumIdList = array_keys($albumList);
			$photos = $this->Album->getPhotos($albumIdList, 'RAND()', 2);
			return (!empty($photos) ? $photos : false);
		} else {
			return false;
		}
	}
	
	function getAlbumsList($member_id, $field = null) {
		$query = array('conditions'=> array(
							'Album.member_id'=>$member_id));
		if($field) { 
			$query = array('fields'=>array('Album.id', 'Album.' . $field));
		}
		
		$albums = $this->Album->find('list', $query);
		return (!empty($albums) ? $albums : false);
	}
	
	//sets the albums info.. returns false if no albums
	function getMemberAlbums($member_id) {
		$albums = $this->getAlbumsList($member_id);
		if(!empty($albums)) {
			foreach( $albums as $album_id => $albumName ) {
				$pic_count = $this->Album->countPhotos($album_id);
				if($cover_pic = $this->Album->getCoverPicture($album_id)) {
					$myAlbums[$album_id]['cover_pic'] = $cover_pic;
				} else {
					$myAlbums[$album_id]['cover_pic'] = $this->Album->getFirstPhoto($album_id, 'picture_path');
				}
				$myAlbums[$album_id]['pic_count'] = $pic_count;
				$myAlbums[$album_id]['name'] = $albumName;
			}// end foreach
			return $myAlbums;
		} else {
			return false;
		}
	}
	
	function getRandomMatchesPhotos($member_id) {
		if( $matches = $this->Match->getRandomMatch($member_id, 'list', 'member_id')) { //check if there is a match
			$ctr = 0;
			foreach($matches as $mem_id) {
				if($photos = $this->getPhotos($mem_id)) {
					for($i = 0; $i < count(array_keys($photos)); $i++) {
						$photos[$i]['Photo']['albumName'] = $this->Album->getAlbumInfo($photos[$i]['Photo']['album_id'], 'name');
						$photos[$i]['Photo']['member_id'] = $mem_id;
						$memberInfo = $this->getProfileInfo($mem_id);
						$myMatches[$ctr] = $photos;
						$myMatches[$ctr]['name'] = $memberInfo['Member']['firstname'] . ' ' . $memberInfo['Member']['lastname'];
					}
					$ctr++;
					//we need just 2 featured match.. end search
					if($ctr > 2) { return $myMatches; }
				}
			} //end foreach
			return (isset($myMatches) ? $myMatches : false);
		} else {
			return false;
		}
	}
	
	function getProfilePicture($member_id, $field = null) {
		$albumList = $this->getAlbumsList($member_id);
		
		if(!empty($albumList)) {
			$albumIdList = array_keys($albumList);
			
			$profilePicture = $this->Album->Photo->find('first', 
									array('conditions'=>array(
										'Photo.profile_pic'=>1,
										'Photo.album_id'=>$albumIdList,
										'Photo.photo_status_id'=>1),
									'recursive'=>-1,
									'limit'=>1));
			if(!empty($profilePicture)) {
				return (!$field ?  $profilePicture : $profilePicture['Photo'][$field]);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function setProfilePicture($member_id, $photo_id) {
		//get the current profile picture.. check if its not the same picture to be assigned as profile picture
		if($photo_id != $profilePicture = $this->getProfilePicture($member_id, 'id')) { 
			//unset the current profile picture
			$this->Album->Photo->id = $profilePicture;
			$this->Album->Photo->saveField('profile_pic', 0);
			//assign the new one
			$this->Album->Photo->id = $photo_id;
			$this->Album->Photo->saveField('profile_pic', 1);
			return true;
		} else { // same profile picture is being assign.. cancel..
			return false;
		}
	}
	
	/**
	 * 
	 * Resets the password of the member ...
	 * @param $code
	 */
	function reset($code){
		$member =  $this->find("first", array("conditions"=>array("Member.reset_code"=>$code)));
		if ($member){
			$member["Member"]["password"] = "";
			return $this->save($member, false);
		}else{
			return false;
		}
	}
}
