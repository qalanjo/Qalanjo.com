<?php
class SentIceBreakersController extends AppController {

	var $name = 'SentIceBreakers';

	function send(){
		$this->layout = "ajax";
		if ($this->RequestHandler->isAjax()){
			if (!empty($this->data)){
				$view_id = $this->data["SentIceBreaker"]["to_id"];
				$this->SentIceBreaker->create($this->data);
				if ($this->SentIceBreaker->save($this->data, false)){
					$this->render("/elements/icebreaker-success", "ajax");
					$lastInsert = $this->SentIceBreaker->getLastInsertId();
					$this->loadModel("Update");
					$this->Update->createUpdate($view_id, $lastInsert, 4);
				}else{
					$this->render("/elements/icebreaker-failed", "ajax");
				}
			}
			if (isset($this->passedArgs["viewed_id"])){
				$this->loadModel("Member");
				$member_id = $this->Session->read("Member.id");
				$view_id = $this->passedArgs["viewed_id"];	
				$view_member = $this->Member->find("first", array("conditions"=>array("Member.id"=>$view_id)));
				$age = $this->Member->MemberProfile->getAgeV2($member_id);
				$this->loadModel("IceBreaker");
				$breakers = $this->IceBreaker->find("list", array("fields"=>array("id", "value"), "recursive"=>-1));
				$this->set(compact("breakers", "view_id", "member_id", "view_member", "age"));
			}else{
				$this->render("/elements/blank", "ajax");
			}
		}
	}
	
	function test_fail(){
		$this->render("/elements/icebreaker-success", "ajax");
	}
}
?>