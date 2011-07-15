<?php

class PhotoUpdatesController extends AppController {
	var $name = 'PhotoUpdates';
	var $helpers = array('Time');
	
	function index() {
		$this->layout = "blue_full_block";
		
		$member_id = $this->Session->read('Member.id');
		$updates = $this->PhotoUpdate->getUpdates($member_id);
		$this->set('updates', $updates);
	}
	
	function loadUpdates() {
		if($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
			$this->loadModel('Album');
			$member_id = $this->Session->read('Member.id');
			//get updates
			if($photoUpdates = $this->PhotoUpdate->getUpdates($member_id)) {
				$album_id = $photoUpdates[0]['Photo']['album_id'];
				$albumName = $this->Album->getAlbumInfo($album_id, 'name');
				$this->set('photoUpdates', $photoUpdates);
				$this->set('member_id', $member_id);
				$this->set('albumName', $albumName);
				$this->set('album_id', $album_id);
				$hasUpdate = true;
			} else { //no updates yet
				$hasUpdate = false;
			}
			$this->set('hasUpdate', $hasUpdate);
			$this->render('/elements/blue/members/index/photo-update-content', 'ajax');
		}
	}
	
}