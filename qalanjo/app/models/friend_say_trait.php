<?php
class FriendSayTrait extends AppModel {
	var $name = 'FriendSayTrait';
	var $displayField = 'value';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Member' => array(
			'className' => 'Member',
			'joinTable' => 'members_friend_say_traits',
			'foreignKey' => 'friend_say_trait_id',
			'associationForeignKey' => 'member_id',
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