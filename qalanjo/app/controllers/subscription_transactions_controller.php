<?php
class SubscriptionTransactionsController extends AppController {

	var $name = 'SubscriptionTransactions';

	function __construct(){
		parent::__construct();
		$this->components[] = "Paypal";
		$this->components[] = "Security";
	}
	function beforeFilter(){
		parent::beforeFilter();
		$this->Security->blackHoleCallback = "forceSSL";
		$this->Security->requireSecure('checkout');
	}
	
	
	/**
	 * Details of Subscription Types
	 */
	
	function details(){
		if (!empty($this->data)){
			$this->Session->write("Subscription.details", $this->data);
			$this->redirect(array("action"=>"checkout"));
		}
		$this->layout = "blue_full_block";
		$this->loadModel("CreditType");
		$this->loadModel("SubscriptionType");
		$types = $this->SubscriptionType->find("all");
		$this->set("process", "subscribe_details");
		$this->set("types", $types);

		
	}
	
	function details_quick(){
		if (!empty($this->data)){
			$this->Session->write("Subscription.details", $this->data);
			$this->redirect(array("action"=>"checkout"));
		}
	}
	
	function checkout_paypal($type=-1){
		$this->loadModel("SubscriptionType");
		if ($type!=-1){
			$type = $this->SubscriptionType->find("first", array("conditions"=>array("SubscriptionType.id"=>$type), "recursive"=>-1));
			$paymentInfo["Order"]["amount"] = $type["SubscriptionType"]["price"];
			$paymentInfo["Order"]["description"] = $type["SubscriptionType"]["name"];
			$key = Security::generateAuthKey( );
			$this->Session->write("transaction", $key);
			$this->Session->write("type", $type);
			
			$paymentInfo["Order"]["returnURL"] ="http://".$_SERVER['SERVER_NAME'] . $this->base."/subscription_transactions/success_paypal/".$key;
			$paymentInfo["Order"]["cancelURL"] ="http://".$_SERVER['SERVER_NAME'] . $this->base."/subscription_transactions/cancel_paypal/".$key;
			$paymentInfo["Order"]["shoppingURL"] ="http://".$_SERVER['SERVER_NAME'] . $this->base."/subscribe/";
			$this->Paypal->payViaPaypal($paymentInfo);
		}else{
			$this->redirect("/subscribe");
		}
	}
	
	function success_paypal($key){
		if ($this->Session->check("transaction")){
			$transaction = $this->Session->read("transaction"); 
			if ($key==$transaction){
				$this->data["SubscriptionTransaction"]["payment_method_id"] = 2;
				$this->data["SubscriptionTransaction"]["transaction_code"] = "";
				$this->data["SubscriptionTransaction"]["member_id"] = $this->Session->read("Member.id");
				$type =$this->Session->read("type");
				$this->data["SubscriptionTransaction"]["subscription_type_id"] = $type["SubscriptionType"]["id"];
				$this->Session->write("transaction", null);
				$this->SubscriptionTransaction->create($this->data);						
				if ($this->SubscriptionTransaction->save($this->data, false)){
					$this->loadModel("Member");
					$member_id = $this->Session->read("Member.id");
					$this->Member->updateRole(3, $member_id);
					$this->Session->setFlash("Transaction has been processed", "default", array("class"=>"success"));
					$this->redirect("http://".$_SERVER['SERVER_NAME'] . $this->base."/subscription_transactions/success");
				}
			}	
		}else{
			$this->redirect("/");
		}		
	}
	
	function cancel_paypal(){
		$this->redirect("/subscribe");
	}
	
	function checkout($type = -1){
		$this->layout = "blue_full_block";
		$this->loadModel("SubscriptionType");
		$this->loadModel("CreditType");
		$this->loadModel("Country");
		$this->loadModel("Member");
		if (!empty($this->data)){
			$this->Session->write("SubscriptionResult", null);
			if (!$this->Session->check("SubscriptionResult")){
				if ($this->data["SubscriptionTransaction"]["credit_type_id"]!=-1){
					$type = $this->CreditType->find("first", array("conditions"=>array("CreditType.id"=>$this->data["SubscriptionTransaction"]["credit_type_id"])));
					$country = $this->Country->find("first", array("conditions"=>array("Country.id"=>$this->data["CreditCard"]["country_id"])));
					$this->data["Country"] = $country["Country"];
					$this->data["CreditCard"]["credit_type"] = $type["CreditType"]["paypal_name"];
					$result = $this->Paypal->processPayment($this->data, "DoDirectPayment");
					if ($result["ACK"]=="Success"){
						$this->Session->write("SubscriptionResult", $result);
						$this->data["SubscriptionTransaction"]["payment_method_id"] = 1;
						$this->data["SubscriptionTransaction"]["transaction_code"] = $result["TRANSACTIONID"];
						$this->data["SubscriptionTransaction"]["member_id"] = $this->Session->read("Member.id");
						$this->SubscriptionTransaction->create($this->data);						
						if ($this->SubscriptionTransaction->save($this->data, false)){
							$this->loadModel("Member");
							$member_id = $this->Session->read("Member.id");
							$this->Member->updateRole(3, $member_id);
							$this->Session->setFlash("Transaction has been processed", "default", array("class"=>"success"));
							$this->redirect("http://".$_SERVER['SERVER_NAME'] . $this->base."/subscription_transactions/success");
						}
					}else{
						$this->Session->setFlash($result["L_LONGMESSAGE0"], "default", array("class"=>"error"));
						$this->redirect("http://".$_SERVER['SERVER_NAME'] . $this->base."/subscription_transactions/error");
					}	
				}else{
					
				}
			}else{
				$this->redirect("http://".$_SERVER['SERVER_NAME'] . $this->base."/subscription_transactions/success");
			}
		}
		if ($type!=-1){
			$selectedSubscription = $this->SubscriptionType->find("first",array("conditions"=>array("SubscriptionType.id"=>$type)));
			$this->set("selectedSubscription", $selectedSubscription);
			$member_id = $this->Session->read("Member.id");
			$member = $this->Member->find("first", array("conditions"=>array("Member.id"=>$member_id), "fields"=>array("lastname", "firstname", "middlename" , "zipcode", "address1", "city", "state", "id", "email", "country_code", "contact_number")));
			$credit_cards = $this->CreditType->find ("all", array("recursive"=>-1));
			$countries = $this->Country->find ( "list", array ("fields" => array ("id", "name" ), "order" => "name", "recursive"=>-1 ) );
			$this->set("process", $this->action);
			$this->set("credit_cards", $credit_cards);
			$this->set("countries", $countries);
		}else{
			$this->redirect(array("action"=>"details"));	
		}
	}
	
	function success(){
		$this->layout = "blue_full_block";
	}
	
	function error(){
		
	}
	
	
	/*function already_subscribe(){
		if ($this->RequestHandler->isAjax()){
			$this->layout = "ajax";
			if ($this->Session->check("Member.id")){
				$member_id = $this->Session->read("Member.id");
				$count = $this->SubscriptionTransaction->find("count", array("conditions"=>array("SubscriptionTransaction.member_id"=>$member_id, "expired"=>0)));
				if ($count==0){	
					$this->set("response", "false");
				}else{
					$this->set("response", "true");
				}
				$this->set("response", "true");
				
			}else{
				$this->set("response", "invalid");
			}
		}else{
			$this->set("response", "invalid");
		}
		$this->render("/elements/responses", "ajax");
		
	}*/
	
	function already_subscribe(){
		if($this->RequestHandler->isAjax()) {
			$this->layout = "ajax";
			
					$this->set("response", "true");
		
		}
	}
	
	function drop(){
		$result = $this->passedArgs["result"];
	}
	
	function check_subscription() {	
		if($this->RequestHandler->isAjax()) {
			Configure::write('debug', 0);
			$this->layout = 'ajax';
			$this->autoRender = false;

			if($this->Session->check('Member.id')) {// check if logged in
				$member = $this->SubscriptionTransaction->find('first', array(
												'conditions'=>array(
													'SubscriptionTransaction.member_id'=>$this->Session->read('Member.id'))));
				
				if($member['SubscriptionTransaction']['expired'] == 0) {
					echo 'valid';
				} else {
					echo 'invalid';
				}		
			} else { // not logged in
				echo 'logout';
			}

		}
	}

}
?>