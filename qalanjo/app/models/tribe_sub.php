<?php
/**
 * 
 * Sub tribe of a tribe in Somali ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class TribeSub extends AppModel {
	var $name = 'TribeSub';
	var $displayField = 'value';

	var $belongsTo = array(
		'Tribe' => array(
			'className' => 'Tribe',
			'foreignKey' => 'tribe_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'MemberSetting' => array(
			'className' => 'MemberSetting',
			'foreignKey' => 'tribe_sub_id',
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