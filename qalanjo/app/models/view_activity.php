<?php
/**
 * 
 * Represents an object for viewing activity ...
 * @author Allanaire
 * @version 0.0.1
 *
 */
class ViewActivity extends Model{
	var $belongsTo = array(
		'Viewer' => array(
			'className' => 'Member',
			'foreignKey' => 'viewer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Viewee' => array(
			'className' => 'Member',
			'foreignKey' => 'viewed_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);
	
	/**
	 * 
	 * Registers a activity ...
	 * @param $viewer_id The viewer
	 * @param $viewed_id The viewee
	 */
	function register($viewer_id, $viewed_id){
		$data["ViewActivity"]["viewer_id"] = $viewer_id;
		$data["ViewActivity"]["viewed_id"] = $viewed_id;
		$this->set($data);
		$viewActivity = $this->find("first", array("conditions"=>array("ViewActivity.viewer_id"=>$viewer_id, "ViewActivity.viewed_id"=>$viewed_id, "DATE(ViewActivity.created) = CURDATE()"), "recursive"=>-1));
		if (!$viewActivity){
			$this->create($this->data);
			return $this->save($this->data, false);	
		}
		
	}

	/**
	 * 
	 * List viewers of a member ...
	 * @param $member_id the member
	 */
	function listViewers($member_id, $limit=3){
		$this->unbindModel(array("hasMany"=>array("Viewer")));
		$temp = $this->find("all", array(
				"conditions"=>
					array("ViewActivity.viewed_id"=>$member_id),
				"recursive"=>1,
				"limit"=>$limit,
				"order"=>"ViewActivity.created DESC",
				"fields"=>array("DISTINCT ViewActivity.viewer_id")));
		$items = array();
		foreach($temp as $viewer){
			$items[] = $this->find("first",
						array("conditions"=>array("ViewActivity.viewer_id"=>$viewer["ViewActivity"]["viewer_id"]),
						"fields"=>array("Viewer.id", "ViewActivity.id", "Viewer.lastname", "Viewer.firstname", "Viewer.gender_id", "Viewer.country_id", "ViewActivity.created", "Viewer.state", "Viewer.city"),
						"order"=>"ViewActivity.created desc"			
									
						
						));
		}
		return $items;
		
	}
	
	function firstViewed($viewer_id, $viewed_id){
		$this->unbindModel(array("hasMany"=>array("Viewer")));
		$temp = $this->find("first", array(
				"conditions"=>
					array("ViewActivity.viewer_id"=>$viewer_id,
					"ViewActivity.viewed_id"=>$viewed_id
					),
				"recursive"=>-1,
				"order"=>"ViewActivity.created ASC"));
		return $temp;
	}
	
	function countViewers($member_id, $limit=100){
		$this->unbindModel(array("hasMany"=>array("Viewer")));
		return $this->find("all", array(
			"conditions"=>array("ViewActivity.viewed_id"=>$member_id),
			"recursive"=>-1,
			"fields"=>array("DISTINCT ViewActivity.viewer_id"),
			"order"=>"ViewActivity.created DESC",
			"limit"=>$limit
		));
	}
	
	function getViewActivity($id){
		$this->unbindModel(array("hasMany"=>array("Viewer")));
		return $this->find("first", array("conditions"=>array("ViewActivity.id"=>$id),
										));
	}
}