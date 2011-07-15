<?php
class GiftsController extends AppController {

	var $name = 'Gifts';
	
	var $helpers = array('Javascript','Js','Ajax');
	
	var $components = array('RequestHandler');
	
	/**
	 * 
	 * Index action ...
	 * @param $query
	 */
	function index($query=""){
		$this->layout = 'gift-page';
		
		// finding the type is all that's needed because the GiftType model itself limits the number of
		// Gifts it retreives, see the GiftType model
		$types = $this->Gift->GiftType->find('all');
		
		$this->ending_of_file($types);
		
	}
	
	/**
	 * 
	 * used for updating scrollable div
	 * @param $type_id
	 * @param $eof
	 * @param $last_gift_id
	 */
	function update_by_type($type_id,$eof,$last_gift_id){
		
		$type = $this->Gift->get_remaining_items($type_id,$last_gift_id);
		
		if($eof == 0){
			$type['EOF'] = $this->determine_end_of_file($type);
		}
		
		$this->set('type',$type);
	}
	
	/**
	 * 
	 * used to see if end of file is reached by a particular type in the index
	 * @param $types
	 */
	
	function ending_of_file($types){
	
		$i = 0;
		foreach($types as $type){
			$types[$i]['EOF'] = $this->determine_end_of_file($type);
			$i++;
		}
		$this->set('types',$types);
	}
	
	/**
	 * 
	 * used to determine if there are no more remaining items in the database
	 * @param $type
	 */
	
	function determine_end_of_file($type){
		if(!empty($type['Gift'])){
			$last_gift_id = $type['Gift'][sizeof($type['Gift'])-1]['id'];
			$temp = $this->Gift->get_remaining_items($type['GiftType']['id'],$last_gift_id);
			if(!empty($temp['Gift'])){
				return false;
			}
			return true;
		}
		return false;
	}
	
	
	/**
	 * 
	 * Search by category
	 */
	function search_by_category($type_id=-1){
		if ($type_id!=-1){
			$gifts = $this->Gift->find("all", array("conditions"=>array("Gift.gift_type_id"=>$type_id), "order"=>"Gift.gift_type_id, Gift.name, Gift.created desc"));
			$this->set("gifts", $gifts);
		}else{
			$this->redirect(array("action"=>"index"));
		}
	}
	
	
	/**
	 * 
	 * Performs autocomplete for searching ...
	 */
	function autoComplete(){
		 Configure::write('debug', 0);
		 $this->layout = 'ajax';
		 $gifts = $this->Gift->find('all', array(
		   'conditions'=>array('Gift.name LIKE'=>$this->params['url']['q'].'%'),
		   'fields'=>array('name', 'id')));

 		 $this->set("gifts", $gifts); 		 
	}
	

	/**
	 * 
	 * View current items...
	 * @param $item_id
	 */
	function view($item_id){
		$gift = $this->Gift->find("first", array(
			'conditions'=>array("Gift.id"=>$item_id)
		));
		$this->set("gift", $gift);
	}
	
}
?>