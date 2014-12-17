<?php 

class TeamsController extends BaseController {
	protected $layout = "layouts.main";

	public function getCreate(){  
		$this->layout->content = View::make('layouts.teams.teamsForm')
		->with('organization', app('organization'))  ;
	}

	//save mew
	public function postCreate(){
		$validator = Validator::make(Input::all(), Teams::$rules);

		if ($validator->passes()) { 

			$teams = new Teams;
			$teams->name = Input::get('name'); 
			$teams->save();

			$organization = app('organization');
			return Redirect::to('organization/name/'.$organization->auxName.'/teams')
			->with('message', 'Equipo creado con éxito'); 
		}else{
			return Redirect::to('teams/create')
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   	
		}
	}

	public function getEdit($id){
		 
		$teams = Teams::findOrFail($id);
		$organization = app('organization');
		if($teams==null){
			return Redirect::to('/organization/name/'.$organization->auxName.'/teams')
			->with('message', 'No hay el Equipo');
		}
		$this->layout->content = View::make('layouts.teams.teamsEditForm')
		->with('teams', $teams)  ;
	}

	public function postUpdate(){
		
	}
}
?>