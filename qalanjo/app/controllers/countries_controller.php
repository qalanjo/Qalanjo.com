<?php
class CountriesController extends AppController {

	var $name = 'Countries';

	function getcode($id){
		$this->layout = "ajax";
		$country = $this->Country->find("first", array("conditions"=>array("Country.id"=>$id),
													"recursive"=>-1));	
		$this->set("country", $country);
	}
}
?>