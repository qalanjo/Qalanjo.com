<?php
class ExpressQuestion extends AppModel {
	var $name = 'ExpressQuestion';
	var $displayField = 'question';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ExpressQuestionType' => array(
			'className' => 'ExpressQuestionType',
			'foreignKey' => 'express_question_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ExpressAnswer' => array(
			'className' => 'ExpressAnswer',
			'foreignKey' => 'express_question_id',
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