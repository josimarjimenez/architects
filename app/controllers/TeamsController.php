<?php 

class TeamsController extends BaseController {
	protected $layout = "layouts.main";

 	public function index() {
 		
 	}

    public function show($id) {}


	public function create(){  
		$this->layout->content = View::make('layouts.teams.new')
		->with('organization', app('organization')) 
		->with('type',  'new') ;
	}

	//save mew
	public function store(){
		$validator = Validator::make(Input::all(), Teams::$rules);

		if ($validator->passes()) { 

			$teams = new Teams;
			$teams->name = Input::get('name'); 
			$teams->save();

			$organization = app('organization');
			return Redirect::to('organization/name/'.$organization->auxName.'/teams')
			->with('message', 'Equipo creado con exito'); 
		}else{
			return Redirect::to('teams/create')
			->with('error', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   	
		}
	}

	public function edit($id){
		try {
			$teams = Teams::findOrFail($id);
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
			$organization = app('organization');
		    return Redirect::to('/organization/name/'.$organization->auxName.'/teams')
			->with('message', 'No existe el Equipo');
		}
		
		 
		$this->layout->content = View::make('layouts.teams.new')
		->with('team', $teams)->with('type',  'edit')  ;
	}

	public function update($id){
		$teams = Teams::findOrFail($id);
		$teams->fill(Input::all());
		$teams->save();
		$organization = app('organization');
		return Redirect::to('organization/name/'.$organization->auxName.'/teams')
			->with('message', 'Equipo actualizado');
	}


	public function destroy($id){
		//project
		$teams = Teams::find($id);
		if( sizeof($teams->iterations) < 1 ){
			$teams->delete();
		}

		$organization = app('organization');
		return Redirect::to('organization/name/'.$organization->auxName.'/teams')->with('message', 'Equipo eliminado');
	}
}
?>