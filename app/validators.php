<?php  
/*
* app/validators.php
*/

Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[\pL\s]+$/u', $value);
});

Validator::extend('foo', function($field,$value,$parameters){
	return $value > 3;
});

Validator::extend('amount_major_cero', function($field,$value,$parameters){
	return $value > 0;
});

Validator::extend('identification', function($field,$value,$parameters){
	return $value > 0;
});

?>