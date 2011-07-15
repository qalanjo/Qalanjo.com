<?php
class BadWordsFilterComponent extends Object{
	function initialize($controller, $settings = array()){
		$this->controller = $controller;
		$this->controller->loadModel("FoulWord");
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
	
	function filterFoulWord($message){
		$this->controller->FoulWord->find("all");
	
	}
	
}