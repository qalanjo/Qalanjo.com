<?php
class Reciprocal extends AppModel {
	var $name = 'Reciprocal';
	var $displayField = 'question';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ReciprocalType' => array(
			'className' => 'ReciprocalType',
			'foreignKey' => 'reciprocal_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'MemberReciprocalWeight' => array(
			'className' => 'MemberReciprocalWeight',
			'foreignKey' => 'reciprocal_id',
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
	 * Loads for item given the specified page ...
	 * @param $page
	 */
	public function loadItems($page){
		$this->unbindModel(array("hasMany"=>array("MemberReciprocalWeight")));
		return $this->find("all", array("conditions"=>array("Reciprocal.page"=>$page)));
	}

}
