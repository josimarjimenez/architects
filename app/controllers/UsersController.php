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
 
		$rules = User::$rules;
		$rules['password'] .= '|required';
		$validator = Validator::make(Input::all(), $rules, User::$messages);

		if ($validator->passes()) {
			$user = new User;
			$user->name = Input::get('nombres'); 
			$user->lastname = Input::get('apellidos');
			$user->identification = Input::get('identification');
			$user->phone = Input::get('telefono');
			$user->mail = Input::get('mail');
			$user->direction = Input::get('direccion');
			$user->password = Hash::make(Input::get('password'));
			$user->rol = 'User';
			$user->save();

			Mail::send('layouts.users.welcome', array('firstname'=>Input::get('nombres'), 'mail'=>Input::get('mail'), 'password'=>Input::get('password')), function($message){
        		$message->to(Input::get('mail'), Input::get('nombres').' '.Input::get('apellidos'))->subject('Bienvenido!!');
    		});
			$organization = app('organization');
			return Redirect::to('/organization/members/'.$organization->auxName . '/all_members')->with('message', 'Gracias por registrarse');
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

	public function getEditprofile(){

		try {
			$user = Auth::user();
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
			$organization = app('organization');
		    return Redirect::to('/organization/members/'. $organization->auxName . '/all_members')
			->with('message', 'No existe el usuario');
		}
		
		$this->layout->content = View::make('layouts.users.editprofile')
	//		->with('organization', app('organization'))
			->with('user', $user)
			->with('type', "edit");
			//->with('type', "edit");
	}	

	public function postUpdate($id){

		

		$user = User::findOrFail($id);
		$rules = User::$rules;
		$rules['identification'] .= ',identification,' . $id;
		$rules['mail'] .= ',mail,' . $id;
		$validator = Validator::make(Input::all(), $rules, User::$messages);

		//var_dump($rules);
		//die();

		if($validator->passes()){
			$user->name = Input::get('nombres'); 
			$user->lastname = Input::get('apellidos');
			$user->identification = Input::get('identification');
			$user->phone = Input::get('telefono');
			$user->mail = Input::get('mail');
			$user->direction = Input::get('direccion');

			if(!empty(Input::get('password'))){
				$user->password = Hash::make(Input::get('password'));
			}
			
			$user->save();
			$organization = app('organization');

			if( isset($_POST['myprofile']) ){

			//if(Input::get('myprofile')){	
				return Redirect::to('/users/dashboard')
				->with('message', 'Registro actualizado');
			}else{
				return Redirect::to('/organization/members/'. $organization->auxName . '/all_members')
				->with('message', 'Registro actualizado');	
			}

			

		}else{
			return Redirect::to('users/edit/'.$id)
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();
		}		
	}


 
 	/**
 	* Get home after logged in
 	**/
	public function getDashboard() {
		$organization = app('organization');
		$projectsCount = sizeof($organization->projects);
		$idProjects = array();

		foreach($organization->projects as $project){
			$idProjects[]=$project->id;
		}

		$iterations = Iterations::whereIn('projectid', $idProjects)->get();
		$idIterations = array();

		
		foreach($iterations as $iteration){
			$idIterations[]=$iteration->id;
		}

		$issues = Issue::whereIn('iterationid', $idIterations)->get();

		$idStories = array();
		foreach ($issues  as $issue) {
			$idStories[] = $issue->id;
		}
		$tasks = Task::whereIn('issueid', $idStories)->get();
	
		$this->layout->content = View::make('layouts.users.dashboard')
    	->with('organization', $organization) 
    	->with('projectsCount', $projectsCount)
    	->with('iterationsCount', count($iterations))
    	->with('taskCount', count($tasks));
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
			$user->password = Hash::make($passwordTmp);
			$user->save();
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
/*
	public function postPassword()
    {
        $rules = array(
            'password' => 'required',
            'newpassword' => 'required|min:5',
            'repassword' => 'required|same:newpassword'
        );

        $messages = array(
                'required' => 'El campo :attribute es obligatorio.',
                'min' => 'El campo :attribute no puede tener menos de :min carácteres.'
        );

        $validation = Validator::make(Input::all(), $rules, $messages);
        if ($validation->fails())
        {
            return Redirect::to('password')->withErrors($validation)->withInput();
        }
        else{
            if (Hash::check(Input::get('password'), Auth::user()->Password))
            {
                $cliente = new cliente();
                $cliente = Auth::user();
                $cliente->Password = Hash::make(Input::get('newpassword'));
                $cliente->save();
               
                   
                   if($cliente->save()){
                        return Redirect::to('password')->with('notice', 'Nueva contraseña guardada correctamente');
                   }
                   else
                   {
                       return Redirect::to('password')->with('notice', 'No se ha podido guardar la nueva contaseña');
                    }
            }
            else
            {
                return Redirect::to('password')->with('notice', 'La contraseña actual no es correcta')->withInput();
            }

        }
    }
	*/
}
?>