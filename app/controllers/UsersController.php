<?php

class UsersController extends BaseController {
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
	} 

	public function index(){
		$organization = app('organization');  
		$this->layout->content = View::make('layouts.users.users')
								->with('organization', $organization);
	}

    //users/register
	public function getRegister() { 
		//$this->layout->content = View::make('layouts.users.register');
		$this->layout->content = View::make('layouts.users.form')
		->with('organization', app('organization'))
		->with('type', 'new');
	}

	public function getRecoverpassword(){
		$this->layout->content = View::make('layouts.users.formrecoverpassword')
		->with('organization', app('organization'));
	}

	//POST users/create
	public function postCreate() { 
 
		//$validator = Validator::make(Input::all(), User::$rules);
		$validator = Validator::make(Input::all(), User::$rules, User::$messages);

		if ($validator->passes()) {
			$user = new User;
			$user->name = Input::get('nombres'); 
			$user->lastname = Input::get('apellidos');
			$user->mail = Input::get('mail');
			$user->direction = Input::get('direccion');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			Mail::send('layouts.users.welcome', array('firstname'=>Input::get('nombres'), 'mail'=>Input::get('mail'), 'password'=>Input::get('password')), function($message){
        	$message->to(Input::get('mail'), Input::get('nombres').' '.Input::get('apellidos'))->subject('Bienvenido!!');
    		});

			return Redirect::to('users/login')->with('message', 'Gracias por registrarse');
		} else {
			return Redirect::to('users/register')
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   
		}
	}

//  /users/login
	public function getLogin() {
		if(Auth::check()){
			return Redirect::to('users/dashboard')->with('message', '');
		}else{
			$this->layout->content = View::make('layouts.users.login');
		}
		
	}

// /users/sigin
	public function postSignin() 
	{

		$data =array('mail'=>Input::get('mail'), 
				'password'=>Input::get('password'));
		
		if (Auth::attempt($data)) {
			return Redirect::to('users/dashboard')->with('message', 'Ha iniciado sesión');
		} else {
			return Redirect::to('users/login')
			->with('message', 'Tu email/password es incorrecto')
			->withInput();
		}      
	}


	public function getEdit($id){

		try {
			$user = User::findOrFail($id);
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
			$organization = app('organization');
		    return Redirect::to('/organization/members/'. $organization->auxName . '/all_members')
			->with('message', 'No existe el usuario');
		}
		
		$this->layout->content = View::make('layouts.users.edit')
	//		->with('organization', app('organization'))
			->with('user', $user)
			->with('type', "edit");
			//->with('type', "edit");
	}


	public function postUpdate($id){

		$user = User::findOrFail($id);
		//$user->fill(Input::all());
		$user->name = Input::get('nombres'); 
		$user->lastname = Input::get('apellidos');
		$user->mail = Input::get('mail');
		$user->direction = Input::get('direccion');
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		$organization = app('organization');
		return Redirect::to('/organization/members/'. $organization->auxName . '/all_members')
			->with('message', 'Registro actualizado');

	}


 
	public function getDashboard() {
		$organization = app('organization');
		$projectsCount = sizeof($organization->projects);
		$iterationsCount = sizeof($organization->iterations);
	
		$this->layout->content = View::make('layouts.users.dashboard')
    	->with('organization', $organization) 
    	->with('projectsCount', $projectsCount)
    	->with('iterationsCount', $iterationsCount);
	}

	public function getLogout() {
    	Auth::logout();
    	return Redirect::to('users/login')->with('message', 'Ha finalizado su sesión');
	}


	public function getNew() {
		//$this->layout->content = View::make('layouts.users.register');
		$this->layout->content = View::make('layouts.users.form')
		->with('organization', app('organization'))
		->with('type', 'new');
	}

	public function postSendpasswordrecovery(){
		$mail = Input::get('mail'); 
		$user = User::where('mail', '=', $mail )->get()->first();

		if ($user) {
			$passwordTmp = substr( $user->name, 0, 3) . substr( $user->lastname, 0, 3);

			Mail::send('layouts.users.recoverpassword', array('name'=>$user->name, 'mail'=> $user->mail, 'password'=> $passwordTmp), function($message){
        		$message->to(Input::get('mail'))->subject('Bienvenido!!');
    		});

			return Redirect::to('users/login')
			->with('message', 'Se ha generado un constraseña temporal y se ha enviado a su correo.')
			->withInput();

		} else {
			return Redirect::to('users/recoverpassword')
			->with('message', 'Tu email no se encuentra registrado.')
			->withInput();
		}      
	}

}
?>