<?php

use Validator, Input, Redirect; 


class CustomValidator {

	public function phone($field, $value, $parameters){
	    // return true if phone number is valid
	    if($value == '555-555-555') {
	       return true;
	    }
	    // return false if it is not.
	    return false;
	}
}	