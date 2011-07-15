<?php
APP::import("Vendor", "paypal");

/**
 * 
 * Paypal component ...
 * @author Ney
 *
 */
class PaypalComponent extends Object{
	
	function initialize($controller, $settings = array()){
		$this->controller = $controller;
	}
	function processPayment($paymentInfo, $function) {
		if ((is_array($paymentInfo["CreditCard"]["expiration_year"]))||(is_array($paymentInfo["CreditCard"]["expiration_month"]))){
			$paymentInfo["CreditCard"]["expiration_year"] = $paymentInfo["CreditCard"]["expiration_year"]["year"];
			$paymentInfo["CreditCard"]["expiration_month"] = $paymentInfo["CreditCard"]["expiration_month"]["month"];
		}
		if (isset($paymentInfo["CoinAvailTransaction"])){
			$paymentInfo["Payment"]["total"] = $paymentInfo["CoinAvailTransaction"]["price"];
			$paymentInfo["Payment"]["description"] =  $paymentInfo["CoinAvailTransaction"]["description"];
		}else if (isset($paymentInfo["SubscriptionTransaction"])){
			$paymentInfo["Payment"]["total"] = $paymentInfo["SubscriptionTransaction"]["price"];
			$paymentInfo["Payment"]["description"] = $paymentInfo["SubscriptionTransaction"]["description"];
		}
		$paypal = new Paypal();
		$result = $paypal->$function($paymentInfo);
		
		return $result;
	}
	
	function payViaPaypal($paymentInfo){
		$url = Configure::read("paypal");
		$currencyCode = Configure::read("currencycode");
		$url.="item_name=".urlencode($paymentInfo["Order"]["description"]);
		$url.="&currency_code=USD";
		$url.="&amount=".urlencode($paymentInfo["Order"]["amount"]);
		$url.="&add=1";		
		$url.="&shopping_url=".$paymentInfo["Order"]["shoppingURL"];
		$url.="&cancel_return=".$paymentInfo["Order"]["cancelURL"];
		$url.="&return=".$paymentInfo["Order"]["returnURL"];
		$this->controller->redirect($url);
	}
}

