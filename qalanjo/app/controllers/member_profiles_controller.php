<?php
App::import("Vendor", "simpleimage");
App::import("Vendor", "imagefilter");
class MemberProfilesController extends AppController{
	var $name="MemberProfiles";
	
	function __construct(){
		parent::__construct();
		$this->components[] = "Progress";
	}

	function signup_upload(){
		Configure::write ( 'debug', 0 );
		$this->layout = "personal_assessment";
		$this->set("action", $this->action);
		$member_id = $this->Session->read("Member.id");
		$this->MemberProfile->Member->removeHasMany();
		$member = $this->MemberProfile->Member->find("first", array("conditions"=>array("Member.id"=>$member_id),
									 "fields"=>array("Member.lastname", "Member.firstname", "Gender.value")));
		$this->set("member_id", $member_id);
		$this->set("member", $member);
		//$this->set("member_id", 1);
		$this->set("step", "Upload Your Profile Picture");
		$this->set("page", "2. Upload");
		$this->set("set", "Upload your profile picture");
		$this->set("progress", $this->Progress->getProgressAfterQuestionnaire($member_id));
	}
	
	
	function process_signup_upload($filename){
		$member_id = $this->Session->read("Member.id");
		$path = Configure::read("upload_path");
		$url = WWW_ROOT."img/uploads/$member_id/default/".$filename;
		//$url = $_SERVER['DOCUMENT_ROOT']."/app/webroot/img/uploads/$member_id/default/".$filename;
		if (file_exists($url)){
			$file = file_get_contents ( $url );
			if (! $file) {
				$this->redirect("/members/step/3");
			} else {
				$image = new SimpleImage();
				$image->load(WWW_ROOT."img/uploads/$member_id/default/".$filename);
				$image->resizeToWidth(126);
				$image->save(WWW_ROOT."img/uploads/$member_id/default/profile_thumb_".$filename, IMAGETYPE_JPEG, 75, 0755);			
				$member = $this->Member->read(null, $member_id);
				$member["MemberProfile"]["picture_path"]  = $filename;
				if ($this->MemberProfile->save($member, false)){
					$this->Member->save_progress($member_id, "complete");
				}
				$this->redirect("/");
			}	
		}else{
			$this->Session->setFlash("The upload failed. Please try again.");
			$this->redirect("/signup_upload");
		}	
	}
	
	
	function signup_upload_crop($filename = ""){
		Configure::write ( 'debug', 0 );
		$this->layout = "personal_assessment";
		$member_id = $this->Session->read("Member.id");
		$path = Configure::read("upload_path");
		$filename_full = "uploads/$member_id/default/full_".$filename;
		//$url_server = $_SERVER['DOCUMENT_ROOT']."/app/webroot/img/";
		$url_server = WWW_ROOT."img/";
		$this->loadModel("Member");
		if (!empty($this->data)){
			$targ_w = $targ_h = 150;
			$jpeg_quality = 90;
			$img_r = imagecreatefromjpeg($url_server.$filename_full);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			$width = $this->data["MemberProfile"]["width"];
			$height = $this->data["MemberProfile"]["height"];
			$x = $this->data["MemberProfile"]["x"];
			$y = $this->data["MemberProfile"]["y"];
			imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
			$targ_w,$targ_h,$width,$height);
			imagejpeg($dst_r, $url_server."uploads/$member_id/default/profile_".$filename);	
			$image = new SimpleImage();
			$image->load($url_server."uploads/$member_id/default/profile_".$filename);
			$image->resizeToWidth(126);
			$image->save($url_server."uploads/$member_id/default/profile_thumb_".$filename, IMAGETYPE_JPEG, 75, 0755);		
			$member = $this->Member->read(null, $member_id);
			$member["MemberProfile"]["picture_path"]  = $filename;
			if ($this->MemberProfile->save($member, false)){
				$this->Member->save_progress($member_id, "complete");
				$this->redirect(array("controller"=>"members", "action"=>"signup_congrats"));
			}
		}
		$this->set("filename", $filename);
		$this->set("filename_full", $filename_full);	
		$this->set("step", "Crop profile picture");
		$this->set("set", "");
		$this->set("progress", $this->Progress->getProgressAfterUpload($member_id));
	}
	
	
	function find($member_id){
		return $this->MemberProfile->find("first", array("conditions"=>array("MemberProfile.member_id"=>$member_id)));	
	}
	
	
	function getAge($member_id){
		return $this->MemberProfile->getAge($member_id);
	}
	
	function getAgeV2($member_id){
		return $this->MemberProfile->getAgeV2($member_id);
	}

	function getProfileOnly($id){
		return $this->MemberProfile->find("first", array("conditions"=>array("MemberProfile.member_id"=>$id), "recursive"=>-1));
	}
	
	function shout(){
		if (!empty($this->data)){
			if ($this->MemberProfile->save($this->data)){
				$this->set("response", "true");
			}else{
				$this->set("response", "false");
			}
		}
	}
}