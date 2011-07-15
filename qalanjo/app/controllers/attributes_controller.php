<?php
class AttributesController extends AppController {

	var $name = 'Attributes';

	function __construct(){
		parent::__construct();
		$this->components[] = "Progress";
		$this->helpers[] = "ProfileCompletor";
	}
	
	/**
	 * 
	 * questionnaire action. Used in paging action
	 * @param $type
	 */
	function questionnaire($page = 1){
		$this->layout = "personal_assessment";
		$this->loadModel("Member");
		if (!$this->Session->check("Member.id")){
			$this->redirect("/");
		}
		$member_id = $this->Session->read("Member.id");
		//$member_id = 1;
		if (!empty($this->data)){
			$this->loadModel("MemberAttributeWeight");

			$valid = true;
			if (count($this->data["MemberAttributeWeight"])==0){
				$valid = false;
			}
			
			foreach($this->data["MemberAttributeWeight"] as $item){
				
				if (!isset($item["weight"])||($item["weight"]=="")){
					$valid = false;
					break;
				}
				
			}
			if ($valid){
				foreach($this->data["MemberAttributeWeight"] as $item){
					$this->loadModel("MemberAttributeWeight");
					$weight = $item["weight"];
					$member = $item["member_id"];
					$attribute = $item["attribute_id"];
					$this->MemberAttributeWeight->saveWeight($weight, $attribute, $member);				
				}
				$this->Member->save_progress($member_id, "questionnaire/".$page);
			}else{
				$this->Session->setFlash("One of the question is not answered.", "default", array("class"=>"error"));
				if ($page==1){
					$page=1;
				}else{
					$page-=1;
				}
				$this->redirect("/attributes/questionnaire/".$page);
				
			}
		}
		
		if ($page==7){
			$this->Member->save_progress($member_id, "complete");
			$this->redirect("/");
		}
		$this->set("member_id", $member_id);
		$this->set("page", $page);
		$this->set("progressSet", "Personality Assessment ".$page." out of 7");
		if ($page==1){
			$pageSet = "Sociability";	
			$items = $this->getItemsForPage(array(1, 2, 3, 4));
			$perc = 31;
		}else if ($page==2){
			$pageSet = "Emotional Stability";	
			$items = $this->getItemsForPage(array(5, 6));
			$perc = 38;
		}else if ($page==3){
			$pageSet = "Emotional Stability";	
			$items = $this->getItemsForPage(array(7, 8, 9, 10, 11));
			$perc = 46;
		}else if ($page==4){
			$pageSet = "Conscientiousness";	
			$items = $this->getItemsForPage(array(12, 13, 14));
			$perc = 54;
		}else if ($page==5){
			$pageSet = "Conscientiousness con't";	
			$items = $this->getItemsForPage(array(15,16,17));
			$perc = 62;
		}else if ($page==6){
			$pageSet = "Introversion";
			$items = $this->getItemsForPage(array(18, 19, 20, 21));
			$perc = 69;
		}else if ($page==7){
			$pageSet = "Openness";
			$items = $this->getItemsForPage(array(22, 23, 24));
			$perc = 77;
		}
		$this->set("items", $items);
		$this->set("pageSet", $pageSet);
		$this->set("perc", $perc);
		$this->set("page", $page);
		$this->set("set", "Personality Assessment");
		$this->set("action", $this->action);
		$this->render("/elements/blue/questionnaire/itemset", "personal_assessment");
		
	}
	/**
	 * 
	 * Get items for a certain page ...
	 * @param array $list The list of item set to be loaded
	 */
	private function getItemsForPage($list){
		$items = array();
		foreach($list as $item){
			$items[] =  $this->Attribute->find("all", array("conditions"=>array("Attribute.attribute_category_id"=>$item)));		
		}
		return $items;
	}
}
?>