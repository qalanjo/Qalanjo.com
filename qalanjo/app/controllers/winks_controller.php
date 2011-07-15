<?php
class WinksController extends AppController {

	var $name = 'Winks';

	function index() {
		$this->Wink->recursive = 0;
		$this->set('winks', $this->paginate());
	}

	function quick(){
		
	}
}
?>