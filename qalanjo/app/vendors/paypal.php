<?php


class Paypal{
	private $api_username, $api_password, $api_signature, $api_endpoint, $subject, $auth_token,$auth_signature, $auth_timestamp, $version;
	
	
	function __construct(){
		require_once 'constants.php';
		if(defined('API_USERNAME'))
		$this->api_username=API_USERNAME;
		
		if(defined('API_PASSWORD'))
		$this->api_password=API_PASSWORD;
		
		if(defined('API_SIGNATURE'))
		$this->api_signature=API_SIGNATURE;
		
		if(defined('API_ENDPOINT'))
		$this->api_endpoint =API_ENDPOINT;
		
		$this->version=VERSION;
		
		if(defined('SUBJECT'))
		$this->subject = SUBJECT;
		// below three are needed if used permissioning
		if(defined('AUTH_TOKEN'))
		$this->auth_token= AUTH_TOKEN;
		
		if(defined('AUTH_SIGNATURE'))
		$this->auth_signature=AUTH_SIGNATURE;
		
		if(defined('AUTH_TIMESTAMP'))
		$this->auth_timestamp=AUTH_TIMESTAMP;

	}
	
	function DoDirectPayment($paymentInfo=array()){
		/**
		* Get required parameters from the web form for the request
		*/
		$paymentType =urlencode('Sale');
		$firstName =urlencode($paymentInfo['CreditCard']['firstname']);
		$lastName =urlencode($paymentInfo['CreditCard']['lastname']);
		$creditCardType =urlencode($paymentInfo['CreditCard']['credit_type']);
		$creditCardNumber = urlencode($paymentInfo['CreditCard']['card_number']);
		$expDateMonth =urlencode($paymentInfo['CreditCard']['expiration_month']);
		$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
		$expDateYear =urlencode($paymentInfo['CreditCard']['expiration_year']);
		$cvv2Number = urlencode($paymentInfo['CreditCard']['cv_code']);
		$address1 = urlencode($paymentInfo['CreditCard']['address1']);
		if (isset($paymentInfo["Member"]["address2"])){
			$address2 = urlencode($paymentInfo['Member']['address2']);
		}else{
			$address2 = "";
		}
		$country = urlencode($paymentInfo['Country']['country_code']);
		$city = urlencode($paymentInfo['CreditCard']['city']);
		$state =urlencode($paymentInfo['CreditCard']['state']);
		$zip = urlencode($paymentInfo['CreditCard']['zipcode']);
		$amount = urlencode($paymentInfo['Payment']['total']);
		$desc = urlencode($paymentInfo["Payment"]["description"]);
		$currencyCode="USD";
		$paymentType=urlencode('Sale');
		$ip=$_SERVER['REMOTE_ADDR'];
		$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&STREET2=$address2&CITY=$city&STATE=$state".
		"&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyCode";	
		$resArray=$this->hash_call("doDirectPayment",$nvpstr);
		return $resArray;
		
	}
	
	function SetExpressCheckout($paymentInfo=array()){
		$amount = urlencode($paymentInfo['Order']['theTotal']);
		$paymentType=urlencode('Sale');
		
		$currencyCode=urlencode('USD');
		
		$returnURL =urlencode($paymentInfo['Order']['returnUrl']);
		$cancelURL =urlencode($paymentInfo['Order']['cancelUrl']);
		
		$nvpstr='&PAYMENTREQUEST_0_AMT='.$amount.'&PAYMENTACTION='.$paymentType.'&CURRENCYCODE='.$currencyCode.'&RETURNURL='.$returnURL.'&CANCELURL='.$cancelURL;
		$resArray=$this->hash_call("SetExpressCheckout",$nvpstr);
		return $resArray;
	}
	
	function GetExpressCheckoutDetails($token){
		$nvpstr='&TOKEN='.$token;
		$resArray=$this->hash_call("GetExpressCheckoutDetails",$nvpstr);
		return $resArray;
	}
	
	function DoExpressCheckoutPayment($paymentInfo=array()){
		$paymentType='Sale';
		$currencyCode='USD';
		$serverName = $_SERVER['SERVER_NAME'];
		$nvpstr='&TOKEN='.urlencode($paymentInfo['TOKEN']).'&PAYERID='.urlencode($paymentInfo['PAYERID']).'&PAYMENTACTION='.urlencode($paymentType).'&AMT='.urlencode($paymentInfo['ORDERTOTAL']).'&CURRENCYCODE='.urlencode($currencyCode).'&IPADDRESS='.urlencode($serverName); 
		$resArray=$this->hash_call("DoExpressCheckoutPayment",$nvpstr);
		return $resArray;
	}
	
	function APIError($errorNo,$errorMsg,$resArray){
		$resArray['Error']['Number']=$errorNo;
		$resArray['Error']['Number']=$errorMsg;
		return $resArray;
	}
	
	function hash_call($methodName,$nvpStr)
	{

		// form header string
		$nvpheader= $this->nvpHeader();
		//setting the curl parameters.
		$ch = curl_init();
		
		
		curl_setopt($ch, CURLOPT_URL,$this->api_endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		//in case of permission APIs send headers as HTTPheders
		if(!empty($this->auth_token) && !empty($this->auth_signature) && !empty($this->auth_timestamp))
		 {
			$headers_array[] = "X-PP-AUTHORIZATION: ".$nvpheader;
	  
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_array);
	    curl_setopt($ch, CURLOPT_HEADER, false);
		}
		else 
		{
			$nvpStr=$nvpheader.$nvpStr;
		}
	    //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
	   //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
		if(USE_PROXY)
		curl_setopt ($ch, CURLOPT_PROXY, PROXY_HOST.":".PROXY_PORT); 
	
		//check if version is included in $nvpStr else include the version.
		if(strlen(str_replace('VERSION=', '', strtoupper($nvpStr))) == strlen($nvpStr)) {
			$nvpStr = "&VERSION=" . urlencode($this->version) . $nvpStr;	
		}
		
		$nvpreq="METHOD=".urlencode($methodName).$nvpStr;
		
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
	
		//getting response from server
		$response = curl_exec($ch);
	
		//convrting NVPResponse to an Associative Array
		$nvpResArray=$this->deformatNVP($response);
		$nvpReqArray=$this->deformatNVP($nvpreq);
		$_SESSION['nvpReqArray']=$nvpReqArray;

		if (curl_errno($ch)) {
		// moving to display page to display curl errors
		  $_SESSION['curl_error_no']=curl_errno($ch) ;
		  $_SESSION['curl_error_msg']=curl_error($ch);
		  $location = "../files/APIError.php";
		  header("Location: $location");
	 	} else {
		 //closing the curl
			curl_close($ch);
	  	}	

		return $nvpResArray;
	}
	
	function nvpHeader(){
		
		$nvpHeaderStr = "";
		if (defined ( 'AUTH_MODE' )) {
			//$AuthMode = "3TOKEN"; //Merchant's API 3-TOKEN Credential is required to make API Call.
			//$AuthMode = "FIRSTPARTY"; //Only merchant Email is required to make EC Calls.
			$AuthMode = "THIRDPARTY";//Partner's API Credential and Merchant Email as Subject are required.
			$AuthMode = "AUTH_MODE";
		} else {
			if ((! empty ( $this->api_username )) && (! empty ( $this->api_password )) && (! empty ( $this->api_signature )) && (! empty ( $this->subject ))) {
				$AuthMode = "THIRDPARTY";
			} 
			else if ((! empty ( $this->api_username )) && (! empty ( $this->api_password )) && (! empty ( $this->api_signature ))) {
				$AuthMode = "3TOKEN";
			} 
			elseif (! empty ( $this->auth_token ) && ! empty ( $this->auth_signature ) && ! empty ( $this->auth_timestamp )) {
				$AuthMode = "PERMISSION";
			} elseif (! empty ( $this->subject )) {
				$AuthMode = "FIRSTPARTY";
			}
		}
		switch ($AuthMode) {
			case "3TOKEN" :
				$nvpHeaderStr = "&PWD=" . urlencode ( $this->api_password ) . "&USER=" . urlencode ( $this->api_username ) . "&SIGNATURE=" . urlencode ( $this->api_signature );
				break;
			case "FIRSTPARTY" :
				$nvpHeaderStr = "&SUBJECT=" . urlencode ( $this->subject );
				break;
			case "THIRDPARTY" :
				$nvpHeaderStr = "&PWD=" . urlencode ( $this->api_password ) . "&USER=" . urlencode ( $this->api_username ) . "&SIGNATURE=" . urlencode ( $this->api_signature ) . "&SUBJECT=" . urlencode ( $this->subject );
				break;
			case "PERMISSION" :
				$nvpHeaderStr = $this->formAutorization ( $this->auth_token, $this->auth_signature, $this->auth_timestamp );
				break;
		}
		return $nvpHeaderStr;
	}
	
	
	
	function deformatNVP($nvpstr)
	{
	
		$intial=0;
	 	$nvpArray = array();
	
	
		while(strlen($nvpstr)){
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);
	
			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
	     }
		return $nvpArray;
	}
	function formAutorization($auth_token,$auth_signature,$auth_timestamp)
	{
		$authString="token=".$auth_token.",signature=".$auth_signature.",timestamp=".$auth_timestamp ;
		return $authString;
	}
	
}
?>