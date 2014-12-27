<?php 

class ProjectsController extends BaseController {
	protected $layout = "layouts.main";

 	public function index() {
 		 
 	}

    public function show($id) { 

    	try {
			$project = Project::findOrFail($id);
			$iterations =sizeof($project->iterations);
			$this->layout->content = View::make('layouts.projects.show')
								->with('project', $project)
								->with('iterations', $iterations);
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
			$organization = app('organization');
		    return Redirect::to('/materials/')
			->with('message', 'No existe el material');
		}
    }


	public function create(){  
		$this->layout->content = View::make('layouts.projects.new')
		->with('organization', app('organization')) 
		->with('type',  'new') ;
	}

	//save mew
	public function store(){
		$validator = Validator::make(Input::all(), Project::$rules);

		if ($validator->passes()) { 

			$project = new Project;
			$project->name = Input::get('name'); 
			$project->startDate = Input::get('startDate'); 
			$project->endDate = Input::get('endDate');   
			$project->budgetEstimated = Input::get('budgetEstimated');  
			$project->organizationid = Input::get('organizationid'); 
			$project->save();

			$organization = app('organization');
			return Redirect::to('organization/name/'.$organization->auxName.'/projects')
			->with('message', 'Registro creado con exito'); 
		}else{
			return Redirect::to('projects/create')
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   	
		}
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