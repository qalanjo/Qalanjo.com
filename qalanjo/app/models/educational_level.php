<?php
class EducationalLevel extends AppModel {
	var $name = 'EducationalLevel';
	
	var $hasMany = array(
		'MemberProfileAttributeWeight' => array(
			'className' => 'MemberProfileAttributeWeight',
			'foreignKey' => 'educational_level_id',
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