<?php
/**
 * 
 * Represents a wink ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class Wink extends AppModel {
	var $name = 'Wink';
	
	var $belongsTo = array(
		'Winker' => array(
			'className' => 'Member',
			'foreignKey' => 'winker_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Winkee' => array(
			'className' => 'Member',
			'foreignKey' => 'winkee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);
	
	/**
	 * 
	 * Wink at someone ...
	 * @param $winker
	 * @param $winkee
	 */
	function wink_at($winker, $winkee){
		$this->data["Wink"]["winker_id"] = $winker;
		$this->data["Wink"]["winkee_id"] = $winkee;
		$this->create($this->data);
		return $this->save($this->data, false);
	}
	
	/**
	 * 
	 * Get the list of wink list  ...
	 * @param $winkee
	 */
	function getWinkList($winkee){
		return $this->find("all", array("Wink.winkee_id"=>$winkee, array("order"=>"created desc")));	
	}
	
	
	/**
	 * 
	 * Get Wink List for Communication ...
	 * @param unknown_type $winkee
	 */
	function getWinkListForCommunication($winkee){
		$this->unbindModel(array("belongsTo"=>array("Winkee")));
		return $this->find("all", array("conditions"=>array("Wink.winkee_id"=>$winkee),
				 "contain"=>array(
				 	"Winker.id",
					"Winker.lastname",
					"Winker.firstname",
					"Winker.gender_id",
					"Winker.country_id",
					"Winker.state",
					"Winker.city"),
					"order"=>"Wink.created DESC"));
	}
	
	function getWink($id){
			$this->unbindModel(array("belongsTo"=>array("Winkee")));
		return $this->find("first", array("conditions"=>array("Wink.id"=>$id),
				 "contain"=>array(
				 	"Winker.id",
					"Winker.lastname",
					"Winker.firstname",
					"Winker.gender_id",
					"Winker.country_id",
					"Winker.state",
					"Winker.city"),
					"order"=>"Wink.created DESC"));	
	}
	
	
}