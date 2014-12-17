<?php 

class RolController extends BaseController {
	protected $layout = "layouts.main";

 	public function index() {}

    public function show($id) {}


	public function create(){  
		$this->layout->content = View::make('layouts.rol.new')
		->with('organization', app('organization')) 
		->with('type',  'new') ;
	}

	//save mew
	public function store(){
		$validator = Validator::make(Input::all(), Rol::$rules);

		if ($validator->passes()) { 

			$rol = new Rol;
			$rol->name = Input::get('name'); 
			$rol->description = Input::get('description'); 
			$rol->save();

			$organization = app('organization');
			return Redirect::to('organization/name/'.$organization->auxName.'/rol')
			->with('message', 'Rol creado con exito'); 
		}else{
			return Redirect::to('rol/create')
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   	
		}
	}

	public function edit($id){
		try {
			$rol = Rol::findOrFail($id);
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
			$organization = app('organization');
		    return Redirect::to('/organization/name/'.$organization->auxName.'/rol')
			->with('message', 'No existe el proyecto');
		}
		
		 
		$this->layout->content = View::make('layouts.rol.new')
		->with('rol', $rol)->with('type',  'edit')  ;
	}

	public function update($id){
		$rol = Rol::findOrFail($id);
		$rol->fill(Input::all());
		$rol->save();
		$organization = app('organization');
		return Redirect::to('organization/name/'.$organization->auxName.'/rol')
			->with('message', 'Rol actualizado');
	}


	public function destroy($id){
		//rol
		$rol = Rol::find($id);
		if( sizeof($rol->iterations) < 1 ){
			$rol->delete();
		}

		$organization = app('organization');
		return Redirect::to('organization/name/'.$organization->auxName.'/rol')->with('message', 'Rol eliminado');
	}
}
?>