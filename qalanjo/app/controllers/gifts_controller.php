<?php 
class GiftsController extends AppController {
	var $name = 'Gifts';
	var $helpers = array('Javascript', 'Js', 'Ajax');
	var $components = array('RequestHandler');
	
	function index() {
		$this->layout = 'blue_full_block';
		$this->loadModel('Member');
		$this->load_index();
		$memberId = $this->Session->read('Member.id');
		$member = $this->Member->find('first', array('conditions'=>array('Member.id'=>$memberId), 'fields'=>array('Member.id', 'Member.credit_points') ,'recursive'=>-1));
		$viewedMemberId = $this->Session->read('ViewMember.id');
		$viewedMember = $this->Member->find('first', array('conditions'=>array('Member.id'=>$viewedMemberId), 'fields'=>array('Member.id', 'Member.firstname'), 'recursive'=>-1));
		$giftTypes = $this->Gift->GiftType->find('all', array('order'=>array('GiftType.value ASC') ,'recursive'=>-1));
		$this->set('giftTypes', $giftTypes);
		$this->set('member', $member);
		$this->set('viewedMember', $viewedMember);
	}
	
	function get_gifts($typeId) {
		$gifts = $this->Gift->find('all', array('conditions'=>array('Gift.gift_type_id'=>$typeId), 'fields'=>array('Gift.id', 'Gift.name', 'Gift.price', 'Gift.picture_path'), 'recursive'=>-1));
		$type = $this->Gift->GiftType->find('first', array('conditions'=>array('GiftType.id'=>$typeId), 'recursive'=>-1));
		$this->set('gifts', $gifts);
		$this->set('typeName', $type['GiftType']['value']);
	}
	
	function get_gift($typeName, $giftId) {
		$this->loadModel('Member');
		$memberId = $this->Session->read('Member.id');
		$viewedMemberId = $this->Session->read('ViewMember.id');
		$member = $this->Member->find('first', array('conditions'=>array('Member.id'=>$memberId), 'fields'=>array('Member.id', 'Member.credit_points') ,'recursive'=>-1));
		$gift = $this->Gift->find('first', array('conditions'=>array('Gift.id'=>$giftId), 'recursive'=>-1));
		$this->set('typeName', $typeName);
		$this->set('member', $member);
		$this->set('gift', $gift);
		$this->set('viewedMemberId', $viewedMemberId);
	}
	
	function send_gift($viewedMemberId, $giftId, $memberId) {
		$message = $this->params['form']['message'];
		$item['SentGift']['member_id'] = $viewedMemberId;
		$item['SentGift']['gift_id'] = $giftId;
		$item['SentGift']['message'] = $message;
		$item['SentGift']['from_id'] = $memberId;
		$this->loadModel('SentGift');
		$this->SentGift->create();
		if ($this->SentGift->save($item, false)) {
			$this->loadModel('Member');
			$lastInsert = $this->SentGift->getLastInsertId();
			$this->loadModel("Update");
			$this->Update->createUpdate( $viewedMemberId, $lastInsert, 5);
			$member = $this->Member->find('first', array('conditions'=>array('Member.id'=>$memberId), 'fields'=>array('Member.credit_points'), 'recursive'=>-1));
			$this->loadModel('Gift');
			$gift = $this->Gift->find('first', array('conditions'=>array('Gift.id'=>$giftId), 'fields'=>array('Gift.price'), 'recursive'=>-1));
			$this->Member->id = $memberId;
			$this->Member->saveField('credit_points', $member['Member']['credit_points'] - $gift['Gift']['price']);
			
			$viewedMember = $this->Member->find('first', array('conditions'=>array('Member.id'=>$viewedMemberId), 'fields'=>array('Member.id', 'Member.firstname'), 'recursive'=>-1));
			$this->set('viewedMember', $viewedMember);
			$success = true;
		} else {
			$success = false;
		}
		$this->set('success', $success);
	}
	
	function load_sent_gifts($limit = 3){
		if ($this->RequestHandler->isAjax()){
			$member_id = $this->Session->read("Member.id");
			$this->loadModel("SentGift");
			$this->loadModel("MemberProfile");
			$this->loadModel("Country");	
			$sentGifts = $this->SentGift->loadSentGift($member_id, $limit);
			$gifts = array();
			foreach($sentGifts as $sentGift){
				$profile = $this->MemberProfile->find("first", array("conditions"=>array("MemberProfile.member_id"=>$sentGift["SentGift"]["from_id"])));
				$country = $this->Country->find("first", array("conditions"=>array("Country.id"=>$sentGift["Sender"]["country_id"]), "recursive"=>-1));
				$sentGift["Country"] = $country["Country"];
				$sentGift["MemberProfile"] = $profile["MemberProfile"];
				$gifts[] = $sentGift;			
			}	
			$this->set("gifts", $gifts);
			$this->render("/elements/blue/members/index/sent_gift_content", "ajax");
		}
	}
	
	function open($sent_gift_id){
		$this->loadModel("SentGift");
		$this->loadModel("GiftType");
		$this->loadModel("MemberProfile");
		if ($this->RequestHandler->isAjax()){
			$sentGift = $this->SentGift->getSentGift($sent_gift_id);
			$type = $this->GiftType->find("first", array("conditions"=>array("GiftType.id"=>$sentGift["Gift"]["gift_type_id"])));
			$profile = $this->MemberProfile->getPictureOnly($sentGift["SentGift"]["from_id"]);
			$sentGift["MemberProfile"] = $profile["MemberProfile"];
			$this->set("sentGift", $sentGift);
			$this->set("typeName", $type["GiftType"]["value"]);
			$this->layout = "ajax";
		}else{
			$this->redirect("/");
		}
	}
}
?>