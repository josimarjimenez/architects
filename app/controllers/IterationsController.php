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
			$categories = Category::all();
			$idCategory = 0;
			$totalPoints = $issues->sum('points'); 
			$materiales = Material::all();
			$team = Teams::where('projectid','=',$project->id)->get()->first(); 
			$members = DB::table('memberof')->where('teamid','=', $team->id)->get();
			$hasmembers = (sizeof($members)>0)? true : false;
			
 
			$this->layout->content = View::make('layouts.iterations.show')
								->with('iteration', $iteration)
								->with('iterations', $iterations)
								->with('issues', $issues)
								->with('categories', $categories)
								->with('idCategory', $idCategory)
								->with('countIssues', $countIssues)
								->with('totalPoints', $totalPoints)
								->with('project', $project)
								->with('materiales', $materiales)
								->with('hasmembers', $hasmembers)
								->with('members', $members)
								->with('message', '');
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

	//date validator
	public function validarFecha($inicio, $fin){
		 
		if($inicio > $fin){
 
			return false;
		}else{ 
			return true;
		}
	}

	//save mew
	public function store(){

		$validator = Validator::make(Input::all(), Iterations::$rules);
		$inicio = Input::get('start'); 
		$end  = Input::get('end');   

		$valido = $this->validarFecha($inicio, $end); 
		if(!$valido){
		return Redirect::to('iterations/create?projectid='.Input::get('projectid'))
			->with('message', 'La fecha inicial es mayor que la final')
			->withErrors($validator)
			->withInput();
		}	
		if($validator->passes() && $valido){
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