<?php

class UsersController extends BaseController {
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
	} 

    //users/register
	public function getRegister() { 
		$this->layout->content = View::make('layouts.users.register');
	}

	//POST users/create
	public function postCreate() { 
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
			$user = new User;
			$user->nombres = Input::get('nombres'); 
			$user->apellidos = Input::get('apellidos');
			$user->mail = Input::get('mail');
			$user->direccion = Input::get('direccion');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

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
		$this->layout->content = View::make('layouts.users.login');
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

	public function getDashboard() {
    	$this->layout->content = View::make('layouts.users.dashboard'); 
	}

	public function getLogout() {
    	Auth::logout();
    	return Redirect::to('users/login')->with('message', 'Ha finalizado su sesión');
	}


	public function getNew() {
		$this->layout->content = View::make('layouts.users.register');
	}

}
?>