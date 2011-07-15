<?php
class NotificationType extends AppModel {
	var $name = 'NotificationType';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'notification_type_id',
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