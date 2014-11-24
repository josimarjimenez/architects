<?php

class UsersController extends BaseController {
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
	}


	public function getRegister() {
		$this->layout->content = View::make('layouts.users.register');
	}

	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
			$user = new User;
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::to('usuarios/login')->with('message', 'Gracias por registrarse');
		} else {
			return Redirect::to('usuarios/register')->with('message', 'Ocurrieron los siguientes errores')->withErrors($validator)->withInput();   
		}
	}

	public function getLogin() {
		$this->layout->content = View::make('layouts.users.login');
	}

	public function postSignin() {
		if (Auth::attempt(array('mail'=>Input::get('email'), 'password'=>Input::get('password')))) {
			return Redirect::to('usuarios/dashboard')->with('message', 'Ha iniciado sesión');
		} else {
			return Redirect::to('usuarios/login')
			->with('message', 'Tu email/password es incorrecto')
			->withInput();
		}      
	}

	public function getDashboard() {
    	$this->layout->content = View::make('layouts.users.dashboard'); 
	}

	public function getLogout() {
    	Auth::logout();
    	return Redirect::to('usuarios/login')->with('message', 'Ha finalizado su sesión');
	}


	public function getNeworg() { 
    	return Redirect::to('usuarios/register')->with('message', 'Ha finalizado su sesión');
	}

	public function getNew() {
		$this->layout->content = View::make('layouts.users.register');
	}

}
?>