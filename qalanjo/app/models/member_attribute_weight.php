<?php
class MemberAttributeWeight extends AppModel {
	var $name = 'MemberAttributeWeight';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Attribute' => array(
			'className' => 'Attribute',
			'foreignKey' => 'attribute_id',
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
	
	
	function reset($member_id){
		$this->deleteAll(array("MemberAttributeWeight.member_id"=>$member_id));
	}
	
	function saveWeight($weight, $attribute, $member){
		$weight = mysql_escape_string($weight);
		$attribute = mysql_escape_string($attribute);
		$member = mysql_escape_string($member);
		$weightable_attribute = $this->find("first", array("conditions"=>array("MemberAttributeWeight.attribute_id"=>$attribute,"MemberAttributeWeight.member_id"=>$member)));
		if (!empty($weightable_attribute)){
			$weightable_attribute["MemberAttributeWeight"]["weight"] = $weight;
			$this->save($weightable_attribute, false);
		}else{
			$this->data["MemberAttributeWeight"]["member_id"] = $member;
			$this->data["MemberAttributeWeight"]["attribute_id"]=$attribute;
			$this->data["MemberAttributeWeight"]["weight"] =  $weight;	
			$this->create($this->data);
			$this->save($this->data, false);	
		}
	}	
}
?>