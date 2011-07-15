<?php
class Attribute extends AppModel {
	var $name = 'Attribute';
	var $displayField = 'attribute';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'AttributeCategory' => array(
			'className' => 'AttributeCategory',
			'foreignKey' => 'attribute_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AttributeType' => array(
			'className' => 'AttributeType',
			'foreignKey' => 'attribute_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	var $hasMany = array(
		'AttributeInterpretation' => array(
			'className' => 'AttributeInterpretation',
			'foreignKey' => 'attribute_id',
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
	

	function load($type, $limit=array()){
		return $this->Attribute->find("all", array(
										"conditions"=>array("Attribute.attribute_category_id"=>$type),
										"recursive"=>1,
										));
			
	}

}
?>