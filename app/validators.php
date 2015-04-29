<?php  
/*
* app/validators.php
*/

Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[\pL\s]+$/u', $value);
});

Validator::extend('alpha_num_spaces', function($attribute, $value){
	//return preg_match('/(^[A-Za-z0-9 ]+$)+/', $value);
	return (bool) preg_match('/^[A-Za-z0-9\s]+$/', $value);
});

Validator::extend('foo', function($field,$value,$parameters){
	return $value > 3;
});

Validator::extend('amount_major_cero', function($field,$value,$parameters){
	return $value > 0;
});

Validator::extend('check_identification', function($field,$value,$parameters){

	$help = new Helper();
	if($help->validarCedula($value)){
		return true;
	}else{
		return false;
	}
});

?>