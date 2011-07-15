<?php
class ExpressAnswer extends AppModel {
	var $name = 'ExpressAnswer';
	var $displayField = 'answer';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ExpressQuestion' => array(
			'className' => 'ExpressQuestion',
			'foreignKey' => 'express_question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'MembersExpressAnswer' => array(
			'className' => 'MembersExpressAnswer',
			'foreignKey' => 'express_answer_id',
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