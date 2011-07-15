<?php
class DistanceComponent extends Object{
	function initialize($controller, $settings = array()){
		$this->controller = $controller;
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
	
	function getDistance($q){
		$url = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=Vancouver+BC|Seattle&destinations=San+Francisco|Victoria+BC&mode=bicycling&language=fr-FR&sensor=false");
			
	}
	
	
}