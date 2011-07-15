<?php
/**
 * 
 * These are profile question ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class ProfileQuestion extends AppModel {
	var $name = 'ProfileQuestion';
	var $displayField = 'question';
	
	var $belongsTo = array(
		'ProfileQuestionType' => array(
			'className' => 'ProfileQuestionType',
			'foreignKey' => 'profile_question_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ProfileAnswer' => array(
			'className' => 'ProfileAnswer',
			'foreignKey' => 'profile_question_id',
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

	/**
	 * 
	 * Finding the list of attribute ...
	 * @param $question_id The question
	 * @param $member_id The member
	 */
	function findAttribute($question_id, $member_id){
		$this->unbindModel(array("belongsTo"=>array("ProfileQuestionType")));
		$question = $this->find("first", array("conditions"=>array("ProfileQuestion.id"=>$question_id)));
		$this->ProfileAnswer->MemberProfileAnswer->unbindModel(array("belongsTo"=>array("Member")));
		foreach($question["ProfileAnswer"] as $answer){
			$temp = $this->ProfileAnswer->MemberProfileAnswer->find("first", array("conditions"=>array("MemberProfileAnswer.profile_answer_id"=>$answer["id"], "MemberProfileAnswer.member_id"=>$member_id)));
			if ($temp){
				return $temp;
			}
		}	
	}
	
}
?>