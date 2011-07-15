<?php
class MemberReciprocalWeight extends AppModel {
	var $name = 'MemberReciprocalWeight';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Reciprocal' => array(
			'className' => 'Reciprocal',
			'foreignKey' => 'reciprocal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function saveAnswers($data){
		$this->set($data);
		foreach($this->data["MemberReciprocalWeight"] as $item){
			$this->deleteAll(array("MemberReciprocalWeight.member_id"=>$item["member_id"], "MemberReciprocalWeight.reciprocal_id"=>$item["reciprocal_id"]));
		}
		return $this->saveAll($this->data["MemberReciprocalWeight"]);
	}
}
