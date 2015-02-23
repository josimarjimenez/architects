<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	//views
	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'nombres'=>'required|alpha|min:2',
	    'apellidos'=>'required|alpha|min:2',
	    'mail'=>'required|email|unique:users',
	    'password'=>'required|alpha_num|between:6,12|confirmed',
	    'password_confirmation'=>'alpha_num'
    );

    public static $messages = array(
    	'nombres.required' => 'El nombre es obligatorio',
    	'nombres.min' => 'El nombre debe contoner al menos dos caracteres',
    	'apellidos.required' => 'El apellido es obligatorio',
    	'mail.required' => 'El email es obligatorio',
    	'mail.email' => 'El correo registrado no es válido',
    	'mail.unique' => 'El mail ya se encuentra registrado',
    	'password.required' => 'El password es obligatorio',
    	'password.alpha_num' => 'El password debe contener letras y números',
    	'password.between' => 'El password debe contener entre 6 y 12 caracteres',
    	'password.confirmed' => 'El password de confirmación es diferente',
    	//'password_confirmation.required' => 'El password de confirmación es obligatorio',
    	//'password_confirmation.alpha_num' => 'El password de confirmación debe contener letras y números',
    	//'password_confirmation.between' => 'El password de confirmación debe contener entre 6 y 12 caracteres'
    );
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	//models
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function roles() {
		return $this->belongsToMany('Rol', 'belongsTo', 'userid', 'rolid');
	}

	public function teams() {
		return $this->belongsToMany('Teams', 'memberof', 'userid', 'teamid');
	}

	public function checkEmailRegistered(){
		//return $this->where('rating', '>', 5)
		//->orderBy('rating', 'DESC')->get();
		return Album::where('artista', '=', 'Something Corporate')->get();
	}

	public function organization(){
		return $this->belongsTo('Organization', 'usersid');
	}

}
