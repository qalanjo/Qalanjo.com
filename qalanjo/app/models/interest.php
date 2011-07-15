<?php
class Interest extends AppModel {
	var $name = 'Interest';
	var $displayField = 'description';
	var $validate = array(
		'description' => array(
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
		'InterestType' => array(
			'className' => 'InterestType',
			'foreignKey' => 'interest_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);
	
	var $hasAndBelongsToMany = array(
		'Member' => array(
			'className' => 'Member',
			'joinTable' => 'members_interests',
			'foreignKey' => 'interest_id',
			'associationForeignKey' => 'member_id',
			'unique' => true
		),
	
	);
	
	var $hasMany = array(
		'MembersInterest' => array(
			'className' => 'MembersInterest',
			'foreignKey' => 'interest_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	function get($type, $limit=20, $shuffle=false){
		$this->layout  = "ajax";
		$option["conditions"] = array("InterestType.description"=>strtolower($type));
		$option["recursive"] = -1;
		if ($shuffle){
			$option["order"] = "RAND()";
		}
		$option["fields"] = array("id", "description");
 		return $this->find("list", $option);
	}
	
	function getSameInterestTypes($member_id, $view_member_id){
		$member = $this->Member->find("first", array("conditions"=>array("Member.id"=>$member_id),
											"recursive"=>1));
		$view_member = $this->Member->find("first", array("conditions"=>array("Member.id"=>$view_member_id),
											"recursive"=>1));
		$interests = array();
		/**
		 * Find the same interest types
		 */
		foreach($member["Interest"] as $interest){
			foreach($view_member["Interest"] as $compare_interest){
				if ($interest["interest_type_id"]==$compare_interest["interest_type_id"]){
					$found = false;
					foreach($interests as $temp){
						if ($interest["interest_type_id"]==$temp){
							$found=true;
						}
					}
					if (!$found){
						$interests[] = $interest["interest_type_id"];
					}
				}
			}
		}
		return $interests;
		
	}

}
?>