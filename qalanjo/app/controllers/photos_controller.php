<?php
App::import("Vendor", "simpleimage");

class PhotosController extends AppController {

	var $name = 'Photos';
    var $helpers = array('Html', 'Javascript', 'Time');
    var $tempAlbum = 'rb72aknjykn0w5cefu6z3g7yw8xnpa'; // temp album name on upload
    var $profileAlbum = 'default'; // profile album folder name

	function beforeFilter() {
		parent::beforeFilter();
		
		$action = $this->action;
		$member_id = $this->Session->read('Member.id');
		
		if($action == 'upload') {
			
		}
		
	
	}
	
	function beforeRender() {
		parent::beforeRender();
		
		
	}
	function admin_index() {
		$this->Photo->recursive = 0;
		$this->set('photos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid photo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('photo', $this->Photo->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Photo->create();
			if ($this->Photo->save($this->data)) {
				$this->Session->setFlash(__('The photo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photo could not be saved. Please, try again.', true));
			}
		}
		$albums = $this->Photo->Album->find('list');
		$this->set(compact('albums'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid photo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Photo->save($this->data)) {
				$this->Session->setFlash(__('The photo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Photo->read(null, $id);
		}
		$albums = $this->Photo->Album->find('list');
		$this->set(compact('albums'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for photo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Photo->delete($id)) {
			$this->Session->setFlash(__('Photo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Photo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function index() {
		$member_id = $this->Session->read("Member.id");
		
		$this->redirect(array(
					'controller'=>'photos',
					'action'=>'view', $member_id));
	}
	
	function view($owner_id = null) {
		$this->layout = "blue_full_block";
		$this->loadModel('Member');
		$this->loadModel('Album');
		$this->loadModel('Match');
		$this->loadModel('PhotoUpdate');
				
		$member_id = $this->Session->read("Member.id");
		$list = $this->Member->getAlbumsList($member_id);
		//debug(array_keys($list));
		if(!$owner_id) { //if owner_id not specified.. render the viewers own profile
			$owner_id = $member_id;
		}
		
		if($this->Member->isExisting($owner_id)) { //check if owner really exist..
				$visitor = ($owner_id == $member_id ? false : true);
				$profileInfo = $this->Member->getProfileInfo($owner_id); //info used on the left bar.. profile element
				$myAlbums = $this->Member->getMemberAlbums($owner_id); //set up the array of album info used on rendering of albums
				$myMatches = $this->Member->getRandomMatchesPhotos($member_id);
		} else {
			$this->redirect(array(
					'controller'=>'photos',
					'action'=>'view', $member_id));
		}
			if($myMatches) { $this->set('myMatches', $myMatches); }
			$this->set(compact("profileInfo", 
								"member_id", 
								"photos", 
								"myAlbums",
								"visitor"));
	}
	
	function upload() {
		$this->layout = "blue_full_block";
		$this->loadModel("Member");
		$this->loadModel("Album");
		$this->loadModel("PhotoUpdate");

		$member_id = $this->Session->read('Member.id');
		//debug($this->data);
		if(!empty($this->data)) {
			$uploadedPhoto = 0;
			foreach($this->data as $key => $photo) {
				if($key == 'Album') { //save photos..
					if($this->data['action'] == 'create') { //create-ablum
						$this->data['Album']['member_id'] = $member_id;
						$this->data['Album']['name'] = $this->generateAlbumName($this->data['Album']['name'], $member_id);
						$this->Album->create();
						$this->Album->save($this->data['Album']);
						$album_id = $this->Album->id;
					} else { //save photos on existing album
						$album_id = $this->data['Album']['id'];
					}
					continue;
				} else if($key != 'Album' && $key != 'action') {
					if($this->Album->getCoverPicture($album_id) == false) { // set the cover picture for the album
						$photo['Photo']['cover_pic'] = 1;
					}
					$photo['Photo']['album_id'] = $album_id;
					$photo['Photo']['picture_path'] = $this->generateFilename($photo['Photo']['picture_path']);
					$photo['Photo']['created'] = date('Y-m-d H:i');
					$this->Photo->create();
					$this->Photo->save($photo);
					$uploadedPhoto++;
					
					//relocate the photos from the temp folder to album
					if($this->data['action'] == 'add') { 
						$albumName = $this->Album->getAlbumInfo($album_id, 'name');
						$oldDir = $this->getUploadDir($member_id, $this->tempAlbum);
						$newDir = $this->getUploadDir($member_id, $albumName);
						$oldPhotoDir = str_replace('//' ,'/', $oldDir . '/' . $photo['Photo']['picture_path']);
						$newPhotoDir = str_replace('//' ,'/', $newDir . '/' . $photo['Photo']['picture_path']);
						$oldThumbPhotoDir = str_replace('//' ,'/', $oldDir . '/thumb_' . $photo['Photo']['picture_path']);
						$newThumbPhotoDir = str_replace('//' ,'/', $newDir . '/thumb_' . $photo['Photo']['picture_path']);
						
						rename(str_replace('//', '/', $oldPhotoDir), str_replace('//', '/', $newPhotoDir));
						rename(str_replace('//', '/', $oldThumbPhotoDir), str_replace('//', '/', $newThumbPhotoDir));
					}
				}
			} //end foreach
			
			//save update
			$this->Album->saveUpdate($album_id);
			
			if($this->data['action'] == 'create') {
				$this->_renameAlbum($member_id, $this->tempAlbum, $this->data['Album']['name']);
				$this->redirect(array(
					'controller'=>'photos',
					'action'=>'view', $member_id));
			} else {
				$this->redirect(array(
					'controller'=>'photos',
					'action'=>'album', $album_id));
			}
				
		} else {
			$this->redirect(array(
					'controller'=>'photos',
					'action'=>'view', $member_id));
		}
		
		$albums = $this->Session->read('albums');
		
		$this->set(compact("albums",
							"process", 
							"member_id"));
	}
	
	//rendering of albums pictures.. thumbnails
	function album($album_id = null) {
		$this->layout = 'blue_full_block';
		$this->loadModel('Member');
		$this->loadModel('Album');
		$member_id = $this->Session->read('Member.id');
		
		if($album_id > 0 && $this->Album->isExisting($album_id)) { //valid url
			$visitor = $this->Album->isVisitor($member_id, $album_id); //check if owner or visitor of someones album
			$photos = $this->Album->getPhotos($album_id);
			$album = $this->Album->getAlbumInfo($album_id);
			$profileInfo = $this->Member->getProfileInfo($album['Album']['member_id']); //get the profile info of the profile owner
			$defaultAlbum = $this->Album->isDefaultAlbum($album_id);
			$myMatches = $this->Member->getRandomMatchesPhotos($member_id);
			
			if($myMatches) { $this->set('myMatches', $myMatches); }
			if($photos) { $this->set('photos', $photos); }
			$this->set(compact('member_id', 
								'profileInfo',
								'album', 
								'visitor',
								'defaultAlbum'));
		} else {
			$this->redirect(array(
					'controller'=>'photos',
					'action'=>'view', $member_id));
		}
	}
	
	function sort_order() {
		if($this->RequestHandler->isAjax()) {
			Configure::write('debug', 0);
			$this->layout = 'ajax';
			$this->autoRender = false;
			
			parse_str($this->params['form']['thumb'], $thumbs);
            
			foreach($thumbs['photo'] as $order => $id) {
				$this->Photo->id = $id;
				$this->Photo->saveField('order', ++$order);
			}
		}
	}
	
	function crop_picture($photo_id = null) {
		$this->layout = 'blue_full_block';
		$member_id = $this->Session->read('Member.id');
		
		if($photo_id > 0) {
			
			$photo = $this->Photo->getPhotoInfo($photo_id);
			// check if the viewer is not the owner.. maybe just typed in the url
			if(!$this->Photo->Album->isVisitor($member_id, $photo['Photo']['album_id'])) {
				//im the owner.. let me in
				$albumName = $this->Photo->Album->getAlbumInfo($photo['Photo']['album_id'], 'name');
				$this->set(compact('member_id', 'photo', 'albumName'));
				
			} else { //im just a viewer of someone's profile
				$this->redirect(array(
					'controller'=>'photos',
					'action'=>'view', $member_id));
			}
		} else {
			$this->redirect(array(
					'controller'=>'photos',
					'action'=>'view', $member_id));
		}
	}
	
	function makeProfilePicture($photo_id) {
		$this->layout = 'blue_full_block';
		
		if(!empty($this->data)) {
			$this->loadModel('MemberProfile');
			$this->loadModel('PhotoUpdate');
			$this->loadModel('Album');
			$member_id = $this->Session->read('Member.id');
			$photo = $this->Photo->getPhotoInfo($photo_id);
			$albumName = $this->Photo->Album->getAlbumInfo($photo['Photo']['album_id'], 'name');
			$imageDir = $this->getUploadDir($member_id, $albumName);
			$imageFile = $imageDir . '/' . $photo['Photo']['picture_path'];
			
			//measurements used in cropping
			$x1 = $this->data['Photo']['x1'];
			$y1 = $this->data['Photo']['y1'];
			$width = $this->data['Photo']['width'];
			$height = $this->data['Photo']['height'];
			
			//location of the images.. directory of profile pictures
			$profileDir = $this->getUploadDir($member_id, $this->profileAlbum);
			$picturePath = $this->randomString();
			
			//create cropped copy of image
			$cropCopy = new SimpleImage();
			$cropCopy->load($imageFile);
			$cropCopy->crop($x1, $y1, $width, $height);
			$ext = $cropCopy->ext(); //extension name
			$profileCrop = $profileDir . '/profile_thumb_' . $picturePath . $ext; //the cropped copy of image file
			$cropCopy->save($profileCrop);
			
			/*//create full copy of image
			$fullCopy = new SimpleImage();
			$fullCopy->load($imageFile);
			$profileFull = $profileDir . '/' . $picturePath . $ext; //the full copy of image file 
			$fullCopy->save($profileFull);*/
			
			//create thumbnail copy of image
			$thumbCopy = new SimpleImage();
			$thumbCopy->load($profileCrop);
			$thumbCopy->resize(155, 115);
			$profileThumb = $profileDir . '/thumb_' . $picturePath . $ext; //the cropped copy of image file
			$thumbCopy->save($profileThumb);
			
			//save picture_path on members profile.. table used to get the profile picture
			$member = $this->MemberProfile->find('first', array(
									'conditions'=> array(
										'member_id'=>$member_id),
									'fields'=> array(
										'MemberProfile.id'),
									'recursive'=>-1));
			$this->MemberProfile->id = $member['MemberProfile']['id'];
			$this->MemberProfile->saveField('picture_path', '' . $picturePath . $ext);
			
			//save path to profile picture folder..
			$profile = $this->Photo->Album->find('first', array(
										'conditions'=> array(
											'Album.member_id'=>$member_id,
											'Album.name'=>$this->profileAlbum),
										'fields'=> array(
											'Album.id'),
										'recursive'=>-1));
			/*$this->Photo->id = $photo_id;
			$this->Photo->saveField('profile_pic', 1);*/
			
			$photo['Photo']['id'] = null; //reset the id to create new record
			$photo['Photo']['album_id'] = $profile['Album']['id'];
			$photo['Photo']['picture_path'] = $picturePath . $ext;
			$photo['Photo']['profile_pic'] = 1;
			//assign cover picture if no photo was set yet
			if($this->Album->getCoverPicture($photo['Photo']['album_id']) == false) {
				$photo['Photo']['cover_pic'] = 1;
			}
			
			//save update..
			if($this->Photo->save($photo)) {
				$album_id = $this->Photo->getPhotoInfo($photo_id, 'album_id');
				$this->Album->saveUpdate($album_id, 1);
			}
			
			$this->redirect(array(
					'controller'=>'photos',
					'action'=>'view', $member_id));
		} else {
			$this->redirect(array(
					'controller'=>'photos',
					'action'=>'view', $member_id));
		}
	}
	
	function changeProfilePicture($photo_id) {
		if($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
			$this->loadModel('MemberProfile');
			$this->loadModel('Album');
			$this->loadModel('PhotoUpdate');
			$this->loadModel('Member');
			
			$member_id = $this->Session->read('Member.id');
			if($this->Member->setProfilePicture($member_id, $photo_id)) {
				//get the picture path of profile picture to be set..
				$picturePath = $this->Photo->getPhotoInfo($photo_id, 'picture_path');
				//search reord of the MemberProfile profile picture
				$member = $this->MemberProfile->find('first', array(
										'conditions'=> array(
											'member_id'=>$member_id),
										'fields'=> array(
											'MemberProfile.id'),
										'recursive'=>-1));
				$this->MemberProfile->id = $member['MemberProfile']['id']; //access the record
				$this->MemberProfile->saveField('picture_path', '' . $picturePath); //update record
				
				//save update
				$album_id = $this->Photo->getPhotoInfo($photo_id, 'album_id');
				$this->Album->saveUpdate($album_id, 1);
				$response['msg'] = 'success';
			} else {
				$response['msg'] = 'failed';
			}
			
			$this->set('response', json_encode($response));
			$this->render('/elements/responses', 'ajax');
		}
	}
	
	function deletePhoto($photo_id) {
		if($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
			
			$member_id = $this->Session->read('Member.id');
			$picture_path = $this->Photo->getPhotoInfo($photo_id, 'picture_path');
			$album_id = $this->Photo->getPhotoInfo($photo_id, 'album_id');
			$albumName = $this->Photo->Album->getAlbumInfo($album_id, 'name');
			$full = $this->getUploadDir($member_id, $albumName);
			$imageFile =  $full . '/' . $picture_path;
			
			if($this->delete_img($imageFile)) {
				$this->Photo->delete($photo_id);
				$response['msg'] = 'success';
			} else {
				$response['msg'] = 'failed';
			}
			
			$this->set('response', json_encode($response));
			$this->render('/elements/responses', 'ajax');
		}
	}
	
	/*
	 * 	delete thumb and full image file
	 */
	private function delete_img($imageFile) {
		$path = explode('/', $imageFile);
		$path[count($path) - 1] = 'thumb_' . $path[count($path) - 1];
		$thumb = implode('/', $path);
		
		$prof = explode('/', $imageFile);
		$prof[count($prof) - 1] = 'profile_' . $prof[count($prof) - 1];
		$profile = implode('/', $prof);

		// delete full photo
		if(file_exists($imageFile)) {
			$full_img = new File($imageFile);
			if($full_img->delete()) {
				
			}
		}
		
		// delete thumbnail copy
		if(file_exists($thumb)) {
			$thumb_img = new File($thumb);
			if($thumb_img->delete()) {
				
			}
		}
		
		// delete profile copy
		if(file_exists($profile)) {
			$profile_img = new File($profile);
			if($profile_img->delete()){
				
			}
		}
		return true;
	}
	
	function photo_approval() {
		$this->loadModel('Album');
	}
	
	function editAlbum() {
		$this->layout = 'blue-full_block';
		
		if(!empty($this->data)) {
			$this->loadModel('Album');
			$member_id = $this->Session->read('Member.id');
			$album_id = $this->data['Album']['id'];
			$prevName = $this->Album->getAlbumInfo($album_id, 'name');
			$newName = $this->data['Album']['name'];
			
			if($this->_renameAlbum($member_id, $prevName, $newName)) {
				$this->Album->id = $album_id;
				$this->data['Album']['name'] = $this->generateAlbumName($newName, $member_id);
				$this->Album->save($this->data['Album']);
				
				$this->redirect(array('controller'=>'photos',
										'action'=>'album', $album_id));
			}
		} else {
			$this->redirect(array('controller'=>'photos',
										'action'=>'album', $album_id));
		}
	}
	
	function deleteAlbum() {
		if(!empty($this->data)) {
			$album_id = $this->data['Album']['id'];
			$albumName = $this->Photo->Album->getAlbumInfo($album_id, 'name');
			$member_id = $this->Session->read('Member.id');
			
			if($this->Photo->Album->delete($album_id, false)) {
				$album = $this->getUploadDir($member_id, $albumName);
				Folder::delete(str_replace('//','/', $album));
				$this->redirect(array(
							'controller'=>'photos',
							'action'=>'view', $member_id));
			} 
		} else {
			$this->redirect(array(
							'controller'=>'photos',
							'action'=>'view', $member_id));
		}
	}
	
	//deletes the uploaded album if the user leaves or refreshes
	//the page without clicking the create album
	function deleteTempFolder() {
		if($this->RequestHandler->isAjax()) {
			$member_id = $this->Session->read('Member.id');
			$album = $this->getUploadDir($member_id, $this->tempAlbum);
				Folder::delete(str_replace('//','/', $album));
		}
	}
	
	//check if there is already existing album before creating the album..
	function checkAlbumName() {
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->autoRender = false;
			$member_id = $this->Session->read('Member.id');
			$response['albumName'] = date('F-d-Y', time());
			$this->set('response', json_encode($response));
			$this->render('/elements/responses', 'ajax');
		}
	}
	
	
	/*
	 *  sets and return the directory of uploads..
	 *  concatenate the member id and album name
	 */
	private function getUploadDir($member_id, $albumName) {
		$uploads = Configure::read('uploadsPath');
		$fullImagePath = Configure::read('fullImagePath');
		$dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $fullImagePath . '/' . $uploads . '/' . $member_id . '/' . $albumName;
		
		return str_replace('//', '/', $dir);
	}
	
	//generate photo filename if there is existing one
	private function generateFilename($filename) {
		$match = $this->Photo->find('all', array(
						'conditions'=>array(
							'Photo.picture_path'=>$filename),
						'fields'=>array(
							'Photo.picture_path'),
						'recursive'=>-1));
		if(empty($match)) {
			return $filename;
		} else {
			list($name, $ext) = explode('.', $filename);
			$rand = $this->randomString();
			$temp = $rand . '.' . $ext;
			return $this->generateFilename($temp);
		}
	}
	
	private function randomString() {
	    $length = 32;
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	    $string = '';    
	
	    for ($i = 0; $i < $length; $i++) {
	        @$string .= $characters[mt_rand(0, strlen($characters))];
	    }
   		 return $string;
	}
	
	private function generateAlbumName($albumName, $member_id) {
		$match = $this->Photo->Album->find('first', array(
							'conditions'=> array(
								'Album.name'=>$albumName,
								'Album.member_id'=>$member_id),
							'fields'=> array(
								'Album.name'),
							'recursive'=>-1));
		
		if(empty($match)) {
			return $albumName;
		} else {
			$new = $albumName . '!';
			return $this->generateAlbumName($new, $member_id);
		}
	}
	
	private function _renameAlbum($member_id, $prevName, $newName) {
		$oldAlbum = $this->getUploadDir($member_id, $prevName);
		$newAlbum = $this->getUploadDir($member_id, $newName);
		if(rename(str_replace('//','/', $oldAlbum), str_replace('//','/',$newAlbum))){
			return true;
		} 
	}

}
