<?php
class PersonalIncome extends AppModel {
	var $name = 'PersonalIncome';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'MemberProfileAttributeWeight' => array(
			'className' => 'MemberProfileAttributeWeight',
			'foreignKey' => 'personal_income_id',
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