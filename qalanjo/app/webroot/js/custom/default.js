/**
 * Default Value Validator
 */

function equalDefault(defaultValue, value){
	return defaultValue!=value;
}

/**
 * Function for creating validation
 */
function create_defaults(){
	
	/*
	 * Contact Number Related
	 */
	$.validator.addMethod("telcodeDefault", function(value){
		return equalDefault("Code", value);
	});
	$.validator.addMethod("contactnumberDefault", function(value){
		return equalDefault("Number", value);
	});
	
	/**
	 * Billing Information
	 */
	$.validator.addMethod("address1Default", function(value){
		return equalDefault("Address 1", value);
	});
	$.validator.addMethod("cityDefault", function(value){
		return equalDefault("City", value);
	});
	$.validator.addMethod("stateDefault", function(value){
		return equalDefault("State/Province", value);
	});
	$.validator.addMethod("zipcodeDefault", function(value){
		return equalDefault("Zip Code", value);
	});
	$.validator.addMethod("lastnameDefault", function(value){
		return equalDefault("Last Name", value);
	});
	$.validator.addMethod("firstnameDefault", function(value){
		return equalDefault("First Name", value);
	});

	/**
	 * Credit Card
	 */
	$.validator.addMethod("cvcodeDefault", function(value){
		return equalDefault("CV Code", value);
	});
	$.validator.addMethod("cardnumberDefault", function(value){
		return equalDefault("Card Number", value);
	});
	
}