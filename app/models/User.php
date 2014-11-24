<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'firstname'=>'required|alpha|min:2',
	    'lastname'=>'required|alpha|min:2',
	    'mail'=>'required|email|unique:usuario',
	    'password'=>'required|alpha_num|between:6,12|confirmed',
	    'password_confirmation'=>'required|alpha_num|between:6,12'
    );
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuario';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
