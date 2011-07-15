<?php
class WeightableComponent extends Object{
	function initialize($controller, $settings = array()){
		$this->controller = $controller;
		$this->controller->loadModel("Member");
		$this->controller->loadModel("AttributeInterpretation");
		
	}
	//called after Controller::beforeFilter()
	function startup(&$controller) {
	}

	//called after Controller::beforeRender()
	function beforeRender(&$controller) {
	}

	//called after Controller::render()
	function shutdown(&$controller) {
	}

	//called before Controller::redirect()
	function beforeRedirect(&$controller, $url, $status=null, $exit=true) {
	}

	function redirectSomewhere($value) {
		// utilizing a controller method
		$this->controller->redirect($value);
	}
	
	function getTopicOpeners($member_id, $limit=-1){
		if ($limit==-1){
			$weights = $this->controller->Member->MemberAttributeWeight->find("all", array("conditions"=>array("MemberAttributeWeight.member_id"=>$member_id), "order"=>"RAND()", "recursive"=>-1));
		}else{
			$weights = $this->controller->Member->MemberAttributeWeight->find("all", array("conditions"=>array("MemberAttributeWeight.member_id"=>$member_id), "order"=>"RAND()", "limit"=>$limit, "recursive"=>-1));	
		}
		$member = $this->controller->Member->find("first", array("conditions"=>array("Member.id"=>$member_id), "recursive"=>-1));
		$results = array();
		foreach($weights as $weight){
			$attribute_id = $weight["MemberAttributeWeight"]["attribute_id"];
			$interpretations = $this->controller->AttributeInterpretation->find("all",array("conditions"=>array("AttributeInterpretation.attribute_id"=>$attribute_id)));
			foreach($interpretations as $interpretation){
				if ($weight["MemberAttributeWeight"]["weight"] == $interpretation["AttributeInterpretation"]["response"]){
					$temp = str_replace("The person", $member["Member"]["firstname"], $interpretation["AttributeInterpretation"]["interpretation"]);
					if ($member["Member"]["gender_id"]=="1"){
						$temp = str_replace("_his/her_", "his", $temp);
						$temp = str_replace("_he/she_", "he", $temp);
						$temp = str_replace("_himself/herself_", "himself", $temp);						
					}else{
						$temp = str_replace("_his/her_", "her", $temp);
						$temp = str_replace("_he/she_", "she", $temp);
						$temp = str_replace("_himself/herself_", "herself", $temp);
					}
					$weight["MemberAttributeWeight"]["interpretation"] = $temp;
					$results[] = $weight;
				}
			}
		}
		return $results;
	}
		
}