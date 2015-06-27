<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Eloquent implements UserInterface, RemindableInterface {

	//views
	use UserTrait, RemindableTrait, Messagable;
	public static $rules = array(
	    'nombres'=>'required|latino|min:2',
	    'apellidos'=>'required|latino|min:2',
	    'identification'=>'required|numeric|check_identification|unique:users',
	    //'identification'=>'required|numeric|unique:users',
	    'mail'=>'required|email|unique:users',
	    'password'=>'alpha_num|between:6,12|confirmed',
	    'password_confirmation'=>'alpha_num',
    );

    public static $messages = array(
    	'nombres.required' => 'El nombre es obligatorio',
    	'nombres.min' => 'El nombre debe contener al menos dos caracteres',
    	'apellidos.required' => 'El apellido es obligatorio',
    	'identification.required' => 'La identificación es obligatoria',
    	'identification.numeric' => 'La identificación es un valor numérico',
    	'identification.check_identification' => 'El número de cédula es inválido',
    	'identification.unique' => 'La identificación ingresada ya se encuentra registrada',
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
		return $this->belongsToMany('Teams', 'memberof', 'usersid', 'teamid');
	}

	//public function checkEmailRegistered(){
		//return $this->where('rating', '>', 5)
		//->orderBy('rating', 'DESC')->get();
		//return Album::where('artista', '=', 'Something Corporate')->get();
	//}

	public function organization(){
		return $this->belongsTo('Organization', 'usersid');
	}

	 public function position()
    {
        return $this->belongsTo('Functions','functionid');
    }

	public function threads(){
		return $this->belongsToMany('Cmgmyr\Messenger\Models\Thread', 'participants', 'user_id', 'thread_id')
        ->withPivot('updated_at')
        ->orderBy('updated_at', 'desc');;
	}


	public function numberThreads(){
		return $this->belongsToMany('Cmgmyr\Messenger\Models\Thread', 'participants', 'user_id', 'thread_id')
        ->withPivot('updated_at')
        ->orderBy('updated_at', 'desc');;
	}

	public function projects(){
		$teams = $this->belongsToMany('Teams', 'memberof', 'usersid', 'teamid')->get();	
		$projects = array();
		foreach ($teams as $var) {
			$projects[] = Project::findOrFail($var->id); 
			//$project = Project::findOrFail($var->id)->get(); 
			//print_r($project->name);
			//print_r($var->id);
			//die();
		}

		//print_r(count($projects));
		//return count($teams);
		return $projects;
	}

}
