<?php 

class TaskController  {
	protected $layout = "layouts.main";

 	public function index() {
 		 
 	}

    public function show($id) { 
 
    }


	public function create(){  
		 
	}

	//save mew
	public function store(){ 	
		//metodo no usado, se maneja por ajax las peticiones  
		$task = new Task;
		$task->name = Input::get("name");
		$task->summary = Input::get("summary");
		$task->points  = Input::get("points");
		$task->timeEstimated = Input::get("hours");
		$task->timeRemaining = Input::get("hours");
		$task->scrumid = 1; //estado todo ...quemado por código
		$task->issueid = Input::get("issueid"); 
		$task->userid =  Input::get("selAssignee");
		
		$task->save();
		//die;
	}

	public function edit($id){
		 
	}

	public function update($id){
		 
	}


	public function destroy($id){
		 
	}

	public function showRemaining($id){
		$task = Task::findOrFail($id);
		$this->layout->content = View::make('layouts.task.remainingForm')
		->with('organization', app('organization')) 
		->with('type',  'new') ;
	}
}
?>