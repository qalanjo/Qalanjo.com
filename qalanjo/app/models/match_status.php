<?php
class MatchStatus extends AppModel {
	var $name = 'MatchStatus';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Match' => array(
			'className' => 'Match',
			'foreignKey' => 'match_status_id',
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