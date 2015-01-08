<?php 

class IterationsController extends BaseController {
	protected $layout = "layouts.main";

 	public function index() {
 		 
 	}

    public function show($id) { 
   
    	try {
			$iteration = Iterations::findOrFail($id); 


			$this->layout->content = View::make('layouts.iterations.show')
								->with('iteration', $iteration)
								->with('message', 'Iteracion creada con éxito');
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
			 
		    return Redirect::to('/projects/')
			->with('message', 'Error al crear la iteración');
		}
    }


	public function create(){   
		$projectid = Input::get('projectid');
		$project = Project::findOrFail($projectid);  
		
		$this->layout->content = View::make('layouts.iterations.form')
		->with('project', $project) 
		->with('type',  'new');
	}

	//save mew
	public function store(){

		$iterations = new Iterations;
		$iterations->name = Input::get('name'); 
		$iterations->start = Input::get('start'); 
		$iterations->end = Input::get('end');   
		$iterations->realBudget = Input::get('realBudget');  
		$iterations->projectid = Input::get('projectid'); 
		$iterations->save();

		return Redirect::to('/iterations/'.$iterations->id)
			->with('message', 'Registro creado con exito'); 
	}

	public function edit($id){
		try {
			$project = Project::findOrFail($id);
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
			$organization = app('organization');
		    return Redirect::to('/organization/name/'.$organization->auxName.'/projects')
			->with('message', 'No existe el proyecto');
		}
		
		 
		$this->layout->content = View::make('layouts.projects.new')
		->with('project', $project)->with('type',  'edit')  ;
	}

	public function update($id){
		$project = Project::findOrFail($id);
		$project->fill(Input::all());
		$project->save();
		$organization = app('organization');
		return Redirect::to('organization/name/'.$organization->auxName.'/projects')
			->with('message', 'Registro actualizado');
	}


	public function destroy($id){
		//project
		$project = Project::find($id);
		if( sizeof($project->iterations) < 1 ){
			$project->delete();
		}

		$organization = app('organization');
		return Redirect::to('organization/name/'.$organization->auxName.'/projects')->with('message', 'Registro eliminado');
	}
}
?>