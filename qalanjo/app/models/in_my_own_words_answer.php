<?php
class InMyOwnWordsAnswer extends AppModel {
	var $name = 'InMyOwnWordsAnswer';
	var $validate = array(
		'answer' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'InMyOwnWordQuestion' => array(
			'className' => 'InMyOwnWordsQuestions',
			'foreignKey' => 'in_my_own_words_question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	function shuffle($member_id, $limit = 2){
		return $this->find("all", array("conditions"=>
									array("InMyOwnWordsAnswer.member_id"=>$member_id),
									"limit"=>$limit
							));
	}
	
	function saveAnswers($data){
		$this->set($data);
		foreach($this->data["InMyOwnWordsAnswer"] as $answer){
			$this->deleteAll(array("InMyOwnWordsAnswer.in_my_own_words_question_id"=>$answer["in_my_own_words_question_id"], "InMyOwnWordsAnswer.member_id"=>$answer["member_id"]));			
		}
		$this->create($this->data);
		$this->saveAll($this->data["InMyOwnWordsAnswer"]);
	}
	
}
?>