<?php
class Match extends AppModel {
	var $name = 'Match';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MatchStatus' => array(
			'className' => 'MatchStatus',
			'foreignKey' => 'match_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),"Matched" => array(
			'className' => 'Member',
			'foreignKey' => 'matched_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);
	
	function save_match($data){
		$this->set($data);
		$member =  $this->find("first", array("conditions"=>
			array("member_id"=>$this->data["Match"]["member_id"], "matched_id"=>$this->data["Match"]["matched_id"])));
		$member_id = $this->data["Match"]["member_id"];
		$match_id = $this->data["Match"]["matched_id"];
		if (!$member){
			
			$this->create($this->data);
			$this->save($this->data, false);
			$this->query("INSERT INTO userlist(userid, relationid, friend) VALUES(".$member_id.", ".$match_id.", 'yes')");
			$this->query("INSERT INTO userlist(userid, relationid, friend) VALUES(".$match_id.", ".$member_id.", 'yes')");
			
		}else{
			$member["Match"]["compatibility"] = $data["Match"]["compatibility"];
			$this->save($member);
			$res =	$this->query("SELECT * FROM userlist WHERE userid = $member_id AND relationid = $match_id");
			if (empty($res)){
				$this->query("INSERT INTO userlist(userid, relationid, friend) VALUES(".$member_id.", ".$match_id.", 'yes')");
				$this->query("INSERT INTO userlist(userid, relationid, friend) VALUES(".$match_id.", ".$member_id.", 'yes')");
			}	
		}
		
		$matched = $this->find("first", array("conditions"=>
			array("Match.member_id"=>$data["Match"]["member_id"], "Match.matched_id"=>$data["Match"]["matched_id"])));	
		return $matched;
	}
	
	function countMatch($member_id, $type=1){
		return $this->find("count", array("conditions"=>array(
			"Match.member_id" =>$member_id, "Match.match_status_id"=>$type
			)
			
		));
	}
	
	function getDailyMatches($member_id, $start=0, $limit=20, $type=1){
		$this->unbindModel(array("belongsTo"=>array("Member")));
		$matches = $this->find("all", array("conditions"=>array("Match.member_id"=>$member_id, "Match.match_status_id"=>$type, "Match.archived"=>0),
			 "order"=>"Match.created DESC",
			 "limit"=>"$start, $limit",
			 "recursive"=>1,
			 "contain"=>
					array("Matched.firstname",
						  "Matched.lastname",
						  "Matched.country_id",
						  "Matched.city",
						  "Matched.gender_id",
						  "Matched.state",
						  "MatchStatus.value",
						  "Matched.id")));	
		return $matches;
	}
	
	function getMatches($member_id, $start=0, $limit=1000){
		$this->unbindModel(array("belongsTo"=>array("Member")));
		$matches = $this->find("all", array("conditions"=>array("Match.member_id"=>$member_id, "Match.match_status_id IN (1, 2)", "Match.archived"=>0),
			 "order"=>"Matched.firstname",
			 "limit"=>"$start, $limit",
			 "recursive"=>1,
			 "contain"=>
					array("Matched.firstname",
						  "Matched.lastname",
						  "Matched.country_id",
						  "Matched.city",
						  "Matched.gender_id",
						  "Matched.state",
						  "MatchStatus.value",
						  "Matched.id")));	
		return $matches;
	}
	
	
	
	function getArchivedMatches($member_id, $start=0, $limit=20){
		$this->unbindModel(array("belongsTo"=>array("Member")));
		$matches = $this->find("all", array("conditions"=>array("Match.member_id"=>$member_id,  "Match.archived"=>1),
			 "order"=>"Match.created DESC",
			 "limit"=>"$start, $limit",
			 "recursive"=>1,
			 "contain"=>
					array("Matched.firstname",
						  "Matched.lastname",
						  "Matched.country_id",
						  "Matched.city",
						  "Matched.gender_id",
						  "Matched.state",
						  "MatchStatus.value",
						  "Matched.id")));	
		return $matches;
	}
	
	
	
	function searchMatches($member_id, $query, $type=1){
		$this->unbindModel(array("belongsTo"=>array("Member")));
		$matches = $this->find("all", array("conditions"=>array("Match.member_id"=>$member_id, "Match.match_status_id"=>$type,"MATCH(Matched.lastname,Matched.firstname)  
		          AGAINST('$query*' IN BOOLEAN MODE)"),
			 "order"=>"Match.created DESC",
			 "recursive"=>1,
			 "contain"=>
					array("Matched.firstname",
						  "Matched.lastname",
						  "Matched.country_id",
						  "Matched.city",
						  "Matched.gender_id",
						  "Matched.state",
						  "MatchStatus.value",
						  "Matched.id")));	
		return $matches;
		
	}
	
	/**
	 * 
	 * Archive matches ...
	 * @param $match_id
	 * @param unknown_type $member_id
	 */
	function archive($match_id, $member_id){
		$match = $this->find("first", array("conditions"=>array("Match.member_id"=>$member_id, "Match.matched_id"=>$match_id, "Match.archived"=>0)));
		if (!empty($match)){
			$this->id = $match["Match"]["id"];
			return $this->saveField("archived", true);
		}
		return false;
	}
	
	
	function getMatch($match_id, $member_id){
		$this->unbindModel(array("belongsTo"=>array("Member", "Matched", "MatchStatus")));
		$match = $this->find("first", array("conditions"=>array("Match.member_id"=>$member_id, "Match.matched_id"=>$match_id)));
		if (!empty($match)){
			return $match;
		}
		return false;
	}
	
	function deleteMatches($member_id){
		$matches = $this->find("all", array("conditions"=>array("Match.member_id"=>$member_id)));
		foreach($matches as $match){
			$this->query("DELETE FROM userlist WHERE userid = $member_id AND relationid = {$match["Match"]["matched_id"]}");
			$this->query("DELETE FROM userlist WHERE userid = {$match["Match"]["matched_id"]} AND relationid = {$member_id}");
		}
		$this->deleteAll(array("Match.member_id"=>$member_id));
	}
	
	function updateMatchStatus($member_id, $match_id, $status){
		$match = $this->find("first", array("conditions"=>array("Match.member_id"=>$member_id, "Match.matched_id"=>$match_id, "Match.archived"=>0)));
		$this->id = $match["Match"]["id"];
		$this->saveField("match_status_id", $status);
		$match = $this->find("first", array("conditions"=>array("Match.member_id"=>$match_id, "Match.matched_id"=>$member_id, "Match.archived"=>0)));
		$this->id = $match["Match"]["id"];
		$this->saveField("match_status_id", $status);
	}
	
	function getRandomMatch($member_id, $type = 'all', $field = null, $limit = null) {
		$query = array('conditions'=> array(
							'Match.member_id'=>$member_id),
						'recursive'=> -1,
						'limit'=> $limit);
						
		if(!empty($field)) $query = array('fields'=>array('Match.' . $field));
		if($type == 'all') $query = array('order'=>'RAND()');
		
		$match = $this->find($type, $query);
		
		return (!empty($match) ? $match : false);
	}
}
