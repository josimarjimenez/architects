<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('before' => 'auth'), function()
{
	Route::controller('organization', 'OrganizationsController');
	Route::controller('states','ScrumStatesController');
	Route::resource('projects', 'ProjectsController');
	//Route::resource('users', 'UsersController');
	Route::resource('materials', 'MaterialsController');
	Route::resource('teams', 'TeamsController');
	Route::resource('taskBoard', 'TaskBoardController'); 
	Route::resource('issue', 'IssueController');
	Route::resource('iterations', 'IterationsController');
	//Route::resource('task', 'TaskController');
	Route::resource('personalType', 'PersonalTypeController');
});


Route::get('users/delete', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$user = User::findOrFail($id); 
		$organizations = sizeof(Organization::where('usersid','=', $id)->get());

 
		if($organizations>= 1){
			return Response::json(array('succes'=>'false', 
				'message'=>'No se puede borrar el registro. <br />El usuario es propietario de una organización'));
		}

		if($user->delete()){
			return Response::json(array('succes'=>'true', 
				'message'=>'Usuario eliminado exitosamente', 'gr'=>$user->organization()));
		}else{
			return Response::json(array('succes'=>'false', 
				'message'=>'Error, claves foráneas'));
		}
	} 
}); 

Route::controller('projects', 'ProjectsController');
Route::controller('users', 'UsersController');
Route::get('/', 'UsersController@getLogin');
Route::post('update/{id}', 'UsersController@update');
Route::get('grafica/{id}', 'GraphicsController@create');

Route::post('task', function(){ 
	if(Request::ajax()){ 
		$task = new Task; 
		$task->name = Input::get("name");
		$task->summary = Input::get("summary");
		//$task->points  = Input::get("points");
		$task->points  = 1;
		$task->timeEstimated = Input::get("timeEstimated");
		$task->timeRemaining = Input::get("timeEstimated");
		$task->scrumid = 1; //estado todo ...quemado por código
		$task->issueid = Input::get("issueid"); 
		$task->save();
		if($task){  
			return Response::json(array(
                    'success' => true,
                    'message' => 'Tarea registrada',
                    'task' =>  $task
            ));
		}else{
			 return Response::json(array(
                'success' => false,
                'errors' => 'Error al grabar'
            )); 
		}
	}
});
//get specific task
Route::get('tareas/getTask', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$task = Task::findOrFail($id);
		return Response::json(array('task'=>$task));
	}
});

//get all task
Route::get('tareas/taskAll', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$tasks = Task::where('issueid','=', $id)->get();
		return Response::json(array('tasks'=>$tasks));
	}
});

//udpate STATE task
Route::get('tareas/updateTaks', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$state = Input::get("state");
		$task = Task::findOrFail($id);
		
		switch($state){
			case "todo":
				$task->scrumid = 1; 
			break;
			case "haciendo":
				$task->scrumid = 2;
			break;
			case "hecho":
				$task->scrumid = 3;
			break;
		}
		$task->save();
		return Response::json(array('succes'=>'1'));
	}
});

Route::post('tareas/editTask', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$task = Task::findOrFail($id);
		$task->name = Input::get("name"); 
		$task->summary = Input::get("summary");
		$task->points = Input::get("tags");
		$task->timeEstimated = Input::get("timeEstimated");
		


		//vincular materiales a tarea
		$idsMaterial =  Input::get("listaIDS");
		$ids = explode(" ", $idsMaterial);
		foreach ($ids as $id) {
			if($id==''){
				continue;
			}
			$cantidad 	=  Input::get("cu_".$id); 
			$total  	=  Input::get("to_".$id);
			$idMaterial =  Input::get("id_".$id); 
			  
			$task->materials()->attach([$id => ['quantity'=>$cantidad, 'total'=>$total]]);
		}
 
		$task->save();


		$issue = Issue::findOrFail($task->issueid);
		$iteration = Iterations::findOrFail($issue->iterationid);
		$project = Project::findOrFail($iteration->projectid);
		$totalSpent = Input::get("total");
		/*
		$iteration->summaryBudgets = $iteration->summaryBudgets + $totalSpent;
		$iteration->save();

		$project->budgetSummary = $project->budgetSummary +$totalSpent;
		$project->save();
		*/
		return Response::json(array('succes'=>'1'));
	}
});


Route::get('ajax/getProject', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$project = Project::findOrFail($id); 
		return Response::json(array('project'=>$project, 'iterations'=>$project->iterations));
	}
});

