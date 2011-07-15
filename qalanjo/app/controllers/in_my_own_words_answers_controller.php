<?php
App::import("Sanitize");
class InMyOwnWordsAnswersController extends AppController {

	var $name = 'InMyOwnWordsAnswers';

	function update(){
		if (!empty($this->data)) {
			$this->data["InMyOwnWordsAnswer"]["answer"] = Sanitize::stripTags($this->data["InMyOwnWordsAnswer"]["answer"]);
			if ($this->InMyOwnWordsAnswer->save($this->data)) {
				$this->Session->setFlash(__('Answer has been saved', true), "default", array("class"=>"success"));
			} else {
				$this->Session->setFlash(__('Error occured while saving.', true), "default", array("class"=>"error"));
			}
			$this->render("result", "ajax");
		}
	}
	
	function cycle(){
		
	}
	
	
}
?>