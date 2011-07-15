<?php
class Distance extends AppModel {
	var $name = 'Distance';
	var $displayField = 'label';
	
	
	var $hasMany = array(
		'MemberSetting' => array(
			'className' => 'MemberSetting',
			'foreignKey' => 'distance_id',
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

}
?>