<?php 

class IssueController extends BaseController {
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
		$this->layout->content = View::make('layouts.issue.form')
		->with('project', app('project')) 
		->with('type',  'new');
	}

	//save mew
	public function store(){
		 
		 $validator = Validator::make(Input::all(), Issue::$rules);

		 if($validator->passes()){
		 	$issue = new Issue;
			$issue->summary = Input::get('summary'); 
			$issue->detail = Input::get('detail'); 
			$issue->budget = 0.0;  	 
			$issue->currentState = "TO-DO";  
			$issue->points = Input::get('points'); 
			$issue->labels = Input::get('labels'); 
			$issue->iterationid = Input::get('iterationid'); 

				$categoryId = Input::get('categoryid');
				if($categoryId == 0 ){
					//crear categoria 
					$category = new Category;
					$category->name = Input::get('category_name');
					$category->save();
					$issue->categoryid = $category->id;
				}else{
					$issue->categoryid = $categoryId;
				}

				$issue->save();
 					return Redirect::to('/iterations/'.$issue->iterationid)
						->with('message', 'Historia creada con exito');	
			}else{
				return Redirect::to('issue/create')
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