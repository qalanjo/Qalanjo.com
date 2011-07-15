<?php
class Gift extends AppModel {
	var $name = 'Gift';
	var $validate = array(
		'name' => array(
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
		'GiftType' => array(
			'className' => 'GiftType',
			'foreignKey' => 'gift_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'GiftAvailTransactionItem' => array(
			'className' => 'GiftAvailTransactionItem',
			'foreignKey' => 'gift_id',
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
	 * called to populate a new scrollable div...
	 * @param $query
	 * @param $type
	 */
	
	function get_remaining_items($type,$last_gift_id){
		
		$this->GiftType->unbindModel(array('hasMany'=>array('Gift')));
		
		$this->GiftType->bindModel(array('hasMany'=>
			array(
				'Gift' => array(
					'className' => 'Gift',
					'foreignKey' => 'gift_type_id',
					'dependent' => false,
					'conditions' => array('Gift.id <'=>$last_gift_id),
					'order' => array('Gift.id'=>'desc'),
					'limit' => 6,
				)
			)
		));
		
		$type = $this->GiftType->find('first',array('conditions'=>array(
			'GiftType.id'=>$type,
		)));
		
		
		return $type;
		
	}
}
?>