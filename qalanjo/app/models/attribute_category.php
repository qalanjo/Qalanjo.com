<?php
class AttributeCategory extends AppModel {
	var $name = 'AttributeCategory';
	var $displayField = 'value';
	var $validate = array(
		'value' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The field should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	

	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Attribute' => array(
			'className' => 'Attribute',
			'foreignKey' => 'attribute_category_id',
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