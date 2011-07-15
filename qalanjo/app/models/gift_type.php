<?php
class GiftType extends AppModel {
	var $name = 'GiftType';
	var $displayField = 'value';
	var $validate = array(
		'value' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Type must not be empty'
			),
			'unique'=>array(
				'rule'=>array('mustBeUnique','GiftType.value'),
				'message'=>'The value already exists'
			)
		),
	);
	
	var $hasMany = array(
		'Gift' => array(
			'className' => 'Gift',
			'foreignKey' => 'gift_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('Gift.id'=>'desc'),
			'limit' => 12,
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function mustBeUnique($check,$field){
		$value = array_values($check);
		$value = $value[0];
		$notUnique = $this->find('first',array('conditions'=>array($field=>$value)));
		if($notUnique){
			return false;	
		}
		return true;
	}

}
?>