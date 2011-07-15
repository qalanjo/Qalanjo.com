<?php
class ViewActivitiesController extends AppController {

	var $name = 'ViewActivities';
	
	function index($render = "ajax"){
		$this->layout = "ajax";
		$member_id = $this->Session->read("Member.id");
		$this->set("process", "view_activities");
		$this->load_index();
		$view = $this->ViewActivity->find("all");
		$this->paginate = array("conditions"=>array("ViewActivity.viewer_id <>"=>$member_id, "ViewActivity.viewed_id "=>$member_id),  "recursive"=>1, "fields"=>array("DISTINCT ViewActivity.viewer_id","ViewActivity.viewed_id","Viewer.lastname","Viewer.firstname","Viewer.gender_id","Viewee.lastname","Viewee.firstname","Viewer.gender_id"));
		$this->set("viewers", $this->paginate());
		$this->set("render", $render);
	}
	
	function loadCommunications($limit = 3){
		$this->loadModel("Country");	
		$this->loadModel("MemberProfile");
		$member_id = $this->Session->read("Member.id");
		$viewers = $this->ViewActivity->listViewers($member_id, $limit);
		$viewlist = array();
		foreach($viewers as $view){
			$profile = $this->MemberProfile->find("first", array("conditions"=>array("MemberProfile.member_id"=>$view["Viewer"]["id"]), "recursive"=>-1));
			$country = $this->Country->find("first", array("conditions"=>array("Country.id"=>$view["Viewer"]["country_id"]), "recursive"=>-1));
			$view["MemberProfile"] = $profile["MemberProfile"];
			$view["Country"] = $country["Country"];
			$viewlist[] = $view;
		}
		$this->set("viewers", $viewlist);
		$this->render("/elements/blue/members/index/wvme_content", "ajax");
	}
	
	function countViewActivities(){
		$member_id = $this->Session->read("Member.id");
		$this->set("response", count($this->ViewActivity->countViewers($member_id)));
		$this->render("/elements/responses", "ajax");
	}
}
?>