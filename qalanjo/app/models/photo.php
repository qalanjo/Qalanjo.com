<?php
class Photo extends AppModel {
	var $name = 'Photo';
	var $displayField = 'title';
	var $validate = array(
		'picture_path' => array(
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
		'Album' => array(
			'className' => 'Album',
			'foreignKey' => 'album_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getPhotoInfo($photo_id, $field = null) {
		$photo = $this->find('first', array(
				'conditions'=> array(
					'Photo.id'=>$photo_id),
				'recursive'=>-1));
		
		return (!$field ? $photo : $photo[$this->name][$field]);
	}
	
}
