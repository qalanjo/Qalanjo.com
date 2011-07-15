<?php
class MemberSetting extends AppModel {
	var $name = 'MemberSetting';
	var $validate = array(
		'age_from' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid age',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The field is required.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minlen' => array(
				'rule' => array('minlen', 18),
				'message' => "Minimum age for match making is 18 years old"
			),
			'maxlen' => array(
				'rule' => array('maxlen', 60),
				'message' => "Maximum age for match making is 60 years old"
			)
			
			
		),
		'age_to' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlen' => array(
				'rule' => array('maxlen', 60),
				'message' => "Maximum age for match making is 60 years old"
			),
			'minlen' => array(
				'rule' => array('minlen', 18),
				'message' => "Minimum age for match making is 18 years old"
			)
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
		'Distance' => array(
			'className' => 'Distance',
			'foreignKey' => 'distance_id',
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
		)
	);

	var $hasAndBelongsToMany = array(
		'Tribe' => array(
			'className' => 'Tribe',
			'joinTable' => 'member_settings_tribes',
			'foreignKey' => 'member_setting_id',
			'associationForeignKey' => 'tribe_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	

}
?>