<?php
/**
 * 
 * These are the accompanied answer for profile question ...
 * @author Allanaire
 *
 */
class ProfileAnswer extends AppModel {
	var $name = 'ProfileAnswer';
	var $displayField = 'answer';
	
	
	var $belongsTo = array(
		'ProfileQuestion' => array(
			'className' => 'ProfileQuestion',
			'foreignKey' => 'profile_question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'MemberProfileAnswer' => array(
			'className' => 'MemberProfileAnswer',
			'foreignKey' => 'profile_answer_id',
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

	function listAnswers($profile_question_id){
		return $this->find("list", array("fields"=>array("id", "answer"),
			 "conditions"=>array("ProfileAnswer.profile_question_id"=>$profile_question_id),"recursive"=>-1));
	}
}
?>