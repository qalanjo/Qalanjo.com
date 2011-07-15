<?php
class GiftAvailTransactionsController extends AppController {

	var $name = 'GiftAvailTransactions';
	var $components =array("Session", "Notifier", "Paypal");
	
	/**
	 * 
	 * Start Transaction. Call this action when ever gift browsing is executed.
	 */
	function startTransaction(){
		$this->Session->write("Cart", array());
	}

	
	/**
	 * 
	 * Add items to cart. Call this action when ever you wanted to add items to the cart
	 */
	function addToCart(){
		$cart = $this->Session->read("Cart");
		foreach($cart as $item){ //loops over cart item
			if ($item["GiftAvailTransactionItem"]["gift_id"]==$this->data["GiftAvailTransactionItem"]["gift_id"]){ //if there existing item in the cart, which just need to add the quantity
				$item["GiftAvailTransactionItem"]["quantity"] += $this->data["GiftAvailTransactionItem"]["quantity"];
				return;
			}
		}	
		$cart[] = $this->data; //if item is not yet found. It will be added as new item in the list		
	}

	/**
	 * 
	 * Delete from the cart ...
	 * @param $item_id
	 */
	function deleteFromCart($item_id){
		$cart = $this->Session->read("Cart");
		foreach($cart as $item){ //loops over cart item
			if ($item["GiftAvailTransactionItem"]["gift_id"]==$item_id){ //if there existing item in the cart, which just need to add the quantity
				unset($item);
				return;
			}
		}	
	}
	
	/**
	 * 
	 * Update the list of item of cart ...
	 */
	function updateCart(){
		$cart = $this->Session->read("Cart");
		foreach($cart as $item){ //loops over cart item
			if ($item["GiftAvailTransactionItem"]["gift_id"]==$this->data["GiftAvailTransactionItem"]["gift_id"]){ //if there existing item in the cart, then we update its quantity
				$item["GiftAvailTransactionItem"]["quantity"] = $this->data["GiftAvailTransactionItem"]["quantity"]; 
				return;
			}
		}	
	}

	/**
	 * 
	 * Make payment ...
	 */
	function makePayment(){
		$cart = $this->Session->read("Cart");
		$member_id = $this->Session->read("Member.id");
		$this->loadModel("Member");
		$this->loadModel("Gift");
		$member = $this->Member->find("all", array("conditions"=>array("Member.id"=>$member_id)));
		$transaction = array("Member"=>$member["Member"]);
		$total = 0;
		foreach($cart as $item){ //loops over cart item and sum up the price
			$gift = $this->Gift->find("first", array("conditions"=>array("Gift.id"=>$item["GiftAvailTransactionItem"]["gift_id"])));
			$total+=($gift["Gift"]["price"]*$item["GiftAvailTransactionItem"]["quantity"]);				
		}	
		$transaction["GiftAvailTransaction"]["total"] = $total;
		$card = $this->CreditCard->find("all", array("conditions"=>array("CreditCard.member_id"=>$member_id)));
		$transaction[] = $card;
		$this->Paypal->processPayment($transaction, "DoDirectPayment");
		
	}

	/**
	 * 
	 * View the cart of the current ...
	 */
	function view_cart(){
		$cart = $this->Session->read("Cart");
		foreach($cart as $item){ //
			$item[] = $this->Gift->find("first", 
										array(
											"conditions"=>array("Gift.id"=>$item["Gift"]["id"]),
											"recursive"=>1
										));
		}
		$this->set("cart", $cart);
	}
	
	
}
?>