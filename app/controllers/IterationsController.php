<?php 

class IterationsController extends BaseController {
	protected $layout = "layouts.main";

 	public function index() {
 		 
 	}

    public function show($id) { 
   
    	try {
			$iteration = Iterations::findOrFail($id); 
			$iterations = Iterations::where('projectid','=', $iteration->projectid)->get();
			$project = Project::findOrFail($iteration->projectid);
			$issues = Issue::where('iterationid','=', $id)->get();  
			$countIssues = sizeof($issues);
			$totalPoints = $issues->sum('points'); 
			$this->layout->content = View::make('layouts.iterations.show')
								->with('iteration', $iteration)
								->with('iterations', $iterations)
								->with('issues', $issues)
								->with('countIssues', $countIssues)
								->with('totalPoints', $totalPoints)
								->with('project', $project)
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
		
		$validator = Validator::make(Input::all(), Iterations::$rules);

		if($validator->passes()){
			$iterations = new Iterations;
			$iterations->name = Input::get('name'); 
			$iterations->start = Input::get('start'); 
			$iterations->end = Input::get('end');   
			$iterations->realBudget = Input::get('realBudget');  
			$iterations->projectid = Input::get('projectid'); 
			$iterations->save();

			$organization = app('organization');
			return Redirect::to('/iterations/'.$iterations->id)
			->with('message', 'Iteracion creada con exito'); 
			
		}else{
			return Redirect::to('iterations/create?projectid='.Input::get('projectid'))
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