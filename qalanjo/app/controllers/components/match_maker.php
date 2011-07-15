<?php

class MatchMakerComponent extends Object{
	function initialize($controller, $settings = array()){
		$this->controller = $controller;
		$this->controller->loadModel("Member");
		$this->controller->loadModel("Attribute");
		$this->controller->loadModel("Match");
		
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
	 * Get the list of candidates ...
	 * @param array $searchee the searchee
	 */
	function getCompatibleCandidates($searchee = array(), $criteria=array(), $limit=-1){	
		$action="profile_search";
		$registered_date=null;
		foreach($criteria as $key=>$value){ //plugs variables to place
			if ($key=="action"){
				$action = $value;
			}else if ($key=="registered_date"){
				$registered_date = $value;
			}
		}
		if ($action=="searchbydateprofile"){
			
			$condition = array("DATE(Member.created) = '".$registered_date."'",
								 "gender_id"=>$searchee["Member"]["looking_for_id"], "Member.id <> ".$searchee["Member"]["id"]);
			
		}else if ($action=="all"){
			$condition = array("gender_id"=>$searchee["Member"]["looking_for_id"], "Member.id <> ".$searchee["Member"]["id"]);
		
		
		
		}
		$this->controller->Member->unbindModel(array("hasMany"=>array("GiftAvailTransaction", "Notification", "CreditCard", "PrivateMessage", "SentGift", "SubscriptionTransaction", "MemberProfileAnswer", "Album", "InMyOwnWordsAnswer", "MembersInterest", "Connection", "ReceiveMessage", "ShoppedItem")));
		if ($limit==-1){ 
			$members = $this->controller->Member->find("all", 
						array("conditions"=>$condition));
		}else{
			$members = $this->controller->Member->find("all", array("conditions"=>$condition, "limit"=>$limit));						
		}
		
		$matches = array();
		foreach ($members as $member){

			$passed = true;
			if (isset($searchee["MemberSetting"])){
				if ($this->validAge($searchee,$member)&&$this->validDistance($searchee,$member)){
					$passed = true;
				}
			}else{
				$passed =  true;
			}
			if ($passed){
			
			
				$data["Match"]["matched_id"] = $member["Member"]["id"];
				$data["Match"]["member_id"] = $searchee["Member"]["id"];
				$data["Match"]["compatibility"] = $this->getCompatibilityByWeight ($searchee, $member);
				if ($data["Match"]["compatibility"]!=0){
					$matches[] = $this->controller->Match->save_match($data);
				}
			}
		}
		return $matches;	
		
	}
	/**
	 * Valid Distance ...
	 * @param searchee
	 * @param member
	 */
	private function validDistance($searchee, $member) {
		$passed = true;
		if (isset($searchee["MemberSetting"]["Distance"])){
			$distance = $this->getDistanceFromOther($searchee, $member);
			if ($searchee["MemberSetting"]["Distance"]["distance"]>=$distance){
				$passed=false;
			}
		}
		return $passed;
	}

	/**
	 * Valid Age ...
	 * @param searchee The searcher
	 * @param member The compared member
	 */
	private function validAge($searchee, $member) {
		$passed = true;
		$age = $this->controller->Member->MemberProfile->getAgeV2($member["Member"]["id"]);
		if (!(($searchee["MemberSetting"]["age_from"]>=$age)&&($searchee["MemberSetting"]["age_to"]<=$age))){
			$passed = false;				
		}
		return $passed;
	}


	function getDistanceFromOther($searchee = array(), $candidate = array()){
		$addressSearchee = $this->getFullAddress($searchee);
		$addressCandidate = $this->getFullAddress($candidate);
		$result1 = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address={$addressSearchee}&sensor=false"));
		$result2 = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address={$addressCandidate}&sensor=false"));
		if (($result1->status=="OK")&&($result2->status=="OK")){
			$distance = $this->controller->DistanceCalculate->getDistance($result1->results[0]->geometry->location->lat, $result2->results[0]->geometry->location->lat, $result1->results[0]->geometry->location->lng, $result2->results[0]->geometry->location->lng);
			return $distance;
		}else{
			return -1;
		}
	}
	
	
	function getFullAddress($person){
		if ($person["Country"]["name"]=="United States of America"){
			$address = $person["Member"]["city"].", ".$person["Member"]["state"].", ".$person["Country"]["name"];
		}else{
			$address = $person["Member"]["city"].", ".$person["Country"]["name"];
		}
		$address = str_replace(" ", "+", $address);
		return $address;
	}
	
	
	
	/**
	 * 
	 * Get the compatibility percentage of the searchee and the candidate based on profile...
	 * @param Member $searchee
	 * @param Member $candidate
	 */
	function getCompatibility($searchee = array(), $candidate = array(), $type="Profile"){
		if ($type=="Profile"){
			return count($this->intersection($searchee, $candidate))/count($this->union($searchee, $candidate));
		}
	}
	
	
	/**
	 * Get the distance between the similarities of two objects profile
	 */

	function getDistance($searchee = array(), $candidate = array()){
		return 1 - $this->getCompatibility($searchee, $candidate);
	}
	
	/**
	 * 
	 * Get the union ...
	 * @param array $searchee
	 * @param array $candidate
	 */
	function union($searcher = array(), $candidate = array()){
		$set = array();
		
		foreach($searcher["MemberProfile"] as $temp){ //include all attribute from the first set
			$set[] = $temp;
		}
		
		foreach($candidate["MemberProfile"] as $key_candidate => $temp){
			foreach($set as $key=>$value){
				if ($key_candidate==$key){		
					continue;
				}else{
					$set[] = array($key=>$value);
				}
			}
			
		}
		return set;
	}


	/**
	 * 
	 * Get the intersection of two members. Used in  Jaccard index algo
	 * @param array $searchee
	 * @param array $candidate
	 */
	function intersection($searcher = array(), $candidate = array()){
		$set = array();
		foreach($searcher["MemberProfile"] as $key_searchee=>$temp1){
			if ($key_searchee=="member_id"){
				continue;
			}
			foreach($candidate["MemberProfile"] as $key_candidate=>$temp2){
				if ($key_candidate==$key_searchee){
					if ($temp1[$key_searchee]==$temp2[$key_candidate]){
						$set[] = array($key_searchee=>$temp1);					
						break;			
					}
				}			
			}		
		}
		return $set;
	}	
	
	
	/**
	 * 
	 * Get the compatibility by weight. Based on euclidean distance ...
	 * @param array $searchee 
	 * @param array $candidate
	 * @param int $type
	 */
	function getCompatibilityByWeight($searchee=array(), $candidate=array(), $type=1){
		$commonItems = 0;
		$sim = 0;
		foreach($searchee["MemberAttributeWeight"] as $weight_searchee){
			foreach($candidate["MemberAttributeWeight"] as $weight_candidate){
				if ($weight_searchee["attribute_id"]==$weight_candidate["attribute_id"]){
					$attribute = $this->controller->Attribute->find("first", array("conditions"=>array("Attribute.id"=>$weight_candidate["attribute_id"])));
					//if ($attribute["attribute_type_id"]==$type){
						$commonItems++;
						$weight1 = $weight_searchee["weight"];
						$weight2 = $weight_candidate["weight"];
						$sim+=pow(($weight1-$weight2), 2);
					//}			
				}		
			}
		}

		if ($commonItems>0){
			$sim = sqrt($sim/$commonItems);
			$sim = 1 - tanh($sim);
			$maxItems = min(count($searchee["MemberAttributeWeight"]), count($candidate["MemberAttributeWeight"]));
			$sim = $sim * ($commonItems/$maxItems);
		}
		return $sim;
	}
	
	
	/**
	 * 
	 * Get the compatibility by weight. Based on Pearson Correlation Score. Use for large scale differences
	 * @param array $searchee 
	 * @param array $candidate
	 * @param int $type
	 */
	function getCompatibilityByWeight2($searchee=array(), $candidate=array()){
		$similarItems = $this->getSimilarItems ( $searchee, $candidate );
		$n = count($similarItems);
		if ($n==0){
			return 0;
		}
		$sum1 = $this->sumUpWeights($searchee, $similarItems);
		$sum2 = $this->sumUpWeights($candidate, $similarItems);
		$sumPow1 = $this->sumUpWeights($searchee, $similarItems, "sumpower");
		$sumPow2 = $this->sumUpWeights($candidate, $similarItems, "sumpower");
		$sameItems1 = $this->getSimilarItemsPerPerson($searchee, $similarItems);
		$sameItems2 = $this->getSimilarItemsPerPerson($candidate, $similarItems);
		$sumMul = 0;
		for($i=0;$i<$n;$i++){
			$sumMul += ($sameItems1[$i]["weight"]*$sameItems2[$i]["weight"]);
		}
		//$numerator = $sumMul*$n - (($sum1*$sum2)/$n);
		$numerator = ($sumMul*$n - ($sum1*$sum2))/$n;
		$denominator = sqrt(
			($sumPow1 - (pow($sum1, 2)/$n))*($sumPow2 - (pow($sum2, 2)/$n))
		
		);
		if ($numerator==$denominator){
			return 1;
		}
		if ($denominator==0){
			return 0;
		}
		return $numerator/$denominator;
	}
	
	/**
	 * 
	 * Get similar item per person ...
	 * @param $person
	 * @param $similarItems
	 */
	private function getSimilarItemsPerPerson($person=array(), $similarItems=array()){
		$items = array();
		foreach($person["MemberAttributeWeight"] as $item){
			foreach($similarItems as $similarItem){
				if ($item["attribute_id"] == $similarItem["attribute_id"]){
					$items[] = $item;
					break;
				}
			}
		}
		return $items;
	}
	
	
	/**
	 * Get the similar items ...
	 * @param searchee
	 * @param candidate
	 */
	private function getSimilarItems($searchee, $candidate) {
		$similarItems = array();
		
		/**
		 * Collect same items
		 */
		foreach($searchee["MemberAttributeWeight"] as $weight_searchee){
			foreach($candidate["MemberAttributeWeight"] as $weight_candidate){
				if ($weight_searchee["attribute_id"]==$weight_candidate["attribute_id"]){
					$similarItems[] = $weight_candidate;
				}		
			}
		}
		return $similarItems;
	}
	private function sumUpWeights($person = array(), $similarItems = array(), $action = "sum"){
		$sum = 0;
		foreach($person["MemberAttributeWeight"] as $weight){
			foreach($similarItems as $item){
				if ($item["attribute_id"]==$weight["attribute_id"]){
					if ($action=="sum"){
						$sum += $weight["weight"];
					}else if ($action=="sumpower"){
						$sum += pow($weight["weight"], 2);
					}
				}
			}
		}		
		return $sum;
	}
	
}

