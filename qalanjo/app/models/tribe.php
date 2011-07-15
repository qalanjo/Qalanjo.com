<?php

/**
 * 
 * Object for representing a tribe ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class Tribe extends AppModel {
	var $name = 'Tribe';
	var $displayField = 'value';
	
	var $hasMany = array(
		'TribeSub' => array(
			'className' => 'TribeSub',
			'foreignKey' => 'tribe_id',
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


	var $hasAndBelongsToMany = array(
		'MemberSetting' => array(
			'className' => 'MemberSetting',
			'joinTable' => 'member_settings_tribes',
			'foreignKey' => 'tribe_id',
			'associationForeignKey' => 'member_setting_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>