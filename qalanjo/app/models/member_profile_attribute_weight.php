<?php
class MemberProfileAttributeWeight extends AppModel {
	var $name = 'MemberProfileAttributeWeight';
	var $validate = array(
		'personal_income_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please specify your personal income',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'educational_level_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please specify your highest educational attainment',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'physical_appearance_satisfaction' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please rate your satisfaction with your physical appearance',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'physical_appearance_satisfaction_weight' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please rate your satisfaction with your physical appearance',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PersonalIncome' => array(
			'className' => 'PersonalIncome',
			'foreignKey' => 'personal_income_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EducationalLevel' => array(
			'className' => 'EducationalLevel',
			'foreignKey' => 'educational_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
?>