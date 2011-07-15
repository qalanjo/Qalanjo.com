<?php
class MembersInterest extends AppModel {
	var $name = 'MembersInterest';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Interest' => array(
			'className' => 'Interest',
			'foreignKey' => 'interest_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	function save_selected($data){
		$this->set($data);
		$i = 0;
		foreach($data["Interest"] as $interest){
			$type_id = $interest["interest_type_id"];
			$member_id = $interest["member_id"];
			if ($i==0){				
				$loadedInterests = $this->Interest->find("all", array(
											"conditions"=>array("Interest.interest_type_id"=>$type_id)));
				foreach($loadedInterests as $temp){
					$item = $this->find("first", array("conditions"=>array("MembersInterest.member_id"=>$member_id, 
																	"MembersInterest.interest_id"=>$temp["Interest"]["id"])));
					$this->delete($item["MembersInterest"]["id"]);
				}
			}
			if (isset($interest["interest_id"])){
				$interest_id = $interest["interest_id"];			
				$this->data["MembersInterest"]["member_id"] = $member_id;
				$this->data["MembersInterest"]["interest_id"] = $interest_id;
				$this->create($this->data);
				$this->save($this->data);
			}
			$i++;
		}
	}
}
?>