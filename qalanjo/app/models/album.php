<?php
class Album extends AppModel {
	var $name = 'Album';
	var $displayField = 'name';
	var $profileAlbum = 'default'; //profile album folder name
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
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Photo' => array(
			'className' => 'Photo',
			'foreignKey' => 'album_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PhotoUpdate' => array(
			'className' => 'PhotoUpdate',
			'foreignKey' => 'album_id',
			'dependent' => true,
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
	
	function createDefault($album){
		$this->set($album);
		$this->create($this->data);
		return $this->save($this->data);
	}
	
	
	function getDefaultAlbum($member_id, $field = null){
		$profile = $this->find("first", array(
					"conditions"=>array(
						"Album.name"=>$this->profileAlbum, 
						"Album.member_id"=>$member_id),
				  "recursive"=>-1, 
		));
		
		return (!$field ? $profile : $profile[$this->name][$field]);
	}
	
	function countPhotos($album_id) {
		return $this->Photo->find('count', array(
				'conditions'=>array(
					'Photo.album_id'=>$album_id,
					'Photo.photo_status_id'=>1)));
	}
	
	function getPhotos($album_id, $order = 'Photo.created DESC', $limit = null) {
		$photos = $this->Photo->find('all', array(
						'conditions'=>array(
							'Photo.album_id'=>$album_id,
							'Photo.photo_status_id'=>1),
						'recursive'=>-1,
						'limit'=>$limit,
						'order'=>$order));
		return (!empty($photos) ? $photos : false);
	}
	
	function getAlbumInfo($album_id, $field = null) {
		$album = $this->find('first', array(
					'conditions'=>array(
						'Album.id'=>$album_id),
					'recursive'=>-1));
		
		return (!$field ? $album : $album[$this->name][$field]);
	}
	
	function albumNameExist($albumName, $member_id) {
			$match = $this->find('first', array( 
									'conditions'=> array(
										'Album.member_id'=>$member_id,
										'Album.name'=>$albumName),
									'fields'=> array(
										'Album.name'),
									'recursive'=>-1));
			return (!empty($match) ? true : false);
	}
	
	//rename album
	function setAlbumName($album_id, $newAlbumName, $member_id) {
		if(!$this->albumNameExist($newAlbumName, $member_id)) {
			$this->id = $album_id;
			$this->saveField('name', $newAlbumName);
			return true;
		} else {
			return false;
		}
	}
	
	function getCoverPicture($album_id) {
		$cover = $this->Photo->find('first', array(
					'conditions'=>array(
						'Photo.album_id'=>$album_id,
						'Photo.cover_pic'=>1),
					'recursive'=>-1));
		
		return (!$cover ? false : $cover['Photo']['picture_path']);
	}
	
	//check if the viewer is the owner of the album
	function isVisitor($member_id, $album_id) {
		$viewer = $this->find('first', array(
					'conditions'=>array(
						'Album.id'=>$album_id,
						'Album.member_id'=>$member_id),
					'recursive'=>-1));
		
		return (!empty($viewer) ? false : true);
	}
	
	function isDefaultAlbum($album_id) {
		$album = $this->getAlbumInfo($album_id, 'name');
		return ($album == $this->profileAlbum ? true : false);
	}
	
	function getFirstPhoto($album_id, $field = null) {
		$photo = $this->Photo->find('first', array(
						'conditions'=> array(
							'Photo.album_id'=>$album_id),
						'fields'=> array(
							'Photo.picture_path'),
						'recursive'=>-1));
		return (!$field ? $photo : $photo['Photo'][$field]);
	}
	
	//check if album exist
	function isExisting($album_id) {
		$album = $this->find('first', array(
						'conditions'=> array(
							'Album.id'=>$album_id),
						'recursive'=>-1));
		
		return (!empty($album) ? true : false);
	}
	
	//1 for profile.. 0 if not
	function saveUpdate($album_id, $type = 0) {
		$member_id = $this->getAlbumInfo($album_id, 'member_id');
		$update['PhotoUpdate']['id'] = null;
		$update['PhotoUpdate']['member_id'] = $member_id;
		$update['PhotoUpdate']['album_id'] = $album_id;
		$update['PhotoUpdate']['created'] = date('Y-m-d H:i');
		$update['PhotoUpdate']['profile'] = $type;
		$this->PhotoUpdate->save($update);
	}
}

