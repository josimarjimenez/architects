<?php 

class ProjectsController extends BaseController {
	protected $layout = "layouts.main";

 	public function index() {
 		 
 	}

    public function show($id) { 

    	try {
			$project = Project::findOrFail($id); 
			$iterations =sizeof($project->iterations);
			$idIterations = array();
			foreach ($project->iterations as $iteration) {
				$idIterations[] = $iteration->id;
			}
			$stories= Issue::whereIn('iterationid', $idIterations)->get();
			$totalStories = sizeof($stories);
			$storiesCompleted = Issue::whereIn('iterationid', $idIterations)->
								where('currentState', 'TO-DO')->get();
			$storiesProgress = Issue::whereIn('iterationid', $idIterations)->
								where('currentState', 'DOING')->get();
 
			$this->layout->content = View::make('layouts.projects.show')
								->with('project', $project)
								->with('iterations', $iterations)
								->with('totalStories', $totalStories)
								->with('completed', count($storiesCompleted))
								->with('doing', count($storiesProgress));

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
		//$validator = Validator::make(Input::all(), Project::$rules);
		$validator = Validator::make(Input::all(), Project::$rules, Project::$messages);

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

		$validator = Validator::make(Input::all(), Project::$rules, Project::$messages);

		if ($validator->passes()) { 

			$project->fill(Input::all());
			$project->save();
			$organization = app('organization');
			return Redirect::to('organization/name/'.$organization->auxName.'/projects')
				->with('message', 'Registro actualizado');
		}else{
			return Redirect::to('projects/'.$id.'/edit')
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   	
		}
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

	public function getMembers($id){
		$organization = app('organization');
		$project = Project::find($id);
		$team = $project->team;
		$users = User::all();
		$members;

		//echo 'Hoal mundo >>>>>>>>>>>>>>>>>>>>>>>>';
		//die;

		if($team != null){
			$members = Teams::find($team->id)->users;
			$members = array_pluck($members, 'id');
			$this->layout->content = View::make('layouts.projects.addMembers')
								->with('organization', $organization)
								->with('project',$project)
								->with('team', $team)
								->with('users', $users)
								->with('members',$members);	
		}
		//$users = Teams::find($team->id)->users();
		//$organization = app('organization');
		//$this->layout->content = View::make('layouts.projects.addMembers')
		//						->with('organization', $organization)
		//						->with('users', $users);
		//$this->layout->content = View::make('layouts.projects.addMembers');
		//						->with('organization', $organization)
		//						->with('users', $users);
	}

	public function postAsigned() { 
 		$members = Input::get('users_id');
 		$project_id = Input::get('project_id');
 		$team_id = Input::get('team_id');
 		$var = null;
 		$num = count($members) ;
		$team = Teams::find($team_id);
    	$team->users()->sync($members);
 		return Redirect::to('projects/members/'.$project_id)->with('message', 'Se han asignado los miembros correctamente.');
	}

}
?>