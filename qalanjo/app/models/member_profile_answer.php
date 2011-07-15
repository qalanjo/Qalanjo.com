<?php
class MemberProfileAnswer extends AppModel {
	var $name = 'MemberProfileAnswer';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ProfileAnswer' => array(
			'className' => 'ProfileAnswer',
			'foreignKey' => 'profile_answer_id',
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
		)
	);
	
	function save_answer($data){
		$this->set($data);
		
		$answer =  $this->find("first", array("conditions"=>
			array("MemberProfileAnswer.member_id"=>$this->data["MemberProfileAnswer"]["member_id"], "MemberProfileAnswer.profile_answer_id"=>$this->data["MemberProfileAnswer"]["profile_answer_id"])));
		if (!$answer){
			$this->create($this->data);
			$this->save($this->data, false);
			return $this->find("first", array("conditions"=>
			array("MemberProfileAnswer.member_id"=>$this->data["MemberProfileAnswer"]["member_id"], "MemberProfileAnswer.profile_answer_id"=>$this->data["MemberProfileAnswer"]["profile_answer_id"])));
		
		}else{
			$answer["MemberProfileAnswer"]["profile_answer_id"] = $this->data["MemberProfileAnswer"]["profile_answer_id"];
			$this->save($answer, false);
			return $this->find("first", array("conditions"=>
			array("MemberProfileAnswer.member_id"=>$data["MemberProfileAnswer"]["member_id"], "MemberProfileAnswer.profile_answer_id"=>$data["MemberProfileAnswer"]["profile_answer_id"])));
		
		}
		
	}
}
?>