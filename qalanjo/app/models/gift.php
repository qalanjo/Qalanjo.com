<?php
class Gift extends AppModel {
	var $name = 'Gift';
	
	var $currently_viewed_gift = '';
	
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Must not be empty',
			),
			'unique'=>array(
				'rule'=>array('mustBeUnique','Gift.name'),
				'message'=>'The name already exists'
			)
		),
		'price'=>array(
			'numeric'=>array(
				'rule'=>'numeric',
				'message'=>'Price must be numeric'
			)
		)
	);
	var $belongsTo = array(
		'GiftType' => array(
			'className' => 'GiftType',
			'foreignKey' => 'gift_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'GiftAvailTransactionItem' => array(
			'className' => 'GiftAvailTransactionItem',
			'foreignKey' => 'gift_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SentGift' => array(
			'className' => 'SentGift',
			'foreignKey' => 'gift_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ShoppedItem' => array(
			'className' => 'ShoppedItem',
			'foreignKey' => 'gift_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	
	function get_at_least_one(){
		$this->gift_type_binder('',1);
		return $this->gift_finder('all','');
	}

	
	function gift_type_binder($conditions,$limit){
		$this->GiftType->unbindModel(array('hasMany'=>array('Gift')));
		$this->GiftType->bindModel(array('hasMany'=>
			array(
				'Gift' => array(
					'className' => 'Gift',
					'foreignKey' => 'gift_type_id',
					'dependent' => false,
					'conditions' => $conditions,
					'order' => array('Gift.id'=>'desc'),
					'limit' => $limit,
				)
			)
		));	
	}
	
	function gift_finder($type,$conditions){
		return $this->GiftType->find($type,array('conditions'=>$conditions));
	}
	
	
	function get_related_gifts($currently_viewed_gift){
		
		if(!empty($currently_viewed_gift)){
			
			$this->gift_type_binder(array('Gift.id <>'=>$currently_viewed_gift['Gift']['id']),'');
			
			$related_gifts = $this->gift_finder('first',array(
				'GiftType.id'=>$currently_viewed_gift['Gift']['gift_type_id']
			));
			return $related_gifts;
		}
		return false;
	}
	
	function get_total($items){
		$total = 0;
		$temp = array();
		foreach($items as $key=>$item){
			$temp[$key] = $this->GiftAvailTransactionItem->Gift->find('first',array('conditions'=>array('Gift.id'=>$item['GiftAvailTransactionItem']['gift_id'])));
			$total += $temp[$key]['Gift']['price'] * $item['GiftAvailTransactionItem']['quantity'];
		}
		return $total;	
	}
	
	
	
	/**
	 * 
	 * Autocomplete search ...
	 * @param $q The Query
	 */
	function autocomplete($q, $recursive=0){
		$options['conditions'] = array( 
		   "Gift.name LIKE "=>"$q%"
		);
		$options["fields"] =  array("DISTINCT id", "name", 'picture_path'
		);
		$options["recursive"] = $recursive;
		return $this->find("all", $options);		
	}
	
	/**
	 * 
	 * Autocomplete search ...
	 * @param $q The Query
	 */
	function autocomplete_connections($q, $recursive=0){
		$options['conditions'] = array( 
		   "Gift.name LIKE "=>"$q%"
		);
		$options["fields"] =  array("DISTINCT id", "name", 'picture_path'
		);
		$options["recursive"] = $recursive;
		return $this->find("all", $options);		
	}
	
	function delete_picture($filename){
		$url = $_SERVER['DOCUMENT_ROOT']."/qalanjo/app/webroot/img/gifts/".$filename;
		$file = new File($url);
		return $file->delete();	
	}

	function mustBeUnique($check,$field){
		$value = array_values($check);
		$value = $value[0];
		$notUnique = $this->find('first',array('conditions'=>array($field=>$value)));
		
		if(isset($this->data['Gift']['old_name'])){
			if($this->data['Gift']['old_name'] != $value){
				if($notUnique){
					return false;	
				}
			}
			return true;
		}
		
		if($notUnique){
			return false;	
		}
		return true;
	}
	
	
	function get_items_in_stock($member_id){
		$in_stock = $this->ShoppedItem->find('all',array(
			'conditions'=>array(
				'ShoppedItem.member_id'=>$member_id
			),
			'fields'=>array(
				'ShoppedItem.quantity','ShoppedItem.gift_id',
				'Gift.name','Gift.picture_path','Gift.id'
			),
			'recursive'=>0
		));
		return $in_stock;
	}
	
	
	function check_item_count($in_stock){
		$there_are_available_gifts = false;
		foreach($in_stock as $item){
			if($item['ShoppedItem']['quantity'] > 0){
				$there_are_available_gifts = true;
			}
		}
		return !$there_are_available_gifts;
	}
	
	function get_gift_details($in_stock,$member_id){
		$sent_gifts = array();
		foreach($in_stock as $key=>$item){
				$temp = $this->find('first',array(
					'conditions'=>array('Gift.id'=>$item['gift_id']),
					'fields'=>array(
						'Gift.id','Gift.picture_path','Gift.name'
					),
					'recursive'=>0
				));
				
				$sent_gifts[] = $this->SentGift->find('all',
					array(
						'conditions'=>array(
							'SentGift.gift_id'=>$item['gift_id'],
							'SentGift.from_id'=>$member_id
						),
						'field'=>array(
							'SentGift.id'
						),
						'recursive'=>0
					)
				);	
				$shopped_item = $this->ShoppedItem->find('first',array('conditions'=>
					array(
						'ShoppedItem.member_id'=>$member_id,
						'ShoppedItem.gift_id'=>$item['gift_id']
					)
				));
					
				$in_stock[$key]['quantity'] = $shopped_item['ShoppedItem']['quantity'];
					
				$in_stock[$key] = array_merge($in_stock[$key],$temp);
		}
		return $in_stock;	
	}
	
	
	function get_member_connections($member_id){
		$connections = $this->
			GiftAvailTransactionItem->GiftAvailTransaction->
				Member->Connection->find('all',
					array(
						'conditions'=>array(
							'OR'=>array(
								'Connection.member_id'=>$member_id,
								'Connection.partner_id'=>$member_id
							)
						),
						'fields'=>array(
							'Connection.partner_id','Connection.accepted','Connection.member_id',
							'Member.firstname','Member.lastname','Member.gender_id','Member.id',
							'Partner.firstname','Partner.lastname','Partner.gender_id','Partner.id'
						)
					)
			);
		foreach($connections as $key=>$connection){
			if($connection['Partner']['id'] == $member_id){
				$connections[$key]['Partner']['firstname'] = $connection['Member']['firstname'];
				$connections[$key]['Partner']['lastname'] = $connection['Member']['lastname'];
				$connections[$key]['Partner']['gender_id'] = $connection['Member']['gender_id'];
				$connections[$key]['Partner']['id'] = $connection['Member']['id'];
			}
		}
		$connections = $this->get_partner_info($connections);
		return $connections;
	}
	
	function get_partner_info($connections,$gift_selection = null){
		foreach($connections as $key=>$connection){
			$picture_path = $this->
				GiftAvailTransactionItem->GiftAvailTransaction->
					Member->MemberProfile->find('first',array(
						'conditions'=>
							array(
								'MemberProfile.member_id'=>$connection['Partner']['id']
							),
						'fields'=>
							array(
								'MemberProfile.picture_path'
							)
				));
			$gender = $this->
				GiftAvailTransactionItem->GiftAvailTransaction->
					Member->Gender->find('first',array('conditions'=>array('Gender.id'=>$connection['Partner']['gender_id']),'recursive'=>0));
			$connections[$key]['Partner'] = array_merge($connections[$key]['Partner'],$picture_path);
			$connections[$key]['Partner'] = array_merge($connections[$key]['Partner'],$gender);
		}
		
		if(isset($gift_selection)){
			$temp_connection = $connections[0];
			$member = $this->
			GiftAvailTransactionItem->GiftAvailTransaction->
				Member->find('first',array('conditions'=>array(
					'Member.id'=>$temp_connection['Partner']['id']
				),
				'fields'=>array(
					'Member.firstname','Member.lastname'
				),
				'recursive'=>0
			));
			
			$temp = array(
				'firstname'=>$member['Member']['firstname'],
				'lastname'=>$member['Member']['lastname']
			);
			$connections[0]['Partner'] = array_merge($connections[0]['Partner'],$temp);
		}
		
		return $connections;
	}
	
}
?>