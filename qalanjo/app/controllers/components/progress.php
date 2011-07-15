<?php
class ProgressComponent extends Object{
	
	/**
	 * 
	 * The points of each sequence step ...
	 */
	var $points = array();
	
	
	function initialize($controller, $settings = array()){
		$this->controller = $controller;
		$this->controller->loadModel("Attribute");
		$this->controller->loadModel("AttributeCategory");
		$this->controller->loadModel("MemberAttributeWeight");
		
		
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
	
	/**
	 * 
	 * Initialize total points ...
	 */
	function totalPoints(){
		/**
		 * plug to associative arrays the points for each step
		 */	
		$this->points["signup"] = 12;
		$this->points["profile_completion1"] = 7;
		$this->points["profile_completion2"] = 6;
		$this->points["profile_completion3"] = 4;
		$this->points["profile_completion4"] = 4;
		$this->points["profile_completion5"] = 3;
		$categories = $this->controller->AttributeCategory->find("all");		
		foreach($categories as $category){
			$attributes = $this->controller->Attribute->find("all", 
										array(
											"conditions"=>array("Attribute.attribute_category_id"=>$category["AttributeCategory"]["id"])
							));
			$this->points["category".$category["AttributeCategory"]["id"]] = count($attributes);	
		}	
		$this->points["signup_upload"] = 20;
		$this->points["signup_crop"] = 5;
	}
	
	/**
	 * 
	 * Get total progress of a step by using the name of the progress as the key ...
	 * @param $key the name of the step 
	 */
	function getProgressByKey($key_val=""){
		$sum = 0;
		foreach($this->points as $key=>$value){
			$sum+=$value;
			if ($key==$key_val){
				break;
			}
		}
		return $sum;	
	}
	
	/**
	 * 
	 * Get the total points ...
	 */
	function getTotal(){
		$sum = 0;
		foreach($this->points as $value){
			$sum+=$value;
		}
		return $sum;
	}
	
	/**
	 * 
	 * Get the total progress ...
	 * @param $key the name of the step
	 */
	function getTotalProgress($key=""){
		$this->totalPoints();
		return round($this->getProgressByKey($key)/$this->getTotal(), 2)*100;
	}
	
	function getProgressAfterQuestionnaire($member_id){
		$this->totalPoints();
		$this->controller->loadModel("MemberAttributeWeight");
		$weights = $this->controller->MemberAttributeWeight->find("all", array("conditions"=>array("Member.id"=>$member_id)));	
		$max_category = $this->controller->AttributeCategory->find("first", array("fields"=>"MAX(id) AS id"));
		$attributes = $this->controller->Attribute->find("all");		
		return round(($this->getTotalProgress("category".$max_category[0]["id"])-(count($attributes)-count($weights)))/$this->getTotal(), 2)*100;
	}
	function getProgressAfterUpload($member_id){
		$this->totalPoints();
		$this->controller->loadModel("MemberAttributeWeight");
		$weights = $this->controller->MemberAttributeWeight->find("all", array("conditions"=>array("Member.id"=>$member_id)));	
		$max_category = $this->controller->AttributeCategory->find("first", array("fields"=>"MAX(id) AS id"));
		$attributes = $this->controller->Attribute->find("all");		
		return round((($this->getTotalProgress("category".$max_category[0]["id"])-(count($attributes)-count($weights)))+20)/$this->getTotal(), 2)*100;
	}
	
	
	
	
}