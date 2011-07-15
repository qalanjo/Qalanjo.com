<?php
class UpdatesController extends AppController {

	var $name = 'Updates';

	function loadList(){
		$member_id = $this->Session->read("Member.id");
		$this->loadModel("Wink");
		$this->loadModel("ViewActivity");
		$this->loadModel("SentIceBreaker");
		$this->loadModel("SentGift");
		$this->loadModel("PrivateMessage");
		$this->loadModel("Member");
		$this->loadModel("Country");
		
		$updates = $this->Update->getUpdates($member_id);
		$temp = array();
		foreach($updates as $update){
			$model = $update["UpdateType"]["value"];
			if ($model=="PrivateMessage"){
				continue;
			}
			$action = "get".$model;
			$item = $this->$model->$action($update["Update"]["specific_id"]);
			if ($model=="Wink"){
				$from = $item["Wink"]["winker_id"];
			}else if ($model=="ViewActivity"){
				$from = $item["ViewActivity"]["viewed_id"];
			}else if ($model=="SentGift"){
				$from = $item["SentGift"]["from_id"];
			}else if ($model=="SentIceBreaker"){
				$from = $item["SentIceBreaker"]["to_id"];
			}
			$member = $this->Member->find("first", array("conditions"=>array("Member.id"=>$from), "recursive"=>-1, "fields"=>array("Member.country_id")));
			$profile = $this->Member->MemberProfile->find("first", array("conditions"=>array("MemberProfile.member_id"=>$from), "recursive"=>-1, "fields"=>array("MemberProfile.picture_path")));
			$country = $this->Country->find("first", array("conditions"=>array("Country.id"=>$member["Member"]["country_id"])));
			$update["Specific"] = $item;
			$update["Specific"]["MemberProfile"] = $profile["MemberProfile"];
			$update["Specific"]["Country"] = $country["Country"];	
			$temp[] = $update;
		}
		$this->set("updates", $temp);
		$this->render("/elements/blue/members/index/list-content", "ajax");
		
	}
}
