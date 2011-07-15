<?php
class SentIceBreaker extends AppModel {
	var $name = 'SentIceBreaker';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'IceBreaker' => array(
			'className' => 'IceBreaker',
			'foreignKey' => 'ice_breaker_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ToMember' => array(
			'className' => 'Member',
			'foreignKey' => 'to_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getSentIceBreaker($member_id){
		$icebreaker = $this->find("first",
					 array("conditions"=>array(
					 "SentIceBreaker.id"=>$member_id)
					, "contain"=>
						array("Member.firstname",
							"Member.id",
							"Member.lastname",
							"Member.city",
							"Member.state",
							"Member.country_id",
							"Member.gender_id",
							"IceBreaker.value")));
		return $icebreaker;
	}
	
	function getSentIceBreakerForCommunications($member_id){
		$icebreakers = $this->find("all",
					 array("conditions"=>array(
					 "SentIceBreaker.to_id"=>$member_id)
					, "contain"=>
						array("Member.firstname",
							"Member.id",
							"Member.lastname",
							"Member.city",
							"Member.state",
							"Member.country_id",
							"Member.gender_id",
							"IceBreaker.value")));
		return $icebreakers;
	}
}
?>