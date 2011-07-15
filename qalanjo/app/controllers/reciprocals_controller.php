<?php
/**
 * 
 * Controller for reciprocals ...
 * @author Allanaire
 *
 */
class ReciprocalsController extends AppController {

	var $name = 'Reciprocals';

	/**
	 * 
	 * Match preference. Based on Sean idea for filtering ...
	 * @param $page Page Number
	 */
	public function match_preference($page=1){
		if (!empty($this->data)){
			$this->loadModel("MemberReciprocalWeight");
			if ($this->MemberReciprocalWeight->saveAnswers($this->data)){
				if ($page==2){
					$this->redirect("/members/questionnaire_success");	
				}else{
					$this->redirect(array("action"=>"match_preference", $page+1));
				}	
			}
		}
		
		if ($page>2){
			$this->redirect("/members/questionnaire_success");
		}
		
		if ($page==1){
			$pageSet = "My Reciprocal +";	
			$perc = 85;
		}else if ($page==2){
			$pageSet = "My Reciprocal -";	
			$perc = 92;
		}
		$this->layout = "personal_assessment";
		$this->set("progressSet", "Reciprocal ".$page." out of 2");
		$this->set("pageSet", $pageSet);
		$this->set("perc", $perc);
		$this->set("member_id", $this->Session->read("Member.id"));
		
		$items = $this->Reciprocal->loadItems($page);
		$list = array();
		$i = 0;
		foreach($items as $item){
			if (empty($list)){
				$value = $item["ReciprocalType"]["value"]; 
				unset($item["ReciprocalType"]);
				$list[$i][$value][] = $item;
				$i++;
			}else{
				$found = false;
				foreach($list[$i-1] as $key=>$temp){
					if ($key==$item["ReciprocalType"]["value"]){
						unset($item["ReciprocalType"]["value"]);
						$list[$i-1][$key][] = $item;
						$found = true;
						break;
					}
				}
				if (!$found){
					$value = $item["ReciprocalType"]["value"];
					unset($item["ReciprocalType"]);
					$list[$i][$value][] = $item;
					$i++;
				}
			}
		}
		$this->set("items", $list);
		$this->set("page", $page);
	}
}
