<?php 

class ProjectsController extends BaseController {
	protected $layout = "layouts.main";

 	public function index() {}

    public function show($id) {}


	public function create(){  
		$this->layout->content = View::make('layouts.projects.projectForm')
		->with('organization', app('organization'))  ;
	}

	//save mew
	public function store(){
		$validator = Validator::make(Input::all(), Project::$rules);

		if ($validator->passes()) { 

			$project = new Project;
			$project->name = Input::get('name'); 
			$project->startDate = Input::get('startDate'); 
			$project->endDate = Input::get('endDate');   
			$project->budgetEstimated = Input::get('budget');  
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
		
		 
		$this->layout->content = View::make('layouts.projects.projectEditForm')
		->with('project', $project)  ;
	}

	public function update($id){
		$project = Project::findOrFail($id);
		$project->fill(Input::all());
		$project->save();
		$organization = app('organization');
		return Redirect::to('organization/name/'.$organization->auxName.'/projects')
			->with('message', 'Registro actualizado');
	}
}
 ?>