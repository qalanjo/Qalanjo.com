<?php
class ExpressQuestionType extends AppModel {
	var $name = 'ExpressQuestionType';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'ExpressQuestion' => array(
			'className' => 'ExpressQuestion',
			'foreignKey' => 'express_question_type_id',
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