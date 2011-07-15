<?php
class MembersExpressAnswer extends AppModel {
	var $name = 'MembersExpressAnswer';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ExpressAnswer' => array(
			'className' => 'ExpressAnswer',
			'foreignKey' => 'express_answer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>