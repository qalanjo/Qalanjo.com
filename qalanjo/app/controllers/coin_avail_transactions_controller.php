<?php
class CoinAvailTransactionsController extends AppController {

	var $name = 'CoinAvailTransactions';

	function __construct(){
		parent::__construct();
		$this->components[] = "Paypal";
		$this->components[] = "Security";
	}
	
	/**
	 * 
	 * Action for availing ...
	 */
	function avail(){		
		$this->loadModel("CoinPackage");
		if (!empty($this->data)){
			$this->Session->write("coin_avail_transactions", $this->data);
			$this->redirect("/coin_avail_transactions/checkout");
		}
		$this->layout = "full_block";
		$this->load_index();
		$packages = $this->CoinPackage->find("all");
		$this->set("packages", $packages);
	}
	
	function checkout($type=1){
		if (!empty($this->data)){
		
			$this->Session->write("CoinAvailResult", null);
			if (!$this->Session->check("CoinAvailResult")){
				$this->loadModel("CreditType");	
					debug($this->data);	
				$this->loadModel("Country");
				$this->loadModel("CoinPackage");
				$type = $this->CreditType->find("first", array("conditions"=>array("CreditType.id"=>$this->data["CoinAvailTransaction"]["credit_type_id"])));
				$country = $this->Country->find("first", array("conditions"=>array("Country.id"=>$this->data["CreditCard"]["country_id"])));
				$this->data["Country"] = $country["Country"];
				$this->data["CreditCard"]["credit_type"] = $type["CreditType"]["paypal_name"];
				$result = $this->Paypal->processPayment($this->data, "DoDirectPayment");
				if ($result["ACK"]=="Success"){
					$this->Session->write("CoinAvailResult", $result);
					$package = $this->CoinPackage->find("first", array("conditions"=>array("CoinPackage.package"=>$this->data["CoinAvailTransaction"]["description"]), "recursive"=>-1));
					$this->data["CoinAvailTransaction"]["payment_method_id"] = 1;
					$this->data["CoinAvailTransaction"]["transaction_code"] = $result["TRANSACTIONID"];
					$this->data["CoinAvailTransaction"]["member_id"] = $this->Session->read("Member.id");
					$this->data["CoinAvailTransaction"]["coins"] = $package["CoinPackage"]["coins"];
					$this->Session->write("qpoints", $package["CoinPackage"]["coins"]);
					$this->CoinAvailTransaction->create($this->data);
					if ($this->CoinAvailTransaction->save($this->data, false)){
						$this->loadModel("Member");
						$this->Member->add_q_points($this->data["CoinAvailTransaction"]["member_id"], $this->data["CoinAvailTransaction"]["coins"]);						
						$this->redirect("http://".$_SERVER['SERVER_NAME'] . $this->base."/coin_avail_transactions/success");				
					}
				}else{
					$this->Session->setFlash($result["L_LONGMESSAGE0"], "default", array("class"=>"error"));
					$this->redirect("http://".$_SERVER['SERVER_NAME'] . $this->base."/coin_avail_transactions/error");
				}
			}else{
				$this->redirect("http://".$_SERVER['SERVER_NAME'] . $this->base."/coin_avail_transactions/error");
			}
		}
		$this->layout = "blue_full_block";
		$this->loadModel("CoinPackage");
		$package = $this->CoinPackage->find("first", array("conditions"=>array("CoinPackage.id"=>$type)));
		$this->set("package", $package);
		$this->load_index();
		$this->loadModel("CreditType");
		$this->loadModel("Country");
		$credit_cards = $this->CreditType->find ( "list", array ("fields" => array ("paypal_name", "value" ), "order" => "value" ) );
		$this->set("credit_cards", $credit_cards);
		$countries = $this->Country->find ( "list", array ("fields" => array ("id", "name" ), "order" => "name", "recursive"=>-1 ) );
		$this->set("countries", $countries);
	}
	function error(){
		$this->layout = "blue_full_block";
		$this->Session->write("CoinAvailResult", null);
		$this->load_index();
	}
	function success(){
		$this->layout = "blue_full_block";
		$this->load_index();
		$this->Session->write("CoinAvailResult", null);
		$qpoints = $this->Session->read("qpoints");
		$this->Session->write("qpoints", null);
		$this->set("qpoints", $qpoints);
	}
	function review(){
		$transaction = $this->CoinAvailTransaction->avail($this->data);
		if ($transaction){
			
		}
	}
	
	function buy() {
		$this->layout = 'blue_full_block';
		$this->loadModel('Member');
		$memberId = $this->Session->read('Member.id');
		$member = $this->Member->find('first', array('conditions'=>array('Member.id'=>$memberId), 'fields'=>array('Member.id', 'Member.credit_points', "Member.lastname", "Member.firstname") ,'recursive'=>-1));
		$this->set('member', $member);
	}
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Security->blackHoleCallback = "forceSSL";
		$this->Security->requireSecure('checkout');
	}
	
	
	function checkout_paypal($type=-1){
		$this->loadModel("CoinPackage");
		if ($type!=-1){
			$type = $this->CoinPackage->find("first", array("conditions"=>array("CoinPackage.id"=>$type), "recursive"=>-1));
			$paymentInfo["Order"]["amount"] = $type["CoinPackage"]["amount"];
			$paymentInfo["Order"]["description"] = $type["CoinPackage"]["package"];
			$key = Security::generateAuthKey( );
			$this->Session->write("transaction", $key);
			$this->Session->write("cointype", $type);
			$paymentInfo["Order"]["returnURL"] ="http://".$_SERVER['SERVER_NAME'] . $this->base."/qpoints/success_paypal/".$key;
			$paymentInfo["Order"]["cancelURL"] ="http://".$_SERVER['SERVER_NAME'] . $this->base."/qpoints/cancel_paypal/".$key;
			$paymentInfo["Order"]["shoppingURL"] ="http://".$_SERVER['SERVER_NAME'] . $this->base."/qpoints/buy";
			$this->Paypal->payViaPaypal($paymentInfo);
		}else{
			$this->redirect("/subscribe");
		}
	}
	
	function success_paypal($key){
		if ($this->Session->check("qpoint_transaction")){
			$transaction = $this->Session->read("qpoint_transaction"); 
			if ($key==$transaction){
				$this->data["CoinAvailTransaction"]["payment_method_id"] = 2;
				$this->data["CoinAvailTransaction"]["transaction_code"] = "";
				$this->data["CoinAvailTransaction"]["member_id"] = $this->Session->read("Member.id");
				$type = $this->Session->read("cointype");
				$this->data["CoinAvailTransaction"]["amount"] = $type["CoinPackage"]["amount"];
				$this->data["CoinAvailTransaction"]["coins"] = $type["CoinPackage"]["coins"];
				$this->Session->write("transaction", null);
				$this->CoinAvailTransaction->create($this->data);						
				if ($this->CoinAvailTransaction->save($this->data, false)){
					$this->loadModel("Member");
					$member_id = $this->Session->read("Member.id");
					$this->loadModel("Member");
					$this->Member->add_q_points($member_id, $type["CoinPackage"]["coins"]);						
					$this->Session->setFlash("Transaction has been processed", "default", array("class"=>"success"));
					$this->redirect("http://".$_SERVER['SERVER_NAME'] . $this->base."/qpoints/success");
				}
			}	
		}else{
			$this->redirect("/");
		}		
	}
	
}
?>